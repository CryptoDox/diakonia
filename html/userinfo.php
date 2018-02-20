<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XOOPS User
 *
 * See the enclosed file license.txt for licensing information.
 * If you did not receive this file, get it at http://www.fsf.org/copyleft/gpl.html
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU General Public License (GPL)
 * @package         core
 * @since           2.0.0
 * @author          Kazumi Ono <webmaster@myweb.ne.jp>
 * @version         $Id: userinfo.php 3538 2009-08-31 14:16:34Z trabis $
 */
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'mainfile.php';
$xoopsPreload =& XoopsPreload::getInstance();
$xoopsPreload->triggerEvent('core.userinfo.start');

xoops_loadLanguage('user');
include_once $GLOBALS['xoops']->path('class/module.textsanitizer.php');
include_once $GLOBALS['xoops']->path('modules/system/constants.php');

$uid = intval($_GET['uid']);
if ($uid <= 0) {
    redirect_header('index.php', 3, _US_SELECTNG);
    exit();
}

$gperm_handler =& xoops_gethandler('groupperm');
$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;

$isAdmin = $gperm_handler->checkRight('system_admin', XOOPS_SYSTEM_USER, $groups);
if (is_object($xoopsUser)) {
    if ($uid == $xoopsUser->getVar('uid')) {
        $config_handler =& xoops_gethandler('config');
        $xoopsConfigUser = $config_handler->getConfigsByCat(XOOPS_CONF_USER);
        $xoopsOption['template_main'] = 'system_userinfo.html';
        include $GLOBALS['xoops']->path('header.php');
        $xoopsTpl->assign('user_ownpage', true);
        $xoopsTpl->assign('lang_editprofile', _US_EDITPROFILE);
        $xoopsTpl->assign('lang_avatar', _US_AVATAR);
        $xoopsTpl->assign('lang_inbox', _US_INBOX);
        $xoopsTpl->assign('lang_logout', _US_LOGOUT);
        if ($xoopsConfigUser['self_delete'] == 1) {
            $xoopsTpl->assign('user_candelete', true);
            $xoopsTpl->assign('lang_deleteaccount', _US_DELACCOUNT);
        } else {
            $xoopsTpl->assign('user_candelete', false);
        }
        $thisUser =& $xoopsUser;
    } else {
        $member_handler =& xoops_gethandler('member');
        $thisUser =& $member_handler->getUser($uid);
        if (! is_object($thisUser) || ! $thisUser->isActive()) {
            redirect_header("index.php", 3, _US_SELECTNG);
            exit();
        }
        $xoopsOption['template_main'] = 'system_userinfo.html';
        include $GLOBALS['xoops']->path('header.php');
        $xoopsTpl->assign('user_ownpage', false);
    }
} else {
    $member_handler =& xoops_gethandler('member');
    $thisUser =& $member_handler->getUser($uid);
    if (!is_object($thisUser) || !$thisUser->isActive()) {
        redirect_header("index.php", 3, _US_SELECTNG);
        exit();
    }
    $xoopsOption['template_main'] = 'system_userinfo.html';
    include $GLOBALS['xoops']->path('header.php');
    $xoopsTpl->assign('user_ownpage', false);
}
$myts =& MyTextSanitizer::getInstance();
if (is_object($xoopsUser) && $isAdmin) {
    $xoopsTpl->assign('lang_editprofile', _US_EDITPROFILE);
    $xoopsTpl->assign('lang_deleteaccount', _US_DELACCOUNT);
    $xoopsTpl->assign('user_uid', $thisUser->getVar('uid'));
}
$xoopsOption['xoops_pagetitle'] = sprintf(_US_ALLABOUT, $thisUser->getVar('uname'));
$xoopsTpl->assign('lang_allaboutuser', sprintf(_US_ALLABOUT, $thisUser->getVar('uname')));
$xoopsTpl->assign('lang_avatar', _US_AVATAR);
//TODO make absolute avatar url
$xoopsTpl->assign('user_avatarurl', 'uploads/' . $thisUser->getVar('user_avatar'));
$xoopsTpl->assign('lang_realname', _US_REALNAME);
$xoopsTpl->assign('user_realname', $thisUser->getVar('name'));
$xoopsTpl->assign('lang_website', _US_WEBSITE);
if ($thisUser->getVar('url', 'E') == '') {
    $xoopsTpl->assign('user_websiteurl', '');
} else {
    $xoopsTpl->assign('user_websiteurl', '<a href="' . $thisUser->getVar('url', 'E') . '" rel="external">' . $thisUser->getVar('url') . '</a>');
}
$xoopsTpl->assign('lang_email', _US_EMAIL);
$xoopsTpl->assign('lang_privmsg', _US_PM);
$xoopsTpl->assign('lang_icq', _US_ICQ);
$xoopsTpl->assign('user_icq', $thisUser->getVar('user_icq'));
$xoopsTpl->assign('lang_aim', _US_AIM);
$xoopsTpl->assign('user_aim', $thisUser->getVar('user_aim'));
$xoopsTpl->assign('lang_yim', _US_YIM);
$xoopsTpl->assign('user_yim', $thisUser->getVar('user_yim'));
$xoopsTpl->assign('lang_msnm', _US_MSNM);
$xoopsTpl->assign('user_msnm', $thisUser->getVar('user_msnm'));
$xoopsTpl->assign('lang_location', _US_LOCATION);
$xoopsTpl->assign('user_location', $thisUser->getVar('user_from'));
$xoopsTpl->assign('lang_occupation', _US_OCCUPATION);
$xoopsTpl->assign('user_occupation', $thisUser->getVar('user_occ'));
$xoopsTpl->assign('lang_interest', _US_INTEREST);
$xoopsTpl->assign('user_interest', $thisUser->getVar('user_intrest'));
$xoopsTpl->assign('lang_extrainfo', _US_EXTRAINFO);
$var = $thisUser->getVar('bio', 'N');
$xoopsTpl->assign('user_extrainfo', $myts->displayTarea($var, 0, 1, 1));
$xoopsTpl->assign('lang_statistics', _US_STATISTICS);
$xoopsTpl->assign('lang_membersince', _US_MEMBERSINCE);
$var = $thisUser->getVar('user_regdate');
$xoopsTpl->assign('user_joindate', formatTimestamp($var, 's'));
$xoopsTpl->assign('lang_rank', _US_RANK);
$xoopsTpl->assign('lang_posts', _US_POSTS);
$xoopsTpl->assign('lang_basicInfo', _US_BASICINFO);
$xoopsTpl->assign('lang_more', _US_MOREABOUT);
$xoopsTpl->assign('lang_myinfo', _US_MYINFO);
$xoopsTpl->assign('user_posts', $thisUser->getVar('posts'));
$xoopsTpl->assign('lang_lastlogin', _US_LASTLOGIN);
$xoopsTpl->assign('lang_notregistered', _US_NOTREGISTERED);
$xoopsTpl->assign('lang_signature', _US_SIGNATURE);
$var = $thisUser->getVar('user_sig', 'N');
$xoopsTpl->assign('user_signature', $myts->displayTarea($var, 0, 1, 1));
if ($thisUser->getVar('user_viewemail') == 1) {
    $xoopsTpl->assign('user_email', $thisUser->getVar('email', 'E'));
} else {
    if (is_object($xoopsUser)) {
        // All admins will be allowed to see emails, even those that are not allowed to edit users (I think it's ok like this)
        if ($xoopsUserIsAdmin || ($xoopsUser->getVar("uid") == $thisUser->getVar("uid"))) {
            $xoopsTpl->assign('user_email', $thisUser->getVar('email', 'E'));
        } else {
            $xoopsTpl->assign('user_email', '&nbsp;');
        }
    }
}
if (is_object($xoopsUser)) {
    $xoopsTpl->assign('user_pmlink', "<a href=\"javascript:openWithSelfMain('" . XOOPS_URL . "/pmlite.php?send2=1&amp;to_userid=" . $thisUser->getVar('uid') . "', 'pmlite', 450, 380);\"><img src=\"" . XOOPS_URL . "/images/icons/pm.gif\" alt=\"" . sprintf(_SENDPMTO, $thisUser->getVar('uname')) . "\" /></a>");
} else {
    $xoopsTpl->assign('user_pmlink', '');
}
$userrank = $thisUser->rank();
if (isset($userrank['image']) && $userrank['image']) {
    $xoopsTpl->assign('user_rankimage', '<img src="' . XOOPS_UPLOAD_URL . '/' . $userrank['image'] . '" alt="" />');
}
$xoopsTpl->assign('user_ranktitle', $userrank['title']);
$date = $thisUser->getVar("last_login");
if (! empty($date)) {
    $xoopsTpl->assign('user_lastlogin', formatTimestamp($date, "m"));
}
$module_handler =& xoops_gethandler('module');
$criteria = new CriteriaCompo(new Criteria('hassearch', 1));
$criteria->add(new Criteria('isactive', 1));
$mids = array_keys($module_handler->getList($criteria));
foreach ($mids as $mid) {
    if ($gperm_handler->checkRight('module_read', $mid, $groups)) {
        $module = $module_handler->get($mid);
        $results = $module->search('', '', 5, 0, $thisUser->getVar('uid'));
        $count = count($results);
        if (is_array($results) && $count > 0) {
            for($i = 0; $i < $count; $i++) {
                if (isset($results[$i]['image']) && $results[$i]['image'] != '') {
                    $results[$i]['image'] = 'modules/' . $module->getVar('dirname') . '/' . $results[$i]['image'];
                } else {
                    $results[$i]['image'] = 'images/icons/posticon2.gif';
                }

                if (! preg_match("/^http[s]*:\/\//i", $results[$i]['link'])) {
                    $results[$i]['link'] = "modules/" . $module->getVar('dirname') . "/" . $results[$i]['link'];
                }

                $results[$i]['title'] = $myts->htmlspecialchars($results[$i]['title']);
                $results[$i]['time'] = $results[$i]['time'] ? formatTimestamp($results[$i]['time']) : '';
            }
            if ($count == 5) {
                $showall_link = '<a href="search.php?action=showallbyuser&amp;mid=' . $mid . '&amp;uid=' . $thisUser->getVar('uid') . '">' . _US_SHOWALL . '</a>';
            } else {
                $showall_link = '';
            }
            $xoopsTpl->append('modules', array(
                'name' => $module->getVar('name') ,
                'results' => $results ,
                'showall_link' => $showall_link));
        }
        unset($module);
    }
}
include $GLOBALS['xoops']->path('footer.php');

?>