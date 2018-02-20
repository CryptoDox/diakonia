<?php
// $Id: modinfo.php,v 1.16 2004/06/09 09:57:33 mithyt2 Exp $
// Module Info

// The name of this module
define("_AMS_MI_NEWS_NAME","Art�culos");

// A brief description of this module
define("_AMS_MI_NEWS_DESC","Crear una secci�n de art�culos al estilo Slashdot, donde los usuarios puedan enviar art�culos y comentarios.");

// Names of blocks for this module (Not all module has blocks)
define("_AMS_MI_NEWS_BNAME1","Temas de las Noticias");
define("_AMS_MI_NEWS_BNAME3","Gran Historia");
define("_AMS_MI_NEWS_BNAME4","Noticias Top");
define("_AMS_MI_NEWS_BNAME5","Noticias Recientes");
define("_AMS_MI_NEWS_BNAME6","Moderar Noticias");
define("_AMS_MI_NEWS_BNAME7","Navegar por los temas");
define("_AMS_MI_NEWS_BNAME8","Autores M�s Activos");
define("_AMS_MI_NEWS_BNAME9","Autores M�s Le�dos");
define("_AMS_MI_NEWS_BNAME10","Autores M�s Valorados");
define("_AMS_MI_NEWS_BNAME11","Art�culos M�s Valorados");
define("_AMS_MI_NEWS_BNAME12","AMS Spotlight");

// Sub menus in main menu block
define("_AMS_MI_NEWS_SMNAME1","Enviar Art�culo");
define("_AMS_MI_NEWS_SMNAME2","Archivo");

// Names of admin menu items
define("_AMS_MI_NEWS_ADMENU2", "Administrador de Temas");
define("_AMS_MI_NEWS_ADMENU3", "Administrar Art�culos");
define("_AMS_MI_NEWS_GROUPPERMS", "Enviar/Aprobar Permisos");

// Title of config items
define("_AMS_MI_STORYHOME", "Elija el n�mero de art�culos a mostrar en la p�gina principal");
define("_AMS_MI_STORYCOUNTTOPIC", "Elija el n�mero de art�culos a mostrar en la p�gina de Temas");
define("_AMS_MI_NOTIFYSUBMIT", "Elija S� para enviar un mensaje de notificaci�n al webmaster encima de los nuevos env�os");
define("_AMS_MI_DISPLAYNAV", "Elija S� para mostrar una caja de navegaci�n encima de cada p�gina del m�dulo");
define("_AMS_MI_AUTOAPPROVE","�Auto-aprobar art�culos sin la intervenci�n del admin?");
define("_AMS_MI_ALLOWEDSUBMITGROUPS", "Grupos que pueden Enviar Art�culos");
define("_AMS_MI_ALLOWEDAPPROVEGROUPS", "Grupos que pueden Aprobar Art�culos");
define("_AMS_MI_NEWSDISPLAY", "Plantilla de visualizaci�n del Art�culo");
define("_AMS_MI_NAMEDISPLAY","Nombre del Autor");
define("_AMS_MI_COLUMNMODE","Columnas");
define("_AMS_MI_STORYCOUNTADMIN","N�mero de art�culos nuevos a mostrar en el �rea de administraci�n: ");
define("_AMS_MI_UPLOADFILESIZE", "M�x. tama�o de Subida (KB) 1048576 = 1 Meg");
define("_AMS_MI_UPLOADGROUPS","Grupos autorizados para subir");
define("_AMS_MI_MAXITEMS", "M�ximos elementos permitidos");
define("_AMS_MI_MAXITEMDESC", "Aqu� configurar� el n�mero m�ximo de elementos seleccionables para un usuario en la caja de navegaci�n del �ndice o de las p�ginas de Temas");


// Description of each config items
define("_AMS_MI_STORYHOMEDSC", "Aqu� controlar� el n�mero de elementos mostrados en la parte superior de la p�gina (ejemplo: cuando ning�n tema sea seleccionado)");
define("_AMS_MI_NOTIFYSUBMITDSC", "");
define("_AMS_MI_DISPLAYNAVDSC", "");
define("_AMS_MI_AUTOAPPROVEDSC", "");
define("_AMS_MI_ALLOWEDSUBMITGROUPSDESC", "Los grupos seleccionados podr�n enviar art�culos");
define("_AMS_MI_ALLOWEDAPPROVEGROUPSDESC", "Los grupos seleccionados podr�n aprobar art�culos");
define("_AMS_MI_NEWSDISPLAYDESC", "La Vista Cl�sica mostrar� todos los art�culos ordenados por fecha de publicaci�n. Los art�culos por tema agrupar�n a los art�culos seg�n su tema mostrando en la parte superior al �ltimo art�culo publicado y el t�tulo de los dem�s (anteriores)");
define("_AMS_MI_ADISPLAYNAMEDSC", "Elija c�mo se mostrar� el nombre del autor");
define("_AMS_MI_COLUMNMODE_DESC","Podr� elegir el n�mero de columnas usadas en la p�gina de art�culos");
define("_AMS_MI_STORYCOUNTADMIN_DESC","");
define("_AMS_MI_STORYCOUNTTOPIC_DESC","Esto determinar� cu�ntos elementos ser�n mostrados en cada Tema. (no en la portada)");
define("_AMS_MI_UPLOADFILESIZE_DESC","");
define("_AMS_MI_UPLOADGROUPS_DESC","Elija los grupos que podr�n subir contenido al servidor");

