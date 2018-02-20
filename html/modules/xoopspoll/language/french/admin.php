<?php
/**
 * XOOPS Poll Administration Language Definitions
 *
 * @package::    xoopspoll
 * @subpackage:: defines
 * @version::    $Id: admin.php 11547 2013-05-15 20:47:32Z zyspec $
 */
define('_AM_XOOPSPOLL_DBUPDATED', "Base de données mise à jour avec succès !");
define('_AM_XOOPSPOLL_POLLCONF', "Configuration des sondages");
define('_AM_XOOPSPOLL_POLLSLIST', "Liste des sondages");
define('_AM_XOOPSPOLL_AUTHOR', "Auteur de ce sondage");
define('_AM_XOOPSPOLL_DISPLAYBLOCK', "L'afficher dans le bloc ?");
define('_AM_XOOPSPOLL_POLLQUESTION', "Question du sondage");
define('_AM_XOOPSPOLL_VOTERS', "Nombre total de votants");
define('_AM_XOOPSPOLL_VOTES', "Nombre total de votes");
define('_AM_XOOPSPOLL_EXPIRATION', "Expiration");
define('_AM_XOOPSPOLL_EXPIRED', "Expiré");
define('_AM_XOOPSPOLL_VIEWLOG', "Afficher le journal");
define('_AM_XOOPSPOLL_CREATENEWPOLL', "Créez un nouveau sondage");
define('_AM_XOOPSPOLL_POLLDESC', "Description du sondage");
define('_AM_XOOPSPOLL_DISPLAYORDER', "Ordre d'affichage");
define('_AM_XOOPSPOLL_ALLOWMULTI', "Permettre la sélection multiple ?");
define('_AM_XOOPSPOLL_ALLOWANONYMOUS', "Permettre le vote anonyme ?");
define('_AM_XOOPSPOLL_NOTIFY', "Prévenir l'auteur du sondage quand ce dernier aura expiré");
define('_AM_XOOPSPOLL_POLLOPTIONS', "Options :&nbsp;");
define('_AM_XOOPSPOLL_EDITPOLL', "Modifier le sondage");
define('_AM_XOOPSPOLL_FORMAT', "Format: dd-mm-yyyy hh:mm");
define('_AM_XOOPSPOLL_CURRENTTIME', "Date actuelle : %s");
define('_AM_XOOPSPOLL_EXPIREDAT', "Expire à %s");
define('_AM_XOOPSPOLL_RESTART', "Réinitialiser le sondage");
define('_AM_XOOPSPOLL_ADDMORE', "Ajouter d'autres options");
define('_AM_XOOPSPOLL_RUSUREDEL', "Êtes-vous certain de vouloir supprimer ce sondage et ses messages");
define('_AM_XOOPSPOLL_RESTARTPOLL', "Redémarrez le sondage");
define('_AM_XOOPSPOLL_RESET', "Réinitialiser tous les journaux de ce sondage ?");
define('_AM_XOOPSPOLL_ADDPOLL', "Ajouter un sondage");

define('_AM_XOOPSPOLL_LOGSLIST', "Liste des journaux");
define('_AM_XOOPSPOLL_RETURNLIST', "Retour à la liste des sondages");
define('_AM_XOOPSPOLL_LOGID', "Journal des ID");
define('_AM_XOOPSPOLL_OPTIONID', "Option choisie");
define('_AM_XOOPSPOLL_IP', "Adresse IP");
define('_AM_XOOPSPOLL_VOTER', "Votant");
define('_AM_XOOPSPOLL_VOTETIME', "Temps de vote");

//1.32 / 1.33
define('_AM_XOOPSPOLL_HOST_NAME', "Nom d'hôte");

// Text for Admin footer
//define("_AM_XOOPSPOLL_ADMIN_FOOTER", "<div class='center smallsmall italic pad5'>Le module de sondages XOOPS Poll est suivi par la <a class='tooltip' rel='external' href='http://xoops.org/' title='Visitez la communauté XOOPS'>Communauté XOOPS</a></div>");

