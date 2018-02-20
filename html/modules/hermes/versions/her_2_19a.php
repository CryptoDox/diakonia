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


class cls_her_2_19a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '2.19a';  
  var $dateVersion  = "2008-03-18 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "Misà jour : Libelle,Archive,Cession,FluxRss,Lettre,Params,Plugin,Structure,Style,Texte,Users";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_her_2_19a($options){
 
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


    $this->createLibelle();    
    
    $this->updateArchive();    
    $this->updateCession();    
    $this->updateFluxRss();    
    $this->updateLettre();
    $this->updateParams();
    $this->updatePlugin();
    $this->updateStructure();
    $this->updateStyle();    
    $this->updateTexte();
    $this->updateUsers();

    $this->maj_groupesOfLettre();
            
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
        ." ADD `avertissement` LONGTEXT NOT NULL, "
        ." ADD `emailSender` VARCHAR(60) NOT NULL, "
        ." ADD idLettreConfirmation bigint(20) NOT NULL DEFAULT '0',"
        ." ADD typeLettre TINYINT(2) NOT NULL DEFAULT '0'," 
        ." ADD `send2Author` TINYINT(1) NOT NULL DEFAULT '0',"
        ." ADD `groupes` VARCHAR( 80 ) NOT NULL ;";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin updateContentTable
/*************************************************************************
 *
 *************************************************************************/
