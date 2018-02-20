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


class cls_hermes_plugin{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $moduleName   = 'hermes';
  var $version      = '1.01.01';  
  
  var $name         = 'hermes';
  var $description  = 'hermes';
  var $header       = 'hermes';
  var $footer       = 'hermes';
  var $identifiant  = 0;
  
  var $tColDef = array ();


  var $catLstId = '';
  var $catTbl = '';
  var $catColIdCat = '';
  var $catColLib = '';
  var $itemLstId = '';
  var $itemTbl = '';
  var $itemColIdItem = '';
  var $itemColIdCat = '';
  var $itemColLib = '';
  var $itemColOrderDate = '';
  var $dateRef = 0;
  var $maxItem = 0;
  var $periode = 0;
      
/************************************************************
 * Constructucteur:
 ************************************************************/
function  cls_hermes_plugin($options){

  if (is_readable($options['lang'])) include_once($options['lang']);
  
/*

  $this->init(array ('moduleName'  => 'hermes',
                     'version'     => '0.00.00',
                     'pluginName'  => '',
                     'description' => '',
                     'header'      => '',
                     'footer'      => ''), array());                                              
  //$this->tColDef = $colDef;
*/  
  
  return true;
  
}
  
/************************************************************
 * initialisation de la classe:
 ************************************************************/
function  init($options, $tColDef){


  $this->moduleName    = $options['moduleName'];
  $this->version       = $options['version'];  
  $this->name          = $options['pluginName'];
  $this->description   = $options['description'];
  $this->header        = $options['header'];  
  $this->footer        = $options['footer'];  
  
  $this->tColDef = $tColDef;  
  
    //displayArray($options, "***** options *****===========");  
    //displayArray($tColDef, "***** tColDef *****===========");
    //displayArray($this->tColDef, "***** tColDef *****++++++++++++");
  return true;    
    
      
}
/*************************************************************************
 *
 *************************************************************************/
function getInfoPluggin(&$tProperty, &$params){

}

/*************************************************************************
 *
 *************************************************************************/

function buildInfoPluggin(&$tProperty, &$params, $tColDefPlugin, $binGenerique = 65535){  
global $xoopsModuleConfig;
  //------------------------------------------------------------
  $tProperty = array ();
  $tProperty ['module'] = $this->moduleName;
  $tProperty ['version'] = $this->version;
  $tProperty ['name'] = $this->name;
  $tProperty ['description'] = $this->description; 
  $tProperty ['identifiant'] = $this->identifiant;    
  //------------------------------------------------------------         
  $levelHidden    = 0;
  $levelGenerique = 1;
  $levelParam     = 2;
  $levelOrdre     = 3;
  //------------------------------------------------------------  
  $generique = array();  
  //------------------------------------------------------------ 
  $level = $levelHidden;
//'articlesListe' 
//'categoriesListe'   
  $generique [_HER_LIST_ID_ITEM] = array(
                  'name'        => 'listIDItem',
                  'value'       =>  '', 
                  'description' => 'Liste  identifiant des items',
                  'type'        => 0,
                  'level'       => $level);
    
  $generique [_HER_LIST_ID_CAT] = array(
                  'name'        => 'listIDCategorie',
                  'value'       =>  '', 
                  'description' => 'Liste  identifiant des catégories',
                  'type'        => 0,
                  'level'       => $level);

  //--------------------------------------------------------- 
  $level = $levelGenerique;
  if (($binGenerique & _HER_BALISE_GEN_TEMPLATE) <> 0){
    $generique ['template'] = array('name'    => _AD_HER_TEMPLATE,
                                      'value'       =>  '', 
                                      'description' => _AD_HER_TEMPLATE_DSC,
                                      'type'        => 3,
                                      'level'       => $level);
  }  
  //-------------------------------------------------------------------
  if (($binGenerique & _HER_BALISE_GEN_FRAME) <> 0){  
    $generique ['frame'] = array('name'        => _AD_HER_FRAME,
                                      'value'       =>  '', 
                                      'description' => _AD_HER_FRAME_DSC,
                                      'type'        => 6,
                                      'level'       => $level);
  }
  
  //-------------------------------------------------------------------
  if (($binGenerique & _HER_BALISE_GEN_NOM) <> 0){  
    $generique ['nom'] = array('name'    => _AD_HER_NAME, 
                                      'value'       => '', 
                                      'description' => _AD_HER_CATSIZE,
                                      'type'        => 0,
                                      'level'       => $level);
  }
  //-------------------------------------------------------------------
  if (($binGenerique & _HER_BALISE_GEN_PERIODE) <> 0){  
    $generique ['periode'] = array('name'        => _AD_HER_PERIODE_ANT,
                                      'value'       =>  2, 
                                      'description' => _AD_HER_PERIODE_ANT_DSC,
                                      'type' => 1, 
                                      'min'  => 0,
                                      'max'  =>  12,
                                      'level'       => $level);
  }  
  //-------------------------------------------------------------------  
  if (($binGenerique & _HER_BALISE_GEN_MAXITEM) <> 0){  
    $generique ['maxItem'] = array('name'        => _AD_HER_MAXITEM, 
                                      'value'       => 15, 
                                      'description' => _AD_HER_MAXITEM_DESC,
                                      'type' => 1, 
                                      'min'  => 0,
                                      'max'  =>  12,
                                      'level'       => $level);
  }  
  //-------------------------------------------------------------------  
  if (($binGenerique & _HER_BALISE_GEN_CATSIZE) <> 0){  
    $generique ['catSize'] = array('name'        => _AD_HER_CATSIZE, 
                                      'value'       => '+1', 
                                      'description' => _AD_HER_CATSIZE_DSC,
                                      'level'       => $level);  
 }  
 
 
   //-------------------------------------------------------------------  
  //if (($binGenerique & _HER_BALISE_GEN_CATSIZE) <> 0){ 
  
  $list = "width|cols|rows|colwidth|colheight|00|01|02|03|04|{$xoopsModuleConfig['smartyTag']}";
  $t = explode ('|', $list);
  for ($h = 0; $h < count($t); $h++){
    $t[$h] = trim ($t[$h]);    
    if ($t[$h] == '') continue;
    $generique ["smartyTag_{$t[$h]}"] = array('name'        => _AD_HER_SMARTY_TAG, 
                                      'value'       => '', 
                                      'description' => '',
                                      'level'       => $level);  
  
  } 
  
  /*

  for ($h = 0; $h < 5; $h++){
  
    $generique ["smartyTag{$h}"] = array('name'        => _AD_HER_SMARTY_TAG, 
                                      'value'       => '', 
                                      'description' => '',
                                      'level'       => $level);  
  
  }
  */   

  //-------------------------------------------------------------------  
  
  
    //-------------------------------------------------------------------
    //displayArray($tColDefPlugin, "***** tColDefPlugin *****.........................");
    //displayArray($this->tColDef, "***** tColDefPlugin *****.........................");
    $level = $levelOrdre;    
    $col = array();        


        $col['ordre'] = array('name'        => 'ordre', 
                              'value'       => 0, 
                              'description' => _AD_HER_COLUMN_ORDER_DSC,
                              'type'        => 10,
                              'level'       => $level);
    if (count($tColDefPlugin) > 0){        
        $h = 1;
        reset($tColDefPlugin);
        while (list($key, $item) = each($tColDefPlugin)){
        //for ($h=0; $h < count($tColDefPlugin); $h++){
          //$item = $tColDefPlugin[$h];
          $h ++;
          //echo "<hr>getInfoPluggin -> {$key} : {$item[0]}<hr>";
           $col [$item[0]] = array('name' => $item[1], 
                                  'value' => $h*10, 
                                  'type'  => 1,
                                  'min'   => 0,
                                  'max'   => 999,
                                  'level' => $level);
        
        }
    }
                          
    //-------------------------------------------------------------------
    if (is_array($params)){

      $level = $levelParam;  
      while (list($key, $item) = each($params)){   
        //displayArray($item,'--------params--------------'); 
        if (is_array($params[$key])){
          $params[$key]['level'] = $level;      
        } else{
          //echo "<hr>{$key}<hr>";
        }    

      } 
    
    }
      //-------------------------------------------------------------------    
    
      
    $params = array_merge($generique, $params, $col);
    
    //displayArray($params, "***** params *****!!!!!!!!!!!!!!!!!!");    
    
    return true;                  
}

/************************************************************
 * test l'existance du module au quel se referer le plugin:
 ************************************************************/
  
