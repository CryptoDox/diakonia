<?php
// $Id: vars.php,v 1.3 2005/10/19 17:20:33 phppp Exp $
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
//  Author: phppp (D.J., infomax@gmail.com)                                  //
//  URL: http://xoopsforge.com, http://xoops.org.cn                          //
//  Project: Article Project                                                 //
//  ------------------------------------------------------------------------ //
if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
include_once XOOPS_ROOT_PATH.'/modules/newbb/include/functions.ini.php';

$ori_error_level = ini_get('error_reporting');
error_reporting(E_ALL ^ E_NOTICE);

/**#@+
 * NewBB constant
 *
 **/
define('NEWBB_CONSTANTS',1);
define('NEWBB_READ', 1);
define('NEWBB_UNREAD', 2);
define('NEWBB_UNREPLIED', 3);
define('NEWBB_DIGEST', 4);
define('NEWBB_DELETEONE', 1);
define('NEWBB_DELETEALL', 2);
if (!defined('FORUM_PERM_ITEMS')) define('FORUM_PERM_ITEMS', 'access,view,post,reply,edit,delete,addpoll,vote,attach,noapprove');

/* some static xoopsModuleConfig */
$GLOBALS["xoopsModuleConfig"]["require_name"] = true; // "name" field is required for anonymous users in edit form

// MENU handler
/* You could remove anyone by commenting out in order to disable it */
$valid_menumodes = array(
	0 => _MD_MENU_SELECT,	// for selectbox
	1 => _MD_MENU_CLICK,	// for "click to expand"
	2 => _MD_MENU_HOVER		// for "mouse hover to expand"
	);

include_once XOOPS_ROOT_PATH.'/modules/newbb/include/functions.php';

// You shouldn't have to change any of these
$forumUrl['root'] = XOOPS_URL."/modules/" . $xoopsModule->dirname();
$forumUrl['images_root'] = $forumUrl['root']."/images";

//$handle = opendir(XOOPS_ROOT_PATH.'/modules/' . $xoopsModule->dirname() . '/images/imagesets/');
$setdir = $xoopsModuleConfig['image_set'];
//if (empty($setdir) || !is_dir(XOOPS_ROOT_PATH.'/modules/'. $xoopsModule->dirname() .'/images/imagesets/'.$setdir.'/')) {
if (empty($setdir)) {
	$setdir = "default";
}

$forumUrl['images_set']= $forumUrl['images_root']."/imagesets/".$setdir;
if (is_dir(XOOPS_ROOT_PATH.'/modules/'. $xoopsModule->dirname() .'/images/imagesets/'.$setdir.'/'.$xoopsConfig['language'])) {
	$forumUrl['images_lang']=$forumUrl['images_set']."/".$xoopsConfig['language'];
}else{
	$forumUrl['images_lang']=$forumUrl['images_set']."/english";
}

/* -- You shouldn't have to change anything after this point */
/* -- Images -- */

$forumImage['attachment'] = $forumUrl['images_set']."/attachment-a";
$forumImage['clip'] = $forumUrl['images_set']."/clip-a";
$forumImage['whosonline'] = $forumUrl['images_set']."/whosonline-a";

$forumImage['folder_sticky'] = $forumUrl['images_set']."/folder_sticky-a";
$forumImage['folder_digest'] = $forumUrl['images_set']."/folder_digest-a";
$forumImage['locked_topic'] = $forumUrl['images_set']."/lock-a";
$forumImage['poll'] = $forumUrl['images_set']."/poll-a";

$forumImage['newposts_forum'] = $forumUrl['images_set']."/folder_new_big-a";
$forumImage['folder_forum'] = $forumUrl['images_set']."/folder_big-a";
$forumImage['locked_forum'] = $forumUrl['images_set']."/folder_locked_big-a";
$forumImage['locked_forum_newposts'] = $forumUrl['images_set']."/folder_locked_big_newposts-a";
$forumImage['folder_topic'] = $forumUrl['images_set']."/folder-a";
$forumImage['hot_folder_topic'] = $forumUrl['images_set']."/hot_folder-a";
$forumImage['newposts_topic'] = $forumUrl['images_set']."/red_folder-a";
$forumImage['hot_newposts_topic'] = $forumUrl['images_set']."/hot_red_folder-a";
$forumImage['hot_user_folder_topic'] = $forumUrl['images_set']."/hot_folder_user-a";
$forumImage['newposts_user_topic'] = $forumUrl['images_set']."/red_folder_user-a";
$forumImage['folder_user_topic'] = $forumUrl['images_set']."/folder_user-a";

$forumImage['rss'] = $forumUrl['images_root']."/rss-a";
$forumImage['subforum'] = $forumUrl['images_root']."/arrow-a";
$forumImage['blank'] = $forumUrl['images_root']."/blank";
$forumImage['move_topic'] = $forumUrl['images_root']."/move_topic-a";
$forumImage['del_topic'] = $forumUrl['images_root']."/del_topic-a";
$forumImage['lock_topic'] = $forumUrl['images_root']."/lock_topic-a";
$forumImage['unlock_topic'] = $forumUrl['images_root']."/unlock_topic-a";
$forumImage['sticky'] = $forumUrl['images_root']."/sticky-a";
$forumImage['unsticky'] = $forumUrl['images_root']."/unsticky-a";
$forumImage['digest'] = $forumUrl['images_root']."/digest-a";
$forumImage['undigest'] = $forumUrl['images_root']."/undigest-a";

$forumImage['edit'] = $forumUrl['images_root']."/edit-a";
$forumImage['delete'] = $forumUrl['images_root']."/delete-a";
$forumImage['restart'] = $forumUrl['images_root']."/approve-a";
$forumImage['approve'] = $forumUrl['images_root']."/approve-a";

