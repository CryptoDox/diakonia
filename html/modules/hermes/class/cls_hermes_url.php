<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_url extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_url($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_URL, "idUrl", $becho); 
  
  return true;
  
}

/*============================================================
 * methodes:
 =============================================================*/
  
/******************************************************
 *
 ******************************************************/
function getArray ($id,$colList = '*', $becho = 0){
	global  $xoopsDB;

  if ($id == 0) {
      $p = array ('idUrl'             => 0, 
                  'url'               => '',
                  'description'       => '',
                  'categorie'         => '');
  }
  else {
    $sqlQuery = $this->getRow($id,$colList,$becho);
    $p = $xoopsDB->fetchArray($sqlQuery);
    
    $p['url']         = sql2string ($p['url']);
    $p['description'] = sql2string ($p['description']);
  }
  return $p;
}

/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table} "
	      ."(url,description,categorie) "
	      ."VALUES ('','',0)";
	
       $xoopsDB->query($sql);	

  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO  {$this->table} "
	      ."(url,description,categorie) "
	      ."VALUES ('','',0)";

 $xoopsDB->query($sql);	
 $newId = $xoopsDB->getInsertId() ;
 return $newId;
  
}

/****************************************************************
 *
 ****************************************************************/

function deleteId ($idUrl) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM {$this->table} "
	      ." WHERE [$this->colNameId} = ".$idUrl;
	
       $xoopsDB->query($sql);	

	
	$sql = "DELETE FROM "._HER_TFN_SYNDICATION
	      ." WHERE idUrl = ".$idUrl;
	
       $xoopsDB->query($sql);	
  
}


/*******************************************************************
 *
 *******************************************************************/
function saveRequest ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	

  //------------------------------------
  
  $idUrl = $t['idUrl'];
  //-----------------------------------------------------------
   $t['txtUrl']         = string2sql($t['txtUrl']);
   $t['txtDescription'] = string2sql($t['txtDescription']);
   
    
  if ($idUrl == 0){
    
      $sql = "INSERT INTO  {$this->table} "
            ."(url, description,categorie)"
            ."VALUES (" 
            ."'{$t['txtUrl']}',"  
            ."'{$t['txtDescription']}',"  
            ."{$t['txtCategorie']}"                                    
            .")";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE  {$this->table} SET "
           ."url               = '{$t['txtUrl']}',"
           ."description       = '{$t['txtDescription']}'"  
           ." WHERE idUrl = ".$idUrl;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
}

//==============================================================================
} // fin de la classe

?>



