<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_lettre extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_lettre($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_LETTRE, "idLettre", $becho); 
  
  return true;
  
}

/*============================================================
 * methodes:
 =============================================================*/
 /*********************************************************************

**********************************************************************/

 function getRowId($idLettre = 0){
	global $xoopsModuleConfig, $xoopsDB;
	
    
    $sqlDateFormat = ((defined("_MI_HER_DATE_FORMAT_SQL_VIEW")) 
                   ? _MI_HER_DATE_FORMAT_SQL_VIEW 
                   : _AD_HER_DATE_FORMAT_SQL_VIEW);
    
    $sql = "SELECT *, date_format(prochaineParution,'".$sqlDateFormat."') as dateCourte"
          ." FROM {$this->table}"
          ." WHERE {$this->colNameId} = $idLettre";
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query($sql);  
    return $sqlquery;
                
      
 }
   /*********************************************************************

**********************************************************************/

 function getRows($clauseOrderBy = '', $clauseWhere = ''){
	global $xoopsModuleConfig, $xoopsDB;
	
    if ($clauseWhere <> ''){
      $where = " WHERE {$clauseWhere} ";    
    }else{
      $where = '';    
    }
    
    $sqlDateFormat = ((defined("_MI_HER_DATE_FORMAT_SQL_VIEW")) ? _MI_HER_DATE_FORMAT_SQL_VIEW : _AD_HER_DATE_FORMAT_SQL_VIEW);
    $sql = "SELECT *, date_format(prochaineParution,'".$sqlDateFormat."') as dateCourte "
          ." FROM {$this->table}"
          .$where
          .(($clauseOrderBy == "" )?'':" ORDER BY {$clauseOrderBy}");
          
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);  
    return $sqlquery;
                
      
 }

/******************************************************
 *
 ******************************************************/
function getArray ($id, $typeLettre = 0, $colList = '*', $becho = 0){
	global  $xoopsDB;

  if ($id == 0) {
      $emailSender = (($xoopsModuleConfig['emailSender'] =='') ? "webmaster@{$_SERVER['SERVER_NAME']}" : $xoopsModuleConfig['emailSender']);
      $p = array ('idLettre'             => 0, 
                  'nom'                  => '',
                  'libelle'              => '',                  
                  'description'          => '',
                  'avertissement'        => _AD_HER_AVERTISSEMENT_DEFAULT,                  
                  'affichage'            => 255,       
                  'personnalisable'      => 1,           
                  'periodicite'          => _HER_PERIODE_MENSUELLE, 
                  'jour'                 => 1,
                  'dateParution'         => date('Y-m-d h:m:s', time()) ,                  
                  'prochaineParution'    => date('Y-m-d h:m:s', time()) ,
                  'delaiArchivage'       => 12,
                  'cheminArchivage'      => '',
                  'feuilleDeStyle'       => '',                  
                  'pageWidth'            => '',
                  'bgImg'                => '',      
                  'bgImgMode'            => 0,       
                  'bgImgRepeat'          => 0,                  
                  'bgImgPosH'            => 0,       
                  'bgImgPosV'            => 0,                  
                  'background'           => '#FFFFFF',
                  'typeLettre'           => $typeLettre,
                  'idLettreConfirmation' => 0,
                  'emailSender'          => $emailSender,
                  'send2Author'          => 0,
                  'idListe'              => 0,
                  'idListeTest'          => 0,
                  'chronoArchive'        => 0,
                  'statLecture'          => 1,
                  'statImgAlign'         => 1,
                  'statImg0'             => 'sumo.gif',
                  'statImg1'             => 'troll.gif',
                  'idFrame'              => 0,
                  'tplBody'              => '',
                  'tplHeader'            => '',                  
                  'tplFooter'            => '');
  }
  else {
    $sqlQuery = $this->getRowId($id,$colList,$becho);
    $p = $xoopsDB->fetchArray($sqlQuery);
        
    $p['nom']         = sql2string ($p['nom']);
    $p['description'] = sql2string ($p['description']);

  }
  
  if ($p['idListe'] == '')               $p['idListe'] = 0;
  if ($p['idListeTest'] == '')           $p['idListeTest'] = 0;  
  if ($p['affichage'] == '')             $p['affichage'] = 0;  
  if ($p['personnalisable'] == '')       $p['personnalisable'] = 1;  
  if ($p['bgImgMode'] == '')             $p['bgImgMode'] = 0;  
  if ($p['bgImgRepeat'] == '')           $p['bgImgRepeat'] = 0;  
  if ($p['bgImgPosH'] == '')             $p['bgImgPosH'] = 0;  
  if ($p['bgImgPosV'] == '')             $p['bgImgPosV'] = 0;  
  if ($p['idLettreConfirmation'] == '')  $p['idLettreConfirmation'] = 0;  
  if ($p['typeLettre'] == '')            $p['typeLettre'] = 0;  
  if ($p['send2Author'] == '')           $p['send2Author'] = 0; 
  
  return $p;
}




