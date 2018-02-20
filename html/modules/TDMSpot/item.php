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
$xoopsOption['template_main'] = 'spot_viewitem.html';
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
	$user_uid = $xoopsUser->getVar('uid');
	$user_name = $xoopsUser->getVar('name');
	$user_uname = $xoopsUser->getVar('uname');
	$user_email = $xoopsUser->getVar('email');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$user_uid = 0;
	$user_name = XOOPS_GROUP_ANONYMOUS;
	$user_uname = XOOPS_GROUP_ANONYMOUS;
	$user_email = XOOPS_GROUP_ANONYMOUS;
}

//permission d'afficher
if (!$gperm_handler->checkRight('spot_view', 2, $groups, $xoopsModule->getVar('mid'))) {
	redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	 exit();
    }

if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
    include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/seo.inc.php';
}
// get User ID
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : $xoopsModuleConfig['tdmspot_page'];
$tris = isset($_REQUEST['tris']) ? $_REQUEST['tris'] : 'indate';
$itemid = isset($_REQUEST['itemid']) ? $_REQUEST['itemid'] : false;


global $XoopsUser, $xoopsModule, $xoopsModuleConfig;


 switch($op) {
 
  case "list": 
  default:
 //navigation Alpha
$xoopsTpl->assign('comment_view', true);  
 // ************************************************************
 // Liste
 // ************************************************************

  //securiter si aucun n'est choisis
	if (empty($itemid)) {
	redirect_header(XOOPS_URL, 2, _MD_SPOT_NOPERM);
	exit();
    }	
	
	//Fichier 
	$criteria2 = new CriteriaCompo();
	$criteria2->add(new Criteria('display', 1));
	$criteria2->add(new Criteria('indate', time(), '<'));
	$criteria2->add(new Criteria('id', $itemid));
	$criteria2->setLimit(1);
	$item_arr = $item_handler->getObjects($criteria2);
	$numitem = $item_handler->getCount($criteria2);
	$xoopsTpl->assign('numitem', $numitem);
	
	
		foreach (array_keys($item_arr) as $i) {
		
	//si pas le droit d'afficher la cat		
if (!$gperm_handler->checkRight('tdmpicture_catview', $item_arr[$i]->getVar('cat'), $groups, $xoopsModule->getVar('mid'))) {
redirect_header('index.php', 2, _MD_SPOT_NOPERM);
exit();
}	

		//navigation next previous
	$criteria3 = new CriteriaCompo();
	$criteria3->add(new Criteria('display', 1));
	$criteria3->add(new Criteria('indate', time(), '<'));
	$criteria3->add(new Criteria('cat', $item_arr[$i]->getVar('cat')));
	$criteria3->setOrder('DESC');
	$arr = $item_handler->getObjects($criteria3);
	$nav_ids = array() ;
	$nav_title = array() ;
	foreach (array_keys($arr) as $f) {
	if ($gperm_handler->checkRight('tdmspot_catview', $item_arr[$i]->getVar('cat'), $groups, $xoopsModule->getVar('mid'))) {
	$nav_ids[] = $arr[$f]->getVar('id');
	$nav_title[] = $arr[$f]->getVar('title');
	$nav_date[] = formatTimeStamp($arr[$f]->getVar('indate'),"s");
	}
	}
	$numrows = count( $nav_ids )-1 ;
	$pos = array_search( $itemid , $nav_ids ) ;
	$nav = "";
	if ($pos != 0) {
	$prev_link = tdmspot_seo_genUrl($xoopsModuleConfig['tdmspot_seo_item'], $nav_ids[$pos-1], $nav_title[$pos-1]);
	$xoopsTpl->assign("prev_page", "<u>&laquo;</u> <b>"._MD_SPOT_ITEMPREV."</b><br /><br />".$nav_date[$pos-1]." - <a href='".$prev_link."'>".$nav_title[$pos-1]."</a>");
	}
	if ($pos != $numrows) {
	$next_link = tdmspot_seo_genUrl($xoopsModuleConfig['tdmspot_seo_item'], $nav_ids[$pos+1], $nav_title[$pos+1]);
	$xoopsTpl->assign("next_page", "&nbsp;&nbsp;<b>"._MD_SPOT_ITEMNEXT."</b> <u>&raquo;</u><br /><br />".$nav_date[$pos+1]." - <a href='".$next_link."'>".$nav_title[$pos+1]."</a>") ;
	}
	//
	//$xoopsTpl->assign('nav_page', $nav);
	
	////////////////////////////////////////////

		//cherche le cat parent
		$navigation = '';
		//sous cat
		$criteria = new CriteriaCompo();
		$criteria->setSort('weight');
		$criteria->setOrder('ASC');
		$criteria->add(new Criteria('display', 1));
		$souscat_arr = $cat_handler->getObjects($criteria);
		$mytree = new XoopsObjectTree($souscat_arr, 'id', 'pid');
		$nav_parent_id = $mytree->getAllParent(intval($item_arr[$i]->getVar('cat')));
		$nav_parent_id = array_reverse($nav_parent_id);
		$num_cat = $cat_handler->getCount($criteria);
		foreach (array_keys($nav_parent_id) as $i) {
		//$navigation .= '<a href="viewcat.php?LT='.$nav_parent_id[$i]->getVar('id').'">' . $nav_parent_id[$i]->getVar('title') . '</a>&nbsp;>&nbsp;';
		$navigation .= "<a href='".tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $nav_parent_id[$i]->getVar('id'), $nav_parent_id[$i]->getVar('title'))."'>".$nav_parent_id[$i]->getVar('title')."</a>&nbsp;>&nbsp;";
		}

		//trouve la categorie
		if ($cat =& $cat_handler->get($item_arr[$i]->getVar('cat'))) {
		$tpitem['cat_title'] = $cat->getVar('title');
		$xoopsTpl->assign('cat_title', $cat->getVar('title'));
		$tpitem['cat_id'] = $cat->getVar('id');
		$tpitem['cat_link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_cat'], $cat->getVar('id'), $cat->getVar('title'));
		$xoopsTpl->assign('selectcat', tdmspot_catselect(intval($cat->getVar('id'))));
		$xoopsTpl->assign('selectpage', tdmspot_pageselect(false));
		//$navigation .= "<a href='viewcat.php?LT=".$cat->getVar('id')."'>".$myts->displayTarea($cat->getVar('title'))."</a>&nbsp;>&nbsp;";
		$meta_title = $cat->getVar('title');
		$meta_keywords = $cat->getVar('title');
		$meta_description = $cat->getVar('title');
		
		if ($xoopsModuleConfig['tdmspot_img'] == 1) {
		$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img");
		if (file_exists($imgpath)) {
		$redim = tdmspot_redimage( $imgpath,$xoopsModuleConfig['tdmspot_cat_width'],$xoopsModuleConfig['tdmspot_cat_height']);
		$tpitem['img'] = "<img src=".XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/cat/".$cat->getVar("img")." height='".$redim['dst_h']."' width='".$redim['dst_w']."'>";
		} else {
		$tpitem['img'] = false;
		} } } 

		