// Name of config item values
define("_AMS_MI_NEWSCLASSIC", "Cl�sica");
define("_AMS_MI_NEWSBYTOPIC", "Por Tema");
define("_AMS_MI_DISPLAYNAME1", "Nombre de Usuario");
define("_AMS_MI_DISPLAYNAME2", "Nombre Real");
define("_AMS_MI_DISPLAYNAME3", "No mostrar Autor");
define("_AMS_MI_UPLOAD_GROUP1","Autores y Aprobadores");
define("_AMS_MI_UPLOAD_GROUP2","S�lo Aprobadores");
define("_AMS_MI_UPLOAD_GROUP3","Subidas Deshabilitadas");
define("_AMS_MI_INDEX_NAME", "Nombre del Index");
define("_AMS_MI_INDEX_DESC", "Esto ser� mostrado en el nivel superior del men� de navegaci�n de Temas y en la vista art�culo");

// Text for notifications

define("_AMS_MI_NEWS_GLOBAL_NOTIFY", "Global");
define("_AMS_MI_NEWS_GLOBAL_NOTIFYDSC", "Opciones de notificaci�n Global para las noticias.");

define("_AMS_MI_NEWS_STORY_NOTIFY", "Historia");
define("_AMS_MI_NEWS_STORY_NOTIFYDSC", "Opciones de notificaci�n que se aplican a la historia actual.");

define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFY", "Nuevo Tema");
define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Notificarme la creaci�n de nuevos temas.");
define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Recibir notificaci�n de la creaci�n de nuevos temas.");
define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} auto-notificar : Nuevo tema de noticias");

define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFY", "Nueva historia enviada");
define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Notificarme el env�o de cualquier art�culo enviado (en espera de aprobaci�n).");
define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Recibir notificaci�n de cualquier nuevo art�culo enviado (en espera de aprobaci�n).");
define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} auto-notificar : Nuevo art�culo enviado");

define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFY", "Nueva Historia");
define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYCAP", "Notificarme el env�o de cualquier art�culo nuevo.");
define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYDSC", "Recibir notificaci�n de cualquier art�culo nuevo.");
define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} auto-notificar : Art�culo Nuevo");

define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFY", "Historia Aprobada");
define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFYCAP", "Notificarme la aprobaci�n de esta historia.");
define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFYDSC", "Recibir notificaci�n de cuando este art�culo sea aprobado.");
define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} auto-notificar : Art�culo Aprobado");

define("_AMS_MI_RESTRICTINDEX", "�Restringir Temas a la p�gina de Inicio?");
define("_AMS_MI_RESTRICTINDEXDSC", "Si elige s�, los usuarios s�lo ver�n los art�culos listados en el �ndice de los temas. Tendr�n acceso a los art�culos seg�n hayan sido marcados los permisos");

define("_AMS_MI_ANONYMOUS_VOTE", "�Podr�n los usuarios an�nimos valorar los art�culos?");
define("_AMS_MI_ANONYMOUS_VOTE_DESC", "Si est� activado, los usuarios an�nimos podr�n valorar art�culos");

define("_AMS_MI_AUDIENCE", "Niveles de Audiencia");

define("_AMS_MI_SPOTLIGHT", "Spotlight");
define("_AMS_MI_SPOTLIGHT_ITEMS", "Art�culos Candidatos al Spotlight");
define("_AMS_MI_SPOTLIGHT_ITEMS_DESC", "Este es el n�mero de art�culos que ser�n listados en la p�gina de configuraci�n del spotlight como seleccionables para los art�culos categorizados como parte de spotlight");

define("_AMS_MI_EDITOR", "Editor");
define("_AMS_MI_EDITOR_DESC", "Elija qu� editor desea usar en el formulario de env�o - Los editores distintos al incluido por defecto DEBEN ser instalados independientemente por usted.");
define("_AMS_MI_EDITOR_DEFAULT", "El que usa Xoops por Defecto");
define("_AMS_MI_EDITOR_DHTML","DHTML");
define("_AMS_MI_EDITOR_HTMLAREA","Editor HtmlArea");
define("_AMS_MI_EDITOR_FCK","Editor FCK");
define("_AMS_MI_EDITOR_KOIVI","Editor Koivi");
define("_AMS_MI_EDITOR_TINYMCE","Editor TinyMCE");

define("_AMS_MI_EDITOR_USER_CHOICE", "Permitir la posisibilidad de elegir editor al usuario");
define("_AMS_MI_EDITOR_USER_CHOICE_DESC", "Permitirle al usuario elegir el tipo de editor a usar");

define("_AMS_MI_EDITOR_CHOICE", "Editores disponibles");
define("_AMS_MI_EDITOR_CHOICE_DESC", "Editores disponibles para el usuario");

define("_AMS_MI_SPOTLIGHT_TEMPLATE","Plantillas del Spotlight");
define("_AMS_MI_SPOTLIGHT_TEMPLATE_DESC","Qu� plantillas estar�n disponibles para el bloque spotlight para el admin");

define("_AMS_MI_ABOUT", "Acerca de");
define("_AMS_MI_MIME_TYPES","Tipos MIME");

?>