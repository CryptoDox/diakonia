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

function const_user_index($modules, $modules_name, $tables_id, $tables_module_table, $tables_name)
{
	$language = '_AM_'.strtoupper($modules_name).'';
	$language_manager = '_AM_'.strtoupper($modules_name).'_MANAGER_'.strtoupper($tables_name).'';
	
	$modules_name_minuscule = strtolower($modules_name);
	$user_index_file = "index.php";
	$user_index_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/".$user_index_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'
include "../../mainfile.php";
include_once XOOPS_ROOT_PATH."/header.php";

include_once XOOPS_ROOT_PATH."/footer.php";	
?>';
		
	//Integration du contenu dans le bloc
	$handle = fopen($user_index_path_file ,"w");

	if (is_writable($user_index_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'.sprintf(_AM_TDMCREATE_CONST_NOTOK_INDEX_USER, $tables_name).'<br>'.$user_index_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'.sprintf(_AM_TDMCREATE_CONST_OK_INDEX_USER, $tables_name).'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'.sprintf(_AM_TDMCREATE_CONST_NOTOK_INDEX_USER, $tables_name).'<br>'.$user_index_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>