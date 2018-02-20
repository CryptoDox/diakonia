<?php
/**
 * Main Definitions
 *
 * @package::    xoopspoll
 * @subpackage:: defines
 * @version::    $Id: main.php 11539 2013-05-13 20:56:06Z zyspec $
 */

/**
 * 	File Name pollresults.php
 */
define('_MD_XOOPSPOLL_TOTALVOTES', "Total des votes : %s");
define('_MD_XOOPSPOLL_TOTALVOTERS', "Total des votants : %s");

/**
 * File Name index.php
 */
define('_MD_XOOPSPOLL_POLLSLIST', "Liste des sondages");
define('_MD_XOOPSPOLL_ALREADYVOTED', "Désolé, vous avez déjà voté une fois.");
define('_MD_XOOPSPOLL_THANKSFORVOTE', "Merci pour votre vote !");
define('_MD_XOOPSPOLL_SORRYEXPIRED', "Désolé, mais le sondage a expiré.");
define('_MD_XOOPSPOLL_YOURPOLLAT', "%s, votre sondage sur %s"); // 1st %s is user name, 2nd %s is site name
define('_MD_XOOPSPOLL_PREV', "Précédent");
define('_MD_XOOPSPOLL_NEXT', "Suivant");
define('_MD_XOOPSPOLL_POLLQUESTION', "Question du sondage");
define('_MD_XOOPSPOLL_VOTERS', "Nombre total de votants");
define('_MD_XOOPSPOLL_VOTES', "Total de votes");
define('_MD_XOOPSPOLL_EXPIRATION', "Expiration");
define('_MD_XOOPSPOLL_EXPIRED', "Expiré");
define('_MD_XOOPSPOLL_MUSTLOGIN', "Désolé, mais vous devez vous connecter pour voter à ce sondage.");

/**
 * File Name xoopspollrenderer.php
 */
// %s represents date
define('_MD_XOOPSPOLL_HIDE_ENDSAT', "Se termine le %s");
define('_MD_XOOPSPOLL_HIDE_ENDEDAT', "S'est terminé à %s");
define('_MD_XOOPSPOLL_STARTSAT', "Commence le %s");
define('_MD_XOOPSPOLL_VOTE', "Votez !");
define('_MD_XOOPSPOLL_RESULTS', "Résultats");

// 1.32

/**
 * File name /admin/index.php
 */
define('_MD_XOOPSPOLL_DASHBOARD', "Tableau de bord des sondages de Xoops");
define('_MD_XOOPSPOLL_TOTALPOLLS', "Total des sondages : <strong>%s</strong> ");
define('_MD_XOOPSPOLL_TOTALACTIVE', "Sondages actifs : <strong>%s</strong> ");
define('_MD_XOOPSPOLL_TOTALWAITING', "Sondages non commencés : <strong>%s</strong> ");
define('_MD_XOOPSPOLL_TOTALEXPIRED', "Sondages expirés : <strong>%s</strong> ");

// 1.40
define('_MD_XOOPSPOLL_VOTE_NOW', "Cliquez ici pour voter maintenant !");
define('_MD_XOOPSPOLL_ERROR_INVALID_POLLID', "ID de sondage incorrect, veuillez retenter.");
define('_MD_XOOPSPOLL_CANNOTVOTE', "Désolé, mais vous n'êtes pas autorisé à voter à ce sondage.");
define('_MD_XOOPSPOLL_HIDE_NEVER', "ne jamais cacher les résultats");
define('_MD_XOOPSPOLL_HIDE_ALWAYS', "toujours cacher les résultats");
define('_MD_XOOPSPOLL_HIDE_VOTED', "ne masquer les résultats qu'après le vote");
define('_MD_XOOPSPOLL_HIDE_END', "masquer les résultats jusqu'à l'expiration du sondage");
define('_MD_XOOPSPOLL_HIDE_ALWAYS_MSG', "Les résultats de ce sondage sont privées et ne sont pas visibles.");
define('_MD_XOOPSPOLL_HIDE_VOTED_MSG', "Les résultats de ce sondage ne seront accessibles que lorsque vous aurez voté.");
define('_MD_XOOPSPOLL_HIDE_END_MSG', "Les résultats de ce sondage ne seront accessibles que lorsqu'il sera terminé.");
define('_MD_XOOPSPOLL_YOURVOTEAT', "%s, votre vote à %s"); // 1st %s is user name, 2nd %s is site name
define('_MD_XOOPSPOLL_VOTE_ERROR', "Il y a eu un problème d'enregistrement de votre vote. Veuillez recommencer.");
define('_MD_XOOPSPOLL_MULTITEXT', "Veuillez sélectionner un maximum de %d éléments");
define('_MD_XOOPSPOLL_OBSCURED', "Cacher");

//Mail Voter
define('_MD_XOOPSPOLL_ENDED_AT', "Le sondage a pris fin le %s.");
define('_MD_XOOPSPOLL_ENDS_ON', "Le vote du sondage se termine le %s.");
define('_MD_XOOPSPOLL_SEE_AT', "Vous pouvez voir les résultats du sondage à l'adresse :");
define('_MD_XOOPSPOLL_SEE_AFTER', "Vous pourrez voir les résultats du vote une fois qu'il se termine sur :");