<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: index.php,v 1.5 2008/05/10 11:46:50 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "author_tpl.html";
/*-----------function區--------------*/
$csn=(isset($_REQUEST['csn']))?intval($_REQUEST['csn']) : 0;
$passwd=(isset($_POST['passwd']))?$_POST['passwd'] : "";
$uid=(isset($_GET['uid']))?intval($_GET['uid']) : 0;

if(empty($uid))header("location: index.php");

$MDIR=$xoopsModule->getVar('dirname');

//取得所有資料夾名稱
$cate=get_tad_gallery_cate($csn);


//密碼檢查
if(!empty($csn)){
  if(empty($passwd) and !empty($_SESSION['tadgallery'][$csn])){
    $passwd=$_SESSION['tadgallery'][$csn];
	}

	$sql = "select csn,passwd from ".$xoopsDB->prefix("tad_gallery_cate")." where csn='{$csn}'";
  $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	list($ok_csn,$ok_passwd)=$xoopsDB->fetchRow($result);
	if(!empty($ok_csn) and $ok_passwd!=$passwd)redirect_header($_SERVER['PHP_SELF'],3, sprintf(_TADGAL_NO_PASSWD_CONTENT,$cate['title']));
	
	if(!empty($ok_passwd) and empty($_SESSION['tadgallery'][$csn])){
		$_SESSION['tadgallery'][$csn]=$passwd;
	}
}

//檢查相簿觀看權限
if(!empty($csn)){
	$ok_cat=chk_cate_power();
	if(!in_array($csn,$ok_cat)){
		redirect_header($_SERVER['PHP_SELF'],3, _TADGAL_NO_POWER_TITLE,sprintf(_TADGAL_NO_POWER_CONTENT,$cate['title'],$select));
	}
}



$cate_option=get_tad_gallery_cate_option(0,0,$csn);

$data="";
$ok_cat=chk_cate_power();

/*
$sql = "select csn,title,passwd,show_mode from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$csn}'  order by sort";
$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
while(list($fcsn,$title,$passwd,$show_mode)=$xoopsDB->fetchRow($result)){
	if(!in_array($fcsn,$ok_cat)){
	  continue;
	}
  $passwd_input=(empty($passwd))?"":"<div style='width:100%;text-align:center;position:absolute;bottom:50px;'><input type='password' name='passwd' size=10></div>";
  
  if($show_mode=="3d"){
		$url="3d.php";
		$rel="rel='shadowbox'";
	}elseif($show_mode=="slideshow"){
		$url="slideshow.php";
		$rel="";
	}else{
		$url="index.php";
		$rel="";
	}
  
  if(empty($passwd) or $passwd==$_SESSION['tadgallery'][$fcsn]){
  	$data.="<a $rel href='{$url}?csn={$fcsn}'><div style='margin:4px 8px 4px 8px;float:left;width:150px;height:110px;background-image:url(images/folder_picture.png);position:relative;'>
	<div style='width:100%;text-align:center;position:absolute;bottom:10px;'>$title</div></div></a>";
	}else{
  	$data.="<a><div style='margin:4px 8px 4px 8px;float:left;width:150px;height:110px;background-image:url(images/folder_picture.png);position:relative;'>
  	<div style='width:100%;text-align:center;position:absolute;bottom:50px;'>
    <form action='{$_SERVER['PHP_SELF']}' method='post'>
		<img src='images/view_lock.png' alt='view_lock.png, 1.4kB' title='View lock' border='0' height='22' width='22' align='absmiddle'>
		<input type='hidden' name='csn' value='{$fcsn}'>
		<input type='password' name='passwd' size=10 style='font-size:10px'>
		</form>
		</div>
		<div style='width:100%;text-align:center;position:absolute;bottom:10px;'>$title</div></div></a>";
	}
}
*/

$sql = "select count(*) , a.`csn`,b.`title` from ".$xoopsDB->prefix("tad_gallery")." as a, ".$xoopsDB->prefix("tad_gallery_cate")." as b where a.csn=b.csn and a.uid='{$uid}' group by a.`csn`";

//PageBar(資料數, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
$total=$xoopsDB->getRowsNum($result);

$navbar = new PageBar($total, $xoopsModuleConfig['thumbnail_number'], 10);
$mybar = $navbar->makeBar();
$bar= sprintf(_BP_TOOLBAR,$mybar['total'],$mybar['current'])."{$mybar['left']}{$mybar['center']}{$mybar['right']}";
$sql.=$mybar['sql'];

$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

$pp="";
$i=1;

$thumbnail_mode=(empty($cate['mode']))?$xoopsModuleConfig['thumbnail_mode']:$cate['mode'];

while(list($count,$db_csn,$title)=$xoopsDB->fetchRow($result)){
	$all.="<a href='index.php?csn={$db_csn}&uid={$uid}'>{$title}</a> ({$count})<br>";
}



/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";
$xoopsTpl->assign( "css" , "
<link rel='alternate' href='"._TADGAL_UP_FILE_URL."photos.rss' type='application/rss+xml' title='' id='gallery' />
<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/piclens.js'></script>
<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />
<link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/css/shadowbox.css'>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/js/lib/yui-utilities.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/js/adapter/shadowbox-yui.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/js/shadowbox.js'></script>
<script type='text/javascript'>
window.onload = function(){
    Shadowbox.init();
};
</script>
{$script}") ;

$author_menu=get_all_author($uid);

$xoopsTpl->assign( "author_option" , "<select onChange=\"window.location.href='author.php?uid=' + this.value\" style='margin-right:20px'>$author_menu</select>") ;


$xoopsTpl->assign( "cate_option" , "<select onChange=\"window.location.href='{$_SERVER['PHP_SELF']}?csn=' + this.value\" style='margin-right:20px'>$cate_option</select>") ;

$xoopsTpl->assign( "show_3d_button" , "<a rel='shadowbox' class='option' title='{$cate['title']}' href='3d.php?csn={$csn}'><img src='images/3d.png' alt='"._MA_TADGAL_3D_MODE."' title='"._MA_TADGAL_3D_MODE."' border='0' height='22' width='22' hspace=4 align='absmiddle' onmouseover=\"showToolTip(event,'"._MA_TADGAL_3D_MODE."');return false\" onmouseout=\"hideToolTip()\"></a>") ;


$xoopsTpl->assign( "show_shadowbox_button" , $pp) ;


$xoopsTpl->assign( "slideshow_button" , "<a href='slideshow.php?csn={$csn}'><img src='images/impress.png' alt='"._MA_TADGAL_SLIDE_SHOW_MODE."' title='"._MA_TADGAL_SLIDE_SHOW_MODE."' border='0' height='22' width='22' hspace=4 align='absmiddle' onmouseover=\"showToolTip(event,'"._MA_TADGAL_SLIDE_SHOW_MODE."');return false\" onmouseout=\"hideToolTip()\"></a>") ;

$xoopsTpl->assign( "PicLens_button" , "<a href='javascript:PicLensLite.start();'><img src='images/PicLensButton.png' alt='PicLens' width='16' height='12' border='0' align='absmiddle' hspace=2></a>") ;

$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;

$xoopsTpl->assign( "data" , $all) ;

$xoopsTpl->assign( "bar" , $bar) ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>