$forumImage['personal'] = $forumUrl['images_root']."/personal-a";
$forumImage['pm'] = $forumUrl['images_root'] . "/pm-a";
$forumImage['icq'] = $forumUrl['images_root'] . "/icq-a";
$forumImage['email'] = $forumUrl['images_root'] . "/email-a";
$forumImage['aim'] = $forumUrl['images_root'] . "/aim-a";
$forumImage['home'] = $forumUrl['images_root'] . "/home-a";
$forumImage['yahoo'] = $forumUrl['images_root'] . "/yahoo-a";
$forumImage['msnm'] = $forumUrl['images_root'] . "/msnm-a";
$forumImage['pdf'] = $forumUrl['images_root']."/pdf-a";
$forumImage['spacer'] = $forumUrl['images_root']."/spacer-a";
$forumImage['news'] = $forumUrl['images_root']."/news-a";
$forumImage['docicon'] = $forumUrl['images_root']."/document-a";

$forumImage['p_delete'] = $forumUrl['images_lang']."/p_delete-a";
$forumImage['p_reply'] = $forumUrl['images_lang']."/p_reply-a";
$forumImage['p_quote'] = $forumUrl['images_lang']."/p_quote-a";
$forumImage['p_edit'] = $forumUrl['images_lang']."/p_edit-a";
$forumImage['p_report'] = $forumUrl['images_lang']."/p_report-a";
$forumImage['p_up'] = $forumUrl['images_lang']."/p_up-a";
$forumImage['t_new'] = $forumUrl['images_lang']."/t_new-a";
$forumImage['t_poll'] = $forumUrl['images_lang']."/t_poll-a";
$forumImage['t_qr'] = $forumUrl['images_lang']."/t_qr-a";
$forumImage['t_reply'] = $forumUrl['images_lang']."/t_reply-a";

$forumImage['online'] = $forumUrl['images_lang']."/online-a";
$forumImage['offline'] = $forumUrl['images_lang']."/offline-a";
$forumImage['new_forum']    = $forumUrl['images_lang']."/new_forum-a";
$forumImage['new_subforum'] = $forumUrl['images_lang']."/new_subforum-a";

$forumImage['post_content'] = $forumUrl['images_set']."/post_content-a";

$forumImage['threaded'] = $forumUrl['images_set']."/threaded-a";
$forumImage['flat'] = $forumUrl['images_set']."/flat-a";
$forumImage['left'] = $forumUrl['images_set']."/left-a";
$forumImage['right'] = $forumUrl['images_set']."/right-a";
$forumImage['doubledown'] = $forumUrl['images_set']."/doubledown-a";
$forumImage['down'] = $forumUrl['images_set']."/down-a";
$forumImage['up'] = $forumUrl['images_set']."/up-a";
$forumImage['printer'] = $forumUrl['images_set']."/printer-a";

$forumImage['pm'] = XOOPS_URL."/images/icons/pm_small.gif";

$forumImage['rate1'] = $forumUrl['images_set'].'/rate1-a';
$forumImage['rate2'] = $forumUrl['images_set'].'/rate2-a';
$forumImage['rate3'] = $forumUrl['images_set'].'/rate3-a';
$forumImage['rate4'] = $forumUrl['images_set'].'/rate4-a';
$forumImage['rate5'] = $forumUrl['images_set'].'/rate5-a';

// NewBB cookie structure
/* -- Cookie settings -- */
$forumCookie['domain'] = "";
$forumCookie['path'] = "/";
$forumCookie['secure'] = false;
$forumCookie['expire'] = time() + 3600 * 24 * 30; // one month
$forumCookie['prefix'] = '';

// set cookie name to avoid subsites confusion such as: domain.com, sub1.domain.com, sub2.domain.com, domain.com/xoopss, domain.com/xoops2
if(empty($forumCookie['prefix'])){
	$cookie_prefix = preg_replace("/[^a-z_0-9]+/i", "_", preg_replace("/(http(s)?:\/\/)?(www.)?/i","",XOOPS_URL));
	$cookie_userid = (is_object($xoopsUser))?$xoopsUser->getVar('uid'):0;
	$forumCookie['prefix'] = $cookie_prefix."_".$xoopsModule->dirname().$cookie_userid."_";
}

// set LastVisitTemp cookie, which only gets the time from the LastVisit cookie if it does not exist yet
// otherwise, it gets the time from the LastVisitTemp cookie
//$last_visit = newbb_getcookie("LVT");
$last_visit = newbb_getsession("LV");
$last_visit = ($last_visit)?$last_visit:newbb_getcookie("LV");
$last_visit = ($last_visit)?$last_visit:time();


// update LastVisit cookie.
newbb_setcookie("LV", time(), $forumCookie['expire']); // set cookie life time to one month
//newbb_setcookie("LVT", $last_visit);
newbb_setsession("LV", $last_visit);

/* NewBB cookie storage
	Long term cookie: (configurable, generally one month)
		LV - Last Visit
		M - Menu mode
		V - View mode
		G - Toggle
	Short term cookie: (same as session life time)
		ST - Stored Topic IDs for mark
		LP - Last Post
		LF - Forum Last view
		LT - Topic Last read
		LVT - Last Visit Temp
*/

// include customized variables
if( is_object($GLOBALS["xoopsModule"]) && "newbb" == $GLOBALS["xoopsModule"]->getVar("dirname", "n") ) {
	$GLOBALS["xoopsModuleConfig"] = newbb_load_config();
}

newbb_load_object();

error_reporting($ori_error_level);
?>