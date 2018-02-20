<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class TDMSpot_item extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("cat",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("title",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("text",XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar("display",XOBJ_DTYPE_INT,null,false,1);
		$this->initVar("file",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("indate",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("hits",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("votes",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("counts",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("comments",XOBJ_DTYPE_INT,null,false,11);
		$this->initVar("poster",XOBJ_DTYPE_INT,null,false,10);
	}

	  function TDMSpot_item()
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
        $form->addElement(new XoopsFormText(_AM_SPOT_TITLE, 'title', 80, 255, $this->getVar('title')), true);
        if (!$this->isNew()) {
            //Load groups
            $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
            $form->addElement(new XoopsFormHidden('file', $this->getVar("file")));
	   }


//genre
	
		$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');
		$arr = $cat_handler->getall();
		$mytree = new XoopsObjectTree($arr, 'id', 'pid');
		$form->addElement(new XoopsFormLabel(_AM_SPOT_CATEGORY, $mytree->makeSelBox('cat', 'title','-', $this->getVar('cat') ,true)), true);
	
//editor
	    $editor_configs=array();
    	$editor_configs["name"] ="text'";
    	$editor_configs["value"] = $this->getVar('text', 'e');
    	$editor_configs["rows"] = 20;
    	$editor_configs["cols"] = 80;
    	$editor_configs["width"] = "100%";
    	$editor_configs["height"] = "400px";
    	$editor_configs["editor"] = $xoopsModuleConfig["tdmspot_editor"];				
		$form_editor = new XoopsFormEditor(_AM_SPOT_TEXT, "text", $editor_configs);		
		$form_editor->setDescription(_AM_SPOT_TEXT_DESC);
		$form->addElement($form_editor , false);
	
	
	
//upload

		//on test l'existance de l'image
		$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/".$this->getVar("file");
		if ($this->getVar("file")) {
		$filetray = new XoopsFormElementTray(_AM_SPOT_FILE,'<br />');
		$file = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/".$this->getVar("file");
		$filetray -> addElement( new XoopsFormLabel( '', "<a href='".$file."' />".$file."</a>" ) );
		$form->addElement($filetray);
		$form->addElement(new XoopsFormHidden('file', $this->getVar("file")));
		}
		
		$imgtray = new XoopsFormElementTray(_AM_SPOT_UPLOAD);
		$imgtray->addElement(new XoopsFormFile('' , 'attachedfile', $xoopsModuleConfig['tdmspot_mimemax']), false);
		$form->addElement($imgtray);
		
		$form_date = new XoopsFormDateTime(_AM_SPOT_INDATE, 'indate', 10,  $this->getVar('indate'));
		$form_date->setDescription(_AM_SPOT_INDATE_DESC.'<br />'.sprintf(_AM_SPOT_INDATE_TIME, formatTimeStamp(time(),"m")));
		$form->addElement($form_date , true);
				
       // $form->addElement(new XoopsFormRadioYN(_AM_TDMSOUND_DISPLAYUSER, 'alb_display', $this->getVar('alb_display'), _YES, _NO));
		
	if ( is_object($xoopsUser) && $xoopsUser->isAdmin()) {
    $form->addElement(new XoopsFormRadioYN(_AM_SPOT_VISIBLE, 'display', $this->getVar('display'), _YES, _NO));
	}else {
	
	$gperm_handler =& xoops_gethandler('groupperm');
	if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	}

	if ($gperm_handler->checkRight('tdmspot_view', 8, $groups, $xoopsModule->getVar('mid'))) {
	$form->addElement(new XoopsFormHidden('display', 1));
	}else {
	$form->addElement(new XoopsFormHidden('display', 0));
	}
	}	
		
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}

}


class TDMSpottdmspot_itemHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmspot_item", 'TDMSpot_item', 'id', 'title');
    }

}


?>