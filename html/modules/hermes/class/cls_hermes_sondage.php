<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************
******************************************************************************/
include_once (XOOPS_ROOT_PATH . "/modules/jjd_tools/_common/class/cls_jjd_ado.php");

class cls_hermes_sondage extends cls_jjd_ado {  

/************************************************************
 * declaration des variables membre:
 ************************************************************/

      
/*============================================================
 * Constructucteur:
 =============================================================*/
//function  cls_hermes_texte($table, $colNameId, $becho = 0){
function  cls_hermes_sondage($becho = 0){
  cls_jjd_ado::cls_jjd_ado(_HER_TFN_SONDAGE, "idSondage", $becho); 
  
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
      $p = array ('idSondage'     =>  0, 
                  'nom'           => '',
                  'categorie'     => '',                  
                  'description'   => '',
                  'dateDebut'     => date('Y-m-d h:m:s', time()) ,
                  'dateFin'       => date('Y-m-d h:m:s', time()) ,                  
                  'disposition'   => 1,
                  'groupes'       => '1,2',
                  'mode'          => 2);                  
                  
  }
  else {
    $sqlQuery = $this->getRow($id,$colList,$becho);
    $p = $xoopsDB->fetchArray($sqlQuery);
    
    $p['nom']         = sql2string ($p['nom']);
    $p['description'] = sql2string ($p['description']);
  }
  return $p;
}

/****************************************************************************
 *
 ****************************************************************************/
function newClone($id, $returnArray = false, $name2AddCopy = ''){
	global $xoopsModuleConfig, $xoopsDB, $xoopsModule;  
    
  //--------------------------------------------------------
  //$t = cls_jjd_ado::newClone($id, $returnArray, $name2AddCopy);
  $tClone = cls_jjd_ado::newClone($id, $returnArray, $name2AddCopy);  
  $newId = $tClone['idSondage'] ;
  //-------------------------------------------------------
  cls_jjd_ado::newCloneChild($id, $newId, _HER_TFN_REPONSE, 'idReponse', $this->colNameId, true); 
  //----------------------------------------------------------
  return $tClone;

}

/****************************************************************
 *
 ****************************************************************/

function newRow ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table} "
	      ."(nom,description,dateDebut,dateFin,idFrame,groupes) "
	      ."VALUES ('','','','',0,'')";
	
       $xoopsDB->query($sql);	

 
  
}
/****************************************************************
 *
 ****************************************************************/

function newEmptyRow () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO {$this->table} "
	      ."(nom,description,dateDebut,dateFin,idFrame,groupes) "
	      ."VALUES ('','','','',0,'')";

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
  
  $idSondage = $t['idSondage'];
  //-----------------------------------------------------------
   $t['txtName']         = string2sql($t['txtName']);
   $t['txtCategorie']   = string2sql($t['txtCategorie']);   
   $txt = $t['txtDescription'];   
   $txt = $myts->makeTareaData4Save($txt);
   $dateDebut   = $t['txtDateDebut'];
   $dateFin = $t['txtDateFin'];
   $lstGroupes = buildGroupes2StrList('chkGroupe', $t, true);
       
  if ($idSondage == 0){
    
      $sql = "INSERT INTO  {$this->table} "
            ."(nom,categorie,description,dateDebut,dateFin,disposition,groupes,mode)"
            ."VALUES (" 
            ."'{$t['txtName']}',"  
            ."'{$t['txtCategorie']}',"  
            ."'{$txt}',"            
            ."{$dateDebut},"     
            ."{$dateFin},"            
            ."{$t['txtDisposition']},"
            ."'{$lstGroupes}',"                                                     
            ."{$t['txtMode']}"              
            .")";

      $xoopsDB->query($sql);
      $t['idSondage'] = $xoopsDB->getInsertId() ;    
      
  }else{
      $sql = "UPDATE  {$this->table} SET "
           ."nom           = '{$t['txtName']}',"
           ."categorie     = '{$t['txtCategorie']}',"           
           ."description   = '{$txt}',"  
           ."dateDebut     = '{$dateDebut}',"           
           ."dateFin       = '{$dateFin}',"           
           ."disposition   = {$t['txtDisposition']},"
           ."groupes       = '{$lstGroupes}',"
           ."mode          = {$t['txtMode']}"                      
           ." WHERE idSondage = ".$idSondage;
 
          
      $xoopsDB->query($sql);            
  }
  
  //-------------------------------------------------
  //sauvegarde de la liste des réponses
  //-------------------------------------------------           
  $this->saveReponses ($t);
  
  
  
