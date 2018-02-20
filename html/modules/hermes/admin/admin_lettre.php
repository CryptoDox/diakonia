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
include_once ('admin_interface.php');

define ('_HER_COEF_LIST', 100);



//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idLettre',  'default' => 0),
              array('name' =>'id',        'default' => 0),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

/**************************************************************************
 *
 **************************************************************************/
function listLettre () {
global $xoopsModule, $xoopsDB,$xoopsConfig, $xoopsModuleConfig, $adoLettre;
 
  $tIcoLight = aList_icoLight();
                 
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
	  //xoops_cp_header();

    OpenTable();
        
	  //echo "<B>"._AD_HER_ADMINISTRATION." ".$xoopsConfig['sitename']."</B><p>";
  	//echo "<B>"._AD_HER_LETTER_MANAGEMENT."</B><P>";
		echo "<FORM ACTION='admin_index.php?' METHOD=POST>";
    

    //*************************************************************************   
    echo "<b>"._AD_HER_LETTERS."</b><br>";    
    
    //----------------------------------------------------------------
    $clauseOrderBy = 'typeLettre, prochaineParution ASC';
    $sqlquery = $adoLettre->getRows($clauseOrderBy);
    $nbArchives = countArchives();
    //displayArray($nbArchives,"----- countArchives -----");
    //----------------------------------------------------------------
    
    $tblStyle = getTblStyle();
    echo "<table {$tblStyle}>";  
    $level = 0;
    $oldTypeLettre = -1;
    $tl = array(_AD_HER_LETTRES_NORMAL,_AD_HER_LETTRES_CONFIRMATION);                  
    
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $bg = getRowStyle($row,'',0, _HER_TR_BASE);
      $colEmpty = "<TD {$bg} align='center'></td>";      
      //----------------------------------------------------------------------
  
          
      $nbJours = difDays (strtotime($sqlfetch['prochaineParution']));
      $urgence = getTranche($nbJours, $xoopsModuleConfig['degre_urgence']);
      $icoLight = choose($urgence, $tIcoLight, 0);
      $typeLettre = $sqlfetch['typeLettre'];
      
      //rupture sur le type de lettre
      if ($oldTypeLettre <> $typeLettre){
        $oldTypeLettre = $typeLettre;
        $caption = $tl[$typeLettre];
        //echo "<hr>{$oldTypeLettre}-{$typeLettre}-{$caption}<hr>";
        echo buildDescription($caption, $colSpan = 16, ($typeLettre > 0));
      }
      
      echo '<tr>';
      
      
      echo "<td {$bg} align='right'>({$sqlfetch['idLettre']})-</td>";      
      echo "<td {$bg} >{$sqlfetch['dateCourte']}</td>";
      echo "<td {$bg} >:</td>";      
      echo "<td {$bg} align='left'>{$sqlfetch['nom']}</td>";
      echo "<td {$bg} align='left'>{$sqlfetch['libelle']}</td>";            
        $idLettre = $sqlfetch['idLettre'];
        
        //---------------------------------------------------------------------        
        //degre d'urgence
        //---------------------------------------------------------------------   
        if ($typeLettre == 0){
          echo "<TD {$bg} align='right'>";        
      	  echo "{$nbJours} "._AD_HER_DAYS;
          echo "</td>"; 
          echo build_icoOption('', $icoLight, _AD_HER_DEGRE_URGENCE, '', '', $bg);        
        
        
          //statistique	 
          $link = "admin_lettre.php?op=stat&idLettre={$idLettre}&presentation=0";
          echo build_icoOption($link, _JJDICO_PROPERTY, _AD_HER_STAT, '', '', $bg);         
          
          //statistique	 
          $link = "admin_lettre.php?op=stat&idLettre={$idLettre}&presentation=1";          
          //$link = "admin_lettre.php?op=statgraph&idLettre=".$idLettre;
          echo build_icoOption($link, _JJDICO_URL.'graph.gif', _AD_HER_STAT, '', '', $bg);         
        
        }else echo $colEmpty.$colEmpty.$colEmpty.$colEmpty;
        
        
        //-----------------------------------------------------------------------        
        //boutons d'action
        //----------------------------------------------------------------------- 
          
        //Editer	   
        $link = "admin_lettre.php?op=edit&idLettre=".$idLettre;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_HER_EDIT, '', '', $bg);         
        //-----------------------------------------------------------------------
        //Structure de la lettre
    	  $link = "admin_lettre.php?op=structure&idLettre=".$idLettre;
        echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_STRUCTURE, '', '', $bg);        
        //-----------------------------------------------------------------------
        /*

        //syndication
    	  $link = "admin_lettre.php?op=syndication&idLettre=".$idLettre;
        echo build_icoOption($link, _JJDICO_SYNDICATION, _AD_HER_SYNDICATION, '', '', $bg);        
        */        
        //-----------------------------------------------------------------------
        //Dupliquer la lettre
    	  $link = "admin_lettre.php?op=duplicate&idLettre=".$idLettre;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_HER_DUPLICATE, '', '', $bg);        
        
        //-----------------------------------------------------------------------
        if ($typeLettre == 0){        
          //Vidage des archives
          if (isset($nbArchives["k-{$idLettre}"])){
            $nba = $nbArchives["k-{$idLettre}"];
          }else{
            $nba = 0;
          }
        

      	  $link = "admin_lettre.php?op=empty&idLettre={$idLettre}&name={$sqlquery['nom']}";
          echo build_icoOption($link, _JJDICO_EMPTY, _AD_HER_DELETE_ARCHIVES, '',"({$nba})", $bg);
        
        }else echo $colEmpty;
        //-----------------------------------------------------------------------
        //suppression de la lettre
    	  $link = "admin_lettre.php?op=remove&idLettre={$idLettre}&name={$sqlquery['nom']}";
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_HER_DELETE, '', '', $bg);       
       //-----------------------------------------------------------------------  
        //preparation avant envoi
        $link = "admin_lettre.php?op=editBeforeSend&idLettre=".$idLettre;          
        echo build_icoOption($link, _JJDICO_PREPAR, _AD_HER_PREPAR_LETTER, '', '', $bg);        
        //-----------------------------------------------------------------------
        //previsualisation de la lettre
    	  $link = "admin_lettre.php?op=previewLetter&idLettre={$idLettre}&name={$sqlquery['nom']}";
        echo build_icoOption($link, _JJDICO_VIEW, _AD_HER_VIEWLETTER, '', '', $bg); 
       
       //-----------------------------------------------------------------------  
        /*

        //send 	to liste test
        $link = "admin_lettre.php?op=editBeforeSend&mode=1&idLettre=".$idLettre;          
        echo build_icoOption($link, _JJDICO_PROPERTY, _AD_HER_SENDLETTER_TEST, '', '', $bg);      	  
        */       
       //-----------------------------------------------------------------------  
        //send 	 (previqualise les elements a modifier avant envoi)
        if ($sqlfetch['prochaineParution'] <= dateAdd(time(),0,0,7) & ($typeLettre == 0)){
          $link = "admin_lettre.php?op=editBeforeSend&mode=1&idLettre=".$idLettre;          
          echo build_icoOption($link, _JJDICO_SEND, _AD_HER_SENDLETTER, '', '', $bg);      	  
        }else{
           $link = "admin_lettre.php?op=editBeforeSend&mode=1&idLettre=".$idLettre;          
          echo build_icoOption($link, _JJDICO_PROPERTY, _AD_HER_SENDLETTER_TEST, '', '', $bg);      	  
       
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
    <input type='button' name='newConfirmation' value='"._AD_HER_NEW_CONFIRMATION."' onclick='".buildUrlJava("admin_lettre.php?op=newConfirmation",false)."'></td>    

    <td align='right'>
    <input type='button' name='new' value='"._AD_HER_NEW_NORMAL."' onclick='".buildUrlJava("admin_lettre.php?op=new",false)."'></td>    
  
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}


/*****************************************************************
 *
 *****************************************************************/
function editLettre($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);  
    
    $listYesNo = aList_noYes();    
    $listPeriodicite = aList_periodicite();
    $listPositionH = aList_positionH();
    $listPositionV = aList_positionV();
    $listRepeat = aList_imgRepeat();
    $listMode = aList_imgMode();
 
    //------------------------------------------------    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
      
  //echo versionJS();
  $idLettre = $p['idLettre'];

	  //xoops_cp_header();
    OpenTable();  
    
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_LETTRE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_lettre.php?op=save' METHOD=POST>\n";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>\n";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >".$p['idLettre'];
    echo "<INPUT TYPE=\"hidden\" id='idLettre'  NAME='idLettre'  size='1%' VALUE='{$p['idLettre']}'>";
    echo "<INPUT TYPE=\"hidden\" id='typeLettre'  NAME='typeLettre'  size='1%' VALUE='{$p['typeLettre']}'>";    
    echo "</TD>\n";
    echo "</TR>\n";    



    //---Name
    echo buildInput(_AD_HER_NOM,_AD_HER_SHORTNAME_DSC , 'txtName', $myts->makeTboxData4Show($p['nom'], "1", "1", "1"), '40%');    

    //---libellé
    echo buildInput(_AD_HER_LIBELLE, '', 'txtLibelle', $myts->makeTboxData4Show($p['libelle'], "1", "1", "1"), '80%');    


    //---Description
    //echo buildInput(_AD_HER_DESCRIPTION, '', 'txtDescription', $myts->makeTboxData4Show($p['description'], "1", "1", "1"), '60%');    

   	$desc1 = getXME($myts->makeTareaData4Show($p['description']), 'txtTexte', '','100%');
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_DESCRIPTION."</B></TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc1->render();
    echo "</TD>"._br;
    echo "</TR>"._br;

    insertCodeDeRemplacement('txtTexte','lstCode');   

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
     
        echo buildSelecteur(_AD_HER_FRAME,_AD_HER_FRAME_DSC , $selected );



//-------------------------------------------------------------------
    
    echo $ligneDeSeparation; 

    //---avertissement
    echo buildDescription("<font color='#FF0000'>"._AD_HER_AVERTISSEMENT_DSC.'</font>');    
   	$desc2 = getXME($myts->makeTareaData4Show($p['avertissement']), 'txtAvertissement', '','100%');
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_AVERTISSEMENT."</B></TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc2->render();
    echo "</TD>"._br;
    echo "</TR>"._br;

    insertCodeDeRemplacement('txtAvertissement','lstCodeAvertissement');   

    echo $ligneDeSeparation; 
//****************************************************************
        //--element a afficher 
    
        $lib = 'lib';
        $val = 'val';
        $id  = 'id';
        $h=0;
        $b = $p['affichage'];
    
        $t = array(array($lib => _AD_HER_NAME,              $val => isBitOk($h, $b), $id => $h++),    
                   array($lib => _AD_HER_LIBELLE,           $val => isBitOk($h, $b), $id => $h++),               
                   array($lib => _AD_HER_DESCRIPTION,       $val => isBitOk($h, $b), $id => $h++),  
                   array($lib => _AD_HER_AVERTISSEMENT,     $val => isBitOk($h, $b), $id => $h++));    
        echo "<tr><td><b>"._AD_HER_AFFICHAGE."</b><td>"._br;
        echo buildCheckedListH ($t, '' , "txtAffichage", 0, 1, $lib, $val, $id);
        echo "</td></tr>"._br;
        echo buildDescription(_AD_HER_AFFICHAGE_DSC);
