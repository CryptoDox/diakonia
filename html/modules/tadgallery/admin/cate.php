<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-02-28
// $Id: cate.php,v 1.4 2008/05/05 03:21:31 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "../../../include/cp_header.php";
include "../function.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";

/*-----------function區--------------*/
//tad_gallery_cate編輯表單
function tad_gallery_cate_form($csn=""){
	global $xoopsDB,$xoopsModuleConfig,$photo_border,$cate_show_mode_array;
	include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
	include_once(XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php");

	//抓取預設值
	if(!empty($csn)){
		$DBV=get_tad_gallery_cate($csn);
	}else{
		$DBV=array();
	}

	//預設值設定

	$csn=(!isset($DBV['csn']))?"":$DBV['csn'];
	$of_csn=(!isset($DBV['of_csn']))?"":$DBV['of_csn'];
	$title=(!isset($DBV['title']))?"":$DBV['title'];
	$enable_group=(!isset($DBV['enable_group']))?"":explode(",",$DBV['enable_group']);
	$enable_upload_group=(!isset($DBV['enable_upload_group']))?array('1'):explode(",",$DBV['enable_upload_group']);
	$sort=(!isset($DBV['sort']))?auto_get_csn_sort():$DBV['sort'];
	$passwd=(!isset($DBV['passwd']))?"":$DBV['passwd'];
	$mode=(!isset($DBV['mode']))?$xoopsModuleConfig['thumbnail_mode']:$DBV['mode'];
	$show_mode=(!isset($DBV['show_mode']))?"":$DBV['show_mode'];
	$cover=(!isset($DBV['cover']))?"":$DBV['cover'];

	$op=(empty($csn))?"insert_tad_gallery_cate":"update_tad_gallery_cate";

	$cate_select=get_tad_gallery_cate_option(0,0,$of_csn,"","",$csn,1);
	$cover_select=get_cover($csn,$cover);
	
	
	//可見群組
	$SelectGroup_name = new XoopsFormSelectGroup("", "enable_group", false,$enable_group, 3, true);
	$SelectGroup_name->addOption("", _MA_TADGAL_ALL_OK, false);
	$enable_group = $SelectGroup_name->render();

	//可上傳群組
	$SelectGroup_name = new XoopsFormSelectGroup("", "enable_upload_group", false,$enable_upload_group, 3, true);
	//$SelectGroup_name->addOption("", _MA_TADGAL_ALL_OK, false);
	$enable_upload_group = $SelectGroup_name->render();
	
	$option="";
	foreach($photo_border as $key=>$value){
	  $selected=($mode==$key)?"selected='selected'":"";
		$option.="<option value='$key' $selected>$value</option>";
	}
	
	$cate_show_option="";
	foreach($cate_show_mode_array as $key=>$value){
	  $selected=($show_mode==$key)?"selected='selected'":"";
		$cate_show_option.="<option value='$key' $selected>$value</option>";
	}
	
	
	$cover_default=(!empty($cover))?XOOPS_URL."/uploads/tadgallery/{$cover}":"../images/folder_picture.png";
	
	$main="
	<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/jquery.js'></script>
	<script type='text/javascript'>
	$(document).ready(function() {
		$('#adv_form').hide();
		$('#show_adv_form').click(function() {
			if ($('#adv_form').is(':visible')) {
	       $('#adv_form').slideUp();
	       $('#show_adv_form').val('"._MA_TADGAL_CATE_ADVANCE_SETUP."');
			} else{
	       $('#adv_form').slideDown();
	       $('#show_adv_form').val('"._MA_TADGAL_CATE_HIDE_ADVANCE_SETUP."');
			}
		});
		

		$('#shl_form').hide();
		$('#show_shl_form').click(function() {
			if ($('#shl_form').is(':visible')) {
	       $('#shl_form').slideUp();
	       $('#show_shl_form').val('"._MA_TADGAL_CATE_SHL_SETUP."');
			} else{
	       $('#shl_form').slideDown();
	       $('#show_shl_form').val('"._MA_TADGAL_CATE_HIDE_SHL_SETUP."');
			}
		});
	});
	</script>
  <form action='{$_SERVER['PHP_SELF']}' method='post' id='myForm' enctype='multipart/form-data'>
  <table class='form_tbl'>

	<tr><td class='title' nowrap>"._MA_TADGAL_SORT."</td>
	<td class='col' colspan=2><input type='text' name='sort' size='5' value='{$sort}'></td></tr>
	<tr><td class='title' nowrap>"._MA_TADGAL_OF_CSN."</td>
	<td class='col' colspan=2><select name='of_csn' size=1>
	$cate_select
	</select></td></tr>
	
	<tr><td class='title' nowrap>"._MA_TADGAL_TITLE."</td>
	<td class='col' colspan=2><input type='text' name='title' size='30' value='{$title}'></td></tr>

	<tr><td class='title' nowrap>"._MA_TADGAL_COVER."</td>
	<td class='col' colspan=2><select name='cover' size=5 onChange='document.getElementById(\"pic\").src=\"".XOOPS_URL."/uploads/tadgallery/\" + this.value'>
	$cover_select
	</select><br><img src='{$cover_default}' id='pic' vspace=4></td></tr>
	
	<tr><td colspan=3><input type='button' value='"._MA_TADGAL_CATE_ADVANCE_SETUP."' id='show_adv_form'></div>
		<div id='adv_form'>
	  <table class='form_tbl'>
			<tr><td class='title' nowrap>"._MA_TADGAL_CATE_SHOW_MODE."</td>
			<td class='col' colspan=2>
			<select name='show_mode' size='1'>$cate_show_option</select>
			</td></tr>
			<tr><td class='title' nowrap>"._MA_TADGAL_PASSWD."</td>
			<td class='col' colspan=2><input type='text' name='passwd' size='10' value='{$passwd}'>"._MA_TADGAL_PASSWD_DESC."</td></tr>
			<tr><td class='title' nowrap>"._MA_TADGAL_SHOW_MODE."</td>
			<td class='col' colspan=2><select size='1' name='mode'>
			$option
			</select></td></tr>
			<tr><td>"._MA_TADGAL_CATE_POWER_SETUP."</td><td class='title'>"._MA_TADGAL_ENABLE_GROUP."</td><td class='title'>"._MA_TADGAL_ENABLE_UPLOAD_GROUP."</td>
			</tr>
			<tr><td></td>
			<td class='col'>$enable_group</td><td class='col'>$enable_upload_group</td>
			</tr>
		  </table>
	  </div>
	</td></tr>

  </table>
	<input type='hidden' name='csn' value='{$csn}'>
  <input type='hidden' name='op' value='{$op}'>
  <input type='submit' value='"._MA_SAVE."'>
  </form>";

	$main=div_3d(_MA_INPUT_CATE_FORM,$main,"raised","display:inline;float:left;");

	return $main;
}

//新增資料到tad_gallery_cate中
function insert_tad_gallery_cate(){
	global $xoopsDB;
	if(empty($_POST['title']))return;
 	if(empty($_POST['enable_group']) or in_array("",$_POST['enable_group'])){
    $enable_group="";
	}else{
		$enable_group=implode(",",$_POST['enable_group']);
	}

	if(empty($_POST['enable_upload_group'])){
    $enable_upload_group="1";
	}else{
		$enable_upload_group=implode(",",$_POST['enable_upload_group']);
	}
	
	$sql = "insert into ".$xoopsDB->prefix("tad_gallery_cate")." (of_csn,title,passwd,enable_group,enable_upload_group,sort,mode,show_mode) values('{$_POST['of_csn']}','{$_POST['title']}','{$_POST['passwd']}','{$enable_group}','{$enable_upload_group}','{$_POST['sort']}','{$_POST['mode']}','{$_POST['show_mode']}')";
	$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	//取得最後新增資料的流水編號
	$csn=$xoopsDB->getInsertId();
	return $csn;
}

//列出所有tad_gallery_cate資料
function list_tad_gallery_cate($of_csn=1,$level=0){
	global $xoopsDB,$xoopsModule,$photo_border;
	$old_level=$level;
	$left=$level*18+4;
	$level++;

 $MDIR=$xoopsModule->getVar('dirname');
	
	$sql = "select csn,of_csn,title,passwd,enable_group,enable_upload_group,sort,mode,cover from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$of_csn}' order by sort";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());


	if($old_level==0){
		$data="
		<script>
		function delete_tad_gallery_cate_func(csn){
			var sure = window.confirm('"._BP_DEL_CHK."');
			if (!sure)	return;
			location.href=\"{$_SERVER['PHP_SELF']}?op=delete_tad_gallery_cate&csn=\" + csn;
		}
		</script>
		<table id='tbl'>
		<tr>
		<th>("._MA_TADGAL_SORT.") "._MA_TADGAL_TITLE."</th>
		<th>"._MA_TADGAL_ENABLE_GROUP."</th>
		<th>"._MA_TADGAL_ENABLE_UPLOAD_GROUP."</th>
		<th>"._BP_FUNCTION."</th>
		</tr>
		<tbody>";
	}else{
		$data="";
	}
	
	while(list($csn,$of_csn,$title,$passwd,$enable_group,$enable_upload_group,$sort,$mode,$cover)=$xoopsDB->fetchRow($result)){
		$g_txt=txt_to_group_name($enable_group,_MA_TADGAL_ALL_OK);
		$gu_txt=txt_to_group_name($enable_upload_group,_MA_TADGAL_ALL_OK);
		$passwd_txt=(empty($passwd))?"":""._MA_TADGAL_PASSWD.":{$passwd}";
		$lock=(empty($passwd))?"":"<img src='../images/view_lock.png' alt='$passwd_txt' title='$passwd_txt' align='absmiddle'>";
		$pic=(empty($cover))?"../images/no_cover.png":"".XOOPS_URL."/uploads/tadgallery/{$cover}";
		$photo_border_mode=(empty($photo_border[$mode]))?"":"<div style='color:#FF99CC;font-size:11px;margin-top:3px;'>[ {$photo_border[$mode]} ]{$lock}</div>";
		
		$data.="<tr>
		<td style='padding-left: {$left}px;' class='col' >
		<img src='{$pic}' width=50 align=left hspace=4 alt='{$passwd_txt}' title='{$passwd_txt}'>
		<font color='#99CCCC'>(".$sort.") </font><b><a href='../index.php?csn=$csn'>{$title}</a></b>{$photo_border_mode}</td>
		<td class='col'>{$g_txt}</td>
		<td class='col'>{$gu_txt}</td>
		<td>
		<a href='{$_SERVER['PHP_SELF']}?op=tad_gallery_cate_form&csn=$csn'><img src='".XOOPS_URL."/modules/{$MDIR}/images/edit.gif' alt='"._BP_EDIT."' title='"._BP_EDIT."'></a>
		<a href=\"javascript:delete_tad_gallery_cate_func($csn);\"><img src='".XOOPS_URL."/modules/{$MDIR}/images/del.gif' alt='"._BP_DEL."' title='"._BP_DEL."'></a></td></tr>";
		$data.=list_tad_gallery_cate($csn,$level);
	}
	
	if($old_level==0){
		$data.="
		</tbody>
		</table>";
	}
	
	
	
	return $data;
}





