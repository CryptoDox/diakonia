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

class cls_smartsectionCat extends cls_hermes_plugin{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $moduleName   = 'smartsection';
  var $version      = '1.01.01';  
  var $identifiant  = 201;  //Attention ce numero doit etre unique pour chaque plugin
  
  var $name         = 'smartsectionCat';
  var $description  = 'Choix es articles par catégorie';

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_smartsectionCat($options){
     cls_hermes_plugin::cls_hermes_plugin($options); 



  $options = array ('moduleName'  => 'smartsection',
                     'version'     => '1.01.01',
                     'pluginName'  => _SMARTS_CATNAME,
                     'description' => _SMARTS_PLUGIN_DESC,
                     'header'      => _SMARTS_HEADER,
                     'footer'      => _SMARTS_ALL_ARTICLES,
                     'identifiant' => 200);                                              

  $tColDef = array (array('ordreTitle',           _AD_HER_TITLE) ,
                    array('ordreSommaire',        _AD_HER_SUMMARY) ,
                    array('ordreDatePublication', _AD_HER_DATEPUBLICATION) ,
                    array('ordreLecture',         _SMARTS_LECTURES) ,
                    array('ordreCategorie',      _AD_HER_CATEGORY) ,                          
                    array('ordreCatLecture',      _SMARTS_CAT_LECTURES) ,                          
                    array('ordreCatCreation',     _AD_HER_DATECREATION ));
     
  $this->init($options, $tColDef);
  return $this->isOk();

   //---------------------------------------
    
}
  

/************************************************************
 * test l'existance du moduleau quel se refer le plugin:
 ************************************************************/
  
  function isOk(){

    $f = XOOPS_ROOT_PATH.'/modules/'.$this->moduleName.'/xoops_version.php';
    return is_readable($f);
  
  }

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  
global $xoopsDB;

  //------------------------------------------------------------
  //periode correspon au nombre de mois maximum de recherche des annonces

  $params = array ('periode' => array('name'        => _AD_HER_NB_MOIS,
                                      'value'       =>  2, 
                                      'description' => _AD_HER_NB_MOIS_LOOKKFOR,
                                      'type'        =>1,
                                      'min'         =>0,
                                      'max'         =>12),
                   'maxItem' => array('name'        => _AD_HER_MAXITEM, 
                                      'value'       => 15, 
                                      'description' => _AD_HER_MAXITEM_DSC,
                                      'type'        =>  1,
                                      'min'         =>  0,
                                      'max'         => 99),
                   'catSize' => array('name'        => _AD_HER_CATSIZE, 
                                      'value'       => '+1', 
                                      'description' => _AD_HER_CATSIZE_DSC),
                   'affichage' => array('name'        => 'affichage', 
                                      'value'       => 1, 
                                      'description' => _SMARTS_AFFICHAGE_DESC,
                                      'type'        => 2,
                                      'list'        => _SMARTS_AFFICHAGE_LIST)
                    );

/*

    
    $sql = "SELECT * FROM ".$xoopsDB->prefix("smartsection_categories")." AS cat "     
          ." ORDER BY cat.name" ;
    $sqlquery = $xoopsDB->queryF($sql);  
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        $lib = "Cat_".$sqlfetch['categoryid']."_".$sqlfetch['name'];
        $t = array('name'       => $lib, 
                  'value'       => '', 
                  'description' => _SMARTS_ARTICLESLISTE_DESC);
         $params[$lib] = $t;         
    }              
*/
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
  
  $tProperty['version'] = 1;  
  $tProperty['header'] = _SMARTS_HEADER;
  $tProperty['footer'] =  "<a href='".XOOPS_URL."/modules/smartsection/index.php'>"._SMARTS_ALL_ARTICLES."</a>";

  $colName = '';


