<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
// Support Francophone de Xoops (www.frxoops.org)
//%%%%%%                Module Name phpBB                  %%%%%
//functions.php
define("_MDEX_ERROR","Erreur");
define("_MDEX_NOPOSTS","Pas d'envois");
define("_MDEX_GO","Ok");

//index.php
define("_MDEX_FORUM","Forum");
define("_MDEX_WELCOME","Bienvenue sur les forums de %s.");
define("_MDEX_TOPICS","Sujets");
define("_MDEX_POSTS","Envois");
define("_MDEX_LASTPOST","Dernier envoi");
define("_MDEX_MODERATOR","Mod&eacute;rateur");
define("_MDEX_NEWPOSTS","Nouveaux envois");
define("_MDEX_NONEWPOSTS","Pas de nouveaux envois");
define("_MDEX_PRIVATEFORUM","Forum priv&eacute;");
define("_MDEX_BY","par"); // Posted by
define("_MDEX_TOSTART","Pour commencer la lecture des messages, s&eacute;lectionnez le forum que vous voulez visiter dans la selection ci-dessous.");
define("_MDEX_TOTALTOPICSC","Total sujets :&nbsp;");
define("_MDEX_TOTALPOSTSC","Total envois :&nbsp;");
define("_MDEX_TIMENOW","Nous sommes le %s");
define("_MDEX_LASTVISIT","Votre derni&egrave;re visite remonte au : %s");
define("_MDEX_ADVSEARCH","Recherche avanc&eacute;e");
define("_MDEX_POSTEDON","Envoy&eacute; sur :&nbsp;");
define("_MDEX_SUBJECT","Sujet :&nbsp;");

//page_header.php
define("_MDEX_MODERATEDBY","Mod&eacute;r&eacute; par");
define("_MDEX_SEARCH","Recherche");
define("_MDEX_SEARCHRESULTS","R&eacute;sultats de la recherche");
define("_MDEX_FORUMINDEX","Index des forums de %s");
define("_MDEX_POSTNEW","Poster un nouveau message");
define("_MDEX_REGTOPOST","Enregistrez-vous pour poster");

//search.php
define("_MDEX_KEYWORDS","Mots cl&eacute;s :");
define("_MDEX_SEARCHANY","Recherche par N'IMPORTE QUEL terme (D&eacute;faut)");
define("_MDEX_SEARCHALL","Recherche par TOUS les termes");
define("_MDEX_SEARCHALLFORUMS","Recherche dans tous les forums");
define("_MDEX_FORUMC","Forum :");
define("_MDEX_SORTBY","Tri&eacute; par :");
define("_MDEX_DATE","Date");
define("_MDEX_TOPIC","Sujet");
define("_MDEX_USERNAME","Pseudo");
define("_MDEX_SEARCHIN","Recherche dans :");
define("_MDEX_BODY","Corps");
define("_MDEX_NOMATCH","Aucun enregistrement correspondant &agrave; la demande. Merci d'affiner votre recherche.");
define("_MDEX_POSTTIME","Heure d'envoi");

//viewforum.php
define("_MDEX_REPLIES","R&eacute;ponses");
define("_MDEX_POSTER","Exp&eacute;diteur");
define("_MDEX_VIEWS","Lectures");
define("_MDEX_MORETHAN","Nouveaux envois [ Populaire ]");
define("_MDEX_MORETHAN2","Pas de nouveaux envois [ Populaire ]");
define("_MDEX_TOPICSTICKY","Sujet sensible (Reste au sommet)");
define("_MDEX_TOPICLOCKED","Sujet verrouill&eacute;");
define("_MDEX_LEGEND","L&eacute;gende");
define("_MDEX_NEXTPAGE","Page suivante");
define("_MDEX_SORTEDBY","Tri&eacute; par");
define("_MDEX_TOPICTITLE","titre du sujet");
define("_MDEX_NUMBERREPLIES","nombre de r&eacute;ponses");
define("_MDEX_TOPICPOSTER","exp&eacute;diteur du sujet");
define("_MDEX_LASTPOSTTIME","heure du dernier envoi");
define("_MDEX_ASCENDING","Ordre ascendant");
define("_MDEX_DESCENDING","Ordre descendant");
define("_MDEX_FROMLASTDAYS","Depuis les %s derniers jours");
define("_MDEX_THELASTYEAR","Depuis la derni&egrave;re ann&eacute;e");
define("_MDEX_BEGINNING","Depuis le d&eacute;but");

//viewtopic.php
define("_MDEX_AUTHOR","Auteur");
define("_MDEX_LOCKTOPIC","Verrouiller ce sujet");
define("_MDEX_UNLOCKTOPIC","D&eacute;verrouiller ce sujet");
define("_MDEX_STICKYTOPIC","Rendre ce sujet sensible");
define("_MDEX_UNSTICKYTOPIC","Rendre ce sujet non-sensible");
define("_MDEX_MOVETOPIC","D&eacute;placer ce sujet");
define("_MDEX_DELETETOPIC","Supprimer ce sujet");
define("_MDEX_TOP","Top");
define("_MDEX_PARENT","Parent");
define("_MDEX_PREVTOPIC","Sujet pr&eacute;c&eacute;dent");
define("_MDEX_NEXTTOPIC","Sujet suivant");

