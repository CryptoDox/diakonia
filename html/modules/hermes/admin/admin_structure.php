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

require_once (_HERCST_DIR_MODULEROOT."include/functions.php");
require_once (_HERCST_DIR_MODULEROOT."include/html_functions.php");
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
              array('name' =>'idLettre',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HERCST_DIR_MODULEROOT."include/gp_globe.php");
//-------------------------------------------------------------

function listLettre () {
global $xoopsModule, $xoopsDB;
 
    
	$j =  XOOPS_URL._HERCST_DIR_JS."jjd_tools.js";
  echo _herbr."<script type='text/javascript' src='{$j}'></script>"._herbr;  	

	  xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    echo "<b>"._AD_HER_LETTERS."</b><br>";    

    $sqlquery = db_getLettres ();
    
    
    echo "<table>";  
              
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      echo '<tr>';
      
      echo "<td>{$sqlfetch['nom']}</td>";
      echo "<td>{$sqlfetch['description']}</td>";            
        $idLettre = $sqlfetch['idLettre'];
        //-----------------------------------------------------------------------   	   
        $link = "admin_lettre.php?op=edit&idLettre=".$idLettre;
        echo "<TD align='center'>";        
    	  echo "<A href='".$link."'><img src='"._HERICO_EDIT."' border=0 Alt='"._AD_HER_EDIT."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";    
        //-----------------------------------------------------------------------
    	  $link = "admin_structure.php?op=list&idLettre=".$idLettre;
        echo "<TD align='center'>";        
    	  echo "<A href='".$link."'><img src='"._HERICO_TOOLS."' border=0 Alt='"._AD_HER_STRUCTURE."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";    
        //-----------------------------------------------------------------------
        echo "<TD align='center'>";        

    	  $link = "admin_lettre.php?op=remove&idLettre={$idLettre}&name={$sqlquery['nom']}";
    	  echo "<A href='".$link."'><img src='"._HERICO_REMOVE."' border=0 Alt='"."_AD_HER_DELETE"."' width='20' height='20' ALIGN='absmiddle'></A>";
        echo "</td>";            
 
        //-----------------------------------------------------------------------      
      echo '</tr>';       
    }
    
    echo "</table>";      


     /*
                  
    $link = BuildLink ('lex_HERique', 'idLexique', 'name',
                       "admin_HERique.php?op=edit&idLexique=%0%", 'name');   
    echo "<p>-&nbsp;<A HREF='admin_HERique.php?op=list'>"._AD_HER_HERIQUE_MANAGEMENT."</A> : {$link}<br>";
    
    $link = BuildLink ('lex_selecteur', 'idSelecteur', 'name',
                       "admin_selecteur.php?op=edit&idSelecteur=%0%", 'name');   
    echo "<p>-&nbsp;<A HREF='admin_selecteur.php?op=list'>"._AD_HER_SELECTEUR_MANAGEMENT."</A> : {$link}<br>";
    
    $link = BuildLink ('lex_family', 'idFamily', 'name',
                       "admin_family.php?op=edit&id=%0%", 'name');   
    echo "<p>-&nbsp;<A HREF='admin_family.php?'>"._AD_HER_CATEGORY_MANAGEMENT."</A> : {$link}</p>";
    
    $link = BuildLink ('lex_caption', 'idCaption', 'name',
                       "admin_caption.php?op=edit&idCaption=%0%", 'name');   
    echo "<p>-&nbsp;<A HREF='admin_caption.php?'>"._AD_HER_CAPTION_MANAGEMENT."</A> : {$link}</p>";
    
    $link = BuildLink ('lex_property', 'idProperty', 'name',
                       "admin_property.php?op=edit&idProperty=%0%", 'name');   
    echo "<p>-&nbsp;<A HREF='admin_property.php?'>"._AD_HER_PROPERTY_MANAGEMENT."</A> : {$link}</p>";
     */    
     
    //**********************************************************************************

echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='javascript:window.navigate(\"admin_lettre.php?op=new\")'>    
  </tr>
  </form>";

    
	CloseTable();
	xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editLettre($p){
	
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
	$j =  XOOPS_URL._HERCST_DIR_JS."jjd_tools.js";
  echo _herbr."<script type='text/javascript' src='{$j}'></script>"._herbr;  	
  
  //echo versionJS();
  $idLettre = $p['idLettre'];

	  xoops_cp_header();
    OpenTable();  
    
    //********************************************************************
	  echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	echo "<B>"._AD_HER_LETTRE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_lettre.php?op=save' METHOD=POST>"._herbr;
    
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
    echo "<TD align='right' >".$p['idLettre']." <INPUT TYPE=\"hidden\" id='idLettre'  NAME='idLettre'  size='1%'"." VALUE='".$p['idLettre']."'></TD>"._herbr;
    echo "</TR>"._herbr;    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    

    //---Description
    echo buildInput(_AD_HER_DESCRIPTION, '', 'txtDescription', $myts->makeTboxData4Show($p['description'], "1", "1", "1"), '60%');    

    //---Periodicite
    echo buildList(_AD_HER_PERIODICITE, _AD_HER_PERIODE_DSC, 'txtPeriodicite', $listPeriodicite, $p['periodicite']);



    //---Jour
    echo buildSpin(_AD_HER_QUANTIEME, _AD_HER_QUANTIEME_DSC, 'txtJour', $p['jour'], 365, 1, 1, 10);
    //    echo buildSpin(_AD_LEX_ORDER, _AD_LEX_ORDER_DESC, 'txt_ordre', $p['ordre'], 100, 0, 1, 10);


    //groupes
    $groups = getListGroupesLettre($idLettre);
    
//displayArray2($groups,"----------------------------");

    //---optins pour xoops search
    //---actif
    $lib = 'name';
    $val = 'value';
    $id  = 'id';

    echo "<tr><td><b>"._AD_HER_GROUPE_DESTINATAIRE."</b></tr><td>"._br;
    echo buildCheckedListH ($groups, '' , "chkGroupe", 0, 1, $lib, $val, $id);
    echo "</td></tr>"._br;
    echo buildDescription(_AD_HER_GROUPE_DESTINATAIRE);


    
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>"._herbr;    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_lettre.php",false)."'></td>
        <td align='left' width='200'></td>
    
        <td align='right'>
        <input type='submit' name='submit' value='"._AD_HER_VALIDER."' )'>    
        </td>    
      </tr>
      </table>
      </form>";
    
        
    	CloseTable();
    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}


