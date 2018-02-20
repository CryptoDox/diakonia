<?php
// $Id: forumform.inc.php,v 1.16 2003/11/16 05:42:46 okazu Exp $
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

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
include_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
include_once XOOPS_ROOT_PATH.'/include/xoopscodes.php';

if($forumdata['allow_upload'] == 1) {
	$multipart = 'enctype="multipart/form-data"';
} else {
	$multipart = '';
}

echo "<form action='post.php' $multipart method='post' name='forumform' id='forumform' onsubmit='return xoopsValidate(\"subject\", \"message\", \"contents_submit\", \"".htmlspecialchars(_PLZCOMPLETE, ENT_QUOTES)."\", \"".htmlspecialchars(_MESSAGETOOLONG, ENT_QUOTES)."\", \"".htmlspecialchars(_ALLOWEDCHAR, ENT_QUOTES)."\", \"".htmlspecialchars(_CURRCHAR, ENT_QUOTES)."\");'><table cellspacing='1' class='outer' width='100%'><tr><td class='head' width='25%' valign='top'>". _MDEX_ABOUTPOST .":</td>";

$class = '';
$class = ($class == 'even') ? 'odd' : 'even';

if ( $forumdata['forum_type'] == 1 ) {
	echo "<td class='$class'>". _MDEX_PRIVATE ."</td>";
} elseif ( $forumdata['forum_access'] == 1 ) {
	echo "<td class='$class'>". _MD_REGCANPOST ."</td>";
} elseif ( $forumdata['forum_access'] == 2 ) {
	echo "<td class='$class'>". _MDEX_ANONCANPOST ."</td>";
} elseif ( $forumdata['forum_access'] == 3 ) {
	echo "<td class='$class'>". _MDEX_MODSCANPOST ."</td>";
}

$class = ($class == 'even') ? 'odd' : 'even';
echo "</tr><tr><td class='head' valign='top' nowrap='nowrap'>". _MDEX_SUBJECTC ."</td><td class='$class'>";
$class = ($class == 'even') ? 'odd' : 'even';
echo "<input type='text' id='subject' name='subject' size='60' maxlength='100' value='$subject' /></td></tr>";

// Ajout Hervé
$panels_params=get_show_panels($forum);
if(substr($panels_params,0,1)=='1') {
	echo "<tr><td class='head' valign='top' nowrap='nowrap'>". _MDEX_MESSAGEICON ."</td><td class='$class'>";
	$class = ($class == 'even') ? 'odd' : 'even';

	$lists = new XoopsLists;
	$filelist = $lists->getSubjectsList();
	$count = 1;
	while ( list($key, $file) = each($filelist) ) {
		$checked = "";
		if ( isset($icon) && $file==$icon ) {
			$checked = " checked='checked'";
		}
		echo "<input type='radio' value='$file' name='icon'$checked />&nbsp;";
		echo "<img src='".XOOPS_URL."/images/subject/$file' alt='' />&nbsp;";
		if ( $count == 8 ) {
			echo "<br />";
			$count = 0;
		}
		$count++;
	}
	echo "</td></tr>";
}


echo "<tr align='left'><td class='head' valign='top' nowrap='nowrap'>". _MDEX_MESSAGEC ."</td><td class='$class'>";
$class = ($class == 'even') ? 'odd' : 'even';
require_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
$editor_option = $xoopsModuleConfig['form_options'];
$editor = false;
$editor_configs = array();
$editor_configs['name'] = 'message';
$editor_configs['value'] = $message;
$editor_configs['rows'] = 35;
$editor_configs['cols'] = 60;
$editor_configs['width'] = '100%';
$editor_configs['height'] = '400px';
$editor_configs['editor'] = $editor_option;
$name = 'message';
$editor = new XoopsFormEditor('', $name, $editor_configs);
echo $editor->render();

if ( !empty($isreply) && isset($hidden) && $hidden != "" ) {
	echo "<input type='hidden' name='isreply' value='1' />";
	echo "<input type='hidden' name='hidden' id='hidden' value='$hidden' />
	<input type='button' name='quote' class='formButton' value='"._MDEX_QUOTE."' onclick='xoopsGetElementById(\"message\").value=xoopsGetElementById(\"message\").value + xoopsGetElementById(\"hidden\").value; xoopsGetElementById(\"hidden\").value=\"\";' /><br />";
}
// Ajout Hervé
if(substr($panels_params,1,1)=='1') {
	xoopsSmilies("message");
}

echo "</td></tr><tr>";

