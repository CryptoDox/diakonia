<?php
// $Id: modinfo.php 75 2005-09-06 21:52:55Z gron $
// Module Info

// The name of this module
define("_MI_WSPROJECT_NAME","wsProject");
// A brief description of this module
define("_MI_WSPROJECT_DESC","Ett administrationsverktyg f�r Era projekt.");

// Names of admin menu items
define('_MI_WSPROJECT_ADMENU1','Konfiguration');


//Die Men�punkte
define("_MI_WSPROJECT_COMPLETEDPROJECTS",	"Avslutade Projekt");

define("_MI_WSPROJECT_ACTIVEPROJECTS","P�g�ende Projekt");
define("_MI_WSPROJECT_MYTASKS",		"Mina Uppgifter");
define("_MI_WSPROJECT_NEWPROJECT",	"Nytt Projekt");

//Blocks
define("_MI_WSPROJECT_PROJECTSTATUS",	"Projekt Status");
define("_MI_WSPROJECT_PROJECTOVERVIEW",	"Projekt �versikt");


//Notifications
define ('_MI_WSPROJECT_GLOBAL_NOTIFY', 'Globala');
define ('_MI_WSPROJECT_GLOBAL_NOTIFYDSC', 'Globala underr�ttelse inst�llningar.');

define ('_MI_WSPROJECT_PROJECT_NOTIFY', 'Projekt');
define ('_MI_WSPROJECT_PROJECT_NOTIFYDSC', 'Underr�ttelse inst�llningar f�r projekt.');

define ('_MI_WSPROJECT_TASK_NOTIFY', 'Uppgifter');
define ('_MI_WSPROJECT_TASK_NOTIFYDSC', 'Underr�ttelse inst�llningar f�r uppgifter.');

define ('_MI_WSPROJECT_NEWPROJECT_NOTIFY', 'Nytt Projekt');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYCAP', 'Underr�ttelse om att ett nytt projekt har startats');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYDSC', 'Meddela mig vid nya projekt.');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatiskt meddelande : Nytt Projekt');

define ('_MI_WSPROJECT_NEWTASK_NOTIFY', 'Ny Uppgift');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYCAP', 'Underr�ttelse om en ny uppgift.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYDSC', 'Meddela mig n�r nya uppgifter tilldelats mig.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatiskt meddelande : Ny Uppgift');

define ('_MI_WSPROJECT_EDITTASK_NOTIFY', '�ndrade Uppgifter');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYCAP', 'Underr�ttelse om �ndring av uppgift.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYDSC', 'Meddela mig om en uppgift har �ndrats.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Automatiskt meddelande : �ndrad Uppgift');

?>