<?php
/**
 * ****************************************************************************
 * newbbex - MODULE FOR XOOPS
 * Copyright (c) Hervé Thouzard of Instant Zero (http://www.instant-zero.com)
 * Created on 20 nov. 07 at 17:12:41
 * ****************************************************************************
 */
include 'header.php';
include_once XOOPS_ROOT_PATH.'/modules/newbbex/class/class.sfiles.php';
include_once XOOPS_ROOT_PATH.'/modules/newbbex/class.forumposts.php';

$fileid = (isset($_GET['fileid'])) ? intval($_GET['fileid']) : 0;
if (empty($fileid)) {
    redirect_header('index.php', 4,_ERRORS);
    exit();
}
$myts =& MyTextSanitizer::getInstance();
$sfiles = null;
$sfiles = new newbbex_sFiles($fileid);

if(!is_object($sfiles)) {
	redirect_header('index.php', 3, _NOPERM);
	exit();
}

// Do we have the right to see the file ?
$post_id = $sfiles->getPost_id();
// Recherche du post
$sql = 'SELECT forum_id, topic_id FROM '.$xoopsDB->prefix('bbex_posts').' WHERE post_id='.$post_id;
if ( !$result = $xoopsDB->query($sql) ) {
	redirect_header('index.php', 3, _NOPERM);
	exit();
}
$postData = $xoopsDB->fetchArray($result);
$forum = $postData['forum_id'];
$topic_id = $postData['topic_id'];

// Recherche du forum
$sql = 'SELECT t.topic_id, t.topic_title, t.topic_time, t.topic_status, t.topic_sticky, t.topic_last_post_id, f.forum_id, f.forum_name, f.forum_access, f.forum_type, f.allow_html, f.allow_sig, f.posts_per_page, f.hot_threshold, f.topics_per_page, f.allow_upload FROM '.$xoopsDB->prefix('bbex_topics').' t LEFT JOIN '.$xoopsDB->prefix('bbex_forums').' f ON f.forum_id = t.forum_id WHERE t.topic_id = '.$topic_id.' AND t.forum_id = '.$forum;
if ( !$result = $xoopsDB->query($sql) ) {
	redirect_header('index.php', 3, _NOPERM);
	exit();
}

if ( !$forumdata = $xoopsDB->fetchArray($result) ) {
	redirect_header('index.php', 3, _NOPERM);
	exit();
}

if ( $forumdata['forum_type'] == 1 ) {	// this is a private forum.
	$accesserror = 0;
	if ( is_object($xoopsUser) ) {
		if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
			if ( !check_priv_forum_auth($xoopsUser->getVar('uid'), $forum, false) ) {
				$accesserror = 1;
			}
		}
	} else {
		$accesserror = 1;
	}
	if ( $accesserror == 1 ) {
		redirect_header("index.php", 3, _NOPERM);
		exit();
	}
} else {	// this is not a priv forum
	if ( $forumdata['forum_access'] == 1 ) {	// this is a reg user only forum
		if ( !is_object($xoopsUser)) {
			redirect_header("index.php", 3, _NOPERM);
			exit();
		}
	} elseif ( $forumdata['forum_access'] == 2 ) {	// this is an open forum

	} else {
		// this is an admin/moderator only forum
		if ( is_object($xoopsUser)) {
			if ( $xoopsUser->isAdmin($xoopsModule->mid()) || is_moderator($forum, $xoopsUser->getVar('uid')) ) {

			} else {
				redirect_header("index.php", 3, _NOPERM);
				exit();
			}
		} else {
			redirect_header("index.php", 3, _NOPERM);
			exit();
		}
	}
}
$sfiles->updateCounter();
$url = XOOPS_UPLOAD_URL.'/'.$sfiles->getDownloadname();
if (!preg_match("/^ed2k*:\/\//i", $url)) {
	Header("Location: $url");
}
echo "<html><head><meta http-equiv=\"Refresh\" content=\"0; URL=".$myts->htmlSpecialChars($url)."\"></meta></head><body></body></html>";
exit();
?>