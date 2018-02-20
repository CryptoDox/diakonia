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
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * Icons
 */
define( '_XO_LA_EDIT', 'Edit Item' );
define( '_XO_LA_DELETE', 'Delete Item' );
define( '_XO_LA_CREATENEW', 'Create New Item' );
define( '_XO_LA_MODIFYITEM', 'Modify Item: %s' );

/**
 * Content
 */
define( '_XO_LA_CONTENTS_HEADER', 'Faq Content Management' );
define( '_XO_LA_CONTENTS_SUBHEADER', '' );
define( '_XO_LA_CONTENTS_LIST_DSC', '' );
define( '_XO_LA_CONTENTS_ID', '#' );
define( '_XO_LA_CONTENTS_TITLE', 'Content Title' );
define( '_XO_LA_CONTENTS_WEIGHT', 'Weight' );
define( '_XO_LA_CONTENTS_PUBLISH', 'Published' );
define( '_XO_LA_CONTENTS_ACTIVE', 'Active' );
define( '_XO_LA_ACTIONS', 'Actions' );
define( '_XO_LAE_CONTENTS_CATEGORY', 'Content Category:' );
define( '_XO_LAE_CONTENTS_CATEGORY_DSC', 'Select a category you wish this item to be placed under' );
define( '_XO_LAE_CONTENTS_TITLE', 'Content Title:' );
define( '_XO_LAE_CONTENTS_TITLE_DSC', 'Enter a title for this item.' );
define( '_XO_LAE_CONTENTS_CONTENT', 'Content Body:' );
define( '_XO_LAE_CONTENTS_CONTENT_DSC', '' );
define( '_XO_LAE_CONTENTS_PUBLISH', 'Content Time:' );
define( '_XO_LAE_CONTENTS_PUBLISH_DSC', 'Select the date for the publish date' );
define( '_XO_LAE_CONTENTS_WEIGHT', 'Content Weight:' );
define( '_XO_LAE_CONTENTS_WEIGHT_DSC', 'Enter a value for the item order. ' );
define( '_XO_LAE_CONTENTS_ACTIVE', 'Content Active:' );
define( '_XO_LAE_CONTENTS_AVTIVE_DSC', 'Select whether this item will be hidden or not' );
define( '_XO_LAE_DOHTML', 'Show as Html' );
define( '_XO_LAE_BREAKS', 'Convert Linebreaks to Xoopskreaks' );
define( '_XO_LAE_DOIMAGE', 'Show Xoops Images' );
define( '_XO_LAE_DOXCODE', 'Show Xoops Codes' );
define( '_XO_LAE_DOSMILEY', 'Show Xoops Smilies' );

/**
 * Category
 */
define( '_XO_LA_ADDCAT', 'Add Category' );
define( '_XO_LA_CATEGORY_HEADER', 'Faq Category Management' );
define( '_XO_LA_CATEGORY_SUBHEADER', '' );
define( '_XO_LA_CATEGORY_DELETE_DSC', 'Delete Check! You are about to delete this item. You can cancel this action by clicking on the cancel button or you can choose to continue.<br /><br />This action is not reversible.' );
define( '_XO_LA_CATEGORY_EDIT_DSC', 'Edit Mode: You can edit this item properties here. Click the submit button to make your changes permanent or click Cancel to return you were you where.' );
define( '_XO_LA_CATEGORY_LIST_DSC', '' );
define( '_XO_LA_CATEGORY_ID', '#' );
define( '_XO_LA_CATEGORY_TITLE', 'Title' );
define( '_XO_LA_CATEGORY_WEIGHT', 'Weight' );
define( '_XO_LA_ACTIONS', 'Actions' );
define( '_XO_LAE_CATEGORY_TITLE', 'Category Title:' );
define( '_XO_LAE_CATEGORY_TITLE_DSC', '' );
define( '_XO_LAE_CATEGORY_WEIGHT', 'Category Weight:' );
define( '_XO_LAE_CATEGORY_WEIGHT_DSC', '' );

/**
 * Buttons
 */
define( '_XO_LA_CREATENEW', 'Create New' );
define( '_XO_LA_NOLISTING', 'No Items Found' );

/**
 * Database and error
 */
define( '_XO_LA_FAQ_SUBERROR', 'We have encountered an Error<br />' );
define( '_XO_LA_RUSURECAT', 'Are you sure you want to delete this category and all of its FAQ?' );
define( '_XO_LA_DBSUCCESS', 'Database Updated Successfully!' );
define( '_XO_LA_ERRORNOCATEGORY', 'Error: No category name given, please go back and enter a category name' );
define( '_XO_LA_ERRORCOULDNOTADDCAT', 'Error: Could not add category to database.' );
define( '_XO_LA_ERRORCOULDNOTDELCAT', 'Error: Could not delete requested category.' );
define( '_XO_LA_ERRORCOULDNOTEDITCAT', 'Error: Could not edit requested item.' );
define( '_XO_LA_ERRORCOULDNOTDELCONTENTS', 'Error: Could not delete FAQ contents.' );
define( '_XO_LA_ERRORCOULDNOTUPCONTENTS', 'Error: Could not update FAQ contents.' );
define( '_XO_LA_ERRORCOULDNOTADDCONTENTS', 'Error: Could not add FAQ contents.' );
define( '_XO_LA_NOTHTINGTOSHOW', 'No Items To Display' );
define( '_XO_LA_ERRORNOCAT', 'Error: There are no Categories created yet. Before you can create a new FAQ, you must create a Category first.' );

?>