<?php
// $Id: xoops_version.php,v 1.22 2004/05/29 15:10:18 mithyt2 Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
//  Based on standard News module v1.2 with several changes by Mithrandir    //

if (!defined('XOOPS_ROOT_PATH')){ exit(); }

//Added AMS 2.50 Beta 2
//Fetch AMS spotlight dynamicly
$spotlight_templates_list_count=0;
$path = XOOPS_ROOT_PATH."/modules/AMS/templates";
if ($handle = opendir($path))
{
	while (false !== ($file = readdir($handle)))
	{
		//if not a folder...
		if (!is_dir($path."/".$file) && $file != "." && $file != "..")
		{
			//if it is spotlight templates..
			if(substr($file,0,19)=="ams_block_spotlight" && substr($file, strlen($file) - 5)==".html")
			{			
					$template_name_offset=20;
					$template_name=substr($file,$template_name_offset,strlen($file)-$template_name_offset-5);
					$spotlight_templates[$template_name]=$file;
					$spotlight_templates_list[$spotlight_templates_list_count]=$file;
					$spotlight_templates_list_count++;
			}
		}
	}
   closedir($handle);
}

$modversion['name'] = _AMS_MI_NEWS_NAME;
$modversion['version'] = "3.00 Final";
$modversion['description'] = _AMS_MI_NEWS_DESC;
$modversion['author'] = "NovaSmart Technology, Jan Keller Pedersen (Mithrandir)<br>Dominic Ryan (Brashquido)<br>Jeffrey Tindillier (jctsup1)";
$modversion['credits'] = "The XOOPS Project<br><br>Herv� Thouzard for his work with the News 1.2 module on which AMS is based. Also to Feichtl and speedbit for contributing language files.<br><br>Also a very big thank you to all who donated to the AMS development costs. Without your financial support a public release of this module would not have been possible!";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 1;
$modversion['image'] = "images/ams_slogo.png";
$modversion['dirname'] = "AMS";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";
//$modversion['onInstall'] = "include/install.php";
$modversion['onUpdate'] = "include/update.php";
$modversion['onUninstall'] = "include/uninstall.php";
// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "ams_article";
$modversion['tables'][1] = "ams_topics";
$modversion['tables'][2] = "ams_files";
$modversion['tables'][3] = "ams_link";
$modversion['tables'][4] = "ams_text";
$modversion['tables'][5] = "ams_rating";
$modversion['tables'][6] = "ams_audience";
$modversion['tables'][7] = "ams_spotlight";
$modversion['tables'][8] = "ams_setting";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Templates
$template_count=1;
$modversion['templates'][$template_count]['file'] = 'ams_item.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_archive.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_article.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_index.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_by_topic.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_ratearticle.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_version.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

$modversion['templates'][$template_count]['file'] = 'ams_searchform.html';
$modversion['templates'][$template_count]['description'] = '';
$template_count++;

//Added AMS 2.50 Beta 2
//Put detected SPOTLIGHT templates to templates
for($i=0;$i<$spotlight_templates_list_count;$i++)
{
	$modversion['templates'][$template_count]['file'] = $spotlight_templates_list[$i];
	$modversion['templates'][$template_count]['description'] = '';
	$template_count++;
}

