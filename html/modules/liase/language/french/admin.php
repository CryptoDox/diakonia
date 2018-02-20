<?php
// Version fran�aise : solo (www.wolfpackclan.com)
// Traduction corrig�e et modifi�e par jbaudin (www.moodle4xoops.euro.tm)

define("_AM_SAVE","Sauver");
define("_AM_COPIED","%s copi�");
define("_AM_DBUPDATED","Base de donn�e mise � jour !");
define("_AM_ELE_CREATE","Ajouter un �l�ment au formulaire");
define("_AM_ELE_EDIT","Editer les �l�ments du formulaire : %s");

define("_AM_ELE_CAPTION","L�gende");
define("_AM_ELE_DEFAULT","Valeur par d�faut");
define("_AM_ELE_DETAIL","D�tail");
define("_AM_ELE_REQ","Requis");
define("_AM_ELE_ORDER","Ordre");
define("_AM_ELE_DISPLAY","Afficher");

define("_AM_ELE_TEXT","Champs texte");
define("_AM_ELE_TEXT_DESC","{UNAME} imprime le pseudo d'utilisateur;<br />{EMAIL} imprime l'adress mail;<br />{NAME} imprime le nom r�el de l'utilisateur;<br />{FROM} imprime la localisation de l'utilisateur;<br />{INFO} imprime les infos;<br />{ICQ} imprime l'adresse ICQ;<br />{AIM} imprime l'adresse AIM;<br />{YIM} imprime l'adresse YIM;<br />{MSNM} imprime l'adresse MSN;<br />{OCCUP} imprime la profession");
define("_AM_ELE_TAREA","Zone de texte");
define("_AM_ELE_SELECT","S�lectionner bo�te");
define("_AM_ELE_CHECK","Cocher el�ment");
define("_AM_ELE_RADIO","Boutons radio");
define("_AM_ELE_YN","Simple boutton radio - oui/non  ");
define("_AM_ELE_REQ_USELESS","Utilisable ni pour la bo�te de s�lection, ni pour les boutons � cocher, ni pour les boutons radio.");

define("_AM_ELE_SIZE","Taille");
define("_AM_ELE_MAX_LENGTH","Longueur maximum");
define("_AM_ELE_ROWS","Lignes");
define("_AM_ELE_COLS","Colonnes");
define("_AM_ELE_OPT","Options");
define("_AM_ELE_OPT_DESC","Cochez les boutons pour s�lectionner les valeurs par d�faut.");
define("_AM_ELE_OPT_DESC1","<br />Seul le premier bouton est valid� si les s�lections multiples ne sont pas autoris�es");
define("_AM_ELE_OPT_DESC2","S�lectionnez la valeur par d�faut en cochant le bouton radio");
define("_AM_ELE_ADD_OPT","Ajoute %s options");
define("_AM_ELE_ADD_OPT_SUBMIT","Ajouter");
define("_AM_ELE_SELECTED","S�lectionner");
define("_AM_ELE_CHECKED","Coch�");
define("_AM_ELE_MULTIPLE","Autoriser les s�lections multiples");

define("_AM_ELE_SELECT_NONE","Aucun �l�ment s�lectionn�.");
define("_AM_ELE_CONFIRM_DELETE","Etes-vous certain de vouloir supprimer cet �l�ment du formulaire ?");

######### version 1.1 #########
define("_AM_ELE_OTHER", 'Pour une option "Autre", indiquez {OTHER|*nombre*} dans une des zones de texte. Ex. {OTHER|30} g�n�re une zone de texte de 30 caract�res.');

