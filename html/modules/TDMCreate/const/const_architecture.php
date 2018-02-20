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
function const_architecture($modules_name, $modules_image)
{	
	$indexFile = XOOPS_ROOT_PATH."/modules/TDMCreate/include/index.html";
	
	//Creation des fichiers
	//Creation du dossier du modules
	$module_path = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name;
	if(!is_dir($module_path))
		mkdir($module_path, 0705);
		chmod($module_path, 0705);
		
	//Creation du dossier "admin"
	$module_admin = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin";
	if(!is_dir($module_admin))
		mkdir($module_admin, 0705);
		chmod($module_admin, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/index.html");
	
	//Creation du dossier "admin"
	$blocks_admin = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/blocks";
	if(!is_dir($blocks_admin))
		mkdir($blocks_admin, 0705);
		chmod($blocks_admin, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/blocks/index.html");
		
	//Creation du dossier "class"
	$module_class = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/class";
	if(!is_dir($module_class))
		mkdir($module_class, 0705);
		chmod($module_class, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/class/index.html");
	$class_objectFile = XOOPS_ROOT_PATH."/modules/TDMCreate/class/object.php";
	copy($class_objectFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/class/object.php");
	
	//Creation du dossier "images"
	$module_images = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images";
	if(!is_dir($module_images))
		mkdir($module_images, 0705);
		chmod($module_images, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/index.html");
	//Copie le logo du module
	$modules_images1 = XOOPS_ROOT_PATH."/modules/TDMCreate/images/uploads/modules/".$modules_image;
	if (file_exists($modules_images1)) {
		copy($modules_images1, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/".$modules_image);
	}	
	//Creation du dossier "images/menu"
	$module_images_menu = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/menu";
	if(!is_dir($module_images_menu))
		mkdir($module_images_menu, 0705);
		chmod($module_images_menu, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/menu/index.html");
	$module_images_menu_bg = XOOPS_ROOT_PATH."/modules/TDMCreate/images/menu/bg.png";
	copy($module_images_menu_bg, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/menu/bg.png");
	$module_images_menu_left_both = XOOPS_ROOT_PATH."/modules/TDMCreate/images/menu/left_both.png";
	copy($module_images_menu_left_both, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/menu/left_both.png");
	$module_images_menu_right_both = XOOPS_ROOT_PATH."/modules/TDMCreate/images/menu/right_both.png";
	copy($module_images_menu_right_both, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/menu/right_both.png");
	
	//Creation du dossier "images/deco"
	$module_images_deco = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco";
	if(!is_dir($module_images_deco))
		mkdir($module_images_deco, 0705);
		chmod($module_images_deco, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/index.html");
	$module_images_deco_index = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/index.png";
	copy($module_images_deco_index, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/index.png");
	$module_images_deco_pref = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/pref.png";
	copy($module_images_deco_pref, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/pref.png");
	$module_images_deco_permissions = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/permissions.png";
	copy($module_images_deco_permissions, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/permissions.png");
	$module_images_deco_update = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/update.png";
	copy($module_images_deco_update, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/update.png");
	$module_images_deco_about = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/about.png";
	copy($module_images_deco_about, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/about.png");
	$module_images_deco_on = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/on.gif";
	copy($module_images_deco_on, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/on.gif");
	$module_images_deco_off = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/off.gif";
	copy($module_images_deco_off, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/off.gif");
	$module_images_deco_edit = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/edit.gif";
	copy($module_images_deco_edit, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/edit.gif");
	$module_images_deco_delete = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/delete.gif";
	copy($module_images_deco_delete, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/delete.gif");
	$module_images_deco_arrow = XOOPS_ROOT_PATH."/modules/TDMCreate/images/deco/arrow.gif";
	copy($module_images_deco_arrow, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/images/deco/arrow.gif");
	
	//Creation du dossier "include"
	$module_include = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/include";
	if(!is_dir($module_include))
		mkdir($module_include, 0705);
		chmod($module_include, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/include/index.html");
		
	//Creation du dossier "language"
	$module_language = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language";
	if(!is_dir($module_language))
		mkdir($module_language, 0705);
		chmod($module_language, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language/index.html");
	
	//Creation du dossier "language/french"
	$module_language_french = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language/french";
	if(!is_dir($module_language_french))
		mkdir($module_language_french, 0705);
		chmod($module_language_french, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/language/french/index.html");
	
	//Creation du dossier "templates"
	$module_templates = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates";
	if(!is_dir($module_templates))
		mkdir($module_templates, 0705);
		chmod($module_templates, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates/index.html");
	
	//Creation du dossier "templates/blocks"
	$module_templates_blocks = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates/blocks";
	if(!is_dir($module_templates_blocks))
		mkdir($module_templates_blocks, 0705);
		chmod($module_templates_blocks, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates/blocks/index.html");
		
	//Creation du dossier "sql"
	$module_sql = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/sql";
	if(!is_dir($module_sql))
		mkdir($module_sql, 0705);
		chmod($module_sql, 0705);
	copy($indexFile, XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/sql/index.html");
	/*****************************************************/
	echo '<tr>
			<td>'._AM_TDMCREATE_CONST_OK_ARCHITECTURE.'</td>
			<td><img src="./../images/deco/on.gif"></td>
		 </tr>';
}
?>