<?php
/**
 * Module Info Language Definitions
 *
 * @package xoopspoll
 * @version::  $Id: modinfo.php 11593 2013-05-27 22:28:05Z zyspec $
 */

/**
 * The name of this module
 */
define('_MI_XOOPSPOLL_NAME', "XOOPS Poll");

/**
 * A brief description of this module
 */
define('_MI_XOOPSPOLL_DESC', "Le module de sondage XOOPS peut être utilisé pour afficher des formulaires interactifs d'enquêtes sur le site.");

/**#@+
 * Name and description of block for this module
 */
define('_MI_XOOPSPOLL_BNAME1', "Sondages");
define('_MI_XOOPSPOLL_BNAME1DSC', "Affiche un nombre illimité de sondages / enquêtes");
define('_MI_XOOPSPOLL_BNAME1A', "Sondages utilisant la sélection HTML");
define('_MI_XOOPSPOLL_BNAME1ADSC', "Afficher un nombre illimité de sondages / enquêtes utilisant la sélection HTML");
define('_MI_XOOPSPOLL_BNAME2', "Sondage unique");
define('_MI_XOOPSPOLL_BNAME2DSC', "Affiche un seul sondage");
/**#@-*/

/**#@+
 * Module properties
 */
//define('_MI_XOOPSPOLL_LIMITBYIP', "Empêcher le double vote, en vérifiant l'adresse IP.");
//define('_MI_XOOPSPOLL_LIMITBYIPDSC', "L'adresse IP de l'utilisateur est vérifiée pour empêcher de voter deux fois avec la même adresse IP. Veuillez noter que si il y a deux utilisateurs différents qui utilisent la même adresse IP publique, ce dernier ne sera pas en mesure de voter.");
//define('_MI_XOOPSPOLL_LIMITBYUID', "Empêcher le même utilisateur de voter deux fois ");
//define('_MI_XOOPSPOLL_LIMITBYUIDDSC', "Vérifiez l'ID des utilisateurs connectés pour les empêcher de voter plus d'une fois.");
define('_MI_XOOPSPOLL_LOOKUPHOST', "Affiche le nom d'hôte au lieu de l'adresse IP dans le journal d'administration");
define('_MI_XOOPSPOLL_LOOKUPHOSTDSC', "Liste des noms d'hôte au lieu des adresses IP dans l'affichage des journaux de sondage. Si Nslookup est utilisé, cela peut prendre plus de temps pour afficher les noms.");
define('_MI_XOOPSPOLL_DISPVOTE', "Afficher le nombre de votes et votants du sondage aux utilisateurs.");
define('_MI_XOOPSPOLL_DISPVOTEDSC', "Affiche / masque le nombre total de votes et votants dans un sondage aux utilisateurs dans les pages et les blocs. Les chiffres sont toujours affichés dans le panneau d'administration.");
//define('_MI_XOOPSPOLL_CHOOSEEDITOR', "Choisir l'éditeur de texte à utiliser :");
//define('_MI_XOOPSPOLL_CHOOSEEDITORDSC', "Éditeur à utiliser pour la saisie des descriptions.");
define('_MI_XOOPSPOLL_HIDEFORUM_POLLS', "Cacher du module de sondages et des blocs, les sondages créés dans un forum ");
define('_MI_XOOPSPOLL_HIDEFORUM_POLLSDSC', "Si Oui, les sondages créés à partir d'un forum (newbb) sont cachés dans le module de sondages. <br /> Réglez sur Oui si le module de forum n'est pas installé.");
/**#@-*/

/**#@+
 * Template description
 */
define('_MI_XOOPSPOLL_INDEX_DSC', "Modèle de l'index du module");
define('_MI_XOOPSPOLL_VIEW_DSC', "Affiche le modèle du sondage");
define('_MI_XOOPSPOLL_RESULTS_DSC', "Affiche le modèle des résultats");
define('_MI_XOOPSPOLL_RESULTS_REND_DSC', "Affiche le modèle du rendu des résultats");
define('_MI_XOOPSPOLL_ADMIN_INDEX_DSC', "Modèle d'administration pour afficher les informations du module");
define('_MI_XOOPSPOLL_ADMIN_LIST_DSC', "Modèle d'administration pour lister les informations de liaison");
define('_MI_XOOPSPOLL_ADMIN_UTIL_DSC', "Modèle d'administration pour les utilitaires du module");
//define('_MI_XOOPSPOLL_HELP_DSC', "Modèle pour afficher la page d'aide du module");
/**#@-*/

/**#@+
 * index.php definition
 */
define('_MI_XOOPSPOLL_HOME', "Accueil");
define('_MI_XOOPSPOLL_HOMEDSC', "Accueil de l'administration du module");
define('_MI_XOOPSPOLL_ADMENU1', "Sondages");
define('_MI_XOOPSPOLL_ADMENU1DSC', "Administration des Sondages liste / modifie / supprime");
define('_MI_XOOPSPOLL_ADMENU2', "Utilitaires");
define('_MI_XOOPSPOLL_ADMENU2DSC', "Assistants du module");
define('_MI_XOOPSPOLL_ADABOUT', "À propos");
define('_MI_XOOPSPOLL_ADABOUTDSC', "En savoir plus sur le module de Sondage XOOPS");
//define('_MI_XOOPSPOLL_ADMIN_HELP', "Aide");
/**#@-*/
