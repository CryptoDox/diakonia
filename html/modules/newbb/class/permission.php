<?php
// $Id: permission.php,v 1.3 2005/10/19 17:20:32 phppp Exp $
// ------------------------------------------------------------------------ //
// XOOPS - PHP Content Management System                      //
// Copyright (c) 2000 XOOPS.org                           //
// <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// //
// You may not change or alter any portion of this comment or credits       //
// of supporting developers from this source code or any supporting         //
// source code which is considered copyrighted (c) material of the          //
// original comment or credit authors.                                      //
// //
// This program is distributed in the hope that it will be useful,          //
// but WITHOUT ANY WARRANTY; without even the implied warranty of           //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
// GNU General Public License for more details.                             //
// //
// You should have received a copy of the GNU General Public License        //
// along with this program; if not, write to the Free Software              //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------ //
// Author: phppp (D.J., infomax@gmail.com)                                  //
// URL: http://xoopsforge.com, http://xoops.org.cn                          //
// Project: Article Project                                                 //
// ------------------------------------------------------------------------ //
if (!defined('FORUM_PERM_ITEMS')) define('FORUM_PERM_ITEMS', 'access,view,post,reply,edit,delete,addpoll,vote,attach,noapprove');
 
if (!defined("XOOPS_ROOT_PATH")) {
	exit();
}

require_once XOOPS_ROOT_PATH."/kernel/groupperm.php";

class NewbbPermissionHandler extends XoopsGroupPermHandler 
{
    /*
	* Returns permissions for a certain type
	*
	* @param string $type "category", "forum"
	* @param int $id id of the item (forum, topic or possibly post) to get permissions for
	*
	* @return array
	*/
    function getPermissions($type = "forum", $id = 0)
    {
        global $xoopsUser;
        static $permissions = array(), $suspension = array();

        $type = (strtolower($type) !="category")?"forum":"category";
        
	    if(is_object($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]->getVar("dirname")=="newbb"){
        	$modid = $GLOBALS["xoopsModule"]->getVar("mid");
	    }else{
    		$module_handler =& xoops_gethandler('module');
			$xoopsNewBB =& $module_handler->getByDirname('newbb');
			$modid = $xoopsNewBB->getVar("mid");
			unset($xoopsNewBB);
	    }
        
	    $uid = is_object($GLOBALS["xoopsUser"])?$GLOBALS["xoopsUser"]->getVar("uid"):0;
		$ip = newbb_getIP(true);
		if (($type == "forum") && !newbb_isAdmin($id) && !isset($suspension[$uid][$id]) && !empty($GLOBALS["xoopsModuleConfig"]['enable_usermoderate'])){
			$moderate_handler =& xoops_getmodulehandler('moderate', 'newbb');
			if($moderate_handler->verifyUser($uid,"",$id)){
				$suspension[$uid][$ip][$id] = 1;
			}else{
				$suspension[$uid][$ip][$id] = 0;
			}
		}

        if (!isset($permissions[$type]) || ($id && !isset($permissions[$type][$id]))) {
            // Get group permissions handler
            $gperm_handler =& xoops_gethandler('groupperm');
            // Get user's groups
            $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
            // Create string of groupid's separated by commas, inserted in a set of brackets
            if (count($groups) < 1) return false;
            $groupstring = "(" . implode(',', $groups) . ")";
            // Create criteria for getting only the permissions regarding this module and this user's groups
            $criteria = new CriteriaCompo(new Criteria('gperm_modid', $modid));
            $criteria->add(new Criteria('gperm_groupid', $groupstring, 'IN'));
            if ($id) {
                if (is_array($id)) {
                    $counter = 0;
                    $idstring = "(" . implode(',', $id) . ")";
                    $criteria->add(new Criteria('gperm_itemid', $idstring, 'IN'));
                } else {
                    $criteria->add(new Criteria('gperm_itemid', intval($id)));
                }
            }

            switch ($type) {
                case "forum":
                    $items = array_map("trim",explode(',', FORUM_PERM_ITEMS));

                    $full_items = array();
                    foreach($items as $item) {
	                    /* skip access for suspended users */
						if( !empty($suspension[$uid][$ip][$id]) && in_array($item,array("post", "reply", "edit", "delete", "addpoll", "vote", "attach", "noapprove")) ) continue;
                        $full_items[] = "'forum_" . $item . "'";
                    }
                    $gperm_names = implode(',', $full_items);
                    break;

                case "category":
                    $gperm_names = "'category_access'";
                    break;
            }
            // Add criteria for gpermnames
            $criteria->add(new Criteria('gperm_name', "(" . $gperm_names . ")", 'IN'));
            // Get all permission objects in this module and for this user's groups
            $userpermissions =& $gperm_handler->getObjects($criteria, true);
                        
            // Set the granted permissions to 1
            foreach ($userpermissions as $gperm_id => $gperm) {
                $permissions[$type][$gperm->getVar('gperm_itemid')][$gperm->getVar('gperm_name')] = 1;
            }
            unset($userpermissions);
        }
        // Return the permission array
        return isset($permissions[$type]) ? $permissions[$type] : array();
    }