  $myts =& MyTextSanitizer::getInstance();
  $ts = dateAdd(time() , 0, -$params['periode'], 0, true, true);
  $te = dateAdd(time() , 0, -$params['periode'], 0, true, true);  
  $tInfo = array();  
  //---------------------------------------
     $sql = "SELECT * FROM ".$xoopsDB->prefix("smartsection_categories")." AS cat "     
          ." ORDER BY cat.name ";    
    $queryCat = $xoopsDB->query($sql, $params['maxItem'], 0);
    while ($sqlfetchCat = $xoopsDB->fetchArray($queryCat)) {
        $lib = "Cat_".$sqlfetchCat['categoryid']."_".$sqlfetchCat['name']; 
        if ($params[$lib] == '' | $params[$lib] == 0){
          $sql = "SELECT itm.itemid, itm.categoryid, itm.title, itm.summary,"
                ."itm.datesub, itm.status, itm.image, itm.counter"
                ." from ".$xoopsDB->prefix("smartsection_items")." AS itm "
                ." WHERE itm.categoryid = {$sqlfetchCat['categoryid']}  "    
                ." AND itm.datesub > 0 " 
                ." AND itm.status = 2 "
                ." ORDER BY itm.datesub, itm.title";   
        
        }else{
          $list = str_replace(";", ",", $params[$lib]);
          $sql = "SELECT itm.itemid, itm.categoryid, itm.title, itm.summary,"
                ."itm.datesub, itm.status, itm.image, itm.counter"
                ." from ".$xoopsDB->prefix("smartsection_items")." AS itm "
                ." WHERE itm.categoryid = {$sqlfetchCat['categoryid']}  "    
                ." AND itm.itemid IN ({$list}) "
                ." ORDER BY itm.datesub, itm.title";   
          
        }  
    
    
              //." AND  expired > ".strtotime($ts)
    
    
    //    echo "---> {$sql}<br>";
        $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
        $nbEnr = $xoopsDB->getRowsNum($sqlquery);
        //echo "<hr>nbenr = {$nbEnr}<br>$ts<hr>";
        //-------------------------------------------------------
   
        $idCat = 0 ;
       $ok=true;
        
       while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    
          //----------------------------------------------------
          
          $title = $myts->makeTareaData4Show($sqlfetch['title']);  
          $datePublication = date("d-m-y h-m-s",$sqlfetch['datesub']); 
          $dateCreation    = date("d-m-y h-m-s",$sqlfetchCat['created']);
          
          
          if ($sqlfetch['image'] <> ''){
            $img = "<img alt=' ' src=\"".XOOPS_URL
                  ."/uploads/smartsection/images/item/{$sqlfetch['image']}\"/>"; 
          }else{
            $img =  "";      
          }
    
          $link1 = "<a href='".XOOPS_URL
                  ."/modules/smartsection/item.php?itemid={$sqlfetch['itemid']}'>"
                  ."{$img} {$title}</a>";
          //--------------------------------------------
          if ($sqlfetchCat['image'] <> ''){
            $img = "<img alt=' ' src=\"".XOOPS_URL
                  ."/uploads/smartsection/images/category/{$sqlfetchCat['image']}\"/>";              
          }else{
            $img =  "";      
          }
          $title = $myts->makeTareaData4Show($sqlfetchCat['name']);      
          $catLink1 = "<a href='".XOOPS_URL
                     ."/modules/smartsection/category.php?categoryid={$sqlfetchCat['categoryid']}'>"
                     ."{$img} {$title}</a>";
          
          //---------------------------------------------------------------
          $h = 0;   
          
          if ($params['affichage']==1){
            $order   = 0;
            $rupture = $sqlfetchCat['categoryid'];
          }else{
            $order   = $params['ordreCategorie'];  
            $rupture = 0 ;          
          }
          
          
          $tt['ordreTitle']['value']            = $sqlfetch['$link1'];
          $tt['ordreSommaire']['value']         = $sqlfetch['summary'];
          $tt['ordreDatePublication']['value']  = $sqlfetch['ordreDatePublication'];
          $tt['ordreLecture']['value']          = $sqlfetch['counter'];
          $tt['ordreCatCreation']['value']      = $sqlfetch['ordreLecture'];
          $tt['ordreCatLecture']['value']       = $sqlfetch['total'];
          $tt['ordreCategorie']['value']        = $sqlfetch['$catLink1'];
          //----------------------------------------------------
          $tt[_HER_CODE_RUPTURE]['value'] = "<b><font size='{$params['catSize']}'>{$item['linkCategory']}</font></b>";
          $tt[_HER_CODE_RUPTURE]['rupture'] =  $rupture;      
          //----------------------------------------------------
    
          ksort($tt);
          reset($tt);
          //displayArray2($tt,"Traitement du tableau tInfo");
          //$tk =  array_filter($tt, "colOk");
          //displayArray2($tk,"Traitement du tableau tInfo");      
          
          //$tInfo[] = array_filter($tt, "colOk");
          $tInfo[] = $tt;   
          //**************************************************************   
        }
  
   }
   //------------------------------------------------------------
   
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  

   
}

/*************************************************************************
 *Filtrage des colonne a renvoyerr dans tInfo
 *************************************************************************/
function colOk($var) 
{
  //echo "{$var['order']}-";
  //  return ($var['order'] > 0);
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

//----------------------------------------------------------    



} // fin de la classe

?>



