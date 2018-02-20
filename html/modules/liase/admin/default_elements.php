<?php
// $Id: default_elements.php,v 1.3 2005/02/14 12:52:55 tuff Exp $
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
if( preg_match('/default_elements.php/', $_SERVER['PHP_SELF']) ){
	die('Access denied');
}

$defaults = array();
$defaults[0]['caption'] = 'Your name';
$defaults[0]['req'] = true;
$defaults[0]['order'] = 1;
$defaults[0]['display'] = 1;
$defaults[0]['type'] = 'text';
$defaults[0]['value'] = array(
							0 => $xoopsModuleConfig['t_width'],
							1 => $xoopsModuleConfig['t_max'],
							2 => '{UNAME}'
							);

$defaults[1]['caption'] = 'Email address';
$defaults[1]['req'] = true;
$defaults[1]['order'] = 2;
$defaults[1]['display'] = 1;
$defaults[1]['type'] = 'text';
$defaults[1]['value'] = array(
							0 => $xoopsModuleConfig['t_width'],
							1 => $xoopsModuleConfig['t_max'],
							2 => '{EMAIL}'
							);

$defaults[2]['caption'] = 'Your comments';
$defaults[2]['req'] = true;
$defaults[2]['order'] = 3;
$defaults[2]['display'] = 1;
$defaults[2]['type'] = 'textarea';
$defaults[2]['value'] = array(
							0 => '',
							1 => $xoopsModuleConfig['ta_rows'],
							2 => $xoopsModuleConfig['ta_cols']
							);

?>