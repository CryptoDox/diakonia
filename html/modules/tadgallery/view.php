<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: view.php,v 1.5 2008/05/05 03:23:04 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "view_tpl.html";
/*-----------function區--------------*/

//取得路徑
function get_csn_path($csn=""){
	global $xoopsDB,$xoopsModule,$xoopsModuleConfig;
	$sql = "select of_csn,title from ".$xoopsDB->prefix("tad_gallery_cate")." where csn='{$csn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	list($of_csn,$title)=$xoopsDB->fetchRow($result);
	if(!empty($of_csn))$path=get_csn_path($of_csn);
	if(empty($csn))$title=_MA_TADGAL_CATE_SELECT;
	$path.="/ <a href='index.php?csn={$csn}'>{$title}</a>";
	return $path;
}

//觀看某一張照片
function view_pic($sn=""){
	global $xoopsDB,$xoopsUser,$xoopsModule,$xoopsModuleConfig;
	$MDIR=$xoopsModule->getVar('dirname');
	//判斷是否對該模組有管理權限，  若空白
  if ($xoopsUser) {
    $nowuid=$xoopsUser->getVar('uid');
    $module_id = $xoopsModule->getVar('mid');
    $isAdmin=$xoopsUser->isAdmin($module_id);
  }else{
    $isAdmin=false;
    $nowuid="";
	}
	
	//所有分類名稱
	$cate_all=get_tad_gallery_cate_all();

	$sql = "select csn,title,description,filename,size,type,width,height,dir,uid,post_date,counter,exif,good,tag from ".$xoopsDB->prefix("tad_gallery")." where sn='{$sn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	list($csn,$title,$description,$filename,$size,$type,$width,$height,$dir,$uid,$post_date,$counter,$exif,$good,$tag)=$xoopsDB->fetchRow($result);

	if(!empty($csn)){
		$ok_cat=chk_cate_power();
		if(!in_array($csn,$ok_cat)){
		 	$cate_option=get_tad_gallery_cate_option(0,0,$csn);
  		$cate=get_tad_gallery_cate($csn);
		  $select="<select onChange=\"window.location.href='index.php?csn=' + this.value\">
			$cate_option
			</select>";
			$main=div_3d(_TADGAL_NO_POWER_TITLE,sprintf(_TADGAL_NO_POWER_CONTENT,$cate['title'],$select),"corners");
			return $main;
			exit;
		}
	}

	$path=get_csn_path($csn);
	//找出上一張或下一張
  $pnp=get_pre_next($csn,$sn);

	$back_btn=(!empty($pnp['pre']))?"<a href='{$_SERVER['PHP_SELF']}?sn={$pnp['pre']}'><img src='images/back.png' align='absmiddle' hspace=6 style='display:inline;width:22px;float:left;' onmouseover=\"showToolTip(event,'"._BP_BACK_PAGE."');return false\" onmouseout=\"hideToolTip()\"></a>":"";
	$next_btn=(!empty($pnp['next']))?"<a href='{$_SERVER['PHP_SELF']}?sn={$pnp['next']}'><img src='images/forward.png' align='absmiddle' hspace=6 style='display:inline;width:22px;float:right;' onmouseover=\"showToolTip(event,'"._BP_NEXT_PAGE."');return false\" onmouseout=\"hideToolTip()\"></a>":"";
	$title=(empty($title))?$filename:$title;
	$div_width=$xoopsModuleConfig['thumbnail_m_width']+30;
	$size_txt=sizef($size);

	$copy_pic_url=($xoopsModuleConfig['show_copy_pic']=='1')?get_copy_pic_url($dir,$sn,$filename):"";

	$exif_btn=(empty($exif))?"":"<a href='exif.php?sn=$sn'><img src='images/view_exif.png' alt='view exif' title='view exif' border='0' height='22' width='22' align='absmiddle' onmouseover=\"showToolTip(event,'".sprintf(_MD_TADGAL_EXIF,$filename)."');return false\" onmouseout=\"hideToolTip()\"></a>";


	if($uid==$nowuid or $isAdmin){
	  $del_btn="<img src='images/view_del.png' alt='"._TADGAL_DEL_PIC."' title='"._TADGAL_DEL_PIC."' border='0' height='22' width='22' onClick='delete_tad_gallery_func($sn)' style='cursor:pointer' align='absmiddle' hspace=4 onmouseover=\"showToolTip(event,'"._TADGAL_DEL_PIC."');return false\" onmouseout=\"hideToolTip()\">";

		$good_btn=(empty($good))?"<a href='view.php?op=good&sn={$sn}'><img src='images/good_add.png' alt='"._TADGAL_GOOD_PIC."' title='"._TADGAL_GOOD_PIC."' border='0' height='22' width='22' align='absmiddle' hspace=2 onmouseover=\"showToolTip(event,'"._TADGAL_GOOD_PIC."');return false\" onmouseout=\"hideToolTip()\"></a>":"<a href='view.php?op=good_del&sn={$sn}'><img src='images/good_del.png' alt='"._TADGAL_REMOVE_GOOD_PIC."' title='"._TADGAL_REMOVE_GOOD_PIC."' border='0' height='22' width='22' align='absmiddle' hspace=2 onmouseover=\"showToolTip(event,'"._TADGAL_REMOVE_GOOD_PIC."');return false\" onmouseout=\"hideToolTip()\"></a>";

		$admin_tool="
		<img src='images/view_edit.png' alt='"._TADGAL_EDIT_PIC."' title='"._TADGAL_EDIT_PIC."' border='0' height='22' width='22' align='absmiddle' hspace=2 id='show_input_form' onmouseover=\"showToolTip(event,'"._TADGAL_EDIT_PIC."');return false\" onmouseout=\"hideToolTip()\">
		{$good_btn}
		<img src='images/tag.png' alt='"._MD_TADGAL_TAG."' title='"._MD_TADGAL_TAG."' border='0' height='22' width='22' align='absmiddle' hspace=2 id='show_tag_form' onmouseover=\"showToolTip(event,'"._MD_TADGAL_TAG."');return false\" onmouseout=\"hideToolTip()\">
		";


		$del_js="
		<script>
		function delete_tad_gallery_func(sn){
			var sure = window.confirm('"._BP_DEL_CHK."');
			if (!sure)	return;
			location.href=\"{$_SERVER['PHP_SELF']}?op=delete_tad_gallery&sn=\" + sn;
		}
		</script>";
		

		$option=get_tad_gallery_cate_option(0,0,$csn);
		

		$edit_form="<div id='input_form' style='clear:both;'>
		<form action='{$_SERVER['PHP_SELF']}' method='post' id='myForm' name='myForm'>
	  <table class='form_tbl'>
		<tr><td class='title' nowrap>"._MA_TADGAL_CSN."</td>
		<td class='col'><select name='csn' size=1>
			$option
		</select></td>
		<td class='title' nowrap>"._MA_TADGAL_NEW_CSN."</td>
		<td class='col'><input type='text' name='new_csn' size='20'></td></tr>
		<tr><td class='title' nowrap>"._MA_TADGAL_TITLE."</td>
		<td class='col' colspan=3><input type='text' name='title' size='60' value='{$title}'></td></tr>
		<tr><td class='title' nowrap>"._MA_TADGAL_DESCRIPTION."</td>
		<td class='col' colspan=3><textarea style='width: 400px; height: 44px; min-height: 44px;' name='description'>$description</textarea></td></tr>
	  <tr><td class='bar' colspan='4' align='right'>
	  <input type='hidden' name='sn' value='{$sn}'>
	  <input type='hidden' name='op' value='update_tad_gallery'>
		<input type='checkbox' name='cover' value='small/{$dir}/{$sn}_s_{$filename}'>"._MA_TADGAL_AS_COVER."
	  <input type='submit' value='"._MA_SAVE_EDIT."'></td></tr>
	  </table>
	  </form>
		</div>";

		$tag_select=tag_select($tag);
		
		$tag_form="<div id='tag_form' style='clear:both;'>
		<form action='{$_SERVER['PHP_SELF']}' method='post' id='tagForm' name='tagForm'>
	  <table class='form_tbl'>
		<tr><td class='title' nowrap>"._MD_TADGAL_TAG."</td>
		<td class='col'><input type='text' name='new_tag' size='30'>"._MD_TADGAL_TAG_TXT."</td></tr>
		<tr>
		<td class='col' colspan=2>$tag_select</td></tr>
	  <tr><td class='bar' colspan='4' align='right'>
	  <input type='hidden' name='sn' value='{$sn}'>
	  <input type='hidden' name='op' value='update_tad_gallery_tag'>
	  <input type='submit' value='"._MA_SAVE_EDIT."'></td></tr>
	  </table>
	  </form>
		</div>";
	}else{
	  $del_btn="";
		$admin_tool="";
		$del_js="";
    $edit_form="";
    $tag_form="";
	}

	add_tad_gallery_counter($sn);

	if(($width/$height)>2){
	  $mpic=getimagesize(get_pic_url($dir,$sn,$filename,"m","dir"));
	  $pic180="<marquee width='{$xoopsModuleConfig['thumbnail_m_width']}' behavior='scroll' height='{$mpic[1]}' direction=left scrolldelay=0 scrollamount=3><a href='".get_pic_url($dir,$sn,$filename)."'><img src='".get_pic_url($dir,$sn,$filename,"m")."'  alt='$title' class='instant itiltnone icolorFCFCFC' /></a></marquee>";
	}else{
    $pic180="<a href='".get_pic_url($dir,$sn,$filename)."'><img src='".get_pic_url($dir,$sn,$filename,"m")."'  alt='$title' class='instant itiltnone icolorFCFCFC' /></a>";
	}



	$data="
	$del_js
	<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/bubble-tooltip.js'></script>
	<script language='javascript' type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/copy.js'></script>
	<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/rounded-corners.js'></script>
	<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/form-field-tooltip.js'></script>
	<script type='text/javascript'>
	$(document).ready(function() {
		$('#input_form').hide();
		$('#show_input_form').click(function() {
			if ($('#input_form').is(':visible')) {
	       $('#input_form').slideUp();
			} else{
	       $('#input_form').slideDown();
			}
		});
		
		$('#tag_form').hide();
		$('#show_tag_form').click(function() {
			if ($('#tag_form').is(':visible')) {
	       $('#tag_form').slideUp();
			} else{
	       $('#tag_form').slideDown();
			}
		});
	});
	</script>
	<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/bubble.css' />
	<div id='bubble_tooltip'>
	<div class='bubble_top'><span></span></div>
	<div class='bubble_middle'><span id='bubble_tooltip_content'></span></div>
	<div class='bubble_bottom'></div>
	</div>

	<div style='width:{$div_width}px;margin-left:auto;margin-right:auto;'>
		<dl class='bot_rgt'>
		<dt>{$next_btn}{$back_btn}{$path}/{$title}
		{$copy_pic_url}{$exif_btn}</dt>
		<dd><p align='center'>$pic180</p>
		<p style='width:auto;margin-left:auto;margin-right:auto;'>".nl2br($description)."</p>
		<p style='background-color:#AAAAAA;height:20px'>
		<span style='border-top:1px solid #303030;border-left:1px solid #303030;width:auto;float:right;font-size:10px;background-color:#F0F0F0;color:gray;padding:2px 5px 2px 5px;'>$del_btn<b>{$filename}</b> ({$size_txt}) {$width} x {$height}</span>
		{$admin_tool}
		</p>
		</dd>
		</dl>
		<dl>{$edit_form}{$tag_form}</dl>
	</div>


	";

	return $data;
}


