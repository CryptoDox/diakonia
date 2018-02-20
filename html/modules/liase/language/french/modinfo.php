<?php
// Version française : solo (www.wolfpackclan.com)
// Traduction corrigée et modifiée par jbaudin (www.moodle4xoops.euro.tm)

// Module Info

// The name of this module
define("_MI_LIAISE_NAME","Liaise");

// A brief description of this module
define("_MI_LIAISE_DESC","Générateur de Formulaire de Contact");

// admin/menu.php
define("_MI_LIAISE_ADMENU1","Liste des Formulaires");
define("_MI_LIAISE_ADMENU2","Créer un nouveau Formulaire");

//      preferences
define("_MI_LIAISE_TEXT_WIDTH","Largeur des zones de texte par défaut.");
define("_MI_LIAISE_TEXT_MAX","Largeur maximum des zones de texte par défaut.");
define("_MI_LIAISE_TAREA_ROWS","Nombre de lignes par défaut des zones de texte.");
define("_MI_LIAISE_TAREA_COLS","Nombre de colonnes par défaut des zones de texte.");

######### version 1.1  additions #########
//      preferences
define("_MI_LIAISE_MAIL_CHARSET","Texte encodé pour les e-mails envoyés");

//      template descriptions
define("_MI_LIAISE_TMPL_MAIN_DESC","Page d'accueil de Liaise");
define("_MI_LIAISE_TMPL_ERROR_DESC","Page à afficher lors d'erreurs");

######### version 1.2 additions #########
//      template descriptions
define("_MI_LIAISE_TMPL_FORM_DESC","Template des formulaires");

//      preferences
define("_MI_LIAISE_MOREINFO","Envoyer des informations supplémentaires avec les informations soumises.");
define("_MI_LIAISE_MOREINFO_USER","Nom d'utilisateur et lien vers sa page d'information.");
define("_MI_LIAISE_MOREINFO_IP","Adresse IP du contact");
define("_MI_LIAISE_MOREINFO_AGENT","Fournisseur d'accès du contact (infos du navigateur)");
define("_MI_LIAISE_MOREINFO_FORM","URL du formulaire de contact");
define("_MI_LIAISE_MAIL_CHARSET_DESC","Laisser vierge pour "._CHARSET);
define("_MI_LIAISE_PREFIX","Preffix du texte pour les champs requis");
define("_MI_LIAISE_SUFFIX","Suffix du texte pour les champs requis");
define("_MI_LIAISE_INTRO","Texte d'introduction pour la page d'accueil");
define("_MI_LIAISE_GLOBAL","Texte à afficher dans chaque formulaire");

// admin/menu.php
define("_MI_LIAISE_ADMENU3","Editer les éléments du formulaire");
######### version 1.21 additions #########
// preferences default values
define("_MI_LIAISE_INTRO_DEFAULT","Contactez nous librement au moyen du formulaire suivant:");
define("_MI_LIAISE_GLOBAL_DEFAULT","[b]* Requis[/b]");

######### version 1.23 additions #########
// Ajout jbaudin
define("_MI_LIAISE_UPLOADDIR","Chemin physique de votre répertoire SANS le slash / de fin.");
define("_MI_LIAISE_UPLOADDIR_DESC","Tous les fichiers envoyés seront stockés ici quand un formulaire est envoyé par l'intermédiaire de message privé");

?>