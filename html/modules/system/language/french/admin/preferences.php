<?php
// $Id: preferences.php 1112 2010-01-28 18:27:34Z kris_fr $
// _LANGCODE: en
// _CHARSET : UTF-8
// Translator: XOOPS Translation Team

//%%%%%%    Admin Module Name  AdminGroup   %%%%%
// dont change
define("_AM_DBUPDATED",_MD_AM_DBUPDATED);
define("_MD_AM_SITEPREF", "Préférences du site");
define("_MD_AM_SITENAME", "Nom du site");
define("_MD_AM_SLOGAN", "Slogan pour votre site");
define("_MD_AM_ADMINML", "Courriel administrateur");
define("_MD_AM_LANGUAGE", "Langage par défaut");
define("_MD_AM_STARTPAGE", "Module pour votre page d'accueil");
define("_MD_AM_NONE", "Aucun");
define("_MD_AM_SERVERTZ", "Fuseau horaire du serveur");
define("_MD_AM_DEFAULTTZ", "Fuseau horaire par défaut");
define("_MD_AM_DTHEME", "Thème par défaut");
define("_MD_AM_THEMESET", "Jeu de thèmes");
define("_MD_AM_ANONNAME", "Identifiant pour les utilisateurs anonymes");
define("_MD_AM_MINPASS", "Longueur minimum requise pour le mot de passe");
define("_MD_AM_NEWUNOTIFY", "Notifier par mail lorsqu'un nouvel utilisateur s'est enregistré ?");
define("_MD_AM_SELFDELETE", "Autoriser les membres à effacer leur compte ?");
define("_MD_AM_LOADINGIMG", "Afficher l'image : Chargement ... ?");
define("_MD_AM_USEGZIP", "Utiliser la compression gzip ?");
define("_MD_AM_UNAMELVL", "Sélectionner le niveau de restriction pour le filtrage des identifiants");
define("_MD_AM_STRICT", "Strict (uniquement alpha-numérique)");
define("_MD_AM_MEDIUM", "Moyen");
define("_MD_AM_LIGHT", "Permissif (recommandé pour les caractères multi-bits)");
define("_MD_AM_USERCOOKIE", "Nom pour le cookie utilisateur.");
define("_MD_AM_USERCOOKIEDSC", "Ce cookie contient uniquement un nom utilisateur et est sauvegardé pour un an sur le PC de l'utilisateur (s'il le désire). Si un utilisateur a ce cookie, son identifiant sera automatiquement inséré dans la boite de connexion.");
define("_MD_AM_USEMYSESS", "Utiliser une session personnalisée");
define("_MD_AM_USEMYSESSDSC", "Choisissez OUI pour personnaliser la session des valeurs liées.");
define("_MD_AM_SESSNAME", "Nom de la session.");
define("_MD_AM_SESSNAMEDSC", "Le nom de la session (Valide uniquement lorsque l'option 'Utiliser une session personnalisée' est active)");
define("_MD_AM_SESSEXPIRE", "Expiration de la session");
define("_MD_AM_SESSEXPIREDSC", "Durée maximum de la session en minutes (Valide uniquement lorsque l'option 'Utiliser une session personnalisée' est active. Fonctionne seulement quand vous utilisez PHP 4.2.0 ou supérieur.)");
define("_MD_AM_BANNERS", "Activer l'affichage des bannières ?");
define("_MD_AM_MYIP", "Votre adresse IP");
define("_MD_AM_MYIPDSC", "Cette IP ne sera pas comptée pour l'affichage des bannières");
define("_MD_AM_ALWDHTML", "Balises HTML autorisées dans tous les envois.");
define("_MD_AM_INVLDMINPASS", "Valeur invalide pour la longueur minimum du mot de passe.");
define("_MD_AM_INVLDUCOOK", "Valeur invalide pour le nom du cookie utilisateur.");
define("_MD_AM_INVLDSCOOK", "Valeur invalide pour le nom du cookie de session.");
define("_MD_AM_INVLDSEXP", "Valeur invalide pour l'expiration de la session.");
define("_MD_AM_ADMNOTSET", "Le mail de l'administrateur n'est pas saisi.");
define("_MD_AM_YES", "Oui");
define("_MD_AM_NO", "Non");
define("_MD_AM_DONTCHNG", "Ne pas changer !");
define("_MD_AM_REMEMBER", "Rappelez-vous de faire un chmod 666 (autorisation) sur ce fichier pour permettre au système d'y écrire correctement.");
define("_MD_AM_IFUCANT", "Si vous ne changez pas les permissions vous pouvez éditer le reste de ce fichier manuellement.");


