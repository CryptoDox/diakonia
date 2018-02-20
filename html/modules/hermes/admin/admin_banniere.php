<?php
//  ------------------------------------------------------------------------ //
//            LEXIQUE - Module de gestion de lexiques pour XOOPS             //
//                    Copyright (c) 2006 JJ Delalandre                       //
//                       <http://kiolo.com>                                  //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Module LEXIQUE version 1.6.2 pour XOOPS- Gestion multi-lexiques 
Copyright (C) 2007 Jean-Jacques DELALANDRE 
Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon les termes de la Licence Publique Générale GNU publiée par la Free Software Foundation (version 2 ou bien toute autre version ultérieure choisie par vous). 

Ce programme est distribué car potentiellement utile, mais SANS AUCUNE GARANTIE, ni explicite ni implicite, y compris les garanties de commercialisation ou d'adaptation dans un but spécifique. Reportez-vous à la Licence Publique Générale GNU pour plus de détails. 

Vous devez avoir reçu une copie de la Licence Publique Générale GNU en même temps que ce programme ; si ce n'est pas le cas, écrivez à la Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, +tats-Unis. 

Dernière modification : juin 2007 
******************************************************************************/


include_once ("admin_header.php");
include_once ("admin_catMenu.php");
include_once ("admin_buildLetter.php");

require_once (XOOPS_ROOT_PATH."/include/jjd/functions.php");
require_once (XOOPS_ROOT_PATH."/include/jjd/html_functions.php");
include_once (_HERCST_DIR_MODULEROOT."include/hermes_data.php");

define ("_PREFIX_NAME",       "name_");
define ("_PREFIX_ORDER",      "order_");
define ("_PREFIX_ACTIF",      "actif_");
define ("_PREFIX_ID",         "id_");
define ("_PREFIX_CATEGORIES", "categories_");

define ("_PREFIX_LIST",    _PREFIX_ID.";"
                          ._PREFIX_NAME.";"
                          ._PREFIX_ORDER.";"
                          ._PREFIX_ACTIF.";"
                          ._PREFIX_CATEGORIES);


//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idTexte',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (XOOPS_ROOT_PATH."/include/jjd/gp_globe.php");
//-------------------------------------------------------------

