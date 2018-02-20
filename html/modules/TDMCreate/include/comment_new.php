<?php
/**
 * ****************************************************************************
 *  - TDMCreate By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence GPL Copyright (c)  (http://www.tdmxoops.net)
 *
 * Cette licence, contient des limitations!!!
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license     TDM GPL license
 * @author		TDM TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
include '../../mainfile.php';
include_once XOOPS_ROOT_PATH.'/modules/catads/class/ads.php';
$com_itemid = isset($HTTP_GET_VARS['com_itemid']) ? intval($HTTP_GET_VARS['com_itemid']) : 0;
if ($com_itemid > 0) {
	$ads_handler = & xoops_getmodulehandler('ads');
//	$ads_handler = & xoops_getmodulehandler('ads', 'catads');
	$ads = & $ads_handler->get($com_itemid);
	$com_replytitle = $ads->getVar('ads_title');
	include XOOPS_ROOT_PATH.'/include/comment_new.php';
}
?>