//更新tad_gallery_cate某一筆資料
function update_tad_gallery_cate($csn=""){
	global $xoopsDB;
 	if(empty($_POST['enable_group']) or in_array("",$_POST['enable_group'])){
    $enable_group="";
	}else{
		$enable_group=implode(",",$_POST['enable_group']);
	}

	if(empty($_POST['enable_upload_group'])){
    $enable_upload_group="1";
	}else{
		$enable_upload_group=implode(",",$_POST['enable_upload_group']);
	}
	$sql = "update ".$xoopsDB->prefix("tad_gallery_cate")." set of_csn = '{$_POST['of_csn']}', title = '{$_POST['title']}', passwd = '{$_POST['passwd']}', enable_group = '{$enable_group}', enable_upload_group = '{$enable_upload_group}', sort = '{$_POST['sort']}', mode = '{$_POST['mode']}', show_mode = '{$_POST['show_mode']}', cover = '{$_POST['cover']}' where csn='$csn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	return $csn;
}

//刪除tad_gallery_cate某筆資料資料
function delete_tad_gallery_cate($csn=""){
	global $xoopsDB;
	
	//先找出底下所有相片
	$sql="select sn from ".$xoopsDB->prefix("tad_gallery")." where csn='$csn'";
	$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while(list($sn)=$xoopsDB->fetchRow($result)){
	  delete_tad_gallery($sn="");
	}
	
	//找出底下分類，並將分類的所屬分類清空
	$sql="update ".$xoopsDB->prefix("tad_gallery_cate")." set  of_csn='' where of_csn='$csn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	
	//刪除之
	$sql = "delete from ".$xoopsDB->prefix("tad_gallery_cate")." where csn='$csn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	
}

