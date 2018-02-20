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

class cls_news extends cls_hermes_plugin {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/


/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_news($options){
 
    cls_hermes_plugin::cls_hermes_plugin($options);
    
  $options = array ('moduleName'  => 'news',
                    'version'     => '1.02.01',
                    'pluginName'  => _NEWS_NAME,
                    'description' => _NEWS_MODULE_DSC,
                    'header'      => _NEWS_HEADER,
                    'footer'      => "<a href='".XOOPS_URL."/modules/news/article.php'>"._NEWS_ALL_NEWS."</a>",
                    'identifiant' => 120);                                              
    
    
    
  $tColDef = array (array('ordreTitle',           _NEWS_TITLE),
                    array('ordreHometext',        _AD_HER_SCOOP),
                    array('ordreAuthor',          _NEWS_AUTHOR),
                    array('ordreCategorie',       _NEWS_CATEGORIE) ,
                    array('ordreDatePublication', _NEWS_DATEPUBLISHED));

     
  $this->init($options, $tColDef);                                              
  return $this->isOk();


    
  }
  


/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  


  //------------------------------------------------------------
  $params = array ('ruptureMaitre' => array('name'  => _AD_HER_ORDREDETRI, 
                                      'value'       => 1, 
                                      'description' => _NEWS_AFFICHAGE_DESC,
                                      'type'        => 2,
                                      'list'        => _NEWS_AFFICHAGE_LIST)
                    );

  //   displayArray($this->tColDef,"***** this->tColDef *****");
  //-------------------------------------------------------------
  cls_hermes_plugin::buildInfoPluggin($tProperty, $params, $this->tColDef);


  //$this->getRstItemGen($params);  
  return $this->isOk();                  

                
}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;
//displayArray($params,"----- getLastInfo -----");
  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  $this->getProperty($tProperty);
  $colName = '';
  
    
   $myts =& MyTextSanitizer::getInstance();

    $this->getRecordSet($params, $rst);  
    $col = $this->setShowOrder($params);    
    
    //displayArray2($col, "----- setOrder -----");   
  //---------------------------------------
  //displayArray($tInfo[0],"----- getLastInfo -----");
  //displayArray($params,"----- getLastInfo -----"); 
  //------------------------------------------- 
  $tInfo = array();
  while (list ($key, $item) = each ($rst)) {
      $h = 0;   
      
      if ($params['ruptureMaitre'] == 1){
        $order   = 0;
        $rupture = $item['topicid'];
        //echo "<hr>sujet : {$item['topicid']}<hr>";
      }else{
        $order   = $params['ordreCategorie'];  
        $rupture = 0 ;          
      }
      
    
      //----------------------------------------------------
      $tt = array_merge($col);
      //echo "<hr>";
      //displayArray2($tt, "----- avant -----");      
      //----------------------------------------------------      
      
      //$tt = array($col);
      //displayArray($tt, "----- setOrder -----");      
                                              
      $tt['ordreTitle']['value']            = $item['linkNew'];
      $tt['ordreHometext']['value']         = $item['hometext'];
      $tt['ordreAuthor']['value']           = $item['author'];
      $tt['ordreCategorie']['value']        = $item['linkTopic'];
      $tt['ordreDatePublication']['value']  = $item['datePublication'];
      //------------------------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "<b><font size='{$params['catSize']}'>{$item['linkTopic']}</font></b>";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      

      //---------------------------------------------------------------
      $tInfo[] = $tt;   
      //**************************************************************   

  
   }
   //displayArray2($tt, "----- setOrder -----");   
  //-------------------------------------------  
  return count($tInfo);
   
}





/******************************************************
 *
 ******************************************************/

