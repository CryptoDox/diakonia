<?php
// $Id: rssfeed.php 244 2006-07-20 08:41:42Z tuff $
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
##  Author of this file: NS Tai (aka tuff)                                   ##
##  URL: http://www.brandycoke.com/                                          ##
##  Project: RSSFit                                                          ##
###############################################################################

if( !defined('RSSFIT_ROOT_PATH') ){ exit(); }
class RssfeedHandler {
	var $rssmod;
	var $pHandler;
	var $mHandler;
	var $channelreq;
	var $sub_handler;
	var $plugin_obj;
	var $myts;
	var $modConfig;
	var $xoopsConfig;
	var $cached = '';
	var $charset = _CHARSET;
	var $feedkey = 'feed';
	var $plugin_file = 'rssfit.%s.php';
	var $substr_remove = array(',', '/', ';', ':', '(', '{', '[', ' ');
	var $substr_add = array('.', '!', '?', '}', ']', ')', '%');
	var $substr_endwith = '...';
	var $spec_url = 'http://blogs.law.harvard.edu/tech/rss';
	var $specs = array( 'req' => 'requiredChannelElements',
						'opt' => 'optionalChannelElements',
						'cloud' => 'ltcloudgtSubelementOfLtchannelgt',
						'img' => 'ltimagegtSubelementOfLtchannelgt'
						);
	var $escaped = array( 128 => '&#8364;', 130 => '&#8218;', 131 => '&#402;',
						  132 => '&#8222;', 133 => '&#8230;', 134 => '&#8224;',
						  135 => '&#8225;', 136 => '&#710;', 137 => '&#8240;',
						  138 => '&#352;', 139 => '&#8249;', 140 => '&#338;',
						  142 => '&#381;', 145 => '&#8216;', 146 => '&#8217;',
						  147 => '&#8220;', 148 => '&#8221;', 149 => '&#8226;',
						  150 => '&#8211;', 151 => '&#8212;', 152 => '&#732;',
						  153 => '&#8482;', 154 => '&#353;', 155 => '&#8250;',
						  156 => '&#339;', 158 => '&#382;', 159 => '&#376;');

	function RssfeedHandler(&$modConfig, &$xoopsConfig, &$xoopsModule){
		$this->myts =& MyTextSanitizer::getInstance();
		$this->rssmod =& $xoopsModule;
		$this->pHandler =& xoops_getmodulehandler('plugins');
		$this->mHandler =& xoops_getmodulehandler('misc');
		$this->modConfig =& $modConfig;
		$this->xoopsConfig =& $xoopsConfig;
		$this->channelreq = array('title' => $this->xoopsConfig['sitename'],
								 'link' => XOOPS_URL,
								 'description' => $this->xoopsConfig['slogan']);
	}

	function getChannel(&$feed){
		$channel = array();
		if( $elements =& $this->mHandler->getObjects(new Criteria('misc_category', 'channel')) ){
			foreach( $elements as $e){
				if( $e->getVar('misc_content') != '' ){
					$channel[$e->getVar('misc_title')] = $e->getVar('misc_content', 'n');
				}
			}
			$channel['language'] = _LANGCODE;
			$channel['lastBuildDate'] = $this->rssTimeStamp(time());
			if( $this->modConfig['cache'] ){
				$channel['ttl'] = $this->modConfig['cache'];
			}
		}
		if( !empty($feed['plugin']) ){
			if( is_object($this->plugin_obj) && is_object($this->sub_handler) ){
				$channel['title'] = $this->plugin_obj->getVar('sub_title', 'n');
				$channel['link'] = $this->plugin_obj->getVar('sub_link', 'n');
				$channel['description'] = $this->plugin_obj->getVar('sub_desc', 'n');
				$image = array( 'url' => $this->plugin_obj->getVar('img_url', 'n'),
								'title' => $this->plugin_obj->getVar('img_title', 'n'),
								'link' => $this->plugin_obj->getVar('img_link', 'n')
								);
			}
		}else{
			if( $img =& $this->mHandler->getObjects(new Criteria('misc_category', 'channelimg'), '*', 'title') ){
				$image = array( 'url' => $img['url']->getVar('misc_content', 'n'),
								'title' => $img['title']->getVar('misc_content', 'n'),
								'link' => $img['link']->getVar('misc_content', 'n')
								);
			}
		}
		if( empty($channel['title']) || empty($channel['link']) || empty($channel['description']) ){
			$channel = array_merge($channel, $this->channelreq);
		}
		foreach( $channel as $k=>$v ){
			$this->cleanupChars($channel[$k]);
		}
		if( !empty($image['url']) && !empty($image['title']) || !empty($image['link']) ){
			foreach( $image as $k=>$v ){
				$this->cleanupChars($image[$k]);
			}
			$feed['image'] =& $image;
		}
		$feed['channel'] =& $channel;
	}