//echo "<hr>{$sql}<hr>";
}
/****************************************************************
 *
 ****************************************************************/
function saveReponses (&$p) {
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //her_displayArray($p,"--- saveReponses--- ");
  $lstPrefixe = "txtIdReponse;txtReponse;txtOrdre";  
  $idSondage = $p['idSondage'];  
 
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
  //displayArray($t, "******saveReponses*************");
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------

  //$h=0;
  while (list($key, $item) = each ($t)){  
    //her_displayArray($item,"--- item--- ");      
    $idReponse = $item['txtIdReponse'];
    $nom = string2sql ($item['txtReponse']);
    $ordre = $item['txtOrdre'];
    $sql = '';
    
    if (trim($nom) == '' & $idReponse == 0) continue;
    //-------------------------------------------------------------    
    if (trim($nom) == '') {
      $sql = "DELETE FROM "._HER_TFN_REPONSE
           ." WHERE idReponse = {$idReponse}"; 
    }elseif ($this->existInTable(_HER_TFN_REPONSE,$idReponse, 'idReponse')){
      $sql = "UPDATE "._HER_TFN_REPONSE." SET "
           ."idSondage = {$idSondage},"     
           ."nom = '{$nom}',"
           ."ordre = {$ordre}"  
           ." WHERE idReponse = {$idReponse}"; 
    }else{
      $sql = "INSERT INTO "._HER_TFN_REPONSE
            ." (idSondage,nom,ordre) "
            ." VALUES ("
            ."{$idSondage},"
            ."'{$nom}',"
            ."{$ordre}"
            .")";    
    }  
    
    //echo "<hr>saveReponses<br{$sql}><hr>";
    if ($sql <> '') $xoopsDB->query($sql);    

  }
    
//echo "<hr>"; exit;   
} 
/************************************************************************
 *construction du texte à insérer ans l'objet texte lui meme inséré dans la lettre
 ************************************************************************/
function buildSondageArray($prefixe = _HER_PREFIXE_SONDAGE, $sep="-"){
	global $xoopsModuleConfig, $xoopsDB;  
  
  $sqlquery = $this->getRows('nom');	
  $t = array();


   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $k = $this->buildKey($prefixe, $sqlfetch['nom'], $sqlfetch['idSondage'], true, $sep );
      $t[$k] = $this->buildSondage($sqlfetch['idSondage']);
    }
    
  //her_displayArray($t,"--- buildSondageArray ---");    
  return $t;
  
  
}

/*
function buildSondageArray($prefixe = _HER_PREFIXE_SONDAGE, $sep="-"){
	global $xoopsModuleConfig, $xoopsDB;  
  
  $sqlquery = $this->getRows('nom');	
  $t = array();


   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $k = $this->buildKey($prefixe, $sqlfetch['nom'], $sep , $sqlfetch['idSondage']);      
      $item = explode(_HER_SEPCODE, $k);

      $t[$item[0]] = $this->buildSondage($sqlfetch['idSondage']);
    }
    
  //her_displayArray($t,"--- buildSondageArray ---");    
  return $t;
  
  
}

*/
/************************************************************************
 *construction du texte à insérer ans l'objet texte lui meme inséré dans la lettre
 ************************************************************************/
