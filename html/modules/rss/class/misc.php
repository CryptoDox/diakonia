<?php
// $Id: misc.php 244 2006-07-20 08:41:42Z tuff $
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
class RssMisc extends XoopsObject{
	function RssMisc(){
		$this->XoopsObject();
	//	key, data_type, value, req, max, opt
		$this->initVar('misc_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('misc_category', XOBJ_DTYPE_TXTBOX, '', true, 15);
		$this->initVar('misc_title', XOBJ_DTYPE_TXTBOX, '', false, 255);
		$this->initVar('misc_content', XOBJ_DTYPE_TXTAREA, '', false);
		$this->initVar('misc_setting', XOBJ_DTYPE_ARRAY, '');
	}

	function setDoHtml($do=true){
		$this->vars['dohtml']['value'] = $do;
	}

	function setDoBr($do=true){
		$this->vars['dobr']['value'] = $do;
	}
}

class RssMiscHandler extends XoopsObjectHandler {
	var $db;
	var $db_table;
	var $obj_class = 'RssMisc';
	var $obj_key = 'misc_id';

	function RssMiscHandler(&$db){
		$this->db =& $db;
		$this->db_table = $this->db->prefix('rssfit_misc');
	}
	function &getInstance(&$db){
		static $instance;
		if( !isset($instance) ){
			$instance = new RssMiscHandler($db);
		}
		return $instance;
	}

	function &create(){
		$obj = new $this->obj_class();
		$obj->setNew();
		return $obj;
	}
	
	function &get($id, $fields='*'){
		$criteria = new Criteria($this->obj_key, intval($id));
		if( $objs =& $this->getObjects($criteria) ){
			return count($objs) != 1 ? false : $objs[0];
		}
		return false;
	}

	function getCount($criteria=null){
		$sql = 'SELECT COUNT(*) FROM '.$this->db_table;
		if( isset($criteria) && is_subclass_of($criteria, 'criteriaelement') ){
			$sql .= ' '.$criteria->renderWhere();
		}
		if( !$result =& $this->db->query($sql) ){
			return false;
		}
		list($count) = $this->db->fetchRow($result);
		return $count;
	}

	function &getObjects($criteria=null, $fields='*', $key=''){
		$ret = false;
		$limit = $start = 0;
		$sql = 'SELECT '.$fields.' FROM '.$this->db_table;
		if( isset($criteria) && is_subclass_of($criteria, 'criteriaelement') ){
			$sql .= ' '.$criteria->renderWhere();
			if( $criteria->getSort() != '' ){
				$sql .= ' ORDER BY '.$criteria->getSort().' '.$criteria->getOrder();
			}
			$limit = $criteria->getLimit();
			$start = $criteria->getStart();
		}
		if( !preg_match('/ORDER\ BY/', $sql) ){
			$sql .= ' ORDER BY '.$this->obj_key.' ASC';
		}
		$result = $this->db->query($sql, $limit, $start);
		if( !$result ){
			return false;
		}
		while( $myrow = $this->db->fetchArray($result) ){
			$obj = new $this->obj_class();
			$obj->assignVars($myrow);
			switch($key){
			default:
				$ret[] =& $obj;
			break;
			case 'title':
				$ret[$myrow['misc_title']] =& $obj;
			break;
			case 'id':
				$ret[$myrow[$this->obj_key]] =& $obj;
			break;
			}
			unset($obj);
		}
		return $ret;
	}

	function insert(&$obj, $force = false){
		if( strtolower(get_class($obj)) != strtolower($this->obj_class) ){
			return false;
		}
		if( !$obj->isDirty() ){
			return true;
		}
		if( !$obj->cleanVars() ){
			return false;
		}
		foreach( $obj->cleanVars as $k=>$v ){
			if( $obj->vars[$k]['data_type'] == XOBJ_DTYPE_INT ){
				$cleanvars[$k] = intval($v);
			}else{
				$cleanvars[$k] = $this->db->quoteString($v);
			}
		}
		if( count($obj->getErrors()) > 0 ){
			return false;
		}
		if( $obj->isNew() || empty($cleanvars[$this->obj_key]) ){
			$cleanvars[$this->obj_key] = $this->db->genId($this->db_table.'_'.$this->obj_key.'_seq');
			$sql = 'INSERT INTO '.$this->db_table.' ('.implode(',', array_keys($cleanvars)).') VALUES ('.implode(',', array_values($cleanvars)) .')';
		}else{
			unset($cleanvars[$this->obj_key]);
			$sql = 'UPDATE '.$this->db_table.' SET';
			foreach ($cleanvars as $k => $v ){
				$sql .= ' '.$k.'='.$v.',';
			}
			$sql = substr($sql, 0, -1);
			$sql .= ' WHERE '.$this->obj_key.' = '.$obj->getVar($this->obj_key);
		}
		if( false != $force ){
			$result = $this->db->queryF($sql);
		}else{
			$result = $this->db->query($sql);
		}
		if( !$result ){
			$obj->setErrors('Could not store data in the database.<br />'.$this->db->error().' ('.$this->db->errno().')<br />'.$sql);
			return false;
		}
		if( false == $obj->getVar($this->obj_key) ){
			$obj->assignVar($this->obj_key, $this->db->getInsertId());
		}
		return $obj->getVar($this->obj_key);
	}

	function modifyObjects($criteria=null, $fields=array(), $force=false){
		if( is_array($fields) && count($fields) > 0 ){
			$obj = new $this->obj_class();
			$sql = '';
			foreach( $fields as $k => $v ){
				$sql .= $k.' = ';
				$sql .= $obj->vars[$k]['data_type'] == 3 ? intval($v) : $this->db->quoteString($v);
				$sql .= ', ';
			}
			$sql = substr($sql, 0, -2);
			$sql = 'UPDATE '.$this->db_table.' SET '.$sql;
			if( isset($criteria) && is_subclass_of($criteria, 'criteriaelement') ){
				$sql .= ' '.$criteria->renderWhere();
			}
			if( false != $force ){
				$result = $this->db->queryF($sql);
			}else{
				$result = $this->db->query($sql);
			}
			if( !$result ){
				return 'Could not store data in the database.<br />'.$this->db->error().' ('.$this->db->errno().')<br />'.$sql;
			}
		}
		return false;
	}

	function delete(&$obj, $force=false){
		if( strtolower(get_class($obj)) != strtolower($this->obj_class) ){
			return false;
		}
		$sql = 'DELETE FROM '.$this->db_table.' WHERE '.$this->obj_key.'='.$obj->getVar($this->obj_key);
		if( false != $force ){
			$result = $this->db->queryF($sql);
		}else{
			$result = $this->db->query($sql);
		}
		if( !$result ){
			return false;
		}
		return true;
	}

}
?>