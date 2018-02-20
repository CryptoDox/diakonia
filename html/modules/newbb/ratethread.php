<?php
// $Id: ratethread.php,v 1.3 2005/10/19 17:20:28 phppp Exp $
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

include 'header.php';

$ratinguser = is_object($xoopsUser)?$xoopsUser -> getVar('uid'):0;
$anonwaitdays = 1;
$ip = newbb_getIP(true);
foreach(array("topic_id", "rate", "forum") as $var){
	${$var} = isset($_POST[$var]) ? intval($_POST[$var]) : (isset($_GET[$var])?intval($_GET[$var]):0);
}

$topic_handler =& xoops_getmodulehandler('topic', 'newbb');
$topic_obj =& $topic_handler->get($topic_id);
if (!$topic_handler->getPermission($topic_obj->getVar("forum_id"), $topic_obj->getVar('topic_status'), "post")
	&&
	!$topic_handler->getPermission($topic_obj->getVar("forum_id"), $topic_obj->getVar('topic_status'), "reply")
){
	redirect_header("javascript:history.go(-1);", 2, _NOPERM);
}

if (empty($rate)){
	redirect_header("viewtopic.php?topic_id=".$topic_id."&amp;forum=".$forum."", 4, _MD_NOVOTERATE);
    exit();
}
$rate_handler =& xoops_getmodulehandler("rate", $xoopsModule->getVar("dirname"));
if ($ratinguser != 0) {
	// Check if Topic POSTER is voting (UNLESS Anonymous users allowed to post)
    $crit_post =& New CriteriaCompo(new Criteria("topic_id", $topic_id));
    $crit_post->add(new Criteria("post_uid", $ratinguser));
    $post_handler =& xoops_getmodulehandler("post", $xoopsModule->getVar("dirname"));
    if($post_handler->getCount($crit_post)){
        redirect_header("viewtopic.php?topic_id=".$topic_id."&amp;forum=".$forum."", 4, _MD_CANTVOTEOWN);
        exit();
    }
    // Check if REG user is trying to vote twice.
    $crit_rate =& New CriteriaCompo(new Criteria("topic_id", $topic_id));
    $crit_rate->add(new Criteria("ratinguser", $ratinguser));
    if($rate_handler->getCount($crit_rate)){
        redirect_header("viewtopic.php?topic_id=".$topic_id."&amp;forum=".$forum."", 4, _MD_VOTEONCE);
        exit();
    }
}else{
    // Check if ANONYMOUS user is trying to vote more than once per day.
    $crit_rate =& New CriteriaCompo(new Criteria("topic_id", $topic_id));
    $crit_rate->add(new Criteria("ratinguser", $ratinguser));
    $crit_rate->add(new Criteria("ratinghostname", $ip));
    $crit_rate->add(new Criteria("ratingtimestamp", time() - (86400 * $anonwaitdays), ">"));
    if($rate_handler->getCount($crit_rate)){
        redirect_header("viewtopic.php?topic_id=".$topic_id."&amp;forum=".$forum."", 4, _MD_VOTEONCE);
        exit();
    }
}
$rate_obj =& $rate_handler->create();
$rate_obj->setVar("rating", $rate*2);
$rate_obj->setVar("topic_id", $topic_id);
$rate_obj->setVar("ratinguser", $ratinguser);
$rate_obj->setVar("ratinghostname", $ip);
$rate_obj->setVar("ratingtimestamp", time());

$ratingid = $rate_handler->insert($rate_obj);;

newbb_updaterating($topic_id);
$ratemessage = _MD_VOTEAPPRE . "<br />" . sprintf(_MD_THANKYOU, $xoopsConfig['sitename']);
redirect_header("viewtopic.php?topic_id=".$topic_id."&amp;forum=".$forum."", 2, $ratemessage);
exit();

include 'footer.php';
?>