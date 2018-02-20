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
require('../../../mainfile.php');
include_once '../../../include/cp_header.php';


 if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';

$myts =& MyTextSanitizer::getInstance();
global $xoopsUser, $xoopsModuleConfig, $xoopsModule;

$module_handler =& xoops_gethandler('module');
$xoopsModule =& $module_handler->getByDirname('TDMNotify');
$gperm_handler =& xoops_gethandler('groupperm');
//inclus les langues
include_once(XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language']."/main.php");

//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$xd_uid = $xoopsUser->getVar('uid');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$xd_uid = 0;
}

 switch($op) {		
		
	case "save": 

$notif_handler =& xoops_getModuleHandler('tdmnotify_notif', 'TDMNotify');

if (isset($_REQUEST['id'])) {
        $obj =& $notif_handler->get($_REQUEST['id']);
		} else {
        $obj =& $notif_handler->create();
		}		
		
		$obj->setVar('block', $_REQUEST['block']);
		$obj->setVar('url', $_REQUEST['url']);
		$obj->setVar('ip', $_SERVER['REMOTE_ADDR']);
		$obj->setVar('indate', time());
		$obj->setVar('poster', $xd_uid);
		$obj->setVar('form', $_REQUEST['form']);		
		
		if ($xd_uid > 0 ) {
  
  //if ($xoopsModuleConfig['send_notify'] > 1) {
	echo $users =& $obj->getMail($xd_uid, 1);
	//}
        }
		
		
	$notif_handler->insert($obj);
	echo _MD_NOTIFY_BASEOK; 
	exit();
	
	
	 break;
}

?>
