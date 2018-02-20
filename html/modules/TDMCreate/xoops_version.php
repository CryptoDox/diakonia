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


$modversion['name'] = "TDMCreate";
$modversion['version'] = 1.1;
$modversion['description'] = _MI_TDMCREATE_DESC;
$modversion['author'] = 'TDM';
$modversion['author_website_url'] = "http://www.tdmxoops.net/";
$modversion['author_website_name'] = "Team Dev Mdodule";
$modversion['credits'] = "none";
$modversion['license'] = "GPL";
$modversion["release_info"] = "README";
$modversion["release_file"] = XOOPS_URL."/modules/TDMCreate/readme.txt";
$modversion["manual"] = "MANUAL";
$modversion["manual_file"] = XOOPS_URL."/modules/TDMCreate/manual.txt";
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = "TDMCreate";

//about
$modversion['demo_site_url'] = "http://www.tdmxoops.net/";
$modversion['demo_site_name'] = "TDM";
$modversion["module_website_url"] = "http://www.tdmxoops.net/";
$modversion["module_website_name"] = "TDM";

$modversion["release"] = "23-07-2009";
$modversion["module_status"] = "Release";
//

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Mysql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables
$modversion['tables'][0] = "tdmcreate_modules";
$modversion['tables'][1] = "tdmcreate_tables";

// Scripts to run upon installation or update
$modversion['onInstall'] = "include/install.php";
//$modversion['onUpdate'] = "include/update.php";

// Menu
$modversion['hasMain'] = 0;

?>