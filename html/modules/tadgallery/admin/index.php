<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: index.php,v 1.3 2008/05/05 03:21:31 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "../../../include/cp_header.php";
include "../function.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.php";
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";

/*-----------function區--------------*/
//列出所有tad_gallery資料
function list_tad_gallery($show_function=1){
	global $xoopsDB,$xoopsModule,$xoopsModuleConfig;
	$MDIR=$xoopsModule->getVar('dirname');
	
	$order=(empty($_SESSION['gallery_order_mode']))?"post_date":$_SESSION['gallery_order_mode'];

	$where_uid=(empty($_GET['uid']))?"":"and uid='{$_GET['uid']}'";
	
	$sql = "select sn,csn,title,filename,size,width,height,dir,uid,post_date,counter,good from ".$xoopsDB->prefix("tad_gallery")." where csn='{$_GET['csn']}' {$where_uid} order by $order ";
	
	//PageBar(資料數, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$total=$xoopsDB->getRowsNum($result);

	$navbar = new PageBar($total, $xoopsModuleConfig['thumbnail_number'], 10);
	$mybar = $navbar->makeBar();
	$bar= sprintf(_BP_TOOLBAR,$mybar['total'],$mybar['current'])."{$mybar['left']}{$mybar['center']}{$mybar['right']}";
	$sql.=$mybar['sql'];

	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	$cate_option=get_tad_gallery_cate_option(0,0,$_GET['csn']);


	$data="
	<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/jquery.js'></script>
	<script type='text/javascript'>
	function show_form(div_sn){
		$('#div_form_'+div_sn).load('form.php?csn={$_GET['csn']}&sn='+div_sn);
		//$('#div_form_'+div_sn).html(\"<form action=\'index.php\' method=\'post\'><table class=\'form_tbl\'><tr><td class=\'col\'><input type=\'text\' name=\'title\' value=\'{$title}\' style=\'width:130px;\'></td></tr><tr><td class=\'col\'><textarea style=\'width: 130px; height: 60px;\' name=\'description\'>{$description}</textarea></td></tr><tr><td colspan=2><input type=\'hidden\' name=\'sn\' value=\'\"+div_sn+\"\'><input type=\'hidden\' name=\'op\' value=\'update_tad_gallery\'><input type=\'submit\' value=\'儲存\'></td></tr></table></form>\");
	}

	function delete_tad_gallery_func(sn){
		var sure = window.confirm('"._BP_DEL_CHK."');
		if (!sure)	return;
		location.href=\"{$_SERVER['PHP_SELF']}?op=delete_tad_gallery&csn={$_GET['csn']}&&sn=\" + sn;
	}
	</script>
	<table><tr><td valign='top'>
		<select size=30 name='csn' onChange='location.href=\"index.php?csn=\"+this.value'>
		$cate_option
		</select>
	</td><td valign='top'>
		<table>
		<tbody>";
		$i=3;
		while(list($sn,$csn,$title,$filename,$size,$width,$height,$dir,$uid,$post_date,$counter,$good)=$xoopsDB->fetchRow($result)){
		
		  $good_btn=($good=='1')?"<a href='{$_SERVER['PHP_SELF']}?op=good_del&sn={$sn}&csn={$_GET['csn']}'><img src='".XOOPS_URL."/modules/{$MDIR}/images/good_del.png' alt='good_del.png, 1.1kB' title='"._MA_TADGAL_DEL_GOOD."' border='0' height='22' width='22' hspace=2></a>":"<a href='{$_SERVER['PHP_SELF']}?op=good&sn={$sn}&csn={$_GET['csn']}'><img src='".XOOPS_URL."/modules/{$MDIR}/images/good_add.png' alt='good_add.png, 4.0kB' title='"._MA_TADGAL_ADD_GOOD."' border='0' height='22' width='22' hspace=2></a>";
		
			$fun=($show_function)?"
			<img src='".XOOPS_URL."/modules/{$MDIR}/images/edit.gif' alt='"._BP_EDIT."' title='"._BP_EDIT."' onClick=\"show_form('{$sn}')\">
			<a href=\"javascript:delete_tad_gallery_func($sn);\"><img src='".XOOPS_URL."/modules/{$MDIR}/images/del.gif' alt='"._BP_DEL."' title='"._BP_DEL."'></a>$good_btn":"";

			$tr1=($i%2)?"<tr>":"";
			$tr2=($i%2)?"":"</tr>";

      $title_div=(!empty($title))?"<div class='pic_title'>{$title}</div>":"";
      $good_pic=($good=='1')?"<img src='".XOOPS_URL."/modules/{$MDIR}/images/good.png' alt='good.png, 3.9kB' title='Good' border='0' height='22' width='22' style='float:left'>":"";
      

			$data.="$tr1
			<td style='background-image:url(".get_pic_url($dir,$sn,$filename,"s").");background-position: center center;	background-repeat: no-repeat;	padding:0px;' align='center'>
			<a href='../view.php?sn=$sn'>
			<div style='background-image:url(".XOOPS_URL."/modules/{$MDIR}/images/film.gif); width: 150px;	height: 120px;vertical-align:bottom;position:relative;'>{$good_pic}$title_div</div></a></td>
			
			<td style='width:150px;padding:2px 10px 2px 10px;vertical-align:top;line-height:150%;'>
			<div id='div_form_{$sn}'>
				<div class='pic_filename'>{$filename}</div>
				<div><font class='pic_wh'>{$width} x {$height}</font> (<font class='pic_size'>".sizef($size)."</font>)</div>
				"._MA_TADGAL_UID." : ".XoopsUser::getUnameFromId($uid,0)."<br />
				"._MA_TADGAL_COUNTER." : {$counter}<br />
				<div class='pic_date'>{$post_date}</div>
				$fun
			</div>
			</td>
			$tr2";
			$i++;
		}
		$data.="
		<tr>
		<td colspan=4 class='bar'>{$bar}</td></tr>
		</tbody>
		</table>
	</td></tr></table>";
	$data=div_3d(_MA_TADGAL_LIST_ALL,$data,"corners","display:inline;");
	return $data;
}



