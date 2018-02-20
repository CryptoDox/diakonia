<?php
// $Id: modinfo.php 677 2009-08-20 15:58:21Z dugris $
// Thanks Tom (http://www.wf-projects.com), for correcting the Engligh language package

// Module Info

// The name of this module
define("_MI_NEWBB_NAME","Forum CBB");

// A brief description of this module
define("_MI_NEWBB_DESC","Module de forums pour la Communaut&#233; XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBB_BLOCK_TOPIC_POST","Sujets r&#233;cents avec r&#233;ponse");
define("_MI_NEWBB_BLOCK_TOPIC","Sujets r&#233;cents");
define("_MI_NEWBB_BLOCK_POST","Posts r&#233;cents");
define("_MI_NEWBB_BLOCK_AUTHOR","Auteurs");
/*
define("_MI_NEWBB_BNAME2","Sujets les plus lus");
define("_MI_NEWBB_BNAME3","Sujets les plus actifs");
define("_MI_NEWBB_BNAME4","Nouveaux gros titres");
define("_MI_NEWBB_BNAME5","Nouveaux sujets agraph&#233;s");
define("_MI_NEWBB_BNAME6","Nouveaux messages");
define("_MI_NEWBB_BNAME7","Auteurs avec le plus de sujets");
define("_MI_NEWBB_BNAME8","Auteurs avec le plus de messages");
define("_MI_NEWBB_BNAME9","Auteurs les plus sommairis&#233;s");
define("_MI_NEWBB_BNAME10","Auteurs avec le plus de sujets attach&#233;s");&#233;
define("_MI_NEWBB_BNAME11","Derni&#232;re contribution avec du texte");
*/

// Names of admin menu items
define("_MI_NEWBB_ADMENU_INDEX","Index");
define("_MI_NEWBB_ADMENU_CATEGORY","Cat&#233;gories");
define("_MI_NEWBB_ADMENU_FORUM","Forums");
define("_MI_NEWBB_ADMENU_PERMISSION","Permissions");
define("_MI_NEWBB_ADMENU_BLOCK","Blocs");
define("_MI_NEWBB_ADMENU_SYNC","Synchronisation");
define("_MI_NEWBB_ADMENU_ORDER","Ordre");
define("_MI_NEWBB_ADMENU_PRUNE","Purge");
define("_MI_NEWBB_ADMENU_REPORT","Messages rapport&#233;s");
define("_MI_NEWBB_ADMENU_DIGEST","Sommaires");
define("_MI_NEWBB_ADMENU_VOTE","Votes");



//config options

define("_MI_DO_DEBUG","Mode Debug");
define("_MI_DO_DEBUG_DESC","Afficher les messages d&#39;erreur");

define("_MI_IMG_SET","Set d&#39;images");
define("_MI_IMG_SET_DESC","S&#233;lectionner le set d&#39;images &#224; utiliser");

define("_MI_THEMESET", "Set de Th&#232;me");
define("_MI_THEMESET_DESC", "Th&#232;me global du module, la s&#233;lection de &#39;"._NONE."&#39; utilisera le th&#232;me global du site");

define("_MI_DIR_ATTACHMENT","Chemin physique des fichiers attach&#233;s");
define("_MI_DIR_ATTACHMENT_DESC","Le chemin physique doit &#234;tre param&#233;tr&#233; &#224; la racine de xoops et pas avant.<br /> Exemple vous souhaitez que les fichiers attach&#233;s soient t&#233;l&#233;charg&#233;s dans http://www.votresite.com/uploads/newbb.<br />Le chemin &#224; saisir sera alors &#39;upload/newbb&#39; sans jamais inclure le &#39;/&#39; final.<br />Le chemin des vignettes (pour les fichiers images) sera &#39;uploads/newbb/thumbs&#39;.");
define("_MI_PATH_MAGICK","Chemin pour ImageMagick");
define("_MI_PATH_MAGICK_DESC","Usuellement il s&#39;agit de &#39;/usr/bin/X11&#39;. Laissez le vide si ImageMAgick n&#39;est pas install&#233;");

