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

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idSondage', 'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listSondage () {
global $xoopsModule, $xoopsDB, $adoSondage;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_TEXTES."</b><br>";    


    $sqlquery = $adoSondage->getRows('categorie,nom');    
    
    echo "<table ".getTblStyle().">";  
    
    $categorie = '';          
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idSondage = $sqlfetch['idSondage'];   
      
      $bg = getRowStyle($row,'',0,3); 
      if ($categorie <> $sqlfetch['categorie']){
        $categorie = $sqlfetch['categorie'];
        //echo "<hr>{$oldTypeLettre}-{$typeLettre}-{$caption}<hr>";
        echo buildDescription($categorie, $colSpan = 5, (categorie <> ''));
              
      }
      
      echo '<tr>';
      
      echo "<td {$bg}>({$idSondage})</td>";      
      echo "<td {$bg}>{$sqlfetch['nom']}</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            

        
        //-----------------------------------------------------------------------   	   
        $link = "admin_sondage.php?op=edit&idSondage=".$idSondage;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);
        //-----------------------------------------------------------------------
        //Dupliquer  
    	  $link = "admin_sondage.php?op=duplicate&idSondage=".$idSondage;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE, '', '', $bg);        
        //-----------------------------------------------------------------------
        //suppression          
    	  $link = "admin_sondage.php?op=remove&idSondage={$idSondage}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);
        //-----------------------------------------------------------------------
        //previsualisation 
    	  $link = "admin_sondage.php?op=previewSondage&idSondage={$idSondage}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_VIEW, _AD_HER_VIEWTEXT, '', '', $bg); 
       //-----------------------------------------------------------------------  
        //show sontage	 
        $link = "admin_sondage.php?op=showSondage&idSondage=".$idSondage;
        echo build_icoOption($link, _JJDICO_USER, _AD_HER_SONDAGE, '', '', $bg);         
      
      echo '</tr>';       
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='button' name='new' value='"._AD_HER_NEW."' onclick='".buildUrlJava("admin_sondage.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editSondage($p){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule,$adoSondage;

	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    $listYesNo = aList_noYes();    
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);        
 
    //------------------------------------------------    
    $idSondage=$p['idSondage'];
    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_sondage.php?op=save' METHOD=POST>";
    
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
    echo "<TD align='right' >".$p['idSondage']." <INPUT TYPE=\"hidden\" id='idSondage'  NAME='idSondage'  size='1%'"." VALUE='".$p['idSondage']."'></TD>";
    echo "</TR>";    



    //---Name
    echo buildInput(_AD_HER_NOM, '', 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '60%');    

    //---categorie
    echo buildInput(_AD_HER_CATEGORY, _AD_HER_CATEGORY_TEXT_DSC, 'txtCategorie', $myts->makeTboxData4Show($p['categorie'], "1", "1", "1"), '60%');    
   
    //---texte    
   	$desc1 = getXME($myts->makeTareaData4Show($p['description']), 'txtDescription', '','100%');
    echo "<TR>"._br;
    echo "<TD align='center' ><B>"._AD_HER_DESCRIPTION."</B</TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc1->render();
    echo "</TD>"._br;
    echo "</TR>"._br;
  
  
  /******************************************************************
   *pas de code de remplacement personalisé pour le moment
   *il sont déjà dans les texte dans lequel sera inclus le sondage      
  insertCodeDeRemplacement('txtDescription','lstCode');   
  ********************************************************************/
  echo $ligneDeSeparation; 
 
    
    
        //---disposition
        echo buildSpin(_AD_HER_DISPOSITION, _AD_HER_DISPOSITION_DSC, 'txtDisposition', $p['disposition'], 8, 0, 1, 10);
    
 //*********
    echo $ligneDeSeparation;   
        //groupes
        $groups = getListGroupesSondages($p['groupes']);
        $lib = 'name';
        $val = 'value';
        $id  = 'id';
    
        echo "<tr><td><b>"._AD_HER_GROUPES."</b></td><td>"._br;
        echo buildCheckedListH ($groups, '' , "chkGroupe", 0, 1, $lib, $val, $id);
        echo "</td></tr>"._br;
        echo buildDescription(_AD_HER_GROUPES_SONDAGE);
        //---------------------------------------------------------
        //-----mode de scrustin     
        echo buildList(_AD_HER_SCRUSTIN_MODE, _AD_HER_SCRUSTIN_MODE_DSC, 
                       'txtMode', aList_vote(), $p['mode']);
        
    echo $ligneDeSeparation;

        $ele = new  XoopsFormTextDateSelect('', 'txtDateDebut', 15, strtotime($p['dateDebut']  ));
        echo "<tr>";
        echo "<td><b>"._AD_HER_DATE_DEBUT."</b></td>"._br;      
        echo "<td style='align:left;'>".$ele->render()."</td>";
        echo '</tr>';
    
        $ele = new  XoopsFormTextDateSelect('', 'txtDateFin', 15, strtotime($p['dateFin']  ));
        echo "<tr>";
        echo "<td><b>"._AD_HER_DATE_FIN."</b></td>"._br;      
        echo "<td style='align:left;'>".$ele->render()."</td>";
        echo '</tr>';
        
     echo $ligneDeSeparation;  
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************
           
    //********************************************************************  
    echo buildTitleOption (_AD_HER_REPONSES,_AD_HER_REPONSES_DSC);    
    //********************************************************************
    

      $tDefault = array('idSondage' => $idSondage,
                        'idReponse' => 0,
                        'nom'       => '',
                        'ordre'     => 999);
     $t =  $adoSondage->getChildrenArray(_HER_TFN_REPONSE, $idSondage, 'ordre,nom', 
                               8, $tDefault);
    $numLine=0;    
    while (list($key, $item) = each($t)){

      $idReponse = $item['idReponse'];
            
      echo "<tr>";   
      echo "<td width='50px' align='right'>({$idReponse}) ->&nbsp;</td>";      

      
      //---Name
	    $name = $myts->makeTboxData4Show($item['nom']);      
      echo   "<TD align='left' width='100px'><INPUT TYPE='text' id='txtReponse_{$numLine}' size='150'"
            ."NAME='txtReponse_{$numLine}'  size='36' VALUE='{$name}'>";
      echo " <INPUT TYPE=\"hidden\" id='txtIdReponse_{$numLine}' NAME='txtIdReponse_{$numLine}' VALUE='{$idReponse}'>";            
      echo  "</TD>";    


      $lwSpin = 3;
      echo "<td>";      
      echo htmlSpin ("","txtOrdre_{$numLine}", ($numLine+1)*10, 999, 1, 1, $lwSpin , '', 1);      
      echo "</td>"; 
      


      echo "</tr>";      
      //-------------------------------------------------------------
      $numLine++;
    }
    
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_sondage.php",false)."'></td>
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
function previewSondage ($idSondage){
global $xoopsUser,$adoSondage;



/*
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
*/  

    $texte = $adoSondage->buildSondage($idSondage);
    //**********************************************************************
    echo $texte;
    //**********************************************************************
    $link = "<a href='javascript:window.close();'>Close</a>";
    
		echo "<FORM ACTION='admin_sondage.php?op=list' METHOD=POST>";
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
function showSondages ($idSondage){
	global $xoopsModuleConfig, $xoopsDB, $adoSondage;
	

   $t = $adoSondage->getResultats($idSondage); 
    //------------------------------------------------    
  $myts =& MyTextSanitizer::getInstance();    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_LIBELLES."</b><br>";    

    echo "<FORM ACTION='admin_sondage.php' METHOD=POST>";
    //showStatistiques($idLettre);    
    //her_displayArray($t, "----- showSondages -----");
    
    echo "<table {$tblStyle}>"; 
    
    while (list($key,$item) = each ($t)){
        $bgl = getRowStyle($row,'left',0, _HER_TR_BASE);
        $bgr = str_replace('left','right',$bgl); 
        $bgc = str_replace('left','center',$bgl);               
        $lv = "<TD {$bgc} align='center'>|</td>";     //ligne verticale   
  
        echo "<tr>";
        echo "{$lv}<td {$bgr}>{$item['idReponse']}</td>";
        echo "{$lv}<td {$bgl}>{$item['nom']}</td>";                
        echo "{$lv}<td {$bgr}>{$item['sommeDeReponse']}</td>{$lv}";
                
        echo "</tr>";        
    }
    
    echo "</table>";    
    
    
	CloseTable();    
    OpenTable();    
    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='right'>
    <input type='submit' name='fermer' value='"._AD_HER_CLOSE."' > 
    </td>   

        
  </tr></table>
  </form>";

	CloseTable();
	//xoops_cp_footer();

  
  
  
  
}

 

/************************************************************************
 *
 ************************************************************************/
//include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php'); 
include_once (_HER_ROOT_PATH.'class/cls_hermes_sondage.php');
$adoSondage = new cls_hermes_sondage();
   
  admin_xoops_cp_header(_HER_ONGLET_SONDAGE, $xoopsModule); 

  switch($op) {
  case "list":
		listSondage ();
		break;
		

  case "new":
		$adoSondage->saveRequest($_POST);
    $p = $adoSondage->getArray(0);
    editSondage ($p);
		break;

  case "edit":
		$p = $adoSondage->getArray($idSondage);
    editSondage ($p);
    //redirect_header("admin_sondage.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		$adoSondage->saveRequest($gepeto);		
    redirect_header("admin_sondage.php?op=list",1,_AD_HER_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idSondage})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idSondage'    => $_GET['idSondage'] ,
                        'ok'         => 1),
                        "admin_sondage.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
    $adoSondage->deleteId($_POST['idSondage']);    
    redirect_header("admin_sondage.php?op=list",1,_AD_HER_DELETEOK);    
		break;

  case "duplicate":
		$p = $adoSondage->newClone ($idSondage, true, 'nom');    
    editSondage ($p);    
  	break;


  case "previewSondage":
    previewSondage ($idSondage);
		break;


  case "showSondage":
    showSondages ($gepeto['idSondage']);
    //redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;

		
	default:
	 $state = _HER_STATE_WAIT;
    redirect_header("admin_sondage.php?op=list",1,_AD_HER_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