    function &permission_table($permission_set, $forum = 0, $topic_locked = false, $isadmin = false)
    {
        global $xoopsUser;
        $perm = array();

        if (is_object($forum)) $forumid = $forum->getVar('forum_id');
        else $forumid = $forum;

        $perm_items = explode(',', FORUM_PERM_ITEMS);
        foreach($perm_items as $item) {
	        if($item=="access") continue;
            if ($isadmin ||
                (isset($permission_set[$forumid]['forum_' . $item]) && (!$topic_locked || $item=="view"))
                    ) {
                $perm[] = constant('_MD_CAN_' . strtoupper($item));
            } else {
                $perm[] = constant('_MD_CANNOT_' . strtoupper($item));
            }
        }

        return $perm;
    }
    
    function deleteByForum($forum)
    {
        $gperm_handler = &xoops_gethandler('groupperm');
        $criteria = new CriteriaCompo(new Criteria('gperm_modid', $GLOBALS["xoopsModule"]->getVar('mid')));
        $criteria->add(new Criteria('gperm_name', '('.FORUM_PERM_ITEMS.')', 'IN'));
        $criteria->add(new Criteria('gperm_itemid', $forum));
        return $gperm_handler->deleteAll($criteria);
    }
    
    function deleteByCategory($category)
    {
        $gperm_handler = &xoops_gethandler('groupperm');
        $criteria = new CriteriaCompo(new Criteria('gperm_modid', $GLOBALS["xoopsModule"]->getVar('mid')));
        $criteria->add(new Criteria('gperm_name', 'category_access'));
        $criteria->add(new Criteria('gperm_itemid', $category));
        return $gperm_handler->deleteAll($criteria);
    }

    function setCategoryPermission($category, $groups=null)
    {
	    if(is_object($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]->getVar("dirname")=="newbb"){
		    $mid = $GLOBALS["xoopsModule"]->getVar("mid");
	    }else{
    		$module_handler =& xoops_gethandler('module');
			$newbb =& $module_handler->getByDirname('newbb');
			$mid = $newbb->getVar("mid");
	    }
		//$groupperm_handler =& xoops_gethandler('groupperm');
		if(!is_array($groups)){
		    $member_handler =& xoops_gethandler('member');
		    $glist =& $member_handler->getGroupList();
		    $groups = array_keys($glist);
	    }
		$ids = $this->getGroupIds("category_access", $category, $mid);
	    $ids_add = array_diff($groups, $ids);
	    $ids_rmv = array_diff($ids, $groups);
		foreach($ids_add as $group){
			$this->addRight("category_access", $category, $group, $mid);
		}
		foreach($ids_rmv as $group){
			$this->deleteRight("category_access", $category, $group, $mid);
		}
		
        return true;
    }
    
    function validateRight($perm, $itemid, $groupid, $mid = null)
    {
	    if(empty($mid)){
		    if(is_object($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]->getVar("dirname")=="newbb"){
			    $mid = $GLOBALS["xoopsModule"]->getVar("mid");
		    }else{
    			$module_handler =& xoops_gethandler('module');
				$newbb =& $module_handler->getByDirname('newbb');
				$mid = $newbb->getVar("mid");
				unset($newbb);
		    }
	    }
		if($this->_checkRight($perm, $itemid, $groupid, $mid)) return true;
		$this->addRight($perm, $itemid, $groupid, $mid);
		return true;
    }

