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
 * @version         $Id: formradioyn.php 4897 2010-06-19 02:55:48Z phppp $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

xoops_load('XoopsFormRadio');

/**
 * Yes/No radio buttons.
 *
 * A pair of radio buttons labelled _YES and _NO with values 1 and 0
 */
class XoopsFormRadioYN extends XoopsFormRadio
{
    /**
     * Constructor
     *
     * @param string $caption
     * @param string $name
     * @param string $value Pre-selected value, can be "0" (No) or "1" (Yes)
     * @param string $yes String for "Yes"
     * @param string $no String for "No"
     */
    function XoopsFormRadioYN($caption, $name, $value = null, $yes = _YES, $no = _NO)
    {
        $this->XoopsFormRadio($caption, $name, $value);
        $this->addOption(1, $yes);
        $this->addOption(0, $no);
    }
}

?>