<?php
/**
 * Name: menu.php
 * Description: Menu for the Xoops FAQ Module
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
 * @package : Xoops
 * @Module : Xoops FAQ
 * @subpackage : Xoops FAQ Adminisration
 * @since 2.3.0
 * @author John Neill
 * @version $Id: menu.php 0000 10/04/2009 08:55:20 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );
/**
 * Admin Menus
 */
$adminmenu[] = array( 'title' => _XO_MI_MENU_ADMININDEX, 'link' => 'admin/index.php' );
$adminmenu[] = array( 'title' => _XO_MI_MENU_ADMINCATEGORY, 'link' => 'admin/category.php' );

?>