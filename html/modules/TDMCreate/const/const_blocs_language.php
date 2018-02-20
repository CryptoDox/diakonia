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

function const_blocs_language($modules, $modules_name, $tables_arr)
{
	$language = '_MB_'.strtoupper($modules_name).'_';
	
	$blocs_language_file = "blocks.php";
	$blocs_language_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language/french/".$blocs_language_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'	
';

foreach (array_keys($tables_arr) as $i) 
{
	//Champs
	$champs_total = explode("|", $tables_arr[$i]->getVar("tables_champs"));
	$nb_champs = count($champs_total);
	$nb_caracteres = strlen($tables_arr[$i]->getVar("tables_name"));
	$tables_blocs = $tables_arr[$i]->getVar('tables_blocs');
	$language1 = $language.strtoupper($tables_arr[$i]->getVar("tables_name")).'_';
	if ( $tables_blocs == 1 ) {
		$text .= 'define("'.$language1.'DISPLAY","Afficher");
define("'.$language1.'TITLELENGTH","Longueur du titre");
define("'.$language1.'CATTODISPLAY","S&#233;lectionner les cat&#233;gories &#224; affich&#233;es");
define("'.$language1.'ALLCAT","Toutes les cat&#233;gories");

';
	}
	//Recuperation des noms des tables
	for($j=0; $j<$nb_champs; $j++)
	{	
		//Nom des champs
		$champs1 = explode(":", $champs_total[$j]);
		$champs[$j] = $champs1[0];
		$champs_final[$j] = substr("".$champs1[0]."", $nb_caracteres+1);
	
		$text .= 'define("'.$language1.strtoupper($champs_final[$j]).'","'.UcFirstAndToLower($champs_final[$j]).'");
';		
	}
	$text .= '
';
}

$text .= '

?>';
		
	//Integration du contenu dans le bloc
	$handle = fopen($blocs_language_path_file ,"w");

	if (is_writable($blocs_language_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_LANGUAGE.'<br>'.$blocs_language_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_BLOCS_LANGUAGE.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_LANGUAGE.'<br>'.$blocs_language_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>