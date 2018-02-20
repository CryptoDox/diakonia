<?php
// $Id: modinfo.php,v 1.5 2005/02/14 12:52:52 tuff Exp $
// Translated to Norwegian by Bjørn Wirum 2005/02/16

// The name of this module
define("_MI_LIAISE_NAME","Liaise");

// A brief description of this module
define("_MI_LIAISE_DESC","Kontaktskjemagenerator");

// admin/menu.php
define("_MI_LIAISE_ADMENU1","Kontaktskjemaliste");
define("_MI_LIAISE_ADMENU2","Lag et nytt skjema");

//	preferences
define("_MI_LIAISE_TEXT_WIDTH","Standard bredde på tekstbokser");
define("_MI_LIAISE_TEXT_MAX","Standard maksimum bredde på tekstbokser");
define("_MI_LIAISE_TAREA_ROWS","Standard antall rader i tekstområder");
define("_MI_LIAISE_TAREA_COLS","Standard antall kolonner i tekstområder");

######### version 1.1  additions #########
//	preferences
define("_MI_LIAISE_MAIL_CHARSET","Tekstkoding ved sending av e-post");

//	template descriptions
define("_MI_LIAISE_TMPL_MAIN_DESC","Hovedsiden til Liaise");
define("_MI_LIAISE_TMPL_ERROR_DESC","Side som skal vises ved feil");

######### version 1.2 additions #########
//	template descriptions
define("_MI_LIAISE_TMPL_FORM_DESC","Mal for skjemaer");

//	preferences
define("_MI_LIAISE_MOREINFO","Send tilleggsinformasjon sammen med de innsendte data");
define("_MI_LIAISE_MOREINFO_USER","Brukernavn og url til brukerinfoside");
define("_MI_LIAISE_MOREINFO_IP","Innsenders IP adresse");
define("_MI_LIAISE_MOREINFO_AGENT","Innsenders brukeragent (nettleser info)");
define("_MI_LIAISE_MOREINFO_FORM","URL til innsendt skjema");
define("_MI_LIAISE_MAIL_CHARSET_DESC","La være blank for "._CHARSET);
define("_MI_LIAISE_PREFIX","Tekst prefiks for obligatoriske felter");
define("_MI_LIAISE_SUFFIX","Tekst suffiks for obligatoriske felter");
define("_MI_LIAISE_INTRO","Introduksjonstekst på hovedsiden");
define("_MI_LIAISE_GLOBAL","Tekst som skal vises på alle skjemasider");

// admin/menu.php
define("_MI_LIAISE_ADMENU3","Lag skjemaelementer");

######### version 1.21 additions #########
// preferences default values
define("_MI_LIAISE_INTRO_DEFAULT","Kontakt oss gjerne på følgende måter:");
define("_MI_LIAISE_GLOBAL_DEFAULT","[b]* Obligatorisk[/b]");

######### version 1.23 additions #########
define("_MI_LIAISE_UPLOADDIR","Fysisk sti for å lagre opplastede filer UTEN avsluttende skråstrek");
define("_MI_LIAISE_UPLOADDIR_DESC","Alle opplastede filer vil bli lagret her når skjemaet er sendt via privat melding");

?>