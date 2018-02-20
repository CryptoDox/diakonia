<?php
/**
 * ****************************************************************************
 *  - TDMCreate By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence GPL Copyright (c)  (http://www.tdmxoops.net)
 *
 * Cette licence, contient des limitations!!!
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license     TDM GPL license
 * @author		TDM TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
//Menu
define("_AM_TDMCREATE_MANAGER_INDEX", "Indice");
define("_AM_TDMCREATE_MANAGER_MODULES", "Aggiungi un modulo");
define("_AM_TDMCREATE_MANAGER_TABLES", "Aggiungi una tabella");
define("_AM_TDMCREATE_MANAGER_CONST", "Compila il modulo");
define("_AM_TDMCREATE_MANAGER_ABOUT", "About");
define("_AM_TDMCREATE_MANAGER_PREFERENCES", "Preferenze");
define("_AM_TDMCREATE_MANAGER_UPDATE", "Aggiornamento");

define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_ELEMENTS","Form : Elements");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_DISPLAY_ADMIN","Page : Display admin");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_DISPLAY_USER","Page :Display user");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_BLOC","Bloc : Display");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_MAIN_FIELD","Table : Main Field");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_SEARCH","Search : Index");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE_REQUIRED","Form : Required field");

//General
define("_AM_TDMCREATE_FORMOK", "Salvato con successo");
define("_AM_TDMCREATE_FORMDELOK", "Eliminato con successo");
define("_AM_TDMCREATE_FORMSUREDEL", "Sei sicuro di voler <span style='color : Red'><b>eliminare: %s </b></span>");
define("_AM_TDMCREATE_FORMSURERENEW", "sei sicuro di voler <span style='color : Red'><b>aggiornare: %s </b></span>");
define("_AM_TDMCREATE_FORMUPLOAD", "Carica un file");
define("_AM_TDMCREATE_FORMIMAGE_PATH", "File presenti in %s ");
define("_AM_TDMCREATE_FORMACTION", "Azione");
define("_AM_TDMCREATE_FORMEDIT","Edit");
define("_AM_TDMCREATE_FORMDEL","Delete");
define("_AM_TDMCREATE_FORMCHAMPS","Edit fields");
define("_AM_TDMCREATE_FORM_INFO_TABLE","Information on the table");
define("_AM_TDMCREATE_FORM_INFO_TABLE_FIELD","There are 3 fields added automatically on each tables : table_submitter, table_date_created, table_online");

define("_AM_TDMCREATE_NAME", "Nome");
define("_AM_TDMCREATE_BLOCS", "Blocchi");
define("_AM_TDMCREATE_NB_CHAMPS", "Numero di campi");
define("_AM_TDMCREATE_IMAGE", "Immagine");
define("_AM_TDMCREATE_DISPLAY_ADMIN", "Visibile lato Admin");

//Modules.php
//Form
define("_AM_TDMCREATE_MODULES_ADD", "Aggiungi un nuovo modulo");
define("_AM_TDMCREATE_MODULES_EDIT", "Crea un modulo");
define("_AM_TDMCREATE_MODULES_IMPORTANT", "Informazioni richieste");
define("_AM_TDMCREATE_MODULES_NOTIMPORTANT", "Informazioni opzionali");
define("_AM_TDMCREATE_MODULES_NAME", "Nome");
define("_AM_TDMCREATE_MODULES_VERSION", "Versione");
define("_AM_TDMCREATE_MODULES_DESCRIPTION", "Descrizione");
define("_AM_TDMCREATE_MODULES_AUTHOR", "Autore");
define("_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_URL", "Sito dell'autore");	
define("_AM_TDMCREATE_MODULES_AUTHOR_WEBSITE_NAME", "Nome del sito");
define("_AM_TDMCREATE_MODULES_CREDITS", "Crediti");	
define("_AM_TDMCREATE_MODULES_LICENSE", "Licenza");
define("_AM_TDMCREATE_MODULES_RELEASE_INFO", "Info sulla release");	
define("_AM_TDMCREATE_MODULES_RELEASE_FILE", "File allegato alla release");
define("_AM_TDMCREATE_MODULES_MANUAL", "Manuale");	
define("_AM_TDMCREATE_MODULES_MANUAL_FILE", "File del manuale");
define("_AM_TDMCREATE_MODULES_IMAGE", "Logo del modulo");
define("_AM_TDMCREATE_MODULES_DEMO_SITE_URL", "Indirizzo del sito dimostrativo");	
define("_AM_TDMCREATE_MODULES_DEMO_SITE_NAME", "Titolo del sito dimostrativo");	
define("_AM_TDMCREATE_MODULES_MODULE_WEBSITE_URL", "Sito web del modulo");
define("_AM_TDMCREATE_MODULES_MODULE_WEBSITE_NAME", "Titolo sito web del modulo");
define("_AM_TDMCREATE_MODULES_RELEASE", "Release");
define("_AM_TDMCREATE_MODULES_STATUS", "Stato");
define("_AM_TDMCREATE_MODULES_DISPLAY_MENU", "Visibile nel menu principale");
define("_AM_TDMCREATE_MODULES_DISPLAY_ADMIN", "Visibile lato Admin");
define("_AM_TDMCREATE_MODULES_ACTIVE_SEARCH", "Abilita la ricerca");

//Tables.php
//Form1
define("_AM_TDMCREATE_TABLES_ADD", "Aggiungi tabelle al modulo:");
define("_AM_TDMCREATE_TABLES_EDIT", "Modifica le tabelle del modulo");
define("_AM_TDMCREATE_TABLES_MODULES", "Scegli il modulo");
define("_AM_TDMCREATE_TABLES_NAME", "Nome della tabella <br> <i>(il nome del modulo verrà automaticamente aggiunto al prefisso)</i> <br> Esempio: 'nome_modulo'_'table'_");
define("_AM_TDMCREATE_TABLES_NB_CHAMPS", "Numero di campi in questa tabella <br> <i>in questa versione del modulo, non è possibile aggiungere nuovi campi dopo questo form<br> calcola in modo corretto ciò di cui hai bisogno</i>");
define("_AM_TDMCREATE_TABLES_IMAGE", "Logo tabella");
define("_AM_TDMCREATE_TABLES_BLOCS", "Crea un nuovo blocco per questa tabella (blocchi: casuali, recenti, oggi)");
define("_AM_TDMCREATE_TABLES_DISPLAY_ADMIN", "Usa vista TAB lato Admin");
define("_AM_TDMCREATE_TABLES_SEARCH", "Attiva la ricerca per questa tabella <br> <i>il modulo per il momento, è  in grado di gestire la ricerca sulla tabella <br>Se confermi l'opzione di ricerca verrà disabilitata</i>");
define("_AM_TDMCREATE_TABLES_EXIST", "Il nome specificato per questa tabella è già in uso");
define("_AM_TDMCREATE_TABLES_COMS","Enable the search in this table <br><i>the module can manage for the moment, the coms on a table<br>Coms option will be disabled if you confirmed</i>");
define("_AM_TDMCREATE_TABLES_TOPIC_ADD", "Aggiungi la tabella per la categoria<br> <i>non è possibile aggiungere più di una tabella per la categoria <br> questo form non sarà disponibile dopo aver creato la tabella per la categoria</i>");
//Form2
define("_AM_TDMCREATE_TABLES_CHAMPS_ADD", "Inserisci i campi");
define("_AM_TDMCREATE_TABLES_CHAMPS_EDIT", "Modifica il tuo campo");
define("_AM_TDMCREATE_TABLES_CHAMPS_NAME", "Campo");
define("_AM_TDMCREATE_TABLES_CHAMPS_TYPE", "Tipo");
define("_AM_TDMCREATE_TABLES_CHAMPS_VALEUR", "Valore");
define("_AM_TDMCREATE_TABLES_CHAMPS_ATTRIBUTS", "Attributi");
define("_AM_TDMCREATE_TABLES_CHAMPS_NULL", "Null");
define("_AM_TDMCREATE_TABLES_CHAMPS_DEFAULT", "Default");
define("_AM_TDMCREATE_TABLES_CHAMPS_CLEF", "Key");
define("_AM_TDMCREATE_TABLES_CHAMPS_MORE", "Altri");

//Const.php
define("_AM_TDMCREATE_CONST_MODULES", "Selezionare il modulo che si vuole compilare");

//Creation
//OK
define("_AM_TDMCREATE_CONST_OK_ARCHITECTURE", "Creazione della struttura del modulo (file index.html, icone ,...)");
define("_AM_TDMCREATE_CONST_OK_XOOPS_VERSION", "Creazione del file xoops_version.php");
define("_AM_TDMCREATE_CONST_OK_INDEX_USER","Creazione del file index.php");
define("_AM_TDMCREATE_CONST_OK_CLASS", "Creazione del file %s.php nella cartella class");
define("_AM_TDMCREATE_CONST_OK_CLASS_MENU", "Creazione del file menu.php nella cartella class");
define("_AM_TDMCREATE_CONST_OK_BLOCS", "Creazione del file blocks.php nell cartella blocchi");
define("_AM_TDMCREATE_CONST_OK_SQL", "Creazione del file mysql.sql nella cartella sql");
define("_AM_TDMCREATE_CONST_OK_ADMIN_HEADER", "Creazione del file admin_header.php nella cartella admin");
define("_AM_TDMCREATE_CONST_OK_ADMIN_MENU", "Creazione del file menu.php nella cartella admin");
define("_AM_TDMCREATE_CONST_OK_ADMIN_INDEX", "Creazione del file index.php nella cartella admin");
define("_AM_TDMCREATE_CONST_OK_ADMIN_PAGES", "Creazione del file  %s.php nella cartella admin");
define("_AM_TDMCREATE_CONST_OK_ADMIN_ABOUT", "Creazione del file about.php nella cartella admin");
define("_AM_TDMCREATE_CONST_OK_ADMIN_LANGUAGE", "Creazione del file admin.php nella  cartella languages");
define("_AM_TDMCREATE_CONST_OK_BLOCS_LANGUAGE", "Creazione del file blocks.php nella  cartella languages");
define("_AM_TDMCREATE_CONST_OK_BLOCS_TEMPLATE", "Creazione del file blocks.html nella cartella templates/blocks");
define("_AM_TDMCREATE_CONST_OK_MODINFO_LANGUAGE", "Creazione del file modinfo.php nella cartella languages");
define("_AM_TDMCREATE_CONST_OK_SEARCH", "Creazione del file search.inc.php nella cartella include");
define("_AM_TDMCREATE_CONST_OK_COMS","Creazione files for the coms");
define("_AM_TDMCREATE_CONST_OK_INCLUDE_FUNCTIONS", "Creazione del file functions.php nella cartella include");
define("_AM_TDMCREATE_CONST_OK_ADMIN_PERMISSIONS", "Creazione del file permissions.php nella cartella admin");
//NOTOK
define("_AM_TDMCREATE_CONST_NOTOK_ARCHITECTURE", "Problemi: Creazione della struttura del modulo(file index.html, icone ,...)");
define("_AM_TDMCREATE_CONST_NOTOK_XOOPS_VERSION", "Problemi: Creazione del file xoops_version.php");
define("_AM_TDMCREATE_CONST_NOTOK_CLASS", "Problemi: Creazione del file %s.php nella cartella class");
define("_AM_TDMCREATE_CONST_NOTOK_CLASS_MENU", "Problemi: Creazione del file menu.php nella cartella class");
define("_AM_TDMCREATE_CONST_NOTOK_BLOCS", "Problemi: Creazione dei blocchi nella cartella blocks");
define("_AM_TDMCREATE_CONST_NOTOK_SQL", "Problemi: Creazione del mysql.sql nella cartella sql");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_HEADER", "Problemi: Creazione del file admin_header.php nella cartella admin");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_MENU", "Problemi: Creazione del file menu.php nella cartella admin");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_INDEX", "Problemi: Creazione del file index.php nella cartella admin");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_PAGES", "Problemi: Creazione del file %s .php nella cartella admin");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_ABOUT", "Problemi: Creazione del file about.php nella cartella admin");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_LANGUAGE", "Problemi: Creazione del file admin.php nella cartella languages");
define("_AM_TDMCREATE_CONST_NOTOK_BLOCS_LANGUAGE", "Problemi: Creazione del file blocks.php nella cartella languages");
define("_AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE", "Problemi: Creazione del file blocks.html nella cartella blocks/templates");
define("_AM_TDMCREATE_CONST_NOTOK_MODINFO_LANGUAGE", "Problemi: Creazione del file modinfo.php nella cartella languages");
define("_AM_TDMCREATE_CONST_NOTOK_SEARCH", "Problemi: Creazione del file search.inc.php nella cartella include");
define("_AM_TDMCREATE_CONST_NOTOK_COMS","Problemi : Creazione files for the coms");
define("_AM_TDMCREATE_CONST_NOTOK_INCLUDE_FUNCTIONS", "Problemi: Creazione del file functions.php nella cartella include");
define("_AM_TDMCREATE_CONST_NOTOK_ADMIN_PERMISSIONS", "Problemi: Creazione del file permissions.php nella cartella admin");

//About.php
define("_AM_TDMCREATE_ABOUT_RELEASEDATE", "Data di rilascio");
define("_AM_TDMCREATE_ABOUT_AUTHOR", "Autore");
define("_AM_TDMCREATE_ABOUT_CREDITS", "Credits");
define("_AM_TDMCREATE_ABOUT_README", "Informazioni generali");
define("_AM_TDMCREATE_ABOUT_MANUAL", "Aiuto");
define("_AM_TDMCREATE_ABOUT_LICENSE", "Licenza");
define("_AM_TDMCREATE_ABOUT_MODULE_STATUS", "Stato");
define("_AM_TDMCREATE_ABOUT_WEBSITE", "Sito Web");
define("_AM_TDMCREATE_ABOUT_AUTHOR_NAME", "Nome Autore");
define("_AM_TDMCREATE_ABOUT_AUTHOR_WORD", "Commento dell'autore");
define("_AM_TDMCREATE_ABOUT_CHANGELOG", "Change Log");
define("_AM_TDMCREATE_ABOUT_MODULE_INFO", "Info modulo");
define("_AM_TDMCREATE_ABOUT_AUTHOR_INFO", "Info Autore");
define("_AM_TDMCREATE_ABOUT_DISCLAIMER", "Disclaimer");
define("_AM_TDMCREATE_ABOUT_DISCLAIMER_TEXT", "Licenza GPL - Nessuna garanzia");

?><?php // Translation done by xtransam & Francesco Mulassano aka Urbanspaceman - 2009-07-17 16:27 ?>
