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


//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (dirname(__FILE__)."/include/hermes_constantes.php");
//-----------------------------------------------------------------------------------

if (!defined('_HER_DIR_NAME')){ 
    define ('_HER_DIR_NAME','hermes');
}

include_once (_HER_JJD_PATH.'include/editor_functions.php');

            
//----------------------------------------------------------------------------

$modversion['name']         = "hermes"; 
$modversion['version']      = "5.02"; 
$modversion['dateVersion']  = "08-03-2009";

$modversion['description']  = defined('_MI_HER_HERMES_DSC')?constant('_MI_HER_HERMES_DSC'):'Gestion de lettres de diffusion';
$modversion['credits']      = "Jean-Jacques DELALANDRE";
$modversion['author']       = "jjdd@kiolo.com";
$modversion['initiales']    = "J&deg;J&deg;D";
$modversion['license']      = "GPL";
$modversion['official']     = 0;
$modversion['image']        = "images/hermes_logo.png";
$modversion['dirname']      = _HER_DIR_NAME;

// Admin things
$modversion['hasAdmin']     = 1;
$modversion['adminindex']   = "admin/index.php";
$modversion['adminmenu']    = "admin/menu.php";

//--------------------------------------------------------

//install:
//$modversion['onInstall']     = 'include/install.php';
$modversion['onInstall']     = 'admin/admin_version.php';
//suppression:
//$modversion['onUninstall']   = 'include/uninstall.php';
$modversion['onUninstall']   = 'admin/admin_version.php';
//mise à jour:
//$modversion['onUpdate'] = 'include/update.php';
$modversion['onUpdate'] = 'admin/admin_version.php';
//--------------------------------------------------------

// Blocks
/*
*/
$i=1;
$modversion['blocks'][$i]['file']        = "hermes_block_new.php";
$modversion['blocks'][$i]['name']        = 'Hermes';  
$modversion['blocks'][$i]['description'] = '_MD_HER_BNAMEDESC';
$modversion['blocks'][$i]['show_func']   = "hermes_show_new";
$modversion['blocks'][$i]['edit_func']   = "hermes_numDef_edit";
$modversion['blocks'][$i]['options']     = "5";
$modversion['blocks'][$i]['template']    = 'hermes_block_new.html';

$i++;
$modversion['blocks'][$i]['file']        = "hermes_block_subscription.php";
$modversion['blocks'][$i]['name']        = 'New Letters';  
$modversion['blocks'][$i]['description'] = '_MD_HER_SUBSCRIPTION_DSC';
$modversion['blocks'][$i]['show_func']   = "hermes_show_subscription";
$modversion['blocks'][$i]['edit_func']   = "hermes_edit_subscription";
$modversion['blocks'][$i]['options']     = _HER_BLOCK_PARAM_SUB ; //"1|hermes|1|5|12|16|0|50|securityimage|1";
$modversion['blocks'][$i]['template']    = 'hermes_block_subscription.html';


// Menu -----------------------------------------------------------------
$modversion['hasMain'] = 1;

$i=0;
$modversion['sub'][$i]['name']  = _MI_HER_PROFILE;
$modversion['sub'][$i]['url']   = "index.php?op=profile";

$i++;
$modversion['sub'][$i]['name']  = _MI_HER_SONDAGES;
$modversion['sub'][$i]['url']   = "sondage.php?op=list";

//-----------------------------------------------------------------

// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$i = 0;
$modversion['tables'][$i++]  = _HER_TAB_GROUPE;
$modversion['tables'][$i++]  = _HER_TAB_LETTRE;
$modversion['tables'][$i++]  = _HER_TAB_ARCHIVE;
$modversion['tables'][$i++]  = _HER_TAB_TEXTE;
$modversion['tables'][$i++]  = _HER_TAB_STRUCTURE;
$modversion['tables'][$i++]  = _HER_TAB_PLUGIN;
$modversion['tables'][$i++]  = _HER_TAB_PARAMS;
$modversion['tables'][$i++]  = _HER_TAB_USERS;
$modversion['tables'][$i++]  = _HER_TAB_PIECE;

