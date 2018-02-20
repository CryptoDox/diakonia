<?php
// $Id: viewforum.php,v 1.14 2003/07/18 07:56:08 okazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

include_once 'header.php';

$forum = intval($_GET['forum']);
if ( $forum < 1 ) {
	redirect_header("index.php", 2, _MDEX_ERRORFORUM);
	exit();
}
$sql = 'SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page FROM '.$xoopsDB->prefix('bbex_forums').' WHERE forum_id = '.$forum;
if ( !$result = $xoopsDB->query($sql) ) {
	redirect_header("index.php", 2, _MDEX_ERRORCONNECT);
	exit();
}
if ( !$forumdata = $xoopsDB->fetchArray($result) ) {
	redirect_header("index.php", 2, _MDEX_ERROREXIST);
	exit();
}
// this page uses smarty template
// this must be set before including main header.php
$xoopsOption['template_main'] = 'newbbex_viewforum.html';
include XOOPS_ROOT_PATH."/header.php";
$can_post = 0;
$show_reg = 0;
$myts =& MyTextSanitizer::getInstance();
$mn = $xoopsModule->name();
$pt = strip_tags($myts->displayTarea($mn) . ' - ' .  $myts->displayTarea($forumdata['forum_name']));
$xoopsTpl->assign('xoops_pagetitle', $pt);

if ( $forumdata['forum_type'] == 1 ) {
	// this is a private forum.
	$xoopsTpl->assign('is_private_forum', true);
	$accesserror = 0;
	if ( is_object($xoopsUser)) {
		if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
			if ( !check_priv_forum_auth($xoopsUser->getVar("uid"), $forum, false) ) {
				$accesserror = 1;
			}
		}
	} else {
		$accesserror = 1;
	}
	if ( $accesserror == 1 ) {
		redirect_header("index.php",2,_MDEX_NORIGHTTOACCESS);
		exit();
	}
	$can_post = 1;
	$show_reg = 1;
} else {
	// this is not a priv forum
	$xoopsTpl->assign('is_private_forum', false);
	if ( $forumdata['forum_access'] == 1 ) {
		// this is a reg user only forum
		if ( is_object($xoopsUser)) {
			$can_post = 1;
		} else {
			$show_reg = 1;
		}
	} elseif ( $forumdata['forum_access'] == 2 ) {
		// this is an open forum
		$can_post = 1;
	} else {
		// this is an admin/moderator only forum
		if ( is_object($xoopsUser) ) {
			if ( $xoopsUserIsAdmin || is_moderator($forum, $xoopsUser->uid()) ) {
				$can_post = 1;
			}
		}
	}
}

$xoopsTpl->assign("forum_id", $forum);
if ( $can_post == 1 ) {
	$xoopsTpl->assign('viewer_can_post', true);
  	$xoopsTpl->assign('forum_post_or_register', "<a href=\"newtopic.php?forum=".$forum."\"><img src=\"".$bbImage['post']."\" alt=\""._MDEX_POSTNEW."\" /></a>");
} else {
	$xoopsTpl->assign('viewer_can_post', false);
	if ( $show_reg == 1 ) {
		$xoopsTpl->assign('forum_post_or_register', '<a href="'.XOOPS_URL.'/user.php?xoops_redirect='.htmlspecialchars($xoopsRequestUri).'">'._MDEX_REGTOPOST.'</a>');
	} else {
		$xoopsTpl->assign('forum_post_or_register', "");
	}
}
$xoopsTpl->assign('forum_index_title', sprintf(_MDEX_FORUMINDEX,$xoopsConfig['sitename']));
$xoopsTpl->assign('forum_image_folder', $bbImage['folder_topic']);
$myts =& MyTextSanitizer::getInstance();
$xoopsTpl->assign('forum_name', $myts->htmlSpecialChars($forumdata['forum_name']));
$xoopsTpl->assign('lang_moderatedby', _MDEX_MODERATEDBY);

$forum_moderators = "";
$count = 0;
$moderators = get_moderators($forum);
foreach ( $moderators as $mods ) {
	foreach ( $mods as $mod_id => $mod_name ) {
		if ( $count > 0 ) {
			$forum_moderators .= ", ";
		}
		$forum_moderators .=  '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$mod_id.'">'.$myts->htmlSpecialChars($mod_name).'</a>';
		$count = 1;
	}
}
$xoopsTpl->assign('forum_moderators', $forum_moderators);


