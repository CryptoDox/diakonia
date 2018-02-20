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

function const_modinfo_language($modules, $modules_name, $tables_arr)
{
	$language = '_MI_'.strtoupper($modules_name).'_';
	
	$modinfo_language_file = "modinfo.php";
	$modinfo_language_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language/french/".$modinfo_language_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'
//Menu
define("'.$language.'MANAGER_INDEX","Index");
';
foreach (array_keys($tables_arr) as $i) 
{	
	$text .= 'define("'.$language.'MANAGER_'.strtoupper($tables_arr[$i]->getVar("tables_name")).'","'.ucfirst(strtolower($tables_arr[$i]->getVar("tables_name"))).'");
';
}
$text .= '
define("'.$language.'MANAGER_ABOUT","A propos");
define("'.$language.'MANAGER_PREFERENCES","Preferences");
define("'.$language.'MANAGER_UPDATE","Mise a jour");
define("'.$language.'MANAGER_PERMISSIONS","Permissions");

//Config
define("'.$language.'EDITOR","Editeur");
';

foreach (array_keys($tables_arr) as $i) 
{	
	$tables_name = $tables_arr[$i]->getVar("tables_name");
	$tables_champs = $tables_arr[$i]->getVar("tables_champs");
	$tables_parametres = $tables_arr[$i]->getVar("tables_parametres");
	
	//Champs
	$champs = explode("|", $tables_champs);
	$nb_champs = count($champs);

	//Parametres
	$parametres = explode("|", $tables_parametres);
	$nb_parametres = count($parametres);
	$j=0;
	for ($i=0; $i<$nb_champs; $i++)
	{
		$structure_champs = explode(":", $champs[$i]);
		$language1 = $language.strtoupper($structure_champs[0]).'';
		if ( $i != 0 ) 
		{
			$structure_parametres = explode(":", $parametres[$j]);	
			$j++;
			if ( $structure_parametres[0] == 'XoopsFormUploadImage' || $structure_parametres[0] == 'XoopsFormUploadFile' )
			{
				$text .= '
define("'.$language1.'_SIZE","Taille autorisee pour '.$structure_champs[0].'");
define("'.$language1.'_MIMETYPES","Types mime autorises pour '.$structure_champs[0].'");
';
			}
		}
	}
}
$text .='

//Blocks
';

foreach (array_keys($tables_arr) as $i) 
{	
	$language1 = $language.strtoupper($tables_arr[$i]->getVar("tables_name")).'';
	$text .= 'define("'.$language1.'_BLOCK_RECENT","'.strtolower($tables_arr[$i]->getVar("tables_name")).' recents");
define("'.$language1.'_BLOCK_DAY","'.strtolower($tables_arr[$i]->getVar("tables_name")).' d\'aujourdh\'ui");
define("'.$language1.'_BLOCK_RANDOM","'.strtolower($tables_arr[$i]->getVar("tables_name")).' aleatoires");
';
}
$text .='
?>';
		
	//Integration du contenu dans modinfo
	$handle = fopen($modinfo_language_path_file ,"w");

	if (is_writable($modinfo_language_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_MODINFO_LANGUAGE.'<br>'.$modinfo_language_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_MODINFO_LANGUAGE.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_MODINFO_LANGUAGE.'<br>'.$modinfo_language_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>