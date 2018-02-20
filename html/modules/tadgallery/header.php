<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2008-03-23
// $Id: header.php,v 1.3 2008/05/05 03:23:04 tad Exp $
// ------------------------------------------------------------------------- //

include "../../mainfile.php";
include "function.php";

$interface_menu[_TO_INDEX_PAGE]="index.php";
//$upload_powers=chk_cate_post_power();
$upload_powers=chk_cate_power("upload");

if(sizeof($upload_powers)>0 and $xoopsUser){
	$interface_menu[_MD_TADGAL_XP_UPLOAD]="xppw.php?op=html";
	$interface_menu[_MD_TADGAL_UPLOAD_PAGE]="uploads.php";
	$interface_menu[_MD_TADGAL_PATCH_UPLOAD_PAGE]="import.php";
}


	
?>