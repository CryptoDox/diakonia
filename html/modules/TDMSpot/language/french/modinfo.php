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
define('_MI_SPOT_NAME',' TDMSpot');
define('_MI_SPOT_DESC',' Spot gestion de vos blocks');
define('_MI_SPOT_INDEX',' Index');
define('_MI_SPOT_PAGE',' Pages index');
define('_MI_SPOT_BLOCK',' Blocks');
define('_MI_SPOT_CAT',' Catégorie');
define('_MI_SPOT_ITEM',' Article');
define('_MI_SPOT_PERMISSIONS','Permissions');
define('_MI_SPOT_ABOUT','About');
define('_MI_SPOT_PREF','Préférences');

// pref
define('_MI_TDMSPOT_NAME','Index: Afficher le nom des pages ?');
define('_MI_TDMSPOT_DISPLAY','Index: Style de l\'effect');
define("_MI_TDMSPOT_MIMEMAX","Taille maxi des fichiers pour l'upload");
define("_MI_TDMSPOT_MIMETYPE","Extension autoriser s&#233;parer par | ");
define('_MI_TDMSPOT_PAGE','Catégorie: Limite par defaut du nombre d\'article');
define('_MI_TDMSPOT_IMG','catégorie: Afficher l\'image dans les articles');
define('_MI_TDMSPOT_CAT_WIDTH','Catégorie: Largeur maxi de l\'image');
define('_MI_TDMSPOT_CAT_HEIGHT','Catégorie: Hauteur maxi de l\'image');

define('_MI_TDMSPOT_BLINDATE','Catégorie: Block : Afficher x articles récents ?');
define('_MI_TDMSPOT_BLCOUNTS','Catégorie: Block : Afficher x articles populaires ?');
define('_MI_TDMSPOT_BLHITS','Catégorie: Block : Afficher x articles affichages ?');
define('_MI_TDMSPOT_BLTITLE','Catégorie/Item: Block : Limite du titre ?');
define('_MI_TDMSPOT_FORNULL','0 pour ne rien afficher');
define('_MI_TDMSPOT_BLSIMIL','Item: Block : Afficher x articles similaires ?');
define('_MI_TDMSPOT_BLPOSTER','Item: Block : Afficher x articles du même auteur ?');
define('_MI_TDMSPOT_PRESENT','Item: Afficher la présentation de l\'auteur ?');
define("_MI_TDMSPOT_DESCRIPTION","META : Description des pages sans information, pour le reste des pages cela seras automatique");
define("_MI_TDMSPOT_KEYWORDS","META : Mots clef des pages sans information, séparer les mots par un espace, pour le reste des pages cela seras automatique");

define('_MI_TDMSPOT_SEO','Activer la réécriture d\'URL?');
define('_MI_TDMSPOT_SEO_DESC','Ne pas oublier le fichier .htaccess à la racine de votre site');
define('_MI_TDMSPOT_SEO_TITLE','Nom du module pour l\'URL Rewriting?');
define('_MI_TDMSPOT_SEO_CAT','Nom des catégories pour l\'URL Rewriting?');
define('_MI_TDMSPOT_SEO_ITEM','Nom des articles pour l\'URL Rewriting?');
define('_MI_TDMSPOT_EDITOR','Editeur?');

//block
define("_MI_SPOT_BLOCK_TITLE","Ordre alphabétique");
define("_MI_SPOT_BLOCK_DATE","Date de publication");
define("_MI_SPOT_BLOCK_HITS","Affichage");
define("_MI_SPOT_BLOCK_COUNTS","Popularité");
define("_MI_SPOT_BLOCK_COMMENT","Critiques");
define("_MI_SPOT_BLOCK_RAND","Au hasard");
define('_MI_SPOT_BLOCK_LIMIT','Limite');
define('_MI_SPOT_BLOCK_TEXTE','Limite du texte');
define('_MI_SPOT_BLOCK_CAT','Catégorie');

//version 1.3
define('_MI_TDMSPOT_NEXTPREV','Item: Afficher les liens précèdent, suivant ?');

//version 1.5
define("_MI_TDMSPOT_CAT_CEL","Affichage catégorie : Nombre de colonne");
define("_MI_TDMSPOT_CAT_DISPLAY","Affichage : Style des catégories");
define("_MI_TDMSPOT_CAT_DISPLAY_TEXT","Catégorie puis sous-catégorie (sans image)");
define("_MI_TDMSPOT_CAT_DISPLAY_TEXTIMG","Catégorie puis sous-catégorie (avec image)");
define("_MI_TDMSPOT_CAT_DISPLAY_SUB","Catégorie et sous-catégorie (sans image)");
define("_MI_TDMSPOT_CAT_DISPLAY_SUBIMG","Catégorie et sous-catégorie (avec image)");
define("_MI_TDMSPOT_CAT_DISPLAY_IMG","Image");
define("_MI_TDMSPOT_CAT_DISPLAY_NONE","Non");
define("_MI_TDMSPOT_CAT_SOUSCEL","Affichage catégorie : Nombre de sous-catégorie");
?>
