<?php
// $Id: admin.php 677 2009-08-20 15:58:21Z dugris $
//%%%%%%        File Name  index.php           %%%%%
define ("_AM_NEWBB_FORUMCONF", "Configuration des forums");
define ("_AM_NEWBB_ADDAFORUM", "Ajouter un forum");
define ("_AM_NEWBB_SYNCFORUM", "Synchronisation");
define ("_AM_NEWBB_REORDERFORUM", "Organisation");
define ("_AM_NEWBB_FORUM_MANAGER", "Forums");
define ("_AM_NEWBB_PRUNE_TITLE", "Purges");
define ("_AM_NEWBB_CATADMIN", "Cat&#233;gories");
define ("_AM_NEWBB_GENERALSET", "Param&#232;tres du module");
define ("_AM_NEWBB_MODULEADMIN", "Administration :");
define ("_AM_NEWBB_HELP", "Aide");
define ("_AM_NEWBB_ABOUT","A propos");
define ("_AM_NEWBB_BOARDSUMMARY", "Statistiques");
define ("_AM_NEWBB_PENDING_POSTS_FOR_AUTH", "Contributions en attente de validation");
define ("_AM_NEWBB_POSTID", "N° de contribution");
define ("_AM_NEWBB_POSTDATE", "Date de publication");
define ("_AM_NEWBB_POSTER", "Publier");
define ("_AM_NEWBB_TOPICS", "Sujets");
define ("_AM_NEWBB_SHORTSUMMARY", "Sommaire");
define ("_AM_NEWBB_TOTALPOSTS", "Nombre de contributions");
define ("_AM_NEWBB_TOTALTOPICS", "Nombre de sujets");
define ("_AM_NEWBB_TOTALVIEWS", "Nombre de lectures");
define ("_AM_NEWBB_BLOCKS", "Blocs");
define ("_AM_NEWBB_SUBJECT", "Sujet");
define ("_AM_NEWBB_APPROVE", "Approuver cette proposition");
define ("_AM_NEWBB_APPROVETEXT", "Contenu de cet enregistrement");
define ("_AM_NEWBB_POSTAPPROVED","La proposition a &#233;t&#233; approuv&#233;e");
define ("_AM_NEWBB_POSTNOTAPPROVED","La proposition n&#39;a pas &#233;t&#233; approuv&#233;e");
define ("_AM_NEWBB_POSTSAVED","La contribution a &#233;t&#233; sauvegard&#233;e");
define ("_AM_NEWBB_POSTNOTSAVED","La contribution n&#39;a pas &#233;t&#233; sauvegard&#233;e");

define ("_AM_NEWBB_TOPICAPPROVED","Le sujet a &#233;t&#233; approuv&#233;");
define ("_AM_NEWBB_TOPICNOTAPPROVED","le sujet n&#39;a pas &#233;t&#233; approuv&#233;");
define ("_AM_NEWBB_TOPICID","Sujet N°");
define ("_AM_NEWBB_ORPHAN_TOPICS_FOR_AUTH","Autorisation des sujets non approuv&#233;s");


define ('_AM_NEWBB_DEL_ONE', 'Effacer seulement ce message');
define ('_AM_NEWBB_POSTSDELETED', 'S&#233;lection de la proposition &#224; effacer.');
define ("_AM_NEWBB_NOAPPROVEPOST", "Il n&#39;y a aucune contribution en attente d&#39;approbation pour le moment.");
define ('_AM_NEWBB_SUBJECTC', 'Sujet :');
define ('_AM_NEWBB_MESSAGEICON', 'Ic&#244;ne du message :');
define ('_AM_NEWBB_MESSAGEC', 'Message :');
define ('_AM_NEWBB_CANCELPOST', 'Annuler votre contribution');
define ('_AM_NEWBB_GOTOMOD','Aller au module');