//取得圖片複製網址
function get_copy_pic_url($dir="",$sn="",$filename=""){

	$main="";

	if(is_file(_TADGAL_UP_FILE_DIR."small/{$dir}/{$sn}_s_{$filename}")){
    $main.="<img src='images/view_copy.png' alt='"._TADGAL_FILE_COPY_S."' title='"._TADGAL_FILE_COPY_S."' border='0' height='22' width='22' align='absmiddle' onClick='return Copy2Clipboard(\"".get_pic_url($dir,$sn,$filename,"s")."\")' style='cursor:pointer' onmouseover=\"showToolTip(event,'"._TADGAL_FILE_COPY_S."');return false\" onmouseout=\"hideToolTip()\">";
	}

	if(is_file(_TADGAL_UP_FILE_DIR."medium/{$dir}/{$sn}_m_{$filename}")){
    $main.="<img src='images/view_copy_m.png' alt='"._TADGAL_FILE_COPY_M."' title='"._TADGAL_FILE_COPY_M."' border='0' height='22' width='22' align='absmiddle' onClick='return Copy2Clipboard(\"".get_pic_url($dir,$sn,$filename,"m")."\")' style='cursor:pointer' onmouseover=\"showToolTip(event,'"._TADGAL_FILE_COPY_M."');return false\" onmouseout=\"hideToolTip()\">";
	}

	$main.="<img src='images/view_copy_s.png' alt='"._TADGAL_FILE_COPY_B."' title='"._TADGAL_FILE_COPY_B."' border='0' height='22' width='22' align='absmiddle' onClick='return Copy2Clipboard(\"".get_pic_url($dir,$sn,$filename)."\")' style='cursor:pointer' onmouseover=\"showToolTip(event,'"._TADGAL_FILE_COPY_B."');return false\" onmouseout=\"hideToolTip()\">";

	return $main;
}



