<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: import.php,v 1.6 2008/05/10 11:46:50 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "index_tpl.html";
if(sizeof($upload_powers) < 0 or empty($xoopsUser)){
	redirect_header(XOOPS_URL."/user.php",3, _TADGAL_NO_UPLOAD_POWER);
}
/*-----------function區--------------*/

//tad_gallery編輯表單
function import_form($sn=""){
	global $xoopsDB;
	
	include_once("class/exif.php");
	$myts =& MyTextSanitizer::getInstance();
	$option=get_tad_gallery_cate_option(0,0,"","",1);
	
	//找出要匯入的圖
	$pics="";
	if (is_dir(_TADGAL_UP_IMPORT_DIR)) {
	  if ($dh = opendir(_TADGAL_UP_IMPORT_DIR)) {
	    $i=0;
      while (($file = readdir($dh)) !== false) {
        if(substr($file,0,1)==".")continue;

        
        $result = read_exif_data_raw(_TADGAL_UP_IMPORT_DIR.$file,0);
				$creat_date=$result['SubIFD']['DateTimeOriginal'];
				$dir=(empty($creat_date) or substr($creat_date,0,1)!="2")?date("Y_m_d"):str_replace(":","_",substr($result['SubIFD']['DateTimeOriginal'],0,10));
				$exif=(empty($result) or empty($result['IFD0']))?"":implodeArray2D("||",$result);
				//$exif=$myts->addSlashes ($exif);
		
        $size=filesize(_TADGAL_UP_IMPORT_DIR.$file);
        $size_txt=sizef($size);
        $pic=getimagesize(_TADGAL_UP_IMPORT_DIR.$file);
				$width=$pic[0];
				$height=$pic[1];
				
				$subname=strtolower(substr($file,-3));
			  if($subname=="jpg" or $subname=="peg"){
					$type="image/jpeg";
				}elseif($subname=="png"){
					$type="image/png";
				}elseif($subname=="gif"){
					$type="image/gif";
				}else{
					$type=$subname;
		      continue;
				}
				
				$sql = "select width,height from ".$xoopsDB->prefix("tad_gallery")." where filename='{$file}' and size='{$size}'";
				$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
				list($db_width,$db_height)=$xoopsDB->fetchRow($result);
				if($db_width==$width and $db_height==$height){
          $checked="disabled='disabled'";
          $upload="0";
          $status=_TADGAL_IMPORT_EXIST;
				}else{
          $checked="checked='checked'";
          $upload="1";
          $status=$type;
				}

        if(_CHARSET=="UTF-8")$file=to_utf8($file);
        $pics.="
				<td class='col'>
				<input type='hidden' name='all[$i]' value='"._TADGAL_UP_IMPORT_DIR.$file."'>
				<input type='checkbox' name='import[$i][upload]' value='1' $checked>{$file}
				<input type='hidden' name='import[$i][filename]' value='{$file}'></td>
				<td class='col' style='text-align:center'>$dir<input type='hidden' name='import[$i][dir]' value='{$dir}'></td>
				<td class='col' style='text-align:center'>$width x $height
				<input type='hidden' name='import[$i][post_date]' value='{$creat_date}'>
				<input type='hidden' name='import[$i][width]' value='{$width}'>
				<input type='hidden' name='import[$i][height]' value='{$height}'></td>
				<td class='col' style='text-align:right'>$size_txt<input type='hidden' name='import[$i][size]' value='{$size}'></td>
				<td class='col' style='text-align:right'>$status
				<input type='hidden' name='import[$i][exif]' value='{$exif}'>
				<input type='hidden' name='import[$i][type]' value='{$type}'></td>
				</tr>";
				$i++;
      }
      closedir($dh);
	  }
	}

	//預設值設定

	//$op="replace_tad_gallery";
	$main="
  <form action='{$_SERVER['PHP_SELF']}' method='post' id='myForm' enctype='multipart/form-data'>
  <table id='form_tbl'>
	<tr><td colspan='5'>"._MA_TADGAL_CSN."<select name='csn' size=1>$option</select>
	"._MA_TADGAL_NEW_CSN."<input type='text' name='new_csn' size='20'></td></tr>
	<tr>
  <tr>
	<th>"._TADGAL_IMPORT_FILE."</th>
	<th>"._TADGAL_IMPORT_DIR."</th>
	<th>"._TADGAL_IMPORT_DIMENSION."</th>
	<th>"._TADGAL_IMPORT_SIZE."</th>
	<th>"._TADGAL_IMPORT_STATUS."</th>
	</tr>
	$pics
  <tr><td class='bar' colspan='5'>
  <input type='hidden' name='op' value='import_tad_gallery'>
  <input type='submit' value='"._TADGAL_UP_IMPORT."'></td></tr>
  </table>
  </form>";

	$main=div_3d(_TADGAL_PATCH_IMPORT_FORM,$main);

	return $main;
}