/****************************************************************************
 *
 ****************************************************************************/
function newClone($id, $returnArray = false, $name2AddCopy = 'nom'){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
  
   
  //--------------------------------------------------------
  //$t = cls_jjd_ado::newClone($id, $returnArray, $name2AddCopy);
  $tClone = cls_jjd_ado::newClone($id, $returnArray, $name2AddCopy);  
  $newId = $tClone[$this->colNameId] ;
  //-------------------------------------------------------
  
  
  //-----------------------------------------------------
  //duplication des appartenances aux groupes
  //-----------------------------------------------------  
  
  cls_jjd_ado::newCloneChild($id, $newId, _HER_TFN_GROUPE, 'idGroupe', $this->colNameId, true);  
  
  //-----------------------------------------------------
  //duplication des appartenances aux structures
  //-----------------------------------------------------
  
  cls_jjd_ado::newCloneChild($id, $newId, _HER_TFN_STRUCTURE, 'idStructure', $this->colNameId, true);  
    
 
  //----------------------------------------------------------
  return $tClone;

}


/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table}"
	      ."(nom) "
	      ."VALUES ('')";
	
       $xoopsDB->query($sql);	

  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table} "
	      ." (name) "
	      ." VALUES ('')";

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
    
//her_displayArray ($t, "======= saveLettre ==========");  
  $idLettre = $t['idLettre'];
  //-----------------------------------------------------------
  $bDef = checkBoxToBin($t, 'definitions', $def);  
  $bSearch = checkBoxToBin($t, 'xoopsSearch', $def);  
  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);
  //-----------------------------------------------------------
   //$t['txtName']            = string2sql($t['txtName']);
   $t['txtName']            = sanitizeNameFile ($t['txtName']);   

   $t['txtLibelle']         = string2sql($t['txtLibelle']);   
   $t['txtCheminArchivage'] = string2sql($t['txtCheminArchivage']);
   $t['txtPageWidth']       = string2sql($t['txtPageWidth']); 
   $t['emailSender']       = string2sql($t['txtEmailSender']);   
   
     
   if (!isset($t['txtbgImg']))  $t['txtbgImg'] ==''; 
   //$t['txtDescription']     = string2sql($t['txtDescription']);   
   //$txt = $t['txtDescription'];
   $txt = $t['txtTexte'];   
   $txt = $myts->makeTareaData4Save($txt);   
   $avertissement = $myts->makeTareaData4Save($t['txtAvertissement']);   
  //-----------------------------------------------------------
  //pour les lettre de confirmation qui n'ont pas tous les champs
  if (!isset($t['txtIdLettreConfirmation'])) $t['txtIdLettreConfirmation']=0;
  //-----------------------------------------------------------   
  //$lstPrefixe = "txtCSS";
  //$tCSS =  getArrayOnPrefixArray ($t, $lstPrefixe);  
  //$feuilleDeStyle = $tCSS[$t['txtFeuilleDeStyle']]['txtCSS'];
  
  $feuilleDeStyle = $t['txtFeuilleDeStyle'];  
  
  //displayArray ($tCSS, "======= saveLettre =t CSS =========");
   //$t['txtFeuilleDeStyle']  = string2sql();  
  //-----------------------------------------------------------   
  if ( $t['typeLettre'] <> 0){
      $t['txtEmailSender']          = '';  
      $t['txtIdLettreConfirmation'] = 0;  
      $t['txtPeriodicite']          = 0;
      $t['txtJour']                 = 0;
      $t['txtAffichage']            = 0;      
      $t['txtPersonnalisable']      = 1;
      $t['txtProchaineParution']    = '';            
      //$t['txtArchiver']             = 0;
      $t['txtDelaiArchivage']       = 0;   
      $t['txtCheminArchivage']      = '';   
      $t['txtSend2Author']          = 0;     
      $t['txtIdListe']              = 0;      
      $t['txtIdListeTest']          = 0;   
      $t['txtChronoArchive']        = 0;  
      $t['txtStatLecture']          = 0;
      $t['txtStatImg0']             = '';      
      $t['txtStatImg1']             = '';     
      $t['txtStatImgAlign']         = 0;        
  }
  //-------------------------------------------------------
  // preparation de la liste des groupes
  //-------------------------------------------------------  
  $lstGroupes = buildGroupes2StrList('chkGroupe', $t);
  $tGroups = explode (',', $lstGroupes);
  //-------------------------------------------------------
  // fin preparation des groupes
  //-------------------------------------------------------  

  //-----------------------------------------------------------        
  if ($idLettre == 0){

      $sql = "INSERT INTO {$this->table} \n"
            ."(nom,libelle,description,avertissement,affichage,personnalisable,periodicite,"
            ."jour,prochaineParution,delaiArchivage,cheminArchivage, "
            ."background,feuilleDeStyle,"
            ."pageWidth,bgImgMode,bgImgRepeat,bgImgPosH,bgImgPosV,bgImg,"
            ."idLettreConfirmation, typeLettre,emailSender,send2Author,groupes,"
            ."idListe,idListeTest,chronoArchive,"
            ."statLecture,statImg0,statImg1,statImgAlign,idFrame,"
            ."tplBody,tplHeader,tplFooter) \n"
            ."VALUES (" 
            ."'{$t['txtName']}'," 
            ."'{$t['txtLibelle']}',"             
            ."'{$txt}',"  
            ."'{$avertissement}',"              
            ."{$bAffichage},"   
            ."{$t['txtPersonnalisable']},"                             
            ."{$t['txtPeriodicite']},"            
            ."{$t['txtJour']},"
            ."'{$t['txtProchaineParution']}',"
            ."{$t['txtDelaiArchivage']},"            
            ."'{$t['txtCheminArchivage']}',"   
            ."'{$t['txtBackground']}',"   
            ."'{$feuilleDeStyle}',"     
            ."'{$t['txtPageWidth']}',"            
            ."{$t['txtbgImgMode']},"         
            ."{$t['txtbgImgRepeat']},"            
            ."{$t['txtbgImgPosH']},"         
            ."{$t['txtbgImgPosV']},"            
            ."'{$t['txtbgImg']}',"
            ."{$t['txtIdLettreConfirmation']},"
            ."{$t['typeLettre']},"
            ."'{$t['txtEmailSender']}',"
            ."{$t['txtSend2Author']},"
            ."'{$lstGroupes}',"        
            ."{$t['txtIdListe']},"            
            ."{$t['txtIdListeTest']},"  
            ."{$t['txtChronoArchive']},"   
            ."{$t['txtStatLecture']},"   
            ."'{$t['txtStatImg0']}',"            
            ."'{$t['txtStatImg1']}',"   
            ."{$t['txtStatImgAlign']},"       
            ."{$t['txtIdFrame']},"  
            ."'{$t['txtTplBody']}'," 
            ."'{$t['txtTplHeader']}',"            
            ."'{$t['txtTplFooter']}'"                                               
            .")";
            
      $xoopsDB->query($sql);
      $idLettre = $xoopsDB->getInsertId() ;
      
  }else{

      
      $sql = "UPDATE {$this->table} SET "
           ."nom                  = '{$t['txtName']}',"
           ."libelle              = '{$t['txtLibelle']}',"           
           ."description          = '{$txt}',"  
           ."avertissement        = '{$avertissement}',"            
           ."affichage            = {$bAffichage},"    
           ."personnalisable      = {$t['txtPersonnalisable']},"                          
           ."periodicite          = {$t['txtPeriodicite']},"           
           ."jour                 = {$t['txtJour']},"   
           ."prochaineParution    = '{$t['txtProchaineParution']}',"    
           ."delaiArchivage       = {$t['txtDelaiArchivage']},"   
           ."cheminArchivage      = '{$t['txtCheminArchivage']}'," 
           ."background           = '{$t['txtBackground']}',"     
           ."feuilleDeStyle       = '{$feuilleDeStyle}',"  
           ."pageWidth            = '{$t['txtPageWidth']}',"
           ."bgImgMode            = {$t['txtbgImgMode']},"           
           ."bgImgRepeat          = {$t['txtbgImgRepeat']},"        
           ."bgImgPosH            = {$t['txtbgImgPosH']},"           
           ."bgImgPosV            = {$t['txtbgImgPosV']},"        
           ."bgImg                = '{$t['txtbgImg']}',"
           ."idLettreConfirmation = {$t['txtIdLettreConfirmation']},"
           ."emailSender          = '{$t['txtEmailSender']}',"
           ."send2Author          = {$t['txtSend2Author']},"
           ."groupes              = '{$lstGroupes}',"  
           ."idListe              = {$t['txtIdListe']},"           
           ."idListeTest          = {$t['txtIdListeTest']},"   
           ."chronoArchive        = {$t['txtChronoArchive']},"  
           ."statLecture          = {$t['txtStatLecture']},"      
           ."statImg0             = '{$t['txtStatImg0']}',"           
           ."statImg1             = '{$t['txtStatImg1']}'," 
           ."statImgAlign         = {$t['txtStatImgAlign']},"   
           ."idFrame              = {$t['txtIdFrame']},"  
           ."tplBody              = '{$t['txtTplBody']}',"     
           ."tplHeader            = '{$t['txtTplHeader']}',"
           ."tplFooter            = '{$t['txtTplFooter']}'"                                                      
           ." WHERE idLettre = ".$idLettre;

      $xoopsDB->query($sql);   
      //computeNewParution($idLettre);               
  }
  
  //echo "<hr>saveLettre<br>{$sql}<hr>";
  //----------------------------------------
  //$bSearch = checkBoxToBin($t, 'xoopsSearch', $def);        
  
  //-------------------------------------------------------
  // enregistrement des groupes
  //-------------------------------------------------------  

  $sql = "DELETE FROM "._HER_TFN_GROUPE.
         " WHERE idLettre = ".$idLettre;
  $xoopsDB->query($sql);         
  
  if (count($tGroups) > 0){
    for ($h = 0; $h < count($tGroups); $h++){
      $sql = "INSERT INTO "._HER_TFN_GROUPE
           ." (idLettre, idGroupe)"
           ." VALUES ({$idLettre},{$tGroups[$h]})";
      $xoopsDB->query($sql);         
    
    }
  }  
  //-------------------------------------------------------
  // fin enregistrement des groupes
  //-------------------------------------------------------  

}


/****************************************************************
 *
 ****************************************************************/

function deleteId ($id) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	//$this->deleteId($id);
	cls_jjd_ado::deleteId($id);	
  //--------------------------------------------------------------
	$sql = "DELETE FROM "._HER_TFN_GROUPE." "
	      ."WHERE idLettre = ".$id;
	
  $xoopsDB->query($sql);	
	
  //--------------------------------------------------------------
	$sql = "DELETE FROM "._HER_TFN_STRUCTURE." "
	      ."WHERE idLettre = ".$id;
	
  $xoopsDB->query($sql);	
	
  //--------------------------------------------------------------
	$sql = "DELETE FROM "._HER_TFN_USERS." "
	      ."WHERE idLettre = ".$id;
	
  $xoopsDB->query($sql);	
  
}

//==============================================================================
} // fin de la classe

?>



