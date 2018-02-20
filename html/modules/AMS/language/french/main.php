<?php
// $Id: main.php 1019 2009-12-15 14:31:15Z kris_fr $
//%%%%%%		File Name index.php 		%%%%%
define("_AMS_NW_PRINTER","Version imprimable");
define("_AMS_NW_SENDSTORY","Envoyer cet article à un ami");
define("_AMS_NW_READMORE","Lire la suite ...");
define("_AMS_NW_COMMENTS","Commentaires ?");
define("_AMS_NW_ONECOMMENT","1 commentaire");
define("_AMS_NW_BYTESMORE", "%s octets en plus");
define("_AMS_NW_NUMCOMMENTS", "%s commentaires");
define("_AMS_NW_MORERELEASES", "Plus d'articles dans le sujet");

//%%%%%% Nom du fichier Submit.php %%%%%
define("_AMS_NW_SUBMITNEWS","Proposer un Article");
define("_AMS_NW_TITLE","Titre");
define("_AMS_NW_TOPIC","Sujet");
define("_AMS_NW_THESCOOP","Le scoop");
define("_AMS_NW_NOTIFYPUBLISH","Notifier par mail lors de la publication");
define("_AMS_NW_POST","Publier");
define("_AMS_NW_GO", "Ok");
define("_AMS_NW_THANKS","Merci pour votre participation."); //submission of news article

define("_AMS_NW_NOTIFYSBJCT","Des articles à publier sur le site"); // Notification mail subject
define("_AMS_NW_NOTIFYMSG","Hey ! Vous avez de nouvelles propositions d'articles pour votre site."); // Notification mail message

//%%%%%% Nom du fichier archive.php %%%%%
define("_AMS_NW_NEWSARCHIVES","Archives");
define("_AMS_NW_ARTICLES","Articles");
define("_AMS_NW_VIEWS","Lectures");
define("_AMS_NW_DATE","Date");
define("_AMS_NW_ACTIONS","Actions");
define("_AMS_NW_PRINTERFRIENDLY","Version imprimable");

define("_AMS_NW_THEREAREINTOTAL","Il y a %s article(s) au total");

// %S est votre nom de site
define("_AMS_NW_INTARTICLE","Article intéressant sur %s");
define("_AMS_NW_INTARTFOUND","Voici un article intéressant trouvé sur %s");

define("_AMS_NW_TOPICC","Sujet :");
define("_AMS_NW_URL","URL :");
define("_AMS_NW_NOSTORY","Désolé, l'article sélectionné n'existe pas.");

//%%%%%% Nom du fichier print.php %%%%%

define("_AMS_NW_URLFORSTORY","L'adresse de cet article est :");

//% S représente votre nom de site
define("_AMS_NW_THISCOMESFROM","Cet article provient de %s");

// Ajouté par Hervé
define("_AMS_NW_ATTACHEDFILES","Fichiers attachés : ");

define("_AMS_NW_MAJOR","des changements majeurs?");
define("_AMS_NW_STORYID", "Article ID");
define("_AMS_NW_VERSION", "Version");
define("_AMS_NW_SETVERSION", "Set Current Version");
define("_AMS_NW_VERSIONUPDATED", "Set Current Version à %s");
define("_AMS_NW_OVERRIDE", "Ignorer");
define("_AMS_NW_FINDVERSION", "Trouver la version");
define("_AMS_NW_REVISION", "Version");
define("_AMS_NW_MINOR", "révision mineure");
define("_AMS_NW_VERSIONDESC", "Choisissez le niveau de changement - si vous ne spécifiez pas cela, le texte ne mettra pas à jour!");
define("_AMS_NW_NOVERSIONCHANGE", "Pas de changement de version");
define("_AMS_NW_AUTO", "Auto");

define("_AMS_NW_RATEARTICLE", "Taux de l'article");
define("_AMS_NW_RATE", "Taux de l'article");
define("_AMS_NW_SUBMITRATING", "Soumettre Rating");
define("_AMS_NW_RATING_SUCCESSFUL", "Article évalué avec succés");
define("_AMS_NW_PUBLISHED_DATE", "Date de publication:");
define("_AMS_NW_POSTEDBY", "Auteur");
define("_AMS_NW_READS", "lectures");
define("_AMS_NW_AUDIENCE", "Public");
define("_AMS_NW_SWITCHAUTHOR", "Auteur de mise à jour?");