function listTexte () {
global $xoopsModule, $xoopsDB;
 
    
	$j =  XOOPS_URL._HERCST_DIR_JS."jjd_tools.js";
  echo _herbr."<script type='text/javascript' src='{$j}'></script>"._herbr;  	
	?>
	<script type='text/javascript' src='funcs.js'></script>
	<script type='text/javascript' src='cookies.js'></script>
	<?php

	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    echo "<b>"._AD_HER_LETTERS."</b><br>";    

    $sqlquery = db_getTextes ();
    
    
    echo "<table>";  
              
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      echo '<tr>';
      
      echo "<td>{$sqlfetch['nom']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idTexte = $sqlfetch['idTexte'];
        
      echo "<td>[{$sqlfetch['editBeforeSend']}]</td>";        
        //-----------------------------------------------------------------------   	   
        $link = "admin_texte.php?op=edit&idTexte=".$idTexte;
        echo "<TD align='center'>";        
    	  echo "<A href='".$link."'><img src='"._HERICO_EDIT."' border=0 Alt='"._AD_HER_EDIT."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";    
        //-----------------------------------------------------------------------
        /*

    	  $link = "admin_structure.php?op=list&idTexte=".$idTexte;
        echo "<TD align='center'>";        
    	  echo "<A href='".$link."'><img src='"._HERICO_TOOLS."' border=0 Alt='"._AD_HER_STRUCTURE."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";    
        */      
        //-----------------------------------------------------------------------
        //Dupliquer la lettre
    	  $link = "admin_texte.php?op=duplicate&idTexte=".$idTexte;
        echo "<TD align='center'>";        
    	  echo "<A href='".$link."'><img src='"._HERICO_DUPLICATE."' border=0 Alt='"._AD_HER_DUPLICATE."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";    
        
          
        //-----------------------------------------------------------------------
        echo "<TD align='center'>";        

    	  $link = "admin_texte.php?op=remove&idTexte={$idTexte}&name={$sqlquery['nom']}";
    	  echo "<A href='".$link."'><img src='"._HERICO_REMOVE."' border=0 Alt='"."_AD_HER_DELETE"."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";            
 
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='javascript:window.navigate(\"admin_texte.php?op=new\")'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editTexte($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = "<TR><td colspan='2'><hr></td></TR>"._herbr;  
    $listYesNo = array(_AD_HER_NO,_AD_HER_YES);    
    $listPeriodicite = array(_AD_HER_PERIODE_ANNUELLE,
                             _AD_HER_PERIODE_SEMESTRIELLE,
                             _AD_HER_PERIODE_TRIMESTRIELLE,
                             _AD_HER_PERIODE_BIMENSUELLE,
                             _AD_HER_PERIODE_MENSUELLE,
                             _AD_HER_PERIODE_HEBDOMADAIRE,
                             _AD_HER_PERIODE_JOURNALIERE);
        
 
    //------------------------------------------------    
    $ligneDeSeparation = "<TR><td colspan='2'><hr></td></TR>"._herbr;

    
          
  //echo versionJS();
	?>
	<script type='text/javascript' src='funcs.js'></script>
	<script type='text/javascript' src='cookies.js'></script>
	
	<?php

//	<script type='text/javascript' src='include/xoops.js'></script>
	  //xoops_cp_header();
	 // echo "<div style = ' float:left; '>totovnbcnvbdfghfghfghgfhfghfg</div>";
	 
    OpenTable();  
	$j =  XOOPS_URL._HERCST_DIR_JS."jjd_tools.js";
  echo _herbr."<script type='text/javascript' src='{$j}'></script>"._herbr;  	
    
    //********************************************************************
	  echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	echo "<B>"._AD_HER_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_texte.php?op=save' METHOD=POST>"._herbr;
    
    //********************************************************************
    CloseTable();
    OpenTable();   
    echo "<table width='80%'>"._herbr;     
    //********************************************************************  
    echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>"._herbr;
    echo "<TD align='left' >".""."</TD>"._herbr;
    echo "<TD align='right' >".$p['idTexte']." <INPUT TYPE=\"hidden\" id='idTexte'  NAME='idTexte'  size='1%'"." VALUE='".$p['idTexte']."'></TD>"._herbr;
    echo "</TR>"._herbr;    



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
   	$desc1 = getEditor($p['texte'], 'txtTexte', '','100%');
    echo "<TR>"._br;
    echo "<TD align='center' ><B>"._AD_HER_TEXTE."</B</TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc1->render();
    echo "</TD>"._br;
    echo "</TR>"._br;
    
    //-------------code de remplacement
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 1, '', '');    
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']});";
    $btn =  "<input type='button' name='insertCode' value='"._AD_HER_INSERT_TAG."' onclick='{$oc}'>";
    
    
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_TAGINFO."<B></TD>"._br;    
    echo "<TD align='left' >{$listCode} ->  {$btn}</TD>"._br;    
    echo "</TR>"._br;    
    echo buildDescription(_AD_HER_TAGINFO_DSC);    
    echo $ligneDeSeparation;
 
 
    //-------------edit textebefore send
    echo buildList(_AD_HER_EDITBEFORESEND, _AD_HER_EDITBEFORESEND_DSC, 
                   'txtEditBeforeSend', $listYesNo, $p['editBeforeSend'], $ligneDeSeparation);
    
    
 //*********
    //--element a afficher 

    $lib = 'lib';
    $val = 'val';
    $id  = 'id';
    $h=0;
    $b = $p['affichage'];

    $t = array(array($lib => _AD_HER_CAPTION, $val => isBitOk($h, $b), $id => $h++), 
               array($lib => _AD_HER_NAME,    $val => isBitOk($h, $b), $id => $h++),    
               array($lib => _AD_HER_TEXTE,   $val => isBitOk($h, $b), $id => $h++));  

    echo "<tr><td><b>"._AD_HER_AFFICHAGE."</b></tr><td>"._br;
    echo buildCheckedListH ($t, '' , "txtAffichage", 0, 1, $lib, $val, $id);
    echo "</td></tr>"._br;
    echo buildDescription(_AD_HER_AFFICHAGE_DSC);


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
      
/*

    //---incrustation
    echo buildSpin(_AD_HER_INCRUSTATION, '', 'txtIncrustation', $p['incrustation'], 8, -8, 0, 10);
*/
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>"._herbr;    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_texte.php",false)."'></td>
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
function saveTexte ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  //------------------------------------
  
  $idTexte = $t['idTexte'];
  //-----------------------------------------------------------
  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);
  //-----------------------------------------------------------
   $t['txtName']      = string2sql($t['txtName']);
   $t['txtTexte'] = string2sql($t['txtTexte']);
   
    
  if ($idTexte == 0){
    
      $sql = "INSERT INTO ".$xoopsDB->prefix(_HERCST_TBL_TEXTE)." "._herbr
            ."(nom, texte, editBeforeSend, affichage, width,alignement, "
            ."borderWidth, borderColorLight, borderColorDark, bgColor)"._herbr
            ."VALUES (" 
            ."'{$t['txtName']}',"  
            ."'{$t['txtTexte']}',"
            ."{txtEditBeforeSend},"            
            ."{$bAffichage},"   
            ."'{$t['txtWidth']}',"            
            ."{$t['txtAlignement']},"              
            ."{$t['txtBorderWidth']},"    
            ."'{$t['txtBorderColorLight']}',"         
            ."'{$t['txtBorderColorDark']}',"                         
            ."'{$t['txtBgColor']}'"                          
            .")";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE ".$xoopsDB->prefix(_HERCST_TBL_TEXTE)." SET "._herbr
           ."nom               = '{$t['txtName']}',"._herbr
           ."texte             = '{$t['txtTexte']}',"._herbr  
           ."editBeforeSend    = {$t['txtEditBeforeSend']},"._herbr  
           ."affichage         = {$bAffichage},"._herbr   
           ."width             = '{$t['txtWidth']}',"._herbr           
           ."alignement        = {$t['txtAlignement']},"._herbr           
           ."borderWidth       = {$t['txtBorderWidth']},"._herbr 
           ."borderColorLight  = '{$t['txtBorderColorLight']}',"._herbr           
           ."borderColorDark   = '{$t['txtBorderColorDark']}',"._herbr           
           ."bgColor           = '{$t['txtBgColor']}'"._herbr
           ." WHERE idTexte = ".$idTexte;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";
}
/****************************************************************
 *
 ****************************************************************/

