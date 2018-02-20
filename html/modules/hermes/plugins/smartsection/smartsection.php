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

class cls_smartsection extends cls_hermes_plugin  {  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
var $tColDef = array ();

/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_smartsection($options){
    cls_hermes_plugin::cls_hermes_plugin($options); 



  $options = array ('moduleName'  => 'smartsection',
                     'version'     => '1.01.01',
                     'pluginName'  => _SMARTS_NAME,
                     'description' => _SMARTS_PLUGIN_DESC,
                     'header'      => _SMARTS_HEADER,
                     'footer'      => _SMARTS_ALL_ARTICLES,
                     'identifiant' => 200);                                              

  $tColDef = array (array('ordreTitle',           _SMARTS_TITLE) ,
                          array('ordreSommaire',        _SMARTS_SUMMARY) ,
                          array('ordreDatePublication', _SMARTS_PUBLISHED) ,
                          array('ordreLecture',         _SMARTS_LECTURE) ,
                          array('ordreCatCreation',     _SMARTS_CATCREATED) ,                          
                          array('ordreCatLecture',      _SMARTS_CATLECTURE) ,                          
                          array('ordreCategorie',       _SMARTS_CATEGORIE));
        
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
                   
  $params = array ('ruptureMaitre' => array('name'        => _AD_HER_ORDREDETRI, 
                                      'value'       => 1, 
                                      'description' => _SMARTS_AFFICHAGE_DESC,
                                      'type'        => 2,
                                      'list'        => _SMARTS_AFFICHAGE_LIST),
                    'show_title' => array('name'    => 'show_title', 
                                      'value'       => 1, 
                                      'description' => _SMARTS_SHOWTITLE_DESC,
                                      'type'        => 2,
                                      'list'        => _AD_HER_NOYES),
                    'show_categorie' => array('name'=> 'show_categorie', 
                                      'value'       => 1, 
                                      'description' => _SMARTS_SHOWCATEGORIE_DESC,
                                      'type'        => 2,
                                      'list'        => _AD_HER_NOYES)
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
  $this->getProperty($tProperty);
  $colName = '';

  $nbEnr = $this->getRecordSet($params, $rst);
  $col = $this->setShowOrder($params);
    //-------------------------------------------------------
    $tInfo = array();   
    $idCat = 0 ;
   $ok=true;
    
   //while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
  while (list ($key, $item) = each ($rst)) {
      $h = 0;   
      
      if ($params['affichage']==1){
        $order   = 0;
        $rupture = $item['categoryid'];
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

      $tt['ordreTitle']['value']            = $item['linkArticle'];
      $tt['ordreSommaire']['value']         = $item['summary'];
      $tt['ordreDatePublication']['value']  = $item['datePublication'];
      $tt['ordreLecture']['value']          = $item['counter'];
      $tt['ordreCatCreation']['value']      = $item['dateCreation'];
      $tt['ordreCatLecture']['value']       = $item['total'];
      $tt['ordreCategorie']['value']        = $item['linkCategory'];
      //----------------------------------------------------
      $tt[_HER_CODE_RUPTURE]['value'] = "<b><font size='{$params['catSize']}'>{$item['linkCategory']}</font></b>";
      $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      


      //------------------------------------------------------------------      
      //$tInfo[] = array_filter($tt, "colOk");
      $tInfo[] = $tt;   
      //**************************************************************   

  
   }
   //------------------------------------------------------------
   
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  

   
}

/******************************************************
 *
 ******************************************************/

function getRecordSet(&$params, &$tInfo){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();

//displayArray($params,"----- getRecordSet -----");  
  $ts = dateAdd(time() , 0, -$params['periode'], 0, true, true);
  //$te = dateAdd(time() , 0, -$params['periode'], 0, true, true);  

  //---------------------------------------
  //echo   "<hr>getLastInfo<br>{$params[_HER_LIST_ID_ITEM] }<hr>";
  //if ($params[_HER_LIST_ID_ITEM] == '0')   $params[_HER_LIST_ID_ITEM] ='' ;
  //if ($params[_HER_LIST_ID_CAT] == '0')    $params[_HER_LIST_ID_CAT] ='' ;  
  
    if ($params[_HER_LIST_ID_ITEM] <> '' and $params[_HER_LIST_ID_CAT] <> ''){
      $filter = " AND (itm.itemid IN ({$params[_HER_LIST_ID_ITEM]}) OR  itm.categoryid IN ({$params[_HER_LIST_ID_CAT]}) )";
    
    }else if ($params[_HER_LIST_ID_ITEM] <> '' ){
      $filter = " AND itm.itemid IN ({$params[_HER_LIST_ID_ITEM]}) ";

    }else if ($params[_HER_LIST_ID_CAT] <> '' ){
      $filter = " AND itm.categoryid IN ({$params[_HER_LIST_ID_CAT]}) ";

    
    }else{
      $filter = " AND itm.datesub >= '{$ts}'" 
               ." AND itm.status = 2 ";   
    }
    
    $sql = "SELECT itm.itemid, itm.categoryid, itm.title, itm.summary,"
          ."itm.datesub, itm.status, itm.image, itm.counter,"
          ."cat.parentid, cat.name, cat.description,"
          ."cat.image as catImage, cat.total, cat.created"
          ." from ".$xoopsDB->prefix("smartsection_items")." AS itm ,"
                   .$xoopsDB->prefix("smartsection_categories")." AS cat "     
          ." WHERE itm.categoryid = cat.categoryid "    
          .$filter
          ." ORDER BY "
          .(($params['ruptureMaitre'] == 1) ? 'itm.categoryid,' : '' )
          ."itm.datesub, itm.title";   

    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    //echo "<hr>nbenr = {$nbEnr}<br>{$sql}<br>$ts<hr>";
    //-------------------------------------------------------
    $tInfo = array();   
    $idCat = 0 ;
    $ok=true;
    
   //complete les enregsitre pardesinfoc constuite, lien notamment  
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {

      //----------------------------------------------------
      //$sqlfetch['title'] = $myts->makeTareaData4Show($sqlfetch['title']); 

      $sqlfetch['datePublication'] = date("d-m-y h-m-s",$sqlfetch['datesub']); 
      $sqlfetch['dateCreation'] = date("d-m-y h-m-s",$sqlfetch['created']);     
      
      if ($sqlfetch['image'] <> '' & $sqlfetch['image'] <> 'blank.png'){
        $img = "<img alt=' ' src=\"".XOOPS_URL
              ."/uploads/smartsection/images/item/{$sqlfetch['image']}\"/>"; 
      }else{
        $img =  "";      
      }
      $title = $myts->previewTarea($sqlfetch['title'],1,0,0,0,0);      
      $sqlfetch['linkArticle'] = "<a href='".XOOPS_URL
              ."/modules/smartsection/item.php?itemid={$sqlfetch['itemid']}'>"
              ."{$img} {$title}</a>";
     
      //--------------------------------------------

      if ($sqlfetch['catImage'] <> '' & $sqlfetch['catImage'] <> 'blank.png' ){
        $img = "<img alt=' ' src=\"".XOOPS_URL
              ."/uploads/smartsection/images/category/{$sqlfetch['catImage']}\"/>";              
      }else{
        $img =  "";      
      }
      //$title = $myts->makeTareaData4Show($sqlfetch['name']);   
      $title = $myts->previewTarea($sqlfetch['name'],1,0,0,0,0);         
      $sqlfetch['linkCategory']= "<a href='".XOOPS_URL
                 ."/modules/smartsection/category.php?categoryid={$sqlfetch['categoryid']}'>"
                 ."{$img} {$title}</a>";
      //--------------------------------------------            
       // Ajout d'un lien 'lire la suite en bas du résumé si la colonne de titre n'est pas affichée
       if ($params['ordreTitle'] == 0) {
       	  $sqlfetch['linkOnNext'] = "<br /><div align='right'><a href='".XOOPS_URL
                             ."/modules/smartsection/item.php?itemid={$item['itemid']}'>"
                             . _SMARTS_READNEXT
							               ."</a></div><br />";
       } else {
       	  $sqlfetch['linkOnNext'] = '';
      }
      
      //----------------------------------------------------------------------
      $tInfo[] = $sqlfetch;
      //----------------------------------------------------------------------      

/*
*/  
   }
   //------------------------------------------------------------
  //displayArray($tInfo,"**************** getRecordSet **********************");   
  return count($tInfo);   
  

   
}

/*********************************************************************
 *
 *********************************************************************/
function getRstCategorieGen($params){
global $xoopsDB;
  
  //echo "<hr>getRstItemGen<hr>";
  $this->catLstId     = ''; 
  $this->catTbl       = 'smartsection_categories';
  $this->catColIdCat  = 'categoryid';
  $this->catColLib    = 'name';


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
  $this->catTbl       = 'smartsection_categories';
  $this->catColIdCat  = 'categoryid';
  $this->catColLib    = 'name';

  $this->itemLstId      = '';
  $this->itemTbl        = 'smartsection_items';
  $this->itemColIdItem  = 'itemid';
  $this->itemColIdCat   = 'categoryid';
  $this->itemColLib     = 'title';
  
  $this->itemColOrderDate = 'datesub';
  $this->periode          = $params['periode']['value'];  
  //$this->dateRef          = dateAdd(time() , 0, -$params['periode'], 0, true, true);;
  $this->maxItem          = $params['maxItem']['value'];
  
  
 //----------------------------------------------------
 $sqlquery = $this->getItemGen();
 return $sqlquery;
 //---------------------------------------------------- 
}


//-----------------------------
} // fin classe

?>



