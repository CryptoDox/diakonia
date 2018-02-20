<?php
// $Id: modinfo.php,v 1.12 2003/04/02 04:44:23 mvandam Exp $
// Support Francophone de Xoops (www.frxoops.org)
// Module Info

// The name of this module
define("_MI_NEWBBEX_NAME","ForumEx");

// A brief description of this module
define("_MI_NEWBBEX_DESC","Module Forums pour XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBBEX_BNAME1","Sujets r&eacute;cents");
define("_MI_NEWBBEX_BNAME2","Sujets les plus vus");
define("_MI_NEWBBEX_BNAME3","Sujets les plus actifs");
define("_MI_NEWBBEX_BNAME4","Sujets priv&eacute;s r&eacute;cents");
define("_MI_NEWBBEX_BNAME5","Sujets sans r&eacute;ponse");
define("_MI_NEWBBEX_BNAME6","Sujets priv&eacute;s sans r&eacute;ponse");
define("_MI_NEWBBEX_BNAME7","Sujets priv&eacute;s et publiques sans r&eacute;ponse");
define("_MI_NEWBBEX_BNAME8","Statistiques des forums");
define("_MI_NEWBBEX_BNAME9","Sujets priv&eacute;s et publiques r&eacute;cents");
define("_MI_NEWBBEX_BNAME10","Statistiques mensuelles");
define("_MI_NEWBBEX_BNAME11","Derniers sujets publiques et priv&eacute;s depuis votre derni&egrave;re visite");

// Names of admin menu items
define("_MI_NEWBBEX_ADMENU1","Ajouter un forum");
define("_MI_NEWBBEX_ADMENU2","Editer un forum");
define("_MI_NEWBBEX_ADMENU3","Editer un forum priv&eacute;");
define("_MI_NEWBBEX_ADMENU4","Synchroniser les forums/sujets");
define("_MI_NEWBBEX_ADMENU5","Ajouter une cat&eacute;gorie");
define("_MI_NEWBBEX_ADMENU6","Editer une cat&eacute;gorie");
define("_MI_NEWBBEX_ADMENU7","Effacer une cat&eacute;gorie");
define("_MI_NEWBBEX_ADMENU8","R&eacute;-ordonner les cat&eacute;gories");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_NEWBBEX_THREAD_NOTIFY', 'Discussion'); //Current Thread');
define ('_MI_NEWBBEX_THREAD_NOTIFYDSC', "Options de notification s'appliquant &agrave; la discussion actuelle.");

define ('_MI_NEWBBEX_FORUM_NOTIFY', 'Forum'); //Current Forum');
define ('_MI_NEWBBEX_FORUM_NOTIFYDSC', "Options de notification s'appliquant au forum actuel.");

define ('_MI_NEWBBEX_GLOBAL_NOTIFY', 'Globale');
define ('_MI_NEWBBEX_GLOBAL_NOTIFYDSC', 'Options de notification globale des forums.');

define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', 'Nouvel envoi');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', 'Notifiez-moi des nouveaux envois dans la discussion actuelle.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', "Recevoir une notification lorsqu'un nouveau message est post&eacute; dans la discussion actuelle.");
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi dans la discussion');

define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', 'Nouvelle discusion');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', 'Notifiez-moi des nouveaux sujets dans le forum actuel.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', "Recevoir une notification lorsqu'un nouveau sujet d&eacute;bute dans le forum actuel.");
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvelle discussion dans le forum');

define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', 'Nouveau forum');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau forum est cr&eacute;&eacute;.");
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', "Recevoir une notification lorsqu'un nouveau forum est cr&eacute;&eacute;.");
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau forum');

define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', 'Nouvel envoi');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', 'Notifiez-moi de chaque nouvel envoi.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', 'Recevoir une notification quand un nouveau message est post&eacute;.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi');

define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', 'Nouvel envoi');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', 'Notifiez-moi de chaque nouvel envoi dans le forum actuel.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', 'Recevoir une notification quand un nouveau message est post&eacute; dans le forum actuel.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Nouvel envoi dans le forum');

define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', 'Nouvel envoi (Texte Complet)');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Notifiez-moi de chaque nouvel envoi (incluant le texte complet du message).');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Recevoir une notification du texte complet quand un nouveau message est post&eacute;.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi (texte complet)');

define ('_MI_NEWBBEX_SMNAME1', 'Recherche avancée');
define ('_MI_NEWBBEX_SHOWMSG', 'Voir les titres et les forums privés ?');
define ('_MI_NEWBBEX_SHOWMSGDESC', 'Lorsque l\'option est positionnée sur Non, les utilisateurs ne peuvent pas voir les forums auxquels ils n\'ont pas accès');

// Added in version 1.5
define("_MI_NEWBBEX_ATTACH_FILES", "Types Mime (Pour attacher des fichiers ou des images)");
define("_MI_NEWBBEX_ATTACH_HLP", "Entrez un type par ligne");

define('_MI_NEWBBEX_UPLSIZE', "Taille maximale des fichiers téléchargés (KO) 1048576 = 1 Mega");
define('_MI_NEWBBEX_UPLSIZE_DSC', "en octets");
define('_MI_NEWBBEX_EDITOR_TO_USE', "Editeur à utiliser");
?>