<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_mailingListe extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_mailingListe($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_BONUS, "idListe", $becho); 
  
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
      $p = array ('idListe'           => 0, 
                  'nom'               => '',
                  'liste'             => '');

  }
  else {
    $sqlQuery = $this->getRow($id,$colList,$becho);
    $p = $xoopsDB->fetchArray($sqlQuery);
    
  }
  return $p;
}

/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (nom,liste) "
	      ." VALUES ('','')";
	
       $xoopsDB->query($sql);	

  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (nom,liste) "
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
	   //$myts =& MyTextSanitizer::getInstance();
	   //$name = $myts->makeTboxData4Show();	

  //------------------------------------
  
  $idListe = $t['idListe'];
  //-----------------------------------------------------------
   $t['txtName']      = string2sql($t['txtName']);
   $t['txtListe']     = string2sql($t['txtListe']);
   
    
  if ($idListe == 0){
    
      $sql = "INSERT INTO  {$this->table} "
            ."(nom, liste)"
            ."VALUES (" 
            ."'{$t['txtName']}',"  
            ."'{$t['txtListe']}'"                          
            .")";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE {$this->table} SET "
           ."nom               = '{$t['txtName']}',"
           ."liste             = '{$t['txtListe']}'"
           ." WHERE idListe = ".$idListe;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
}


//==============================================================================
} // fin de la classe

?>



