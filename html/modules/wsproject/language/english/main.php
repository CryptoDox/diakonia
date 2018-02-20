<?php
// $Id: main.php 75 2005-09-06 21:52:55Z gron $

//include shared constants
include_once(XOOPS_ROOT_PATH."/modules/wsproject/language/english/shared.php");


define("_WS_USERDETAILS","");

define("_WS_NOTE",			"Notice");

define("_WS_COMPLETEPROJECT","Complete Project");

define("_WS_SUBTASKS", "Subtasks");

define("_WS_REACTIVATE",	"Reactivate");
define("_WS_COMPLETED2",	"Completed");
define("_WS_RESTORE",		"Restore");
define("_WS_UPDATETASK",	"Update Task");
define("_WS_UPDATEPROJECT",	"Update Project");
define("_WS_DELPROJECT1",	"Are you sure you want to delete the");
define("_WS_DELPROJECT2",	"project");
define("_WS_DELWARNING",	"ALL TASKS AND ASSOCIATED INFO WILL BE DELETED");

define("_WS_TOPLEVEL", "TOP LEVEL (none)");
define("_WS_SUBTASKOF", "Subtask of");
define("_WS_PUBLIC", "Public");
define("_WS_QUOTEDHOURS", "Quoted Hours");
define("_WS_NOTIFYUSER", "notify user");
define("_WS_ASSIGNEDTO", "Assigned To");
define("_WS_TASKNAME", "Task Name");
define("_WS_SHOWPROJECT", "Show Project");
define("_WS_ADDPROJECT", "Add Project");
define("_WS_COMMENTS", "Comments");
define("_WS_STARTDATE", "Start Date");
define("_WS_PROJECTNAME",	"Project Name");

define("_WS_PROJECTOVERVIEW", "Project overview");

define("_WS_WARNING", "Warning");
define("_WS_CHILDWARNING", "This task contains child tasks. Deleting it will delete all children as well!");
define("_WS_DELTASK",	"Are you sure you want to delete the task");

define("_WS_PLEASEADDGROUP","Please, add a group of user. (edit project)");

//admin
define("_WS_PROJECTADMIN",	"wsProject Administration");
define("_WS_CONFIG",		"Settings");
define("_WS_USEDGROUPS",	"Used groups");
define("_WS_APPLY",			"Apply");

define("_WS_PROJECTUSER",	"Standard User");
define("_WS_PROJECTUSERNOTE","Task may by assigned to this user and the user can change the status infos of this tasks.");
define("_WS_PROJECTADMIN2",	"Administrators");
define("_WS_PROJECTADMINNOTE","User with the right to modify all tasks.");
define("_WS_ADMINGROUPS",	"Administrator groups<br />This users can<br /> modify every task and project.");
?>