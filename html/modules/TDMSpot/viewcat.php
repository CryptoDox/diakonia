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
$xoopsOption['template_main'] = 'spot_viewcat.html';
require(XOOPS_ROOT_PATH.'/header.php');
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$myts =& MyTextSanitizer::getInstance();

//load class
$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');

//perm
$gperm_handler =& xoops_gethandler('groupperm');
//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$xd_uid = $xoopsUser->getVar('uid');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$xd_uid = 0;
}

//permission d'afficher
if (!$gperm_handler->checkRight('spot_view', 2, $groups, $xoopsModule->getVar('mid'))) {
	redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	 exit();
    }

if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
    include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/seo.inc.php';
}

//variable post
 $op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
 $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : $xoopsModuleConfig['tdmspot_page'];
 $LT = isset($_REQUEST['LT']) ? $_REQUEST['LT'] : false;
 $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
 $tris = isset($_REQUEST['tris']) ? $_REQUEST['tris'] : 'indate';
 //

//mode de visualisation
$xoopsTpl->assign('tris', $tris); 
$xoopsTpl->assign('limit', $limit);
$xoopsTpl->assign('baseurl', $_SERVER['PHP_SELF']);


 switch($op) {		

  case "list": 
  default:

  //securiter si aucun n'est choisis
	if (!isset($LT)) {
	redirect_header('index.php', 2, _MD_SPOT_QUERYNOPERM);
	exit();
    }
	
	//perm
if (!$gperm_handler->checkRight('tdmspot_catview', $LT, $groups, $xoopsModule->getVar('mid'))) {
redirect_header('index.php', 2,_MD_SPOT_QUERYNOPERM);
exit();
}



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
		$display_cat = $mytree->makeCatBox($item_handler, 'title','-', $LT);
		$xoopsTpl->assign('display_cat', $display_cat);



  		//navigation
		$navigation = '';

		$xoopsTpl->assign('cat_view', true);
		$xoopsTpl->assign('selectcat', tdmspot_catselect(intval($LT)));
		$xoopsTpl->assign('selectpage', tdmspot_pageselect(false));
		$xoopsTpl->assign('selecttris', tdmspot_trisselect(intval($LT), $tris));
		$xoopsTpl->assign('selectview', tdmspot_viewselect(intval($LT), $limit));
		//sous cat
		$criteria = new CriteriaCompo();
		$criteria->setSort('weight');
		$criteria->setOrder('ASC');
		$criteria->add(new Criteria('display', 1));
		$souscat_arr = $cat_handler->getObjects($criteria);
		$mytree = new XoopsObjectTree($souscat_arr, 'id', 'pid');
		$nav_parent_id = $mytree->getAllParent(intval($LT));
		$nav_parent_id = array_reverse($nav_parent_id);

foreach (array_keys($nav_parent_id) as $i) {

    $navigation .= "<a href='".tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $nav_parent_id[$i]->getVar('id'), $nav_parent_id[$i]->getVar('title'))."'>".$nav_parent_id[$i]->getVar('title')."</a>&nbsp;>&nbsp;";
}
		//categorie en cour
		$cat = $cat_handler->get($_REQUEST['LT']); 

		//on test l'existance de l'image
		$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img");
		if (file_exists($imgpath)) {
		$redim = tdmspot_redimage( $imgpath,$xoopsModuleConfig['tdmspot_cat_width'],$xoopsModuleConfig['tdmspot_cat_height']);
		$cat_img = "<img src=".XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img")." height='".$redim['dst_h']."' width='".$redim['dst_w']."'>";
		//$cat_img = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img");
		} else {
		$cat_img = false;
		}
		
		$xoopsTpl->assign('cat_title', $myts->displayTarea($cat->getVar('title')));
		$meta_title = $cat->getVar('title');
		$meta_keywords = $cat->getVar('title');
		$meta_description = $cat->getVar('title');
		$xoopsTpl->assign('cat_text', $myts->displayTarea($cat->getVar('text')));	
		$xoopsTpl->assign('cat_id', $cat->getVar('id'));
		$xoopsTpl->assign('cat_img', $cat_img);
		//$navigation .= "<a href='viewcat.php?LT=".$cat->getVar('id')."&tris=".$tris."&limit=".$limit."'>".$myts->displayTarea($cat->getVar('title'))."</a>&nbsp;>&nbsp;";

		$xoopsTpl->assign('nav_bar', $navigation);
		
		 if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
		$xoopsTpl->assign('nav', "<a href='".XOOPS_URL. "/".$xoopsModuleConfig['tdmspot_seo_title']."/'/>".$xoopsModuleConfig['tdmspot_seo_title']."</a>");
        } else {
		$xoopsTpl->assign('nav', "<a href='".XOOPS_URL. "/modules/".$xoopsModule->dirname()."'/>".$xoopsModule->name()."</a>");
		}
	unset($criteria);	

 // ************************************************************
 // Liste des derniers fichier
 // ************************************************************

