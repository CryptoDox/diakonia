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


                               
require_once ("hermes_constantes.php");
include_once (_HER_JJD_PATH."/include/functions.php");

//---------------------------------------------------------------/
global $toto;

/*********************************************************************

**********************************************************************/


/*********************************************************************
 *
**********************************************************************/
function getCodeStat1($params, $sep = '|'){
//displayArray($params ,"----- getCodeStat -----");

    //-------------------------------------------------------
    $tc = array();
    $tc[] = $params['idLettre'];
    $tc[] = $params['idArchive'];
    $tc[] = $params['stat_code'];
    $tc[] = $params['stat_id'];
    $tc[] = $params['stat_increment'];
    //---------------------------------------------------------------
    $code = implode($sep, $tc);
    //-------------------------------------------------------   
  return $code;      

}
/*********************************************************************
 *
**********************************************************************/
function getCodeStat2($params, $sep = '|'){
//displayArray($params ,"----- getCodeStat -----");
    
    $codeVersion = 1;
    //-------------------------------------------------------
    $tc = array();
    $tc[] = $codeVersion;  //en prevision d'un codage de l'email 0=non code 1=code md5 todo ou d'ne modif du code   
    
    switch ($codeVersion){
      case 0:
        $tc[] = $params['_user.idUser'];      
        $tc[] = $params['_user.email'];
        $tc[] = $params['idLettre'];
        $tc[] = $params['idArchive'];    
        break;
        
      case 1:
        $tc[] = $params['_user.idUser'];      
        $t = explode('@', $params['_user.email'].'@');  
        $tc[] = $t[0];  
        $tc[] = $t[1];    
        $tc[] = $params['idLettre'];
        $tc[] = $params['idArchive'];    
        break;
        
      default:
        //todo : faire un codeVerion=2 avec codeage de l'email
        $tc[] = $params['_user.idUser'];      
        $t = explode('@', $params['_user.email']);  
        $tc[] = $t[0];  
        $tc[] = $t[1];    
        $tc[] = $params['idLettre'];
        $tc[] = $params['idArchive'];    
        break;
    }

            
    //---------------------------------------------------------------
    $code = implode($sep, $tc);
    //-------------------------------------------------------   
  return $code;      


}
/*********************************************************************
 *
**********************************************************************/
function parseCodeStat($code, $sep1 = '_', $sep2 = '|'){
//displayArray($params ,"----- getCodeStat -----");
 global $xoopsUser, $xoopsModule, $xoopsDB;
    //-------------------------------------------------------
    $t  = explode($sep1, $code.str_repeat($sep1, 2));
    $t0 = explode($sep2, $t[0].str_repeat($sep2, 8));  
     
    if ($t[1] == '') $t[1] = str_repeat('0|',8); 
    $t1 = explode($sep2, $t[1].str_repeat($sep2, 8));
    
    //-------------------------------------------------------    
    $tc = array();        
    
    $tc['idLettre']       = $t0[0];
    $tc['idArchive']      = $t0[1];
    $tc['stat_code']      = $t0[2];
    $tc['stat_id']        = $t0[3];
    $tc['increment']      = $t0[4];
    //-------------------------------    
    $tc['ip'] = $_SERVER['REMOTE_ADDR'];    
    //-------------------------------
    $tc['codeVersion']    = $t1[0];
    switch ($tc['codeVersion']){
      case 0:
        $tc['idUser']     = $t1[1];  
        $tc['email']      = $t1[2];        
        $tc['idLettre']   = $t1[3];        
        $tc['idArchive']  = $t1[4];        
        break;
        
      case 1:
        $tc['idUser']     = $t1[1];      
        $tc['email']      = $t1[2].'@'.$t1[3];        
        $tc['idLettre']   = $t1[4];        
        $tc['idArchive']  = $t1[5];        
        break;
        
      default:
        //todo : faire un codeVerion=2 avec codeage de l'email
        $tc['idUser']     = $t1[1];      
        $tc['email']      = $t1[2].'@'.$t1[3];        
        $tc['idLettre']   = $t1[4];        
        $tc['idArchive']  = $t1[5];        
        break;
    }
           
    $sql = "SELECT * FROM "._HER_TFN_ARCHIVE." WHERE idArchive = {$tc['idArchive']}";
    $sqlquery = $xoopsDB->query ($sql);  
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    if ($nbEnr == 0){
      $nbJours = 0;    
    }else{
      $sqlfetch = $xoopsDB->fetchArray ($sqlquery);    
      $nbJours = difDays (time(), strtotime($sqlfetch['dateParution']));  
    }    

//echo "<hr>parseCodeStat<br>{$sql}<hr>";
//displayArray($sqlfetch ,"----- parseCodeStat -----");
    
    //$nbJours = difDays (strtotime($sqlfetch['prochaineParution']));;    
    //$nbJours = difDays (strtotime($sqlfetch['dateParution']), time());    
    //if ($nbJours < 0 )  $nbJours = $tc['idArchive'];
    $tc['time'] = time();    
    $tc['quantieme'] = $nbJours;
        
    //---------------------------------------------------------------
  return $tc;      

}

