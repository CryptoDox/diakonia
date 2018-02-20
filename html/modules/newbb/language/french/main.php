<?php
// $Id: main.php 849 2009-09-15 22:09:49Z kris_fr $
if(defined('MAIN_DEFINED')) return;
define('MAIN_DEFINED',true);

define("_MD_ERROR","Erreur");
define("_MD_NOPOSTS","Aucune contribution");
define("_MD_GO","Ok");
define("_MD_SELFORUM","S&#233;lectionner un forum");

define("_MD_THIS_FILE_WAS_ATTACHED_TO_THIS_POST","Fichier attach&#233; :");
define("_MD_ALLOWED_EXTENSIONS","Extensions autoris&#233;es");
define('_MD_MAX_FILESIZE','Taille maximum du fichier');
define("_MD_ATTACHMENT","Attacher un fichier");
define("_MD_FILESIZE","Taille");
define("_MD_HITS","Hits");
define("_MD_GROUPS","Groupes :");
define("_MD_DEL_ONE","Effacer seulement ce message");
define("_MD_DEL_RELATED","Effacer tous les messages de ce sujet");
define('_MD_MARK_ALL_FORUMS','Marquer tous les forums');
define('_MD_MARK_ALL_TOPICS','Marquer tous les sujets');
define('_MD_MARK_UNREAD','non lus');
define('_MD_MARK_READ','lus ');
define('_MD_ALL_FORUM_MARKED','tous les forums marqu&#233;s');
define('_MD_ALL_TOPIC_MARKED','tous les sujets marqu&#233;s');
define('_MD_BOARD_DISCLAIMER',"Message d'avertissement");


//index.php
define ("_MD_ADMINCP", "Console d&#39;administration");
define ("_MD_FORUM", "Forum(s)");
define ("_MD_WELCOME", "Bienvenue sur les forums de %s.");
define ("_MD_TOPICS", "Sujets");
define ("_MD_POSTS", "Messages");
define ("_MD_LASTPOST", "Derniers messages");
define ("_MD_MODERATOR", "Mod&#233;rateur(s)");
define ("_MD_NEWPOSTS", "nouveau(x) messages(s)");
define ("_MD_NONEWPOSTS", "Aucun nouveau message");
define ("_MD_PRIVATEFORUM", "Forum inactif;");
define ("_MD_BY", "par"); //  Post&#233; par
define ("_MD_TOSTART", "Pour consulter les messages, vous devez s&#233;lectionner un forum parmi ceux ci-dessous.");
define ("_MD_TOTALTOPICSC", "Total sujets : ");
define ("_MD_TOTALPOSTSC", "Total messages : ");
define ("_MD_TOTALUSER", "Total utilisateurs : ");
define ("_MD_TIMENOW", "Nous sommes le  : %s");
define ("_MD_LASTVISIT", "Votre derni&#232;re visite : %s");
define ("_MD_ADVSEARCH", "Recherche avanc&#233;e");
define ("_MD_POSTEDON", "Post&#233; le : ");
define ("_MD_SUBJECT", "Sujet");
define ("_MD_INACTIVEFORUM_NEWPOSTS", "Forum inactif contenant de nouveau(x) message(s)");
define ("_MD_INACTIVEFORUM_NONEWPOSTS", "Forum inactif sans nouveau message");
define ("_MD_SUBFORUMS", "Sous-forums");
define ('_MD_MAINFORUMOPT', 'Options du menu');
define ("_MD_PENDING_POSTS_FOR_AUTH","Messages en attente d&#39;approbation :");



//page_header.php
define ("_MD_MODERATEDBY", "Mod&#233;r&#233; par");
define ("_MD_SEARCH", "Recherche");
//define ("_MD_SEARCHRESULTS", "R&#233;sultats de la recherche");
define ("_MD_FORUMINDEX","Index des forums %s");
define ("_MD_POSTNEW", "Ecrire un nouveau message");
define ("_MD_REGTOPOST", "S&#39;enregistrer pour contribuer");

//search.php
define ("_MD_SEARCHALLFORUMS", "Recherche dans tous les forums");
define ("_MD_FORUMC", "Forum");
define ("_MD_AUTHORC", "Auteur :");
define ("_MD_SORTBY", "Tri par");
define ("_MD_DATE", "Derni&#232;res r&#233;ponses");
define ("_MD_TOPIC", "Sujet ");
define('_MD_POST2','Contribution');
define ("_MD_USERNAME", "Nom d&#39;utilisateur");
define ("_MD_BODY", "Corps de texte");
define('_MD_SINCE','Depuis');