//forumform.inc
define("_MDEX_ABOUTPOST","A propos des envois");
define("_MDEX_ANONCANPOST","Les utilisateurs <b>Anonymes</b> peuvent poster de nouveaux sujets et r&eacute;pondre dans ce forum");
define("_MDEX_PRIVATE","Ceci est un forum <b>priv&eacute;</b>.<br />Seuls les utilisateurs avec un acc&egrave;s sp&eacute;cial peuvent poster des nouveaux sujets et r&eacute;pondre dans ce forum");
define("_MD_REGCANPOST","Tous les utilisateurs <b>enregistr&eacute;s</b> peuvent poster des nouveaux sujets et r&eacute;pondre dans ce forum");
define("_MDEX_MODSCANPOST","Seul les <B>Mod&eacute;rateurs et Administrateurs</b> peuvent poster de nouveaux sujets et r&eacute;pondre dans ce forum");
define("_MDEX_PREVPAGE","Page pr&eacute;c&eacute;dante");
define("_MDEX_QUOTE","Citation");

// ERROR messages
define("_MDEX_ERRORFORUM","ERREUR : Forum non s&eacute;lectionn&eacute; !");
define("_MDEX_ERRORPOST","ERREUR : Envoi non s&eacute;lectionn&eacute; !");
define("_MDEX_NORIGHTTOPOST","Vous n'avez pas le droit de poster dans ce forum.");
define("_MDEX_NORIGHTTOACCESS","Vous n'avez pas le droit d'acc&eacute;der &agrave; ce forum.");
define("_MDEX_ERRORTOPIC","ERREUR : Sujet non s&eacute;lectionn&eacute; !");
define("_MDEX_ERRORCONNECT","ERREUR : Impossible de se connecter &agrave; la base de donn&eacute;es des forums.");
define("_MDEX_ERROREXIST","ERREUR : Le forum que vous avez s&eacute;lectionn&eacute; n'existe pas. Merci de retourner en arri&egrave;re et de recommencer.");
define("_MDEX_ERROROCCURED","Une erreur est survenue");
define("_MDEX_COULDNOTQUERY","Impossible d'interroger la base de donn&eacute;es des forums.");
define("_MDEX_FORUMNOEXIST","Erreur - Le forum/sujet que vous avez s&eacute;lectionn&eacute; n'existe pas. Merci de retourner en arri&egrave;re et de recommencer.");
define("_MDEX_USERNOEXIST","Cet utilisateur n'existe pas. Merci de retourner en arri&egrave;re et de recommencer.");
define("_MDEX_COULDNOTREMOVE","Erreur - Impossible de supprimer les envois de la base de donn&eacute;es !");
define("_MDEX_COULDNOTREMOVETXT","Erreur - Impossible de supprimer les textes des envois !");

//reply.php
define("_MDEX_ON","le"); //Posted on
define("_MDEX_USERWROTE","%s a &eacute;crit :"); // %s is username

//post.php
define("_MDEX_EDITNOTALLOWED","Vous n'&ecirc;tes pas autoris&eacute; &agrave; &eacute;diter cet envoi !");
define("_MDEX_EDITEDBY","Edit&eacute; par");
define("_MDEX_ANONNOTALLOWED","Les utilisateurs Anonymes ne sont pas autoris&eacute;s &agrave; poster.<br>Merci de vous enregistrer.");
define("_MDEX_THANKSSUBMIT","Merci pour votre participation !");
define("_MDEX_REPLYPOSTED","Un r&eacute;ponse &agrave; votre sujet a &eacute;t&eacute; post&eacute;e."); // mail
define("_MDEX_HELLO","Bonjour %s,"); // mail
define("_MDEX_URRECEIVING","Vous recevez cette e-mail parce qu'un message, que vous avez post&eacute; sur les forums de %s, a re&ccedil;u une r&eacute;ponse."); // mail - %s is your site name
define("_MDEX_CLICKBELOW","Cliquez sur le lien ci-dessous pour voir la conversation :"); // mail

//forumform.inc
define("_MDEX_YOURNAME","Votre nom :");
define("_MDEX_LOGOUT","D&eacute;connexion");
define("_MDEX_REGISTER","Inscription");
define("_MDEX_SUBJECTC","Sujet :");
define("_MDEX_MESSAGEICON","Ic&ocirc;ne du message :");
define("_MDEX_MESSAGEC","Message :");
define("_MDEX_ALLOWEDHTML","HTML autoris&eacute; :");
define("_MDEX_OPTIONS","Options :");
define("_MDEX_POSTANONLY","Poster anonymement");
define("_MDEX_DISABLESMILEY","D&eacute;sactiver les &eacute;motic&ocirc;nes");
define("_MDEX_DISABLEHTML","D&eacute;sactiver le html");
define("_MDEX_NEWPOSTNOTIFY", "Notifiez-moi des nouveaux envois dans cette discussion");
define("_MDEX_ATTACHSIG","Attacher la signature");
define("_MDEX_POST","Envoi");
define("_MDEX_SUBMIT","Valider");
define("_MDEX_CANCELPOST","Annuler");