define("_MI_SUBFORUM_DISPLAY","Mode de visualisation des sous-forums sur la page index");
define("_MI_SUBFORUM_DISPLAY_DESC","Cette option d&#233;termine l&#39;affichage des sous-forums sur la page index du module");
define("_MI_SUBFORUM_EXPAND","Etendu");
define("_MI_SUBFORUM_COLLAPSE","Condens&#233;");
define("_MI_SUBFORUM_HIDDEN","Cach&#233;");

define("_MI_POST_EXCERPT","Publier un extrait sur la page d&#39;index du forum");
define("_MI_POST_EXCERPT_DESC","Longueur de l&#39;extrait de la contribution au survol de la souris. 0 pour aucun extrait.");

define("_MI_PATH_NETPBM","Chemin pour Netpbm");
define("_MI_PATH_NETPBM_DESC","Usuellement il s&#39;agit de &#39;/usr/bin&#39;. Laissez en blanc si Netpbm n&#39;est pas install&#233; ou choisissez AUTO pour une autod&#233;tection.");

define("_MI_IMAGELIB","S&#233;lectionnez la librairie d&#39;images &#224; utiliser");
define("_MI_IMAGELIB_DESC","S&#233;lectionnez la librairie d&#39;images avec laquelle vous d&#233;sirez cr&#233;er des vignettes pour les fichiers d&#39;images.<br />Laissez AUTO pour une autod&#233;tection.");

define("_MI_MAX_IMG_WIDTH","Largeur maximale de l&#39;image");
define("_MI_MAX_IMG_WIDTH_DESC", "Valeur maximum pour la <strong>largeur</strong> d&#39;une image t&#233;l&#233;charg&#233;e lorsque des vignettes seront utilis&#233;es. <br/ >Entrez 0 si vous ne d&#233;sirez pas cr&#233;er de vignettes.");

define("_MI_MAX_IMAGE_WIDTH","Largeur maximale de l&#39;image pour cr&#233;er une vignette");
define("_MI_MAX_IMAGE_WIDTH_DESC", "D&#233;finit la largeur maximale de l&#39;image envoy&#233;e pour cr&#233;er une vignette. <br >Une image de largeur plus &#233;lev&#233;e que la valeur d&#233;finie n&#39;aura pas de vignette.");

define("_MI_MAX_IMAGE_HEIGHT","Hauteur maximum de l&#39;image pour cr&#233;er une vignette");
define("_MI_MAX_IMAGE_HEIGHT_DESC", "D&#233;finit la hauteur maximale de l&#39;image envoy&#233;e pour cr&#233;er une vignette. <br />Une image de hauteur plus &#233;lev&#233;e que la valeur d&#233;finie n&#39;aura pas de vignette.");

