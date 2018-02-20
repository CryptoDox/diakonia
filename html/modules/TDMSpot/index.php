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

include_once '../../mainfile.php';
$xoopsOption['template_main'] = 'spot_index.html';
require(XOOPS_ROOT_PATH.'/header.php');

include_once XOOPS_ROOT_PATH."/class/template.php";
include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$page_handler =& xoops_getModuleHandler('tdmspot_page', 'TDMSpot');
$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');
$block_handler =& xoops_getModuleHandler('tdmspot_newblocks', 'TDMSpot');
$gperm_handler =& xoops_gethandler('groupperm');

if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
    include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/seo.inc.php';
}

//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}

//permission d'afficher
if (!$gperm_handler->checkRight('spot_view', 2, $groups, $xoopsModule->getVar('mid'))) {
	redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	 exit();
    }

	$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : $xoopsModuleConfig['tdmspot_page'];
	$tris = isset($_REQUEST['tris']) ? $_REQUEST['tris'] : 'indate';
	$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
	$itemid = isset($_REQUEST['itemid']) ? $_REQUEST['itemid'] : 0;
 
$myts =& MyTextSanitizer::getInstance();

// ************************************************************
// Liste des Categories
// ************************************************************
		$cat_arr = $cat_handler->getall();
		$mytree = new TDMObjectTree($cat_arr, 'id', 'pid');
		//asigne les URL
		define("TDM_CAT_URL", TDMSPOT_CAT_URL);
		define("TDM_CAT_PATH", TDMSPOT_CAT_PATH);
		$cat_display = $xoopsModuleConfig['tdmspot_cat_display'];
		$cat_cel = $xoopsModuleConfig['tdmspot_cat_cel'];
		$display_cat = $mytree->makeCatBox($item_handler, 'title','-', $cat = false);
		$xoopsTpl->assign('display_cat', $display_cat);

	// ************************************************************
 // Liste des Pages
 // ************************************************************
	
	$criteria = new CriteriaCompo();
	
	if ( !empty($itemid) && is_numeric($itemid)) {
	$itemid = intval($itemid);
	$criteria->add(new Criteria('id', $itemid));
		}
	
	$criteria->add(new Criteria('visible', 1));	
	$criteria->setSort('weight');
	$criteria->setOrder('ASC');
	$criteria->setLimit(1);
	$page_arr = $page_handler->getObjects( $criteria );
	
	$page = array();
	$tptabs = array();
	
	foreach (array_keys($page_arr) as $p) {
	if ($gperm_handler->checkRight('spot_pageview', $page_arr[$p]->getVar('id'), $groups, $xoopsModule->getVar('mid')))
	{
	
	if ($xoopsModuleConfig['tdmspot_name'] == 1) {
	$page['title'] = $page_arr[$p]->getVar('title');
	}
	$page['id'] = $page_arr[$p]->getVar('id');
//tabs
$tptabs['title'] = $page_arr[$p]->getVar('title');
$tptabs['id'] = $page_arr[$p]->getVar('id');
//cherche les blocks
$criteria = new CriteriaCompo();
	
$criteria->add(new Criteria('visible', 1));
$criteria->add(new Criteria('pid', $page_arr[$p]->getVar('id')));	
$criteria->setSort('weight');
$criteria->setOrder('ASC');
$block_arr = $block_handler->getObjects($criteria);
//$tpblock = array();
foreach (array_keys($block_arr) as $b) {

$tpblock['title'] = $block_arr[$b]->getVar('title');
$tpblock['side'] = $block_arr[$b]->getVar('side');
$tpblock['pid'] = $block_arr[$b]->getVar('pid');

//crée le block
$xoopsblock_arr = new XoopsBlock($block_arr[$b]->getVar('bid'));	

@include_once XOOPS_ROOT_PATH."/modules/".$xoopsblock_arr->getVar('dirname')."/blocks/".$xoopsblock_arr->getVar('func_file');
@include_once XOOPS_ROOT_PATH."/modules/".$xoopsblock_arr->getVar('dirname')."/language/".$xoopsConfig['language']."/blocks.php";

$opt = $block_arr[$b]->getVar("options") ? $block_arr[$b]->getVar("options") : $xoopsblock_arr->getVar('options');

$show_func = $xoopsblock_arr->getVar('show_func');
$options = explode("|", $opt);
$block = $show_func($options);
$GLOBALS['xoopsLogger']->startTime($block_arr[$b]->getVar('title'));
$GLOBALS['xoopsTpl']->assign('block', $block);
$tpblock['content'] = $GLOBALS['xoopsTpl']->fetch("db:".$xoopsblock_arr->getVar("template"));
$GLOBALS['xoopsLogger']->stopTime($block_arr[$b]->getVar('title'));
$page['tpblock'][] = $tpblock;
}

// ************************************************************
 // Liste des News
 // ************************************************************
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('display', 1));
$criteria->add(new Criteria('indate', time(), '<'));
$criteria->setSort('indate');
$criteria->setOrder('ASC');
$criteria->add(new Criteria('cat', '(' .$page_arr[$p]->getVar('cat'). ')','IN'));
$item_arr = $item_handler->getall($criteria);
foreach (array_keys($item_arr) as $i) {

if ($gperm_handler->checkRight('tdmpicture_catview', $item_arr[$i]->getVar('cat'), $groups, $xoopsModule->getVar('mid'))) {

$tpitem['id'] = $item_arr[$i]->getVar('id');
$tpitem['title'] = $item_arr[$i]->getVar('title');
$tpitem['cat'] = $item_arr[$i]->getVar('cat');
		//trouve la categorie
		if ($cat =& $cat_handler->get($item_arr[$i]->getVar('cat'))) {
		$tpitem['cat_title'] = $cat->getVar('title');
		$tpitem['cat_link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $cat->getVar('id'), $cat->getVar('title'));
		$tpitem['cat_id'] = $cat->getVar('id');
		if ($xoopsModuleConfig['tdmspot_img'] == 1) {
		$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img");
		if (file_exists($imgpath)) {
		$redim = tdmspot_redimage( $imgpath,$xoopsModuleConfig['tdmspot_cat_width'],$xoopsModuleConfig['tdmspot_cat_height']);
		$tpitem['img'] = "<img src=".XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img")." height='".$redim['dst_h']."' width='".$redim['dst_w']."'>";
		//$tpitem['img'] = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img");
		} else {
		$tpitem['img'] = false;
		} } } 
		
	$tpitem['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));	

	if (strpos($item_arr[$i]->getVar('text'),'{X_BREAK}')) {
	$more = substr($item_arr[$i]->getVar('text'), strpos($item_arr[$i]->getVar('text'),'{X_BREAK}')+11 );
	$tpitem['text'] = substr($item_arr[$i]->getVar('text'),0,strpos($item_arr[$i]->getVar('text'),'{X_BREAK}') )."<a href='".$tpitem['link']."' rel='nofollow'>[...]</a>";
	$tpitem['more'] = strlen($more);
	} else {
	$tpitem['text'] = $item_arr[$i]->getVar('text');
	}


$tpitem['indate'] = formatTimeStamp($item_arr[$i]->getVar("indate"),"m");
$tpitem['hits'] = $item_arr[$i]->getVar('hits');
$tpitem['votes'] =  $item_arr[$i]->getVar("votes");
$tpitem['counts'] =  $item_arr[$i]->getVar("counts");
$tpitem['postername'] = XoopsUser::getUnameFromId($item_arr[$i]->getVar('poster'));
$tpitem['poster'] = $item_arr[$i]->getVar('poster');
$tpitem['comments'] = $item_arr[$i]->getVar('comments');

	//on test l'existance de fichier
	if ($gperm_handler->checkRight('spot_view', 256, $groups, $xoopsModule->getVar('mid'))) {
	$imgpath = TDMSPOT_UPLOAD_PATH . "/".$item_arr[$i]->getVar("file");
		if (file_exists($imgpath)) {
		$tpitem['file'] = $item_arr[$i]->getVar("file");
		$tpitem['file_url'] = tdmspot_seo_genUrl( 'download', $item_arr[$i]->getVar("id"), 'download_'.$item_arr[$i]->getVar('file'));
		}else {
		$tpitem['file'] = false;
		}
	}
//moyen des vote
	@$moyen = ceil( $tpitem['votes'] / $tpitem['counts'] );
	if (@$moyen == 0) {
	$tpitem['moyen'] = "";
	} else {
	$tpitem['moyen'] = "<img src='".TDMSPOT_IMAGES_URL."/rate".$moyen.".png'/>";
	}
	
$page['tpitem'][] = $tpitem;
}
}

	}
	
	$xoopsTpl->append('page', $page);
	unset($page['tpblock']);
	unset($page['tpitem']);

	}
//nav
$xoopsTpl->assign('selectcat', tdmspot_catselect(false));

$xoopsTpl->assign('selectpage', tdmspot_pageselect($itemid));

		 if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
		$xoopsTpl->assign('nav', "<a href='".XOOPS_URL. "/".$xoopsModuleConfig['tdmspot_seo_title']."/'/>".$xoopsModuleConfig['tdmspot_seo_title']."</a>");
        } else {
		$xoopsTpl->assign('nav', "<a href='".XOOPS_URL. "/modules/".$xoopsModule->dirname()."'/>".$xoopsModule->name()."</a>");
		}
