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


class cls_her_2_14a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.14a';  
  var $dateVersion  = "2008-01-25 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = 'Ajout de la table fluxrss';

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_14a($options){
 
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
    
    $this->createTable_FluxRss();

    return true;
} // fin updtateModule

/*************************************************************************
 *
 *************************************************************************/
function createTable_FluxRss(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_fluxrss');
  
  
   $sql = "
CREATE TABLE {$table} (  
  `idFluxrss` bigint(20) NOT NULL auto_increment,
  `nom` varchar(50) default NULL,
  `url` varchar(255) default NULL,
  `description` varchar(255) default NULL, 
  `affichage` varchar(255) default NULL, 
  `max` int(10) unsigned default NULL,  
  `options` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`idFluxrss`)
) ENGINE=MyISAM; ;";

  $xoopsDB->queryF ($sql);
  //-------------------------------------------  
   $sql = "
  INSERT INTO {$table} (nom, url, description, affichage, max, options) 
  VALUES 
  ('Documentation Fr','http://www.ladocumentationfrancaise.fr/catalogue/rss/droit-institutions.xml', 'Documentation francaise', 'title,author,description,pubDate', 15, 2),
  ('Conv. collectives','http://www.ladocumentationfrancaise.fr/catalogue/rss/conventions-collectives.xml', 'Conventions collectves', 'title', 12, 1),  
  ('Xul', 'http://www.xul.fr/rss/rss.xml', 'Xul', 'title,author,description,pubDate', 0,1);";
  $xoopsDB->queryF ($sql);  
  


  //------------------------------------------- 
  return true;   
   
}//fin createTable_FluxRss
//-----------------------------------------------------------

//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>