/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "main":$_REQUEST['op'];

switch($op){
	//替換資料
	case "replace_tad_gallery_cate":
	replace_tad_gallery_cate();
	header("location: {$_SERVER['PHP_SELF']}");
	break;

	//新增資料
	case "insert_tad_gallery_cate":
	insert_tad_gallery_cate();
	header("location: {$_SERVER['PHP_SELF']}");
	break;

	//輸入表格
	case "tad_gallery_cate_form";
	$main=tad_gallery_cate_form($_GET['csn']);
	break;

	//刪除資料
	case "delete_tad_gallery_cate";
	delete_tad_gallery_cate($_GET['csn']);
	mk_rss_xml();
	header("location: {$_SERVER['PHP_SELF']}");
	break;

	//更新資料
	case "update_tad_gallery_cate";
	update_tad_gallery_cate($_POST['csn']);
	header("location: {$_SERVER['PHP_SELF']}");
	break;
	
	//預設動作
	default:
	$main=tad_gallery_cate_form($_GET['csn']);
	$data=list_tad_gallery_cate(0);
	$main.=div_3d(_MA_TADGAL_LIST_CATE,$data,"corners","display:inline;");
	break;


}

/*-----------秀出結果區--------------*/
xoops_cp_header();
loadModuleAdminMenu(1);
echo "<link rel='stylesheet' type='text/css' media='screen' href='../module.css' />";
echo $main;
xoops_cp_footer();

?>
