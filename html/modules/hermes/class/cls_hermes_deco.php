<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_deco extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_deco($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_DECO, "idDeco", $becho); 
  
  return true;
  
}

/*============================================================
 * methodes:
 =============================================================*/
  
/******************************************************
 *
 ******************************************************/
function getArray ($id, $colList = '*', $becho = 0){
	global  $xoopsDB;

  //------------------------------------------------------------------------   
  if ($id == 0) {
      $p = array ('idDeco'           => 0, 
                  'name'             => '',
                  'decoModele'       => '',                  
                  'properties'       => array());
  }
  else {
    $sqlQuery = $this->getRow($id,$colList,$becho);
    $p = $xoopsDB->fetchArray($sqlQuery);
    $p['name']   = sql2string ($p['name']);
    //-------------------------------------------------------------'
    
    
    $p['properties'] = $this->getProperties($id);    
    
    
    
    
    

  }
  return $p;
}
 /****************************************************************************
 *
 ****************************************************************************/
function getPPValues($idDeco){
  //$deco = $this->GetArray($idDeco);
  
  $pp = $this->getProperties($idDeco);
  $t = array();
  //$t ['params'] = $deco['params'];
    
  while (list ($key, $item) = each ($pp)){
    $t[$item['property']] = $item['ppValue'];
  }
  
  return $t;
}

 /****************************************************************************
 *
 ****************************************************************************/
 function getProperties($idDeco){
	global $xoopsModuleConfig, $xoopsDB;
  $tDeco       = _HER_TFN_DECO;
  $tDecopp     = _HER_TFN_DECOPP;
  $tDecomodele = _HER_TFN_DECOMODELE;
  //echo"<hr>$tDeco<br>$tDecopp<br>$tDecomodele<hr>";
  
  
  $sql = "SELECT tblDeco.*,  
                 tblPP.value , 
                 if(tblPP.value is null, tblDeco.defaut, tblPP.value) AS ppValue

        FROM (SELECT tDeco.name, tDeco.idDeco, tModele.*
              FROM {$tDeco} AS tDeco INNER JOIN {$tDecomodele} AS tModele 
              ON tDeco.decoModele = tModele.decoModele
              WHERE tDeco.idDeco = {$idDeco}
              ORDER BY rupture,ordre) 
              AS tblDeco 
        
        LEFT JOIN (SELECT tPP.value, tPP.property
              FROM {$tDecopp} AS tPP INNER JOIN {$tDeco} as tDeco  
              ON tPP.idDeco = tDeco.idDeco
              WHERE tDeco.idDeco = {$idDeco}) 
              AS tblPP 
        ON tblDeco.property = tblPP.property   ";  


  //--------------------------------------------------------------

  $sqlquery = $xoopsDB->query ($sql);
  $t = array();
    
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $t[] = $sqlfetch;
    }

  //her_displayArray($t,"------------- getProperties ------------------");
  return $t;         

      
}

/****************************************************************************
 *
 ****************************************************************************/
function newClone($id, $returnArray = false, $name2AddCopy = ''){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
    
  //--------------------------------------------------------
  //$t = cls_jjd_ado::newClone($id, $returnArray, $name2AddCopy);
  $tDeco = cls_jjd_ado::newClone($id, true, 'name');  
  $newId = $tDeco['idDeco'] ;
  //-------------------------------------------------------
  cls_jjd_ado::newCloneChild($id, $newId, _HER_TFN_DECOPP, 'idDecopp',$this->colNameId, true); 
  //----------------------------------------------------------
  return $tDeco;

}
/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (name,decoModele) "
	      ." VALUES ('???','???')";
	
       $xoopsDB->query($sql);	

  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (name,decoModele) "
	      ." VALUES ('','')";

 $xoopsDB->query($sql);	
 $newId = $xoopsDB->getInsertId() ;
 return $newId;
  
}

/*******************************************************************
 *
 *******************************************************************/
function saveRequest ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	   // $name = $myts->makeTboxData4Show();	

  //------------------------------------
  
  $idDeco = $t['idDeco'];
  $t['txtName']      = string2sql($t['txtName']);
  //-----------------------------------------------------------   
   
  if ($idDeco == 0){
    
      $sql = "INSERT INTO {$this->table} "
            ." (name, decoModele)"
            ."VALUES (" 
            ."'{$t['txtName']}'," 
            ."'{$t['txtDecoModele']}'"             
            .")";
  }else{
      $sql = "UPDATE {$this->table} SET "
           ."name              = '{$t['txtName']}',"
           ."decoModele        = '{$t['txtDecoModele']}'"           
           ." WHERE idDeco = ".$idDeco;
          
            
  }
  
  $xoopsDB->query($sql);
  if  ($idDeco == 0) $idDeco = $xoopsDB->getInsertId() ;
  
  
  
  //------------------------------------------------------------
  // sauvegarde des valeur de propriete
  //------------------------------------------------------------
  $sql = "DELETE FROM "._HER_TFN_DECOPP
        ." WHERE idDeco = {$idDeco}";
  $xoopsDB->query($sql);    
  //-------------------------------------------------------------      
  $lstPrefixe = "txtProperty;txtValue;txtTypeName";  
  //$idPlugin = $p['idPlugin'];  
  //$idStructure = (isset($p['txtIdStructure']) ? $p['txtIdStructure'] : 0);  
 
  $p =  getArrayOnPrefixArray ($t, $lstPrefixe);  
  
  //her_displayArray($p, "****** saveRequest *************");
  $h=0;
    while (list($key, $item) = each ($p)){      
    //for ($h = 0; $h < count($t); $h++){
      //$item = $t[$h] ; 
      
      
  
      switch ($item['txtTypeName']){
        case 'zzzzzz':
          break;
          
        default:
          $v = $item['txtValue'];
          break;
      }
      
      $sql = "INSERT INTO "._HER_TFN_DECOPP
            ."(idDeco,property,value)"
            ." VALUES "
            ."({$idDeco},'{$item['txtProperty']}','{$v}')";
            
      $xoopsDB->query($sql);


    }
  
  return $idDeco; 
  //displayArray($p, "******{}*************");             
//echo "<hr>{$sql}<hr>";
//exit;
}

/****************************************************************************
 *
 ****************************************************************************/
function getModeleList(){
	global $xoopsDB;  
	
	
/* version a etidier en allant lire directement les plugins
mais je crois que je vis abandonner cette option pour ne pas risquer de 
perdre une deco si le fichier est effacee

  //--------------------------------------------------------    
  $folder = _HER_ROOT_PATH.'decorations/cls_deco_';  
  $list =  getFiles ($folder, "php", false, false);
  
   //displayArray($list,"----------getModeleList--------------");  

  //--------------------------------------------------------
  $t = array();
  while (list($key,$name) = each ($list)){
    $clName = basename($name, '.php');

    $f = _HER_ROOT_PATH.'decorations/'.$name;    
    //echo "<hr>$clName<br$f><hr>";  
    include_once($f);
    $obDeco = new $clName();    
    $t[] = $obDeco->name;
  }

*/
	
  
  
/*

*/  
  
  $sqlquery = $this->getArray($id);
  
  $sql = "SELECT DISTINCT decoModele FROM "._HER_TFN_DECOMODELE
        ." ORDER BY decoModele";
        
  $sqlquery = $xoopsDB->query ($sql);
  $t = array();
    
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $t[] = $sqlfetch['decoModele'];
    }
  
  //echo "<hr>$sql<hr>";
  //her_displayArray($t, "-------------- getModeleList ------------------");
  return $t;         

}




//==============================================================================
} // fin de la classe

?>



