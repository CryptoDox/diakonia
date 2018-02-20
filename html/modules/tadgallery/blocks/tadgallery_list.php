<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2008-03-23
// $Id: tadgallery_show.php,v 1.7 2008/05/14 01:23:14 tad Exp $
// ------------------------------------------------------------------------- //


//�϶��D�禡 (�Y�Ϯi��)
function tadgallery_list($options){
	global $xoopsDB;
	if(!empty($options[1]))$by[]=" a.csn='{$options[1]}'";
	if($options[7]=='1')$by[]=" a.good='1'";

	$by_txt=(!empty($by))?implode(" and ",$by):"";
	$where_txt=(!empty($by_txt))?"and $by_txt":"";

	if($options[2]=='order by rand()'){
    $options[3]="";
	}
	

	$sql = "select a.sn,a.title,a.description,a.filename,a.dir from ".$xoopsDB->prefix("tad_gallery")." as a left join  ".$xoopsDB->prefix("tad_gallery_cate")." as b on a.csn=b.csn where b.passwd='' and b.enable_group='' {$where_txt} {$options[2]} {$options[3]} limit 0,{$options[0]}";

	$result = $xoopsDB->query($sql);


	$pics="";
	while(list($sn,$title,$description,$filename,$dir)=$xoopsDB->fetchRow($result)){
    $description=Only1br($description);
	  $show_title=(empty($title))?"":"onmouseover=\"showToolTip(event,'<b>{$title}</b><br />{$description}');return false\" onmouseout=\"hideToolTip()\"";
	  $pic_url=get_pic_url($dir,$sn,$filename,"s");
	  $txt=(empty($title))?$filename:$title;
	  
	  $pic_txt=($options[8]=='1')?"<div style='width:{$options[5]}px;{$options[9]}'>$txt</div>":"";
	  
		$pics.="
		<a href='".XOOPS_URL."/modules/tadgallery/view.php?sn={$sn}' style='display:block;float:left;margin:{$options[4]}px;text-decoration:none;'><div style='border:1px solid #D0D0D0;width:{$options[5]}px;height:{$options[6]}px;background-image:url({$pic_url});background-position: top center;	background-repeat: no-repeat;cursor:pointer;' $show_title></div>$pic_txt</a>
		";
	}

	$block="
	<div>
	$pics
	<div style='clear:both;'></div>
	</div>";
	return $block;
}

function Only1br($string)
{
    return preg_replace("/(\r\n)+|(\n|\r)+/", "<br />", $string);
}


//�϶��s��禡
function tadgallery_list_edit($options){
	$cate_select=get_tad_gallery_block_cate_option(0,0,$options[1]);

	
	$sortby_0=($options[2]=="order by post_date")?"selected":"";
	$sortby_1=($options[2]=="order by counter")?"selected":"";
	$sortby_2=($options[2]=="order by rand()")?"selected":"";

	$sort_normal=($options[3]=="")?"selected":"";
	$sort_desc=($options[3]=="desc")?"selected":"";


	$only_good_0=($options[7]!="1")?"selected":"";
	$only_good_1=($options[7]=="1")?"selected":"";
	

	$show_txt_0=($options[8]=="0")?"checked":"";
	$show_txt_1=($options[8]=="1")?"checked":"";

	$form="
	"._MB_TADGAL_BLOCK_SHOWNUM."
	<INPUT type='text' name='options[0]' value='{$options[0]}' size=2><br>
	"._MB_TADGAL_BLOCK_SHOWCATE."
	<select name='options[1]'>
		$cate_select
	</select><br>
	"._MB_TADGAL_BLOCK_SORTBY."
	<select name='options[2]'>
	<option value='order by post_date' $sortby_0>"._MB_TADGAL_BLOCK_SORTBY_MODE1."</option>
	<option value='order by counter' $sortby_1>"._MB_TADGAL_BLOCK_SORTBY_MODE2."</option>
	<option value='order by rand()' $sortby_2>"._MB_TADGAL_BLOCK_SORTBY_MODE3."</option>
	</select><select name='options[3]'>
	<option value='' $sort_normal>"._MB_TADGAL_BLOCK_SORT_NORMAL."</option>
	<option value='desc' $sort_desc>"._MB_TADGAL_BLOCK_SORT_DESC."</option>
	</select><br>
	"._MB_TADGAL_BLOCK_THUMB_SPACE."
	<INPUT type='text' name='options[4]' value='{$options[4]}' size=2> px<br>
	"._MB_TADGAL_BLOCK_THUMB_WIDTH."
	<INPUT type='text' name='options[5]' value='{$options[5]}' size=3> x
	"._MB_TADGAL_BLOCK_THUMB_HEIGHT."
	<INPUT type='text' name='options[6]' value='{$options[6]}' size=3> px<br>
	"._MB_TADGAL_BLOCK_SHOW_TYPE."<select name='options[7]'>
	<option value='0' $only_good_0>"._MB_TADGAL_BLOCK_SHOW_ALL."</option>
	<option value='1' $only_good_1>"._MB_TADGAL_BLOCK_ONLY_GOOD."</option>
	</select><br>
	"._MB_TADGAL_BLOCK_SHOW_TEXT."
	<input type='radio' name='options[8]' value=1 $show_txt_1>"._MB_TADGAL_BLOCK_SHOW_TEXT_Y."
	<input type='radio' name='options[8]' value=0 $show_txt_0>"._MB_TADGAL_BLOCK_SHOW_TEXT_N."<br>
	"._MB_TADGAL_BLOCK_TEXT_CSS."	<INPUT type='text' name='options[9]' value='{$options[9]}' size=50><br>
	";
	return $form;
}

