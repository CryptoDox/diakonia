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


//include_once ("admin_header.php");
//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
             ."modules/".$xoopsModule->getVar('dirname')."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------
include_once (_HER_ROOT_PATH.'class/cls_hermes_texte.php');
//include_once (_HER_ROOT_PATH.'class/cls_hermes_frame.php');
include_once (_HER_ROOT_PATH.'class/cls_hermes_deco.php');
include_once (_HER_ROOT_PATH.'class/cls_hermes_fluxRSS.php');
include_once (_HER_ROOT_PATH.'class/cls_hermes_libelle.php');
//include_once (_HER_ROOT_PATH.'class/cls_hermes_style.php');
include_once (_HER_ROOT_PATH.'class/cls_hermes_sondage.php');
include_once (_HER_ROOT_PATH.'class/cls_hermes_lettre.php');
//-----------------------------------------------------------------------------------
require_once (_HER_JJD_PATH."include/functions.php");
require_once (_HER_JJD_PATH."include/html_functions.php");


include_once (_HER_ROOT_INCLUDE."hermes_data.php");


//include_once (_HER_ROOT_PATH."plugins/hermes_selecteur.inc");

/*

    $style = $xoopsModuleConfig['style_Caption'];
    $style = $xoopsModuleConfig['style_TexteNom'];    
    $style = $xoopsModuleConfig['style_TexteContent'];
    $style = $xoopsModuleConfig['style_pluginNom'];    
    $style = $xoopsModuleConfig['style_pluginColTitles'];
    $style = $xoopsModuleConfig['style_pluginFooter'];    
    $style = $xoopsModuleConfig['style_pluginFirstColone'];
    $style = $xoopsModuleConfig['style_pluginLastColone'];    
    $style = $xoopsModuleConfig['style_pluginOtherColones'];
    
*/

define ('hermes_crlf',chr(13).chr(10));


/**************************************************************************
 *
 **************************************************************************/
function buildLetter ($idLettre, &$params, $mode = 0){
	global $xoopsModuleConfig, $xoopsDB, $xoopsConfig;
  

  $adoLetter = new cls_hermes_lettre();
  $rsLettre =  $adoLetter->getArray($idLettre);
  $rsLettre ['nextChronoArchive'] = $rsLettre ['chronoArchive'];
   
  //$rsLettre['groupes'] = db_getGroupeLettre($idLettre); c'est dan la table maintenant'
  //echo "<hr>buildLetter - groupes<br>{$rsLettre['groupes']}<hr>";
  
  //$params ['idLettre'] = $idLettre;  
  $params =  $rsLettre;  
  $bTpl = ($rsLettre['tplBody'] <> '');
  //displayArray($params, "-----{buildLetter}-----");
  //echo "----> {$rsLettre['nom']}<br>";
  
  $sqlQuery = db_getStructure($idLettre);  
  //-------------------------------------------------------------  
  $fds = XOOPS_URL."/themes/default/style.css";
    
  //-------------------------------------------------------------
  //if ($mode == _HER_SEND || $mode == _HER_SENDTEST){
  // }  
  $tf = getNameForLetter($idLettre, $rsLettre['nom'], $mode);
  $params['archiveName'] = $tf [0];

  //-------------------------------------------------------------  
  
  $tl = array ();  

  /*


  $params['idArchive'] = 0;
      
  if ($mode == _HER_SEND || $mode == _HER_SENDTEST){
    $idStat = getNewStat($idLettre, 0, 'jjd');  
  } else{
    $idStat = 0;
  } 
  */  
  $params['stat_code'] = 'jjd';  
  $params['stat_id'] = 25;    
  $params['stat_increment'] = 1;
  

  /*

  if ($mode == _HER_SEND || $mode == _HER_SENDTEST){ 
    $params['folderRessource'] = createFolderRessource($params, $mode);
    //$params['isFolderRessource'] = true;    
  } 
  */  

  
    //------------------------------------------------------------------  
    // Entete de la page template ou manu
    //------------------------------------------------------------------    
    if ($bTpl){
      //------------------------------------------------------- 
      //Encodage du site
      //-------------------------------------------------------  
      $encodage = _CHARSET;   //   'ISO-8859-1' ;//  //'ISO-8859-1' 'utf8' -  'windows-1252' - ...      
      $tl['encodage_xml'] = "<"."?xml version='1.0' encoding='{$encodage}'?".">";
      $tl['encodage_html'] = "<meta http-equiv='Content-Type' content='text/html; charset={$encodage}' />";      
      //-------------------------------------------------------

    }else{
        $tl[] = buildLetter_header ($idLettre, '', $fds, $mode, $rsLettre, $params);       
    }
  
  
    //------------------------------------------------------------------  
    // boucle de traitement des insertion dans la le ttre
    //------------------------------------------------------------------    
  
  
  $h = 0;
    
  while ($sqlfetch = $xoopsDB->fetchArray($sqlQuery)) {
    $idElement = $sqlfetch ['idElement'];
    $idItem    = $sqlfetch ['idItem'];
    $caption   = $sqlfetch ['nom'];
    
    $params ['idElement']   = $sqlfetch ['idElement'];
    $params ['idItem']      = $sqlfetch ['idItem'];    
    $params ['caption']     = $sqlfetch ['nom'];    
    $params ['miseEnForme'] = $sqlfetch ['miseEnForme'];
        
        
    $lineBefore = buildLetter_Line ($sqlfetch['lineBeforeWidth'], $sqlfetch['lineBeforeColor'], $mode);
         
    switch ($idElement){
    case _HER_EL_SYSTEM: //system (banner auto;;;)
      $block = buildLetter_system ($idItem, $params, $mode);    
      break;
      
    case _HER_EL_PLUGIN: //plugin
      $block = buildLetter_Plugin ($idItem, $params, $sqlfetch, $mode);
      break;

    case _HER_EL_TEXTE: //Texte
      $block = buildLetter_Texte ($idItem, $params, $mode);   
      break;  
           
    case _HER_EL_BANNIERE: //system (banner auto;;;)
      $block = getBannerCode($idItem);     
      break;

    case _HER_EL_FLUXRSS: //plugin
      $block = buildLetter_fluxrss ($idItem, $params, $sqlfetch, $mode);   
      break;  

    case _HER_EL_STYLE: //style
      $block = buildLetter_Style ($idItem, $params, $mode);   
      break;  

    case _HER_EL_DECO: //decoration
      $block = buildLetter_deco ($idItem, $params, $mode);   
      break;  
      
    default: //pas normal
      $block = buildLetter_pasNormal ($idItem, $params, $idElement);   
      break;  
      
    }
    //-------------------------------------------    
    $lineAfter = buildLetter_Line ($sqlfetch['lineAfterWidth'], $sqlfetch['lineAfterColor'], $mode);    
    
    //-------------------------------------------    
    if ($bTpl){
      if ($sqlfetch ['blockSmarty'] <> '') {
        $blockSmarty = $sqlfetch ['blockSmarty'];      
      }else{
        $blockSmarty = '';      
      }
    
      if (!isset($tl[$blockSmarty])) $tl[$blockSmarty] = '';  ;    

      $tl[$blockSmarty] .= $lineBefore.$block.$lineAfter."\n";    
      
      //test pour encodage utf8
      //$tl[$blockSmarty] .= "<hr> " . utf8_encode(" ééé èèè "). "<hr>";


    }else{
      $tl[] = $lineBefore.$block.$lineAfter."\n";    
    }
    
    //-------------------------------------------
    $h++;
    $block = '';
  }  
  //*************************************************
  
  if ($bTpl){
    // Start template class
    include_once XOOPS_ROOT_PATH.'/class/template.php';
    $tpl = new XoopsTpl();
    //--------------------------------------------------------
    // Assign smarty variables
    while(list($key, $item) = each($tl)){
      $tpl->assign($key,  $item);    
    }
     //-------------------------------------------------------- 
     buildLetter_template ($tpl, $params, $rsLettre, $mode);
     //--------------------------------------------------------  
     // Call template
     //$tpl->display($template);
     $template = _HER_ROOT_TEMPLATES.'letter/'.$rsLettre['tplBody'];
     $texte = $tpl->fetch($template);
      
  }else{
    $tl[] = buildLetter_footer ($idLettre, 0, $rsLettre);  
    $texte = implode (hermes_crlf, $tl);    
  }  

  //----------------------------------------------------------
  
    //$texte = replaceCodeInLetter($texte, $params);    
  //----------------------------------------------------------  
  
  
  if ($mode == _HER_SEND || $mode == _HER_SENDTEST){
    //$tf = getNameForLetter($idLettre, $rsLettre['nom'], $mode);
    $fileName = $tf [0];
    //$fileName = $params['fileNameArchive'];    
    $params['idArchive'] = saveArchive ($idLettre, $fileName, $tf[1], $mode);
    
    //$params['urlArchive'] = getUrlArchive($fileName, $rsLettre['cheminArchivage']); 
    //$params['urlArchiveLink'] = "<a href='{$params['urlArchive']}'>"._AD_HER_URL_ARCHIVE."</a>";
        
    $params['fullNameArchive'] =  getFulNameArchive($fileName, $rsLettre['cheminArchivage'] );  
    $texte = replaceCodeInLetter($texte, $params);
    //-------------------------------------------------------
    //$code = getCodeLecture($params);
    //$texte = str_replace("_____code_stat_____", $code, $texte);    
    //-------------------------------------------------------   
    saveNewLetter($params['fullNameArchive'], $texte );
    copy_statImg($params, $mode);
  //echo "<hr>sauvegarde<hr>";  
  }else{
      $params['idArchive'] = 0;  
  //echo "<hr>pas de sauvegarde<hr>";
      
      
    
    //-------------------------------------------------------
    //$code = getCodeLecture($params);    
    //$texte = str_replace("_____code_stat_____", $code, $texte);    
    //-------------------------------------------------------   
    $texte = replaceCodeInLetter($texte, $params);
  
  }


  //------------------------------------------
  
  //setNewStat($code, true);

  if ($xoopsModuleConfig['ModRegExp'] > 0){
    //$texte=replace_for_mod_rewrite($texte);      
    $texte = replace_for_tracking($texte, $xoopsModuleConfig['ModRegExp']);
  }
  
  $texte = replace_for_tracking($texte, $xoopsModuleConfig['ModRegExp']);  
  return $texte;

}