define("_MI_SHOW_DIS","Afficher une mise en garde");
define("_MI_DISCLAIMER","Contenu de la mise en garde");
define("_MI_DISCLAIMER_DESC","Saisissez le texte de votre avertissement qui sera affich&#233; dans le contexte s&#233;lectionn&#233; ci-dessus.");
define("_MI_DISCLAIMER_TEXT", "Ces forums contiennent beaucoup de contributions avec de nombreuses informations. <br /><br />Afin de r&#233;duire au maximum les sujets en doublon, nous aimerions que vous utilisiez la fonction de recherche de discussions avant de poster votre question ici.");
define("_MI_NONE","Aucun");
define("_MI_POST","Post");
define("_MI_REPLY","R&#233;ponse");
define("_MI_OP_BOTH","Les deux");
define("_MI_WOL_ENABLE","Activer le bloc : Qui est en ligne");
define("_MI_WOL_ENABLE_DESC","Active le bloc Qui est en ligne ; il sera affich&#233; en dessous de la page Index et de la page des forums");
//define("_MI_WOL_ADMIN_COL","Couleur de surlignage des administrateurs");
//define("_MI_WOL_ADMIN_COL_DESC","Couleur des administrateurs affich&#233;e dans le bloc qui est en ligne");
//define("_MI_WOL_MOD_COL","Couleur de surlignage des mod&#233;rateurs");
//define("_MI_WOL_MOD_COL_DESC","Couleur des mod&#233;rateurs affich&#233;e dans le bloc Qui est en ligne");
//define("_MI_LEVELS_ENABLE", "Activer les modes de niveaux HP/MP/EXP");
//define("_MI_LEVELS_ENABLE_DESC", "<strong>HP</strong>  est d&#233;termin&#233; par la moyenne des contributions par jour.<br /><strong>MP</strong>  est d&#233;termin&#233; par la date jointe en rapport avec le compte du post.<br /><strong>EXP</strong> Montre le temps du post, Et quand vous arrivez &#224; 100%, vous gagnez un niveau EXP retombe &#224; 0.");
define("_MI_NULL", "d&#233;sactiv&#233;");
define("_MI_TEXT", "texte");
define("_MI_GRAPHIC", "graphique");
define("_MI_USERLEVEL", "Mode niveaux HP/MP/EXP");
define("_MI_USERLEVEL_DESC", "<strong>HP</strong>  est d&#233;termin&#233; par votre moyenne de contributions par jour.<br /><strong>MP</strong>  est d&#233;termin&#233; par votre date de visite relatif &#224; votre nombre de contributions.<br /><strong>EXP</strong> augmente &#224; chaque fois que vous contribuez. Lorsque vous parvenez &#224; 100%, vous gagnez un niveau et EXP redescend &#224; 0 de nouveau.");
define("_MI_RSS_ENABLE","Activer les flux RSS");
define("_MI_RSS_ENABLE_DESC","Permet la cr&#233;ation de filets RSS. Les options ci-dessous pr&#233;cisent le maximum d&#39;articles et la longueur de la description");
define("_MI_RSS_MAX_ITEMS", "Nombre maximum d&#39;articles dans le flux RSS.");
define("_MI_RSS_MAX_DESCRIPTION", "Longueur maximum de la description dans le flux RSS");
define("_MI_RSS_UTF8", "Encodage RSS avec UTF-8");
define("_MI_RSS_UTF8_DESCRIPTION", "&#39;UTF-8&#39; sera utilis&#233; si activ&#233; sinon &#39;"._CHARSET."&#39; sera utilis&#233;.");
define("_MI_RSS_CACHETIME", "Temps de cache du flux RSS");
define("_MI_RSS_CACHETIME_DESCRIPTION", "Temps de cache pour la re-g&#233;n&#233;ration du filet RSS, en minutes.");

define("_MI_MEDIA_ENABLE","Activer des fonctions m&#233;dia");
define("_MI_MEDIA_ENABLE_DESC","Afficher les images attach&#233;es directement dans le message.");
define("_MI_USERBAR_ENABLE","Activer la barre utilisateur");
define("_MI_USERBAR_ENABLE_DESC","Afficher la barre utilisateur &#233;tendue : Profil, PM, ICQ, MSN, etc...");

define("_MI_GROUPBAR_ENABLE","Activer la barre de groupe");
define("_MI_GROUPBAR_ENABLE_DESC","Affiche les groupes auquels appartient l&#39;utilisateur dans le champ informations.");

define("_MI_RATING_ENABLE","Activer la fonction de comptabilisation");
define("_MI_RATING_ENABLE_DESC","Activer la comptabilisation par sujet");

define("_MI_VIEWMODE","Mode de visualisation des discussions");
define("_MI_VIEWMODE_DESC","Outrepasser les param&#232;tres g&#233;n&#233;raux des modes de visualisation<br />Choisissez Aucun pour ne pas outrepasser");
define("_MI_COMPACT","Compact");

define("_MI_MENUMODE","Mode de menu par d&#233;faut");
define("_MI_MENUMODE_DESC","Cette option d&#233;fini la pr&#233;sentation du menu affich&#233; dans l&#39;en-t&#234;te du module et s&#39;appellant selon les pages &#39;Options du menu&#39;,&#39;Options des forums&#39;, &#39;Options du sujet&#39;<br /> - Liste de s&#233;lection(SELECT) : affiche une liste d&#233;roulante classique<br /> - Menu d&#233;roulant(HOVER) : affiche un menu d&#233;roulant dont le contenu devient visible lorsque la souris est positionn&#233;e sur ce menu (Comportement parfois al&#233;atoire avec Internet Explorer)<br />- Menu d&#233;roulant par clic (CLICK) dont le contenu devient visible aprs avoir cliqu&#233; sur le titre de ce menu (requiert Javascript)");

