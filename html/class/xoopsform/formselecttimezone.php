<?php
/**
 * XOOPS form element
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
 * @subpackage      form
 * @since           2.0.0
 * @author          Kazumi Ono (AKA onokazu) http://www.myweb.ne.jp/, http://jp.xoops.org/
 * @version         $Id: formselecttimezone.php 4897 2010-06-19 02:55:48Z phppp $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * lists of values
 */

xoops_load('XoopsLists');
xoops_load('XoopsFormSelect');

/**
 * A select box with timezones
 */
class XoopsFormSelectTimezone extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption
     * @param string $name
     * @param mixed $value Pre-selected value (or array of them).
     * 							Legal values are "-12" to "12" with some ".5"s strewn in ;-)
     * @param int $size Number of rows. "1" makes a drop-down-box.
     */
    function XoopsFormSelectTimezone($caption, $name, $value = null, $size = 1)
    {
        $this->XoopsFormSelect($caption, $name, $value, $size);
        $this->addOptionArray(XoopsLists::getTimeZoneList());
    }
}

?>