if(!function_exists("get_pic_url")){
	//���o�Ϥ����}
	function get_pic_url($dir="",$sn="",$filename="",$kind="",$path_kind=""){
    $TADGAL_UP_FILE_DIR=XOOPS_ROOT_PATH."/uploads/tadgallery/";
		$TADGAL_UP_FILE_URL=XOOPS_URL."/uploads/tadgallery/";
	  $show_path=($path_kind=="dir")?$TADGAL_UP_FILE_DIR:$TADGAL_UP_FILE_URL;

		if($kind=="m"){
	    if(is_file($TADGAL_UP_FILE_DIR."medium/{$dir}/{$sn}_m_{$filename}")){
	      return "{$show_path}medium/{$dir}/{$sn}_m_{$filename}";
			}
		}elseif($kind=="s"){
			if(is_file($TADGAL_UP_FILE_DIR."small/{$dir}/{$sn}_s_{$filename}")){
		    return "{$show_path}small/{$dir}/{$sn}_s_{$filename}";
			}elseif(is_file($TADGAL_UP_FILE_DIR."medium/{$dir}/{$sn}_m_{$filename}")){
	      return "{$show_path}medium/{$dir}/{$sn}_m_{$filename}";
			}
		}
		return "{$show_path}{$dir}/{$sn}_{$filename}";
	}
}

if(!function_exists("get_tad_gallery_block_cate_option")){
	//���o�����U�Կ��
	function get_tad_gallery_block_cate_option($of_csn=0,$level=0,$v=""){
		global $xoopsDB,$xoopsUser;

		$modhandler = &xoops_gethandler('module');
	  $xoopsModule = &$modhandler->getByDirname("tadgallery");

		if ($xoopsUser) {
	    $module_id = $xoopsModule->getVar('mid');
	    $isAdmin=$xoopsUser->isAdmin($module_id);
	  }else{
	    $isAdmin=false;
		}

		$sql = "select count(*),csn from ".$xoopsDB->prefix("tad_gallery")." group by csn";
		$result = $xoopsDB->query($sql);
		while(list($count,$csn)=$xoopsDB->fetchRow($result)){
		  $cate_count[$csn]=$count;
		}

		//$left=$level*10;
		$level+=1;

		$syb=str_repeat("-", $level)." ";

		$option=($of_csn)?"":"<option value='0'>"._MB_TADGAL_BLOCK_ALL."</option>";
		$sql = "select csn,title from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$of_csn}' order by sort";
		$result = $xoopsDB->query($sql);

		while(list($csn,$title)=$xoopsDB->fetchRow($result)){
			$selected=($v==$csn)?"selected":"";
			$count=(empty($cate_count[$csn]))?0:$cate_count[$csn];
			$option.="<option value='{$csn}' $selected>{$syb}{$title}({$count})</option>";
			$option.=get_tad_gallery_block_cate_option($csn,$level,$v);
		}
		return $option;
	}
}

?>