######### version 1.2 additions #########
define("_AM_FORM_LISTING", "Liste des formulaires de contact");
define("_AM_FORM_ORDER","Ordre d'affichage");
define("_AM_FORM_ORDER_DESC","0 = masquer ce formulaire");
define("_AM_FORM_TITLE", "Titre du formulaire");
define("_AM_FORM_PERM", "Permission d'utilisation des formulaire par les groupes");
define("_AM_FORM_SENDTO", "Envoyer �");
define("_AM_FORM_SENDTO_ADMIN", "E-mail de l'administrateur du site");
define("_AM_FORM_SEND_METHOD", "M�thode d'envoi");
define("_AM_FORM_SEND_METHOD_DESC", "L'information ne peut pas �tre envoy�e par l'interm�diaire de message priv� quand le formulaire est envoy� � "._AM_FORM_SENDTO_ADMIN." ou envoy� aux utilisateurs anonymes");
define("_AM_FORM_SEND_METHOD_MAIL", "E-mail");
define("_AM_FORM_SEND_METHOD_PM", "Message priv�");
define("_AM_FORM_DELIMETER", "S�parateur pour les cases � cocher et les boutons radio");
define("_AM_FORM_DELIMETER_SPACE", "Espace blanc");
define("_AM_FORM_DELIMETER_BR", "Ligne de s�paration");
define("_AM_FORM_SUBMIT_TEXT", "Texte du bouton d'envoi");
define("_AM_FORM_DESC", "Description du formulaire");
define("_AM_FORM_DESC_DESC", "Texte � afficher dans la page principale s'il y a plus d'un formulaire");
define("_AM_FORM_INTRO", "Introduction du formulaire");
define("_AM_FORM_INTRO_DESC", "Texte a afficher sur le formulaire");
define("_AM_FORM_WHERETO", "URL de destination apr�s envoi du formulaire");
define("_AM_FORM_WHERETO_DESC", "Laissez blanc pour aller � la page d'accueil du site. {SITE_URL} sera utilis� : ".XOOPS_URL);

define("_AM_FORM_ACTION_EDITFORM", "Editer les param�tres");
define("_AM_FORM_ACTION_EDITELEMENT", "Editer les �l�ments");
define("_AM_FORM_ACTION_CLONE", "Cloner");

define("_AM_FORM_NEW", "Cr�er un nouveau formulaire");
define("_AM_FORM_EDIT", "Editer ce formulaire: %s");
define("_AM_FORM_CONFIRM_DELETE", "Etes-vous s�r de vouloir supprimer ce formulaire et tous ses �l�ments ?");

define("_AM_ID", "ID");
define("_AM_ACTION", "Action");
define("_AM_RESET_ORDER", "Enreg. tri");
define("_AM_SAVE_THEN_ELEMENTS", "Sauvegarder puis �diter les �l�ments");
define("_AM_SAVE_THEN_FORM", "Sauvegarder puis editer les param�tres");
define("_AM_NOTHING_SELECTED", "Aucune s�lection.");
define("_AM_GO_CREATE_FORM", "Vous devez d'abord cr�er un formulaire.");

define("_AM_ELEMENTS_OF_FORM", "El�ments du formulaire %s");
define("_AM_ELE_APPLY_TO_FORM", "Appliquer au formulaire");
define("_AM_ELE_HTML", "Format texte / HTML");

######### version 1.23 additions #########
//Ajout jbaudin
define("_AM_XOOPS_VERSION_WRONG", "La version de XOOPS ne r�pond pas aux exigences du module. Liaise pourrait ne pas fonctionner correctement.");
define("_AM_ELE_UPLOADFILE","Fichier attach�");
define("_AM_ELE_UPLOADIMG","Image attach�e");
define("_AM_ELE_UPLOADIMG_MAXWIDTH","Largeure maximale (pixels)");
define("_AM_ELE_UPLOADIMG_MAXHEIGHT","Hauteur maximale (pixels)");
define("_AM_ELE_UPLOAD_MAXSIZE","Taille maximale des fichiers (bytes)");
define("_AM_ELE_UPLOAD_MAXSIZE_DESC","1k = 1024 bytes");
define("_AM_ELE_UPLOAD_DESC_SIZE_NOLIMIT","0 = pas de limite");
define("_AM_ELE_UPLOAD_ALLOWED_EXT","Extensions autoris�es des fichiers");
define("_AM_ELE_UPLOAD_ALLOWED_EXT_DESC","S�parez les extensions des fichiers avec un |, respectez la casse. ex: 'jpg|jpeg|gif|png|tif|tiff'");
define("_AM_ELE_UPLOAD_ALLOWED_MIME","Types MIME autoris�s");
define("_AM_ELE_UPLOAD_ALLOWED_MIME_DESC","S�parez les types MIME avec un |, respectez la casse. ex: 'image/jpeg|image/pjpeg|image/png|image/x-png|image/gif|image/tiff'");
define("_AM_ELE_UPLOAD_DESC_NOLIMIT","Laissez vide pour aucune limite (non recommand� pour des raisons de s�curit�)");
define("_AM_ELE_UPLOAD_SAVEAS","Sauvegarder les fichiers envoy�s vers");
define("_AM_ELE_UPLOAD_SAVEAS_MAIL","Fichiers joints � l'e-mail");
define("_AM_ELE_UPLOAD_SAVEAS_FILE","R�pertoire d'upload");
?>