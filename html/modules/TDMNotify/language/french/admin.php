<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */

define('_AM_NOTIFY_ADD','Ajouter');
define('_AM_NOTIFY_EDITER','Editer');
define('_AM_NOTIFY_DELETE','Supprimer');
define('_AM_NOTIFY_BASESURE','ATTENTION: vous ête sur de vouloir supprimer?');
define('_AM_NOTIFY_BASEOK','Base de donnée mise à jour');
define('_AM_NOTIFY_PAGEERROR','Erreur: vous devez créer une page');
define('_AM_NOTIFY_BLOCKERROR','Erreur: vous devez créer un formulaire');

define('_AM_NOTIFY_OPTIONDESC',"Aucun champ n'est enregistrer pour le moment.");

define('_AM_NOTIFY_MANAGE_INDEX','Index du module');
define('_AM_NOTIFY_MANAGE_NOTIF','Gestion des notifications');
define("_AM_NOTIFY_THEREARE_NOTIF","Il y a <span style='color: #ff0000; font-weight: bold'>%s</span> notifications dans la Base de donnée");
define("_AM_NOTIFY_THEREARE_NOTIF_WAITING","Il y a <span style='color: #ff0000; font-weight: bold'>%s</span> notifications en attente...");
define('_AM_NOTIFY_MANAGE_BLOCK','Gestion des formulaires');
define("_AM_NOTIFY_THEREARE_BLOCK","Il y a <span style='color: #ff0000; font-weight: bold'>%s</span> formulaires dans la Base de donnée");
define('_AM_NOTIFY_MANAGE_PERM','Gestion des permissions');
define('_AM_NOTIFY_MANAGE_PERM2','Permissions d\'afficher');
define('_AM_NOTIFY_MANAGE_PLUG','Gestion du pluging');
define('_AM_NOTIFY_MANAGE_PLUGERROR','Veuillez copier le fichier "xoops_plugins/function.xoNotify.php" dans Racine de votre site "/class/smarty/xoops_plugins/"');
define('_AM_NOTIFY_MANAGE_PLUGOK','Pluging installé');
define('_AM_NOTIFY_MANAGE_UPDATE','Mise a jour');
define('_AM_NOTIFY_MANAGE_ABOUT','A propos');
define('_AM_NOTIFY_MANAGE_HELP','Aide');


define('_AM_NOTIFY_TITLE','Titre');
define('_AM_NOTIFY_TEXT','Texte');
define("_AM_NOTIFY_UPLOAD","Uploader");
define("_AM_NOTIFY_PATH","Fichier présent dans %s");
define("_AM_NOTIFY_IMG","Image utilisé");
define('_AM_NOTIFY_STYLE','Afficher');
define('_AM_NOTIFY_PAGE','ID unique si multiple dans une page<br /> pour un Foreach entrer $i++');

define('_AM_NOTIFY_STYLE_TEXT','Texte');
define('_AM_NOTIFY_STYLE_IMG','Image');
define('_AM_NOTIFY_STYLE_BUTTON','boutton');

define('_AM_NOTIFY_ALT','Balise ALT (affiché au survol de la souris)');

define('_AM_NOTIFY_TYPE','Type de champ');
define('_AM_NOTIFY_SIZE','Taille du champ');
define('_AM_NOTIFY_LIMIT','Limite du champ');
define('_AM_NOTIFY_OPTION','Option du select (séparé par |)');
define('_AM_NOTIFY_FORM','Champ de formulaire');
define("_AM_NOTIFY_LABEL_DESC","- {UNAME} imprime le pseudo d'utilisateur;<br />- {EMAIL} imprime l'adresse mail;<br />- {NAME} imprime le nom réel de l'utilisateur;<br />- {FROM} imprime la localisation de l'utilisateur;<br />- {INFO} imprime les infos;<br />- {ICQ} imprime l'adresse ICQ;<br />- {AIM} imprime l'adresse AIM;<br />- {YIM} imprime l'adresse YIM;<br />- {MSNM} imprime l'adresse MSN;<br />- {OCCUP} imprime la profession");
define('_AM_NOTIFY_LABEL','Texte par défaut');

define("_AM_NOTIFY_FORMSUREDEL", "Êtes-vous sûr de vouloir supprimer : <b><span style='color : Red'> %s </span></b>");

define('_AM_NOTIFY_STYLEFORM','Style du formulaire');

define('_AM_NOTIFY_ACTION','Action');

//notify
define('_AM_NOTIFY_NOTIF_READ','Résolus');
define('_AM_NOTIFY_NOTIF_POSTER','Poster');
define('_AM_NOTIFY_NOTIF_URL','URL');
define('_AM_NOTIFY_NOTIF_FORM','Formulaire');
define('_AM_NOTIFY_UPDATE','Marquer comme Résolus');
define('_AM_NOTIFY_PLUGSTYLE','Style');

define('_AM_NOTIFY_SUBJECT','Formulaire de soumission');


//block.php
define('_AM_NOTIFY_BLOCK_BLOCK','Formulaires');
define('_AM_NOTIFY_BLOCK_FORM','Champs de formulaire');
define('_AM_NOTIFY_PLUGPAGE','Page affichés');
define('_AM_NOTIFY_PLUGDISPLAY','Afficher');
define('_AM_NOTIFY_PLUG_DESC','Utiliser ce code dans vos templates ou votre thème pour afficher le formulaire');
define('_AM_NOTIFY_PLUGSTYLE','Style');

//plug.php
define('_AM_NOTIFY_PLUGDEF','Page par défaut');
define('_AM_NOTIFY_PLUGNONE','AUCUN');
define('_AM_NOTIFY_PLUGPAGE','Page affichés');
define('_AM_NOTIFY_PLUGDISPLAY','Afficher');
define('_AM_NOTIFY_PLUGALL','TOUT');
define('_AM_NOTIFY_PLUGTEXT','Texte');
define('_AM_NOTIFY_PLUGTABS','Tabs');
define('_AM_NOTIFY_PLUGSELECT','Select');
define('_AM_NOTIFY_PLUG_DESC','Utiliser ce code dans vos templates ou votre thème pour afficher les blocks');
define('_AM_NOTIFY_PLUGSTYLE','Style');
define('_AM_NOTIFY_PLUGSTYLE_DESC','Pour modifier le texte éditer (TDMSpot/menus/none/style.css)<br />Pour modifier le select éditer (TDMSpot/menus/select/style.css)');
define('_AM_NOTIFY_PLUGVAR','Variable a récupérer sans <{ }>, si aucune mettre 0');

//About (about.php)
define("_AM_ABOUT_RELEASEDATE","Release Date");
define("_AM_ABOUT_AUTHOR","Author");
define("_AM_ABOUT_CREDITS","Crédits");
define("_AM_ABOUT_README","Général Info");
define("_AM_ABOUT_MANUAL","Help");
define("_AM_ABOUT_LICENSE","License");
define("_AM_ABOUT_MODULE_STATUS","Status");
define("_AM_ABOUT_WEBSITE","Web Site");
define("_AM_ABOUT_AUTHOR_NAME","Author Name");
define("_AM_ABOUT_AUTHOR_WORD","Author Word");
define("_AM_ABOUT_CHANGELOG","Change Log");
define("_AM_ABOUT_MODULE_INFO","Module Info");
define("_AM_ABOUT_AUTHOR_INFO","Author Info");
define("_AM_ABOUT_DISCLAIMER","Disclaimer");
define("_AM_ABOUT_DISCLAIMER_TEXT","GPL Licensed - No Warranty");
?>
