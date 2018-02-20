<?php
// $Id: admin.php,v 1.2 2004/04/15 04:10:14 tuff Exp $
define("_AM_SAVE","Speichern");
define("_AM_COPIED","%s kopiert");
define("_AM_DBUPDATED","Datenbank erfolgreich aktualisiert!");
define("_AM_ELE_CREATE","Formular Element erstellen");
define("_AM_ELE_EDIT","Formular Element bearbeiten: %s");

define("_AM_ELE_CAPTION","Bezeichnung");
define("_AM_ELE_DEFAULT","Vorgaben");
define("_AM_ELE_DETAIL","Detail");
define("_AM_ELE_REQ","Erforderlich");
define("_AM_ELE_ORDER","Position");
define("_AM_ELE_DISPLAY","Anzeigen");

define("_AM_ELE_TEXT","Textbox");
define("_AM_ELE_TEXT_DESC","{UNAME} zeigt den Benutzernamen;<br />{EMAIL} zeigt die email Adresse des Benutzers");
define("_AM_ELE_TAREA","Textbereich");
define("_AM_ELE_SELECT","Selections");
define("_AM_ELE_CHECK","Check boxes");
define("_AM_ELE_RADIO","Radio buttons");
define("_AM_ELE_YN","Ja/Nein radio buttons");

define("_AM_ELE_SIZE","Grösse");
define("_AM_ELE_MAX_LENGTH","Maximale länge");
define("_AM_ELE_ROWS","Reihen");
define("_AM_ELE_COLS","Spalten");
define("_AM_ELE_OPT","Optionen");
define("_AM_ELE_OPT_DESC","Markiere die check boxen um die Standardwerte festzulegen.");
define("_AM_ELE_OPT_DESC1","<br />Sind Mehrfachauswahlen nicht erlaubt, so wird nur die erste angewählte check box berücksichtigt."); 
define("_AM_ELE_OPT_DESC2","Wähle die Standardwerte durch anklicken der radio buttons.");
define("_AM_ELE_ADD_OPT","Füge %s Optionen hinzu"); 
define("_AM_ELE_ADD_OPT_SUBMIT","Hinzufügen");
define("_AM_ELE_SELECTED","ausgewählt");
define("_AM_ELE_CHECKED","markiert");
define("_AM_ELE_MULTIPLE","Mehrfachauswahlen erlaubt?");

define("_AM_ELE_CONFIRM_DELETE","Dieses Formularelement wirklich löschen?");

######### version 1.1 #########
define("_AM_ELE_OTHER", 'Für die Option "Sonstiges" mit eigener Eingabemöglichkeit gib {OTHER|*anzahl*} in einem Texteingabefeld ein. Beispielsweise würde die Eingabe {OTHER|*30*} ein Texteingabefeld mit 30 Zeichen Länge erzeugen.');

######### version 1.2 additions #########
define("_AM_FORM_LISTING", "Auflistung der Kontaktformulare");
define("_AM_FORM_ORDER","Position");
define("_AM_FORM_ORDER_DESC","0 = dieses Formular verstecken");
define("_AM_FORM_TITLE", "Formularname");
define("_AM_FORM_PERM", "Gruppen die dieses Formular benutzen dürfen");
define("_AM_FORM_SENDTO", "Senden an");
define("_AM_FORM_SENDTO_ADMIN", "Site Admin email");
define("_AM_FORM_SEND_METHOD", "Versandart");
define("_AM_FORM_SEND_METHOD_DESC", "Informationen können nicht als Private Nachricht versandt werden wenn das Formular an "._AM_FORM_SENDTO_ADMIN." gesendet wird oder von anonymen Benutzern versandt wird.");
define("_AM_FORM_SEND_METHOD_MAIL", "Email");
define("_AM_FORM_SEND_METHOD_PM", "Private Nachricht");
define("_AM_FORM_DELIMETER", "Trennzeichen für check boxen und radio buttons");
define("_AM_FORM_DELIMETER_SPACE", "Leerzeichen");
define("_AM_FORM_DELIMETER_BR", "Zeilenumbruch");
define("_AM_FORM_SUBMIT_TEXT", "Anzeigetext für Senden Knopf");
define("_AM_FORM_DESC", "Formular Beschreibung");
define("_AM_FORM_DESC_DESC", "Text der auf der Hauptseite angezeigt wird wenn mehr als ein Formular aufgelistet wird");
define("_AM_FORM_INTRO", "Formular Vorstellung");
define("_AM_FORM_INTRO_DESC", "Text der auf der Seite des Kontaktformulars angezeigt wird");
define("_AM_FORM_WHERETO", "Adresse (URL) die nach dem senden des Formulars aufgerufen wird");
define("_AM_FORM_WHERETO_DESC", "Frei lassen um die Anfangsseite dieser Webseite aufzurufen. {SITE_URL} zeigt ".XOOPS_URL);

