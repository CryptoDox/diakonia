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

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_hermes_plugin.php");

class cls_test_Plugin_actu extends cls_hermes_plugin{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $moduleName   = 'testPlugin';
  var $version      = '1.01.08';  
  var $identifiant  = 140;  //Attention ce numero doit etre unique pour chaque plugin
  
  var $name         = '';
  var $description  = '';

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_test_Plugin_actu($options){
 
     if (is_readable($options['lang'])) include_once($options['lang']);
    $this->name         = _TESTPLUGIN_NEWACTU;
    $this->description  = _TESTPLUGIN_NEWACTU_DSC;
     
     return $this->isOk();
  }
  

/************************************************************
 * test l'existance du moduleau quel se refer le plugin:
 ************************************************************/
  
  function isOk(){

    $f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
        .'/modules/'.$this->moduleName.'/xoops_version.php';
    
    //plugin de test le retout est force a vrai 
    //return is_readable($f);
    return true;
      
  }
  




/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------

  $params = array ('periode' => array('name'        => _AD_HER_NB_MOIS,
                                      'value'       =>  2, 
                                      'description' => _AD_HER_NB_MOIS_LOOKKFOR,
                                      'type' =>   1, 
                                      'min'  =>   0,
                                      'max'  =>  12),
                   'maxItem' => array('name'        => _AD_HER_MAXITEM, 
                                      'value'       => 15, 
                                      'description' => _AD_HER_MAXITEM_DSC,
                                      'type' =>   1, 
                                      'min'  =>   0,
                                      'max'  =>  99),
                   'message' => array('name'        => _AD_HER_MESSAGE, 
                                      'value'       => 15, 
                                      'description' => ''),
                                      
                    );
                  
                 
  //-------------------------------------------------------------
  cls_hermes_plugin::getInfoPluggin($tProperty, $params);
    return $this->isOk();                  
  
}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){

  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  $tProperty['version'] = 1;  
  $tProperty['header'] = "Derniers lexiques";
  $tProperty['footer'] = 'Créer par JJD';  
  
    
  $colName = array (_TESTPLUGIN_SUBJECT,
                    _TESTPLUGIN_ANNONCE,
                    _TESTPLUGIN_AUTHOR,
                    _TESTPLUGIN_DATECREATION,
                    _TESTPLUGIN_DATEMODIFICATION
                    );
  $tInfo = array();

  //---------------------------------------
  $link = "<A href='http://www.vieillescharrues.asso.fr/festival/index.php'>Festival des vieiells charues</A>";  
  $tInfo[] = array($colName[0] => 'Manifestation', 
                   $colName[1] => $link,
                   $colName[2] => 'Jean némard',
                   $colName[3] => '15/01/2007',
                   $colName[4] => '10/02/2007');
                  

  $link = "<A href='http://wakasensei.fr'>Création d'un nouveau Site : http://wakasensei.fr</A>";                  
  $tInfo[] = array($colName[0] => 'Nouveauté', 
                   $colName[1] => $link,
                   $colName[2] => 'Jean-JAcques DELALANDRE',
                   $colName[3] => '16/09/2006',
                   $colName[4] => '16/04/2007');
                  
  return count($tInfo);
  
}
/*************************************************************************
 *permet de flaguer les enregistrement déjà utiliser dans les lettres de diffusion
 *************************************************************************/
function flagLastInfo($mode = 2,$oldValue = 0, $newValue = 1){
	global $xoopsModuleConfig, $xoopsDB;


   switch ($mode){
   case 0:
      //to do
      break;
      
   case 2:
      //to do
      break;
      
   case 3:
      //to do
      break;
      
   default:
      //to do   
   }
    
  //------------------------------------------- 
  return 0;   
   
}//fin flagLastInfo

} // fin de la classe

?>
