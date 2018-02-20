<?php
//  ------------------------------------------------------------------------ //
//       HERMES - Module de gestion de lettre de diffusion pour XOOPS        //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://xoops.kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Module HERMES version 1.1.1pour XOOPS- Gestion de lettre de diffusion 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique G�n�rale GNU publi�e par la Free Software Foundation (version 2 ou bien toute autre version ult�rieure choisie par vous). 

Ce programme est distribu� car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but sp�cifique. Reportez-vous � la Licence Publique G�n�rale GNU pour plus de d�tails. 

Vous devez avoir re�u une copie de la Licence Publique G�n�rale GNU en m�me temps que ce programme ; si ce n'est pas le cas, �crivez � la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Cr�eation juin 2007
Derni�re modification : septembre 2007 
******************************************************************************/


include_once ("admin_header.php");
include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php');


//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                              ."modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------



//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idFluxrss', 'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listFluxrss () {
global $xoopsModule, $xoopsDB,$adoFluxRSS;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_TEXTES."</b><br>";    

    $sqlquery = $adoFluxRSS->getRows ();
    
    
    echo "<table".getTblStyle().">";  
              
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $bg = getRowStyle($row,'',0, _HER_TR_BASE);; 
      echo '<tr>';
      $idFluxrss = $sqlfetch['idFluxrss'];   
      
      echo "<td{$bg}>({$idFluxrss})</td>";     
      echo "<td{$bg}>{$sqlfetch['nom']}</td>";       
      echo "<td{$bg}>{$sqlfetch['description']}</td>";         
      //echo "<td>{$sqlfetch['url']}</td>";
            
        //-----------------------------------------------------------------------   	   
        $link = "admin_fluxrss.php?op=edit&idFluxrss=".$idFluxrss;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);           
        //-----------------------------------------------------------------------
    	  $link = "admin_fluxrss.php?op=remove&idFluxrss={$idFluxrss}";
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
        //-----------------------------------------------------------------------      
      echo '</tr>';       
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_fluxrss.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editFluxrss($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

    $idFluxrss = $p['idFluxrss'];    
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_fluxrss.php?op=save&idFluxrss={$idFluxrss}' METHOD=POST>";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>";
    echo "<TD align='right' >".$p['idFluxrss']." <INPUT TYPE=\"hidden\" idFluxrss='idFluxrss'  NAME='idFluxrss'  size='1%'"." VALUE='".$p['idFluxrss']."'></TD>";
    echo "</TR>";    


    //---Nom
    echo buildInput(_AD_HER_NOM, '', 'txtNom', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    
    
    //---Fluxrss
    echo buildInput(_AD_HER_URL, '', 'txtUrl', $myts->makeTboxData4Show($p['url'], "1", "1", "1"), '60%');    


    //---description
    echo buildInput(_AD_HER_DESCRIPTION, '', 'txtDescription', $myts->makeTboxData4Show($p['description'], "1", "1", "1"), '60%');    

    //---Colonnes a afficher
    echo buildInput(_AD_HER_AFFICHAGE_ITEM, _AD_HER_AFFICHAGE_ITEM_DSC, 'txtColonnes', $myts->makeTboxData4Show($p['colonnes'], "1", "1", "1"), '60%');    
   
    //---max
    echo buildSpin(_AD_HER_MAXITEM, _AD_HER_MAXITEM_DSC, 'txtMax', $p['max'], 99, 0, 1, 10);
        
    //---Options
    //echo buildSpin(_AD_HER_OPTIONSRSS, _AD_HER_OPTIONSRSS_DSC, 'txtOptions', $p['options'], 3, 1, 1, 10);    


    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_fluxrss.php",false)."'></td>
        <td align='left' width='200'></td>
    
        <td align='right'>
        <input type='submit' name='submit' value='"._AD_HER_VALIDER."' )'>    
        </td>    
      </tr>
      </table>
      </form>";
    
        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}


/************************************************************************
 *
 ************************************************************************/
include_once (_HER_ROOT_PATH.'class/cls_hermes_fluxRSS.php');
$adoFluxRSS = new cls_hermes_fluxRss();
 
  admin_xoops_cp_header(_HER_ONGLET_FLUXRSS, $xoopsModule); 

  switch($op) {
  
  case "list":
		listFluxrss ();
		break;


  case "new":
    $p = $adoFluxRSS->getArray (0);
    editFluxrss ($p);
		break;

  case "edit":
		$p = $adoFluxRSS->getArray ($idFluxrss);
    editFluxrss ($p);
    //redirect_header("admin_texte.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		$adoFluxRSS->saveRequest ($_POST);
    redirect_header("admin_fluxrss.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['url']} (id:{$idFluxrss})</b>" , _AD_HER_FLUXRSS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idFluxrss'      => $_GET['idFluxrss'] ,
                        'ok'         => 1),
                        "admin_fluxrss.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
    $adoFluxRSS->deleteId ($_POST['idFluxrss']);    
    redirect_header("admin_fluxrss.php?op=list",1,_AD_HER_DELETEOK);    
		break;


		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_fluxrss.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
