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

Création juin 2007
Dernière modification : septembre 2007 
******************************************************************************/

include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_hermes_plugin.php");

class cls_catads extends cls_hermes_plugin {  

/************************************************************
 * déclaration des variables membre:
 ************************************************************/

/************************************************************
 * Constructeur:
 ************************************************************/
function  cls_catads($options){
  cls_hermes_plugin::cls_hermes_plugin($options); 
    
  $options = array ('moduleName'  => 'catads',
                    'version'     => '1.02.01',
                    'pluginName'  => _CATADS_NAME,
                    'description' => _CATADS_PLUGIN_DESC,
                    'header'      => _CATADS_HEADER,
                    'footer'      => _CATADS_ALL_ANNONCES,
                    'identifiant' => 190);                                              
    
  $tColDef = array (array('ordreTitle',           _AD_HER_TITLE),
                    array('ordreDescription',     _AD_HER_DESCRIPTION),
                    array('ordrePrice',           _CATADS_PRICE),
                    array('ordreTown',            _CATADS_TOWN) ,
                    array('ordreDateCreation',    _AD_HER_DATECREATION),
                    array('ordreDatePublication', _AD_HER_DATEPUBLICATION) ,
                    array('ordreDateExpiration',  _CATADS_DATEEXPIRATION) ,                    
                    array('ordreCategorie',       _AD_HER_CATEGORY));

  $this->init($options, $tColDef);                                              
 
    return $this->isOk();
    
  }
  

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------
  //période correspondant au nombre de mois maximum de recherche des annonces