//新增資料到tad_gallery中
function import_tad_gallery(){
	global $xoopsDB,$xoopsUser,$xoopsModuleConfig;
	
	if(!empty($_POST['new_csn'])){
    $csn=add_tad_gallery_cate($_POST['csn'],$_POST['new_csn']);
	}else{
		$csn=$_POST['csn'];
	}

	$uid=$xoopsUser->getVar('uid');

	if(!empty($_POST['csn']))$_SESSION['tad_gallery_csn']=$_POST['csn'];

	
		//處理上傳的檔案
	foreach($_POST['all'] as $i => $source_file){
		if($_POST['import'][$i]['upload']!='1'){
			unlink($source_file);
			continue;
		}
		
   	$sql = "insert into ".$xoopsDB->prefix("tad_gallery")." (`csn`,`filename`,`size`,`type`,`width`,`height`,`dir`,`uid`,`post_date`,`counter`,`exif`) values('{$csn}','{$_POST['import'][$i]['filename']}','{$_POST['import'][$i]['size']}','{$_POST['import'][$i]['type']}','{$_POST['import'][$i]['width']}','{$_POST['import'][$i]['height']}','{$_POST['import'][$i]['dir']}','{$uid}','{$_POST['import'][$i]['post_date']}','0','{$_POST['import'][$i]['exif']}')";
		$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error().$sql);
		//取得最後新增資料的流水編號
		$sn=$xoopsDB->getInsertId();

		set_time_limit(0);
	
		mk_dir(_TADGAL_UP_FILE_DIR.$_POST['import'][$i]['dir']);
		mk_dir(_TADGAL_UP_FILE_DIR."small/".$_POST['import'][$i]['dir']);
		mk_dir(_TADGAL_UP_FILE_DIR."medium/".$_POST['import'][$i]['dir']);
		
		$filename=photo_name($sn,"source",1);
		if(rename($source_file,$filename)){
		  //add_pic_mark($filename,$filename,$type,"Tad Gallery");

			$m_thumb_name=photo_name($sn,"m",1);
			$s_thumb_name=photo_name($sn,"s",1);
			
			if($_POST['import'][$i]['width'] > $xoopsModuleConfig['thumbnail_m_width'] or $_POST['import'][$i]['height'] > $xoopsModuleConfig['thumbnail_m_width']){
				thumbnail($filename,$m_thumb_name,$_POST['import'][$i]['type'],$xoopsModuleConfig['thumbnail_m_width']);
			}
			if($_POST['import'][$i]['width'] > $xoopsModuleConfig['thumbnail_s_width'] or $_POST['import'][$i]['height'] > $xoopsModuleConfig['thumbnail_s_width']){
				thumbnail($filename,$s_thumb_name,$_POST['import'][$i]['type'],$xoopsModuleConfig['thumbnail_s_width']);
			}
		}else{
		  $sql = "delete from ".$xoopsDB->prefix("tad_gallery")." where sn='$sn'";
			$xoopsDB->query($sql);
			redirect_header($_SERVER['PHP_SELF'], 5, sprintf(_TADGAL_IMPORT_IMPORT_ERROR,$filename));
		}
	}

	return $csn;
}

/*-----------執行動作判斷區----------*/
$_REQUEST['op']=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
switch($_REQUEST['op']){
	case "import_tad_gallery":
	$csn=import_tad_gallery();
	mk_rss_xml();
	header("location: index.php?csn=$csn");
	break;

	default:
	$main=import_form();
	break;
}

/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";
$xoopsTpl->assign( "css" , "<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />") ;
$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;
$xoopsTpl->assign( "content" , $main) ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>