    /**
     * Check permission (directly)
     * 
     * @param	string    $gperm_name       Name of permission
     * @param	int       $gperm_itemid     ID of an item
     * @param	int/array $gperm_groupid    A group ID or an array of group IDs
     * @param	int       $gperm_modid      ID of a module
     * 
     * @return	bool    TRUE if permission is enabled
     */
    function _checkRight($gperm_name, $gperm_itemid, $gperm_groupid, $gperm_modid = 1)
    {
        $criteria = new CriteriaCompo(new Criteria('gperm_modid', $gperm_modid));
        $criteria->add(new Criteria('gperm_name', $gperm_name));
        $gperm_itemid = intval($gperm_itemid);
        if ($gperm_itemid > 0) {
            $criteria->add(new Criteria('gperm_itemid', $gperm_itemid));
        }
        if (is_array($gperm_groupid)) {
            $criteria2 = new CriteriaCompo();
            foreach ($gperm_groupid as $gid) {
                $criteria2->add(new Criteria('gperm_groupid', $gid), 'OR');
            }
            $criteria->add($criteria2);
        } else {
            $criteria->add(new Criteria('gperm_groupid', $gperm_groupid));
        }
        if ($this->getCount($criteria) > 0) {
            return true;
        }
        return false;
    }
    
    function deleteRight($perm, $itemid, $groupid, $mid = null)
    {
	    if(empty($mid)){
		    if(is_object($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]->getVar("dirname")=="newbb"){
			    $mid = $GLOBALS["xoopsModule"]->getVar("mid");
		    }else{
    			$module_handler =& xoops_gethandler('module');
				$newbb =& $module_handler->getByDirname('newbb');
				$mid = $newbb->getVar("mid");
				unset($newbb);
		    }
	    }
		if(is_callable(array(&$this->XoopsGroupPermHandler, "deleteRight"))){
			return $this->deleteRight($perm, $itemid, $groupid, $mid);
		}else{
	        $criteria = new CriteriaCompo(new Criteria('gperm_name', $perm));
	        $criteria->add(new Criteria('gperm_groupid', $groupid));
	        $criteria->add(new Criteria('gperm_itemid', $itemid));
	        $criteria->add(new Criteria('gperm_modid', $mid));
	        $perms_obj = $this->getObjects($criteria);
	        if (!empty($perms_obj)) {
		        foreach($perms_obj as $perm_obj){
	            	$this->delete($perm_obj);
		        }
	        }
	        unset($criteria, $perms_obj);
		}
		return true;
    }
        
    function applyTemplate($forum, $mid=null)
    {
	    $perm_template = $this->getTemplate();
	    if(empty($perm_template)) return false;
	    
	    if(empty($mid)){
		    if(is_object($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]->getVar("dirname")=="newbb"){
			    $mid = $GLOBALS["xoopsModule"]->getVar("mid");
		    }else{
    			$module_handler =& xoops_gethandler('module');
				$newbb =& $module_handler->getByDirname('newbb');
				$mid = $newbb->getVar("mid");
				unset($newbb);
		    }
	    }
	    
		//$groupperm_handler =& xoops_gethandler('groupperm');
	    $member_handler =& xoops_gethandler('member');
	    $glist =& $member_handler->getGroupList();
		$perms = array_map("trim",explode(',', FORUM_PERM_ITEMS));
		foreach(array_keys($glist) as $group){
		    foreach($perms as $perm){
			    $perm = "forum_".$perm;
				if(!empty($perm_template[$group][$perm])){
					$this->validateRight($perm, $forum, $group, $mid);
				}else{
					$this->deleteRight($perm, $forum, $group, $mid);
				}
		    }
		}
	    return true;
    }
    
    function &getTemplate()
    {
		$perms = mod_loadCacheFile("perm_template", "newbb");
		return $perms;
    }
    
    function setTemplate($perms)
    {
		return mod_createCacheFile($perms, "perm_template", "newbb");
    }
}

?>
