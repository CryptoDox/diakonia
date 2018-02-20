<?php
// $Id: modinfo.php,v 1.5 2005/02/14 12:52:52 tuff Exp $

// The name of this module
define("_MI_LIAISE_NAME","Liaise");

// A brief description of this module
define("_MI_LIAISE_DESC","Kontaktformular Generator");

// admin/menu.php
define("_MI_LIAISE_ADMENU1","Liste der Kontaktformulare");
define("_MI_LIAISE_ADMENU2","Neues Formular anlegen");

//	preferences
define("_MI_LIAISE_TEXT_WIDTH","Standardbreite von Textboxen");
define("_MI_LIAISE_TEXT_MAX","Standardl�nge von Textboxen (maximal)");
define("_MI_LIAISE_TAREA_ROWS","Standardanzahl der Zeilen von Textbereichen");
define("_MI_LIAISE_TAREA_COLS","Standardanzahl der Spalten von Textbereichen");

######### version 1.1  additions #########
//	preferences
define("_MI_LIAISE_MAIL_CHARSET","Text encoding f�r den Mailversand");

//	template descriptions
define("_MI_LIAISE_TMPL_MAIN_DESC","Hauptseite von Liaise");
define("_MI_LIAISE_TMPL_ERROR_DESC","Seite die bei Fehlern angezeigt wird");

######### version 1.2 additions #########
//	template descriptions
define("_MI_LIAISE_TMPL_FORM_DESC","Formularvorlage");

//	preferences
define("_MI_LIAISE_MOREINFO","Zus�tzliche Informationen mit den �bertragenen Daten verschicken");
define("_MI_LIAISE_MOREINFO_USER","Benutzername und url der Benutzerinfoseite");
define("_MI_LIAISE_MOREINFO_IP","IP Adresse des Benutzers");
define("_MI_LIAISE_MOREINFO_AGENT","Verwendeter Browser des Benutzers");
define("_MI_LIAISE_MOREINFO_FORM","URL des gesendeten Formulars");
define("_MI_LIAISE_MAIL_CHARSET_DESC","Feld frei lassen f�r "._CHARSET);
define("_MI_LIAISE_PREFIX","Text Pr�fix f�r erforderliche Felder");
define("_MI_LIAISE_SUFFIX","Text Suffix f�r erforderliche Felder");
define("_MI_LIAISE_INTRO","Beschreibungstext auf der Hauptseite");
define("_MI_LIAISE_GLOBAL","Text der auf jeder Formularseite angezeigt wird");

// admin/menu.php
define("_MI_LIAISE_ADMENU3","Formularelemente erstellen");

######### version 1.21 additions #########
// preferences default values
define("_MI_LIAISE_INTRO_DEFAULT","Waehle eines der Kontaktformulare aus:");
define("_MI_LIAISE_GLOBAL_DEFAULT","[b]* Erforderlich[/b]");

######### version 1.23 additions #########
define("_MI_LIAISE_UPLOADDIR","Physikalischer Pfad zum speichern der uploads ohne vorangestellten Schr�gstrich");
define("_MI_LIAISE_UPLOADDIR_DESC","Alle hochgeladenen Dateien werden hier gespeichert wenn ein Formular via privater Nachricht gesendet wird.");

?>