$modversion['tables'][$i++]  = _HER_TAB_BONUS;
$modversion['tables'][$i++]  = _HER_TAB_ELEMENT;
$modversion['tables'][$i++]  = _HER_TAB_STYLE;
$modversion['tables'][$i++]  = _HER_TAB_TEMP;
$modversion['tables'][$i++]  = _HER_TAB_CESSION;

$modversion['tables'][$i++]  = _HER_TAB_URL;
$modversion['tables'][$i++]  = _HER_TAB_SYNDICATION;
$modversion['tables'][$i++]  = _HER_TAB_FLUXRSS;
$modversion['tables'][$i++]  = _HER_TAB_LIBELLE;
$modversion['tables'][$i++]  = _HER_TAB_LECTURE;
$modversion['tables'][$i++]  = _HER_TAB_FRAME;

$modversion['tables'][$i++]  = _HER_TAB_SONDAGE;
$modversion['tables'][$i++]  = _HER_TAB_REPONSE;
$modversion['tables'][$i++]  = _HER_TAB_RESULTAT;

$modversion['tables'][$i++]  = _HER_TAB_DECO;
$modversion['tables'][$i++]  = _HER_TAB_DECOPP;
$modversion['tables'][$i++]  = _HER_TAB_DECOMODELE;

$modversion['tables'][$i++]  = _HER_TAB_SOUSCRIPTION;
//----------------------------------------------------------------

// Templates
$i = 0;

/*

$i++;
//$modversion['templates'][$i]['file']         = _HER_JJD_PATH.'include/adminOnglet/templates/adminOnglet.html';
$modversion['templates'][$i]['file']         = 'adminOnglet.html';
$modversion['templates'][$i]['description']  = 'Page adminOnglet';


$i++;
$modversion['templates'][$i]['file']         = 'hermes_catMenu.html';
$modversion['templates'][$i]['description']  = 'Page catMenu';
*/

$i++;
$modversion['templates'][$i]['file']         = 'hermes_lettre.html';
$modversion['templates'][$i]['description']  = 'Page lettre';

$i++;
$modversion['templates'][$i]['file']         = 'hermes_lettreDetail.html';
$modversion['templates'][$i]['description']  = 'Page lettreDetail';

$i++;
$modversion['templates'][$i]['file']         = 'hermes_archive.html';
$modversion['templates'][$i]['description']  = 'Page archive';

$i++;
$modversion['templates'][$i]['file']         = 'hermes_archiveDetail.html';
$modversion['templates'][$i]['description']  = 'Page archiveDetail';

$i++;
$modversion['templates'][$i]['file']         = 'hermes_archiveIn.html';
$modversion['templates'][$i]['description']  = 'Page archive in one';

$i++;
$modversion['templates'][$i]['file']         = 'hermes_listSondage.html';
$modversion['templates'][$i]['description']  = 'Liste des sondages';

$i++;
$modversion['templates'][$i]['file']         = 'hermes_showSondage.html';
$modversion['templates'][$i]['description']  = 'Afichage sondage';

//------------------------------------------------------------------
// Search
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "her_search";

// Comments
$modversion['hasComments']          = 0;


       
//------------------------------------------------------------------
// Config Settings
//------------------------------------------------------------------
$i=-1;
//------------------------------------------------------------------
// General 
//------------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'dateVersion';
$modversion['config'][$i]['title'] = '_MI_HER_DATEVERSION';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'hidden';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '31/08/2007';
//------------------------------------------------------------------

$i++;
$modversion['config'][$i]['name'] = 'textintro';
$modversion['config'][$i]['title'] = '_MI_HER_INTROTEXT';
$modversion['config'][$i]['description'] = '_MI_HER_INTROTEXTDESC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_HER_INTROTEXT_HERMES;




$i++;
$modversion['config'][$i]['name'] = 'editor';
$modversion['config'][$i]['title'] = '_MI_HER_EDITOR';
$modversion['config'][$i]['description'] = '_MI_HER_EDITOR_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  getEditorList();