/*****************************************************************
 
 *****************************************************************/
function addNewStat($code, $sep1 = '_', $sep2 = '|', $debug = false, $img = 0){
global $xoopsUser, $xoopsModule, $xoopsModuleConfig, $xoopsDB;   
  //echo "<hr>addNewStat<br>{$code}<hr>";
  
  if ($debug) echo "<hr>";  
  $t = parseCodeStat($code, $sep1, $sep2);
  if ($debug) her_displayArray($t, "----- parseCodeStat -----");
  //------------------------------------------------------
  if ($t['idArchive'] == 0){
    $sql = "SELECT * FROM "._HER_TFN_LETTRE
          ." WHERE idLettre = {$t['idLettre']}";
    $sqlquery = $xoopsDB->query ($sql);
    $sqlfetch = $xoopsDB->fetchArray($sqlquery); 
    if ($debug) her_displayArray($sqlfetch,"----- addNewStat -----");  
    //echo "<hr>addNewStat<br>$sql<hr>";
    
    if ($sqlfetch ['statLecture'] == 1){
        $sqlfetch ['statImg0'] = 'statImg1px.gif';
        $sqlfetch ['statImg1'] = 'statImg1px.gif';    
    }else{
        if ($sqlfetch ['statImg0'] == '') $sqlfetch ['statImg0'] = 'statImg1px.gif';
        if ($sqlfetch ['statImg1'] == '') $sqlfetch ['statImg1'] = 'statImg1px.gif';    
    } 
    $statImg0 = _HER_ROOT_PATH.'images/'.$sqlfetch ['statImg0'];   
    $statImg1 = _HER_ROOT_PATH.'images/'.$sqlfetch ['statImg1'];     

  }else{
    $sql = "SELECT * FROM "._HER_TFN_ARCHIVE
          ." WHERE idArchive = {$t['idArchive']}";
    $sqlquery = $xoopsDB->query ($sql);
    $sqlfetch = $xoopsDB->fetchArray($sqlquery);   
    if ($sqlfetch ['cheminArchivage'] == '') {
      $f = _HER_ROOT_PATH.'archives/';
    }else{
      $f =   $sqlfetch ['cheminArchivage'];   
    }
    $sf = baseName($sqlfetch ['nomFichier'],'.html');
    //if ($sqlfetch ['statImg0'] == '') $sqlfetch ['statImg0'] = 'statImg1px.gif';
    //if ($sqlfetch ['statImg1'] == '') $sqlfetch ['statImg1'] = 'statImg1px.gif';    
    
    $statImg0 = $f.$sf.'/statImg0.gif';   
    $statImg1 = $f.$sf.'/statImg1.gif';   
    //displayArray8($sqlfetch,"----- addNewStat -----");      
    //echo "<hr>addNewStat<br>$statImg0<hr>";    
  }
  
  if ($debug) {
    echo "statImg0 : {$statImg0}<br>statImg1 : {$statImg1}<hr>";
    
    $urlImg0 = str_replace(_HER_ROOT_PATH, _HER_URL, $statImg0);
    $urlImg1 = str_replace(_HER_ROOT_PATH, _HER_URL, $statImg1);
    echo "urlImg0 : <A href='{$urlImg0}'>{$urlImg0}</A><br>urlImg1 : <A href='{$urlImg1}'>{$urlImg1}</A><hr>";    
        
  }
  // controle de la valider de la lecture

  $ok = true;
  //------------------------------------------------------  
  if ($xoopsModuleConfig['statMaxLectureByIP'] > 0) {
    $filter = "idArchive = {$t['idArchive']} AND ip = '{$t['ip']}'";
    $nbEnr = geScalaire(_HER_TAB_LECTURE, 'idArchive', $filter);  
    if ($nbEnr >= $xoopsModuleConfig['statMaxLectureByIP']) $ok = false;                                         
  }
  if ($xoopsModuleConfig['statMaxLectureByEM'] > 0) {
    $filter = "idArchive = {$t['idArchive']} AND email = '{$t['email']}'";
    $nbEnr = geScalaire(_HER_TAB_LECTURE, 'idArchive', $filter);  
    if ($nbEnr >= $xoopsModuleConfig['statMaxLectureByEM']) $ok = false;                                         
  
  }                                            
  
  if ($debug) echo "<b>Lettre lue  {$nbEnr} fois</b><br>";  
  
  if (!$ok) {
    if ($img == 0){
      $img = $statImg1;    
      return $img;
    }
    
  }
  //------------------------------------------------------    
  $sql = "INSERT INTO "._HER_TFN_LECTURE
        ."(idLettre,idArchive,idUser,email,ip,dateLecture,quantieme,compteur) "
        ." VALUES ("
        ."{$t['idLettre']},"
        ."{$t['idArchive']},"
        ."{$t['idUser']},"
        ."'{$t['email']}',"        
        ."'{$t['ip']}',"        
        ."{$t['time']}," 
        ."{$t['quantieme']},"
        ."{$t['increment']})";
                           
  $sqlquery = $xoopsDB->queryF ($sql); 
  if ($debug) echo "sql - increment des stats de lecture: <br>{$sql}<br>";  
  
  $img = $statImg0;   
  if ($debug) {
    $urlImg = str_replace(_HER_ROOT_PATH, _HER_URL, $img);  
    echo "<hr>image renvoyée : <br><A href = '{$urlImg}'>{$img}</A><hr>";  
  }
  
    
  return $img;

}
/*****************************************************************
 
 *****************************************************************/