define("_MI_REPORTMOD_ENABLE","Rapporter les contributions aux mod&#233;rateurs");
define("_MI_REPORTMOD_ENABLE_DESC","Les utilisateurs peuvent rapporter les contributions aux mod&#233;rateurs en vue d&#39;une action");
define("_MI_SHOW_JUMPBOX", "Afficher la boite de saut");
define("_MI_JUMPBOXDESC", "Si actif, un menu d&#233;roulant autorisera les utilisateurs &#224; sauter d&#39;un sujet ou d&#39;un forum vers un autre forum");

define("_MI_SHOW_PERMISSIONTABLE", "Afficher la table des permissions");
define("_MI_SHOW_PERMISSIONTABLE_DESC", "Param&#232;tr&#233; &#224; OUI affichera ses droits &#224; l&#39;utilisateur en bas de chaque page");

define("_MI_EMAIL_DIGEST", "Email des publications en sommaire");
define("_MI_EMAIL_DIGEST_DESC", "Param&#233;trer la p&#233;riode horaire pour envoyer les contributions en sommaire aux utilisateurs");
define("_MI_NEWBB_EMAIL_NONE", "Pas d&#39;email");
define("_MI_NEWBB_EMAIL_DAILY", "Journalier");
define("_MI_NEWBB_EMAIL_WEEKLY", "Hebdomadaire");

define("_MI_SHOW_IP", "Afficher les adresses IP des utilisateurs");
define("_MI_SHOW_IP_DESC", "Activ&#233;e, cette option affiche les adresses IP des utilisateurs aux mod&#233;rateurs");

define("_MI_ENABLE_KARMA", "Activer les pr&#233;requis de Karma");
define("_MI_ENABLE_KARMA_DESC", "Ceci permet aux utilisateurs de param&#232;trer un pr&#233;requis n&#233;c&#233;ssaire &#224; la lecture de leurs contributions");

define("_MI_KARMA_OPTIONS", "Options de Karma pour la contribution");
define("_MI_KARMA_OPTIONS_DESC", "Utilisez &#39;,&#39; pour d&#233;limiter les options multiples. Laisser blanc pour ne pas activer cette option");

define("_MI_SINCE_OPTIONS", "Dur&#233;es associ&#233;es &#224; &#39;depuis&#39; option pour le S&#233;lecteur d&#39;affichage &#39;visualisation des formulaire&#39; et la fonction &#39;Recherche&#39;");
define("_MI_SINCE_OPTIONS_DESC", "Valeur positive pour les jours et n&#233;gative pour les heures. Utilisez &#39;,&#39; comme d&#233;limitateur d&#39;options multiples.");

define("_MI_SINCE_DEFAULT", "Valeur par d&#233;faut en jour pour le param&#232;tre &#39;Depuis...&#39; utilis&#233; pour le S&#233;lecteur d&#39;affichage et la fonction Recherche ");
define("_MI_SINCE_DEFAULT_DESC", "La valeur par d&#233;faut (100 jours) n&#39;affichera pas les sujets ant&#233;rieurs &#224; ce nombre. Cela permet d&#39;all&#233;ger la charge du serveur de base de donn&#233;es.<br />Saisir 0 pour afficher tous les sujets.");

define("_MI_MODERATOR_HTML", "Autoriser les tags HTML pour les mod&#233;rateurs");
define("_MI_MODERATOR_HTML_DESC", "Cette option autorise les mod&#233;rateurs &#224; utiliser le langage HTML dans le sujet des contributions");

define("_MI_USER_ANONYMOUS", "Autoriser les utilisateurs &#224; contribuer en anonyme");
define("_MI_USER_ANONYMOUS_DESC", "Cette option autorise les utilisateurs identifi&#233;s &#224; contribuer anonymement");

define("_MI_ANONYMOUS_PRE", "Pr&#233;fixe pour les utilisateurs anonymes");
define("_MI_ANONYMOUS_PRE_DESC", "Ceci ajoute un pr&#233;fixe au nom d&#39;utilisateur anonyme");

