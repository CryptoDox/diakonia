<?php
/**
 * ****************************************************************************
 *  - TDMCreate By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence GPL Copyright (c)  (http://www.tdmxoops.net)
 *
 * Cette licence, contient des limitations!!!
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license     TDM GPL license
 * @author		TDM TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';

function const_include_search($modules, $modules_name, $tables_name, $tables_module_table, $tables_champs, $tables_parametres, $tables_img)
{
	$searchfile = "search.inc.php";
	$searchpath_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/include/".$searchfile;
	$en_tete = const_entete($modules, 0);
	//copie de l'image de la table et renommer
	$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $tables_img) ;
	$imgFile = XOOPS_ROOT_PATH."/modules/TDMCreate/images/uploads/tables/".$tables_img."";
	$img_search = $tables_name."_search.".$extension;
	if (file_exists($imgFile)) {
		copy($imgFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/".$img_search."");
	}
	
	//Champs
	$champs_total = explode("|", $tables_champs);
	$nb_champs = count($champs_total);
	//print_r($champs_total);
	//Parametres
	$parametres_total = explode("|", $tables_parametres);
	$k = 0;
	//Recuperation des parametres affichage dans le formulaire
	for($j=0; $j<$nb_champs; $j++)
	{
		$champs = explode(":", $champs_total[$j]);
		//Afficher dans les elements du formulaire et choisir le type
			if( $j != 0 ) 
			{
				$parametres1 = explode(":", $parametres_total[$j-1]);
				if ( $parametres1[5] == 1 ) 
				{
					$champs_param_search_field[$k] = $champs[0];
					$k++;
				}
				if ( $parametres1[4] == 1 ) {
					$champs_param_main_field = $champs[0];
				}
			}
	}
	
	function search_field($champs_param_search_field, $options)
	{
		$nb_champs_param_search_field = count($champs_param_search_field);
		$sql = '(';
		for($l=0; $l<$nb_champs_param_search_field; $l++)
		{
			if ( $l != $nb_champs_param_search_field - 1 ) {
				$sql .= ''.$champs_param_search_field[$l].' LIKE \'%$queryarray['.$options.']%\' OR ';
			} else {
				$sql .= ''.$champs_param_search_field[$l].' LIKE \'%$queryarray[0]%\'';
			}
		}
		$sql .= ')';
		return $sql;
	}
	
	$text = '<?php'.$en_tete.'
	
	function '.$modules_name.'_search($queryarray, $andor, $limit, $offset, $userid)
	{
		global $xoopsDB;
		
		$sql = "SELECT '.$tables_name.'_id, '.$champs_param_main_field.', '.$tables_name.'_submitter, '.$tables_name.'_date_created FROM ".$xoopsDB->prefix("'.$tables_module_table.'")." WHERE '.$tables_name.'_online = 1";
		
		if ( $userid != 0 ) {
			$sql .= " AND '.$tables_name.'_submitter=".intval($userid)." ";
		}
		
		if ( is_array($queryarray) && $count = count($queryarray) ) 
		{
			$sql .= " AND (';
			$text .= ''.search_field($champs_param_search_field, 0).'";
			
			for($i=1;$i<$count;$i++)
			{
				$sql .= " $andor ";
				';
				$text .= '$sql .= "'.search_field($champs_param_search_field, '$i').'";
			}
			$sql .= ")";
		}
		
		$sql .= " ORDER BY '.$tables_name.'_date_created DESC";
		$result = $xoopsDB->query($sql,$limit,$offset);
		$ret = array();
		$i = 0;
		while($myrow = $xoopsDB->fetchArray($result))
		{
			$ret[$i]["image"] = "images/deco/'.$img_search.'";
			$ret[$i]["link"] = "'.$tables_name.'.php?'.$tables_name.'_id=".$myrow["'.$tables_name.'_id"]."";
			$ret[$i]["title"] = $myrow["'.$champs_param_main_field.'"];
			$ret[$i]["time"] = $myrow["'.$tables_name.'_date_created"];
			$ret[$i]["uid"] = $myrow["'.$tables_name.'_submitter"];
			$i++;
		}
		return $ret;
	}

	
?>';
		
	//Integration du contenu dans le fichier xoopsconfig.php
	$handle = fopen($searchpath_file ,"w");

	if (is_writable($searchpath_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_SEARCH.'<br>'.$searchpath_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_SEARCH.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_SEARCH.'<br>'.$searchpath_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>