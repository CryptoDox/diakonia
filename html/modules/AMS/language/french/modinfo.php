<?php
// $Id: modinfo.php 1019 2009-12-15 14:31:15Z kris_fr $
// Module Info

// The name of this module
define("_AMS_MI_NEWS_NAME","Articles");

// A brief description of this module
define("_AMS_MI_NEWS_DESC","Créer une section d'articles, où les utilisateurs peuvent poster des articles/commentaires.");

// Names of blocks for this module (Not all module has blocks)
define("_AMS_MI_NEWS_BNAME1","Sujets d'articles");
define("_AMS_MI_NEWS_BNAME3","Article du jour");
define("_AMS_MI_NEWS_BNAME4","Top articles");
define("_AMS_MI_NEWS_BNAME5","Articles récents");
define("_AMS_MI_NEWS_BNAME6","Modération des articles");
define("_AMS_MI_NEWS_BNAME7","Navigation dans les sujets");
define("_AMS_MI_NEWS_BNAME8","Auteurs les plus actifs");
define("_AMS_MI_NEWS_BNAME9","Auteurs les plus lus");
define("_AMS_MI_NEWS_BNAME10","Auteurs les mieux notés");
define("_AMS_MI_NEWS_BNAME11","Articles les mieux notés");
define("_AMS_MI_NEWS_BNAME12","AMS Spotlight");

// Sub menus in main menu block
define("_AMS_MI_NEWS_SMNAME1","Proposer un article");
define("_AMS_MI_NEWS_SMNAME2","Archives");

// Names of admin menu items
define("_AMS_MI_NEWS_ADMENU2", "Sujets");
define("_AMS_MI_NEWS_ADMENU3", "Articles");
define("_AMS_MI_NEWS_GROUPPERMS", "Permissions");

// Title of config items
define("_AMS_MI_STORYHOME", "Combien d'article(s) sur la page principale ?");
define("_AMS_MI_STORYCOUNTTOPIC", "Sélectionnez le nombre d'articles à afficher sur un sujet");
define("_AMS_MI_NOTIFYSUBMIT", "Notifier par mail d'une nouvelle proposition ?");
define("_AMS_MI_DISPLAYNAV", "Afficher la boîte de navigation en haut de chaque page ?");
define("_AMS_MI_AUTOAPPROVE","Approuver automatiquement les nouveaux articles sans l'intervention d'un administrateur ?");
define("_AMS_MI_ALLOWEDSUBMITGROUPS", "Groupes pouvant soumettre des articles");
define("_AMS_MI_ALLOWEDAPPROVEGROUPS", "Groupes pouvant approuver des articles");
define("_AMS_MI_NEWSDISPLAY", "Mise en page des articles");
define("_AMS_MI_NAMEDISPLAY","Nom d'auteur à utiliser");
define("_AMS_MI_COLUMNMODE","Colonnes");
define("_AMS_MI_STORYCOUNTADMIN","Nombre d'articles à afficher dans l'administration : ");
define("_AMS_MI_UPLOADFILESIZE", "Taille maximale des fichiers joints en Ko (1048576 = 1 Méga)");
define("_AMS_MI_UPLOADGROUPS","Groupes autorisés à joindre des fichiers aux articles");
define("_AMS_MI_MAXITEMS", "Maximum d'articles");
define("_AMS_MI_MAXITEMDESC", "");


// Description of each config itemsCe controle
define("_AMS_MI_STORYHOMEDSC", "");
define("_AMS_MI_NOTIFYSUBMITDSC", "");
define("_AMS_MI_DISPLAYNAVDSC", "");
define("_AMS_MI_AUTOAPPROVEDSC", "");
define("_AMS_MI_ALLOWEDSUBMITGROUPSDESC", "Les groupes sélectionnés seront autorisés à soumettre des articles");
define("_AMS_MI_ALLOWEDAPPROVEGROUPSDESC", "Les groupes sélectionnés seront autorisés à approuver les nouveaux articles");
define("_AMS_MI_NEWSDISPLAYDESC", "Le mode Classique affiche tous les nouveaux articles triés par date de publication. Le mode Articles par sujets groupera les articles par sujet avec le dernier article développé et les autres avec juste le titre");
define("_AMS_MI_ADISPLAYNAMEDSC", "Permet de choisir sous quelle forme le nom de l'auteur doit être affiché");
define("_AMS_MI_COLUMNMODE_DESC","Choisissez le nombre de colonnes à utiliser pour afficher les articles (cette option n'est utilisable qu'avec le mode d'affichage classique");
define("_AMS_MI_STORYCOUNTADMIN_DESC","");
define("_AMS_MI_STORYCOUNTTOPIC_DESC","");
define("_AMS_MI_UPLOADFILESIZE_DESC","");
define("_AMS_MI_UPLOADGROUPS_DESC","Choisissez les groupes qui peuvent télécharger vers le serveur");

