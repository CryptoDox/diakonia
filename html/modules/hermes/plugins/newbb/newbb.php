<?php

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_hermes_plugin.php");

class cls_newbb extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_newbb($options){
 
  cls_hermes_plugin::cls_hermes_plugin($options);
    
  $options = array ('moduleName'  => 'newbb',
                    'version'     => '1.02',
                    'pluginName'  => 'Forum',
                    'description' => '',
                    'header'      => '',
                    'footer'      => "'"._NEWBB_PLUGIN_DESC."</a>",
                    'identifiant' => 151);                                              
    
    
    
  $tColDef = array (array('ordreTitle',       _AD_HER_TITLE),
                    array('ordreTime',        _NEWBB_TIME),
                    array('ordreHits',        _NEWBB_HITS));

  $this->init($options, $tColDef);                                              
  return $this->isOk();

  }
  

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------
  //periode correspon au nombre de mois maximum de recherche des annonces
  //$params = array ('periode' => 2,
  //                 'maxItem' => 15);
                   
  $params = array ('messageSource' => array('name'  => _NEWBB_SOURCE, 
                                     'value'        => 0, 
                                     'description'  => _NEWBB_SOURCE_DSC,
                                     'type'         => 2,
                                     'list'         => _NEWBB_SOURCE_LIST)
                    );
  //-------------------------------------------------------------
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);
    return $this->isOk();                  
}


/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;

  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  //----------------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = 'Liste des sujets populaires';
  $tProperty['footer'] = "";  
    
  $colName = '';
  $tInfo = array();

  //---------------------------------------
                  

//********************************************************
$n_lien = (($params['maxItem'] > 0) ? $params['maxItem'] : 15) ;

 	$time = time()-(60*60*24*(30*$params['periode'])*2);
   
   $cols = array('topic_time','topic_views','topic_replies');
   $colOrder = $cols[$params['messageSource']];


   //$sql = "SELECT topic_id, topic_title, topic_views, date_format(topic_time,'"._AD_HER_DATE_FORMAT_SQL_VIEW."')"

   $sql = "SELECT topic_id, topic_title, topic_views, topic_time "
         ." FROM ".$xoopsDB->prefix('bb_topics')
         ." WHERE approved > 0 AND topic_time>{$time} ORDER BY {$colOrder} DESC";

    $result = $xoopsDB->queryF($sql, $n_lien, 0);
    $col = $this->setShowOrder($params);
 
    //-------------------------------------------------------
    //while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    while(list($topic_id, $topic_title, $topic_views, $topic_time)=$xoopsDB->fetchRow($result)) {
		
      $link = XOOPS_URL."/modules/newbb/viewtopic.php?topic_id=".$topic_id;
      $href = "<A href={$link} target=blank>{$topic_title}</A>";   
echo $href;	  
      $rupture = 0;
      //----------------------------------------------------
      $tt = array_merge($col);
      //echo "<hr>";
      //displayArray2($tt, "----- avant -----");      
      //----------------------------------------------------      
      
      //$tt = array($col);
      //displayArray($tt, "----- setOrder -----");      
                                              
                                              
      $tt['ordreTitle']['value']        = $href;
      $tt['ordreTime']['value']         = $datePub = date(_NEWBB_FORMAT_DATE,$topic_time);
      $tt['ordreHits']['value']         = $topic_views;
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
