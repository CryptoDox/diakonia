<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: exif.php,v 1.3 2008/04/21 08:17:33 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "index_tpl.html";
/*-----------function區--------------*/

//觀看某一張照片
function view_pic_exif($sn=""){
	global $xoopsDB,$xoopsModule,$xoopsModuleConfig;
	$MDIR=$xoopsModule->getVar('dirname');
	
	$sql = "select csn,title,description,filename,size,type,width,height,dir,uid,post_date,counter,exif from ".$xoopsDB->prefix("tad_gallery")." where sn='{$sn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	list($csn,$title,$description,$filename,$size,$type,$width,$height,$dir,$uid,$post_date,$counter,$exif)=$xoopsDB->fetchRow($result);
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
	//找出上一張或下一張
  $pnp=get_pre_next($csn,$sn);
  
	$info=explode("||",$exif);
	$info_txt="";
	foreach($info as $v){
	  $pic=explode("=",$v);
	  $pic[1]=str_replace("&#65533;","",$pic[1]);
	  $bb= "\$aa{$pic[0]}=\"{$pic[1]}\";";
	  if(empty($pic[0]))continue;
	  @eval($bb);
	}
	
	$info_txt="
	<style type=\"text/css\">
	  .blur{
	        background-color: #ccc; /*shadow color*/
	        color: inherit;
	        margin-left: 4px;
	        margin-top: 4px;
	        margin-right: 8px;
	    }

	    .shadow,
	    .content{
	        position: relative;
	        bottom: 2px;
	        right: 2px;
	    }

	    .shadow{
	        background-color: #666; /*shadow color*/
	        color: inherit;
	    }

	    .content{
	        background-color: #fff; /*background color of content*/
	        color: #000; /*text color of content*/
	        border: 1px solid #000; /*border color*/
	        padding: 8px;
	    }
  </style>
	<table id='tbl'>
	<tr><th colspan=2>IFD0</th></tr>
	<tr><td>"._MD_TADGAL_MAKE." (Make) </td><td>{$aa["IFD0"]['Make']}</td></tr>
	<tr><td>"._MD_TADGAL_MODEL." (Model) </td><td>{$aa["IFD0"]["Model"]}</td></tr>
	<tr><td>"._MD_TADGAL_ORIENTATION." (Orientation) </td><td>{$aa["IFD0"]["Orientation"]}</td></tr>
	<tr><td>"._MD_TADGAL_XRESOLUTION." (xResolution) </td><td>{$aa["IFD0"]["xResolution"]}</td></tr>
	<tr><td>"._MD_TADGAL_YRESOLUTION." (yResolution) </td><td>{$aa["IFD0"]["yResolution"]}</td></tr>
	<tr><td>"._MD_TADGAL_RESOLUTIONUNIT." (ResolutionUnit) </td><td>{$aa["IFD0"]["ResolutionUnit"]}</td></tr>
	<tr><td>"._MD_TADGAL_YCBCRPOSITIONING." (YCbCrPositioning) </td><td>{$aa["IFD0"]["YCbCrPositioning"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXIFOFFSET." (ExifOffset) </td><td>{$aa["IFD0"]["ExifOffset"]}</td></tr>

	<tr><th colspan=2>SubIFD</th></tr>
	<tr><td>"._MD_TADGAL_EXPOSURETIME." (ExposureTime) </td><td>{$aa["SubIFD"]["ExposureTime"]}</td></tr>
	<tr><td>"._MD_TADGAL_FNUMBER." (FNumber) </td><td>{$aa["SubIFD"]["FNumber"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXPOSUREPROGRAM." (ExposureProgram) </td><td>{$aa["SubIFD"]["ExposureProgram"]}</td></tr>
	<tr><td>"._MD_TADGAL_ISOSPEEDRATINGS." (ISOSpeedRatings) </td><td>{$aa["SubIFD"]["ISOSpeedRatings"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXIFVERSION." (ExifVersion) </td><td>{$aa["SubIFD"]["ExifVersion"]}</td></tr>
	<tr><td>"._MD_TADGAL_DATETIMEORIGINAL." (DateTimeOriginal) </td><td>{$aa["SubIFD"]["DateTimeOriginal"]}</td></tr>
	<tr><td>"._MD_TADGAL_DATETIMEDIGITIZED." (DateTimedigitized) </td><td>{$aa["SubIFD"]["DateTimedigitized"]}</td></tr>
	<tr><td>"._MD_TADGAL_COMPONENTSCONFIGURATION." (ComponentsConfiguration) </td><td>{$aa["SubIFD"]["ComponentsConfiguration"]}</td></tr>
	<tr><td>"._MD_TADGAL_SHUTTERSPEEDVALUE." (ShutterSpeedValue) </td><td>{$aa["SubIFD"]["ShutterSpeedValue"]}</td></tr>
	<tr><td>"._MD_TADGAL_APERTUREVALUE." (ApertureValue) </td><td>{$aa["SubIFD"]["ApertureValue"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXPOSUREBIASVALUE." (ExposureBiasValue) </td><td>{$aa["SubIFD"]["ExposureBiasValue"]}</td></tr>
	<tr><td>"._MD_TADGAL_MAXAPERTUREVALUE." (MaxApertureValue) </td><td>{$aa["SubIFD"]["MaxApertureValue"]}</td></tr>
	<tr><td>"._MD_TADGAL_METERINGMODE." (MeteringMode) </td><td>{$aa["SubIFD"]["MeteringMode"]}</td></tr>
	<tr><td>"._MD_TADGAL_FLASH." (Flash) </td><td>{$aa["SubIFD"]["Flash"]}</td></tr>
	<tr><td>"._MD_TADGAL_FOCALLENGTH." (FocalLength) </td><td>{$aa["SubIFD"]["FocalLength"]}</td></tr>
	<tr><td>KnownMaker</td><td>{$aa["SubIFD"]["KnownMaker"]}</td></tr>
	<tr><td>"._MD_TADGAL_FLASHPIXVERSION." (FlashPixVersion) </td><td>{$aa["SubIFD"]["FlashPixVersion"]}</td></tr>
	<tr><td>"._MD_TADGAL_COLORSPACE." (ColorSpace) </td><td>{$aa["SubIFD"]["ColorSpace"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXIFIMAGEWIDTH." (ExifImageWidth) </td><td>{$aa["SubIFD"]["ExifImageWidth"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXIFIMAGEHEIGHT." (ExifImageHeight) </td><td>{$aa["SubIFD"]["ExifImageHeight"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXIFINTEROPERABILITYOFFSET." (ExifInteroperabilityOffset) </td><td>{$aa["SubIFD"]["ExifInteroperabilityOffset"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXPOSUREINDEX." (ExposureIndex) </td><td>{$aa["SubIFD"]["ExposureIndex"]}</td></tr>
	<tr><td>"._MD_TADGAL_SENSINGMETHOD." (SensingMethod) </td><td>{$aa["SubIFD"]["SensingMethod"]}</td></tr>
	<tr><td>"._MD_TADGAL_FILESOURCE." (FileSource) </td><td>{$aa["SubIFD"]["FileSource"]}</td></tr>
	<tr><td>"._MD_TADGAL_SCENETYPE." (SceneType) </td><td>{$aa["SubIFD"]["SceneType"]}</td></tr>
	<tr><td>CustomerRender</td><td>{$aa["SubIFD"]["CustomerRender"]}</td></tr>
	<tr><td>"._MD_TADGAL_EXPOSUREMODE." (ExposureMode) </td><td>{$aa["SubIFD"]["ExposureMode"]}</td></tr>
	<tr><td>"._MD_TADGAL_WHITEBALANCE." (WhiteBalance) </td><td>{$aa["SubIFD"]["WhiteBalance"]}</td></tr>
	<tr><td>"._MD_TADGAL_DIGITALZOOMRATIO." (DigitalZoomRatio) </td><td>{$aa["SubIFD"]["DigitalZoomRatio"]}</td></tr>
	<tr><td>"._MD_TADGAL_SCENECAPTUREMODE." (SceneCaptureMode) </td><td>{$aa["SubIFD"]["SceneCaptureMode"]}</td></tr>
	<tr><td>"._MD_TADGAL_GAINCONTROL." (GainControl) </td><td>{$aa["SubIFD"]["GainControl"]}</td></tr>
	<tr><td>"._MD_TADGAL_CONTRAST." (Contrast) </td><td>{$aa["SubIFD"]["Contrast"]}</td></tr>
	<tr><td>"._MD_TADGAL_SATURATION." (Saturation) </td><td>{$aa["SubIFD"]["Saturation"]}</td></tr>
	<tr><td>"._MD_TADGAL_SHARPNESS." (Sharpness) </td><td>{$aa["SubIFD"]["Sharpness"]}</td></tr>
	
	<tr><th colspan=2>IFD1</th></tr>
	<tr><td>"._MD_TADGAL_COMPRESSION." (Compression) </td><td>{$aa["IFD1"]["Compression"]}</td></tr>
	<tr><td>"._MD_TADGAL_ORIENTATION." (Orientation) </td><td>{$aa["IFD1"]["Orientation"]}</td></tr>
	<tr><td>"._MD_TADGAL_XRESOLUTION." (xResolution) </td><td>{$aa["IFD1"]["xResolution"]}</td></tr>
	<tr><td>"._MD_TADGAL_YRESOLUTION." (yResolution) </td><td>{$aa["IFD1"]["yResolution"]}</td></tr>
	<tr><td>"._MD_TADGAL_RESOLUTIONUNIT." (ResolutionUnit) </td><td>{$aa["IFD1"]["ResolutionUnit"]}</td></tr>
	<tr><td>"._MD_TADGAL_JPEGIFOFFSET." (JpegIFOffset) </td><td>{$aa["IFD1"]["JpegIFOffset"]}</td></tr>
	<tr><td>"._MD_TADGAL_JPEGIFBYTECOUNT." (JpegIFByteCount) </td><td>{$aa["IFD1"]["JpegIFByteCount"]}</td></tr>

	<tr><th colspan=2>InteroperabilityIFD</th></tr>
	<tr><td>InteroperabilityIndex</td><td>{$aa["InteroperabilityIFD"]["InteroperabilityIndex"]}</td></tr>
	<tr><td>InteroperabilityVersion</td><td>{$aa["InteroperabilityIFD"]["InteroperabilityVersion"]}</td></tr>

	<tr><th colspan=2>Other</th></tr>
	<tr><td>"._MD_TADGAL_IFD1OFFSET." (IFD1Offset) </td><td>{$aa["IFD1Offset"]}</td></tr>
	</table>";
	
	$pre_btn=(!empty($pnp['pre']))?"<div style='display:inline'><a href='exif.php?sn={$pnp['pre']}'><img src='images/1leftarrow.gif' alt='"._BP_BACK_PAGE." title='"._BP_BACK_PAGE."' align='absmiddle'>"._BP_BACK_PAGE."</a></div>":"";
	$next_btn=(!empty($pnp['next']))?"<div style='float:right'><a href='exif.php?sn={$pnp['next']}'>"._BP_NEXT_PAGE."<img src='images/1rightarrow.gif' alt='"._BP_NEXT_PAGE." title='"._BP_NEXT_PAGE."' align='absmiddle'></a></div>":"";

	$data="
	<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/bubble.css' />
	<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/bubble-tooltip.js'></script>
	<div id='bubble_tooltip'>
	<div class='bubble_top'><span></span></div>
	<div class='bubble_middle'><span id='bubble_tooltip_content'></span></div>
	<div class='bubble_bottom'></div>
	</div>
	<table><tr>
	<td valign='top'>
  <div class='blur'>
    <div class='shadow'>
      <div class='content'>
			<a href='view.php?sn=$sn'><img src='".get_pic_url($dir,$sn,$filename,"s")."' onmouseover=\"showToolTip(event,'"._MA_TADGAL_CLICK_BACK."');return false\" onmouseout=\"hideToolTip()\"></a>
			<div style='margin-top:4px;'>$next_btn $pre_btn</div>
			<div style='clear:both'></div>
			</div>
    </div>
	</div>
	</td>
	<td valign='top'>$info_txt</td></tr>
	</table>";
	
	$data=div_3d(sprintf(_MD_TADGAL_EXIF,$filename),$data,"corners");
	
	return $data;
}


/*-----------執行動作判斷區----------*/
$_REQUEST['op']=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(isset($_REQUEST['sn']))?intval($_REQUEST['sn']) : 0;

switch($_REQUEST['op']){


	default:
	$main=view_pic_exif($sn);
	break;
}

/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";
$xoopsTpl->assign( "css" , "<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />") ;
$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;
$xoopsTpl->assign( "content" , $main) ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>