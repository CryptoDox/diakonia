<?php
// $Id: modinfo.php 75 2005-09-06 21:52:55Z gron $
// Module Info

// The name of this module
define("_MI_WSPROJECT_NAME",			"wsProject");
// A brief description of this module
define("_MI_WSPROJECT_DESC",			"Un outil pour planifier des projets.");

// Names of admin menu items
define('_MI_WSPROJECT_ADMENU1',			'Param&egrave;tres');


//Die Menüpunkte
define("_MI_WSPROJECT_COMPLETEDPROJECTS",	"Projets termin&eacute;s");

define("_MI_WSPROJECT_ACTIVEPROJECTS",		"Projets en cours");
define("_MI_WSPROJECT_MYTASKS",			"Mes t&acirc;ches");
define("_MI_WSPROJECT_NEWPROJECT",		"Nouveau projet");

//Blocks
define("_MI_WSPROJECT_PROJECTSTATUS",		"Statut des projets");
define("_MI_WSPROJECT_PROJECTOVERVIEW",		"Description des projets");


//Notifications
define ('_MI_WSPROJECT_GLOBAL_NOTIFY', 		'Globale');
define ('_MI_WSPROJECT_GLOBAL_NOTIFYDSC', 	'Options de notification globale.');

define ('_MI_WSPROJECT_PROJECT_NOTIFY', 	'Projets');
define ('_MI_WSPROJECT_PROJECT_NOTIFYDSC', 	'Options de Notification pour les projets.');

define ('_MI_WSPROJECT_TASK_NOTIFY', 		'Taches');
define ('_MI_WSPROJECT_TASK_NOTIFYDSC', 	'Options de Notification pour les t&acirc;ches.');

define ('_MI_WSPROJECT_NEWPROJECT_NOTIFY', 	'Nouveau projet');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYCAP', 	'Notification pour un nouveau projet');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYDSC', 	"Notification lors d'un nouveau projet.");
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYSBJ', 	'[{X_SITENAME}] {X_MODULE} auto-notification : Nouveau projet');

define ('_MI_WSPROJECT_NEWTASK_NOTIFY', 	'Nouvelle t&acirc;che');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYCAP', 	'Notification pour une nouvelle t&acirc;che.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYDSC', 	"Notification lorsque l'on m'assigne une nouvelle t&acirc;che.");
define ('_MI_WSPROJECT_NEWTASK_NOTIFYSBJ', 	'[{X_SITENAME}] {X_MODULE} auto-notification : Nouvelle t&acirc;che');

define ('_MI_WSPROJECT_EDITTASK_NOTIFY', 	'Edition de t&acirc;che');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYCAP', 	'Notification sur modification de t&acirc;ches.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYDSC', 	'Notification si une t&acirc;che est modifi&eacute;e.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYSBJ', 	'[{X_SITENAME}] {X_MODULE} auto-notification : Edition de t&acirc;che');

?>