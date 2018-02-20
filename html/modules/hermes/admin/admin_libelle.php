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
              array('name' =>'idLibelle',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listLibelle () {
global $xoopsModule, $xoopsDB,$adoLibelle;
 
  $myts =& MyTextSanitizer::getInstance();    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_LIBELLES."</b><br>";    

    $sqlquery = $adoLibelle->getRows('locked DESC,perso DESC,code ASC');
    
    
    echo "<table ".getTblStyle().">";  
              
    $oldRupture = -1;      
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        $idLibelle = $sqlfetch['idLibelle'];    
    
      $bg = getRowStyle($row,'',0, _HER_TR_BASE); 
      $colEmpty = "<TD {$bg} align='center'></td>";
            
      $rupture = ($sqlfetch['locked'] * 10) +  $sqlfetch['perso']; 
      //echo "<hr>{$oldRupture}:{$rupture}<br>";
      if (($oldRupture <> $rupture) & ($oldRupture) >= 0){

        echo buildHR(1, '839D2D',5); 
      }
        $oldRupture = $rupture;      
      
            
      echo '<tr>';
      echo "<td{$bg} align='right'>({$idLibelle})</td>";      
      echo "<td {$bg}>{$sqlfetch['code']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            

      $texte = $myts->previewTarea($sqlfetch['texte'],1,0,0,0,0);
      echo "<td{$bg}>{$texte}</td>";        
      
      
        //-----------------------------------------------------------------------   	   
        //editer
        if ($sqlfetch['locked'] == 0){        
          $link = "admin_libelle.php?op=edit&idLibelle=".$idLibelle;
          echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);
        }else{
          echo $colEmpty;        
        }
        //-----------------------------------------------------------------------
        //Dupliquer 
        if ($sqlfetch['perso'] == 0 & $sqlfetch['locked'] == 0){
      	  $link = "admin_libelle.php?op=duplicate&idLibelle=".$idLibelle;
          echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE, '', '', $bg);
        }else{
          echo $colEmpty;        
        }        
        //-----------------------------------------------------------------------
        //suppression du libelle        
    	  if ($sqlfetch['perso'] == 0 & $sqlfetch['locked'] == 0){
          $link = "admin_libelle.php?op=remove&idLibelle={$idLibelle}&name={$sqlquery['nom']}";        
          echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
        
        }else{
          echo $colEmpty;
        }
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_libelle.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editLibelle($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    
          
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_LIBELLE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_libelle.php?op=save' METHOD=POST>";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >".$p['idLibelle']." <INPUT TYPE=\"hidden\" id='idLibelle'  NAME='idLibelle'  size='1%'"." VALUE='".$p['idLibelle']."'></TD>";
    echo "</TR>";    

    //$disabled = (($sqlfetch['perso'] == 1) ? ' disabled ' : '');
    $disabled = (($p['perso'] == 1) ? _HER_color_disabled : '');    
    //$disabled = '';  //pour debuger permet la saisie des constantes
    //---Code
    echo buildInput(_AD_HER_CODE, '', 'txtCode', 
                    $myts->makeTboxData4Show($p['code'], "1", "1", "1"), 
                    '60%', '','',$disabled);    

    //---Constant
    echo buildInput(_AD_HER_CONSTANT, '', 'txtConstant', 
                    $myts->makeTboxData4Show($p['constant'], "1", "1", "1"), 
                    '60%', '','',$disabled);    

    //---libelle    
    $desc1 = getEditorHTML(_EDITOR_TEXTAREA, 
                       $p['texte'], 
                       'txtTexte', 'Texte', '600px', '50px', 5, 120 );
   	
    echo "<TR>"._br;
    echo "<TD align='center'  width='80px'><B>"._AD_HER_LIBELLE."</B</TD>";    
    echo "<TD align='left'  width='500px'>";
    echo $desc1->render();

    echo "</TD>"._br;
    echo "</TR>"._br;
    
    //echo buildDescription(_AD_HER_LIBELLE_DSC);    
    
   

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_libelle.php",false)."'></td>
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
include_once (_HER_ROOT_PATH.'class/cls_hermes_libelle.php');
$adoLibelle = new cls_hermes_libelle();
 
  admin_xoops_cp_header(_HER_ONGLET_LIBELLE, $xoopsModule); 

  switch($op) {
  
  case "list":
		listLibelle ();
		break;
		
  case "new":
    $p = $adoLibelle->getArray (0);
    
    editLibelle ($p);
    //redirect_header("admin_Libelle.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		$p = $adoLibelle->getArray ($idLibelle);
    editLibelle ($p);
    //redirect_header("admin_libelle.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		$adoLibelle->saveRequest ($_POST);
    redirect_header("admin_libelle.php?op=list",1,_AD_HER_ADDOK);		
		break;




  case "duplicate":
		$p = $adoLibelle->newClone ($idLibelle, true,'code');    
    editLibelle ($p);    
  	break;

  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idLibelle})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idLibelle'    => $_GET['idLibelle'] ,
                        'ok'         => 1),
                        "admin_libelle.php", $msg );
//    xoops_cp_footer();
    
    break;
    
  case "removeOk":
    //deleteLibelle ($id);
    $adoLibelle->deleteId ($_POST['idLibelle']);    
    redirect_header("admin_libelle.php?op=list",1,_AD_HER_DELETEOK);    
		break;

		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_libelle.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
