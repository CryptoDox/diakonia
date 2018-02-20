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
function b_tdmspot($options) {

	global $xoopsModuleConfig, $xoopsModule;
	
include_once XOOPS_ROOT_PATH.'/modules/TDMSpot/include/common.php';

$module_handler =& xoops_gethandler('module');
$xoopsModule =& $module_handler->getByDirname('TDMSpot');

if(!isset($xoopsModuleConfig)){
	$config_handler = &xoops_gethandler('config');
	$xoopsModuleConfig = &$config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));
    }	

if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
    include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/seo.inc.php';
}

		
	$blocks = array();
	$type_block = $options[0];
	$nb_document = $options[1];
	$lenght_title = $options[2];
	$myts =& MyTextSanitizer::getInstance();
	$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
	
	$criteria = new CriteriaCompo();
	$criteria->setLimit($nb_document);
	array_shift($options);
	array_shift($options);
	array_shift($options);
	if (!(count($options) == 1 && $options[0] == 0)) {
		$criteria->add(new Criteria('cat', addCatSelect($options),'IN'));
	}
	

	switch ($type_block) 
	{
	//title
			case "title":
			$criteria->add(new Criteria('display', 1));
			$criteria->add(new Criteria('indate', time(), '<'));
			$criteria->setSort('title');
			$criteria->setOrder('DESC');
			$assoc_arr = $item_handler->getall($criteria);
	foreach (array_keys($assoc_arr) as $i) {	
		$blocks[$i]['id'] = $assoc_arr[$i]->getVar('id');
		$blocks[$i]['title'] = $myts->displayTarea((strlen($assoc_arr[$i]->getVar('title')) > $lenght_title ? substr($assoc_arr[$i]->getVar('title'),0,($lenght_title))."..." : $assoc_arr[$i]->getVar('title')));
		//$blocks[$i]['title'] =  "<a href='".XOOPS_URL. "/modules/TDMSpot/item.php?itemid=".$assoc_arr[$i]->getVar('id')."'>".$title."</a>";
		$blocks[$i]['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $assoc_arr[$i]->getVar('id'), $assoc_arr[$i]->getVar('title'));
		$blocks[$i]['counts'] = $assoc_arr[$i]->getVar("counts");
		$blocks[$i]['hits'] = $assoc_arr[$i]->getVar("hits");
		$blocks[$i]['indate'] = formatTimeStamp($assoc_arr[$i]->getVar("indate"),"m");
	}			
		break;
		//recents
		case "date":
			$criteria->add(new Criteria('display', 1));
			$criteria->add(new Criteria('indate', time(), '<'));
			$criteria->setSort('indate');
			$criteria->setOrder('DESC');
			$assoc_arr = $item_handler->getall($criteria);
	foreach (array_keys($assoc_arr) as $i) {	
		$blocks[$i]['id'] = $assoc_arr[$i]->getVar('id');
		$blocks[$i]['title'] = $myts->displayTarea((strlen($assoc_arr[$i]->getVar('title')) > $lenght_title ? substr($assoc_arr[$i]->getVar('title'),0,($lenght_title))."..." : $assoc_arr[$i]->getVar('title')));
		//$blocks[$i]['title'] =  "<a href='".XOOPS_URL. "/modules/TDMSpot/item.php?itemid=".$assoc_arr[$i]->getVar('id')."'>".$title."</a>";
		$blocks[$i]['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $assoc_arr[$i]->getVar('id'), $assoc_arr[$i]->getVar('title'));
		$blocks[$i]['counts'] = $assoc_arr[$i]->getVar("counts");
		$blocks[$i]['hits'] = $assoc_arr[$i]->getVar("hits");
		$blocks[$i]['indate'] = formatTimeStamp($assoc_arr[$i]->getVar("indate"),"m");
	}			
		break;
		// populaire
		case "hits":
			$criteria->add(new Criteria('display', 1));
			$criteria->add(new Criteria('indate', time(), '<'));
			$criteria->setSort('hits');
			$criteria->setOrder('DESC');
			$assoc_arr = $item_handler->getall($criteria);
	foreach (array_keys($assoc_arr) as $i) {	
		$blocks[$i]['id'] = $assoc_arr[$i]->getVar('id');
		$blocks[$i]['title'] = $myts->displayTarea((strlen($assoc_arr[$i]->getVar('title')) > $lenght_title ? substr($assoc_arr[$i]->getVar('title'),0,($lenght_title))."..." : $assoc_arr[$i]->getVar('title')));
		//$blocks[$i]['title'] =  "<a href='".XOOPS_URL. "/modules/TDMSpot/item.php?itemid=".$assoc_arr[$i]->getVar('id')."'>".$title."</a>";
		$blocks[$i]['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $assoc_arr[$i]->getVar('id'), $assoc_arr[$i]->getVar('title'));
		$blocks[$i]['counts'] = $assoc_arr[$i]->getVar("counts");
		$blocks[$i]['hits'] = $assoc_arr[$i]->getVar("hits");
		$blocks[$i]['indate'] = formatTimeStamp($assoc_arr[$i]->getVar("indate"),"m");
	}
		break;
				case "counts":
			$criteria->add(new Criteria('display', 1));
			$criteria->add(new Criteria('indate', time(), '<'));
			$criteria->setSort('counts');
			$criteria->setOrder('DESC');
			$assoc_arr = $item_handler->getall($criteria);
	foreach (array_keys($assoc_arr) as $i) {	
		$blocks[$i]['id'] = $assoc_arr[$i]->getVar('id');
		$blocks[$i]['title'] = $myts->displayTarea((strlen($assoc_arr[$i]->getVar('title')) > $lenght_title ? substr($assoc_arr[$i]->getVar('title'),0,($lenght_title))."..." : $assoc_arr[$i]->getVar('title')));
		//$blocks[$i]['title'] =  "<a href='".XOOPS_URL. "/modules/TDMSound/item.php?itemid=".$assoc_arr[$i]->getVar('id')."'>".$title."</a>";
		$blocks[$i]['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $assoc_arr[$i]->getVar('id'), $assoc_arr[$i]->getVar('title'));
		$blocks[$i]['counts'] = $assoc_arr[$i]->getVar("counts");
		$blocks[$i]['hits'] = $assoc_arr[$i]->getVar("hits");
		$blocks[$i]['indate'] = formatTimeStamp($assoc_arr[$i]->getVar("indate"),"m");
	}
		break;
			case "comments":
			$criteria->add(new Criteria('display', 1));
			$criteria->add(new Criteria('indate', time(), '<'));
			$criteria->setSort('comments');
			$criteria->setOrder('DESC');
			$assoc_arr = $item_handler->getall($criteria);
	foreach (array_keys($assoc_arr) as $i) {	
		$blocks[$i]['id'] = $assoc_arr[$i]->getVar('id');
		$blocks[$i]['title'] = $myts->displayTarea((strlen($assoc_arr[$i]->getVar('title')) > $lenght_title ? substr($assoc_arr[$i]->getVar('title'),0,($lenght_title))."..." : $assoc_arr[$i]->getVar('title')));
		//$blocks[$i]['title'] =  "<a href='".XOOPS_URL. "/modules/TDMSpot/item.php?itemid=".$assoc_arr[$i]->getVar('id')."'>".$title."</a>";
		$blocks[$i]['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $assoc_arr[$i]->getVar('id'), $assoc_arr[$i]->getVar('title'));
		$blocks[$i]['counts'] = $assoc_arr[$i]->getVar("counts");
		$blocks[$i]['hits'] = $assoc_arr[$i]->getVar("hits");
		$blocks[$i]['indate'] = formatTimeStamp($assoc_arr[$i]->getVar("indate"),"m");
	}
		break;
			case "rand":
			$criteria->add(new Criteria('display', 1));
			$criteria->add(new Criteria('indate', time(), '<'));
			$criteria->setSort('RAND()');
			$assoc_arr = $item_handler->getall($criteria);
	foreach (array_keys($assoc_arr) as $i) {	
		$blocks[$i]['id'] = $assoc_arr[$i]->getVar('id');
		$blocks[$i]['title'] = $myts->displayTarea((strlen($assoc_arr[$i]->getVar('title')) > $lenght_title ? substr($assoc_arr[$i]->getVar('title'),0,($lenght_title))."..." : $assoc_arr[$i]->getVar('title')));
		//$blocks[$i]['title'] =  "<a href='".XOOPS_URL. "/modules/TDMSpot/item.php?itemid=".$assoc_arr[$i]->getVar('id')."'>".$title."</a>";
		$blocks[$i]['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $assoc_arr[$i]->getVar('id'), $assoc_arr[$i]->getVar('title'));
		$blocks[$i]['counts'] = $assoc_arr[$i]->getVar("counts");
		$blocks[$i]['hits'] = $assoc_arr[$i]->getVar("hits");
		$blocks[$i]['indate'] = formatTimeStamp($assoc_arr[$i]->getVar("indate"),"m");
	}
		break;
			
	}
	
	return $blocks;
}

function b_tdmspot_edit($options) {
	$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('display', 1));
	$criteria->setSort('title');
	$criteria->setOrder('ASC');
	$assoc_arr = $cat_handler->getall($criteria);
	$form = _MI_SPOT_BLOCK_LIMIT."&nbsp;\n";
	$form .= "<input type=\"hidden\" name=\"options[0]\" value=\"" . $options[0] . "\" />";
	$form .= "<input name=\"options[1]\" size=\"5\" maxlength=\"255\" value=\"" . $options[1] . "\" type=\"text\" />&nbsp;<br />";
	$form .= _MI_SPOT_BLOCK_TEXTE . " : <input name=\"options[2]\" size=\"5\" maxlength=\"255\" value=\"" . $options[2] . "\" type=\"text\" /><br /><br />";
	array_shift($options);
	array_shift($options);
	array_shift($options);
	$form .= _MI_SPOT_BLOCK_CAT. "<br /><select name=\"options[]\" multiple=\"multiple\" size=\"5\">";
	$form .= "<option value=\"0\" " . (array_search(0, $options) === false ? '' : 'selected="selected"') . ">All</option>";
	foreach (array_keys($assoc_arr) as $i) {
		$form .= "<option value=\"" . $assoc_arr[$i]->getVar('id') . "\" " . (array_search($assoc_arr[$i]->getVar('id'), $options) === false ? '' : 'selected="selected"') . ">".$assoc_arr[$i]->getVar('title')."</option>";
	}
	$form .= "</select>";
	
	return $form;
}


?>