/**************************************************************************
 *
 **************************************************************************/
  
function replace_for_tracking($s, $mode = 0){  
    //include('../../../ModRegExp.php');  
    
    switch ($mode){
      //------------------------------------------------    
      case 1:
        $url = replace_for_mod_rewrite($s);      
        break;
      
      //------------------------------------------------
      case 2:
        //each urlin need a line in urlout
        $urlin = array("'(?<!//).html'",
                       "'(?<!//)/''"
                      );
    
        $urlout = array(".html?utm_source=newsletters&utm_medium=e-mail",
                        "/?utm_source=newsletters&utm_medium=e-mail'"
                       );
    
        $s = preg_replace($urlin, $urlout, $s);
        $url = replace_for_mod_rewrite($s);    
        break;
        
      //------------------------------------------------      
      default:
        $url = $s;      
        break;
        
    }
    
    return $url;
}




/**************************************************************************
 *
 **************************************************************************/
function buildLetter_template (&$tpl, $params, $rstLettre, $mode = 0){
global $xoopsConfig;  
  $idLettre = $rstLettre['idLettre'];
  $title =  $rstLettre['nom'];
  
  
  $fds = (($rstLettre['feuilleDeStyle'] == '') 
       ? $xoopsConfig['theme_set']
       : $rstLettre['feuilleDeStyle']);
  $fds = XOOPS_URL."/themes/{$fds}/style.css";  
  $fds = "<link rel='stylesheet' type='text/css' media='all' href='{$fds}' />"; 
  //-------------------------------------------------------------
  $tpl->assign('her_showTplName', 0);
  $tpl->assign('her_tplBody',     $rstLettre['tplBody']);
  $tpl->assign('her_tplHeader',   $rstLettre['tplHeader']);
  $tpl->assign('her_tplFooter',   $rstLettre['tplFooter']);  
  //------------------------------------------------------------- 
  $tpl->assign(_HER_SMARTY_SHEETSTYLE,  $fds);  
  $tpl->assign(_HER_SMARTY_COPYRIGHT,  _HER_COPYRIGHT);    
  $tpl->assign(_HER_SMARTY_TITLE, $rstLettre['nom'] );    
  
  
  $tpl->assign(_HER_SMARTY_TPLNAME, $rstLettre['tplBody'] );
  
  $tpl->assign(_HER_SMARTY_HEADER, _HER_ROOT_TEMPLATES.'letter/'.
                                    (($rstLettre['tplHeader'] == '') 
                                    ? 'header_standard.htm'
                                    : $rstLettre['tplHeader']));

  $tpl->assign(_HER_SMARTY_FOOTER, _HER_ROOT_TEMPLATES.'letter/'.
                                    (($rstLettre['tplFooter'] == '') 
                                    ? 'footer_standard.htm'
                                    : $rstLettre['tplFooter']));

  //$tpl->assign(_HER_SMARTY_HEADER, _HER_ROOT_TEMPLATES.'letter/header_standard.htm' );
  //$tpl->assign(_HER_SMARTY_FOOTER, _HER_ROOT_TEMPLATES.'letter/footer_standard.htm' );                           
 
 //--------------------------------------------------------  
  $tpl->assign(_HER_SMARTY_STAT,  buildLetter_body_stat ($params));  
  $tpl->assign(_HER_SMARTY_DESCRIPTION,  buildLetter_body_description ($idLettre,$title,$fds,$mode,$rstLettre,$params));
  $tpl->assign(_HER_SMARTY_AVERTISSEMENT,  buildLetter_body_avertissement ($rstLettre ,$params));      
  
  $PageWidth = (($rstLettre['pageWidth'] == '') ? '100%' : $rstLettre['pageWidth']);
  $tpl->assign('her_pageWidth', $PageWidth);      

  $bg =  buildLetter_body_background ($rstLettre, $params);  
  $tpl->assign('her_background',   $bg);



}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_header ($idLettre, 
                             $title = '', 
                             $fds ='', 
                             $mode = 0, 
                             $rstLettre = '',
                             $params){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
//displayArray8($rstLettre, "----- buildLetter_header -----");  
  $encodage = _CHARSET;   //   'ISO-8859-1' ;//  //'ISO-8859-1' 'utf8' -  'windows-1252' - ...
  $testEncodage = false;
  //echo "<hr>Encodage : {$encodage}<hr>";
  
  $t = array();  
  
  //------------------------------------------------------------------
  $version = $xoopsModule->getVar('version')/100;
  switch ($mode){     
    case _HER_TEST:
      $t[] = "Lettre de test - Test letter (Hermes version {$version} )\n<br>";
      break;
    case _HER_PREVIEW:
      $t[] = "mode {$mode} - Lettre de test - Test letter (Hermes version {$version} )\n<br>";
      break;
    case _HER_SEND:
      break;    
    case _HER_SENDTEST:
      $t[] = "Envoi de test - Sending test (Hermes version {$version})\n<br>";
      break;
    default:
      $t[] = "??? (Hermes version {$version} )\n<br>";
      break;
  }  
  //------------------------------------------------------------------
  //teste d'avertissement pour ceux qui recvent en mode texte
  //------------------------------------------------------------------  
  $t[] = buildLetter_body_avertissement ($rstLettre,$params);
  /*

  if (($rstLettre['avertissement'] <> '') & (isBitOk(3,$rstLettre['affichage']) == 1)){
    $t[] = $rstLettre['avertissement']."\n";  
  }
  */
  //------------------------------------------------------------------
  $t[] = "<"."?xml version='1.0' encoding='{$encodage}'?".">";
  $t[] = "<html>";
  $t[] = "<head>";
  
  //------------------------------------------------------- 
  //Encodage du site
  //-------------------------------------------------------  
  $t[] = "<meta http-equiv='Content-Type' content='text/html; charset={$encodage}' />";      
  //-------------------------------------------------------

  $t[] = "<title>{$title}</title>";  
  
  $fds = (($rstLettre['feuilleDeStyle'] == '')?$xoopsConfig['theme_set']:$rstLettre['feuilleDeStyle']);
  $fds = XOOPS_URL."/themes/{$fds}/style.css";  
  $t[] = "<link rel='stylesheet' type='text/css' media='all' href='{$fds}' />"; 
  
  
  //Ajout des adresse de syndication
  $sqlquery = db_getLetterSyndication($idLettre);
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    $prefixe = 'http://';
    $url =((substr($sqlfetch['url'],strlen($prefixe))=='$prefixe')?'': $prefixe)
         . $sqlfetch['url'];
    //$url = $sqlfetch['url'];
    //echo "<hr>{$url}<hr>";
    $t[] = "<link rel=\"alternate\" type=\"application/rss+xml\"  title=\"{$sqlfetch['description']}\" href=\"{$url}\" />";          
  }
   

  
  //---------------------------------------------------------    
  $t[] = "</head>";
  //---------------------------------------------------------  
  // body builder   (;-)
  //---------------------------------------------------------
  
  
  $bg='';
  $style="";
  /*  
  if ( $rstLettre['bgImg'] <> '' ){
    $ts = array();
    $f = $folder = _HER_URL."ressources/{$rstLettre['bgImg']}";
    $ts [] = "background-image:url({$f})";
    
    $tAt = array('fixed' , 'scroll');
    $ts [] = "background-attachment:".$tAt [$rstLettre['bgImgMode']] ;
    
    $tAt = array('no-repeat' , 'repeat-x repeat-y', 'repeat-x', 'repeat-y');
    //$ts [] =  "background-repeat: ".$tAt [$rstLettre['bgImgReapeat']] ;
    
    $tAt = array('left' , 'center', 'right'); $posx = $tAt [$rstLettre['bgImgPosH']];
    $tAt = array('top' , 'center', 'bottom'); $posy = $tAt [$rstLettre['bgImgPosV']];    
    $ts [] =  "background-position: {$posx} {$posy}" ;
    
    $at = implode (";", $ts);
    $bg = " style='{$at};'";  
    
    
    //$bg = " background=\"{$f}\" bgproperties=\"fixed\"";
    //$bg = " style='background-image:url({$f});background-attachment:fixed;'";    
    
  }else{
    $bg =  (isset($rstLettre['background']))?"style='background:#{$rstLettre['background']};'":'';  
  }

  */
  $bg =  buildLetter_body_background ($rstLettre, $params);
  //-------------------------------------------------------------------
  $strTestEncodage = "<hr><table {$bg}  border='2'> <tr><td>Test encodage "
                  .  utf8_encode (" é è à ê ") 
                   . "</td></tr></table><hr>\n";
  
  if ( $rstLettre['pageWidth'] == '' ){
    $t[] = "<body>\n";

    if ($testEncodage) $t[] = $strTestEncodage;
    
    $t[] = "<table {$style} {$bg} ><tr><td>\n";  
    $t[] = "<p align=\"center\"> \n";    
    //$endPage = "</table></td></tr></body>";    
  }else{
    $st2 = "style='width:{$rstLettre['pageWidth']};padding: 0'\n";    
    
    $t[] = "<body {$bg}>\n";
    
    if ($testEncodage) $t[] = $strTestEncodage;
    
    
    //$t[] = "<table {$bg}  border='12'> <tr><td>";    
    $t[] = "<table {$bg}  border='0'> <tr><td>\n";    
    //$t[] = "{$bg}</td></tr><tr><td>";    
    $t[] = "<p align=\"center\">\n";    
    
    
    
    $t[] = "<table  $st2  border='0' ><tr><td>\n";
    //$endPage = "</p></body>";
  }  


  
  //---------------------------------------------------------------
  $t[] = "<div align='center'><table >";  
  
  //-------------------------------------------------------  
  // statistique de lecture
  //-------------------------------------------------------
  $t[] = buildLetter_body_stat ($params, false);
  /*

  if ($params['statLecture'] > 0){
    $align = choose ($params['statImgAlign'], array('left','center','right'));
    
    $t[] = "<tr><td align='{$align}'>";  
    $t[] = buildUrlCodeStat(true);
  }
  $t[] = "</td></tr>"; 
  */  
  

  //------------------------------------------------------- 
  //test de description de la lettr
  //-------------------------------------------------------  
  $t[] = buildLetter_body_description ($idLettre,$title,$fds,$mode,$rstLettre,$params);   
  //-------------------------------------------------------
  
  
  $t[] = "</table></div>";  

  //----------------------------------------------
  return implode(hermes_crlf, $t);
      
}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_body_background ($rstLettre, $params){


  if ( $rstLettre['bgImg'] <> '' ){
    $ts = array();
    $f = $folder = _HER_URL."ressources/{$rstLettre['bgImg']}";
    $ts [] = "background-image:url({$f})";
    
    $tAt = array('fixed' , 'scroll');
    $ts [] = "background-attachment:".$tAt [$rstLettre['bgImgMode']] ;
    
    $tAt = array('no-repeat' , 'repeat-x repeat-y', 'repeat-x', 'repeat-y');
    //$ts [] =  "background-repeat: ".$tAt [$rstLettre['bgImgReapeat']] ;
    
    $tAt = array('left' , 'center', 'right'); $posx = $tAt [$rstLettre['bgImgPosH']];
    $tAt = array('top' , 'center', 'bottom'); $posy = $tAt [$rstLettre['bgImgPosV']];    
    $ts [] =  "background-position: {$posx} {$posy}" ;
    
    $at = implode (";", $ts);
    $bg = " style='{$at};'";  
    
    //$bg = " background=\"{$f}\" bgproperties=\"fixed\"";
    //$bg = " style='background-image:url({$f});background-attachment:fixed;'";    
    
  }else{
    $bg =  (isset($rstLettre['background']))?"style='background:#{$rstLettre['background']};'":'';  
  }
  
  return $bg; 
}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_body_stat ($params, $encapsuler = true){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  $t = array();
  
  if ($params['statLecture'] > 0){
    $align = choose ($params['statImgAlign'], array('left','center','right'));
    
    if ($encapsuler) $t[] = "<table border='0'><tr><td align='{$align}'>";  
    $t[] = buildUrlCodeStat(true);
    if ($encapsuler) $t[] = "</td></tr></table>";    
  }
 
  
  return implode(hermes_crlf, $t);
}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_body_avertissement ($rstLettre,$params){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  //her_displayArray($rstLettre,"----- buildLetter_body_avertissement -----");
  
  $t = array();
  if (($rstLettre['avertissement'] <> '') & (isBitOk(3,$rstLettre['affichage']) == 1)){
    $t[] = $rstLettre['avertissement']."\n";  
  }

  return implode(hermes_crlf, $t);
}


