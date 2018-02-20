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
include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php');


//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                                ."modules/".$xoopsModule->getVar('dirname')
                                ."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------


//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idLettre',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listFiles () {
global $xoopsModule, $xoopsDB;
 
    
  $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);   
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
    OpenTable();
    //**********************************************************************************    
    echo "<b>"._AD_HER_UPLOAD_FOR_LETTER."</b><br>";    
        echo "<table>";
    
    //-----------------------------------------------------------
    $folder = _HER_ROOT_PATH."pieces/";
    
    $tFiles = getFileListH($folder, $extention = "", $level = 1);
    $nbFiles = count($tFiles);
    if ($nbFiles > 0){
      $nblines = ($nbFiles > 16)?16:$nbFiles;
         $t = array();
        $t[] = "<select size='{$nblines}' name='D1[]' multiple>";
        $lg = strlen($folder);
        for ($h = 0; $h < count($tFiles); $h++){
          $f = substr($tFiles[$h], $lg);
          $t[] = "<option value='{$f}'>{$f}</option>";    
        }
        $list[] = "</select>";
      
        $lstFiles =  implode("\n",$t)."\n";
        echo "<FORM METHOD='post' action='admin_fichier.php?op=delete'>";    
      
        echo "<tr>";              
        echo     "<td>"._AD_HER_FILES."</td>\n";  
        echo     "<td>{$lstFiles}</td>\n";   
        echo "</tr><tr><td></td>";      
        echo     "<td align='left'><input type='submit' name='delete' value='"._AD_HER_DELETE."'></td>\n";     
        echo "</tr>";
        echo " ";      
        echo "</form>";
        
        //----------------------------------------------------    
        echo $ligneDeSeparation;   
        //----------------------------------------------------
   
    }
    echo "<FORM METHOD='post' enctype='multipart/form-data'>";
    echo " <tr><td>"._AD_HER_DOWNLOAD."</td>";
    echo "<td>";    
    echo "<input name='fileup' type='file' size=50 value='toto'>";
    echo "<input type='submit' name='ok' value='"._AD_HER_DOWNLOAD2."'>";
    echo "</td></tr>";    
    echo "</form></table>";

     
    //**********************************************************************************
	CloseTable();


}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function transfertFile($p){
  //displayArray($p,"---------- transfertFile ----------");
    //copy($p['fileup'], HER_ROOT_PATH."/pieces/{$p['fileup_name']}");
    
    //$to = _HER_ROOT_PATH."pieces/{$p['name']}";
    $to = _HER_ROOT_PIECES.$p['name'];    
    //echo "<hr>{$to}<hr>";
    move_uploaded_file($p['tmp_name'], $to);   
     
    
}

/*****************************************************************
 *
 *****************************************************************/
function deleteFiles($p){
  //displayArray($p,"---------- deleteFiles ----------");
  if (!is_array($p)) return;
  if (count($p) == 0) return;
  $folder = _HER_ROOT_PATH."/pieces/";
    
  for ($h = 0; $h < count($p); $h++)  {
    
    unlink ($folder.$p[$h]);
  } 
    
}


//---------------------------------------------------------------------
//if (isset($gepeto['reloadStructure']))    {$op = "reloadStructure";} 
//if (isset($gepeto['saveEditBeforeSend'])) {$op = "saveEditBeforeSend";} 
if (isset($gepeto['ok']))     {$op = "ok";}
//--------------------------------------------------------------------   
//$bOk = ($op <> 'previewLetter');   
$bOk = true;
if ($bOk){admin_xoops_cp_header(_HER_ONGLET_FILES, $xoopsModule);}   

switch($op) {
		
  case "ok":
    transfertFile($_FILES['fileup']);
		listFiles ();    
   	break;

  case "delete":
    deleteFiles($gepeto['D1']);
    //deleteFiles($_SERVER);    
		listFiles ();    
   	break;
		
  case "listFiles":
	default:  
		listFiles ();
		break;

}

if ($bOk) {admin_xoops_cp_footer();} 

?>
