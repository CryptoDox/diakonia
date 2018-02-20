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


class cls_her_2_10{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.10';  
  var $dateVersion  = "2008-01-25 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = 'Test version 2.10';

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_10($options){
 
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
    
    $this->createNewTables();
    $this->alterTables();    
    $this->updateContentTables();                  
    return true;
} // fin updtateModule

/*************************************************************************
 *
 *************************************************************************/
function createNewTables(){
global $xoopsModuleConfig, $xoopsDB;
  
  $table = $xoopsDB->prefix('her_url');
  $sql = "CREATE TABLE  {$table}(
          idUrl BIGINT(20) NOT NULL AUTO_INCREMENT,
          url VARCHAR(255) NULL,
          description VARCHAR(255) NULL,
          PRIMARY KEY(idUrl)
          );";  
  $xoopsDB->queryF ($sql);  
  //----------------------------------------------
  $table = $xoopsDB->prefix('her_syndication');  
  $sql = "CREATE TABLE  {$table}(
            idUrl BIGINT(20) NOT NULL,
            idLettre BIGINT(20) NOT NULL,
            PRIMARY KEY(idUrl, idLettre)
          );";
  $xoopsDB->queryF ($sql);          
  //----------------------------------------------          
            
  return true;   

   
} // fin createNewTables
/*************************************************************************
 *
 *************************************************************************/
function alterTables(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_lettre');  
  $sql = "ALTER TABLE {$table}"
        ." ADD pageWidth     varchar(8) not Null,"
        ." ADD bgImg         varchar(50) not Null";


  //echo "mise à jour : {$table}<br>" ;
  //----------------------------------------------------
  $xoopsDB->queryF ($sql);
 
  //------------------------------------------- 
  return true;   
   
}//fin updateContentTable
//-----------------------------------------------------------

/*************************************************************************
 *
 *************************************************************************/
function updateContentTables(){
global $xoopsModuleConfig, $xoopsDB;

    
  //------------------------------------------- 
  return true;   
   
}//fin updateContentTable
//-----------------------------------------------------------

} // fin de la classe

?>
