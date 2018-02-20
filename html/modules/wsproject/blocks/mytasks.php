<?php
// $Id: mytasks.php 77 2005-09-07 22:56:44Z gron $
//  ------------------------------------------------------------------------ //
//              wsProject - A XOOPS Project Management Modul                 //
//                  Copyright (c) 2005 stefan-marr.de                        //
//                    <http://www.stefan-marr.de/>                           //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
define('WS_PROJECT', true);

include_once(XOOPS_ROOT_PATH."/modules/wsproject/class/functions.php");
include_once(XOOPS_ROOT_PATH."/modules/wsproject/class/core.php");

function b_wsproject_show_mytasks($options){
	global $xoopsUser;
	if ($xoopsUser != NULL) {
		$projectmanager = wsProject::getInstance();
		$projectmanager->processInput();
	
		$result['lang'] = $projectmanager->getLanguageData();
		$result['data'] = $projectmanager->getData();
		//print_r($result);
		if (isset($result['data']['projects'])) {
	 		return $result;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}
?>