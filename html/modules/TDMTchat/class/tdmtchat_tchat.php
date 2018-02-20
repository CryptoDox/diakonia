<?php
/**
 * ****************************************************************************
 *  - TDMTchat By TDM   - TEAM DEV MODULE FOR XOOPS
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

if (!class_exists('XoopsPersistableObjectHandler')) {
  include_once XOOPS_ROOT_PATH.'/modules/TDMTchat/class/object.php';
}

class tdmtchat_tchat extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("tchat_id",XOBJ_DTYPE_INT,null,false,8);
		$this->initVar("tchat_pid",XOBJ_DTYPE_INT,null,false,8);
		$this->initVar("tchat_from",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("tchat_to",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("tchat_message",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("tchat_sent",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("tchat_recd",XOBJ_DTYPE_INT,null,false,1);
	}

	  function tdmtchat_tchat()
    {
        $this->__construct();
    }


    function getForm($action = false)
    {
 global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_NOTIFY_ADD) : sprintf(_AM_NOTIFY_EDITER);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_AM_NOTIFY_TITLE, 'title', 100, 255, $this->getVar('title')), true);
        if (!$this->isNew()) {
            //Load groups
            $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
	   }
	
	
		
		$form->addElement(new XoopsFormText(_AM_NOTIFY_WEIGHT, 'weight', 10, 10, $this->getVar('weight')));			
        $form->addElement(new XoopsFormRadioYN(_AM_NOTIFY_VISIBLE, 'visible', $this->getVar('visible'), _YES, _NO));
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}

}


class TDMTchattdmtchat_tchatHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmtchat_tchat", 'tdmtchat_tchat', 'tchat_id', 'tchat_message');
    }

}


?>