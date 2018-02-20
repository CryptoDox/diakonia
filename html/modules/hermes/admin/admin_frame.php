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
              array('name' =>'idFrame',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listFrame () {
global $xoopsModule, $xoopsDB;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_FRAMES."</b><br>";    

    $sqlquery = db_getFrames (0,'nom');
    
    
    echo "<table ".getTblStyle().">";  
    
    $categorie = '';          
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $bg = getRowStyle($row,'',0,3); 
      
      echo '<tr>';
      
      echo "<td {$bg}>{$sqlfetch['nom']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idFrame = $sqlfetch['idFrame'];
        
      //echo "<td{$bg}>[{$sqlfetch['editBeforeSend']}]</td>";        
        //-----------------------------------------------------------------------   	   
        $link = "admin_frame.php?op=edit&idFrame=".$idFrame;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);
        //-----------------------------------------------------------------------
        //Dupliquer la lettre
    	  $link = "admin_frame.php?op=duplicate&idFrame=".$idFrame;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE, '', '', $bg);        
        //-----------------------------------------------------------------------
        //suppression du Frame        
    	  $link = "admin_frame.php?op=remove&idFrame={$idFrame}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
        //-----------------------------------------------------------------------
        //previsualisation du Frame
    	  $link = "admin_frame.php?op=previewFrame&id={$idFrame}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_VIEW, _AD_HER_VIEWTEXT, '', '', $bg); 
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_frame.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editFrame($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    $listYesNo = aList_noYes();    
    $listPeriodicite = aList_periodicite();
        
 
    //------------------------------------------------    
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_FRAME_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_frame.php?op=save' METHOD=POST>";
    
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
    echo "<TD align='right' >".$p['idFrame']." <INPUT TYPE=\"hidden\" id='idFrame'  NAME='idFrame'  size='1%'"." VALUE='".$p['idFrame']."'></TD>";
    echo "</TR>";    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    

    
 //*********

   //---alignement
   $listAlign = array(_AD_HER_LEFT,
                      _AD_HER_RIGHT,
                      _AD_HER_CENTER);

    echo buildList(_AD_HER_ALIGNEMENT, '', 'txtAlignement', $listAlign, $p['alignement']);
    
    //---largeur du tableau
    //echo buildSpin(_AD_HER_WIDTH.' (%)', '', 'txtWidth', $p['Width'], 100, 0, 100, 10);
    echo buildInput(_AD_HER_WIDTH, '', 'txtWidth', $myts->makeTboxData4Show($p['width'], "1", "1", "1"), '20%');    

      //echo "<td align='left' width = '20'>{$listCadres}<td>";
    //---borderWidth
    echo buildSpin(_AD_HER_BORDERWIDTH, '', 'txtBorderWidth', $p['borderWidth'], 25, 0, 1, 10);

    //---borderColorLight   
    echo buildColorSelecteur(_AD_HER_BORDERCOLORLIGHT, '', 'txtBorderColorLight', $p['borderColorLight']);

    //---borderColorDark   
    echo buildColorSelecteur(_AD_HER_BORDERCOLORDARK, '', 'txtBorderColorDark', $p['borderColorDark']);

    //---bgColor   
    echo buildColorSelecteur(_AD_HER_BGCOLOR, '', 'txtBgColor', $p['bgColor']);
      


    //---incrustation
    echo buildSpin(_AD_HER_INCRUSTATION, _AD_HER_INCRUSTATION_DSC, 'txtIncrustation', $p['incrustation'], 8, -8, 0, 10);
/*
*/
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_frame.php",false)."'></td>
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



/*******************************************************************
 *
 *******************************************************************/
function saveFrame ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	   // $name = $myts->makeTboxData4Show();	

  //------------------------------------
  //displayArray8($t, "----- saveFrame -----");
  $idFrame = $t['idFrame'];
  //-----------------------------------------------------------
   $t['txtName']      = string2sql($t['txtName']);
     
  if ($idFrame == 0){
    
      $sql = "INSERT INTO "._HER_TFN_FRAME." "
            ."(nom, width, alignement, "
            ."borderWidth, borderColorLight, borderColorDark, bgColor,incrustation )"
            ."VALUES (" 
            ."'{$t['txtName']}'," 
            ."'{$t['txtWidth']}',"            
            ."{$t['txtAlignement']},"              
            ."{$t['txtBorderWidth']},"    
            ."'{$t['txtBorderColorLight']}',"         
            ."'{$t['txtBorderColorDark']}',"                         
            ."'{$t['txtBgColor']}',"
            ."{$t['txtIncrustation']}"                                      
            .")";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE "._HER_TFN_FRAME." SET "
           ."nom               = '{$t['txtName']}',"
           ."width             = '{$t['txtWidth']}',"           
           ."alignement        = {$t['txtAlignement']},"           
           ."borderWidth       = {$t['txtBorderWidth']}," 
           ."borderColorLight  = '{$t['txtBorderColorLight']}',"           
           ."borderColorDark   = '{$t['txtBorderColorDark']}',"           
           ."bgColor           = '{$t['txtBgColor']}',"
           ."incrustation      = {$t['txtIncrustation']}"           
           ." WHERE idFrame = ".$idFrame;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
//exit;
}

/****************************************************************
 *
 ****************************************************************/

function deleteFrame ($idFrame) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM "._HER_TFN_FRAME." "
	      ."WHERE idFrame = ".$idFrame;
	
       $xoopsDB->query($sql);	

	
  
}