/**************************************************************************
 *
 **************************************************************************/
function buildLetter_body_description ($idLettre, 
                             $title = '', 
                             $fds ='', 
                             $mode = 0, 
                             $rstLettre = '',
                             $params){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  $myts       = & MyTextSanitizer::getInstance();
  $t = array();
  
  if ($rstLettre['idFrame'] == 0 ){
   /*
   */   
        if (isBitOk(0,$rstLettre['affichage']) == 1){
          $style = $xoopsModuleConfig['style_Caption'];
          $t[] = "<tr>";
          $t[] = "   <td class='{$style}' align='center'>{$rstLettre['nom']}</td>";
          $t[] = "</tr>";
          $ok = true;  
        
        }
      
        if (isBitOk(1,$rstLettre['affichage']) == 1){
          $style = $xoopsModuleConfig['style_TexteNom'];
          $t[] = "<tr>";
          $t[] = "   <td class='{$style}' align='center'>{$rstLettre['libelle']}</td>";
          $t[] = "</tr>";
          $ok = true;  
        
        }
      
        $myts =& MyTextSanitizer::getInstance();
        $txt = $myts->previewTarea($rstLettre['description'],1,0,0,0,0);
        if (isBitOk(2,$rstLettre['affichage']) == 1){
          $style = $xoopsModuleConfig['style_TexteContent'];
          $t[] = "<tr>";
          $t[] = "   <td class='{$style}' align='center'>{$txt}</td>";
          $t[] = "</tr>";
          $ok = true;  
        
        }
      

        //$t[] = $endPage;
  }else{
      $ok = false;
      $nom = '';
      $caption = '';
      $content = '';
      //--------------------------------------------------
      if (isBitOk(0,$rstLettre['affichage']) == 1){
        $nom = $rstLettre['nom']; 
        $ok = true;
      }
      if (isBitOk(1,$rstLettre['affichage']) == 1){
        $caption = $rstLettre['libelle']; 
        $ok = true;
      }
      if (isBitOk(2,$rstLettre['affichage']) == 1){
        $content = $myts->previewTarea($rstLettre['description'],1,0,0,0,0); 
        $ok = true;
      }
      
      if ($ok){
        $adoFrame = new cls_hermes_deco();
          $tFrame = $adoFrame->getPPValues($rstLettre['idFrame']);
          
          $t[] = "<tr><td>";
          $t[] = format_texte ($caption, $nom, $content, $rstLettre['affichage'], $tFrame);   
          $t[] = "</td></tr>";
      }

   }
  
  //---------------------------------------------------------------------
  if ($ok){
    $r = implode(hermes_crlf, $t); 
    return  "<table border='0'>{$r}</table>";
  }else{
    return  "";  
  }
 
  
}
/**************************************************************************
 *
 **************************************************************************/
function buildLetter_footer ($idLettre, $mode = 0, $rstLettre){
  $t = array();
  if ( $rstLettre['pageWidth'] == '' ){
    $t[] = "</p></td></tr></table>";  
    
  }else{
    $t[] = "</td></tr></table></p> </td></tr></table>";
  }  
  
  //$t[] = "</body>";
  $t[] = "</body></html>";

  return implode (hermes_crlf, $t);


}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_system($idSystem, $params, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;  

    $t = array ();
         
    switch ($idSystem){

    case 1:
      $t [] = getBannerRandom();
      $ok = true;
      break;

    case 2:
      //$t[] = "<hr style='color: blue; background-color: red; height: 10px; border: 0;'>";
      //$t[] = "<hr>";      
      $ok = true;      
      break;       

    case 3: //system (fichiers lies)
      $t[] = buildLetter_FilesLinked($params['idLettre'], $params, $mode);   
      $ok = true;        
      break;
      

    case 99:
      // a definir ...
      break;       
      
    }
  //---------------------------------------------------  

  if ($ok) {
    $texte = implode (hermes_crlf, $t);  
  }else{
    $texte = "";  
  }
  
  return $texte;

 

}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_FilesLinked($idLettre, &$params, $mode){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //if ($mode = 2) return '';  
  
  //si cest ne prévisualisation on cre pas les copy ni le sous dossier
  //on pointer sur les originaux
  $ok = ($mode == _HER_SEND OR $mode == _HER_SENDTEST);
  //------------------------------------------------------------------
  /* 
  $fullName = getFulNameArchive($params['archiveName'], $params['cheminArchivage'] );
  //hecho ($params['archiveName'], 'nom');  
  //hecho ($params['archivePath'], 'path');  
  //hecho ($fullName, 'ficher archive');  
  
  
  if ($ok){
      $dir = dirname($fullName);  
      $f = basename($fullName, '.html');
      
      $folderTo = $dir.'/'.$f.'/';
//      echo "<hr>buildLetter_FilesLinked<br>$folderTo<hr>";
      //hecho ($folderTo, 'dosier de destination');
      @mkdir ($folderTo, 0755);
  
  }

  */
  if (!isset($params['folderRessource'])) {  
  //if ($params['folderRessource'] == '') {
    //$params['folderRessource'] = createFolderRessource($params, $mode); 
    createFolderRessource($params, $mode);     
  }
  $folderTo = $params['folderRessource'];    

  $sqlQuery = db_getPieces($idLettre);
  //hecho($idLettre , 'idLEttre');
  if  ($xoopsDB->getRowsNum($sqlQuery) == 0 ) return '';
  $t = array();  
  $t[] = '<table>';
  
  $style1 = $xoopsModuleConfig['style_pluginNom'];  
  $style3 = $xoopsModuleConfig['style_pluginFirstColone'];  
    
    $caption = (($params['caption'] == '')?_AD_HER_PEACES_JOIN:$params['caption']);
    $t[] = '<tr>';
    $t[] = "<td class='{$style1}'>{$caption}</td>";      
    $t[] = '</tr>';  
  
  
  
  
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlQuery)) {
    $t[] = '<tr>';
       
    
    if ($ok AND $sqlfetch['state'] == 1){    
      $f = $folderTo.basename($sqlfetch['nomFichier']);
      
       //hecho ($sqlfetch['nomFichier'], 'source');    
       //hecho ($f, 'destination');    
       
      copy($sqlfetch['nomFichier'],$f);
      
      $url = str_replace(addSlash(XOOPS_ROOT_PATH),addSlash(XOOPS_URL) , $f); 
      //echo "<hr>$url<hr>";
      $lib = (($sqlfetch['libelle'] == '') ? $url : $sqlfetch['libelle']);    
      $link = "<a href='{$url}' target=blank>{$lib}</a>";    

    }else{
      $url = str_replace(addSlash(XOOPS_ROOT_PATH), addSlash(XOOPS_URL), $sqlfetch['nomFichier']);
      //echo "<hr>".XOOPS_ROOT_PATH."<br>".XOOPS_URL."<br>$url<hr>";      
        
      $lib = (($sqlfetch['libelle'] == '') ? $url : $sqlfetch['libelle']);        
      $link = "<a href='{$url}' target=blank>{$lib}</a>";    
    }

    $t[] = "<td class='{$style3}'>{$link}</td>";
    $t[] = '</tr>';  
  }
  $t[] = '</table>';
  
  
  return implode ('', $t);  
  //return "<table><hr><td><OOOOOOOOOOOOOOOOOOOOOOO/td></hr></table>";
}

