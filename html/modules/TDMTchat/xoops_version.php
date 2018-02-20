<?php
/**
 * ****************************************************************************
 *  - TDMTchat By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.tdmxoops.net)
 *
 * 	Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR PRO license
 * @author		TDMFR ; TEAM DEV MODULE ; Venom 
 *
 * ****************************************************************************
 */
 
$modversion['name'] = 'TDMTchat';
$modversion['version'] = 1.00;
//$modversion['description'] = _MI_NOTIFY_DESC;
$modversion['author'] = 'TDM';
$modversion['author_website_url'] = "http://www.tdmxoops.net/";
$modversion['author_website_name'] = "Team Dev Module";
$modversion['credits'] = 'None';
$modversion['help'] = 'None';
$modversion['license'] = 'Licensed - PRO';
$modversion['official'] = 1;
$modversion['image'] = 'images/tdmtchat.png';
$modversion['dirname'] = 'TDMTchat';

//install
//$modversion['onInstall'] = 'include/install.php';

//about
$modversion["module_website_url"] = "http://www.tdmxoops.net";
$modversion["module_website_name"] = "TDM";

$modversion["release"] = "2010-21-01";
$modversion["module_status"] = "Release";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] = _MI_TDMTCHAT_MES;
$modversion['sub'][1]['url'] = "message.php";

// Search
$modversion['hasSearch'] = 0;

// Notification
$modversion['hasNotification'] = 0;

// Database
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'tdmtchat_tchat';


$modversion['templates'][1]['file'] = 'tdmtchat_index.html';
$modversion['templates'][1]['description'] = 'Index';
$modversion['templates'][2]['file'] = 'tdmtchat_message.html';
$modversion['templates'][2]['description'] = 'Message';

//config
$i=1;
$modversion['config'][$i]['name']	= 'tdmtchat_pageuser';
$modversion['config'][$i]['title']	= '_MI_TDMTCHAT_USERPAGE';
$modversion['config'][$i]['description']	= '';
$modversion['config'][$i]['formtype']	= 'textbox';
$modversion['config'][$i]['valuetype']	= 'int';
$modversion['config'][$i]['default']	= 10;
$i++;
$modversion['config'][$i]['name'] = 'tdmtchat_history';
$modversion['config'][$i]['title'] = '_MI_TDMTCHAT_HISTORY';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 7;
$i++;
?>