define('_AM_NEWBB_PREFERENCES','Pr&#233;f&#233;rences du module');
define('_AM_NEWBB_POLLMODULE','Module Xoops de sondage ');
define('_AM_NEWBB_POLL_OK','Pr&#234;t &#224; &#234;tre utilis&#233;');
define('_AM_NEWBB_GDLIB1','Librairie GD1 :');
define('_AM_NEWBB_GDLIB2','Librairie GD2 :');
define('_AM_NEWBB_AUTODETECTED','Autod&#233;tection : ');
define('_AM_NEWBB_AVAILABLE','Valide');
define('_AM_NEWBB_NOTAVAILABLE','<font color="red">Non valide</font>');
define('_AM_NEWBB_NOTWRITABLE','<font color="red">Non ouvert en &#233;criture</font>');
define('_AM_NEWBB_IMAGEMAGICK','Image MagicK');
define('_AM_NEWBB_IMAGEMAGICK_NOTSET','Non param&#233;tr&#233;');
define('_AM_NEWBB_ATTACHPATH','Chemin de stockage des pi&#232;ces jointes');
define('_AM_NEWBB_THUMBPATH','Chemin des miniatures d&#39;images attach&#233;es');
//define('_AM_NEWBB_RSSPATH','Chemin du filet RSS');
define('_AM_NEWBB_REPORT','Posts rapport&#233;s');
define('_AM_NEWBB_REPORT_PENDING','Rapports en attente');
define('_AM_NEWBB_REPORT_PROCESSED','Rapports trait&#233;s');

define('_AM_NEWBB_CREATETHEDIR','Le cr&#233;er');
define('_AM_NEWBB_SETMPERM','Param&#232;trer les permissions');
define('_AM_NEWBB_DIRCREATED','Le r&#233;pertoire a &#233;t&#233; cr&#233;&#233;');
define('_AM_NEWBB_DIRNOTCREATED','Le r&#233;pertoire ne peut pas &#234;tre cr&#233;&#233;');
define('_AM_NEWBB_PERMSET','Les permissions ont &#233;t&#233; param&#232;tr&#233;es');
define('_AM_NEWBB_PERMNOTSET','Les permissions ne peuvent pas &circ;tre param&#232;tr&#233;es');

define('_AM_NEWBB_DIGEST',"Notification des sommaires");
define('_AM_NEWBB_DIGEST_PAST','<font color="red">devait &#234;tre communiqu&#233; il y a %d minutes</font>');
define('_AM_NEWBB_DIGEST_NEXT',"Demande &#224; &#234;tre envoy&#233; &#224; l&#39;ext&#233;rieur dans %d minutes");
define('_AM_NEWBB_DIGEST_ARCHIVE',"Archive des sommaires");
define('_AM_NEWBB_DIGEST_SENT','Sommaires op&#233;r&#233;s');
define('_AM_NEWBB_DIGEST_FAILED','Sommaires NON op&#233;r&#233;s');