//viewforum.php
define ("_MD_REPLIES", "R&#233;ponses");
define ("_MD_POSTER", "Auteurs");
define ("_MD_VIEWS", "Lectures");
define ("_MD_MORETHAN", "Nouveaux [Populaire(s)]");
define ("_MD_MORETHAN2", "Aucun nouveau [Populaire]");
define ('_MD_TOPICSHASATT','Le sujet a une pi&#232;ce jointe');
define ('_MD_TOPICHASPOLL','Le sujet a un sondage');
define ('_MD_TOPICLOCKED','Le sujet est verrouill&#233;');
define ("_MD_LEGEND", "L&#233;gende");
define ("_MD_NEXTPAGE", "prochaine page");
define ("_MD_SORTEDBY", "Trier par");
define ("_MD_TOPICTITLE", "Titre du sujet");
define ("_MD_NUMBERREPLIES", "Nombre de r&#233;ponses");
define ("_MD_TOPICPOSTER", "Participation(s) au sujet");
define ('_MD_TOPICTIME','Publi&#233; le');
define ("_MD_LASTPOSTTIME", "Heure de la derni&#232;re contribution");
define ("_MD_ASCENDING", "Ordre ascendant");
define ("_MD_DESCENDING", "Ordre descendant");
define ('_MD_FROMLASTHOURS','Des % derni&#232;res heures');
define ("_MD_FROMLASTDAYS", "Des %d derniers jours");
define ("_MD_THELASTYEAR", "Des derni&#232;res ann&#233;es");
define ("_MD_BEGINNING", "Du d&#233;but");
define ('_MD_SEARCHTHISFORUM', 'Rechercher ce forum');
define ('_MD_TOPIC_SUBJECTC',"Pr&#233;fixe du sujet :");


define ('_MD_RATINGS', "Cotations");
define("_MD_CAN_ACCESS", "Vous <strong>pouvez</strong> acc&#233;der &#224; ce forum.<br />");
define("_MD_CANNOT_ACCESS", "Vous <strong>ne pouvez pas</strong> acc&#233;der &#224; ce forum.<br />");
define ("_MD_CAN_POST", "Vous <strong>pouvez</strong> d&#233;buter de nouveaux sujets.<br />");
define ("_MD_CANNOT_POST", "Vous <strong>ne pouvez pas</strong> d&#233;buter de nouveaux sujets.<br />");
define ("_MD_CAN_VIEW", "Vous <strong>pouvez</strong> voir les sujets.<br />");
define ("_MD_CANNOT_VIEW", "Vous <strong>ne pouvez pas</strong> voir les sujets.<br />");
define ("_MD_CAN_REPLY", "Vous <strong>pouvez</strong> r&#233;pondre aux contributions.<br />");
define ("_MD_CANNOT_REPLY", "Vous <strong>ne pouvez pas</strong> r&#233;pondre aux contributions.<br />");
define ("_MD_CAN_EDIT", "Vous <strong>pouvez</strong> &#233;diter vos contributions.<br />");
define ("_MD_CANNOT_EDIT", "Vous <strong>ne pouvez pas</strong> &#233;diter vos contributions.<br />");
define ("_MD_CAN_DELETE", "Vous <strong>pouvez</strong> effacer vos contributions.<br />");
define ("_MD_CANNOT_DELETE", "Vous <strong>ne pouvez pas</strong> effacez vos contributions.<br />");
define ("_MD_CAN_ADDPOLL", "Vous <strong>pouvez</strong> ajouter de nouveaux sondages.<br />");
define ("_MD_CANNOT_ADDPOLL", "Vous <strong>ne pouvez pas</strong> ajouter de nouveaux sondages.<br />");
define ("_MD_CAN_VOTE", "Vous <strong>pouvez</strong> voter en sondage.<br />");
define ("_MD_CANNOT_VOTE", "Vous <strong>ne pouvez pas</strong> voter en sondage.<br />");
define ("_MD_CAN_ATTACH", "Vous <strong>pouvez</strong> attacher des fichiers &#224; vos contributions.<br />");
define ("_MD_CANNOT_ATTACH", "Vous <strong>ne pouvez pas</strong> attacher des fichiers &#224; vos contributions.<br />");
define ("_MD_CAN_NOAPPROVE", "Vous <strong>pouvez</strong> poster sans approbation.<br />");
define ("_MD_CANNOT_NOAPPROVE", "Vous <strong>ne pouvez pas</strong> poster sans approbation.<br />");
define ("_MD_IMTOPICS", "Sujets importants");
define ("_MD_NOTIMTOPICS", "Sujets des forums");
define ('_MD_FORUMOPTION', 'Options des forums');

define('_MD_VAUP','Voir tous les sujets sans r&#233;ponse');
define('_MD_VANP','Voir les nouveaux sujets');


