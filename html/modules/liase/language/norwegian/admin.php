<?php
// $Id: admin.php,v 1.5 2005/02/14 12:52:52 tuff Exp $
// Translated to Norwegian by Bjørn Wirum 2005/02/16

define("_AM_SAVE","Lagre");
define("_AM_COPIED","%s kopier");
define("_AM_DBUPDATED","Databasen er oppdatert!");
define("_AM_ELE_CREATE","Lag et skjemaelement");
define("_AM_ELE_EDIT","Rediger skjemaelement: %s");

define("_AM_ELE_CAPTION","Forklaring");
define("_AM_ELE_DEFAULT","Standard verdi");
define("_AM_ELE_DETAIL","Detalj");
define("_AM_ELE_REQ","Obligatorisk");
define("_AM_ELE_ORDER","Rekkefølge");
define("_AM_ELE_DISPLAY","Vis");

define("_AM_ELE_TEXT","Tekstboks");
define("_AM_ELE_TEXT_DESC","{UNAME} vil skrive brukernavn;<br />{EMAIL} vil skrive brukerens e-post");
define("_AM_ELE_TAREA","Tekstfelt");
define("_AM_ELE_SELECT","Valg");
define("_AM_ELE_CHECK","Avmerkingsbokser");
define("_AM_ELE_RADIO","Alternativknapper");
define("_AM_ELE_YN","Enkle ja/nei alternativknapper");

define("_AM_ELE_SIZE","Størrelse");
define("_AM_ELE_MAX_LENGTH","Maksimum bredde");
define("_AM_ELE_ROWS","Rader");
define("_AM_ELE_COLS","Kolonner");
define("_AM_ELE_OPT","Alternativer");
define("_AM_ELE_OPT_DESC","Kryss av avmerkingsboksene for å sette standardverdier");
define("_AM_ELE_OPT_DESC1","<br />Kun den første boksen benyttes dersom ikke flere valg er tillatt");
define("_AM_ELE_OPT_DESC2","Velg standardverdi ved å merke av en alternativknapp");
define("_AM_ELE_ADD_OPT","Legg til %s alternativer");
define("_AM_ELE_ADD_OPT_SUBMIT","Legg til");
define("_AM_ELE_SELECTED","Valgt");
define("_AM_ELE_CHECKED","Merket av");
define("_AM_ELE_MULTIPLE","Tillat flere valg");

define("_AM_ELE_CONFIRM_DELETE","Er du sikker på at du vil slette dette skjemaelementet?");

######### version 1.1 #########
define("_AM_ELE_OTHER", 'For et valg "Annet", skriv {OTHER|*nummer*} i en av tekstboksene. Eksempelvis genererer {OTHER|30} en tekstboks med 30 tegns bredde.');

######### version 1.2 additions #########
define("_AM_FORM_LISTING", "Kontaktskjemaliste");
define("_AM_FORM_ORDER","Visningsrekkefølge");
define("_AM_FORM_ORDER_DESC","0 = skjul dette skjemaet");
define("_AM_FORM_TITLE", "Skjematittel");
define("_AM_FORM_PERM", "Grupper som kan se dette skjemaet");
define("_AM_FORM_SENDTO", "Send til");
define("_AM_FORM_SENDTO_ADMIN", "Administrator e-post");
define("_AM_FORM_SEND_METHOD", "Sendemetode");
define("_AM_FORM_SEND_METHOD_DESC", "Informasjon kan ikke sendes via privat melding når skjemaet sendes til "._AM_FORM_SENDTO_ADMIN." eller er sendt av anonyme brukere");
define("_AM_FORM_SEND_METHOD_MAIL", "E-post");
define("_AM_FORM_SEND_METHOD_PM", "Privat melding");
define("_AM_FORM_DELIMETER", "Skilletegn for avmerkingsbokser og alternativknapper");
define("_AM_FORM_DELIMETER_SPACE", "Hvitt mellomrom");
define("_AM_FORM_DELIMETER_BR", "Linjeskift");
define("_AM_FORM_SUBMIT_TEXT", "Tekst for send-knapp");
define("_AM_FORM_DESC", "Beskrivelse av skjema");
define("_AM_FORM_DESC_DESC", "Tekst som skal vises i hovedsiden dersom fler enn ett skjema er opplistet");
define("_AM_FORM_INTRO", "Introduksjon til skjema");
define("_AM_FORM_INTRO_DESC", "Tekst som skal vises på selve skjemaet");
define("_AM_FORM_WHERETO", "URL som en skal sendes til etter at skjemaet er innsendt");
define("_AM_FORM_WHERETO_DESC", "La være blank for å sende tilbake til hjemmesiden til dette nettstedet; {SITE_URL} vil skrive ".XOOPS_URL);

