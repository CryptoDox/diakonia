<?php
// $Id: admin.php 1019 2009-12-15 14:31:15Z kris_fr $
//%%%%%%	Admin Module Name  Articles 	%%%%%

define("_AMS_AM_DBUPDATED","Base de données mise à jour avec succès !");
define("_AMS_AM_CONFIG","Configuration des articles");
define("_AMS_AM_AUTOARTICLES","Articles automatisés");
define("_AMS_AM_STORYID","ID de l'article");
define("_AMS_AM_TITLE","Titre");
define("_AMS_AM_TOPIC","Sujet");
define("_AMS_AM_ARTICLE","Article");
define("_AMS_AM_POSTER","Poster");
define("_AMS_AM_PROGRAMMED","Date/Heure programmées");
define("_AMS_AM_ACTION","Action");
define("_AMS_AM_EDIT","Modifier");
define("_AMS_AM_DELETE","Supprimer");
define("_AMS_AM_LAST10ARTS","Les %d derniers articles");
define("_AMS_AM_PUBLISHED","Publié le"); // Date de publication
define("_AMS_AM_GO","Ok!");
define("_AMS_AM_EDITARTICLE","Editer l'article");
define("_AMS_AM_POSTNEWARTICLE","Poster un nouvel article");
define("_AMS_AM_ARTPUBLISHED","Votre article a été publié !"); // mail
define("_AMS_AM_HELLO","Bonjour %s,"); // mail
define("_AMS_AM_YOURARTPUB","Votre article soumis sur notre site a été publié."); // mail
define("_AMS_AM_TITLEC","Titre:"); // mail
define("_AMS_AM_URLC","URL: "); //mail
define("_AMS_AM_PUBLISHEDC","Publié le : "); // mail
define("_AMS_AM_RUSUREDEL","Etes-vous sûr de vouloir supprimer cet article et tous ses commentaires ?");
define("_AMS_AM_YES","Oui");
define("_AMS_AM_NO","Non");
define("_AMS_AM_INTROTEXT","Texte de l'introduction");
define("_AMS_AM_EXTEXT","Suite du texte");
define("_AMS_AM_ALLOWEDHTML","HTML autorisé :");
define("_AMS_AM_DISAMILEY","Désactiver les émoticônes");
define("_AMS_AM_DISHTML","Désactiver le HTML");
define("_AMS_AM_APPROVE","Approuver");
define("_AMS_AM_MOVETOTOP", "Déplacer cet article au Top");
define("_AMS_AM_CHANGEDATETIME","Changer la date/heure de publication");
define("_AMS_AM_NOWSETTIME","C'est maintenant mis sur : %s"); // %s is datetime of publish
define("_AMS_AM_CURRENTTIME","Actuellement il est : %s");  // %s is the current datetime
define("_AMS_AM_SETDATETIME","Paramétrer la date/heure de publication");
define("_AMS_AM_MONTHC","Mois :");
define("_AMS_AM_DAYC","Jour :");
define("_AMS_AM_YEARC","Année :");
define("_AMS_AM_TIMEC","Heure :");
define("_AMS_AM_PREVIEW","Prévisualiser");
define("_AMS_AM_SAVE","Sauvegarder");
define("_AMS_AM_PUBINHOME","Publier en page d'accueil ?");
define("_AMS_AM_ADD","Ajouter");

//%%%%%% Administrative Nom du module Thèmes %%%%%

define("_AMS_AM_ADDMTOPIC","Ajouter un sujet principal");
define("_AMS_AM_TOPICNAME","Nom du sujet");
define("_AMS_AM_MAX40CHAR","(max: 40 caractères)");
define("_AMS_AM_TOPICIMG","Image du sujet");
define("_AMS_AM_IMGNAEXLOC","Image à placer dans %s");
define("_AMS_AM_FEXAMPLE","par exemple: games.gif");
define("_AMS_AM_ADDSUBTOPIC","Ajouter un sous-sujet");
define("_AMS_AM_IN","dans");
define("_AMS_AM_MODIFYTOPIC","Modifier le sujet");
define("_AMS_AM_MODIFY","Modifier");
define("_AMS_AM_PARENTTOPIC","Sujet parent");
define("_AMS_AM_SAVECHANGE","Enregistrer les modifications");
define("_AMS_AM_DEL","Supprimer");
define("_AMS_AM_CANCEL","Annuler");
define("_AMS_AM_WAYSYWTDTTAL", "ATTENTION : Etes-vous sûr de vouloir supprimer ce sujet et tous ses articles et commentaires ?");


// Ajouté dans Beta6
define("_AMS_AM_TOPICSMNGR","Gestionnaire de sujets");
define("_AMS_AM_PEARTICLES","Gestion des articles");
define("_AMS_AM_NEWSUB","Nouvelles propositions");
define("_AMS_AM_POSTED","Posté le");
define("_AMS_AM_GENERALCONF","Configuration générale");

