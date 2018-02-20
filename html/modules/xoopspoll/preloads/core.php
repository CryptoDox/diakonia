<?php
/*
                XOOPS - PHP Content Management System
                    Copyright (c) 2012 XOOPS.org
                       <http://www.xoops.org/>
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  You may not change or alter any portion of this comment or credits
  of supporting developers from this source code or any supporting
  source code which is considered copyrighted (c) material of the
  original comment or credit authors.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
*/
/**
 *  XOOPS Poll Module results mailer preload
 *
 * @copyright::  {@link http://xoops.org The XOOPS Project}
 * @license::    {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @package::    xoopspoll
 * @subpackage:: preloads
 * @since::      1.4
 * @author::     zyspec <owners@zyspec.com>
 * @version::    $Id: core.php 12482 2014-04-25 12:08:17Z beckmi $
 **/

class XoopspollCorePreload extends XoopsPreloadItem
{
    /**
     * plugin class for Xoops preload for index page start
     * @return void
     */
    public function eventCoreIndexStart($args)
    {
        // check once per user session if expired poll email has been sent
        if (empty($_SESSION['pollChecked'])) {
            $pollHandler = xoops_getmodulehandler('poll', 'xoopspoll');
            $pollHandler->mailResults();  //send the results of any polls that have ended
            unset($pollHandler);
            $_SESSION['pollChecked'] = 1;
        }
    }
}
