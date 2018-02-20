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
 * @version         $Id: formselectgroup.php 4897 2010-06-19 02:55:48Z phppp $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Parent
 */
xoops_load('XoopsFormElement');

/**
 * A select field with a choice of available groups
 */
class XoopsFormSelectGroup extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption
     * @param string $name
     * @param bool $include_anon Include group "anonymous"?
     * @param mixed $value Pre-selected value (or array of them).
     * @param int $size Number or rows. "1" makes a drop-down-list.
     * @param bool $multiple Allow multiple selections?
     */
    function XoopsFormSelectGroup($caption, $name, $include_anon = false, $value = null, $size = 1, $multiple = false)
    {
        $this->XoopsFormSelect($caption, $name, $value, $size, $multiple);
        $member_handler = &xoops_gethandler('member');
        if (! $include_anon) {
            $this->addOptionArray($member_handler->getGroupList(new Criteria('groupid', XOOPS_GROUP_ANONYMOUS, '!=')));
        } else {
            $this->addOptionArray($member_handler->getGroupList());
        }
    }
}

?>