<?php
// $Id: modinfo.php,v 1.12 2003/04/02 04:44:23 mvandam Exp $
// Module Info

// The name of this module
define("_MI_NEWBBEX_NAME","ForumEx");

// A brief description of this module
define("_MI_NEWBBEX_DESC","Forums module for XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBBEX_BNAME1","最新主题");
define("_MI_NEWBBEX_BNAME2","最高人气主题");
define("_MI_NEWBBEX_BNAME3","最活跃主题");
define("_MI_NEWBBEX_BNAME4","最新私有主题");
define("_MI_NEWBBEX_BNAME5","没有回复的主题");
define("_MI_NEWBBEX_BNAME6","没有回复的私有主题");
define("_MI_NEWBBEX_BNAME7","没有回复的公开及私有主题");
define("_MI_NEWBBEX_BNAME8","论坛统计");
define("_MI_NEWBBEX_BNAME9","最新公开及私有主题");
define("_MI_NEWBBEX_BNAME10","月份统计");
define("_MI_NEWBBEX_BNAME11","访问过的公开及私有主题");

// Names of admin menu items
define("_MI_NEWBBEX_ADMENU1","新增论坛");
define("_MI_NEWBBEX_ADMENU2","编辑论坛");
define("_MI_NEWBBEX_ADMENU3","编辑私有论坛");
define("_MI_NEWBBEX_ADMENU4","同步论坛/主题");
define("_MI_NEWBBEX_ADMENU5","新增分类");
define("_MI_NEWBBEX_ADMENU6","编辑分类");
define("_MI_NEWBBEX_ADMENU7","删除分类");
define("_MI_NEWBBEX_ADMENU8","分类排序");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_NEWBBEX_THREAD_NOTIFY', '内容');
define ('_MI_NEWBBEX_THREAD_NOTIFYDSC', '通知选项适用于当前内容.');

define ('_MI_NEWBBEX_FORUM_NOTIFY', '论坛');
define ('_MI_NEWBBEX_FORUM_NOTIFYDSC', '通知选项适用于当前论坛.');

define ('_MI_NEWBBEX_GLOBAL_NOTIFY', '全局');
define ('_MI_NEWBBEX_GLOBAL_NOTIFYDSC', '全局论坛的通知选项.');

define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', '新贴');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', '通知选项适用于当前内容.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', '接收通知，当新贴发表时.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自动通知 : 新贴内容');

define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', '新内容');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', '论坛有新主题发表通知我.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', '接收通知，当论坛有新内容发表时.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自动通知 : 新内容发表');

define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', '新论坛');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', '新论坛创建时通知我.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', '接收通知，当新论坛创建时.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自动通知 : 新论坛');

define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', '新贴');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', '有新贴是通知我.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', '接收通知，当有新信息时.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自动通知 : 新贴');

define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', '新贴');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', '当前论坛有新贴时通知我.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', '接收通知，当前论坛有新贴时.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自动通知 : 论坛有新贴');

define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', '新贴 (全文本)');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', '有包括全文本新贴时通知我.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', '接收通知，当有全文本信息发表时.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自动通知 : 新贴 (全文本)');

define ('_MI_NEWBBEX_SMNAME1', '高级搜索');
define ('_MI_NEWBBEX_SHOWMSG', '是否显示私有主题 ?');
define ('_MI_NEWBBEX_SHOWMSGDESC', '如果设为否，私有论坛和主题将是不可见的');


// Added in version 1.5
define("_MI_NEWBBEX_ATTACH_FILES", "Mime类型 (附件或图片)");
define("_MI_NEWBBEX_ATTACH_HLP", "每行一种类型");

define('_MI_NEWBBEX_UPLSIZE', "文件大小控制 (KB) 1048576 = 1 Meg");
define('_MI_NEWBBEX_UPLSIZE_DSC', "单位:byte");

?>