$sel_sort_array = array("t.topic_title"=>_MDEX_TOPICTITLE, "t.topic_replies"=>_MDEX_NUMBERREPLIES, "u.uname"=>_MDEX_TOPICPOSTER, "t.topic_views"=>_MDEX_VIEWS, "p.post_time"=>_MDEX_LASTPOSTTIME);
if ( !isset($_GET['sortname']) || !in_array($_GET['sortname'], array_keys($sel_sort_array)) ) {
	$sortname = "p.post_time";
} else {
	$sortname = $_GET['sortname'];
}

$xoopsTpl->assign('lang_sortby', _MDEX_SORTEDBY);

$forum_selection_sort = '<select name="sortname">';
foreach ( $sel_sort_array as $sort_k => $sort_v ) {
	$forum_selection_sort .= '<option value="'.$sort_k.'"'.(($sortname == $sort_k) ? ' selected="selected"' : '').'>'.$sort_v.'</option>';
}
$forum_selection_sort .= '</select>';

// assign to template
$xoopsTpl->assign('forum_selection_sort', $forum_selection_sort);

$sortorder = (!isset($_GET['sortorder']) || $_GET['sortorder'] != "ASC") ? "DESC" : "ASC";
$forum_selection_order = '<select name="sortorder">';
$forum_selection_order .= '<option value="ASC"'.(($sortorder == "ASC") ? ' selected="selected"' : '').'>'._MDEX_ASCENDING.'</option>';
$forum_selection_order .= '<option value="DESC"'.(($sortorder == "DESC") ? ' selected="selected"' : '').'>'._MDEX_DESCENDING.'</option>';
$forum_selection_order .= '</select>';

// assign to template
$xoopsTpl->assign('forum_selection_order', $forum_selection_order);

$sortsince = !empty($_GET['sortsince']) ? intval($_GET['sortsince']) : 1000;
$sel_since_array = array(1, 2, 5, 10, 20, 30, 40, 60, 75, 100);
$forum_selection_since = '<select name="sortsince">';
foreach ($sel_since_array as $sort_since_v) {
	$forum_selection_since .= '<option value="'.$sort_since_v.'"'.(($sortsince == $sort_since_v) ? ' selected="selected"' : '').'>'.sprintf(_MDEX_FROMLASTDAYS,$sort_since_v).'</option>';
}
$forum_selection_since .= '<option value="365"'.(($sortsince == 365) ? ' selected="selected"' : '').'>'.sprintf(_MDEX_THELASTYEAR,365).'</option>';
$forum_selection_since .= '<option value="1000"'.(($sortsince == 1000) ? ' selected="selected"' : '').'>'.sprintf(_MDEX_BEGINNING,1000).'</option>';
$forum_selection_since .= '</select>';

// assign to template
$xoopsTpl->assign('forum_selection_since', $forum_selection_since);
$xoopsTpl->assign('lang_go', _MDEX_GO);