  function isOk(){

    $f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
       .'modules/'.$this->moduleName.'/xoops_version.php';
    return is_readable($f);
  
  }

/************************************************************
 *retour
 * 0 : le module n'existe pas
 * 1 : le module n'est pas installé
 * 2 : le module est désactivé
 * 3 : le module est ok       
 ************************************************************/
  
function getModuleStatus(){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;

    $f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
       .'modules/'.$this->moduleName.'/xoops_version.php';
    if (!is_readable($f)) return 0;   
    //-------------------------------------------------
  $sql = "SELECT isactive from ".$xoopsDB->prefix("modules")
        ." WHERE dirname = '{$this->moduleName}'";   
  $sqlquery = $xoopsDB->queryF($sql);  
  $nbenr = $xoopsDB->getRowsNum($sqlquery);
  
  if ($nbenr == 0){
    return 1;
  }else{
    list($isactive) = $xoopsDB->fetchRow($sqlquery); 
    return $isactive + 2;
  }
}


/*************************************************************************
 *
 *************************************************************************/
function getProperty(&$tProperty){
  
  $tProperty['version'] = $this->version;  
  $tProperty['header'] = $this->header;
  $tProperty['footer'] = "<a href='".XOOPS_URL
                        ."/modules/{$this->moduleName }/index.php'>"
                        .$this->footer."</a>";
  return true;
}

/*************************************************************************
 *
 *************************************************************************/
function getLastInfo(&$params, &$tProperty, &$tInfo ,&$colName, $mode = 0){
  

   
}

/******************************************************
 *
 ******************************************************/
function setShowOrder($params, $bAddRupture = true, $sep=';'){

  $tColDef = $this->tColDef;

  $t = array();
  for ($h = 0; $h < count($tColDef); $h++){
    $j = 0;
    while (true){
      $ordre = $params[$tColDef[$h][0]];
      $k =  sprintf("k-%04d-%03d", $ordre, $j);      
      if (!isset($t[$k])) break;
      $j++;
    }
    $k =  sprintf("k-%04d-%03d", $ordre, $j);
    $t[$k] = array($tColDef[$h][0], $tColDef[$h][1], $ordre) ; 
    //echo "{$k} - {$tKeys[$h]} - {$t[$k]}<br>";   
    
  }
  
  ksort($t);
  reset($t);
  //-----------------------------------------------------------  
  $col = array();
  //$h = 0;
  while (list($key, $item) = each ($t)){
    //$ordre = (($item[1] == 0 ) ? : $h++)
    //$col[$val] = array('key' => $item[0], 'visible' => true, 'order'=>$h++);
    $col[$item[0]] = array('keyname' => $item[0], 
                           'name'    =>$item[1],
                           'visible' => true,
                           'order'   => $item[2]);    
  }
  
  //-----------------------------------------------------------
  $key = _HER_CODE_RUPTURE;
  if ($bAddRupture == true){
    $col[$key] = array('keyname' => $key,  
                       'name'    => $key,
                       'order'   => 0,
                       'visible' => false);

  }
    
  //displayArray($t, "----- setOrder -----");
  return $col;


}

/*************************************************************************
 *Filtrage des colonne a renvoyerr dans tInfo
 *************************************************************************/
function colOk($var) 
{
  //echo "{$var['order']}-";
    return ($var['order'] > 0);
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
/******************************************************
 *
 ******************************************************/
function getInfoTemplate($template, 
                         &$params, 
                         &$tProperty, 
                         &$tInfo ,
                         &$colName, 
                         $mode = 0,
                         $structure){
// Xoops class
include_once XOOPS_ROOT_PATH.'/class/template.php';
  
  $f = $template.'.inc';
  $tpl = basename($template);
  $prefixeTPLinfo = 'generique-info';
  $prefixeTPLrst  = 'generique-recordset';  
  
  //si c'est un template generique selon le cas
  //appel de la fonctiion getLastInfo ou getRecordSet
  //sinon cheche si il ya une classe et appel dans cette class :"getLastInfo"
  //qui retrouner un objet utilisatble par le template
  //sinon dans tous les autres cas appel getLastInfo
  if (substr($tpl, 0,strlen($prefixeTPLinfo)) == $prefixeTPLinfo){
    $nbLine = $this->getLastInfo($params, $tProperty, $tInfo, $colName, $mode);  
  }else if(substr($tpl, 0, strlen($prefixeTPLrst)) == $prefixeTPLrst){
     $nbLine = $this->getRecordSet($params, $tInfo); 
     $this->getProperty($tProperty);
  }else if (is_readable($f)){
    include_once($f);
    $clsName = "cls_" . basename($template,'.html');
    //echo "<hr>{$f}<br>{$clsName}<hr>";
    $ob = new $clsName(array('lang'=>''));
    $nbLine = $ob->getLastInfo($params, $tProperty, $tInfo, $colName, $mode);  
  }else{
     //echo "<hr>getInfoTemplate-{$tpl}<br>pas de prefixe<hr>";  
    $nbLine = $this->getLastInfo($params, $tProperty, $tInfo, $colName, $mode);  
  }
  
/*
*/  
  
  //$nbLine = $this->getLastInfo($params, $tProperty, $tInfo, $colName, $mode);
  //echo "<hr>getInfoTemplate<br>{$nbLine}<hr>";
  
  // Start template class
  $tpl = new XoopsTpl();
  //--------------------------------------------------------
  // Assign smarty variables

  $tpl->assign('property',  $tProperty);  
  $tpl->assign('info',      $tInfo);
  $tpl->assign('colName',   $colName);  
  $tpl->assign('structure', $structure);
  $tpl->assign('params',    $params);  
    
  //--------------------------------------------------------  
  // Call template
  //$tpl->display($template);
  return $tpl->fetch($template);


} //fin getTemplate
/******************************************************
 *
 ******************************************************/

function getRecordSet(&$params){  
  

   
}

/******************************************************
 *


function getRstCatLibGenRecordSet(){

     
  $rst = getItemGen (
     $this->catLstId, $this->catTbl, $this->catColIdCat, $this->catColLib,
     $this->itemLstId, $this->itemTbl,$this->itemColIdItem, $this->itemColIdCat, $this->itemColLib,
     $this->itemColOrderDate, $this->dateRef, $this->maxItem);

  return $rst;   
}
 ******************************************************/
 
 
/*********************************************************************

**********************************************************************/
function getRstCategorieGen($params){
  return false;
}
 
 
/*********************************************************************

**********************************************************************/
function getRstItemGen($params){
  return false;
}
/*********************************************************************

**********************************************************************/
 function getCategorieGen(){
	global $xoopsModuleConfig, $xoopsDB;
	
	
$catLstId     = $this->catLstId;
$catTbl       = $this->catTbl;
$catColIdCat  = $this->catColIdCat;
$catColLib    = $this->catColLib;


  //---------------------------------------------------------------

  
  $sqlSelect = "SELECT cat.{$catColIdCat} AS catIdCat, cat.{$catColLib} AS catLib "
	      ." FROM ".$xoopsDB->prefix($catTbl) ." AS cat ";  
  
  $sqlFilter = "";

  $sqlOrderBy =" ORDER BY cat.{$catColLib} ";

 	$sql = $sqlSelect.$sqlFilter.$sqlOrderBy;      
  //echo "<hr>getCatLibGen<br>{$sql}<hr>";
    
    $maxItem = 0;
    if ($maxItem == 0){
      $sqlquery = $xoopsDB->query ($sql);    
    }else{
      $sqlquery = $xoopsDB->query ($sql, $maxItem);    
    }
  
    
    //--------------------------------------
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    if ($nbEnr == 0 ){
      return false;
    }else{
      return $sqlquery;
    }
                

}

/*********************************************************************

**********************************************************************/
 function getItemGen(){
	global $xoopsModuleConfig, $xoopsDB;
	
	
$catLstId     = $this->catLstId;
$catTbl       = $this->catTbl;
$catColIdCat  = $this->catColIdCat;
$catColLib    = $this->catColLib;

$itemLstId      = $this->itemLstId;
$itemTbl        = $this->itemTbl;
$itemColIdItem  = $this->itemColIdItem;
$itemColIdCat   = $this->itemColIdCat;
$itemColLib     = $this->itemColLib;

$itemColOrderDate   = $this->itemColOrderDate;
$periode            = $this->periode;
if ($periode == '') $periode = 0; 
//$dateRef            = $this->dateRef;
$maxItem            = $this->maxItem;
$dateRef            = dateAdd(time() , 0, -$periode, 0, true, true);
//$this->dateRef      = dateAdd(time() , 0, -$params['periode'], 0, true, true);
  //---------------------------------------------------------------

  
  $sqlSelect = "SELECT cat.{$catColIdCat} AS catIdCat, cat.{$catColLib} AS catLib, "
	      ." item.{$itemColIdItem} AS itemIdItem,  "
        ." item.{$itemColIdCat} AS itemIdCat,item.{$itemColLib} AS itemLib, "
        ." item.{$itemColOrderDate} AS itemDateUnix, "
        ." DATE_FORMAT(item.{$itemColOrderDate},'%d-%m-%Y') AS itemDateCourte"        
	      ." FROM ".$xoopsDB->prefix($catTbl) ." AS cat,"
        ."      ".$xoopsDB->prefix($itemTbl)." AS item"
	      ." WHERE cat.{$catColIdCat} = item.{$itemColIdCat}";  
  
  $filter = " AND item.{$itemColOrderDate} >= '{$dateRef}'"; 

  
  
  
  	      
  $sqlOrderBy =' ORDER BY '.(($itemColOrderDate == '') ? '' : "item.{$itemColOrderDate} DESC," )
	            ." item.{$itemColLib}";

 	$sql = $sqlSelect.$filter.$sqlOrderBy;      
  //echo "<hr>getCatLibGen<br>{$sql}<hr>";
    
    if ($maxItem == 0){
      $sqlquery = $xoopsDB->query ($sql);    
    }else{
      $sqlquery = $xoopsDB->query ($sql, $maxItem);    
    }
  
    
    //--------------------------------------
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    if ($nbEnr == 0 ){
      return false;
    }else{
      return $sqlquery;
    }

                

}

//------------------------------------------------------------------------------

} // fin de la classe

?>