//met ajout le nombre d'affichage
$hits = $item_arr[$i]->getVar('hits');
$hits++;
$item_arr[$i]->setVar('hits', $hits);
$item_handler->insert($item_arr[$i]);
//

	$tpitem['id'] = $item_arr[$i]->getVar("id");
	$tpitem['title'] = $item_arr[$i]->getVar("title");
	$meta_title .= " : ".$item_arr[$i]->getVar('title');
	$meta_keywords .= $item_arr[$i]->getVar('title');
	$meta_description .= $item_arr[$i]->getVar('title');
	$bl_title = $item_arr[$i]->getVar("title");
	$tpitem['hits'] = $item_arr[$i]->getVar("hits");
	$tpitem['link'] = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
	$tpitem['postername'] = XoopsUser::getUnameFromId($item_arr[$i]->getVar('poster'));
	$tpitem['uid'] = $item_arr[$i]->getVar('poster');
	$bl_poster = $item_arr[$i]->getVar('poster');
	//trouve les info user
	$member_handler =& xoops_gethandler('member');
    $thisUser =& $member_handler->getUser($bl_poster);
	//teste l'avatard
	if ($thisUser->getVar('user_avatar') != "blank.gif") {
	$tpitem['user_avatarurl'] = XOOPS_URL.'/uploads/'.$thisUser->getVar('user_avatar');
	} else {
	$tpitem['user_avatarurl'] = TDMSPOT_IMAGES_URL.'/user.png';
	}
	$tpitem['user_uname'] = $thisUser->getVar('uname');
	$tpitem['user_name'] = $thisUser->getVar('name');
	$tpitem['user_name'] = $thisUser->getVar('name');
	if ( $thisUser->getVar('url', 'E') == '') {
    $tpitem['user_websiteurl']  = '';
	} else {
    $tpitem['user_websiteurl'] = '<a href="'.$thisUser->getVar('url', 'E').'" rel="external">'.$thisUser->getVar('url').'</a>';
	}

	$tpitem['user_extrainfo'] = $myts->displayTarea( $thisUser->getVar('bio', 'N'),0,1,1);
	$tpitem['user_signature'] = $myts->displayTarea( $thisUser->getVar('user_sig', 'N'), 0, 1, 1 );
	$tpitem['user_joindate'] = formatTimestamp( $thisUser->getVar('user_regdate'), 's' );
	$userrank = $thisUser->rank();
	if ($userrank['image']) {
    $tpitem['user_rankimage'] = '<img src="'.XOOPS_UPLOAD_URL.'/'.$userrank['image'].'" alt="" />';
	}
	$tpitem['user_ranktitle'] = $userrank['title'];
	
	//Body
	$body = str_replace("{X_BREAK}", "<br /><br /><br />", $item_arr[$i]->getVar('text'));

	//sommaire
