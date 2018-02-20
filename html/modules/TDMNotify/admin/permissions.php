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
 
include '../../../include/cp_header.php'; 
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once("../include/functions.php");

include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
//include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname().'/class/mygrouppermform.php';



if( ! empty( $_POST['submit'] ) ) {
	redirect_header( XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/permissions.php" , 1 , _AM_XD_GPERMUPDATED);
}
	
 xoops_cp_header();
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(4, _AM_NOTIFY_MANAGE_PERM);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (4, _AM_NOTIFY_MANAGE_PERM);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/permissions.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;"><strong>'._AM_NOTIFY_MANAGE_PERM.'</strong>';
echo '</div><br />';

$module_id = $xoopsModule->getVar('mid');


$perm_name = "notify_view";
$perm_desc = _AM_NOTIFY_MANAGE_PERM2;

	

$permform = new XoopsGroupPermForm($perm_desc, $module_id, $perm_name, '');
	
$block_handler =& xoops_getModuleHandler('tdmnotify_block', 'TDMNotify');
$criteria = new CriteriaCompo();
$criteria->setOrder('title');	
$page_arr = $block_handler->getObjects( $criteria );
$count = count($page_arr);

if($count == 0) {
redirect_header( "./block.php" , 1 , _AM_NOTIFY_BLOCKERROR);
}

foreach (array_keys($page_arr) as $i) {
		$permform->addItem( $page_arr[$i]->getVar('id') , $page_arr[$i]->getVar('title') ) ;
	}
	
echo $permform->render();

xoops_cp_footer() ;

?>