define('_MD_UNREPLIED','sujets sans r&#233;ponse');
define('_MD_UNREAD','sujets non lus');
define('_MD_ALL','tous les sujets');
define('_MD_ALLPOSTS','tous les messages');
define('_MD_VIEW','Voir');

//viewtopic.php
define ("_MD_AUTHOR", "Auteur");
define ("_MD_LOCKTOPIC", "Verrouiller ce sujet");
define ("_MD_UNLOCKTOPIC", "D&#233;verrouiller ce sujet");
define ("_MD_UNSTICKYTOPIC", "D&#233;sagrafer ce sujet");
define ("_MD_STICKYTOPIC", "Agrafer ce sujet");
define('_MD_DIGESTTOPIC','Sommairiser ce sujet');
define('_MD_UNDIGESTTOPIC','D&#233;sommairiser ce sujet');
define('_MD_MERGETOPIC','Fusionner ce sujet');
define ("_MD_MOVETOPIC", "D&#233;placer ce sujet");
define ("_MD_DELETETOPIC", "Effacer ce sujet");
define ("_MD_TOP", "Haut");
define('_MD_BOTTOM','Bas');
define ("_MD_PREVTOPIC", "Pr&#233;c&#233;dent");
define ("_MD_NEXTTOPIC", "Suivant");
define ("_MD_GROUP", "Groupe :");
define ("_MD_QUICKREPLY", "R&#233;ponse rapide");
define ("_MD_POSTREPLY", "Enregistrer votre r&#233;ponse");
define ("_MD_PRINTTOPICS", "Imprimer le sujet");
define ("_MD_PRINT", "Imprimer");
define ("_MD_REPORT", "Rapport");
define ("_MD_PM", "PM");
define('_MD_EMAIL','Email');
define ("_MD_WWW", "WWW");
define ("_MD_AIM", "AIM");
define ("_MD_YIM", "YIM");
define ("_MD_MSNM", "MSNM");
define ("_MD_ICQ", "ICQ");
define ("_MD_PRINT_TOPIC_LINK", "URL de cette discussion");
define ("_MD_ADDTOLIST", "Ajouter &#224; votre liste de contact");
define('_MD_TOPICOPT', 'Options du sujet');
define('_MD_VIEWMODE', 'Affichage');
define('_MD_NEWEST', 'les plus r&#233;cents en premier');
define('_MD_OLDEST', 'les plus anciens en premier');

define('_MD_FORUMSEARCH','Recherche');

define('_MD_RATED','Not&#233; :');
define('_MD_RATE','Cotations');
define('_MD_RATEDESC','Donner une note');
define('_MD_RATING','Voter');
define('_MD_RATE1','Terrible');
define('_MD_RATE2','Mauvais');
define('_MD_RATE3','Passable');
define('_MD_RATE4','Bon!!!');
define('_MD_RATE5','Excellent');

define('_MD_TOPICOPTION','Options du sujet');
define('_MD_KARMA_REQUIREMENT', 'Votre Karma personnel %s est inf&#233;rieur au Karma requis %s. <br /> Veuillez essayer plus tard.');
define('_MD_REPLY_REQUIREMENT', "Afin de visualiser cette contribution, vous devez d&#39;abord r&#233;pondre.");
define('_MD_TOPICOPTIONADMIN','Options des sujets');
define('_MD_POLLOPTIONADMIN','Options de sondage');

define('_MD_EDITPOLL','Editer ce sondage');
define('_MD_DELETEPOLL','Effacer ce sondage');
define('_MD_RESTARTPOLL','Relancer ce sondage');
define('_MD_ADDPOLL','Ajouter un sondage');

define("_MD_QUICKREPLY_EMPTY","Entrez votre r&#233;ponse rapide ici");

define('_MD_LEVEL','Niveau :');
define('_MD_HP','HP :');
define('_MD_MP','MP :');
define('_MD_EXP','EXP :');

define('_MD_BROWSING','Parcourir ce sujet :');
define('_MD_POSTTONEWS','Envoyer ce message comme un article d&#39;actualit&#233;');

define('_MD_EXCEEDTHREADVIEW','Le nombre des contributions d&#233;passe les capacit&#233;s du mode par sujet<br />Changez pour le mode &#224; plat');


//forumform.inc
define ("_MD_PRIVATE", "Ceci est un forum <strong>priv&#233;</strong>.<br />seuls les utilisateurs disposant des droits d&#39;acc&#232;s sp&#233;ciaux peuvent proposer de nouveaux sujets et r&#233;pondre");
define ("_MD_QUOTE", "Citation");
define ('_MD_VIEW_REQUIRE','Pr&#233;requis de visualisation');
define ('_MD_REQUIRE_KARMA','Karma');
define ('_MD_REQUIRE_REPLY','R&#233;pondre');
define ('_MD_REQUIRE_NULL','Aucun pr&#233;requis');