$pattern = '`\{X_PAGE:(.*)\}`U';
preg_match_all($pattern, $item_arr[$i]->getVar('text'), $matches);
if (!empty($matches[1])) {
foreach ($matches[0] as $match) {
$body = str_replace($match, "<dt>", $body);
}
$xoopsTpl->assign("tdmspot_somaire","['".implode($matches[1], "','")." ']");
}

	//text

	$body = str_replace("{X_NAME}", $user_name, $body);
	$body = str_replace("{X_UNAME}", $user_uname, $body);
	$body = str_replace("{X_UEMAIL}", $user_email, $body);
	$body = str_replace("{X_ADMINMAIL}", $xoopsConfig['adminmail'], $body);
	$body = str_replace("{X_SITENAME}", $xoopsConfig['sitename'], $body);
	$body = str_replace("{X_SITEURL}", XOOPS_URL, $body);
	$tpitem['text'] = $body;
	$meta_keywords .= $body;
	$meta_description .= $body;
	//
	
	
	$tpitem['indate'] = formatTimeStamp($item_arr[$i]->getVar('indate'),"m");
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
		$tpitem['pdf'] = tdmspot_seo_genUrl( 'pdf', $item_arr[$i]->getVar("id"), 'pdf_'.$item_arr[$i]->getVar('title'));
		$tpitem['print'] = tdmspot_seo_genUrl( 'print', $item_arr[$i]->getVar("id"), 'print_'.$item_arr[$i]->getVar('title'));
//moyen des votes
	@$moyen = ceil( $tpitem['votes']/ $tpitem['counts'] );
	if (@$moyen == 0) {
	$tpitem['moyen'] = "";
	} else {
	$tpitem['moyen'] = "<img src='".TDMSPOT_IMAGES_URL."/rate".$moyen.".png'/>";
	}
	
	$xoopsTpl->append('tpitem', $tpitem);
	$xoopsTpl->assign('nav_bar', $navigation);
		if ($xoopsModuleConfig['tdmspot_seo'] == 1) {
		$xoopsTpl->assign('nav', "<a href='".XOOPS_URL. "/".$xoopsModuleConfig['tdmspot_seo_title']."/'/>".$xoopsModuleConfig['tdmspot_seo_title']."</a>");
        } else {
		$xoopsTpl->assign('nav', "<a href='".XOOPS_URL. "/modules/".$xoopsModule->dirname()."'/>".$xoopsModule->name()."</a>");
		}
	
