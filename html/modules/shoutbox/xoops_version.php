<?php
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
//  Original Author: Alphalogic <alphafake@hotmail.com>					     //
//  Original Author Website: http://www.alphalogic-network.de		         //
//  ------------------------------------------------------------------------ //
//  XOOPS Version made by: (XOOPS 1.3.x and 2.0.x version)			         //
//  Jan304 <http://www.jan304.org>									         //
//  ------------------------------------------------------------------------ //
//  Author:     tank                                                         //
//  Website:    http://www.customvirtualdesigns.com                          //
//  E-Mail:     tanksplace@comcast.net                                       //
//  Date:       12/01/2008                                                   //
//  Module:     Shoutbox                                                     //
//  File:       xoops_version.php                                            //
//  Version:    4.04                                                         //
//  ------------------------------------------------------------------------ //
//  Change Log                                                               //
//  ***                                                                      //
//  Version 4.01 Initial CVD Release 10/05/2008                              //
//  ***                                                                      //
//  Version 4.02  11/01/2008                                                 //
//  New: Add captcha enable/disable parameter                                //
//  New: Expand auto-refresh options                                         //
//  ***                                                                      //
//  Version 4.03  11/15/2008                                                 //
//  New: Eliminate local module copy of the captcha class                    //
//  New: Add preference parameter for setting/enabling wordwrap              //
//  New: Add preference parameter to enable/disable avatar display in block  //
//  New: Add Frameworks captcha support                                      //
//  ***                                                                      //
//  Version 4.04  12/01/2008                                                 //
//  New: Add selectable guest avatars                                        //
//  ***                                                                      //
//  Version 4.05  12/15/2008                                                 //
//  Update version                                                           //
//  ***                                                                      //
//  Version 5.0  24/01/2010                                                 //
//  Update version by xuups.com                                                          //
//  ***                                                                      //

$modversion['name'] = _MI_SHOUTBOX_NAME;
$modversion['version'] = '5.0alpha';
$modversion['description'] = _MI_SHOUTBOX_DESC;
$modversion['credits'] = "The XOOPS Project";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/module_logo.png";
$modversion['dirname'] = "shoutbox";
$modversion['author'] = 'xuups, tank (refer to readme_archive for previous developer info)';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "shoutbox";

// Blocks
$modversion['blocks'][1]['file'] = "shoutbox.php";
$modversion['blocks'][1]['name'] = _MI_SHOUTBOX_BLOCK;
$modversion['blocks'][1]['description'] = _MI_SHOUTBOX_DESC;
$modversion['blocks'][1]['show_func'] = "b_shoutbox_show";
$modversion['blocks'][1]['template'] = 'shoutbox_block.html';

// Menu
$modversion['hasMain'] = 0;

// Templates
$modversion['templates'][1]['file'] = 'shoutbox_popup.html';
$modversion['templates'][1]['description'] = 'Template for popup';
$modversion['templates'][2]['file'] = 'shoutbox_shoutframe.html';
$modversion['templates'][2]['description'] = 'Template for block-iframe content';
$modversion['templates'][3]['file'] = 'shoutbox_popupframe.html';
$modversion['templates'][3]['description'] = 'Template for popup-iframe content';
$modversion['templates'][4]['file'] = 'shoutbox_popupheader.html';
$modversion['templates'][4]['description'] = '';
$modversion['templates'][5]['file'] = 'shoutbox_online.html';
$modversion['templates'][5]['description'] = '';

$modversion['onInstall'] = 'include/module.php';
$modversion['onUninstall'] = 'include/module.php';

// Config settings
// Global settings:
$modversion['config'][0]['name'] = 'global_settings';
$modversion['config'][0]['title'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][0]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][0]['formtype'] = 'select';
$modversion['config'][0]['valuetype'] = 'text';
$modversion['config'][0]['options'] = array('_MI_SHOUTBOX_CAT1' => '1');

$modversion['config'][1]['name'] = 'guests_may_post';
$modversion['config'][1]['title'] = '_MI_SHOUTBOX_TITLE1';
$modversion['config'][1]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][1]['formtype'] = 'yesno';
$modversion['config'][1]['valuetype'] = 'int';
$modversion['config'][1]['default'] = 1;

$modversion['config'][2]['name'] = 'guests_may_chname';
$modversion['config'][2]['title'] = '_MI_SHOUTBOX_TITLE2';
$modversion['config'][2]['description'] = '_MI_SHOUTBOX_DESC2';
$modversion['config'][2]['formtype'] = 'yesno';
$modversion['config'][2]['valuetype'] = 'int';
$modversion['config'][2]['default'] = 0;