/**************************************************************************
 *
 **************************************************************************/
function copy_statImg(&$params, $mode){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  $ok = ($mode == _HER_SEND OR $mode == _HER_SENDTEST);
  //------------------------------------------------------------------
  if ($params['folderRessource'] == '') {
    $params['folderRessource'] = createFolderRessource($params, $mode);  
  }
  $folderTo = $params['folderRessource'];    
  //-------------------------------------------------
  if ($params['statImg0'] == '')  $params['statImg0'] = 'statImg1px.gif';
  if ($params['statImg1'] == '')  $params['statImg1'] = $params['statImg0'];  
  
  $name0 = _HER_ROOT_PATH.'images/'.$params['statImg0'];
  $name1 = _HER_ROOT_PATH.'images/'.$params['statImg1'];  
  $folderTo = $params['folderRessource'];    

  //copy($name0, $folderTo.baseName($name0));  
  //copy($name1, $folderTo.baseName($name1));       
  
  copy($name0, $folderTo.'statImg0.gif');  
  copy($name1, $folderTo.'statImg1.gif');       
  
  return true;  
  //return "<table><hr><td><OOOOOOOOOOOOOOOOOOOOOOO/td></hr></table>";
}

/**************************************************************************
 *
 **************************************************************************/
function createFolderRessource(&$params, $mode){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
//  echo "<hr>createFolderRessource<hr>";
  //if ($mode = 2) return '';  
  
  //si cest ne prévisualisation on cre pas les copy ni le sous dossier
  //on pointer sur les originaux
  $ok = ($mode == _HER_SEND || $mode == _HER_SENDTEST);
  //------------------------------------------------------------------
  
  $fullName = getFulNameArchive($params['archiveName'], $params['cheminArchivage'] );
  //hecho ($params['archiveName'], 'nom');  
  //hecho ($params['archivePath'], 'path');  
  //hecho ($fullName, 'ficher archive');  
  
  if ($ok){
      $dir = dirname($fullName);  
      $f = basename($fullName, '.html');
      
      $folderTo = $dir.'/'.$f.'/';
//      echo "<hr>buildLetter_FilesLinked<br>$folderTo<hr>";
//      hecho ($folderTo, 'dosier de destination');
      if (!is_dir($folderTo)) {
        @mkdir ($folderTo, 0777);      
      }

  
  }else $folderTo = '';
  
  $params['folderRessource'] = $folderTo; 
  return $folderTo;
}
/**************************************************************************
 *
 **************************************************************************/
function buildLetter_fluxrss ($idFluxrss, $params, $structure, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;  
  
  $idPlugin = db_getIdPluginsByName('fluxrss/fluxrss.php');
  $adoFluxRSS = new cls_hermes_fluxRSS();  
  $params = array_merge($params, $adoFluxRSS->getArray($idFluxrss)); 
  //$params['fluxInterne'] =1;
  
  
  $params['template'] = '';  
  $params['optionsAffichage'] = 255;  
 
  //displayArray($params,"----- buildLetter_fluxrss -----");
  
  //$params['caption'] = $params['rss']['nom'];
  //$params['nom']     = $params['rss']['description'];  
  
/*
  $params['caption'] = $params['rss']['nom']."<br>"
                      .$params['rss']['description'];  


*/                      
  //echo "<hr>caption<br>{$params['caption']}<hr>";
  $texte = buildLetter_plugin ($idPlugin, $params, $structure, $mode); 


  
  //---------------------------------
  return $texte;
}


/**************************************************************************
 *
 **************************************************************************/
