<?php
include_once "../../../../mainfile.php";

if($_POST['op']=="GO"){
  start_update3();
}

$ver="1.2 -> 1.3";
$title=_MA_GAL_AUTOUPDATE3;
$ok=update_chk3();


function update_chk3(){
	global $xoopsDB;
	$sql="select count(`show_mode`) from ".$xoopsDB->prefix("tad_gallery_cate");
	$result=$xoopsDB->query($sql);
	if(empty($result)) return false;
	return true;
}


function start_update3(){
	global $xoopsDB;
	$sql="ALTER TABLE ".$xoopsDB->prefix("tad_gallery_cate")." ADD `show_mode` varchar(255) NOT NULL";
	$xoopsDB->queryF($sql) or redirect_header(XOOPS_URL,3,  mysql_error());

	header("location:{$_SERVER["HTTP_REFERER"]}");
	exit;
}
?>