$modversion['config'][3]['name'] = 'allow_bbcode';
$modversion['config'][3]['title'] = '_MI_SHOUTBOX_TITLE3';
$modversion['config'][3]['description'] = '_MI_SHOUTBOX_DESC3';
$modversion['config'][3]['formtype'] = 'yesno';
$modversion['config'][3]['valuetype'] = 'int';
$modversion['config'][3]['default'] = 1;

$modversion['config'][4]['name'] = 'stamp_format';
$modversion['config'][4]['title'] = '_MI_SHOUTBOX_TITLE4';
$modversion['config'][4]['description'] = '_MI_SHOUTBOX_DESC4';
$modversion['config'][4]['formtype'] = 'textbox';
$modversion['config'][4]['valuetype'] = 'text';
$modversion['config'][4]['default'] = 'h:i a';

$modversion['config'][5]['name'] = 'maxshouts_trim';
$modversion['config'][5]['title'] = '_MI_SHOUTBOX_TITLE5';
$modversion['config'][5]['description'] = '_MI_SHOUTBOX_DESC5';
$modversion['config'][5]['formtype'] = 'textbox';
$modversion['config'][5]['valuetype'] = 'int';
$modversion['config'][5]['default'] = '20';

$modversion['config'][6]['name'] = 'maxshouts_view';
$modversion['config'][6]['title'] = '_MI_SHOUTBOX_TITLE6';
$modversion['config'][6]['description'] = '_MI_SHOUTBOX_DESC6';
$modversion['config'][6]['formtype'] = 'textbox';
$modversion['config'][6]['valuetype'] = 'int';
$modversion['config'][6]['default'] = '20';

$modversion['config'][7]['name'] = 'storage_type';
$modversion['config'][7]['title'] = '_MI_SHOUTBOX_TITLE7';
$modversion['config'][7]['description'] = '_MI_SHOUTBOX_DESC7';
$modversion['config'][7]['formtype'] = 'select';
$modversion['config'][7]['valuetype'] = 'text';
$modversion['config'][7]['options'] = array('_MI_SHOUTBOX_OP7_F' => 'file', '_MI_SHOUTBOX_OP7_D' => 'database');
$modversion['config'][7]['default'] = 'file';

// Block Settings:
$modversion['config'][10]['name'] = 'block_settings';
$modversion['config'][10]['title'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][10]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][10]['formtype'] = 'select';
$modversion['config'][10]['valuetype'] = 'text';
$modversion['config'][10]['options'] = array('_MI_SHOUTBOX_CAT2' => '1');

$modversion['config'][11]['name'] = 'show_smileybar';
$modversion['config'][11]['title'] = '_MI_SHOUTBOX_TITLE11';
$modversion['config'][11]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][11]['formtype'] = 'yesno';
$modversion['config'][11]['valuetype'] = 'int';
$modversion['config'][11]['default'] = 1;

$modversion['config'][12]['name'] = 'iframe_width';
$modversion['config'][12]['title'] = '_MI_SHOUTBOX_TITLE12';
$modversion['config'][12]['description'] = '_MI_SHOUTBOX_DESC12';
$modversion['config'][12]['formtype'] = 'textbox';
$modversion['config'][12]['valuetype'] = 'text';
$modversion['config'][12]['default'] = '100%';

$modversion['config'][13]['name'] = 'iframe_height';
$modversion['config'][13]['title'] = '_MI_SHOUTBOX_TITLE13';
$modversion['config'][13]['description'] = '_MI_SHOUTBOX_DESC13';
$modversion['config'][13]['formtype'] = 'textbox';
$modversion['config'][13]['valuetype'] = 'text';
$modversion['config'][13]['default'] = '150';

$modversion['config'][14]['name'] = 'iframe_border';
$modversion['config'][14]['title'] = '_MI_SHOUTBOX_TITLE14';
$modversion['config'][14]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][14]['formtype'] = 'textbox';
$modversion['config'][14]['valuetype'] = 'text';
$modversion['config'][14]['default'] = '0';

$modversion['config'][15]['name'] = 'popup';
$modversion['config'][15]['title'] = '_MI_SHOUTBOX_TITLE15';
$modversion['config'][15]['description'] = '_MI_SHOUTBOX_DESC15';
$modversion['config'][15]['formtype'] = 'yesno';
$modversion['config'][15]['valuetype'] = 'int';
$modversion['config'][15]['default'] = 1;