function buildLetter_plugin ($idPlugin, $params, $structure, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;  

  $rstPlugin = $xoopsDB->fetchArray(db_getPlugins($idPlugin));
  //$optionsAffichage = $rstPlugin['affichage'];
  //displayArray($rstPlugin,"***********{$idPlugin}**{$rstPlugin['nom']}***********");
  //liste de params a passer a l'instance de l'la classe  
  //displayArray($structure,"*********** buildLetter_plugin - structure ***********");  
  
  
  //---------------------------------------------------------------
  $rstParams   = db_getPluginParams($idPlugin, $nbParams, $structure['idStructure']);  
  //displayArray($rstParams,"*********** buildLetter_plugin - rstParams ***********"); 
  /*
  $rstParams   = db_getPluginParams($idPlugin,$nbParams, );  
  */
  
  
 
  //$params = array();
  while($sqlfetch = $xoopsDB->fetchArray($rstParams)){
    //le if est pour les flux rss en provenance de la table(a etidier s'il faut garder cette table)
    //qqui ont deja rempli la table params, il ne faut donc pas les ecraser
    if (!isset($params [$sqlfetch['nom']])){
        $params [$sqlfetch['nom']] = $sqlfetch['valeur'];  
    }
  
  }
  //displayArray($params ,"*********** buildLetter_plugin - params ***********");  
  /*

  //recupe des parametres personalisé de la structure
  //et remplacemnent des valeurs globale du plugin
  if ($structure['params'] <>''){
    $t = explode(';', $structure['params']);
    for ($h = 0; $h < count($t); $h++){
      $item = explode('=', $t[$h]);
       $params [trim($item[0])] = trim($item[1]);       
    }
  }
  */  
  
  $template = trim((isset($params ['template'])) ? $params ['template'] : '');   
  $optionsAffichage = ((isset($params ['optionsAffichage'])) ? $params ['optionsAffichage'] : 127);
  //echo "<hr>{$template}<hr>";
  
 $opa_module     = 0;
 $opa_nom        = 1;
 $opa_entete     = 2;
 $opa_detail     = 3;
 $opa_pied       = 4;
 $opa_titreColonnes = 5;
 $opa_categorie     = 6; 
  //echo "<hr>optionsAffichage = {$optionsAffichage}<br>template = {$template}<hr>"; 
  

  //displayArray($params,"***********{$idPlugin}**{$rstPlugin['nom']}***********");




  
  //displayArray($params,"----- buildLetter_plugin -----");  
  //displayArray($rstPlugin,"---plugin-");
  /*

  //liste de params a passer a l'instance de l'la classe
  $obParams = array('periode' => $rstPlugin['periode'],
                    'maxItem' => $rstPlugin['maxItem']);
  */  
  
  $folder = _HER_ROOT_PATH."plugins/";
  $fileName = $rstPlugin['nomFichier'];
  
  //echo 'idPlugin -> '.$idPlugin.'<br>'; 
  //echo "plugin include --{$idPlugin}----> ".$fileName.'***'.$rstPlugin['nomFichier'].'<br>';

  $fulName = $folder.$fileName;
  if (!is_readable($fulName)){ return'';}
  include_Once ($fulName);
  $langFile = getLanguageFile($fulName);
  $nomClasse = 'cls_'.extractFileNameFromFullName($fileName);
  //echo "nom de la classe : {$nomClasse}<hr>";  
  $ob = new $nomClasse(array('lang' => $langFile, 'jjd' => 'JÝJÝD'), $mode);
  //echo 'nom de la classe : '.get_class($ob).'<hr>';    


  $ob->getInfoPluggin($tProperty, $initParams);
    $sName        = string2sql($tProperty['name']);
    $sDescription = string2sql($tProperty['description']);
    $sModule      = string2sql($tProperty['module']);
    $sVersion     = string2sql($tProperty['version']);
    $identifiant  = string2sql($tProperty['identifiant']);    
  
  
//  displayArray($params,"----- buildLetter_plugin -----");  
  //$cm = get_class_methods($ob); 
  //displayArray($cm,"--méthodes de la clase {$nomClasse}--");  
  //$template= ($rstPlugin['template'] :
  //if ($template <> '' & method_exists($nomClasse, 'getInfoTemplate')){    
  if ($template <> ''){
      //verifie si c'est un templae generique 
        $template = _HER_ROOT_PLUGINS.$template; 
             
      /*

      if(sustr(0,str_len(_HER_PREFIXE_TEMPLATE)) == _HER_PREFIXE_TEMPLATE) {
        $template = _HER_ROOT_TEMPLATES.'/'.$rstPlugin['template'];      
      }else{
        $template = dirname(_HER_ROOT_PLUGINS.$rstPlugin['nomFichier']).'/'.$rstPlugin['template'];      
      }
      */
      //echo "<hr>buildLetter_plugin<br>{$template}<hr>";
      return $ob->getInfoTemplate($template, $params, $tProperty, $tInfo , $colName, $mode, $structure);

      
      //if ($ob->getInfoTemplate($template, $params, $tProperty, $tInfo , $colName, $mode) == 0){ 
      //  return '';      
      //} 
  }else if (method_exists($nomClasse, 'getLastInfoHTML') AND ($params['miseEnForme'] == 1)){  
      if ($ob->getLastInfoHTML($params, $tProperty, $tInfo, $colName, $mode) == 0){  
        return '';  
      }else{
          if (is_array($tInfo)){
              $texte = implode (hermes_crlf, $tInfo);  
              return $texte;
          
          }else{
              return $tInfo;          
          }
      }
      
  }else{
      if ($ob->getLastInfo($params, $tProperty, $tInfo , $colName, $mode) == 0){
        return '';
      }    
  
  }  
    
    $sHeader = $tProperty['header'];
    $sFooter = $tProperty['footer'];
    $version = $tProperty['version'];  
    
    //-----------------------------------------------------------
    //echo "sName        = {$sName}<br>";    
    //echo "sDescription = {$sDescription}<br>";    
    //echo "sModule      = {$sModule}<br>";  
    //$sDescription = str_replace("'", "''", $sDescription);
    //---------------------------------------------------------------------    
  $ok = false;  
  $t = array();
  //------------------------------------
  //la il y a un probleme a traiter
  if (isBitOk($opa_detail ,$optionsAffichage) == 1){  
  }  
      $style1 = $xoopsModuleConfig['style_pluginColTitles'];
      $style3 = $xoopsModuleConfig['style_pluginFirstColone'];
      $style4 = $xoopsModuleConfig['style_pluginLastColone'];    
      $style5 = $xoopsModuleConfig['style_pluginOtherColones'];

  //------------------------------------      
  $bRupture = ($colName == '');
  //------------------------------------  
      if ($bRupture){
        //displayArray($rstPlugin,"***********{$idPlugin}**{$rstPlugin['nom']}***********");
          $colName = array();
          //echo "<hr>Traitement du tableau tInfo<hr>";      
          //reset($tInfo["k-1"]);
          //displayArray($tInfo[0], "***** tInfo['k-1'] *****");
          while (list($key, $val) = each($tInfo[0])) {
            if ($val['order'] > 0){          
              $colName[] = $val['name']."<br>";
            }              
        }
      } 
      
      if(!isset($params ['show_title'])) $params ['show_title']=1;
      if(!isset($params ['show_categorie'])) $params ['show_categorie']=1;      
      //---------------------------------------------
      //Preparation des ligne de titre des colonnes      
      //---------------------------------------------      

      $tHead = array();      
      $tHead[] = "<tr>";      
      /*
        for ($i = 0; $i < count($colName); $i++){
          $t[] = "  <td class='{$style1}' align='center'><b>{$colName[$i]}</b></td>"; 
        }      
      
      */

      for ($i = 0; $i < count($colName); $i++){
        $tHead[] = "  <td class='{$style1}' align='center'><b>{$colName[$i]}</b></td>"; 
      } 
      $tHead[] = "</tr>";           
      $colHead = implode ("\n", $tHead);
      $colSpan = count ($colName);  
      //---------------------------------------------      
    $t[] = "<table   class='{$style1}' width='100%'>";
    $endTable =  "</table>";        
 
  //------------------------------------------------------------------
  if (isBitOk($opa_module ,$optionsAffichage) == 1){
    $style = $xoopsModuleConfig['style_Caption'];
    $t[] = "<tr>";
    $t[] = "   <td colspan='{$colSpan}' class='{$style}' align='center'>{$params['caption']}</td>";
    $t[] = "</tr>";
    $ok = true;  
  
  }


  if (isBitOk($opa_nom ,$optionsAffichage) == 1){
    $style = $xoopsModuleConfig['style_pluginNom'];  
    $t[] = "<tr>";
    $t[] = "   <td colspan='{$colSpan}' class='{$style}' align='center'>{$rstPlugin['nom']}</td>";
    $t[] = "</tr>";
    $ok = true;  
  
  }
  
  if (isBitOk($opa_entete ,$optionsAffichage) == 1){
    $style = $xoopsModuleConfig['style_pluginHeader'];  
    $t[] = "<tr>";
    $t[] = "   <td colspan='{$colSpan}' class='{$style}' align='center'>{$sHeader}</td>";
    $t[] = "</tr>";
    $ok = true;  
  
  }
    
      if (!$bRupture & $params ['show_title']==1){
          $t[] = $colHead;      
      }

  
  
      //---------------------------------------------      
     
      //displayArray($tInfo,"---{$rstPlugin['nom']}---");      
      //---------------------------------------------  
    //while (list($key, $item) = each($tInfo))
    
    reset($tInfo);
    $rupture = 0;
    
    //if ($params['affichage'] == 0 (isBitOk($opa_categorie ,$optionsAffichage) == 0)    
    if (!isset($params['ruptureMaitre'])) $params['ruptureMaitre']=0;
    if (($params['ruptureMaitre'] == 0 )
      & (isBitOk($opa_titreColonnes ,$optionsAffichage) == 1)) 
        $t[] = $colHead;    
        
    while (list($key, $tItem) = each($tInfo)) {
      $t[] = "<tr>";    
      //--------------------------------------------------------------
      if (isset($tItem [_HER_CODE_RUPTURE])  & ($params['ruptureMaitre'] == 1)){
        $tr = $tItem [_HER_CODE_RUPTURE];
          if (($tr['rupture'] > 0 | $rupture == 0) & ($tr['rupture'] <> $rupture)){
            $rupture = $tr['rupture'];
            $style = $xoopsModuleConfig['style_pluginHeader'];  
            $t[] = "<tr>";
            $t[] = "   <td colspan='{$colSpan}' class='{$style}' align='center'><hr></td>";
            $t[] = "</tr>";
            $t[] = "<tr>";
            $t[] = "   <td colspan='{$colSpan}' class='{$style}' align='center'>{$tr['value']}</td>";
            $t[] = "</tr>";
            if ((isBitOk($opa_titreColonnes ,$optionsAffichage) == 1)) $t[] = $colHead;          
          }      
      
      }
      //--------------------------------------------------------------

      //displayArray($tItem,"---detail---");
      
       /*      
      for ($i = 0; $i < count($tItem); $i++){
        $t[] = "  <td class='odd'>{$tItem[$i]}</td>"; 
      }      
      */     
       
      reset($tItem);
      $j = 0;
      $k = count ($tItem) - 1;
      
      while (list($key, $val) = each($tItem)) {
        //-------------------------------------------------
        
        if (is_array ($val)) {  
          if (intval($val['order']) == 0){continue;}       
          $v =  $val['value'];
        }else{
          $v = $val;        
        }
            

        //-------------------------------------------------
        //echo "$key => $val\n";
        //$Line = $val; //$tItem[$skey]; 
        if ($j == 0){
          $style = $style3;        
        }elseif ($j == $k & $k > 2) {
           $style = $style4;       
        }else{
          $style = $style5;        
        } 
        
        //$style = ($j == 0)?'even':'odd';
        $t[] = "  <td class='{$style}'>{$v}</td>";        
        $j++;          
      }
      
      
      $t[] = "</tr>";
      //---------------------------------------------      
    }
    $ok = true;

  if (isBitOk($opa_pied ,$optionsAffichage) == 1){  
    $style = $xoopsModuleConfig['style_pluginFooter'];  
    $t[] = "<tr>";  
    $t[] = "  <td colspan='{$colSpan}' class='{$style}'>{$sFooter}</td>"; 
    $t[] = "</tr>";  
    $ok = true;
  }
    
  $t[] = $endTable; 
  
  //---------------------------------------------  
  if ($ok) {
    $texte = implode (hermes_crlf, $t);  
  }else{
    $texte = "";  
  }



  //echo "<hr>{$texte}<hr>";  
  //displayArray($params,"-------------------------");
  $idDeco = intval($params['frame']);  
  if ($idDeco <> 0){
    //$texte = "hello world";
    $tFrame = getDecoFrame($idDeco, '');
    //$texte format_texte ($caption, $nom, $text, $affichage, $tStyle){
    $texte = format_texte ('', '', $texte, 4, $tFrame, false);
  }

  return $texte;
  


  

}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_Texte ($idTexte, $params, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  

  $adoTexte = new cls_hermes_texte();
  $rst = $adoTexte->getArray($idTexte);  
  
  $caption   = $params['caption'];
  $affichage = $rst['affichage'];
  $myts      =& MyTextSanitizer::getInstance(); 
  $content   = $myts->previewTarea($rst['texte'],1,0,0,0,0);  
  
  if ($rst['idFrame'] == 0 ){
    $tFrame = $rst ; //les champs portent les memes noms
     $nom = $rst['nom'];    
  }else{
     /*

     $adoFrame = new cls_hermes_frame();
     $tFrame = $adoFrame->getArray($rst['idFrame']);
     */     

     $adoFrame = new cls_hermes_deco();
     $tDeco = $adoFrame->getArray($rst['idFrame']);
     $tFrame = $adoFrame->getPPValues($rst['idFrame']);
//her_displayArray($tFrame,"-------------- buildLetter_Texte --------------------");
     $nom = $tDeco['name'];     
  }
  //her_displayArray($tFrame,"----- format_texte -----");  
  $texte = format_texte ($caption, $nom, $content, $affichage, $tFrame);  
  
  

  //----------------------------------------------
  return $texte;

  

}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_pasNormal ($idItem, $params, $codeElement = 0){
  
  $t = array();
  
  $t[] = "<table border='1'>";
  $t[] = "<td><tr>";
  $t[] = "<b>Cas non traité : idElement = {$idElement} | idItem = {$idItem}</b>";  
  $t[] = "</td></tr>";    
  $t[] = "</table>";  
  //------------------------------------------
  $r = implode("\n", $t); 
  return $r; 
}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_deco ($idDeco, $params, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //her_displayArray($params,"----- buildLetter_deco -----");
  $daoDeco = new cls_hermes_deco();
  $rst = $daoDeco->getArray($idDeco);  
  $tpp = $daoDeco->getPPValues($idDeco);
//displayArray($tpp,"---------------------------");  
  
    $texte = 'Test de modèle de cadre';
    
    $caption   = "";
    $nom       = "";
    $texte     = "";
    $affichage = 255;    
  
  //------------------------------------------------------------
  $clName = 'cls_deco_' . strtolower( ($rst['decoModele']));
  $f = _HER_ROOT_PATH.'decorations/'.$clName.'.php';
  include_once($f);
  //echo "<hr>{$f}<hr>";
  $obDeco = new $clName();
  
  $options = array('caption'   => $params['caption'],
                   'nom'       => $nom,
                   'texte'     => $texte,
                   'affichage' => $affichage
                   );
                 
  $texte = $obDeco->getTexte($tpp, $options);



  //--------------------------------------------------------  
  return $texte;



}

