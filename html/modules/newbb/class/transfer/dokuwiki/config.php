<?php
// $Id: config.php,v 1.1.1.1 2005/10/19 16:23:35 phppp Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
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
/**
 * Transfer::newbb config
 *
 * @author	    phppp, http://xoops.org.cn
 * @copyright	copyright (c) 2005 XOOPSForge.com
 * @package		module::article
 *
 */
//global $xoopsConfig, $xoopsModule;

$current_path = __FILE__;
if ( DIRECTORY_SEPARATOR != "/" ) $current_path = str_replace( strpos( $current_path, "\\\\", 2 ) ? "\\\\" : DIRECTORY_SEPARATOR, "/", $current_path);
$root_path = dirname($current_path);

$xoopsConfig['language'] = preg_replace("/[^a-z0-9_\-]/i", "", $xoopsConfig['language']);
if(!@include_once($root_path."/language/".$xoopsConfig['language'].".php")){
	include_once($root_path."/language/english.php");
}

return $config = array(
		"title"		=>	_MD_TRANSFER_DOKUWIKI,
		"module"	=>	"dokuwiki",
		"level"		=>	1,	/* 0 - hidden (For direct call only); 1 - display (available for selection) */
		"namespace"	=>	"transfer",
		"namespace_skip"	=>	array("discussion"),
		"prefix"	=>	$xoopsModule->getVar("dirname")
	);
?>