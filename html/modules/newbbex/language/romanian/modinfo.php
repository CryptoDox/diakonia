<?php
// $Id: modinfo.php,v 1.12 2003/04/02 04:44:23 mvandam Exp $
// Module Info

// The name of this module
define("_MI_NEWBBEX_NAME","ForumEx");

// A brief description of this module
define("_MI_NEWBBEX_DESC","Modul de Forum pentru XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBBEX_BNAME1","Topicuri Recente");
define("_MI_NEWBBEX_BNAME2","Cele mai Vizitate Topicuri");
define("_MI_NEWBBEX_BNAME3","Cele mai Active Topicuri");
define("_MI_NEWBBEX_BNAME4","Topicuri Private Recente");
define("_MI_NEWBBEX_BNAME5","Topicuri fara raspuns");
define("_MI_NEWBBEX_BNAME6","Topicuri Private fara raspuns");
define("_MI_NEWBBEX_BNAME7","Topicuri Private si Publice fara raspuns");
define("_MI_NEWBBEX_BNAME8","Statistica Forumuri");
define("_MI_NEWBBEX_BNAME9","Topicuri Private si Publice");

// Names of admin menu items
define("_MI_NEWBBEX_ADMENU1","Adauga Forum");
define("_MI_NEWBBEX_ADMENU2","Editeaza Forum");
define("_MI_NEWBBEX_ADMENU3","Editeaza Forum Priv.");
define("_MI_NEWBBEX_ADMENU4","Sincronizeaza forumuri/topicuri");
define("_MI_NEWBBEX_ADMENU5","Adauga Categorie");
define("_MI_NEWBBEX_ADMENU6","Editeaza Categorie");
define("_MI_NEWBBEX_ADMENU7","Sterge Categorie");
define("_MI_NEWBBEX_ADMENU8","Reordoneaza Categorie");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_NEWBBEX_THREAD_NOTIFY', 'Thread');
define ('_MI_NEWBBEX_THREAD_NOTIFYDSC', 'Optiuni de Notificare ce se aplica legaturii curente.');

define ('_MI_NEWBBEX_FORUM_NOTIFY', 'Forum');
define ('_MI_NEWBBEX_FORUM_NOTIFYDSC', 'Optiuni de Notificare ce se aplica forumului curent.');

define ('_MI_NEWBBEX_GLOBAL_NOTIFY', 'Global');
define ('_MI_NEWBBEX_GLOBAL_NOTIFYDSC', 'Optiuni de Notificare Globala.');

define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', 'Postare Noua');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', 'Primesc notificare la notificari noi in acest thread.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', 'Primeste notificari cand un mesaj nou este postat in acest thread.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Postare noua in thread');

define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', 'Thread Nou');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', 'Primesc notificare la crearea de topicuri noi in forumul curent.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', 'Primeste notificari cand este creat un topic nou in forumul curent.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Thread nou in forum');

define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', 'Forum Nou');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', 'Primesc notificare cand este creat un forum nou.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', 'Primeste notificari cand este creat un forum nou.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Forum nou');

define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', 'Postare Noua');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', 'Primesc notificare la orice postare noua.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', 'Primeste notificare la fiecare mesaj nou postat.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Postare Noua');

define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', 'Postare Noua');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', 'Primesc notificare la orice postare noua in forumul curent.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', 'Primeste notificare la orice postare de mesaj nou in forumul curent.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Postare noua in forum');

define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', 'Postare Noua (Text Complet)');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Primesc notificare la orice postare noua (include text complet in mesaj.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Primeste notificare cu text complet inclus la fiecare postare noua.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Postare noua (text complet)');

define ('_MI_NEWBBEX_SMNAME1', 'Cautare Avansata');
define ('_MI_NEWBBEX_SHOWMSG', 'Afiseaza forumuri si titluri private ?');
define ('_MI_NEWBBEX_SHOWMSGDESC', 'Cand este setat la nu, utilizatorii nu pot vedea forumuri si postari la care nu au acces');

// Added in version 1.5
define("_MI_NEWBBEX_ATTACH_FILES", "Mime Types (to attach files or pictures)");
define("_MI_NEWBBEX_ATTACH_HLP", "Type one mime type per line");

define('_MI_NEWBBEX_UPLSIZE', "MAX Filesize Upload (KB) 1048576 = 1 Meg");
define('_MI_NEWBBEX_UPLSIZE_DSC', "in bytes");
?>