<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Module HERMES version 1.1.1pour XOOPS- Gestion de lettre de diffusion 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique Générale GNU publiée par la Free Software Foundation (version 2 ou bien toute autre version ultérieure choisie par vous). 

Ce programme est distribué car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but spécifique. Reportez-vous à la Licence Publique Générale GNU pour plus de détails. 

Vous devez avoir reçu une copie de la Licence Publique Générale GNU en même temps que ce programme ; si ce n'est pas le cas, écrivez à la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Créeation juin 2007
Dernière modification : septembre 2007 
******************************************************************************/

// General settings
//include_once ("header.php");
global $xoopsModule;
//$f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
//                               ."modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php";
// echo "<hr>$f<hr>";

//$hPath = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
//                               ."modules/".$xoopsModule->getVar('dirname');
$hPath = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."modules/".'hermes';

//echo "<hr>{$hPath}<hr>";
include_once ($hPath."/include/hermes_constantes.php");
include_once ($hPath."/include/hermes_data.php");

/*

include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
*/

$root = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/').
                          "modules/jjd_tools/";
include_once ($root."include/jjd_constantes.php");
include_once ($root."_common/include/version_functions.php");


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => ''),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------



/**********************************************************************
 *
 **********************************************************************/ 
//function xoops_module_install_xoopshack(&$module) {
function xoops_module_install_hermes(&$module) {
global $xoopsModuleConfig, $xoopsDB;

  return true;
}


/**********************************************************************
 *
 **********************************************************************/ 
//function xoops_module_update_xoopshack(&$module) {
function xoops_module_update_hermes(&$module) {
global $xoopsModuleConfig, $xoopsDB;
  
  return update_module($module);
  return true;  

}

/**********************************************************************
 *
 **********************************************************************/ 
//function xoops_module_uninstall_xoopshack(&$module) {
function xoops_module_uninstall_hermes(&$module) {
global $xoopsModuleConfig, $xoopsDB;

  kill_Module($module);
  return true;
}
 
 

?>