$xoopsTpl->assign('h_topic_link', "viewforum.php?forum=$forum&amp;sortname=t.topic_title&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "t.topic_title" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_topic', _MDEX_TOPIC);

$xoopsTpl->assign('h_reply_link', "viewforum.php?forum=$forum&amp;sortname=t.topic_replies&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "t.topic_replies" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_replies', _MDEX_REPLIES);

$xoopsTpl->assign('h_poster_link', "viewforum.php?forum=$forum&amp;sortname=u.uname&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "u.uname" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_poster', _MDEX_POSTER);

$xoopsTpl->assign('h_views_link', "viewforum.php?forum=$forum&amp;sortname=t.topic_views&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "t.topic_views" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_views', _MDEX_VIEWS);

$xoopsTpl->assign('h_date_link', "viewforum.php?forum=$forum&amp;sortname=p.post_time&amp;sortsince=$sortsince&amp;sortorder=". (($sortname == "p.post_time" && $sortorder == "DESC") ? "ASC" : "DESC"));
$xoopsTpl->assign('lang_date', _MDEX_DATE);

$startdate = time() - (86400* $sortsince);
$start = !empty($_GET['start']) ? intval($_GET['start']) : 0;

// Modif Hervé
if(get_show_name($forum)) {
	$sql = 'SELECT t.*, u.uname, u.name, u2.name as last_poster, u2.uname as last_poster2, p.post_time as last_post_time, p.icon FROM '.$xoopsDB->prefix("bbex_topics").' t LEFT JOIN '.$xoopsDB->prefix('users').' u ON u.uid = t.topic_poster LEFT JOIN '.$xoopsDB->prefix('bbex_posts').' p ON p.post_id = t.topic_last_post_id LEFT JOIN '.$xoopsDB->prefix('users').' u2 ON  u2.uid = p.uid WHERE t.forum_id = '.$forum.' AND (p.post_time > '.$startdate.' OR t.topic_sticky=1) ORDER BY topic_sticky DESC, '.$sortname.' '.$sortorder;
} else {
	$sql = 'SELECT t.*, u.uname, u.name, u2.uname as last_poster, p.post_time as last_post_time, p.icon FROM '.$xoopsDB->prefix("bbex_topics").' t LEFT JOIN '.$xoopsDB->prefix('users').' u ON u.uid = t.topic_poster LEFT JOIN '.$xoopsDB->prefix('bbex_posts').' p ON p.post_id = t.topic_last_post_id LEFT JOIN '.$xoopsDB->prefix('users').' u2 ON  u2.uid = p.uid WHERE t.forum_id = '.$forum.' AND (p.post_time > '.$startdate.' OR t.topic_sticky=1) ORDER BY topic_sticky DESC, '.$sortname.' '.$sortorder;
}

if ( !$result = $xoopsDB->query($sql,$forumdata['topics_per_page'],$start) ) {
	redirect_header('index.php',2,_MDEX_ERROROCCURED);
	exit();
}

// Read topic 'lastread' times from cookie, if exists
$topic_lastread = newbb_get_topics_viewed();
$keywords='';
while ( $myrow = $xoopsDB->fetchArray($result) ) {

 	if ( empty($myrow['last_poster']) ) {
 		if(empty($myrow['last_poster2'])) {
			$myrow['last_poster'] = $xoopsConfig['anonymous'];
		} else {
			$myrow['last_poster'] = $myrow['last_poster2'];
		}
	}
	if ( $myrow['topic_sticky'] == 1 ) {
		$image = $bbImage['folder_sticky'];
	} elseif ( $myrow['topic_status'] == 1 ) {
		$image = $bbImage['locked_topic'];
	} else {
		if ( $myrow['topic_replies'] >= $forumdata['hot_threshold'] ) {
			if ( empty($topic_lastread[$myrow['topic_id']]) || ($topic_lastread[$myrow['topic_id']] < $myrow['last_post_time'] )) {
				$image = $bbImage['hot_newposts_topic'];
			} else {
				$image = $bbImage['hot_folder_topic'];
			}
		} else {
			if ( empty($topic_lastread[$myrow['topic_id']]) || ($topic_lastread[$myrow['topic_id']] < $myrow['last_post_time'] )) {
				$image = $bbImage['newposts_topic'];
			} else {
				$image = $bbImage['folder_topic'];
			}
		}
	}
	$pagination = '';
	$addlink = '';
	$topiclink = 'viewtopic.php?topic_id='.$myrow['topic_id'].'&amp;forum='.$forum;
	$totalpages = ceil(($myrow['topic_replies'] + 1) / $forumdata['posts_per_page']);
	if ( $totalpages > 1 ) {
		$pagination .= '&nbsp;&nbsp;&nbsp;<img src="'.XOOPS_URL.'/images/icons/posticon.gif" /> ';
		for ( $i = 1; $i <= $totalpages; $i++ ) {

			if ( $i > 3 && $i < $totalpages ) {
				$pagination .= "...";
			} else {
				$addlink = '&start='.(($i - 1) * $forumdata['posts_per_page']);
				$pagination .= '[<a href="'.$topiclink.$addlink.'">'.$i.'</a>]';
			}
		}
	}
	if ( $myrow['icon'] ) {
		$topic_icon = '<img src="'.XOOPS_URL.'/images/subject/'.htmlspecialchars( $myrow['icon'], ENT_QUOTES ).'" alt="" />';
	} else {
		$topic_icon = '<img src="'.XOOPS_URL.'/images/icons/no_posticon.gif" alt="" />';
	}
	if ( $myrow['topic_poster'] != 0 && $myrow['uname'] ) {
		// Ajout Hervé
		$username=$myrow['uname'];
		if(get_show_name($forum)) {
			if(trim($myrow['name'])!='') {
				$username=$myrow['name'];
			}
		}
		// Modif Hervé
		$topic_poster = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$myrow['topic_poster'].'">'.$username.'</a>';
	} else {
		$topic_poster = $xoopsConfig['anonymous'];
	}
	$lastPoster = xoops_trim($myrow['last_poster']);
	$xoopsTpl->append('topics', array('topic_icon'=>$topic_icon, 'topic_folder'=>$image, 'topic_title'=>$myts->htmlSpecialChars($myrow['topic_title']), 'topic_link'=>$topiclink, 'topic_page_jump'=>$pagination, 'topic_replies'=>$myrow['topic_replies'], 'topic_poster'=>$topic_poster, 'topic_views'=>$myrow['topic_views'], 'topic_last_posttime'=>formatTimestamp($myrow['last_post_time']), 'topic_last_poster'=>$myts->htmlSpecialChars($lastPoster)));
	$keywords .= $myts->htmlSpecialChars($myrow['topic_title']).' ';
}

$xoopsTpl->assign('lang_by', _MDEX_BY);

$xoopsTpl->assign('img_newposts', $bbImage['newposts_topic']);
$xoopsTpl->assign('img_hotnewposts', $bbImage['hot_newposts_topic']);
$xoopsTpl->assign('img_folder', $bbImage['folder_topic']);
$xoopsTpl->assign('img_hotfolder', $bbImage['hot_folder_topic']);
$xoopsTpl->assign('img_locked', $bbImage['locked_topic']);
$xoopsTpl->assign('img_sticky', $bbImage['folder_sticky']);
$xoopsTpl->assign('lang_newposts', _MDEX_NEWPOSTS);
$xoopsTpl->assign('lang_hotnewposts', _MDEX_MORETHAN);
$xoopsTpl->assign('lang_hotnonewposts', _MDEX_MORETHAN2);
$xoopsTpl->assign('lang_nonewposts', _MDEX_NONEWPOSTS);
$xoopsTpl->assign('lang_legend', _MDEX_LEGEND);
$xoopsTpl->assign('lang_topiclocked', _MDEX_TOPICLOCKED);
$xoopsTpl->assign('lang_topicsticky', _MDEX_TOPICSTICKY);
$xoopsTpl->assign("lang_search", _MDEX_SEARCH);
$xoopsTpl->assign("lang_advsearch", _MDEX_ADVSEARCH);

$sql = 'SELECT COUNT(*) FROM '.$xoopsDB->prefix('bbex_topics').' WHERE forum_id = '.$forum.' AND (topic_time > '.$startdate.' OR topic_sticky = 1)';
if ( !$r = $xoopsDB->query($sql) ) {
	//redirect_header('index.php',2,_MDEX_ERROROCCURED);
	//exit();
}
list($all_topics) = $xoopsDB->fetchRow($r);
if ( $all_topics > $forumdata['topics_per_page'] ) {
	include XOOPS_ROOT_PATH.'/class/pagenav.php';
	$nav = new XoopsPageNav($all_topics, $forumdata['topics_per_page'], $start, "start", 'forum='.$forum.'&amp;sortname='.$sortname.'&amp;sortorder='.$sortorder.'&amp;sortsince='.$sortsince);
	$xoopsTpl->assign('forum_pagenav', $nav->renderNav(4));
} else {
	$xoopsTpl->assign('forum_pagenav', '');
}
$xoopsTpl->assign('forum_jumpbox', make_jumpboxex($forum));

include XOOPS_ROOT_PATH.'/modules/newbbex/include/functions.php';

$meta_keywords = newbbex_createmeta_keywords($myts->displayTarea($keywords));
if(isset($xoTheme) && is_object($xoTheme)) {
	$xoTheme->addMeta( 'meta', 'keywords', $meta_keywords);
} else {	// Compatibility for old Xoops versions
	$xoopsTpl->assign('xoops_meta_keywords', $meta_keywords);
}

$meta_description = $myts->displayTarea($forumdata['forum_name']);
if(isset($xoTheme) && is_object($xoTheme)) {
	$xoTheme->addMeta( 'meta', 'description', $meta_description);
} else {	// Compatibility for old Xoops versions
	$xoopsTpl->assign('xoops_meta_description', $meta_description);
}

include XOOPS_ROOT_PATH."/footer.php";
?>