//****************************************************************        

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************

    //---Feuille de style   
    $f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')."themes/";
    echo buildListFromFolder(_AD_HER_STYLE_SHEET, 
                             _AD_HER_STYLE_SHEET_DSC, 
                             $p['feuilleDeStyle'],                             
                             'txtFeuilleDeStyle',
                             $f, 
                             'style.css', 
                             1,                             
                             $AddBlanck = true );
    
    

    //---Template   
    //$f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')."themes/";
    //echo "<hr>"._HER_ROOT_LETTER_TPL."<hr>";    

    $extention = "htm;html;tpl";
    //----------------------------------------------  
    //echo "<hr>"._HER_ROOT_LETTER_TPL."<hr>";  
    $list = getListFiles(_HER_ROOT_LETTER_TPL.'body_', $extention, $p['tplBody'],"txtTplBody");
      
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_TEMPLATE_TMP."</B></TD>"._br;    
    echo "<TD align='left' >{$list}</TD>"._br;      
    echo buildDescription(_AD_HER_TEMPLATE_TMP_DSC);    
    echo "</TR>"._br;
    //----------------------------------------------
    $list = getListFiles(_HER_ROOT_LETTER_TPL.'header_', $extention, $p['tplHeader'],"txtTplHeader");
      
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_TEMPLATE_HEADER."</B></TD>"._br;    
    echo "<TD align='left' >{$list}</TD>"._br;      
    echo buildDescription(_AD_HER_TEMPLATE_HEADER_DSC);    
    echo "</TR>"._br;
    //----------------------------------------------
    $list = getListFiles(_HER_ROOT_LETTER_TPL.'footer_', $extention, $p['tplFooter'],"txtTplFooter");
      
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_TEMPLATE_FOOTER."</B></TD>"._br;    
    echo "<TD align='left' >{$list}</TD>"._br;      
    echo buildDescription(_AD_HER_TEMPLATE_FOOTER_DSC);    
    echo "</TR>"._br;
    //----------------------------------------------





    //largeur max de la lettre
    echo buildInput(_AD_HER_PAGEWIDTH,_AD_HER_PAGEWIDTH_DSC , 'txtPageWidth', $myts->makeTboxData4Show($p['pageWidth'], "1", "1", "1"), '10%');    
    
    //---backGround   
    echo buildColorSelecteur(_AD_HER_BACKGROUND, '', 'txtBackground', $p['background']);

    //---Image de fond   
    $folder = _HER_ROOT_PATH."ressources/";
    $extention = "jpg;gif;png";
    $list = getListFiles($folder, $extention, $p['bgImg'],"txtbgImg");
    //$hList = buildList(_AD_HER_BGIMG, _AD_HER_BGIMG_DSC, 'txtbgImg', $tFiles, $p['bgImg']);
      
    echo "<TR>"._br;
    echo "<TD align='left' ><B>"._AD_HER_BGIMG."</B></TD>"._br;    
    echo "<TD align='left' >{$list}</TD>"._br;      
    echo buildDescription(_AD_HER_BGIMG_DSC);    
    echo "</TR>"._br;


//------------------------------------------------------------------------
 //*********
    //--mode d'affichage de l'image 
    //---Fise/scrol
    echo buildList(_AD_HER_IMGMODE, _AD_HER_IMGMODE_DSC, 'txtbgImgMode', $listMode, $p['bgImgMode']);

    //---mode de repetition
    echo buildList(_AD_HER_IMGREPEAT, _AD_HER_IMGREPEAT_DSC, 'txtbgImgRepeat', $listRepeat, $p['bgImgRepeat']);

    //---Position H
    echo buildList(_AD_HER_IMGPOSH, _AD_HER_IMGPOSH_DSC, 'txtbgImgPosH', $listPositionH, $p['bgImgPosH']);

    //---Position V
    echo buildList(_AD_HER_IMGPOSV, _AD_HER_IMGPOSV_DSC, 'txtbgImgPosV', $listPositionV, $p['bgImgPosV']);

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************
    if ($p['typeLettre'] == 0){
        //---emailSender
        echo buildInput(_AD_HER_EMAIL_SENDER,_AD_HER_EMAIL_SENDER_DSC , 'txtEmailSender', $myts->makeTboxData4Show($p['emailSender'], "1", "1", "1"), '40%');    
        
        //---lettre de confirmation
        $defaut = $p['idLettreConfirmation'];
        $selected = buildHtmlListFromTable ('txtIdLettreConfirmation', 
                                     _HER_TAB_LETTRE,
                                     'nom', 
                                     'idLettre', 
                                     'nom', 
                                     $defaut,
                                     '',
                                     'typeLettre = 1');
       
        echo buildSelecteur(_AD_HER_CONFIRMATION,_AD_HER_CONFIRMATION_DSC , $selected );
        //-----------------------------------------------------------------
    
        //---Periodicite
        echo buildList(_AD_HER_PERIODICITE, _AD_HER_PERIODE_DSC, 'txtPeriodicite', $listPeriodicite, $p['periodicite']);
    
    
    
        //---Jour
        echo buildSpin(_AD_HER_QUANTIEME, _AD_HER_QUANTIEME_DSC, 'txtJour', $p['jour'], 365, 1, 1, 10);
    
    
        //groupes
        $groups = getListGroupesLettre($idLettre);
        
    //displayArray2($groups,"----------------------------");
    
    
        //---actif
        $lib = 'name';
        $val = 'value';
        $id  = 'id';
    
        echo "<tr><td><b>"._AD_HER_GROUPE_DESTINATAIRE."</b></td><td>"._br;
        echo buildCheckedListH ($groups, '' , "chkGroupe", 0, 1, $lib, $val, $id);
        echo "</td></tr>"._br;
        echo buildDescription(_AD_HER_GROUPE_DESTINATAIRE);
        
        
//****************************************************************
        //--liste d'email complementaire    
       $lstListEmail = buildHtmlListFromTable ("txtIdListe", _HER_TAB_BONUS, 
                                 'nom', 'idListe', 'nom', $p['idListe'],
                                 '','',150,'',true);
                                 
        echo "<TR>"._br;
        echo "<TD align='left' ><B>"._AD_HER_LISTEMAIL."<B></TD>"._br;    
        echo "<TD align='left' >{$lstListEmail}</TD>"._br;    
        echo "</TR>"._br;    
        //echo buildDescription(_AD_HER_TAGINFO_DSC);    
    
       //--liste d'email de test    
       $lstListEmail = buildHtmlListFromTable ("txtIdListeTest", _HER_TAB_BONUS, 
                                 'nom', 'idListe', 'nom', $p['idListeTest'],
                                 '','',150,'',true);
                                 
        echo "<TR>"._br;
        echo "<TD align='left' ><B>"._AD_HER_LISTEMAIL_TEST."<B></TD>"._br;    
        echo "<TD align='left' >{$lstListEmail}</TD>"._br;    
        echo "</TR>";    
        
        echo buildHR(1, _HER_HR_COLOR1, 2);
        //echo buildDescription(_AD_HER_TAGINFO_DSC);    
        
//**************************************************************** 
//--  statistiques  
//-----------------------------------------------------------------     
    if ($p['typeLettre'] == 0){  
        //echo buildHR(1, _HER_HR_COLOR1, 2);    
    //****************************************************************  
        //---afficher les images qui seront aux stats de lecture
        $list = array(_AD_HER_PSTAT_SHOWIMG0,_AD_HER_PSTAT_SHOWIMG1,_AD_HER_PSTAT_SHOWIMG2);
        echo buildList(_AD_HER_STAT_SHOWIMG, _AD_HER_STAT_SHOWIMF_DSC, 'txtStatLecture', $list, $p['statLecture']);
    
        //---image 0   
        //$f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')."images/";
        $f = _HER_ROOT_PATH."images/";
        //if ($item['params'] <> '') $f .= $item['params'] .'/';
        echo buildListFromFolder(_AD_HER_STAT_IMG0, 
                                 _AD_HER_STAT_IMG0_DSC, 
                                 $p['statImg0'],                             
                                 'txtStatImg0',
                                 $f, 
                                 '.gif', 
                                 0,
                                 $AddBlanck = true);
      
        //---image 1   
        echo buildListFromFolder(_AD_HER_STAT_IMG1, 
                                 _AD_HER_STAT_IMG1_DSC, 
                                 $p['statImg1'],                             
                                 'txtStatImg1',
                                 $f, 
                                 '.gif', 
                                 0,
                                 $AddBlanck = true);
        //---Position H
        echo buildList(_AD_HER_IMGPOSH, '', 'txtStatImgAlign', $listPositionH, $p['statImgAlign']);
    
        
        }      
        
        
        //********************************************************************  
        echo "</table>";      
        CloseTable();
        OpenTable();    
        echo "<table width='80%'>\n";    
        //********************************************************************
        //---dernier n° d'archive
        echo buildInput(_AD_HER_LAST_ARCHIVE,_AD_HER_LAST_ARCHIVE_DSC , 
                        'txtChronoArchive', $p['chronoArchive'], '100%');        
        
                  
        //---archiver
        echo buildList(_AD_HER_PERSONNALISABLE, _AD_HER_PERSONNALISABLE_DSC, 'txtPersonnalisable', $listYesNo, $p['personnalisable']);
    
          
        //--------------------------------------------
        //date de parution et de prochaine parution 
        echo "<tr>";
        echo "<td><b>"._AD_HER_LASTPARUTION."</b></td>"._br;      
        echo "<td style='align:left;'>".$p['dateParution']."</td>";
        echo '</tr>';
        
        
        $ele = new  XoopsFormTextDateSelect('', 'txtProchaineParution', 15, strtotime($p['prochaineParution']  ));
        echo "<tr>";
        echo "<td><b>"._AD_HER_NEXTPARUTION_AT."</b></td>"._br;      
        echo "<td style='align:left;'>".$ele->render()."</td>";
        echo '</tr>';
    
        
    
        //---archiver
        //echo buildList(_AD_HER_RECORD, _AD_HER_RECORD_DSC, 'txtArchiver', $listYesNo, $p['archiver']);
        
        if ($p['typeLettre'] == 0){
           //---délai d'archivage
          echo buildSpin(_AD_HER_RECORD_LIMIT, _AD_HER_RECORD_LIMIT_DSC, 
                         'txtDelaiArchivage', $p['delaiArchivage'], 
                         60, 0, 12, 12,'',_AD_HER_MONTHS);
                         
          //---chemin d'Archivage
          echo buildInput(_AD_HER_RECORD_PATH, _AD_HER_RECORD_PATH_DSC, 'txtCheminArchivage', $myts->makeTboxData4Show($p['cheminArchivage'], "1", "1", "1"), '100%');    
        
        }

        //send to JÝJÝD    
         echo buildList(_AD_HER_SEND2AUTHOR, _AD_HER_SEND2AUTHOR_DSC, 
                        'txtSend2Author', $listYesNo, $p['send2Author']);
   
    
    
        //********************************************************************  
        echo "</table>";      
        CloseTable();
        OpenTable();    
        echo "<table width='80%'>\n";    
        //********************************************************************
    
    }   //fin typeLettre = 0
    
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
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}

/*****************************************************************
 *
 *****************************************************************/