// Ajouté en RC2
define("_AMS_AM_TOPICDISPLAY", "Afficher l'image du sujet ?");
define("_AMS_AM_TOPICALIGN","Position");
define("_AMS_AM_RIGHT","Droit");
define("_AMS_AM_LEFT","Gauche");

define("_AMS_AM_EXPARTS","Articles expirés");
define("_AMS_AM_EXPIRED","Expiré");
define("_AMS_AM_CHANGEEXPDATETIME","Changer la date/heure d'expiration");
define("_AMS_AM_SETEXPDATETIME","Paraméter la date/heure d'expiration");
define("_AMS_AM_NOWSETEXPTIME","C'est maintenant mis sur : %s");

// Ajouté en RC3
define("_AMS_AM_ERRORTOPICNAME","Vous devez entrer un nom de sujet!");
define("_AMS_AM_EMPTYNODELETE","Rien à supprimer !");

// Ajouté 240304 (Mithrandir)
define("_AMS_AM_GROUPPERM","Permissions des groupes");
define("_AMS_AM_SELFILE","Sélectionnez un fichier");

// Ajouté Novasmart en 2.42
define("_MULTIPLE_PAGE_GUIDE","Type [pagebreak] de partager à plusieurs pages");

// Ajouté par Hervé
define("_AMS_AM_UPLOAD_DBERROR_SAVE","Erreur pendant le rattachement d'un fichier à un article");
define("_AMS_AM_UPLOAD_ERROR","Erreur pendant le téléchargement du fichier vers le serveur");
define("_AMS_AM_UPLOAD_ATTACHFILE","Fichier(s) attaché(s)");
define("_AMS_AM_APPROVEFORM","Permission d'approuver");
define("_AMS_AM_SUBMITFORM","Permission de soumettre");
define("_AMS_AM_VIEWFORM","Permissions de consulter");
define("_AMS_AM_APPROVEFORM_DESC","Choisissez les groupes qui peuvent approuver les articles pour les sujets affichés");
define("_AMS_AM_SUBMITFORM_DESC","Choisissez les groupes qui peuvent soumettre des articles pour les sujets affichés");
define("_AMS_AM_VIEWFORM_DESC","Choisissez les groupes qui peuvent visualiser les sujets affichés");
define("_AMS_AM_DELETE_SELFILES","Supprimer les fichiers sélectionnés");
define("_AMS_AM_TOPIC_PICTURE","Télécharger l'image du sujet");
define("_AMS_AM_UPLOAD_WARNING","<strong>Attention, n'oubliez pas d'appliquer les permissions d'écriture au répertoire suivant : %s </strong>");

define("_AMS_AM_NEWS_UPGRADECOMPLETE","Mise à jour terminée");
define("_AMS_AM_NEWS_UPDATEMODULE","Veuillez mettre à jour les templates et les blocs");
define("_AMS_AM_NEWS_UPGRADEFAILED","La mise à jour a échoué");
define("_AMS_AM_NEWS_UPGRADE","Mise à jour");
define("_AMS_AM_ADD_TOPIC","Ajouter un sujet");
define("_AMS_AM_ADD_TOPIC_ERROR","Erreur, ce sujet existe déjà !");
define("_AMS_AM_ADD_TOPIC_ERROR1","ERREUR: Impossible de selectionner ce sujet comme sujet parent !");
define("_AMS_AM_SUB_MENU","Prendre ce sujet comme sous-menu");
define("_AMS_AM_SUB_MENU_YESNO","Sous-menu ?");
define("_AMS_AM_HITS","Hits");
define("_AMS_AM_CREATED","Crée");
define("_AMS_AM_COMMENTS","Commentaires");
define("_AMS_AM_VERSION", "Version");
define("_AMS_AM_PUBLISHEDARTICLES", "Articles publiés");
define("_AMS_AM_TOPICBANNER", "Bannière");
define("_AMS_AM_BANNERINHERIT","Hériter du parent");
define("_AMS_AM_RATING", "Note");
define("_AMS_AM_FILTER", "Filtrer");
define("_AMS_AM_SORTING", "options de tri");
define("_AMS_AM_SORT", "Tri");
define("_AMS_AM_ORDER", "ordonnance");
define("_AMS_AM_STATUS", "Status");
define("_AMS_AM_OF", "de");

