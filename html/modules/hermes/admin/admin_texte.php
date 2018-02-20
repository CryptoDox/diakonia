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

function listTexte () {
global $xoopsModule, $xoopsDB, $adoTexte;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_TEXTES."</b><br>";    


    $sqlquery = $adoTexte->getRows('categorie,nom');    
    
    echo "<table ".getTblStyle().">";  
    
    $categorie = '';          
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idTexte = $sqlfetch['idTexte'];    
      
      $bg = getRowStyle($row,'',0,3); 
      if ($categorie <> $sqlfetch['categorie']){
        $categorie = $sqlfetch['categorie'];
        //echo "<hr>{$oldTypeLettre}-{$typeLettre}-{$caption}<hr>";
        echo buildDescription($categorie, $colSpan = 5, ($categorie <> ''));
              
      }
      
      echo '<tr>';
      echo "<td {$bg} align='right'>({$idTexte})</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
      
      echo "<td {$bg}>{$sqlfetch['nom']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            

        
      echo "<td{$bg}>[{$sqlfetch['editBeforeSend']}]</td>";        
        //-----------------------------------------------------------------------   	   
        $link = "admin_texte.php?op=edit&idTexte=".$idTexte;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);
        //-----------------------------------------------------------------------
        //Dupliquer la lettre
    	  $link = "admin_texte.php?op=duplicate&idTexte=".$idTexte;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE, '', '', $bg);        
        //-----------------------------------------------------------------------
        //suppression du texte        
    	  $link = "admin_texte.php?op=remove&idTexte={$idTexte}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
        //-----------------------------------------------------------------------
        //previsualisation du texte
    	  $link = "admin_texte.php?op=previewTexte&id={$idTexte}&name={$sqlquery['nom']}";        
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
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_texte.php?op=new",false)."'>    
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
  	//echo "<B>"._AD_HER_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_texte.php?op=save' METHOD=POST>";
    
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
    echo "<TD align='right' >".$p['idTexte']." <INPUT TYPE=\"hidden\" id='idTexte'  NAME='idTexte'  size='1%'"." VALUE='".$p['idTexte']."'></TD>";
    echo "</TR>";    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    

    //---categorie
    echo buildInput(_AD_HER_CATEGORY, _AD_HER_CATEGORY_TEXT_DSC, 'txtCategorie', $myts->makeTboxData4Show($p['categorie'], "1", "1", "1"), '60%');    

    //---liste des codes de remplacement
    //jai change de présentation, mais jegarde pour revoir ca pus tard
    /*
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']});";    
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 12, '', $oc);
    
    echo "<TD align='center' ><B>"._AD_HER_TEXTE."</B><br>"._AD_HER_TAGINFO."<br>{$listCode}</TD>"._br;    
    */
    
    
   
    //---texte    
   	$desc1 = getXME($myts->makeTareaData4Show($p['texte']), 'txtTexte', '','100%');
    echo "<TR>"._br;
    echo "<TD align='center' ><B>"._AD_HER_TEXTE."</B</TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc1->render();
    echo "</TD>"._br;
    echo "</TR>"._br;
    
  insertCodeDeRemplacement('txtTexte','lstCode');   
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

    $t = array(array($lib => _AD_HER_STRUCTURE_CAPTION, $val => isBitOk($h, $b), $id => $h++), 
               array($lib => _AD_HER_NAME,              $val => isBitOk($h, $b), $id => $h++),    
               array($lib => _AD_HER_TEXTE,             $val => isBitOk($h, $b), $id => $h++));  

    echo "<tr><td><b>"._AD_HER_AFFICHAGE."</b></tr><td>"._br;
    echo buildCheckedListH ($t, '' , "txtAffichage", 0, 1, $lib, $val, $id);
    echo "</td></tr>"._br;
    echo buildDescription(_AD_HER_AFFICHAGE_DSC);
    
    echo $ligneDeSeparation;
//-------------------------------------------------------------------
        //---modele de cadre
        $defaut = $p['idFrame'];
 
        $selected = buildHtmlListFromTable ('txtIdFrame', 
                                     _HER_TAB_DECO,
                                     'name', 
                                     'idDeco', 
                                     'name', 
                                     $defaut,
                                     '',
                                     "decoModele = 'frame'",
                                     '150','',true);
      
        echo buildSelecteur(_AD_HER_FRAME,_AD_HER_FRAME_DSC2 , $selected );



//-------------------------------------------------------------------
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
    echo "<table width='80%'>";    
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


/****************************************************************************
 *
 ****************************************************************************/
function previewTexte ($idTexte){
global $xoopsUser;
  $params =array('idLettre'  => 1954,
                 'idArchive' => 2501,
                 'caption' =>  'Titre de la lettre pour exemple');
                 
$paramsPerso = array(_HER_CODE_USER.'idUser'   => $xoopsUser->uid(),
                     _HER_CODE_USER.'pseudo'   => $xoopsUser->uname(),      
                     _HER_CODE_USER.'name'     => $xoopsUser->name(),
                     _HER_CODE_USER.'email'    => $xoopsUser->email(),    
                     _HER_CODE_USER.'mail'     => $xoopsUser->email(),
                     _HER_CODE_USER.'login'    => $xoopsUser->uname(),                      
                     'idLettre' => $cession['idLettre'],
                     'idArchive'=> $cession['idArchive']);      


    $texte = buildLetter_Texte ($idTexte, $params);
    $texte = replaceCodeInLetter($texte, $params);
    $texte = replaceCodePersonalise ($texte, $paramsPerso);    
    //**********************************************************************
    echo $texte;
    //**********************************************************************
    $link = "<a href='javascript:window.close();'>Close</a>";
    
		echo "<FORM ACTION='admin_texte.php?op=list' METHOD=POST>";
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



 

/************************************************************************
 *
 ************************************************************************/
//include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php'); 
include_once (_HER_ROOT_PATH.'class/cls_hermes_texte.php');
$adoTexte = new cls_hermes_texte();
   
  admin_xoops_cp_header(_HER_ONGLET_TEXTE, $xoopsModule); 

  switch($op) {
  case "list":
		listTexte ();
		break;
		

  case "new":
		$adoTexte->saveRequest($_POST);
    $p = $adoTexte->getArray(0);
    editTexte ($p);
		break;

  case "edit":
		$p = $adoTexte->getArray($idTexte);
    editTexte ($p);
    //redirect_header("admin_texte.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		$adoTexte->saveRequest($_POST);		
    redirect_header("admin_texte.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idTexte})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idTexte'    => $_GET['idTexte'] ,
                        'ok'         => 1),
                        "admin_texte.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
    $adoTexte->deleteId($_POST['idTexte']);    
    redirect_header("admin_texte.php?op=list",1,_AD_HER_DELETEOK);    
		break;

  case "duplicate":
		$p = $adoTexte->newClone ($idTexte, true, 'nom');    
    editTexte ($p);    
  	break;


  case "previewTexte":
    previewTexte ($id);
		break;

		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_texte.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
