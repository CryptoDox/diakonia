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


class cls_her_2_17a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.17a';  
  var $dateVersion  = "2008-03-05 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Modification de la l 'index unique de her_temp sur idCession et eMail";

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_17a($options){
 
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
    
    $this->updateIndexTemp();

    return true;
} // fin updtateModule

/*************************************************************************
 *
 *************************************************************************/
function updateIndexTemp(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_temp');
  
  
   $sql = "ALTER TABLE {$table} DROP INDEX `email` ;";
  $xoopsDB->queryF ($sql);   
   
   $sql = "ALTER TABLE {$table} DROP INDEX `her_temp_email` ;";
  $xoopsDB->queryF ($sql);
  //-------------------------------------------  
   $sql = "
   ALTER TABLE `{$table}` ADD UNIQUE `her_temp_email` ( `idCession` , `email` );";

  $xoopsDB->queryF ($sql);
  


  //------------------------------------------- 
  return true;   
   
}//fin createTable_FluxRss
//-----------------------------------------------------------

//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>
