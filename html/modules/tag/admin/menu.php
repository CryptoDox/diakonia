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
 * XOOPS tag management module
 *
 * @copyright       The XOOPS project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @since           1.0.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: menu.php 1575 2008-05-04 15:54:26Z phppp $
 * @package         tag
 */

$adminmenu = array();
$adminmenu[0]["title"] = TAG_MI_ADMENU_INDEX;
$adminmenu[0]["link"] = "admin/index.php";
$adminmenu[0]["icon"] = "images/admin/index.png";
$adminmenu[1]["title"] = TAG_MI_ADMENU_EDIT;
$adminmenu[1]["link"] = "admin/admin.tag.php";
$adminmenu[1]["icon"] = "images/admin/admin.png";
$adminmenu[2]["title"] = TAG_MI_ADMENU_SYNCHRONIZATION;
$adminmenu[2]["link"] = "admin/syn.tag.php";
$adminmenu[2]["icon"] = "images/admin/sync.png";

?>