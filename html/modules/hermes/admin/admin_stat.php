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
include_once ('admin_interface.php');

//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."/modules/".$xoopsModule->getVar('dirname')
                               ."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------

define ("_PREFIX_NAME",       "name_");
define ("_PREFIX_ORDER",      "order_");
define ("_PREFIX_ACTIF",      "actif_");
define ("_PREFIX_ID",         "id_");
define ("_PREFIX_CATEGORIES", "categories_");

define ("_PREFIX_LIST",    _PREFIX_ID."|"
                          ._PREFIX_NAME."|"
                          ._PREFIX_ORDER."|"
                          ._PREFIX_ACTIF."|"
                          ._PREFIX_CATEGORIES);


//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idTexte',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------


/****************************************************************************
 *
 ****************************************************************************/
function editStatDetaillee ($p){
	global $xoopsModuleConfig, $xoopsDB;
	

    
    //------------------------------------------------    
  $myts =& MyTextSanitizer::getInstance();    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
  //echo "<hr>editStatDetaillee : idArchive = {$p['idArchive']}<hr>";
  $sqlquery = getStatistiquesDetailleesByArchive($p['idArchive']); 
  $rst = $xoopsDB->fetchArray(db_getArchives($p['idArchive'])); 
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_LIBELLES."</b><br>";    

    //echo "<FORM ACTION='admin_lettre.php' METHOD=POST>";



    echo ""._AD_HER_STATDETAILLEE."<b> {$rst['nom']}({$rst['idLettre']}-{$rst['idArchive']}) </b><br>";    
    
    //----------------------------------------------------------------
    
    $tblStyle = getTblStyle();
    echo "<table {$tblStyle}>";  
    $h = 0;
    
    //--------------------------------------------------------
      $bg = '';
      $colEmpty = "<TD {$bg} align='center'></td>";      
      $colH = "<TD {$bg} align='center'>|</td>";      

      echo '<tr>';
      echo "{$colH}<td {$bg} align='right'>#}</td>{$colH}";      
      echo "<td  {$bg} align='right'>id L-A</td>{$colH}";      
      echo "<td {$bg} >idUser</td>{$colH}";
      echo "<td {$bg} >email</td>{$colH}";      
      echo "<td {$bg} >date</td>{$colH}";
      echo "<td {$bg} >compteur</td>{$colH}";      
      echo "<td {$bg} >quantieme</td>{$colH}";
      
      echo "<td {$bg} >pseudo</td>{$colH}";      
      echo "<td {$bg} >name</td>{$colH}";       
 
        //-----------------------------------------------------------------------      
      echo '</tr>';       
    //--------------------------------------------------------        
    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      //displayArray8($sqlfetch,"----- editStatDetaillee -----");
      $bg = getRowStyle($row,'',0, _HER_TR_BASE);
      $colEmpty = "<TD {$bg} align='center'></td>";      
      $colH = "<TD {$bg} align='center'>|</td>";      
      //----------------------------------------------------------------------
      $h++;
      echo '<tr>';
      
      $d = date("d.m.y",$sqlfetch['dateLecture']);
      
      echo "{$colH}<td {$bg} align='right'>{$h}</td>{$colH}";      
      echo "<td  {$bg} align='right'>{$sqlfetch['idLettre']}-{$sqlfetch['idArchive']}</td>{$colH}";      
      echo "<td {$bg} >{$sqlfetch['idUser']}</td>{$colH}";
      echo "<td {$bg} >{$sqlfetch['email']}</td>{$colH}";      
      echo "<td {$bg} >{$d}</td>{$colH}";
      echo "<td {$bg} >{$sqlfetch['compteur']}</td>{$colH}";      
      echo "<td {$bg} >{$sqlfetch['quantieme']}</td>{$colH}";
      
      echo "<td {$bg} >{$sqlfetch['pseudo']}</td>{$colH}";      
      echo "<td {$bg} >{$sqlfetch['name']}</td>{$colH}";       
 
        //-----------------------------------------------------------------------      
      echo '</tr>';       
    }
    
    echo "</table>";      
       
 
	//CloseTable();    
  //**********************************************************************************
  includeStatButtons();  
}


/****************************************************************************
 *
 ****************************************************************************/
function editAllStatistiques ($bDetail = true, $présentation = 0){
// $présentation = 0 : présentation en tableau
// $présentation = 1 : présentation en graphique


	global $xoopsModuleConfig, $xoopsDB;
	

    
    //------------------------------------------------    
  $myts =& MyTextSanitizer::getInstance();    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_LIBELLES."</b><br>";    

    //echo "<FORM ACTION='admin_lettre.php' METHOD=POST>";
    if ($présentation == 1){
      showGraphique(0, $bDetail);    
    }else{
      showStatistiques(0, $bDetail);    
    }
   
   
    
    
	//CloseTable();    
    //**********************************************************************************
    
  includeStatButtons();
  
}


/************************************************************************
 *
 ************************************************************************/
function includeStatButtons(){
  OpenTable();
  //---------------------------------------------------------
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
      <td align='right'>
        "._AD_HER_STAT_ARRAYS." 
      </td>   
    
    <FORM ACTION='admin_stat.php?op=editAllStatistiquesGlobales&presentation=0' METHOD=POST>    
      <td align='right'>
        <input type='submit' name='fermer' value='"._AD_HER_STAT_GLOBAL."' > 
      </td>   
    </form>
    
    <FORM ACTION='admin_stat.php?op=editAllStatistiques&presentation=0' METHOD=POST>    
      <td align='right'>
        <input type='submit' name='fermer' value='"._AD_HER_STAT_DETAIL."' > 
      </td>   
    </form>
    
      <td align='right'>
         
      </td>   
    
  </tr>

  <tr valign='top'>
      <td align='right'>
        "._AD_HER_STAT_GRAPHICS." 
      </td>   
    
    <FORM ACTION='admin_stat.php?op=editAllStatistiquesGlobales&presentation=1' METHOD=POST>    
      <td align='right'>
        <input type='submit' name='fermer' value='"._AD_HER_STAT_GLOBAL."' > 
      </td>   
    </form>
    
    <FORM ACTION='admin_stat.php?op=editAllStatistiques&presentation=1' METHOD=POST>    
      <td align='right'>
        <input type='submit' name='fermer' value='"._AD_HER_STAT_DETAIL."' > 
      </td>   
    </form>
    
    <FORM ACTION='admin_lettre.php' METHOD=POST>    
      <td align='right'>
        <input type='submit' name='fermer' value='"._AD_HER_CLOSE."' > 
      </td>   
    </form>
    
  </tr>
</table>";

  //----------------------------------------------------------
	CloseTable();
}  
/************************************************************************
 *
 ************************************************************************/
if (!isset($gepeto['presentation'])) $gepeto['presentation'] = $xoopsModuleConfig['statPresentation'];
//---------------------------------------------------------   
  admin_xoops_cp_header(_HER_ONGLET_STAT, $xoopsModule); 

  switch($op) {
  case "editAllStatistiques":
		editAllStatistiques (true, $gepeto['presentation']);
		break;
		
  case "editAllStatistiquesGlobales":
		editAllStatistiques (false, $gepeto['presentation']);
		break;
		
  case "editStatDetaillee":
		editStatDetaillee ($gepeto);
		break;

		
	default:
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();


//---------------------------------------------------------------------
    

?>