define ("_MD_SELECT_FORMTYPE","S&#233;lectionnez votre type de formulaire d&#233;sir&#233;");

define ("_MD_FORM_COMPACT","Compact");
define ("_MD_FORM_DHTML","DHTML");
define ("_MD_FORM_SPAW","Editeur Spaw");
define ("_MD_FORM_HTMLAREA","HTMLArea");
define ("_MD_FORM_KOIVI","Editeur Koivi");
define ("_MD_FORM_FCK","Editeur FCK");
define ("_MD_FORM_TINYMCE","Editeur TinyMCE");

// Messages d'ERREURS
define ("_MD_ERRORFORUM", "ERREUR : Aucun forum n&#39;a &#233;t&#233; s&#233;lectionn&#233;!");
define ("_MD_ERRORPOST", "ERREUR : Aucune contribution n&#39;a &#233;t&#233; s&#233;lectionn&#233;e!");
define ('_MD_NORIGHTTOVIEW','Vous ne disposez pas des privil&#232;ges pour visualiser ce sujet.');
define ('_MD_NORIGHTTOPOST','Vous ne disposez pas des privil&#232;ges pour contribuer &#224; ce forum.');
define ('_MD_NORIGHTTOEDIT','Vous ne disposez pas des privil&#232;ges pour &#233;diter dans ce forum.');
define ('_MD_NORIGHTTOREPLY','Vous ne disposez pas des privil&#232;ges pour r&#233;pondre dans ce forum.');
define ('_MD_NORIGHTTOACCESS','Vous ne disposez pas des privil&#232;ges pour acc&#233;der &#224; ce forum.');
define ('_MD_ERRORTOPIC','ERREUR : Sujet non s&#233;lectionn&#233;!');
define ('_MD_ERRORCONNECT','ERREUR : ne peut pas se connecter &#224; la base de donn&#233;es du forum.');
define ('_MD_ERROREXIST',"ERREUR : Le forum que vous avez s&#233;lectionn&#233; n&#39;existe pas. Veuillez revenir en arri&#232;re et recommencer.");
define ("_MD_ERROROCCURED", "Une erreur est apparue");
define ("_MD_COULDNOTQUERY", "ne parvient pas &#224; interroger la base de donn&#233;es des forums.");
define ("_MD_FORUMNOEXIST", "Erreur - Le forum/sujet que vous avez s&#233;lectionn&#233; n&#39;existe pas. Veuillez revenir en arri&#232;re et r&#233;essayez.");
define ("_MD_USERNOEXIST", "Cet utilisateur n&#39;existe pas. Veuillez revenir en arri&#232;re et rechercher encore.");
define ("_MD_COULDNOTREMOVE", "Erreur - ne peut supprimer les contributions de la base de donn&#233;es!");
define ("_MD_COULDNOTREMOVETXT", "Erreur - ne peut supprimer les textes des contributions!");
define ('_MD_TIMEISUP',"Vous avez d&#233;pass&#233; la limite du temps imparti &#224; l&#39;&#233;dition de ce post.");
define ('_MD_TIMEISUPDEL',"Vous avez d&#233;pass&#233; la limite du temps imparti &#224; l&#39;effacement de votre contribution.");

//reply.php
define ("_MD_ON", "sur"); //D&#233;pos&#233; sur
define ("_MD_USERWROTE","%s a &#233;crit :"); //%s est le pseudo de l'utilisateur
define('_MD_RE','Re');

//post.php
define ("_MD_EDITNOTALLOWED", "Vous n&#39;&#234;tes pas autoris&#233;s &#224; &#233;diter cette contribution!");
define ("_MD_EDITEDBY", "Edit&#233; par");
define ("_MD_ANONNOTALLOWED", "les utilisateurs anonymes ne sont pas autoris&#233;s &#224; participer.<br />Veuillez vous enregistrer.");
define ("_MD_THANKSSUBMIT", "Merci pour votre contribution!");
define ("_MD_REPLYPOSTED", "Une r&#233;ponse &#224; votre sujet vient d&#39;&#234;tre post&#233;e.");
define ("_MD_HELLO", "Bonjour %s,");
define ("_MD_URRECEIVING", "Vous recevez cet email parce qu&#39;une r&#233;ponse &#224; votre contribution a &#233;t&#233; post&#233;e sur les forums de %s.");//%s est votre nom de votre site
define ("_MD_CLICKBELOW", "Cliquez sur le lien afin de visualiser la discussion :");
define ('_MD_WAITFORAPPROVAL',"Veuillez patienter pour l&#39;approbation.");
define ('_MD_POSTING_LIMITED','Pourquoi ne pas faire une pause et revenir dans %d secondes');