define("_MD_AM_COMMODE", "Mode d'affichage par défaut des commentaires");
define("_MD_AM_COMORDER", "Ordre d'affichage par défaut des commentaires");
define("_MD_AM_ALLOWHTML", "Autoriser les balises HTML dans les commentaires utilisateurs ?");
define("_MD_AM_DEBUGMODE", "Mode de mise au point (Debug)");
define("_MD_AM_DEBUGMODEDSC", "Vous pouvez choisir entre plusieurs options de debuggage. Un site Web courant doit avoir ceci sur inactif, puisque tout le monde pourra visualiser les messages affichés.");
define("_MD_AM_AVATARALLOW", "Permettre l'upload d'avatar personnalisé ?");
define("_MD_AM_AVATARMP", "Minimum d'envois requis");
define("_MD_AM_AVATARMPDSC", "Entrez le nombre minimum d'envois requis pour uploader un avatar personnalisé");
define("_MD_AM_AVATARW", "Largeur maxi de l'image avatar (pixels)");
define("_MD_AM_AVATARH", "Hauteur maxi de l'image avatar (pixels)");
define("_MD_AM_AVATARMAX", "Taille maxi de l'image avatar (octets)");
define("_MD_AM_AVATARCONF", "Paramètres des avatars personnalisés");
define("_MD_AM_CHNGUTHEME", "Changer tous les thèmes utilisateurs");
define("_MD_AM_NOTIFYTO", "Choisissez le groupe auquel le mail de notification d'un nouveau membre sera envoyé");
define("_MD_AM_ALLOWTHEME", "Autoriser les utilisateurs à sélectionner un thème ?");
define("_MD_AM_ALLOWIMAGE", "Autoriser les utilisateurs à afficher des fichiers images dans les envois ?");