function buildSondage($idSondage){
  
  $myts =& MyTextSanitizer::getInstance();  
  $t = array();  
  //-------------------------------------------------
  $sondage = $this->getArray($idSondage);
  $t[] = "<b>".$myts->previewTarea($sondage['nom'],1,0,0,0,0)."</b>"; 
  $t[] = "<b>identifiant du sondage : {$sondage['idSondage']}</b>";  
  $t[] = "<hr>";  
  //$txt = $sondage['description'];
  //$txt = $myts->previewTarea($txt,1,0,0,0,0);  
  //$t[] = $txt;
  
  $t[] = $myts->previewTarea($sondage['description'],1,0,0,0,0);  
  $t[] = "<hr>";  
  
  $r = $this->getChildrenArray(_HER_TFN_REPONSE, $idSondage, $orderBy = 'ordre,nom');
  //her_displayArray($r,"--- buildSondage ---");
  //$sondage['disposition'] = 0;  
  
  switch ($sondage['disposition']){
    case 0:
      $deb = '';
      $fin = '';
      $sep = ' | ';
      $row = "%s";
      $cols = 1; 
      break;
      
    case 1:
      $deb = "";
      $fin = '';
      $sep = '<br>';
      $row = "%s";
      $cols = 1;
      break;
    
    default:
      $deb = "<table border='0'><tr>";
      $fin = '</tr></table>';
      $sep = '</tr><tr>';
      $row = "<td>%s</td>";
      $cols = $sondage['disposition'];
      break;
  }
  //$t[] = "<br>disposition = {$sondage['disposition']}-{$col}<br>";  //debug
  $t[] = $deb;  
      $tr = array();
      $h = 0;
      $max = count($r);
      
      while (list($key,$item) = each($r)){
        $h++;    
        $item['codeReponse'] = '';//non défini dans la base, a voir !!!
        $params = $this->buildLinkParams(1, $idSondage, $item['idReponse'], $item['codeReponse']);
        $url = _HER_URL.'sondage.php?op=vote&code=';
        $link = "<A href='{$url}{$params}' target='blank'>{$item['nom']}</A>";
        
        $tr[] = sprintf($row, $link)  ; 
        //if ((($h % $cols) == 0) ) $tr[] =  "<td><b>{$h}-{$col}</b></td>".$sep ;        
        if ((($h % $cols) == 0) ) $tr[] =  $sep ;        

      }
  
  $t[] = implode('',$tr);
  $t[] = $fin;
  //----------------------------------------------------------  
  return implode ("\n", $t);


}
/************************************************************************
 *construction du texte à insérer ans l'objet texte lui meme inséré dans la lettre
 ************************************************************************/
function buildLinkParams($version, $idSondage, $idReponse, $codeReponse, $sep='|'){
  $t = array();
  
  switch ($version){
    case 1://a définir dans les future version
    case 2:
    case 3:  
          
    default:
        $t['version']     = $version;  
        $t['action']      = 'vote';  
        $t['idSondage']   = $idSondage;
        $t['idReponse']   = $idReponse;
        $t['codeReponse'] = $codeReponse;
        $t['email']       = '[user.email]';
      break;
    }
  
  return implode($sep, $t);
  
}

/************************************************************************
 *construction du texte à insérer ans l'objet texte lui meme inséré dans la lettre
 ************************************************************************/
function parseLinkParams($params, $sep='|'){
  
  $p = explode ($sep, $params);
  //her_DisplayArray($p,"----- parseLinkParams ->{$params}-----");
  $t = array();
  
  switch ($p[0]){
    case 1://a définir dans les future version
    case 2:
    case 3:  
          
    default:
      $t['version']     = $p[0];  
      $t['action']      = $p[1];  
      $t['idSondage']   = $p[2];
      $t['idReponse']   = $p[3];
      $t['codeReponse'] = $p[4];
      $t['email']       = $p[5];
      break;
    }
    
  //------------------------------
  return $t;
}

/************************************************************************
 *construction du texte à insérer ans l'objet texte lui meme inséré dans la lettre
 ************************************************************************/
function buildCodeList($prefixe, $sep = '-'){
	global $xoopsModuleConfig, $xoopsDB;  
  
  $sqlquery = $this->getRows('nom');	
  $t = array();


   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $t[] = $this->buildKey($prefixe, $sqlfetch['nom'], $sqlfetch['idSondage'], false, $sep);
    }
    
  return $t;
  
}

/************************************************************************
 *construction du texte à insérer ans l'objet texte lui meme inséré dans la lettre
 ************************************************************************/
function buildKey($prefixe, $caption, $id, $bShort, $sep = '-'){
	global $xoopsModuleConfig, $xoopsDB;  
  
  return $prefixe.$id.(($bShort) ? '' : _HER_SEPCODE.$caption);
  
}
/*
function buildKey($prefixe, $caption, $sep = '-', $id){
	global $xoopsModuleConfig, $xoopsDB;  
  $sep = '';
  return 
  
}

*/
/************************************************************************
 *ajoute un nouveau vote au sondage
 ************************************************************************/