//forumform.inc
define ('_MD_NAMEMAIL','Nom/Email :');
define ("_MD_LOGOUT", "Se d&#233;connecter");
define ("_MD_REGISTER", "S&#39;enregistrer");
define ("_MD_SUBJECTC", "Titre du sujet :");
define ("_MD_MESSAGEICON", "Ic&#244;ne du message :");
define ("_MD_MESSAGEC", "Message :");
define ("_MD_ALLOWEDHTML", "Autoriser le langage HTML :");
define ("_MD_OPTIONS", "Options :");
define ("_MD_POSTANONLY", "Poster anonymement");
define ('_MD_DOSMILEY','Activer les &#233;moticones');
define ('_MD_DOXCODE','Activer les codes Xoops');
define ('_MD_DOBR','Activation du line break (Sugg&#233;r&#233; non activ&#233; si le langage HTML est activ&#233;)');
define ('_MD_DOHTML','Activer les balises HTML');
define ("_MD_NEWPOSTNOTIFY", "Notifiez-moi les nouvelles contributions sur ce sujet");
define ("_MD_ATTACHSIG", "Attacher la signature");
define ("_MD_POST", "Poster");
define ("_MD_SUBMIT", "Valider");
define ("_MD_CANCELPOST", "Abandonner");
define ('_MD_REMOVE','Enlever');
define ('_MD_UPLOAD','T&#233;l&#233;charger');

// forumuserpost.php
define ("_MD_ADD", "Ajouter");
define ("_MD_REPLY", "R&#233;ponse");

// topicmanager.php
define('_MD_VIEWTHETOPIC','Voir le sujet');
define('_MD_RETURNTOTHEFORUM','Retourner au forum');
define('_MD_RETURNFORUMINDEX',"Retourner &#224; l'index des forums");
define('_MD_ERROR_BACK','Erreur - veuillez aller en arri&#232;re et recommencer.');
define('_MD_GOTONEWFORUM','Voir le sujet mis &#224; jour');

define('_MD_TOPICDELETE','Le sujet a &#233;t&#233; effac&#233;');
define('_MD_TOPICMERGE','Le sujet a &#233;t&#233; fusionn&#233;.');
define('_MD_TOPICMOVE','Le sujet a &#233;t&#233; d&#233;plac&#233;');
define('_MD_TOPICLOCK','Le sujet est verrouill&#233;');
define('_MD_TOPICUNLOCK','Le sujet a &#233;t&#233; d&#233;verrouill&#233;');
define('_MD_TOPICSTICKY','Le sujet est agraf&#233;');
define('_MD_TOPICUNSTICKY','Le sujet a &#233;t&#233; d&#233;sagraf&#233;');
define('_MD_TOPICDIGEST','Le sujet est sommairis&#233;');
define('_MD_TOPICUNDIGEST','Le sujet a &#233;t&#233; d&#233;sommairis&#233;');

define('_MD_DELETE','Effacer');
define('_MD_MOVE','D&#233;placer');
define('_MD_MERGE','Fusionner');
define('_MD_LOCK','Verrouiller');
define('_MD_UNLOCK','D&#233;verrouiller');
define('_MD_STICKY','Agrafer');
define('_MD_UNSTICKY','D&#233;sagrafer');
define('_MD_DIGEST','sujets en sommaire');
define('_MD_UNDIGEST','D&#233;sommairiser');

