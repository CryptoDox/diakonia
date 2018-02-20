<?php 

$modversion['name'] = "CryptoDuke";
$modversion['version'] = 1.1;
$modversion['description'] = _MI_CRYPTODUKE_DESC; // _MI_TDMCREATE_DESC
$modversion['author'] = 'CryptoDuke';
$modversion['author_website_url'] = "https://elduke3d.shost.ca";
$modversion['author_website_name'] = "El Duke 3D My Book";
$modversion['credits'] = "none";
$modversion['license'] = "GPL";
$modversion["release_info"] = "README";
$modversion["release_file"] = XOOPS_URL."/modules/cryptoduke/readme.txt";
$modversion["manual"] = "MANUAL";
$modversion["manual_file"] = XOOPS_URL."/modules/cryptoduke/manual.txt";
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = "cryptoduke";

//about
$modversion['demo_site_url'] = "https://elduke3d.shost.ca";
$modversion['demo_site_name'] = "El Duke 3D My Book";
$modversion["module_website_url"] = "https://elduke3d.shost.ca";
$modversion["module_website_name"] = "El Duke 3D My Book";

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
$modversion['tables'][0] = "cryptoduke_modules"; // tdmcreate_modules
$modversion['tables'][1] = "cryptoduke_tables"; // tdmcreate_tables

// Scripts to run upon installation or update
$modversion['onInstall'] = "include/install.php";
//$modversion['onUpdate'] = "include/update.php";

// Menu
$modversion['hasMain'] = 0;

?>