define("_MI_REQUIRE_REPLY", "Activer le pr&#233;requis de r&#233;ponse afin de lire une contribution");
define("_MI_REQUIRE_REPLY_DESC", "Cette option permet aux utilisateurs de demander une r&#233;ponse aux lecteurs avant qu&#39;il puissent lire leurs contributions.<br />Option &#224; manier avec pr&#233;caution si vous choisissez une r&#233;ponse positive, elle pourra vous d&#233;router autant que vos utilisateurs.");

define("_MI_EDIT_TIMELIMIT", "D&#233;lai pour &#233;diter une contribution");
define("_MI_EDIT_TIMELIMIT_DESC", "Param&#232;tres de d&#233;lai, pendant lequel la contribution est &#233;ditable. En minutes");

define("_MI_DELETE_TIMELIMIT", "Limitation du temps &#224; l&#39;effacement d&#39;une contribution");
define("_MI_DELETE_TIMELIMIT_DESC", "Param&#232;trage d&#39;une limitation de temps, pendant lequel la contribution peut &#234;tre effac&#233;e. en Minutes");

define("_MI_POST_TIMELIMIT", "Limite de temps pour une contribution cons&#233;cutive");
define("_MI_POST_TIMELIMIT_DESC", "Param&#232;trer une limite de temps en secondes, pour pouvoir poster cons&#233;cutivement. Saisir 0 pour ne pas mettre de limite");

define("_MI_RECORDEDIT_TIMELIMIT", "Limite de temps pour enregistrer une info &#233;dit&#233;e");
define("_MI_RECORDEDIT_TIMELIMIT_DESC", "Param&#224;tre un temps limit&#233; pour enregistrer une info &#233;dit&#233;e. En secondes");

define("_MI_SUBJECT_PREFIX", "Ajouter un pr&#233;fixe pour l&#39;article du sujet. Attention se param&#232;tre aussi dans les options de chaque forum");
define("_MI_SUBJECT_PREFIX_DESC", "Param&#232;tre un pr&#233;fixe i.e. [r&#233;solu] au d&#233;but du sujet. Utilisez &#39;,&#39; comme d&#233;limiteur pour des options multiples, laissez &#224; Aucun pour ne pas utiliser de pr&#233;fixe.");
define("_MI_SUBJECT_PREFIX_DEFAULT", '<font color="#00CC00">[r&#233;solu]</font>,<font color="#00CC00">[fix&#233;]</font>,<font color="#FF0000">[requ&#234;te]</font>,<font color="#FF0000">[rapport bug]</font>,<font color="#FF0000">[non r&#233;solu]</font>');

define("_MI_SUBJECT_PREFIX_LEVEL", "Niveau pour les groupes qui peuvent utiliser les pr&#233;fixes");
define("_MI_SUBJECT_PREFIX_LEVEL_DESC", "Choisissez les groupes autoris&#233;s &#224; utiliser les pr&#233;fixes.");
define("_MI_SPL_DISABLE", "D&#233;sactiv&#233;");
define("_MI_SPL_ANYONE", 'Tous');
define("_MI_SPL_MEMBER", 'Membres');
define("_MI_SPL_MODERATOR", 'Mod&#233;rateurs');
define("_MI_SPL_ADMIN", 'Administrateurs');

define("_MI_SHOW_REALNAME", "Afficher le nom r&#233;el");
define("_MI_SHOW_REALNAME_DESC", "Remplace le pseudo de l&#39;utilisateur par son nom r&#233;el.");

define("_MI_CACHE_ENABLE", "Activer le cache");
define("_MI_CACHE_ENABLE_DESC", "Stocke quelques r&#233;sultats interm&#233;diaires de la session pour all&#233;ger les requ&#234;tes");

define("_MI_QUICKREPLY_ENABLE", "Activer la r&#233;ponse rapide");
define("_MI_QUICKREPLY_ENABLE_DESC", "Ceci activera le formulaire de r&#233;ponse rapide");

define("_MI_POSTSPERPAGE","Contributions par page");
define("_MI_POSTSPERPAGE_DESC","Le nombre maximum de contributions qui seront affich&#233;es par page pour un sujet donn&#233;.");

define("_MI_POSTSFORTHREAD","Nombre de contributions maximum pour le mode de visualisation par sujet");
define("_MI_POSTSFORTHREAD_DESC","Le mode &#224; plat devra &#234;tre utilis&#233; si le nombre de contributions exc&#232;de ce nombre");