$modversion['config'][16]['name'] = 'block_autorefresh';
$modversion['config'][16]['title'] = '_MI_SHOUTBOX_TITLE16';
$modversion['config'][16]['description'] = '_MI_SHOUTBOX_DESC16';
$modversion['config'][16]['formtype'] = 'select';
$modversion['config'][16]['valuetype'] = 'int';
$modversion['config'][16]['options'] = Array('_MI_SHOUTBOX_OP16_BA0' => 0, '_MI_SHOUTBOX_OP16_BA1' => 1);
$modversion['config'][16]['default'] = 1;

$modversion['config'][17]['name'] = 'wordwrap_setting';
$modversion['config'][17]['title'] = '_MI_SHOUTBOX_TITLE17';
$modversion['config'][17]['description'] = '_MI_SHOUTBOX_DESC17';
$modversion['config'][17]['formtype'] = 'text';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = 0;

$modversion['config'][18]['name'] = 'display_avatar';
$modversion['config'][18]['title'] = '_MI_SHOUTBOX_TITLE18';
$modversion['config'][18]['description'] = '_MI_SHOUTBOX_DESC18';
$modversion['config'][18]['formtype'] = 'yesno';
$modversion['config'][18]['valuetype'] = 'int';
$modversion['config'][18]['default'] = 1;

$modversion['config'][19]['name'] = 'guest_avatar';
$modversion['config'][19]['title'] = '_MI_SHOUTBOX_TITLE19';
$modversion['config'][19]['description'] = '_MI_SHOUTBOX_DESC19';
$modversion['config'][19]['formtype'] = 'select';
$modversion['config'][19]['valuetype'] = 'int';
$modversion['config'][19]['options'] = array('_MI_SHOUTBOX_OP19_GA0' => 0, '_MI_SHOUTBOX_OP19_GA1' => 1, '_MI_SHOUTBOX_OP19_GA2' => 2, '_MI_SHOUTBOX_OP19_GA3' => 3, '_MI_SHOUTBOX_OP19_GA4' => 4, '_MI_SHOUTBOX_OP19_GA5' => 5);
$modversion['config'][19]['default'] = 1;

// PopUp:
$modversion['config'][30]['name'] = 'popup_settings';
$modversion['config'][30]['title'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][30]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][30]['formtype'] = 'select';
$modversion['config'][30]['valuetype'] = 'text';
$modversion['config'][30]['options'] = array('_MI_SHOUTBOX_CAT3' => '1');

$modversion['config'][31]['name'] = 'popup_whoisonline';
$modversion['config'][31]['title'] = '_MI_SHOUTBOX_TITLE31';
$modversion['config'][31]['description'] = '_MI_SHOUTBOX_DESC31';
$modversion['config'][31]['formtype'] = 'yesno';
$modversion['config'][31]['valuetype'] = 'int';
$modversion['config'][31]['default'] = 1;

$modversion['config'][32]['name'] = 'popup_show_smileybar';
$modversion['config'][32]['title'] = '_MI_SHOUTBOX_TITLE32';
$modversion['config'][32]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][32]['formtype'] = 'yesno';
$modversion['config'][32]['valuetype'] = 'int';
$modversion['config'][32]['default'] = 1;

$modversion['config'][33]['name'] = 'popup_sound';
$modversion['config'][33]['title'] = '_MI_SHOUTBOX_TITLE33';
$modversion['config'][33]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][33]['formtype'] = 'yesno';
$modversion['config'][33]['valuetype'] = 'int';
$modversion['config'][33]['default'] = 1;

$modversion['config'][34]['name'] = 'popup_guests';
$modversion['config'][34]['title'] = '_MI_SHOUTBOX_TITLE34';
$modversion['config'][34]['description'] = '_MI_SHOUTBOX_DESC34';
$modversion['config'][34]['formtype'] = 'yesno';
$modversion['config'][34]['valuetype'] = 'int';
$modversion['config'][34]['default'] = 0;

$modversion['config'][35]['name'] = 'popup_irc';
$modversion['config'][35]['title'] = '_MI_SHOUTBOX_TITLE35';
$modversion['config'][35]['description'] = '_MI_SHOUTBOX_DESC35';
$modversion['config'][35]['formtype'] = 'yesno';
$modversion['config'][35]['valuetype'] = 'int';
$modversion['config'][35]['default'] = 1;

