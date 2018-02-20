<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_syndication extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_syndication($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_TEXTE, "idTexte", $becho); 
  
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
      $p = array ('idTexte'           => 0, 
                  'nom'               => '',
                  'categorie'         => '',                  
                  'texte'             => '',
                  'editBeforeSend'    => 0,
                  'affichage'         => 255,
                  'width'             => '100%',
                  'alignement'        => 2,
                  'borderWidth'       => 0,
                  'borderColorLight'  => '',                  
                  'borderColorDark'   => '',                  
                  'bgColor'           => '');

  }
  else {
    $sqlQuery = $this->getRow($id,$colList,$becho);
    $p = $xoopsDB->fetchArray($sqlQuery);
    
    $p['nom']   = sql2string ($p['nom']);
    $p['texte'] = sql2string ($p['texte']);
  }
  return $p;
}

/****************************************************************************
 *
 ****************************************************************************/
function newClone($id, $returnArray = false){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
    
  //--------------------------------------------------------
  $sqlquery = $this->getArray($id);
  
  $sql = "INSERT INTO {$this->table}"
        ." (nom,categorie,texte,affichage,idFrame,bgColor,borderWidth,"
        ."borderColorLight,borderColorDark,alignement,width,"
        ."incrustation,editBeforeSend)"
        ." VALUES ("
        .sqlQuoteString($sqlquery['nom'].' copy', true, true)
        .sqlQuoteString($sqlquery['categorie'], true, true)        
        .sqlQuoteString($sqlquery['texte'], true, true)        
        ."{$sqlquery['affichage']},"   
        ."{$sqlquery['idFrame']},"             
        ."'{$sqlquery['bgColor']}',"
        ."{$sqlquery['borderWidth']},"
        ."'{$sqlquery['borderColorLight']}',"
        ."'{$sqlquery['borderColorDark']}',"
        ."{$sqlquery['alignement']},"
        ."'{$sqlquery['width']}',"
        ."{$sqlquery['incrustation']},"        
        ."{$sqlquery['editBeforeSend']}"        
        .")";
	
  
  $xoopsDB->queryF ($sql);
  $newId = $xoopsDB->getInsertId() ;
  //echo "<hr>JJD ---{$newIdLettre}-> {$sql}<hr>"; 
         
 
  //----------------------------------------------------------
  if ($returnArray) {
    return $this->getArray($newId);
  }else{
    return $this->fetchRow($newId);  
  }

}
/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (name,description,periodicite,jour) "
	      ." VALUES ('???','???',0,0)";
	
       $xoopsDB->query($sql);	

  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (name,description,periodicite,jour) "
	      ." VALUES ('','',0,0)";

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
  
  $idTexte = $t['idTexte'];
  //-----------------------------------------------------------
  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);
  //-----------------------------------------------------------
   $t['txtName']      = string2sql($t['txtName']);
   $t['txtCategorie'] = ucfirst(strtolower(string2sql($t['txtCategorie'])));     
   //$t['txtTexte'] = string2sql($t['txtTexte']);
   $txt = $t['txtTexte'];
   $txt = $myts->makeTareaData4Save($txt);   
    
  if ($idTexte == 0){
    
      $sql = "INSERT INTO {$this->table} "
            ." (nom, categorie, texte, editBeforeSend, affichage, width,alignement, "
            ."borderWidth, borderColorLight, borderColorDark, bgColor, idFrame)"
            ."VALUES (" 
            ."'{$t['txtName']}'," 
            ."'{$t['txtCategorie']}',"             
            ."'{$txt}',"
            ."{$t['txtEditBeforeSend']},"            
            ."{$bAffichage},"   
            ."'{$t['txtWidth']}',"            
            ."{$t['txtAlignement']},"              
            ."{$t['txtBorderWidth']},"    
            ."'{$t['txtBorderColorLight']}',"         
            ."'{$t['txtBorderColorDark']}',"                         
            ."'{$t['txtBgColor']}',"  
            ."{$t['txtIdFrame']}"                                    
            .")";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE {$this->table} SET "
           ."nom               = '{$t['txtName']}',"
           ."categorie         = '{$t['txtCategorie']}',"           
           ."texte             = '{$txt}',"  
           ."editBeforeSend    = {$t['txtEditBeforeSend']},"  
           ."affichage         = {$bAffichage},"   
           ."width             = '{$t['txtWidth']}',"           
           ."alignement        = {$t['txtAlignement']},"           
           ."borderWidth       = {$t['txtBorderWidth']}," 
           ."borderColorLight  = '{$t['txtBorderColorLight']}',"           
           ."borderColorDark   = '{$t['txtBorderColorDark']}',"           
           ."bgColor           = '{$t['txtBgColor']}',"
           ."idFrame           = {$t['txtIdFrame']}"           
           ." WHERE idTexte = ".$idTexte;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
//exit;
}
//==============================================================================
} // fin de la classe

?>



