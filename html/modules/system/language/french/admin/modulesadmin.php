<?php
// $Id: modulesadmin.php 1112 2010-01-28 18:27:34Z kris_fr $
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

//%%%%%%        File Name  modulesadmin.php         %%%%%
define('_MD_AM_MODADMIN','Administration des modules');
define('_MD_AM_MODULE','Module');
define('_MD_AM_VERSION','Version');
define('_MD_AM_LASTUP','Dernière mise à jour');
define('_MD_AM_DEACTIVATED','Désactivé');
define('_MD_AM_ACTION','Action');
define('_MD_AM_DEACTIVATE','Désactiver');
define('_MD_AM_ACTIVATE','Activer');
define('_MD_AM_UPDATE','Mise à jour');
define('_MD_AM_DUPEN','Entrée dupliquée dans la table modules !');
define('_MD_AM_DEACTED','Le module sélectionné a été désactivé. Vous pouvez maintenant le désinstaller sans risque.');
define('_MD_AM_ACTED','Le module sélectionné a été activé !');
define('_MD_AM_UPDTED','Le module sélectionné a ét mis à jour !');
define('_MD_AM_SYSNO','Le module Système ne peut être désactivé.');
define('_MD_AM_STRTNO','Ce module est défini comme votre page d\'accueil par défaut. Merci de changer tout d\'abord le module d\'accueil dans les préférences.');

// added in RC2
define('_MD_AM_PCMFM','Merci de confirmer :');

// added in RC3
define('_MD_AM_ORDER','Ordre');
define('_MD_AM_ORDER0','(0 = caché)');
define('_MD_AM_ACTIVE','Actif');
define('_MD_AM_INACTIVE','Inactif');
define('_MD_AM_NOTINSTALLED','Non installé');
define('_MD_AM_NOCHANGE','Pas de changement');
define('_MD_AM_INSTALL','Installer');
define('_MD_AM_UNINSTALL','Désinstaller');
define('_MD_AM_SUBMIT','Valider');
define('_MD_AM_CANCEL','Annuler');
define('_MD_AM_DBUPDATE','Base de données mise à jour avec succès !');
define('_MD_AM_BTOMADMIN','Retour à la page d\'administration des modules');

// <strong>%s</strong> represents module name
define('_MD_AM_FAILINS','Impossible d\'installer <strong>%s</strong>.');
define('_MD_AM_FAILACT','Impossible d\'activer <strong>%s</strong>.');
define('_MD_AM_FAILDEACT','Impossible de désactiver <strong>%s</strong>.');
define('_MD_AM_FAILUPD','Impossible de mettre à jour <strong>%s</strong>.');
define('_MD_AM_FAILUNINS','Impossible de désinstaller <strong>%s</strong>.');
define('_MD_AM_FAILORDER','Impossible de ré-ordonner <strong>%s</strong>.');
define('_MD_AM_FAILWRITE','Impossible d\'écrire dans le menu principal.');
define('_MD_AM_ALEXISTS','Le module <strong>%s</strong> existe déjà.');
define('_MD_AM_ERRORSC', 'Erreur(s) :');
define('_MD_AM_OKINS','Le module <strong>%s</strong> a été installé avec succès.');
define('_MD_AM_OKACT','Le module <strong>%s</strong> a été activé avec succès.');
define('_MD_AM_OKDEACT','Le module <strong>%s</strong> a été désactivé avec succès.');
define('_MD_AM_OKUPD','Le module <strong>%s</strong> a été mis à jour avec succès.');
define('_MD_AM_OKUNINS','Le module <strong>%s</strong> a été désinstallé avec succés.');
define('_MD_AM_OKORDER','Le module <strong>%s</strong> a été ré-ordonné avec succès.');

define('_MD_AM_RUSUREINS', 'Pressez le bouton ci-dessous pour installer ce module');
define('_MD_AM_RUSUREUPD', 'Pressez le bouton ci-dessous pour mettre à jour ce module');
define('_MD_AM_RUSUREUNINS', 'Etes-vous sûr de vouloir désinstaller ce module ?');
define('_MD_AM_LISTUPBLKS', 'Les blocs suivants vont être mis à jour.<br />Sélectionnez les blocs dont le contenu (template et options) peuvent être écrasés.<br />');
define('_MD_AM_NEWBLKS', 'Nouveaux blocs');
define('_MD_AM_DEPREBLKS', 'Blocs rejetés');

