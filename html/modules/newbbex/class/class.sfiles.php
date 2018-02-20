<?php
// $Id: class.sfiles.php,v 1.10 2004/09/02 17:04:08 hthouzard Exp $
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
// ------------------------------------------------------------------------- //
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

include_once XOOPS_ROOT_PATH.'/modules/newbbex/class/class.mimetype.php';

class newbbex_sFiles {
	var $db;
	var $table;
	var $fileid;
	var $filerealname;
	var $post_id;
	var $date;
	var $mimetype;
	var $downloadname;
	var $counter;

    function newbbex_sFiles($fileid=-1)
    {
		$this->db =& Database::getInstance();
        $this->table = $this->db->prefix('bbex_files');
        $this->post_id = 0;
        $this->filerealname = '';
        $this->date = 0;
        $this->mimetype = '';
        $this->downloadname = 'downloadfile';
        $this->counter = 0;
        if(is_array($fileid)){
        	$this->makeFile($fileid);
        } elseif($fileid != -1) {
        	$this->getFile(intval($fileid));
        }
	}

	function createUploadName($folder,$filename, $trimname=false)
	{
		$workingfolder = $folder;
		if(xoops_substr($workingfolder,strlen($workingfolder)-1,1)<>'/') {
			$workingfolder.='/';
		}
		$ext = basename($filename);
		$ext = explode('.', $ext);
		$ext = '.'.$ext[count($ext)-1];
		$true = true;
		while($true) {
			$ipbits = explode(".", $_SERVER['REMOTE_ADDR']);
  			list($usec, $sec) = explode(" ",microtime());
			$usec = (integer) ($usec * 65536);
  			$sec = ((integer) $sec) & 0xFFFF;

  			if($trimname) {
  				$uid = sprintf("%06x%04x%04x",($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec);
  			} else {
  				$uid = sprintf("%08x-%04x-%04x",($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec);
  			}
         	if(!file_exists($workingfolder.$uid.$ext)) {
         		$true = false;
         	}
         }
  		return $uid.$ext;
	}

    function giveMimetype($filename='')
    {
		$cmimetype = new newbbex_cmimetype();
		$workingfile = $this->downloadname;
		if(xoops_trim($filename) !='' ) {
			$workingfile = $filename;
			return $cmimetype->getType($workingfile);
		} else {
			return '';
		}
    }

    function getAllbyPost($post_id)
    {
       $ret = array();
       $sql = 'SELECT * FROM '.$this->table.' WHERE post_id='.intval($post_id);
       $result = $this->db->query($sql);
       while( $myrow = $this->db->fetchArray($result)) {
			$ret[] = new newbbex_sFiles($myrow);
       }
       return $ret;
    }

    function getFile($id)
    {
       $sql = 'SELECT * FROM '.$this->table.' WHERE fileid='.intval($id);
       $array = $this->db->fetchArray($this->db->query($sql));
       $this->makeFile($array);
    }

    function makeFile($array)
    {
       foreach($array as $key=>$value) {
			$this->$key = $value;
       }
    }

    function store()
    {
       $myts =& MyTextSanitizer::getInstance();
       $fileRealName = $myts->addSlashes($this->filerealname);
       $downloadname = $myts->addSlashes($this->downloadname);
       $date = isset($this->date) ? intval($this->date) : time();
       $mimetype = $myts->addSlashes($this->mimetype);
       $counter = intval($this->counter);
       $post_id = intval($this->post_id);

       if(!isset($this->fileid)) {
			$newid = intval($this->db->genId($this->table.'_fileid_seq'));
            $sql = 'INSERT INTO '.$this->table." (fileid, post_id, filerealname, date, mimetype, downloadname, counter) "."VALUES (".$newid.",".$post_id.",'".$fileRealName."','".$date."','".$mimetype."','".$downloadname."',".$counter.")";
            $this->fileid=$newid;
       } else {
            $sql = 'UPDATE '.$this->table." SET post_id=".$post_id.",filerealname='".$fileRealName."',date=".$date.",mimetype='".$mimetype."',downloadname='".$downloadname."',counter=".$counter." WHERE fileid=".$this->getFileid();
       }
       if(!$result = $this->db->query($sql)) {
			return false;
       }
       return true;
    }

	function delete($workdir=XOOPS_UPLOAD_PATH)
    {
		$sql = 'DELETE FROM '.$this->table.' WHERE fileid='.$this->getFileid();
		if(!$result = $this->db->query($sql)) {
			return false;
		}
		if (file_exists($workdir.'/'.$this->downloadname)) {
			unlink($workdir.'/'.$this->downloadname);
		}
       	return true;
    }

    function deletePost($post_id, $workdir=XOOPS_UPLOAD_PATH)
    {
    	$sql = 'SELECT * FROM '.$this->table.' WHERE post_id='.intval($post_id);
		if(!$result = $this->db->query($sql)) {
			return false;
		}
		while( $myrow = $this->db->fetchArray($result)) {
			if (file_exists($workdir.'/'.$myrow['downloadname'])) {
				unlink($workdir.'/'.$myrow['downloadname']);
			}
		}
		$sql = 'DELETE FROM '.$this->table.' WHERE post_id='.intval($post_id);
		return $this->db->queryF($sql);
    }

    function updateCounter()
    {
		$sql = 'UPDATE '.$this->table.' SET counter=counter+1 WHERE fileid='.$this->getFileid();
		if(!$result = $this->db->queryF($sql)) {
			return false;
        }
        return true;
    }

	// ****************************************************************************************************************
	// All the Sets
	// ****************************************************************************************************************
    function setFileRealName($filename)
    {
		$this->filerealname=$filename;
    }

    function setPost_id($id)
    {
		$this->post_id = intval($id);
    }

    function setMimetype($value)
    {
		$this->mimetype = $value;
    }

    function setDownloadname($value)
    {
		$this->downloadname = $value;
    }

	// ****************************************************************************************************************
	// All the Gets
	// ****************************************************************************************************************
    function getFileid()
    {
		return intval($this->fileid);
    }

    function getPost_id()
    {
    	return intval($this->post_id);
    }

    function getCounter()
    {
    	return intval($this->counter);
    }

	function getDate()
	{
		return intval($this->date);
	}

    function getFileRealName($format='S')
    {
		$myts =& MyTextSanitizer::getInstance();
        switch($format)
        {
        	case 'S':
            case 'Show':
            	$filerealname=$myts->htmlSpecialChars($this->filerealname);
				break;
			case 'E':
        	case 'Edit':
                $filerealname=$myts->htmlSpecialChars($this->filerealname);
                break;
        	case 'P':
        	case 'Preview':
                $filerealname=$myts->htmlSpecialChars($myts->stripSlashesGPC($this->filerealname));
                break;
        	case 'F':
        	case 'InForm':
                $filerealname=$myts->htmlSpecialChars($myts->stripSlashesGPC($this->filerealname));
                break;
        }
        return $filerealname;
    }

    function getMimetype($format='S')
    {
       $myts =& MyTextSanitizer::getInstance();
       switch($format){
			case 'S':
            case 'Show':
                $filemimetype = $myts->htmlSpecialChars($this->mimetype);
                break;
            case 'E':
            case 'Edit':
                $filemimetype = $myts->htmlSpecialChars($this->mimetype);
                break;
            case 'P':
            case 'Preview':
                $filemimetype = $myts->htmlSpecialChars($myts->stripSlashesGPC($this->mimetype));
                break;
            case 'F':
            case 'InForm':
                $filemimetype = $myts->htmlSpecialChars($myts->stripSlashesGPC($this->mimetype));
                break;
       }
       return $filemimetype;
    }

    function getDownloadname($format='S')
    {
       $myts =& MyTextSanitizer::getInstance();
       switch($format){
			case 'S':
            case 'Show':
            	$filedownname = $myts->htmlSpecialChars($this->downloadname);
                break;
            case 'E':
            case 'Edit':
                $filedownname = $myts->htmlSpecialChars($this->downloadname);
                break;
            case 'P':
            case 'Preview':
                $filedownname = $myts->htmlSpecialChars($myts->stripSlashesGPC($this->downloadname));
                break;
            case 'F':
            case 'InForm':
                $filedownname = $myts->htmlSpecialChars($myts->stripSlashesGPC($this->downloadname));
                break;
       }
       return $filedownname;
    }

    // Deprecated
    function getCountbyPost($post_id)
    {
       $sql = 'SELECT count(fileid) as cnt FROM '.$this->table.' WHERE post_id='.intval($post_id);
       $result = $this->db->query($sql);
       $myrow = $this->db->fetchArray($result);
       return $myrow['cnt'];
    }


    function getCountbyPosts($post_ids)
    {
		$ret=array();
    	if(count($post_ids)>0) {
			$sql = 'SELECT post_id, count(fileid) as cnt FROM '.$this->table.' WHERE post_id IN (';
        	$sql .= implode(',', $post_ids).') GROUP BY post_id';
	       	$result = $this->db->query($sql);
	       	while( $myrow = $this->db->fetchArray($result)) {
	    		$ret[$myrow['post_id']]=$myrow['cnt'];
	       	}
       	}
       	return $ret;
    }
}
?>