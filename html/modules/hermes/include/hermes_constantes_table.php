<?php

//------------------------------------------------
// definition des constante de table
//------------------------------------------------
define ('_HER_TBL_PREFIXE',     'her_');
//------------------------------------------------
define ('_HER_TBL_ARCHIVE'            , 'archive');
define ('_HER_TBL_BONUS'              , 'bonus');
define ('_HER_TBL_CESSION'            , 'cession');
define ('_HER_TBL_DECO'               , 'deco');
define ('_HER_TBL_DECOMODELE'         , 'decomodele');
define ('_HER_TBL_DECOPP'             , 'decopp');
define ('_HER_TBL_ELEMENT'            , 'element');
define ('_HER_TBL_FLUXRSS'            , 'fluxrss');
define ('_HER_TBL_FRAME'              , 'frame');
define ('_HER_TBL_GROUPE'             , 'groupe');
define ('_HER_TBL_LECTURE'            , 'lecture');
define ('_HER_TBL_LETTRE'             , 'lettre');
define ('_HER_TBL_LIBELLE'            , 'libelle');
define ('_HER_TBL_PARAMS'             , 'params');
define ('_HER_TBL_PIECE'              , 'piece');
define ('_HER_TBL_PLUGIN'             , 'plugin');
define ('_HER_TBL_REPONSE'            , 'reponse');
define ('_HER_TBL_RESULTAT'           , 'resultat');
define ('_HER_TBL_SONDAGE'            , 'sondage');
define ('_HER_TBL_STRUCTURE'          , 'structure');
define ('_HER_TBL_STYLE'              , 'style');
define ('_HER_TBL_SYNDICATION'        , 'syndication');
define ('_HER_TBL_TEMP'               , 'temp');
define ('_HER_TBL_TEXTE'              , 'texte');
define ('_HER_TBL_URL'                , 'url');
define ('_HER_TBL_USERS'              , 'users');
//------------------------------------------------
define ('_HER_TAB_ARCHIVE'            , _HER_TBL_PREFIXE._HER_TBL_ARCHIVE);
define ('_HER_TAB_BONUS'              , _HER_TBL_PREFIXE._HER_TBL_BONUS);
define ('_HER_TAB_CESSION'            , _HER_TBL_PREFIXE._HER_TBL_CESSION);
define ('_HER_TAB_DECO'               , _HER_TBL_PREFIXE._HER_TBL_DECO);
define ('_HER_TAB_DECOMODELE'         , _HER_TBL_PREFIXE._HER_TBL_DECOMODELE);
define ('_HER_TAB_DECOPP'             , _HER_TBL_PREFIXE._HER_TBL_DECOPP);
define ('_HER_TAB_ELEMENT'            , _HER_TBL_PREFIXE._HER_TBL_ELEMENT);
define ('_HER_TAB_FLUXRSS'            , _HER_TBL_PREFIXE._HER_TBL_FLUXRSS);
define ('_HER_TAB_FRAME'              , _HER_TBL_PREFIXE._HER_TBL_FRAME);
define ('_HER_TAB_GROUPE'             , _HER_TBL_PREFIXE._HER_TBL_GROUPE);
define ('_HER_TAB_LECTURE'            , _HER_TBL_PREFIXE._HER_TBL_LECTURE);
define ('_HER_TAB_LETTRE'             , _HER_TBL_PREFIXE._HER_TBL_LETTRE);
define ('_HER_TAB_LIBELLE'            , _HER_TBL_PREFIXE._HER_TBL_LIBELLE);
define ('_HER_TAB_PARAMS'             , _HER_TBL_PREFIXE._HER_TBL_PARAMS);
define ('_HER_TAB_PIECE'              , _HER_TBL_PREFIXE._HER_TBL_PIECE);
define ('_HER_TAB_PLUGIN'             , _HER_TBL_PREFIXE._HER_TBL_PLUGIN);
define ('_HER_TAB_REPONSE'            , _HER_TBL_PREFIXE._HER_TBL_REPONSE);
define ('_HER_TAB_RESULTAT'           , _HER_TBL_PREFIXE._HER_TBL_RESULTAT);
define ('_HER_TAB_SONDAGE'            , _HER_TBL_PREFIXE._HER_TBL_SONDAGE);
define ('_HER_TAB_STRUCTURE'          , _HER_TBL_PREFIXE._HER_TBL_STRUCTURE);
define ('_HER_TAB_STYLE'              , _HER_TBL_PREFIXE._HER_TBL_STYLE);
define ('_HER_TAB_SYNDICATION'        , _HER_TBL_PREFIXE._HER_TBL_SYNDICATION);
define ('_HER_TAB_TEMP'               , _HER_TBL_PREFIXE._HER_TBL_TEMP);
define ('_HER_TAB_TEXTE'              , _HER_TBL_PREFIXE._HER_TBL_TEXTE);
define ('_HER_TAB_URL'                , _HER_TBL_PREFIXE._HER_TBL_URL);
define ('_HER_TAB_USERS'              , _HER_TBL_PREFIXE._HER_TBL_USERS);
//------------------------------------------------
define ('_HER_TFN_ARCHIVE'            , $xoopsDB->prefix(_HER_TAB_ARCHIVE));
define ('_HER_TFN_BONUS'              , $xoopsDB->prefix(_HER_TAB_BONUS));
define ('_HER_TFN_CESSION'            , $xoopsDB->prefix(_HER_TAB_CESSION));
define ('_HER_TFN_DECO'               , $xoopsDB->prefix(_HER_TAB_DECO));
define ('_HER_TFN_DECOMODELE'         , $xoopsDB->prefix(_HER_TAB_DECOMODELE));
define ('_HER_TFN_DECOPP'             , $xoopsDB->prefix(_HER_TAB_DECOPP));
define ('_HER_TFN_ELEMENT'            , $xoopsDB->prefix(_HER_TAB_ELEMENT));
define ('_HER_TFN_FLUXRSS'            , $xoopsDB->prefix(_HER_TAB_FLUXRSS));
define ('_HER_TFN_FRAME'              , $xoopsDB->prefix(_HER_TAB_FRAME));
define ('_HER_TFN_GROUPE'             , $xoopsDB->prefix(_HER_TAB_GROUPE));
define ('_HER_TFN_LECTURE'            , $xoopsDB->prefix(_HER_TAB_LECTURE));
define ('_HER_TFN_LETTRE'             , $xoopsDB->prefix(_HER_TAB_LETTRE));
define ('_HER_TFN_LIBELLE'            , $xoopsDB->prefix(_HER_TAB_LIBELLE));
define ('_HER_TFN_PARAMS'             , $xoopsDB->prefix(_HER_TAB_PARAMS));
define ('_HER_TFN_PIECE'              , $xoopsDB->prefix(_HER_TAB_PIECE));
define ('_HER_TFN_PLUGIN'             , $xoopsDB->prefix(_HER_TAB_PLUGIN));
define ('_HER_TFN_REPONSE'            , $xoopsDB->prefix(_HER_TAB_REPONSE));
define ('_HER_TFN_RESULTAT'           , $xoopsDB->prefix(_HER_TAB_RESULTAT));
define ('_HER_TFN_SONDAGE'            , $xoopsDB->prefix(_HER_TAB_SONDAGE));
define ('_HER_TFN_STRUCTURE'          , $xoopsDB->prefix(_HER_TAB_STRUCTURE));
define ('_HER_TFN_STYLE'              , $xoopsDB->prefix(_HER_TAB_STYLE));
define ('_HER_TFN_SYNDICATION'        , $xoopsDB->prefix(_HER_TAB_SYNDICATION));
define ('_HER_TFN_TEMP'               , $xoopsDB->prefix(_HER_TAB_TEMP));
define ('_HER_TFN_TEXTE'              , $xoopsDB->prefix(_HER_TAB_TEXTE));
define ('_HER_TFN_URL'                , $xoopsDB->prefix(_HER_TAB_URL));
define ('_HER_TFN_USERS'              , $xoopsDB->prefix(_HER_TAB_USERS));
//------------------------------------------------
?>