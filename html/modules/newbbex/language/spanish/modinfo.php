<?php
//========================================================================================
//Traducción al Español (es-ar) realizada por Magno Laguna [laguna_virtual@yahoo.com.ar]
//Buenos Aires - Argentina
//========================================================================================
// $Id: modinfo.php,v 1.12 2003/04/02 04:44:23 mvandam Exp $
// Module Info

// The name of this module
define("_MI_NEWBBEX_NAME","Foro");

// A brief description of this module
define("_MI_NEWBBEX_DESC","Modulo de Foros para XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBBEX_BNAME1","Temas recientes");
define("_MI_NEWBBEX_BNAME2","Temas m&aacute;s vistos");
define("_MI_NEWBBEX_BNAME3","Temas m&aacute;s activos");
define("_MI_NEWBBEX_BNAME4","Temas privados recientes");
define("_MI_NEWBBEX_BNAME5","Temas sin respuestas");
define("_MI_NEWBBEX_BNAME6","Temas privados sin respuesta");
define("_MI_NEWBBEX_BNAME7","Temas privados y p&uacute;blicos sin respuesta");
define("_MI_NEWBBEX_BNAME8","Estad&iacute;sticas del Foro");
define("_MI_NEWBBEX_BNAME9","Temas privados y p&uacute;blicos recientes");
define("_MI_NEWBBEX_BNAME10","Estad&iacute;sticas mensuales");
define("_MI_NEWBBEX_BNAME11","&Uacute;ltimos env&iacute;os p&uacute;blicos y privados desde tu &uacute;ltima visita");

// Names of admin menu items
define("_MI_NEWBBEX_ADMENU1","Agregar foro");
define("_MI_NEWBBEX_ADMENU2","Editar foro");
define("_MI_NEWBBEX_ADMENU3","Editar foro privado");
define("_MI_NEWBBEX_ADMENU4","Sincronizar Foros/Temas");
define("_MI_NEWBBEX_ADMENU5","Agregar categor&iacute;a");
define("_MI_NEWBBEX_ADMENU6","Editar categor&iacute;a");
define("_MI_NEWBBEX_ADMENU7","Borrar categor&iacute;a");
define("_MI_NEWBBEX_ADMENU8","Re-ordenar categor&iacute;a");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_NEWBBEX_THREAD_NOTIFY', 'Hilo');
define ('_MI_NEWBBEX_THREAD_NOTIFYDSC', 'Opciones de notificaci&oacute;n que se aplican al hilo actual.');

define ('_MI_NEWBBEX_FORUM_NOTIFY', 'Foro');
define ('_MI_NEWBBEX_FORUM_NOTIFYDSC', 'Opciones de notificaci&oacute;n que se aplican al foro actual.');

define ('_MI_NEWBBEX_GLOBAL_NOTIFY', 'Global');
define ('_MI_NEWBBEX_GLOBAL_NOTIFYDSC', 'Opciones de notificaci&oacute;n Globales del foro.');

define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', 'Nuevo Mensaje');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', 'Notificarme de nuevos mensajes en el hilo actual.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', 'Recibir notificaci&oacute;n cuando un nuevo mensaje es escrito en el hilo actual.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto-notificaci&oacute;n : Nuevo mensaje en el hilo actual.');

define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', 'Nuevo Hilo');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', 'Notificarme cuando un nuevo hilo es empezado en este foro.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', 'Recibir notificaci&oacute;n cuando un nuevo hilo es comenzado el el foro actual.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto-notificaci&oacute;n : Nuevo hilo en el foro.');

define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', 'Nuevo Foro');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', 'Notificarme cuando un nuevo foro es creado.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', 'Recibir notificaci&oacute;n cuando un nuevo foro es creado.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto-notificaci&oacute;n : Nuevo Foro');

define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', 'Nuevo Mensaje');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', 'Notificarme de cualquier nuevo mensaje.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', 'Recibir notificaci&oacute;n cuando cualquier nuevo mensaje es enviado.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto-notificaci&oacute;n : Nuevo mensaje');

define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', 'Nuevo Mensaje');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', 'Notificarme de cualquier nuevo mensaje en el foro actual.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', 'Recibir notificaci&oacute;n cuando cualquier nuevo mensaje es enviado en el foro actual.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto-notificaci&oacute;n : Nuevo mensaje en foro');

define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', 'Nuevo mensaje (Texto completo)');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Notificarme de cualquier nuevo mensaje (incluir el texto del mensaje).');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Recibir notificaci&oacute;n con texto completo cuando cualquier nuevo mensaje es enviado.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto-notificaci&oacute;n : Nuevo mensaje (texto completo)');

define ('_MI_NEWBBEX_SMNAME1', 'B&uacute;squeda avanzada');
define ('_MI_NEWBBEX_SHOWMSG', '&iquest;Mostrar t&iacute;tulos y foros privados?');
define ('_MI_NEWBBEX_SHOWMSGDESC', 'Al seleccionar no, los usuarios no pueden ver los foros y postar en ellos.');

// Added in version 1.5
define("_MI_NEWBBEX_ATTACH_FILES", "Mime Types (to attach files or pictures)");
define("_MI_NEWBBEX_ATTACH_HLP", "Type one mime type per line");

define('_MI_NEWBBEX_UPLSIZE', "MAX Filesize Upload (KB) 1048576 = 1 Meg");
define('_MI_NEWBBEX_UPLSIZE_DSC', "in bytes");
?>