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
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: config.php 4897 2010-06-19 02:55:48Z phppp $
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

return $config = array(
    'highlight' => 'php',// Source code highlight: '' - disable; 'php' - php highlight; 'geshi' - geshi highlight
    'language' => 'PHP');// Default language for code highlight, applicable only if geshi is enabled

?>