/***********************************************************************
 *
 ***********************************************************************/




/*******************************************************************
 *
 *******************************************************************/
function saveLettre ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  
  $idLettre = $t['idLettre'];
  //-----------------------------------------------------------
  $bDef = checkBoxToBin($t, 'definitions', $def);  
  $bSearch = checkBoxToBin($t, 'xoopsSearch', $def);  
  //-----------------------------------------------------------
   $t['txtName']      = string2sql($t['txtName']);
   $t['txtDescription'] = string2sql($t['txtDescription']);
   
    
  if ($idLettre == 0){
    
      $sql = "INSERT INTO ".$xoopsDB->prefix(_HERCST_TBL_LETTRE)." "._herbr
            ."(nom,description,periodicite,jour ) "._herbr
            ."VALUES (" 
            ."'{$t['txtName']}',"  
            ."'{$t['txtDescription']}',"            
            ."{$t['txtPeriodicite']},"            
            ."{$t['txtJour']}"
            .")";
            
      $xoopsDB->query($sql);
      $idLettre = $xoopsDB->getInsertId() ;
      
  }else{
      $sql = "UPDATE ".$xoopsDB->prefix(_HERCST_TBL_LETTRE)." SET "._herbr
           ."nom           = '{$t['txtName']}',"._herbr
           ."description   = '{$t['txtDescription']}',"._herbr           
           ."periodicite   = {$t['txtPeriodicite']},"._herbr           
           ."jour          = {$t['txtJour']} "._herbr     
           ." WHERE idLettre = ".$idLettre;
           
      $xoopsDB->query($sql);            
  }
  //----------------------------------------
  //$bSearch = checkBoxToBin($t, 'xoopsSearch', $def);        
  $name= 'chkGroupe' ;   
$list = htmlArrayOnPrefix($t, array($name), '_');
displayArray ($list, "=================");

    $sql = "DELETE FROM ".$xoopsDB->prefix(_HERCST_TBL_GROUPE).
         " WHERE idLettre = ".$idLettre;
    $xoopsDB->query($sql);         
/*
*/
  if (is_array($list)){
    for ($h = 0; $h < count($list); $h++){
      if (isset($list[$h][$name])){
        if ($list[$h][$name] == 'on') {
            $sql = "INSERT INTO ".$xoopsDB->prefix(_HERCST_TBL_GROUPE)
                 ." (idLettre, idGroupe)"
                 ." VALUES ({$idLettre},{$h})";
            $xoopsDB->query($sql);         
        
        }
      
      }
    }
  
  }


}
/****************************************************************
 *
 ****************************************************************/

function newLettre () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO ".$xoopsDB->prefix(_HERCST_TBL_LETTRE)." "
	      ."(name,description,periodicite,jour) "
	      ."VALUES ('???','???',0,0)";
	
       $xoopsDB->query($sql);	

  
}

/****************************************************************
 *
 ****************************************************************/

function deleteLettre ($id) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM ".$xoopsDB->prefix(_HERCST_TBL_LETTRE)." "
	      ."WHERE idLettre = ".$id;
	
       $xoopsDB->query($sql);	

	
  //redirect_header("admin_lexique.php?op=edit",1,_AD_HER_ADDOK);	
  
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getLettre ($idLettre){
	global $xoopsModuleConfig, $xoopsDB;

  if ($idLettre == 0) {
      $p = array ('idLettre'      => 0, 
                  'nom'           => '',
                  'description'   => '',
                  'periodicite'   => _HER_PERIODE_MENSUELLE, 
                  'jour'          => 1);

  }
  else {
    	
    $sql = "SELECT  * FROM ".$xoopsDB->prefix(_HERCST_TBL_LETTRE)." "
          ."WHERE idLettre = ".$idLettre;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   $p['nom']      = sql2string ($p['nom']);
   $p['description'] = sql2string ($p['description']);



    
  }
  //displayArray ($p, "edition de lexique");  
  return $p;
}

//---------------------------------------------------------------------
    

switch($op) {
  case "list":
		listLettre ();
		break;
		
  case "saveList":
		saveListLettre ($_POST);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);		
		break;

  case "new":
		//saveLettre ($_POST);
    $p = getLettre (0);
    
    editLettre ($p);
    //redirect_header("admin_Lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "edit":
		//saveLettre ($_POST);
		$p = getLettre ($idLettre);
    editLettre ($p);
    //redirect_header("admin_Lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		saveLettre ($_POST);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idLettre})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idLettre' => $_GET['idLettre'] ,
                        'ok'         => 1),
                        "admin_lettre.php", $msg );
    xoops_cp_footer();
    
    break;


  case "removeOk":
		//saveLettre ($_POST);
    //deleteLettre ($id);
    deleteLettre ($_POST['idLettre']);    
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;

  case "clear":
		//saveLettre ($_POST);
    clearLettre ($id);
    redirect_header("admin_lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;


		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);
    break;
}


?>
