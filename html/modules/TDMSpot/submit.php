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
include_once '../../mainfile.php';
include_once XOOPS_ROOT_PATH.'/header.php';
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$myts =& MyTextSanitizer::getInstance();
$gperm_handler =& xoops_gethandler('groupperm');
//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}

//load class
$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'submit';

global $xoopsUser, $xoopsModule, $xoopsModuleConfig;

 switch($op) {
 
  case "submit":
  
  //perm
if (!$gperm_handler->checkRight('tdmspot_view', 4, $groups, $xoopsModule->getVar('mid')) && !$gperm_handler->checkRight('tdmspot_view', 8, $groups, $xoopsModule->getVar('mid'))) {
redirect_header(TDMSPOT_URL, 2, _MD_SPOT_NOPERM);
exit();
}else {
  		// Affichage du formulaire de cr?ation de cat?gories
    	$obj =& $item_handler->create();
    	$form = $obj->getForm();
    	$form->display();
		}
		break;		
		
 case "save":
 
   //perm
if (!$gperm_handler->checkRight('tdmspot_view', 4, $groups, $xoopsModule->getVar('mid')) && !$gperm_handler->checkRight('tdmspot_view', 8, $groups, $xoopsModule->getVar('mid'))) {
redirect_header(TDMSPOT_URL, 2, _MD_SPOT_NOPERM);
exit();
}else {

		
		if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('index.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}

        $obj =& $item_handler->create();
	
//upload	
		include_once XOOPS_ROOT_PATH.'/class/uploader.php';
     //cree le chemin
	
		$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/";
		$mimetype = explode('|',$xoopsModuleConfig['tdmspot_mimetype']);
		$uploader = new XoopsMediaUploader($uploaddir, $mimetype, $xoopsModuleConfig['tdmspot_mimemax'], null, null);

		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
		$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
		if (!$uploader->upload()) {
		$errors = $uploader->getErrors();
		redirect_header("javascript:history.go(-1)",3, $errors);
		} else {
		$obj->setVar('file', $uploader->getSavedFileName());
		}
		} else {
		$obj->setVar('file', $_REQUEST['file']);
		}
		$obj->setVar('title', $_REQUEST['title']);
		$obj->setVar('cat', $_REQUEST['cat']);
		$obj->setVar('text', $_REQUEST['text']);
		$obj->setVar('display', $_REQUEST['display']);
		$obj->setVar('indate', strtotime($_REQUEST['indate']['date']) + intval($_REQUEST['indate']['time']));
		$obj->setVar('poster', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
		
		if ($item_handler->insert($obj)) {
        redirect_header(TDMSPOT_URL, 2, _MD_SPOT_BASEOK);
		}
		//include_once('../include/forms.php');
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
		$form->display();
		
		}
    break;
	
	  } 
	  
include_once "../../footer.php";
?>