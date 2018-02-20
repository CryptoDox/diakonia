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


//include_once ("admin/admin_header.php");
//---------------------------------------------------------------
/*
*/
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."class/xoopsformloader.php");
                               
require_once ("hermes_constantes.php");
include_once (_HER_JJD_PATH."/include/functions.php");

//---------------------------------------------------------------/
global $toto;

/*********************************************************************

**********************************************************************/
function getLanguageFile ($fullName){
global $xoopsConfig;

	
    $lang = $xoopsConfig['language'];
    $t = explode('/', $fullName);
    $lastIndex = count($t)-1; 
    $t[$lastIndex] = "language_{$lang}.inc";

    $f = implode ('/', $t);
//    echo "<hr>------>{$f}<hr>";    
    
    if (!is_readable($f)){
      $t[$lastIndex] = "language_english.inc" ;   
      $f = implode ('/', $t);
      if (!is_readable($f)){$f = '';}        
    }
    
    //echo "<hr>--++---->{$f}<hr>";    
  return $f;
}
/*********************************************************************

**********************************************************************/
function showColumnSql($msg = ""){
  global $xoopsDB;
  echo "<hr>showColumnSql<hr>";
  
  $sql = "SELECT * FROM "._HER_TFN_LETTRE;
  $sqlquery = $xoopsDB->query ($sql);
 
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    while (list($key, $item) = each($sqlfetch)){
      echo "->{$key} = {$item}<br>";
    }
  } 
  
  echo "<hr>";  
   
  $col = $xoopsDB->fieldname ($sqlquery);  
  while ($sqlfetch = $xoopsDB->fetchArray($col)) {
    while (list($key, $item) = each($sqlfetch)){
      echo "{$key} = {$item}<br>";
    }
  }  
  echo "<hr>";    
}


/****************************************************************************
 *
 ****************************************************************************/
function extractFileNameFromFullName ($fullName){
  
  $tf = explode('/', $fullName);
  $tt = explode('.', $tf[count($tf)-1]);
  return $tt [0];
  
  
}

/****************************************************************************
 *
 ****************************************************************************/

function MyGetDate( $nb_ans='0', $nb_mois='0', $nb_jours='0', $mysql=FALSE){
  if( is_int($nb_ans) && is_int($nb_mois) && is_int($nb_jours)){
    $mysql ? $format = "Y-m-d" : $format = "d/m/Y";
    $d = getDate();
    return date($format, mktime(0,0,0,$d['mon']+$nb_mois,$d['mday']+$nb_jours,$d['year']+$nb_ans));    
    //return date($format, mktime(0,0,0,date('m')+$nb_mois,date('d')+$nb_jours,date('Y')+$nb_ans));
  }
  else{
    return FALSE;
  }
}
/****************************************************************************
 *
 ****************************************************************************/

function dateAdd($timeStamp, 
                 $nb_ans=0, 
                 $nb_mois=0, 
                 $nb_jours=0, 
                 $mysql=true, 
                 $dateAlone = false){
  
  //if( is_int($nb_ans) && is_int($nb_mois) && is_int($nb_jours)){
  if( true){  
    if ($dateAlone){
      $format = $mysql ? "Y-m-d" : "d/m/Y";    
    }else{
      $format = $mysql ? "Y-m-d h:m:s" : "d/m/Y h:m:s";    
    }

    
    $d = getdate($timeStamp);
   // return date($format,$d);    
    return date($format, mktime(0,0,0,$d['mon']+$nb_mois,$d['mday']+$nb_jours,$d['year']+$nb_ans));    
    //return date($format, mktime(0,0,0,date('m')+$nb_mois,date('d')+$nb_jours,date('Y')+$nb_ans));
  }
  else{
    return '????????????????';
    //return FALSE;
    
  }
}
/****************************************************************************
 *
 ****************************************************************************/

function dateAdd2DateTime($dateHeureMySql, $nb_ans=0, $nb_mois=0, $nb_jours=0, $mysql=true){

  $timeStamp = strtotime($dateHeureMySql);
  
  $newDate = dateAdd($timeStamp, $nb_ans, $nb_mois, $nb_jours, $mysql);
  //echo "<hr>dateAdd2DateTime<hr>$dateHeureMySql -> {$timeStamp} -> {$newDate}<hr>";  
  //echo "<hr>dateAdd2DateTime<hr>$dateHeureMySql ->ans = {$nb_ans} -> mois = {$nb_mois}-> jours = {$nb_jours}<hr>";  
  return $newDate;
}

/**********************************************************************
 * 
 **********************************************************************/
function createNewUser ($name, $uname, $email, $password){
	global $xoopsModuleConfig, $xoopsDB,$xoopsGroup;
	
/*
  $sql = "INSERT INTO "._HER_TFN_LETTRE
       ."(name,description,group_type)"
       .VALUES ('{}','{description}','{$group_type}');
       
       
 
      $xoopsDB->query($sql);
      $groupid = $xoopsDB->getInsertId() ;


*/
	

include_once(XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                              ."include/functions.php")  ;
  //$xg = new XoopsGroupHandler('rr');
    
    
    $xg = xoops_gethandler('user');  
    
    $g = $xg->create(true);
    $g->name  = $name;
    $g->uname = $uname;    
    $g->email = $email;
    $g->pass  = $password; 
    
    
    $g->setGroups(array(7));    
    //$g->group_type  = $group_type;
    
    $uid = $xg->insert($g, true);
    //$groupid = $g->groupid;

    return $uid;


}
/***********************************************************************
 *
 ***********************************************************************/
 function getTranche($val, $tranches, $sep = ';'){
  
  //hecho ($tranches, 'tranche');
  if (!is_array($tranches)) $tranches = explode($sep, $tranches);
  $h = 0;
  $max = count($tranches)-1;
  
  while ($val > $tranches[$h] AND $h < $max) $h++;
  if ($h > $max) $h = $max;
  
  return $h; 
 }

