<?php
/**
 * Name: xoops_version.php
 * Description:
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
 * @Module :
 * @subpackage :
 * @since 2.3.0
 * @author John Neill
 * @version $Id: xoops_version.php 0000 10/04/2009 09:30:53 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * Module configs
 */
$modversion = array( 'name' => _XO_MI_XOOPSFAQ_NAME,
	'description' => _XO_MI_XOOPSFAQ_DESC,
	'author' => 'John Neill, Kazumi Ono',
	'license' => 'GPL see LICENSE',
	'contributors' => '',
	'credits' => 'The Xoops Module Development Team',
	'version' => 1.15,
	'status' => 'Beta',
	'releasedate' => 'Friday 10.4.2009',
	'official' => 1,
	'image' => 'images/slogo.png',
	'website_url' => 'http://www.xoops.org',
	'dirname' => basename( dirname( __FILE__ ) )
	);

/**
 * Module Sql
 */
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

/**
 * Module SQL Tables
 */
$modversion['tables'] = array( 'faq_contents', 'faq_categories' ) ;

/**
 * Module Admin
 */
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

/**
 * Module Main
 */
$modversion['hasMain'] = 1;

/**
 * Module Search
 */
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'xoopsfaq_search';

/**
 * Module Templates
 */
$modversion['templates'][] = array( 'file' => 'xoopsfaq_index.html', 'description' => '' );
$modversion['templates'][] = array( 'file' => 'xoopsfaq_category.html', 'description' => '' );
/**
 * Module Comments
 */
$modversion['hasComments'] = 1;
$modversion['comments'][] = array( 'pageName' => 'index.php', 'itemName' => 'cat_id' );

/**
 * Module configs
 */
$modversion['config'][] = array( 'name' => 'use_wysiwyg',
	'title' => '_XO_MI_XOOPSFAQ_EDITORS',
	'description' => '_XO_MI_XOOPSFAQ_EDITORS_DSC',
	'formtype' => 'select',
	'valuetype' => 'text',
	'default' => 'dhtmltextarea',
	'options' => array( 'Plain Editor' => 'textarea', 'XoopsEditor' => 'dhtmltextarea', 'Tiny Editor' => 'tinymce', 'FCK Editor' => 'fckeditor', 'Koivi Editor' => 'koivi' )
	);

?>