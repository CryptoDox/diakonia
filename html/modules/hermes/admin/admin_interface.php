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


//include_once ("admin/admin_header.php");
//---------------------------------------------------------------
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."class/xoopsformloader.php");
//require_once ("hermes_constantes.php");
//include_once (_HER_JJD_PATH."/include/functions.php");

//---------------------------------------------------------------/

/*********************************************************************

**********************************************************************/
function insertCodeDeRemplacement($txtName, $listName){
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

 
    //-------------code de remplacement
    $listCode = buildHtmlList ($listName, getCodeList(), 0,  0, $nbRows = 1, '', '');    
    $oc = "insertTextIntoWysiwyg(\"{$listName}\", \"{$txtName}\",{$xoopsModuleConfig['editor']},\"[]\",event);";
    $or = "insertTextIntoWysiwyg(\"{$listName}\", \"{$txtName}\",{$xoopsModuleConfig['editor']},\"[]\",event);";    
    $btn =  "<input type='button' name='insertCode' value='"._AD_HER_INSERT_TAG."' onclick='{$oc}' >";
    
    if (true){
      $oc = "insertAllCode(\"{$listName}\", \"{$txtName}\",{$xoopsModuleConfig['editor']},\"[]\",event);";
      $btn2 =  "   ->  <input type='button' name='insertCode' value='"."tous"."' onclick='{$oc}' >";
    
    }else{$btn2 =  '';}
    
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_TAGINFO."<B></TD>"._br;    
    echo "<TD align='left' >{$listCode} ->  {$btn}{$btn2}</TD>"._br;    
    
    
    echo "</TR>"._br;    
    echo buildDescription(_AD_HER_TAGINFO_DSC);    

    
}
/*************************************************************************
 *
 *************************************************************************/
function insertCodeDeRemplacement2($nameList){
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

 
    //-------------code de remplacement
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 1, '', '');    
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']},\"[]\",event);";
    $or = "insertTextIntoWysiwyg(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']},\"[]\",event);";    
    $btn =  "<input type='button' name='insertCode' value='"._AD_HER_INSERT_TAG."' onclick='{$oc}' >";
    
    if (true){
      $oc = "insertAllCode(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']},\"[]\",event);";
      $btn2 =  "   ->  <input type='button' name='insertCode' value='"."tous"."' onclick='{$oc}' >";
    
    }else{$btn2 =  '';}
    
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_TAGINFO."<B></TD>"._br;    
    echo "<TD align='left' >{$listCode} ->  {$btn}{$btn2}</TD>"._br;    
    
    
    echo "</TR>"._br;    
    echo buildDescription(_AD_HER_TAGINFO_DSC);    

    
}
//----------------------------------------------------------------------




?>
