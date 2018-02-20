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

function const_include_install($modules, $modules_name, $tables_arr)
{		
	$indexFile = XOOPS_ROOT_PATH."/modules/TDMCreate/include/index.html";

	$include_install_file = "install.php";
	$include_install_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/include/".$include_install_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'
$indexFile = XOOPS_ROOT_PATH."/modules/TDMCreate/include/index.html";
$blankFile = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/blank.gif";

//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/'.$modules_name.'";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/index.html");
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
		if ( $i != 0 ) {
			$structure_parametres = explode(":", $parametres[$j]);	
			$j++;
		}
		if ( $i == 0 ) {
			$text .= '
//Creation du fichier '.$tables_name.' dans uploads
$module_uploads = XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'/index.html");
				';
		} else {
			if ( $structure_parametres[0] == 'XoopsFormUploadImage' || $structure_parametres[0] == 'XoopsFormUploadFile' )
			{
				$text .= '
//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'/'.$structure_champs[0].'";
if(!is_dir($module_uploads))
	mkdir($module_uploads, 0777);
	chmod($module_uploads, 0777);
copy($indexFile, XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'/'.$structure_champs[0].'/index.html");
copy($blankFile, XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'/'.$structure_champs[0].'/blank.gif");
';
			}
		}
	}
}
$text .='
?>';
	/*****************************************************/
	//Integration du contenu dans le bloc
	$handle = fopen($include_install_path_file ,"w");

	if (is_writable($include_install_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_INCLUDE_FUNCTIONS.'<br>'.$include_install_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_INCLUDE_FUNCTIONS.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_INCLUDE_FUNCTIONS.'<br>'.$include_install_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}
?>