function editSyndication($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);    
 
    //------------------------------------------------    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
      
  //echo versionJS();
  $idLettre = $p['idLettre'];

	  //xoops_cp_header();
    OpenTable();  
    $tUrl = db_getSyndication($p['idLettre']);
    //displayArray($tUrl,"--- db_getSyndication ---");
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_LETTRE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_lettre.php?op=saveSyndication' METHOD=POST>\n";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>\n";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >".$p['idLettre']." <INPUT TYPE=\"hidden\" id='idLettre'  NAME='idLettre'  size='1%'"." VALUE='".$p['idLettre']."'></TD>\n";
    echo "</TR>\n";    


    echo "<tr>";
    //---Name
    echo "<td>{$p['nom']}</td>";   
    //---libellé     
    echo "<td>{$p['libelle']}</td>";
    echo "</tr>";

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************
    for ($h = 0; $h < count($tUrl); $h++){
      $idUrl = $tUrl[$h]['idUrl'];
      echo "<tr>";   
      $ok = ($tUrl[$h]['ok'] == 1) ? 'checked':'' ;
      $chk = "<input type='checkbox' name='chkUrl_{$h}' value='1' {$ok}>";
      
      echo " <INPUT TYPE=\"hidden\" id='idLettre'  NAME='txtIdUrl_{$h}'  size='1%'"." VALUE='{$idUrl}'></TD>\n";      
      echo "<td>{$idUrl}</td>";      
      echo "<td>{$chk}</td>";         
      echo "<td>{$tUrl[$h]['description']}</td>"; 
      echo "<td>{$tUrl[$h]['url']}</td>";           
      echo "</tr>";      
    }

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
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
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}

/****************************************************************************
 *
 ****************************************************************************/
function getListFiles($folder, $extention = '', $defaut = '', $name=''){

  //$onChange = "changeImgFromList(\"imgIcone\", \"lstIcones\", \""._LEX_URL_LEXICONES."\");";
  //$onChange = "changeImgFromList(\"imgIcone\", \"lstIcones\", \""._LEX_URL_LEXICONES."\", \"\");";
   $onChange = '';
  return  htmlFilesList ($defaut, $folder, $extention, $onChange, $name, true, false);

}

/*****************************************************************
 *
 *****************************************************************/
function editBeforeSend($p, $mode = 0){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    $listYesNo = array(_AD_HER_NO,_AD_HER_YES);    
        

    //------------------------------------------------    
  //echo _JJD_JSI_TOOLS;
  //echo _JJD_JSI_SPIN;  
  
  //echo versionJS();
  $idLettre = $p['idLettre'];
  $texte2Edit =  db_getTexte2Edit($idLettre);

  $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);  
  
  
	  //xoops_cp_header();
    OpenTable();  
   //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  echo _HER_JSI_TOOLS;  
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	echo "<B>"._AD_HER_BEFORESEND_MANAGEMENT."</B></div>";
    
    ///$link = "admin_lettre.php?op=sendAllLetters&idLettre=".$idLettre;
    $link = "admin_lettre.php?op=saveBeforeSend&idLettre=".$idLettre;    
 		echo "<FORM ACTION='{$link}' METHOD=POST>\n";
    
    //********************************************************************
    CloseTable();
    OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>\n";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >".$p['idLettre']." <INPUT TYPE=\"hidden\" id='idLettre'  NAME='idLettre'  size='1%'"." VALUE='".$p['idLettre']."'></TD>\n";
    echo "</TR>\n";    

    //---Name
    echo buildLibInfo(_AD_HER_NOM, '', $p['nom']);
    
    //---libellé
    echo buildLibInfo(_AD_HER_LIBELLE, '', $p['libelle']);

    //---description
    echo buildLibInfo(_AD_HER_DESCRIPTION, '', $p['description']);
    //********************************************************************
    $listElements = buildListElement();
    //buildList($title, $description, $name, $list, $default, $fin = '') 
    $name = "xxxxx";
    //$list = buildList('', '', $name, $listElements, 000);   
    $listElements =  getlistSearch ($name, $listElements, 0, 000);
    //$listCadres = getlistSearch ($name, $aListCadre, 0, 000);
    
    //echo '<tr><td><hr></td></tr>';
    

    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************
    $h = 0;
    while ($sqlfetch = $xoopsDB->fetchArray($texte2Edit)) {
        $idTexte = $sqlfetch['idTexte'];        
        $editName = "txtTexte_{$idTexte}";
        $lstCodeName = "lstCode_{$idTexte}";
        
        
        $tt = getXME($myts->makeTareaData4Show($sqlfetch['texte']), $editName, '','100%');        

        if ($h > 0) echo $ligneDeSeparation;
        $h++;    
        
        
        echo "<INPUT TYPE=\"hidden\" id='idTexte_{$idTexte}'  NAME='idTexte_{$idTexte}'  size='1%'  VALUE='{$idTexte}'>";        
        echo "<TR>"._br;
    
        echo "<TD align='center' ><B>{$sqlfetch['nom']}</B</TD>"._br;    
        echo "<TD align='left'  >".$tt->render()."</TD>"._br;
        
        echo "</TR>"._br;
        //-------------code de remplacement
        insertCodeDeRemplacement($editName,$lstCodeName);        
        /*

        
        $listCode = buildHtmlList ($lstCodeName, getCodeList(), 0,  0, $nbRows = 1, '', '');    
        $oc = "insertTextIntoWysiwyg(\"{$lstCodeName}\", \"{$editName}\",{$xoopsModuleConfig['editor']},\"[]\",event);";
        $btn =  "<input type='button' name='insertCode_{$idTexte}' value='"._AD_HER_INSERT_TAG."' onclick='{$oc}'>";
    
    
        echo "<TR>"._br;
        echo "<TD align='left' ><B>"._AD_HER_TAGINFO."<B></TD>"._br;    
        echo "<TD align='left' >{$listCode} ->  {$btn}</TD>"._br;    
        echo "</TR>"._br;    
        
        echo buildDescription(_AD_HER_TAGINFO_DSC);    
        */        
    }  
    
    
    //liste d email complementaire
    $lstListEmail = buildHtmlListFromTable ("txtListeMail", _HER_TAB_BONUS, 
                                 'nom', 'idListe', 'nom', $p['idListe'],
                                 '','',150,'',true);
                                 
        echo "<TR>"._br;
        echo "<TD align='left' ><B>"._AD_HER_LISTEMAIL."<B></TD>"._br;    
        echo "<TD align='left' >{$lstListEmail}</TD>"._br;    
        echo "</TR>"._br;    
        //echo buildDescription(_AD_HER_TAGINFO_DSC);    
        
    //liste d email de test
    $lstListEmail = buildHtmlListFromTable ("txtIdListeTest", _HER_TAB_BONUS, 
                                 'nom', 'idListe', 'nom', $p['idListeTest'],
                                 '','',150,'',true);
                                 
        echo "<TR>"._br;
        echo "<TD align='left' ><B>"._AD_HER_LISTEMAIL_TEST."<B></TD>"._br;    
        echo "<TD align='left' >{$lstListEmail}</TD>"._br;    
        echo "</TR>"._br;    
        //echo buildDescription(_AD_HER_TAGINFO_DSC);    
        
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************

    //-----------------------------------------------    
    //piseces à joindre à l'envoi
    //-----------------------------------------------
    $listPieces = getPieces($idLettre);    
    echo "<B>"._AD_HER_PEACES_MANAGEMENT." : </B></div>";    
    
    if (count($listPieces) > 0){
        
        
        $listMode  = array(array('lib' => _AD_HER_NO,   'id' => 0),
                             array('lib' => _AD_HER_LINK, 'id' => 1));
                            // array('lib' => _AD_HER_JOIN, 'id' => 2));                   
      
      
         
          
   
          //$f = _HER_ROOT_PATH."pieces/";
          //echo "<hr>dossier des pieces : {$f}<hr>";
          //$tf = getFileListH($f);
      
          
          
          echo "<table>";
          for ($h = 0; $h < count($listPieces); $h++){
            $tf = $listPieces[$h];
            //$list =  getlistSearch ("txtPiece_{$numLine}", $listMode, 0, $rst['state']);    
            $list =  getlistSearch ("txtPiece_{$h}", $listMode, 0, $tf['ok']);   
            
            $hid = "<INPUT TYPE=\"hidden\" id='txtFullName_{$h}'  NAME='txtFullName_{$h}'  size='1%'  VALUE='{$tf['fullName']}'>"; 
            echo "<tr>";
            echo "<td align='left'>".basename($tf['name'])."{$hid}</td>";      
            echo "<td align='left'>{$list}</td>";    
            
            
            
            //---Name
      	    $name = $myts->makeTboxData4Show($tf['libelle']);      
            echo   "<TD align='left' width='20'>"
                  ."<INPUT TYPE='text' id='txtStrName_{$numLine}' "
                  ."NAME='txtLibPiece_{$h}'  size='80' VALUE='{$name}'></TD>";    
            
            
            //echo "<td>{$tf['fullName']}</td>";        
            echo "<td>   </td>";
            echo "</tr>";      
          }
    
    }else{
        echo "<B>"._AD_HER_PEACES_MANAGEMENT_NOTHING."</B></div>";    
    }
  





    //********************************************************************  
    echo "</table>";      
    CloseTable();

    OpenTable();
    echo _AD_HER_SENDLETTERBYLOT_DEC;        
    echo "<table width='80%'>\n";    
    //********************************************************************
    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
         <tr valign='top'>";
    echo "   <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_lettre.php",false)."'></td>
             <td align='left' width='200'></td>";

     echo "     <td align='right'>
                <input type='submit' name='saveEditBeforeSend' value='"._AD_HER_SAVE."' )'>    
                </td>    ";
    
    //if (!isset($p['mode'])){$p['mode'] = 0;}
    //if ($p['mode'] == 1){
    echo "    <td align='right'>";  
    echo "          <input type='submit' name='sendTest'  value='"._AD_HER_SEND_TEST."' )'>";
    echo "    </td>";      
    
    
    if ($mode == 1){    
 //echo "<hr>methode = {$xoopsModuleConfig['sendMethod']}<hr>"; 
      if ($xoopsModuleConfig['sendMethod'] == 0 | $xoopsModuleConfig['sendMethod'] == 1){
      
      
      
        echo "    <td align='right'>";  
        echo "          <input type='submit' name='sendAllLetters'  value='"._AD_HER_SENDLLETERDIRECTLY."' )'>";
        echo "    </td>";      
          
      }
/* 

     
      if ($xoopsModuleConfig['sendMethod'] == 0 | $xoopsModuleConfig['sendMethod'] == 2){
        echo "    <td>";      
        echo "          <input type='submit' name='sendAllInOneTime' value='"._AD_HER_SENDLETTERLIKELOT."' )'>";                    
        echo "    </td>";    
      }
*/
      
      
      
      if ($xoopsModuleConfig['sendMethod'] == 0 | $xoopsModuleConfig['sendMethod'] == 2){
        echo "    <td>";      
        echo "          <input type='submit' name='sendLetterByLot' value='"._AD_HER_SENDLETTERBYLOT."' )'>";                    
        echo "    </td>";    
      }
    }
  
      echo "    </tr>
            </table>
            </form>";
    

