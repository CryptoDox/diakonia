<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}


function tdmspot_seo_title($title = '', $withExt = true) {

    /**
     * if XOOPS ML is present, let's sanitize the title with the current language
     */
     $myts = MyTextSanitizer::getInstance();
     if (method_exists($myts, 'formatForML')) {
     	$title = $myts->formatForML($title);
     }

    // Transformation de la chaine en minuscule
    // Codage de la chaine afin d'éviter les erreurs 500 en cas de caractères imprévus
    $title   = rawurlencode(strtolower($title));

    // Transformation des ponctuations
    //                 Tab     Space      !        "        #        %        &        '        (        )        ,        /        :        ;        <        =        >        ?        @        [        \        ]        ^        {        |        }        ~       .
    $pattern = array("/%09/", "/%20/", "/%21/", "/%22/", "/%23/", "/%25/", "/%26/", "/%27/", "/%28/", "/%29/", "/%2C/", "/%2F/", "/%3A/", "/%3B/", "/%3C/", "/%3D/", "/%3E/", "/%3F/", "/%40/", "/%5B/", "/%5C/", "/%5D/", "/%5E/", "/%7B/", "/%7C/", "/%7D/", "/%7E/", "/\./");
    $rep_pat = array(  "-"  ,   "-"  ,   ""   ,   ""   ,   ""   , "-100" ,   ""   ,   "-"  ,   ""   ,   ""   ,   ""   ,   "-"  ,   ""   ,   ""   ,   ""   ,   "-"  ,   ""   ,   ""   , "-at-" ,   ""   ,   "-"   ,  ""   ,   "-"  ,   ""   ,   "-"  ,   ""   ,   "-"  ,  ""  );
    $title   = preg_replace($pattern, $rep_pat, $title);

    // Transformation des caractères accentués
    //                  è        é        ê        ë        ç        à        â        ä        î        ï        ù        ü        û        ô        ö
    $pattern = array("/%B0/", "/%E8/", "/%E9/", "/%EA/", "/%EB/", "/%E7/", "/%E0/", "/%E2/", "/%E4/", "/%EE/", "/%EF/", "/%F9/", "/%FC/", "/%FB/", "/%F4/", "/%F6/");
    $rep_pat = array(  "-", "e"  ,   "e"  ,   "e"  ,   "e"  ,   "c"  ,   "a"  ,   "a"  ,   "a"  ,   "i"  ,   "i"  ,   "u"  ,   "u"  ,   "u"  ,   "o"  ,   "o"  );
    $title   = preg_replace($pattern, $rep_pat, $title);

    if (sizeof($title) > 0) {
        return $title;
    }

    return '';
}

function tdmspot_seo_genUrl($op, $id,  $short_url = "", $start = null, $limit = false, $tris = false) {
    //$publisher =& PublisherPublisher::getInstance();
	
$module_handler =& xoops_gethandler('module');
$xoopsModule =& $module_handler->getByDirname('TDMSpot');

if(!isset($xoopsModuleConfig)){
	$config_handler = &xoops_gethandler('config');
	$xoopsModuleConfig = &$config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));
    }	
	
    if ($xoopsModuleConfig['tdmspot_seo'] == 1)
    {
    	if (! empty($short_url)) $short_url = tdmspot_seo_title($short_url) . '.html';

        if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
            // generate SEO url using htaccess
			$url = '';
			if (! empty($id))  $url .= "/${id}";
			if (! is_null($start))  $url .= "/${start}";
			if (! empty($limit))  $url .= "/${limit}";
			if (! empty($tris))  $url .= "/${tris}";
			return XOOPS_URL . '/' . $xoopsModuleConfig['tdmspot_seo_title']  . "/${op}$url/${short_url}";
		} else {
            die('Unknown SEO method.');
        }
    } else {
       // generate classic url

	   //seo Map
$seoMap = array(
	 $xoopsModuleConfig['tdmspot_seo_cat']  => 'viewcat.php',
	 $xoopsModuleConfig['tdmspot_seo_item'] => 'item.php',
	'print' => 'print.php',
	'pdf' => 'pdf.php',
	'submit' => 'submit.php',
	'rss' => 'rss.php',
	'download' => 'download.php',
	'index' => 'index.php'
);
			
			$url = '';
			$id_item = '';
			$id_cat = '';
			if (! empty($id))  $id_item = "itemid=${id}";
			if (! empty($id))  $id_cat = "LT=${id}";
			if (! is_null($start))  $url .= "&start=${start}";
			if (! empty($limit))  $url .= "&limit=${limit}";
			if (! empty($tris))  $url .= "&tris=${tris}";

        switch ($op) {
            case $xoopsModuleConfig['tdmspot_seo_cat'] :
               return XOOPS_URL.'/modules/'.$xoopsModule->getVar("dirname")."/".$seoMap[$op]."?".@$id_cat."${url}";
			case $xoopsModuleConfig['tdmspot_seo_item']:
            case 'print':
			case 'pdf':
			case 'submit':
			case 'rss':
			case 'download':
			case 'index':
              return XOOPS_URL.'/modules/'.$xoopsModule->getVar("dirname")."/".$seoMap[$op]."?".@$id_item;
            default:
                die('Unknown SEO operation.');
        }
    }
}
?>
