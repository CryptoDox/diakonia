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
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_entete.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';

function const_blocs($modules, $modules_name, $tables_module_table, $tables_name, $tables_champs, $tables_parametres, $topic)
{
	$language = '_MB_'.strtoupper($tables_module_table).'';
	$modules_name_minuscule = strtolower($modules_name);
	$blocs_file = "blocks_".$tables_name.".php";
	$blocs_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/blocks/".$blocs_file;
	$constructor = const_champs($modules_name, $tables_module_table, $tables_name, $tables_champs, $tables_name, 0, 0, 0);
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'	
include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/include/functions.php";
	
function b_'.$modules_name_minuscule.'_'.$tables_name.'($options) {
include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/class/'.$tables_name.'.php";
$myts =& MyTextSanitizer::getInstance();

$'.$tables_name.' = array();
$type_block = $options[0];
$nb_'.$tables_name.' = $options[1];
$lenght_title = $options[2];

$'.$tables_name.'Handler =& xoops_getModuleHandler("'.$tables_module_table.'", "'.$modules_name.'");
$criteria = new CriteriaCompo();
array_shift($options);
array_shift($options);
array_shift($options);
';
if ( $topic == 1 ) {
$text .= 'if (!(count($options) == 1 && $options[0] == 0)) {
$criteria->add(new Criteria("'.$tables_name.'_topic", block_addCatSelect($options),"IN"));
}
';
} 
$text .= '
switch ($type_block) 
{
	// pour le bloc: '.$tables_name.' recents
	case "recent":
		$criteria->add(new Criteria("'.$tables_name.'_online", 1));
		$criteria->setSort("'.$tables_name.'_date_created");
		$criteria->setOrder("DESC");
	break;
	// pour le bloc: '.$tables_name.' du jour
	case "day":	
		$criteria->add(new Criteria("'.$tables_name.'_online", 1));
		$criteria->add(new Criteria("'.$tables_name.'_date_created", strtotime(date("Y/m/d")), ">="));
		$criteria->add(new Criteria("'.$tables_name.'_date_created", strtotime(date("Y/m/d"))+86400, "<="));
		$criteria->setSort("'.$tables_name.'_date_created");
		$criteria->setOrder("ASC");
	break;
	// pour le bloc: '.$tables_name.' aléatoires
	case "random":
		$criteria->add(new Criteria("'.$tables_name.'_online", 1));
		$criteria->setSort("RAND()");
	break;
}


$criteria->setLimit($nb_'.$tables_name.');
$'.$tables_name.'_arr = $'.$tables_name.'Handler->getall($criteria);';

$text .= '
	foreach (array_keys($'.$tables_name.'_arr) as $i) 
	{
	';	
		$prefix = '$'.$tables_name.'_arr[$i]->getVar';
		//Champs
		$champs = explode("|", $tables_champs);
		$nb_champs = count($champs);

		//Parametres
		$parametres = explode("|", $tables_parametres);
		$nb_parametres = count($parametres);

		$j=0;
		$structure_parametres[3] = 0;
		for ($i=0; $i<$nb_champs; $i++)
		{
			$structure_champs = explode(":", $champs[$i]);
			if ( $i != 0 ) {
				$structure_parametres = explode(":", $parametres[$j]);	
				$j++;
			}
			if( $structure_parametres[3] == 1 || $i == 0) {
				$text .= '	$'.$tables_name.'[$i]["'.$structure_champs[0].'"] = '.$prefix.'("'.$structure_champs[0].'");
		';
			}
	}
$text .= '
	}
return $'.$tables_name.';
}

function b_'.$modules_name_minuscule.'_'.$tables_name.'_edit($options) {';

if ( $topic == 1 ) {
$text .='
	include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/class/topic.php";
	
	$topicHandler =& xoops_getModuleHandler("'.$modules_name.'_topic", "'.$modules_name.'");
	$criteria = new CriteriaCompo();
	$criteria->setSort("topic_title");
	$criteria->setOrder("ASC");
	$topic_arr = $topicHandler->getall($criteria);
	';
}
$text .='
	$form = "".'.$language.'_DISPLAY."\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"".$options[0]."\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"".$options[1]."\" type=\"text\" />&nbsp;<br />";
	$form .= "".'.$language.'_TITLELENGTH." : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"".$options[2]."\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);';
	$text .= '
	$form .= "".'.$language.'_CATTODISPLAY."<br /><select name=\"options[]\" multiple=\"multiple\" size=\"5\">";
	$form .= "<option value=\"0\" " . (array_search(0, $options) === false ? "" : "selected=\"selected\"") . ">" .'.$language.'_ALLCAT . "</option>";
	foreach (array_keys($topic_arr) as $i) {
		$form .= "<option value=\"" . $topic_arr[$i]->getVar("topic_id") . "\" " . (array_search($topic_arr[$i]->getVar("topic_id"), $options) === false ? "" : "selected=\"selected\"") . ">".$topic_arr[$i]->getVar("topic_title")."</option>";
	}
	$form .= "</select>";

	return $form;
}
	
?>';
		
	//Integration du contenu dans le bloc
	$handle = fopen($blocs_path_file ,"w");

	if (is_writable($blocs_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS.'<br>'.$blocs_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_BLOCS.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS.'<br>'.$blocs_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>