// admin_forum_manager.php
define ("_AM_NEWBB_NAME", "Nom");
define("_AM_NEWBB_CREATEFORUM","Cr&#233;er un forum");
define("_AM_NEWBB_EDIT","Modifier");
define("_AM_NEWBB_CLEAR","Effacer");
define ("_AM_NEWBB_DELETE", "Effacer");
define ("_AM_NEWBB_ADD", "Ajouter");
define ("_AM_NEWBB_MOVE", "D&#233;placer");
define ("_AM_NEWBB_ORDER", "Ordre");
define ("_AM_NEWBB_TWDAFAP", "Note : Ceci supprimera toutes les contributions du forum.<br> <br> AVERTISSEMENT : Etes vous certain de vouloir effacer ce forum ?");
define ("_AM_NEWBB_FORUMREMOVED", "le forum a &#233;t&#233; &#233;ffac&#233;.");
define ("_AM_NEWBB_CREATENEWFORUM", "Cr&#233;er un nouveau forum");
define ("_AM_NEWBB_EDITTHISFORUM", "Editer le forum :");
define ("_AM_NEWBB_SET_FORUMORDER", "Param&#232;tres de position du forum :");
define ("_AM_NEWBB_ALLOWPOLLS", "Autoriser les sondages :");
define ("_AM_NEWBB_ATTACHMENT_SIZE", "Taille maximum en kb :");
define ("_AM_NEWBB_ALLOWED_EXTENSIONS", "Autoriser les extensions :<span style='font-size: xx-small; font-weight: normal; display: block;'>&#39;*&#39; Indique pas de limitation.<br /> S&#233;parez les extensions par &#39;|&#39;</span>");
define ("_AM_NEWBB_ALLOW_ATTACHMENTS", "Autoriser les pi&#232;ces jointes :");
define ("_AM_NEWBB_ALLOWHTML", "Autoriser le language HTML :");
define ("_AM_NEWBB_YES", "Oui");
define ("_AM_NEWBB_NO", "Non");
define ("_AM_NEWBB_ALLOWSIGNATURES", "Autoriser les signatures :");
define ("_AM_NEWBB_HOTTOPICTHRESHOLD", "Seuil des sujets dit chauds :");
//define ("_AM_NEWBB_POSTPERPAGE", "Nombre de contributions par page: <span style='font-size: xx-small; font-weight: normal; display: block;'>(D&#233;fini le nombre de contributions<br /> par sujet qui seront<br /> affich&#233;es par page)</span>");
//define ("_AM_NEWBB_TOPICPERFORUM", "Nombre de sujets par forum: <span style='font-size: xx-small; font-weight: normal; display: block;'>(D&#233;fini le nombre de sujets<br /> par forum qui seront<br /> affich&#233;s sur la page d'un forum)</span>");
//define ("_AM_NEWBB_SHOWNAME", "Remplacer les noms d'utilisateurs par leurs noms r&#233;els:");
//define ("_AM_NEWBB_SHOWICONSPANEL", "Afficher le panneau des ic&#244;nes :");
//define ("_AM_NEWBB_SHOWSMILIESPANEL", "Afficher le panneau des emoticones:");
define("_AM_NEWBB_MODERATOR_REMOVE","Enlever le mod&#233;rateur courant");
define("_AM_NEWBB_MODERATOR_ADD","Ajouter des mod&#233;rateurs");
define("_AM_NEWBB_ALLOW_SUBJECT_PREFIX", "Allouer un pr&#233;fixe de sujet pour les articles");
define("_AM_NEWBB_ALLOW_SUBJECT_PREFIX_DESC", "Ceci alloue un pr&#233;fixe, qui sera ajout&#233; au sujet de l&#39;article");


// admin_cat_manager.php

define ("_AM_NEWBB_SETCATEGORYORDER", "Param&#232;tres de position de la cat&#233;gorie :");
define ("_AM_NEWBB_ACTIVE","Actif");
define ("_AM_NEWBB_INACTIVE","Inactif");
define ("_AM_NEWBB_STATE", "Etat :");
define ("_AM_NEWBB_CATEGORYDESC", "Description de la cat&#233;gorie :");
define ("_AM_NEWBB_SHOWDESC", "Afficher la description ?");
define ("_AM_NEWBB_IMAGE","Image :");
//define ("_AM_NEWBB_SPONSORIMAGE", "Image du sponsor:");
define ("_AM_NEWBB_SPONSORLINK", "Lien du sponsor :");
define ("_AM_NEWBB_DELCAT", "Effacer la cat&#233;gorie");
define ("_AM_NEWBB_WAYSYWTDTTAL", "Note : Ceci ne supprimera pas les forums situ&#233;s sous la cat&#233;gorie, pour ce faire vous devez utiliser la section Editer un forum.<br /><br />AVERTISSEMENT : Etes vous certain de vouloir effacer cette cat&#233;gorie ?");



