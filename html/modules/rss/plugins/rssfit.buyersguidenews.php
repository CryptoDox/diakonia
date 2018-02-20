<?php
// $Id: rssfit.bueyrsguide.php 244 2006-07-20 08:41:42Z tuff $
###############################################################################
##                RSSFit - Extendable XML news feed generator                ##
##                Copyright (c) 2004 - 2006 NS Tai (aka tuff)                ##
##                       <http://www.brandycoke.com/>                        ##
###############################################################################
##                    XOOPS - PHP Content Management System                  ##
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
/*
 * About this RSSFit plug-in
 * Author: Herv� Thouzard of Instant Zero (http://www.instant-zero.com)
 * Requirements (Tested with):
 *  Module: Buyersguide
 *  Version: 1.33
 * Flux RSS : Derniers Fabricants
 *  RSSFit verision: 1.22
 *  XOOPS version: 2.0.18.1
 */

if( !defined('RSSFIT_ROOT_PATH') ){ exit(); }
class RssfitBuyersguidenews{
	var $dirname = 'buyersguide';
	var $modname;
	var $grab;

	function RssfitBuyersguidenews(){
	}

	function loadModule(){
		$mod =& $GLOBALS['module_handler']->getByDirname($this->dirname);
		if( !$mod || !$mod->getVar('isactive') ){
			return false;
		}
		$this->modname = $mod->getVar('name');
		return $mod;
	}

	function &grabEntries(&$obj){
		$ret = false;
		include XOOPS_ROOT_PATH.'/modules/buyersguide/include/common.php';
		$items = $hBgNews->getRecentNews(0, $this->grab);
		$i = 0;

		if( false != $items && count($items) > 0 ){
			foreach($items as $item) {
				$ret[$i]['link'] = $ret[$i]['guid'] = $item->getLink();
				$ret[$i]['title'] = $item->getVar('news_title', 'n');
				$ret[$i]['timestamp'] = $item->getVar('news_date');
				$ret[$i]['description'] = $item->getShortenText();
				$ret[$i]['category'] = $this->modname;
				$ret[$i]['domain'] = XOOPS_URL.'/modules/'.$this->dirname.'/';
				$i++;
			}
		}
		return $ret;
	}
}
?>