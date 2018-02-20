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
include_once ("lastRSS.inc");
include_once (XOOPS_ROOT_PATH . "/modules/hermes/class/cls_hermes_plugin.php");
class cls_fluxrss extends cls_hermes_plugin {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/
  
  
/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_fluxrss($options){

    cls_hermes_plugin::cls_hermes_plugin($options); 
    
  $options = array ('moduleName'  => 'hermes',
                    'version'     => '1.02.01',
                    'pluginName'  => _HERRSS_NAME,
                    'description' => _HERRSS_PLUGIN_DESC,
                    'header'      => _HERRSS_HEADER,
                    'footer'      => '',
                    'identifiant' => 10);                                              
  
  
  $tColDef = array();
  
  $this->init($options, $tColDef);    
  return $this->isOk();
    
  
}
  

/*************************************************************************
 *
 *************************************************************************/

function getInfoPluggin(&$tProperty, &$params){  

  //------------------------------------------------------------         



  $params = array ('url' =>        array('name'        => _AD_HER_URL, 
                                      'value'       => '', 
                                      'description' => '',
                                      'type'        => 0),
                  'description' => array('name'        => _AD_HER_DESCRIPTION, 
                                      'value'       => '', 
                                      'description' => _HERRSS_DESCRIPTION_DSC,
                                      'type'        => 0),
                  'colonnes' => array('name'        => _AD_HER_AFFICHAGE_ITEM, 
                                      'value'       => 'author,description,pubDate', 
                                      'description' => _AD_HER_AFFICHAGE_ITEM_DSC,
                                      'type'        => 0),
                   'max' => array('name'        => _AD_HER_MAXITEM, 
                                      'value'       => 15, 
                                      'description' => _AD_HER_MAXITEM_DSC,
                                      'type'        =>  1,
                                      'min'         =>  0,
                                      'max'         => 99),
                  'catSize' => array('name'        => 'catSize', 
                                      'value'       => '+1', 
                                      'description' => _AD_HER_CATSIZE,
                                      'type'        => 0)
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
  
  //displayArray($params,"-----  -----");
  if (!$this->isOk()) return 0;	
  //----------------------------------------------
  
  $tProperty['version']    = 1;  
  //$tProperty['header']     = _HERRSS_HEADER;
  $tProperty['footer']     = "";  
	$tProperty['show_title'] = false;  

  $colName = '';

	$params ['show_title'] = false;
  $myts =& MyTextSanitizer::getInstance();
  
  
  //---------------------------------------
  $tInfo = array();  
  //$optionsRSS = $params['rss'];  
  $optionsRSS = $params;  
  
  $tProperty['header']     = $optionsRSS['description'];
  //echo "<hr>{$optionsRSS['url']}<br>{$optionsRSS['max']}<hr>";
  //if (!$this->getDefinition($rss, $rss)) return '';
  $this->getFluxrss($optionsRSS['url'], $optionsRSS['max']);   
    //-------------------------------------------------------
  $title = $optionsRSS['colonnes'];
  //echo "<hr>{$title}<hr>";
  if ($title == '' | $title = 'title'){
    $this->getUrl_rss1($tInfo, $colName, $mode, $params);    
  }else{
    $this->getUrl_rss2($tInfo, $colName, $mode, $params);    
  }

  //------------------------------------------- 
  return count($tInfo);   
  

   
}
/*************************************************************************
 *
 *************************************************************************/
function getUrl_rss1(&$tInfo, &$colName, $mode = 0 , $params = ''){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
	global $RSS_Content;  
	
  //echo "<hr>{$url}<hr>";
  
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;
  //displayArray($params, "----- getLastInfo -----");

  //----------------------------------------------
	
  $myts =& MyTextSanitizer::getInstance();
  $options = $params['rss'];
  //---------------------------------------

  
  $idCat = 0 ;
  $ok=true;
  $h = 0;
  //$tInfo = array();
  //$tOrderKey = $this->getItemOrder($params);
  $options['colonnes'] = str_replace(',' ,';' ,$options['colonnes']);  
  //if (strpos($options['affichage'], 'title') === false)  $options['affichage'] = 'title;'.$options['affichage'];
  $tOrderKey = array_flip(explode(";", $options['colonnes']));	
  //displayArray($tOrderKey,"----- tOrderKey -----");
  $recents = $this->xml;  
  if (count($recents) == 0) return "";
  if (!is_array($recents)) return "";
  
  foreach($recents as $article)	{
      $h++;
      $order   = 0;
      $rupture = $h;

 //echo "{$article['title']}<br>";     
 //print_r($article);
 //echo "<hr>";
      $link1 = "<a href='{$article['link']}'>{$article['title']}</a>" ;
      $tt = array();
      $tt ['k-null'] = array('name'  => '',
                              'value' => '',
                              'order' => 1);
      
      $tt ['k-sujet'] = array('name'  => _HERRSS_TITLE,
                              'value' => $link1,
                              'order' => 2);
      $tt ['k-pubDate'] = array('name'  => _HERRSS_PUBDATE,
                              'value' => $article['pubDate'],
                              'order' => 3);
                              
      $tInfo[] = $tt;                             
      

      //------------------------------------------------------
      $h++;

    }

  //------------------------------------------- 
  return count($tInfo);   
  

   
}

/*************************************************************************
 *
 *************************************************************************/
function getUrl_rss2(&$tInfo, &$colName, $mode = 0 , $params = ''){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
	global $RSS_Content;  
	
  //echo "<hr>{$url}<hr>";
  
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;
  //displayArray($params, "----- getLastInfo -----");

  //----------------------------------------------
	
  $myts =& MyTextSanitizer::getInstance();
  //$options = $params['rss'];
  $options = $params;  
  //---------------------------------------
  
  $idCat = 0 ;
  $ok=true;
  $h = 0;
  //$tInfo = array();
  //$tOrderKey = $this->getItemOrder($params);
  $options['colonnes'] = str_replace(',' ,';' ,$options['colonnes']);  
  //if (strpos($options['affichage'], 'title') === false)  $options['affichage'] = 'title;'.$options['affichage'];
  $tOrderKey = array_flip(explode(";", $options['colonnes']));	
  //displayArray($tOrderKey,"----- tOrderKey -----");
  $recents = $this->xml;
  
  foreach($recents as $article)	{
      $h++;
      $order   = 0;
      $rupture = $h;

 //echo "{$article['title']}<br>";     
 //print_r($article);
 //echo "<hr>";
      $link1 = "<a href='{$article['link']}'>{$article['title']}</a>" ;

      $z = array('name'   => "ne sera jamais affiché, c'est juste pour passer les paramètre par contre value oui",
                 'value'    => "<b><font size='{$params['catSize']}'>{$link1}</font></b>",
                 'order'    => 0,
                 'rupture' => $rupture);
      $y = array ('name'   => '',
                  'value' => '',
                  'order' => 999);

      //--------------------------------------------------------------------------------
      $i = 0;
      
      reset($tOrderKey);
      while (list($key, $item) = each($tOrderKey)) {
        //echo "{$key} => {$item}<br>";
        if (isset($article[$key])){
          //echo "{$key}=>{$article[$key]}|".strlen($article[$key])."|<br>";
          if (trim($article[$key]) <> '' ){
              $rowTitle = $this->getTitle($key);
              if ($key == 'description'){
                $article[$key] = $this->sanitiseDescription ($article[$key]);
              }
              //---------------------------------------------------------
              $tt = array();
              $tt ['k-sujet'] = array('name'  => _HERRSS_TITLE,
                                      'value' => $rowTitle,
                                      'order' => 1);
                                      
              $tt ['k-valeur'] = array('name'  => _HERRSS_SUBJECT,
                                       'value' => $article[$key],
                                       'order' => 2);
              $tt ['k-valeur2'] = $y;

              if ($i == 0){
                $tt [_HER_CODE_RUPTURE] = $z;            
              }
              $i++;              
              $tInfo[] = $tt;                                                       
         
          }
        
        }
          

      }
 

      //------------------------------------------------------
      $h++;

    }

  //------------------------------------------- 
  return count($tInfo);   
  

   
}
/*************************************************************************
 *
 *************************************************************************/
function getFluxrss($rssurl, $max){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
	global $RSS_Content;  
	
  //echo "<hr>{$url}<hr>";
  
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;
  //displayArray($params, "----- getLastInfo -----");

  //----------------------------------------------
// Create lastRSS object
  $rss = new lastRSS;
  
  // Set cache dir and cache time limit (1200 seconds)
  // (don't forget to chmod cahce dir to 777 to allow writing)
  $rss->cache_dir = '';
  $rss->cache_time = 0;
  $rss->cp = 'US-ASCII';
  $rss->date_format = 'l';
  
  // Try to load and parse RSS file of Slashdot.org
  //$rssurl = 'http://www.freshfolder.com/rss.php';
  
  if ($rs = $rss->get($rssurl)) {
    	$this->xml = $rs['items'];
    	if($max > 0) $this->xml = array_slice($this->xml, 0, $max);
      return true;
  
/*
      echo '<pre>';
      //print_r($rs);
      echo '</pre>';


*/  
  
  
  
  } else {
    return false;
      //echo "Error: It's not possible to get $rssurl...";
  }

   
}

/*************************************************************************
 *
 *************************************************************************/
function getItemOrder($params){
  //print_r($params);
  $prefix = 'ordre';
  $lgPrefixe = strlen($prefix);
  $t = array();
  
  
  reset($params);
  while (list($key, $val) = each($params)) {
    $tItem = explode('_', $key);
    //echo "{$key} -> {$val}<br>";
      //if (substr($key, 0, $lgPrefixe) == $prefix){
      if ($tItem[0] == $prefix){      
        if ($val > 0 ) {
          $t[$tItem[1]] = $val;      
        }
      }
    
  }

      
    //print_r($t);
    arsort($t, SORT_NUMERIC);
    reset ($t);
    
    //print_r($t);
  return $t;
}

/*************************************************************************
 *
 *************************************************************************/

function getTitle($key){
    switch ($key){
      case 'title'      : $title = _HERRSS_TITLE       ; break;
      case 'author'     : $title = _HERRSS_AUTHOR      ; break;  
      case 'pubDate'    : $title = _HERRSS_PUBDATE     ; break;
      case 'description': $title = _HERRSS_DESCRIPTION ; break;  
      case 'guid'       : $title = _HERRSS_GUID        ; break;
      default           : $title = ''                  ; break;  
    }
  return $title;
}


/*************************************************************************
 *
 *************************************************************************/
function sanitiseDescription($description){
/*

<a href="http://www.ladocumentationfrancaise.fr/catalogue/9789287163769/index.shtml?xtor=RSS-583">
<img src="http://www.ladocumentationfrancaise.fr/catalogue/couverture-non-disponible.jpg" border=0 alt="couverture"></a><br />23 &euro; <br />
		Conseil de l'Europe<br />
		]]>
*/

  $h = strpos($description, 'CDATA');

  if ($h === false){
      return $description;  
  }else{
    $h = strpos($description, '[', $h);
    
    $r = strrev($description);
    $i =  strpos($r, ']');
    $i =  strpos($r, ']', $i+1);
  //echo "h = {$h} | i = {$i}<br>";    
    
    $dsc = substr($description, $h+1, -($i+1));    
    //traitement d'une image si elle existe
    $h = strpos($dsc, '<img');
    if (!($h === false)){
      /*    
      $i =  strpos($dsc, '>', $h);
      $s1 = substr($dsc, 0 , $h-1);
      $s2 = substr($dsc, $h, $i-$h+1);
      $s3 = substr($dsc, $i+1);
  echo "h = {$h} | i = {$i}<br>";      
      $dsc = "<table border='0'><tr><td>{$s1}</td><td>{$s2}</td><td>{$s3}</td></tr></table>";

      
      */
      
      $dsc = str_replace ('<img',"<img style='float: left'", $dsc);
    }    
    
    
    
    
    return trim($dsc);
  
  }



   
  

   
}



/****************************************************************************
*
****************************************************************************/
function getDefinition($idFluxrss, &$rss){
global $xoopsModuleConfig, $xoopsDB;

        
  $sql = "SELECT * FROM ".$xoopsDB->prefix("her_fluxrss")
        ." WHERE idFluxrss = {$idFluxrss}";
  $sqlquery = $xoopsDB->queryF($sql);        
  $nbEnr = $xoopsDB->getRowsNum($sqlquery);
  
  if ($nbEnr == 0 ){
      $rss = false;  
      return false;  
  }else{
  
      $rss = $xoopsDB->fetchArray($sqlquery); 
      return    true;   
  }

    
}

/****************************************************************************
*
****************************************************************************/

function getRecordSet(&$params, &$tInfo){  
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
	global $RSS_Content;  
	
  //echo "<hr>{$url}<hr>";
  
  //  global $format_mail, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2,$lig;
  //displayArray($params, "----- getLastInfo -----");
$this->getFluxrss($params['url'], $params['max']);  
  //----------------------------------------------
	
  $myts =& MyTextSanitizer::getInstance();
  //$options = $params['rss'];
  $options = $params;  
  //---------------------------------------
  
  $idCat = 0 ;
  $ok=true;
  $h = 0;
  //$tInfo = array();
  //$tOrderKey = $this->getItemOrder($params);
  $options['colonnes'] = str_replace(',' ,';' ,$options['colonnes']);  
  //if (strpos($options['affichage'], 'title') === false)  $options['affichage'] = 'title;'.$options['affichage'];
  $tOrderKey = array_flip(explode(";", $options['colonnes']));	
  //displayArray($tOrderKey,"----- tOrderKey -----");
  $recents = $this->xml;
  
  foreach($recents as $article)	{
      $h++;
      $order   = 0;
      $rupture = $h;

 //echo "{$article['title']}<br>";     
 //print_r($article);
 //echo "<hr>";
      //$link1 = "<a href='{$article['link']}'>{$article['title']}</a>" ;
              $tt = array();
              $tt['link'] = "<a href='{$article['link']}'>{$article['title']}</a>" ;
      //--------------------------------------------------------------------------------
      $i = 0;
      
      reset($tOrderKey);
      while (list($key, $item) = each($tOrderKey)) {
        //echo "{$key} => {$item}<br>";
        if (isset($article[$key])){
          //echo "{$key}=>{$article[$key]}|".strlen($article[$key])."|<br>";
          if (trim($article[$key]) <> '' ){
              $rowTitle = $this->getTitle($key);
              if ($key == 'description'){
                $article[$key] = $this->sanitiseDescription ($article[$key]);
              }
              //---------------------------------------------------------

              $tt [$key] = $article[$key];              
              
              
              $i++;              
                                                       
         
          }
        
        }
          

      }
 

      //------------------------------------------------------
      $h++;
              $tInfo[] = $tt;
    }

  //------------------------------------------- 
  return count($tInfo);   
  


}

//---------------------------------------------------------------------------
} // fin de la classe


//****************************************************************************/

?>