// File upload
if($forumdata['allow_upload'] == 1) {
	echo "<tr><td class='head' valign='top' nowrap='nowrap'>"._MDEX_ATTACH_FILE."</td>\n";
	echo "<td class='$class'><input type='hidden' name='MAX_FILE_SIZE' value='1000000' />\n";
	$class = ($class == 'even') ? 'odd' : 'even';
	echo "<input type='file' name='upfile' id='upfile' /><input type='hidden' name='xoops_upload_file[]' id='xoops_upload_file[]' value='upfile' /></td></tr>\n";
	if(isset($postFiles) && count($postFiles) > 0) {
		foreach($postFiles as $file) {
			echo "<tr><td class='head' valign='top' nowrap='nowrap'>"._MDEX_ATTACHED_FILES."</td>\n";
			$url = XOOPS_UPLOAD_URL.'/'.$file['downloadname'];
			echo "<td class='$class'><input type='checkbox' name='delattach[]' id='delattach[]' value='".$file['fileid']."' /> "._DELETE." <a href='$url' target='_blank'>".$file['filerealname'].'</a>';
			$class = ($class == 'even') ? 'odd' : 'even';
		}
	}
}

echo "<tr><td class='head' valign='top' nowrap='nowrap'>"._MDEX_OPTIONS."</td>\n";
echo "<td class='$class'>";
$class = ($class == 'even') ? 'odd' : 'even';

if ( is_object($xoopsUser) && $forumdata['forum_access'] == 2 && !empty($post_id) ) {
	echo "<input type='checkbox' name='noname' value='1'";
	if ( isset($noname) && $noname ) {
		echo " checked='checked'";
	}
	echo " />&nbsp;"._MDEX_POSTANONLY."<br />\n";
}

echo "<input type='checkbox' name='nosmiley' value='1'";
if ( isset($nosmiley) && $nosmiley ) {
	echo " checked='checked'";
}
echo " />&nbsp;"._MDEX_DISABLESMILEY."<br />\n";

if ( $forumdata['allow_html'] ) {
	echo "<input type='checkbox' name='nohtml' value='1'";
	if (isset($nohtml) && $nohtml ) {
		echo " checked='checked'";
	}
	echo " />&nbsp;"._MDEX_DISABLEHTML."<br />\n";
} else {
	echo "<input type='hidden' name='nohtml' value='1' />";
}

if ( $forumdata['allow_sig'] && is_object($xoopsUser) ) {
	echo "<input type='checkbox' name='attachsig' value='1'";
	if (isset($_POST['contents_preview'])) {
		if ( $attachsig ) {
			echo " checked='checked' />&nbsp;";
		} else {
			echo " />&nbsp;";
		}
	} else {
		if ($xoopsUser->getVar('attachsig') || !empty($attachsig)) {
			echo " checked='checked' />&nbsp;";
		} else {
			echo "/>&nbsp;";
		}
	}

	echo _MDEX_ATTACHSIG."<br />\n";
}

if (is_object($xoopsUser) && !empty($xoopsModuleConfig['notification_enabled'])) {
	echo "<input type='hidden' name='istopic' value='1' />";
	echo "<input type='checkbox' name='notify' value='1'";
	if (!empty($notify)) {
		// If 'notify' set, use that value (e.g. preview)
		echo ' checked="checked"';
	} else {
		// Otherwise, check previous subscribed status...
		$notification_handler =& xoops_gethandler('notification');
		if (!empty($topic_id) && $notification_handler->isSubscribed('thread', $topic_id, 'new_post', $xoopsModule->getVar('mid'), $xoopsUser->getVar('uid'))) {
			echo ' checked="checked"';
		}
	}
	echo " />&nbsp;"._MDEX_NEWPOSTNOTIFY."<br />\n";
}

$post_id = isset($post_id) ? intval($post_id) : '';
$topic_id = isset($topic_id) ? intval($topic_id) : '';
$order = isset($order) ? intval($order) : '';
$pid = isset($pid) ? intval($pid) : 0;
echo "</td></tr><tr><td class='head'></td><td class='$class'>
<input type='hidden' name='pid' value='".intval($pid)."' />
<input type='hidden' name='post_id' value='".$post_id."' />
<input type='hidden' name='topic_id' value='".$topic_id."' />
<input type='hidden' name='forum' value='".intval($forum)."' />
<input type='hidden' name='viewmode' value='$viewmode' />
<input type='hidden' name='order' value='".$order."' />
<input type='submit' name='contents_preview' class='formButton' value='"._PREVIEW."' />&nbsp;<input type='submit' name='contents_submit' class='formButton' id='contents_submit' value='"._SUBMIT."' />
<input type='button' onclick='location=\"";
if ( isset($topic_id) && $topic_id != "" ) {
	echo "viewtopic.php?topic_id=".intval($topic_id)."&amp;forum=".intval($forum)."\"'";
} else {
	echo "viewforum.php?forum=".intval($forum)."\"'";
}
echo " class='formButton' value='"._MDEX_CANCELPOST."' />";
echo "</td></tr></table></form>\n";
?>
