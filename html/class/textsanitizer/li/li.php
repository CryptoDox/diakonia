<?php
/**
 * TextSanitizer extension
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
 * @package         class
 * @subpackage      textsanitizer
 * @since           2.3.0
 * @author          Wishcraft <simon@xoops.org>
 * @version         $Id: li.php 3575 2009-09-05 19:35:11Z trabis $
 * @deprecated
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

class MytsLi extends MyTextSanitizerExtension
{
    function load(&$ts)
    {
        $ts->patterns[] = "/\[li](.*)\[\/li\]/sU";
        $ts->replacements[] = '<li>\\1</li>';
        return true;
    }
}

?>