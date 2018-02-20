<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: index.php,v 1.5 2008/05/10 11:46:50 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "show_tpl.html";
/*-----------function區--------------*/
$csn=(isset($_REQUEST['csn']))?intval($_REQUEST['csn']) : 0;
$passwd=(isset($_POST['passwd']))?$_POST['passwd'] : "";

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



if($xoopsModuleConfig['only_thumb']!='1'){
	$sql = "select csn,title,passwd,show_mode,cover from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$csn}'  order by sort";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while(list($fcsn,$title,$passwd,$show_mode,$cover)=$xoopsDB->fetchRow($result)){
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
		


		$cover_pic=(empty($cover))?"images/folder_picture.png":XOOPS_URL."/uploads/tadgallery/{$cover}";
		$cover_css=(empty($cover))?"border:4px solid transparent;":"border:4px solid rgb(255,255,255);";
		$cover_class=(empty($cover))?"GalleryCate":"PhotoCate";

	  if(empty($passwd) or $passwd==$_SESSION['tadgallery'][$fcsn]){
	  	$data.="<a $rel href='{$url}?csn={$fcsn}'><div style='background-image:url({$cover_pic});{$cover_css}' class='{$cover_class}'><div class='GalleryCate_txt'>$title</div></div></a>";
	  	
		}else{
	  	$data.="<a href='#'><div style='background-image:url({$cover_pic});{$cover_css}' class='{$cover_class}'>
	  	<div style='width:100%;text-align:center;position:absolute;bottom:50px;'>
	    <form action='{$_SERVER['PHP_SELF']}' method='post'>
			<img src='images/view_lock.png' alt='view_lock.png, 1.4kB' title='View lock' border='0' height='22' width='22' align='absmiddle'>
			<input type='hidden' name='csn' value='{$fcsn}'>
			<input type='password' name='passwd' size=10 style='font-size:10px'>
			</form>
			</div>
			<div class='GalleryCate_txt'>$title</div></div></a>";
		}
	}

}
$sql = "select * from ".$xoopsDB->prefix("tad_gallery")." where csn='{$csn}' order by post_date";

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

while(list($sn,$db_csn,$title,$description,$filename,$size,$type,$width,$height,$dir,$uid,$post_date,$counter,$exif)=$xoopsDB->fetchRow($result)){

  $mbf_item="<span style='display:none'>#gallery {$sn}-{$db_csn}</span>";

	if($thumbnail_mode=="edge"){
    $data.="<a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"s")."' class='edges inbuilt imask2'  alt='{$title}' title='{$title}'  style='margin:10px'>$mbf_item</a>";
	}elseif($thumbnail_mode=="slided"){
    $data.="<a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"s")."' class='slided ibgcolorFBFBFB ishadow20'  alt='{$title}' title='{$title}' style='margin:10px'>$mbf_item</a>";
  }elseif($thumbnail_mode=="instant"){
    $data.="<a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"s")."' class='instant icolorFCFCFC'  alt='{$title}' title='{$title}' style='margin:10px;'>$mbf_item</a>";
	}elseif($thumbnail_mode=="curved"){
	  $pic=getimagesize(get_pic_url($dir,$sn,$filename,"s","dir"));
    $data.=pic_3d($pic[0],$pic[1],"<a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"s")."' alt='{$title}' title='{$title}'>$mbf_item</a>");
	}elseif($thumbnail_mode=="shadow"){

  	$div_width=$xoopsModuleConfig['thumbnail_s_width']+28;
  	  
  	if($width/$height > 2){
  	  $blur2_width=$xoopsModuleConfig['thumbnail_s_width']+22;
  	  $marquee_width=$xoopsModuleConfig['thumbnail_s_width'];
  	  $style="style='width:{$blur2_width}px;'";
			$div1="<div class='shadow_content2'><center><marquee style='width:{$marquee_width}px'>";
      $div2="</marquee></center></div>";
		}else{
      $style="";
      $div1="<div class='shadow_content2'>";
      $div2="</div>";
		}

		$data.="
		<div style='padding:2px;whidth:{$div_width}px;height:{$div_width}px; float:left;'>
		<div class='blur2' $style>
	  <div class='shadow2'>
	    $div1<a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"s")."' alt='{$title}' title='{$title}' style='margin:10px;'>$mbf_item</a>
	  	$div2
		</div>
	</div></div>";
	}else{
    $data.="<a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"s")."' alt='{$title}' title='{$title}' style='margin:10px;'>$mbf_item</a>";
	}
  	

	$option_pic=($i==1)?"option":"hidden";
	$description=($i==1)?"<img src='images/randr.png' alt='"._MA_TADGAL_SHOW_ONE_MODE."' title='"._MA_TADGAL_SHOW_ONE_MODE."' border='0' height='22' width='22' hspace=4 align='absmiddle' onmouseover=\"showToolTip(event,'"._MA_TADGAL_SHOW_ONE_MODE."');return false\" onmouseout=\"hideToolTip()\">":"";
	
	$pp.="<a rel='shadowbox[{$cate['title']}]' href='".get_pic_url($dir,$sn,$filename,"m")."' class='{$option_pic}' title='{$title}'>{$description}</a>\n";
	$i++;
}