function addVote($t){
	global $xoopsModuleConfig, $xoopsDB;  
	
	if ($t['email'] == "[user.email]") $t['email'] = 'jjd@kiolo.com';
	//her_displayArray($t,"----- addVote -----");


	$mode = $this->getValue($t['idSondage'], 'mode');
	
	$sqlDelete = "DELETE tResultat.* "
              ."FROM "._HER_TFN_RESULTAT." AS tResultat, "
              ."     "._HER_TFN_REPONSE." AS tReponse "
	            ." WHERE tResultat.idReponse = tReponse.idReponse "
              ."   AND tReponse.idSondage = {$t['idSondage']}"
	            ."   AND tResultat.email = '{$t['email']}'";

	$sqlInsert = "INSERT INTO "._HER_TFN_RESULTAT
	            ." (idReponse,email,reponse,dateReponse) "
	            ." VALUES ({$t['idReponse']},'{$t['email']}',1,0)";
	
  $filter = "idReponse = {$t['idReponse']} AND email = '{$t['email']}'";              
	$sqlUpdate = "UPDATE "._HER_TFN_RESULTAT
	            ." SET reponse = reponse + 1 "
	            ." WHERE {$filter} ";
  

  
  //-------------------------------------------------------------------------
  switch ($mode){
    case 1:
    case 2:    
	    $xoopsDB->queryF($sqlDelete);   
	    $xoopsDB->queryF($sqlInsert);         
      break;
    
    case 3:
      $nbVotes = geScalaire( _HER_TAB_RESULTAT,'idReponse', $filter, 'count');
      if ($nbVotes == 0){
	       $xoopsDB->queryF($sqlInsert);      
      }else{
	       $xoopsDB->queryF($sqlUpdate);      
      }
      break;
    
    default:
      break;
  }
	//------------------------------------------------
  return true;  
}

/************************************************************************
 *retourne un tableau des réssultats
 ************************************************************************/
function getResultats($idSondage, &$totSomme, &$totPourcentage){
	global $xoopsModuleConfig, $xoopsDB;  
	
  $t = array();
  /*
SELECT reponse.idSondage, reponse.idReponse, reponse.ordre, reponse.nom, IIf(Sum(resultat.compte) Is Null,0,Sum(resultat.compte)) AS SommeDecompte
FROM reponse LEFT JOIN resultat ON reponse.idReponse = resultat.idReponse
GROUP BY reponse.idSondage, reponse.idReponse, reponse.ordre, reponse.nom
HAVING (((reponse.idSondage)=1))
ORDER BY reponse.idSondage, reponse.ordre, reponse.nom;
  */
  
  $sql = "SELECT reponse.idSondage, reponse.idReponse, reponse.ordre, reponse.nom, "
        ."If(Sum(resultat.reponse) Is Null,0,Sum(resultat.reponse)) AS sommeDeReponse "
        ." FROM "._HER_TFN_REPONSE." AS reponse "
        ." LEFT JOIN "._HER_TFN_RESULTAT." AS resultat "
        ." ON reponse.idReponse = resultat.idReponse "
        ." GROUP BY reponse.idSondage, reponse.idReponse, reponse.ordre, reponse.nom "
        ." HAVING (reponse.idSondage={$idSondage}) "
        ." ORDER BY reponse.idSondage, reponse.ordre, reponse.nom";
  
  //echo "<hr>getResultats<br>{$sql}<hr>" ;     
	$sqlquery = $xoopsDB->query($sql);        
   
   $totSomme = 0;     
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $totSomme += $sqlfetch ['sommeDeReponse'];
      $t[] = $sqlfetch;      
    }
   /*

   reset($sqlquery); 
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $m = $sqlfetch['sommeDeReponse'] / $tot * 100 ;
      $sqlfetch['moyenne'] = number_format($m, 2, ',', ' ');
      $t[] = $sqlfetch;
    }
   */    
    for ($h = 0; $h < count($t); $h++){
       if ($totSomme == 0){
           $m = 0 ;      
       }else{
          $m = $t[$h]['sommeDeReponse'] / $totSomme * 100 ;       
       }

       $t[$h]['pourcentage'] = number_format($m, 2, ',', ' ') . ' %';   
    }
    //-------------------------------------------------------------
    $totPourcentage =  number_format(100, 2, ',', ' ') . ' %';
    return $t;    
        
        
}

//==============================================================================
} // fin de la classe

?>



