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
 * @version         $Id: header.php 2292 2008-10-12 04:53:18Z phppp $
 * @package         tag
 */

include "../../../include/cp_header.php";
require XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/include/vars.php";
require_once XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/include/functions.php";
xoops_loadLanguage("main", $xoopsModule->getVar("dirname"));

$myts =& MyTextSanitizer::getInstance();

IF (!@ include_once XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"):    

function loadModuleAdminMenu($currentoption, $breadcrumb = "")
{
    if (!$adminmenu = $GLOBALS["xoopsModule"]->getAdminMenu()) {
        return false;
    }
        
    $breadcrumb = empty($breadcrumb) ? $adminmenu[$currentoption]["title"] : $breadcrumb;
    $module_link = XOOPS_URL . "/modules/" . $GLOBALS["xoopsModule"]->getVar("dirname") . "/";
    $image_link = XOOPS_URL . "/modules/" . $GLOBALS["xoopsModule"]->getVar("dirname") . "/images";
}
    
ENDIF;
?>