function updateCession(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_cession');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `emailSender` VARCHAR(60) NOT NULL"
        ." ADD `listeComplementaire2` LONGTEXT NOT NULL ;";
  
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
        ." ADD `idStructure` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST,"
        ." ADD `params` VARCHAR( 255 ) NOT NULL ; ";

  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable


/*************************************************************************
 *
 *************************************************************************/
function updateParams(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_params');  
  
  $sql = "ALTER TABLE {$table}"
        ." CHANGE `valeur` `valeur` VARCHAR(512) NOT NULL ; ";
 
  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin 








/*************************************************************************
 *
 *************************************************************************/
function updateArchive(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_archive');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `groupes` VARCHAR( 80 ) NOT NULL ; ";

  $xoopsDB->queryF ($sql);  
  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable
/*************************************************************************
 *
 *************************************************************************/
function updateStyle(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_style');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `typeBalise` TINYINT(2) NOT NULL DEFAULT '0' ;";
  
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
        ." CHANGE `nom` `nom` VARCHAR( 80 ) NOT NULL,"
        ." ADD `categorie` VARCHAR(60) NOT NULL ;";
 
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable


/*************************************************************************
 *
 *************************************************************************/
function updateFluxRss(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_fluxrss');  
  
  $sql = "ALTER TABLE {$table}"
        ." CHANGE `affichage` `colonnes` VARCHAR( 255 ) NOT NULL ;";
 
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable


/*************************************************************************
 *
 *************************************************************************/
function updateUsers(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_users');  
  //--------------------------------------------------  
  $sql = "ALTER TABLE {$table}"  
        ." DROP PRIMARY KEY ";  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  $sql = "ALTER TABLE {$table}"
        ." ADD `idUsers` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST,"  
        ." ADD `email` VARCHAR(60) NOT NULL, "
        ." ADD `dateMaj` DATETIME NOT NULL ;";
 
  $xoopsDB->queryF ($sql);  
  
  //--------------------------------------------------  
  return true;   

}//fin updateContentTable


/*************************************************************************
 *
 *************************************************************************/
function updatePlugin(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_plugin');  
  
  $sql = "ALTER TABLE {$table}"
        ." ADD `template` VARCHAR(250) NOT NULL ,"
        ." CHANGE `state` `state` TINYINT(1) UNSIGNED NULL DEFAULT '0',"
        ." CHANGE `flag`  `flag`  TINYINT(1) UNSIGNED NULL DEFAULT '0',"
        ." CHANGE `affichage` `affichage` TINYINT(1) UNSIGNED NULL DEFAULT '255' ;";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  //--------------------------------------------------  
  
  return true;   
   
}//fin updateContentTable

/*************************************************************************
 *
 *************************************************************************/
function createLibelle(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('her_libelle');  
  
  $sql = "CREATE TABLE {$table} (
          `idLibelle` BIGINT( 20 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
          `code` VARCHAR( 60 ) NOT NULL ,
          `constant` VARCHAR( 30 ) NOT NULL ,          
          `texte` VARCHAR( 255 ) NOT NULL ,
          `allowUpdate` TINYINT(2) NOT NULL DEFAULT '1', 
          `perso` TINYINT(2) NOT NULL DEFAULT '0',  
          `locked` TINYINT(2) NOT NULL DEFAULT '0',                  
          UNIQUE (`code`)
          ) ENGINE=MyISAM; ;";
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  

$sql = "
INSERT INTO `{$table}` (`code`, `constant`, `texte`, `allowUpdate`, `perso`, `locked`) VALUES 
('_souscribe.revokeAllLetters', 'REVOKE_ALL_LETTERS', 'Résiliez l''abonnement à toutes les lettres de ce site.', 0, 1, 0),
('_souscribe.revokeThisLetter', 'REVOKE_THIS_LETTER', 'Confirmez la résiliation à cette lettre d''information du site', 0, 1, 0),
('_souscribe.confirmRevokeAllLetters', 'REVOKE_ALL_LETTERS_CONF', 'Résiliez l''abonnement à toutes les lettres de ce site. Une lettre de confirmation vous sera envoyée.', 0, 1, 0),
('_souscribe.confirmRevokeThisLetter', 'REVOKE_THIS_LETTER_CONF', 'Si vous ne souhaitez plus recevoir cette lettre d''information du site. Une lettre de confirmation vous sera envoyée', 0, 1, 0),
('_souscribe.subscribeThisLetter', 'SUBSCRIBE_THIS_LETTER', 'Souscrire à cette lettre.', 0, 1, 0),
('_souscribe.revokeAllLettersConfirmed', 'CONFREVOKE_ALL_LETTERS', 'Résiliez toutes les lettres de diffusion de ce site', 0, 1, 0),
('_souscribe.revokeThisLetterConfirmed', 'CONFREVOKE_THIS_LETTER', 'Confirmez la résiliation de cette lettre.', 0, 1, 0),
('urlArchiveLink', 'ARCHIVE', 'Archive', 1, 1, 0),
('adresse', '', '13 rue des Lilas\r\nTrifouillis les oies', 1, 0, 0),
('Copy Right', '', 'Copy Right : Jean-Jacques DELALANDRE - juin 2007', 1, 0, 1),
('Hermes', '', 'Lettre réalisée avec le module HERMES pour XOOPS', 0, 0, 1);
";


  $xoopsDB->queryF ($sql); 
  //--------------------------------------------------  


  
  return true;   


   
}//fin 


/*************************************************************************
 *
 *************************************************************************/
function maj_groupesOfLettre(){
global $xoopsModuleConfig, $xoopsDB;

  $sql = "SELECT idLettre FROM ".$xoopsDB->prefix('her_lettre');
  $sqlquery = $xoopsDB->query ($sql);  
  
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idLettre = $sqlfetch ['idLettre'];
      $g = "0," . $this->getGroupeOfLettre($idLettre) . ",0";
      //echo "<hr>maj_groupesOfLettre {$idLettre} -> {$g}<hr>";
      $sql = "UPDATE ".$xoopsDB->prefix('her_lettre')
            ." SET groupes = '{$g}'"
            ." WHERE idLettre = {$idLettre}";
      $xoopsDB->queryF ($sql);
      
      $sql = "UPDATE ".$xoopsDB->prefix('her_archive')
            ." SET groupes = '{$g}'"
            ." WHERE idLettre = {$idLettre}";
      $xoopsDB->queryF ($sql);
            
      
    }



}
/*************************************************************************
 *
 *************************************************************************/

 function getGroupeOfLettre($idLettre){
	global $xoopsModuleConfig, $xoopsDB;
	   
    $sql = "SELECT idGroupe FROM ".$xoopsDB->prefix('her_groupe')
          ." WHERE idLettre = {$idLettre}";
     
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
   $sqlquery = $xoopsDB->query ($sql);  
   $t = array();
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $t[] = $sqlfetch ['idGroupe'];
    }
    

    return implode(',',$t);
                
      
 }

//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>
