<?php
// $Id: admin_header.php,v 1.7 2005/02/15 04:25:12 tuff Exp $
###############################################################################
##                Liaise -- Contact forms generator for XOOPS                ##
##                 Copyright (c) 2003-2005 NS Tai (aka tuff)                 ##
##                       <http://www.brandycoke.com/>                        ##
###############################################################################
##                   XOOPS - PHP Content Management System                   ##
##                       Copyright (c) 2000 XOOPS.org                        ##
##                          <http://www.xoops.org/>                          ##
###############################################################################
##  This program is free software; you can redistribute it and/or modify     ##
##  it under the terms of the GNU General Public License as published by     ##
##  the Free Software Foundation; either version 2 of the License, or        ##
##  (at your option) any later version.                                      ##
##                                                                           ##
##  You may not change or alter any portion of this comment or credits       ##
##  of supporting developers from this source code or any supporting         ##
##  source code which is considered copyrighted (c) material of the          ##
##  original comment or credit authors.                                      ##
##                                                                           ##
##  This program is distributed in the hope that it will be useful,          ##
##  but WITHOUT ANY WARRANTY; without even the implied warranty of           ##
##  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            ##
##  GNU General Public License for more details.                             ##
##                                                                           ##
##  You should have received a copy of the GNU General Public License        ##
##  along with this program; if not, write to the Free Software              ##
##  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA ##
###############################################################################
##  Author of this file: NS Tai (aka tuff)                                   ##
##  URL: http://www.brandycoke.com/                                          ##
##  Project: Liaise                                                          ##
###############################################################################
include '../../../include/cp_header.php';
include '../include/common.php';
define('LIAISE_ADMIN_URL', LIAISE_URL.'admin/index.php');
include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
function adminHtmlHeader(){
	global $xoopsModule, $xoopsConfig;
	$langf = LIAISE_ROOT_PATH.'language/'.$xoopsConfig['language'].'/modinfo.php';
	if( file_exists($langf) ){
		include $langf;
	}else{
		include LIAISE_ROOT_PATH.'language/english/modinfo.php';
	}
	include 'menu.php';
	for( $i=0; $i<3; $i++ ){
		$links[$i] = array(0 => LIAISE_URL.$adminmenu[$i]['link'], 1 => $adminmenu[$i]['title']);
	}
	$links[] = array(0 => XOOPS_URL.'/modules/system/admin.php?fct=preferences&op=showmod&mod='.$xoopsModule->getVar('mid'), 1 => _PREFERENCES);
	$admin_links = '<table class="outer" width="100%" cellspacing="1"><tr>';
	for( $i=0; $i<count($links); $i++ ){
		$admin_links .= '<td class="even" style="width: 25%; text-align: center;"><a href="'.$links[$i][0].'" accesskey="'.($i+1).'">'.$links[$i][1].'</a></td>';
	}
	$admin_links .= "</tr></table><br clear='all' />\n";
	xoops_cp_header();
	echo $admin_links;
}
?>