// added in 2.3 - julionc
define('_MD_AM_INSTALLING', 'Installation ');
define('_MD_AM_TABLE_RESERVED', '<strong>%s</strong> est une table réservée !');
define('_MD_AM_CREATE_TABLES', 'Création de tables ...');
define('_MD_AM_TABLE_CREATED', 'Table <strong>%s</strong> crée');
define('_MD_AM_INSERT_DATA', '&nbsp;&nbsp; Les données insérées à la table <strong>%s</strong>');
define('_MD_AM_INSERT_DATA_FAILD', 'Ne peut pas insérer <strong>%s</strong> dans la base de données.');
define('_MD_AM_INSERT_DATA_DONE', 'Les données du module ont été inséré avec succès.');
define('_MD_AM_MODULEID', ' Module ID : <strong>%s</strong>');
define('_MD_AM_SQL_FOUND', 'Le fichier SQL se trouve dans <strong>%s</strong> ');
define('_MD_AM_SQL_NOT_FOUND', 'Le fichier SQL n\'est pas dans <strong>%s</strong>');
define('_MD_AM_SQL_NOT_CREATE', 'ERREUR : Impossible de créer <strong>%s</strong> ');
define('_MD_AM_SQL_NOT_VALID', '<strong>%s</strong> Le fichier SQL n\'est pas valide !');

define('_MD_AM_GROUP_ID', ' Groupe ID : <strong>%s</strong> ');
define('_MD_AM_NAME', ' Nom : ');
define('_MD_AM_VALUE', ' Valeur : ');

/* Templates */
define('_MD_AM_TEMPLATES_ADD', 'Ajout de templates ...');
define('_MD_AM_TEMPLATES_DELETE', 'Suppression de templates ...');
define('_MD_AM_TEMPLATES_UPDATE', 'Mise à jour de templates ...');

define('_MD_AM_TEMPLATE_ID', 'Template ID : <strong>%s</strong> ');

define('_MD_AM_TEMPLATE_ADD_DATA', 'Ajouté le template <strong>%s</strong> à la base de données');
define('_MD_AM_TEMPLATE_ADD_ERROR', 'ERREUR : Le template <strong>%s</strong> ne peut pas être inséré dans la base de données.');
define('_MD_AM_TEMPLATE_COMPILED', 'Le template <strong>%s</strong> est compilé ');
define('_MD_AM_TEMPLATE_COMPILED_FAILED', 'ERREUR : échec de la compilation du template <strong>%s</strong> ');
define('_MD_AM_TEMPLATE_DELETE_DATA', 'Le template <strong>%s</strong> à été supprimé de la base de données. ');
define('_MD_AM_TEMPLATE_DELETE_DATA_FAILD', 'ERREUR : Impossible de supprimer le template <strong>%s</strong> de la base de données. ');
define('_MD_AM_TEMPLATE_INSERT_DATA', 'Le template <strong>%s</strong> inséré à la base de données. ');
define('_MD_AM_TEMPLATE_RECOMPILE', 'Le template <strong>%s</strong> est recompilé');
define('_MD_AM_TEMPLATE_RECOMPILE_FAILD', 'ERREUR : &#201;chec de la recompilation du template <strong>%s</strong> ');
define('_MD_AM_TEMPLATE_RECOMPILE_ERROR', 'ERREUR : Impossible de recompiler le template <strong>%s</strong> ');
define('_MD_AM_TEMPLATE_DELETE_OLD_ERROR', 'ERREUR : Impossible de supprimer le vieux modèle <strong>%s</strong>. Abandon de mise à jour de ce fichier. ');
define('_MD_AM_TEMPLATE_UPDATE', 'Le template <strong>%s</strong> est à jour. ');
define('_MD_AM_TEMPLATE_UPDATE_ERROR', 'ERREUR : Impossible de mettre à jour le template <strong>%s</strong> . ');

/* Blocks */
define('_MD_AM_BLOCKS_ADD', 'Ajout de blocs ...');
define('_MD_AM_BLOCKS_DELETE', 'Suppression de blocs ...');
define('_MD_AM_BLOCKS_REBUILD', 'La reconstruction de blocs ...');

define('_MD_AM_BLOCK_ID', ' Bloc ID : <strong>%s</strong> ');

define('_MD_AM_BLOCK_ACCESS', 'Ajouté les droits d\'accès au bloc');
define('_MD_AM_BLOCK_ACCESS_ERROR', 'ERREUR : Impossible d\'ajouter les droits d\'accès au bloc');
define('_MD_AM_BLOCK_ADD', 'Le bloc <strong>%s</strong> à été ajouté ');
define('_MD_AM_BLOCK_ADD_ERROR', 'ERREUR : Impossible d\'ajouter le bloc <strong>%s</strong> à la base de données ! ');
define('_MD_AM_BLOCK_ADD_ERROR_DATABASE', 'Erreur dans la base de données : <strong>%s</strong> ');
define('_MD_AM_BLOCK_CREATED', 'Le bloc <strong>%s</strong> a été créé ');
define('_MD_AM_BLOCK_DELETE', 'Le bloc <strong>%s</strong> est effacé. ');
define('_MD_AM_BLOCK_DELETE_DATA', 'Le template du bloc <strong>%s</strong> a été effacé de la base de données. ');
define('_MD_AM_BLOCK_DELETE_ERROR', 'ERREUR : Impossible de supprimer le bloc <strong>%s</strong>');
define('_MD_AM_BLOCK_DELETE_TEMPLATE_ERROR', 'ERREUR : Impossible de supprimer le template du bloc <strong>%s</strong> de la base de données.');
define('_MD_AM_BLOCK_DEPRECATED', 'Le template du bloc <strong>%s</strong> et dépassé ');
define('_MD_AM_BLOCK_DEPRECATED_ERROR', 'ERREUR : Impossible de supprimer le template dépassé du bloc. ');
define('_MD_AM_BLOCK_UPDATE', 'Mise à jour du <strong>%s</strong> bloc. ');

