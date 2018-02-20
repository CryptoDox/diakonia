<?php
/**
 * Tag management for XOOPS
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Taiwen Jiang (phppp or D.J.) <php_pp@hotmail.com>
 * @since		1.00
 * @version		$Id: config.php 527 2009-08-03 16:49:29Z dugris $
 * @package		module::tag
 */

if (!defined('XOOPS_ROOT_PATH')){ exit(); }


/* 
 * Due to the difference of word boundary for different languages, delimiters also depend on languages
 * You need specify all possbile deimiters here, (",", ";", " ", "|") will be taken if no delimiter is set
 *
 * Tips:
 * For English sites, you can set as array(",", ";", " ", "|")
 * For Chinese sites, set as array(",", ";", " ", "|", "£¬")
 */
//$GLOBALS["tag_delimiter"] = array(",", " ", "|", ";");
$GLOBALS["tag_delimiter"] = array(",", "|", ";");

/**
 * @translation     Communauté Francophone des Utilisateurs de Xoops
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: ISO-8859-1
 *
 * @version         $Id: modinfo.php 1304 2010-10-17 22:21:07Z kris_fr $
**/
?>