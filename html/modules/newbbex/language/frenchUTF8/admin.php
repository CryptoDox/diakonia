<?php
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
// Support Francophone de Xoops (www.frxoops.org)
//%%%%%%        File Name  index.php           %%%%%
define("_MDEX_A_FORUMCONF","Configuration des forums");
define("_MDEX_A_ADDAFORUM","Ajouter un forum");
define("_MDEX_A_LINK2ADDFORUM","Ce lien vous emm&egrave;ne sur une page o&ugrave; vous pouvez ajouter un forum &agrave; la base de donn&eacute;es.");
define("_MDEX_A_EDITAFORUM","Editer un forum");
define("_MDEX_A_LINK2EDITFORUM","Ce lien vous permet d'&eacute;diter un forum existant.");
define("_MDEX_A_SETPRIVFORUM","Param&eacute;trer les permissions des forums priv&eacute;s");
define("_MDEX_A_LINK2SETPRIV","Ce lien vous permet de param&eacute;trer les acc&egrave;s au forums priv&eacute;s existants.");
define("_MDEX_A_SYNCFORUM","Synchroniser l'index des forums/sujets");
define("_MDEX_A_LINK2SYNC","Ce lien vous permet de synchroniser les forums et les index de sujets pour corriger n'importe quelles contradictions qui pourraient y avoir");
define("_MDEX_A_ADDACAT","Ajouter une cat&eacute;gorie");
define("_MDEX_A_LINK2ADDCAT","Ce lien vous permet d'ajouter une nouvelle cat&eacute;gorie pour y cr&eacute;er des forums.");
define("_MDEX_A_EDITCATTTL","Editer le titre d'une cat&eacute;gorie");
define("_MDEX_A_LINK2EDITCAT","Ce lien vous permet d'&eacute;diter le titre d'une cat&eacute;gorie.");
define("_MDEX_A_RMVACAT","Supprimer une cat&eacute;gorie");
define("_MDEX_A_LINK2RMVCAT","Ce lien vous permet de supprimer une cat&eacute;gorie de la base de donn&eacute;es");
define("_MDEX_A_REORDERCAT","R&eacute;-ordonner les cat&eacute;gories");
define("_MDEX_A_LINK2ORDERCAT","Ce lien vous permet de changer l'ordre d'affichage des cat&eacute;gories sur la page d'index");

//%%%%%%        File Name  admin_forums.php           %%%%%
define("_MDEX_A_FORUMUPDATED","Forum mis &agrave; jour");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","Le(s) mod&eacute;rateur(s) s&eacute;lectionn&eacute;s n'a(ont) pas &eacute;t&eacute; supprim&eacute; car sinon il n'y aurait plus de mod&eacute;rateur pour ce forum.");
define("_MDEX_A_FORUMREMOVED","Forum supprim&eacute;.");
define("_MDEX_A_FRFDAWAIP","Forum supprim&eacute; de la base de donn&eacute;es avec tous ses envois.");
define("_MDEX_A_NOSUCHFORUM","Ce forum n'existe pas");
define("_MDEX_A_EDITTHISFORUM","Editer ce forum");
define("_MDEX_A_DTFTWARAPITF","Supprimer ce forum (Cela supprimera aussi tous les envois dans ce forum !)");
define("_MDEX_A_FORUMNAME","Nom du forum :");
define("_MDEX_A_FORUMDESCRIPTION","Description du forum :");
define("_MDEX_A_MODERATOR","Mod&eacute;rateur(s) :");
define("_MDEX_A_REMOVE","Supprimer");
define("_MDEX_A_NOMODERATORASSIGNED","Aucun mod&eacute;rateur assign&eacute;");
define("_MDEX_A_NONE","Aucun");
define("_MDEX_A_CATEGORY","Cat&eacute;gorie :");
define("_MDEX_A_ANONYMOUSPOST","Envoi anonyme");
define("_MDEX_A_REGISTERUSERONLY","Utilisateurs enregistr&eacute;s uniquement");
define("_MDEX_A_MODERATORANDADMINONLY","Mod&eacute;rateurs/Administrateurs uniquement");
define("_MDEX_A_TYPE","Type :");
define("_MDEX_A_PUBLIC","Public");
define("_MDEX_A_PRIVATE","Priv&eacute;");
define("_MDEX_A_SELECTFORUMEDIT","S&eacute;lectionner un forum &agrave; &eacute;diter");
define("_MDEX_A_NOFORUMINDATABASE","Pas de forums dans la base de donn&eacute;es");
define("_MDEX_A_DATABASEERROR","Erreur dans la base de donn&eacute;es");
define("_MDEX_A_EDIT","Editer");
define("_MDEX_A_CATEGORYUPDATED","Cat&eacute;gorie mise &agrave; jour.");
define("_MDEX_A_EDITCATEGORY","Edition de la cat&eacute;gorie :");
define("_MDEX_A_CATEGORYTITLE","Titre de la cat&eacute;gorie :");
define("_MDEX_A_SELECTACATEGORYEDIT","S&eacute;lectionner une cat&eacute;gorie &agrave; &eacute;diter");
define("_MDEX_A_CATEGORYCREATED","Cat&eacute;gorie cr&eacute;&eacute;e.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","Note : Ceci NE supprimera PAS les forums de cette cat&eacute;gorie, vous devez le faire via la section Editer un Forum.");
define("_MDEX_A_REMOVECATEGORY","Supprimer un cat&eacute;gorie");
define("_MDEX_A_CREATENEWCATEGORY","Cr&eacute;er une nouvelle cat&eacute;gorie");
define("_MDEX_A_YDNFOATPOTFDYAA","Vous n'avez pas rempli toutes les parties du formulaire.<br>Avez-vous assign&eacute; au moins un mod&eacute;rateur ? Merci de retourner en arri&egrave;re et de corriger le formulaire.");
define("_MDEX_A_FORUMCREATED","Forum cr&eacute;&eacute;.");
define("_MDEX_A_VTFYJC","Afficher le forum que vous venez juste de cr&eacute;er.");
define("_MDEX_A_EYMAACBYAF","Erreur, vous devez ajouter une cat&eacute;gorie avant d'ajouter des forums");
define("_MDEX_A_CREATENEWFORUM","Cr&eacute;er un nouveau forum");
define("_MDEX_A_ACCESSLEVEL","Niveau d'acc&egrave;s :");
define("_MDEX_A_CATEGORYMOVEUP","Cat&eacute;gorie d&eacute;plac&eacute;e vers le haut");
define("_MDEX_A_TCIATHU","Ceci est d&eacute;j&agrave; la plus haute cat&eacute;gorie.");
define("_MDEX_A_CATEGORYMOVEDOWN","Cat&eacute;gorie d&eacute;plac&eacute;e vers le bas");
define("_MDEX_A_TCIATLD","Ceci est d&eacute;j&agrave; la plus basse cat&eacute;gorie.");
define("_MDEX_A_SETCATEGORYORDER","Param&eacute;trer l'ordre des cat&eacute;gories");
define("_MDEX_A_TODHITOTCWDOTIP","L'ordre affich&eacute; ici est l'ordre des cat&eacute;gories qui seront affich&eacute;es sur la page d'index. Pour d&eacute;placer une cat&eacute;gorie vers le haut cliquez sur 'Monter' et vers le bas sur 'Descendre'.");
define("_MDEX_A_ECWMTCPUODITO","Chaque clic d&eacute;placera la cat&eacute;gorie d'une place vers le haut ou vers le bas dans le classement.");
define("_MDEX_A_CATEGORY1","Cat&eacute;gorie");
define("_MDEX_A_MOVEUP","Monter");
define("_MDEX_A_MOVEDOWN","Descendre");


