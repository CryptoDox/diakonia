<?php
// $Id: modinfo.php,v 1.12 2003/04/02 04:44:23 mvandam Exp $
// Module Info

// The name of this module
define("_MI_NEWBBEX_NAME","ForumEx");

// A brief description of this module
define("_MI_NEWBBEX_DESC","Forums module for XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBBEX_BNAME1","Recent Topics");
define("_MI_NEWBBEX_BNAME2","Most Viewed Topics");
define("_MI_NEWBBEX_BNAME3","Most Active Topics");
define("_MI_NEWBBEX_BNAME4","Recent Private Topics");
define("_MI_NEWBBEX_BNAME5","Topics without answer");
define("_MI_NEWBBEX_BNAME6","Private Topics without answer");
define("_MI_NEWBBEX_BNAME7","Private and public topics without answer");
define("_MI_NEWBBEX_BNAME8","Forums statistics");
define("_MI_NEWBBEX_BNAME9","Recent private and public Topics");
define("_MI_NEWBBEX_BNAME10","Monthly statistics");
define("_MI_NEWBBEX_BNAME11","Last public and private posts since your last visit");

// Names of admin menu items
define("_MI_NEWBBEX_ADMENU1","Add Forum");
define("_MI_NEWBBEX_ADMENU2","Edit Forum");
define("_MI_NEWBBEX_ADMENU3","Edit Priv. Forum");
define("_MI_NEWBBEX_ADMENU4","Sync forums/topics");
define("_MI_NEWBBEX_ADMENU5","Add Category");
define("_MI_NEWBBEX_ADMENU6","Edit Category");
define("_MI_NEWBBEX_ADMENU7","Delete Category");
define("_MI_NEWBBEX_ADMENU8","Re-order Category");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_NEWBBEX_THREAD_NOTIFY', 'Thread');
define ('_MI_NEWBBEX_THREAD_NOTIFYDSC', 'Notification options that apply to the current thread.');

define ('_MI_NEWBBEX_FORUM_NOTIFY', 'Forum');
define ('_MI_NEWBBEX_FORUM_NOTIFYDSC', 'Notification options that apply to the current forum.');

define ('_MI_NEWBBEX_GLOBAL_NOTIFY', 'Global');
define ('_MI_NEWBBEX_GLOBAL_NOTIFYDSC', 'Global forum notification options.');

define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', 'New Post');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', 'Notify me of new posts in the current thread.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', 'Receive notification when a new message is posted to the current thread.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post in thread');

define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', 'New Thread');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', 'Notify me of new topics in the current forum.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', 'Receive notification when a new thread is started in the current forum.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New thread in forum');

define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', 'New Forum');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', 'Notify me when a new forum is created.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', 'Receive notification when a new forum is created.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New forum');

define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', 'New Post');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', 'Notify me of any new posts.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', 'Receive notification when any new message is posted.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post');

define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', 'New Post');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', 'Notify me of any new posts in the current forum.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', 'Receive notification when any new message is posted in the current forum.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post in forum');

define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', 'New Post (Full Text)');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Notify me of any new posts (include full text in message).');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Receive full text notification when any new message is posted.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New post (full text)');

define ('_MI_NEWBBEX_SMNAME1', 'Advance Search');
define ('_MI_NEWBBEX_SHOWMSG', 'Show private titles and forums ?');
define ('_MI_NEWBBEX_SHOWMSGDESC', 'When set to no, users can\'t see forums and posts they don\'t have access to');

// Added in version 1.5
define("_MI_NEWBBEX_ATTACH_FILES", "Mime Types (to attach files or pictures)");
define("_MI_NEWBBEX_ATTACH_HLP", "Type one mime type per line");

define('_MI_NEWBBEX_UPLSIZE', "MAX Filesize Upload (KB) 1048576 = 1 Meg");
define('_MI_NEWBBEX_UPLSIZE_DSC', "in bytes");

define('_MI_NEWBBEX_EDITOR_TO_USE', "Editor to use");
?>