define("_MI_TOPICSPERPAGE","Sujets par page");
define("_MI_TOPICSPERPAGE_DESC","Le nombre maximum de sujets qui seront affich&#233;s par page");

define("_MI_IMG_TYPE","Type d&#39;image");
define("_MI_IMG_TYPE_DESC","S&#233;lectionnez le type d&#39;image &#224; utiliser");

define("_MI_PNGFORIE_ENABLE","Activer le hack png");
define("_MI_PNGFORIE_ENABLE_DESC","Le hack alloue l&#39;attribut de transparence png avec IE");

define("_MI_FORM_OPTIONS","Options de formulaire");
define("_MI_FORM_OPTIONS_DESC","Options de formulaire que les utilisateurs peuvent choisir quand ils postent/&#233;ditent/r&#233;pondent.");
define("_MI_FORM_COMPACT","Compact");
define("_MI_FORM_DHTML","DHTML");
define("_MI_FORM_SPAW","Editeur Spaw");
define("_MI_FORM_HTMLAREA","Editeur HtmlArea");
define("_MI_FORM_FCK","Editeur FCK");
define("_MI_FORM_KOIVI","Editeur Koivi");
define("_MI_FORM_TINYMCE","Editeur TinyMCE");

define("_MI_MAGICK","Image Magick");
define("_MI_NETPBM","Netpbm");
define("_MI_GD1","Librarie GD1");
define("_MI_GD2","Librarie GD2");
define("_MI_AUTO","AUTO");

define("_MI_WELCOMEFORUM","Forum de bienvenue pour les nouveaux utilisateurs");
define("_MI_WELCOMEFORUM_DESC","Un profil de contribution sera publi&#233; quand un utilisateur visitera le module de forum pour la premi&#232;re fois");

define("_MI_PERMCHECK_ONDISPLAY","Contr&#244;ler les permissions");
define("_MI_PERMCHECK_ONDISPLAY_DESC","Contr&#244;ler les permissions pour l&#39;&#233;dition sur la page affich&#233;e");

define("_MI_USERMODERATE","Activer la mod&#233;ration des utilisateurs");
define("_MI_USERMODERATE_DESC","");


// RMV-NOTIFY
// Notification event descriptions and mail templates

define ("_MI_NEWBB_THREAD_NOTIFY", "Discussion");
define ("_MI_NEWBB_THREAD_NOTIFYDSC", "Options de notification s&#39;appliquant &#224; la discussion actuelle.");

define ("_MI_NEWBB_FORUM_NOTIFY", "Forum");
define ("_MI_NEWBB_FORUM_NOTIFYDSC", "options de la notification qui s&#39;appliquent au forum courant.");

define ("_MI_NEWBB_GLOBAL_NOTIFY", "Globale");
define ("_MI_NEWBB_GLOBAL_NOTIFYDSC", "Options de notification globale des forums.");

define ("_MI_NEWBB_THREAD_NEWPOST_NOTIFY", "Nouvel envoi");
define ("_MI_NEWBB_THREAD_NEWPOST_NOTIFYCAP", "Notifiez-moi des nouveaux envois dans la discussion actuelle.");
define ("_MI_NEWBB_THREAD_NEWPOST_NOTIFYDSC", "Recevoir une notification lorsqu&#39;un nouveau message est post&#233; dans la discussion actuelle.");
define ("_MI_NEWBB_THREAD_NEWPOST_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi dans la discussion");

define ("_MI_NEWBB_FORUM_NEWTHREAD_NOTIFY", "Nouvelle discussion");
define ("_MI_NEWBB_FORUM_NEWTHREAD_NOTIFYCAP", "Notifiez-moi des nouveaux sujets dans le forum actuel.");
define ("_MI_NEWBB_FORUM_NEWTHREAD_NOTIFYDSC", "Recevoir une notification lorsqu&#39;un nouveau sujet d&#233;bute dans le forum actuel.");
define ("_MI_NEWBB_FORUM_NEWTHREAD_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvelle discussion dans le forum");

