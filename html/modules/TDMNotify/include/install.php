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

function xoops_module_install_TDMNotify(&$module) {
///////////////////////////
///Creation des fichiers///
///////////////////////////
global $xoopsModule, $xoopsConfig, $xoopsDB;

$namemodule = "spot";
  if( file_exists(XOOPS_ROOT_PATH."/modules/".$namemodule."/language/".$xoopsConfig['language']."/admin.php") ) {
	 include_once(XOOPS_ROOT_PATH."/modules/".$namemodule."/language/".$xoopsConfig['language']."/admin.php");
  } else {
	 include_once(XOOPS_ROOT_PATH."/modules/".$namemodule."/language/english/admin.php");
  }
		
//Copie du plug
	$plugFile = XOOPS_ROOT_PATH."/modules/".$namemodule."/xoops_plugins/function.xoNotify.php";
	copy($plugFile, XOOPS_ROOT_PATH."/class/smarty/xoops_plugins/function.xoNotify.php");
	
	
	return true;
}
?>