define('_MD_DESC_DELETE','Une fois que vous aurez cliqu&#233; sur le bouton <em>Effacer</em>, le sujet que vous avez s&#233;lectionn&#233; et toutes ses contributions relatives seront <strong>d&#233;finitivement</strong> effac&#233;s.');
define('_MD_DESC_MOVE','<p>Une fois que vous aurez cliqu&#233; sur le bouton <em>D&#233;placer</em>, le sujet que vous avez s&#233;lectionn&#233; et toutes ses contributions relatives seront d&#233;plac&#233;s vers le forum que vous aurez s&#233;lectionn&#233;.</p>');
define('_MD_DESC_MERGE','Une fois que vous aurez cliqu&#233; sur le bouton <em>Fusionner</em>, le sujet que vous avez s&#233;lectionn&#233; et toutes ses contributions relatives seront fusionn&#233;s dans le sujet que vous aurez s&#233;lectionn&#233;.<br /><strong>Le num&#233;ro de sujet de destination ID doit &#234;tre plus petit que celui du sujet courant</strong>.');
define('_MD_DESC_LOCK','Une fois que vous aurez cliqu&#233; sur le bouton <em>Verrouiller</em>, le sujet que vous avez s&#233;lectionn&#233; sera verrouill&#233;. Vous pourrez le d&#233;verrouiller plus tard si vous le d&#233;sirez.');
define('_MD_DESC_UNLOCK','Une fois que vous aurez cliqu&#233; sur le bouton <em>D&#233;verrouiller</em>, le sujet que vous avez s&#233;lectionn&#233; sera d&#233;verrouill&#233;. Vous pourrez le re-verrouiller plus tard si vous le d&#233;sirez.');
define('_MD_DESC_STICKY','Une fois que vous aurez cliqu&#233; sur le bouton <em>Agrafer</em>, le sujet que vous avez s&#233;lectionn&#233; sera mis en agrafe. Vous pourrez le d&#233;sagrafer plus tard si vous le d&#233;sirez.');
define('_MD_DESC_UNSTICKY','Une fois que vous aurez cliqu&#233; sur le bouton <em>D&#233;sagrafer</em>, le sujet que vous sera d&#233;-agraf&#233;,. Vous pourrez le r&#233;-agrafer plus tard si vous le d&#233;sirez.');
define('_MD_DESC_DIGEST','Une fois que vous aurez cliqu&#233; sur le bouton <em>Sujets en sommaire</em>, le sujet que vous avez s&#233;lectionn&#233; deviendra un sommaire. Vous pourrez le d&#233;sommairiser plus tard si vous le d&#233;sirez.');
define('_MD_DESC_UNDIGEST','Une fois que vous aurez cliqu&#233; sur le bouton <em>D&#233;sommairiser</em>, le sujet que vous avez s&#233;lectionn&#233; sera d&#233;sommairis&#233;. Vous pourrez le remettre en sommaire une nouvelle fois plus tard si vous le d&#233;sirez.');

define('_MD_MERGETOPICTO','Fusionner le sujet vers :');
define('_MD_MOVETOPICTO','D&#233;placer le sujet vers :');
define('_MD_NOFORUMINDB','Pas de forum dans la base');

// delete.php
define ("_MD_DELNOTALLOWED", "D&#233;sol&#233;, mais vous n&#39;&#234;tes pas autoris&#233; &#224; effacer ce message.");
define ("_MD_AREUSUREDEL", "Etes vous certain de d&#233;sirer effacer cette contribution et toutes les contributions enfants ?");
define ("_MD_POSTSDELETED", "La contribution S&#233;lectionn&#233;e et toutes ses contributions enfants ont &#233;t&#233; effac&#233;es.");
define ('_MD_POSTDELETED','Effacer la contribution s&#233;lectionn&#233;e.');

// les d&#233;finitions ont boug&#233; de global.
define ("_MD_THREAD", "Contribution");
define ("_MD_FROM", "De");
define ("_MD_JOINED", "Inscrit");
define ("_MD_ONLINE", "En ligne");
define ('_MD_OFFLINE','Hors Ligne');
define ('_MD_FLAT', 'A plat');


// class.whoisonline.php
define ("_MD_USERS_ONLINE", "Utilisateur(s) en ligne :");
define ("_MD_ANONYMOUS_USERS", "Utilisateur(s) anonymes");
define ("_MD_REGISTERED_USERS", "Utilisateur(s) enregistr&#233;s : ");
define ("_MD_BROWSING_FORUM", "Utilisateur(s) en consultation des forums");
define ("_MD_TOTAL_ONLINE", "Total %d utilisateurs en ligne.");
define ("_MD_ADMINISTRATOR", "Administrateur");

define('_MD_NO_SUCH_FILE',"Le fichier n&#39;existe pas!");
define('_MD_ERROR_UPATEATTACHMENT',"Une erreur s&#39;est produite &#224; la mise &#224; jour de la pi&#232;ce jointe");

// ratethread.php
define("_MD_CANTVOTEOWN", "Vous ne pouvez pas voter pour le sujet que vous avez soumis.<br />Tous les votes sont enregistr&#233;s et contr&#244;l&#233;s.");
define("_MD_VOTEONCE", "Merci de ne voter qu&#39;une seule fois pour le m&#234;me sujet.");
define("_MD_VOTEAPPRE", "Merci de votre vote.");
define("_MD_THANKYOU", "Merci d&#39;avoir pris le temps de voter ici sur %s"); // %s est le nom de votre site web
define("_MD_VOTES","Votes");
define("_MD_NOVOTERATE","Vous n&#39;avez pas not&#233; ce sujet");


