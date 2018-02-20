<?php
/*
               XOOPS - PHP Content Management System
                   Copyright (c) 2000 XOOPS.org
                      <http://www.xoops.org/>
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting
 source code which is considered copyrighted (c) material of the
 original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
*/
/**
 * Poll Results page for the XoopsPoll Module
 *
 * @copyright::  {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license::    {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @package::    xoopspoll
 * @subpackage:: admin
 * @since::		 1.0
 * @author::     {@link http://www.myweb.ne.jp/ Kazumi Ono (AKA onokazu)}
 * @version::    $Id: pollresults.php 12482 2014-04-25 12:08:17Z beckmi $
 **/

/**
 * @uses xoops_load() method used to load classes
 * @uses redirect_header() function used to send user to another location after completing task(s)
 * @uses $GLOBALS['xoops']::path gets XOOPS directory information
 * @uses xoops_getmodulehandler() to load handler for this module's class(es)
 */
include '..'. DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "mainfile.php";

xoops_load('constants', 'xoopspoll');
xoops_load('renderer', 'xoopspoll');
xoops_load('request', 'xoopspoll');

$pollId = XoopspollRequest::getInt('poll_id', 0);
/*
 * check to see if we want to show polls created by the forum (newbb) module
 */
if ($GLOBALS['xoopsModuleConfig']['hide_forum_polls']) {
    $module_handler =& xoops_gethandler('module');
    $newbbModule =& $module_handler->getByDirname('newbb');
    if ($newbbModule instanceof XoopsModule && $newbbModule->isactive()) {
        $topic_handler = xoops_getmodulehandler('topic', 'newbb');
        $tCount = $topic_handler->getCount(new Criteria('poll_id', $pollId, '='));
        if (!empty($tCount)) {
            $pollId = 0; // treat it as if no poll requested
        }
    }
}

if (empty($pollId)) {
    redirect_header('index.php', XoopspollConstants::REDIRECT_DELAY_NONE);
    exit();
}
$GLOBALS['xoopsOption']['template_main'] = 'xoopspoll_results.tpl';
include $GLOBALS['xoops']->path("header.php");

$pollHandler =& xoops_getmodulehandler('poll', 'xoopspoll');
$pollObj = $pollHandler->get($pollId);
if ((!empty($pollObj)) && ($pollObj instanceof XoopspollPoll)) {
    /* make sure the poll has started */
    if ($pollObj->getVar('start_time') > time()) {
        redirect_header('index.php', XoopspollConstants::REDIRECT_DELAY_NONE);
        exit();
    }

    /* assign variables to template */
    $renderer = new XoopspollRenderer($pollObj);
    $renderer->assignResults($GLOBALS['xoopsTpl']);

    $visReturn = $pollObj->isResultVisible();
    $isVisible = (true === $visReturn) ? true : false;
    $visibleMsg = ($isVisible) ? "" : $visReturn;

    $GLOBALS['xoopsTpl']->assign(array(
                                   'visible_msg'    => $visibleMsg,
                                   'disp_votes'     => $GLOBALS['xoopsModuleConfig']['disp_vote_nums'],
                                   'back_link_icon' => $GLOBALS['xoopsModule']->getInfo('icons16') . DIRECTORY_SEPARATOR . "back.png",
                                   'back_link'      => $GLOBALS['xoops']->url("modules/xoopspoll/index.php"),
                                   'back_text'      => _BACK)
    );
} else {
    redirect_header('index.php', XoopspollConstants::REDIRECT_DELAY_MEDIUM, _MD_XOOPSPOLL_ERROR_INVALID_POLLID);
}
include $GLOBALS['xoops']->path('include' . DIRECTORY_SEPARATOR . 'comment_view.php');
include $GLOBALS['xoops']->path('footer.php');
