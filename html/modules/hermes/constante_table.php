//------------------------------------------------
//------------------------------------------------
//------------------------------------------------
define ('BAB_TBL_PREFIXE',     'her_');
//------------------------------------------------
define (_BAB_TBL_ACTEUR               , 'acteur');
define (_BAB_TBL_CONSTANTE            , 'constante');
define (_BAB_TBL_DEFINITION           , 'definition');
define (_BAB_TBL_FICHIER              , 'fichier');
define (_BAB_TBL_LANGUE               , 'langue');
define (_BAB_TBL_PROJET               , 'projet');
//------------------------------------------------
define (_BAB_TBA_ACTEUR               , _BAB_TBL_PREFIXE._BAB_TBL_ACTEUR);
define (_BAB_TBA_CONSTANTE            , _BAB_TBL_PREFIXE._BAB_TBL_CONSTANTE);
define (_BAB_TBA_DEFINITION           , _BAB_TBL_PREFIXE._BAB_TBL_DEFINITION);
define (_BAB_TBA_FICHIER              , _BAB_TBL_PREFIXE._BAB_TBL_FICHIER);
define (_BAB_TBA_LANGUE               , _BAB_TBL_PREFIXE._BAB_TBL_LANGUE);
define (_BAB_TBA_PROJET               , _BAB_TBL_PREFIXE._BAB_TBL_PROJET);
//------------------------------------------------
define (_BAB_TFN_ACTEUR               , $xoopsDB->prefix(_BAB_TBA_ACTEUR));
define (_BAB_TFN_CONSTANTE            , $xoopsDB->prefix(_BAB_TBA_CONSTANTE));
define (_BAB_TFN_DEFINITION           , $xoopsDB->prefix(_BAB_TBA_DEFINITION));
define (_BAB_TFN_FICHIER              , $xoopsDB->prefix(_BAB_TBA_FICHIER));
define (_BAB_TFN_LANGUE               , $xoopsDB->prefix(_BAB_TBA_LANGUE));
define (_BAB_TFN_PROJET               , $xoopsDB->prefix(_BAB_TBA_PROJET));
//------------------------------------------------