/****************************************************************************
 *
 ****************************************************************************/
function previewFrame ($idFrame){
global $xoopsUser;
  $params =array('idLettre'  => 1954,
                 'idArchive' => 2501,
                 'caption' =>  'Titre de la lettre pour exemple');
    
    //**********************************************************************                 
    $texte = 'Test de modèle de cadre';
    
    $rst       = getFrame($idFrame);
    $caption   = "Titre du texte";
    $nom       = "Nom du texte";
    $texte     = str_repeat (" contenu du texte. ", 50);
    $affichage = 255;    
    
    $texte = formatTexte ($caption, $nom, $texte, $affichage, $rst);
    echo $texte;



    //**********************************************************************
    $link = "<a href='javascript:window.close();'>Close</a>";
    
		echo "<FORM ACTION='admin_frame.php?op=list' METHOD=POST>";
    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
        <tr valign='top'>
        <td align='center' ><input type='submit' name='cancel' value='"._CLOSE."' ></td>
        <td align='left' width='200'></td>
        </tr>";
        //<td align='center' ><input type='button' name='cancel' value='"._CLOSE."' onclick='javascript:window.close();'></td>

   echo "</form>";
/*    
    //**********************************************************************    
	CloseTable();
	xoops_cp_footer();
*/ 
  
  
  
  
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getFrame ($idFrame){
	global $xoopsModuleConfig, $xoopsDB;

  if ($idFrame == 0) {
      $p = array ('idFrame'           => 0, 
                  'nom'               => '',
                  'width'             => '100%',
                  'alignement'        => 2,
                  'borderWidth'       => 0,
                  'borderColorLight'  => '',                  
                  'borderColorDark'   => '',                  
                  'bgColor'           => '',
                  'incrustation'      => 0);

  }
  else {
    	
    $sql = "SELECT  * FROM "._HER_TFN_FRAME." "
          ."WHERE idFrame = ".$idFrame;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;
   $p['nom']      = sql2string ($p['nom']);
    
  }
  return $p;
}

/************************************************************************
 *
 ************************************************************************/
//include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php'); 
//include_once (_HER_ROOT_PATH.'class/cls_hermes_frame.php');

  
   
  admin_xoops_cp_header(_HER_ONGLET_FRAME, $xoopsModule); 

  switch($op) {
  case "list":
		listFrame ();
		break;
		
  case "new":
		//saveFrame ($_POST);
    $p = getFrame (0);


    editFrame ($p);
    //redirect_header("admin_frame.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		//saveFrame ($_POST);
		$p = getFrame ($idFrame);
		
    editFrame ($p);
    //redirect_header("admin_frame.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		saveFrame ($_POST);
    redirect_header("admin_frame.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idFrame})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idFrame'    => $_GET['idFrame'] ,
                        'ok'         => 1),
                        "admin_frame.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "duplicate":
    $idFrame = duplicateFrame ($idFrame); 
		$p = getFrame ($idFrame);    
    editFrame ($p);    
  	break;

  case "removeOk":
		//saveFrame ($_POST);
    //deleteFrame ($id);
    deleteFrame ($_POST['idFrame']);    
    redirect_header("admin_frame.php?op=list",1,_AD_HER_DELETEOK);    
		break;

  case "previewFrame":
		//saveFrame ($_POST);
    previewFrame ($id);
		break;

		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_frame.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