// Name of config item values
define("_AMS_MI_NEWSCLASSIC", "Classique");
define("_AMS_MI_NEWSBYTOPIC", "Articles par sujets");
define("_AMS_MI_DISPLAYNAME1", "Pseudo");
define("_AMS_MI_DISPLAYNAME2", "Nom complet");
define("_AMS_MI_DISPLAYNAME3", "Aucun");
define("_AMS_MI_UPLOAD_GROUP1","Editeurs et Approbateurs");
define("_AMS_MI_UPLOAD_GROUP2","Approbateurs uniquement");
define("_AMS_MI_UPLOAD_GROUP3","Téléchargement désactivé");
define("_AMS_MI_INDEX_NAME", "Nom de l'Index");
define("_AMS_MI_INDEX_DESC", "Il sera affiché dans en partie supérieure du sujet et de l'article");

// Text for notifications

define("_AMS_MI_NEWS_GLOBAL_NOTIFY", "Globale");
define("_AMS_MI_NEWS_GLOBAL_NOTIFYDSC", "Options de notification globale des articles.");

define("_AMS_MI_NEWS_STORY_NOTIFY", "Articles");
define("_AMS_MI_NEWS_STORY_NOTIFYDSC", "Options de notification s'appliquant à l'article actuel");

define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFY", "Nouveau sujet");
define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYCAP", "Notifiez-moi quand un nouveau sujet est créé.");
define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYDSC", "Recevoir une notification quand un nouveau sujet est créé.");
define("_AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel article");

define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFY", "Nouvel article proposé");
define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYCAP", "Notifiez-moi lorsqu'un nouvel article est proposé (attente d'être approuvé).");
define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYDSC", "Recevoir une notification lorsqu'un nouvel article est proposé (attente d'être approuvé).");
define("_AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel article proposé");

define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFY", "Nouvel article");
define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYCAP", "Notifiez-moi quand un nouvel article est posté.");
define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYDSC", "Recevoir une notification quand un nouvel article est posté.");
define("_AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel article");

define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFY", "Article approuvé");
define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFYCAP", "Notifiez-moi quand cet article est approuvé.");
define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFYDSC", "Recevoir une notification quand cet article est approuvé.");
define("_AMS_MI_NEWS_STORY_APPROVE_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Article approuvé");

define("_AMS_MI_RESTRICTINDEX", "Restreindre les sujets sur la page d'index ?");
define("_AMS_MI_RESTRICTINDEXDSC", "Si l'option est à Oui, les utilisateurs ne verront que les articles pour lesquels ils ont les permissions de lecture");

define("_AMS_MI_ANONYMOUS_VOTE", "Activer le vote des Anonymes");
define("_AMS_MI_ANONYMOUS_VOTE_DESC", "Si Oui, les utilisateurs anonymes peuvent voter");

define("_AMS_MI_AUDIENCE", "Audience");

define("_AMS_MI_SPOTLIGHT", "Spotlight");
define("_AMS_MI_SPOTLIGHT_ITEMS", "Spotlight Article Candidats");
define("_AMS_MI_SPOTLIGHT_ITEMS_DESC", "C'est le nombre d'articles qui seront inscrites sous le feu des projecteurs en tant que page de configuration de choix pour l'article en lumi&#232;re");

define("_AMS_MI_EDITOR", "Editeur par défaut");
define("_AMS_MI_EDITOR_DESC", "");
define("_AMS_MI_EDITOR_DEFAULT", "Xoops Default");
define("_AMS_MI_EDITOR_DHTML","DHTML");
define("_AMS_MI_EDITOR_HTMLAREA","HtmlArea Editor");
define("_AMS_MI_EDITOR_FCK","FCK WYSIWYG Editor");
define("_AMS_MI_EDITOR_KOIVI","Koivi WYSIWYG Editor");
define("_AMS_MI_EDITOR_TINYMCE","TinyMCE WYSIWYG Editor");

define("_AMS_MI_EDITOR_USER_CHOICE", "Choix des éditeurs disponibles");
define("_AMS_MI_EDITOR_USER_CHOICE_DESC", "");

define("_AMS_MI_EDITOR_CHOICE", "Editeurs");
define("_AMS_MI_EDITOR_CHOICE_DESC", "Choix des éditeurs permis aux utilisateurs");

define("_AMS_MI_SPOTLIGHT_TEMPLATE","Spotlight Templates");
define("_AMS_MI_SPOTLIGHT_TEMPLATE_DESC","quel template pour le spotlight block");

define("_AMS_MI_ABOUT", "Au sujet de...");
define("_AMS_MI_MIME_TYPES","Types MIME");


/**
 * @translation     FRXOOPS (XOOPS France) <http://www.frxoops.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans BOM
 *
 * @version        2010-07
**/
?>