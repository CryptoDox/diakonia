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

class cls_mylinks extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_mylinks($options){
 
  cls_hermes_plugin::cls_hermes_plugin($options);
    
  $options = array ('moduleName'  => 'mylinks',
                    'version'     => '1.02.01',
                    'pluginName'  => 'My Links',
                    'description' => '',
                    'header'      => '',
                    'footer'      => "'"._MYLINK_ALL_LINKS."</a>",
                    'identifiant' => 150);                                              
    
    
    
  $tColDef = array (array('ordreTitle',       _AD_HER_TITLE),
                    array('ordreTime',        _MYLINK_TIME),
                    array('ordreHits',        _MYLINK_HITS));

  $this->init($options, $tColDef);                                              
  return $this->isOk();

  }
  

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------
  //------------------------------------------------------------         

  $params = array ();
                  
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);
    return $this->isOk();
}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){

  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  //----------------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = 'Liste des derniers liens soumis';
  $tProperty['footer'] = 'Liens web';  
    
  $colName = array ('title','time','hits');
  $tInfo = array();

  //---------------------------------------
                  

//********************************************************
$n_lien = 15;

	global $xoopsModuleConfig, $xoopsDB;
 
   $sql = "SELECT lid, cid, title, date, hits FROM ".$xoopsDB->prefix("mylinks_links")
         ." WHERE status > 0 ORDER BY lid desc";

    $result = $xoopsDB->queryF($sql, $n_lien, 0);
    $col = $this->setShowOrder($params);
 
    //-------------------------------------------------------
    //while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    while(list($lid, $cat_id, $title, $time, $hits)=$xoopsDB->fetchRow($result)) {

      $link = XOOPS_URL."/modules/mylinks/singlelink.php?lid=".$lid;
      $href = "<A href={$link} target=blank>{$title}</A>";      
      $rupture = 0;
      //----------------------------------------------------
      $tt = array_merge($col);
      //echo "<hr>";
      //displayArray2($tt, "----- avant -----");      
      //----------------------------------------------------      
      
      //$tt = array($col);
      //displayArray($tt, "----- setOrder -----");      
                                              
      $tt['ordreTitle']['value']        = $href;
      $tt['ordreTime']['value']         = $time;
      $tt['ordreHits']['value']         = $hits;
      //------------------------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      

      //---------------------------------------------------------------
      $tInfo[] = $tt;   
      //**************************************************************   
                  

   }
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
//-----------------------------------------------------------

} // fin de la classe

?>