//%%%%%%        Nom du dossier admin_forums.php           %%%%%
define ("_AM_NEWBB_FORUMNAME", "Nom du forum :");
define ("_AM_NEWBB_FORUMDESCRIPTION", "Description du forum :");
define ("_AM_NEWBB_MODERATOR", "Mod&#233;rateur(s) :");
define ("_AM_NEWBB_REMOVE", "Supprimer");
define ("_AM_NEWBB_CATEGORY", "Cat&#233;gorie :");
define ("_AM_NEWBB_DATABASEERROR", "Erreur dans la base de donn&#233;es");
define ("_AM_NEWBB_CATEGORYUPDATED", "La cat&#233;gorie a &#233;t&#233; mise &#224; jour.");
define ("_AM_NEWBB_EDITCATEGORY", "Editer la cat&#233;gorie :");
define ("_AM_NEWBB_CATEGORYTITLE", "Titre de la cat&#233;gorie :");
define ("_AM_NEWBB_CATEGORYCREATED", "la cat&#233;gorie a &#233;t&#233; cr&#233;&#233;e.");
define ("_AM_NEWBB_CREATENEWCATEGORY", "Cr&#233;er une nouvelle cat&#233;gorie");
define ("_AM_NEWBB_FORUMCREATED", "Le forum a &#233;t&#233; cr&#233;&#233;.");
define ("_AM_NEWBB_ACCESSLEVEL", "Niveau d&#39;acc&#232;s :");
define ("_AM_NEWBB_CATEGORY1", "Cat&#233;gorie");
define ("_AM_NEWBB_FORUMUPDATE", "les param&#232;tres du forum ont &#233;t&#233; mis &#224; jour");
define ("_AM_NEWBB_FORUM_ERROR","ERREUR : Erreur de param&#233;trage de forum");
define ("_AM_NEWBB_CLICKBELOWSYNC", "Cliquer sur le bouton de synchronisation autant de fois qu&#39;il vous plaira en haut vos forums et pages de sujets afin de corriger les donn&#233;es de la base de donn&#233;es. Utilisez cette option &#224; chaque fois  que vous observez des d&#233;synchronisations entre les listes de sujets et leurs forums.");
define ("_AM_NEWBB_SYNCHING", "Synchroniser le forum et les sujets index&#233;s (Cela peut prendre du temps)");
define ("_AM_NEWBB_CATEGORYDELETED", "la cat&#233;gorie a &#233;t&#233; supprim&#233;e.");
define ("_AM_NEWBB_MOVE2CAT", "D&#233;placer la cat&#233;gorie :");
define ("_AM_NEWBB_MAKE_SUBFORUM_OF", "Cr&#233;er un sous-forum de :");
define ("_AM_NEWBB_MSG_FORUM_MOVED", "Le forum a &#233;t&#233; d&#233;plac&#233;!");
define ("_AM_NEWBB_MSG_ERR_FORUM_MOVED", "Echec de d&#233;placement du forum.");
define ("_AM_NEWBB_SELECT"," < S&#233;lectionner >");
define ("_AM_NEWBB_MOVETHISFORUM","D&#233;placer ce forum");
define ("_AM_NEWBB_MERGE","Fusionner");
define ("_AM_NEWBB_MERGETHISFORUM","Fusionner ce forum");
define ("_AM_NEWBB_MERGETO_FORUM","Fusionner ce forum avec :");
define ("_AM_NEWBB_MSG_FORUM_MERGED","Forums fusionn&#233;s !");
define ("_AM_NEWBB_MSG_ERR_FORUM_MERGED","Echec de la fusion des forums.");

//%%%%%%        Nom du dossier admin_forum_reorder.php           %%%%%
define ("_AM_NEWBB_REORDERID", "N°");
define ("_AM_NEWBB_REORDERTITLE", "Titre");
define ("_AM_NEWBB_REORDERWEIGHT","Position");
define ("_AM_NEWBB_SETFORUMORDER", "Param&#232;tres d&#39;organisation des forums");
define ("_AM_NEWBB_BOARDREORDER","Le forum a &#233;t&#233; r&#233;-ordonn&#233;");

// admin_permission.php
define("_AM_NEWBB_PERMISSIONS_TO_THIS_FORUM","Permissions pour ce forum");
define("_AM_NEWBB_CAT_ACCESS","Acc&#232;s aux cat&#233;gories");
define("_AM_NEWBB_CAN_ACCESS","Peut acc&#233;der");
define ("_AM_NEWBB_CAN_VIEW", "peut visualiser");
define ("_AM_NEWBB_CAN_POST", "peut d&#233;buter de nouveaux sujets");
define ("_AM_NEWBB_CAN_REPLY", "peut r&#233;pondre");
define ("_AM_NEWBB_CAN_EDIT", "peut &#233;diter");
define ("_AM_NEWBB_CAN_DELETE", "peut effacer");
define ("_AM_NEWBB_CAN_ADDPOLL", "peut ajouter un sondage");
define ("_AM_NEWBB_CAN_VOTE", "peut voter");
define ("_AM_NEWBB_CAN_ATTACH", "peut attacher");
define ("_AM_NEWBB_CAN_NOAPPROVE","peut poster sans approbation");
define ("_AM_NEWBB_ACTION", "Action");