function readFileImgForStat($img, $debug = false){
  if (is_file($img)){
    if ($debug) {
      $urlImg = str_replace(_HER_ROOT_PATH, _HER_URL, $img);  
      echo "<hr>readFileImgForStat : <br><A href = '{$urlImg}'>{$img}</A><hr>";  
    }else{
      readfile($image);    
    }
  
  }else{
    if ($debug) {
      $urlImg = str_replace(_HER_ROOT_PATH, _HER_URL, $img);  
      echo "<hr>readFileImgForStat : le fichier n'existe pas : <br><A href = '{$urlImg}'>{$img}</A><hr>";
    }        
  }

}

/*****************************************************************
 
 *****************************************************************/

function setNewStatImg($code, $razCompteur = false, $sep = '|'){
global $xoopsUser, $xoopsModule, $xoopsDB;   

    //$img = XOOPS_ROOT_PATH."/modules/hermes/images/sumo.gif";
    //$img = _HER_ROOT_PATH."images/sumo.gif";    
    $img = $statImg0;    
    //echo "<hr>{$img}<hr>";
    return $img;
    //return _HER_ROOT."images/sumo.gif";    
    //return _HER_URL."images/sumo.gif";

}


/*****************************************************************
 
 *****************************************************************/
function getStatistiques($idLettre, $name = ''){
global $xoopsUser, $xoopsModule, $xoopsDB;   
    
    if ($name ==''){
      $sql = "SELECT idLettre, idArchive, sum(compteur) as lectures"
            ." FROM "._HER_TFN_LECTURE
            ." WHERE idLettre = {$idLettre} "
            ." GROUP BY idLettre, idArchive";    
    
    }else{
      $sql = "SELECT idLettre, '{$name}' AS nom,idArchive, sum(compteur) as lectures"
            ." FROM "._HER_TFN_LECTURE
            ." WHERE idLettre = {$idLettre} "
            ." GROUP BY idLettre,nom , idArchive";    
    
    }




  
  //echo "<hr>getStatistiques<br>{$sql}<hr>";
  $sqlquery = $xoopsDB->queryF ($sql);
  return  $sqlquery;

}

/*****************************************************************
 
 *****************************************************************/
function getStatistiquesDetailleesByArchive($idArchive){
global $xoopsUser, $xoopsModule, $xoopsDB;  

/*

    $sql = "SELECT tl.*  FROM "._HER_TFN_LECTURE." AS tl "
          ." WHERE tl.idArchive = {$idArchive} " 
          ." ORDER BY email";    
*/
$tl = _HER_TFN_LECTURE;
$tu = $xoopsDB->prefix('users');

    $sql = "SELECT tl.*, tu.name AS name, tu.uname AS pseudo "
          ."FROM {$tl} AS tl  LEFT JOIN {$tu} AS tu "
          ."  ON tl.email = tu.email "    
          ." WHERE tl.idArchive = {$idArchive} " 
          ." ORDER BY tl.email";    

  
  $sqlquery = $xoopsDB->query ($sql);    
//echo "<hr>getStatistiquesDetailleesByArchive<br>{$sql}<hr>";
  return $sqlquery;
}


