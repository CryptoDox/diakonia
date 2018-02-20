<?php
// $Id: main.php,v 1.3 2004/04/10 16:04:12 hthouzard Exp $
//%%%%%%		File Name index.php 		%%%%%
define("_AMS_NW_PRINTER","Versi�n Imprimible");
define("_AMS_NW_SENDSTORY","Enviar este art�culo");
define("_AMS_NW_READMORE","Leer m�s...");
define("_AMS_NW_COMMENTS","�Comentarios?");
define("_AMS_NW_ONECOMMENT","1 comentario");
define("_AMS_NW_BYTESMORE","%s palabr�s m�s");
define("_AMS_NW_NUMCOMMENTS","%s comentarios");
define("_AMS_NW_MORERELEASES", "M�s publicados en ");

//%%%%%%		File Name submit.php		%%%%%
define("_AMS_NW_SUBMITNEWS","Enviar Art�culo");
define("_AMS_NW_TITLE","T�tulo");
define("_AMS_NW_TOPIC","Tema");
define("_AMS_NW_THESCOOP","Texto del Art�culo");
define("_AMS_NW_NOTIFYPUBLISH","Notificar por correo cuando sea publicado");
define("_AMS_NW_POST","Publicar");
define("_AMS_NW_GO","�Enviar!");
define("_AMS_NW_THANKS","Gracias por su env�o."); //submission of news article

define("_AMS_NW_NOTIFYSBJCT","Art�culo para su sitio"); // Notification mail subject
define("_AMS_NW_NOTIFYMSG","Le aguarda un nuevo env�o para su Sitio."); // Notification mail message

//%%%%%%		File Name archive.php		%%%%%
define("_AMS_NW_NEWSARCHIVES","Archivo de Art�culos");
define("_AMS_NW_ARTICLES","Art�culos");
define("_AMS_NW_VIEWS","Visto");
define("_AMS_NW_DATE","Fecha");
define("_AMS_NW_ACTIONS","Acciones");
define("_AMS_NW_PRINTERFRIENDLY","Versi�n Imprimible");

define("_AMS_NW_THEREAREINTOTAL","Hay %s art�culo(s) en total");

// %s is your site name
define("_AMS_NW_INTARTICLE","Art�culo interesante en %s");
define("_AMS_NW_INTARTFOUND","Encontr� un art�culo interesante en %s");

define("_AMS_NW_TOPICC","Tema:");
define("_AMS_NW_URL","URL:");
define("_AMS_NW_NOSTORY","Lo lamento, el art�culo seleccionado no existe.");

//%%%%%%	File Name print.php 	%%%%%

define("_AMS_NW_URLFORSTORY","La URL para este art�culo es:");

// %s represents your site name
define("_AMS_NW_THISCOMESFROM","Este art�culo proviene de %s");

// Added by Herv�
define("_AMS_NW_ATTACHEDFILES","Archivos Adjuntos:");

define("_AMS_NW_MAJOR", "�Cambio Mayor?");
define("_AMS_NW_STORYID", "ID del Art�culo");
define("_AMS_NW_VERSION", "Versi�n");
define("_AMS_NW_SETVERSION", "Fijar la Versi�n Actual");
define("_AMS_NW_VERSIONUPDATED", "Versi�n Actual fijada a %s");
define("_AMS_NW_OVERRIDE", "Override");
define("_AMS_NW_FINDVERSION", "Encontrar Versi�n");
define("_AMS_NW_REVISION", "Revisi�n");
define("_AMS_NW_MINOR", "Revisi�n Menor");
define("_AMS_NW_VERSIONDESC", "Elija un nivel de cambio - Si NO lo especifica, el texto �NO SER� ACTUALIZADO!");
define("_AMS_NW_NOVERSIONCHANGE", "No cambiar la Versi�n");
define("_AMS_NW_AUTO", "Auto");

define("_AMS_NW_RATEARTICLE", "Valorar Art�culo");
define("_AMS_NW_RATE", "Valorar Art�culo");
define("_AMS_NW_SUBMITRATING", "Enviar Valoraci�n");
define("_AMS_NW_RATING_SUCCESSFUL", "Art�culo Valorado Satisfactoriamente");
define("_AMS_NW_PUBLISHED_DATE", "Fecha de Publicaci�n: ");
define("_AMS_NW_POSTEDBY", "Autor");
define("_AMS_NW_READS", "Lecturas");
define("_AMS_NW_AUDIENCE", "Audiencia");
define("_AMS_NW_SWITCHAUTHOR", "�Actualizar Autor?");

