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



include_once ("admin_header.php");
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                             ."modules/jjd_tools/_common/include/functions.php");


include_once ("../include/hermes_data.php");


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => ''),
              array('name' =>'ok',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));    
                        
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------
function build_const_table($prefixe, $folder = 'generation', $file = 'constantes_table.php'){

$tDef = array();
$tShortName = array();
$tName = array();
$tfullName = array();
 

  $tblPrefixe = strtoupper($prefixe);  
  $tDef[] = "define ('{$tblPrefixe}TBL_PREFIXE',     '{$prefixe}');";
  
  $t = get_tables($prefixe);
   while (list($key, $item) = each($t) ) {
    $name = $item[1];
    $uName = strtoupper($name);
    
    $defShortName = "_{$tblPrefixe}TBL_{$uName}";   
    $tShortName [] = 'define (' . str_pad($defShortName, 30). ", '{$name}');";
              
    $defName = "_{$tblPrefixe}TBA_{$uName}";    
    $tName [] = 'define (' . str_pad($defName, 30) . ", _{$tblPrefixe}TBL_PREFIXE.{$defShortName});";
    
    
    $fullName = "_{$tblPrefixe}TFN_{$uName}";    
    //$tFullName [] = 'define (' . str_pad($fullName, 30) . ", _{$tblPrefixe}TBL_PREFIXE.{$defShortName});";
    $tFullName [] = 'define (' . str_pad($fullName, 30) . ", $"."xoopsDB->prefix({$defName}));";    
    

  }
  
  $t=array();
  $line = str_pad('//', 50, '-');
  $t[] = '<?php';
  $t[] = '';    
  $t[] = $line;  
  $t[] = '// definition des constante de table'; 
  $t[] = $line;  
  
  $t[] = implode("\n", $tDef);
  $t[] = $line;  
  
  $t[] = implode("\n", $tShortName);
  $t[] = $line;  
  
  $t[] = implode("\n", $tName);
  $t[] = $line;  
  
  $t[] = implode("\n", $tFullName);
  $t[] = $line;  
  
  $t[] = '?>';  
  //her_displayArray($tDef, "----- build_const_table -----");  
  //her_displayArray($tShortName, "----- build_const_table -----");  
  //her_displayArray($tName, "----- build_const_table -----");  
  //her_displayArray($tFullName, "----- build_const_table -----");  
  
  //her_displayArray($t, "----- build_const_table -----"); 
  $texte = implode("\n", $t);
  
  echo "<hr>{$texte}<hr>"; 
  $fullName = XOOPS_ROOT_PATH."/modules/hermes/{$folder}/{$file}";   
  $fullName = str_replace('//', '/', $fullName);  
  echo "<hr>{$fullName}<hr>";
  $fp = fopen ($fullName, "w");  
  fwrite ($fp, $texte);
  fclose ($fp);
  

  
  exit;
}
/**********************************************************************
 *

function get_tables($prefixe){
global $xoopsDB;

  echo "<hr>".XOOPS_DB_NAME."<hr>";
  $sqlquery = mysql_list_tables(XOOPS_DB_NAME );
  $t = array();
  $prefixe = $xoopsDB->prefix().'_'.$prefixe;
  echo "<hr>{$prefixe}<hr>";
  $lg = strlen($prefixe); 
  
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    
      list($key, $name)= each($sqlfetch);
      if (substr($name, 0, $lg) == $prefixe) {
          $t[] =array($name, substr($name, $lg)) ;
      };
      //her_displayArray($sqlfetch,"----- build_const_table -----");
    }
    
    //her_displayArray($t,"----- build_const_table -----");
  //exit;
  return $t;
}
 **********************************************************************/
//-------------------------------------------------------------


  $msg = _AD_HER_ADDOK;
  echo "<hr>";
//  echo $op.'<br>';
  //---------------------------------------------------------
  switch ($op){
  
  case "getFileList":

    $folder = _HER_ROOT_PATH."plugins/";  
    getFileList($folder,  ".php");
    echo "<hr>";    
    break;
      
  case "updatePluginsList":

    updatePluginsList();  
    
    echo "<hr>";    
    break;

  case "createNewGroupHermesA":

    createNewGroup ('HERMES_ANONYMOUS', "Groupe d'abonné à la newLetter de HERMES", $group_type = 'Anonymous');  
    
    echo "<hr>";    
    break;

  case "purgerArchives":
    if ($ok == 0){
      $msg = sprintf(_AD_HER_CONFIRM_PURGE, "<b>{$_GET['name']} (id:{$idTexte})</b>" , _AD_HER_LETTERS);            
      xoops_confirm(array('op'         => 'removeOk', 
                          'idTexte'    => $_GET['idTexte'] ,
                          'ok'         => 1),
                          "admin_texte.php", $msg );

    }else{
        purgerArchive();
        $msg = "Les archives ontété purgées avec succès" ;    
    
    }
//    xoops_cp_footer();
    
    break;

  
    echo "<hr>";  
    
  case "purgerAllArchives":
    purgerArchive(0, true);
    $msg = "Les archives ontété purgées avec succès" ;    
    echo "<hr>";    
    break;
    
  case "setFolderForUpload":
    setFolderForUpload ('pieces', '0666',$msg);
    // = "Dossier créé";    
    echo "<hr>";    
    break;
    
  case "showColumnSql":
    showColumnSql ($msg);
    // = "Dossier créé";    
    echo "<hr>";    
    break;
    
    
  case "testMail":
    testMail ($msg);
    // = "Dossier créé";    
    echo "<hr>";    
    break;

  case "purgerStat":
    purgerStat ();
    // = "Dossier créé";    
    echo "<hr>";    
    break;
    
  case "updateQuantiemeLecture":
     updateQuantiemeLecture();
    // = "Dossier créé";    
    echo "<hr>";    
    break;
    
  case "testRegexp":
     testRegexp();
    // = "Dossier créé";    
    echo "<hr>";    
    break;
    
  case "build_const_table":
    build_const_table('bab_','generation','babel_constantes_table.php');
    echo "<hr>";    
    break;
    
    
  }

  
  redirect_header("index.php",3,$op."<br>".$msg);
  
?>