// similaire
if($xoopsModuleConfig['tdmspot_blsimil'] != 0){
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('display', 1));
	$criteria->add(new Criteria('indate', time(), '<'));
	$criteria->add(new Criteria('title', '%'.$bl_title.'%', 'LIKE'));
    $criteria->setSort('title');
    $criteria->setOrder('DESC');
    $criteria->setLimit($xoopsModuleConfig['tdmspot_blsimil']);
    $item_arr = $item_handler->getall($criteria);
    foreach (array_keys($item_arr) as $i) {
        $title = $myts->htmlSpecialChars($item_arr[$i]->getVar('title'));
		if (strlen($title) >= $xoopsModuleConfig['tdmspot_bltitle']) {
				$title = substr($title,0,($xoopsModuleConfig['tdmspot_bltitle']))."...";
		}
        $indate = formatTimestamp($item_arr[$i]->getVar('indate'),"s");
        $link = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
		$xoopsTpl->append('tpitem_blsimil', array('id' => $item_arr[$i]->getVar('id'),'cat' => $item_arr[$i]->getVar('cat'),'indate' => $indate,'title' => $title, 'link' => $link));
    }
	unset($criteria);
}

//meme auteur
if($xoopsModuleConfig['tdmspot_blposter'] > 0){
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('display', 1));
	$criteria->add(new Criteria('indate', time(), '<'));
    $criteria->add(new Criteria('poster', intval($bl_poster)));
    $criteria->setSort('title');
    $criteria->setOrder('DESC');
    $criteria->setLimit($xoopsModuleConfig['tdmspot_blposter']);
    $item_arr = $item_handler->getall($criteria);
    foreach (array_keys($item_arr) as $i) {
        $title = $myts->htmlSpecialChars($item_arr[$i]->getVar('title'));
		if (strlen($title) >= $xoopsModuleConfig['tdmspot_bltitle']) {
				$title = substr($title,0,($xoopsModuleConfig['tdmspot_bltitle'])) . "...";
		}
		 $indate = formatTimestamp($item_arr[$i]->getVar('indate'),"s");
        $link = tdmspot_seo_genUrl( $xoopsModuleConfig['tdmspot_seo_item'], $item_arr[$i]->getVar('id'), $item_arr[$i]->getVar('title'));
		$xoopsTpl->append('tpitem_blposter', array('id' => $item_arr[$i]->getVar('id'),'cat' => $item_arr[$i]->getVar('cat'),'indate' => $indate,'title' => $title, 'link' => $link));
    }
}	
	}
	
	break;

}

//lien admin
 if ($xoopsUser->isAdmin()) {
 $xoopsTpl->assign('perm_admin','&nbsp; <a href="'.TDMSPOT_URL.'/admin/item.php?op=edit&id='.$item_arr[$i]->getVar('id').'"><img src="'.TDMSPOT_IMAGES_URL.'/edit.png" border="0" alt="'._MD_SPOT_EDITER.'" title="'._MD_SPOT_EDITER.'"></a><a href="'.TDMSPOT_URL.'/admin/item.php?op=delete&id='.$item_arr[$i]->getVar('id').'"><img src="'.TDMSPOT_IMAGES_URL.'/delete.png" border="0" alt="'._MD_SPOT_DELETE.'" title="'._MD_SPOT_DELETE.'"></a>');
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
$xoopsTpl->assign('tdmspot_present', $xoopsModuleConfig['tdmspot_present']);
$xoopsTpl->assign('tdmspot_nextprev', $xoopsModuleConfig['tdmspot_nextprev']);

tdmspot_header();
$xoopsTpl->assign('xoops_pagetitle', $myts->htmlSpecialChars($xoopsModule->name()." : ".$meta_title));

if(isset($xoTheme) && is_object($xoTheme)) {
$xoTheme->addMeta( 'meta', 'keywords', tdmspot_keywords($meta_keywords));
$xoTheme->addMeta( 'meta', 'description', tdmspot_desc($meta_description));
} else {	// Compatibility for old Xoops versions
$xoopsTpl->assign('xoops_meta_keywords', tdmspot_keywords($meta_keywords));
$xoopsTpl->assign('xoops_meta_description', tdmspot_desc($meta_description));
}
 //fonction commentaire
include XOOPS_ROOT_PATH.'/include/comment_view.php';
//
include(XOOPS_ROOT_PATH.'/footer.php');
?>