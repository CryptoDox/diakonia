<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Module HERMES version 1.1.1pour XOOPS- Gestion de lettre de diffusion 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique G�n�rale GNU publi�e par la Free Software Foundation (version 2 ou bien toute autre version ult�rieure choisie par vous). 

Ce programme est distribu� car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but sp�cifique. Reportez-vous � la Licence Publique G�n�rale GNU pour plus de d�tails. 

Vous devez avoir re�u une copie de la Licence Publique G�n�rale GNU en m�me temps que ce programme ; si ce n'est pas le cas, �crivez � la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Cr�eation juin 2007
Derni�re modification : septembre 2007 
******************************************************************************/


include_once ("admin_header.php");


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'hermes'),
              array('name' =>'idTexte',   'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

/*****************************************************************************
 *  controleur
*****************************************************************************/

    

   admin_xoops_cp_header(_HER_ONGLET_DOC + $gepeto['numDoc'], $xoopsModule);
   $tDoc = array('help/hermes','licence/GPL','help/hermes-histo','help/hermesPlugin'); 
//    displayArray ($tDoc, "***** docs *****");
//    viewDoc ($tDoc[$gepeto['numDoc']], $xoopsConfig['language'], _LEX_ROOT_PATH);
    
    $root = (($xoopsModuleConfig['urlDoc'] == '') ? XOOPS_URL : $xoopsModuleConfig['urlDoc']).'/modules';
    //echo "<hr>{$root}<br>{$xoopsConfig['language']}<hr>";
    viewDocFromSite ('hermes', $tDoc[$gepeto['numDoc']], $xoopsConfig['language'], $root);  
    admin_xoops_cp_footer();





?>