//perm
if ($gperm_handler->checkRight('spot_view', 4, $groups, $xoopsModule->getVar('mid'))) {
$xoopsTpl->assign('perm_submit', "<a href='".TDMSPOT_URL."/submit.php'>"._MD_SPOT_PERM_4."</a>");
}
if ($gperm_handler->checkRight('spot_view', 128, $groups, $xoopsModule->getVar('mid'))) {
$xoopsTpl->assign('perm_rss', "<a href='".TDMSPOT_URL."/rss.php'><img src=".TDMSPOT_IMAGES_URL."/rss.png alt="._MD_SPOT_EXPRSS." title="._MD_SPOT_EXPRSS."></a>");
}
$xoopsTpl->assign('perm_vote', $gperm_handler->checkRight('spot_view', 32, $groups, $xoopsModule->getVar('mid')) ? true : false );
$xoopsTpl->assign('perm_export', $gperm_handler->checkRight('spot_view', 16, $groups, $xoopsModule->getVar('mid')) ? true : false );
$xoopsTpl->assign('perm_social', $gperm_handler->checkRight('spot_view', 64, $groups, $xoopsModule->getVar('mid')) ? true : false );



tdmspot_header();
$xoopsTpl->assign('xoops_pagetitle', $myts->htmlSpecialChars($xoopsModule->name()));

if(isset($xoTheme) && is_object($xoTheme)) {
$xoTheme->addMeta( 'meta', 'keywords', tdmspot_keywords($xoopsModuleConfig['tdmspot_keywords']));
$xoTheme->addMeta( 'meta', 'description', tdmspot_desc($xoopsModuleConfig['tdmspot_description']));
} else {	// Compatibility for old Xoops versions
$xoopsTpl->assign('xoops_meta_keywords', tdmspot_keywords($xoopsModuleConfig['tdmspot_keywords']));
$xoopsTpl->assign('xoops_meta_description', tdmspot_desc($xoopsModuleConfig['tdmspot_description']));
}
include_once XOOPS_ROOT_PATH.'/footer.php';
?>