	function getSticky(&$feed){
		if( !$intr =& $this->mHandler->getObjects(new Criteria('misc_category', 'sticky')) ){
			return false;
		}
		$sticky =& $intr[0];
		unset($intr);
		$setting = $sticky->getVar('misc_setting');
		if( in_array(0, $setting['feeds']) || $sticky->getVar('misc_title') == '' || $sticky->getVar('misc_content') == '' ){
			return false;
		}
		if( ( in_array(-1, $setting['feeds']) && empty($feed['plugin']) ) ||
			( !empty($feed['plugin']) && in_array($this->plugin_obj->getVar('rssf_conf_id'), $setting['feeds']) )
		){
			$feed['sticky']['title'] = $sticky->getVar('misc_title', 'n');
			$feed['sticky']['link'] = $setting['link'];
			$sticky->setDoHtml($setting['dohtml']);
			$sticky->setDoBr($setting['dobr']);
			$feed['sticky']['description'] = $sticky->getVar('misc_content');
			$this->cleanupChars($feed['sticky']['title']);
			$this->cleanupChars($feed['sticky']['link']);
			$this->cleanupChars($feed['sticky']['description'], $setting['dohtml'] ? 0 : 1, false);
			$this->wrapCdata($feed['sticky']['description']);
			$feed['sticky']['pubdate'] = $this->rssTimeStamp(time());
		}
		return true;
	}

	function getItems(&$feed){
		$entries = array();
		if( !empty($feed['plugin']) ){
			$this->plugin_obj->setVar('rssf_grab', $this->plugin_obj->getVar('sub_entries'));
			$this->sub_handler->grab = $this->plugin_obj->getVar('sub_entries');
			$grab =& $this->sub_handler->grabEntries($this->plugin_obj);
			if( false != $grab && count($grab) > 0 ){
				foreach( $grab as $g ){
					array_push($entries, $g);
				}
			}
		}elseif( $plugins =& $this->pHandler->getObjects(new Criteria('rssf_activated', 1)) ){
			foreach( $plugins as $p ){
				if( $handler =& $this->pHandler->checkPlugin($p) ){
					$handler->grab = $p->getVar('rssf_grab');
					$grab =& $handler->grabEntries($p);
					if( false != $grab && count($grab) > 0 ){
						foreach( $grab as $g ){
							array_push($entries, $g);
						}
					}
				}
			}
		}
		if( count($entries) > 0 ){
			for( $i=0; $i<count($entries); $i++ ){
				$this->cleanupChars($entries[$i]['title']);
				$strip = $this->modConfig['strip_html'] ? 1 : 0;
				$this->cleanupChars($entries[$i]['description'], $strip, 0, 1);
				$this->wrapCdata($entries[$i]['description']);
				$entries[$i]['category'] = $this->myts->undoHtmlSpecialChars($entries[$i]['category']);
				$this->cleanupChars($entries[$i]['category']);
				if( !isset($entries[$i]['timestamp']) ){
					$entries[$i]['timestamp'] = $this->rssmod->getVar('last_update');
				}
				$entries[$i]['pubdate'] = $this->rssTimeStamp($entries[$i]['timestamp']);
			}
			if( empty($feed['plugin']) && $this->modConfig['sort'] == 'd' ){
				uasort($entries, 'sortTimestamp');
			}
			if( count($entries) > $this->modConfig['overall_entries'] && empty($feed['plugin']) ){
				$entries = array_slice($entries, 0, $this->modConfig['overall_entries']);
			}
		}
		$feed['items'] =& $entries;
	}

	function doSubstr($text){
		$ret = $text;
		$len = function_exists('mb_strlen') ? mb_strlen($ret, $this->charset) : strlen($ret);
		if( $len > $this->modConfig['max_char'] && $this->modConfig['max_char'] > 0 ){
			$ret = $this->substrDetect($ret, 0, $this->modConfig['max_char']-1);
			if( false == $this->strrposDetect($ret, ' ') ){
				if( false != $this->strrposDetect($text, ' ') ){
					$ret = $this->substrDetect($text, 0, strpos($text, ' '));
				}
			}
			if( in_array($this->substrDetect($text, $this->modConfig['max_char']-1, 1), $this->substr_add) ){
				$ret .= $this->substrDetect($text, $this->modConfig['max_char']-1, 1);
			}else{
				if( false != $this->strrposDetect($ret, ' ') ){
					$ret = $this->substrDetect($ret, 0, $this->strrposDetect($ret, ' '));
				}
				if( in_array($this->substrDetect($ret, -1, 1), $this->substr_remove) ){
					$ret = $this->substrDetect($ret, 0, -1);
				}
			}
			$ret .= $this->substr_endwith;
		}
		return $ret;
	}

