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
                                ."/modules/".$xoopsModule->getVar('dirname')
                                ."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------

//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idListe',   'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listMailingListe () {
global $xoopsModule, $xoopsDB;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  

	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    echo "<b>"._AD_HER_MAILING_LISTE."</b><br>";    

    $sqlquery = $adoMailingListe->getRows();
    
    
    echo "<table".getTblStyle().">";  
              
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $bg = getRowStyle($row,'',0, _HER_TR_BASE); 
      echo '<tr>';
      
      echo "<td{$bg}>{$sqlfetch['nom']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idListe = $sqlfetch['idListe'];
        
      //echo "<td>[{$sqlfetch['editBeforeSend']}]</td>";        
        //-----------------------------------------------------------------------   	   
        $link = "admin_liste.php?op=edit&idListe=".$idListe;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);        
        //-----------------------------------------------------------------------
    	  $link = "admin_liste.php?op=remove&idListe={$idListe}&name={$sqlquery['nom']}";
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_liste.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editListe($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    $listYesNo = array(_AD_HER_NO,_AD_HER_YES);    
 
    //------------------------------------------------    
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  

	 
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_LISTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_liste.php?op=save' METHOD=POST>";
    
    //********************************************************************
    CloseTable();
    OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    echo buildTitleOption (_AD_HER_MAILING_LISTE,_AD_HER_MAILING_LISTE_DSC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>";
    echo "<TD align='right' >".$p['idListe']." <INPUT TYPE=\"hidden\" id='idListe'  NAME='idListe'  size='1%'"." VALUE='".$p['idListe']."'></TD>";
    echo "</TR>";    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    


    //---liste des codes de remplacement
    //jai change de présentation, mais jegarde pour revoir ca pus tard
    /*
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']});";    
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 12, '', $oc);
    
    echo "<TD align='center' ><B>"._AD_HER_TEXTE."</B><br>"._AD_HER_TAGINFO."<br>{$listCode}</TD>"._br;    
    */
    //---texte    
    
   
    
   	//$desc1 = getXME($myts->makeTareaData4Save($p['texte']), 'txtTexte', '','100%');
   	$value = $p['liste'];
   	$desc1 = getEditor(99, $value, $name = 'txtListe', $caption = 'Liste',  
                   $width='80%', $height='400px', 
                   $rows = 24 , $cols = 69 );

    echo "<TR>"._br;
    echo "<TD align='center' ><B>"._AD_HER_TEXTE."</B</TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc1->render();
    echo "</TD>"._br;
    echo "</TR>"._br;
    
      
/*

    //---incrustation
    echo buildSpin(_AD_HER_INCRUSTATION, '', 'txtIncrustation', $p['incrustation'], 8, -8, 0, 10);
*/
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_liste.php",false)."'></td>
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
include_once (_HER_ROOT_PATH.'class/cls_hermes_mailingListe.php');
$adoMailingListe = new cls_hermes_mailingListe();
 
  admin_xoops_cp_header(_HER_ONGLET_LISTES, $xoopsModule); 

  switch($op) {
		
  case "save":
		$adoMailingListe->saveRequest ($_POST);
    redirect_header("admin_liste.php?op=list",1,_AD_HER_ADDOK);		
		break;

  case "new":
    $p = $adoMailingListe->getArray(0);
    editListe ($p);
		break;

  case "edit":
		$p = $adoMailingListe->getArray ($idListe);
		//displayArray($p,"----- Listes -----");
    editListe ($p);
		break;


  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idListe})</b>" , _AD_HER_LISTES);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idListe'    => $_GET['idListe'] ,
                        'ok'         => 1),
                        "admin_liste.php", $msg );
//    xoops_cp_footer();
    
    break;


  case "removeOk":
    $adoMailingListe->deleteId ($_POST['idListe']);    
    redirect_header("admin_liste.php?op=list",1,_AD_HER_ADDOK);    
		break;


  case "liste":		
	default:
    listMailingListe($gepeto);
    break;

}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
