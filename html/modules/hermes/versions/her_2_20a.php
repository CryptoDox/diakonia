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


class cls_her_2_20a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.20a';  
  var $dateVersion  = "2008-04-03 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Mis� jour : Ajout d'une liste 'email de test dans lettre";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_20a($options){
 
  }
  
/*************************************************************************
 *
 *************************************************************************/
function getVersion()     {return $this->version;}
function getDateVersion() {return $this->dateVersion;}
function getDescription() {return $this->description;}


/*************************************************************************
 *
 *************************************************************************/

function updateModule(&$module){


   
    $this->updateLettre();
    $this->updateArchive();
                
    //$this->updateStyle();    
    return true;

} // fin updtateModule
/*************************************************************************
 *
 *************************************************************************/
function updateLettre(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_lettre');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD idListeTest bigint(20) NOT NULL DEFAULT '0',"
        ." ADD chronoArchive   bigint(20) NOT NULL DEFAULT '0'";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function updateArchive(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_archive');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD chronoArchive   bigint(20) NOT NULL DEFAULT '0',"
        ." ADD test TINYINT(1) UNSIGNED NULL DEFAULT '0'";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

} //fin class
?>
