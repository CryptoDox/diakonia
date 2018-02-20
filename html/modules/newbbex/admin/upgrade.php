<?php
// $Id$
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

include_once '../../../include/cp_header.php';
xoops_cp_header();

/**
 * Verify that a mysql table exists
*/
function newbbex_TableExists($tablename)
{
	global $xoopsDB;
	$result = $xoopsDB->queryF("SHOW TABLES LIKE '$tablename'");
	return($xoopsDB->getRowsNum($result) > 0);
}

/**
 * Verify that a field exists inside a mysql table
*/
function newbbex_FieldExists($fieldname,$table)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF("SHOW COLUMNS FROM	$table LIKE '$fieldname'");
	return($xoopsDB->getRowsNum($result) > 0);
}

/**
 * Add a field to a mysql table
 */
function newbbex_AddField($field, $table)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF('ALTER TABLE ' . $table . " ADD $field;");
	return $result;
}

if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
	// 1) Create, if it does not exists, the bbex_files table
	if(!newbbex_TableExists($xoopsDB->prefix('bbex_files'))) {
		$sql = 'CREATE TABLE '.$xoopsDB->prefix('bbex_files')." (
  			fileid int(8) unsigned NOT NULL auto_increment,
  			filerealname varchar(255) NOT NULL default '',
  			post_id int(8) unsigned NOT NULL default '0',
  			date int(10) NOT NULL default '0',
  			mimetype varchar(64) NOT NULL default '',
  			downloadname varchar(255) NOT NULL default '',
  			counter int(8) unsigned NOT NULL default '0',
  			PRIMARY KEY  (fileid),
  			KEY post_id (post_id)
			) TYPE=MyISAM;";
		$xoopsDB->queryF($sql);
	}

	// 2) Add the new field to the bbex_forums table
	if (!newbbex_FieldExists('allow_upload',$xoopsDB->prefix('bbex_forums'))) {
		newbbex_AddField("allow_upload TINYINT( 1 ) DEFAULT '0' NOT NULL",$xoopsDB->prefix('bbex_forums'));
	}
	echo "Module upgrade now, please, <a href='".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op=update&module=newbbex'>UPDATE IT</a>";
}
xoops_cp_footer();
?>