/***********************************************************************
 *
 ***********************************************************************/
 function difDays($date2Compare, $dateRef = 0){
    if ($dateRef == 0) $dateRef = time();
    //return intval(($dateRef - strtotime($mois.'/'.$jour.'/'.$annee))/(3600*24));
    $dif = intval(($date2Compare - $dateRef)/(3600*24))+1;

    return $dif;

 }

/***********************************************************************
 *
 ***********************************************************************/
 function hecho($info, $source = ''){
  echo "<hr>{$source} -> {$info}<hr>";
 }
/***********************************************************************
 *
 ***********************************************************************/
 function removeFolder($dir){
  if (is_dir($dir)) {
    if (substr($dir,-1) <> '/' AND substr($dir,-1) <> '\\') $dir .= '/';
    if ($dh = opendir($dir)) {

        while (($file = readdir($dh)) !== false) {
            //echo "fichier : $file : type: " . filetype($dir . $file) . "<hr>\n";
            if (substr($file,1) <> '.'){
              unlink ($dir.$file);            
            }

        }
        closedir($dh);
    }
    closedir($dh);    
    rmdir($dir);

  }
  
 }
 
/**************************************************************************
 *
 **************************************************************************/
function mdpAleatoire(&$mdpEnClair,&$mdpCripte, $len = 8){
$lettre = "0123456789ABCDEFGHIJKLMNOBQRSTUVWXYZabcdefghijklmnopqrstuvwxyz_";
$nbl = strlen($lettre) -1;
    
    $mdpEnClair = '';
    for($i = 0; $i < $len; $i++)
       $mdpEnClair .= substr($lettre, rand(0, $nbl), 1);

    $mdpCripte = md5($mdpEnClair);
    return true;       
}

/**************************************************************************
 *
 **************************************************************************/
function valider_email($email) {

/*
  
  $p = '^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.
               '@'.
               '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.
               '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]{2,3}$'
*/
  $p = "^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]"
      ."@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$";
  
  return (ereg($p, $email));
}
/*********************************************************************
 *
 *********************************************************************/
 function redirectTo($url, $message, $delai = 1){
    $msg0 = "<b><font color='#FF0000'>{$message}</font></b>";
    redirect_header($url, $delai, $msg0); 
 }


//----------------------------------------------------------------------


/****************************************************************************
 *
 ****************************************************************************/

//---------------------------------------------------------
function Array2Table($array){
/*

    if (is_array($array) {
      $echo ="\n<TABLE width=100% border=2>";
      foreach ($array as $TR) {
        $echo .="\n\t<TR>";
        if (is_array($TR)) {
          foreach ($TR as $TD) {
            $echo .="\n\t\t<TD>";
            if (is_array($TD)) {
              $echo .= Array2Table($TD);
            }
            else {
              $echo .= $TD;
            }
            $echo .="</TD>";
          }
        }
        else {
          $echo .= "\n\t\t<TD>".$TR."</TD>";
        }
        $echo .="\n\t</TR>";
      }
      $echo .="\n</TABLE>\n";
      return $echo;
    }
    else {
      return $array;
    }
*/    
} // fin de la fonction

/****************************************************************
 *
 ****************************************************************/

function geScalaire($table, $col2count, $filter, $op = 'count', $debug = false){
	Global $xoopsDB, $xoopsConfig, $xoopsModule;
	
  $sql = "SELECT {$op}({$col2count}) AS nbEnr "
        ." FROM ".$xoopsDB->prefix($table)
        .(($filter == '') ? '' : " WHERE {$filter}"); 

  $sqlquery = $xoopsDB->query ($sql);  
  if ($xoopsDB->getRowsNum($sqlquery) == 0){
    $r = 0;
  }else{
    //$sqlfetch = $xoopsDB->fetchArray($sqlquery);
    //$r = $sqlfetch['nbEnr'] ;
    list($r) = $xoopsDB->fetchRow($sqlquery);
  }
  
  if ($debug) echo "<hr>countArchives<br>$sql<hr>";
  //displayArray($t,"----- countArchives -----");
  return $r;
}



/*******************************************************************
 *
 *******************************************************************/
function her_displayArray($t, $name = "", $ident = 0){
  
  if (is_array($t)){
  	jjd_echo ("displayArray: ".$name." - count = ".count($t), 255, "-") ;
  
    echo "<table ".getTblStyle().">";
  
    echo "<tr><td>";      
  	jjd_echo ("displayArray: ".$name." - count = ".count($t), 255, "-") ;  
    echo "</td></tr>";  
  
    echo "<tr><td>";
    echo '<pre>'; 
    echo print_r($t); 
    echo '</pre>';
    echo "</td></tr>";
    echo "</table>";

  }else  {
    echo "l'indice ---|{$t}|--- n'est pas un tableau";  
  }
	//jjd_echo ("Fin - ".$name, 255, "-") ;

}



?>
