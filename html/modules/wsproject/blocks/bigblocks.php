<?php
// $Id: bigblocks.php 75 2005-09-06 21:52:55Z gron $
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

include_once(XOOPS_ROOT_PATH."/modules/wsproject/class/functions.php");

function b_wsproject_show_projectoverview($options){
	global $member_handler;
	if (isset($options[0]) and $options[0] != '') {
		$xoopsDB =& Database::getInstance();
		//init data variable
		$data = array();
		$tb_tasks = $xoopsDB->prefix("ws_tasks");
		$tb_projects = $xoopsDB->prefix("ws_projects");
		foreach ($options as $proj_id) {
			//Das ausgewählte Projekt holen
			$sql = "SELECT project_id, name, startdate, enddate, completed, completed_date, description FROM ".$tb_projects." WHERE project_id=".$proj_id;
			$result = $xoopsDB->query($sql);
				
			$project = $xoopsDB->fetchArray($result);
			$project['done'] = 0; //initialiseren, falls eine spätere query keien daten zu dem projekt liefert
			$project['todo'] = 0;
			$data[$proj_id] = $project;		
			$xoopsDB->freeRecordSet($result);
			
			//get sum houres done
			$sql = "SELECT SUM(hours) AS done FROM ".$tb_tasks." WHERE status = 100 AND deleted = 0 AND project_id=".$proj_id;
			$result = $xoopsDB->query($sql);
			while ($done = $xoopsDB->fetchArray($result)) {
				$data[$proj_id]['done'] = (($done['done'] != "")?$done['done']:0);
			}		
			
			//get sum houres open
			$sql = "SELECT SUM(hours) AS todo FROM ".$tb_tasks." WHERE status < 100 AND deleted = 0 AND project_id=".$proj_id;
			$result = $xoopsDB->query($sql);
			while ($todo = $xoopsDB->fetchArray($result)) {
				$data[$proj_id]['todo'] = (($todo['todo'] != "")?$todo['todo']:0);
			}
			
			//calculate curent status and set info text's
			$data[$proj_id]['timedone'] = max(0, min(100, percentTimeComplete($data[$proj_id]['startdate'], $data[$proj_id]['enddate'])));
			$data[$proj_id]['workdone'] = percentComplete($data[$proj_id]['done'], $data[$proj_id]['todo']);
			
			if ($data[$proj_id]['workdone'] > $data[$proj_id]['timedone']) {
				$data[$proj_id]['timebar'] = createBar('green', $data[$proj_id]['timedone']);
			}
			elseif ($data[$proj_id]['timedone'] < 100) {
				$data[$proj_id]['timebar'] = createBar('yellow', $data[$proj_id]['timedone']);
			}
			else {
				$data[$proj_id]['timebar'] = createBar('red', $data[$proj_id]['timedone']);
			}
			
			$data[$proj_id]['progressbar'] = createBar('green', $data[$proj_id]['workdone']);
			
			if ($data[$proj_id]['timedone'] <= 0) {
				$data[$proj_id]['timeinfo'] = _WS_TASKPLANED;
			}
			elseif ($data[$proj_id]['timedone'] >= 100) {
				$data[$proj_id]['timeinfo'] = "<b>"._WS_OVERDUE."</b>";
			}
			else {
				$data[$proj_id]['timeinfo'] = $data[$proj_id]['timedone'] .'% '._WS_TIME;
			}
			
			if ($data[$proj_id]['workdone'] <= 0) {
				$data[$proj_id]['workinfo'] = _WS_NOTSTARTED;
			}
			elseif ($data[$proj_id]['workdone'] >= 100) {
				$data[$proj_id]['workinfo'] = "<b>"._WS_COMPLETED."</b>";
			}
			else {
				$data[$proj_id]['workinfo'] = $data[$proj_id]['workdone'].'% '._WS_COMPLETE;
			}
			
			
			//get all tasks
			$sql = "SELECT task_id, user_id, title, hours, status, public, parent_id, description FROM ".$tb_tasks." WHERE deleted = 0 AND public=1 AND project_id=".$proj_id. " ORDER BY title";
			$result = $xoopsDB->query($sql);
			while ($task = $xoopsDB->fetchArray($result)) {
				//hier nur setzen der Felder, da eventuell schon andere Info's gesetzt wurden, wenn bereits eine Unteraufgabe in der DB stand
				$data[$proj_id]['tasks'][$task['task_id']]['task_id']	= $task['task_id'];
				$data[$proj_id]['tasks'][$task['task_id']]['user_id']	= $task['user_id'];
				$data[$proj_id]['tasks'][$task['task_id']]['title']	= $task['title'];
				$data[$proj_id]['tasks'][$task['task_id']]['hours']	= $task['hours'];
				$data[$proj_id]['tasks'][$task['task_id']]['status']	= $task['status'];
				$data[$proj_id]['tasks'][$task['task_id']]['public']	= $task['public'];
				$data[$proj_id]['tasks'][$task['task_id']]['parent_id'] = $task['parent_id'];
				$data[$proj_id]['tasks'][$task['task_id']]['description'] = $task['description'];
	
				if (!isset($data[$proj_id]['tasks'][$task['task_id']]['somechildrendone'])) {
					$data[$proj_id]['tasks'][$task['task_id']]['somechildrendone'] = "false";
				}
						
				if (!isset($data[$proj_id]['tasks'][$task['task_id']]['children'])) {
					$data[$proj_id]['tasks'][$task['task_id']]['children'] = NULL;
					$data[$proj_id]['tasks'][$task['task_id']]['childrencompleted'] = "true";
				}
				if ($task['parent_id'] != "0") {
					$data[$proj_id]['tasks'][$task['parent_id']]['children'][] = &$data[$proj_id]['tasks'][$task['task_id']];
					
					//Wenn noch nicht gesetzt, schon mal setzen, wird korregiert, wenn der Datensatz kommt
					if (!isset($data[$proj_id]['tasks'][$task['parent_id']]['indent'])) {
						$data[$proj_id]['tasks'][$task['parent_id']]['indent'] = 0;
					}
					
					if ($task['status'] != "100") {
						$data[$proj_id]['tasks'][$task['parent_id']]['childrencompleted'] = "false";
					}
					elseif (!isset($data['tasks'][$task['parent_id']]['childrencompleted'])) {
						$data[$proj_id]['tasks'][$task['parent_id']]['childrencompleted'] = "true";
					}
					
					if ($task['status'] == "100") {
						$data[$proj_id]['tasks'][$task['parent_id']]['somechildrendone'] = "true";
						if ($task['parent_id'] != 0) {
							$t = $data[$proj_id]['tasks'][$task['parent_id']];
							while (isset($t['parent_id']) and ($t['parent_id'] != 0) and ($t['parent_id'] != NULL)) {
								$data[$proj_id]['tasks'][$t['parent_id']]['somechildrendone'] = "true";
								$t = $data[$proj_id]['tasks'][$t['parent_id']];
							}
						}
					}
					
					$data[$proj_id]['tasks'][$task['task_id']]['indent'] = $data[$proj_id]['tasks'][$task['parent_id']]['indent'] + 10;
					
					if ($data[$proj_id]['tasks'][$task['task_id']]['children'] != NULL) {
						_setCorrectIndent($data[$proj_id], $task['task_id']);
					}
				}
				else {
					$data[$proj_id]['tasks'][$task['task_id']]['indent'] = 0;
				}
				
				$user = $member_handler->getUser($task['user_id']);
				if ($user != NULL) {
					$data[$proj_id]['tasks'][$task['task_id']]['uname'] = $user->getVar('uname');
				}
			}
			
			sortTasksBySubTasks($data[$proj_id]);
		}
		$block['data'] = $data;
		
		$block['lang']['projectstart'] = _WS_PROJECTSTART;
		$block['lang']['projectdeadline'] = _WS_PROJECTDEADLINE;
		$block['lang']['todo'] = _WS_TODO;
		$block['lang']['respuser'] = _WS_RESP_USER;
		$block['lang']['hours'] = _WS_HOURS;
		$block['lang']['status'] = _WS_STATUS;
		$block['lang']['completedtasks'] = _WS_COMPLETEDTASKS;	
		$block['lang']['hourstodo'] = _WS_HOURSTODO;
		$block['lang']['hoursdone'] = _WS_HOURSDONE;
		$block['lang']['description'] = _WS_DESCRIPTION;

 		return $block;
	}
	else {
		return false;
	}
}

function b_wsproject_edit_projectoverview($options){
	$projects = getProjectsIdAndName();
	$form = _MB_WSPROJECT_SHOWEDPROJECT.": ";
	
	$form .= "<select name=\"options[]\" id=\"options[]\" size=\"5\" multiple=\"multiple\">";
	
	
	foreach ($projects as $project) {
		$form .= "<option value=\"".$project['project_id']."\" ".((in_array($project['project_id'],$options))?'selected="selected"':'').">".$project['name']."</option>";	
	}
	$form .= "</select>";
	
	return $form;
}
?>