//+ récents
if($xoopsModuleConfig['tdmspot_blindate'] != 0){
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('display', 1));
	$criteria->add(new Criteria('indate', time(), '<'));
    $criteria->add(new Criteria('cat', intval($_REQUEST['LT'])));
    $criteria->setSort('indate');
    $criteria->setOrder('DESC');
    $criteria->setLimit($xoopsModuleConfig['tdmspot_blindate']);
    $item_arr = $item_handler->getall($criteria);
    foreach (array_keys($item_arr) as $i) {
        $title = $myts->htmlSpecialChars($item_arr[$i]->getVar('title'));
		if (strlen($title) >= $xoopsModuleConfig['tdmspot_bltitle']) {
				$title = substr($title,0,($xoopsModuleConfig['tdmspot_bltitle']))."...";
		}
        $indate = formatTimestamp($item_arr[$i]->getVar('indate'),"s");
		$link = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
        $xoopsTpl->append('tpitem_blindate', array('id' => $item_arr[$i]->getVar('id'),'cat' => $item_arr[$i]->getVar('cat'),'indate' => $indate,'title' => $title, 'link' => $link));
    }
	unset($criteria);
}

//plus populaire
if($xoopsModuleConfig['tdmspot_blcounts'] > 0){
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('display', 1));
	$criteria->add(new Criteria('indate', time(), '<'));
    $criteria->add(new Criteria('cat', intval($_REQUEST['LT'])));
    $criteria->setSort('counts');
    $criteria->setOrder('DESC');
    $criteria->setLimit($xoopsModuleConfig['tdmspot_blcounts']);
    $item_arr = $item_handler->getall($criteria);
    foreach (array_keys($item_arr) as $i) {
        $title = $myts->htmlSpecialChars($item_arr[$i]->getVar('title'));
		if (strlen($title) >= $xoopsModuleConfig['tdmspot_bltitle']) {
				$title = substr($title,0,($xoopsModuleConfig['tdmspot_bltitle'])) . "...";
		}
		$link = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
        $xoopsTpl->append('tpitem_blcounts', array('id' => $item_arr[$i]->getVar('id'),'cat' => $item_arr[$i]->getVar('cat'),'counts' => $item_arr[$i]->getVar('counts'),'title' => $title, 'link' => $link));
    }
}
//plus vue
if($xoopsModuleConfig['tdmspot_blhits'] >0){
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('display', 1));
	$criteria->add(new Criteria('indate', time(), '<'));
    $criteria->add(new Criteria('cat', intval($_REQUEST['LT'])));
    $criteria->setSort('hits');
    $criteria->setOrder('DESC');
    $criteria->setLimit($xoopsModuleConfig['tdmspot_blhits']);
    $item_arr = $item_handler->getall($criteria);
    foreach (array_keys($item_arr) as $i) {
        $title = $myts->htmlSpecialChars($item_arr[$i]->getVar('title'));
		if (strlen($title) >= $xoopsModuleConfig['tdmspot_bltitle']) {
				$title = substr($title,0,($xoopsModuleConfig['tdmspot_bltitle']))."...";
		}
		$link = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
        $xoopsTpl->append('tpitem_blhits', array('id' => $item_arr[$i]->getVar('id'),'cat' => $item_arr[$i]->getVar('cat'),'hits' => $item_arr[$i]->getVar('hits'),'title' => $title, 'link' => $link));
    }
}