/*****************************************************************
 
 *****************************************************************/
function getStatistiquesJournalieres($idLettre, $nbQuantiemes = 30){
global $xoopsUser, $xoopsModule, $xoopsDB, $xoopsModuleConfig;  
  
   $nbJoursStat = $xoopsModuleConfig['statNbJours'];
  /*
 
    $sql = "SELECT idLettre, idArchive, quantieme, sum(compteur) as lectures"
          ." FROM "._HER_TFN_LECTURE
          .(($idLettre == 0) ? '' : " WHERE idLettre = {$idLettre} ")
          ." GROUP BY idLettre, idArchive, quantieme";    
   */   
    
    $sql = "SELECT tl.idLettre AS idLettre, tl.idArchive as idArchive, tl.quantieme AS quantieme, sum(tl.compteur) as lectures,"
          ." ta.nom as nom, DATE_FORMAT(ta.dateParution, '%d %m %y') AS `dateParution`, "
          ." ta.chronoArchive as chronoArchive "          
          ." FROM "._HER_TFN_LECTURE." AS tl, "
          ._HER_TFN_ARCHIVE." AS ta "    
          ." WHERE tl.idArchive = ta.idArchive "      
          .(($idLettre == 0) ? '' : " AND tl.idLettre = {$idLettre} ")
          ." GROUP BY tl.idLettre, tl.idArchive, tl.quantieme";    
  
  $sqlquery = $xoopsDB->query ($sql);    
//echo "<hr>getStatistiquesJournalieres<br>{$sql}<hr>";

  
  $t = array();
/* structure de $t

['lettres'][1]['archives'][1][somme][0,1,2,3,4,5...28,29,30]
                             [info][idLettre,nom,dateParution]  
                          
                          [2][somme][0,1,2,3,4,5...28,29,30]
                             [info][idLettre,nom,dateParution] 
                          
                          [3][somme][0,1,2,3,4,5...28,29,30]
                             [info][idLettre,nom,dateParution]                        
               
               ['stat'][somme]  [0,1,2,3,4,5...28,29,30]
                       [compte] [0,1,2,3,4,5...28,29,30]               
                       [moyenne][0,1,2,3,4,5...28,29,30]
           
           
           [2]['archives'][7][somme][0,1,2,3,4,5...28,29,30]
                             [info][idLettre,nom,dateParution]          
                          
                          [8][somme][0,1,2,3,4,5...28,29,30]
                             [info][idLettre,nom,dateParution]                        
                          
                          [9][somme][0,1,2,3,4,5...28,29,30]
                             [info][idLettre,nom,dateParution]                          
               
               ['stat'][somme]  [0,1,2,3,4,5...28,29,30]
                       [compte] [0,1,2,3,4,5...28,29,30]               
                       [moyenne][0,1,2,3,4,5...28,29,30]
                        
['stat']['somme']  [0,1,2,3,4,5...28,29,30] 
        ['compte'] [0,1,2,3,4,5...28,29,30] 
        ['moyenne'][0,1,2,3,4,5...28,29,30]


*/         
  //-----------------------------------------------------------------------
  $tl = array(); //tableau des lettres
  $tt = prepareArrayStat($nbQuantiemes); //tableaux des totaux
  $z = 0; //quantieme 0 sera utilise pour totaliser les quantiemes de 1 à nbQuantieme
  //----------------------------------------------------------------------- 
  
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    $l = $sqlfetch['idLettre'];
    $a = $sqlfetch['idArchive'];
    $c = $sqlfetch['lectures'];
    //$sqlfetch['quantieme']++;
    if ($sqlfetch['quantieme'] <= 0) $sqlfetch['quantieme'] =1;
    $q =(($sqlfetch['quantieme'] > $nbQuantiemes) ? $nbJoursStat: $sqlfetch['quantieme']) ;    
    //echo "<hr><br>{$i}-{$q}-{$c}<br>";
    //---------------------------------------------------
    if (!isset($tl[$l])) {
        $tl[$l] = array('archives' => array(), 
                        'stat'     => prepareArrayStat($nbQuantiemes),
                        'info'     => array());
    } 
    //-------------------------------------------  


    if (!isset($tl[$l]['archives'][$a])){
          $tl[$l]['archives'][$a]['somme'] = prepareArrayQuantieme($nbQuantiemes);    
          $tl[$l]['archives'][$a]['info'] = array('nom'           => $sqlfetch['nom'],
                                                  'dateParution'  => $sqlfetch['dateParution'],
                                                  'chronoArchive' => $sqlfetch['chronoArchive']);    
          
          $tl[$l]['stat']['compte'][$q] += 1;     
          $tl[$l]['stat']['compte'][$z] += 1;    
          
          $tt['compte'][$q] += 1;     
          $tt['compte'][$z] += 1;    
                         
    } 

    $tl[$l]['archives'][$a]['somme'][$q] += $c;
    $tl[$l]['archives'][$a]['somme'][$z] += $c;   
    
    $tl[$l]['stat']['somme'][$q] += $c;
    $tl[$l]['stat']['somme'][$z] += $c;
            
    $tt['somme'][$q] += $c;
    $tt['somme'][$z] += $c;
    
    
             
  }
  
