<?php
/**
 * user/member handlers
 *
 * @copyright       The XOOPS project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @since           1.00
 * @version         $Id: functions.user.php 2197 2008-09-29 14:36:07Z phppp $
 * @package         Frameworks
 * @subpackage      art
 */
if (!defined("FRAMEWORKS_ART_FUNCTIONS_USER")):
define("FRAMEWORKS_ART_FUNCTIONS_USER", true);

xoops_load('XoopsUserUtility');

function mod_getIP($asString = false)
{
    $GLOBALS['xoopsLogger']->addDeprecated("Deprecated function '" . __FUNCTION__ . "', use XoopsUserUtility directly.");
    return XoopsUserUtility::getIP($asString);
}

function &mod_getUnameFromIds( $uid, $usereal = false, $linked = false )
{
    $GLOBALS['xoopsLogger']->addDeprecated("Deprecated function '" . __FUNCTION__ . "', use XoopsUserUtility directly.");
    $ids = XoopsUserUtility::getUnameFromIds($uid, $usereal, $linked);
    return $ids;
}

function mod_getUnameFromId( $uid, $usereal = 0, $linked = false)
{
    $GLOBALS['xoopsLogger']->addDeprecated("Deprecated function '" . __FUNCTION__ . "', user XoopsUserUtility directly.");
    return XoopsUserUtility::getUnameFromId($uid, $usereal, $linked);
}

endif;
?>