//
/*

 $link = _HER_URL."admin/admin_send.php";    
  echo "<form name='progressbar'>";
  echo "<div align=center>";
  echo "<table border bordercolor='lightblue' width='210px' height='15px'>";
  echo "<tr>";
  echo "<td colspan='2' bgcolor='lightblue'><img src='bar.gif' id='picBrogress' name='pic1' width='0' height='15'>";
  echo "</td></tr>";
  //echo "<tr><td id='txtProgress'>OOO</td></rr></table>";
  echo "<tr><td colspan='2' align='center'>";
  echo "<input type='button' id= 'txtProgress' name='btn1' value='Start' style=\"width: 360px;\" >";  
  echo "</td></tr>";
  
  

  echo "</form";
  echo "<tr><td align='center'>";  
  echo "<input type='button' id= 'btnStop'     name='btn0' value='Stop' onClick='stopProgressBar();'></center>";
  echo "</td><td align='center'>";  
  echo "<input type='button' id= 'btnBrogress' name='btn1' value='Start' onClick='startProgressBar(\"{$link}\");'></center>";  
  echo "</td></tr>";  
  echo "</table><div></form>";
*/  
//*****************************************************************
        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    







}
/*****************************************************************
 *
 *****************************************************************/
function sendLetterByLot($p, $mode = 0){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
    $listYesNo = array(_AD_HER_NO,_AD_HER_YES);    
        

    //------------------------------------------------    
  
  //echo versionJS();
  $idLettre = $p['idLettre'];
  $texte2Edit =  db_getTexte2Edit($idLettre);

  
	  //xoops_cp_header();
    OpenTable();  
   //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  echo _HER_JSI_TOOLS;  
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	echo "<B>"._AD_HER_SENLETTERBYLOT."</B></div>";
    
    ///$link = "admin_lettre.php?op=sendAllLetters&idLettre=".$idLettre;
    $link = "admin_lettre.php?op=list&idLettre=".$idLettre;    
 		echo "<FORM ACTION='{$link}' METHOD=POST>\n";
    
    //********************************************************************
    CloseTable();
    OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>\n";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >".$p['idLettre']." <INPUT TYPE=\"hidden\" id='idLettre'  NAME='idLettre'  size='1%'"." VALUE='".$p['idLettre']."'></TD>\n";
    echo "</TR>\n";    

    //---Name
    echo buildLibInfo(_AD_HER_NOM, '', $p['nom']);
    
    //---libellé
    echo buildLibInfo(_AD_HER_LIBELLE, '', $p['libelle']);

    //---description
    echo buildLibInfo(_AD_HER_DESCRIPTION, '', $p['description']);
    //********************************************************************
    $listElements = buildListElement();
    //buildList($title, $description, $name, $list, $default, $fin = '') 
    $name = "xxxxx";
    //$list = buildList('', '', $name, $listElements, 000);   
    $listElements =  getlistSearch ($name, $listElements, 0, 000);
    //$listCadres = getlistSearch ($name, $aListCadre, 0, 000);
    
    //echo '<tr><td><hr></td></tr>';
    

    //********************************************************************  
    /*

    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";  
    */      
    //********************************************************************


    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************

 
    //********************************************************************

 
    

//*****************************************************************    
  $link = _HER_URL."admin/admin_send.php";    
 $lw = "480px";
 $lh = "15px";
 
  echo "<div id='tdBrogress' align=center style=\"left: 0; top: 0; width: {$lw}; height: {$lh}; z-index: 0; position: absolue\">";
  echo "<table border bordercolor='lightblue'  >";
  echo "<tr>";
  echo "<td   bgcolor='lightblue' align='center' >";
  echo "<img src='bar0.gif' id='picBrogress0' name='pic0' width='0' height='{$lh}'>";
  echo "<img src='bar1.gif' id='picBrogress1' name='pic1' width='{$lw}' height='{$lh}'>";  
  echo "</td></tr>";
  //echo "<tr><td id='txtProgress'>OOO</td></rr></table>";
  echo "<tr><td  bgcolor='lightblue' align='center' >";
  echo "<input type='button' id= 'txtProgress' name='btn1' value='HERMES' style=\"width: {$lw};\" >";  
  echo "</td></tr></table><div>";
  
  //-------------------------------------------------------------------

  echo "<form name='progressbar'>";  
  echo "<table>";
  echo "<tr><td align='center'>";  
  echo "<input type='submit' id= 'btnRetour'     name='retour' value='Retour'>";
  echo "</td>";  

  echo "<td align='center'>";  
  echo "<input type='button' id= 'btnStop'     name='btn0' value='Stop' onClick='stopProgressBar(\"STOP\");'></center>";
  echo "</td>";  

  echo "<td align='center'>";
  echo "<input type='button' id= 'btnBrogress' name='btn1' value='Start' onClick='startProgressBar(\"{$link}\",{$xoopsModuleConfig['timer1']},{$xoopsModuleConfig['timer2']});'></center>";  
  echo "</td></tr>";  
  
  echo "</table></form>";
  
//*****************************************************************
    	CloseTable();        

//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    







}

/*****************************************************************
 *
 *****************************************************************/
function editStructure($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
      
  //displayArray($p, "**********************************");
  //echo versionJS();
  $idLettre = $p['idLettre'];
  //echo "<hr>editStructure<hr>";
  $structure = db_getStructure($idLettre); 
  $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 2);
  $listPosition = array(_AD_HER_NONE,
                        _AD_HER_BEFORE,
                        _AD_HER_AFTER,
                        _AD_HER_BEFORE_AFTER);
                        
    $listMiseEnForme = array(_AD_HER_AUTOMATIC, _AD_HER_PLUGIN);    
	  
    //xoops_cp_header();
    OpenTable();  
    
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_LETTRE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_lettre.php?op=saveAllStructures' METHOD=POST>\n";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>\n";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >({$idLettre}) <INPUT TYPE=\"hidden\" id='idLettre'  NAME='idLettre'  size='1%'"." VALUE='{$idLettre}'></TD>";
    echo "</TR>\n";    

    //---Name
    echo buildLibInfo(_AD_HER_NOM, '', $p['nom']);

    //---description
    echo buildLibInfo(_AD_HER_DESCRIPTION, '', $p['description']);
    //********************************************************************
    $name = "xxxxx";    
    
    $listElements = buildListElement();
    $obListElements =  getlistSearch ($name, $listElements, 0, 000);
    $obListPositions =  getlistSearch ($name, $listPosition, 0, 000);   
    $obListMiseEnForme =  getlistSearch ($name, $listMiseEnForme, 0, 000);    
    

    //$obListColor = buildColorSelecteur('', '', $name, '');
 
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************
    
      
    echo "<table ".getTblStyle().">";  
    $numLine = 0;
    
    //-------------------------------------  
    $lastOrdre = 0;              
    if ($p['tplBody'] <> ''){
      $tBalise = getAllBaliseFromTemplates(array($p['tplBody'],
                                                 $p['tplHeader'],
                                                 $p['tplFooter']));
      //$showBlock = true;    
    }else{
      $tBalise = false;    
      //$tBalise = array();
      //$showBlock = false;    
    }
    //her_displayArray($tBalise);
    //-------------------------------------
    echo "<tr align='center'>";    
    echo "<td align='center'>#</td>";
    echo "<td align='center'>"._AD_HER_PARAGRAPHE.'</td>';    
    echo "<td align='center'>".''.'</td>';    
    echo "<td align='center'>"._AD_HER_CAPTION.'</td>';  
      
    if (!$tBalise === false){
      echo "<td align='left'>"._AD_HER_SMARTY.'</td>';    
    }
    echo "<td align='left'>"._AD_HER_ORDER.'</td>';    
    echo "<td align='left'>"._AD_HER_FORMAT_MODE.'</td>';    
    
    
    echo '</tr>';
    
    //-------------------------------------    
    $blockSmarty = '';
    $ligneDeSeparation = buildHR(1, _HER_HR_COLOR1, 8);
    while ($sqlfetch = $xoopsDB->fetchArray($structure)) {
      if ($blockSmarty <> $sqlfetch['blockSmarty'] ){
        if ($blockSmarty <> '') echo  $ligneDeSeparation;      
        $blockSmarty = $sqlfetch['blockSmarty'];
      
      }
      
      $bg = getRowStyle($row,'',0, _HER_TR_BASE); 
      
      structureLine($numLine++, $sqlfetch, $obListElements, $obListPositions, $obListMiseEnForme, $bg, $tBalise);
      $lastOrdre = $sqlfetch['ordre'];
    }  
    echo  $ligneDeSeparation;
    //-----------------------------------------
    $t = array('nom'              => '',
               'ordre'            =>  0,    
               'idItem'           =>  0,               
               'idElement'        =>  0,
               'linePosition'     =>  0,
               'lineWidth'        =>  1,
               'lineColor'        => '',
               'cadreBorderWidth' =>  0,
               'cadreBorderColor' =>  0,
               'lineBeforeWidth'  =>  0,
               'lineBeforeColor'  => '',
               'lineAfterWidth'   =>  0,
               'lineAfterColor'   => '',
               'miseEnForme'      => 0,
               'params'           => '', 
               'idStructure'      => 0,
               'blockSmarty'      => '');
  
    //-----------------------------------------    
    for ($h = 0; $h < 5; $h++){
      $bg = getRowStyle($row,'',0, _HER_TR_BASE); 

      $t['ordre'] = $lastOrdre + (($h+1) * 10);
     
       structureLine($numLine + $h, $t, $obListElements, $obListPositions, $obListMiseEnForme, $bg, $tBalise);


      //-----------------------------------------            
      //echo '</tr>';          
    }

    
    //echo '<tr><td><hr></td></tr>';    
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************




    echo "
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_lettre.php",false)."'></td>
        <td align='left' width='200'></td>


        <td align='right'>
        <input type='submit' name='reloadStructure' value='"._AD_HER_SAVE."' )'>    
        </td>    

    
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


/*****************************************************************
 *
 *****************************************************************/
function parseIdParenthese($p){
  
  if (isset($p['updateParams'])){
    $name = $p['updateParams'];
  }else if (isset($p['clearParams'])){
    $name = $p['clearParams'];  
  }else{
    return -1;
  }
  //-------------------------------------------
  $t = explode('(',$name);
  $t = explode(')',$t[1]);
  return $t[0];  
  
}

/*****************************************************************
 *
 *****************************************************************/
