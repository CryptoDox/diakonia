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
                              ."modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------



//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idUrl',     'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listUrl () {
global $xoopsModule, $xoopsDB, $adoUrl;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_TEXTES."</b><br>";    

    $sqlquery = $adoUrl->getRows('url') ;
    
    
    echo "<table".getTblStyle().">";  
              
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idUrl = $sqlfetch['idUrl'];    
    
      $bg = getRowStyle($row,'',0, _HER_TR_BASE);
      echo '<tr{$bg}>';
   
      
      echo "<td{$bg}>({$idUrl})</td>";      
      echo "<td{$bg}>{$sqlfetch['description']}</td>";         
      echo "<td{$bg}>{$sqlfetch['url']}</td>";
            
        //-----------------------------------------------------------------------   	   
        $link = "admin_syndication.php?op=edit&idUrl=".$idUrl;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);           
        //-----------------------------------------------------------------------
    	  $link = "admin_syndication.php?op=remove&idUrl={$idUrl}";
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_syndication.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editUrl($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

    $idUrl = $p['idUrl'];    
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_syndication.php?op=save&idUrl={$idUrl}' METHOD=POST>";
    
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
    echo "<TD align='right' >".$p['idUrl']." <INPUT TYPE=\"hidden\" idUrl='idUrl'  NAME='idUrl'  size='1%'"." VALUE='".$p['idUrl']."'></TD>";
    echo "</TR>";    


    //---URL
    echo buildInput(_AD_HER_URL_SYNDICATION, '', 'txtUrl', $myts->makeTboxData4Show($p['url'], "1", "1", "1"), '60%');    
    


    //---description
    echo buildInput(_AD_HER_DESCRIPTION, '', 'txtDescription', $myts->makeTboxData4Show($p['description'], "1", "1", "1"), '60%');    

    //---categorie
    echo buildInput(_AD_HER_CATEGORIE, '', 'txtCategorie', $p['categorie'], '60%');    
   
    
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_syndication.php",false)."'></td>
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
include_once (_HER_ROOT_PATH.'class/cls_hermes_url.php');
$adoUrl = new cls_hermes_url();
 
  admin_xoops_cp_header(_HER_ONGLET_SYNDICATION, $xoopsModule); 

  switch($op) {
  case "list":
		listUrl ();
		break;

  case "new":
		//saveTexte ($_POST);
    $p = $adoUrl->getArray (0);
    editUrl ($p);
		break;

  case "edit":
		//saveTexte ($_POST);
		$p = $adoUrl->getArray ($idUrl);
    editUrl ($p);
    //redirect_header("admin_texte.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "duplicate":
		$p = $adoUrl->newClone ($idUrl, true,'nom');    
    editMailingListe ($p);    
  	break;


  case "save":
		$adoUrl->saveRequest ($_POST);
    redirect_header("admin_syndication.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['url']} (id:{$idUrl})</b>" , _AD_HER_URL_SYNDICATION);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idUrl'      => $_GET['idUrl'] ,
                        'ok'         => 1),
                        "admin_syndication.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
    $adoUrl->deleteId ($_POST['idUrl']);    
    redirect_header("admin_syndication.php?op=list",1,_AD_HER_DELETEOK);    
		break;


		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_syndication.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
