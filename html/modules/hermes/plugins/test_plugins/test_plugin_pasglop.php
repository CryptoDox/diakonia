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
include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_hermes_plugin.php");

class cls_test_plugin_pasglop extends cls_hermes_plugin{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/


/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_test_plugin_pasglop($options){
 
  cls_hermes_plugin::cls_hermes_plugin($options);
    
  $options = array ('moduleName'  => 'testPlugin',
                    'version'     => '1.02.01',
                    'pluginName'  => _TESTPLUGIN_PASGLOP,
                    'description' => _TESTPLUGIN_PASGLOP_DSC,
                    'header'      => '',
                    'footer'      => "",
                    'identifiant' => 180);                                              
    
    
    
  $tColDef = array (array('ordreSujet',            _TESTPLUGIN_SUBJECT),
                    array('ordreAnnonce',          _TESTPLUGIN_ANNONCE),
                    array('ordreAuthor',           _TESTPLUGIN_AUTHOR),
                    array('ordreDateCreation',     _TESTPLUGIN_DATECREATION) ,
                    array('ordreDateModification', _TESTPLUGIN_DATEMODIFICATION));

   
  $this->init($options, $tColDef);                                              
  return $this->isOk();


}
  

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------
  /*

  $params = array ('Age du capitaine' => 24,
                   'Sexe des anges'   => '???',
                   'pages'            =>  1954);
  */                 
  //-------------------------------------------------------------
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);
    return $this->isOk();                  
  
}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){

  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = "Derniers lexiques";
  $tProperty['footer'] = 'Cr�er par JJD';  
  

  $colName = '';


  $tInfo = array();
      $rupture = 0;
  //---------------------------------------
  $tt = array_merge($col);  
  $link = "<A href='http://www.vieillescharrues.asso.fr/festival/index.php'>Festival des vieiells charues</A>";  
      $tt['ordreSujet']['value']              = 'Manifestation';
      $tt['ordreAnnonce']['value']            = $link;
      $tt['ordreAuthor']['value']             = 'Jean n�mard';
      $tt['ordreDateCreation']['value']       = '15/01/2007';
      $tt['ordreDateModification']['value']   = '10/02/2007';
      //------------------------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      
      //---------------------------------------------------------------
      $tInfo[] = $tt;   
  
  //------------------------------------------------------------------                  
  $tt = array_merge($col);
  $link = "<A href='http://wakasensei.fr'>Cr�ation d'un nouveau Site : http://wakasensei.fr</A>";                  
      $tt['ordreSujet']['value']              = 'Nouveaut�';
      $tt['ordreAnnonce']['value']            = $link;
      $tt['ordreAuthor']['value']             = 'Jean-JAcques DELALANDRE';
      $tt['ordreDateCreation']['value']       = '16/09/2006';
      $tt['ordreDateModification']['value']   = '16/04/2007';
      //------------------------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      
      //---------------------------------------------------------------
      $tInfo[] = $tt;   
      //**************************************************************   
                  
  return count($tInfo);
  
}
/*************************************************************************
 *permet de flaguer les enregistrement d�j� utiliser dans les lettres de diffusion
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