define("_MD_AM_USERACTV", "Activation par l'utilisateur requise (recommandé)");
define("_MD_AM_AUTOACTV", "Activation automatique");
define("_MD_AM_ADMINACTV", "Activation par les administrateurs");
define("_MD_AM_ACTVTYPE", "Sélectionnez le type d'activation des membres nouvellement enregistrés");
define("_MD_AM_ACTVGROUP", "Choisissez le groupe auquel le mail d'activation doit être envoyé");
define("_MD_AM_ACTVGROUPDSC", "Valide uniquement lorsque l'option 'Activation par les administrateurs' est sélectionnée");
define("_MD_AM_USESSL", "Utiliser le SSL pour se connecter ?");
define("_MD_AM_SSLPOST", "Nom de la variable SSL");
define("_MD_AM_SSLPOSTDSC", "Nom de la variable utilisée une valeur de session en mode POST. Si vous ne savez pas quoi mettre, inventez un nom difficilement reconnaissable.");
define("_MD_AM_DEBUGMODE0", "Inactif");
define("_MD_AM_DEBUGMODE1", "Activer mode debug en ligne");
define("_MD_AM_DEBUGMODE2", "Activer mode debug en popup");
define("_MD_AM_DEBUGMODE3", "Mise au point des templates Smarty");
define("_MD_AM_MINUNAME", "Longueur minimum requise pour l'identifiant");
define("_MD_AM_MAXUNAME", "Longueur maximum requise pour l'identifiant");
define("_MD_AM_GENERAL", "Paramètres généraux");
define("_MD_AM_USERSETTINGS", "Paramètres des infos utilisateurs");
define("_MD_AM_ALLWCHGMAIL", "Autoriser les utilisateurs à changer leur adresse de courriel ?");
define("_MD_AM_ALLWCHGMAILDSC", "");
define("_MD_AM_IPBAN", "IP Interdites");
define("_MD_AM_BADEMAILS", "Entrez les courriels qui ne doivent pas être employés dans les profils utilisateurs");
define("_MD_AM_BADEMAILSDSC", "Les séparer par un |, casse insensible, regex activé. Ne jamais terminer par |");
define("_MD_AM_BADUNAMES", "Entrez les noms qui ne doivent pas être sélectionnés comme identifiant");
define("_MD_AM_BADUNAMESDSC", "Les séparer par un |, casse insensible, regex activé.");
define("_MD_AM_DOBADIPS", "Activer le bannissement d'IP ?");
define("_MD_AM_DOBADIPSDSC", "Les utilisateurs des adresses IP indiquées seront bannis de votre site");
define("_MD_AM_BADIPS", "Entrez les adresses IP qui seront bannies de ce site.<br />Les séparer par un |, casse insensible, regex activé.");
define("_MD_AM_BADIPSDSC", "^aaa.bbb.ccc bannira les visiteurs dont l'IP commence par aaa.bbb.ccc<br />aaa.bbb.ccc$ bannira les visiteurs dont l'IP se termine par aaa.bbb.ccc<br />aaa.bbb.ccc bannira les visiteurs dont l'IP contient aaa.bbb.ccc");
define("_MD_AM_PREFMAIN", "Préférences principales");
define("_MD_AM_METAKEY", "Méta keywords");
define("_MD_AM_METAKEYDSC", "La balise keywords est une série de mots-clés qui représente le contenu de votre site. Tapez les mots-clés séparés par une virgule ou un espace au milieu. (Ex. XOOPS, PHP, mySQL, portal system)");
define("_MD_AM_METARATING", "Méta rating");
define("_MD_AM_METARATINGDSC", "La balise rating définie l'âge minimum d'accès à votre site et une évaluation de son contenu");
define("_MD_AM_METAOGEN", "Général");
define("_MD_AM_METAO14YRS", "14 ans");
define("_MD_AM_METAOREST", "Limité");
define("_MD_AM_METAOMAT", "Adulte");
define("_MD_AM_METAROBOTS", "Méta robots");
define("_MD_AM_METAROBOTSDSC", "La balise robots déclare aux moteurs de recherche quel contenu indexer");
define("_MD_AM_INDEXFOLLOW", "Indexer, suivre");
define("_MD_AM_NOINDEXFOLLOW", "Ne pas indexer, suivre");
define("_MD_AM_INDEXNOFOLLOW", "Indexer, ne pas suivre");
define("_MD_AM_NOINDEXNOFOLLOW", "Ne pas indexer, ne pas suivre");
define("_MD_AM_METAAUTHOR", "Méta auteur");
define("_MD_AM_METAAUTHORDSC", "La balises auteur définit le nom de l'auteur des documents qui seront lus. Les formats de données supportés incluent le nom, l'adresse e-mail du Webmestre, le nom de l'entreprise ou l'URL.");
define("_MD_AM_METACOPYR", "Méta copyright");
define("_MD_AM_METACOPYRDSC", "La balise copyright définit n'importe quelle déclaration de droit d'auteur que vous voulez appliquer à vos documents Web.");
define("_MD_AM_METADESC", "Méta description");
define("_MD_AM_METADESCDSC", "La balise description est une description générale de ce qui est contenu dans vos pages web");
define("_MD_AM_METAFOOTER", "Méta balises et pied de page");
define("_MD_AM_FOOTER", "Pied de page");
define("_MD_AM_FOOTERDSC", "Assurez-vous de taper les liens avec le chemin complet commençant par http://, autrement les liens ne fonctionneront pas correctement dans les pages des modules.");
define("_MD_AM_CENSOR", "Options des mots à censurer");
define("_MD_AM_DOCENSOR", "Activer la censure des mots indésirables ?");
define("_MD_AM_DOCENSORDSC", "Les mots qui doivent être censurés si cette option est activée. Cette option peut être arrêtée pour accro&#238;tre la vitesse de votre site.");
define("_MD_AM_CENSORWRD", "Mots à censurer");
define("_MD_AM_CENSORWRDDSC", "Entrez les mots qui seront censurés dans les envois utilisateurs.<br />Les séparer par un |, casse insensible.");
define("_MD_AM_CENSORRPLC", "Les mots censurés seront remplacés par :");
define("_MD_AM_CENSORRPLCDSC", "Les mots censurés seront remplacés par les caractères entrés dans cette zone de texte");