  $params = array ('modeAffichage' => array('name'  => _CATADS_MODE_AFFICHAGE, 
                                      'value'       => 1, 
                                      'description' => _CATADS_AFFICHAGE_DESC,
                                      'type'        => 2,
                                      'list'        => _CATADS_AFFICHAGE_LIST),
                   'imgCategorie' => array('name'        => _CATADS_IMGCATEGORIE, 
                                      'value'       => 1, 
                                      'description' => _CATADS_IMGCATEGORIE_DESC,
                                      'type'        => 2,
                                      'list'        => _AD_HER_NOYES),
                   'imgAnnonce'  => array('name'        => _CATADS_IMGANNONCE, 
                                      'value'       => 1, 
                                      'description' => _CATADS_IMGANNONCE_DESC,
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

//displayArray($params,"----- getLastInfo -----");
  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  //----------------------------------------------
  $this->getProperty($tProperty);
  $tProperty['header'] = _CATADS_HEADER;
  $tProperty['footer'] =  "<a href='".XOOPS_URL."/modules/catads/index.php'>"._CATADS_ALL_ANNONCES."</a>";

  $colName = '';


  $myts =& MyTextSanitizer::getInstance();
  $ts = dateAdd(time() , 0, -$params['periode'], 0, true, true);
  $te = dateAdd(time() , 0, -$params['periode'], 0, true, true);  
  //---------------------------------------
  
    $sql = "SELECT ads.ads_id, ads.cat_id, ads.ads_title, ads.ads_type, ads.ads_desc, "
          ."ads.price, ads.monnaie,"    
          ."ads.town, ads.created, ads.published, ads.expired, ads.photo0,"
          ."cat.pid, cat.title, cat.img, cat.weight, cat.nb_photo"
          ." from ".$xoopsDB->prefix("catads_ads")." AS ads ,"
                   .$xoopsDB->prefix("catads_cat")." AS cat "     
          ." WHERE ads.cat_id = cat.cat_id "    
          ." AND published > 0 " 
          ." AND  created > ".strtotime($ts)
          ." AND  expired > ".strtotime("now")          
          ." ORDER BY cat.pid, cat.title, ads.ads_title";   
          
          //." AND  expired > ".strtotime($ts)


//    echo "---> {$sql}<br>";
    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    //echo "<hr>nbenr = {$nbEnr}<br>$ts<hr>";
    //-------------------------------------------------------
    $tInfo = array();   
    $col = $this->setShowOrder($params);
    
    $idCat = 0 ;
    $ok=true;
    
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      //----------------------------------------------------
      $tt = array_merge($col);
      //----------------------------------------------------
      
      $title = $myts->makeTareaData4Show($sqlfetch['ads_title']);  

      if ($sqlfetch['photo0'] <> '' & $params['imgCategorie'] == 1 ){
        $img = "<img alt=' ' src=\"".XOOPS_URL
              ."/modules/catads/images/ads/{$sqlfetch['photo0']}\"/>";  
      }else{
        $img =  "";      
      }

      $link1 = "<a href='".XOOPS_URL
              ."/modules/catads/adsitem.php?ads_id={$sqlfetch['ads_id']}'>"
              ."{$img} {$title}</a>";
      
      $town = $sqlfetch['town'];
      $datePublication = date("d-m-y",$sqlfetch['published']); 
      $dateCreation    = date("d-m-y",$sqlfetch['created']);
      $dateExpiration  = date("d-m-y",$sqlfetch['expired']);            
      
      //--------------------------------------------
      if ($sqlfetch['img'] <> '' & $params['imgAnnonce'] == 1 ){
        $img = "<img alt=' ' src=\"".XOOPS_URL
              ."/modules/catads/images/cat/{$sqlfetch['img']}\"/>";  
      }else{
        $img =  "";      
      }
      $title = $myts->makeTareaData4Show($sqlfetch['title']);      
      $catLink1 = "<a href='".XOOPS_URL
                 ."/modules/catads/adslist.php?cat_id={$sqlfetch['cat_id']}'>"
                 ."{$img} {$title}</a>";
      
      //---------------------------------------------------------------
      $h = 0;   
      
      if ($params['modeAffichage']==1){
        $order   = 0;
        $rupture = $sqlfetch['cat_id'];
      }else{
        $order   = $params['ordreCategorie'];  
        $rupture = 0 ;          
      }
      //---------------------------------------------------------------
      $tt['ordreTitle']['value']            = $link1;
      $tt['ordreDescription']['value']      = $sqlfetch['ads_desc'];
      $tt['ordrePrice']['value']            =  $sqlfetch['price']." ".$sqlfetch['monnaie'];
      $tt['ordreTown']['value']             = $params['ordreTown'];
      $tt['ordreDateCreation']['value']     = $dateCreation;
      $tt['ordreDatePublication']['value']  = $datePublication;
      $tt['ordreDateExpiration']['value']   = $dateExpiration;
      $tt['ordreCategorie']['value']        = $catLink1;
      //---------------------------------------------------------------            

      
      //$tInfo[] = array_filter($tt, "colOk");
      $tInfo[] = $tt;   
      //**************************************************************   

  
   }
   //------------------------------------------------------------
   
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  

   
}
/*************************************************************************
 *
 *************************************************************************/

function getRecordSet(&$params, &$tInfo){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  $myts =& MyTextSanitizer::getInstance();
  
  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  

  $colName = '';

  $ts = dateAdd(time() , 0, -$params['periode'], 0, true, true);
  $te = dateAdd(time() , 0, -$params['periode'], 0, true, true);  
  //---------------------------------------
  
    $sql = "SELECT ads.ads_id, ads.cat_id, ads.ads_title, ads.ads_type, ads.ads_desc, "
          ."ads.price, ads.monnaie,"    
          ."ads.town, ads.created, ads.published, ads.expired, ads.photo0,"
          ."cat.pid, cat.title, cat.img, cat.weight, cat.nb_photo"
          ." from ".$xoopsDB->prefix("catads_ads")." AS ads ,"
                   .$xoopsDB->prefix("catads_cat")." AS cat "     
          ." WHERE ads.cat_id = cat.cat_id "    
          ." AND published > 0 " 
          ." AND  created > ".strtotime($ts)
          ." AND  expired > ".strtotime("now")          
          ." ORDER BY cat.pid, cat.title, ads.ads_title";   
          
          //." AND  expired > ".strtotime($ts)


//    echo "---> {$sql}<br>";
    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    //echo "<hr>nbenr = {$nbEnr}<br>$ts<hr>";
    //-------------------------------------------------------
    $tInfo = array();   
    $idCat = 0 ;
   $ok=true;
    
//    echo "---> {$sql}<br>";
    $sqlquery = $xoopsDB->queryF($sql, $params['maxItem'], 0);  
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    //echo "<hr>nbenr = {$nbEnr}<br>$ts<hr>";
    //-------------------------------------------------------
    $tInfo = array();   
    $idCat = 0 ;
   $ok=true;
    
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {

      //----------------------------------------------------
      $sqlfetch['ads_title'] = $myts->makeTareaData4Show($sqlfetch['ads_title']);      
  

      if ($sqlfetch['photo0'] <> '' & $params['imgCategorie'] == 1 ){
        $img = "<img alt=' ' src=\"".XOOPS_URL
              ."/modules/catads/images/ads/{$sqlfetch['photo0']}\"/>";  
      }else{
        $img =  "";      
      }

      $sqlfetch['titleLink'] = "<a href='".XOOPS_URL
              ."/modules/catads/adsitem.php?ads_id={$sqlfetch['ads_id']}'>"
              ."{$img} {$sqlfetch['ads_title']}</a>";
      

      $sqlfetch['datePublication'] = date("d-m-y",$sqlfetch['published']); 
      $sqlfetch['dateCreation']    = date("d-m-y",$sqlfetch['created']);
      $sqlfetch['dateExpiration']  = date("d-m-y",$sqlfetch['expired']);            
      
      //--------------------------------------------
      if ($sqlfetch['img'] <> '' & $params['imgAnnonce'] == 1 ){
        $img = "<img alt=' ' src=\"".XOOPS_URL
              ."/modules/catads/images/cat/{$sqlfetch['img']}\"/>";  
      }else{
        $img =  "";      
      }
      $title = $myts->makeTareaData4Show($sqlfetch['title']);      
      $sqlfetch['catLink1'] = "<a href='".XOOPS_URL
                 ."/modules/catads/adslist.php?cat_id={$sqlfetch['cat_id']}'>"
                 ."{$img} {$title}</a>";
      
      //---------------------------------------------------------------
       $tInfo[] = $sqlfetch;   
      //**************************************************************   

  
   }
   //------------------------------------------------------------
   
   //------------------------------------------------------------
    
  //------------------------------------------- 
  return count($tInfo);   
  
}


} // fin de la classe

?>