//afficher fichier
		$criteria3 = new CriteriaCompo();
		$criteria3->add(new Criteria('display', 1));
		$criteria3->add(new Criteria('indate', time(), '<'));
		$criteria3->add(new Criteria('cat', $LT));	
		$criteria3->setStart($start);	 
		$criteria3->setLimit($limit);
		$criteria3->setSort($tris);

		$criteria3->setOrder('DESC');
		$item_arr = $item_handler->getObjects($criteria3);
		$numitem = $item_handler->getCount($criteria3);
		$xoopsTpl->assign('numitem', $numitem);
		
		if ($numitem > 0) {
		
		foreach (array_keys($item_arr) as $i) {

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
	
	$tpitem['id'] = $item_arr[$i]->getVar("id");
	$tpitem['title'] = $myts->displayTarea($item_arr[$i]->getVar("title"));
	
	$tpitem['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
	
	if (strpos($item_arr[$i]->getVar('text'),'{X_BREAK}')) {	
	$more = substr($item_arr[$i]->getVar('text'), strpos($item_arr[$i]->getVar('text'),'{X_BREAK}')+11 );
	$tpitem['text'] = substr($item_arr[$i]->getVar('text'),0,strpos($item_arr[$i]->getVar('text'),'{X_BREAK}') )."<a href='".$tpitem['link']."' rel='nofollow'>[...]</a>";
	$tpitem['more'] = strlen($more);
	} else {
	$tpitem['text'] = $item_arr[$i]->getVar('text');
	}
	
	$tpitem['hits'] = $item_arr[$i]->getVar("hits");
	$tpitem['postername'] = XoopsUser::getUnameFromId($item_arr[$i]->getVar('poster'));
	$tpitem['poster'] = $item_arr[$i]->getVar('poster');
	//test si l'user a un album
	//$item['useralb'] = tdmpiLTure_useralb($item_arr[$f]->getVar('item_uid'));
	//
	$tpitem['indate'] = formatTimeStamp($item_arr[$i]->getVar('indate'),"S");
	//nombre de vote
	$tpitem['votes'] = $item_arr[$i]->getVar('votes');
	//total des votes
	$tpitem['counts'] = $item_arr[$i]->getVar("counts");
	$tpitem['comments'] = $item_arr[$i]->getVar("comments");
	
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

//moyen des votes
	@$moyen = ceil( $tpitem['votes']/ $tpitem['counts'] );
	if (@$moyen == 0) {
	$tpitem['moyen'] = "";
	} else {
	$tpitem['moyen'] = "<img src='".TDMSPOT_IMAGES_URL."/rate".$moyen.".png'/>";
	}
	
	$xoopsTpl->append('tpitem', $tpitem);
	}
	
		//navigation
	if ( $numitem > $limit ) {
	$pagenav = new tdmspotPageNav($numitem, $limit, $start, 'start');
	$xoopsTpl->assign('nav_page', $pagenav->renderNav(2));
	}
   
 }

   break;
	

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
//config

tdmspot_header();
$xoopsTpl->assign('xoops_pagetitle', $myts->htmlSpecialChars($xoopsModule->name()." : ".$meta_title));

if(isset($xoTheme) && is_object($xoTheme)) {
$xoTheme->addMeta( 'meta', 'keywords', tdmspot_keywords($meta_keywords));
$xoTheme->addMeta( 'meta', 'description', tdmspot_desc($meta_description));
} else {	// Compatibility for old Xoops versions
$xoopsTpl->assign('xoops_meta_keywords', tdmspot_keywords($meta_keywords));
$xoopsTpl->assign('xoops_meta_description', tdmspot_desc($meta_description));
}
		
include_once XOOPS_ROOT_PATH.'/footer.php';
?>