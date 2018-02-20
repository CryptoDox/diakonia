<?php
/**
 *  XOOPS legacy functions
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         kernel
 * @since           2.3.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: functions.legacy.php 4897 2010-06-19 02:55:48Z phppp $
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Deprecated functions
 */

// Backward compat for 2.2*
function xoops_load_lang_file($name, $module = '', $default = 'english')
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use xoops_loadLanguage() instead");
    return xoops_loadLanguage($name, $module);
}

function xoops_refcheck($docheck = 1)
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use xoopsSecurity::checkReferer instead");
    return $GLOBALS['xoopsSecurity']->checkReferer($docheck);
}

function xoops_getLinkedUnameFromId($userid)
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use XoopsUserUtility::getUnameFromId() instead");
    xoops_load("XoopsUserUtility");
    return XoopsUserUtility::getUnameFromId($userid, false, true);
}

/*
 * Function to display banners in all pages
 */
function showbanner()
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use xoops_getbanner instead");
    echo xoops_getbanner();
}

/*
 * This function is deprecated. Do not use!
 */
function getTheme()
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use \$xoopsConfig['theme_set'] directly");
    return $GLOBALS['xoopsConfig']['theme_set'];
}

/*
 * Function to get css file for a certain theme
 * This function will be deprecated.
 */
function getcss($theme = '')
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use xoops_getcss instead");
    return xoops_getcss($theme);
}

function &getMailer()
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated, use xoops_getMailer instead");
    $mailer =& xoops_getMailer();
    return $mailer;
}

/*
 * Functions to display dhtml loading image box
 */
function OpenWaitBox()
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated");
    echo "<div id='waitDiv' style='position:absolute;left:40%;top:50%;visibility:hidden;text-align: center;'>
    <table cellpadding='6' border='2' class='bg2'>
      <tr>
        <td align='center'><strong><big>" . _FETCHING . "</big></strong><br /><img src='" . XOOPS_URL . "/images/await.gif' alt='' /><br />" . _PLEASEWAIT . "</td>
      </tr>
    </table>
    </div>
    <script type='text/javascript'>
    <!--//
    var DHTML = (document.getElementById || document.all || document.layers);
    function ap_getObj(name) {
        if (document.getElementById) {
            return document.getElementById(name).style;
        } else if (document.all) {
            return document.all[name].style;
        } else if (document.layers) {
            return document.layers[name];
        }
    }
    function ap_showWaitMessage(div,flag)  {
        if (!DHTML) {
            return;
        }
        var x = ap_getObj(div);
        x.visibility = (flag) ? 'visible' : 'hidden';
        if (!document.getElementById) {
            if (document.layers) {
                x.left=280/2;
            }
        }
        return true;
    }
    ap_showWaitMessage('waitDiv', 1);
    //-->
    </script>";
}

function CloseWaitBox()
{
    $GLOBALS['xoopsLogger']->addDeprecated("Function " . __FUNCTION__ . "() is deprecated");
    echo "<script type='text/javascript'>
    <!--//
    ap_showWaitMessage('waitDiv', 0);
    //-->
    </script>
    ";
}

?>