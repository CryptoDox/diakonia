<?php
// $Id: post.php,v 1.20 2003/10/03 22:50:58 okazu Exp $
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

include 'header.php';

foreach (array('forum', 'topic_id', 'post_id', 'order', 'pid') as $getint) {
	${$getint} = isset($_POST[$getint]) ? intval($_POST[$getint]) : 0;
}
$viewmode = (isset($_POST['viewmode']) && $_POST['viewmode'] != 'flat') ? 'thread' : 'flat';
if ( empty($forum) ) {
	redirect_header('index.php', 4, _MDEX_ERRORFORUM);
	exit();
} else {
	$sql = "SELECT forum_type, forum_name, forum_access, allow_html, allow_sig, posts_per_page, hot_threshold, topics_per_page,allow_upload FROM ".$xoopsDB->prefix('bbex_forums').' WHERE forum_id = '.$forum;
	if ( !$result = $xoopsDB->query($sql) ) {
		redirect_header('index.php', 3,_MDEX_ERROROCCURED);
		exit();
	}
	$forumdata = $xoopsDB->fetchArray($result);
	// 2005/2/4 contribution by GIJOE
	// prevent hacking of nohtml value
	if(empty($forumdata['allow_html'])) {
		$_POST['nohtml'] = 1;
	}

	if ( $forumdata['forum_type'] == 1 ) {
	// To get here, we have a logged-in user. So, check whether that user is allowed to view this private forum.
		$accesserror = 0;
		if ( is_object($xoopsUser)) {
			if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
				if ( !check_priv_forum_auth($xoopsUser->uid(), $_POST['forum'], true) ) {
					$accesserror = 1;
				}
			}
		} else {
			$accesserror = 1;
		}

		if ( $accesserror == 1 ) {
			redirect_header("viewforum.php?order=".$order."&viewmode=".$viewmode."&forum=".$forum, 4,_MDEX_NORIGHTTOPOST);
			exit();
		}
	} else {
		$accesserror = 0;
		if ( $forumdata['forum_access'] == 3 ) {
			if ( is_object($xoopsUser)) {
				if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
					if ( !is_moderator($forum, $xoopsUser->uid()) ) {
						$accesserror = 1;
					}
				}
			} else {
				$accesserror = 1;
			}
		} elseif ( $forumdata['forum_access'] == 1 && !is_object($xoopsUser)) {
			$accesserror = 1;
		}
		if ( $accesserror == 1 ) {
			redirect_header("viewforum.php?order=".$order."&viewmode=".$viewmode."&forum=".$forum,2,_MDEX_NORIGHTTOPOST);
			exit();
		}
    }
	if ( !empty($_POST['contents_preview']) ) {
		include XOOPS_ROOT_PATH."/header.php";
		echo"<table width='100%' border='0' cellspacing='1' class='outer'><tr><td>";
		$myts =& MyTextSanitizer::getInstance();
		$p_subject = $myts->stripSlashesGPC($_POST['subject']);
		$p_subject = $myts->htmlSpecialChars($p_subject);
		$nosmiley = !empty($_POST['nosmiley']) ? 1 : 0;
		$nohtml = !empty($_POST['nohtml']) ? 1 : 0;

		if ( $nosmiley && $nohtml ) {
			$p_message = $myts->previewTarea($_POST['message'],0,0,1,1,1);
		} elseif ( $nohtml ) {
			$p_message = $myts->previewTarea($_POST['message'],0,1,1,1,1);
		} elseif ( $nosmiley ) {
			$p_message = $myts->previewTarea($_POST['message'],1,0,1,1,1);
		} else {
			$p_message = $myts->previewTarea($_POST['message'],1,1,1,1,1);
		}
		echo '<table cellpadding="4" cellspacing="1" width="98%" class="outer"><tr><td class="head">'.$p_subject.'</td></tr><tr><td><br />'.$p_message.'<br /></td></tr></table>';
		echo '<br />';
		$subject = $myts->stripSlashesGPC($_POST['subject']);
		$subject = $myts->htmlSpecialChars($subject);
		$message = $myts->stripSlashesGPC($_POST['message']);
		$message = $myts->htmlSpecialChars($message);
		$hidden = isset($_POST['hidden']) ? $myts->stripSlashesGPC($_POST['hidden']) : '';
		$hidden = $myts->htmlSpecialChars($hidden);
        $notify = !empty($_POST['notify']) ? 1 : 0;
		$attachsig = !empty($_POST['attachsig']) ? 1 : 0;
		include 'include/forumform.inc.php';
		echo"</td></tr></table>";
	} else {	// Send post
		include_once 'class/class.forumposts.php';
		require_once XOOPS_ROOT_PATH.'/class/uploader.php';
		require_once XOOPS_ROOT_PATH.'/modules/newbbex/class/class.sfiles.php';
		if ( !empty($post_id) ) {
			$editerror = 0;
			$forumpost = new ForumPosts($post_id);
			if ( is_object($xoopsUser)) {
				if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
					if ($forumpost->islocked() || ($forumpost->uid() != $xoopsUser->getVar("uid") && !is_moderator($forum, $xoopsUser->getVar("uid")))) {
						$editerror = 1;
					}
				}
			} else {
				$editerror = 1;
			}
			if ( $editerror == 1 ) {
				redirect_header("viewtopic.php?topic_id=".$topic_id."&post_id=".$post_id."&order=".$order."&viewmode=".$viewmode."&pid=".$pid."&forum=".$forum,2,_MDEX_EDITNOTALLOWED);
				exit();
			}
			$editor = $xoopsUser->getVar("uname");
   			$on_date .= _MDEX_ON." ".formatTimestamp(time());
			//$message .= "\n\n<small>[ "._MDEX_EDITEDBY." ".$editor." ".$on_date." ]</small>";
		} else {
			$isreply = 0;
			$isnew = 1;
			if ( is_object($xoopsUser) && empty($_POST['noname']) ) {
				$uid = $xoopsUser->getVar("uid");
			} else {
				if ( $forumdata['forum_access'] == 2 ) {
					$uid = 0;
				} else {
					if ( !empty($topic_id) ) {
						redirect_header("viewtopic.php?topic_id=".$topic_id."&order=".$order."&viewmode=".$viewmode."&pid=".$pid."&forum=".$forum,2,_MDEX_ANONNOTALLOWED);
					} else {
						redirect_header("viewforum.php?forum=".$forum,2,_MDEX_ANONNOTALLOWED);
					}
					exit();
				}
			}
			$forumpost = new ForumPosts();
			$forumpost->setForum($forum);
			if (isset($pid) && $pid != "") {
				$forumpost->setParent($pid);
			}
			if (!empty($topic_id)) {
				$forumpost->setTopicId($topic_id);
				$isreply = 1;
			}
			$forumpost->setIp($_SERVER['REMOTE_ADDR']);
			$forumpost->setUid($uid);
		}
		$subject = xoops_trim($_POST['subject']);
		$subject = ($subject == '') ? _NOTITLE : $subject;
		$forumpost->setSubject($subject);
		$forumpost->setText($_POST['message']);
		// 2004/12/15 contribution by minahito
		// prevent hacking of nohtml value
		if (empty($_POST['nohtml']) && $forumdata['allow_html']) {
			$forumpost->setNohtml(0);
		} else {
			$forumpost->setNohtml(1);
		}
		$tmpNosmiley = isset($_POST['nosmiley']) ? intval($_POST['nosmiley']) : 0;
		$tmpIcon = isset($_POST['icon']) ? $_POST['icon'] : '';
		$tmpAttachsig = isset($_POST['attachsig']) ? intval($_POST['attachsig']) : 0;
		$forumpost->setNosmiley($tmpNosmiley);
		$forumpost->setIcon($tmpIcon);
		$forumpost->setAttachsig($tmpAttachsig);
		if (!$postid = $forumpost->store()) {
			include_once(XOOPS_ROOT_PATH.'/header.php');
			xoops_error('Could not insert forum post');
			include_once(XOOPS_ROOT_PATH.'/footer.php');
			exit();
		}
		if (is_object($xoopsUser) && !empty($isnew)) {
			$xoopsUser->incrementPost();
		}
		// Manage upload ******************************************************
		if($forumdata['allow_upload'] == 1) {
			if(isset($_POST['xoops_upload_file'])) {
				$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
				$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
				if(xoops_trim($fldname != '')) {
					$sfiles = new newbbex_sFiles();
					$destname = $sfiles->createUploadName(XOOPS_UPLOAD_PATH,$fldname);
					$permittedtypes = explode("\n",str_replace("\r",'', $xoopsModuleConfig['mimetypes']));
					array_walk($permittedtypes, 'trim');
					$uploader = new XoopsMediaUploader( XOOPS_UPLOAD_PATH, $permittedtypes, $xoopsModuleConfig['maxuploadsize']);
					$uploader->setTargetFileName($destname);
					if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
						if ($uploader->upload()) {
							$sfiles->setFileRealName(htmlentities($uploader->getMediaName()));
							$sfiles->setPost_id($postid);
							$sfiles->setMimetype($sfiles->giveMimetype(XOOPS_UPLOAD_PATH.'/'.$uploader->getMediaName()));
							$sfiles->setDownloadname($destname);
							if(!$sfiles->store()) {
								echo _MDEX_UPLOAD_DBERROR_SAVE;
							}
						} else {
							echo _MDEX_UPLOAD_ERROR. ' ' . $uploader->getErrors();
						}
					} else {
						echo $uploader->getErrors();
					}
				}
			}

			// Faut-il supprimer des fichiers ?
			if(isset($_POST['delattach'])) {
				$ids = array();
				if(!is_array($_POST['delattach'])) {
					$ids[] = intval($_POST['delattach']);
				} else {
					$ids = $_POST['delattach'];
				}
				$uid = -1;
				$sqluid = 'SELECT uid FROM '.$xoopsDB->prefix('bbex_posts').' WHERE post_id='.$post_id;
				$resultuid = $xoopsDB->query($sqluid);
				if($resultuid) {
					$rowuid = $xoopsDB->fetchArray($resultuid);
					$uid = $rowuid['uid'];
				}
				foreach($ids as $id) {
					$id = intval($id);
					$file = null;
					$file = new newbbex_sFiles($id);
					if(is_object($file)) {
						// Peuvent supprimer des fichiers l'auteur du post, les modérateurs et les administrateurs
						if((is_object($xoopsUser) && $xoopsUser->getVar('uid') == $uid) || $xoopsUser->isAdmin($xoopsModule->mid()) || (is_object($xoopsUser) && is_moderator($forum, $xoopsUser->uid()))) {
							$file->delete();
						}
						unset($file);
					}
				}
			}
		}
		// ********************************************************************

		// RMV-NOTIFY
		// Define tags for notification message
		$tags = array();
		$tags['THREAD_NAME'] = $_POST['subject'];
		$tags['THREAD_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->dirname() . '/viewtopic.php?forum=' . $forum . '&post_id='.$postid.'&topic_id=' . $forumpost->topic();
		$tags['POST_URL'] = $tags['THREAD_URL'] . '#forumpost' . $postid;
		include_once XOOPS_ROOT_PATH.'/modules/newbbex/include/notification.inc.php';
		$forum_info = newbbex_notify_iteminfo ('forum', $forum);
		$tags['FORUM_NAME'] = $forum_info['name'];
		$tags['FORUM_URL'] = $forum_info['url'];
		$notification_handler =& xoops_gethandler('notification');
		if (!empty($isnew)) {
			if (empty($isreply)) {
				// Notify of new thread
				$notification_handler->triggerEvent('forum', $forum, 'new_thread', $tags);
			} else {
				// Notify of new post
				$notification_handler->triggerEvent('thread', $topic_id, 'new_post', $tags);
			}
			$notification_handler->triggerEvent('global', 0, 'new_post', $tags);
			$notification_handler->triggerEvent('forum', $forum, 'new_post', $tags);
			$myts =& MyTextSanitizer::getInstance();
			$tags['POST_CONTENT'] = $myts->stripSlashesGPC($_POST['message']);
			$tags['POST_NAME'] = $myts->stripSlashesGPC($_POST['subject']);
			$notification_handler->triggerEvent('global', 0, 'new_fullpost', $tags);
		}

		// If user checked notification box, subscribe them to the
		// appropriate event; if unchecked, then unsubscribe

		if (!empty($xoopsUser) && !empty($xoopsModuleConfig['notification_enabled'])) {
			if (!empty($_POST['notify'])) {
				$notification_handler->subscribe('thread', $forumpost->getTopicId(), 'new_post');
			} else {
				$notification_handler->unsubscribe('thread', $forumpost->getTopicId(), 'new_post');
			}
		}

		if ( $_POST['viewmode'] == "flat" ) {
			redirect_header("viewtopic.php?topic_id=".$forumpost->topic()."&amp;post_id=".$postid."&amp;order=".$order."&amp;viewmode=flat&amp;pid=".$pid."&amp;forum=".$forum."#forumpost".$postid."",2,_MDEX_THANKSSUBMIT);
			exit();
		} else {
			$post_id = $forumpost->postid();
			redirect_header("viewtopic.php?topic_id=".$forumpost->topic()."&amp;post_id=".$postid."&amp;order=".$order."&amp;viewmode=thread&amp;pid=".$pid."&amp;forum=".$forum."#forumpost".$postid."",2,_MDEX_THANKSSUBMIT);
			exit();
		}
	}
	include XOOPS_ROOT_PATH.'/footer.php';
}
?>