//displayArray($t ,"-----  -----");
  
  //--------------------------------------------------
  $t = array('lettres' => $tl, 'stat'=> $tt);
  return  $t;
  //--------------------------------------------------
  
}
//---------------------------------------------------------
function prepareArrayStat($nbQuantiemes = 30){
  $stat = array('somme'  => prepareArrayQuantieme($nbQuantiemes), 
                'compte' => prepareArrayQuantieme($nbQuantiemes), 
                'moyenne'=> prepareArrayQuantieme($nbQuantiemes));
  return $stat;
}
//---------------------------------------------------------
function prepareArrayQuantieme($nbQuantiemes = 30){
  $q = array(0); 
  $q = array_pad($q, $nbQuantiemes + 1, 0);
  return $q;
}


/************************************************************************
 *
 ************************************************************************/
function showStatistiques($idLettre, $bDetail = true, $presentation = 0){
global $xoopsModuleConfig, $xoopsDB;
    
   $nbq = $xoopsModuleConfig['statNbJours'];
   $nbq1 = $nbq + 5;
   $nbq2 = $nbq + 4;  
       
   $t  = getStatistiquesJournalieres($idLettre, $nbq);
   $tl = $t['lettres'];
   $ts = $t['stat'];

  
    echo "<table width='80%'  cellspacing='0'>";
    while (list($idLettre, $lettre) = each($tl)) {
        $sqlfetch = db_getLettreId($idLettre, true);    

        echo buildHR(1, 'blank',$nbq1);        
        $dsc = " {$sqlfetch['nom']} (#{$sqlfetch['idLettre']})";
        echo buildTitleArray(_AD_HER_STAT_LETTRE.$dsc, "" , $nbq1, false, 1);
      //-------------------------------------------------    
      //echo "<tr><td>";
      //echo "statistiques  = ".count($tl);
      if ($presentation == 1){
        showGraphiqueLettre($lettre, $idLettre, $nbq, $nbq1,$bDetail );      
      }else{
        showStatistiquesLettre($lettre, $idLettre, $nbq, $nbq1,$bDetail );      
      }
      
//echo "<hr>presentation ={$presentation}<hr>";      
      //echo "</td></tr>";      
      //echo buildHR (1, _HER_HR_COLOR1, $nbq + 4) ; 
    }
    
    
    echo buildHR(1, 'blank', $nbq1);
      if ($presentation == 1){ 
        showGraphiqueTotal($ts, $nbq, $nbq1);      
      }else{
         showStatistiquesTotal($ts, $nbq, $nbq1);      
      }

    echo buildHR(1, 'blank', $nbq1);
    
    echo "</table>";    
}

/*******************************************************************
 *
 *******************************************************************/

function showGraphique($idLettre, $bDetail = true){
global $xoopsModuleConfig, $xoopsDB;
    
   $nbq = $xoopsModuleConfig['statNbJours'];
   $nbq1 = $nbq + 5;
   $nbq2 = $nbq + 4;  
       
   $t  = getStatistiquesJournalieres($idLettre, $nbq);
   $tl = $t['lettres'];
   $ts = $t['stat'];

  
    echo "<table width='80%'  cellspacing='0'>";
    while (list($idLettre, $lettre) = each($tl)) {
        $sqlfetch = db_getLettreId($idLettre, true);    

        echo buildHR(1, 'blank',$nbq1);        
        $dsc = " {$sqlfetch['nom']} (#{$sqlfetch['idLettre']})";
        echo buildTitleArray(_AD_HER_STAT_LETTRE.$dsc, "" , $nbq1, false, 1);
      //-------------------------------------------------    
      //echo "<tr><td>";
      //echo "statistiques  = ".count($tl);
      showGraphiqueLettre($lettre, $idLettre, $nbq, $nbq1,$bDetail );      
      
      //echo "</td></tr>";      
      //echo buildHR (1, _HER_HR_COLOR1, $nbq + 4) ; 
    }
    
    
    echo buildHR(1, 'blank', $nbq1);
    showGraphiqueTotal($ts, $nbq, $nbq1);
    echo buildHR(1, 'blank', $nbq1);
    
    echo "</table>";    
}