define("_AMS_AM_MANAGEAUDIENCES", "Gérer les niveaux d'audience");
define("_AMS_AM_AUDIENCENAME", "Nom du Public");
define("_AMS_AM_ACCESSRIGHTS", "Droits d'accès");
define("_AMS_AM_LINKEDFORUM", "Lier Forum");
define("_AMS_AM_VERSIONCOUNT", "Versions");
define("_AMS_AM_AUDIENCEHASSTORIES", "% u articles de cette audience, s'il vous plaît choisir un nouveau public pour ces articles");
define("_AMS_AM_RUSUREDELAUDIENCE", "êtes-vous sûr de vouloir supprimer cette audience niveau complètement?");
define("_AMS_AM_PLEASESELECTNEWAUDIENCE", "S'il vous plaît Choisir remplacement Niveau");
define("_AMS_AM_AUDIENCEDELETED", "Audience supprimé avec succès");
define("_AMS_AM_ERROR_AUDIENCENOTDELETED", "Erreur - Audience non supprimé");
define("_AMS_AM_CANNOTDELETEDEFAULTAUDIENCE", "Erreur - Impossible de supprimer le défaut public");

define("_AMS_AM_NOTOPICSELECTED", "Pas de thème choisi");
define("_AMS_AM_SUBMIT", "Valider");
define("_AMS_AM_ERROR_REORDERERROR", "Erreur - des erreurs se sont produites au cours de réorganisation");
define("_AMS_AM_REORDERSUCCESSFUL", "Sujets de nouveau");

define("_AMS_AM_NONE", "No Image");
define("_AMS_AM_AUTHOR", "Avatar de l'auteur");

define("_AMS_AM_SPOT_ADD", "Ajouter Spotlight Mini Bloc");
define("_AMS_AM_SPOT_EDITBLOCK", "Modifier les paramètres de Bloc");
define("_AMS_AM_SPOT_NAME", "Nom");
define("_AMS_AM_SPOT_SHOWIMAGE", "Voir image");
define("_AMS_AM_SPOT_SHOWIMAGE_DESC", "Sélectionnez une image pour afficher ou mettre à démontrer sujet ou auteur image avatar");
define("_AMS_AM_SPOT_WEIGHT", "Poids");
define("_AMS_AM_SPOT_DISPLAY", "Affichage");
define("_AMS_AM_SPOT_MAIN", "Main");
define("_AMS_AM_SPOT_MINI", "Mini");
define("_AMS_AM_SPOTLIGHT", "Spotlight");
define("_AMS_AM_WEIGHT", "Poids");
define("_AMS_AM_SPOT_SAVESUCCESS", "Spotlight avec succès enregistrés");
define("_AMS_AM_SPOT_DELETESUCCESS", "Spotlight supprimé avec succès");
define("_AMS_AM_RUSUREDELSPOTLIGHT", "êtes-vous sûr de vouloir supprimer cette section?");

define("_AMS_AM_SPOT_LATESTARTICLE", "Dernier article");
define("_AMS_AM_SPOT_LATESTINTOPIC", "Dernières dans la rubrique");
define("_AMS_AM_SPOT_SPECIFICARTICLE", "article spécifique");
define("_AMS_AM_SPOT_NOIMAGE", "No Image");
define("_AMS_AM_SPOT_MODE_SELECT", "Spotlight Mode");
define("_AMS_AM_SPOT_SPECIFYIMAGE", "Spécifier l'image");
define("_AMS_AM_SPOT_TOPICIMAGE", "Image de thème");
define("_AMS_AM_SPOT_AUTHORIMAGE", "Auteur Avatar");
define("_AMS_AM_SPOT_IMAGE", "Image");
define("_AMS_AM_SPOT_AUTOTEASER", "Introduction automatique");
define("_AMS_AM_SPOT_MAXLENGTH", "longueur maximale de l'auto-Teaser");
define("_AMS_AM_SPOT_TEASER", "Introduction Texte");
define("_AMS_AM_SPOT_TOPIC_DESC", "Si dans la rubrique Dernière est sélectionné, quel sujet doit être choisi ? ");
define("_AMS_AM_SPOT_ARTICLE_DESC", "Si l'article spécifique est sélectionné, l'article qui doit être affiché? ");
define("_AMS_AM_SPOT_CUSTOM", "Custom");

define("_AMS_AM_PREFERENCES", "Préférences");
define("_AMS_AM_GOMOD", "Aller au module");
define("_AMS_AM_ABOUT", "A propos");
define("_AMS_AM_MODADMIN", "Module Administration");

//SEO
define("_AMS_AM_SEO_SUBMITFORM", "Configuration SEO");
define("_AMS_AM_SEO_FRIENDLYURL", "Détails");
define("_AMS_AM_SEO_ENABLE", "Activer");
define("_AMS_AM_SEO_URLTEMPLATE", "Personnaliser URL Template");
define("_AMS_AM_SEO_VALIDTAG", "Tag valide");

/**
 * @translation     FRXOOPS (XOOPS France) <http://www.frxoops.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans BOM
 *
 * @version        2010-07
**/ 
?>