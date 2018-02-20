<?php
// $Id: newbbex_new.php,v 1.8 2003/09/11 13:33:38 okazu Exp $
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
// Recent private forums block (Bloc Forum privé©                            //
// Author: L'éñuipe de TheNetSpace ( http://www.thenetspace.com )            //
// ------------------------------------------------------------------------- //

include_once XOOPS_ROOT_PATH.'/modules/newbbex/functions.php';

function b_newbbex_new_show($options) {
	global $xoopsUser;
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::getInstance();
    // Ajout Hervé
    $where1='AND f.forum_type <> 1';
    $where2="";
    $block = array();
    switch($options[2]) {
    case 'views':
        $order = 't.topic_views';
        break;
    case 'replies':
        $order = 't.topic_replies';
        break;
    // Ajout Hervé
    case 'withoutreplies':
    	$order = 't.topic_time';		// Sort them by time
    	$where2 = " AND t.topic_replies=0 ";	// Limit to topics without answer
    	break;
    case 'showall':	// In the same block, show recent public and private messages.
		// Hack for viewing only authorized forums
		if (is_object($xoopsUser))
		{
			$where1=private_forums_list_cant_access($xoopsUser->getVar('uid'),'f.');
			if(strlen(trim($where1))>0)
			{
				$where1= " AND (".$where1.') ';
			}
		}
		else	// Don't give any access to private forums for anonymous users
		{
			$where1=' AND f.forum_type=0 ';
		}
    	$order = 't.topic_time';
    	break;
    case 'time':
    default:
        $order = 't.topic_time';
        break;
    }
    // Modif Hervé
    $query='SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_time, t.topic_views, t.topic_replies, t.forum_id, f.forum_name, f.posts_per_page, p.uid FROM '.$db->prefix('bbex_topics').' t, '.$db->prefix('bbex_forums').' f, '.$db->prefix('bbex_posts').' p WHERE (f.forum_id=t.forum_id) AND (p.post_id=t.topic_last_post_id) '.$where1.' '.$where2.' ORDER BY '.$order.' DESC';
    if (!$result = $db->query($query,$options[0],0))
    {
        return false;
    }
    if ( $options[1] != 0 ) {
        $block['full_view'] = true;
    } else {
        $block['full_view'] = false;
    }
    $block['lang_forum'] = _MBEX_NEWBB_FORUM;
    $block['lang_topic'] = _MBEX_NEWBB_TOPIC;
    $block['lang_replies'] = _MBEX_NEWBB_RPLS;
    $block['lang_views'] = _MBEX_NEWBB_VIEWS;
    $block['lang_lastpost'] = _MBEX_NEWBB_LPOST;
    $block['lang_visitforums'] = _MBEX_NEWBB_VSTFRMS;
    while ($arr = $db->fetchArray($result))
    {
        $topic['forum_id'] = $arr['forum_id'];
        $topic['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
        $topic['id'] = $arr['topic_id'];
        $topic['title'] = $myts->htmlSpecialChars($arr['topic_title']);
        $topic['replies'] = $arr['topic_replies'];
        $topic['views'] = $arr['topic_views'];
        $topic['post_id'] = $arr['topic_last_post_id'];
// Hack nb pages
	if($options[3]==1)
	{
        	$pagination = '';
        	$addlink = '';
        	$topiclink = XOOPS_URL . '/modules/newbbex/viewtopic.php?topic_id='.$arr['topic_id'].'&amp;forum='.$arr['forum_id'].'&amp;jump=1';
        	$totalpages = ceil(($arr['topic_replies'] + 1) / $arr['posts_per_page']);
        	if ( $totalpages > 1 )
        	{
			$pagination .= '&nbsp;&nbsp;&nbsp;<img src="'.XOOPS_URL.'/images/icons/posticon.gif" /> ';
			for ( $i = 1; $i <= $totalpages; $i++ )
			{
				if ( $i > 3 && $i < $totalpages )
				{
					$pagination .= "...";
				}
				else
				{
					$addlink = '&start='.(($i - 1) * $arr['posts_per_page']);
					$pagination .= '[<a href="'.$topiclink.$addlink.'">'.$i.'</a>]';
				}
			}
			$topic['topic_page_jump'] = $pagination;
		}
		$topic['title'] = $myts->htmlSpecialChars($arr['topic_title']) . "</a>" . $pagination;
	}
// Hack nb page

        $lastpostername = $db->query("SELECT post_id, uid FROM ".$db->prefix("bbex_posts")." WHERE post_id = ".$topic['post_id']);
        while ($tmpdb=$db->fetchArray($lastpostername)) {
            $tmpuser = XoopsUser::getUnameFromId($tmpdb['uid']);
            // Ajout Hervé
            if (get_show_name($arr['forum_id']))
            {
            	if(trim(username($tmpdb['uid']))!='')
            	{
            		$tmpuser = username($tmpdb['uid']);
            	}
            }

            if ( $options[1] != 0 ) {
                $topic['time'] = formatTimestamp($arr['topic_time'],'m')." $tmpuser";
            }
        }
        $block['topics'][] =& $topic;
        unset($topic);
    }
    return $block;
}

// Shows last messages since last user visit
function b_newbbex_show_last_messages($options)
{
	global $xoopsUser, $xoopsModule;
	$block = array();
	$db =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
    $block['lang_forum'] = _MBEX_NEWBB_FORUM;
    $block['lang_topic'] = _MBEX_NEWBB_TOPIC;
    $block['lang_replies'] = _MBEX_NEWBB_RPLS;
    $block['lang_views'] = _MBEX_NEWBB_VIEWS;
    $block['lang_lastpost'] = _MBEX_NEWBB_LPOST;
    $block['lang_visitforums'] = _MBEX_NEWBB_VSTFRMS;
    $block['lang_forumtype'] = _MDEX_NEWBB_FORUMTYPE;

	if (!is_object($xoopsUser)) {
		return false;
	}
	$lastvisit=$xoopsUser->getVar('last_login');

	$forumslist=private_forums_list_cant_access($xoopsUser->getVar('uid'),'f.');
	if(strlen(trim($forumslist))>0)
	{
		$forumslist = " AND (".$forumslist.') ';
	}

    $query='SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_time, t.topic_views, t.topic_replies, t.forum_id, f.forum_name, f.forum_type, f.posts_per_page, p.uid FROM '.$db->prefix('bbex_topics').' t, '.$db->prefix('bbex_forums').' f, '.$db->prefix('bbex_posts').' p WHERE (f.forum_id=t.forum_id) AND (p.post_id=t.topic_last_post_id) AND (t.topic_time>$lastvisit) $forumslist ORDER BY t.topic_time DESC';
    if (!$result = $db->query($query,$options[0],0))
    {
        return false;
    }
    if ( $options[1] != 0 ) {
        $block['full_view'] = true;
    } else {
        $block['full_view'] = false;
    }
    while ($arr = $db->fetchArray($result))
    {
        $topic['forum_id'] = $arr['forum_id'];
        $topic['forum_type'] = $arr['forum_type'];
        $topic['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
        $topic['id'] = $arr['topic_id'];
        $topic['title'] = $myts->htmlSpecialChars($arr['topic_title']);
        $topic['replies'] = $arr['topic_replies'];
        $topic['views'] = $arr['topic_views'];
        $topic['post_id'] = $arr['topic_last_post_id'];
// Hack nb pages
	if($options[3]==1)
	{
        	$pagination = '';
        	$addlink = '';
        	$topiclink = XOOPS_URL . '/modules/newbbex/viewtopic.php?topic_id='.$arr['topic_id'].'&amp;forum='.$arr['forum_id'].'&amp;jump=1';
        	$totalpages = ceil(($arr['topic_replies'] + 1) / $arr['posts_per_page']);
        	if ( $totalpages > 1 )
        	{
			$pagination .= '&nbsp;&nbsp;&nbsp;<img src="'.XOOPS_URL.'/images/icons/posticon.gif" /> ';
			for ( $i = 1; $i <= $totalpages; $i++ )
			{
				if ( $i > 3 && $i < $totalpages )
				{
					$pagination .= "...";
				}
				else
				{
					$addlink = '&start='.(($i - 1) * $arr['posts_per_page']);
					$pagination .= '[<a href="'.$topiclink.$addlink.'">'.$i.'</a>]';
				}
			}
			$topic['topic_page_jump'] = $pagination;
		}
		$topic['title'] = $myts->htmlSpecialChars($arr['topic_title']) . "</a>" . $pagination;
	}
// Hack nb page

        $lastpostername = $db->query("SELECT post_id, uid FROM ".$db->prefix("bbex_posts")." WHERE post_id = ".$topic['post_id']);
        while ($tmpdb=$db->fetchArray($lastpostername)) {
            $tmpuser = XoopsUser::getUnameFromId($tmpdb['uid']);
            if (get_show_name($arr['forum_id']))
            {
            	if(trim(username($tmpdb['uid']))!='')
            	{
            		$tmpuser = username($tmpdb['uid']);
            	}
            }

            if ( $options[1] != 0 ) {
                $topic['time'] = formatTimestamp($arr['topic_time'],'m')." $tmpuser";
            }
        }
        $block['topics'][] =& $topic;
        unset($topic);
    }
    return $block;
}


// Show all posts (private and publics) without answer
function b_newbbex_new_all_show($options) {
	global $xoopsUser;
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::getInstance();
    $block = array();

	// Hack for viewing only authorized forums
	if (is_object($xoopsUser)) {
		$where1=private_forums_list_cant_access($xoopsUser->getVar('uid'),'f.');
		if(strlen(trim($where1))>0) {
			$where1= "  AND (".$where1.') ';
		}
	}
	else	// Don't give any access to private forums for anonymous users
	{
		$where1=' AND f.forum_type=0 ';
	}

    // Ajout Hervé
    $where2='';
    $order = 't.topic_time';				// Sort them by time
    $where2 = " AND t.topic_replies=0 ";	// Limit to topics without answer
    $query='SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_time, t.topic_views, t.topic_replies, t.forum_id, f.forum_name, f.posts_per_page, p.uid FROM '.$db->prefix('bbex_topics').' t, '.$db->prefix('bbex_forums').' f,  '.$db->prefix('bbex_posts').' p WHERE (f.forum_id=t.forum_id) AND (p.post_id=t.topic_last_post_id) '.$where1.$where2.' ORDER BY '.$order.' DESC';
    if (!$result = $db->query($query,$options[0],0))
    {
        return false;
    }
    if ( $options[1] != 0 ) {
        $block['full_view'] = true;
    } else {
        $block['full_view'] = false;
    }
    $block['lang_forum'] = _MBEX_NEWBB_FORUM;
    $block['lang_topic'] = _MBEX_NEWBB_TOPIC;
    $block['lang_replies'] = _MBEX_NEWBB_RPLS;
    $block['lang_views'] = _MBEX_NEWBB_VIEWS;
    $block['lang_lastpost'] = _MBEX_NEWBB_LPOST;
    $block['lang_visitforums'] = _MBEX_NEWBB_VSTFRMS;
    while ($arr = $db->fetchArray($result)) {
        $topic['forum_id'] = $arr['forum_id'];
        $topic['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
        $topic['id'] = $arr['topic_id'];
        $topic['title'] = $myts->htmlSpecialChars($arr['topic_title']);
        $topic['replies'] = $arr['topic_replies'];
        $topic['views'] = $arr['topic_views'];
        $tmpuser2 = $arr['topic_last_post_id'];
// Hack nb pages
	if($options[3]==1)
	{
        	$pagination = '';
        	$addlink = '';
        	$topiclink = XOOPS_URL . '/modules/newbbex/viewtopic.php?topic_id='.$arr['topic_id'].'&amp;forum='.$arr['forum_id'].'&amp;jump=1';
        	$totalpages = ceil(($arr['topic_replies'] + 1) / $arr['posts_per_page']);
        	if ( $totalpages > 1 )
        	{
			$pagination .= '&nbsp;&nbsp;&nbsp;<img src="'.XOOPS_URL.'/images/icons/posticon.gif" /> ';
			for ( $i = 1; $i <= $totalpages; $i++ )
			{
				if ( $i > 3 && $i < $totalpages )
				{
					$pagination .= "...";
				}
				else
				{
					$addlink = '&start='.(($i - 1) * $arr['posts_per_page']);
					$pagination .= '[<a href="'.$topiclink.$addlink.'">'.$i.'</a>]';
				}
			}
			$topic['topic_page_jump'] = $pagination;
		}
		$topic['title'] = $myts->htmlSpecialChars($arr['topic_title']) . "</a>" . $pagination;
	}
// Hack nb page
        $lastpostername = $db->query("SELECT post_id, uid FROM ".$db->prefix("bbex_posts")." WHERE post_id = $tmpuser2");
        while ($tmpdb=$db->fetchArray($lastpostername)) {
            $tmpuser = XoopsUser::getUnameFromId($tmpdb['uid']);
            // Ajout Hervé
            if (get_show_name($arr['forum_id'])) {
            	if(trim(username($tmpdb['uid']))!='') {
            		$tmpuser = username($tmpdb['uid']);
            	}
            }
            if ( $options[1] != 0 ) {
                $topic['time'] = formatTimestamp($arr['topic_time'],'m')." $tmpuser";
            }
        }
        $block['topics'][] =& $topic;
        unset($topic);
    }
    return $block;
}

// Shows monthly statistics
function b_newbbex_show_monthly_forums_stat()
{
	global $xoopsUser;
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::getInstance();
    $block = array();
    $TblCateg=array();

    $firstday=mktime(2,0,0,date("n"),1,date("Y"));
    // From the Zend web site :
	// The last day of any given month can be expressed as the "0" day of the next month,
    $year=date("Y");
    $curmonth=date("n")+1;
    if($curmonth>12)
    {
    	$curmonth=1;
    	$year++;
    }
    $lastday = mktime(0, 0, 0, $curmonth, 0, $year);

    $block['lang_public'] = _MDEX_NEWBB_PUBLIC;
    $block['lang_private'] = _MDEX_NEWBB_PRIVATE;
    $block['lang_forum'] = _MBEX_NEWBB_FORUM;
    $block['lang_topics'] = _MDEX_NEWBB_TOPICS;
    $block['lang_replies'] = _MBEX_NEWBB_RPLS;
    $block['lang_visitforums'] = _MBEX_NEWBB_VSTFRMS;
    $block['lang_forumtype'] = _MDEX_NEWBB_FORUMTYPE;
    $block['lang_category'] = _MDEX_NEWBB_CETEGORY;
    $block['lang_month_messages'] = _MDEX_NEWBB_MONTHMESSAGES;
    $block['lang_interval'] = sprintf("%s %s %s %s",_MDEX_NEWBB_FROM,formatTimestamp($firstday),_MDEX_NEWBB_TO,formatTimestamp($lastday));

    $query='SELECT cat_id, cat_title FROM '.$db->prefix('bbex_categories').' ORDER BY cat_id';
    if (!$result = $db->query($query))
    {
        return false;
    }
    while ($arr = $db->fetchArray($result))
    {
		$TblCateg[$arr['cat_id']]=$arr['cat_title'];
    }

	// Hack for viewing only authorized forums
	if (is_object($xoopsUser))
	{
		$where1=private_forums_list_cant_access($xoopsUser->getVar('uid'),'');
		if(strlen(trim($where1))>0) {
			$where1= " WHERE (".$where1.') ';
		}
	} else {	// Don't give any access to private forums for anonymous users
		$where1=' WHERE f.forum_type=0 ';
	}

    $query='SELECT forum_id, forum_name, forum_desc, forum_topics, forum_posts, cat_id, forum_type FROM '.$db->prefix('bbex_forums').' '.$where1.' ORDER BY cat_id, forum_id';
    if (!$result = $db->query($query)) {
        return false;
    }

    while ($arr = $db->fetchArray($result)) {
        $forum['forum_id'] = $arr['forum_id'];
        $forum['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
        $forum['forum_desc'] = $myts->htmlSpecialChars($arr['forum_desc']);
        $forum['forum_cat_id'] = $arr['cat_id'];
        $forum['forum_cat_title'] = $myts->htmlSpecialChars($TblCateg[$arr['cat_id']]);
        $forum['forum_total_topics'] = $arr['forum_topics'];
        $forum['forum_total_posts'] = $arr['forum_posts'];
        $forum['forum_type'] = $arr['forum_type'];

		$sqlmonth="select count(post_id) as cpt FROM ".$db->prefix('bbex_posts')." WHERE forum_id=".$arr['forum_id']." AND (post_time>=".$firstday." and post_time<=".$lastday.")";
		if (!$resultmonth = $db->query($sqlmonth))
		{
			$forum['forum_total_month_posts'] = 0;
		}
		else
		{
			$arrmonth = $db->fetchArray($resultmonth);
			$forum['forum_total_month_posts'] = $arrmonth['cpt'];
		}
        $block['forums'][] =& $forum;
        unset($forum);
    }
    return $block;
}


// Ajout Hervé
// Shows global forums statistics
function b_newbbex_show_forums_stat($options)
{
	global $xoopsUser;
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::getInstance();
    $block = array();
    $TblCateg=array();
    $block['lang_public'] = _MDEX_NEWBB_PUBLIC;
    $block['lang_private'] = _MDEX_NEWBB_PRIVATE;
    $block['lang_forum'] = _MBEX_NEWBB_FORUM;
    $block['lang_topics'] = _MDEX_NEWBB_TOPICS;
    $block['lang_replies'] = _MBEX_NEWBB_RPLS;
    $block['lang_lastpost'] = _MDEX_NEWBB_LASTPOST;
    $block['lang_visitforums'] = _MBEX_NEWBB_VSTFRMS;
    $block['lang_forumtype'] = _MDEX_NEWBB_FORUMTYPE;
    $block['lang_category'] = _MDEX_NEWBB_CETEGORY;

    $query='SELECT cat_id, cat_title FROM '.$db->prefix('bbex_categories').' ORDER BY cat_id';
    if (!$result = $db->query($query))
    {
        return false;
    }
    while ($arr = $db->fetchArray($result))
    {
		$TblCateg[$arr['cat_id']]=$arr['cat_title'];
    }

	// Hack for viewing only authorized forums
	if (is_object($xoopsUser)) {
		$where1=private_forums_list_cant_access($xoopsUser->getVar('uid'),'');
		if(strlen(trim($where1))>0)
		{
			$where1= " WHERE (".$where1.') ';
		}
	} else {	// Don't give any access to private forums for anonymous users
		$where1=' WHERE f.forum_type=0 ';
	}

    $query='SELECT forum_id, forum_name, forum_desc, forum_topics, forum_posts, cat_id, forum_type, forum_last_post_id FROM '.$db->prefix('bbex_forums').' '.$where1.' ORDER BY cat_id, forum_id';
    if (!$result = $db->query($query)) {
        return false;
    }

    while ($arr = $db->fetchArray($result)) {
        $forum['forum_id'] = $arr['forum_id'];
        $forum['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
        $forum['forum_desc'] = $myts->htmlSpecialChars($arr['forum_desc']);
        $forum['forum_cat_id'] = $arr['cat_id'];
        $forum['forum_cat_title'] = $myts->htmlSpecialChars($TblCateg[$arr['cat_id']]);
        $forum['forum_topics'] = $arr['forum_topics'];
        $forum['forum_posts'] = $arr['forum_posts'];
        $forum['forum_type'] = $arr['forum_type'];
        $lastpostnum = $arr['forum_last_post_id'];
        $forum['forum_lastpost'] = '';
        if($lastpostnum!=0)
        {
        	if($lastpostres = $db->query("SELECT post_time FROM ".$db->prefix("bbex_posts")." WHERE post_id = $lastpostnum"))
        	{
	        	$arr2 = $db->fetchArray($lastpostres);
        		$forum['forum_lastpost'] = formatTimestamp($arr2['post_time']);
        	}
        }
        else
        {
        	$forum['forum_lastpost'] = '';
        }
        $block['forums'][] =& $forum;
        unset($forum);
    }
    return $block;
}



function b_newbbex_new_private_show($options) {
	global $xoopsUser;
    $db =& Database::getInstance();
    $myts =& MyTextSanitizer::getInstance();
    $block = array();
    // Ajout Hervé
    $where2='';
    switch($options[2]) {
    case 'views':
        $order = 't.topic_views';
        break;
    case 'replies':
        $order = 't.topic_replies';
        break;
    case 'withoutreplies':
    	$order = 't.topic_time';				// Sort them by time
    	$where2 = " AND t.topic_replies=0 ";	// Limit to topics without answer
    case 'time':
    default:
        $order = 't.topic_time';
        break;
    }

	// Hack for viewing only authorized forums
	if (is_object($xoopsUser)) {
		$where1=private_forums_list_cant_access($xoopsUser->getVar('uid'),'f.');
		if(strlen(trim($where1))>0) {
			$where1= " AND (".$where1.') ';
		}
	} else {	// Don't give any access to private forums for anonymous users
		$where1=' AND f.forum_type=0 ';
	}

    $query='SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.topic_time, t.topic_views, t.topic_replies, t.forum_id, f.forum_name, f.posts_per_page, p.uid FROM '.$db->prefix('bbex_topics').' t, '.$db->prefix('bbex_forums').' f,  '.$db->prefix('bbex_posts').' p WHERE (f.forum_type=1) '.$where1.' AND (f.forum_id=t.forum_id) AND (p.post_id=t.topic_last_post_id) '.$where2.' ORDER BY '.$order.' DESC';
    if (!$result = $db->query($query,$options[0],0)) {
        return false;
    }
    if ( $options[1] != 0 ) {
        $block['full_view'] = true;
    } else {
        $block['full_view'] = false;
    }
    $block['lang_forum'] = _MBEX_NEWBB_FORUM;
    $block['lang_topic'] = _MBEX_NEWBB_TOPIC;
    $block['lang_replies'] = _MBEX_NEWBB_RPLS;
    $block['lang_views'] = _MBEX_NEWBB_VIEWS;
    $block['lang_lastpost'] = _MBEX_NEWBB_LPOST;
    $block['lang_visitforums'] = _MBEX_NEWBB_VSTFRMS;
    while ($arr = $db->fetchArray($result)) {
        $topic['forum_id'] = $arr['forum_id'];
        $topic['forum_name'] = $myts->htmlSpecialChars($arr['forum_name']);
        $topic['id'] = $arr['topic_id'];
        $topic['title'] = $myts->htmlSpecialChars($arr['topic_title']);
        $topic['replies'] = $arr['topic_replies'];
        $topic['views'] = $arr['topic_views'];
// Hack nb pages
	if($options[3]==1)
	{
        	$pagination = '';
        	$addlink = '';
        	$topiclink = XOOPS_URL . '/modules/newbbex/viewtopic.php?topic_id='.$arr['topic_id'].'&amp;forum='.$arr['forum_id'].'&amp;jump=1';
        	$totalpages = ceil(($arr['topic_replies'] + 1) / $arr['posts_per_page']);
        	if ( $totalpages > 1 )
        	{
			$pagination .= '&nbsp;&nbsp;&nbsp;<img src="'.XOOPS_URL.'/images/icons/posticon.gif" /> ';
			for ( $i = 1; $i <= $totalpages; $i++ )
			{
				if ( $i > 3 && $i < $totalpages )
				{
					$pagination .= "...";
				}
				else
				{
					$addlink = '&start='.(($i - 1) * $arr['posts_per_page']);
					$pagination .= '[<a href="'.$topiclink.$addlink.'">'.$i.'</a>]';
				}
			}
			$topic['topic_page_jump'] = $pagination;
		}
		$topic['title'] = $myts->htmlSpecialChars($arr['topic_title']) . "</a>" . $pagination;
	}
// Hack nb page
        $tmpuser2 = $arr['topic_last_post_id'];
        $lastpostername = $db->query("SELECT post_id, uid FROM ".$db->prefix("bbex_posts")." WHERE post_id = $tmpuser2");
        while ($tmpdb=$db->fetchArray($lastpostername)) {
            $tmpuser = XoopsUser::getUnameFromId($tmpdb['uid']);
            // Ajout Hervé
            if (get_show_name($arr['forum_id'])) {
            	if(trim(username($tmpdb['uid']))!='') {
            		$tmpuser = username($tmpdb['uid']);
            	}
            }
            if ( $options[1] != 0 ) {
                $topic['time'] = formatTimestamp($arr['topic_time'],'m')." $tmpuser";
            }
        }
        $block['topics'][] =& $topic;
        unset($topic);
    }
    return $block;
}

function b_newbbex_new_edit($options) {
    $inputtag = "<input type='text' name='options[0]' value='".$options[0]."' />";
    $form = sprintf(_MBEX_NEWBB_DISPLAY,$inputtag);
    $form .= "<br /><TABLE BORDER=0><TR><TD>"._MBEX_NEWBB_DISPLAYF."</TD><TD><input type='radio' name='options[1]' value='1'";
    if ( $options[1] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;&nbsp;<input type='radio' name='options[1]' value='0'";
    if ( $options[1] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />"._NO."</TD></TR><TR><TD>";
    $form .= '<input type="hidden" name="options[2]" value="'.$options[2].'">';
// Ajout Hervé
    $form .= _MBEX_NEWBB_SHOWPAGINATOR."</TD><TD><input type='radio' name='options[3]' value='1'";
    if ( $options[3] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;&nbsp;<input type='radio' name='options[3]' value='0'";
    if ( $options[3] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />"._NO."</TD></TR></TABLE>";
// Fin ajout
    return $form;
}

?>
