<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2007-11-04
// $Id: tadgallery_re_block.php,v 1.1 2008/04/21 06:43:17 tad Exp $
// ------------------------------------------------------------------------- //

//區塊主函式 (列出最新的相片評論)
function tadgallery_show_re($options){
	global $xoopsDB;
	$modhandler = &xoops_gethandler('module');
  $xoopsModule = &$modhandler->getByDirname("tadgallery");
	$com_modid=$xoopsModule->getVar('mid');
	$sql = "select a.com_id,a.com_text,a.com_itemid,a.com_uid,b.title,b.filename,b.uid from ".$xoopsDB->prefix("xoopscomments")." as a left join ".$xoopsDB->prefix("tad_gallery")." as b on a.com_itemid=b.sn where a.com_modid='$com_modid' order by a.com_modified desc limit 0,{$options[0]}";
	$result = $xoopsDB->query($sql);
	$block="<div>";
	//if($options[3]=="1")$options[2]=1;
	while(list($com_id,$txt,$nsn,$uid,$title,$filename,$poster_uid)=$xoopsDB->fetchRow($result)){
		$uid_name=XoopsUser::getUnameFromId($uid,0);
		if($options[2]=="1"){
			$poster_uid_name=XoopsUser::getUnameFromId($poster_uid,0);
			$title=(empty($title))?$filename:$title;
			$who="<div style='margin-bottom:6px;font-size:11px;width:{$options[1]}px;height:14px;overflow:hidden;'><a href='".XOOPS_URL."/modules/tadgallery/author.php?uid=$poster_uid'>{$poster_uid_name}</a><img src='".XOOPS_URL."/modules/tadgallery/images/image.png' hspace='4' align='absmiddle'><a href='".XOOPS_URL."/modules/tadgallery/view.php?sn={$nsn}'>{$title}</a></div>";
		}else{
			$who="";
		}
		
		$css=($options[3]!="1")?"height:14px;overflow:hidden;":"margin-bottom:6px;overflow:auto;";
		
		$block.="<div style='width:{$options[1]}px;$css'><a href='".XOOPS_URL."/userinfo.php?uid={$uid}'>{$uid_name}</a>: <a href='".XOOPS_URL."/modules/tadgallery/view.php?sn={$nsn}#comment{$com_id}'>$txt</a></div>$who";
	}
	$block.="</div>";
	return $block;
}

//區塊編輯函式
function tadgallery_re_edit($options){

	$form="
	"._MB_TADGAL_RE_EDIT_BITEM0."
	<INPUT type='text' name='options[0]' value='{$options[0]}'><br>
	"._MB_TADGAL_RE_EDIT_BITEM1."
	<INPUT type='text' name='options[1]' value='{$options[1]}'><br>
	"._MB_TADGAL_RE_EDIT_BITEM2."
	<INPUT type='radio' name='options[2]' value='0'>"._MB_TADGAL_RE_EDIT_BITEM2_OPT1."
	<INPUT type='radio' name='options[2]' value='1'>"._MB_TADGAL_RE_EDIT_BITEM2_OPT2."
	<br>
	"._MB_TADGAL_RE_EDIT_BITEM3."
	<INPUT type='radio' name='options[3]' value='0'>"._MB_TADGAL_RE_EDIT_BITEM3_OPT1."
	<INPUT type='radio' name='options[3]' value='1'>"._MB_TADGAL_RE_EDIT_BITEM3_OPT2."
	";
	return $form;
}


?>