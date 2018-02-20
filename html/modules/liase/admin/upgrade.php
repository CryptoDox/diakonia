<?php
// $Id: upgrade.php,v 1.4 2005/02/14 12:52:55 tuff Exp $
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
include 'admin_header.php';
$version = number_format($xoopsModule->getVar('version')/100, 2);
$count =& $liaise_form_mgr->getCount(new Criteria(1));
if( $version >= 1.2 || $count > 0 ){
	xoops_cp_header();
	echo 'I guess this module has been upgraded already. Why don\'t you delete this file?';
}elseif( $_POST['goupgrade'] == 1){
	$sql = $msgs = $ret = array();
	$error = false;
	
	$msgs[] = 'Rename form elements table...';
	$sql[] = 'ALTER TABLE `'.$xoopsDB->prefix('liaise').'` RENAME `'.$xoopsDB->prefix('liaise_formelements').'`';
	
	$msgs[] = 'Add form_id to elements table...';
	$sql[] = 'ALTER TABLE `'.$xoopsDB->prefix('liaise_formelements')."` ADD `form_id` SMALLINT( 5 ) DEFAULT '1' NOT NULL AFTER `ele_id`";
	
	$msgs[] = 'Change default value of form_id in elements table...';
	$sql[] = 'ALTER TABLE `'.$xoopsDB->prefix('liaise_formelements')."` CHANGE `form_id` `form_id` SMALLINT( 5 ) DEFAULT '0' NOT NULL";
	
	$method = $xoopsModuleConfig['method'];
	$method = $xoopsModuleConfig['method'] == 'pm' ? 'p' : 'e';
	$sendto = !empty($xoopsModuleConfig['admin_only']) ? 0 : $xoopsModuleConfig['group'];
	$delimiter = $xoopsModuleConfig['delimeter'] == 'br' ? 'b' : 's';
	$msgs[] = 'Create forms table...';
	$sql[] = 
	"CREATE TABLE `".$xoopsDB->prefix('liaise_forms')."` (
	  `form_id` smallint(5) NOT NULL auto_increment,
	  `form_send_method` char(1) NOT NULL default 'e',
	  `form_send_to_group` smallint(3) NOT NULL default '0',
	  `form_order` smallint(3) NOT NULL default '0',
	  `form_delimiter` char(1) NOT NULL default 's',
	  `form_title` varchar(255) NOT NULL default '',
	  `form_submit_text` varchar(50) NOT NULL default '',
	  `form_desc` text NOT NULL,
	  `form_intro` text NOT NULL,
	  `form_whereto` varchar(255) NOT NULL default '',
	  PRIMARY KEY  (`form_id`),
	  KEY `form_order` (`form_order`)
	) ENGINE=MyISAM;";
	
	$msgs[] = 'Insert default data into forms table...';
	$sql[] = 
	"INSERT INTO `".$xoopsDB->prefix('liaise_forms')."` VALUES (1, '".$method."', ".intval($sendto).", 1, '".$delimiter."', 'Contact Us', '"._SUBMIT."', 'Tell us about your comments for this site.', 'Contact us by filling out this form.', '');";
	
	for( $i=0; $i<count($sql); $i++ ){
		if( false != $xoopsDB->query($sql[$i]) ){
			$ret[] = $msgs[$i].'done.';
		}else{
			$ret[] = $msgs[$i].'failed.';
			$ret[] = '&nbsp;&nbsp;'.$xoopsDB->error().' ('.$xoopsDB->errno().')';
			$error = true;
		}
	}
	
	if( $error == false ){
		$ret[] = 'Setting up default permissions...';
		$m = '&nbsp;&nbsp;Grant permission of form id 1 to group id %u...%s';
		for( $i=1; $i<4; $i++ ){
			$perm =& $moduleperm_handler->create();
			$perm->setVar('gperm_name', $liaise_form_mgr->perm_name);
			$perm->setVar('gperm_itemid', 1);
			$perm->setVar('gperm_groupid', $i);
			$perm->setVar('gperm_modid', $xoopsModule->getVar('mid'));
			if( !$moduleperm_handler->insert($perm) ){
				$ret[] = sprintf($m, $i, 'failed.');
				$error = true;
			}else{
				$ret[] = sprintf($m, $i, 'done.');
			}
		}
	}
	
	xoops_cp_header();
	$output = '';
	foreach( $ret as $r ){
		$output .= $r.'<br />';
	}
	echo '<pre><code>'.$output.'</code></pre>';
	
	if( false != $error ){
		echo '<b>Oh No! Upgrade seems failed... I honestly hope that you have a backup...</b>';
	}else{
		echo 'Upgrade successed. Now go <a href="'.XOOPS_URL.'/modules/system/admin.php?fct=modulesadmin&op=update&module=liaise">update this module</a>.';
	}
}else{
	xoops_cp_header();
	xoops_confirm(array('goupgrade' => 1), LIAISE_URL.'admin/upgrade.php', 'Make sure you have your files and database backuped. Are you really ready to upgrade the module now?', 'Cut the crap and do it');
}

xoops_cp_footer();
?>