// Mises en garde
define("_AMS_NW_VERSIONSEXIST", "% s Version (s) avec des versions supérieures existent et se <strong> </ strong> être écrasées avec possibilité de restauration NO:");
define("_AMS_NW_AREYOUSUREOVERRIDE", "êtes-vous sûr de vouloir remplacer ces versions");
define("_AMS_NW_CONFLICTWHAT2DO", "Un article calculé avec le numéro de version existe <br /> Que voulez-vous faire? <br /> Override: Cette version est enregistré avec le numéro de version calculé et toutes les versions supérieures dans le même groupe de version (XX.XX.XX) seront supprimées <br /> Trouvez Version: laisser le systéme trouver la prochaine version disponible de la même version de groupe ");
define("_AMS_NW_VERSIONCONFLICT", "conflit de versions");
define("_AMS_NW_TRYINGTOSAVE", "tentative de sauvetage");

// Les messages d'erreur
define("_AMS_NW_ERROR", "Une erreur s'est produite");
define("_AMS_NW_RATING_FAILED", "Evaluation a échoué");
define("_AMS_NW_SAVEFAILED", "Sauver l'article a échoué");
define("_AMS_NW_TEXTSAVEFAILED", "Impossible d'enregistrer l'article texte");
define("_AMS_NW_VERSIONUPDATEFAILED", "Impossible de mettre à jour la version");
define("_AMS_NW_COULDNOTRESET", "Impossible de réinitialiser les versions");
define("_AMS_NW_COULDNOTUPDATEVERSION", "Impossible de mettre à jour à la version actuelle");

define("_AMS_NW_COULDNOTSAVERATING", "Impossible d'enregistrer des avis");
define("_AMS_NW_COULDNOTUPDATERATING", "Impossible de mettre à jour l'article des avis");

define("_AMS_NW_COULDNOTADDLINK", "Link ne peut pas être lié à l'article");
define("_AMS_NW_COULDNOTDELLINK", "Erreur - Lien pas supprimé");

define("_AMS_NW_CANNOTVOTESELF", "Auteur taux ne peut pas les articles");
define("_AMS_NW_ANONYMOUSVOTEDISABLED", "Anonyme avis handicapés");
define("_AMS_NW_ANONYMOUSHASVOTED", "Cette période d'enquête a déjà évalué cet article");
define("_AMS_NW_USERHASVOTED", "Vous avez déjà évalué cette article");

define("_AMS_NW_NOTALLOWEDAUDIENCE", "Vous n'êtes pas autorisé à lire% s niveau articles");
define("_AMS_NW_NOERRORSENCOUNTERED", "Pas d'erreurs rencontrées");

// Constantes supplémentaires
define("_AMS_NW_USERNAME", "Nom d'utilisateur");
define("_AMS_NW_ADDLINK", "Ajouter un Lien (s)");
define("_AMS_NW_DELLINK", "Supprimer le lien (s)");
define("_AMS_NW_RELATEDARTICLES", "Lectures recommandées");
define("_AMS_NW_SEARCHRESULTS", "Résultats de la recherche:");
define("_AMS_NW_MANAGELINK", "Liens");
define("_AMS_NW_DELVERSIONS", "Supprimer les versions en dessous de cette version");
define("_AMS_NW_DELALLVERSIONS", "Supprimer TOUTES les versions en dehors de cette version");
define("_AMS_NW_SUBMIT", "Valider");
define("_AMS_NW_RUSUREDELVERSIONS", "êtes-vous sûr de vouloir supprimer toutes les versions AU-DELA DE RESTAURATION! en dessous de cette version?");
define("_AMS_NW_RUSUREDELALLVERSIONS", "êtes-vous sûr de vouloir supprimer toutes les versions AU-DELA DE RESTAURATION! en dehors de cette version?");
define("_AMS_NW_EXTERNALLINK", "Lien externe");
define("_AMS_NW_ADDEXTERNALLINK", "Ajouter Lien externe");
define("_AMS_NW_PREREQUISITEARTICLES", "Pré-requis de lecture");
define("_AMS_NW_LINKTYPE", "type de lien");
define("_AMS_NW_SETTITLE", "Set Titre du lien");
define("_AMS_NW_BANNER", "Bannière / Sponsor");

define("_AMS_NW_NOTOPICS", "Pas de sujets existent - s'il vous plaît créer un sujet et définir des autorisations appropriées avant de soumettre un article");

define("_AMS_NW_TOTALARTICLES", "Total articles");

define("_AMS_MA_INDEX", "Index");
define("_AMS_MA_SUBTOPICS", "Sous-Rubriques pour");
define("_AMS_MA_PAGEBREAK", "PAGEBREAK");
define("_AMS_NW_POSTNEWARTICLE", "Poster un nouvel article");

/**
 * @translation     FRXOOPS (XOOPS France) <http://www.frxoops.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans BOM
 *
 * @version        2010-07
**/
?>