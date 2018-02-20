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


class cls_her_2_09{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.09';  
  var $dateVersion  = '2008-01-30 12:12:12'; //date("Y-m-d h:m:s");
  var $description  = 'creation des tables cession, temp, ...';

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_09($options){
 
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
    $this->updateContentTables();    
                  
    return true;
} // fin updtateModule

/*************************************************************************
 *
 *************************************************************************/
function createNewTables(){
global $xoopsModuleConfig, $xoopsDB;
  
  //---------------------------------------------------

  $sql = "
CREATE TABLE ".$xoopsDB->prefix('her_cession')." (  
  `idCession` bigint(20) NOT NULL auto_increment,
  `idLettre` bigint(20) default NULL,
  `idArchive` bigint(20) default NULL,
  `fullNameArchive` varchar(255) default NULL,
  `libelle` varchar(255) default NULL,
  `personnalisable` tinyint(3) unsigned default NULL,
  `nbDestinataire` int(10) unsigned default NULL,
  `lot` int(10) unsigned default '3',
  `listeComplementaire` longtext,
  `countListeComplementaire` int(10) unsigned default '0',
  PRIMARY KEY  (`idCession`)
) ENGINE=MyISAM ;";

  $xoopsDB->queryF ($sql);
  //---------------------------------------------------

  $sql = "
CREATE TABLE ".$xoopsDB->prefix('her_temp')." (
  `idTemp` bigint(20) NOT NULL auto_increment,
  `idCession` bigint(20) default NULL,
  `idUser` bigint(20) default NULL,
  `name` varchar(50) default NULL,
  `pseudo` varchar(50) default NULL,
  `email` varchar(60) default NULL,
  `format` int(10) unsigned default NULL,
  `flag` int(10) unsigned default NULL,
  PRIMARY KEY  (`idTemp`),
  UNIQUE KEY `email` (`idCession`,`email`)  
) ENGINE=MyISAM; ;";

  $xoopsDB->queryF ($sql);  
  
  //---------------------------------------------------  
  
  return true;   

   
} // fin createNewTables

/*************************************************************************
 *
 *************************************************************************/
function updateContentTables(){
global $xoopsModuleConfig, $xoopsDB;

/*

  $dateVersion= date("Y-m-d h:m:s");

  $sql = "INSERT INTO ".$xoopsDB->prefix('her_version')
       ."(code,version,dateVersion,libelle)"
        ." VALUES ("
        ."'her_2.09.php','2.09','{$dateVersion}','Cr�ation de la table version'"
        .")";  
  $xoopsDB->queryF ($sql);
*/    
  //------------------------------------------- 
  return true;   
   
}//fin updateContentTable
//-----------------------------------------------------------

} // fin de la classe

?>
