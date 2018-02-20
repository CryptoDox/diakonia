<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_libelle extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_libelle($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_LIBELLE, "idLibelle", $becho); 
  
  return true;
  
}

/*============================================================
 * methodes:
 =============================================================*/
  
/******************************************************
 *
 ******************************************************/
function getArray ($id, $becho = 0){
	global  $xoopsDB;

  if ($id == 0) {
      $p = array ('idLibelle'     => 0, 
                  'code'          => '',
                  'constant'      => '',
                  'texte'         => '',
                  'allowUpdate'   => 1,
                  'perso'         => 0,
                  'txtLocked'     => 0                  
                  );

  }
  else {
    $sqlquery = $this->getRow($id);
    $p = $xoopsDB->fetchArray($sqlquery);    
    
    $p['texte'] = sql2string ($p['texte']);
  }
  return $p;
}




/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (code,constant,texte,allowUpdate,perso,locked) "
	      ." VALUES ('','','',1,',0)";
	
       $xoopsDB->query($sql);	
  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ." (code,constant,texte,allowUpdate,perso,locked) "
	      ." VALUES ('','','',1,',0)";

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
  
  $idLibelle = $t['idLibelle'];
  //-----------------------------------------------------------
   //$t['txtCode']      = string2sql($t['txtCode']);
   //$t['txtConstant']  = string2sql($t['txtConstant']);  
    
   
   //$t['txtLibelle'] = string2sql($t['txtLibelle']);
  //$texte = $t['txtLibelle'];
  $texte = $t['txtTexte'];  
  $texte = $myts->makeTareaData4Save($texte);   
  $t['txtAllowUpdate']  = 1; //valeur par defaut pour le moment
  $t['txtPerso']        = 0; //valeur par defaut pour le moment  
  $t['txtLocked']       = 0; //valeur par defaut pour le moment
      
  if ($idLibelle == 0){
   $t['txtCode']      = sanitizeNameFile ($t['txtCode']); 
   $t['txtConstant']  = sanitizeNameFile ($t['txtConstant']);   
    
      $sql = "INSERT INTO  {$this->table} "
            ."(code, constant,texte,allowUpdate,perso,locked)\n"
            ."VALUES (" 
            ."'{$t['txtCode']}',"  
            ."'{$t['txtConstant']}',"
            ."'{$texte}',"
            ."{$t['txtAllowUpdate']},"
            ."{$t['txtPerso']},"  
            ."{$t['txtLocked']}"                      
            .")";

      $xoopsDB->query($sql);
    
  }else{
      if (isset($t['txtCode'])){
       $t['txtCode']      = sanitizeNameFile ($t['txtCode']); 
       $t['txtConstant']  = sanitizeNameFile ($t['txtConstant']);   
      
        $sql = "UPDATE  {$this->table} SET "
             ."code     = '{$t['txtCode']}',"
             ."constant = '{$t['txtConstant']}',"           
             ."texte          = '{$texte}'"           
             ." WHERE idLibelle = ".$idLibelle;
      
      }else{
        $sql = "UPDATE  {$this->table} SET "
             ."texte          = '{$texte}'"           
             ." WHERE idLibelle = ".$idLibelle;
      
      }           
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
return true;
//exit;
}



//==============================================================================
} // fin de la classe

?>