function newTexte () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO ".$xoopsDB->prefix(_HERCST_TBL_TEXTE)." "
	      ."(name,description,periodicite,jour) "
	      ."VALUES ('???','???',0,0)";
	
       $xoopsDB->query($sql);	

  
}

/****************************************************************
 *
 ****************************************************************/

function deleteTexte ($id) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM ".$xoopsDB->prefix(_HERCST_TBL_TEXTE)." "
	      ."WHERE idTexte = ".$id;
	
       $xoopsDB->query($sql);	

	
  //redirect_header("admin_lexique.php?op=edit",1,_AD_HER_ADDOK);	
  
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getTexte ($idTexte){
	global $xoopsModuleConfig, $xoopsDB;

  if ($idTexte == 0) {
      $p = array ('idTexte'           => 0, 
                  'nom'               => '',
                  'texte'             => '',
                  'editBeforeSend'    => 0,
                  'affichage'         => 255,
                  'width'             => '100%',
                  'alignement'        => 2,
                  'borderWidth'       => 0,
                  'borderColorLight'  => '',                  
                  'borderColorDark'   => '',                  
                  'bgColor'           => '');

  }
  else {
    	
    $sql = "SELECT  * FROM ".$xoopsDB->prefix(_HERCST_TBL_TEXTE)." "
          ."WHERE idTexte = ".$idTexte;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   $p['nom']      = sql2string ($p['nom']);
   $p['texte'] = sql2string ($p['texte']);



    
  }
  //displayArray ($p, "edition de lexique");  
  return $p;
}

/************************************************************************
 *
 ************************************************************************/
 
  admin_xoops_cp_header(_HER_ONGLET_TEXTE); 

  switch($op) {
  case "list":
		listTexte ();
		break;
		
  case "saveList":
		saveListTexte ($_POST);
    redirect_header("admin_texte.php?op=list",1,_AD_HER_ADDOK);		
		break;

  case "new":
		//saveTexte ($_POST);
    $p = getTexte (0);
    
    editTexte ($p);
    //redirect_header("admin_Texte.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		//saveTexte ($_POST);
		$p = getTexte ($idTexte);
    editTexte ($p);
    //redirect_header("admin_texte.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		saveTexte ($_POST);
    redirect_header("admin_texte.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idTexte})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idTexte' => $_GET['idTexte'] ,
                        'ok'         => 1),
                        "admin_texte.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "duplicate":
    $idTexte = duplicateTexte ($idTexte); 
		$p = getTexte ($idTexte);    
    editTexte ($p);    
  	break;

  case "removeOk":
		//saveTexte ($_POST);
    //deleteTexte ($id);
    deleteTexte ($_POST['idTexte']);    
    redirect_header("admin_texte.php?op=list",1,_AD_HER_ADDOK);    
		break;

  case "clear":
		//saveTexte ($_POST);
    clearTexte ($id);
    redirect_header("admin_texte.php?op=edit",1,_AD_HER_ADDOK);    
		break;


		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_texte.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