// polls.php
define("_MD_POLL_DBUPDATED","Base de donn&#233;es mise &#224; jour avec succ&#232;s!");
define("_MD_POLL_POLLCONF","Configuration des sondages");
define("_MD_POLL_POLLSLIST", "Liste des sondages");
define("_MD_POLL_AUTHOR", "Auteur du sondage");
define("_MD_POLL_DISPLAYBLOCK", "Afficher dans un bloc ?");
define("_MD_POLL_POLLQUESTION", "Question du sondage");
define("_MD_POLL_VOTERS", "Total de votants");
define("_MD_POLL_VOTES", "Total de votes");
define("_MD_POLL_EXPIRATION", "Expiration");
define("_MD_POLL_EXPIRED", "Expir&#233;");
define("_MD_POLL_VIEWLOG","Voir le log");
define("_MD_POLL_CREATNEWPOLL", "Cr&#233;er un nouveau sondage");
define("_MD_POLL_POLLDESC", "Description du sondage");
define("_MD_POLL_DISPLAYORDER", "Ordre de visualisation");
define("_MD_POLL_ALLOWMULTI", "Autoriser les s&#233;lections multiples ?");
define("_MD_POLL_NOTIFY", "Notifier l&#39;auteur du sondage lorsque celui ci est expir&#233; ?");
define("_MD_POLL_POLLOPTIONS", "Options");
define("_MD_POLL_EDITPOLL", "Editer le sondage");
define("_MD_POLL_FORMAT", "Format : aaaa-mm-dd hh:mm:ss");
define("_MD_POLL_CURRENTTIME", "Nous sommes le %s");
define("_MD_POLL_EXPIREDAT", "Expir&#233; le %s");
define("_MD_POLL_RESTART", "Relancer ce sondage");
define("_MD_POLL_ADDMORE", "Ajouter plus d&#39;options");
define("_MD_POLL_RUSUREDEL", "Etes vous certain de vouloir effacer ce sondage et tous ses commentaires ?");
define("_MD_POLL_RESTARTPOLL", "Relancer le sondage");
define("_MD_POLL_RESET", "Mettre &#224; Z&#233;ro toutes les logs pour ce sondage ?");
define("_MD_POLL_ADDPOLL","Ajouter un sondage");
define("_MD_POLLMODULE_ERROR","Le module Xoopspoll n&#39;est pas valide &#224; l&#39;utilisation");

//report.php
define("_MD_REPORTED", "Merci de votre rapport au sujet de ce message! Un mod&#233;rateur le prendra en compte dans un court delai.");
define("_MD_REPORT_ERROR", "Une erreur est apparue lors de l&#39;envoi du rapport.");
define("_MD_REPORT_TEXT", "Rapport de message :");

define("_MD_PDF","Cr&#233;er un fichier PDF de la contribution");
define("_MD_PDF_PAGE","Page");

//print.php
define("_MD_COMEFROM","Cette contribution &#233;tait de :");

//viewpost.php
define("_MD_VIEWALLPOSTS","Tous les messages");
define("_MD_VIEWTOPIC","Sujet");
define("_MD_VIEWFORUM","Forum");

define("_MD_COMPACT","Compact");

define("_MD_MENU_SELECT","Liste de s&#233;lection");
define("_MD_MENU_HOVER","Menu d&#233;roulant");
define("_MD_MENU_CLICK","Menu d&#233;roulant par clic");

define("_MD_WELCOME_SUBJECT","%s &#224; rejoint le forum");
define("_MD_WELCOME_MESSAGE","Bonjour, %s est un petit nouveau.");

define("_MD_VIEWNEWPOSTS","Voir les nouveaux messages");

define("_MD_INVALID_SUBMIT","Soumission invalide. Vous avez peut &#234;tre d&#233;pass&#233; le temps de la session. Veuillez faire une sauvegarde de votre contribution et la ressoumettre.");

define("_MD_ACCOUNT","Compte");
define("_MD_NAME","Nom");
define("_MD_PASSWORD","Mot de passe");
define("_MD_LOGIN","Authentification");

define("_MD_TRANSFER","Transf&#233;rer");
define("_MD_TRANSFER_DESC","Transf&#233;rer la contribution vers d&#39;autres applications");
define("_MD_TRANSFER_DONE","Cette action a &#233;t&#233; effectu&#233;e avec succ&#232;s : %s");

define("_MD_APPROVE","Approuver");
define("_MD_RESTORE","Restaurer");
define("_MD_SPLIT_ONE","Eclater");
define("_MD_SPLIT_TREE","Eclater toutes les contributions enfin");
define("_MD_SPLIT_ALL","Eclater tout");

define("_MD_TYPE_ADMIN","Admin");
define("_MD_TYPE_VIEW","Vue");
define("_MD_TYPE_PENDING","En attente");
define("_MD_TYPE_DELETED","Supprim&#233;");
define("_MD_TYPE_SUSPEND","Suspension");