function editParamsStructure($idStructure, $idLettre){
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;	

    $sql = "SELECT * FROM "._HER_TFN_STRUCTURE." WHERE idStructure = {$idStructure}";
    $sqlquery = $xoopsDB->query ($sql);  
    $rst =  $xoopsDB->fetchArray($sqlquery);    
//displayArray($rst,"----- editParamsStructure idStructure = $idStructure-----");    
    if ($rst['idElement'] <> 1) return false;  
    $idPlugin = $rst['idItem']; 
    
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
      
  //displayArray($p, "**********************************");
  //echo versionJS();
  //parseIdParenthese($p){
  
//echo "<hr>{$idStructure} : {$idPlugin}<hr>";	  
    //xoops_cp_header();
    OpenTable();  
    
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_LETTRE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_lettre.php?op=saveParamsStructure' METHOD=POST>\n";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>\n";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>\n";
    echo "<TD align='left' >".""."</TD>\n";
    echo "<TD align='right' >structure : "
          ." <INPUT TYPE=\"hidden\" id='idStructure'  NAME='idStructure'  size='1%' VALUE='{$idStructure}'>"
          ." <INPUT TYPE=\"hidden\" id='idPlugin'     NAME='idPlugin'     size='1%' VALUE='{$idPlugin}'>"
          ." <INPUT TYPE=\"hidden\" id='idLettre'     NAME='idLettre'     size='1%' VALUE='{$idLettre}'></TD>";                    
    echo "</TR>\n";    

    //---Name
    //echo buildLibInfo(_AD_HER_NOM, '', $p['nom']);

    //---description
    //echo buildLibInfo(_AD_HER_PARAMS_STRUCTURE, '', $p['description']);
    

    //$obListColor = buildColorSelecteur('', '', $name, '');
 
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************
    editParamsPlugins($idPlugin, $rst['idStructure'] , $params);   
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
     //********************************************************************
    
    echo "<table width='80%'>";     
    echo buildLibInfo(_AD_HER_SELECT_CAT_FROMMODULE, '', $p['module']);   
    echo "</table>";    
    
    echo "<table width='80%'>";    
    editParamsPluginsCat($idPlugin, $rst['idStructure'] , $params);    
     //********************************************************************    
    
    
    
    echo "<table width='80%'>";     
    echo buildLibInfo(_AD_HER_SELECT_ITEM_FROMMODULE, '', $p['module']);   
    echo "</table>";    
    
    echo "<table width='80%'>";    
    editParamsPluginsItem($idPlugin, $rst['idStructure'] , $params);    
     //********************************************************************    
    
    
    
    
    
    
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>\n";    
    //********************************************************************
    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_lettre.php?op=structure&idLettre={$idLettre}",false)."'></td>
        <td align='left' width='200'></td>
        <td align='right'>
        <input type='button' name='clearParamsStructure' value='"._AD_HER_DELETE."' onclick='".buildUrlJava("admin_lettre.php?op=clearParamsStructure&idLettre={$idLettre}&idPlugin={$idPlugin}&idStructure={$idStructure}",false)."'>        
        <input type='submit' name='submit' value='"._AD_HER_VALIDER."' )'>        
        </td>    
      </tr>
      </table>
      </form>";
        
    	CloseTable();

    //********************************************************************    
    echo "</table></form>";        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    

  return true;

}

/***************************************************************************
 *
 ***************************************************************************/

function structureLine($numLine, $rst, $listElements, 
                       $listPositions, $listMiseEnForme, $bg,
                       $tBalise){
	   $myts =& MyTextSanitizer::getInstance();
	   $numLineBase1 = $numLine + 1;
//her_displayArray($rst,"----- structureLine -----");
       
      //$idElement = ($rst['idItem'] * 100 ) + $rst['idElement'] ;
      $idElement = getIdForList($rst['idElement'], $rst['idItem'] );


      $listElementsOk = str_replace ('xxxxx',"txtStrElement_{$numLine}", $listElements);
      $listElementsOk = str_replace ("'{$idElement}'","'{$idElement}' selected", $listElementsOk);   
         
      //$listPositionsOk = str_replace ('xxxxx',"txtLinePosition_{$numLine}", $listPositions);
      //$listPositionsOk = str_replace ("'{$rst['linePosition']}'","'{$rst['linePosition']}' selected", $listPositionsOk);      
 
      //$obListMiseEnFormeOk = str_replace ('xxxxx',"txtMiseEnForme_{$numLine}", $listMiseEnForme);
      //$obListMiseEnFormeOk = str_replace ("'{$rst['miseEnforme']}'","'{$rst['miseEnforme']}' selected", $obListMiseEnFormeOk);      
$listMiseEnForme = array(array('id' => 0, 'lib'=> _AD_HER_AUTOMATIC),
                         array('id' => 1, 'lib'=> _AD_HER_PLUGIN));
$obListMiseEnFormeOk =  getlistSearch ("txtMiseEnForme_{$numLine}", $listMiseEnForme, 0, $rst['miseEnForme']);

      //--------------------------------------------------------------------------------     
      echo '<tr>';
      //echo "<FORM ACTION='admin_lettre.php?op=saveStructure&line={$numLine}' METHOD=POST>\n";
      //-----------------------------------------
      //echo "<td align='left' width = '20'>{$CadreBorderColor}<td>";      
      echo "<td align='left' {$bg}>{$numLineBase1}-{$rst['idStructure']}</td>";      
      
      echo "<td align='left' width = '20'{$bg}>{$listElementsOk}<td>";
//echo "</tr><tr><td></td>";
      //---Name
	    $name = $myts->makeTboxData4Show($rst['nom']);      
      echo   "<TD align='left' width='20'{$bg}><INPUT TYPE='text' id='txtStrName_{$numLine}' "
            ."NAME='txtStrName_{$numLine}'  size='36' VALUE='{$name}'>";
      echo " <INPUT TYPE=\"hidden\" id='txtIdStructure_{$numLine}' NAME='txtIdStructure_{$numLine}' VALUE='{$rst['idStructure']}'>";            
      echo  "</TD>";    

      //---Ordre
      //echo   "<TD align='left' width = '20' ><INPUT TYPE='text' id='txtOrdre_{$h}'  "
      //      ."NAME='txtOrdre_{$numLine}'  size='8' VALUE='{$ordre}'></TD>";    
    //---Ordre
    //echo buildSpin('', '', 'txtOrdre', $ordre, 365, 1, 1, 10);
   //htmlSpin ("",$name, $default, $max, $min,$smallInc ,$largeInc , _LHERCST_DIR_IMG, 1);
      //$checked = ($rst['editBeforeSend'] > 0 )?'checked':'';
      
      /***********************************************************************
       *Permet dajouter une option editBeforeSend dan la structure
       *finalement je l'ai mis au niveu du de a table Texte, c'est plus judicieux
       *je garde quand meme au cas ou le esoin s'en ferait fianmentsentir a l'usage
       ***************************************************************************                           

      echo "<td align='center' width='50px'>";
      echo "<input type='checkbox' name='chkEditBeforeSend_{$numLine}' value='1' {$checked}>";      
      echo "</td>";      
      ***************************************************************************/   
      //---balise
      if (!($tBalise===false)){
        //$listCode = buildHtmlList ("txtBalise_{$numLine}",  $tBalise, 0,  0, $nbRows = 1, '', '');
        $listCode = buildHtmlListString ("txtBlockSmarty_{$numLine}", $tBalise, $rst['blockSmarty'], true);
        echo "<td{$bg}>$listCode</td>";        
      }else{
        echo " <INPUT TYPE='hidden' id=txtBlockSmarty_{$numLine}' NAME='txtBlockSmarty_{$numLine}' VALUE='{$rst['blockSmarty']}'>";      
      }      

     
           
      //---ordre
      $lwSpin = 3;
      echo "<td{$bg}>";
      //echo htmlSpin ("","txtStrOrdre_{$numLine}", $rst['ordre'], 365, 1, 1, 5 , _HER_URL_IMG, 1);
      echo htmlSpin ("","txtStrOrdre_{$numLine}", ($numLine+1)*10, 365, 1, 1, $lwSpin , '', 1);      
      echo "</td>"; 
      
      
           
      echo "<td align='left' width = '40'{$bg}>{$obListMiseEnFormeOk}<td>";  
      
          
      /*

       
      echo "<td>";      
      echo  html_colorSelecteur("txtStrCadreColor_{$numLine}", $CadreBorderColor);
      echo "</td>";
      */
      //echo "<td align='left' width = '20'>{$listPositionsOk}<td>";      
      //pour assurer la compatibilier des ligne avant et apres chaque structure
      //aremplacer par le choix d'un deco dans la structure
  


      //-----------------------------------------------------------------------
      //Structure de la lettre
  	  //$link = "admin_lettre.php?op=structure&idLettre=".$idLettre;
      //echo build_icoOption($link, _JJDICO_TOOLS, _AD_HER_STRUCTURE, '', '', $bg);        
      //-----------------------------------------------------------------------
      //echo "<input type='image' src="._JJDICO_TOOLS." border='0' name='submit' "
      //    ."alt='Paramètres' >";
      if ($rst['idElement'] == _HER_EL_PLUGIN){ 
        $nbEnr = getNbParams ($rst['idItem'],$rst['idStructure']);     
        $ico = (($nbEnr == 0) ? _JJDICO_TOOLS : _JJDICO_EDIT);         
      }else $ico = _JJDICO_FORBID;


      echo build_icoSubmit('submit_'.$numLine, $ico, _AD_HER_STRUCTURE, '', '', $bg);          
      //echo " <INPUT TYPE=\"hidden\" id='txtParamsH_{$numLine}' NAME='txtParamsH_{$numLine}' VALUE='{$rst['params']}'>";          
          
          //."alt='Paramètres' onclick='document.form.submit();'>";
      //-----------------------------------------------------------------------      
      //echo '</form>';  
      echo '</tr>';          
      //-------------------------------------------------------------------      
      /*

      $style = "style='background-color: #F2F2F2; border-style: solid; border-width: 1'";            
      echo "<tr>"
          ."<td align='right'{$bg}><font color=blue><i>"
          ."<input type='submit' name='updateParams' value='"._AD_HER_PARAMETRES_PLUGIN." ({$numLine})' )'>"
          ."<i></font></td>"     
          ."<td  align='left' colspan='8' >"          
          ."<INPUT TYPE='text' id='txtParams_{$numLine}' {$style} "
          ."NAME='txtParams_{$numLine}'  size='100' VALUE='{$rst['params']}' >"
          ." <INPUT TYPE=\"hidden\" id='txtParamsH_{$numLine}' NAME='txtParamsH_{$numLine}' VALUE='{$rst['params']}'>"
          ."</td>"
          ."<td{$bg}></td>"
          ."</tr>";    
      */
           
/*disabled

      
          
      echo "<td align='right'><font color=blue><i>"._AD_HER_PARAMETRES_PLUGIN."<i></font></td>"

     
     echo  "<td >";     
     echo  "<input type='submit' name='updateParams' value='"._AD_HER_UPDATE."({$numLine})' )'>";      
     //echo  "<input type='submit' name='clearParams' value='"._AD_HER_CLEAR."({$numLine})' )'>";      
      echo '</td></tr>';      
*/

}
/***************************************************************************
 *
 ***************************************************************************/

function 		saveSyndication ($p){
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	$myts =& MyTextSanitizer::getInstance();
  
  $idLettre = $p['idLettre'];
  $lstPrefixe = "chkUrl;txtIdUrl";
  $tUrl =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  //displayArray($tUrl,"--- saveSyndication ---");
  
  $sql = "DELETE FROM "._HER_TFN_SYNDICATION
        ." WHERE idLettre = {$idLettre}";  
    $xoopsDB->query($sql);  
      
  //----------------------------------------------------------    
  while (list($key, $item) = each($tUrl)) {
  //displayArray($item, "****** item *************");    
    if (isset($item['chkUrl'])){
      $sql = "INSERT INTO "._HER_TFN_SYNDICATION
          ." (idLettre, idUrl) "
          ." VALUES ({$idLettre}, {$item['txtIdUrl']})";
        
        //echo "<hr>{$sql}<hr>";
        $xoopsDB->query($sql);  
    
    }
    
  }

//exit;
}
	
/*******************************************************************
 *
 *******************************************************************/
