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

$gif = false;

if ($gif) header("Content-type: image/gif");
//header("Content-type: image/gif");

include_once ("header.php");
require_once ("include/hermes_stat.php");
//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/').
             "modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------
//include_once (_HER_JJD_PATH.'include/constantes.php');
include_once (_HER_JJD_PATH.'include/functions.php');

include_once (_HER_ROOT_PATH."include/hermes_data.php");



//-------------------------------------------------------------
/*

$vars = array(array('name' =>'op',        'default' => ''),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
*/
//-------------------------------------------------------------




/**********************************************************
 *controleur
 **********************************************************/
$op   = ((isset($_GET['op']))   ? $_GET['op']   : '');
$code = ((isset($_GET['code'])) ? $_GET['code'] : '');

//op = 'ucs_img';
switch ($op){

case 'ucs':
  //$image = setNewStat($gepeto['code']);
  $image = addNewStat($code);  
  //echo "<hr>{$image}<hr>";
  //readfile($image);
  if ($gif) readfile($image);    
  break;

case 'ucs_test':
  $image = addNewStat($code);
  break;
  
case 'ucs_img':
  //$image = setNewStat($gepeto['code']);
  //$image = _HER_ROOT_PATH."images/sumo.gif";   
  $image = _HER_ROOT_PATH."images/sumo.gif";   
  //echo "<hr>{$image}<hr>";
  if ($gif) readfile($image);  
  break;
  
  
default:
  break;
}



?>

