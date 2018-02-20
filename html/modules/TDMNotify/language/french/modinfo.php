<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */

// The name of this module
define('_MI_NOTIFY_NAME',' TDMNotify');
define('_MI_NOTIFY_DESC',' Gestion de notification');
define('_MI_NOTIFY_INDEX',' Index');
define('_MI_NOTIFY_NOTIF',' Notifications');
define('_MI_NOTIFY_BLOCK',' Formulaire');
define('_MI_NOTIFY_PLUG',' Pluging');
define('_MI_NOTIFY_PERMISSIONS','Permissions');
define('_MI_NOTIFY_ABOUT','About');
define('_MI_NOTIFY_PREF','Préférences');

//Preferences
define("_MI_NOTIFY_MIMEMAX","Taille maxi des fichiers pour l'upload");
define("_MI_NOTIFY_MIMETYPE","Extension autoriser s&#233;parer par | ");
define("_MI_NOTIFY_EDITOR","Editeur");
define("_MI_NOTIFY_USER","Envoyer un message a l'utilisateur une foix le formulaire soumis");
define("_MI_NOTIFY_USER_TEXT","Texte à envoyer: Formulaire soumis");
define("_MI_NOTIFY_NOTIFY","Envoyer un message a l'utilisateur une foix la notification résolus");
define("_MI_NOTIFY_NOTIFY_TEXT","Texte à envoyer: Notification résolus");
define("_MI_NOTIFY_NOTIFY_DESC","Balises utiles : <br />
{X_UNAME} affichera le nom de l'utilisateur<br />
{X_FNAME} affichera le prenom de l'utilisateur<br />
{X_UEMAIL} affichera l'email de l'utilisateur<br />
{X_ADMINMAIL} affichera l'email de l'admin<br />
{X_SITENAME} affichera le nom de votre site<br />
{X_SITEURL} affichera l'url de votre site");

define("_MI_NOTIFY_NON","Non");
define("_MI_NOTIFY_MP","Message privé");
define("_MI_NOTIFY_MAIL","Email");
?>