//更新資料到tad_gallery中
function update_tad_gallery($sn=""){
	global $xoopsDB,$xoopsUser;
	if(!empty($_POST['new_csn'])){
    $csn=add_tad_gallery_cate($_POST['csn'],$_POST['new_csn']);
	}else{
		$csn=$_POST['csn'];
	}

	$uid=$xoopsUser->getVar('uid');

	if(!empty($_POST['csn']))$_SESSION['tad_gallery_csn']=$_POST['csn'];

	//$myts =& MyTextSanitizer::getInstance();

 	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set `csn`='{$csn}',`title`='{$_POST['title']}',`description`='{$_POST['description']}' where sn='{$sn}'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error());
	
	//設為封面
	if(!empty($_POST['cover'])){
	 	$sql = "update ".$xoopsDB->prefix("tad_gallery_cate")." set `cover`='{$_POST['cover']}' where csn='{$_POST['csn']}'";
		$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error());
	}

}


//更新人氣資料到tad_gallery中
function add_tad_gallery_counter($sn=""){
	global $xoopsDB;
 	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set `counter`=`counter`+1 where sn='{$sn}'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error());

}

//更新標籤資料到tad_gallery中
function update_tad_gallery_tag($sn=""){
	global $xoopsDB;
	
	$all=implode(",",$_POST['tag']);
	
	if(!empty($_POST['new_tag'])){
   $new_tags=explode(",",$_POST['new_tag']);
	}
	
	foreach($new_tags as $tag){
	  if(!empty($tag)){
		  $tag=trim($tag);
	    $all.=",{$tag}";
    }
	}
	
	
 	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set `tag`='{$all}' where sn='{$sn}'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error());
}



