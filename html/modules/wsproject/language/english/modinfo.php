<?php
// $Id: modinfo.php 75 2005-09-06 21:52:55Z gron $
// Module Info

// The name of this module
define("_MI_WSPROJECT_NAME","wsProject");
// A brief description of this module
define("_MI_WSPROJECT_DESC","A tool to plan and administrate your projects.");

// Names of admin menu items
define('_MI_WSPROJECT_ADMENU1','Settings');


//Die Menüpunkte
define("_MI_WSPROJECT_COMPLETEDPROJECTS",	"Completed Projects");

define("_MI_WSPROJECT_ACTIVEPROJECTS","Active Projects");
define("_MI_WSPROJECT_MYTASKS",		"My Tasks");
define("_MI_WSPROJECT_NEWPROJECT",	"New Project");

//Blocks
define("_MI_WSPROJECT_PROJECTSTATUS",	"Project Status");
define("_MI_WSPROJECT_PROJECTOVERVIEW",	"Project Overview");


//Notifications
define ('_MI_WSPROJECT_GLOBAL_NOTIFY', 'Global');
define ('_MI_WSPROJECT_GLOBAL_NOTIFYDSC', 'Global notification options.');

define ('_MI_WSPROJECT_PROJECT_NOTIFY', 'Projects');
define ('_MI_WSPROJECT_PROJECT_NOTIFYDSC', 'Notification options for projects.');

define ('_MI_WSPROJECT_TASK_NOTIFY', 'Tasks');
define ('_MI_WSPROJECT_TASK_NOTIFYDSC', 'Notification options for tasks.');

define ('_MI_WSPROJECT_NEWPROJECT_NOTIFY', 'New Project');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYCAP', 'Notification on a new project');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYDSC', 'Notify me of new projects.');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New Project');

define ('_MI_WSPROJECT_NEWTASK_NOTIFY', 'New Task');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYCAP', 'Notification on a new task.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYDSC', 'Notify me of new tasks assigned to me.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New Task');

define ('_MI_WSPROJECT_EDITTASK_NOTIFY', 'Edit Task');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYCAP', 'Notification on changes at tasks.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYDSC', 'Notify me if a task is changed.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Edit Task');

?>