/****************************************************************************
 *
 ****************************************************************************/

function showStatistiquesLettre($tl, $idLettre, $nbq, $nbq2, $bDetail = true){
global $xoopsModuleConfig, $xoopsDB;


    //echo "<table ".getTblStyle().">";  
              
    //$oldRupture = -1;    
    $h = 0;  
    //$alpha = '';
    $hv0 = ''; //<td> |</td>';
    $colId = 'idStat';
   
    $s1 = "style='text-align: center;border-style: solid; border-width: 1px'";
   //-----------------------------------------------------------------         
    while (list($idArchive, $ta) = each($tl['archives'])) {
      $bg = getRowStyle($row, 'center', '1px'); 
      $hv1 = "" ;// "<td {$bg}> |</td>";      
      $colEmpty = "<TD {$bg} align='center'></td>";
      $h++;
      //$id = $sqlfetch[$colId];
      //echo "<INPUT TYPE=\"hidden\" id='txtId_{$h}'  NAME='txtId_{$h}'  size='1%' VALUE='{$id}'>";
         
      //---------------------------------
      if ($h == 1){  
        //echo "<tr><td>#</td><td>|</td>";  
        echo '<tr>';          
        //echo "<td {$s1}>id L</td><td {$s1}>id A</td><td {$s1}>id C</td>";
        echo "<td {$s1}>id L-A</td><td {$s1}>Chrono</td>";        
        echo "<td {$s1}>nom</td><td {$s1}>date</td>";       
            
        while (list($key, $val) = each($ta['somme'])){
          $lib = (($key == 0) ? '&Sigma;' : $key);
          echo "<td {$s1}>{$lib}</td>{$hv0}";
          
        }
        echo '</tr>';        
        //echo "<td> </td><td> </td></tr>";            
      }    
        $linka1 = "<A href = 'admin_stat.php?op=editStatDetaillee&idArchive={$idArchive}'>";
        $linka2 = "</A>";      
            
        if (!$bDetail) continue;
        reset($ta['somme']);
        echo '<tr>';  
        //echo "<td {$bg}>{$idLettre}</td>{$hv1}";        
        //echo "<td {$bg}>{$idArchive}</td>{$hv1}";    
        
        $link = $linka1.$idLettre.'-'.$idArchive.$linka2;        
        echo "<td {$bg}>$link</td>{$hv1}";    
        
        $link = $linka1.$ta['info']['chronoArchive'].$linka2;        
        echo "<td {$bg}>{$link}</td>{$hv1}";         
        
        $link = $linka1.$ta['info']['nom'].$linka2;
        echo "<td {$bg}>{$link}</td>";
        
        echo "<td {$bg}>{$ta['info']['dateParution']}</td>";
                         
        while (list($key, $val) = each($ta['somme'])){
          $v = getColorTranche($val,'statTranchesArchive', $key);
          echo "<td {$bg}>{$v}</td>{$hv1}";
        }
        echo '</tr>';        
        //echo "<td> </td><td> </td></tr>";            

    }

    
    $row = 1;
    $bg = getRowStyle($row, 'center', '1px', $row+2);    

    echo '<tr>';  
    echo "<td {$bg} colspan='4'>&Sigma;</td>{$hv1}";     
    //echo "<td {$bg}></td>{$hv1}";                 
    
    while (list($key, $val) = each($tl['stat']['somme'])){
      $v = getColorTranche($val,'statTranchesLettre', $key);
      echo "<td {$bg}>{$v}</td>{$hv1}";
    }
    echo '</tr>';        
    
    
    //echo "</table>";    


}

/*******************************************************************
 *
 *******************************************************************/
