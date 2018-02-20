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

function const_admin_language($modules, $modules_name, $tables_arr)
{
	$language = '_AM_'.strtoupper($modules_name).'_';
	
	$admin_language_file = "admin.php";
	$admin_language_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language/french/".$admin_language_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'	
//Menu
define("'.$language.'MANAGER_INDEX","Index");

';

foreach (array_keys($tables_arr) as $i) 
{	
	$text .= 'define("'.$language.'THEREARE_'.strtoupper($tables_arr[$i]->getVar("tables_name")).'","Il y a <span style=\"color: #ff0000; font-weight: bold\">%s</span> '. ucfirst ($tables_arr[$i]->getVar("tables_name")).'s dans la Base de donn&#233;e");
define("'.$language.'THEREARE_'.strtoupper($tables_arr[$i]->getVar("tables_name")).'_ONLINE","Il y a <span style=\'color: #ff0000; font-weight: bold\'>%s</span> '. ucfirst ($tables_arr[$i]->getVar("tables_name")).'s en attente");
';
}

$text .= '
define("'.$language.'MANAGER_ABOUT","A propos");
define("'.$language.'MANAGER_PREFERENCES","Preferences");
define("'.$language.'MANAGER_UPDATE","Mise a jour");
define("'.$language.'MANAGER_PERMISSIONS","Permissions");

//Index
';

foreach (array_keys($tables_arr) as $i) 
{	
	$text .= 'define("'.$language.'MANAGER_'.strtoupper($tables_arr[$i]->getVar("tables_name")).'","'.ucfirst(strtolower($tables_arr[$i]->getVar("tables_name"))).'");
';
}

$text .= '

//General
define("'.$language.'FORMOK","Enregistre avec succes");
define("'.$language.'FORMDELOK","Supprim&eacute; avec succ&egrave;s");
define("'.$language.'FORMSUREDEL", "Etes-vous s&ucirc;r de vouloir supprimer : <b><span style=\"color : Red\"> %s </span></b>");
define("'.$language.'FORMSURERENEW", "Etes-vous s&ucirc;r de vouloir renevouler : <b><span style=\"color : Red\"> %s </span></b>");
define("'.$language.'FORMUPLOAD","Upload");
define("'.$language.'FORMIMAGE_PATH","Fichier present dans %s");
define("'.$language.'FORMACTION","Action");
define("'.$language.'OFF","Hors ligne");
define("'.$language.'ON","En ligne");
define("'.$language.'EDIT","Editer");
define("'.$language.'DELETE","Supprimer");
';
$verif = true;
foreach (array_keys($tables_arr) as $i) 
{
	//Champs
	$champs_total = explode("|", $tables_arr[$i]->getVar("tables_champs"));
	$nb_champs = count($champs_total);
	$nb_caracteres = strlen($tables_arr[$i]->getVar("tables_name"));
	$language1 = $language.strtoupper($tables_arr[$i]->getVar("tables_name")).'_';

	//Recuperation des noms des tables
	for($j=0; $j<$nb_champs; $j++)
	{	
		//Nom des champs
		$champs1 = explode(":", $champs_total[$j]);
		$champs[$j] = $champs1[0];
		$champs_final[$j] = substr("".$champs1[0]."", $nb_caracteres+1);
		
		if ( $verif == true )
		{
			$text .= 'define("'.$language1.'ADD","Ajouter un '.$tables_arr[$i]->getVar("tables_name").'");
define("'.$language1.'EDIT","Editer un '.$tables_arr[$i]->getVar("tables_name").'");
';
		}
		$verif = false;
		$text .= 'define("'.$language1.strtoupper($champs_final[$j]).'","'.UcFirstAndToLower($champs_final[$j]).'");
';		
	}
	$verif = true;
	$text .= '
';
}

$text .= '//Blocks.php
';
foreach (array_keys($tables_arr) as $i) 
{
	$language1 = $language.strtoupper($tables_arr[$i]->getVar("tables_name")).'_';
$text .= 'define("'.$language1.'BLOCK_DAY","'.$tables_arr[$i]->getVar("tables_name").'s d\'aujourdh\'ui");
define("'.$language1.'BLOCK_RANDOM","'.$tables_arr[$i]->getVar("tables_name").'s aleatoires");
define("'.$language1.'BLOCK_RECENT","'.$tables_arr[$i]->getVar("tables_name").'s recents");
';	
}


$text .= '
//Permissions
define("'.$language.'PERMISSIONS_ACCESS","Permission de voir");
define("'.$language.'PERMISSIONS_SUBMIT","Permission de soumettre");

//About.php
define("'.$language.'ABOUT_RELEASEDATE","Release Date");
define("'.$language.'ABOUT_AUTHOR","Author");
define("'.$language.'ABOUT_CREDITS","Credits");
define("'.$language.'ABOUT_README","Générale Information");
define("'.$language.'ABOUT_MANUAL","Aide");
define("'.$language.'ABOUT_LICENSE","Licence");
define("'.$language.'ABOUT_MODULE_STATUS","Status");
define("'.$language.'ABOUT_WEBSITE","Web Site");
define("'.$language.'ABOUT_AUTHOR_NAME","Author Name");
define("'.$language.'ABOUT_AUTHOR_WORD","Author Word");
define("'.$language.'ABOUT_CHANGELOG","Change Log");
define("'.$language.'ABOUT_MODULE_INFO","Module Info");
define("'.$language.'ABOUT_AUTHOR_INFO","Author Info");
define("'.$language.'ABOUT_DISCLAIMER","Disclaimer");
define("'.$language.'ABOUT_DISCLAIMER_TEXT","GPL Licensed - No Warranty");
	
?>';
		
	//Integration du contenu dans le bloc
	$handle = fopen($admin_language_path_file ,"w");

	if (is_writable($admin_language_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_LANGUAGE.'<br>'.$admin_language_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_ADMIN_LANGUAGE.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_LANGUAGE.'<br>'.$admin_language_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>