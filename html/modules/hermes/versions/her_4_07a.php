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

class cls_her_4_07a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '4.07a';  
  var $dateVersion  = "2008-09-25 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Ajout des souscriptions";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_4_07a($options){
 
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

    $this->create_souscription();
    $this->alter_archive();
    //$this->alter_lecture();
    
    return true;

} // fin updtateModule



/*************************************************************************
 *
 *************************************************************************/

function create_souscription(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_souscription');  

  $sql = "CREATE TABLE `{$table}` (
          `idSouscription` bigint(20) NOT NULL default '0',
          `email` varchar(60) NOT NULL,
          `name` varchar(60) NOT NULL,
          PRIMARY KEY  (`idSouscription`),
          UNIQUE KEY `email` (`email`)
      ) type = MyISAM ;";

  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  updateDecorations();
  //--------------------------------------------------  
  
  return true;   

}//fin 


/*************************************************************************
 *
 *************************************************************************/
function alter_archive(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_archive');  
  
  $sql = "ALTER TABLE {$table} "
        ."ADD `cliques` INT NOT NULL DEFAULT '0';";
  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 


/*************************************************************************
 *
 *************************************************************************/
function alter_lecture(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_lecture');  
  
  $sql = "ALTER TABLE {$table} "
        ."DROP PRIMARY KEY ;";
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  $sql = "ALTER TABLE {$table} "
        ."ADD PRIMARY KEY ( `idLettre` , `idArchive` , `email` );";
  $xoopsDB->queryF ($sql);  
  
echo "<hr>{$sql}<hr>";  
  
  
  
  
  return true;   
   
}//fin 



//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>