// Blocks
$block_count=1;
$modversion['blocks'][$block_count]['file'] = "ams_topics.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME1;
$modversion['blocks'][$block_count]['description'] = "Shows news topics";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_topics_show";
$modversion['blocks'][$block_count]['template'] = 'ams_block_topics.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_bigstory.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME3;
$modversion['blocks'][$block_count]['description'] = "Shows most read story of the day";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_bigstory_show";
$modversion['blocks'][$block_count]['template'] = 'ams_block_bigstory.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_top.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME4;
$modversion['blocks'][$block_count]['description'] = "Shows top read news articles";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_top_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_top_edit";
$modversion['blocks'][$block_count]['options'] = "counter|10|25|0";
$modversion['blocks'][$block_count]['template'] = 'ams_block_top.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_top.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME5;
$modversion['blocks'][$block_count]['description'] = "Shows recent articles";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_top_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_top_edit";
$modversion['blocks'][$block_count]['options'] = "published|10|25|0";
$modversion['blocks'][$block_count]['template'] = 'ams_block_top.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_moderate.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME6;
$modversion['blocks'][$block_count]['description'] = "Shows a block to moderate articles";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_topics_moderate";
$modversion['blocks'][$block_count]['template'] = 'ams_block_moderate.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_topicsnav.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME7;
$modversion['blocks'][$block_count]['description'] = "Shows a block to navigate topics";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_topicsnav_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_topicsnav_edit";
$modversion['blocks'][$block_count]['options'] = 0;
$modversion['blocks'][$block_count]['template'] = 'ams_block_topicnav.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_author.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME8;
$modversion['blocks'][$block_count]['description'] = "Shows top authors";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_author_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_author_edit";
$modversion['blocks'][$block_count]['options'] = "count|5|uname";
$modversion['blocks'][$block_count]['template'] = 'ams_block_authors.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_author.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME9;
$modversion['blocks'][$block_count]['description'] = "Shows top authors";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_author_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_author_edit";
$modversion['blocks'][$block_count]['options'] = "read|5|uname";
$modversion['blocks'][$block_count]['template'] = 'ams_block_authors.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_author.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME10;
$modversion['blocks'][$block_count]['description'] = "Shows top authors";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_author_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_author_edit";
$modversion['blocks'][$block_count]['options'] = "rating|5|uname";
$modversion['blocks'][$block_count]['template'] = 'ams_block_authors.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_top.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME11;
$modversion['blocks'][$block_count]['description'] = "Shows top rated articles";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_top_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_top_edit";
$modversion['blocks'][$block_count]['options'] = "rating|10|25|0";
$modversion['blocks'][$block_count]['template'] = 'ams_block_top.html';
$block_count++;

$modversion['blocks'][$block_count]['file'] = "ams_spotlight.php";
$modversion['blocks'][$block_count]['name'] = _AMS_MI_NEWS_BNAME12;
$modversion['blocks'][$block_count]['description'] = "Spotlight articles";
$modversion['blocks'][$block_count]['show_func'] = "b_ams_spotlight_show";
$modversion['blocks'][$block_count]['edit_func'] = "b_ams_spotlight_edit";
$modversion['blocks'][$block_count]['options'] = "10|1|".$spotlight_templates_list[0];
$modversion['blocks'][$block_count]['template'] = 'ams_block_spotlight.html';

$block_count++;


// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] = _AMS_MI_NEWS_SMNAME2;
$modversion['sub'][1]['url'] = "archive.php";

global $xoopsModule;
if (isset($xoopsModule) && $xoopsModule->getVar('dirname') == $modversion['dirname']) {
    global $xoopsUser;
    if (is_object($xoopsUser)) {
        $groups = $xoopsUser->getGroups();
    } else {
        $groups = XOOPS_GROUP_ANONYMOUS;
    }
    $gperm_handler =& xoops_gethandler('groupperm');
    if ($gperm_handler->checkRight("ams_submit", 0, $groups, $xoopsModule->getVar('mid'))) {
        $modversion['sub'][2]['name'] = _AMS_MI_NEWS_SMNAME1;
        $modversion['sub'][2]['url'] = "submit.php";
    }
}


// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "ams_search";

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'article.php';
$modversion['comments']['itemName'] = 'storyid';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'ams_com_approve';
$modversion['comments']['callback']['update'] = 'ams_com_update';

// Config Settings (only for modules that need config settings generated automatically)

$config_count=1;
// name of config option for accessing its specified value. i.e. $xoopsModuleConfig['storyhome']
$modversion['config'][$config_count]['name'] = 'storyhome';

// title of this config option displayed in config settings form
$modversion['config'][$config_count]['title'] = '_AMS_MI_STORYHOME';

// description of this config option displayed under title
$modversion['config'][$config_count]['description'] = '_AMS_MI_STORYHOMEDSC';

// form element type used in config form for this option. can be one of either textbox, textarea, select, select_multi, yesno, group, group_multi
$modversion['config'][$config_count]['formtype'] = 'select';

// value type of this config option. can be one of either int, text, float, array, or other
// form type of group_multi, select_multi must always be value type of array
$modversion['config'][$config_count]['valuetype'] = 'int';

// the default value for this option
// ignore it if no default
// 'yesno' formtype must be either 0(no) or 1(yes)
$modversion['config'][$config_count]['default'] = 5;