	function substrDetect($text, $start, $len){
		if( function_exists('mb_strcut') ){
			return mb_strcut($text, $start, $len, _CHARSET);
		}
		return substr($text, $start, $len);
	}
	
	function strrposDetect($text, $find){
		if( function_exists('mb_strrpos') ){
			return mb_strrpos($text, $find, _CHARSET);
		}
		return strrpos($text, $find);
	}

	function rssTimeStamp($time){
		return date("D, j M Y H:i:s O", $time);
	}

	function sortTimestamp($a, $b){
		if( $a['timestamp'] == $b['timestamp'] ){
			return 0;
		}
		return ($a['timestamp'] > $b['timestamp']) ? -1 : 1;
	}

	function cleanupChars(&$text, $strip=true, $dospec=true, $dosub=false){
		if( $strip ){
			$text = strip_tags($text);
		}
		if( $dosub ){
			$text = $this->doSubstr($text);
		}
		if( $dospec ){
			$text = htmlspecialchars($text, ENT_QUOTES, $this->charset);
			$text = preg_replace('/&amp;(#[0-9]+);/i', '&$1;', $text);
		}
		if( !preg_match('/utf-8/i', $this->charset) || XOOPS_USE_MULTIBYTES != 1 ){
			$text = str_replace(array_map('chr', array_keys($this->escaped)), $this->escaped, $text);
		}
	}

	function wrapCdata(&$text){
		$text = '<![CDATA['.str_replace(array('<![CDATA[', ']]>'), array('&lt;![CDATA[', ']]&gt;'), $text).']]>';
	}

	function &getActivatedSubfeeds($fields='', $type=''){
		$ret = false;
		if( $subs =& $this->pHandler->getObjects(new Criteria('subfeed', 1), $fields) ){
			switch($type){
			default:
				$ret =& $subs;
			break;
			case 'list':
				foreach( $subs as $s ){
					$ret[$s->getVar('rssf_conf_id')] = $s->getVar('sub_title');
				}
			break;
			}
		}
		return $ret;
	}

	function feedSelectBox($caption='', $selected='', $size=1, $multi=true, $none=true, $main=true, $name='feeds', $type='id'){
		$select = new XoopsFormSelect($caption, $name, $selected, $size, $multi);
		if( $none ){
			$select->addOption(0, '-------');
		}
		if( $main ){
			$select->addOption('-1', _AM_MAINFEED);
		}
		if( $subs =& $this->getActivatedSubfeeds('sublist', 'list') ){
			foreach( $subs as $k=>$v ){
				$select->addOption($k, $v);
			}
		}
		return $select;
	}

	function specUrl($key=0){
		if( isset($this->specs[$key]) ){
			return $this->spec_url.'#'.$this->specs[$key];
		}
		return false;
	}
	
	function subFeedUrl($filename=''){
		if( !empty($filename) ){
			$filename = str_replace('rssfit.', '', $filename);
			$filename = str_replace('.php', '', $filename);
			return RSSFIT_URL_FEED.'?'.$this->feedkey.'='.$filename;
		}
		return false;
	}

	function checkSubFeed(&$feed){
		if( !empty($feed['plugin']) ){
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('rssf_filename', sprintf($this->plugin_file, $feed['plugin'])));
			$criteria->add(new Criteria('subfeed', 1));
			if( $sub =& $this->pHandler->getObjects($criteria) && $handler =& $this->pHandler->checkPlugin($sub[0]) ){
				$this->plugin_obj =& $sub[0];
				$this->sub_handler =& $handler;
				$this->cached = 'mod_'.$this->rssmod->getVar('dirname').'|'
					.md5(str_replace(XOOPS_URL, '', $GLOBALS['xoopsRequestUri']));
			}else{
				$feed['plugin'] = '';
			}
		}
	}
	
	function buildFeed(&$feed){
		$this->getChannel($feed);
		$this->getItems($feed);
		$this->getSticky($feed);
	}
	
}

?>