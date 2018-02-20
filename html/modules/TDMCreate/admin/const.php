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
include_once("../include/functions.php");

include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_architecture.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_xoopsversion.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_include_search.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_include_coms.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_include_functions.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_include_install.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_sql.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_class.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_blocs.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_blocs_templates.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_class_menu.php';

include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_header.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_menu.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_index.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_pages.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_about.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_permissions.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_modinfo_language.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_admin_language.php';
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_blocs_language.php';

include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_user_index.php';

xoops_cp_header();
//appele du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMCreate_adminmenu(3, _AM_TDMCREATE_MANAGER_CONST);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (3,_AM_TDMCREATE_MANAGER_CONST);
}

if (isset($_REQUEST['op'])) {
	$op = $_REQUEST['op'];
} else {
	@$op = 'default';
}

//Class
$modulesHandler =& xoops_getModuleHandler('TDMCreate_modules', 'TDMCreate');
$tablesHandler =& xoops_getModuleHandler('TDMCreate_tables', 'TDMCreate');

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/deco/const.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;  height: 48px;"><strong>'._AM_TDMCREATE_MANAGER_CONST.'</strong>';
echo '</div><br />';


switch ($op) {
	case "construction":
		//Nom du module
		$modules =& $modulesHandler->get($_REQUEST['modules_name']);
		$modules_name = $modules->getVar('modules_name');
		$modules_image = $modules->getVar('modules_image');
		//Effacer repertoire du nouveau module s'il existe
		clearDir(XOOPS_ROOT_PATH.'/modules/TDMCreate/modules/'.$modules_name);

		//Nom des tables et combien de tables
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('tables_modules', $_REQUEST['modules_name']));
		$nb_tables = $tablesHandler->getCount($criteria);
		$tables_arr = $tablesHandler->getall($criteria);
		
		//Debut
		echo '<table width="100%" cellspacing="1" class="outer">';
		/************************************************/
		/*Structure*/
		/************************************************/
		//Creation de l'architecture
		const_architecture($modules_name, $modules_image);
		//Creation de xoopsversion.php
		/*Mettre xoops version vers la fin pour integrer les bloc, etc*/
		const_xoopsversion($modules, $modules_name, $tables_arr);
		//Creation de admin index.php
		$menu = 0;
		const_admin_index($modules, $modules_name, $tables_arr, $menu);
		
		foreach (array_keys($tables_arr) as $i) 
		{	
			//Variables
			$tables_id = $tables_arr[$i]->getVar('tables_id');
			$tables_name = $tables_arr[$i]->getVar('tables_name');
			$tables_module_table = $tables_arr[$i]->getVar('tables_module_table');
			$tables_img = $tables_arr[$i]->getVar('tables_img');
			$tables_champs = $tables_arr[$i]->getVar('tables_champs');
			$tables_parametres = $tables_arr[$i]->getVar('tables_parametres');
			$tables_blocs = $tables_arr[$i]->getVar('tables_blocs');
			$tables_display_admin = $tables_arr[$i]->getVar('tables_display_admin');
			$tables_search = $tables_arr[$i]->getVar('tables_search');
			$tables_coms = $tables_arr[$i]->getVar('tables_coms');
			
			//Fabrication
			//Copie des images des tables
			$tables_img1 = XOOPS_ROOT_PATH."/modules/TDMCreate/images/uploads/tables/".$tables_img;
			if (file_exists($tables_img1)) {
				copy($tables_img1, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/".$tables_img);
			}
			//Creation des classes
			const_class($modules, $modules_name, $tables_module_table, $tables_name, $tables_champs, $tables_parametres);
			//Creation des pages admin
			if ( $tables_display_admin == 1 ) {
				$menu++;
				const_admin_pages($modules, $modules_name, $tables_id, $tables_module_table, $tables_name, $tables_img, $tables_champs, $tables_parametres, $menu);
			}
			//Creation de search
			if ( $tables_search == 1 ) {
				const_include_search($modules, $modules_name, $tables_name, $tables_module_table, $tables_champs, $tables_parametres, $tables_img);
			}
			//Creation des coms
			if ( $tables_coms == 1 ) {
				const_include_coms($modules, $modules_name, $tables_name, $tables_module_table, $tables_champs, $tables_parametres, $tables_img);
			}
			
			//Creation du fichier mysql.sql
			const_sql($modules_name, $tables_module_table, $tables_name, $tables_champs);
			
			$result = $xoopsDB->queryF("SELECT COUNT(*) FROM " . $xoopsDB->prefix("tdmcreate_tables")." WHERE tables_name = 'topic'");
			list( $topic ) = $xoopsDB->fetchRow($result);
			//Creation des blocs
			if ( $tables_blocs == 1 ) {
				const_blocs($modules, $modules_name, $tables_module_table, $tables_name, $tables_champs, $tables_parametres, $topic);
				//Creation du template des blocks
				const_blocs_templates($modules, $modules_name, $tables_name, $tables_module_table, $tables_champs, $tables_parametres);
			}			
		}
		
		//Creation du fichier permissions
		if ( $topic == 1 ) {
			$menu++;
			const_admin_permissions($modules, $modules_name, $tables_arr, $menu);
		}
			
		//Include
		//Functions
		const_include_functions($modules, $modules_name);
		//Creation du fichier install pour l'uploads
		const_include_install($modules, $modules_name, $tables_arr);
		//Language
		///////////////////////////////////////////////////////////////////////
		//Creation du language modinfo.php
		const_modinfo_language($modules, $modules_name, $tables_arr);
		//Creation du language admin.php
		const_admin_language($modules, $modules_name, $tables_arr);
		//Creation du language blocks.php
		const_blocs_language($modules, $modules_name, $tables_arr);
		///////////////////////////////////////////////////////////////////////
		//Creation de la class menu
		const_class_menu($modules, $modules_name);
		
		/************************************************/
		/*Admin*/
		/************************************************/
		//Creation de admin header.php
		const_admin_header($modules, $modules_name, $tables_arr);
		//Creation de admin menu.php
		const_admin_menu($modules, $modules_name, $tables_arr);
		//Creation de admin about.php
		$menu++;
		const_admin_about($modules, $modules_name, $menu);
		/************************************************/
		/*Admin*/
		/************************************************/
		const_user_index($modules, $modules_name, $tables_id, $tables_module_table, $tables_name);
		echo '</table>';

	break;
	
	case "default":
	default:
	
		include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
		$action = $_SERVER['REQUEST_URI'];

        $form = new XoopsThemeForm(_AM_TDMCREATE_MANAGER_CONST, 'form_construction', $action, 'post', true);
		
		$modulesHandler =& xoops_getModuleHandler('TDMCreate_modules', 'TDMCreate');
    	$modules_select = new XoopsFormSelect(_AM_TDMCREATE_CONST_MODULES, 'modules_name', 'modules_name');
    	$modules_select->addOptionArray($modulesHandler->getList());
		$form->addElement($modules_select, true);
		$form->addElement(new XoopsFormHidden('op', 'construction'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
		$form->display();
	break;
}
xoops_cp_footer();
?>