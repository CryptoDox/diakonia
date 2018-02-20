<?php 
/**
 * ****************************************************************************
 *  - CryptoDuke By CryptoDuke   - DEV MODULE FOR XOOPS
 *  - Licence Copyright (c) 2016 (https://elduke3d.shost.ca)
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
 * @license     CryptoDuke Copyright (c) license
 * @author		CryptoDuke TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
//Menu
define("_AM_CRYPTODUKE_MANAGER_INDEX","Index");
define("_AM_CRYPTODUKE_MANAGER_MODULES","Crypter/Decrypter");
// define("_AM_CRYPTODUKE_MANAGER_TABLES","Ajouter une table");
// define("_AM_CRYPTODUKE_MANAGER_CONST","Construire le Module");
define("_AM_CRYPTODUKE_MANAGER_ABOUT","A propos");
define("_AM_CRYPTODUKE_MANAGER_PREFERENCES","Preferences");
define("_AM_CRYPTODUKE_MANAGER_UPDATE","Mise a jour");

define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_ELEMENTS","Form : Elements");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_DISPLAY_ADMIN","Page : Afficher admin");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_DISPLAY_USER","Page : Afficher user");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_BLOC","Bloc : Afficher");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_MAIN_FIELD","Table : Champs principal");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_SEARCH","Recherche : Indexer");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE_REQUIRED","Form : Champs Oblig.");

//General
define("_AM_CRYPTODUKE_FORMOK","Enregistre avec succes");
define("_AM_CRYPTODUKE_FORMDELOK","Supprim&eacute; avec succ&egrave;s");
define("_AM_CRYPTODUKE_FORMSUREDEL", "Etes-vous s&ucirc;r de vouloir supprimer : <b><span style='color : Red'> %s </span></b>");
define("_AM_CRYPTODUKE_FORMSURERENEW", "Etes-vous s&ucirc;r de vouloir renevouler : <b><span style='color : Red'> %s </span></b>");
define("_AM_CRYPTODUKE_FORMUPLOAD","Upload");
define("_AM_CRYPTODUKE_FORMIMAGE_PATH","Fichier present dans %s");
define("_AM_CRYPTODUKE_FORMACTION","Action");
define("_AM_CRYPTODUKE_FORMEDIT","Editer");
define("_AM_CRYPTODUKE_FORMDEL","Supprimer");
define("_AM_CRYPTODUKE_FORMCHAMPS","Editer champs");
define("_AM_CRYPTODUKE_FORM_INFO_TABLE","Information sur la table");
define("_AM_CRYPTODUKE_FORM_INFO_TABLE_FIELD","Il y a 3 champs ajoutes automatiquement sur chaque tables : table_submitter, table_date_created, table_online");

define("_AM_CRYPTODUKE_NAME","Nom");
define("_AM_CRYPTODUKE_BLOCS","Blocs");
define("_AM_CRYPTODUKE_NB_CHAMPS","Nombre de champs");
define("_AM_CRYPTODUKE_IMAGE","Image");
define("_AM_CRYPTODUKE_DISPLAY_ADMIN","Afficher dans le menu admin");

//Modules.php
//Form
define("_AM_CRYPTODUKE_MODULES_ADD","Ajouter un nouveau module");
define("_AM_CRYPTODUKE_MODULES_EDIT","Editer un module");
define("_AM_CRYPTODUKE_MODULES_IMPORTANT","Informations obligatoires");
define("_AM_CRYPTODUKE_MODULES_NOTIMPORTANT","Informations facultatives");
define("_AM_CRYPTODUKE_MODULES_NAME","Nom");
define("_AM_CRYPTODUKE_MODULES_VERSION","Version");
define("_AM_CRYPTODUKE_MODULES_DESCRIPTION","Description");
define("_AM_CRYPTODUKE_MODULES_AUTHOR","Auteur");
define("_AM_CRYPTODUKE_MODULES_AUTHOR_WEBSITE_URL","Url du Site web de l'auteur");	
define("_AM_CRYPTODUKE_MODULES_AUTHOR_WEBSITE_NAME","Nom du site web de l'auteur");
define("_AM_CRYPTODUKE_MODULES_CREDITS","Credits");	
define("_AM_CRYPTODUKE_MODULES_LICENSE","License");
define("_AM_CRYPTODUKE_MODULES_RELEASE_INFO","Info de la release");	
define("_AM_CRYPTODUKE_MODULES_RELEASE_FILE","Fichier de la release");
define("_AM_CRYPTODUKE_MODULES_MANUAL","Manuel");	
define("_AM_CRYPTODUKE_MODULES_MANUAL_FILE","Fichier du manuel");
define("_AM_CRYPTODUKE_MODULES_IMAGE","Logo du module");
define("_AM_CRYPTODUKE_MODULES_DEMO_SITE_URL","Url du site de demo");	
define("_AM_CRYPTODUKE_MODULES_DEMO_SITE_NAME","Nom du site de demo");	
define("_AM_CRYPTODUKE_MODULES_MODULE_WEBSITE_URL","Url du site du module");
define("_AM_CRYPTODUKE_MODULES_MODULE_WEBSITE_NAME","Nom du site du module");
define("_AM_CRYPTODUKE_MODULES_RELEASE","Release");
define("_AM_CRYPTODUKE_MODULES_STATUS","Statut");
define("_AM_CRYPTODUKE_MODULES_DISPLAY_MENU","Afficher dans le menu principal");
define("_AM_CRYPTODUKE_MODULES_DISPLAY_ADMIN","Afficher dans l'admin");
define("_AM_CRYPTODUKE_MODULES_ACTIVE_SEARCH","Activer la recherche");

//Tables.php
//Form1
define("_AM_CRYPTODUKE_TABLES_ADD","Ajouter une table au module :");
define("_AM_CRYPTODUKE_TABLES_EDIT","Editer une table au module");
define("_AM_CRYPTODUKE_TABLES_MODULES","Selectionner le nom du module");
define("_AM_CRYPTODUKE_TABLES_NAME","Nom de la nouvelle table <br><i>(Il y aura le nom du module rajoute automatiquement en prefixe)</i><br>Exemple: 'nom module'_'table'_");
define("_AM_CRYPTODUKE_TABLES_NB_CHAMPS","Nombre de champs dans cette table<br><i>Dans cette version du module, vous ne pouvez pas rajouter des champs apres ce formulaire<br>calculer bien ce que vous voulez</i>");
define("_AM_CRYPTODUKE_TABLES_IMAGE","Logo de la table");
define("_AM_CRYPTODUKE_TABLES_BLOCS","Creer des blocs pour cette table table ( blocs : aleatoire, recent, du jour)");
define("_AM_CRYPTODUKE_TABLES_DISPLAY_ADMIN","Afficher un onglet dans le menu de la partie admin");
define("_AM_CRYPTODUKE_TABLES_SEARCH","Activer la recherche pour cette table <br><i>Le module peut gerer pour l'instant la recherche que sur une table<br>L'option recherche sera desactivee si vous validez</i>");
define("_AM_CRYPTODUKE_TABLES_COMS","Activer les commentaires pour cette table <br><i>Le module peut gerer pour l'instant les coms que sur une table<br>L'option commentaire sera desactivee si vous validez</i>");
define("_AM_CRYPTODUKE_TABLES_EXIST","Ce nom de table existe deja");
define("_AM_CRYPTODUKE_TABLES_TOPIC_ADD","Ajouter une table categorie<br><i>Vous ne pouvez inserer qu'une seule table pour les categories<i><br>Ce formulaire ne sera plus disponible apres avoir creer la table categorie");
//Form2
define("_AM_CRYPTODUKE_TABLES_CHAMPS_ADD","Inserer vos champs");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_EDIT","Editer vos champs");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_NAME","Champs");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_TYPE","Type");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_VALEUR","Valeur");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_ATTRIBUTS","Attributs");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_NULL","Null");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_DEFAULT","Defaut");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_CLEF","Index");
define("_AM_CRYPTODUKE_TABLES_CHAMPS_MORE","En plus");

//Const.php
define("_AM_CRYPTODUKE_CONST_MODULES","Selectionner un module");

//Creation
//OK
define("_AM_CRYPTODUKE_CONST_OK_ARCHITECTURE","Creation de l'architecture du module (dossiers, index.html, icones,...)");
define("_AM_CRYPTODUKE_CONST_OK_XOOPS_VERSION","Creation du xoops_version.php");
define("_AM_CRYPTODUKE_CONST_OK_INDEX_USER","Creation du fichier index.php");
define("_AM_CRYPTODUKE_CONST_OK_CLASS","Creation de la classe %s.php dans le dossier class");
define("_AM_CRYPTODUKE_CONST_OK_CLASS_MENU","Creation de la classe menu.php dans le dossier class");
define("_AM_CRYPTODUKE_CONST_OK_BLOCS","Creation du fichier blocks.php dans le dossier blocks");
define("_AM_CRYPTODUKE_CONST_OK_SQL","Creation du fichier mysql.sql dans le dossier sql");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_HEADER","Creation du fichier admin_header.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_MENU","Creation du fichier menu.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_INDEX","Creation du fichier index.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_PAGES","Creation du fichier %s.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_ABOUT","Creation du fichier about.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_LANGUAGE","Creation du fichier admin.php dans le dossier language");
define("_AM_CRYPTODUKE_CONST_OK_BLOCS_LANGUAGE","Creation du fichier blocks.php dans le dossier language");
define("_AM_CRYPTODUKE_CONST_OK_BLOCS_TEMPLATE","Creation du fichier blocks.html dans le dossier templates/blocks");
define("_AM_CRYPTODUKE_CONST_OK_MODINFO_LANGUAGE","Creation du fichier modinfo.php dans le dossier language");
define("_AM_CRYPTODUKE_CONST_OK_SEARCH","Creation du fichier search.inc.php dans le dossier include");
define("_AM_CRYPTODUKE_CONST_OK_COMS"," Creation des fichiers pour les commentaires");
define("_AM_CRYPTODUKE_CONST_OK_INCLUDE_FUNCTIONS","Creation du fichier functions.php dans le dossier include");
define("_AM_CRYPTODUKE_CONST_OK_ADMIN_PERMISSIONS","Creation du fichier permissions.php dans le dossier admin");
//NOTOK
define("_AM_CRYPTODUKE_CONST_NOTOK_ARCHITECTURE", "Problemes : Creation de l'architecture du module (dossiers, index.html, icones,...)");
define("_AM_CRYPTODUKE_CONST_NOTOK_XOOPS_VERSION", "Problemes : Creation du xoops_version.php");
define("_AM_CRYPTODUKE_CONST_NOTOK_INDEX_USER","Problemes : Creation du fichier index.php");
define("_AM_CRYPTODUKE_CONST_NOTOK_CLASS", "Problemes : Creation de la classe %s.php dans le dossier class");
define("_AM_CRYPTODUKE_CONST_NOTOK_CLASS_MENU", "Problemes : Creation de la classe menu.php dans le dossier class");
define("_AM_CRYPTODUKE_CONST_NOTOK_BLOCS", "Problemes : Creation des blocks dans le dossier blocks");
define("_AM_CRYPTODUKE_CONST_NOTOK_SQL", "Problemes : Creation du fichier mysql.sql dans le dossier sql");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_HEADER", "Problemes : Creation du fichier admin_header.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_MENU", "Problemes : Creation du fichier menu.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_INDEX", "Problemes : Creation du fichier index.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_PAGES", "Problemes : Creation du fichier %s.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_ABOUT", "Problemes : Creation du fichier about.php dans le dossier admin");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_LANGUAGE","Problemes : Creation du fichier admin.php dans le dossier language");
define("_AM_CRYPTODUKE_CONST_NOTOK_BLOCS_LANGUAGE","Problemes : Creation du fichier blocks.php dans le dossier language");
define("_AM_CRYPTODUKE_CONST_NOTOK_BLOCS_TEMPLATE","Problemes : Creation du fichier blocks.html dans le dossier templates/blocks");
define("_AM_CRYPTODUKE_CONST_NOTOK_MODINFO_LANGUAGE","Problemes : Creation du fichier modinfo.php dans le dossier language");
define("_AM_CRYPTODUKE_CONST_NOTOK_SEARCH","Problemes : Creation du fichier search.inc.php dans le dossier include");
define("_AM_CRYPTODUKE_CONST_NOTOK_COMS","Problemes : Creation des fichiers pour les commentaires");
define("_AM_CRYPTODUKE_CONST_NOTOK_INCLUDE_FUNCTIONS","Problemes : Creation du fichier functions.php dans le dossier include");
define("_AM_CRYPTODUKE_CONST_NOTOK_ADMIN_PERMISSIONS","Problemes : Creation du fichier permissions.php dans le dossier admin");

//Messages error CryptoDuke
define("_AM_CRYPTODUKE_CONST_NOTOK_CRYPT_ERROR","error");
define("_AM_CRYPTODUKE_CONST_NOTOK_CRYPT_SORRY_ERROR","Sorry but there was an error: ");
define("_AM_CRYPTODUKE_CONST_NOTOK_CRYPT_NO_VAL","Pas de valeur indiquee dans le champ de saisi 01");

//Messages CryptoDuke
define("_AM_CRYPTODUKE_CONST_OK_ENCODE","Encodage des donnees");
define("_AM_CRYPTODUKE_CONST_OK_CRYPTAGE","Cryptage des donnees : ");
define("_AM_CRYPTODUKE_CONST_OK_DECODE","Decodage des donnees");
define("_AM_CRYPTODUKE_CONST_OK_DECRYPTAGE","Decryptage des donnees : ");
define("_AM_CRYPTODUKE_CONST_OK_INTERFACE","Interface d'encodage/decodage CryptoDuke 1.1");
define("_AM_CRYPTODUKE_CONST_OK_CLEF_CRYPT","Clef de Cryptage:");
define("_AM_CRYPTODUKE_CONST_OK_DATA_CRYPTDECRYPT","Donnees a Crypter ou a DeCrypter:");
define("_AM_CRYPTODUKE_CONST_OK_ENCODER","Encoder les donnees");
define("_AM_CRYPTODUKE_CONST_OK_DECODER","Decoder les donnees");
define("_AM_CRYPTODUKE_CONST_OK_CLEF_CODE","Clef d'encodage :");
define("_AM_CRYPTODUKE_CONST_OK_DATA_CRYPT","Donnees cryptes :");
define("_AM_CRYPTODUKE_CONST_OK_DATA_DECRYPT","Donnees decryptes :");

//About.php
define("_AM_CRYPTODUKE_ABOUT_RELEASEDATE","Release Date");
define("_AM_CRYPTODUKE_ABOUT_AUTHOR","Author");
define("_AM_CRYPTODUKE_ABOUT_CREDITS","Credits");
define("_AM_CRYPTODUKE_ABOUT_README","Generale Information");
define("_AM_CRYPTODUKE_ABOUT_MANUAL","Aide");
define("_AM_CRYPTODUKE_ABOUT_LICENSE","Licence");
define("_AM_CRYPTODUKE_ABOUT_MODULE_STATUS","Status");
define("_AM_CRYPTODUKE_ABOUT_WEBSITE","Web Site");
define("_AM_CRYPTODUKE_ABOUT_AUTHOR_NAME","Author Name");
define("_AM_CRYPTODUKE_ABOUT_AUTHOR_WORD","Author Word");
define("_AM_CRYPTODUKE_ABOUT_CHANGELOG","Change Log");
define("_AM_CRYPTODUKE_ABOUT_MODULE_INFO","Module Info");
define("_AM_CRYPTODUKE_ABOUT_AUTHOR_INFO","Author Info");
define("_AM_CRYPTODUKE_ABOUT_DISCLAIMER","Disclaimer");
define("_AM_CRYPTODUKE_ABOUT_DISCLAIMER_TEXT","GPL Licensed - No Warranty");

?>