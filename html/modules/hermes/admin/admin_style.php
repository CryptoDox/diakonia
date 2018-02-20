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
              array('name' =>'idStyle',   'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listStyle () {
global $xoopsModule, $xoopsDB;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_StyleS."</b><br>";    

    $sqlquery = db_getStyles ();
    
    
    echo "<table>";  
              
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      echo '<tr>';
      
      echo "<td>{$sqlfetch['nom']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idStyle = $sqlfetch['idStyle'];
        
      echo "<td>[{$sqlfetch['editBeforeSend']}]</td>";        
        //-----------------------------------------------------------------------   	   
        $link = "admin_style.php?op=edit&idStyle=".$idStyle;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT);
        //-----------------------------------------------------------------------
        //Dupliquer le style
    	  $link = "admin_style.php?op=duplicate&idStyle=".$idStyle;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE);        
        //-----------------------------------------------------------------------
        //suppression du Style        
    	  $link = "admin_style.php?op=remove&idStyle={$idStyle}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE);
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_style.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editStyle($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------    
   
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_Style_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_style.php?op=save' METHOD=POST>";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='100%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>";
    echo "<TD align='right' >".$p['idStyle']." <INPUT TYPE=\"hidden\" id='idStyle'  NAME='idStyle'  size='1%'"." VALUE='".$p['idStyle']."'></TD>";
    echo "</TR>";    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    


    //---liste des codes de remplacement
    //jai change de présentation, mais jegarde pour revoir ca pus tard
    /*
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtStyle\",{$xoopsModuleConfig['editor']});";    
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 12, '', $oc);
    
    echo "<TD align='center' ><B>"._AD_HER_Style."</B><br>"._AD_HER_TAGINFO."<br>{$listCode}</TD>"._br;    
    */
    
    
   
    //---Style    
                       //$myts->makeTareaData4Show($p['css']),
    $desc1 = getEditor(_EDITOR_TEXTAREA, 
                       $p['css'], 
                       'txtCss', 'Style', '600px', '600px', 32, 120 );
   	
    echo "<TR>"._br;
    echo "<TD align='center'  width='80px'><B>"._AD_HER_STYLE."</B</TD>"._br;    
    echo "<TD align='left'  width='500px'>";
    echo $desc1->render();
    //echo "<div  width='600px'><textarea rows='54' name='txtCss' cols='120'>{$p['css']}</textarea></div>";

    echo "</TD>"._br;
    echo "</TR>"._br;
    
    echo buildDescription(_AD_HER_STYLE_DSC);    

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_style.php",false)."'></td>
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


/***********************************************************************
 *
 ***********************************************************************/




/*******************************************************************
 *
 *******************************************************************/
function saveStyle ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	   // $name = $myts->makeTboxData4Show();	

  //------------------------------------
  
  $idStyle = $t['idStyle'];
  //-----------------------------------------------------------
  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);
  //-----------------------------------------------------------
   $t['txtName']      = string2sql($t['txtName']);

   //$txt = $t['txtCss'];
   //$txt = $myts->makeTareaData4Save($txt);   
   $txt = string2sql($t['txtCss']);    
   
  if ($idStyle == 0){
    
      $sql = "INSERT INTO "._HER_TFN_STYLE
            ." (nom, css) \n"
            ." VALUES (" 
            ." '{$t['txtName']}',"  
            ." '{$txt}'"
            ." )";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE "._HER_TFN_STYLE." SET "
           ." nom           = '{$t['txtName']}',"
           ." css           = '{$txt}'" 
           ." WHERE idStyle = ".$idStyle;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
//exit;
}

/****************************************************************
 *
 ****************************************************************/

function deleteStyle ($idStyle) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM "._HER_TFN_STYLE." "
	      ."WHERE idStyle = {$idStyle}";
	
       $xoopsDB->query($sql);	

	
  
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getStyle ($idStyle){
	global $xoopsModuleConfig, $xoopsDB;

  if ($idStyle == 0) {
      $p = array ('idStyle'           => 0, 
                  'nom'               => '',
                  'css'               => '');

  }
  else {
    	
    $sql = "SELECT  * FROM "._HER_TFN_STYLE." "
          ."WHERE idStyle = ".$idStyle;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   //$p['nom'] = sql2string ($p['nom']);
   //$p['css'] = sql2string ($p['css']);
    
  }
  return $p;
}

/************************************************************************
 *
 ************************************************************************/
 
  admin_xoops_cp_header(_HER_ONGLET_CODE, $xoopsModule); 

  switch($op) {
  case "list":
		listStyle ();
		break;
		
  case "saveList":
		saveListStyle ($_POST);
    redirect_header("admin_style.php?op=list",1,_AD_HER_ADDOK);		
		break;

  case "new":
		//saveStyle ($_POST);
    $p = getStyle (0);
    
    editStyle ($p);
    //redirect_header("admin_style.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		//saveStyle ($_POST);
		$p = getStyle ($idStyle);
    editStyle ($p);
    //redirect_header("admin_style.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		saveStyle ($_POST);
    redirect_header("admin_style.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idStyle})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idStyle'    => $_GET['idStyle'] ,
                        'ok'         => 1),
                        "admin_style.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "duplicate":
    $idStyle = duplicateStyle ($idStyle); 
		$p = getStyle ($idStyle);    
    editStyle ($p);    
  	break;

  case "removeOk":
		//saveStyle ($_POST);
    //deleteStyle ($id);
    deleteStyle ($_POST['idStyle']);    
    redirect_header("admin_style.php?op=list",1,_AD_HER_DELETEOK);    
		break;

  case "clear":
		//saveStyle ($_POST);
    clearStyle ($id);
    redirect_header("admin_style.php?op=edit",1,_AD_HER_ADDOK);    
		break;

		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_style.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