// options to be displayed in selection box
// required and valid for 'select' or 'select_multi' formtype option only
// language constants can be used for array key, otherwise use integer
$modversion['config'][$config_count]['options'] = array('1' => 1, '5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30);
$config_count++;

$modversion['config'][$config_count]['name'] = 'storycountadmin';
$modversion['config'][$config_count]['title'] = '_AMS_MI_STORYCOUNTADMIN';
$modversion['config'][$config_count]['description'] = '_AMS_MI_STORYCOUNTADMIN_DESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 10;
$modversion['config'][$config_count]['options'] = array('1' => 1, '2' => 2, '4' => 4, '5' => 5, '6' => 6, '8' => 8, '9' => 9, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '35' => 35, '40' => 40);
$config_count++;

$modversion['config'][$config_count]['name'] = "storyhome_topic";
$modversion['config'][$config_count]['title'] = '_AMS_MI_STORYCOUNTTOPIC';
$modversion['config'][$config_count]['description'] = '_AMS_MI_STORYCOUNTTOPIC_DESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 10;
$modversion['config'][$config_count]['options'] = array('1' => 1, '2' => 2, '4' => 4, '5' => 5, '6' => 6, '8' => 8, '9' => 9, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '35' => 35, '40' => 40);
$config_count++;

$modversion['config'][$config_count]['name'] = 'max_items';
$modversion['config'][$config_count]['title'] = '_AMS_MI_MAXITEMS';
$modversion['config'][$config_count]['description'] = '_AMS_MI_MAXITEMDESC';
$modversion['config'][$config_count]['formtype'] = 'text';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 30;
$config_count++;

$modversion['config'][$config_count]['name'] = 'spotlight_art_num';
$modversion['config'][$config_count]['title'] = '_AMS_MI_SPOTLIGHT_ITEMS';
$modversion['config'][$config_count]['description'] = '_AMS_MI_SPOTLIGHT_ITEMDESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 20;
$modversion['config'][$config_count]['options'] = array('1' => 1, '5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '50' => 50, '100' => 100, '500' => 500);
$config_count++;

$modversion['config'][$config_count]['name'] = 'displaynav';
$modversion['config'][$config_count]['title'] = '_AMS_MI_DISPLAYNAV';
$modversion['config'][$config_count]['description'] = '_AMS_MI_DISPLAYNAVDSC';
$modversion['config'][$config_count]['formtype'] = 'yesno';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 1;
$config_count++;

$modversion['config'][$config_count]['name'] = 'autoapprove';
$modversion['config'][$config_count]['title'] = '_AMS_MI_AUTOAPPROVE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_AUTOAPPROVEDSC';
$modversion['config'][$config_count]['formtype'] = 'yesno';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 0;
$config_count++;

$modversion['config'][$config_count]['name'] = 'uploadgroups';
$modversion['config'][$config_count]['title'] = '_AMS_MI_UPLOADGROUPS';
$modversion['config'][$config_count]['description'] = '_AMS_MI_UPLOADGROUPS_DESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 2;
$modversion['config'][$config_count]['options'] = array('_AMS_MI_UPLOAD_GROUP1' => 1, '_AMS_MI_UPLOAD_GROUP2' => 2, '_AMS_MI_UPLOAD_GROUP3' => 3);
$config_count++;

$modversion['config'][$config_count]['name'] = 'maxuploadsize';
$modversion['config'][$config_count]['title'] = '_AMS_MI_UPLOADFILESIZE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_UPLOADFILESIZE_DESC';
$modversion['config'][$config_count]['formtype'] = 'texbox';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 1048576;
$config_count++;

//Workaround for XOOPS Cube Legacy 2.2. XC not support XOOPS Editor by default
if(file_exists(XOOPS_ROOT_PATH.'/class/xoopseditor/xoopseditor.php'))
{
    //To be compatible with XOOPS 2.2.x
    if(file_exists(XOOPS_ROOT_PATH.'/class/xoopslists.php'))
    {
        include_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
    }
    include_once XOOPS_ROOT_PATH.'/class/xoopseditor/xoopseditor.php';
    //$editor_handler = XoopsEditorHandler::getInstance();
    $editor_handler = new XoopsEditorHandler;
    $editor_list=array_flip($editor_handler->getList());
}else
{
    $editor_list= array('_AMS_MI_EDITOR_DEFAULT' => 'textarea', '_AMS_MI_EDITOR_DHTML' => 'dhtmlext');
}
$modversion['config'][$config_count]['name'] = 'editor';
$modversion['config'][$config_count]['title'] = '_AMS_MI_EDITOR';
$modversion['config'][$config_count]['description'] = '_AMS_MI_EDITOR_DESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'text';
$modversion['config'][$config_count]['default'] = 0;
$modversion['config'][$config_count]['options'] = $editor_list;
$config_count++;

$modversion['config'][$config_count]['name'] = 'editor_userchoice';
$modversion['config'][$config_count]['title'] = '_AMS_MI_EDITOR_USER_CHOICE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_EDITOR_USER_CHOICE_DESC';
$modversion['config'][$config_count]['formtype'] = 'yesno';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 1;
$config_count++;

$modversion['config'][$config_count]['name'] = 'editor_choice';
$modversion['config'][$config_count]['title'] = '_AMS_MI_EDITOR_CHOICE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_EDITOR_CHOICE_DESC';
$modversion['config'][$config_count]['formtype'] = 'select_multi';
$modversion['config'][$config_count]['valuetype'] = 'array';
$modversion['config'][$config_count]['default'] = $editor_list;
$modversion['config'][$config_count]['options'] = $editor_list;
//$modversion['config'][12]['category'] = 'tiny_settings';
$config_count++;

$modversion['config'][$config_count]['name'] = 'newsdisplay';
$modversion['config'][$config_count]['title'] = '_AMS_MI_NEWSDISPLAY';
$modversion['config'][$config_count]['description'] = '_AMS_MI_NEWSDISPLAYDESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'text';
$modversion['config'][$config_count]['default'] = "Classic";
$modversion['config'][$config_count]['options'] = array('_AMS_MI_NEWSCLASSIC' => 'Classic',
                                            '_AMS_MI_NEWSBYTOPIC' => 'Bytopic');
$config_count++;

// For Author's name
$modversion['config'][$config_count]['name'] = 'displayname';
$modversion['config'][$config_count]['title'] = '_AMS_MI_NAMEDISPLAY';
$modversion['config'][$config_count]['description'] = '_AMS_MI_ADISPLAYNAMEDSC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 1;
$modversion['config'][$config_count]['options']	= array('_AMS_MI_DISPLAYNAME1' => 1, '_AMS_MI_DISPLAYNAME2' => 2, '_AMS_MI_DISPLAYNAME3' => 3);
$config_count++;

$modversion['config'][$config_count]['name'] = 'columnmode';
$modversion['config'][$config_count]['title'] = '_AMS_MI_COLUMNMODE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_COLUMNMODE_DESC';
$modversion['config'][$config_count]['formtype'] = 'select';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 1;
$modversion['config'][$config_count]['options'] = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5);
$config_count++;

$modversion['config'][$config_count]['name'] = 'restrictindex';
$modversion['config'][$config_count]['title'] = '_AMS_MI_RESTRICTINDEX';
$modversion['config'][$config_count]['description'] = '_AMS_MI_RESTRICTINDEXDSC';
$modversion['config'][$config_count]['formtype'] = 'yesno';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 0;
$config_count++;

$modversion['config'][$config_count]['name'] = 'anonymous_vote';
$modversion['config'][$config_count]['title'] = '_AMS_MI_ANONYMOUS_VOTE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_ANONYMOUS_VOTE_DESC';
$modversion['config'][$config_count]['formtype'] = 'yesno';
$modversion['config'][$config_count]['valuetype'] = 'int';
$modversion['config'][$config_count]['default'] = 0;
$config_count++;

$modversion['config'][$config_count]['name'] = 'index_name';
$modversion['config'][$config_count]['title'] = '_AMS_MI_INDEX_NAME';
$modversion['config'][$config_count]['description'] = '_AMS_MI_INDEX_DESC';
$modversion['config'][$config_count]['formtype'] = 'textbox';
$modversion['config'][$config_count]['valuetype'] = 'text';
$modversion['config'][$config_count]['default'] = "Index";
$config_count++;

$modversion['config'][$config_count]['name'] = 'spotlight_template';
$modversion['config'][$config_count]['title'] = '_AMS_MI_SPOTLIGHT_TEMPLATE';
$modversion['config'][$config_count]['description'] = '_AMS_MI_SPOTLIGHT_TEMPLATE_DESC';
$modversion['config'][$config_count]['formtype'] = 'select_multi';
$modversion['config'][$config_count]['valuetype'] = 'array';
$modversion['config'][$config_count]['default'] = $spotlight_templates;
$modversion['config'][$config_count]['options'] = $spotlight_templates;
$config_count++;

/**
 * Mime Types
 */
$modversion['config'][$config_count]['name'] = 'mimetypes';
$modversion['config'][$config_count]['title'] = '_AMS_MI_MIME_TYPES';
$modversion['config'][$config_count]['description'] = '';
$modversion['config'][$config_count]['formtype'] = 'textarea';
$modversion['config'][$config_count]['valuetype'] = 'text';
$modversion['config'][$config_count]['default'] = "application/vnd.ms-powerpoint;application/vnd.ms-powerpoint;application/vnd.ms-powerpoint;text/xml;text/html;text/plain;image/tiff;image/vnd.microsoft.icon;image/gif;image/jpeg;image/pjpeg;image/x-png;image/png;application/x-zip-compressed;application/msword;application/vnd.ms-excel;application/pdf;application/x-gtar;application/x-gzip;application/x-tar;application/zip;application/x-shockwave-flash;video/x-flv;application/x-rar-compressed;image/bmp;audio/mpeg;audio/x-realaudio;video/quicktime";
$config_count++;


// Notification
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'ams_notify_iteminfo';

$modversion['notification']['category'][1]['name'] = 'global';
$modversion['notification']['category'][1]['title'] = _AMS_MI_NEWS_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description'] = _AMS_MI_NEWS_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'article.php');

$modversion['notification']['category'][2]['name'] = 'story';
$modversion['notification']['category'][2]['title'] = _AMS_MI_NEWS_STORY_NOTIFY;
$modversion['notification']['category'][2]['description'] = _AMS_MI_NEWS_STORY_NOTIFYDSC;
$modversion['notification']['category'][2]['subscribe_from'] = array('article.php');
$modversion['notification']['category'][2]['item_name'] = 'storyid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;

$modversion['notification']['event'][1]['name'] = 'new_category';
$modversion['notification']['event'][1]['category'] = 'global';
$modversion['notification']['event'][1]['title'] = _AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYCAP;
$modversion['notification']['event'][1]['description'] = _AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYDSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject'] = _AMS_MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYSBJ;

$modversion['notification']['event'][2]['name'] = 'story_submit';
$modversion['notification']['event'][2]['category'] = 'global';
$modversion['notification']['event'][2]['admin_only'] = 1;
$modversion['notification']['event'][2]['title'] = _AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFY;
$modversion['notification']['event'][2]['caption'] = _AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYCAP;
$modversion['notification']['event'][2]['description'] = _AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYDSC;
$modversion['notification']['event'][2]['mail_template'] = 'global_storysubmit_notify';
$modversion['notification']['event'][2]['mail_subject'] = _AMS_MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYSBJ;

$modversion['notification']['event'][3]['name'] = 'new_story';
$modversion['notification']['event'][3]['category'] = 'global';
$modversion['notification']['event'][3]['title'] = _AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFY;
$modversion['notification']['event'][3]['caption'] = _AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYCAP;
$modversion['notification']['event'][3]['description'] = _AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYDSC;
$modversion['notification']['event'][3]['mail_template'] = 'global_newstory_notify';
$modversion['notification']['event'][3]['mail_subject'] = _AMS_MI_NEWS_GLOBAL_NEWSTORY_NOTIFYSBJ;

$modversion['notification']['event'][4]['name'] = 'approve';
$modversion['notification']['event'][4]['category'] = 'story';
$modversion['notification']['event'][4]['invisible'] = 1;
$modversion['notification']['event'][4]['title'] = _AMS_MI_NEWS_STORY_APPROVE_NOTIFY;
$modversion['notification']['event'][4]['caption'] = _AMS_MI_NEWS_STORY_APPROVE_NOTIFYCAP;
$modversion['notification']['event'][4]['description'] = _AMS_MI_NEWS_STORY_APPROVE_NOTIFYDSC;
$modversion['notification']['event'][4]['mail_template'] = 'story_approve_notify';
$modversion['notification']['event'][4]['mail_subject'] = _AMS_MI_NEWS_STORY_APPROVE_NOTIFYSBJ;
?>