// forumuserpost.php
define("_MDEX_ADD","Ajouter");
define("_MDEX_REPLY","R&eacute;pondre");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","Vous n'&ecirc;tes pas le mod&eacute;rateur de ce forum donc vous ne pouvez pas ex&eacute;cuter cette fonction.");
define("_MDEX_TTHBRFTD","Le sujet a &eacute;t&eacute; supprim&eacute; de la base de donn&eacute;es.");
define("_MDEX_RETURNTOTHEFORUM","Retour au forum");
define("_MDEX_RTTFI","Retour &agrave; l'index des forums");
define("_MDEX_EPGBATA","Erreur - Merci des retourner en arri&egrave;re et de recommencer.");
define("_MDEX_TTHBM","Le sujet a &eacute;t&eacute; d&eacute;plac&eacute;.");
define("_MDEX_VTUT","Voir le sujet mis &agrave; jour");
define("_MDEX_TTHBL","Le sujet a &eacute;t&eacute; verrouill&eacute;.");
define("_MDEX_TTHBS","Le sujet a &eacute;t&eacute; mis sensible.");
define("_MDEX_TTHBUS","Le sujet a &eacute;t&eacute; mis non-sensible.");
define("_MDEX_VIEWTHETOPIC","Voir le sujet");
define("_MDEX_TTHBU","Le sujet a &eacute;t&eacute; d&eacute;verrouill&eacute;.");
define("_MDEX_OYPTDBATBOTFTTY","Lorsque vous pressez le bouton au bas de ce formulaire, le sujet que vous avez choisi et tous les envois li&eacute;s, seront <b>supprim&eacute;s</b> de mani&egrave;re permanente.");
define("_MDEX_OYPTMBATBOTFTTY","Lorsque vous pressez le bouton au bas de ce formulaire, le sujet que vous avez choisi et tous les envois li&eacute;s, seront <b>d&eacute;plac&eacute;</b> vers le forum que vous avez s&eacute;lectionn&eacute;.");
define("_MDEX_OYPTLBATBOTFTTY","Lorsque vous pressez le bouton de verrouillage au bas de ce formulaire, le sujet que vous avez choisi sera <b>verrouill&eacute;</b>. Vous pouvez le d&eacute;verrouiller plus tard si vous le d&eacute;sirez.");
define("_MDEX_OYPTUBATBOTFTTY","Lorsque vous pressez le bouton de d&eacute;verrouillage au bas de ce formulaire, le sujet que vous avez choisi sera <b>d&eacute;verrouill&eacute;</b>. Vous pouvez le verrouiller &agrave; nouveau plus tard si vous le d&eacute;sirez.");
define("_MDEX_OYPTSBATBOTFTTY","Lorsque vous pressez le bouton Sensible au bas de ce formulaire, le sujet que vous avez choisi va &ecirc;tre <b>sensible</b>. Vous pouvez le rendre non-sensible plus tard si vous le d&eacute;sirez");
define("_MDEX_OYPTTBATBOTFTTY","Lorsque vous pressez le bouton non-sensible au bas de ce formulaire, le sujet que vous avez choisi va &ecirc;tre <b>non-sensible</b>. Vous pouvez le rendre sensible &agrave; nouveau plus tard si vous le d&eacute;sirez");
define("_MDEX_MOVETOPICTO","D&eacute;placer le sujet vers :");
define("_MDEX_NOFORUMINDB","Pas de forums dans la base de donn&eacute;es");
define("_MDEX_DATABASEERROR","Erreur de base de donn&eacute;es");
define("_MDEX_DELTOPIC","Supprimer le Sujet");

// delete.php
define("_MDEX_DELNOTALLOWED","D&eacute;sol&eacute;, mais vous n'&ecirc;tes pas autoris&eacute; &agrave; supprimer cet envoi.");
define("_MDEX_AREUSUREDEL","Etes-vous s&ucirc;r de vouloir supprimer cet envoi et toutes ses r&eacute;ponses ?");
define("_MDEX_POSTSDELETED","L'envoi s&eacute;lectionn&eacute; et toutes ses r&eacute;ponses ont &eacute;t&eacute; supprim&eacute;s.");

// definitions moved from global.
define("_MDEX_THREAD","Conversation");
define("_MDEX_FROM","De");
define("_MDEX_JOINED","Inscrit le");
define("_MDEX_ONLINE","En ligne");
define("_MDEX_BOTTOM","Bas");

// ajout Hervé
define("_MDEX_POSTWITHOUTANSWER","Voir les sujets sans r&eacute;ponses");

// Added version 1.5
define("_MDEX_ATTACH_FILE","Joindre un fichier");
define("_MDEX_ATTACHED_FILES","Fichier(s) joint(s)");
define("_MDEX_UPLOAD_DBERROR_SAVE","Erreur pendant le rattachement du fichier au post");
define('_MDEX_UPLOAD_ERROR',"Erreur pendant le téléchargement du fichier");
?>