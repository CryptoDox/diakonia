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
require(XOOPS_ROOT_PATH.'/header.php');


 if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';

$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
$vote_handler =& xoops_getModuleHandler('tdmspot_vote', 'TDMSpot');

$myts =& MyTextSanitizer::getInstance();

$module_handler =& xoops_gethandler('module');
$xoopsModule =& $module_handler->getByDirname('TDMSpot');
$gperm_handler =& xoops_gethandler('groupperm');

if(!isset($xoopsModuleConfig)){
	$config_handler = &xoops_gethandler('config');
	$xoopsModuleConfig = &$config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));
    }

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
		
	case "addvote": 

	//interdit au non membre	
if (empty($xoopsUser)) {
echo _MD_SPOT_QUERYNOREGISTER;
exit();
}

//permission d'afficher
if (!$gperm_handler->checkRight('spot_view', 32, $groups, $xoopsModule->getVar('mid'))) {
	echo _MD_SPOT_NOPERM;
	 exit();
    }
	
	if ($_REQUEST['vote_id']) {
		

	$criteria = new CriteriaCompo();
    $criteria->add(new Criteria('vote_file', $_REQUEST['vote_id']));
	$criteria->add(new Criteria('vote_ip', $_SERVER["REMOTE_ADDR"]));
	$numvote = $vote_handler->getCount($criteria);
	
	if ($numvote > 0) {
	echo _MD_SPOT_VOTENOOK;
	exit();
	} else {
	$obj =& $vote_handler->create();
	$obj->setVar('vote_file', $_REQUEST['vote_id']);
	$obj->setVar('vote_ip', $_SERVER["REMOTE_ADDR"]);
	$erreur = $vote_handler->insert($obj);
	
	$item = $item_handler->get($_REQUEST['vote_id']);
	$count = $item->getVar('file_counts');
	$vote = $item->getVar('file_votes');
	$count++;
	$vote++;
    $item->setVar('counts', $count);
	$item->setVar('votes', $vote);
	$erreur .= $item_handler->insert($item);
	}
	
	
	if ($erreur){
	echo  _MD_SPOT_VOTEOK;
	exit();
	} else {
	echo _MD_SPOT_BASEERROR;
	exit();
	}
	
	}
    break;
	
		case "removevote": 
	
	//interdit au non membre	
if (empty($xoopsUser)) {
echo _MD_SPOT_QUERYNOREGISTER;
exit();
}

//permission d'afficher
if (!$gperm_handler->checkRight('spot_view', 32, $groups, $xoopsModule->getVar('mid'))) {
	echo _MD_SPOT_NOPERM;
	 exit();
    }

	if ($_REQUEST['vote_id']) {
		
	
	$criteria = new CriteriaCompo();
    $criteria->add(new Criteria('vote_file', $_REQUEST['vote_id']));
	$criteria->add(new Criteria('vote_ip', $_SERVER["REMOTE_ADDR"]));
	$numvote = $vote_handler->getCount($criteria);
	
	if ($numvote > 0) {
	echo _MD_SPOT_VOTENOOK;
	exit();
	} else {
	$obj =& $vote_handler->create();
	$obj->setVar('vote_file', $_REQUEST['vote_id']);
	$obj->setVar('vote_ip', $_SERVER["REMOTE_ADDR"]);
	$erreur = $vote_handler->insert($obj);
	
	$item = $item_handler->get($_REQUEST['vote_id']);
	$count = $item->getVar('file_counts');
	$vote = $item->getVar('file_votes');
	$count = $count - 1;
	$vote++;
    $item->setVar('counts', $count);
	$item->setVar('votes', $vote);
	$erreur .= $item_handler->insert($item);
	
	}
	if ($erreur){
	echo  _MD_SPOT_VOTEOK;
	  	exit();
	} else {
	echo _MD_SPOT_BASEERROR;
		exit();
	}
	}
	
break;

}

?>
