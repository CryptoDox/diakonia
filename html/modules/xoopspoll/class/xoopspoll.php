<?php
/*

 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XoopsPoll Class Definition
 * Description: XoopsPoll thunking class for backward compatibility.  This class should not be used
 * except by legacy modules (for example CBB(newbb) and xForum.
 *
 * @copyright::  {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license::    {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @package::    xoopspoll
 * @subpackage:: class
 * @since::		 1.40
 * @author::     zyspec <owners@zyspec.com>
 * @version::    $Id: xoopspoll.php 12482 2014-04-25 12:08:17Z beckmi $
 */
xoops_load('poll', 'xoopspoll');
/**
 * @deprecated
 */
class Xoopspoll extends XoopspollPoll
{
    /**
     * @deprecated
     */
    function __construct(&$id=null)
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __CLASS__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPoll and XoopspollPollHandler classes instead.");
        parent::__construct($id);
    }
    /**
     * @deprecated
     */
    public function XoopsPoll(&$id=null)
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __CLASS__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPoll and XoopspollPollHandler classes instead.");
        $this->__construct($id);
    }
}

/**
 * @deprecated
 */
class XoopsPollHandler extends XoopspollPollHandler
{
    /**
     * @deprecated
     */
    function __construct(&$db)
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __CLASS__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPoll and XoopspollPollHandler classes instead.");
        parent::__construct($db);
    }
    /**
     * @deprecated
     */
    public function XoopsPollHandler(&$db)
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __CLASS__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPoll and XoopspollPollHandler classes instead.");
        $this->__construct($db);
    }
}
