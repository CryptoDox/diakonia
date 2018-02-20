<?php
// $Id: class.newstopic.php,v 1.5 2004/07/26 17:51:25 hthouzard Exp $
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
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
include_once XOOPS_ROOT_PATH."/class/xoopsstory.php";
include_once XOOPS_ROOT_PATH."/class/tree.php";

class AmsTopic extends XoopsTopic
{
    var $banner = "";
    var $banner_inherit;
    var $forum_id;
    var $weight = 1;

	function AmsTopic($table, $topicid=0)
	{
		$this->db =& Database::getInstance();
		$this->table = $table;
		if ( is_array($topicid) ) {
			$this->makeTopic($topicid);
		} elseif ( $topicid != 0 ) {
			$this->getTopic(intval($topicid));
		} else {
			$this->topic_id = $topicid;
		}
	}
	
	function getVar($var) {
	    return $this->$var;
	}

	function getAllTopicsCount()
	{
		$sql = "SELECT count(topic_id) as cpt FROM ".$this->table;
		$array = $this->db->fetchArray($this->db->query($sql));
		return($array['cpt']);
	}


	function getTopic($topicid)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE topic_id=".$topicid."";
		$array = $this->db->fetchArray($this->db->query($sql));
		$this->makeTopic($array);
	}

	function makeTopic($array)
	{
		foreach($array as $key=>$value){
			$this->$key = $value;
		}
	}

	function store()
	{
		$myts =& MyTextSanitizer::getInstance();
		$title = "";
		$imgurl = "";
		$insert=false;
		if ( isset($this->topic_title) && $this->topic_title != "" ) {
			$title = $myts->addSlashes($this->topic_title);
		}
		if ( isset($this->topic_imgurl) && $this->topic_imgurl != "" ) {
			$imgurl = $myts->addSlashes($this->topic_imgurl);
		}
		if ( !isset($this->topic_pid) || !is_numeric($this->topic_pid) ) {
			$this->topic_pid = 0;
		}
		if ( empty($this->topic_id) ) {
			$insert=true;
			$this->topic_id = $this->db->genId($this->table."_topic_id_seq");
			$sql = sprintf("INSERT INTO %s (topic_id, topic_pid, topic_imgurl, topic_title, banner, banner_inherit, forum_id, weight) VALUES (%u, %u, '%s', '%s', '%s', %u, %u, %u)", $this->table, $this->topic_id, $this->topic_pid, $imgurl, $title, $myts->addSlashes($this->banner), $this->banner_inherit, $this->forum_id, $this->weight);
		} else {
			$sql = sprintf("UPDATE %s SET topic_pid = %u, topic_imgurl = '%s', topic_title = '%s', banner='%s', banner_inherit=%u, forum_id=%u, weight=%u WHERE topic_id = %u", $this->table, $this->topic_pid, $imgurl, $title, $myts->addSlashes($this->banner), $this->banner_inherit, $this->forum_id, $this->weight, $this->topic_id);
		}
		if ( !$this->db->query($sql) ) {
			return false;
		}
		
		//Added in AMS 2.50 Final.  Fix bug permission not set at add topic
		//if ADD TOPIC
		if($insert) {
			$this->topic_id = $this->db->getInsertId();
		}		
		return true;
	}
	
	function getBanner() {
	    if ((!$this->banner_inherit && $this->banner != "") || (!$this->topic_pid())) {
	        return $this->banner;
	    }
	    
        $parent_topic = new AmsTopic($this->table, $this->topic_pid());
        return $parent_topic->getBanner();
	}
	
	function getAllTopics($checkRight = false, $permission = "ams_view") {
	    static $topics_arr = array();
	    $db =& Database::getInstance();
	    $table = $db->prefix('ams_topics');
	    if ((!isset($topics_arr['checked']) && false != $checkRight) || (!isset($topics_arr['unchecked']) && false == $checkRight)){
	        $sql = "SELECT * FROM ".$table;
	        if (false != $checkRight) {
	            global $xoopsUser, $xoopsModule;
	            if (!isset($xoopsModule) || $xoopsModule->getVar('dirname') != "AMS") {
	                $module_handler =& xoops_gethandler('module');
	                $newsModule =& $module_handler->getByDirname('AMS');
	            }
	            else {
	                $newsModule =& $xoopsModule;
	            }
                $groups = $xoopsUser ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
                $gperm_handler =& xoops_gethandler('groupperm');
                $topics = $gperm_handler->getItemIds($permission, $groups, $newsModule->getVar('mid'));
                if (count($topics) == 0) {
                    return array();
                }
                $topics = implode(',', $topics);
                $sql .= " WHERE topic_id IN (".$topics.")";
	        }
	        $sql .= " ORDER BY weight";
	        $result = $db->query($sql);
	        while ($array = $db->fetchArray($result)) {
	            $topic = new AmsTopic($table);
	            $topic->makeTopic($array);
	            if ($checkRight) {
	                $topics_arr['checked'][$array['topic_id']] = $topic;
	            }
	            else {
	                $topics_arr['unchecked'][$array['topic_id']] = $topic;
	            }
	            unset($topic);
	        }
	    }
		return $checkRight ? (isset($topics_arr['checked']) ? $topics_arr['checked'] : array() ) : (isset($topics_arr['unchecked']) ? $topics_arr['unchecked'] : array() );
	}
	
	function getAllAuthors($byName = false) {
	    static $authors = array();
	    $db =& Database::getInstance();
	    if (count($authors) == 0) {
	        $sql = "SELECT DISTINCT u.uid, u.uname, u.name FROM ".$db->prefix('users')." u, ".$db->prefix('ams_text')." t
	            WHERE u.uid = t.uid";
	        if (false != $byName) {
	            $sql .= " ORDER BY uname ASC";
	        }
	        $result = $db->query($sql);
	        while ($array = $db->fetchArray($result)) {
	            if (false != $byName) {
	                $authors[] = $array;
	            }
	            else {
	                $authors[$array['uid']] = $array;
	            }
	        }
	    }
	    return $authors;
	}
	
	function getTopicPath($withAllLink = false,$separation=" > ",$addIndex=true)
	{
        $filename = "index.php";
		If ($withAllLink) {
			$ret = "<a href='" . XOOPS_URL . "/modules/AMS/".$filename."?storytopic=" . $this->topic_id() . "'>" . $this->topic_title() . "</a>";	
		} else {
			$ret = $this->topic_title();
		}
		$parentid = $this->topic_pid();
		if ($parentid > 0) {
			$this->getTopic($parentid);
			$parentid = $this->topic_pid();
			$ret = $this->getTopicPath($withAllLink,$separation,$addIndex) . $separation .$ret;
		}
		else {
            if($addIndex)
            {
		        $ret = "<a href='".XOOPS_URL."/modules/AMS/".$filename."'>".$GLOBALS['xoopsModuleConfig']['index_name']."</a>". $separation .$ret;
            }
		}
		return $ret;
	}
	    
}
?>