define('_AM_XOOPSPOLL_ACTIONS', "Actions");
define('_AM_XOOPSPOLL_POLLVOTERS', "Votants participant à ce sondage");

//1.33
define('_AM_XOOPSPOLL_ERROR_INVALID_POLLID', "ID de sondage incorrect, veuillez retenter.");

//1.40
define('_AM_XOOPSPOLL_ADMIN_MISSING', "<span style='color: red;'> ERREUR: Vous devez installer la classe Frameworks de XOOPS moduleadmin.</span>");
define('_AM_XOOPSPOLL_RESULT_SUM', "Résumé des résultats");
define('_AM_XOOPSPOLL_OPTION', "Option");
define('_AM_XOOPSPOLL_LABEL', "Label");
define('_AM_XOOPSPOLL_COUNT', "Compteur");
define('_AM_XOOPSPOLL_CLONE', "Clone");
define('_AM_XOOPSPOLL_CLONE_SUCCESS', "Clone du sondage créé avec succès");
define('_AM_XOOPSPOLL_CLONE_FAIL', "Impossible de cloner ce sondage");
define('_AM_XOOPSPOLL_START_TIME', "Heure de début");
define('_AM_XOOPSPOLL_PM_VOTER', "Message privé au votant");
define('_AM_XOOPSPOLL_ERROR_DBUPDATE', "<span style='color: red;'> La base de données ne peut pas être mis à jour</span>");
define('_AM_XOOPSPOLL_HELPNOTUPDATED', "Impossible de mettre à jour le texte du lien dans le fichier d'aide");
define('_AM_XOOPSPOLL_ERROR_UPDATE', "Le script de mise à jour du module n'a pas réussi.");
define('_AM_XOOPSPOLL_ERROR_COLUMN', "Impossible de créer la colonne dans la base de données :");
define('_AM_XOOPSPOLL_HELPNOTFOUND', "%s %s introuvable");
define('_AM_XOOPSPOLL_MULTI_LIMIT', "Combien d'options le votant peut-il choisir?");
define('_AM_XOOPSPOLL_MULTI_LIMIT_DESC', "Ceci n'est nécessaire que si vous autorisez plusieurs sélections. Réglez sur zéro (0) pour un nombre illimité.");
define('_AM_XOOPSPOLL_NOTHING_HERE', "Il n'y a rien à mettre à jour.");
define('_AM_XOOPSPOLL_PREFERENCES', "PRÉFÉRENCES");
define('_AM_XOOPSPOLL_OPTION_SETTINGS', "RÉGLAGES D'OPTION");
define('_AM_XOOPSPOLL_BLIND', "Affichage des résultats du sondage");
define('_AM_XOOPSPOLL_POLL_TIMES', "Durées de sondage");
define('_AM_XOOPSPOLL_NOTIFY_VOTER', "Aviser les votants après le vote (utilisateurs enregistrés uniquement) ?");
define('_AM_XOOPSPOLL_IMPORT_UMFRAGE', "Importer les sondages du module Umfrage");
define('_AM_XOOPSPOLL_RUSUREUMFRAGE', "Êtes-vous sûr de vouloir importer les sondages d'Umfrage ?");
define('_AM_XOOPSPOLL_UMFRAGE_INTRO', "Importer les sondages d'Umfrage existants dans XoopsPoll.");
define('_AM_XOOPSPOLL_UMFRAGE_STEP1', "Éteignez le site XOOPS.");
define('_AM_XOOPSPOLL_UMFRAGE_STEP2', "Assurez-vous que le module Umfrage est installé et actif.");
define('_AM_XOOPSPOLL_UMFRAGE_STEP3', "Exécutez le script d'importation (cliquez sur le bouton ci-dessous).");
define('_AM_XOOPSPOLL_UMFRAGE_STEP4', "Vérifiez les paramètres des sondages nouvellement importés.");
define('_AM_XOOPSPOLL_UMFRAGE_STEP5', "Ouvrez le site XOOPS.");
define('_AM_XOOPSPOLL_NEWBB_SUPPORT', "Aide newbb");
define('_AM_XOOPSPOLL_NEWBB_INTRO', "Indique que le sondage est associé à un sujet de Newbb");
define('_AM_XOOPSPOLL_NEWBB_TOPIC', "Sujet :");