function showGraphiqueLettre($tl, $idLettre, $nbq, $nbq2, $bDetail = true){
global $xoopsModuleConfig, $xoopsDB;


    //echo "<table ".getTblStyle().">";  
              
    //$oldRupture = -1;    
    $h = 0;  
    //$alpha = '';
    $hv0 = ''; //<td> |</td>';
    $colId = 'idStat';
   
    $s1 = "style='text-align: center;border-style: solid; border-width: 1px'";
   //-----------------------------------------------------------------         
    while (list($idArchive, $ta) = each($tl['archives'])) {
      $bg = getRowStyle($row, 'center', '1px'); 
      $hv1 = "" ;// "<td {$bg}> |</td>";      
      $colEmpty = "<TD {$bg} align='center'></td>";
      $h++;
      //$id = $sqlfetch[$colId];
      //echo "<INPUT TYPE=\"hidden\" id='txtId_{$h}'  NAME='txtId_{$h}'  size='1%' VALUE='{$id}'>";
         
      //---------------------------------
      if ($h == 1){  
        //echo "<tr><td>#</td><td>|</td>";  
        echo '<tr>';          
        //echo "<td {$s1}>id L</td><td {$s1}>id A</td><td {$s1}>id C</td>";
        echo "<td {$s1}>id L-A</td><td {$s1}>Chrono</td>";        
        echo "<td {$s1}>nom</td><td {$s1}>date</td>";       
          echo "<td {$s1}>Graphique</td>";
        /*while (list($key, $val) = each($ta['somme'])){
          $lib = (($key == 0) ? '&Sigma;' : $key);
          echo "<td {$s1}>{$lib}</td>{$hv0}";
          
        }*/
        echo '</tr>';        
        //echo "<td> </td><td> </td></tr>";            
      }    
        $linka1 = "<A href = 'admin_stat.php?op=editStatDetaillee&idArchive={$idArchive}'>";
        $linka2 = "</A>";      
            
        if (!$bDetail) continue;
        reset($ta['somme']);
        echo '<tr>';  
        //echo "<td {$bg}>{$idLettre}</td>{$hv1}";        
        //echo "<td {$bg}>{$idArchive}</td>{$hv1}";    
        
        $link = $linka1.$idLettre.'-'.$idArchive.$linka2;        
        echo "<td {$bg}>$link</td>{$hv1}";    
        
        $link = $linka1.$ta['info']['chronoArchive'].$linka2;        
        echo "<td {$bg}>{$link}</td>{$hv1}";         
        
        $link = $linka1.$ta['info']['nom'].$linka2;
        echo "<td {$bg}>{$link}</td>";
        
        echo "<td {$bg}>{$ta['info']['dateParution']}</td>";
         $v = '';             
        while (list($key, $val) = each($ta['somme'])){
          $v .= $val.',';
        }
		$v = substr($v,0,-1);
		$vava = $v;
		$ordrev = explode(",",$vava);
		
		$aretirer = strlen($ordrev[0])+1;
		$v = substr($v, $aretirer);
		//echo $ordrev;
		rsort($ordrev);
		//echo $ordrve;
		$max = $ordrev[1];
		//echo 'cdpdf'.$max;
		echo "<td {$bg}><img src='http://chart.apis.google.com/chart?cht=bvs&chs=750x200&chco=4488ee&chds=0,{$max}&chxr=1,0,{$max}&chd=t:{$v}&chxt=x,y'></td>";
        echo '</tr>';        
        //echo "<td> </td><td> </td></tr>";            

    }

    
    $row = 1;
    $bg = getRowStyle($row, 'center', '1px', $row+2);    

    echo '<tr>';  
    echo "<td {$bg} colspan='4'>&Sigma;</td>{$hv1}";     
    //echo "<td {$bg}></td>{$hv1}";                 
    
       
    
         $v = '';             
        while (list($key, $val) = each($tl['stat']['somme'])){
          $v .= $val.',';
        }
		$v = substr($v,0,-1);
		$vava = $v;
		$ordrev = explode(",",$vava);
		
		$aretirer = strlen($ordrev[0])+1;
		$v = substr($v, $aretirer);
		//echo $ordrev;
		rsort($ordrev);
		//echo $ordrve;
		$max = $ordrev[1];
		//echo 'cdpdf'.$max;
		echo "<td {$bg}><img src='http://chart.apis.google.com/chart?cht=bvs&chs=750x200&chco=4488ee&chds=0,{$max}&chxr=1,0,{$max}&chd=t:{$v}&chxt=x,y'></td>";
        echo '</tr>'; 
    
    //echo "</table>";    


}


/****************************************************************************
 *
 ****************************************************************************/

