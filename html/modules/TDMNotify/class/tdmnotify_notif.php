<?php
/**
 * ****************************************************************************
 *  - TDMNotify By TDM   - TEAM DEV MODULE FOR XOOPS
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
  include_once XOOPS_ROOT_PATH.'/modules/TDMNotify/class/object.php';
}

class TDMNotify_notif extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("block",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("url",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("ip",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("indate",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("poster",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("inread",XOBJ_DTYPE_INT,null,false,1);
		$this->initVar("form",XOBJ_DTYPE_TXTBOX, null, false);
	}

	  function TDMNotify_notif()
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
	
	
	 function getMail($user = false, $var = 1)
    {
	
	include_once XOOPS_ROOT_PATH."/class/xoopsmailer.php";
		
 global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
 
 if ($var == 1) {
 $subject = $xoopsModuleConfig['send_user_text'];
 $send = $xoopsModuleConfig['send_user'];
 } else { 
 $subject = $xoopsModuleConfig['send_notify_text'];
 $send = $xoopsModuleConfig['send_notify'];
 }
 
 $err = "";
     $member_handler =& xoops_gethandler('member');
     $users =& $member_handler->getUser($user);
		
      	//prepare l'email ou le mp 
	 $xoopsMailer =& xoops_getMailer();
	 
 	if ($send == 2) {
	$xoopsMailer->usePM();
	}
	
	if ($send == 3) {
	$xoopsMailer->useMail();	
	}
	
	//on remplace les variables
	$body_head = str_replace("{X_UNAME}", $users->getVar('member_name'), $subject);
	$body_head = str_replace("{X_FNAME}", $users->getVar('member_firstname'), $body_head);
	$body_head = str_replace("{X_UEMAIL}", $users->getVar('member_mail'), $body_head);
	//
	

	$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
	$xoopsMailer->setFromName($xoopsConfig['sitename']);
    $xoopsMailer->setSubject(_AM_NOTIFY_SUBJECT);
    $xoopsMailer->setBody($body_head);
	$xoopsMailer->setFromUser($member_handler->getUser('1'));
	$xoopsMailer->setToUsers($users);
	$xoopsMailer->multimailer->isHTML(true);

	
	//email out
	if ($send > 1) {
	if( !$xoopsMailer->send(true) ){
		$err = $xoopsMailer->getErrors();
	}
	}
	
	return $err;
	
	//} else {
	
	//return false;
	//}
        
	}

}


class TDMNotifyTDMNotify_notifHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmnotify_notif", 'TDMNotify_notif', 'id', 'title');
    }

}


?>