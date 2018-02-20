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

class TDMNotify_block extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,8);
		$this->initVar("pid",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("title",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("text",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("img",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("style",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("alt",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("indate",XOBJ_DTYPE_INT,null,false,10);
	}

	  function TDMNotify_block()
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

        $block = new XoopsThemeForm($title, 'block', $action, 'post', true);
		$block->setExtra('enctype="multipart/form-data"');
        $block->addElement(new XoopsFormText(_AM_NOTIFY_TITLE, 'title', 100, 255, $this->getVar('title')), true);
	 
	//alt
	$block->addElement(new XoopsFormText(_AM_NOTIFY_ALT, 'alt', 100, 255, $this->getVar('alt')), false);
	   //style
$tagchannel = array('text' => _AM_NOTIFY_STYLE_TEXT, 'img' => _AM_NOTIFY_STYLE_IMG, 'button' => _AM_NOTIFY_STYLE_BUTTON );
$tagchannel_select = new XoopsFormSelect(_AM_NOTIFY_STYLE, 'style', $this->getVar('style'));
$tagchannel_select->addOptionArray($tagchannel);
$block->addElement($tagchannel_select);


//editor
	    $editor_configs=array();
    	$editor_configs["name"] ="text";
    	$editor_configs["value"] = $this->getVar('text', 'e');
    	$editor_configs["rows"] = 20;
    	$editor_configs["cols"] = 80;
    	$editor_configs["width"] = "100%";
    	$editor_configs["height"] = "400px";
    	$editor_configs["editor"] = $xoopsModuleConfig["TDMNotify_editor"];				
		$block->addElement( new XoopsFormEditor(_AM_NOTIFY_TEXT, "text", $editor_configs), false );		
	
//upload
		$img = $this->getVar('img') ? $this->getVar('img') : 'blank.png';
		$uploadirectory = "modules/".$xoopsModule->dirname()."/upload";
		$imgtray = new XoopsFormElementTray(_AM_NOTIFY_IMG,'<br />');
		$imgpath=sprintf(_AM_NOTIFY_PATH, $uploadirectory );
		$imageselect= new XoopsFormSelect($imgpath, 'img',$img);
		$topics_array = XoopsLists :: getImgListAsArray(XOOPS_ROOT_PATH."/".$uploadirectory);
		foreach( $topics_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"img\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray->addElement($imageselect,false);
		$imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $img . "' name='image3' id='image3' alt='' />" ) );
	
		$fileseltray= new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(_AM_NOTIFY_UPLOAD , 'attachedfile', $xoopsModuleConfig['mimemax']),false);
		$fileseltray->addElement(new XoopsFormLabel(''), false);
		$imgtray->addElement($fileseltray);
		$block->addElement($imgtray);


//load form
$form_handler =& xoops_getModuleHandler('TDMNotify_form', 'TDMNotify');
$numform = $form_handler->getCount();
if ($numform != 0) {
$val = explode("|", $this->getVar('pid'));
$form_select = new XoopsFormSelect(_AM_NOTIFY_FORM, 'pid',  $val, 5 , true);
$form_select->addOptionArray($form_handler->getList());
$block->addElement($form_select, true);
} else {
$block->insertBreak('<div align="center">'._AM_NOTIFY_OPTIONDESC.'</div>', 'odd');
}

//
	// Permissions
    $member_handler = & xoops_gethandler('member');
    $group_list = &$member_handler->getGroupList();
    $gperm_handler = &xoops_gethandler('groupperm');
    $full_list = array_keys($group_list);
	
    if(!$this->isNew()) {		// Edit mode
    $groups_ids = $gperm_handler->getGroupIds('notify_view', $this->getVar('id'), $xoopsModule->getVar('mid'));
    $groups_ids = array_values($groups_ids);
    $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_NOTIFY_MANAGE_PERM2, 'groups_view[]', $groups_ids);
    } else {	// Creation mode
    $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_NOTIFY_MANAGE_PERM2, 'groups_view[]', $full_list);
    }
    $groups_news_can_view_checkbox->addOptionArray($group_list);
    $block->addElement($groups_news_can_view_checkbox);
//	
	
		$block->addElement(new XoopsFormHidden('op', 'save'));
        $block->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $block;
	}

	
	    function getElement($page, $var, $action = false)
    {

 global $xoopsDB, $xoopsModule, $xoopsModuleConfig, $xoopsConfig, $xoopsOption, $xoopsUser;
$form_ele = new XoopsSimpleForm('', 'form_block'.$this->getVar('id').'_'.$page, $_SERVER['REQUEST_URI'], 'post', true);


$val = explode("|", $this->getVar('pid'));	
if (count($val != 0)) {

for($i=0; $i < count($val); $i++){
$form_handler =& xoops_getModuleHandler('TDMNotify_form', 'TDMNotify');
$form = $form_handler->get($val[$i]);

$form_option = explode("|", $form->getVar('option'));	

if( !is_object($xoopsUser) ){
	$form_label = str_replace('{UNAME}', '', $form->getVar('label'));
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

switch($form->getVar('champ')) {

	case "text": 
   $form_ele->addElement(new XoopsFormText($form->getVar('title'), $form->getVar('title'), $form->getVar('size'), $form->getVar('limit'), $form_label10), true);
	break;
	
	case "textarea": 
   $form_ele->addElement(new XoopsFormTextarea($form->getVar('title'), $form->getVar('title'), $form_label, '', $form->getVar('size') ), false);
   break;

	case "checkbox": 
  	$form_ele->addElement(new XoopsFormCheckBox($form->getVar('title'), $form->getVar('title'), $form_label), false);
	break;
	
	case "yesno": 
	$form_ele->addElement(new XoopsFormRadioYN($form->getVar('title'), $form->getVar('title'), $form_label), false);
    break;
	
	case "select": 
    $cid = new XoopsFormSelect($form->getVar('title'), $form->getVar('title'), $form_option);
	$cid->addOptionArray($form_option);
	$form_ele->addElement($cid, false);
    break;	
}

}

if (isset($var)) {
$groupe_var = new XoopsFormText($var, $var, 50, 255, $var );
$groupe_var->setExtra("disabled=\"disabled\"");
$form_ele->addElement($groupe_var, false);
}
//$form_ele->addElement(new XoopsFormHidden('op', 'save'));
$form_ele->addElement(new XoopsFormHidden('block', $this->getVar('id')));
}
//
//	
        return $form_ele;
	}
}


class TDMNotifytdmnotify_blockHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmnotify_block", 'TDMNotify_block', 'id', 'title');
    }

}


?>