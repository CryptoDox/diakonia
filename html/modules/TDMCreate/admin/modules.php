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
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/class/tdmcreate_modules.php';

xoops_cp_header();
//appele du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMCreate_adminmenu(1, _AM_TDMCREATE_MANAGER_MODULES);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (1,_AM_TDMCREATE_MANAGER_MODULES);
}

if (isset($_REQUEST['op'])) {
	$op = $_REQUEST['op'];
} else {
	@$op = 'default';
}

//load class
$modulesHandler =& xoops_getModuleHandler('tdmcreate_modules', 'TDMCreate');

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/deco/modules.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;  height: 48px;"><strong>'._AM_TDMCREATE_MANAGER_MODULES.'</strong>';
echo '</div><br />';

switch ($op) {
	case "modules_save":
		if (!$GLOBALS['xoopsSecurity']->check()) {
           redirect_header('modules.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($_REQUEST['modules_id'])) {
           $obj =& $modulesHandler->get($_REQUEST['modules_id']);
        } else {
           $obj =& $modulesHandler->create();
        }
		
		//Image
		include_once XOOPS_ROOT_PATH.'/class/uploader.php';
	    $uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/modules/";
        $uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile"]['name']) ;
			$name_img = $_REQUEST['modules_name'].'Logo.'.$extension;
			$uploader->setTargetFileName($name_img); 
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar('modules_image', $uploader->getSavedFileName());
			}
		} else {
			$obj->setVar('modules_image', $_REQUEST['modules_image']);
        }
		
		$obj->setVar('modules_name', $_REQUEST['modules_name']);
        $obj->setVar('modules_version', $_REQUEST['modules_version']);
        $obj->setVar('modules_description', $_REQUEST['modules_description']);
        $obj->setVar('modules_author', $_REQUEST['modules_author']);
		$obj->setVar('modules_author_website_url', $_REQUEST['modules_author_website_url']);
        $obj->setVar('modules_author_website_name', $_REQUEST['modules_author_website_name']);
        $obj->setVar('modules_credits', $_REQUEST['modules_credits']);
        $obj->setVar('modules_license', $_REQUEST['modules_license']);
		$obj->setVar('modules_release_info', $_REQUEST['modules_release_info']);
        $obj->setVar('modules_release_file', $_REQUEST['modules_release_file']);
        $obj->setVar('modules_manual', $_REQUEST['modules_manual']);
        $obj->setVar('modules_manual_file', $_REQUEST['modules_manual_file']);
        $obj->setVar('modules_demo_site_url', $_REQUEST['modules_demo_site_url']);
        $obj->setVar('modules_demo_site_name', $_REQUEST['modules_demo_site_name']);
        $obj->setVar('modules_module_website_url', $_REQUEST['modules_module_website_url']);
		$obj->setVar('modules_module_website_name', $_REQUEST['modules_module_website_name']);
        $obj->setVar('modules_release', $_REQUEST['modules_release']);
        $obj->setVar('modules_module_status', $_REQUEST['modules_module_status']);
		
		 $obj->setVar('modules_display_menu', $_REQUEST['modules_display_menu']);
		 $obj->setVar('modules_display_admin', $_REQUEST['modules_display_admin']);
		 $obj->setVar('modules_active_search', $_REQUEST['modules_active_search']);
		 
        if ($modulesHandler->insert($obj)) {
           redirect_header('modules.php?op=default', 2, _AM_TDMCREATE_FORMOK);
        }	
	break;
	
	/*case "modules_edit":
		
	break;*/
	
	case "default":
	default:
		$obj =& $modulesHandler->create();
		$form = $obj->getForm();
	break;
}
xoops_cp_footer();
?>