//Warnings
define("_AMS_NW_VERSIONSEXIST", "%s Versi�n(es) con versiones mayores existen y <strong>ser�n</strong> SOBRESCRITAS sin la posibilidad de ser RESTAURADAS:");
define("_AMS_NW_AREYOUSUREOVERRIDE", "�Est� seguro de que desea remplazar estas versiones?");
define("_AMS_NW_CONFLICTWHAT2DO", "Un art�culo con el n�mero de versi�n calculada existe<br />�Qu� desea hacer?<br />Override: Esta versi�n se guardar� con el n�mero de versi�n calculado y todas las versiones mayores en el mismo grupo de versi�n (xx.xx.xx) ser�n eliminados.<br />Encontrar Versi�n: Permite al sistema buscar la pr�xima versi�n disponible en el mismo grupo de versi�n.");
define("_AMS_NW_VERSIONCONFLICT", "Conflicto de Versi�n");
define("_AMS_NW_TRYINGTOSAVE", "Intentando guardar ");

//Error messages
define("_AMS_NW_ERROR", "Ocurr�o un Error");
define("_AMS_NW_RATING_FAILED", "La Valoraci�n Fall�");
define("_AMS_NW_SAVEFAILED", "No se puedo Guardar el Art�culo");
define("_AMS_NW_TEXTSAVEFAILED", "No se pudo guardar el texto del art�culo");
define("_AMS_NW_VERSIONUPDATEFAILED", "Imposible actualizar la versi�n");
define("_AMS_NW_COULDNOTRESET", "Imposible resetear las versiones");
define("_AMS_NW_COULDNOTUPDATEVERSION", "Imposible actualizar la versi�n actual");

define("_AMS_NW_COULDNOTSAVERATING", "Imposible guardar valoraci�n");
define("_AMS_NW_COULDNOTUPDATERATING", "Imposible actualizar la valoraci�n del art�culo");

define("_AMS_NW_COULDNOTADDLINK", "Imposible enlazar el enlace con el art�culo");
define("_AMS_NW_COULDNOTDELLINK", "Error - Enlace no borrado");

define("_AMS_NW_CANNOTVOTESELF", "El Autor no puede valorar sus art�culos");
define("_AMS_NW_ANONYMOUSVOTEDISABLED", "Valoraci�n An�nima deshabilitada");
define("_AMS_NW_ANONYMOUSHASVOTED", "Esta IP ya ha valorado este art�culo");
define("_AMS_NW_USERHASVOTED", "Ya ha valorado antes este art�culo");

define("_AMS_NW_NOTALLOWEDAUDIENCE", "No le est� permitido leer nivel %s de art�culos");
define("_AMS_NW_NOERRORSENCOUNTERED", "No se encontraron errores");

//Additional constants
define("_AMS_NW_USERNAME", "Nombre Usuario");
define("_AMS_NW_ADDLINK", "A�adir Enlace(s)");
define("_AMS_NW_DELLINK", "Eliminar Enlace(s)");
define("_AMS_NW_RELATEDARTICLES", "Lectura Recomendada");
define("_AMS_NW_SEARCHRESULTS", "Buscar Resultados:");
define("_AMS_NW_MANAGELINK", "Enlaces");
define("_AMS_NW_DELVERSIONS", "Borrar versiones anteriores a esta versi�n");
define("_AMS_NW_DELALLVERSIONS", "Borrar TODAS las versiones a partir de esta");
define("_AMS_NW_SUBMIT", "Enviar");
define("_AMS_NW_RUSUREDELVERSIONS", "�Est� seguro de que desea eliminar TODAS las versiones �POSTERIORES A LA RESTAURACI�N! a partir de esta versi�n?");
define("_AMS_NW_RUSUREDELALLVERSIONS", "�Est� seguro de que desea eliminar TODAS las versiones �POSTERIORES A LA RESTAURACI�N! aparte de esta versi�n?");
define("_AMS_NW_EXTERNALLINK", "Enlace Externo");
define("_AMS_NW_ADDEXTERNALLINK", "A�adir Enlace Externo");
define("_AMS_NW_PREREQUISITEARTICLES", "Lectura Obligada");
define("_AMS_NW_LINKTYPE", "Tipo de Enlace");
define("_AMS_NW_SETTITLE", "Fijar el T�tulo del enlace");
define("_AMS_NW_BANNER", "Banner/Esp�nsor");

define("_AMS_NW_NOTOPICS", "No Existen Temas - Por favor, cree un tema y configure los permisos apropiados antes de enviar un art�culo");

define("_AMS_NW_TOTALARTICLES", "Art�culos Totales");

define("_AMS_MA_INDEX", "�ndice");
define("_AMS_MA_SUBTOPICS", "Sub-Temas para ");
define("_AMS_MA_PAGEBREAK", "SALTO DE P�GINA");
define("_AMS_NW_POSTNEWARTICLE", "Enviar Nuevo Art�culo");

?>