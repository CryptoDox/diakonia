<?php
// $Id: smallblock.php 75 2005-09-06 21:52:55Z gron $
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

function b_wsproject_show_smallblock($options) {
	if ($options[0] == '') {
		$options[0] = 'random';
	}
	$xoopsDB =& Database::getInstance();
	
	if ($options[0] == 'random') {
		$sql = "SELECT project_id FROM ".$xoopsDB->prefix("ws_projects");
		$result = $xoopsDB->query($sql);
		$count = $xoopsDB->getRowsNum($result);
		$ran = rand(1, $count);
		$i = 0;
		while ($id = $xoopsDB->fetchArray($result)) {
			$i++;
			if ($i == $ran) {
				$project_id = $id['project_id'];
			}
		}
	}
	else {
	    $project_id = $options[0];
	}
		$sql = "SELECT name, startdate, enddate, description FROM ".$xoopsDB->prefix("ws_projects")." WHERE project_id=".$project_id;
		$result = $xoopsDB->query($sql);
		$project = $xoopsDB->fetchArray($result);

		//get sum houres done
		$sql = "SELECT SUM(hours) AS done FROM ".$xoopsDB->prefix("ws_tasks")." WHERE status = 100 AND deleted = 0 AND project_id=".$project_id;
		$result = $xoopsDB->query($sql);
		$done = $xoopsDB->fetchArray($result);
		$done = $done['done'];

		//get sum houres open
		$sql = "SELECT SUM(hours) AS todo FROM ".$xoopsDB->prefix("ws_tasks")." WHERE status < 100 AND deleted = 0 AND project_id=".$project_id;
		$result = $xoopsDB->query($sql);
		$todo = $xoopsDB->fetchArray($result);
		$todo = $todo['todo'];
			
		//calculate curent status and set info text's
		$project['timedone'] = max(0, min(100, percentTimeComplete($project['startdate'], $project['enddate'])));
		$project['workdone'] = percentComplete($done, $todo);
				
		if ($project['workdone'] > $project['timedone']) {
			$project['timebar'] = createMiniBar('green', $project['timedone']);
		}
		elseif ($project['timedone'] < 100) {
			$project['timebar'] = createMiniBar('yellow', $project['timedone']);
		}
		else {
			$project['timebar'] = createMiniBar('red', $project['timedone']);
		}
		
		$project['progressbar'] = createMiniBar('green', $project['workdone']);
		
		if ($project['timedone'] <= 0) {
			$project['timeinfo'] = _WS_TASKPLANED;
		}
		elseif ($project['timedone'] >= 100) {
			$project['timeinfo'] = "<b>"._WS_OVERDUE."</b>";
		}
		else {
			$project['timeinfo'] = $project['timedone'] .'% '._WS_TIME;
		}
		
		if ($project['workdone'] <= 0) {
			$project['workinfo'] = _WS_NOTSTARTED;
		}
		elseif ($project['workdone'] >= 100) {
			$project['workinfo'] = "<b>"._WS_COMPLETED."</b>";
		}
		else {
			$project['workinfo'] = $project['workdone'].'% '._WS_COMPLETE;
		}

		
		
       
         $project['title'] = _MB_WSPROJECT_SMALLBLOCKTITLE;			
    return $project;
}


function b_wsproject_edit_smallblock($options) {
	if ($options[0] == '') {
		$options[0] = 'random';
	}
	$projects = getProjectsIdAndName();
	
	$form = _MB_WSPROJECT_SHOWEDPROJECT.": ";
	
	$form .= "<select name=\"options[]\" id=\"options[]\">";
	$form .= "<option value=\"random\" ".(($options[0] == "random")?"selected=\"selected\"":'').">"._MB_WSPROJECT_RANDOM."</option>";
	foreach ($projects as $project) {
		$form .= "<option value=\"".$project['project_id']."\" ".(($options[0] == $project['project_id'])?'selected="selected"':'').">".$project['name']."</option>";	
	}
	$form .= "</select>";
	
	return $form;
}
?>