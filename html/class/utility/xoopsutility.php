<?php
/**
 * XOOPS Utilities
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
 * @subpackage      utility
 * @since           2.3.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: xoopsutility.php 0000 14/04/2009 22:14:29 Catzwolf $
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * XoopsUtility
 *
 * @package
 * @author John
 * @copyright Copyright (c) 2009
 * @version $Id$
 * @access public
 */
class XoopsUtility
{
    /**
     * Constructor
     */
    function __construct()
    {
    }

    /**
     * XoopsUtility Constructor
     */
    function XoopsUtility()
    {
        $this->__construct();
    }

	/**
     * XoopsUtility::recursive()
     *
     * @param mixed $handler
     * @param mixed $data
     * @return
     */
    function recursive($handler, $data)
    {
        if (is_array($data)) {
            $return = array_map(array(
                'XoopsUtility' ,
                'recursive'), $handler, $data);
            return $return;
        }
        // single function
        if (is_string($handler)) {
            return function_exists($handler) ? $handler($data) : $data;
        }
        // Method of a class
        if (is_array($handler)) {
            return call_user_func(array(
                $handler[0] ,
                $handler[1]), $data);
        }
        return $data;
    }
}

?>