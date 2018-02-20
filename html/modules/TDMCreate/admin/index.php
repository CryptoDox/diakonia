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

include '../../../include/cp_header.php'; 
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once("../include/functions.php");

xoops_cp_header();
//apelle du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMCreate_adminmenu(0, _AM_TDMCREATE_MANAGER_INDEX);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (0, _AM_TDMCREATE_MANAGER_INDEX);
}

include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname().'/class/menu.php';

				$menu = new TDMCreateMenu();
				$menu->addItem('modules', 'modules.php', '../images/deco/modules.png', _AM_TDMCREATE_MANAGER_MODULES);
				$menu->addItem('tables', 'tables.php', '../images/deco/tables.png',  _AM_TDMCREATE_MANAGER_TABLES);
				$menu->addItem('const', 'const.php', '../images/deco/const.png',  _AM_TDMCREATE_MANAGER_CONST);
				$menu->addItem('about', 'about.php', '../images/deco/about.png',  _AM_TDMCREATE_MANAGER_ABOUT);
				$menu->addItem('update', '../../system/admin.php?fct=modulesadmin&op=update&module='.$xoopsModule ->getVar('name')
												, '../images/deco/update.png',  _AM_TDMCREATE_MANAGER_UPDATE);	
				/*$menu->addItem('Preference', '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod='.$xoopsModule ->getVar('mid').
												'&amp;&confcat_id=1', '../images/deco/pref.png',  _AM_TDMCREATE_MANAGER_PREFERENCES);	*/
				
	echo $menu->getCSS();
	
echo '<div class="CPbigTitle" style="background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; height: 48px;">
		<strong>'._AM_TDMCREATE_MANAGER_INDEX.'</strong>
	</div><br /><table width="100%" border="0" cellspacing="10" cellpadding="4">
  <tr>
  <td valign="top">
  '.$menu->render().'</td>
  <td valign="top" width="60%">&nbsp;
</td></tr></table>';
xoops_cp_footer();
?>