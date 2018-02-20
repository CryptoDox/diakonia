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

class cls_her_3_05a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '3.05a';  
  var $dateVersion  = "2008-06-01 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Gestion des templates de lettres";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_3_05a($options){
 
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

    $this->updateStructure();
    $this->updateLettre();    
    
    $this->createDeco();
    $this->createDecopp();
    $this->createDecomodele();  

    $this->transfertFrame2Decopp();
    $this->transfertStyle2Decopp();                      
    return true;

} // fin updtateModule


/*************************************************************************
 *

function createFrise(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_frise');  
  
  $sql = "CREATE TABLE `{$table}` (
      `idFrise` bigint(20) NOT NULL auto_increment,
      `foreColor` varchar(7) NOT NULL default '',
      `width` int(8) NOT NULL default '1',
      `image` varchar(60) NOT NULL,
      PRIMARY KEY  (`idFrise`)
      ) type = MyISAM ;";

  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable

 *************************************************************************/

/*************************************************************************
 *
 *************************************************************************/

function createDecomodele(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_decomodele');  
  
  $sql = "CREATE TABLE `{$table}` (
      `decoModele` VARCHAR( 60 ) NOT NULL ,
      `property` VARCHAR( 60 ) NOT NULL ,
      `typeName` VARCHAR( 30 ) NOT NULL ,
      `rupture` INT NOT NULL DEFAULT '0',            
      `ordre` INT NOT NULL DEFAULT '0',
      `params` VARCHAR( 255 ) NOT NULL ,
      `defaut` VARCHAR( 255 ) NOT NULL ,      
      PRIMARY KEY ( `decoModele` , `property` ) 
      ) type = MyISAM ;";

  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  updateDecorations();
  //--------------------------------------------------  
  
  return true;   

}//fin updateContentTable


/*************************************************************************
 *
 *************************************************************************/

function transfertFrame2Decopp(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
 
  
  $sql = "SELECT * FROM ".$xoopsDB->prefix('her_frame');
   $sqlquery = $xoopsDB->query ($sql);  
   $t = array();
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      /*      
      //suppression des futurs orphelins (snif!)     
      $sql = "DELETE tDeco.*,tPP.* FROM "
            .$xoopsDB->prefix('her_deco').' as tDeco,'
            .$xoopsDB->prefix('her_decopp').' AS tPP '      
            ." WHERE tPP.idDeco = tDeco.idDeco"            
            ."   AND tDeco.name = '{$sqlfetch['nom']}'";
      $xoopsDB->query($sql);	
      */      
      
      //suppression de l'enregistrement parent s'il existe encore (le vilain))
      $sql = "DELETE FROM ".$xoopsDB->prefix('her_deco')
            ." WHERE name = '{$sqlfetch['nom']}'";
      $xoopsDB->query($sql);	

 
      $sql = "DELETE tPP.* FROM ".$xoopsDB->prefix('her_decopp').' AS tPP'
            ." LEFT JOIN ".$xoopsDB->prefix('her_deco').' as tDeco' 
            ." ON tPP.idDeco = tDeco.idDeco "     
            ." WHERE tDeco.idDeco IS NULL ";
      $xoopsDB->query($sql);	
   
  
       //----------------------------------------------------------   
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_deco')
            ." (name,decoModele)"
            ." VALUES ('{$sqlfetch['nom']}','frame')";   
      $xoopsDB->query($sql);	
      $newId = $xoopsDB->getInsertId() ;
      //===========================================================
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'bgColor','{$sqlfetch['bgColor']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'borderWidth','{$sqlfetch['borderWidth']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'borderColorLight','{$sqlfetch['borderColorLight']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'borderColorDark','{$sqlfetch['borderColorDark']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'alignement','{$sqlfetch['alignement']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'width','{$sqlfetch['width']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'incrustation','{$sqlfetch['incrustation']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      
              
    }
    

  //--------------------------------------------------


  return true;   

}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/

function transfertStyle2Decopp(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
 
  
  $sql = "SELECT * FROM ".$xoopsDB->prefix('her_style');
   $sqlquery = $xoopsDB->query ($sql);  
   $t = array();
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      /*      
      //suppression des futurs orphelins (snif!)     
      $sql = "DELETE tDeco.*,tPP.* FROM "
            .$xoopsDB->prefix('her_deco').' as tDeco,'
            .$xoopsDB->prefix('her_decopp').' AS tPP '      
            ." WHERE tPP.idDeco = tDeco.idDeco"            
            ."   AND tDeco.name = '{$sqlfetch['nom']}'";
      $xoopsDB->query($sql);	
      */      
      
      //suppression de l'enregistrement parent s'il existe encore (le vilain))
      $sql = "DELETE FROM ".$xoopsDB->prefix('her_deco')
            ." WHERE name = '{$sqlfetch['nom']}'";
      $xoopsDB->query($sql);	

 
      $sql = "DELETE tPP.* FROM ".$xoopsDB->prefix('her_decopp').' AS tPP'
            ." LEFT JOIN ".$xoopsDB->prefix('her_deco').' as tDeco' 
            ." ON tPP.idDeco = tDeco.idDeco "     
            ." WHERE tDeco.idDeco IS NULL ";
      $xoopsDB->query($sql);	
   
  
       //----------------------------------------------------------   
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_deco')
            ." (name,decoModele)"
            ." VALUES ('{$sqlfetch['nom']}','hardtext')";   
      $xoopsDB->query($sql);	
      $newId = $xoopsDB->getInsertId() ;
      //===========================================================
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'content','{$sqlfetch['css']}')";  
      $xoopsDB->query($sql);            
      //----------------------------------------------------------
      $sql = "INSERT INTO ".$xoopsDB->prefix('her_decopp')
            ." (idDeco,property,value)"  
            ." VALUES ($newId,'type','css')";  
      $xoopsDB->query($sql);            

    }
    

  //--------------------------------------------------
  return true;   

}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function createDeco(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_deco');  
  
  $sql = "CREATE TABLE `{$table}` (
      `idDeco` bigint(20) NOT NULL auto_increment,
      `name` varchar(60) NOT NULL default '',
      `decoModele` varchar(60) NOT NULL default '',
      PRIMARY KEY  (`idDeco`)
      ) type = MyISAM ;";

  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable
/*************************************************************************
 *
 *************************************************************************/
function createDecopp(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_decopp');  
  
  $sql = "CREATE TABLE `{$table}` (
      `idDecopp` bigint(20) NOT NULL auto_increment,
      `idDeco` bigint(20) NOT NULL,     
      `property` varchar(60) NOT NULL default '',
      `value` varchar(255) NOT NULL default '',
      PRIMARY KEY  (`idDecopp`)
      ) type = MyISAM ;";

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
        ."  ADD `tplBody`   varchar(60) NOT NULL DEFAULT '',"
        ."  ADD `tplHeader` varchar(60) NOT NULL DEFAULT '',"        
        ."  ADD `tplFooter` varchar(60) NOT NULL DEFAULT '';";
  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable


/*************************************************************************
 *
 *************************************************************************/
function updateStructure(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_structure');  
  
  $sql = "ALTER TABLE {$table}"
        ."  ADD `blockSmarty` varchar(30) NOT NULL DEFAULT '';";
  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable

//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>