define("_MD_AM_SEARCH", "Options de recherche");
define("_MD_AM_DOSEARCH", "Activer la recherche globale ?");
define("_MD_AM_DOSEARCHDSC", "Autorise la recherche d'envois/éléments dans tout votre site.");
define("_MD_AM_MINSEARCH", "Longueur minimum des mots-clés");
define("_MD_AM_MINSEARCHDSC", "Entrez la longueur minimum des mot-clés requis par les utilisateurs pour exécuter la recherche");
define("_MD_AM_MODCONFIG", "Options de configuration des modules");
define("_MD_AM_DSPDSCLMR", "Afficher un disclaimer ?");
define("_MD_AM_DSPDSCLMRDSC", "Choisissez OUI pour afficher le disclaimer dans la page d'enregistrement");
define("_MD_AM_REGDSCLMR", "Disclaimer d'enregistrement");
define("_MD_AM_REGDSCLMRDSC", "Entrez le texte qui sera affiché dans le disclaimer d'enregistrement");
define("_MD_AM_ALLOWREG", "Autoriser l'enregistrement de nouveaux utilisateurs ?");
define("_MD_AM_ALLOWREGDSC", "Choisissez OUI pour accepter l'enregistrement de nouveaux utilisateurs");
define("_MD_AM_THEMEFILE", "Actualisation des thèmes et templates pour voir les modifications ?");
define("_MD_AM_THEMEFILEDSC", "Si cette option est activée, tous les fichiers html présents dans les dossiers/sous-dossiers de votre thème seront mis à jour automatiquement. Si vous utilisez la surcharge, cette option doit être positionnée sur Oui.");
define("_MD_AM_CLOSESITE", "Arrêter le site ?");
define("_MD_AM_CLOSESITEDSC", "Choisissez oui pour arrêter votre site pour que seuls les utilisateurs d'un des groupes choisis aient accès au site. ");
define("_MD_AM_CLOSESITEOK", "Sélectionnez les groupes qui seront autorisés à accéder au site lorsqu'il est arrêté.");
define("_MD_AM_CLOSESITEOKDSC", "On accorde toujours aux utilisateurs du groupe administrateurs l'accès par défaut.");
define("_MD_AM_CLOSESITETXT", "Raison de l'arrêt du site");
define("_MD_AM_CLOSESITETXTDSC", "Le texte qui sera présenté quand le site est fermé.");
define("_MD_AM_SITECACHE", "Cache large du site");
define("_MD_AM_SITECACHEDSC", "Mise en cache du contenu du site pour un temps indiqué afin d'augmenter les performances et diminuer le nombre de requêtes SQL. La mise en cache large du site ignorera le cache au niveau des modules, le cache au niveau des blocs et le cache au niveau du module des articles.");
define("_MD_AM_MODCACHE", "Cache large des modules");
define("_MD_AM_MODCACHEDSC", "Mettre en cache le contenu des modules pour un temps indiqué afin d'augmenter les performances. <br />La mise en cache large des modules ignorera le cache au niveau du module des articles.");
define("_MD_AM_NOMODULE", "Il n'y a pas de modules qui peuvent être mis en cache.");
define("_MD_AM_DTPLSET", "Choix du jeu de templates par défaut");
define("_MD_AM_SSLLINK", "URL pour la page de la connexion SSL");

