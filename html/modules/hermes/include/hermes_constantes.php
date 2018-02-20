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

//-----------------------------------------------------------------
define ('_JJD_CORW', 'zeus');

define ('_HER_SHOWID', true);
define ('_herbr', "\n");

define('_HER_REGEXP_BALISE_SMARTY', '#<\{[a-z ]*[\$]([a-z0-9_]*)[\} =<>]#isU');
define('_HER_REGEXP_BALISE_HERMES', '#[\[]([a-z.0-9_ -|]*)[\]]#isU');


//define ('_br', '<br>');
//-----------------------------------------------------------------
//Definition des constante e dossier
//-----------------------------------------------------------------
global $xoopsModule, $xoopsDB;
if (!defined('_HER_DIR_NAME')){ 
    define ('_HER_DIR_NAME','hermes');
}
define ('_HER_COPYRIGHT',      "copy right : HERMES-JJD 2007");
//------------------------------------------------------
define ('_HER_COMPATIBLE_ROW',      false);
define ('_HER_SEPCODE',      '|');
//------------------------------------------------------
define ('_HER_DATE_SQL',      'y-m-d h:i:s');

$slashP = ((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/');
$slashU = ((substr(XOOPS_URL,  -1) == '/') ? '' : '/');

define ('_HER_PROOT',      XOOPS_ROOT_PATH.$slashP);
define ('_HER_JJD_PATH',      XOOPS_ROOT_PATH.$slashP.'modules/jjd_tools/_common/');
define ('_HER_SUB_FOLDER',       '/modules/'._HER_DIR_NAME.'/'  );
define ('_HER_ROOT_PATH',     XOOPS_ROOT_PATH.$slashP.'modules/'._HER_DIR_NAME.'/'  );


define ('_HER_DIR_ADMIN',      _HER_SUB_FOLDER.'admin/');
define ('_HER_DIR_BLOCKS',     _HER_SUB_FOLDER.'blocks/');
define ('_HER_DIR_DOC',        _HER_SUB_FOLDER.'doc/');
define ('_HER_DIR_IMAGES',     _HER_SUB_FOLDER.'images/');

define ('_HER_DIR_INCLUDE',    _HER_SUB_FOLDER.'include/');
define ('_HER_DIR_LANGUAGE',   _HER_SUB_FOLDER.'language/');
define ('_HER_DIR_LOG',        _HER_SUB_FOLDER.'log/');
define ('_HER_DIR_SQL',        _HER_SUB_FOLDER.'sql/');
define ('_HER_DIR_TEMPLATES',  _HER_SUB_FOLDER.'templates/');
define ('_HER_DIR_JS',         '/include/jjd/js/');
define ('_HER_DIR_PLUGINS',     _HER_SUB_FOLDER.'plugins/');

define ('_HER_ROOT_ADMIN',      _HER_ROOT_PATH.'admin/');
define ('_HER_ROOT_BLOCKS',     _HER_ROOT_PATH.'blocks/');
define ('_HER_ROOT_DOC',        _HER_ROOT_PATH.'doc/');
define ('_HER_ROOT_IMAGES',     _HER_ROOT_PATH.'images/');

define ('_HER_ROOT_INCLUDE',    _HER_ROOT_PATH.'include/');
define ('_HER_ROOT_LANGUAGE',   _HER_ROOT_PATH.'language/');
define ('_HER_ROOT_LOG',        _HER_ROOT_PATH.'log/');
define ('_HER_ROOT_SQL',        _HER_ROOT_PATH.'sql/');
define ('_HER_ROOT_TEMPLATES',  _HER_ROOT_PATH.'templates/');

define ('_HER_PIECES',          'pieces');
define ('_HER_ROOT_PIECES',     _HER_ROOT_PATH._HER_PIECES.'/');
define ('_HER_ROOT_PLUGINS',    _HER_ROOT_PATH.'plugins/');
define ('_HER_ROOT_TPL_GEN',    _HER_ROOT_PATH.'plugins/template-generique/');
define ('_HER_ROOT_CLASS',      _HER_ROOT_PATH.'class/');

define ('_HER_ROOT_LETTER_TPL',   _HER_ROOT_PATH.'templates/letter/');

//----------------------------------------------------------------------
define ('_HER_URL',           XOOPS_URL._HER_SUB_FOLDER);

define ('_HER_URL_ADMIN',     _HER_URL.'admin/');
define ('_HER_URL_IMG',       _HER_URL.'images/');
define ('_HER_URL_ICONES',    _HER_URL.'images/icones/');
define ('_HER_URL_CACHE',     _HER_URL.'cache/');
//define ('_HER_URL_IMG',       _HER_URL.'images/');
//-----------------------------------------------------------------
define ('_HER_JS_TOOLS',     _HER_URL.'js/hermes.js');
define ('_HER_JSI_TOOLS',     "<script type=\"text/javascript\" src=\""._HER_JS_TOOLS."\"></script>\n");

//-----------------------------------------------------------------

//-----------------------------------------------------------------
//Definition des constante de table
//-----------------------------------------------------------------
define ('_HER_TBL_PREFIXE',     'her_');

define ('_HER_TBL_LETTRE',       'lettre');
define ('_HER_TBL_STRUCTURE',    'structure');
define ('_HER_TBL_GROUPE',       'groupe');
define ('_HER_TBL_TEXTE',        'texte');
define ('_HER_TBL_ARCHIVE',      'archive');
define ('_HER_TBL_PLUGIN',       'plugin');
define ('_HER_TBL_PARAMS',       'params');
define ('_HER_TBL_USERS',        'users');
define ('_HER_TBL_PIECE',        'piece');

define ('_HER_TBL_BONUS',        'bonus');
define ('_HER_TBL_ELEMENT',      'element');
define ('_HER_TBL_STYLE',        'style');
define ('_HER_TBL_TEMP',         'temp');
define ('_HER_TBL_CESSION',      'cession');

define ('_HER_TBL_URL',          'url');
define ('_HER_TBL_SYNDICATION',  'syndication');
define ('_HER_TBL_FLUXRSS',      'fluxrss');
define ('_HER_TBL_LIBELLE',      'libelle');
define ('_HER_TBL_LECTURE',      'lecture');
define ('_HER_TBL_FRAME',        'frame');

define ('_HER_TBL_SONDAGE',      'sondage');
define ('_HER_TBL_REPONSE',      'reponse');
define ('_HER_TBL_RESULTAT',     'resultat');

define ('_HER_TBL_DECO',         'deco');
define ('_HER_TBL_DECOPP',       'decopp');
define ('_HER_TBL_DECOMODELE',   'decomodele');

define ('_HER_TBL_SOUSCRIPTION',   'souscription');
//-------------------------------------------------------

define ('_HER_TAB_LETTRE',       _HER_TBL_PREFIXE._HER_TBL_LETTRE);
define ('_HER_TAB_STRUCTURE',    _HER_TBL_PREFIXE._HER_TBL_STRUCTURE);
define ('_HER_TAB_GROUPE',       _HER_TBL_PREFIXE._HER_TBL_GROUPE);
define ('_HER_TAB_TEXTE',        _HER_TBL_PREFIXE._HER_TBL_TEXTE);
define ('_HER_TAB_ARCHIVE',      _HER_TBL_PREFIXE._HER_TBL_ARCHIVE);
define ('_HER_TAB_PLUGIN',       _HER_TBL_PREFIXE._HER_TBL_PLUGIN);
define ('_HER_TAB_PARAMS',       _HER_TBL_PREFIXE._HER_TBL_PARAMS);
define ('_HER_TAB_USERS',        _HER_TBL_PREFIXE._HER_TBL_USERS);
define ('_HER_TAB_PIECE',        _HER_TBL_PREFIXE._HER_TBL_PIECE);

define ('_HER_TAB_BONUS',        _HER_TBL_PREFIXE._HER_TBL_BONUS);
define ('_HER_TAB_ELEMENT',      _HER_TBL_PREFIXE._HER_TBL_ELEMENT);
define ('_HER_TAB_STYLE',        _HER_TBL_PREFIXE._HER_TBL_STYLE);
define ('_HER_TAB_TEMP',         _HER_TBL_PREFIXE._HER_TBL_TEMP);
define ('_HER_TAB_CESSION',      _HER_TBL_PREFIXE._HER_TBL_CESSION);

define ('_HER_TAB_URL',          _HER_TBL_PREFIXE._HER_TBL_URL);
define ('_HER_TAB_SYNDICATION',  _HER_TBL_PREFIXE._HER_TBL_SYNDICATION);
define ('_HER_TAB_FLUXRSS',      _HER_TBL_PREFIXE._HER_TBL_FLUXRSS);
define ('_HER_TAB_LIBELLE',      _HER_TBL_PREFIXE._HER_TBL_LIBELLE);
define ('_HER_TAB_LECTURE',      _HER_TBL_PREFIXE._HER_TBL_LECTURE);
define ('_HER_TAB_FRAME',        _HER_TBL_PREFIXE._HER_TBL_FRAME);

define ('_HER_TAB_SONDAGE',      _HER_TBL_PREFIXE._HER_TBL_SONDAGE);
define ('_HER_TAB_REPONSE',      _HER_TBL_PREFIXE._HER_TBL_REPONSE);
define ('_HER_TAB_RESULTAT',     _HER_TBL_PREFIXE._HER_TBL_RESULTAT);

define ('_HER_TAB_DECO',         _HER_TBL_PREFIXE._HER_TBL_DECO);
define ('_HER_TAB_DECOPP',       _HER_TBL_PREFIXE._HER_TBL_DECOPP);
define ('_HER_TAB_DECOMODELE',   _HER_TBL_PREFIXE._HER_TBL_DECOMODELE);

define ('_HER_TAB_SOUSCRIPTION', _HER_TBL_PREFIXE._HER_TBL_SOUSCRIPTION);
//-----------------------------------------------------------------
define ('_HER_XOOPS_TBL_USERS',       'users');
define ('_HER_XOOPS_TBL_GLOSSAIRE',   'glossaire');
define ('_HER_XOOPS_TBL_GROUPS',      'groups');
//-----------------------------------------------------------------



define ('_HER_TFN_LETTRE',       $xoopsDB->prefix(_HER_TAB_LETTRE));
define ('_HER_TFN_STRUCTURE',    $xoopsDB->prefix(_HER_TAB_STRUCTURE));
define ('_HER_TFN_GROUPE',       $xoopsDB->prefix(_HER_TAB_GROUPE));
define ('_HER_TFN_TEXTE',        $xoopsDB->prefix(_HER_TAB_TEXTE));
define ('_HER_TFN_ARCHIVE',      $xoopsDB->prefix(_HER_TAB_ARCHIVE));
define ('_HER_TFN_PLUGIN',       $xoopsDB->prefix(_HER_TAB_PLUGIN));
define ('_HER_TFN_PARAMS',       $xoopsDB->prefix(_HER_TAB_PARAMS));
define ('_HER_TFN_USERS',        $xoopsDB->prefix(_HER_TAB_USERS));
define ('_HER_TFN_PIECE',        $xoopsDB->prefix(_HER_TAB_PIECE));

define ('_HER_TFN_BONUS',        $xoopsDB->prefix(_HER_TAB_BONUS));
define ('_HER_TFN_ELEMENT',      $xoopsDB->prefix(_HER_TAB_ELEMENT));
define ('_HER_TFN_STYLE',        $xoopsDB->prefix(_HER_TAB_STYLE));
define ('_HER_TFN_TEMP',         $xoopsDB->prefix(_HER_TAB_TEMP));
define ('_HER_TFN_CESSION',      $xoopsDB->prefix(_HER_TAB_CESSION));

define ('_HER_TFN_URL',          $xoopsDB->prefix(_HER_TAB_URL));
define ('_HER_TFN_SYNDICATION',  $xoopsDB->prefix(_HER_TAB_SYNDICATION));
define ('_HER_TFN_FLUXRSS',      $xoopsDB->prefix(_HER_TAB_FLUXRSS));
define ('_HER_TFN_LIBELLE',      $xoopsDB->prefix(_HER_TAB_LIBELLE));
define ('_HER_TFN_LECTURE',      $xoopsDB->prefix(_HER_TAB_LECTURE));
define ('_HER_TFN_FRAME',        $xoopsDB->prefix(_HER_TAB_FRAME));

define ('_HER_TFN_SONDAGE',      $xoopsDB->prefix(_HER_TAB_SONDAGE));
define ('_HER_TFN_REPONSE',      $xoopsDB->prefix(_HER_TAB_REPONSE));
define ('_HER_TFN_RESULTAT',     $xoopsDB->prefix(_HER_TAB_RESULTAT));


define ('_HER_TFN_DECO',        $xoopsDB->prefix(_HER_TAB_DECO));
define ('_HER_TFN_DECOPP',      $xoopsDB->prefix(_HER_TAB_DECOPP));
define ('_HER_TFN_DECOMODELE',  $xoopsDB->prefix(_HER_TAB_DECOMODELE));

define ('_HER_TFN_SOUSCRIPTION',$xoopsDB->prefix(_HER_TAB_SOUSCRIPTION));

define ('_HER_TFN_LGPREFIXE0',  strlen($xoopsDB->prefix(_HER_TBL_PREFIXE)));
define ('_HER_TFN_LGPREFIXE1',  strlen($xoopsDB->prefix(_HER_TBL_PREFIXE))-strlen(_HER_TBL_PREFIXE));
//-----------------------------------------------------------------
define ('_HER_TFN_XUSER',       $xoopsDB->prefix('users'));
define ('_HER_TFN_XGUID',       $xoopsDB->prefix('groups_users_link'));

//-----------------------------------------------------------------
//define ('_HER_GOTO_ADMIN', "javascript:window.navigate(\"".XOOPS_URL.""._HER_SUB_FOLDER."admin/index.php\");");
//define ('_HER_GOTO_ADMIN', buildUrlJava(XOOPS_URL._HER_SUB_FOLDER."admin/index.php",false)); 


//-----------------------------------------------------------------

//---------------------------------
define ('_HERJJD_DEBUG',        255);
//---------------------------------
define ('_HERJJD_DEBUG_NONE',   0);
define ('_HERJJD_DEBUG_ALL',  255);

define ('_HERJJD_DEBUG_VAR',    1);
define ('_HERJJD_DEBUG_SQL',    2);
define ('_HERJJD_DEBUG_ARRAY',  4);
define ('_HERJJD_DEBUG_08',     8);
define ('_HERJJD_DEBUG_16',    16);
define ('_HERJJD_DEBUG_32',    32);




//------------------------------------------------------------------------
//attention que ces consante soit sinchrone avec la liste dans admin_Acces 
//qui permet de definirles autotisation
//------------------------------------------------------------------------
define('_HERBTN_VISIBLE',       1);
define('_HERBTN_VIEW',          2);
define('_HERBTN_EDIT',          4);
define('_HERBTN_NEW',           8);
define('_HERBTN_DELETE',       16);
define('_HERBTN_PRINT',        32);
define('_HERBTN_SENDMAIL',     64);
define('_HERBTN_COMMENT',     128);
define('_HERBTN_SEARCH',      256);
define('_HERBTN_ASKDEF',      512);
define('_HERBTN_ADMIN',      1024);


$h=0;
define('_HER_BYTE_VISIBLE',       $h++);
define('_HER_BYTE_VIEW',          $h++);
define('_HER_BYTE_EDIT',          $h++);
define('_HER_BYTE_NEW',           $h++);
define('_HER_BYTE_DELETE',        $h++);
define('_HER_BYTE_PRINT',         $h++);
define('_HER_BYTE_SENDMAIL',      $h++);
define('_HER_BYTE_COMMENT',       $h++);
define('_HER_BYTE_SEARCH',        $h++);
define('_HER_BYTE_ASKDEF',        $h++);
define('_HER_BYTE_ADMIN',         $h++);
define('_HER_BYTE_SHOWOPTION',    $h++);
define('_HER_BYTE_SHOWVISIT' ,    $h++);


define('_HERBTN_COMMENT1',  8192);
define('_HERBTN_COMMENT2', 16384);

define('_HERBTN_ALL',       255);
define('_HERBTN_NONE',        0);

define('_HERBTN_MENU0',    _HERBTN_NEW + _HERBTN_SEARCH + _HERBTN_ASKDEF + _HERBTN_ADMIN);
//------------------------------------------------------------------------



/************************************************************************
 * periodicite
 ************************************************************************/
define('_HER_PERIODE_ANNUELLE',         0);
define('_HER_PERIODE_SEMESTRIELLE',     1);
define('_HER_PERIODE_TRIMESTRIELLE',    2);
define('_HER_PERIODE_BIMENSUELLE',      3);
define('_HER_PERIODE_MENSUELLE',        4);
define('_HER_PERIODE_HEBDOMADAIRE',     5);
define('_HER_PERIODE_JOURNALIERE',      6);

                             
/************************************************************************
 * ces constante doivesnt avoir les nom des constantes par defaut non prefixées
 ************************************************************************/


//--------------------------------------------------


//*************************************************************************//



define ('_HER_PREFIX_ID'    , 'id_');
define ('_HER_PREFIX_NAME'  , 'name_');
/*************************************************************************
* frfinition de constante pour la gestion des droit d'acces
*************************************************************************/
   
//attention que ces consante soit sinchrone avec la liste dans admin_Acces 
//qui permet de definirles autotisation



define('_HER_BYTE_DEFINITION1', 0);
define('_HER_BYTE_DEFINITION2', 1);
define('_HER_BYTE_DEFINITION3', 2);
define('_HER_BYTE_SHORTDEF'   , 3);
define('_HER_BYTE_CATEGORYS'  , 4);
define('_HER_BYTE_SEEALSO'    , 5);

/*************************************************************************
* definition des constantes d'envoi de lettre
*************************************************************************/
define ('_HER_TEST'     ,0);
define ('_HER_PREVIEW'  ,1);
define ('_HER_SEND'     ,2);
define ('_HER_SENDTEST' ,3);

/*************************************************************************
* definition des onglets
*************************************************************************/
$h = 1;
define('_HER_ONGLET_GESTION',       $h++);
define('_HER_ONGLET_LETTRE',        $h++);
define('_HER_ONGLET_STAT',          $h++);
define('_HER_ONGLET_TEXTE',         $h++);
define('_HER_ONGLET_SONDAGE',       $h++);
define('_HER_ONGLET_DECO',          $h++);
//define('_HER_ONGLET_FRAME',         $h++);
define('_HER_ONGLET_LIBELLE',       $h++);
define('_HER_ONGLET_PLUGIN',        $h++);
define('_HER_ONGLET_FILES',         $h++);
define('_HER_ONGLET_EMAIL',         $h++);
//define('_HER_ONGLET_FLUXRSS'    ,   $h++);
//define('_HER_ONGLET_SYNDICATION',   $h++);
//define('_HER_ONGLET_CODE',          $h++);
define('_HER_ONGLET_USERSTATUS',    $h++);
define('_HER_ONGLET_DOC',           $h++);
define('_HER_ONGLET_DEVELOPPEUR',   $h++);
define('_HER_ONGLET_LICENCE',       $h++);
define('_HER_ONGLET_HISTO',         $h++);
//define('_HER_ONGLET_'  , 4);

/*************************************************************************
* prefixe des codes de remplacements
*************************************************************************/
define('_HER_CODE_USER',        '_user.');
define('_HER_CODE_SITE',        '_site.');
define('_HER_CODE_SOUSCRIBE',   '_souscribe.');


/*************************************************************************
* code element
*************************************************************************/

define('_HER_EL_SYSTEM',   0);
define('_HER_EL_PLUGIN',   1);
define('_HER_EL_TEXTE',    2);
define('_HER_EL_BANNIERE', 3);
define('_HER_EL_FLUXRSS',  4);
define('_HER_EL_STYLE',    5);
define('_HER_EL_DECO' ,    6);

/*************************************************************************
* autres
*************************************************************************/
define ('_HER_PREFIXE_LIBELLE', 'lib.' );
define ('_HER_PREFIXE_SONDAGE', 'sondage.' );
define('_HER_PREFIXE_TEMPLATE',    'generique');
define('_HER_HR_COLOR1',    '839D2D');



//parametre du block de subscription capcha
/*
affichage de la sisie du nom
afficher le capcha
$Caption
$ForMembers
$NumChars
$MinFontSize
$MaxFontSize
$BackgroundType
$NumBackground
$SessionName
$SensitiveCase
*/

define('_HER_BLOCK_PARAM_SUB',    '1|1|CAPCHA|1|5|12|16|0|50|securityimage|1');



//define('_HER_TR_bgColor_0',    '839D2D');
//define('_HER_TR_bgColor_1',    'FF9D2D');
//define('_HER_TR_bgColor_0',    'CBD7A1');
//define('_HER_TR_bgColor_1',    'F7C78E');


define('_HER_TR_BASE',         3);
define('_HER_TR_bgColor_0',    'dbe0c6');
define('_HER_TR_bgColor_1',    'c6e1de');
define('_HER_TR_bgColor_2',    'f2dabe');

define('_HER_color_disabled',  '#D2D2D2');

define('_HER_CODE_RUPTURE',    'z-999');
//---------------------------------------------------------
define('_HER_BALISE_PROPERTY',  'header|footer|moduleName|version|pluginName|'
                               .'description|identifiant');
    

// idStructure|idElement|idItem|editBeforeSend|miseEnForme||params|flag
define('_HER_BALISE_STRUCTURE',  'idLettre|nom|cadreBorderWidth|ordre|'
         .'cadreBorderColor|lineBeforeWidth|'
         .'lineBeforeColor|lineAfterWidth|lineAfterColor');
  
 
//---------------------------------------------------------
define('_HER_BALISE_GEN_TEMPLATE',   1);
define('_HER_BALISE_GEN_AFFICHAGE',  2);
define('_HER_BALISE_GEN_NOM',        4);
define('_HER_BALISE_GEN_PERIODE',    8);
define('_HER_BALISE_GEN_MAXITEM',   16);
define('_HER_BALISE_GEN_CATSIZE',   32);
define('_HER_BALISE_GEN_FRAME',     64);

define('_HER_LIST_ID_ITEM',   'listIdItem');
define('_HER_LIST_ID_CAT',    'listIdCategorie');



//---------------------------------------------------------
define('_HER_TYPE_PARAMS_BALISE',     -1);
define('_HER_TYPE_PARAMS_VARCHAR',    0);//---nom - valeur en direct du plugin
define('_HER_TYPE_PARAMS_SPIN',       1);//c'est un spin
define('_HER_TYPE_PARAMS_LIST',       2 );//c'est une liste de libele dont le numéro d'ordre est atomatique 
define('_HER_TYPE_PARAMS_TEMPLATE',   3);//c'est un template affiche la lsite des template du module + les g‚n‚riques
define('_HER_TYPE_PARAMS_AFFICHAGE',  4);//options d'affichage
define('_HER_TYPE_PARAMS_TEXT',       5);//zone de texte
define('_HER_TYPE_PARAMS_FRAME',      6);//modele de cadre
define('_HER_TYPE_PARAMS_TITLE',      10);//c'est un titre    


//define('_HER_TYPE_PARAMS_',    );
//define('_HER_TYPE_PARAMS_',    );


//---------------------------------------------------------
//nom des balise hermes pur les template de lettre
//---------------------------------------------------------
define('_HER_SMARTY_TITLE',          'her_title');
define('_HER_SMARTY_SHEETSTYLE',     'her_stylesheet');
define('_HER_SMARTY_COPYRIGHT',      'her_copyright');
define('_HER_SMARTY_TPLNAME',        'her_tplname');
define('_HER_SMARTY_HEADER',         'her_header');
define('_HER_SMARTY_FOOTER',         'her_footer');

define('_HER_SMARTY_STAT',           'her_stat');
define('_HER_SMARTY_DESCRIPTION',    'her_description');
define('_HER_SMARTY_AVERTISSEMENT',  'her_avertissement');


/***************************************************************************
 *il faudra peut ˆtre creer un ficichier specifique pour les listes standards
 ***************************************************************************/
function aList($codeList, $addFirstRow = false, $libFirstRow = ''){
  
  switch (strtolower($codeList)){
  case 'noyes':         $list = aList_noYes()       ;break;
  case 'yesno':         $list = aList_yesNo()       ;break;
  case 'fontsize':      $list = aList_fontSize()    ;break;
  case 'icolight':      $list = aList_icoLight()    ;break;
  case 'imgmode':       $list = aList_imgMode()     ;break;
  case 'imgrepeat':     $list = aList_imgRepeat()   ;break;
  case 'positionv':     $list = aList_positionV()   ;break;
  case 'positionh':     $list = aList_positionH()   ;break;
  case 'periodicite':   $list = aList_periodicite() ;break;
  //case '':   $list = ()       ;break;
  //case '':   $list = ()       ;break;
    
  default : $list = array();
  }

  if ($addFirstRow) array_unshift ($list, $libFirstRow);
  return $list;
}


/***************************************************************************
 *il faudra peut ˆtre creer un ficichier specifique pour les listes standards
 ***************************************************************************/
function aList_noYes(){
  return array(_AD_HER_NO, _AD_HER_YES); 
}
//---------------------------------------------------------------------------
function aList_yesNo(){
  return array(_AD_HER_YES, _AD_HER_NO); 
}

//---------------------------------------------------------------------------
function aList_periodicite(){
    return array(_AD_HER_PERIODE_ANNUELLE,
                 _AD_HER_PERIODE_SEMESTRIELLE,
                 _AD_HER_PERIODE_TRIMESTRIELLE,
                 _AD_HER_PERIODE_BIMENSUELLE,
                 _AD_HER_PERIODE_MENSUELLE,
                 _AD_HER_PERIODE_HEBDOMADAIRE,
                 _AD_HER_PERIODE_JOURNALIERE);
}
//---------------------------------------------------------------------------
function aList_positionH(){
  return array(_AD_HER_POSITION_LEFT,
               _AD_HER_POSITION_CENTER,
               _AD_HER_POSITION_RIGHT);
}


//---------------------------------------------------------------------------
function aList_positionV(){
  return array(_AD_HER_POSITION_TOP,
               _AD_HER_POSITION_CENTER,
               _AD_HER_POSITION_BOTTOM); 
}

//---------------------------------------------------------------------------
function aList_imgRepeat(){
  return array(_AD_HER_REPEAT_NONE,
               _AD_HER_REPEAT_FULL,
               _AD_HER_REPEAT_HOR,
               _AD_HER_REPEAT_VER); 
}

//---------------------------------------------------------------------------
function aList_imgMode(){
  
  return array(_AD_HER_REPEAT_FIXE,
               _AD_HER_REPEAT_SCROLL); 
}

//---------------------------------------------------------------------------
function aList_icoLight(){

  return array(_JJDICO_LIGHT_RED,
               _JJDICO_LIGHT_ORANGE,
               _JJDICO_LIGHT_YELLOW,
               _JJDICO_LIGHT_GREEN,
               _JJDICO_LIGHT_WHITE,
               _JJDICO_LIGHT_OFF);
}

//---------------------------------------------------------------------------
function aList_fontSize(){
  return array(_AD_HER_XSMALL,
               _AD_HER_SMALL,
               _AD_HER_MIDDLE,
               _AD_HER_LARGE,
               _AD_HER_XLARGE,
               _AD_HER_XXLARGE);
}

//---------------------------------------------------------------------------
function aList_vote(){
  return array(_AD_HER_VOTE_NONE,
               _AD_HER_VOTE_FIRST,
               _AD_HER_VOTE_LAST,
               _AD_HER_VOTE_ALL);
}

/*

//---------------------------------------------------------------------------
function aList_(){
  return  
}
*/


?>
