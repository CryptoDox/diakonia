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

class TDMSpot_newblocks extends XoopsObject
{ 

// constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("id",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("bid",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("pid",XOBJ_DTYPE_INT,null,false,10);
		$this->initVar("options",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("title",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("side",XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar("weight",XOBJ_DTYPE_INT,null,false,1);
		$this->initVar("visible",XOBJ_DTYPE_INT,null,false,10);
	}

	  function TDMSpot_newblocks()
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
        $title = $this->isNew() ? sprintf(_AM_SPOT_ADD) : sprintf(_AM_SPOT_EDITER);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new XoopsFormText(_AM_SPOT_TITLE, 'title', 100, 255, $this->getVar('title')), true);
        if (!$this->isNew()) {
            //Load groups
            $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
	//load option
	include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php';
	$block_arr = new XoopsBlock($this->getVar('bid'));
	include_once XOOPS_ROOT_PATH.'/modules/'.$block_arr->getVar('dirname').'/blocks/'.$block_arr->getVar('func_file');
	include_once XOOPS_ROOT_PATH."/modules/".$block_arr->getVar('dirname')."/language/".$xoopsConfig['language']."/blocks.php";
	
	if ($edit_func = $block_arr->getVar('edit_func')) {
	
	$opt = $this->getVar("options") ? $this->getVar("options") : $block_arr->getVar('options');
	
	$options = explode("|", $opt);

	//$form->insertBreak($edit_func($options), 'odd');
	$form->addElement(new XoopsFormLabel(_AM_SPOT_OPTION, $edit_func($options)));
	} else {
	$form->insertBreak(_AM_SPOT_NOOPTION, 'odd');
		}
	   
	   
	   }

//load block
	$block_arr = new XoopsBlock();
	$form_arr = $block_arr->getAllBlocks();
	
	$cat_select = new XoopsFormSelect(_AM_SPOT_BLOCK, 'bid', $this->getVar('bid'));
	foreach (array_keys($form_arr) as $i) 	{
	$productcat_title = $form_arr[$i]->getVar('title');
	$productcat_name = $form_arr[$i]->getVar('dirname');
	$cat_select->addOption($form_arr[$i]->getVar("bid"), $productcat_name ." *** ". $productcat_title);
	}

	$form->addElement($cat_select);
//

//centrage
$tagchannel = array('spot_topcenter' => _AM_SPOT_CENTERCCOLUMN, 'spot_topleft' => _AM_SPOT_CENTERLCOLUMN, 'spot_topright' => _AM_SPOT_CENTERRCOLUMN, 'spot_bottomcenter' => _AM_SPOT_BOTTOMCCOLUMN, 'spot_bottomleft' => _AM_SPOT_BOTTOMLCOLUMN, 'spot_bottomright' => _AM_SPOT_BOTTOMRCOLUMN );
$tagchannel_select = new XoopsFormSelect(_AM_SPOT_CENTER, 'side', $this->getVar('side'));
$tagchannel_select->addOptionArray($tagchannel);
$form->addElement($tagchannel_select);
	

//upload
if ($this->isNew()) {
$form->insertBreak('<div align="center">'._AM_SPOT_OPTIONDESC.'</div>', 'odd');
}
//load page
	$page_handler =& xoops_getModuleHandler('tdmspot_page', 'TDMSpot');
    $page_select = new XoopsFormSelect(_AM_SPOT_PAGE, 'pid', $this->getVar('pid'));
    $page_select->addOptionArray($page_handler->getList());
    $form->addElement($page_select, true);
//
//	
		
		
		
		$form->addElement(new XoopsFormText(_AM_SPOT_WEIGHT, 'weight', 10, 10, $this->getVar('weight')));				
        $form->addElement(new XoopsFormRadioYN(_AM_SPOT_VISIBLE, 'visible', $this->getVar('visible'), _YES, _NO));
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
	}

}


class TDMSpottdmspot_newblocksHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmspot_newblocks", 'TDMSpot_newblocks', 'id', 'title');
    }

}


?>