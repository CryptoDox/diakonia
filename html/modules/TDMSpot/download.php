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
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$myts =& MyTextSanitizer::getInstance();
$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');

//perm
$gperm_handler =& xoops_gethandler('groupperm');
//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$user_uid = 0;
}

	if (!isset($_REQUEST['itemid'])) {
	 redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	 	exit();
    }

	if (!$gperm_handler->checkRight('spot_view', 256, $groups, $xoopsModule->getVar('mid'))) {
	 redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	 	exit();
    }

$document = $item_handler->get($_REQUEST['itemid']);

if (!$document){
 redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	exit();
}

		//on test l'existance du fichier
		$imgpath = TDMSPOT_UPLOAD_PATH . "/".$document->getVar("file");
		if (file_exists($imgpath)) {
		$document_file = TDMSPOT_UPLOAD_URL. "/".$document->getVar("file");
		} else {
		 redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	exit();
		}

//$dl = $document->getVar('file_dl');
//$dl++;
//$document->setVar('file_dl', $dl);
//$file_handler->insert($document);

//header('content-disposition: attachment; filename='.$document_file.''); 
//header("Pragma: no-cache");
//header("Expires: 0"); 
//readfile($document_file); 
header ('content-disposition: attachment; filename='.$document_file.''); 
//echo "<html><head><meta http-equiv=\"Refresh\" content=\"0; URL=".$document_file."\"></meta></head><body></body></html>";
?>