<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: uploads.php,v 1.7 2008/05/10 11:46:50 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "index_tpl.html";

if(sizeof($upload_powers) <= 0 or empty($xoopsUser)){
	redirect_header(XOOPS_URL."/user.php",3, _TADGAL_NO_UPLOAD_POWER);
}
/*-----------function區--------------*/

//tad_gallery編輯表單
function tad_gallery_form($sn=""){
	global $xoopsDB;

	//抓取預設值
	if(!empty($sn)){
		$DBV=get_tad_gallery($sn);
	}else{
		$DBV=array();
	}

	//預設值設定

	$sn=(!isset($DBV['sn']))?"":$DBV['sn'];
	$csn=(!isset($DBV['csn']))?$_SESSION['tad_gallery_csn']:$DBV['csn'];
	$title=(!isset($DBV['title']))?"":$DBV['title'];
	$description=(!isset($DBV['description']))?"":$DBV['description'];
	$filename=(!isset($DBV['filename']))?"":$DBV['filename'];
	$size=(!isset($DBV['size']))?"":$DBV['size'];
	$type=(!isset($DBV['type']))?"":$DBV['type'];
	$width=(!isset($DBV['width']))?"":$DBV['width'];
	$height=(!isset($DBV['height']))?"":$DBV['height'];
	$dir=(!isset($DBV['dir']))?"":$DBV['dir'];
	$uid=(!isset($DBV['uid']))?"":$DBV['uid'];
	$post_date=(!isset($DBV['post_date']))?"":$DBV['post_date'];
	$counter=(!isset($DBV['counter']))?"":$DBV['counter'];
	$tag=(!isset($DBV['tag']))?"":$DBV['tag'];

	$op=(empty($sn))?"insert_tad_gallery":"update_tad_gallery";
	
	
	$option=get_tad_gallery_cate_option(0,0,$csn,0,1);
	
	$tag_select=tag_select($tag);
	
	//$op="replace_tad_gallery";
	$main="
  <form action='{$_SERVER['PHP_SELF']}' method='post' id='myForm' enctype='multipart/form-data'>
  <table class='form_tbl'>

	<input type='hidden' name='sn' value='{$sn}'>
	<tr><td class='title' nowrap>"._MA_TADGAL_CSN."</td>
	<td class='col'><select name='csn' size=1>
		$option
	</select></td>
	<td class='title' nowrap>"._MA_TADGAL_NEW_CSN."</td>
	<td class='col'><input type='text' name='new_csn' size='10'></td></tr>
	<tr><td class='title' nowrap>"._MA_TADGAL_PHOTO."</td>
	<td class='col' colspan=3><input type='file' name='image' size='35'></td></tr>
	<tr><td class='title' nowrap>"._MA_TADGAL_TITLE."</td>
	<td class='col' colspan=3><input type='text' name='title' size='40' value='{$title}' style='width: 350px;'></td></tr>
	<tr><td class='title' nowrap>"._MA_TADGAL_DESCRIPTION."</td>
	<td class='col' colspan=3><textarea style='width: 350px; height: 44px; min-height: 44px;font-size:12px;' name='description'></textarea></td></tr>
	<tr><td class='title' nowrap rowspan=2>"._MD_TADGAL_TAG."</td>
		<td class='col' colspan=3><input type='text' name='new_tag' size='20'>"._MD_TADGAL_TAG_TXT."</td></tr>
		<tr>
		<td class='col' colspan=3>$tag_select</td></tr>
  <tr><td class='bar' colspan='4'>
  <input type='hidden' name='op' value='{$op}'>
  <input type='submit' value='"._MA_SAVE."'></td></tr>
  </table>
  </form>";

	$main=div_3d(_MA_INPUT_FORM,$main);

	return $main;
}


//新增資料到tad_gallery中
function insert_tad_gallery(){
	global $xoopsDB,$xoopsUser,$xoopsModuleConfig;
	if(!empty($_POST['new_csn'])){
    $csn=add_tad_gallery_cate($_POST['csn'],$_POST['new_csn']);
	}else{
		$csn=$_POST['csn'];
	}

	$uid=$xoopsUser->getVar('uid');

	if(!empty($_POST['csn']))$_SESSION['tad_gallery_csn']=$_POST['csn'];
	
	
	//處理上傳的檔案
	if(!empty($_FILES['image']['name'])){

		$myts =& MyTextSanitizer::getInstance();
		
		$pic=getimagesize($_FILES['image']['tmp_name']);
		$width=$pic[0];
		$height=$pic[1];
		
		
		include_once("class/exif.php");
		$result = read_exif_data_raw($_FILES['image']['tmp_name'],0);
		
		$creat_date=$result['SubIFD']['DateTimeOriginal'];
		$dir=(empty($creat_date) or substr($creat_date,0,1)!="2")?date("Y_m_d"):str_replace(":","_",substr($result['SubIFD']['DateTimeOriginal'],0,10));
		$exif=(empty($result))?"":implodeArray2D("||",$result);
		//$exif=$myts->addSlashes ($exif);
		
		//$now=xoops_getUserTimestamp(time());

	 	$sql = "insert into ".$xoopsDB->prefix("tad_gallery")." (`csn`,`title`,`description`,`filename`,`size`,`type`,`width`,`height`,`dir`,`uid`,`post_date`,`counter`,`exif`) values('{$csn}','{$_POST['title']}','{$_POST['description']}','{$_FILES['image']['name']}','{$_FILES['image']['size']}','{$_FILES['image']['type']}','{$width}','{$height}','{$dir}','{$uid}',now(),'0','{$exif}')";
		$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error().$sql);
		//取得最後新增資料的流水編號
		$sn=$xoopsDB->getInsertId();

		mk_dir(_TADGAL_UP_FILE_DIR.$dir);
		mk_dir(_TADGAL_UP_FILE_DIR."small/".$dir);
		mk_dir(_TADGAL_UP_FILE_DIR."medium/".$dir);
		
		$filename=photo_name($sn,"source",1);
		
		if(move_uploaded_file($_FILES['image']['tmp_name'],$filename)){
		  //add_pic_mark($filename,$filename,$type,"Tad Gallery");

			$m_thumb_name=photo_name($sn,"m",1);
			$s_thumb_name=photo_name($sn,"s",1);

			if($width > $xoopsModuleConfig['thumbnail_m_width'] or $height > $xoopsModuleConfig['thumbnail_m_width'])	thumbnail($filename,$m_thumb_name,$_FILES['image']['type'],$xoopsModuleConfig['thumbnail_m_width']);
			if($width > $xoopsModuleConfig['thumbnail_s_width'] or $height > $xoopsModuleConfig['thumbnail_s_width'])	thumbnail($filename,$s_thumb_name,$_FILES['image']['type'],$xoopsModuleConfig['thumbnail_s_width']);

			
			
		}else{
			redirect_header($_SERVER['PHP_SELF'], 5,sprintf(_TADGAL_IMPORT_UPLOADS_ERROR,$filename));
		}
	}

	return $sn;
}

/*-----------執行動作判斷區----------*/

switch($_POST['op']){
	case "insert_tad_gallery":
	insert_tad_gallery();
	mk_rss_xml();
	redirect_header("index.php", 1 ,sprintf(_TADGAL_IMPORT_UPLOADS_OK,$filename));
	break;

	default:
	$main=tad_gallery_form();
	break;
}

/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";
$xoopsTpl->assign( "css" , "<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />") ;
$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;
$xoopsTpl->assign( "content" , $main) ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>
