<?php
/**
 * ****************************************************************************
 *  - TDMNotify By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
$modversion['name'] = 'TDMNotify';
$modversion['version'] = 1.01;
$modversion['description'] = _MI_NOTIFY_DESC;
$modversion['author'] = 'TDM';
$modversion['author_website_url'] = "http://www.tdmxoops.net/";
$modversion['author_website_name'] = "Team Dev Mdodule";
$modversion['credits'] = 'None';
$modversion['help'] = 'None';
$modversion['license'] = 'GPL Licensed - No Warranty';
$modversion['official'] = 1;
$modversion['image'] = 'images/TDMNotify.png';
$modversion['dirname'] = 'TDMNotify';

//install
//$modversion['onInstall'] = 'include/install.php';

//about
$modversion["module_website_url"] = "http://www.tdmxoops.net";
$modversion["module_website_name"] = "TDM";

$modversion["release"] = "2008-03-04";
$modversion["module_status"] = "Release";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 0;
// Search
$modversion['hasSearch'] = 0;

// Notification
$modversion['hasNotification'] = 0;

// Database
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'tdmnotify_block';
$modversion['tables'][1] = 'tdmnotify_notif';
$modversion['tables'][2] = 'tdmnotify_form';


$modversion['templates'][1]['file'] = 'tdmnotify_index.html';
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'tdmnotify_top.html';
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = 'tdmnotify_bottom.html';
$modversion['templates'][3]['description'] = '';

//config
$i=1;
$modversion['config'][$i]['name'] = 'mimemax';
$modversion['config'][$i]['title'] = '_MI_NOTIFY_MIMEMAX';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '10485760';
$i++;
include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
$modversion["config"][$i]["name"]           = "TDMNotify_editor";
$modversion["config"][$i]["title"]          = "_MI_NOTIFY_EDITOR";
$modversion["config"][$i]["description"]    = "";
$modversion["config"][$i]["formtype"]       = "select";
$modversion["config"][$i]["valuetype"]      = "text";
$modversion["config"][$i]["default"]        = "dhtmltextarea";
$modversion["config"][$i]["options"]        = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . "/class/xoopseditor");
$modversion["config"][$i]["category"]       = "global";
$i++;
$modversion['config'][$i]['name']	= 'send_user';
$modversion['config'][$i]['title']	= '_MI_NOTIFY_USER';
$modversion['config'][$i]['description']	= '';
$modversion['config'][$i]['formtype']	= 'select';
$modversion['config'][$i]['valuetype']	= 'int';
$modversion['config'][$i]['default']	= 1;
$modversion['config'][$i]['options']	= array('_MI_NOTIFY_NON' => 1,'_MI_NOTIFY_MP' => 2,'_MI_NOTIFY_MAIL' => 3);
$i++;
$modversion['config'][$i]['name'] = 'send_user_text';
$modversion['config'][$i]['title'] = '_MI_NOTIFY_USER_TEXT';
$modversion['config'][$i]['description'] = '_MI_NOTIFY_NOTIFY_DESC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';
$i++;
$modversion['config'][$i]['name']	= 'send_notify';
$modversion['config'][$i]['title']	= '_MI_NOTIFY_NOTIFY';
$modversion['config'][$i]['description']	= '';
$modversion['config'][$i]['formtype']	= 'select';
$modversion['config'][$i]['valuetype']	= 'int';
$modversion['config'][$i]['default']	= 1;
$modversion['config'][$i]['options']	= array('_MI_NOTIFY_NON' => 1,'_MI_NOTIFY_MP' => 2,'_MI_NOTIFY_MAIL' => 3);
$i++;
$modversion['config'][$i]['name'] = 'send_notify_text';
$modversion['config'][$i]['title'] = '_MI_NOTIFY_NOTIFY_TEXT';
$modversion['config'][$i]['description'] = '_MI_NOTIFY_NOTIFY_DESC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';
$i++;
?>
