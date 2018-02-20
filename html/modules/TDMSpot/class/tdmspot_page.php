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

if (!class_exists('XoopsPersistableObjectHandler')) {
  include_once XOOPS_ROOT_PATH.'/modules/TDMSpot/class/object.php';
}

class TDMSpot_page extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,8);
		$this->initVar("title",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("weight",XOBJ_DTYPE_INT,null,false,5);
		$this->initVar("visible",XOBJ_DTYPE_INT,null,false,1);
		$this->initVar("cat",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("limit",XOBJ_DTYPE_INT,null,false,5);
	}

	  function TDMSpot_page()
    {
        $this->__construct();
    }


    function getForm($action = false)
    {
 global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_SPOT_ADD) : sprintf(_AM_SPOT_EDITER);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_AM_SPOT_TITLE, 'title', 100, 255, $this->getVar('title')), true);
        if (!$this->isNew()) {
            //Load groups
            $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
	   }
	
	//genre
	$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');
	$var_cat = explode(",", $this->getVar('cat'));
	$cat_select = new XoopsFormSelect(_AM_SPOT_CATEGORY, 'cat', $var_cat, 5, true);
	$cat_select->addOptionArray($cat_handler->getList());
	$cat_select->addOption(0, 'ALL');
	$form->addElement($cat_select);
	
	$form->addElement(new XoopsFormText(_AM_SPOT_LIMIT, 'limit', 5, 5, $this->getVar('limit')), false);
	// Permissions
    $member_handler = & xoops_gethandler('member');
    $group_list = &$member_handler->getGroupList();
    $gperm_handler = &xoops_gethandler('groupperm');
    $full_list = array_keys($group_list);
	
    if(!$this->isNew()) {		// Edit mode
    $groups_ids = $gperm_handler->getGroupIds('spot_pageview', $this->getVar('id'), $xoopsModule->getVar('mid'));
    	$groups_ids = array_values($groups_ids);
    	$groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_SPOT_PERM_2, 'groups_view[]', $groups_ids);
    } else {	// Creation mode
    $groups_news_can_view_checkbox = new XoopsFormCheckBox(_AM_SPOT_PERM_2, 'groups_view[]', $full_list);
    }
    $groups_news_can_view_checkbox->addOptionArray($group_list);
    $form->addElement($groups_news_can_view_checkbox);
	
	
		
		$form->addElement(new XoopsFormText(_AM_SPOT_WEIGHT, 'weight', 10, 10, $this->getVar('weight')));			
        $form->addElement(new XoopsFormRadioYN(_AM_SPOT_VISIBLE, 'visible', $this->getVar('visible'), _YES, _NO));
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}
	
	 function getPlug($action = false)
    {
 global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_SPOT_ADD) : sprintf(_AM_SPOT_EDITER);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        if (!$this->isNew()) {
            //Load groups
            $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
	   }
	
	//load page
	$page_handler =& xoops_getModuleHandler('tdmspot_page', 'TDMSpot');
    $page_select = new XoopsFormSelect(_AM_SPOT_PLUGDEF, 'default', '');
    $page_select->addOptionArray($page_handler->getList());
	$page_select->addOption(0, _AM_SPOT_PLUGNONE);
    $form->addElement($page_select);
//	
	//load page
    $page2_select = new XoopsFormSelect(_AM_SPOT_PLUGPAGE, 'page', '', '5', true);
    $page2_select->addOptionArray($page_handler->getList());
	$page2_select->addOption(0, _AM_SPOT_PLUGALL);
    $form->addElement($page2_select, true);
//

//display	
	$channel = array(1 => _AM_SPOT_PLUGTABS, 2 => _AM_SPOT_PLUGSELECT, 3 => _AM_SPOT_PLUGTEXT, 4 => 'Accordion', 5 => 'wslide', 0 => _AM_SPOT_PLUGNONE );
	$channel_select = new XoopsFormSelect(_AM_SPOT_PLUGDISPLAY, 'display', 0);
	//$channel_select->setDescription(_AM_SPOT_PLUGSTYLE_DESC);
	$channel_select->addOptionArray($channel);
	$form->addElement($channel_select);

// style display	
    $tagchannel = array('cupertino' => 'cupertino', 'lightness' => 'lightness', 'darkness' => 'darkness', 'smoothness' => 'smoothness', 'start' => 'start', 'redmond' => 'redmond', 'sunny' => 'sunny', 'pepper' => 'pepper', 'eggplant' => 'eggplant' ,
	'dark-hive' => 'dark-hive', 'excite' => 'excite', 'vader' => 'vader', 'trontastic' => 'trontastic' );
	 
	//$tagchannel = array('black-menu' => 'black', 'blue-menu' => 'blue', 'bluesprite-menu' => 'bluesprite', 'chrome-menu' => 'chrome', 'green-menu' => 'green', 'indentmenu-menu' => 'indentmenu', 'jquery-menu' => 'jquery', 'marron-menu' => 'marron', 'modernbricksmenu-menu' => 'modernbricksmenu' ,
	//'mytabsdefault-menu' => 'mytabsdefault', 'shadetabs-menu' => 'shadetabs', 'slate-menu' => 'slate', 'stylefour-menu' => 'stylefour', 'time4bed-menu' => 'time4bed' );
	$tagchannel_select = new XoopsFormSelect(_AM_SPOT_PLUGSTYLE, 'tdmspot_style', 'cupertino');
	//$tagchannel_select->setDescription(_AM_SPOT_PLUGSTYLE_DESC);
	$tagchannel_select->addOptionArray($tagchannel);
	//$tagchannel_select->setExtra("onchange='xoopsGetElementById(\"NewsColorSelect\").className = \"\" + this.options[this.selectedIndex].value;'");
	$form->addElement($tagchannel_select);
	
	//$form->addElement( new XoopsFormLabel('', "<div id='NewsColorSelect' class=''><div id='tabs'><ul><li style='list-style-type: none;'><a href='javascript:;' title='test1'>Test1</a></li><li><a href='javascript:;' title='test2'>Test2</a></li><li><a href='javascript:;' title='test3'>Test3</a></li></ul></div></div>" ));
		
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}

}


class TDMSpottdmspot_pageHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmspot_page", 'TDMSpot_page', 'id', 'title');
    }

}


?>