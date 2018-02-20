<?php
/**
 * ****************************************************************************
 *  - TDMCreate By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence GPL Copyright (c)  (http://www.tdmxoops.net)
 *
 * Cette licence, contient des limitations!!!
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license     TDM GPL license
 * @author		TDM TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
function const_entete($modules)
{
	$text = '';
	$modules_name = $modules->getVar('modules_name');
	$modules_version = $modules->getVar('modules_version');
	$modules_author = $modules->getVar('modules_author');
	$modules_author_website_url = $modules->getVar('modules_author_website_url');
	$modules_license = $modules->getVar('modules_license');
	
	$text .= '
/**
 * ****************************************************************************
 * Module généré par TDMCreate de la TDM "http://www.tdmxoops.net"
 * ****************************************************************************
 * '.$modules_name.' - MODULE FOR XOOPS AND IMPRESS CMS
 * Copyright (c) '.$modules_author.' ('.$modules_author_website_url.')
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       '.$modules_author.' ('.$modules_author_website_url.')
 * @license         '.$modules_license.'
 * @package         '.$modules_name.'
 * @author 			'.$modules_author.' ('.$modules_author_website_url.')
 *
 * Version : '.$modules_version.':
 * ****************************************************************************
 */
 ';
	
	return $text;
}

?>