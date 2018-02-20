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
 * XOOPS Poll module
 *
 * @copyright::  {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license::    {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @package::    xoopspoll
 * @subpackage:: admin
 * @since::      1.32
 * @author::     XOOPS Module Team
 * @version::    $Id: admin_footer.php 12482 2014-04-25 12:08:17Z beckmi $
 *
 * @uses $GLOBALS['xoopsModule'] used to get information about the module
 * @uses xoops_gethandler() used to load information about the module
 * @uses XoopsModule::getByDirname() to load information if module info not currently present
 */

if (!isset($GLOBALS['xoopsModule']) || !($GLOBALS['xoopsModule'] instanceof XoopsModule)) {
    $GLOBALS['xoopsModule'] =& XoopsModule::getByDirname('xoopspoll');
}

$moduleHandler =& xoops_gethandler('module');
$moduleInfo =& $moduleHandler->get($GLOBALS['xoopsModule']->getVar('mid'));

$pathImageAdmin = '..' . DIRECTORY_SEPARATOR . $moduleInfo->getInfo('icons32');

echo "<div class='adminfooter'>\n"
   . "  <div class='center'>\n"
   . "    <a href='" . $moduleInfo->getInfo('author_website_url') . "' target='_blank'><img src='{$pathImageAdmin}" . DIRECTORY_SEPARATOR . "xoopsmicrobutton.gif' alt='" . $xoopsModule->getInfo('author_website_name') . "' title='" . $moduleInfo->getInfo('author_website_name') . "' /></a>\n"
   . "  </div>\n"
   . "  <div class='center smallsmall italic pad5'>\n"
   . "    " . _AM_XOOPSPOLL_MAINTAINED_BY
   . " <a class='tooltip' rel='external' href='http://" . $GLOBALS['xoopsModule']->getInfo('module_website_url') . "' "
   . "title='" . _AM_XOOPSPOLL_MAINTAINTED_TITLE . "'>" . _AM_XOOPSPOLL_MAINTAINTED_TEXT . "</a>\n"
   . "  </div>\n"
   . "</div>";
xoops_cp_footer();