define("_MDEX_A_FORUMUPDATE","Param&eacute;tres du forum mis &agrave; jour");
define("_MDEX_A_RETURNTOADMINPANEL","Retour au panneau d'administration.");
define("_MDEX_A_RETURNTOFORUMINDEX","Retour &agrave; l'index des forums");
define("_MDEX_A_ALLOWHTML","Autoriser le HTML :");
define("_MDEX_A_YES","Oui");
define("_MDEX_A_NO","Non");
define("_MDEX_A_ALLOWSIGNATURES","Autoriser les signatures :");
define("_MDEX_A_HOTTOPICTHRESHOLD","Seuil de sujet chaud :");
define("_MDEX_A_POSTPERPAGE","Envois par page :");
define("_MDEX_A_TITNOPPTTWBDPPOT","(Ceci est le nombre d'envois par sujet qui seront affich&eacute;s par page d'un sujet)");
define("_MDEX_A_TOPICPERFORUM","Sujets par forum :");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(Ceci est le nombre de sujets par forum qui seront affich&eacute;s par page d'un forum)");
define("_MDEX_A_SAVECHANGES","Sauvegarder les changements");
define("_MDEX_A_CLEAR","Vider");
define("_MDEX_A_CLICKBELOWSYNC","Cliquer sur le bouton ci-dessous va synchroniser vos forums et pages sujets avec les donn&eacute;es correctes de la base de donn&eacute;es. Utilisez cette section si vous constatez des anomalies les listes de sujets et forums.");
define("_MDEX_A_SYNCHING","Synchronise l'index des forums et sujets (ceci peut prendre un petit moment)");
define("_MDEX_A_DONESYNC","Fait !");
define("_MDEX_A_CATEGORYDELETED","Cat&eacute;gorie effac&eacute;e.");

//%%%%%%        File Name  admin_priv_forums.php           %%%%%

define("_MDEX_A_SAFTE","S&eacute;lectionner un forum &agrave; &eacute;diter");
define("_MDEX_A_NFID","Pas de forums dans la base de donn&eacute;es");
define("_MDEX_A_EFPF","Edition des permissions du forum pour : <b>%s</b>");
define("_MDEX_A_UWA","Utilisateurs avec acc&egrave;s :");
define("_MDEX_A_UWOA","Utilisateurs sans acc&egrave;s :");
define("_MDEX_A_ADDUSERS","Ajouter des utilisateurs -->");
define("_MDEX_A_CLEARALLUSERS","Vider tous les utilisateurs");
define("_MDEX_A_REVOKEPOSTING","refuser les envois");
define("_MDEX_A_GRANTPOSTING","permettre les envois");

// Ajouts Hervé
define("_MDEX_A_SHOWNAME","Remplacer le pseudo par le nom r&eacute;el");
define("_MDEX_A_SHOWICONSPANEL","Voir le panneau des ic&ocirc;nes");
define("_MDEX_A_SHOWSMILIESPANEL","Voir le panneau des smilies");
define("_MDEX_A_EDITPERMS","Permissions");
define("_MDEX_A_CURRENT","Actuel(s)");
define("_MDEX_A_ADD","Ajouter");
define("_MDEX_A_SHOWMSGPAGINATION","Voir la pagination des messages sur les blocs");
define("_MDEX_A_CANPOST","Peut écrire");
define("_MDEX_A_CANTPOST","Ne peut pas écrire");

// Ajout 1.5
define("_MDEX_A_ALLOW_UPLOAD", "Permettre le téléchargement de fichiers");
?>