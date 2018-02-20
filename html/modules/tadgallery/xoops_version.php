<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: xoops_version.php,v 1.5 2008/05/14 01:23:14 tad Exp $
// ------------------------------------------------------------------------- //

//---基本設定---//
//模組名稱
$modversion['name'] = _MI_TADGAL_NAME;
//模組版次
$modversion['version']	= '1.3';
//模組作者
$modversion['author'] = '_MI_TADGAL_AUTHOR';
//模組說明
$modversion['description'] = _MI_TADGAL_DESC;
//模組授權者
$modversion['credits']	= "_MI_TADGAL_CREDITS";
//模組版權
$modversion['license']		= "GPL see LICENSE";
//模組是否為官方發佈1，非官方2
$modversion['official']		= 2;
//模組圖示
$modversion['image']		= "images/logo.png";
//模組目錄名稱
$modversion['dirname']		= "tadgallery";

//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "tad_gallery";
$modversion['tables'][2] = "tad_gallery_cate";


$modversion['onInstall'] = "include/onInstall.php";
$modversion['onUpdate'] = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//---使用者主選單設定---//
$modversion['hasMain'] = 1;


//---評論設定---//
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'view.php';
$modversion['comments']['itemName'] = 'sn';

//---搜尋設定---//
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.php";
$modversion['search']['func'] = "tadgallery_search";

//---樣板設定---//

$modversion['templates'][1]['file'] = 'show_tpl.html';
$modversion['templates'][1]['description'] = _MI_TADGAL_TEMPLATE_DESC1;
$modversion['templates'][2]['file'] = 'view_tpl.html';
$modversion['templates'][2]['description'] = _MI_TADGAL_TEMPLATE_DESC2;
$modversion['templates'][3]['file'] = 'slideshow.html';
$modversion['templates'][3]['description'] = _MI_TADGAL_TEMPLATE_DESC3;
$modversion['templates'][4]['file'] = 'author_tpl.html';
$modversion['templates'][4]['description'] = _MI_TADGAL_TEMPLATE_DESC4;
$modversion['templates'][5]['file'] = 'index_tpl.html';
$modversion['templates'][5]['description'] = _MI_TADGAL_TEMPLATE_DESC5;



//---區塊設定---//

$modversion['blocks'][4]['file'] = "tadgallery_jquery.php";
$modversion['blocks'][4]['name'] = _MI_TADGAL_BNAME4;
$modversion['blocks'][4]['description'] = _MI_TADGAL_BDESC4;
$modversion['blocks'][4]['show_func'] = "tadgallery_jquery_show";
$modversion['blocks'][4]['template'] = "tadgallery_jquery.html";
$modversion['blocks'][4]['edit_func'] = "tadgallery_jquery_edit";
$modversion['blocks'][4]['options'] = "";

$modversion['blocks'][1]['file'] = "tadgallery_carousel.php";
$modversion['blocks'][1]['name'] = _MI_TADGAL_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADGAL_BDESC1;
$modversion['blocks'][1]['show_func'] = "tadgallery_carousel_show";
$modversion['blocks'][1]['template'] = "tadgallery_carousel.html";
$modversion['blocks'][1]['edit_func'] = "tadgallery_carousel_edit";
$modversion['blocks'][1]['options'] = "10||order by rand()|desc|s|160|120|0";

$modversion['blocks'][2]['file'] = "tadgallery_shuffle.php";
$modversion['blocks'][2]['name'] = _MI_TADGAL_BNAME2;
$modversion['blocks'][2]['description'] = _MI_TADGAL_BDESC2;
$modversion['blocks'][2]['show_func'] = "tadgallery_shuffle_show";
$modversion['blocks'][2]['template'] = "tadgallery_shuffle.html";
$modversion['blocks'][2]['edit_func'] = "tadgallery_shuffle_edit";
$modversion['blocks'][2]['options'] = "10||order by rand()|desc|s|160|120|0";

$modversion['blocks'][3]['file'] = "tadgallery_show.php";
$modversion['blocks'][3]['name'] = _MI_TADGAL_BNAME3;
$modversion['blocks'][3]['description'] = _MI_TADGAL_BDESC3;
$modversion['blocks'][3]['show_func'] = "tadgallery_show";
$modversion['blocks'][3]['template'] = "tadgallery_show.html";
$modversion['blocks'][3]['edit_func'] = "tadgallery_edit";
$modversion['blocks'][3]['options'] = "10||order by rand()|desc|s|160|120|0";

$modversion['blocks'][5]['file'] = "tadgallery_good.php";
$modversion['blocks'][5]['name'] = _MI_TADGAL_BNAME5;
$modversion['blocks'][5]['description'] = _MI_TADGAL_BDESC5;
$modversion['blocks'][5]['show_func'] = "tadgallery_good_show";
$modversion['blocks'][5]['template'] = "tadgallery_good.html";
$modversion['blocks'][5]['edit_func'] = "tadgallery_good_edit";
$modversion['blocks'][5]['options'] = "10||order by rand()|desc|s|160|240|0|jscroller2_up|40";

$modversion['blocks'][6]['file'] = "tadgallery_re_block.php";
$modversion['blocks'][6]['name'] = _MI_TADGAL_BNAME6;
$modversion['blocks'][6]['description'] = _MI_TADGAL_BDESC6;
$modversion['blocks'][6]['show_func'] = "tadgallery_show_re";
$modversion['blocks'][6]['template'] = "tadgallery_re.html";
$modversion['blocks'][6]['edit_func'] = "tadgallery_re_edit";
$modversion['blocks'][6]['options'] = "10|160";