/**************************************************************************
 *
 **************************************************************************/

function getStyleValDefault($key, $t, $exp, $default = ''){
  if (!isset($t[$key])) return $default;
  if ($t[$key] == '') return $default; 
  return sprintf($exp, $t[$key]);
}


/**************************************************************************
 *
 **************************************************************************/
function format_texte ($caption, $nom, $content, $affichage, $tStyle, $bSanitise = true){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //if (!isset($tStyle['bgColor'])) echo "<hr>{$caption}<br>{$content}<hr>";
  //displayArray($tStyle,"----- format_texte {$caption}-{$nom}-----");
  $ok = false;
  $t = array();
  //$t[] = "<div class='item'>";
  
  //$bgc = ($rst['bgColor'] == '')?'':"bgcolor='{$rst['bgColor']}'";

  //-------------------------------------------------------------------
  //$ts = array();
  $bgc = getStyleValDefault ('bgColor', $tStyle, " style='background-color:#%1\$s;' ");
  $border = getStyleValDefault ('borderWidth', $tStyle, "border='%1\$spx'");  
  $bcl = getStyleValDefault ('borderColorLight', $tStyle, "bordercolorlight='#%1\$s'");  
  $bcd = getStyleValDefault ('borderColorDark', $tStyle, "bordercolordark='#%1\$s'");  
  $wc = getStyleValDefault ('width', $tStyle, "width='%1\$s'");  
  $al = getStyleValDefault ('alignement', $tStyle, "%1\$s", 'left');  
  $style = getStyleValDefault ('width', $tStyle, "width:%1\$s; margin: 5;");  
  $nbi = intval(getStyleValDefault ('incrustation', $tStyle, "%1\$s", 0));  
  //$style = "width:{$tw};";  

  
    //$t[] = "<table {$border} {$bcl} {$bcd}><tr width='50%'><td>";
    //$style = "width: 50%; margin: 5; padding: 5; font-size: small";
 
    
  $t[] = "<div style='none'  {$wc} align={$al}>";       
 
 $t[] = "<table {$bgc} {$border} {$bcl} {$bcd} {$wc}>"; 
  
  if ($nbi > 0 ){
     for ($h = 0; $h < $nbi; $h++){
        $t[] = "<tr><td><table {$bgc} {$border} {$bcl} {$bcd} width='100%'>";    
     }
  
  }elseif ($nbi < 0 ){
     $bcli = "bordercolordark='#{$tStyle['borderColorLight']}'";
     $bcdi = "bordercolorlight='#{$tStyle['borderColorDark']}'";
     
     for ($h = 0; $h < $nbi; $h++){
        if (($h % 2) == 0){
          $t[] = "<tr><td><table {$bgc} {$border} {$bcl} {$bcd} width='100%'>";        
        }else{
          $t[] = "<tr><td><table {$bgc} {$border} {$bcli} {$bcdi} width='100%'>";        
        }
    
     }
  }
  
 
  
    
  if (isBitOk(0,$affichage) == 1){
    $style = $xoopsModuleConfig['style_Caption'];
    $t[] = "<tr>";
    $t[] = "   <td class='{$style}' align='center'>{$nom}</td>";
    $t[] = "</tr>";
    $ok = true;  
  
  }

  
  if (isBitOk(1,$affichage) == 1){
    $style = $xoopsModuleConfig['style_TexteNom'];
    $t[] = "<tr>";
    //$t[] = "   <td class='{$style}' align='center'>{$tStyle['nom']}</td>";
    $t[] = "   <td class='{$style}' align='center'>{$caption}</td>";    
    $t[] = "</tr>";
    $ok = true;  
  
  }

  if (isBitOk(2,$affichage) == 1){  
    if($bSanitise){
        $myts =& MyTextSanitizer::getInstance();
        $txt = $myts->previewTarea($content,1,0,0,0,0);
        //$txt = $myts->previewTarea($content, 1, 1, 1);   
    }else{
        $txt = $content ;   
    }
//echo "<hr><preg>{$txt}</preg><hr>";  
    $style = $xoopsModuleConfig['style_TexteContent'];  
    $t[] = "<tr >";  
    $t[] = "  <td class='{$style}'>{$txt}</td>"; 
    $t[] = "</tr>";  
    $ok = true;
  }
  
  $h = abs($nbi);
  if ($h <> 0 ){  
    $t[] = str_repeat("</table></td></tr>\n", $h);  
  }
  
  $t[] = "</table>"; 
   
  //$t[] = "</table>"; 
  //$t[] = "</table></td></TR>";  
  
  $t[] = "</div>\n"  ;
  //---------------------------------------------  
  if ($ok) {
    $texte = implode (hermes_crlf, $t);  
  }else{
    $texte = "";  
  }

  //----------------------------------------------
  return $texte;
  //return "<pre>{$texte}</pre>";
  

}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_Style ($idStyle, $params, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  $daoStyle = new cls_hermes_style();
  $rst = $daoStyle->getArray($idStyle);  

  
  //pour l'instant typeBalise n'est pas defini
  if (!isset($rst['typeBalise'])) $rst['typeBalise'] = 0;
  switch($rst['typeBalise']) {
    case 1:
      $baliseDebut = '<style>'.hermes_crlf.'<!--';
      $baliseFin   = '-->'.hermes_crlf.'</style>';
      break;    
        
    default:
      $baliseDebut = '';
      $baliseFin   = '';
      break;
  } 
  
  //--------------------------------------------------------  
  
  $t = array();
  //----------------------------------------------
  
  $t[] = "<!-- code brute de pomme {$rst['nom']} -->";
  if ($baliseDebut <> '') $t[] = $baliseDebut;
  $t[] = $rst['css'];
  if ($baliseFin <> '') $t[] = $baliseFin;  
  $t[] = "<!-- Fin : {$rst['nom']} -->";
  
  $ok = true;
  //---------------------------------------------  
  if ($ok) {
    $texte = implode (hermes_crlf, $t);  
  }else{
    $texte = "";  
  }
  //----------------------------------------------
  return $texte;



}

/**************************************************************************
 *
 **************************************************************************/
function buildLetter_Line ($width, $color, $mode = 0){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //---------------------------------------------
  
  if ($width > 0 AND $color <> ''){
    $line = "<hr style='color: {$color}; background-color: {$color}; height: {$width}px; border: 0;'>";  
  }else{
    $line = '';
  }

  //---------------------------------------------  
  return $line;

}

/**************************************************************************
 *
 **************************************************************************/

function saveNewLetter($fullName,  $texte, $mode = 0){
  
   
  $fp = fopen ($fullName, "w");  
  fwrite ($fp, $texte);
  fclose ($fp);
  


}


function saveNewLetter2($fileName,  $texte, $path, $mode = 0){
  
  $fullName = getFulNameArchive($fileName,  $path);   
  
  $fp = fopen ($fullName, "w");  
  fwrite ($fp, $texte);
  fclose ($fp);
  


}

/**************************************************************************
 *
 **************************************************************************/

function saveListeTo($idArchive, $tMails){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser;  
  //displayArray($tMails,"--- saveListeTo - liste des adresse ok ---");
  
  $sql = "SELECT nomFichier, cheminArchivage FROM "._HER_TFN_ARCHIVE
        ." WHERE idArchive = ".$idArchive;
  $result = $xoopsDB->query($sql);
  list ($fileName,$path) = $xoopsDB->fetchRow($result);
  $fullName = getFulNameArchive($fileName,  $path);   
  //echo "<hr>{$fullName}<hr>";  
  
  $fullName = subStr($fullName, 0 , -4).'.txt';
  //--------------------------------------------------------
  //echo "<hr>{$fullName}<hr>"; 
  $fp = fopen ($fullName, "w");
  $h = 0;
    while (list($key, $v) = each($tMails)){
      $h++;
      $line = "{$h}-{$key}-{$v}\r\n";
      fwrite ($fp, $line);      
    }

  fclose ($fp);
  


}

/**************************************************************************
 *Attentiion renvoi un tableau 0: le nom du fichier
 *                             1 le time stamp utilise pour le nom 
 **************************************************************************/

