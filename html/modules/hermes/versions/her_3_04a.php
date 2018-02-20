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


class cls_her_3_04a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '3.04a';  
  var $dateVersion  = "2008-05-22 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Gestion es sondages";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_3_04a($options){
 
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

    $this->createSondage();           
    $this->createReponse();             
    $this->createResultat();    
    $this->updateUrl();
    
        
    return true;

} // fin updtateModule


/*************************************************************************
 *
 *************************************************************************/
function createSondage(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_sondage');  

$sql = "CREATE TABLE `{$table}` (
            `idSondage` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            `nom` VARCHAR( 60 ) NOT NULL ,
            `categorie` VARCHAR(60) NOT NULL,
            `description` LONGTEXT NOT NULL ,
            `dateDebut` DATETIME NOT NULL ,
            `dateFin` DATETIME NOT NULL ,
            `disposition` TINYINT NOT NULL DEFAULT '0',
            `groupes` VARCHAR( 255 ) NOT NULL,      
            `mode` TINYINT NOT NULL DEFAULT '2'                     
            ) TYPE = MYISAM ;";  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 


/*************************************************************************
 *
 *************************************************************************/
function createReponse(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_reponse');  

$sql = "CREATE TABLE `{$table}` (
        `idReponse` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `idSondage` BIGINT NOT NULL ,
        `nom` VARCHAR( 255 ) NOT NULL ,
        `image` VARCHAR(255) NOT NULL ,        
        `ordre` INT NOT NULL DEFAULT '0', 
        `resultat` BIGINT NOT NULL
        ) TYPE = MYISAM ;";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 

/*************************************************************************
 *
 *************************************************************************/
function createResultat(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_resultat');  

$sql = "CREATE TABLE `{$table}` (
        `idResultat` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        `idReponse` BIGINT NOT NULL ,
        `email` VARCHAR( 60 ) NOT NULL ,
        `reponse` BIGINT NOT NULL ,
        `dateReponse` DATETIME NOT NULL
        ) TYPE = MYISAM ;";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 
/*************************************************************************
 *
 *************************************************************************/
function updateUrl(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_url');  
  
  $sql = "ALTER TABLE {$table}"
        ."  ADD `categorie` TINYINT(2) NOT NULL DEFAULT '0';";
  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>