$modversion['blocks'][7]['file'] = "tadgallery_slideshow.php";
$modversion['blocks'][7]['name'] = _MI_TADGAL_BNAME7;
$modversion['blocks'][7]['description'] = _MI_TADGAL_BDESC7;
$modversion['blocks'][7]['show_func'] = "tadgallery_slideshow";
$modversion['blocks'][7]['template'] = "tadgallery_slideshow.html";
$modversion['blocks'][7]['edit_func'] = "tadgallery_slideshow_edit";
$modversion['blocks'][7]['options'] = "||510|400|false";

$modversion['blocks'][8]['file'] = "tadgallery_list.php";
$modversion['blocks'][8]['name'] = _MI_TADGAL_BNAME8;
$modversion['blocks'][8]['description'] = _MI_TADGAL_BDESC8;
$modversion['blocks'][8]['show_func'] = "tadgallery_list";
$modversion['blocks'][8]['template'] = "tadgallery_list.html";
$modversion['blocks'][8]['edit_func'] = "tadgallery_list_edit";
$modversion['blocks'][8]['options'] = "12||order by rand()|desc|6|100|100|0|0|font-size:11px;font-weight:normal;overflow:hidden;";

//---偏好設定---//
$modversion['config'][0]['name']	= 'thumbnail_s_width';
$modversion['config'][0]['title']	= '_MI_TADGAL_THUMBNAIL_S_WIDTH';
$modversion['config'][0]['description']	= '_MI_TADGAL_THUMBNAIL_S_WIDTH_DESC';
$modversion['config'][0]['formtype']	= 'textbox';
$modversion['config'][0]['valuetype']	= 'text';
$modversion['config'][0]['default']	= '140';

$modversion['config'][1]['name']	= 'thumbnail_m_width';
$modversion['config'][1]['title']	= '_MI_TADGAL_THUMBNAIL_M_WIDTH';
$modversion['config'][1]['description']	= '_MI_TADGAL_THUMBNAIL_M_WIDTH_DESC';
$modversion['config'][1]['formtype']	= 'textbox';
$modversion['config'][1]['valuetype']	= 'text';
$modversion['config'][1]['default']	= '500';

$modversion['config'][2]['name']	= 'thumbnail_b_width';
$modversion['config'][2]['title']	= '_MI_TADGAL_THUMBNAIL_B_WIDTH';
$modversion['config'][2]['description']	= '_MI_TADGAL_THUMBNAIL_B_WIDTH_DESC';
$modversion['config'][2]['formtype']	= 'textbox';
$modversion['config'][2]['valuetype']	= 'text';
$modversion['config'][2]['default']	= '0';

$modversion['config'][3]['name']	= 'thumbnail_mode';
$modversion['config'][3]['title']	= '_MI_TADGAL_THUMBNAIL_MODE';
$modversion['config'][3]['description']	= '_MI_TADGAL_THUMBNAIL_MODE_DESC';
$modversion['config'][3]['formtype']	= 'select';
$modversion['config'][3]['valuetype']	= 'text';
$modversion['config'][3]['default']	= 'instant';
$modversion['config'][3]['options']	= array('_MI_TADGAL_THUMBNAIL_MODE0' => 'none','_MI_TADGAL_THUMBNAIL_MODE1' => 'instant','_MI_TADGAL_THUMBNAIL_MODE2' => 'slided','_MI_TADGAL_THUMBNAIL_MODE3' => 'edge','_MI_TADGAL_THUMBNAIL_MODE4' =>  'curved','_MI_TADGAL_THUMBNAIL_MODE5' =>  'shadow');


$modversion['config'][4]['name']	= 'thumbnail_number';
$modversion['config'][4]['title']	= '_MI_TADGAL_THUMBNAIL_NUMBER';
$modversion['config'][4]['description']	= '_MI_TADGAL_THUMBNAIL_NUMBER_DESC';
$modversion['config'][4]['formtype']	= 'textbox';
$modversion['config'][4]['valuetype']	= 'text';
$modversion['config'][4]['default']	= '30';


$modversion['config'][5]['name']	= 'prevent_hotlinking';
$modversion['config'][5]['title']	= '_MI_TADGAL_PREVENT_HOTLINKING';
$modversion['config'][5]['description']	= '_MI_TADGAL_PREVENT_HOTLINKING_DESC';
$modversion['config'][5]['formtype']	= 'yesno';
$modversion['config'][5]['valuetype']	= 'int';
$modversion['config'][5]['default']	= '0';


$modversion['config'][6]['name']	= 'allow_hotlinking';
$modversion['config'][6]['title']	= '_MI_TADGAL_ALLOW_HOTLINKING';
$modversion['config'][6]['description']	= '_MI_TADGAL_ALLOW_HOTLINKING_DESC';
$modversion['config'][6]['formtype']	= 'textarea';
$modversion['config'][6]['valuetype']	= 'text';
$modversion['config'][6]['default']	= '';

$modversion['config'][7]['name']	= 'show_copy_pic';
$modversion['config'][7]['title']	= '_MI_TADGAL_SHOW_COPY_PIC';
$modversion['config'][7]['description']	= '_MI_TADGAL_SHOW_COPY_PIC_DESC';
$modversion['config'][7]['formtype']	= 'yesno';
$modversion['config'][7]['valuetype']	= 'int';
$modversion['config'][7]['default']	= '1';

$modversion['config'][8]['name']	= 'only_thumb';
$modversion['config'][8]['title']	= '_MI_TADGAL_ONLY_THUMB';
$modversion['config'][8]['description']	= '_MI_TADGAL_ONLY_THUMB_DESC';
$modversion['config'][8]['formtype']	= 'yesno';
$modversion['config'][8]['valuetype']	= 'int';
$modversion['config'][8]['default']	= '0';
?>
