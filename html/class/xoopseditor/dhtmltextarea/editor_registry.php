<?php
/**
 * XOOPS editor
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author          Taiwen Jiang (phppp or D.J.) <php_pp@hotmail.com>
 * @since           2.3.0
 * @version         $Id: editor_registry.php 4897 2010-06-19 02:55:48Z phppp $
 * @package         xoopseditor
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

return $config = array( 'class' => 'FormDhtmlTextArea',
	'file' => XOOPS_ROOT_PATH . '/class/xoopseditor/dhtmltextarea/dhtmltextarea.php',
	'title' => _XOOPS_EDITOR_DHTMLTEXTAREA,
	'order' => 2,
	'nohtml' => 1
	);

?>