// added for mailer
define("_MD_AM_MAILER", "Paramètre mail");
define("_MD_AM_MAILER_MAIL", "");
define("_MD_AM_MAILER_SENDMAIL", "");
define("_MD_AM_MAILER_", "");
define("_MD_AM_MAILFROM", "De adresse");
define("_MD_AM_MAILFROMDESC", "");
define("_MD_AM_MAILFROMNAME", "De nom");
define("_MD_AM_MAILFROMNAMEDESC", "");
// RMV-NOTIFY
define("_MD_AM_MAILFROMUID", "De utilisateur");
define("_MD_AM_MAILFROMUIDDESC", "Quand le système envoie un message privé, avec quel utilisateur doit-il sembler avoir été envoyé ?");
define("_MD_AM_MAILERMETHOD", "Méthode d'envoi du mail");
define("_MD_AM_MAILERMETHODDESC", "La méthode utilisée pour envoyer le mail. Par défaut c'est 'mail', utiliser une autre uniquement en cas de problèmes.");
define("_MD_AM_SMTPHOST", "Hôte(s) SMTP");
define("_MD_AM_SMTPHOSTDESC", "Liste des serveurs SMTP pour essayer de se connecter.");
define("_MD_AM_SMTPUSER", "Nom utilisateur SMTPAuth");
define("_MD_AM_SMTPUSERDESC", "Nom utilisateur pour se connecter à l'hôte STMP avec SMTPAuth.");
define("_MD_AM_SMTPPASS", "Mot de passe SMTPAuth");
define("_MD_AM_SMTPPASSDESC", "Mot de passe pour se connecter à l'hôte STMP avec SMTPAuth.");
define("_MD_AM_SENDMAILPATH", "Chemin pour l'envoi du mail");
define("_MD_AM_SENDMAILPATHDESC", "Chemin du programe d'envoi du mail (ou substitut) sur le serveur.");
define("_MD_AM_THEMEOK", "Thèmes sélectionnables");
define("_MD_AM_THEMEOKDSC", "Choisissez les thèmes que les utilisateurs peuvent choisir comme thème par défaut dans le bloc thèmes");

// Xoops Authentication constants
define("_MD_AM_AUTH_CONFOPTION_XOOPS", "Base de données XOOPS");
define("_MD_AM_AUTH_CONFOPTION_LDAP", "Annuaire Standard LDAP");
define("_MD_AM_AUTH_CONFOPTION_AD", "Annuaire Active Directory Microsoft &copy");
define("_MD_AM_AUTHENTICATION", "Options d'authentification");
define("_MD_AM_AUTHMETHOD", "Méthode d'authentification");
define("_MD_AM_AUTHMETHODDESC", "Quelle méthode voulez-vous utiliser pour authentifier vos utilisateurs.");
define("_MD_AM_LDAP_MAIL_ATTR", "Attribut du mail");
define("_MD_AM_LDAP_MAIL_ATTR_DESC", "Le nom de l'attribut représentant le mail dans votre annuaire.");
define("_MD_AM_LDAP_NAME_ATTR", "Attribut nom complet de la personne");
define("_MD_AM_LDAP_NAME_ATTR_DESC", "Le nom de l'attribut représentant le nom complet de la personne (en général 'cn').");
define("_MD_AM_LDAP_SURNAME_ATTR", "Attribut nom de famille de la personne");
define("_MD_AM_LDAP_SURNAME_ATTR_DESC", "Le nom de l'attribut représentant le nom de famille de la personne (en général 'sn').");
define("_MD_AM_LDAP_GIVENNAME_ATTR", "Attribut prénom de la personne");
define("_MD_AM_LDAP_GIVENNAME_ATTR_DSC", "Le nom de l'attribut représentant le prénom de la personne (en général 'givenname').");
define("_MD_AM_LDAP_BASE_DN", "DN de base");
define("_MD_AM_LDAP_BASE_DN_DESC", "Nom du DN de base pour les utilisateurs (ou=users,dc=xoops,dc=org).");
define("_MD_AM_LDAP_PORT", "Port LDAP");
define("_MD_AM_LDAP_PORT_DESC", "Port d'écoute de votre annuaire LDAP (par défaut 389 ).");
define("_MD_AM_LDAP_SERVER", "Nom du serveur");
define("_MD_AM_LDAP_SERVER_DESC", "Nom ou adresse IP du serveur LDAP.");

define("_MD_AM_LDAP_MANAGER_DN", "DN de recherche");
define("_MD_AM_LDAP_MANAGER_DN_DESC", "DN de la personne autorisée à faire des recherches (par exemple cn=manager,dc=xoops,dc=org)");
define("_MD_AM_LDAP_MANAGER_PASS", "Mot de passe de recherche");
define("_MD_AM_LDAP_MANAGER_PASS_DESC", "Mot de passe de la personne autorisée à faire des recherches");
define("_MD_AM_LDAP_VERSION", "Version LDAP");
define("_MD_AM_LDAP_VERSION_DESC", "Version du protocole LDAP : 2 ou 3");
define("_MD_AM_LDAP_USERS_BYPASS", "Utilisateurs contournant l'authentification LDAP");
define("_MD_AM_LDAP_USERS_BYPASS_DESC", "Authentification directe dans la base de données Xoops.<br />Les noms utilisateurs seront séparés par |");