function getRecordSet(&$params, &$tInfo){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;

  //----------------------------------------------
  
  $colName = array ();  

$myts =& MyTextSanitizer::getInstance();
//displayArray($params, '***** getRecordSet - params *****');
  
  //---------------------------------------
    if ($params[_HER_LIST_ID_ITEM] <> '' and $params[_HER_LIST_ID_CAT] <> ''){
      $filter = "  (itm.storyid IN ({$params[_HER_LIST_ID_ITEM]}) OR  itm.topicid IN ({$params[_HER_LIST_ID_CAT]}) )";
    
    }else if ($params[_HER_LIST_ID_ITEM] <> '' ){
      $filter = "  itm.storyid IN ({$params[_HER_LIST_ID_ITEM]}) ";

    }else if ($params[_HER_LIST_ID_CAT] <> '' ){
      $filter = "  itm.topicid IN ({$params[_HER_LIST_ID_CAT]}) ";

    
    }else{
      $ts = dateAdd(time() , 0, -$params['periode'], 0, true, true);
      $filter = "  itm.published >= '{$ts}'";   
    }
  
  
    $sql = "SELECT storyid, topicid, uid, title, hometext,published, if(bodytext<>'', true, false) AS suite, published from "
           .$xoopsDB->prefix("stories").' AS itm '
           .' WHERE '.$filter
           ." ORDER BY "
           .(($params['ruptureMaitre'] == 1) ? 'topicid,' : '')
           ."published DESC";   

    //echo "<hr>getRecordSet<br>{$sql}<hr>";
    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $numnews = $xoopsDB->getRowsNum($sqlquery);
    //-------------------------------------------------------
    $tInfo = array();   
      
   //while (list($nsid, $catid, $naid, $ntitle, $published) = mysql_fetch_array($sqlquery)) {
   while ($sqlFetch = $xoopsDB->fetchArray($sqlquery)) {
      
      $ntitle = $myts->makeTareaData4Show($sqlFetch['title']);  
      $sqlFetch['linkNew'] = "<a href='".XOOPS_URL."/modules/news/article.php?storyid={$sqlFetch['storyid']}'>{$ntitle}</a>";
      
      

      $link = ((!$sqlFetch['suite']) ? '' 
               : "<a href='".XOOPS_URL."/modules/news/article.php?storyid={$sqlFetch['storyid']}'>"._AD_HER_READNEXT."</a>");
      $sqlFetch['hometext'] = $myts->makeTareaData4Show($sqlFetch['hometext']) 
                             .$link;           
      
      //--------------------------------------------------------------
        
      $sql = "SELECT topic_id,topic_title from ".$xoopsDB->prefix("topics")
            ." where topic_id={$sqlFetch['topicid']}";        
      $result = $xoopsDB->queryF($sql);
      list($topic_id, $ntopictext) = mysql_fetch_array($result);
      $sqlFetch['linkTopic'] = "<a href='".XOOPS_URL."/modules/news/index.php?storytopic={$topic_id}'>{$ntopictext}</a>";      
      //--------------------------------------------------------------      
      $sql = "SELECT uname from ".$xoopsDB->prefix("users")
            ." where uid={$sqlFetch['uid']}";        
      $result = $xoopsDB->queryF($sql);
      list($author) = $xoopsDB->fetchRow($result);
      $sqlFetch['author'] =  $author;
      
      $datePub = date("d-m-y",$sqlFetch['published']);
      $sqlFetch['datePublication'] = $datePub ;      
      
      $tInfo[] = $sqlFetch;
   
   }
   //------------------------------------------------------------
   //---------------------------------------
  //displayArray($tInfo[0],"----- getRecordSet -----");
  //------------------------------------------- 

  
  return count($tInfo);   
}
/*********************************************************************
 *
 *********************************************************************/
function getRstCategorieGen($params){
global $xoopsDB;
  
  //echo "<hr>getRstItemGen<hr>";

  $this->catLstId     = ''; 
  $this->catTbl       = 'topics';
  $this->catColIdCat  = 'topic_id';
  $this->catColLib    = 'topic_title';

//displayArray ($params,"----- getRstItemGen - params -----");

 $sqlquery = $this->getCategorieGen();
  return $sqlquery;
}

/*********************************************************************
 *
 *********************************************************************/
function getRstItemGen($params){
global $xoopsDB;
  
  //echo "<hr>getRstItemGen<hr>";

  $this->catLstId     = ''; 
  $this->catTbl       = 'topics';
  $this->catColIdCat  = 'topic_id';
  $this->catColLib    = 'topic_title';

  $this->itemLstId      = '';
  $this->itemTbl        = 'stories';
  $this->itemColIdItem  = 'storyid';
  $this->itemColIdCat   = 'topicid';
  $this->itemColLib     = 'title';
  
  $this->itemColOrderDate = 'published';
  $this->periode          = $params['periode']['value'];  
  //$this->dateRef          = dateAdd(time() , 0, -$params['periode'], 0, true, true);;
  $this->maxItem          = $params['maxItem']['value'];

//displayArray ($params,"----- getRstItemGen - params -----");

 $sqlquery = $this->getItemGen();
  return $sqlquery;
}

//----------------------------------------------------------------------
} // fin de la classe

?>