function getNameForLetter($idLettre, $nomCourt, $mode = 0){
  
  $timeStamp = time();
  $tsFile = date("Y-m-d_h-m-s", $timeStamp); 
 
  
  //date ("d-m-y_H-i-s"); 
  //un underscore entre les partie utile pour eventuellement pouvoir recouper le nom
  //pour extraire la date par exemple ou l'id 

  $folder = '';
  /* plus utile - utilise pendant les tests

  switch ($mode ){
    case 1:    $folder = 'preview/'; break;
    case 2:    $folder = 'send/';    break;   
    default:   $folder = 'tests/';       
  }
  */  
  $nom = $folder."{$nomCourt}_{$idLettre}_{$tsFile}.html";
  
  return  array($nom, $timeStamp); 


}

/**************************************************************************
 * la table params doit contenir tous les code de remplacement personalisé
 * pseudo, email, nom, ... 
 **************************************************************************/

function replaceCodePersonalise ($texte, $params){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  addCodePerso($params);
  

   //displayArray($params,"*** replaceCodePersonalise ***");          

    while (list($k, $item) = each($params)) {
      $code = "[{$k}]";
      //echo "===> {$code} ={$item}<br>";
      if ( !(strpos($texte,$code) === false )) {
            $texte = str_replace ($code, $item, $texte);
      }      
  
  
  }  
  //-----------------------------------------------------------
  
  return $texte;

}

/**************************************************************************
 *
 **************************************************************************/

function  addCodePerso(&$params){
//displayArray($params,"----- revokeLetter -----");
  $idLettre  = $params ['idLettre'];
  $idArchive = $params ['idArchive'];
  $tLib = getLibellesBuilding('perso = 1');
  $sp = '|';
  $eg = ':';
  
  $userlink = _HER_URL."souscription.php?op=updateUserStatus{$sp}";
    
  //displayArray($tLib, "----- getLibellesBuilding -----");
  //--------------------------------------------------------------
  //demande de revocation de toutes les lettres
  //--------------------------------------------------------------  
  $op = 'revokeConfirmed';  
  $code = _HER_CODE_SOUSCRIBE.'revokeAllLetters';
  $perimetre = 0;
  $newState = 0;

  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";

  //--------------------------------------------------------------
  //demande de revocation de cette lettre
  //--------------------------------------------------------------  
  $op = 'revokeConfirmed';  
  $code = _HER_CODE_SOUSCRIBE.'revokeThisLetter';
  $perimetre = $params['idLettre'];
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";


  //--------------------------------------------------------------
  //demande de revocaton de toutes les lettres
  //--------------------------------------------------------------  
  $op = 'revoke';  
  $code = _HER_CODE_SOUSCRIBE.'confirmRevokeAllLetters';
  $perimetre = 0;
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";

  //--------------------------------------------------------------
  //demande de revocaton de cette lettre
  //--------------------------------------------------------------  
  $op = 'revoke';  
  $code = _HER_CODE_SOUSCRIBE.'confirmRevokeThisLetter';
  $perimetre = $params['idLettre'];
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";



  //--------------------------------------------------------------
  //souscription a toutes les  lettres
  //--------------------------------------------------------------  
  $op = 'revoke';  
  $code = _HER_CODE_SOUSCRIBE.'subscribeThisLetter';
  $perimetre = 0;
  $newState = 1;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";
  
  //--------------------------------------------------------------
  //souscription a cette lettre
  //--------------------------------------------------------------  
  $op = 'revoke';  
  $code = _HER_CODE_SOUSCRIBE.'subscribeThisLetter';
  $perimetre = $params['idLettre'];
  $newState = 1;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";

/*
  
  //--------------------------------------------------------------
  //confirmation de resiliation a toutes les lettres
  //--------------------------------------------------------------  
  $op = 'revokeConfirmed';  
  $code = _HER_CODE_SOUSCRIBE.'revokeAllLettersConfirmed';
  $perimetre = 0;
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";

  //--------------------------------------------------------------
  //confirmation de resiliation a cette lettre
  //--------------------------------------------------------------  
  $op = 'revokeConfirmed';  
  $code = _HER_CODE_SOUSCRIBE.'revokeThisLetterConfirmed';
  $perimetre = $params['idLettre'];
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idLettre,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";
*/


  //--------------------------------------------------------------
  //lien sur l'archive en texte
  //--------------------------------------------------------------  
  $op = 'consultArchive';  
  $code = 'urlArchive';
  $perimetre = 0;
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idArchive,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = $link;

  //--------------------------------------------------------------
  //lien sur l'archive (href))
  //--------------------------------------------------------------  
  $op = 'consultArchive';  
  $code = 'urlArchiveLink';
  $perimetre = 0;
  $newState = 0;
  
  $t=array($op,$newState,$perimetre,$idArchive,$params['_user.idUser'],$params['_user.login'],$params['_user.email']);
  $link = $userlink.implode($sp, $t);  
  $params [$code] = "<A href='{$link}'>{$tLib[$code]}</A>";
  
  
  //--------------------------------------------------------------
  //code statistique personalisés
  //--------------------------------------------------------------  
  $params ['stat.part2'] = getCodeStat2($params);// code statistiques;
  
  //-----------------------------------------------------------------
  return true;
    
  

}
/**************************************************************************
 *
 **************************************************************************/

function addParamslistInParams (&$params){
 Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
 
  //--------------------------------------------------------------
  //Liste de ous les codes
  //--------------------------------------------------------------  
  $op = '';  
  $code = '_hermes.params';
  $perimetre = $params['idLettre'];
  $newState = 1;
  /*  
  $t=array();
  while (list($key, $item){
    if (!is_array($item)) continue;
    $t[] =  "{$key} = {$item}";
  }
  $params [$code] = implode("\n", $t);  

  */
  $tdStyle = "style='border-style: solid; border-width: 1'";
  $t = array();
  $t[] = "<table border='2' cellspacing='0'>";
  
  while (list($key, $item) = each ($params)){
    if (is_array($item)) {
      $t[] =  "<tr><td {$tdStyle}>{$key}</td><td {$tdStyle}>===> Array()</td></tr>";    
    }else{
      if ($item == '') $item = '--- n/a! ---';
      $t[] =  "<tr><td {$tdStyle}>{$key}</td><td {$tdStyle}>{$item}</td></tr>";    
    }

  }
  $t[] = "</table>";
    
  $params [$code] = implode("\n", $t);  
  //displayArray($params, "------------$code-----------------");
  //-----------------------------------------------------------------
  //displayArray($params,"----- addCodePerso -----");
 
 
 }

/**************************************************************************
 *
 **************************************************************************/

function replaceCodeInLetter ($texte, $params){  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
//displayArray($params, "----- replaceCodeInLetter -----");
/*

  for ($h = 0; $h<count($params); $h++){
    if (substr_count ( $params[$h], '.') > 0){
      $params[$h] = 'letter.'.$params[$h];
    }
  }
*/    
  setlocale(LC_TIME, "fr");
  //-----------------------------------------------------------
  //ajout des code manquants et préparation des tableaux de code
  //-----------------------------------------------------------  
  $tLib = getLibellesBuilding('perso = 0', _HER_PREFIXE_LIBELLE);  
  $adoSondage = new cls_hermes_sondage();
  $sondage = $adoSondage->buildSondageArray(_HER_PREFIXE_SONDAGE);
  //------------------------------------------------------------
  if ( $params['chronoArchive'] == 0) $params['chronoArchive'] = $params ['nextChronoArchive'];
  $params [_HER_CODE_SITE.'sitename'] = $xoopsConfig['sitename'];
  $params [_HER_CODE_SITE.'language'] = $xoopsConfig['language'];
  $params [_HER_CODE_SITE.'adminmail'] = $xoopsConfig['adminmail'];
  $params [_HER_CODE_SITE.'slogan'] = $xoopsConfig['slogan'];
  $params [_HER_CODE_SITE.'siteurl'] = XOOPS_URL;
  $params [_HER_CODE_SITE.'url'] = XOOPS_URL;
  $params [_HER_CODE_SITE.'homepage'] = "<a href='".XOOPS_URL."'>".$xoopsConfig['sitename']."</a>";
  $params ['strDateParution'] ='zzzzzzzzzzzzzz';// strftime($params['dateParution'], _AD_HER_DH_USER_STRINGDATE);
  $params ['stat.part1'] = getCodeStat1($params);// code statistiques
    
  if (!isset($params['dateParution'])) $params['dateParution'] = time();
  $params ['shortDateParution'] = strftime(_AD_HER_DH_USER_SHORTDATE , strtotime($params['dateParution']));  
  $params ['dateParution'] = strftime( _AD_HER_DH_USER_STRINGDATE, strtotime($params['dateParution']));
  
  
  $params = array_merge($params, $tLib, $sondage);  
  //her_displayArray($params,"----- replaceCodeInLetter -----");
  //-----------------------------------------------------------
  addParamslistInParams($params);
  $t = parceContent($texte, _HER_REGEXP_BALISE_HERMES);

  
  for ($h = 0; $h < count($t); $h++){
    $item1 = explode(_HER_SEPCODE, $t[$h]);
    $item2 = explode('.', $t[$h]);
    
    $code = $item1[0];
    $codeLong = "[{$t[$h]}]";
    //echo "--->{$code}=>{$codeLong}<br>";
    if (isset($params[$code])){
      $texte = str_replace ($codeLong, $params[$code], $texte);            
    }



  }
  
  
  //------------------------------------------------------------

  //$urlArchive = $params['urlArchive'] .  $params['archiveName'] ;  
  //$texte = str_replace ('urlArchive', $item, $texte);  
  //---------------------------------------------------------------------  
  
  //-----------------------------------------------------------
  for ($h = 0; $h <=10; $h++){
      $code = "[note{$h}]";  
      if ( !(strpos($texte,$code) === false )) {
            $op = 'noteNewLetter';
            $idArchive = $params['idArchive'];
           
            $link ="<A HREF=\""._HER_URL."index.php?op={$op}&idArchive={$idArchive}&note={$h}\"> {$h} </A>";           
            $texte = str_replace ($code, $link, $texte);
      }      
  }
  //-----------------------------------------------------------
 




  //$code = '[note0]';
  //if ( !(strpos($texte,$code) === false )) {$texte = str_replace ($code, '0', $texte)} 

  
  return $texte;

}