define ("_MI_NEWBB_GLOBAL_NEWFORUM_NOTIFY", "Nouveau forum");
define ("_MI_NEWBB_GLOBAL_NEWFORUM_NOTIFYCAP", "Notifiez-moi lorsqu&#39;un nouveau forum est cr&#233;&#233;.");
define ("_MI_NEWBB_GLOBAL_NEWFORUM_NOTIFYDSC", "Recevoir une notification lorsqu&#39;un nouveau forum est cr&#233;&#233;.");
define ("_MI_NEWBB_GLOBAL_NEWFORUM_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau forum");

define ("_MI_NEWBB_GLOBAL_NEWPOST_NOTIFY", "Nouvel envoi");
define ("_MI_NEWBB_GLOBAL_NEWPOST_NOTIFYCAP", "Notifiez-moi de chaque nouvel envoi.");
define ("_MI_NEWBB_GLOBAL_NEWPOST_NOTIFYDSC", "Recevoir une notification quand un nouveau message est post&#233;.");
define ("_MI_NEWBB_GLOBAL_NEWPOST_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi");

define ("_MI_NEWBB_FORUM_NEWPOST_NOTIFY", "Nouvel envoi");
define ("_MI_NEWBB_FORUM_NEWPOST_NOTIFYCAP", "Notifiez-moi de chaque nouvel envoi dans le forum actuel.");
define ("_MI_NEWBB_FORUM_NEWPOST_NOTIFYDSC", "Recevoir une notification quand un nouveau message est post&#233; dans le forum actuel.");
define ("_MI_NEWBB_FORUM_NEWPOST_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi dans le forum");

define ("_MI_NEWBB_GLOBAL_NEWFULLPOST_NOTIFY", "Nouvel envoi (Texte complet)");
define ("_MI_NEWBB_GLOBAL_NEWFULLPOST_NOTIFYCAP", "Notifiez-moi de chaque nouvel envoi (incluant le texte complet du message).");
define ("_MI_NEWBB_GLOBAL_NEWFULLPOST_NOTIFYDSC", "Recevoir une notification du texte complet quand un nouveau message est post&#233;.");
define ("_MI_NEWBB_GLOBAL_NEWFULLPOST_NOTIFYSBJ", "[{X_SITENAME}] {X_MODULE} notification automatique : Nouvel envoi (texte complet)");

define ('_MI_NEWBB_GLOBAL_DIGEST_NOTIFY', 'Sommaire');
define ('_MI_NEWBB_GLOBAL_DIGEST_NOTIFYCAP', 'Notifier les contributions en sommaire.');
define ('_MI_NEWBB_GLOBAL_DIGEST_NOTIFYDSC', 'Recevoir une notification des contribution en sommaire.');
define ('_MI_NEWBB_GLOBAL_DIGEST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Contributions ajout&#233;es en sommaire');

// FOR installation
define("_MI_NEWBB_INSTALL_CAT_TITLE", "Cat&#233;gorie-Test");
define("_MI_NEWBB_INSTALL_CAT_DESC", "Cat&#233;gorie &#224; tester.");
define("_MI_NEWBB_INSTALL_FORUM_NAME", "Forum-Test");
define("_MI_NEWBB_INSTALL_FORUM_DESC", "Forum de test.");
define("_MI_NEWBB_INSTALL_POST_SUBJECT", "F&#233;licitations! Le forum marche correctement.");
define("_MI_NEWBB_INSTALL_POST_TEXT", "
        Bienvenue sur le forum de ".(htmlspecialchars($GLOBALS["xoopsConfig"]['sitename'], ENT_QUOTES)).".<br />
        N&#39;h&#233;sitez pas &#224; vous enregister et vous connecter pour commencer des sujets de discussion dans ce forum.<br /><br />

        Si vous avez une quelconque question concernant l&#39;utilisation de CBB, merci de visiter vitre site de support ou <a href='http://xoopsforge.com/modules/newbb/' rel='external' title='CBB @ XoopsForge'>Site du Module CBB</a>.
        ");

/**
 * @translation     AFUX (Association Francophone des Utilisateurs de Xoops) <http://www.afux.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8
 *
 * @version         $Id: modinfo.php 677 2009-08-20 15:58:21Z dugris $
**/
?>