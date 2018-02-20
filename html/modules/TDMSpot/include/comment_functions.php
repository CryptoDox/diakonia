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
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

// comment callback functions

function tdmspot_comments_update( $id , $total_num ) {
	global $xoopsDB ;

$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMspot');
$view = $item_handler->get($id);
$hits = $view->getVar('comments');
$hits++;
$obj =& $item_handler->get($id);
$obj->setVar('comments', $hits);
$ret = $item_handler->insert($obj);

	return $ret ;
	
}

function tdmspot_comments_approve( &$comment )
{
	// notification mail here
}
?>