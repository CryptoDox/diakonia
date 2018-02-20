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


class cls_test_plugin_annonces extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/


/************************************************************
 * Constructucteur:
 ************************************************************/
 function cls_test_plugin_annonces($options){

  cls_hermes_plugin::cls_hermes_plugin($options);
    
  $options = array ('moduleName'  => 'testPlugin',
                    'version'     => '1.02.01',
                    'pluginName'  => _TESTPLUGIN_NEWANNONCE,
                    'description' => _TESTPLUGIN_NEWANNONCE_DSC,
                    'header'      => '',
                    'footer'      => "",
                    'identifiant' => 170);                                              
    
    
    
  $tColDef = array (array('ordreSujet',            _TESTPLUGIN_SUBJECT),
                    array('ordreDescription',      _TESTPLUGIN_DESCRIPTION),
                    array('ordreAnnonce',          _TESTPLUGIN_ANNONCE) ,
                    array('ordreDateModification', _TESTPLUGIN_DATEMODIFICATION));

  $this->init($options, $tColDef);                                              
  return $this->isOk();


}
  
 
/*************************************************************************
 *
 *************************************************************************/
function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------
  //tes de passage de paraletrte a l'appli pour recupe dans le taitement

  $params = array ('lastAnnonces' => array('name'        => _TESTPLUGIN_LASTTANNNCES, 
                                      'value'       => 15, 
                                      'description' => '',
                                      'type' =>   1, 
                                      'min'  =>   0,
                                      'max'  =>  99),
                   'message' => array('name'        => _TESTPLUGIN_AUTHOR, 
                                      'value'       => 'JÝJÝD', 
                                      'description' => ''),
                                      
                    );
                
  //-------------------------------------------------------------
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);
    return $this->isOk();                  

}

/************************************************************
 * t:
 ************************************************************/
  
  function getIni(){
    //dirname(__FILE__)
    $f = $_SERVER['SCRIPT_FILENAME'];
    $f = __FILE__;    
    $f = substr($f, 0, -3).'ini';
    
   //echo "<hr>{$f}<hr>";    
    if (!is_readable($f)){
      //le fichier ini n'existe pas return faux , 
      //alors retur du nom original
      return array();
    }
    
    $ini = parse_ini_file($f, true); 
    
    
    

   $tInfo  = array(); 
   while (list($section, $enr) = each ($ini) ){
     $t = array();
      //hile (list($key, $item) = each ($enr) ){   
        $t[_TESTPLUGIN_SUBJECT]          = $enr['SUBJECT'];     
        $t[_TESTPLUGIN_DESCRIPTION]      = $enr['DESCRIPTION'];        
        $t[_TESTPLUGIN_ANNONCE]          = $enr['ANNONCE'];     
        $t[_TESTPLUGIN_DATEMODIFICATION] = $enr['DATEMODIFICATION'];        
        // echo "{$enr['SUBJECT']}<br>{$enr['DESCRIPTION']}<br>{$enr['ANNONCE']}<br>{$enr['DATEMODIFICATION']}<hr>";
      //}
  
      $tInfo[] = $t;   
           
   }

    return $tInfo;
    
  
  }

/*************************************************************************
 *

 function loadDataFromIni($colName){
   $ini = getIni();
   
   $t = array();
   while (list($section, $enr) = each ($ini) ){
      $t[] = $enr;     
   }
   return $t;
 }
 *************************************************************************/ 


/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
  if (!$this->isOk()) return 0;
 
  $this->getProperty($tProperty);
  $tProperty['header'] = 'lastAnnonces';
  $tProperty['footer'] = 'Author';  
  
  //recupe des variables du plugin modifié par l'appli (form des plugins)
  //elle ne sont pas utilise par le test por le moment
  $colName = '';
  

  //---------------------------------------                    
  $tInfo  = $this->getIni(); 
  
  //---------------------------------------
  /*
  $tInfo = array();
  $tInfo[] = array($colName[0] => 'achats ventes', 
                   $colName[1] => "Voitures d'ocasion",
                   $colName[2] => 'traction avant',
                   $colName[3] => '10/03/2007');
                  
                  
  $tInfo[] = array($colName[0] => 'achats ventes', 
                   $colName[1] => 'Voitures de socité',
                   $colName[2] => 'simca 1000',
                   $colName[3] => '15/01/2007');
                  
  $tInfo[] = array($colName[0] => 'achats ventes', 
                   $colName[1] => 'voitures de collection',
                   $colName[2] => 'Deudion bouton',
                   $colName[3] => '08/08/2007');
                   
                   
 
 $nb= count($tInfo) ; 
                 
 echo "<hr>".$this->Name." - nbenr = {$nb}<hr>"   ;    
  */ 
 
          
  return count($tInfo);
  
}//fin fonction


/*************************************************************************
 *
 *************************************************************************/
function getLastInfoHTML(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){

  if (!$this->isOk()) return 0;
  
  $tProperty['version'] = 1;  
  $tProperty['header'] = $params['lastAnnonces'];
  $tProperty['footer'] = $params['Author'];  
  
    
  $colName = array (_TESTPLUGIN_SUBJECT, 
                    _TESTPLUGIN_DESCRIPTION, 
                    _TESTPLUGIN_ANNONCE, 
                    _TESTPLUGIN_DATEMODIFICATION);
  $t = array();
  
  $t[] = "<table border='1' cellspacing='1' margin='1'>";
  $t[] = "<tr>";  
  $t[] = "<td colspan='4'><font color=red><b>{$TitlePluggin}</b></font></td>";  
  $t[] = "</tr>";  
  //---------------------------------------
  $t[] = "<tr>";  
  $t[] = '<td><b>'._TESTPLUGIN_SUBJECT.'</b></td>'; 
  $t[] = '<td><b>'._TESTPLUGIN_DESCRIPTION.'</b></td>';
  $t[] = '<td><b>'._TESTPLUGIN_ANNONCE.'</b></td>';
  $t[] = '<td><b>'._TESTPLUGIN_DATEMODIFICATION.'</b></td>';
  $t[] = "</b></tr>";   
  
  //---------------------------------------  
  $tInfo  = $this->getIni(); 
   while (list($section, $enr) = each ($tInfo) ){
      $t[] = "<tr>";  
       
      while (list($key, $item) = each ($enr) ){   
        $t[] = "<td>$item</td>";      
      }
  
      $t[] = "</tr>";   
           
   }
   
   
  $t[] = "</table>";                  
  
  $tInfo = implode('', $t);
  return count($t);
  
}//fin fonction
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


} //fin de la classe

?>
