<?php
/**
 * Name: admin.php
 * Description: Xoops FAQ module admin language defines
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module : Xoops FAQ
 * @subpackage : Module Language
 * @since 2.3.0
 * @author John Neill
 * @version $Id: admin.php 0000 10/04/2009 09:05:06 John Neill $
 * Traduction: LionHell 
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Accès restreint' );

/**
 * Icons
 */
define( '_XO_LA_EDIT', 'Editer item' );
define( '_XO_LA_DELETE', 'Supprimer item' );
define( '_XO_LA_CREATENEW', 'Créer nouvel item' );
define( '_XO_LA_MODIFYITEM', 'Modifier item: %s' );

/**
 * Content
 */
define( '_XO_LA_CONTENTS_HEADER', 'Gestion du contenu des Faq' );
define( '_XO_LA_CONTENTS_SUBHEADER', '' );
define( '_XO_LA_CONTENTS_LIST_DSC', '' );
define( '_XO_LA_CONTENTS_ID', '#' );
define( '_XO_LA_CONTENTS_TITLE', 'Titre du contenu' );
define( '_XO_LA_CONTENTS_WEIGHT', 'Poids' );
define( '_XO_LA_CONTENTS_PUBLISH', 'Publié' );
define( '_XO_LA_CONTENTS_ACTIVE', 'Activer' );
define( '_XO_LA_ACTIONS', 'Actions' );
define( '_XO_LAE_CONTENTS_CATEGORY', 'Catégorie du contenu:' );
define( '_XO_LAE_CONTENTS_CATEGORY_DSC', 'Choisir une catégorie pour placer cet article' );
define( '_XO_LAE_CONTENTS_TITLE', 'Titre du contenu:' );
define( '_XO_LAE_CONTENTS_TITLE_DSC', 'Saisir un titre pour cet item.' );
define( '_XO_LAE_CONTENTS_CONTENT', 'Contenu:' );
define( '_XO_LAE_CONTENTS_CONTENT_DSC', '' );
define( '_XO_LAE_CONTENTS_PUBLISH', 'Heure:' );
define( '_XO_LAE_CONTENTS_PUBLISH_DSC', 'Choisir la date de publication' );
define( '_XO_LAE_CONTENTS_WEIGHT', 'Poids du contenu:' );
define( '_XO_LAE_CONTENTS_WEIGHT_DSC', 'Saisir une valeur pour l\'ordre de tri. ' );
define( '_XO_LAE_CONTENTS_ACTIVE', 'Contenu actif:' );
define( '_XO_LAE_CONTENTS_AVTIVE_DSC', 'Définir si cet item sera caché ou pas' );
define( '_XO_LAE_DOHTML', 'Afficher en Html' );
define( '_XO_LAE_BREAKS', 'Convertir les retours à la ligne en Xoopskreaks' );
define( '_XO_LAE_DOIMAGE', 'Afficher les images Xoops' );
define( '_XO_LAE_DOXCODE', 'Afficher les codes Xoops' );
define( '_XO_LAE_DOSMILEY', 'Afficher les smileys Xoops' );

/**
 * Category
 */
define( '_XO_LA_ADDCAT', 'Ajouter une catégorie' );
define( '_XO_LA_CATEGORY_HEADER', 'Gestion des catégories de la Faq' );
define( '_XO_LA_CATEGORY_SUBHEADER', '' );
define( '_XO_LA_CATEGORY_DELETE_DSC', 'Confirmation de suppression ! Vous allez détruire cet item. Vous pouvez annuler cette action en cliquant sur le bouton annuler ou choisir de poursuivre.<br /><br />Cette action est irréversible.' );
define( '_XO_LA_CATEGORY_EDIT_DSC', 'Mode édition: Vous pouvez modifier les propriétés de cet item ici. Cliquez sur le bouton envoyer pour confirmer le changement ou sur annuler pour retourner où vous étiez.' );
define( '_XO_LA_CATEGORY_LIST_DSC', '' );
define( '_XO_LA_CATEGORY_ID', '#' );
define( '_XO_LA_CATEGORY_TITLE', 'Titre' );
define( '_XO_LA_CATEGORY_WEIGHT', 'Poids' );
define( '_XO_LA_ACTIONS', 'Actions' );
define( '_XO_LAE_CATEGORY_TITLE', 'Titre de la catégorie:' );
define( '_XO_LAE_CATEGORY_TITLE_DSC', '' );
define( '_XO_LAE_CATEGORY_WEIGHT', 'Poids de la catégorie:' );
define( '_XO_LAE_CATEGORY_WEIGHT_DSC', '' );

/**
 * Buttons
 */
define( '_XO_LA_CREATENEW', 'Créer nouveau' );
define( '_XO_LA_NOLISTING', 'Aucun item trouvé' );

/**
 * Database and error
 */
define( '_XO_LA_FAQ_SUBERROR', 'Une erreur est survenue<br />' );
define( '_XO_LA_RUSURECAT', 'Etes-vous sûr de vouloir supprimer cette catégorie et toutes ses questions ?' );
define( '_XO_LA_DBSUCCESS', 'Base de données mise à jour avec succès !' );
define( '_XO_LA_ERRORNOCATEGORY', 'Erreur: Pas de nom de catégorie, revenez en arrière et saisissez un nom de catégorie' );
define( '_XO_LA_ERRORCOULDNOTADDCAT', 'Erreur: Impossible d\'ajouter une catégorie à la base de données.' );
define( '_XO_LA_ERRORCOULDNOTDELCAT', 'Erreur: Impossible de supprimer la catégorie désirée.' );
define( '_XO_LA_ERRORCOULDNOTEDITCAT', 'Erreur: Impossible de modifier l\'item voulu.' );
define( '_XO_LA_ERRORCOULDNOTDELCONTENTS', 'Erreur: Impossible de supprimer le contenu des FAQ. ' );
define( '_XO_LA_ERRORCOULDNOTUPCONTENTS', 'Erreur: Impossible de mettre à jour le contenu des FAQ.' );
define( '_XO_LA_ERRORCOULDNOTADDCONTENTS', 'Erreur: Impossible d\'ajouter au contenu des FAQ.' );
define( '_XO_LA_NOTHTINGTOSHOW', 'Aucun item à afficher' );
define( '_XO_LA_ERRORNOCAT', 'Erreur: Il n\'y a encore aucune catégorie créée. Avant de créer une nouvelle FAQ vous devez créer une catégorie.' );

?>