/**************************************************************************
 *
 **************************************************************************/

function replaceCodeInLetter_old ($texte, $params){
  Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
//displayArray($params, "----- replaceCodeInLetter -----");
/*

  for ($h = 0; $h<count($params); $h++){
    if (substr_count ( $params[$h], '.') > 0){
      $params[$h] = 'letter.'.$params[$h];
    }
  }
*/  

  setlocale(LC_TIME, "fr");
  //------------------------------------------------------------
  $tLib = getLibellesBuilding('perso = 0', _HER_PREFIXE_LIBELLE);


  $adoSondage = new cls_hermes_sondage();
  $sondage = $adoSondage->buildSondageArray(_HER_PREFIXE_SONDAGE);

  $params = array_merge($params,$tLib,$sondage);
  //her_displayArray($params,"------ replaceCodeInLetter -----");
  //------------------------------------------------------------
  if ( $params['chronoArchive'] == 0) $params['chronoArchive'] = $params ['nextChronoArchive'];
  $params [_HER_CODE_SITE.'sitename'] = $xoopsConfig['sitename'];
  $params [_HER_CODE_SITE.'language'] = $xoopsConfig['language'];
  $params [_HER_CODE_SITE.'adminmail'] = $xoopsConfig['adminmail'];
  $params [_HER_CODE_SITE.'slogan'] = $xoopsConfig['slogan'];
  $params [_HER_CODE_SITE.'siteurl'] = XOOPS_URL;
  $params [_HER_CODE_SITE.'url'] = XOOPS_URL;
  $params [_HER_CODE_SITE.'homepage'] = "<a href='".XOOPS_URL."'>".$xoopsConfig['sitename']."</a>";
  $params ['strDateParution'] ='zzzzzzzzzzzzzz';// strftime($params['dateParution'], _AD_HER_DH_USER_STRINGDATE);
  $params ['stat.part1'] = getCodeStat1($params);// code statistiques
    
  if (!isset($params['dateParution'])) $params['dateParution'] = time();
  $params ['shortDateParution'] = strftime(_AD_HER_DH_USER_SHORTDATE , strtotime($params['dateParution']));  
  $params ['dateParution'] = strftime( _AD_HER_DH_USER_STRINGDATE, strtotime($params['dateParution']));
           
   //displayArray($params,"*** replaceCodeInLetter ***");          

    while (list($k, $item) = each($params)) {
      $code = "[{$k}]";
      //echo "===> {$code} ={$item}<br>";
      if ( !(strpos($texte,$code) === false )) {
            $texte = str_replace ($code, $item, $texte);
      }      
  //---------------------------------------------------------------------
  //$urlArchive = $params['urlArchive'] .  $params['archiveName'] ;  
  //$texte = str_replace ('urlArchive', $item, $texte);  
  //---------------------------------------------------------------------  
  }  
  //-----------------------------------------------------------
  for ($h = 0; $h <=10; $h++){
      $code = "[note{$h}]";  
      if ( !(strpos($texte,$code) === false )) {
            $op = 'noteNewLetter';
            $idArchive = $params['idArchive'];
           
            $link ="<A HREF=\""._HER_URL."index.php?op={$op}&idArchive={$idArchive}&note={$h}\"> {$h} </A>";           
            $texte = str_replace ($code, $link, $texte);
      }      
  }
  //-----------------------------------------------------------
 




  //$code = '[note0]';
  //if ( !(strpos($texte,$code) === false )) {$texte = str_replace ($code, '0', $texte)} 

  
  return $texte;

}

/**************************************************************************
 * liste des codes de remplacement
 * pseudo, email, nom, ... 
 **************************************************************************/

function getCodeList (){

  $t = array('idLettre','nom','libelle','description',
             'urlArchive','urlArchiveLink',
             'periodicite','jour','dateParution','prochaineParution',
             'idElement','idItem','caption','idArchive','chronoArchive',
             'strDateParution','shortDateParution',             
             '_user.idUser','_user.pseudo','_user.name',
             '_user.email', '_user.login',             
             '_site.sitename','_site.language',
             '_site.adminmail','_site.slogan',
             '_site.siteurl','_site.url','_site.homepage',
             '_souscribe.revokeThisLetter',
             '_souscribe.revokeAllLetters',
             '_souscribe.confirmRevokeThisLetter',
             '_souscribe.confirmRevokeAllLetters',             
             '_souscribe.subscribeThisLetter',
             '_hermes.params');

/*
,
             '_souscribe.revokeAllLettersConfirmed',
             '_souscribe.revokeThisLetterConfirmed'
*/
  //-------------------------------------------------------------------
  $tLib = getLibellesBuilding('perso = 0', _HER_PREFIXE_LIBELLE);
  $keys = array_keys($tLib);
  //-------------------------------------------------------------------  
  $adoSondage = new cls_hermes_sondage();
  $sondage = $adoSondage->buildCodeList(_HER_PREFIXE_SONDAGE);
  //-------------------------------------------------------------------
  $t = array_merge($t, $keys, $sondage);
   sort ($t);
   reset($t);
  //-----------------------------------------------------------
  
  return $t;

}
    

/*********************************************************************

**********************************************************************/

function incrementeCompteur($inc){
global $toto;
  
  if ($toto == '') $toto = 0;
  $toto += $inc;
  //echo "incrementeCompteur->{$toto}<br>";
  return $toto;
  
}

/*********************************************************************
ajouter une image 1px X 1px transparent pour compter la lecture de la newsletter 
mais en changeant les url pour forcer le passage par une page en PHP qui comptabilisera et retournera le code du gif.. 
et ensuite remplacer les URL des liens par l'appel à cette même page PHP ou on passera un parametre qui permettra de savoir quelle url est demandée, mais aussi à partir de quelle newsletter 
 
ex: remplacer /images/blanc.gif par /redirect.php? Da456etT4 
et ou cette référence Da.. est associé à l'image gif et identifie que ca vient de la newsletter de satanas par exemple 
donc il faut une base qui converti ces codes en url et login 
pour enregistrer la stat 
ok yes 
ensuite le php retoure le code de l'image ou alors l'url finale 
l'image sert simplement a compter l'ouverture de la newsletter, car si il affiche les images, il ne faut pas d'interventions du lecteur 
ca veut dire que e code devra être différent pour chaque destinataire et chaque lettre 
par contre avec les url, ca permet d'avoir une idée des centres d'intérets de l'utilisateur parmis tout les liens 
 
donc en fait faudrait garder en permanence la table des destinataires et ensuite faire une sorte de md5 ou cryptage.. 
ensuite tu peux par exemple faire un code segmenté 
AE46565-564 
la premiere partie identifiant le destinataire et ensuite les 3 autres chifffres qui retiendrait quelle URL 
oui je vois 
dans la newletter,  
et donc là faut juste un champs avec le nom de l'utilisateur et sa clé 
et ensuite une autre table contenant la newsletter, le code de l'url et le chemin de l'url 

**********************************************************************/
function buildUrlCodeStat($bImgNormal = false){
  
  //------------------------------------------
  //echo "<hr>cde = {$code}<hr>";
  //setNewStat($code);
  
  $url = _HER_URL."ucs.php?op=ucs&code=[stat.part1]_[stat.part2]";
  //$img = "<img border="0" src="file:///D:/wamp/www/xoops_2018/modules/hermes/images/sumo.gif" width="69" height="84">"
  
  $img = "<img border='0' src='{$url}'>";  
  
  /*

  if ($bImgNormal){
    $img = "<img border='0' src='{$url}'  width='69px' height='84px'>";  
  }else{
    $img = "<img border='0' src='{$url}'  width='1px' height='1px'>";  
  }
  */  

  //return $img;
  //return "<hr>test statiqsques<br>{$img}<hr>";
  return $img;  
}

 /****************************************************************************
 *
 ****************************************************************************/
 function getLibellesBuilding($clauseWhere = '', $keyPrefixe = ''){
	global $xoopsModuleConfig, $xoopsDB;

	 $adoLibelle = new cls_hermes_libelle();
    $sqlquery = $adoLibelle->getRows('',$clauseWhere);    
    $tLib = array();

    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      if ($sqlfetch['texte'] == ''){
        $lib = getConstanteValide($sqlfetch['constant']);
      }else{
        $lib = getConstanteValide($sqlfetch['texte']);
        if ($lib == '') $lib = $sqlfetch['texte'];      
      }
      
       $tLib[$keyPrefixe.$sqlfetch['code']] = $lib;
       //$key = $keyPrefixe.$sqlfetch['idLibelle']._HER_SEPCODE.$sqlfetch['code']
       //$tLib[$key] = $lib;       
    }
    
    //displayArray($tLib, "----- getLibellesBuilding -----");
    return $tLib;
      
 }
 

 /****************************************************************************
 *
 ****************************************************************************/
function getDecoFrame($idFrame, $default = ''){
     
     if ($idFrame == 0){
        $tFrame = (is_array($default)) ? $default : array();
     }else{
         $adoFrame = new cls_hermes_deco();
         $tDeco = $adoFrame->getArray($idFrame);
         $tFrame = $adoFrame->getPPValues($idFrame);
     }
     
    return $tFrame;
}
?>