define("_AM_FORM_ACTION_EDITFORM", "Formular Einstellungen bearbeiten");
define("_AM_FORM_ACTION_EDITELEMENT", "Formular Elemente bearbeiten");
define("_AM_FORM_ACTION_CLONE", "Formular clonen");

define("_AM_FORM_NEW", "Neues Formular erstellen");
define("_AM_FORM_EDIT", "Formular bearbeiten: %s");
define("_AM_FORM_CONFIRM_DELETE", "Dieses Formular und alle seine Elemente wirklich löschen?");

define("_AM_ID", "ID");
define("_AM_ACTION", "Aktion");
define("_AM_RESET_ORDER", "Positionen aktualisieren");
define("_AM_SAVE_THEN_ELEMENTS", "Speichern (dann Elemente bearbeiten)");
define("_AM_SAVE_THEN_FORM", "Speichern (dann Formular Einstellungen bearbeiten)");
define("_AM_NOTHING_SELECTED", "Es wurde nichts ausgewählt");
define("_AM_GO_CREATE_FORM", "Zuerst muss ein Formular erstellt werden.");

define("_AM_ELEMENTS_OF_FORM", "Formular Elemente von %s");
define("_AM_ELE_APPLY_TO_FORM", "Zum Formular hinzufügen");
define("_AM_ELE_HTML", "Nur Text / HTML");

######### version 1.23 additions #########
define("_AM_XOOPS_VERSION_WRONG", "Verwendete Xoops version entspricht nicht den Systemvoraussetzungen. Liaise funktioniert evtl. nicht einwandfrei. ");
define("_AM_ELE_UPLOADFILE","Datei upload");
define("_AM_ELE_UPLOADIMG","Grafik upload");
define("_AM_ELE_UPLOADIMG_MAXWIDTH","Maximale Breite (Pixel)");
define("_AM_ELE_UPLOADIMG_MAXHEIGHT","Maximale Hoehe (Pixel)");
define("_AM_ELE_UPLOAD_MAXSIZE","Maximale Dateigroesse (bytes)");
define("_AM_ELE_UPLOAD_MAXSIZE_DESC","1k = 1024 bytes");
define("_AM_ELE_UPLOAD_DESC_SIZE_NOLIMIT","0 = unbegrenzt");
define("_AM_ELE_UPLOAD_ALLOWED_EXT","Erlaubte Dateiendungen");
define("_AM_ELE_UPLOAD_ALLOWED_EXT_DESC","Trenne Endungen mit einem |, Klein- und Großschrift spielt keine Rolle. Beispiel: 'jpg|jpeg|gif|png|tif|tiff'");
define("_AM_ELE_UPLOAD_ALLOWED_MIME","Erlaubte MIME Typen");
define("_AM_ELE_UPLOAD_ALLOWED_MIME_DESC","Trenne MIME Typen mit einem |, Klein- und Großschrift spielt keine Rolle. Beispiel:  'image/jpeg|image/pjpeg|image/png|image/x-png|image/gif|image/tiff'");
define("_AM_ELE_UPLOAD_DESC_NOLIMIT","Um komplett auf Beschränkungen zu verzichten einfach freilassen. (Aus SIcherheitsgruenden nicht empfohlen)");
define("_AM_ELE_UPLOAD_SAVEAS","Sichere hochgeladene Datei nach");
define("_AM_ELE_UPLOAD_SAVEAS_MAIL","Mail Anhang");
define("_AM_ELE_UPLOAD_SAVEAS_FILE","Upload Verzeichnis");

?>