function saveAllStructures ($p, &$idStructureSelected, $numLine = -1) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	//displayArray($p, "----- saveAllStructures -----");
  $idLettre = $p['idLettre'];
  //$lstPrefixe = "txtStrName;txtStrOrdre;txtStrElement;txtStrCadreBorder;txtStrCadreColor";  
  $lstPrefixe = "txtStrName;txtStrOrdre;txtStrElement;txtMiseEnForme;"
               ."txtIdStructure;txtBlockSmarty";  
  
  //probablement a virer quand j'aurai vier le bouton pas bo de la 2eme ligne
  if ($numLine < 0 ) $numLine = parseIdParenthese($p);
  //echo "<hr>saveAllStructures<br>numLine : $numLine<hr>";
  $idStructure = 0;
//  $t = getArrayOnPrefix2 ($p, $prefix );
/*

$t =  buildArrayOnPrefix ($p, $lstPrefix, $sType, $table,
                            $colId, $id, 
                            $underscore = true, $sepPrefixe = ";");  
*/  
$t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
//displayArray($t,"xxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
  
  
  //displayArray($p, "******{$idLettre}*************");
  //-----------------------------------------------------------------------
  $sql = "UPDATE "._HER_TFN_STRUCTURE." SET " 
        ."params = '0' "
        ." WHERE idLettre = {$idLettre}";
  
      $xoopsDB->query($sql);  
  
  //-----------------------------------------------------------------------
  //$sql = "INSERT INTO "._HER_TFN_STRUCTURE  
  //      ." (idLettre, ordre, nom, idElement, idItem, CadreBorderWidth, cadreBorderColor )"
  //      ." VALUES (%0%,%1%,'%2%',%3%,%4%,%5%,'%6%')";
  
  $sqlInsert = "INSERT INTO "._HER_TFN_STRUCTURE  
              ." (idLettre, ordre, nom, idElement, idItem, "
              ."  miseEnForme, params, blockSmarty) "
              ." VALUES (%0%,%1%,'%2%',%4%,%5%,%10%,'%11%','%12%')";

  $sqlUpdate = "UPDATE "._HER_TFN_STRUCTURE." SET " 
              ."idLettre = %0%,"
              ."ordre = %1%,"
              ."nom = '%2%',"
              ."idElement = %4%,"
              ."idItem = %5%,"
              ."miseEnForme = %10%,"
              ."params = '%11%',"              
              ."blockSmarty = '%12%' ";

  //for ($h = 0; $h < count($t); $h++){    
  $h = -1;                  
  while(list($key, $item) = each ($t)){
    //displayArray($item,"-------------$key-------------------");
    //$item = $t[$h] ; 
    $h ++; 
    //si c'est l(item 0 de la liste on ne traite pas l'élément et on le suprimera a la fin)
    if ($item['txtStrElement'] == 0) {continue;}
    parseIdList($item['txtStrElement'], $idElement, $idItem);
    $idStructure = $item['txtIdStructure']; 
    /*

    $filter = " WHERE idLettre = {$idLettre} "
             ." AND idElement = {$idElement}"
             ." AND idItem = {$idItem}";
    
    $sql = "SELECT idStructure AS nbEnr FROM "._HER_TFN_STRUCTURE.$filter;
    $sqlquery = $xoopsDB->queryF($sql);        
    $nbEnr = $xoopsDB->getRowsNum($sqlquery);
    */    
    
    
    $filter = " WHERE idStructure = {$idStructure} " ;   
    if ($idStructure == 0){
        $sql1 = $sqlInsert;
        $idStructure = 0;
    }else{
        $sql1 = $sqlUpdate.$filter;    
        //list($idStructure) = $xoopsDB->fetchRow($sqlquery);        
    }  
    //-----------------------------------------------------------      
    
    $sql1 = str_replace ('%0%', $idLettre, $sql1);
    $sql1 = str_replace ('%1%', $item['txtStrOrdre'], $sql1); 
    $sql1 = str_replace ('%2%', string2sql($item['txtStrName']), $sql1);    
    //$sql1 = str_replace ('%3%', (($item['chkEditBeforeSend']==1)?1:0), $sql1);    
    //$sql1 = str_replace ('%4%', subStr($item['txtStrElement'],2), $sql1);
    //$sql1 = str_replace ('%5%', intval($item['txtStrElement'] / 100) , $sql1);
    $sql1 = str_replace ('%4%', $idElement, $sql1);
    $sql1 = str_replace ('%5%', $idItem, $sql1);
    
    
    //$sql1 = str_replace ('%6%', $item['txtLineBeforeWidth'], $sql1);    
    //$sql1 = str_replace ('%7%', $item['txtLineBeforeColor'], $sql1);  
    //$sql1 = str_replace ('%8%', $item['txtLineAfterWidth'], $sql1);    
    //$sql1 = str_replace ('%9%', $item['txtLineAfterColor'], $sql1);  
    $sql1 = str_replace ('%10%', $item['txtMiseEnForme'], $sql1);   
    //$sql1 = str_replace ('%11%', string2sql($item['txtParamsH']), $sql1);    
    $sql1 = str_replace ('%11%', '1', $sql1);      
    //$sql1 = str_replace ('%4%', subStr($item['txtStrElement'],-3) , $sql1);    
    $sql1 = str_replace ('%12%', $item['txtBlockSmarty'], $sql1);    
    
    //$sql1 = str_replace ('%5%', $item['txtStrCadreBorder'], $sql1);    
    //$sql1 = str_replace ('%6%', "#".$item['txtStrCadreColor'], $sql1);    
    
    //echo "<hr>saveAllStructures -> {$sql1}<hr>";
    $xoopsDB->queryF($sql1);    
    
    
    if ($idStructure == 0){
        $idStructure = $xoopsDB->getInsertId() ;    
    }
    if ($numLine == $h) $idStructureSelected  = $idStructure;    
    
  //echo "<hr>saveAllStructures<br>{$sql1}<hr>";
//echo "<hr>numLine = {$numLine} | idStructure = {$idStructure} | {$h} | {$newIdStructure}<hr>";    
  }  
  
  //-----------------------------------------------------------------------
  //il faut virer les element de structure qui ont ete mis a vide
  //-----------------------------------------------------------------------  
  $sql = "DELETE FROM "._HER_TFN_STRUCTURE 
        ." WHERE idLettre = {$idLettre}"
        ." AND params = '0'";
  
   $xoopsDB->query($sql);  
    //-----------------------------------------------------------------
  
//exit; 
}
/*******************************************************************
 *
 *******************************************************************/
function  getIdForList($idElement, $idItem){
  
  //echo "<hr>{$idElement}-{$idItem}->"._HER_COEF_LIST."<hr>";
  return  ($idItem * _HER_COEF_LIST )+ $idElement;
  
      //$idElement = ($rst['idItem'] * 100 ) + $rst['idElement'] ;
}
/*******************************************************************
 *
 *******************************************************************/
function  parseIdList($idList, &$idElement, &$idItem){
    //$idElement =  subStr($idList, -2);
    $idElement =  subStr($idList, - (strlen(_HER_COEF_LIST)-1));
    $idItem    = intval($idList / _HER_COEF_LIST);

}


/*******************************************************************
 *
 *******************************************************************/
function saveEditBeforeSend ($p) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	$myts =& MyTextSanitizer::getInstance();
	
  //$lstPrefixe = "txtStrName;txtStrOrdre;txtStrElement;txtStrCadreBorder;txtStrCadreColor";  
  $lstPrefixe = "idTexte;txtTexte";  
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe); 
   
  //displayArray($p, "****** p *************");  
  //displayArray2($t, "****** texte *************");
  //-----------------------------------------------------------------------

  
  reset($t);
  while (list($key, $item) = each($t)) {
 
   // for ($h = 0; $h < count($t); $h++){
    //$item = $t[$h];
  //displayArray($item, "****** item *************");    

   $txt = $item['txtTexte'];
   $txt = $myts->makeTareaData4Save($txt);   
     
    $sql = "UPDATE "._HER_TFN_TEXTE
          ." SET texte = '{$txt}'"
          ." WHERE idTexte = {$item['idTexte']}";
    
    $xoopsDB->query($sql);  
    //echo "<hr>{$sql}<hr>";
  }
  
  //-----------------------------------------------------------------------
  //pieces jointes
  //-----------------------------------------------------------------------
  
  $idLettre = $p['idLettre'];  
  $lstPrefixe = "txtPiece;txtFullName;txtLibPiece";
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  

  $sql = "DELETE FROM "._HER_TFN_PIECE
        ." WHERE idLettre = {$idLettre}";
  $xoopsDB->query($sql);  
  

  $sql = "INSERT INTO "._HER_TFN_PIECE  
        ." (idLettre, nomFichier, state, libelle )"
        ." VALUES ({$idLettre}, '%1%', %2%, '%3%')";
        
  for ($h = 0; $h < count($t); $h++){
    $item = $t[$h] ; 
    if ($item['txtPiece'] == 0) {continue;}
    
    $sql1 = str_replace ('%1%', string2sql($item['txtFullName']), $sql);    
    $sql1 = str_replace ('%2%', $item['txtPiece'], $sql1);
    $sql1 = str_replace ('%3%', $item['txtLibPiece'], $sql1);    
    $xoopsDB->query($sql1);    
       
  }  

  //-----------------------------------------------------------------------
  // liste de mail coplementaire
  $sql = "UPDATE "._HER_TFN_LETTRE." SET"
       ." idListe     = {$p['txtListeMail']},"
       ." idListeTest = {$p['txtIdListeTest']}"       
       ." WHERE idLettre = {$p['idLettre']}" ;
   $xoopsDB->query($sql);       
  //-----------------------------------------------------------------------       
}


/****************************************************************************
 *
 ****************************************************************************/
function previewLetter ($idLettre){
  $params =array('idUser' => 123,
                 'login'  => 'JJD',
                 'mail'   => 'jjd@kiolo.com');
  

    $link = "<a href='javascript:window.close();'>Close</a>";
    $btnClose =  "<FORM ACTION='admin_lettre.php?op=list' METHOD=POST>"
                ."<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>"
                 ."<tr valign='top'>"
                 ."<td align='center' >"
                 ."<input type='button' name='cancel' value='"._CLOSE
                 ."' onclick='".buildUrlJava("admin_lettre.php",false)
                 .";'></td>"
                 ."<td align='left' width='200'></td>"
                 ."</tr>";



  db_getUsers($idLettre);
    
    //**********************************************************************************  
      
    //$texte  =  buildLetter ($idLettre, &$params, _HER_PREVIEW);  
    $texte  =  buildLetter ($idLettre, $params, _HER_PREVIEW);
    $idArchive = 0;
         
    if ($params['personnalisable']){    
      $params = array(_HER_CODE_USER.'idUser'   => 0,
                      _HER_CODE_USER.'pseudo'   => 'JÝJÝD',      
                      _HER_CODE_USER.'name'     => 'Jean-Jacques',
                      _HER_CODE_USER.'email'    => 'jjd@kiolo.com',    
                      _HER_CODE_USER.'mail'     => 'jjs@kiolo.com',
                      _HER_CODE_USER.'login'    => 'jjd',                      
                      'idLettre' => $idLettre,
                      'idArchive'=> $idArchive);      
      

      $texte = replaceCodePersonalise ($texte, $params);    
    }                                

    //------------------------------------------------    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
    //echo $btnClose;
    echo $texte;
    //**********************************************************************************
    echo $btnClose;

/*
   echo "</form>";
    
    //**********************************************************************************    
	CloseTable();
	xoops_cp_footer();
*/ 
  
  
  
  
}