/* Configs */
define('_MD_AM_GONFIG_ID', 'Config ID : <strong>%s</strong>');
define('_MD_AM_MODULE_DATA_ADD', 'Ajout du module de configuration des données ...');
define('_MD_AM_MODULE_DATA_DELETE', 'Suppression d\'options de configuration du module ...');
define('_MD_AM_MODULE_DATA_UPDATE', 'Mise à jour des données du module.');

define('_MD_AM_CONFIG_ADD', ' Ajout d\'options de configuration');
define('_MD_AM_CONFIG_DATA_ADD', ' Configuration <strong>%s</strong> ajouter la base de données');
define('_MD_AM_CONFIG_DATA_ADD_ERROR', ' ERREUR : Impossible d\'insérer la configuration <strong>%s</strong> dans la base de données. ');
define('_MD_AM_GONFIG_DATA_DELETE', 'Les données de la configuration  supprimé de la base de données. ');
define('_MD_AM_CONFIG_DATA_DELETE_ERROR', 'ERREUR : Impossible de supprimer les données de la configuration de la base de données.');

/* Access */
define('_MD_AM_GROUP_SETTINGS_ADD', 'Réglage des droits de groupe ...');

define('_MD_AM_GROUP_PERMS_DELETE_ERROR', "ERREUR : Impossible d'effacer les droits du groupe ");
define('_MD_AM_GROUP_PERMS_DELETED', 'Droits du groupe supprimés ');

define('_MD_AM_ACCESS_ADMIN_ADD', 'Ajout du droit d\'accès administrateur pour le Groupe ID <strong>%s</strong>');
define('_MD_AM_ACCESS_ADMIN_ADD_ERROR', 'ERREUR : Impossible d\'ajouter le droit d\'accès administrateur pour le Groupe ID <strong>%s</strong>');
define('_MD_AM_ACCESS_USER_ADD_ERROR', 'Ajouter le droit d\'accès d\'utilisateur pour le groupe ID: <strong>%s</strong>');
define('_MD_AM_ACCESS_USER_ADD_ERROR_ERROR', 'ERREUR : Impossible d\'ajouter le droit d\'accès utilisateur pour le groupe ID: <strong>%s</strong>');

// execute module specific install script if any
define('_MD_AM_FAILED_EXECUTE', 'Echec d\'exécution de <strong>%s</strong>');
define('_MD_AM_FAILED_SUCESS', '<strong>%s</strong> Exécutée avec succès.');

define('_MD_AM_DELETE_ERROR', 'ERREUR : Impossible de supprimer <strong>%s</strong>');
define('_MD_AM_UPDATE_ERROR', 'ERREUR : Impossible de mettre à jour <strong>%s</strong>');
define('_MD_AM_DELETE_MOD_TABLES', 'Suppression de la table du module ...');

define('_MD_AM_COMMENTS_DELETE', 'Suppression des commentaires ...');
define('_MD_AM_COMMENTS_DELETE_ERROR', 'ERREUR : Impossible de supprimer les commentaires');
define('_MD_AM_COMMENTS_DELETED', 'Commentaires supprimés');

define('_MD_AM_NOTIFICATIONS_DELETE', 'Suppression des notifications ...');
define('_MD_AM_NOTIFICATIONS_DELETE_ERROR', 'ERREUR : Impossible de supprimer les notifications');
define('_MD_AM_NOTIFICATIONS_DELETED', 'Notifications supprimées');

define('_MD_AM_TABLE_DROPPED', 'Table <strong>%s</strong> supprimée !');
define('_MD_AM_TABLE_DROPPED_ERROR', 'ERREUR : Impossible de supprimer la table <strong>%s</strong>');
define('_MD_AM_TABLE_DROPPED_FAILDED', 'ERREUR : Pas de droit de suppression de la table <strong>%s</strong> !');

/**
 * @translation     FRXOOPS (XOOPS France) <http://www.frxoops.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans BOM
 *
 * @version        2010-07
**/
?>