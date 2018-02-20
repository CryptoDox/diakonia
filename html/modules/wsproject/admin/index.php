<?php
// $Id: index.php 75 2005-09-06 21:52:55Z gron $
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

include('../class/functions.php');

include '../../../include/cp_header.php';
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include "../language/".$xoopsConfig['language']."/main.php";
} else {
	include "../language/english/main.php";
}

function showAdmin() {
	$xoopsDB =& Database::getInstance();
	$myts =& MyTextSanitizer::getInstance();
	xoops_cp_header();
    echo "<h4>"._WS_PROJECTADMIN."</h4>";
	include XOOPS_ROOT_PATH."/class/xoopsformloader.php";
	$form       = new XoopsThemeForm(_WS_CONFIG, "addform", "index.php");
	
	//$form_group   = new XoopsFormSelectGroup(_WS_USEDGROUPS, "group", true, getUsedGroups(), 8, true);
	$form_admingroup = new XoopsFormSelectGroup(_WS_ADMINGROUPS, "admingroup", true, getAdminGroups(), 8, true);
	
	$op_hidden  = new XoopsFormHidden("op", "set");
	$submit_button = new XoopsFormButton("", "submir", _WS_APPLY, "submit");
	
	//$form->addElement($form_group);
	$form->addElement($form_admingroup);
	$form->addElement($op_hidden);
	$form->addElement($submit_button);
	$form->display();
	xoops_cp_footer();
}

foreach ($HTTP_GET_VARS as $varname => $value) {
	if (is_string($value)) {
		$value = stripslashes($value);
	}
	$vars[$varname] = $value;
}
foreach ($HTTP_POST_VARS as $varname => $value) {
    if (is_string($value)) {
		$value = stripslashes($value);
	}
	$vars[$varname] = $value;			
}

if (isset($vars)) {
	if ($vars['op'] == 'set') {
		if (isset($vars['admingroup'])) {
			setAdminGroups($vars['admingroup']);
		}
		else {
			setAdminGroups(array());
		}
	}
}

showAdmin();
?>