$i++;
$modversion['config'][$i]['name'] = 'emailSender';//email d'envoie de la newsletter
$modversion['config'][$i]['title'] = '_MI_HER_EMAIL_SENDER';
$modversion['config'][$i]['description'] = '_MI_HER_EMAIL_SENDER_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'showAllPlugins';
$modversion['config'][$i]['title'] = '_MI_HER_SHOWALLPLUGINS';
$modversion['config'][$i]['description'] = '_MI_HER_SHOWALLPLUGINS_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO => 0,
                                              _MI_HER_YES => 1);

$i++;
$modversion['config'][$i]['name'] = 'urlDoc';
$modversion['config'][$i]['title'] = '_MI_HER_URLDOC';
$modversion['config'][$i]['description'] = '_MI_HER_URLDOC_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'xoops.kiolo.com';

$i++;
$modversion['config'][$i]['name'] = 'viewArchive';
$modversion['config'][$i]['title'] = '_MI_HER_ARCHIVE_MODE_VIEW';
$modversion['config'][$i]['description'] = '_MI_HER_ARCHIVE_MODE_VIEW_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  array(_MI_HER_ARCHIVE_MODE_0 => 0,
                                              _MI_HER_ARCHIVE_MODE_1 => 1);
                                              
$i++;
$modversion['config'][$i]['name'] = 'archiveSearchMode';
$modversion['config'][$i]['title'] = '_MI_HER_ARCHIVE_SEARCH';
$modversion['config'][$i]['description'] = '_MI_HER_SEARCH_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  array(_MI_HER_ARCHIVE_SERCHMODE_0 => 0,
                                              _MI_HER_ARCHIVE_SERCHMODE_1 => 1);
//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'sendMethod';
$modversion['config'][$i]['title'] = '_MI_HER_SEND_METHOD';
$modversion['config'][$i]['description'] = '_MI_HER_SEND_METHOD_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] =  array(_MI_HER_SEND_ALLMETHOD => 0,
                                              _MI_HER_SEND_DIRECT    => 1,
                                              _MI_HER_SEND_BATCH     => 2);                                              
//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'bloquerMail';
$modversion['config'][$i]['title'] = '_MI_HER_BLOQUER_XMAIL';
$modversion['config'][$i]['description'] = '_MI_HER_BLOQUER_XMAIL_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO => 0,
                                              _MI_HER_YES => 1);
//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'groupeAnonyme';
$modversion['config'][$i]['title'] = '_MI_HER_GROUP_ANONYME';
$modversion['config'][$i]['description'] = '_MI_HER_GROUP_ANONYME_DSC';
$modversion['config'][$i]['formtype'] = 'group';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 3;

//------------------------------------------------------------------------

/*

// utilisation de security image
$i++;
$modversion['config'][$i]['name'] = 'capcha_subscription';
$modversion['config'][$i]['title'] = '_MI_HER_CAPCHA_QUESTION';
$modversion['config'][$i]['description'] = '_MI_HER_CAPCHA_QUESTION_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
//$modversion['config'][$i]['options'] = array(0,1,2,3,4,5,6,7,8);
//$modversion['config'][$i]['options'] = array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8);                                             
$modversion['config'][$i]['options'] =  array(_MI_HER_NO  => 0,
                                              _MI_HER_YES => 1);
*/   
                                           
$i++;
$modversion['config'][$i]['name'] = 'keepTestLetter';
$modversion['config'][$i]['title'] = '_MI_HER_KEEP_TESTLETTER';
$modversion['config'][$i]['description'] = '_MI_HER_KEEP_TESTLETTER_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO  => 0,
                                              _MI_HER_YES => 1);

//--------------------------------------------------------------
//statistique de lecture
//--------------------------------------------------------------