/*-----------執行動作判斷區----------*/
$_REQUEST['op']=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(isset($_REQUEST['sn']))?intval($_REQUEST['sn']) : 0;
$csn=(isset($_REQUEST['csn']))?intval($_REQUEST['csn']) : 0;

switch($_REQUEST['op']){
	case "good":
	update_tad_gallery_good($sn,'1');
	header("location: view.php?sn={$sn}");
	break;

	case "good_del":
	update_tad_gallery_good($sn,'0');
	header("location: view.php?sn={$sn}");
	break;

	case "update_tad_gallery":
	update_tad_gallery($sn);
	if($_POST['go_cate']=='1'){
    header("location: index.php?csn={$csn}");
	}else{
		header("location: view.php?sn={$sn}");
	}
	break;


	case "update_tad_gallery_tag":
	update_tad_gallery_tag($sn);
	header("location: view.php?sn={$sn}");
	break;

	case "delete_tad_gallery":
	$csn=delete_tad_gallery($sn);
	mk_rss_xml();
	header("location: index.php?csn=$csn");
	break;

	default:
	$main=view_pic($sn);
	break;
}

/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";
$xoopsTpl->assign( "css" , "<link rel='alternate' href='"._TADGAL_UP_FILE_URL."photos.rss' type='application/rss+xml' title='' id='gallery' />
<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/piclens.js'></script>
<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />") ;
$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;
$xoopsTpl->assign( "content" , $main) ;
include_once XOOPS_ROOT_PATH.'/include/comment_view.php';
include_once XOOPS_ROOT_PATH.'/footer.php';

?>