define("_AM_NEWBB_PERM_TEMPLATE","Mod&#232;le de Permissions");
define("_AM_NEWBB_PERM_TEMPLATE_DESC","Sera appliqu&#233; aux nouveaux forums");
define("_AM_NEWBB_PERM_FORUMS","S&#233;lectionnez les forums");
define("_AM_NEWBB_PERM_TEMPLATE_CREATED","Le mod&#232;le de permissions a &#233;t&eacute g&#233;n&#233;r&#233;");
define("_AM_NEWBB_PERM_TEMPLATE_ERROR","Une erreur s&#39;est produite durant la cr&#233;ation du mod&#232;le de permission");
define("_AM_NEWBB_PERM_TEMPLATEAPP","Appliquer les permissions par d&#233;faut");
define("_AM_NEWBB_PERM_TEMPLATE_APPLIED","Les permissions par d&#233;faut ont &#233;t&#233; appliqu&#233;es aux forums");
define("_AM_NEWBB_PERM_ACTION","Outils de Gestion des Permissions");
define("_AM_NEWBB_PERM_SETBYGROUP","D&#233;duire les permissions des droits des groupes");

// admin_forum_prune.php

define ("_AM_NEWBB_PRUNE_RESULTS_TITLE", "R&#233;sultats des purges");
define ("_AM_NEWBB_PRUNE_RESULTS_TOPICS", "Sujets purg&#233;s");
define ("_AM_NEWBB_PRUNE_RESULTS_POSTS", "Contributions purg&#233;es");
define ("_AM_NEWBB_PRUNE_RESULTS_FORUMS", "Forums purg&#233;s");
define ("_AM_NEWBB_PRUNE_STORE", "Enregistrer les contributions des forums avant de les purger");
define ("_AM_NEWBB_PRUNE_ARCHIVE", "R&#233;aliser une copie d&#39;archive des contributions");
define ("_AM_NEWBB_PRUNE_FORUMSELERROR", "Vous avez oubli&#233; de s&#233;lectionner le ou les forums &#224; purger");

define ("_AM_NEWBB_PRUNE_DAYS", "Supprimer les sujets sans r&#233;ponse depuis :");
define ("_AM_NEWBB_PRUNE_FORUMS", "Forums &#224; purger");
define ("_AM_NEWBB_PRUNE_STICKY", "Conserver les sujets agraf&#233;s");
define ("_AM_NEWBB_PRUNE_DIGEST", "Conserver les sujets en sommaire");
define ("_AM_NEWBB_PRUNE_LOCK", "Conserver les sujets verrouill&#233;s");
define ("_AM_NEWBB_PRUNE_HOT","Garder les sujets avec un nombre de r&#233;ponses sup&#233;rieur &#224;");
define ("_AM_NEWBB_PRUNE_SUBMIT", "Valider");
define ("_AM_NEWBB_PRUNE_RESET", "R&#233;initialiser");
define ("_AM_NEWBB_PRUNE_YES", "Oui");
define ("_AM_NEWBB_PRUNE_NO", "Non");
define ("_AM_NEWBB_PRUNE_WEEK", "Une semaine");
define ("_AM_NEWBB_PRUNE_2WEEKS", "Deux semaines");
define ("_AM_NEWBB_PRUNE_MONTH", "Un mois");
define ("_AM_NEWBB_PRUNE_2MONTH", "Deux mois");
define ("_AM_NEWBB_PRUNE_4MONTH", "Quatre mois");
define ("_AM_NEWBB_PRUNE_YEAR", "Un an");
define ("_AM_NEWBB_PRUNE_2YEARS", "2 ans");