/*
$i++;
$modversion['config'][$i]['name'] = 'statLectureActive';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_ACTIVE';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_ACTIVE_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO => 0,
                                              _MI_HER_YES => 1);



$i++;                                              
$modversion['config'][$i]['name'] = 'statModeDeCalcul';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_CALCUL';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_CALCUL_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  array(_MI_HER_STAT_CALC0 => 0,
                                              _MI_HER_STAT_CALC1 => 1);
                                              
*/  
//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'statPresentation';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_PRESENTATION';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_PRESENTATION_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] =  array(_MI_HER_STAT_ARRAYS   => 0,
                                              _MI_HER_STAT_GRAPHICS => 1);


$i++;
$modversion['config'][$i]['name'] = 'statMaxLectureByIP';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_MAX_IP';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_MAX_IP_DSC';
$modversion['config'][$i]['formtype'] = 'int';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;

$i++;
$modversion['config'][$i]['name'] = 'statMaxLectureByEM';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_MAX_EM';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_MAX_EM_DSC';
$modversion['config'][$i]['formtype'] = 'int';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;


                                              
$i++;
$modversion['config'][$i]['name'] = 'statNbJours';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_JOURS';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_JOURS_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 25;
$modversion['config'][$i]['options'] =  array( 5 =>  5,
                                              10 => 10,
                                              15 => 15,
                                              20 => 20,
                                              25 => 25,
                                              30 => 30,
                                              35 => 35);


$i++;
$modversion['config'][$i]['name'] = 'statTranchesArchive';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_TRANCHES_A';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_TRANCHES_A_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "0;1;10;50;100";


$i++;
$modversion['config'][$i]['name'] = 'statTranchesLettre';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_TRANCHES_L';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_TRANCHES_L_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "0;10;100;500;1000";

$i++;
$modversion['config'][$i]['name'] = 'statTranchesGlobale';
$modversion['config'][$i]['title'] = '_MI_HER_STAT_TRANCHES_G';
$modversion['config'][$i]['description'] = '_MI_HER_STAT_TRANCHES_G_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "0;100;1000;2500;50000";

/*

$i++;
$modversion['config'][$i]['name'] = 'sumo';
$modversion['config'][$i]['title'] = '_MI_HER_SHOW_SUMO';
$modversion['config'][$i]['description'] = '_MI_HER_SHOW_SUMO_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO => 0,
                                             _MI_HER_YES => 1);

*/ 

/*

$i++;
$modversion['config'][$i]['name'] = 'coloStat0';
$modversion['config'][$i]['title'] = '_MI_HER_STAT0';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'color';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "#FF0000";
*/
//--------------------------------------------------------------

//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'degre_urgence';
$modversion['config'][$i]['title'] = '_MI_HER_DEGRE_URGENCE';
$modversion['config'][$i]['description'] = '_MI_HER_DEGRE_URGENCE_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "-7;0;3;7;16;30";

//--------------------------------------------------------------

$i++;
$modversion['config'][$i]['name'] = 'smartyTag';
$modversion['config'][$i]['title'] = '_MI_HER_SMARTY_TAG';
$modversion['config'][$i]['description'] = '_MI_HER_SMARTY_TAG_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';
//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'lotUserRegistry';
$modversion['config'][$i]['title'] = '_MI_HER_LOT_REGISTRY';
$modversion['config'][$i]['description'] = '_MI_HER_LOT_REGISTRY_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 100;

$i++;
$modversion['config'][$i]['name'] = 'lotUserNotRegistry';
$modversion['config'][$i]['title'] = '_MI_HER_LOT_NOTREGISTRY';
$modversion['config'][$i]['description'] = '_MI_HER_LOT_NOTREGISTRY_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 100;

$i++;
$modversion['config'][$i]['name'] = 'lotMail';
$modversion['config'][$i]['title'] = '_MI_HER_LOT_MAIL';
$modversion['config'][$i]['description'] = '_MI_HER_LOT_MAIL_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 100;

$i++;
$modversion['config'][$i]['name'] = 'timer1';
$modversion['config'][$i]['title'] = '_MI_HER_LOT_TIMER1';
$modversion['config'][$i]['description'] = '_MI_HER_LOT_TIMER1_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 100;