$modversion['config'][36]['name'] = 'popup_autofocus';
$modversion['config'][36]['title'] = '_MI_SHOUTBOX_TITLE36';
$modversion['config'][36]['description'] = '_MI_SHOUTBOX_DESC36';
$modversion['config'][36]['formtype'] = 'yesno';
$modversion['config'][36]['valuetype'] = 'int';
$modversion['config'][36]['default'] = 1;

$modversion['config'][37]['name'] = 'popup_width';
$modversion['config'][37]['title'] = '_MI_SHOUTBOX_TITLE37';
$modversion['config'][37]['description'] = '_MI_SHOUTBOX_DESC37';
$modversion['config'][37]['formtype'] = 'textbox';
$modversion['config'][37]['valuetype'] = 'text';
$modversion['config'][37]['default'] = '500';

$modversion['config'][38]['name'] = 'popup_height';
$modversion['config'][38]['title'] = '_MI_SHOUTBOX_TITLE38';
$modversion['config'][38]['description'] = '_MI_SHOUTBOX_DESC38';
$modversion['config'][38]['formtype'] = 'textbox';
$modversion['config'][38]['valuetype'] = 'text';
$modversion['config'][38]['default'] = '340';

// Text Input:
$modversion['config'][39]['name'] = 'textinput_settings';
$modversion['config'][39]['title'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][39]['description'] = '_MI_SHOUTBOX_EMPTY';
$modversion['config'][39]['formtype'] = 'select';
$modversion['config'][39]['valuetype'] = 'text';
$modversion['config'][39]['options'] = Array('_MI_SHOUTBOX_CAT4' => '1');

$modversion['config'][40]['name'] = 'input_type';
$modversion['config'][40]['title'] = '_MI_SHOUTBOX_TITLE40';
$modversion['config'][40]['description'] = '_MI_SHOUTBOX_DESC40';
$modversion['config'][40]['formtype'] = 'select';
$modversion['config'][40]['valuetype'] = 'int';
$modversion['config'][40]['options'] = Array('_MI_SHOUTBOX_OP40_TL' => 0, '_MI_SHOUTBOX_OP40_TA' => 1);
$modversion['config'][40]['default'] = 1;

$modversion['config'][41]['name'] = 'textarea_rows';
$modversion['config'][41]['title'] = '_MI_SHOUTBOX_TITLE41';
$modversion['config'][41]['description'] = '_MI_SHOUTBOX_DESC41';
$modversion['config'][41]['formtype'] = 'textbox';
$modversion['config'][41]['valuetype'] = 'text';
$modversion['config'][41]['default'] = '4';

$modversion['config'][42]['name'] = 'textarea_cols';
$modversion['config'][42]['title'] = '_MI_SHOUTBOX_TITLE42';
$modversion['config'][42]['description'] = '_MI_SHOUTBOX_DESC42';
$modversion['config'][42]['formtype'] = 'textbox';
$modversion['config'][42]['valuetype'] = 'text';
$modversion['config'][42]['default'] = '75';

$modversion['config'][43]['name'] = 'text_linelength';
$modversion['config'][43]['title'] = '_MI_SHOUTBOX_TITLE43';
$modversion['config'][43]['description'] = '_MI_SHOUTBOX_DESC43';
$modversion['config'][43]['formtype'] = 'textbox';
$modversion['config'][43]['valuetype'] = 'text';
$modversion['config'][43]['default'] = '75';

$modversion['config'][44]['name'] = 'text_maxchars';
$modversion['config'][44]['title'] = '_MI_SHOUTBOX_TITLE44';
$modversion['config'][44]['description'] = '_MI_SHOUTBOX_DESC44';
$modversion['config'][44]['formtype'] = 'textbox';
$modversion['config'][44]['valuetype'] = 'text';
$modversion['config'][44]['default'] = '300';

$modversion['config'][45]['name'] = 'input_alerts';
$modversion['config'][45]['title'] = '_MI_SHOUTBOX_TITLE45';
$modversion['config'][45]['description'] = '_MI_SHOUTBOX_DESC45';
$modversion['config'][45]['formtype'] = 'yesno';
$modversion['config'][45]['valuetype'] = 'int';
$modversion['config'][45]['default'] = 0;

$modversion['config'][46]['name'] = 'captcha_enable';
$modversion['config'][46]['title'] = '_MI_SHOUTBOX_TITLE46';
$modversion['config'][46]['description'] = '_MI_SHOUTBOX_DESC46';
$modversion['config'][46]['formtype'] = 'yesno';
$modversion['config'][46]['valuetype'] = 'int';
$modversion['config'][46]['default'] = 1;

?>