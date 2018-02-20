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


class cls_her_2_26a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.26a';  
  var $dateVersion  = "2008-04-30 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Gestion des statistiques de lectures";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_26a($options){
 
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

    $this->createLecture();
    $this->createFrame();    
    
    $this->updateIndexTemp();   
    $this->updateCession();    
    $this->updateLettre();           
    $this->updateTexte();     
             
    //$this->updateStyle();    
    return true;

} // fin updtateModule


/*************************************************************************
 *
 *************************************************************************/
function updateCession(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_cession');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `emailSender` VARCHAR(60) NOT NULL," 
        ." ADD `listeComplementaire2` LONGTEXT NOT NULL ";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function updateLettre(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_lettre');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `idFrame` bigint(20) NOT NULL  default '0',"  
        ." ADD `categorie` varchar(60) NOT NULL,"  
        ." ADD `statLecture` tinyint(1) NOT NULL default '0',"  
        ." ADD `statImgAlign` tinyint(1) NOT NULL default '1',"        
        ." ADD `statImg0` varchar(255) NOT NULL," 
        ." ADD `statImg1` varchar(255) NOT NULL ;";
  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function updateTexte(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_texte');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `idFrame` bigint(20) NOT NULL  default '0'" ;
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function createLecture(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_lecture');  
  
  $sql = "CREATE TABLE `{$table}` (
      `idLettre` bigint(20) NOT NULL default '0',
      `idArchive` bigint(20) NOT NULL default '0',
      `idUser` bigint(20) NOT NULL default '0',
      `email` varchar(60) NOT NULL,   
      `ip` varchar(25) NOT NULL,
      `dateLecture` int(10) NOT NULL default '0',
      `compteur` tinyint(4) NOT NULL default '1',
      `quantieme` int(10) NOT NULL default '0',
      `flag` tinyint(4) NOT NULL default '0',
      KEY `hermes_lecture` (`idArchive`,`email`)
      ) type = MyISAM ;";

  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable
/*************************************************************************
 *
 *************************************************************************/
function createFrame(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_frame');  
  
  $sql = "CREATE TABLE `{$table}` (
    `idFrame` bigint(20) NOT NULL auto_increment,
    `nom` varchar(80) NOT NULL,
    `bgColor` varchar(7) default NULL,
    `borderWidth` int(10) unsigned default '0',
    `borderColorLight` varchar(7) default NULL,
    `borderColorDark` varchar(7) default NULL,
    `alignement` int(10) unsigned default '2',
    `width` varchar(5) default '100',
    `incrustation` int(11) default '0',
    PRIMARY KEY  (`idFrame`)
     ) type = MyISAM ;";

  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function updateIndexTemp(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_temp');
  
  
  $sql = "ALTER TABLE {$table} DROP INDEX `idCession, her_temp_email` ;";
  $xoopsDB->queryF ($sql);   

  //------------------------------------------- 
  return true;   
   
}//fin createTable_FluxRss

//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>
