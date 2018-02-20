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

function const_include_coms($modules, $modules_name, $tables_name, $tables_module_table, $tables_champs, $tables_parametres, $tables_img)
{
	$coms_file = "comment_new.php";
	$coms_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/".$coms_file;
	$en_tete = const_entete($modules, 0);
	
	////Copie des fichiers coms
	//comment_edit.php
	$coms_edit = XOOPS_ROOT_PATH."/modules/TDMCreate/include/comment_edit.php";
	copy($coms_edit, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/comment_edit.php");
	//comment_delete.php
	$coms_delete = XOOPS_ROOT_PATH."/modules/TDMCreate/include/comment_delete.php";
	copy($coms_delete, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/comment_delete.php");
	//comment_post.php
	$coms_post = XOOPS_ROOT_PATH."/modules/TDMCreate/include/comment_post.php";
	copy($coms_post, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/comment_post.php");
	//comment_reply.php
	$coms_reply = XOOPS_ROOT_PATH."/modules/TDMCreate/include/comment_reply.php";
	copy($coms_reply, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/comment_reply.php");

	//Champs
	$champs_total = explode("|", $tables_champs);
	$nb_champs = count($champs_total);
	//print_r($champs_total);
	//Parametres
	$parametres_total = explode("|", $tables_parametres);

	//Recuperation des parametres affichage dans le formulaire
	for($j=0; $j<$nb_champs; $j++)
	{
		$champs = explode(":", $champs_total[$j]);
		//Afficher dans les elements du formulaire et choisir le type
			if( $j != 0 ) 
			{
				$parametres1 = explode(":", $parametres_total[$j-1]);
				if ( $parametres1[4] == 1 ) 
				{
					$champs_param_main_field = $champs[0];
				}
			}
	}
	
	
	$text = '<?php'.$en_tete.'
	include "../../mainfile.php";
	include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/class/'.$tables_name.'.php";
	$com_itemid = isset($_REQUEST["com_itemid"]) ? intval($_REQUEST["com_itemid"]) : 0;
	if ($com_itemid > 0) {
		$'.$tables_name.'Handler =& xoops_getModuleHandler("'.$tables_module_table.'", "'.$tables_name.'");
		$'.$tables_name.' = $'.$tables_name.'handler->get($com_itemid);
		$com_replytitle = $'.$tables_name.'->getVar("'.$champs_param_main_field.'");
		include XOOPS_ROOT_PATH."/include/comment_new.php";
	}
?>';
		
	$handle = fopen($coms_path_file ,"w");

	if (is_writable($coms_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_COMS.'<br>'.$coms_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_COMS.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_COMS.'<br>'.$coms_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>