// About.php constants
define('_AM_NEWBB_AUTHOR_INFO', "Informations au sujet de l&#39;auteur");
define('_AM_NEWBB_AUTHOR_NAME', "Auteur");
define('_AM_NEWBB_AUTHOR_WEBSITE', "Site Web de l&#39;auteur");
define('_AM_NEWBB_AUTHOR_EMAIL', "Email de l&#39;auteur");
define('_AM_NEWBB_AUTHOR_CREDITS', "Cr&#233;dits");
define('_AM_NEWBB_MODULE_INFO', "Informations de d&#233;veloppement du module");
define('_AM_NEWBB_MODULE_STATUS', "Etats");
define('_AM_NEWBB_MODULE_DEMO', "Site de d&#233;monstration");
define('_AM_NEWBB_MODULE_SUPPORT', "Site officiel de support");
define('_AM_NEWBB_MODULE_BUG', "Rapporter un bug &#224; propos de ce module");
define('_AM_NEWBB_MODULE_FEATURE', "Sugg&#233;rer une nouvelle fonction pour ce module");
define('_AM_NEWBB_MODULE_DISCLAIMER', "Avertissement");
define('_AM_NEWBB_AUTHOR_WORD', "Le monde de l&#39;auteur");
define('_AM_NEWBB_BY','Par');
define('_AM_NEWBB_AUTHOR_WORD_EXTRA', " ");


// admin_report.php
define("_AM_NEWBB_REPORTADMIN","Posts rapport&#233;s aux gestionnaires");
define("_AM_NEWBB_PROCESSEDREPORT","Vues des rapports g&#233;n&#233;r&#233;s");
define("_AM_NEWBB_PROCESSREPORT","Rapports g&#233;n&#233;r&#233;s");
define("_AM_NEWBB_REPORTTITLE","Titre des rapports");
define("_AM_NEWBB_REPORTEXTRA","Extra");
define("_AM_NEWBB_REPORTPOST","Post rapport&#233;");
define("_AM_NEWBB_REPORTTEXT","Texte du rapport");
define("_AM_NEWBB_REPORTMEMO","Memo g&#233;n&#233;r&#233;");

// admin_report.php
define("_AM_NEWBB_DIGESTADMIN","Gestion des sommaires");
define("_AM_NEWBB_DIGESTCONTENT","Contenu des sommaires");

// admin_votedata.php
define("_AM_NEWBB_VOTE_RATINGINFOMATION", "Informations de vote");
define("_AM_NEWBB_VOTE_TOTALVOTES", "Nombre total de votes : ");
define("_AM_NEWBB_VOTE_REGUSERVOTES", "Votes d&#39;utilisateurs enregistr&#233;s : %s");
define("_AM_NEWBB_VOTE_ANONUSERVOTES", "Votes d&#39;utilisateurs anonymes : %s");
define("_AM_NEWBB_VOTE_USER", "Utilisateur");
define("_AM_NEWBB_VOTE_IP", "Addresse IP");
define("_AM_NEWBB_VOTE_USERAVG", "Moyenne des cotations utilisateur");
define("_AM_NEWBB_VOTE_TOTALRATE", "Totaux des cotations");
define("_AM_NEWBB_VOTE_DATE", "Soumis");
define("_AM_NEWBB_VOTE_RATING", "cot&#233;");
define("_AM_NEWBB_VOTE_NOREGVOTES", "Aucun vote d&#39;utilisateur enregistr&#233;");
define("_AM_NEWBB_VOTE_NOUNREGVOTES", "Aucun vote d&#39;utilisateur non enregistr&#233;");
define("_AM_NEWBB_VOTEDELETED", "Donn&#233;es de vote effac&#233;es.");
define("_AM_NEWBB_VOTE_ID", "N°");
define("_AM_NEWBB_VOTE_FILETITLE", "Titre du sujet");
define("_AM_NEWBB_VOTE_DISPLAYVOTES", "Informations de donn&#233;es de vote");
define("_AM_NEWBB_VOTE_NOVOTES", "Aucun vote d&#39;utilisateur &#224; visualiser");
define("_AM_NEWBB_VOTE_DELETE", "Aucun vote d&#39;utilisateur &#224; visualiser");
define("_AM_NEWBB_VOTE_DELETEDSC", "<strong>Effacer</strong> les informations de vote s&#233;lectionn&#233;es de la base de donn&#233;es.");

/**
 * @translation     AFUX (Association Francophone des Utilisateurs de Xoops) <http://www.afux.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8
 *
 * @version         $Id: admin.php 677 2009-08-20 15:58:21Z dugris $
**/
?>