if($thumbnail_mode=="edge"){
	$script="
	<script type='text/javascript'>
	var mask2load = new Array();
	mask2load[0] = '".XOOPS_URL."/modules/{$MDIR}/class/edge/masks/8bit/crippleedge.png';
	mask2load[1] = '".XOOPS_URL."/modules/{$MDIR}/class/edge/masks/8bit/frizzedge.png';
	mask2load[2] = '".XOOPS_URL."/modules/{$MDIR}/class/edge/masks/8bit/softedge.png';
	// if you want IE to use mask images: add GIF versions
	// of the same name to the array (edge.js will find them)
	mask2load[3] = '".XOOPS_URL."/modules/{$MDIR}/class/edge/masks/2bit/crippleedge.gif';
	mask2load[4] = '".XOOPS_URL."/modules/{$MDIR}/class/edge/masks/2bit/frizzedge.gif';
	mask2load[5] = '".XOOPS_URL."/modules/{$MDIR}/class/edge/masks/2bit/softedge.gif';
	</script>
	<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/edge/edge.js'></script>";
}elseif($thumbnail_mode=="slided"){
  $script="<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/slided/slided.js'></script>";
}elseif($thumbnail_mode=="instant"){
  $script="<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/instant/instant.js'></script>";
}elseif($thumbnail_mode=="shadow"){
	$script="
	<style type='text/css'>
  .blur2{
      background-color: #ccc; /*shadow color*/
      color: inherit;
      margin: auto 2px auto 2px;
  }

  .shadow2,
  .shadow_content2{
      position: relative;
      bottom: 1px;
      right: 1px;
  }

  .shadow2{
      background-color: #666; /*shadow color*/
      color: inherit;
  }

  .shadow_content2{
      background-color: #fff; /*background color of content*/
      color: #000; /*text color of content*/
      border: 1px solid #000; /*border color*/
      padding: 0px;
      text-align:center;
  }
	</style>
	";
}else{
  $script="";
}



/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";

$xoopsTpl->assign( "xoops_module_header" , "<link rel='alternate' href='"._TADGAL_UP_FILE_URL."photos.rss' type='application/rss+xml' title='{$cate['title']}' id='gallery' />
<script type=\"text/javascript\"
    src=\"http://lite.piclens.com/current/piclens.js\"></script>");

$xoopsTpl->assign( "css" , "

<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />
<link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/css/shadowbox.css'>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/js/lib/yui-utilities.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/js/adapter/shadowbox-yui.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/shadowbox/src/js/shadowbox.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/jquery.dimensions.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/{$MDIR}/class/jquery.dropshadow.js'></script>
<script type='text/javascript'>
window.onload = function(){
    Shadowbox.init();
    $(\".PhotoCate\").dropShadow({left: 1, top: 1, blur: 2, opacity: 0.5});
};
</script>
{$script}") ;

$author_menu=get_all_author();

$xoopsTpl->assign( "author_option" , "<select onChange=\"window.location.href='author.php?uid=' + this.value\" style='margin-right:20px'>$author_menu</select>") ;


$xoopsTpl->assign( "cate_option" , "<select onChange=\"window.location.href='{$_SERVER['PHP_SELF']}?csn=' + this.value\" style='margin-right:20px'>$cate_option</select>") ;

$xoopsTpl->assign( "show_3d_button" , "<a rel='shadowbox' class='option' title='{$cate['title']}' href='3d.php?csn={$csn}'><img src='images/3d.png' alt='"._MA_TADGAL_3D_MODE."' title='"._MA_TADGAL_3D_MODE."' border='0' height='22' width='22' hspace=4 align='absmiddle' onmouseover=\"showToolTip(event,'"._MA_TADGAL_3D_MODE."');return false\" onmouseout=\"hideToolTip()\"></a>") ;


$xoopsTpl->assign( "show_shadowbox_button" , $pp) ;


$xoopsTpl->assign( "slideshow_button" , "<a href='slideshow.php?csn={$csn}'><img src='images/impress.png' alt='"._MA_TADGAL_SLIDE_SHOW_MODE."' title='"._MA_TADGAL_SLIDE_SHOW_MODE."' border='0' height='22' width='22' hspace=4 align='absmiddle' onmouseover=\"showToolTip(event,'"._MA_TADGAL_SLIDE_SHOW_MODE."');return false\" onmouseout=\"hideToolTip()\"></a>") ;

//$xoopsTpl->assign( "PicLens_button" , "<a href='javascript:PicLensLite.start();'><img src='images/PicLensButton.png' alt='PicLens' border='0' height='22' width='22' align='absmiddle' style='margin-left:4px;'></a>") ;

$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;

$xoopsTpl->assign( "data" , $data) ;

$xoopsTpl->assign( "bar" , $bar) ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>