// datetimepicker language strings
define('_AM_XOOPSPOLL_DTP_CLOSETEXT', "Fait");
define('_AM_XOOPSPOLL_DTP_PREVTEXT', "Préc");
define('_AM_XOOPSPOLL_DTP_NEXTTEXT', "Suivant");
define('_AM_XOOPSPOLL_DTP_CURRENTTEXT', "Maintenant");

// NOTE:  the following are each a SINGLE STRING THE PLACEMENT OF single and double quotes is IMPORTANT!
define('_AM_XOOPSPOLL_DTP_MONTHNAMES', "'Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'");
define('_AM_XOOPSPOLL_DTP_MONTHNAMESSHORT', "'Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Déc'");
define('_AM_XOOPSPOLL_DTP_DAYNAMES', "'Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'");
define('_AM_XOOPSPOLL_DTP_DAYNAMESSHORT', "'Dim','Lun','Mar','Mer','Jeu','Ven','Sam'");
define('_AM_XOOPSPOLL_DTP_DAYNAMESMIN', "'Di','Lu','Ma','Me','Je','Ve','Sa'");
// end NOTE
define('_AM_XOOPSPOLL_DTP_WEEKHEADER', "Sem");
define('_AM_XOOPSPOLL_DTP_DATEFORMAT', "dd-mm-yy");
define('_AM_XOOPSPOLL_DTP_TIMEFORMAT', "hh:mm");
define('_AM_XOOPSPOLL_DTP_FIRSTDAY', 1);
define('_AM_XOOPSPOLL_DTP_ISRTL', "faux");  // can only be set to 'true' or 'false' (always use ENGLISH true/false)
define('_AM_XOOPSPOLL_DTP_SHOWMONTHAFTERYEAR', "faux");
define('_AM_XOOPSPOLL_DTP_YEARSUFFIX', null);
define('_AM_XOOPSPOLL_DTP_TIMEONLYTITLE', "Choisir l'heure");
define('_AM_XOOPSPOLL_DTP_TIMETEXT', "Temps");
define('_AM_XOOPSPOLL_DTP_HOURTEXT', "Heure");
define('_AM_XOOPSPOLL_DTP_MINUTETEXT', "Minute");
define('_AM_XOOPSPOLL_DTP_SECONDTEXT', "Seconde");
define('_AM_XOOPSPOLL_DTP_MILLISECTEXT', "Milliseconde");

// Text for Admin footer
define('_AM_XOOPSPOLL_MAINTAINED_BY', "XOOPS Poll est maintenu par la");
define('_AM_XOOPSPOLL_MAINTAINTED_TITLE', "Visitez la Communauté XOOPS");
define('_AM_XOOPSPOLL_MAINTAINTED_TEXT', "Communauté XOOPS");

//install/upgrade
define('_AM_XOOPSPOLL_UPGRADE_FAILED', "La mise à jour de la table %s de la base de données a échoué.");
define('_AM_XOOPSPOLL_LOG_FAILED', "Il y a eu une erreur de mise à jour des journaux pour le sondage '%s'.");
define('_AM_XOOPSPOLL_OPTION_FAILED', "Impossible de créer l'option '%s' pour le sondage '%s'. %s");
define('_AM_XOOPSPOLL_QUESTION_FAILED', "Impossible de créer le sondage '%s' dans la base de données. %s");
define('_AM_XOOPSPOLL_QUESTION_IMPORT_FAILED', "Le sondage '%s' n'a pas été importé. %s");
define('_AM_XOOPSPOLL_UMFRAGE_FAILED', "Veuillez vous assurer que Umfrage est installé et actif.");
define('_AM_XOOPSPOLL_IMPORT_FAILED', "Erreur(s) d'importation");
define('_AM_XOOPSPOLL_IMPORT_SUCCESS', "(%d) sondages importés de Umfrage avec succès.");