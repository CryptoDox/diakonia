<?php
// $Id: main.php 1112 2010-01-28 18:27:34Z kris_fr $
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

//%%%%%%        File Name readpmsg.php         %%%%%
define("_PM_DELETED","Vos messages ont été effacés");
define("_PM_PRIVATEMESSAGE","Messages privés");
define("_PM_INBOX","Boîte de réception");
define("_PM_FROM","De");
define("_PM_YOUDONTHAVE","Vous n'avez aucun message privé");
define("_PM_FROMC","De : ");
define("_PM_SENTC","Envoyé : "); // The date of message sent
define("_PM_PROFILE","Profil");

// %s is a username
define("_PM_PREVIOUS","Message précédent");
define("_PM_NEXT","Message suivant");

//%%%%%%        File Name pmlite.php         %%%%%
define("_PM_SORRY","Désolé! Vous n'êtes pas un membre enregistré.");
define("_PM_REGISTERNOW","S'enregistrer maintenant!");
define("_PM_GOBACK","Retour");
define("_PM_USERNOEXIST","Le membre sélectionné n'existe pas dans la base de données.");
define("_PM_PLZTRYAGAIN","Veuillez vérifier le nom et réessayez.");
define("_PM_MESSAGEPOSTED","Votre message a été envoyé");
define("_PM_CLICKHERE","Tu peux cliquer ici pour voir tes messages privés");
define("_PM_ORCLOSEWINDOW","Ou clique ici pour fermer la fenêtre maintenant.");
define("_PM_USERWROTE","%s a écrit :");
define("_PM_TO","A : ");
define("_PM_SUBJECTC","Sujet : ");
define("_PM_MESSAGEC","Message : ");
define("_PM_CLEAR","Effacer");
define("_PM_CANCELSEND","Annuler l'envoi");
define("_PM_SUBMIT","Envoyer");
define("_PM_SAVEINOUTBOX", "Enregistrer une copie dans le dossier 'messages envoyés' ?");

//%%%%%%        File Name viewpmsg.php         %%%%%
define("_PM_SUBJECT","Objet");
define("_PM_DATE","Date");
define("_PM_NOTREAD","Non lu");
define("_PM_SEND","Envoyer");
define("_PM_DELETE","Effacer");
define("_PM_TOSAVE","Enregistrer");
define("_PM_UNSAVE","Supprimer l'enregistrement");
define("_PM_EMPTY","Vider la boîte");
define("_PM_REPLY", "Réponse");
define("_PM_PLZREG","S'il vous plaît, enregistrez d'abord pour envoyer les messages privés !");
define("_PM_SAVED_PART","Vous êtes autorisé à %d dans votre boîte de sauvegarde et vous avez déjà sauvardé %d messages sur la période");
define("_PM_SAVED_ALL","Les messages ont été déplacés dans votre boîte de sauvegarde");
define("_PM_UNSAVED","Les messages n'ont pu être déplacés dans votre boîte de sauvegarde");
define("_PM_EMPTIED","Votre boîte est pleine vide");
define("_PM_RUSUREEMPTY","Etes-vous certain de vouloir vider la boîte ?");
define("_PM_RUSUREDELETE","Confirmez-vous la suppression de ce(s) message(s)?");

define("_PM_ONLINE", "En ligne");

define("_PM_RECEIVE","Reçu");
define("_PM_POST","Posté");
define("_PM_READBOX","Boîte de lecture");
define("_PM_RSAVEBOX","Boîte de réception");
define("_PM_OUTBOX","Boîte d'envoi");
define("_PM_SAVEBOX","Sauvegarde");
define("_PM_SENTBOX","Messages envoyés");
define("_PM_PSAVEBOX","Post_SAVEBOX");
define("_PM_SAVE","Enregistrer");
define("_PM_SAVED","Enregistré avec succès");
define("_PM_TOC","De : ");

//WANISYS.NET PM HACK1.5
define("_PM_SORT","Tri");
define("_PM_ORDER","Ordre");
define("_PM_UID","UID du Partenaire");
define("_PM_TIME","Date d'envoi");
define("_PM_ASC","ASC");
define("_PM_DESC","DESC");
define("_PM_LIMIT","Messages privés par page");
define("_PM_BACKTOBOX","Retourner dans la boîte de réception");
define("_PM_SORTSUBMIT","Valider");
define("_PM_PREVIOUSP","Précédent");
define("_PM_NEXTP","Suivant");

define("_PM_MAILNOTIFY","%s-Vous avez un nouveau message privé de %s");
define("_PM_MAILMESSAGE","Bonjour!\nA Un nouveau message privé est arrivé de %s\n\nLe titre du message est\n%s\n\nTu peux visualiser ce message ici\n%s\n\n-----------\nTu as reçu ce message car tu as demandé d'être notifié quand tu reçois un nouveau message privé\n\nTu peux changer tes préférences pour les messages privés\n%s\n\nMerci de ne pas répondre à ce message\n\n---------\nCordialement\n%s\n%s\n%s");

define("_PM_EMAIL", "Email");
define("_PM_EMAIL_DESC", "Cher %s, voici un message transféré à partir de votre compte à ".$GLOBALS['xoopsConfig']['sitename']);
define("_PM_EMAIL_FROM", "De %s");
define("_PM_EMAIL_TO", "A %s");
define("_PM_EMAIL_SUBJECT", "[message]%s");
define("_PM_EMAIL_MESSAGE", "Contenu du message");

define("_PM_ACTION_DONE", "Opération exécutée avec succès");
define("_PM_ACTION_ERROR", "l'opération a échouée");

/**
 * @translation     AFUX (Association Francophone des Utilisateurs de Xoops) <http://www.afux.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans BOM
 *
 * @version         $Id: main.php 1112 2010-01-28 18:27:34Z kris_fr $
**/
?>