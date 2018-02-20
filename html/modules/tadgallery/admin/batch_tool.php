<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: batch_tool.php,v 1.1 2008/05/05 03:21:15 tad Exp $
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
	
	$order=(empty($_SESSION['gallery_order_mode']))?"filename":$_SESSION['gallery_order_mode'];
	
	$sql = "select sn,csn,title,filename,size,width,height,dir,uid,post_date,counter,good from ".$xoopsDB->prefix("tad_gallery")." where csn='{$_GET['csn']}' order by $order";
	
	//PageBar(資料數, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$total=$xoopsDB->getRowsNum($result);
	
  $thumbnail_number=$xoopsModuleConfig['thumbnail_number']*2;
	$navbar = new PageBar($total, $thumbnail_number, 10);
	$mybar = $navbar->makeBar();
	$bar= sprintf(_BP_TOOLBAR,$mybar['total'],$mybar['current'])."{$mybar['left']}{$mybar['center']}{$mybar['right']}";
	$sql.=$mybar['sql'];

	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	$cate_option=get_tad_gallery_cate_option(0,0,$_GET['csn']);


	$data="

	<script language=\"JavaScript\">
function chkall(input1,input2)
{
    var objForm = document.forms[input1];
    var objLen = objForm.length;
    for (var iCount = 0; iCount < objLen; iCount++)
    {
        if (input2.checked == true)
        {
            if (objForm.elements[iCount].type == \"checkbox\")
            {
                objForm.elements[iCount].checked = true;
            }
        }
        else
        {
            if (objForm.elements[iCount].type == \"checkbox\")
            {
                objForm.elements[iCount].checked = false;
            }
        }
    }
}

function ckeck_one(id_name){
	if(document.getElementById(id_name).checked){
		document.getElementById(id_name).checked = false;
	}else{
		document.getElementById(id_name).checked = true;
	}
}
</script>
	<table><tr><td valign='top'>
		<select size=30 name='csn' onChange='location.href=\"batch_tool.php?csn=\"+this.value'>
		$cate_option
		</select>
	</td><td valign='top'>
	<form action='batch_tool.php' method='post' name='form1'>
	<input type='checkbox' onclick='chkall(\"form1\",this)' name=chk>"._MA_TADGAL_SELECT_ALL."
		<table>
		<tbody>";
		$i=4;
		while(list($sn,$csn,$title,$filename,$size,$width,$height,$dir,$uid,$post_date,$counter,$good)=$xoopsDB->fetchRow($result)){

			$tr1=($i%4)?"":"<tr>";
			$tr2=($i%4==3)?"</tr>":"";

      $good_pic=($good=='1')?"<img src='".XOOPS_URL."/modules/{$MDIR}/images/good.png' alt='good.png, 3.9kB' title='Good' border='0' height='22' width='22' style='float:left'>":"";

			$data.="$tr1
			<td style='background-image:url(".get_pic_url($dir,$sn,$filename,"s").");background-position: center center;	background-repeat: no-repeat;	padding:0px;' align='center'>
			<div style='background-image:url(".XOOPS_URL."/modules/{$MDIR}/images/film.gif); width: 150px;	height: 120px;vertical-align:bottom;position:relative;'  onClick='ckeck_one(\"p{$sn}\");'><div style='float:left'><input type='checkbox' id='p{$sn}' name='pic[]' value='{$sn}'  onClick='ckeck_one(\"p{$sn}\")';></div>$good_pic<div class='pic_title'>$filename</div></div></td>
			
		
			$tr2";
			$i++;
		}
		
		$option=get_tad_gallery_cate_option(0,0,$_GET['csn']);
		
		$tag_select=tag_select();
		
		$data.="
		<tr>
		<td colspan=4 class='bar'>
    <input type='hidden' name='csn' value='{$_GET['csn']}'>
		"._MA_TADGAL_THE_ACT_IS."<br>
		<input type='radio' name='op' value='del'>"._BP_DEL."<br>
		<input type='radio' name='op' value='add_good'>"._MA_TADGAL_ADD_GOOD."<br>
		<input type='radio' name='op' value='del_good'>"._MA_TADGAL_DEL_GOOD."<br>
		<input type='radio' name='op' value='move'>"._MA_TADGAL_MOVE_TO."<select name='new_csn'>$option</select><br>
	  <input type='radio' name='op' value='add_tag'>"._MA_TADGAL_TAG."<input type='text' name='new_tag' size='20'>"._MA_TADGAL_TAG_TXT."</td></tr>
		<tr>
		<td class='col' colspan=4>$tag_select</td></tr>
	  <tr><td class='bar' colspan='4' align='right'>
	  </td></tr>
		
		<tr>
		<td colspan=4 class='bar'>{$bar}</td></tr>
		</tbody>
		</table>
		<input type='submit' value='"._MA_TADGAL_GO."'></form>
	</td></tr></table>";
	$data=div_3d(_MA_TADGAL_LIST_ALL,$data,"corners","display:inline;");
	return $data;
}



//批次搬移
function batch_move($new_csn=""){
	global $xoopsDB;
	$pics=implode(",",$_POST['pic']);
	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set `csn` = '{$new_csn}' where sn in($pics)";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error()."<br>$sql");
	return $sn;
}

//批次新增精華
function batch_add_good(){
	global $xoopsDB;
	$pics=implode(",",$_POST['pic']);
	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set  `good` = '1' where sn in($pics)";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	return $sn;
}


//批次移除精華
function batch_add_tag(){
	global $xoopsDB;
	$pics=implode(",",$_POST['pic']);

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

	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set  `tag` = '{$all}' where sn in($pics)";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	return $sn;
}

//批次加入標籤
function batch_del_good(){
	global $xoopsDB;
	$pics=implode(",",$_POST['pic']);
	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set  `good` = '0' where sn in($pics)";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	return $sn;
}



//批次刪除
function batch_del(){
	global $xoopsDB;
	foreach($_POST['pic'] as $sn){
    delete_tad_gallery($sn);
	}
}


/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "main":$_REQUEST['op'];

switch($op){
	case "del":
	batch_del();
	mk_rss_xml();
	header("location: {$_SERVER['PHP_SELF']}?csn={$_POST['csn']}");
	break;

	case "move":
	batch_move($_POST['new_csn']);
	header("location: {$_SERVER['PHP_SELF']}?csn={$_POST['csn']}");
	break;
	
	case "add_good";
	batch_add_good();
	header("location: {$_SERVER['PHP_SELF']}?csn={$_POST['csn']}");
	break;


	case "del_good";
	batch_del_good();
	header("location: {$_SERVER['PHP_SELF']}?csn={$_POST['csn']}");
	break;

	case "add_tag";
	batch_add_tag();
	header("location: {$_SERVER['PHP_SELF']}?csn={$_POST['csn']}");
	break;

	//預設動作
	default:
	$main=list_tad_gallery(1);
	break;

}

/*-----------秀出結果區--------------*/
xoops_cp_header();
loadModuleAdminMenu(5);
echo "<link rel='stylesheet' type='text/css' media='screen' href='../module.css' />";
echo $main;
xoops_cp_footer();

?>
