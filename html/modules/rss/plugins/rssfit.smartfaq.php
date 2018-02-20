<?php
// $Id: rssfit.smartfaq.php 244 2006-07-20 08:41:42Z tuff $
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
* Author: tuff <http://www.brandycoke.com/>
* Requirements (Tested with):
*  Module: SmartFAQ <http://www.smartfactory.ca/>
*  Version: 1.04 / 1.1 dev
*  RSSFit verision: 1.2 / 1.5
*  XOOPS version: 2.0.13.2 / 2.2.3
*/

if( !defined('RSSFIT_ROOT_PATH') ){ exit(); }
class RssfitSmartfaq{
	var $dirname = 'smartfaq';
	var $modname;
	var $grab;
	
	function RssfitSmartfaq(){
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
		@include_once(XOOPS_ROOT_PATH."/modules/smartfaq/include/functions.php");
		$faq_handler =& sf_gethandler('faq');
		$faqs = $faq_handler->getAllPublished($this->grab, 0);
		if( false != $faqs && count($faqs) > 0 ){
			$answer_handler =& sf_gethandler('answer');
			for( $i=0; $i<count($faqs); $i++ ){
				if( !$answer = $answer_handler->getOfficialAnswer($faqs[$i]->faqid()) ){
					continue;
				}
				$ret[$i]['link'] = $ret[$i]['guid'] = XOOPS_URL.'/modules/smartfaq/faq.php?faqid='.$faqs[$i]->faqid();
				$q = $faqs[$i]->getVar('howdoi', 'n');
				$q = empty($q) ? $faqs[$i]->getVar('question', 'n') : $q;
				$ret[$i]['title'] = $q;
				$ret[$i]['timestamp'] = $faqs[$i]->getVar('datesub');
				$ret[$i]['description'] = $answer->getVar('answer');
				$ret[$i]['category'] = $this->modname;
				$ret[$i]['domain'] = XOOPS_URL.'/modules/'.$this->dirname.'/';
			}
		}
		return $ret;
	}
}
?>