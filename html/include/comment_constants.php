<?php
/**
 * XOOPS constants
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
 * @since           2.0.0
 * @author          Kazumi Ono (AKA onokazu) http://www.myweb.ne.jp/, http://jp.xoops.org/
 * @version         $Id: comment_constants.php 4897 2010-06-19 02:55:48Z phppp $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Comment Constants
 *
 */
define('XOOPS_COMMENT_APPROVENONE', 0);
define('XOOPS_COMMENT_APPROVEALL', 1);
define('XOOPS_COMMENT_APPROVEUSER', 2);
define('XOOPS_COMMENT_APPROVEADMIN', 3);
define('XOOPS_COMMENT_PENDING', 1);
define('XOOPS_COMMENT_ACTIVE', 2);
define('XOOPS_COMMENT_HIDDEN', 3);
define('XOOPS_COMMENT_OLD1ST', 0);
define('XOOPS_COMMENT_NEW1ST', 1);
?>