/****************************************************************************
 *
 ****************************************************************************/
function editStatistiques ($idLettre, $presentation = 0){
	global $xoopsModuleConfig, $xoopsDB;
	

    
    //------------------------------------------------    
  $myts =& MyTextSanitizer::getInstance();    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_LIBELLES."</b><br>";    

    echo "<FORM ACTION='admin_lettre.php' METHOD=POST>";
    showStatistiques($idLettre, $true, $presentation);    
//echo "<hr>presentation ={$presentation}<hr>";
    
    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='right'>
    <input type='submit' name='fermer' value='"._AD_HER_CLOSE."' > 
    </td>   

        
  </tr>
  </form>";

	CloseTable();
	//xoops_cp_footer();

  
  
  
  
}


/****************************************************************************
 *
 ****************************************************************************/
function sendAllLetters1 ($idLettre){
global $xoopsModuleConfig, $xoopsDB;

    $tEMails = array();
    $params = array();
    //$texte = buildLetter ($idLettre, &$params, _HER_SEND);
    $texte = buildLetter ($idLettre, $params, _HER_SEND);   
     
    if (isset($params['idArchive'])){
        $idArchive = $params['idArchive'];    
    }else{$idArchive = 999;}
    //displayArray($params, "---sendAllLetters--- params idAchive =  {$idArchive} ------");
    //-------------------------------------------------------------
    
    $tUsers = db_getUsers($idLettre);
      //echo "<hr>";    
    for ($h=0; $h < count($tUsers); $h++){
      $sqlfetch = $tUsers[$h];
      if ($params['personnalisable']){      
        $paramsPerso = array(_HER_CODE_USER.'idUser'   => $sqlfetch['uid'],
                             _HER_CODE_USER.'pseudo'   => $sqlfetch['uname'],      
                             _HER_CODE_USER.'name'     => $sqlfetch['name'],
                             _HER_CODE_USER.'email'    => $sqlfetch['email'],    
                             _HER_CODE_USER.'mail'     => $sqlfetch['email'],
                             _HER_CODE_USER.'login'    => $sqlfetch['uname'],                      
                             'idLettre' => $idLettre,
                             'idArchive'=> $idArchive);      
        
  
        $texte = replaceCodePersonalise ($texte, $paramsPerso);      
      }                                


      
      $d = date("d-m-Y h:m:h" , time());
      //echo "envoi mail  ===> {$sqlfetch['email']} - {$sqlfetch['email']}<hr>";
      
      $headers  = "MIME-Version: 1.0\r\n"
                 ."Content-type: text/html; charset=iso-8859-1\r\n";

      mail($sqlfetch['email'] , "la lettre du {$d}", $texte, $headers);      
      
      $tEMails [$sqlfetch['email']] = $sqlfetch['uid'];




/*
      $d = date("d-m-Y h:m:h" , time());
      echo "envoi mail  ===> {$sqlfetch['email']} - {$sqlfetch['email']}<hr>";
      mail($sqlfetch['email'] , "la lettre du {$d}", "aaaaa");      
*/

    
    }
    //-----------------------------------------------------
    //displayArray($tEMails,"--- liste des adresse ok ---");
    //Envoi des lettre a la liste compl‚mentaire d'eMails
    $sql = "SELECT liste FROM "._HER_TFN_BONUS
          ." WHERE idListe = {$params['idListe']}";
    $sqlquery = $xoopsDB->queryF ($sql);     
    list ($listEmails) = $xoopsDB->fetchRow($sqlquery);
    $t = explode("\r\n", $listEmails);
    for ($h = 0; $h < count($t); $h++){
      $item = explode(",", $t[$h]);
      if (!isset($tEMails[$item[0]]) AND $item[0]<>''){
        //echo "{$item[0]}<hr>";    
        $tEMails [$item[0]] = 0;  
      }

    }
    
    //-----------------------------------
    saveListeTo($idArchive, $tEMails);
    //---------------------------------
    //Mise a jour du nombre d'envoi
    //idArchive est recuperer dans le tableau passer par rereference
    //displayArray($params, "------ params ------");
    if ($idArchive > 0){
        updateArchiveEnvois ($idArchive , count($tUsers));    
    }

      
exit;
  
}

/****************************************************************************
 *
 ****************************************************************************/
function sendAllLetters ($idLettre, $mode = _HER_SEND){
//mode = _HER_TEST, _HER_PREVIEW  ou _HER_SEND
global $xoopsModuleConfig, $xoopsDB;
//echo "<hr>sendAllLetters<hr>";
    $tEMails = array();
    $params = array();
    //$texteHTML = buildLetter ($idLettre, &$params, $mode);
    $texteHTML = buildLetter ($idLettre, $params, $mode);
        
    $texteTEXT = strip_tags($texteHTML);   
     
    if (isset($params['idArchive'])){
        $idArchive = $params['idArchive'];    
    }else{$idArchive = 999;}
    //displayArray($params, "---sendAllLetters--- params idAchive =  {$idArchive} ------");
    //-------------------------------------------------------------
    
    $headersHTML  = getHeader(1, $params['emailSender']);    
    $headersTEXT  = getHeader(2, $params['emailSender']); 
       
    $d = date("d-m-Y h:m:h" , time());    
    $subject = $params['libelle'];   //'nom'
    
    
    if ($mode == _HER_SEND){
        
        $tUsers = db_getUsers($idLettre);
          //echo "<hr>";    
        for ($h=0; $h < count($tUsers); $h++){
          $sqlfetch = $tUsers[$h];
          
          //jjd sendAll
          //echo "<hr>envoi des mails <hr>";
          //displayArray($sqlfetch, "--- sendAllLetters --- params user ----");      
    
          if ($params['personnalisable'] || true){      
            $paramsPerso = array(_HER_CODE_USER.'idUser'   => $sqlfetch['uid'],
                                 _HER_CODE_USER.'pseudo'   => $sqlfetch['uname'],      
                                 _HER_CODE_USER.'name'     => $sqlfetch['name'],
                                 _HER_CODE_USER.'email'    => $sqlfetch['email'],    
                                 _HER_CODE_USER.'mail'     => $sqlfetch['email'],
                                 _HER_CODE_USER.'login'    => $sqlfetch['uname'],                      
                                 'idLettre' => $idLettre,
                                 'idArchive'=> $idArchive);      
            
            
       
            if ($sqlfetch['state'] == 2){
                $texte = replaceCodePersonalise ($texteTEXT, $paramsPerso);
                $headers = $headersTEXT;      
            }else{
                $texte = replaceCodePersonalise ($texteHTML, $paramsPerso);
                $headers = $headersHTML;      
            }
                
          } else{
            if ($sqlfetch['state'] == 2){
                $texte   = $texteTEXT;
                $headers = $headersTEXT;      
            }else{
                $texte   = $texteHTML;
                $headers = $headersHTML;      
            }
          
          }                               
    
          //echo "envoi mail  ===> {$sqlfetch['email']} - {$sqlfetch['email']}<hr>";
          
          /*
    
          $headers  = "MIME-Version: 1.0\r\n"
                     ."Content-type: text/html; charset=iso-8859-1\r\n";
          */      
          
          //-----------------------------------------------------------  
          
          //$bolOk = mail($sqlfetch['email'] , $subject, $texte, $headers);
          //$bolOk = mail($sqlfetch['email'] , $subject, $texte, $headers);      
          //$r= (($bolOk) ? "Succés" : "Echec");
          //echo "==> <b>{$r}</b> de l'envoi du mail a: ==> {$sqlfetch['email']} ==> {$subject}<br>" ;
          
          hermesMail($sqlfetch['email'],$params['emailSender'],$subject,$texte,true,1);          
                
          //echo "<hr><b>{$r}</b> de l'envoi du mail a:<br>{$sqlfetch['email']}<br>{$subject}<br>{$headers}<hr>" ;               
          //-----------------------------------------------------------
          $tEMails [$sqlfetch['email']] = $sqlfetch['uid'];
    
    
    
    
    /*
          $d = date("d-m-Y h:m:h" , time());
          echo "envoi mail  ===> {$sqlfetch['email']} - {$sqlfetch['email']}<hr>";
          mail($sqlfetch['email'] , "la lettre du {$d}", "aaaaa");      
    */
        $sql = "SELECT liste FROM "._HER_TFN_BONUS
              ." WHERE idListe = {$params['idListe']}";
        //echo $sql."<hr>";
        $sqlquery = $xoopsDB->queryF ($sql);     
        list ($listeComplementaire) = $xoopsDB->fetchRow($sqlquery);
    
        
        }
    }else{
        $sql = "SELECT liste FROM "._HER_TFN_BONUS
              ." WHERE idListe = {$params['idListeTest']}";
        //echo $sql."<hr>";
        $sqlquery = $xoopsDB->queryF ($sql);     
        list ($listeComplementaire) = $xoopsDB->fetchRow($sqlquery);
        
    } 
    //-----------------------------------------------------
    //displayArray($tEMails,"--- liste des adresse ok ---");
    //displayArray($params,"--- ID de la liste complementaire ?? ---");    
    //Envoi des lettre a la liste compl‚mentaire d'eMails
    $t = prepareListComplementaire($listeComplementaire, $countListeComplementaire);
   
    //$listEmails = str_replace ("\r",";",$listEmails);
    //$listEmails = str_replace ("\n",";",$listEmails);    
    //echo "liste complementaire ===> " .$listEmails;
    //$t = explode(";", $listEmails);
    
    for ($h = 0; $h < count($t); $h++){
      $item = explode(";", $t[$h]);
      $email = $item[0];      
      if (!isset($tEMails[$email]) AND $email <>''){
         //--------------------------------------------------------------
          if ($params['personnalisable'] || true){      

            $name = (isset($item[1])) ? $item[1] : $email;
            
            $paramsPerso = array(_HER_CODE_USER.'idUser'   => 0,
                                 _HER_CODE_USER.'pseudo'   => '???',      
                                 _HER_CODE_USER.'name'     => $name,
                                 _HER_CODE_USER.'email'    => $email,    
                                 _HER_CODE_USER.'mail'     => $email,
                                 _HER_CODE_USER.'login'    => $name,                      
                                 'idLettre' => $idLettre,
                                 'idArchive'=> $idArchive);      

            $item['state'] = 0;//tout est a revoir dans cette precedure
            if ($item['state'] == 2){
                $texte = replaceCodePersonalise ($texteTEXT, $paramsPerso);
                $headers = $headersTEXT;      
            }else{
                $texte = replaceCodePersonalise ($texteHTML, $paramsPerso);
                $headers = $headersHTML;      
            }
                
         }
         //--------------------------------------------------------------         
        // $bolOk = mail($email , $subject, $texte, $headers);
        // $r= (($bolOk) ? "Succés" : "Echec");
        // echo "==> <b>{$r}</b> de l'envoi du mail a: ==> {$item[0]} ==> {$subject}<br>" ;
        hermesMail($email,$params['emailSender'],$subject,$texte,true,1);               
        
        $tEMails [$email] = 0;  
      }

    }
    
    //-----------------------------------
    /*sauvegazrde de la liste d'emals, mais finalement pas utile
    
    saveListeTo($idArchive, $tEMails);
    */
    //---------------------------------
    //Mise a jour du nombre d'envoi
    //idArchive est recuperer dans le tableau passer par rereference
    //displayArray($params, "------ params ------");
    

    
    
//exit;      
    if ($mode == _HER_SENDTEST){
      //echo "<hr>purgerArchive($idLettre, true, 1)<hr>";
      if ($xoopsModuleConfig['keepTestLetter'] == 0 ){
          purgerArchive($idLettre, true, 1);      
      }

    }else{
      if ($idArchive > 0){
          updateArchiveEnvois ($idArchive , count($tUsers));    
      }
    
    }
  
}