$i++;
$modversion['config'][$i]['name'] = 'timer2';
$modversion['config'][$i]['title'] = '_MI_HER_LOT_TIMER2';
$modversion['config'][$i]['description'] = '_MI_HER_LOT_TIMER2_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 100;


//--------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'ModRegExp';
$modversion['config'][$i]['title'] = '_MI_HER_MODREGEXT';
$modversion['config'][$i]['description'] = '_MI_HER_MODREGEXT_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO                  => 0,
                                              _MI_HER_RW_REWRITING        => 1,
                                              _MI_HER_RW_GOOGLE_ANALYTICS => 2);


//----styles defauts---------------------------------------------------
$tStyle = array('item'           => 'item', 
                'itemHead'       => 'itemHead', 
                'itemInfo'       => 'itemInfo',
                'itemTitle'      => 'itemTitle',
                'itemPoster'     => 'itemPoster', 
                'itemPostDate'   => 'itemPostDate',
                'itemStats'      => 'itemStats',
                'itemBody'       => 'itemBody', 
                'itemText'       => 'itemText',
                'itemText'       => 'itemText',
                'itemFoot'       => 'itemFoot', 
                'itemAdminLink'  => 'itemAdminLink',
                'itemPermaLink'  => 'itemPermaLink',
                'outer'          => 'outer',                
                'head'           => 'head',                
                'even'           => 'even',                
                'odd'            => 'odd',                
                'foot'           => 'foot'                
                );


$i++;
$modversion['config'][$i]['name'] = 'style_Caption';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_CAPTION';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'itemHead';


$i++;
$modversion['config'][$i]['name'] = 'style_TexteNom';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_TEXT_NOM';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'head';


$i++;
$modversion['config'][$i]['name'] = 'style_TexteContent';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_TEXT_CONTENT';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'itemText';



$i++;
$modversion['config'][$i]['name'] = 'style_pluginNom';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_NOM';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'head';



$i++;
$modversion['config'][$i]['name'] = 'style_pluginHeader';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_HEADER';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'even';



$i++;
$modversion['config'][$i]['name'] = 'style_pluginColTitles';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_HEADCOL';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'even';



$i++;
$modversion['config'][$i]['name'] = 'style_pluginFooter';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_FOOTER';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'foot';



$i++;
$modversion['config'][$i]['name'] = 'style_pluginFirstColone';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_FIRSTCOL';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'even';



$i++;
$modversion['config'][$i]['name'] = 'style_pluginLastColone';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_LASTCOL';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'even';


$i++;
$modversion['config'][$i]['name'] = 'style_pluginOtherColones';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_OTHERCOL';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'odd';

/*
//----------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'compatibiliteRow';
$modversion['config'][$i]['title'] = '_MI_HER_COMPATIBLE_ROW';
$modversion['config'][$i]['description'] = '_MI_HER_COMPATIBLE_ROW_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] =  array(_MI_HER_NO => 0,
                                              _MI_HER_YES => 1);
                                              
                                              
//--------------------------------------------------------------


*/
$i++;
$modversion['config'][$i]['name'] = 'toto_zzz';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_OTHERCOL';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'odd';


$i++;
$modversion['config'][$i]['name'] = 'toto_eeeee';
$modversion['config'][$i]['title'] = '_MI_HER_STYLE_PLUGIN_OTHERCOL';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = $tStyle;
$modversion['config'][$i]['default'] = 'odd';

/*
e deplacer au niveau de la lettre
$i++;
$modversion['config'][$i]['name'] = 'allowSend2Author';
$modversion['config'][$i]['title'] = '_MI_HER_SEND2AUTHOR';
$modversion['config'][$i]['description'] = '_MI_HER_SEND2AUTHOR_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['options'] = array('_NO' => 0, 
                                             '_YES' => 1);
*/
//------------------------------------------------------------------------
// Notification
$modversion['hasNotification'] = 0;



?>
