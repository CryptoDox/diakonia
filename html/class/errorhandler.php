<?php
/**
 * XOOPS legacy error handler
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
 * @version         $Id: errorhandler.php 4897 2010-06-19 02:55:48Z phppp $
 * @deprecated
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

xoops_loadLanguage('errors');

XoopsLoad::load('xoopslogger');

/**
 * Xoops ErrorHandler
 *
 * Backward compatibility code, do not use this class directly
 *
 * @package kernel
 * @subpackage core
 * @author Kazumi Ono <onokazu@xoops.org>
 * @author John Neill <catzwolf@xoops.org>
 * @copyright copyright (c) 2000-2003 XOOPS.org
 */
class XoopsErrorHandler extends XoopsLogger
{
    /**
     * Activate the error handler
     */
    function activate($showErrors = false)
    {
        $this->activated = $showErrors;
    }

    /**
     * Render the list of errors
     */
    function renderErrors()
    {
        return $this->dump('errors');
    }
}

?>