/****************************************************************************
 * a virer
 ****************************************************************************/
function sendLettre ($idLettre){
  
  $params =array('idUser' => 123,
                 'login'  => 'JJD',
                 'mail'   => 'jjd@kiolo.com');
  buildLetter ($idLettre, $params, _HER_SEND);
}

/****************************************************************************
 *
 ****************************************************************************/
function noteLettre ($p){
  
}


/****************************************************************
 *
 ****************************************************************/
 function saveParamsStructure ($p) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  $lstPrefixe  = "txtParamNom;txtHParamNom;txtTypeParam";  
  $idStructure = $p['idStructure'];  
  $idPlugin    = $p['idPlugin'];
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
  //displayArray($p, "******{}*************");
  //-----------------------------------------------------------------------
  $rst = db_getFulParams($idPlugin, $nbParams, $idStructure);  
  //-----------------------------------------------------------------------
  //displayArray($rst, "****** db_getPluginParams *************");
  
  $tParams = array();
        
  for ($h = 0; $h < count($t); $h++){
    $item = $t[$h] ; 
    $paramName = $item['txtHParamNom'];
    
    switch ($item['txtTypeParam']){
      case 3:
        //-----------------------------------------------------------   
        $lstPrefixe = "txtFile";
        $tFiles =  getArrayOnPrefixArray ($p, $lstPrefixe);  
        //displayArray($tFiles, "****** fchiers*************");        
        $template = $tFiles[$item['txtParamNom']]['txtFile'];
        $v = string2sql($template);
        //echo "<hr>{$template}-{$item['txtParamNom']}<hr>";
        //-----------------------------------------------------------   
      
        break;
        
      case 4:        
       $v = checkBoxToBin($p, "txtOptionsAffichage", $def);
       $item['txtHParamNom'] = 'optionsAffichage';
        break;
        
        
      default:
        $v = string2sql($item['txtParamNom']);      
        break;
    }
    
    
    //echo "<hr>{$paramName} : ".$rst[$paramName]['value']." = {$v}<br>{}<br><hr>";
    if ($rst[$paramName]['value'] <> $v){
      $tParams[] = $paramName.'='.$v; 
    }
    
  } 
  
  
  $params = implode(';', $tParams);
    $sql = "UPDATE "._HER_TFN_STRUCTURE  
          ." SET  params = '{$params}' "
          ." WHERE idStructure = {$idStructure} ";

      $xoopsDB->query($sql);    
     //echo "<hr>saveParams -> {$sql}<hr>"; //exit;  
  
  
  
  
//exit;   
}  

/****************************************************************
 *
 ****************************************************************/
 function clearParamsStructure (&$p) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  $idStructure = $p['idStructure'];  
  
  $sql = "UPDATE "._HER_TFN_STRUCTURE  
        ." SET  params = '' "
        ." WHERE idStructure = {$idStructure} ";

    $xoopsDB->queryF($sql);    
    //echo "<hr>clearParamsStructure<br>{$sql}<hr>"; //exit;  
//exit;   
}  

/****************************************************************************
 *
 ****************************************************************************/
include_once (_HER_ROOT_PATH.'class/cls_hermes_lettre.php');
$adoLettre = new cls_hermes_lettre();



if (isset($gepeto['reloadStructure']))     {$op = "reloadStructure";} 
if (isset($gepeto['saveEditBeforeSend']))  {$op = "saveEditBeforeSend";} 
if (isset($gepeto['sendAllLetters']))      {$op = "sendAllLetters";  $mode=_HER_SEND;}
if (isset($gepeto['sendAllLetters2']))     {$op = "sendAllLetters";  $mode=_HER_PREVIEW;}
if (isset($gepeto['sendLetterByLot']))     {$op = "sendLetterByLot"; $mode=_HER_SEND;}
if (isset($gepeto['sendAllInOneTime']))    {$op = "sendAllInOneTime"; $mode=_HER_SEND;}
if (isset($gepeto['sendTest']))            {$op = "sendTest";        $mode=_HER_SENDTEST;}
if (isset($gepeto['newConfirmation']))     {$op = "newConfirmation";}

if (isset($gepeto['updateParams']))        {$op = "updateParams";}
if (isset($gepeto['clearParams']))         {$op = "clearParams";}

/***********************************************************************
************************************************************************/
$submit = 'submit_';
$lg = strlen($submit);

while (list($key, $item) = each($gepeto)) {
  if (substr($key, 0, $lg) == $submit){
    $op = 'updateParams';
    $t = explode('_', $key);
    $numLine = $t[1];
    //echo "<hr>{$op}->{$numLine}<hr>";    
    break;
  }
}

reset($gepeto);
//displayArray($gepeto,"************ gepeto ***************");
//--------------------------------------------------------------------   
$bOk = ($op <> 'previewLetter');  
//$bOk=true; 
if ($bOk){admin_xoops_cp_header(_HER_ONGLET_LETTRE, $xoopsModule);}   

//echo "<hr>{$op}<hr>";
$typeLettre = 0;

switch($op) {
  case "list":
		listLettre ();
		break;
		
  case "saveList":
		saveListLettre ($_POST);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);		
		break;
		

    case "newConfirmation":
      $typeLettre = 1;  
    case "new":
    $p = $adoLettre->getArray (0,$typeLettre);
    editLettre ($p);
    //redirect_header("admin_Lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;





  case "edit":
		$p = $adoLettre->getArray ($idLettre);
    editLettre ($p);
    //redirect_header("admin_Lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;
		
  case "syndication":
		$p = $adoLettre->getArray ($idLettre);
    editSyndication ($p);
    //redirect_header("admin_Lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;
		
  case "saveSyndication":
		saveSyndication ($_POST);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;

  case "structure":
		$p = $adoLettre->getArray ($idLettre);
    editStructure ($p);
  	break;

  case "saveAllStructures":
  //displayarray($_POST,"------------post--------------------");
    saveAllStructures ($_POST, $idStructure);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);
  	break;

  case "duplicate":
		$p = $adoLettre->newClone ($idLettre, true);    
    editLettre ($p);    
  	break;
//====================================================
  case "updateParams":
    //displayArray($gepeto,"----- gepeto -----");
    $idLettre = $gepeto['idLettre'];
    saveAllStructures ($gepeto, $idStructure, $numLine);  
    //echo "<hr>$idStructure : $idLettre<hr>";
    if (!editParamsStructure($idStructure, $idLettre,$idStructure )){
      redirectTo("admin_lettre.php?op=structure&idLettre={$idLettre}", _AD_HER_NOTPARAMS, 2);
    }
    break;
/*
*/  	
  case "saveParamsStructure":
    //displayArray($gepeto,"----- gepeto -----");  
    $idLettre = $gepeto['idLettre'];  
    //saveParamsStructure($gepeto);  
    saveParams ($gepeto);
		$p = $adoLettre->getArray($idLettre);    
    editStructure ($p);
  	break;
  	
  case "clearParamsStructure":
    //clearParamsStructure($gepeto); 
    //displayArray($gepeto,"----- gepeto -----"); 
    clearParams ($gepeto['idPlugin'], $gepeto['idStructure']);
		$p = $adoLettre->getArray($idLettre);    
    editStructure ($p);
  	break;
  	
//====================================================

  case "reloadStructure":
		$p = $adoLettre->getArray($idLettre);  
    saveAllStructures ($_POST, $idStructure);
    editStructure ($p);
    //$link = "admin_lettre.php?op=structure&idLettre={$idLettre}";
    //echo "<hr>{$link}<hr>";
    //redirect_header($link,1,_AD_HER_ADDOK);
  	break;


  case "save":
		$adoLettre->saveRequest ($_POST);
		listLettre();
    //redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);		
		break;

  case "empty":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_EMPTY, "<b>{$_GET['name']} (id:{$idLettre})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'emptyOk', 
                        'idLettre' => $_GET['idLettre'] ,
                        'ok'         => 1),
                        "admin_lettre.php", $msg );
//    xoops_cp_footer();
    
    break;


  case "emptyOk":
    purgerArchive ($_POST['idLettre']);    
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_EMPTYOK);    
		break;

  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_HER_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idLettre})</b>" , _AD_HER_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idLettre' => $_GET['idLettre'] ,
                        'ok'         => 1),
                        "admin_lettre.php", $msg );
//    xoops_cp_footer();
    
    break;


  case "removeOk":
    $adoLettre->deleteId ($_POST['idLettre']); 
    //echo "<hr>removeOk<hr>";   
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_DELOK);    
		break;

  case "clear":
    clearLettre ($id);
    redirect_header("admin_lettre.php?op=edit",1,_AD_HER_ADDOK);    
		break;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++
  case "stat":
    editStatistiques ($gepeto['idLettre'], $gepeto['presentation']);
    //redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;
		
  case "statgraph":
    editStatistiques ($gepeto['idLettre']);
    //redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++
  case "previewLetter":
    previewLetter ($gepeto['idLettre']);
    //redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;

  case "editBeforeSend":
    $p = $adoLettre->getArray($idLettre);
    if (!isset($gepeto['mode'])) {$mode = 0;}  else {$mode = $gepeto['mode'];}
		editBeforeSend($p, $mode);    
		break;

  case "saveEditBeforeSend":
    saveEditBeforeSend($gepeto);
    $p = $adoLettre->getArray($idLettre);  
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		//editBeforeSend($p);    
		break;
//******************************
  case "sendTest":
    saveEditBeforeSend($gepeto);		
    sendAllLetters ($idLettre, $mode);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;
//******************************
  case "sendAllLetters":
    saveEditBeforeSend($gepeto);		
    sendAllLetters ($idLettre, $mode);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;


  case "sendLetter":
    sendLettre ($gepeto['idLettre']);
    redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);    
		break;


  case "sendLetterByLot":
    saveEditBeforeSend($gepeto);  
    $p = $adoLettre->getArray($idLettre);
    if (!isset($gepeto['mode'])) {$mode = 0;}  else {$mode = $gepeto['mode'];}
    $mode = 1;
    sendLetterByLot ($p, $mode);
    //redirect_header("admin_send.php?op=sendLetterByLot",1,_AD_HER_ADDOK);    
		break;


  case "sendAllInOneTime":
    echo "<hr>sendAllInOneTime<hr>";
    redirect_header("admin_send.php?op=sendAllInOneTime",1,_AD_HER_ADDOK);
		break;	
    	
	default:
	 //$state = _HER_STATE_WAIT;
    //redirect_header("admin_lettre.php?op=list",1,_AD_HER_ADDOK);
    //break;


}

   
if ($bOk) {admin_xoops_cp_footer();} 

//---------------------------------------------------------------------
    
  //displayArray ($_POST, "******zzz*********");
  


?>
