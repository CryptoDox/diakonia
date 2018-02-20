<?php
// $Id: modinfo.php 75 2005-09-06 21:52:55Z gron $
// Module Info      t.chinese by xoobs 

// The name of this module
define("_MI_WSPROJECT_NAME","wsProject");
// A brief description of this module
define("_MI_WSPROJECT_DESC","簡單易用的一個計劃與管理您專案的工具.");

// Names of admin menu items
define('_MI_WSPROJECT_ADMENU1','專案管理群組設定');


//Die Men�punkte
define("_MI_WSPROJECT_COMPLETEDPROJECTS",	"已完成專案");

define("_MI_WSPROJECT_ACTIVEPROJECTS","執行中專案");
define("_MI_WSPROJECT_MYTASKS",		"我的任務");
define("_MI_WSPROJECT_NEWPROJECT",	"規劃新專案");

//Blocks
define("_MI_WSPROJECT_PROJECTSTATUS",	"專案進度");
define("_MI_WSPROJECT_PROJECTOVERVIEW",	"專案概觀");


//Notifications
define ('_MI_WSPROJECT_GLOBAL_NOTIFY', '專案全域通知項目');
define ('_MI_WSPROJECT_GLOBAL_NOTIFYDSC', '在所有專案加入全域提醒通知項目.');

define ('_MI_WSPROJECT_PROJECT_NOTIFY', '專案通知項目');
define ('_MI_WSPROJECT_PROJECT_NOTIFYDSC', '在專案加入提醒通知項目.');

define ('_MI_WSPROJECT_TASK_NOTIFY', '任務通知項目');
define ('_MI_WSPROJECT_TASK_NOTIFYDSC', '在任務加入提醒通知項目.');

define ('_MI_WSPROJECT_NEWPROJECT_NOTIFY', '新專案發佈通知項目');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYCAP', '有新的專案發佈通知項目.');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYDSC', '有新的專案發佈時通知我.');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動提醒通知 : 有新的專案發佈');

define ('_MI_WSPROJECT_NEWTASK_NOTIFY', '新任務發佈通知項目');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYCAP', '有新的任務發佈通知項目.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYDSC', '有新的任務發佈指定給我時通知項目.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動提醒通知 : 有新的任務發佈');

define ('_MI_WSPROJECT_EDITTASK_NOTIFY', '任務編修通知項目');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYCAP', '有任務被編修通知項目.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYDSC', '當有任務被編修過時請通知我.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動提醒通知 : 有任務被編修');

?>