define("_AM_FORM_ACTION_EDITFORM", "Endre skjemaalternativer");
define("_AM_FORM_ACTION_EDITELEMENT", "Endre skjemaelementer");
define("_AM_FORM_ACTION_CLONE", "Kopier dette skjemaet");

define("_AM_FORM_NEW", "Lag et nytt skjema");
define("_AM_FORM_EDIT", "Endre skjema: %s");
define("_AM_FORM_CONFIRM_DELETE", "Er du sikker på at du vil slette dette skjemaet og alle skjemaelementene i det?");

define("_AM_ID", "ID");
define("_AM_ACTION", "Handling");
define("_AM_RESET_ORDER", "Oppdater rekkefølge");
define("_AM_SAVE_THEN_ELEMENTS", "Lagre, deretter endre skjemaelementer");
define("_AM_SAVE_THEN_FORM", "Lagre, deretter endre skjemaalternativer");
define("_AM_NOTHING_SELECTED", "Ingenting valgt.");
define("_AM_GO_CREATE_FORM", "Du må lage et skjema først.");

define("_AM_ELEMENTS_OF_FORM", "Skjemaelementer i %s");
define("_AM_ELE_APPLY_TO_FORM", "Lagre i skjema");
define("_AM_ELE_HTML", "Ren tekst / HTML");

######### version 1.23 additions #########
define("_AM_XOOPS_VERSION_WRONG", "Den versjonen av Xoops som du kjører er ikke i henhold til systemkravet. Det kan hende Liaise ikke vil fungere som forutsatt.");
define("_AM_ELE_UPLOADFILE","Opplasting av fil");
define("_AM_ELE_UPLOADIMG","Opplasting av bilde");
define("_AM_ELE_UPLOADIMG_MAXWIDTH","Maksimum bredde (piksler)");
define("_AM_ELE_UPLOADIMG_MAXHEIGHT","Maksimum høyde (piksler)");
define("_AM_ELE_UPLOAD_MAXSIZE","Maksimum filstørrelse (bytes)");
define("_AM_ELE_UPLOAD_MAXSIZE_DESC","1k = 1024 bytes");
define("_AM_ELE_UPLOAD_DESC_SIZE_NOLIMIT","0 = ingen grense");
define("_AM_ELE_UPLOAD_ALLOWED_EXT","Tillatte fil-endelser");
define("_AM_ELE_UPLOAD_ALLOWED_EXT_DESC","Del fil-endelser med en |, med skille mellom små og store bokstaver. F. eks. 'jpg|jpeg|gif|png|tif|tiff'");
define("_AM_ELE_UPLOAD_ALLOWED_MIME","Tillatte MIME typer");
define("_AM_ELE_UPLOAD_ALLOWED_MIME_DESC","Del MIME typer med en |, uten skille mellom små og store bokstaver. F. eks. 'image/jpeg|image/pjpeg|image/png|image/x-png|image/gif|image/tiff'");
define("_AM_ELE_UPLOAD_DESC_NOLIMIT","La være blank for ubegrenset (dette er av sikkerhetsgrunner ikke anbefalt)");
define("_AM_ELE_UPLOAD_SAVEAS","Lagre opplastet fil til");
define("_AM_ELE_UPLOAD_SAVEAS_MAIL","Vedlegg til e-post");
define("_AM_ELE_UPLOAD_SAVEAS_FILE","Opplastingsmappe");

?>