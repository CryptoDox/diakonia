<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.tdmxoops.net)
 *
 * Cette licence, contient des limitations!!!
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier,
 * 3. Vous ne devez pas le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer et de rendre publiques les modifications
 *
 * @license     TDMFR PRO license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class TDMSpot_cat extends XoopsObject
{ 


// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,11);
		$this->initVar("pid",XOBJ_DTYPE_INT,null,false,11);
		$this->initVar("title",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("date",XOBJ_DTYPE_INT,null,false,11);
		$this->initVar("text",XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("img",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("weight",XOBJ_DTYPE_INT,null,false,11);
		$this->initVar("display",XOBJ_DTYPE_INT,null,false,1);
	}

	  function TDMSpot_cat()
    {
        $this->__construct();
    }


    function getForm($action = false)
    {
	
 global $xoopsUser, $xoopsDB, $xoopsModule, $xoopsModuleConfig;
 
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_SPOT_ADD) : sprintf(_AM_SPOT_EDITER);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        
		$form->addElement(new XoopsFormText(_AM_SPOT_TITLE, 'title', 80, 255, $this->getVar('title')));

		if (!$this->isNew()) {
            //Load groups
            $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
		}

//categorie
		$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');
		$arr = $cat_handler->getall();
		$mytree = new XoopsObjectTree($arr, 'id', 'pid');
		$form->addElement(new XoopsFormLabel(_AM_SPOT_PARENT, $mytree->makeSelBox('pid', 'title','-', $this->getVar('pid'), true)));

//editor
	 //   $editor_configs=array();
    //	$editor_configs["name"] ="text'";
    //	$editor_configs["value"] = $this->getVar('text', 'e');
    //	$editor_configs["rows"] = 20;
    //	$editor_configs["cols"] = 80;
    //	$editor_configs["width"] = "100%";
    //	$editor_configs["height"] = "400px";
    //	$editor_configs["editor"] = $xoopsModuleConfig["tdmspot_editor"];				
	//	$form->addElement( new XoopsFormEditor(_AM_SPOT_TEXT, "cat_text", $editor_configs), false );		

		//upload
		$img = $this->getVar('img') ? $this->getVar('img') : 'blank.gif';
		$uploadirectory = "modules/".$xoopsModule->dirname()."/upload/cat/";
		$imgtray = new XoopsFormElementTray(_AM_SPOT_IMG,'<br />');
		$imgpath=sprintf(_AM_SPOT_PATH, $uploadirectory );
		$imageselect= new XoopsFormSelect($imgpath, 'img',$img);
		$topics_array = XoopsLists :: getImgListAsArray(XOOPS_ROOT_PATH."/".$uploadirectory);
		foreach( $topics_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"img\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray->addElement($imageselect,false);
		$imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $img . "' name='image3' id='image3' alt='' />" ) );
	
		$fileseltray= new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(_AM_SPOT_UPLOAD , 'attachedfile', $xoopsModuleConfig['tdmspot_mimemax']),false);
		$fileseltray->addElement(new XoopsFormLabel(''), false);
		$imgtray->addElement($fileseltray);
		$form->addElement($imgtray);
		//
		
	//poit
	$form->addElement(new XoopsFormText(_AM_SPOT_WEIGHT, 'weight', 10, 11, $this->getVar('weight')));
		
	// Permissions
    $member_handler = & xoops_gethandler('member');
    $group_list = &$member_handler->getGroupList();
    $gperm_handler = &xoops_gethandler('groupperm');
    $full_list = array_keys($group_list);
	
    if(!$this->isNew()) {		// Edit mode
    $groups_ids = $gperm_handler->getGroupIds('tdmspot_catview', $this->getVar('id'), $xoopsModule->getVar('mid'));
    $groups_ids = array_values($groups_ids);
    $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_SPOT_PERM_2, 'groups_view[]', $groups_ids);
    } else {	// Creation mode
    $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_SPOT_PERM_2, 'groups_view[]', $full_list);
    }
    $groups_news_can_view_checkbox->addOptionArray($group_list);
    $form->addElement($groups_news_can_view_checkbox);
//	
    $form->addElement(new XoopsFormRadioYN(_AM_SPOT_VISIBLE, 'display', $this->getVar('display'), _YES, _NO));
		
		$form->addElement(new XoopsFormHidden('op', 'save_cat'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}

}


class TDMSpottdmspot_catHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmspot_cat", 'TDMSpot_cat', 'id', 'title');
    }
	
	 function delete($obj, $val = 1)
    {

            return parent::delete($obj);
        
    }

}


?>