function showStatistiquesTotal($ts, $nbq, $nbq2){
global $xoopsModuleConfig, $xoopsDB;


    //echo "<table ".getTblStyle().">";  
              
    //$oldRupture = -1;    
    $h = 0;  
    //$alpha = '';
    $hv0 = ''; //<td> |</td>';
    $colId = 'idStat';
   
    $s1 = "style='text-align: center;border-style: solid; border-width: 1px'";
   //-----------------------------------------------------------------      
    setlocale (LC_ALL, 'fr_FR');
    $dsc = date("j F Y, G:i");
    echo buildTitleArray(_AD_HER_STAT_GLOBALE_AU.$dsc, "" , $nbq+5, false,1);

    $s1 = "style='text-align: center;border-style: solid; border-width: 1px'";
        //echo "<tr><td>#</td><td>|</td>";    
    echo '<tr>'; 
    echo "<td {$s1} colspan='4'></td>";
    //echo "<td {$s1}>##</td>";
       
    while (list($key, $val) = each($ts['somme'])){
      $lib = (($key == 0) ? '&Sigma;' : $key);
      echo "<td {$s1}>{$lib}</td>{$hv0}";
      
    }
    echo '</tr>';        
    //echo "<td> </td><td> </td></tr>";            
    //----------------------------------------------------
    $row = 1;
    $bg = getRowStyle($row, 'center', '1px', $row+2);    
    
    echo '<tr>';  
    echo "<td {$bg} colspan='4'>&Sigma;</td>";     
    //echo "<td {$s1}></td>{$hv1}";     
      
    
    reset($ts['somme']) ;           
    while (list($key, $val) = each($ts['somme'])){
      $v = getColorTranche($val,'statTranchesGlobale', $key);
      echo "<td {$bg}>{$v}</td>";
    }
    echo '</tr>';        
    //----------------------------------------------------    
    
    //echo "</table>";    


}

/*******************************************************************
 *
 *******************************************************************/

function showGraphiqueTotal($ts, $nbq, $nbq2){
global $xoopsModuleConfig, $xoopsDB;


    //echo "<table ".getTblStyle().">";  
              
    //$oldRupture = -1;    
    $h = 0;  
    //$alpha = '';
    $hv0 = ''; //<td> |</td>';
    $colId = 'idStat';
   
    $s1 = "style='text-align: center;border-style: solid; border-width: 1px'";
   //-----------------------------------------------------------------      
    setlocale (LC_ALL, 'fr_FR');
    $dsc = date("j F Y, G:i");
    echo buildTitleArray(_AD_HER_STAT_GLOBALE_AU.$dsc, "" , $nbq+5, false,1);

    $s1 = "style='text-align: center;border-style: solid; border-width: 1px'";
        //echo "<tr><td>#</td><td>|</td>";    
    echo '<tr>'; 
    echo "<td {$s1} colspan='4'></td>";
    //echo "<td {$s1}>##</td>";
       
    while (list($key, $val) = each($ts['somme'])){
      $lib = (($key == 0) ? '&Sigma;' : $key);
      //echo "<td {$s1}>{$lib}</td>{$hv0}";
      
    }
	 echo "<td {$s1}>{$lib}</td>{$hv0}";
    echo '</tr>';        
    //echo "<td> </td><td> </td></tr>";            
    //----------------------------------------------------
    $row = 1;
    $bg = getRowStyle($row, 'center', '1px', $row+2);    
    
    echo '<tr>';  
    echo "<td {$bg} colspan='4'>&Sigma;</td>";     
    //echo "<td {$s1}></td>{$hv1}";     
      
    
    reset($ts['somme']) ;           

    //----------------------------------------------------    
    
    //echo "</table>";    
         $v = '';             
        while (list($key, $val) = each($ts['somme'])){
          $v .= $val.',';
        }
		$v = substr($v,0,-1);
		$vava = $v;
		$ordrev = explode(",",$vava);
		
		$aretirer = strlen($ordrev[0])+1;
		$v = substr($v, $aretirer);
		//echo $ordrev;
		rsort($ordrev);
		//echo $ordrve;
		$max = $ordrev[1];
		//echo 'cdpdf'.$max;
		echo "<td {$bg}><img src='http://chart.apis.google.com/chart?cht=bvs&chs=750x200&chco=4488ee&chds=0,{$max}&chxr=1,0,{$max}&chd=t:{$v}&chxt=x,y'></td>";
        echo '</tr>';   

}
/****************************************************************************
 *
 ****************************************************************************/

 function getColorTranche($val, $codeListe, $key = 0){
global $xoopsModuleConfig;
//echo "<hr>getColorTranche<br>{$xoopsModuleConfig['statTranches']}<hr>";

  
  $h = getTranche($val, $xoopsModuleConfig[$codeListe]);  
  $c = array ('#FFFFFF','#000000','#008000','#0000FF','#FF00FF','#FF0000');
  //if $h> count($c) $h = count($c);
  if ($key == 0){
    $v = "<u><b><font color='{$c[$h]}'>{$val}</font></b></u>";  
  }else{
    $v = "<font color='{$c[$h]}'>{$val}</font>";  
  }

  
//echo "<hr>getColorTranche<br>{$val}-{$h}<hr>";  
  
  return $v;
 
 }



?>
