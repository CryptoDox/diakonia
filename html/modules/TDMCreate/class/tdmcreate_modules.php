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

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

if (!class_exists('XoopsPersistableObjectHandler')) {
  include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/class/object.php';
}

class tdmcreate_modules extends XoopsObject
{ 

	// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("modules_id",XOBJ_DTYPE_INT,null,false,5);
		$this->initVar("modules_name",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("modules_version",XOBJ_DTYPE_INT,null,false,5);
		$this->initVar("modules_description",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_author",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_author_website_url",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("modules_author_website_name",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_credits",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_license",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_release_info",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_release_file",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_manual",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_manual_file",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_image",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_demo_site_url",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_demo_site_name",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_module_website_url",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_module_website_name",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_release",XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar("modules_module_status",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("modules_display_menu",XOBJ_DTYPE_INT, null, false, 1);
		$this->initVar("modules_display_admin",XOBJ_DTYPE_INT, null, false, 1);
		$this->initVar("modules_active_search",XOBJ_DTYPE_INT, null, false, 1);
	}

	function tdmcreate_modules()
    {
        $this->__construct();
    }


    function getForm($action = false)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
		
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_MODULES_ADD) : sprintf(_AM_TDMCREATE_MODULES_EDIT);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form_modules', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		
		$form->insertBreak('<div align="center"><b>'._AM_TDMCREATE_MODULES_IMPORTANT.'</b></div>','head');
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_NAME, 'modules_name', 50, 255, $this->getVar('modules_name')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_VERSION, 'modules_version', 50, 255, $this->getVar('modules_version')), true);
		$form->addElement(new XoopsFormTextArea(_AM_TDMCREATE_MODULES_DESCRIPTION, 'modules_description', $this->getVar('modules_description'), 3, 47), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR, 'modules_author', 50, 255, $this->getVar('modules_author')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_LICENSE, 'modules_license', 50, 255, $this->getVar('modules_license')), true);
		$modules_display_menu =  $this->isNew() ? '1' : $this->getVar('modules_display_menu');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_DISPLAY_MENU, 'modules_display_menu', $modules_display_menu, _YES, _NO));
		$modules_display_admin =  $this->isNew() ? '1' : $this->getVar('modules_display_admin');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_DISPLAY_ADMIN, 'modules_display_admin', $modules_display_admin, _YES, _NO));
		$modules_active_search =  $this->isNew() ? '1' : $this->getVar('modules_active_search');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_MODULES_ACTIVE_SEARCH, 'modules_active_search', $modules_active_search, _YES, _NO));
		
		$modules_image = $this->getVar('modules_image') ? $this->getVar('modules_image') : 'blank.gif';
		
		$uploadirectory = "/modules/".$xoopsModule->dirname()."/images/uploads/modules";
		$imgtray = new XoopsFormElementTray(_AM_TDMCREATE_MODULES_IMAGE,'<br />');
		$imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, "./modules/".$xoopsModule->dirname()."/images/uploads/modules");
		$imageselect= new XoopsFormSelect($imgpath, 'modules_image', $modules_image);
		$modules_image_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory );
		foreach( $modules_image_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"modules_image\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray->addElement($imageselect,false);
		$imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $modules_image . "' name='image3' id='image3' alt='' />" ) );
	
		$fileseltray= new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(_AM_TDMCREATE_FORMUPLOAD , 'attachedfile', 104857600),false);
		$fileseltray->addElement(new XoopsFormLabel(''), false);
		$imgtray->addElement($fileseltray);
		$form->addElement($imgtray);

		$form->insertBreak('<div align="center"><b>'._AM_TDMCREATE_MODULES_NOTIMPORTANT.'</b></div>','head');
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_URL, 'modules_author_website_url', 50, 255, $this->getVar('modules_author_website_url')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_NAME, 'modules_author_website_name', 50, 255, $this->getVar('modules_author_website_name')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_CREDITS, 'modules_credits', 50, 255, $this->getVar('modules_credits')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_RELEASE_INFO, 'modules_release_info', 50, 255, $this->getVar('modules_release_info')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_RELEASE_FILE, 'modules_release_file', 50, 255, $this->getVar('modules_release_file')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MANUAL, 'modules_manual', 50, 255, $this->getVar('modules_manual')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MANUAL_FILE, 'modules_manual_file', 50, 255, $this->getVar('modules_manual_file')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_DEMO_SITE_URL, 'modules_demo_site_url', 50, 255, $this->getVar('modules_demo_site_url')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_DEMO_SITE_NAME, 'modules_demo_site_name', 50, 255, $this->getVar('modules_demo_site_name')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MODULE_WEBSITE_URL, 'modules_module_website_url', 50, 255, $this->getVar('modules_module_website_url')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_MODULE_WEBSITE_NAME, 'modules_module_website_name', 50, 255, $this->getVar('modules_module_website_name')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_RELEASE, 'modules_release', 50, 255, $this->getVar('modules_release')), false);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_MODULES_STATUS, 'modules_module_status', 50, 255, $this->getVar('modules_module_status')), false);	
    
		$form->addElement(new XoopsFormHidden('op', 'modules_save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
		$form->display();
        return $form;
	}
}

class TDMCreatetdmcreate_modulesHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmcreate_modules", 'tdmcreate_modules', 'modules_id', 'modules_name');
    }

}

?>