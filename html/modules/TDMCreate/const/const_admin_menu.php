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

function const_admin_menu($modules, $modules_name, $tables_arr)
{
	global $xoopsModule, $xoopsConfig;
	
	$language = '_MI_'.strtoupper($modules_name).'_MANAGER_';
	$admin_menu_file = "menu.php";
	$admin_menu_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/".$admin_menu_file;
	$en_tete = const_entete($modules, 0);
	$menu = 0;
	$text = '<?php'.$en_tete.'
$adminmenu = array(); 
$adminmenu['.$menu.']["title"] = '.$language.'INDEX;
$adminmenu['.$menu.']["link"] = "admin/index.php";
';
	$menu++;
	foreach (array_keys($tables_arr) as $i)
	{
		$tables_id = $tables_arr[$i]->getVar("tables_id");
		if ( $tables_arr[$i]->getVar("tables_display_admin") == 1 ) {
			$text .= '$adminmenu['.$menu.']["title"] = '.$language.''.strtoupper($tables_arr[$i]->getVar("tables_name")).';
$adminmenu['.$menu.']["link"] = "admin/'.$tables_arr[$i]->getVar("tables_name").'.php";
';
		$menu++;
		}
	}
$tables_id++;
$text .= '$adminmenu['.$menu.']["title"] = '.$language.'PERMISSIONS;
$adminmenu['.$menu.']["link"] = "admin/permissions.php";
';
$menu++;
$text .= '
$adminmenu['.$menu.']["title"] = '.$language.'ABOUT;
$adminmenu['.$menu.']["link"] = "admin/about.php";

?>';
		
	//Integration du contenu dans admin_header
	$handle = fopen($admin_menu_path_file ,"w");

	if (is_writable($admin_menu_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_MENU.'<br>'.$admin_menu_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_ADMIN_MENU.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		 echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_MENU.'<br>'.$admin_menu_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>