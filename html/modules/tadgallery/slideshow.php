<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2008-03-23
// $Id: slideshow.php,v 1.5 2008/05/10 11:46:50 tad Exp $
// ------------------------------------------------------------------------- //

/*-----------�ޤJ�ɮװ�--------------*/
include "header.php";
$xoopsOption['template_main'] = "slideshow.html";
/*-----------function��--------------*/
$csn=(isset($_REQUEST['csn']))?intval($_REQUEST['csn']) : 0;
$passwd=(isset($_POST['passwd']))?$_POST['passwd'] : "";


$MDIR=$xoopsModule->getVar('dirname');

$cate_option=get_tad_gallery_cate_option(0,0,$csn);
$cate=get_tad_gallery_cate($csn);

$ok_cat=chk_cate_power();
if(!in_array($csn,$ok_cat)){
  $select="<select onChange=\"window.location.href='{$_SERVER['PHP_SELF']}?csn=' + this.value\">
	$cate_option
	</select>";
	$main=div_3d(_TADGAL_NO_POWER_TITLE,sprintf(_TADGAL_NO_POWER_CONTENT,$cate['title'],$select),"corners");
}else{
	$main="";
	$sql = "select a.sn,a.title,a.description,a.filename,a.dir from ".$xoopsDB->prefix("tad_gallery")." as a , ".$xoopsDB->prefix("tad_gallery_cate")." as b where a.csn=b.csn and a.csn='{$csn}' and b.passwd='{$_SESSION['tadgallery'][$csn]}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	$pics="<ul id='animated-portfolio'>\n";
	while(list($sn,$title,$description,$filename,$dir)=$xoopsDB->fetchRow($result)){
		$pics.="<li><a href='view.php?sn={$sn}'><img src='".get_pic_url($dir,$sn,$filename,"m")."' alt='{$title}'></a></li>\n";
	}
	$pics.="</ul>";

	$div_width=$xoopsModuleConfig['thumbnail_m_width']+30;

	$main="
	<div style='width:{$div_width}px;margin-left:auto;margin-right:auto;'>
	<dl class='bot_rgt'>
	<dt><select onChange=\"window.location.href='{$_SERVER['PHP_SELF']}?op=slideshow&csn=' + this.value\" style='margin-right:20px'>$cate_option</select><a href='index.php?csn={$csn}'>".sprintf(_MD_TADGAL_BACK_CSN,$cate['title'])."</a></dt>
	<dd>$pics</dd>
	</dl>
</div>";
}



/*-----------�q�X���G��--------------*/
include XOOPS_ROOT_PATH."/header.php";


$xoopsTpl->assign( "css" , "<link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadgallery/module.css' />
<script type='text/javascript' src='".XOOPS_URL."/modules/tadgallery/class/jquery.animated.innerfade/js/jquery.animated.innerfade.js'></script>

<script type='text/javascript'>
$(document).ready( function(){
    $('ul#animated-portfolio').animatedinnerfade({
	speed: 1000,
	timeout: 5000,
	type: 'random',
	containerheight: '414px',
	containerwidth: '{$xoopsModuleConfig['thumbnail_m_width']}px',
	animationSpeed: 5000,
	animationtype: 'fade',
	bgFrame: 'none',
  controlBox: 'auto',
  controlBoxClass: 'none',
  controlButtonsPath: 'class/jquery.animated.innerfade/img',
	displayTitle: 'none'
	});
} );
</script>") ;
$xoopsTpl->assign( "toolbar" , toolbar($interface_menu)) ;
$xoopsTpl->assign( "cate_option" , "<select onChange=\"window.location.href='{$_SERVER['PHP_SELF']}?op=slideshow&csn=' + this.value\" style='margin-right:20px'>$cate_option</select>") ;
$xoopsTpl->assign( "link_to_cate" , "<a href='index.php?csn={$csn}'>".sprintf(_MD_TADGAL_BACK_CSN,$cate['title'])."</a>") ;
$xoopsTpl->assign( "div_width" , $div_width) ;
$xoopsTpl->assign( "pics" , $pics) ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>