define("_MD_DBUPDATED", "Base de donn&#233;es mise &#224; jour avec succ&#232;s!");

define("_MD_SUSPEND_SUBJECT", "L&#39;utilisateur %s est suspendu depuis %d jours");
define("_MD_SUSPEND_TEXT", "L&#39;utilisateur %s est suspendu depuis %d jours en raison de :<br />[quote]%s[/quote]<br /><br />La suspension est effective jusqu&#39;au %s");
define("_MD_SUSPEND_UID", "Num&#233;ro ID Utilisateur");
define("_MD_SUSPEND_IP", "Segments d&#39;adresses IP (adresse en entier ou segments)");
define("_MD_SUSPEND_DURATION", "Dur&#233;e de la suspension (en jours)");
define("_MD_SUSPEND_DESC", "Motif de la suspension");
define("_MD_SUSPEND_LIST", "Liste des suspensions");
define("_MD_SUSPEND_START", "D&#233;but");
define("_MD_SUSPEND_EXPIRE", "Fin");
define("_MD_SUSPEND_SCOPE", "Scope");
define("_MD_SUSPEND_MANAGEMENT", "Gestion de la mod&#233;ration");
define("_MD_SUSPEND_NOACCESS", "Votre num&#233;ro d&#39;utilisateur ou votre adresse IP ont &#233;t&#233; suspendus");

// !!IMPORTANT!! insert '&#39; to any char among reserved chars: "a", "A","B","c","d","D","F","g","G","h","H","i","I","j","l","L","m","M","n","O","r","s","S","t","T","U","w","W","Y","y","z","Z"
// insert additional '&#39; to 't', 'r', 'n'
define("_MD_TODAY", "\A\u\j\o\u\\r\d\&#39;\h\u\i G:i:s");
define("_MD_YESTERDAY", "\H\i\e\\r G:i:s");
define("_MD_MONTHDAY", "d/m H:i:s");
define("_MD_YEARMONTHDAY", "d/m/Y H:i");

// For user info
// If you have customized userbar, define here.
require_once(XOOPS_ROOT_PATH."/modules/newbb/class/user.php");
class User_language extends User
{
    function User_language(&$user)
    {
            $this->User($user);
    }

    function &getUserbar()
    {
            global $xoopsModuleConfig, $xoopsUser, $isadmin;
            if (empty($xoopsModuleConfig['userbar_enabled'])) return null;
            $user =& $this->user;
            $userbar = array();
        $userbar[] = array("link"=>XOOPS_URL . "/userinfo.php?uid=" . $user->getVar("uid"), "name" =>_PROFILE);
                if (is_object($xoopsUser))
        $userbar[]= array("link"=>"javascript:void openWithSelfMain('" . XOOPS_URL . "/pmlite.php?send2=1&amp;to_userid=" . $user->getVar("uid") . "', 'pmlite', 450, 380);", "name"=>_MD_PM);
        if($user->getVar('user_viewemail') || $isadmin)
        $userbar[]= array("link"=>"javascript:void window.open('mailto:" . $user->getVar('email') . "', 'new');", "name"=>_MD_EMAIL);
        if($user->getVar('url'))
        $userbar[]= array("link"=>"javascript:void window.open('" . $user->getVar('url') . "', 'new');", "name"=>_MD_WWW);
        if($user->getVar('user_icq'))
        $userbar[]= array("link"=>"javascript:void window.open('http://wwp.icq.com/scripts/search.dll?to=" . $user->getVar('user_icq')."', 'new');", "name" => _MD_ICQ);
        if($user->getVar('user_aim'))
        $userbar[]= array("link"=>"javascript:void window.open('aim:goim?screenname=" . $user->getVar('user_aim') . "&amp;message=Hi+" . $user->getVar('user_aim') . "+Are+you+there?" . "', 'new');", "name"=>_MD_AIM);
        if($user->getVar('user_yim'))
        $userbar[]= array("link"=>"javascript:void window.open('http://edit.yahoo.com/config/send_webmesg?.target=" . $user->getVar('user_yim') . "&.src=pg" . "', 'new');", "name"=> _MD_YIM);
        if($user->getVar('user_msnm'))
        $userbar[]= array("link"=>"javascript:void window.open('http://members.msn.com?mem=" . $user->getVar('user_msnm') . "', 'new');", "name" => _MD_MSNM);
                return $userbar;
    }
}

/**
 * @translation     AFUX (Association Francophone des Utilisateurs de Xoops) <http://www.afux.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8
 *
 * @version         $Id: main.php 849 2009-09-15 22:09:49Z kris_fr $
**/
?>