define("_MD_AM_LDAP_USETLS", " Utilisez une connexion TLS");
define("_MD_AM_LDAP_USETLS_DESC", "Utilisez une connexion TLS (Transport Layer Security).<br />TLS utlise le port 389 par défaut" .
                                                                  " et la version LDAP doit être fixée à 3.");

define("_MD_AM_LDAP_LOGINLDAP_ATTR", "Attribut utilisé pour rechercher un utilisateur");
define("_MD_AM_LDAP_LOGINLDAP_ATTR_D", "Quand l'utilisation du nom de connexion dans l'option DN est placée à oui, il doit correspondre à celui de XOOPS");
define("_MD_AM_LDAP_LOGINNAME_ASDN", "Nom de login présent dans le DN");
define("_MD_AM_LDAP_LOGINNAME_ASDN_D", "Le nom de login XOOPS est utilisé dans le DN (eg : uid=<loginname>,dc=xoops,dc=org)<br />L'entrée est directement lue dans le serveur LDAP sans recherche");

define("_MD_AM_LDAP_FILTER_PERSON", "Filtre de recherche LDAP pour trouver un utilisateur");
define("_MD_AM_LDAP_FILTER_PERSON_DESC", "Filtre spécial pour la recherche de personne. @@loginname@@ est remplacé par le nom de login<br /> Laisser en blanc par défaut !" .
                "<br />Ex : (&(objectclass=person)(samaccountname=@@loginname@@)) pour AD" .
                "<br />Ex : (&(objectclass=inetOrgPerson)(uid=@@loginname@@)) pour LDAP");

define("_MD_AM_LDAP_DOMAIN_NAME", "Nom de domaine");
define("_MD_AM_LDAP_DOMAIN_NAME_DESC", "Nom de domaine Windows. Pour ADS et serveur NT");

define("_MD_AM_LDAP_PROVIS", "Provisionnement automatique du compte XOOPS");
define("_MD_AM_LDAP_PROVIS_DESC", "Créé le compte XOOPS automatiquement si l'authentification est correcte");

define("_MD_AM_LDAP_PROVIS_GROUP", "Affectation par défaut au(x) groupe(s)");
define("_MD_AM_LDAP_PROVIS_GROUP_DSC", "Sélectionner les groupes auquels l'utilisateur créé sera affecté");

define("_MD_AM_LDAP_FIELD_MAPPING_ATTR", "Corrrespondance des champs serveur Xoops-Auth");
define("_MD_AM_LDAP_FIELD_MAPPING_DESC", "Décrivez ici les correspondances entre le champ base de données Xoops et le champ système de l'authentification LDAP." .
                "<br /><br />Format [champ base de données Xoops]=[attribut système LDAP Auth]" .
                "<br />par exemple : courriel=mail" .
                "<br />Séparez chacun d'eux avec un |" .
                "<br /><br />!! Pour utilisateurs expérimentés !!");

define("_MD_AM_LDAP_PROVIS_UPD", "Conserver l'alimentation du compte Xoops");
define("_MD_AM_LDAP_PROVIS_UPD_DESC", "Le compte utilisateur Xoops est toujours synchronisé avec le serveur d'authentification");


define("_MD_AM_CPANEL", "Interface du Panneau de configuration");
define("_MD_AM_CPANELDSC", "Pour la partie administrateur");

define("_MD_AM_WELCOMETYPE", "Message de bienvenue");
define("_MD_AM_WELCOMETYPE_DESC", "La façon d'envoyer un message de bienvenue à un utilisateur lors de son inscription.");
define("_MD_AM_WELCOMETYPE_EMAIL", "Courriel");
define("_MD_AM_WELCOMETYPE_PM", "Message privé");
define("_MD_AM_WELCOMETYPE_BOTH", "Courriel et Message privé");

define("_MD_AM_MODULEPREF", "Préférences des Modules");

/**
 * @translation     FRXOOPS (XOOPS France) <http://www.frxoops.org/>
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: UTF-8 sans BOM
 *
 * @version        2010-07
**/
?>