//更新tad_gallery某一筆資料
function update_tad_gallery($sn=""){
	global $xoopsDB;
	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set  `title` = '{$_POST['title']}', `description` = '{$_POST['description']}' where sn='$sn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	return $sn;
}



/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "main":$_REQUEST['op'];

switch($op){
	case "good":
	update_tad_gallery_good($_GET['sn'],'1');
	header("location: {$_SERVER['PHP_SELF']}?csn={$_GET['csn']}");
	break;

	case "good_del":
	update_tad_gallery_good($_GET['sn'],'0');
	header("location: {$_SERVER['PHP_SELF']}?csn={$_GET['csn']}");
	break;
	
	//輸入表格
	case "tad_gallery_form";
	$main=tad_gallery_form($_GET['sn']);
	break;

	//刪除資料
	case "delete_tad_gallery";
	delete_tad_gallery($_GET['sn']);
	mk_rss_xml();
	header("location: {$_SERVER['PHP_SELF']}?csn={$_GET['csn']}");
	break;

	//更新資料
	case "update_tad_gallery";
	update_tad_gallery($_POST['sn']);
	header("location: {$_SERVER['PHP_SELF']}?csn={$_POST['csn']}");
	break;


	//產生Media RSS
	case "mk_rss_xml";
	mk_rss_xml();
	header("location: {$_SERVER['PHP_SELF']}");
	break;
	

	//預設動作
	default:
	$main=list_tad_gallery(1);
	break;

}

/*-----------秀出結果區--------------*/
xoops_cp_header();
loadModuleAdminMenu(0);
echo "<link rel='stylesheet' type='text/css' media='screen' href='../module.css' />";
echo $main;
xoops_cp_footer();

?>
