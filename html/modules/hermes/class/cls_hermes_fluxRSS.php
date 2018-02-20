<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_fluxRSS extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_fluxRSS($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_FLUXRSS, "idFluxrss", $becho); 
  
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

  if ($id == 0) {
      $p = array ('idFluxrss'     => 0, 
                  'nom'           => '',      
                  'url'           => '',
                  'description'   => '',
                  'colonnes'     => 'title;author;pubDate;description',    
                  'max'           =>  0,                                
                  'options'       =>  0                  
                  );

  }
  else {
    $p = cls_jjd_ado::getArray($id, $colList,$becho);

    $p['url']         = sql2string ($p['url']);
    $p['description'] = sql2string ($p['description']);
  }
  return $p;
}



/****************************************************************************
 *
 ****************************************************************************/
function newClone($idTexte, $returnArray = false){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
    
  //--------------------------------------------------------
 
  //--------------------------------------------------------  
  $sql = "SELECT * FROM {$this->table} "
        ." WHERE idTexte = {$idTexte}";

  $sqlquery = $xoopsDB->fetchArray($xoopsDB->queryF ($sql));
  //$sqlquery['texte'] = str_replace("'","''",$sqlquery['texte']);
  //$sqlquery['texte'] = str_replace('"','""',$sqlquery['texte']);
  
  $sql = "INSERT INTO {$this->table} "
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
  $newIdTexte = $xoopsDB->getInsertId() ;
  //echo "<hr>JJD ---{$newIdLettre}-> {$sql}<hr>"; 
         
 
  //----------------------------------------------------------
  if ($returnArray) {
    return $this->getArray($newIdTexte);
  }else{
    return $this->getRow($newIdTexte);  
  }

}
/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table} "
	      ."(url,description) "
	      ."VALUES ('???','???')";
	
       $xoopsDB->query($sql);	

  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table} "
	      ."(url,description) "
	      ."VALUES ('','')";

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
	

  //------------------------------------
  
  $idFluxrss = $t['idFluxrss'];
  //-----------------------------------------------------------
   $t['txtUrl']         = string2sql($t['txtUrl']);
   $t['txtDescription'] = string2sql($t['txtDescription']);
   
   //inutilise pour le moment, a garder quand meme avcec une valeur par default   
   $t['txtOptions'] = 0;   

   

  if ($idFluxrss == 0){
    
      $sql = "INSERT INTO {$this->table} "
            ."(nom, url, description, colonnes, max, options)"
            ."VALUES (" 
            ."'{$t['txtNom']}',"  
            ."'{$t['txtUrl']}',"  
            ."'{$t['txtDescription']}',"            
            ."'{$t['txtColonnes']}',"            
            ."{$t['txtMax']},"            
            ."{$t['txtOptions']}"                          
            .")";

            
      $xoopsDB->query($sql);

   
  }else{
      $sql = "UPDATE {$this->table} SET "
           ."nom               = '{$t['txtNom']}',"
           ."url               = '{$t['txtUrl']}',"
           ."description       = '{$t['txtDescription']}',"  
           ."colonnes         = '{$t['txtColonnes']}',"
           ."max               = {$t['txtMax']},"
           ."options           = {$t['txtOptions']}"                                 
           ." WHERE idFluxrss = ".$idFluxrss;
          
      $xoopsDB->query($sql);            
  }
           
  //echo "<hr>{$sql}<hr>";exit;
}
//==============================================================================
} // fin de la classe

?>



