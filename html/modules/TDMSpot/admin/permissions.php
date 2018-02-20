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
Adminmenu(5, _AM_SPOT_MANAGE_PERM);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (5, _AM_SPOT_MANAGE_PERM);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/permissions.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_PERM.'</strong></h3>';
echo '</div><br />';

$module_id = $xoopsModule->getVar('mid');


$perm_name = "spot_view";
$perm_desc = _AM_SPOT_MANAGE_PERM;

	
	$global_perms_array = array(
        '2' => _AM_SPOT_PERM_2 ,
		'4' => _AM_SPOT_PERM_4 ,
		'8' => _AM_SPOT_PERM_8 ,
		'16' => _AM_SPOT_PERM_16 ,
		'32' => _AM_SPOT_PERM_32 ,
		'64' => _AM_SPOT_PERM_64,
		'128' => _AM_SPOT_PERM_128,
		'256' => _AM_SPOT_PERM_256
		 );

	

$permform = new XoopsGroupPermForm('', $module_id, $perm_name, '');
	

foreach( $global_perms_array as $perm_id => $perm_name ) {
		$permform->addItem( $perm_id , $perm_name ) ;
	}
	
echo $permform->render();

xoops_cp_footer() ;

?>