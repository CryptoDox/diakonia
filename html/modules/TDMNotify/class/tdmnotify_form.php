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

class TDMNotify_form extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,8);
		$this->initVar("champ",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("size",XOBJ_DTYPE_INT,null,false,5);
		$this->initVar("limit",XOBJ_DTYPE_INT,null,false,5);
		$this->initVar("title",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("option",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("label",XOBJ_DTYPE_TXTBOX, null, false);
	}

	  function TDMNotify_form()
    {
        $this->__construct();
    }


    function getForm($action = false)
    {
	
include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php';

 global $xoopsDB, $xoopsModule, $xoopsModuleConfig, $xoopsConfig, $xoopsOption;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_NOTIFY_ADD) : sprintf(_AM_NOTIFY_EDITER);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_AM_NOTIFY_TITLE, 'title', 100, 255, $this->getVar('title')), true);
  
//

//champ
$tagchannel = array('text' => 'text', 'textarea' => 'textarea', 'checkbox' => 'checkbox', 'yesno' => _YES._NO, 'select' => 'Select' );
$tagchannel_select = new XoopsFormSelect(_AM_NOTIFY_TYPE, 'champ', $this->getVar('champ'));
$tagchannel_select->addOptionArray($tagchannel);
$form->addElement($tagchannel_select);

//size
$form->addElement(new XoopsFormText(_AM_NOTIFY_SIZE, 'size', 5, 5, $this->getVar('size')), true);
//limit
$form->addElement(new XoopsFormText(_AM_NOTIFY_LIMIT, 'limit', 5, 5, $this->getVar('limit')), true);
//option
$form->addElement(new XoopsFormTextarea(_AM_NOTIFY_OPTION, 'option', $this->getVar('option')), false);
//label
$label = new XoopsFormTextarea(_AM_NOTIFY_LABEL, 'label', $this->getVar('label'));
$label->setDescription(_AM_NOTIFY_LABEL_DESC);
$form->addElement($label);


		
		$form->addElement(new XoopsFormHidden('op', 'save_form'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}
	
	
	 function getSimpleElement($action = false)
    {

 global $xoopsDB, $xoopsModule, $xoopsModuleConfig, $xoopsConfig, $xoopsOption, $xoopsUser;
$form_ele = new XoopsSimpleForm('', 'form_block', $_SERVER['REQUEST_URI'], 'post', true);


$form_option = explode("|", $this->getVar('option'));	

if( !is_object($xoopsUser) ){
	$form_label = str_replace('{UNAME}', '', $this->getVar('label'));
	$form_label2 = str_replace('{EMAIL}', '', $form_label);
	$form_label3 = str_replace('{NAME}', '', $form_label2);
	$form_label4 = str_replace('{FROM}', '', $form_label3);
	$form_label5 = str_replace('{INFO}', '', $form_label4);
	$form_label6 = str_replace('{ICQ}', '', $form_label5);
	$form_label7 = str_replace('{AIM}', '', $form_label6);
	$form_label8 = str_replace('{YIM}', '', $form_label7);
	$form_label9 = str_replace('{MSNM}', '', $form_label8);
	$form_label10 = str_replace('{OCCUP}', '', $form_label9);
	} else {
	$form_label = str_replace('{UNAME}', $xoopsUser->getVar('uname'), $form->getVar('label'));
	$form_label2 = str_replace('{EMAIL}', $xoopsUser->getVar('email'), $form_label);
	$form_label3 = str_replace('{NAME}', $xoopsUser->getVar('name'), $form_label2);
	$form_label4 = str_replace('{FROM}', $xoopsUser->getVar('from'), $form_label3);
	$form_label5 = str_replace('{INFO}', $xoopsUser->getVar('info'), $form_label4);
	$form_label6 = str_replace('{ICQ}', $xoopsUser->getVar('icq'), $form_label5);
	$form_label7 = str_replace('{AIM}', $xoopsUser->getVar('aim'), $form_label6);
	$form_label8 = str_replace('{YIM}', $xoopsUser->getVar('yim'), $form_label7);
	$form_label9 = str_replace('{MSNM}', $xoopsUser->getVar('msnm'), $form_label8);
	$form_label10 = str_replace('{OCCUP}', $xoopsUser->getVar('occup'), $form_label9);
	}

switch($this->getVar('champ')) {

	case "text": 
   $form_ele->addElement(new XoopsFormText($this->getVar('title'), $this->getVar('title'), $this->getVar('size'), $this->getVar('limit'), $form_label10), true);
	break;
	
	case "textarea": 
   $form_ele->addElement(new XoopsFormTextarea($this->getVar('title'), $this->getVar('title'), $form_label, '', $this->getVar('size') ), false);
   break;

	case "checkbox": 
  	$form_ele->addElement(new XoopsFormCheckBox($this->getVar('title'), $this->getVar('title'), $form_label), false);
	break;
	
	case "yesno": 
	$form_ele->addElement(new XoopsFormRadioYN($this->getVar('title'), $this->getVar('title'), $form_label), false);
    break;
	
	case "select": 
    $cid = new XoopsFormSelect($this->getVar('title'), $this->getVar('title'), $form_option);
	$cid->addOptionArray($form_option);
	$form_ele->addElement($cid, false);
    break;	
//$form_ele->addElement(new XoopsFormHidden('op', 'save'));
//$form_ele->addElement(new XoopsFormHidden('block', $this->getVar('id')));
}
//
//	
        return $form_ele;
	}

}


class TDMNotifyTDMNotify_formHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmnotify_form", 'TDMNotify_form', 'id', 'title');
    }

}


?>