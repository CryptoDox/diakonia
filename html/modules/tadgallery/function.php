<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2008-03-23
// $Id: function.php,v 1.7 2008/05/10 11:46:50 tad Exp $
// ------------------------------------------------------------------------- //

define("_TADGAL_UP_FILE_DIR",XOOPS_ROOT_PATH."/uploads/tadgallery/");
define("_TADGAL_UP_FILE_URL",XOOPS_URL."/uploads/tadgallery/");
define("_TADGAL_UP_IMPORT_DIR",_TADGAL_UP_FILE_DIR."upload_pics/");
define("_TADGAL_UP_MP3_DIR",_TADGAL_UP_FILE_DIR."mp3/");
define("_TADGAL_UP_MP3_URL",_TADGAL_UP_FILE_URL."mp3/");


$photo_border=array("none"=>_MA_TADGAL_SHOW_MODE_1,"shadow"=>_MA_TADGAL_SHOW_MODE_2,"curved"=>_MA_TADGAL_SHOW_MODE_3,"instant"=>_MA_TADGAL_SHOW_MODE_4,"edge"=>_MA_TADGAL_SHOW_MODE_5,"slided"=>_MA_TADGAL_SHOW_MODE_6);

$cate_show_mode_array=array("thubm"=>_MA_TADGAL_CATE_SHOW_MODE_1,"3d"=>_MA_TADGAL_CATE_SHOW_MODE_2,"slideshow"=>_MA_TADGAL_CATE_SHOW_MODE_3);

if($xoopsModuleConfig['prevent_hotlinking']=='1'){
	mk_htaccess();
}elseif($xoopsModuleConfig['prevent_hotlinking']=='0' and file_exists(_TADGAL_UP_FILE_DIR.".htaccess")){
	unlink(_TADGAL_UP_FILE_DIR.".htaccess");
}

//�s�@���s�s�]�w
function mk_htaccess(){
  global $xoopsDB,$xoopsModule,$xoopsConfig,$xoopsModuleConfig;;

	$allow_hotlinking=explode(";",$xoopsModuleConfig['allow_hotlinking']);

  $main="SetEnvIfNoCase Referer \"^".XOOPS_URL."(/|$)\" allowed=1
";

  foreach($allow_hotlinking as $url){
    $main.="SetEnvIfNoCase Referer \"^{$url}(/|$)\" allowed=1
";
	}
	
  $main.="SetEnvIfNoCase Referer \"^$\" allowed=1

<FilesMatch \".(png|gif|jpg|PNG|GIF|JPG)\">�@
 Order Allow,Deny
 Allow from env=allowed
</FilesMatch>";


  $filename =_TADGAL_UP_FILE_DIR.".htaccess";

  if (!$handle = fopen($filename, 'w')) {
    redirect_header($_SERVER['PHP_SELF'],3, sprintf(_MA_TADGAL_CANT_OPEN,$filename));
  }

  if (fwrite($handle, $main) === FALSE) {
    redirect_header($_SERVER['PHP_SELF'],3, sprintf(_MA_TADGAL_CANT_WRITE,$filename));
  }
  fclose($handle);

}

//�W�Ǫ̿��
function get_all_author($now_uid=""){
  global $xoopsDB;
  $sql = "select distinct uid from ".$xoopsDB->prefix("tad_gallery")."";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error()."<br>$sql");
	$option="<option value=''>"._MD_TADGAL_ALL_AUTHOR."</option>";
	while(list($uid)=$xoopsDB->fetchRow($result)){

		$uid_name=XoopsUser::getUnameFromId($uid,1);
		if(empty($uid_name)){
    	$uid_name=XoopsUser::getUnameFromId($uid,0);
    }
    
	  $selected=($now_uid==$uid)?"selected":"";
		$option.="<option value='{$uid}' $selected>{$uid_name}</option>";
	}
	return $option;
}

//�ʭ��Ͽ��
function get_cover($csn="",$cover=""){
  global $xoopsDB;
  if(empty($csn))return "<option value=''>"._MD_TADGAL_COVER."</option>";
  
  $sql = "select csn from ".$xoopsDB->prefix("tad_gallery_cate")." where csn='{$csn}' or of_csn='{$csn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error()."<br>$sql");
  while(list($all_csn)=$xoopsDB->fetchRow($result)){
    $csn_arr[]=$all_csn;
  }
  
  $csn_arr_str=implode(",",$csn_arr);
  
  $sql = "select sn,dir,filename from ".$xoopsDB->prefix("tad_gallery")." where csn in($csn_arr_str)  order by filename";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error()."<br>$sql");
	//$option="<option value=''>"._MD_TADGAL_COVER."</option>";
	$option="";
	while(list($sn,$dir,$filename)=$xoopsDB->fetchRow($result)){
	  $selected=($cover=="small/{$dir}/{$sn}_s_{$filename}")?"selected":"";
		$option.="<option value='small/{$dir}/{$sn}_s_{$filename}' $selected>{$filename}</option>";
	}
	return $option;
}


//���X�Ҧ�����(�Ǧ^�}�C)
function get_all_tag(){
  global $xoopsDB;
  $sql = "select tag from ".$xoopsDB->prefix("tad_gallery")." where tag!=''";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error()."<br>$sql");
	while(list($tag)=$xoopsDB->fetchRow($result)){
	
	  $tag_arr=explode(",",$tag);
	  
	  foreach($tag_arr as $val){
	    $val=trim($val);
			$tag_all[$val]++;
		}
	}
	return $tag_all;
}

//�s�@���ҤĿ��
function tag_select($tag=""){

	$tag_arr=explode(",",$tag);
	  
	$tag_all=get_all_tag();
	$menu="";
	foreach($tag_all as $tag=>$n){
	  if(empty($tag))continue;
	  $checked=(in_array($tag,$tag_arr))?"checked":"";
		$menu.="<input type='checkbox' name='tag[]' value='{$tag}' $checked>{$tag}
		";
	}
	return $menu;
}

//�s�@Media RSS
function mk_rss_xml(){
  global $xoopsDB,$xoopsModule,$xoopsConfig;
  $ok_cat=chk_cate_power();
  $ok=implode("','",$ok_cat);

	$sql = "select a.sn,a.csn,a.title,a.description,a.filename,a.size,a.dir from ".$xoopsDB->prefix("tad_gallery")." as a , ".$xoopsDB->prefix("tad_gallery_cate")." as b where a.csn=b.csn and a.csn in('{$ok}') and b.passwd='' and b.enable_group='' order by a.post_date desc";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error()."<br>$sql");

  $main="<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>
<rss version=\"2.0\" xmlns:media=\"http://search.yahoo.com/mrss/\" xmlns:atom=\"http://www.w3.org/2005/Atom\">
	<channel>
	<atom:icon>".XOOPS_URL."/modules/tadgallery/images/piclen_logo.png</atom:icon>
	<generator>Tad Gallery</generator>
	<title>{$xoopsConfig['sitename']}</title>
	<link>".XOOPS_URL."/modules/tadgallery</link>
	<description></description>\n";

  while(list($sn,$csn,$title,$description,$filename,$size,$dir)=$xoopsDB->fetchRow($result)){

    $title=(empty($title))?$filename:$title;
    $title=htmlspecialchars($title);
    $description=htmlspecialchars($description);
    $filename=htmlspecialchars($filename);
		$pic_url=get_pic_url($dir,$sn,$filename);
		$mpic_url=get_pic_url($dir,$sn,$filename,"m");
		$spic_url=get_pic_url($dir,$sn,$filename,"s");
    $main.="		<item>
			<title>{$title}</title>
			<link>".XOOPS_URL."/modules/tadgallery/view.php?sn={$sn}</link>
			<guid>{$sn}-{$csn}</guid>
			<media:thumbnail url=\"{$spic_url}\"/>
			<media:content url=\"{$pic_url}\" fileSize=\"{$size}\" />
			<media:title type=\"plain\">{$title}</media:title>
			<media:description type=\"plain\">{$description}</media:description>
		</item>\n";

  }
  $main.="			</channel>
</rss>\n";

	$main=to_utf8($main);

  $filename =_TADGAL_UP_FILE_DIR."photos.rss";

  if (!$handle = fopen($filename, 'w')) {
    redirect_header($_SERVER['PHP_SELF'],3, sprintf(_MA_TADPLAYER_CANT_OPEN,$filename));
  }

  if (fwrite($handle, $main) === FALSE) {
    redirect_header($_SERVER['PHP_SELF'],3, sprintf(_MA_TADPLAYER_CANT_WRITE,$filename));
  }
  fclose($handle);

}

//�ܧ���ۤ����A
function update_tad_gallery_good($sn="",$v='0'){
	global $xoopsDB;
 	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set `good`='{$v}' where sn='{$sn}'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error());
}



//��X�W�@�i�ΤU�@�i
function get_pre_next($csn="",$sn=""){
	global $xoopsDB;
	$sql = "select sn from ".$xoopsDB->prefix("tad_gallery")." where csn='{$csn}' order by sn";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$stop=false;
  $pre=0;
	while(list($psn)=$xoopsDB->fetchRow($result)){
  	if($stop){
		  $next=$psn;
		  break;
		}
		if($psn==$sn){
		  $now=$psn;
			$stop=true;
		}else{
			$pre=$psn;
   	}
	}
	$main['pre']=$pre;
	$main['next']=$next;
	return $main;
}
//���o�Ϥ����}
function get_pic_url($dir="",$sn="",$filename="",$kind="",$path_kind=""){

  $show_path=($path_kind=="dir")?_TADGAL_UP_FILE_DIR:_TADGAL_UP_FILE_URL;
  
	if($kind=="m"){
    if(is_file(_TADGAL_UP_FILE_DIR."medium/{$dir}/{$sn}_m_{$filename}")){
      return "{$show_path}medium/{$dir}/{$sn}_m_{$filename}";
		}
	}elseif($kind=="s"){
		if(is_file(_TADGAL_UP_FILE_DIR."small/{$dir}/{$sn}_s_{$filename}")){
	    return "{$show_path}small/{$dir}/{$sn}_s_{$filename}";
		}elseif(is_file(_TADGAL_UP_FILE_DIR."medium/{$dir}/{$sn}_m_{$filename}")){
      return "{$show_path}medium/{$dir}/{$sn}_m_{$filename}";
		}
	}
	return "{$show_path}{$dir}/{$sn}_{$filename}";
}


//�R��tad_gallery�Y����Ƹ��
function delete_tad_gallery($sn=""){
	global $xoopsDB;

	$pic=get_tad_gallery($sn);

	$sql = "delete from ".$xoopsDB->prefix("tad_gallery")." where sn='$sn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());


	if(is_file(_TADGAL_UP_FILE_DIR."small/{$pic['dir']}/{$sn}_s_{$pic['filename']}")){
    unlink(_TADGAL_UP_FILE_DIR."small/{$pic['dir']}/{$sn}_s_{$pic['filename']}");
	}

	if(is_file(_TADGAL_UP_FILE_DIR."medium/{$pic['dir']}/{$sn}_m_{$pic['filename']}")){
    unlink(_TADGAL_UP_FILE_DIR."medium/{$pic['dir']}/{$sn}_m_{$pic['filename']}");
	}

  unlink(_TADGAL_UP_FILE_DIR."{$pic['dir']}/{$sn}_{$pic['filename']}");
	return $pic['csn'];
}


//���ɮפj�p�ର��r���A
function sizef($size=""){
	if($size > 1048576){
		$size_txt=round($size/1048576,1)." <font color=red>MB</font>";
	}elseif($size > 1024){
    $size_txt=round($size/1024,1)." <font color=blue>KB</font>";
	}else{
    $size_txt=$size." <font color=gray>Bytes</font>";
	}
	return $size_txt;
}

//��r�괫���s��
function txt_to_group_name($enable_group="",$default_txt="",$syb="<br />"){
	$groups_array=get_all_groups();
	if(empty($enable_group)){
    $g_txt=$default_txt;
	}else{
	  $gs=explode(",",$enable_group);
	  $g_txt="";
	  foreach($gs as $gid){
    	$g_txt.=$groups_array[$gid]."{$syb}";
		}
	}
	return $g_txt;
}

//���o�Ҧ��s��
function get_all_groups(){
	global $xoopsDB;
	$sql = "select groupid,name from ".$xoopsDB->prefix("groups")."";
	$result = $xoopsDB->query($sql);
	while(list($groupid,$name)=$xoopsDB->fetchRow($result)){
		$data[$groupid]=$name;
	}
	return $data;
}

/*
//�P�_�Y�H�b�������O�����o���v�Q
function chk_cate_post_power($kind="post"){
	global $xoopsDB,$xoopsUser,$xoopsModule;
	if(empty($xoopsUser))return false;

  $module_id = $xoopsModule->getVar('mid');
  $isAdmin=$xoopsUser->isAdmin($module_id);
	if($isAdmin){
    $ok_cat[]="";
	}
	$user_array=$xoopsUser->getGroups();

	$col=($kind=="post")?"enable_upload_group":"enable_group";

	//�D�޲z���~�n�ˬd
	$where=($isAdmin)?"":"where $col!=''";

	$sql = "select csn,{$col} from ".$xoopsDB->prefix("tad_gallery_cate")." $where";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	while(list($ncsn,$power)=$xoopsDB->fetchRow($result)){
	  if($isAdmin){
      $ok_cat[]=$ncsn;
		}else{
			$power_array=explode(",",$power);
			foreach($power_array as $gid){
				if(in_array($gid,$user_array)){
					$ok_cat[]=$ncsn;
					break;
				}
			}
		}
	}
	return $ok_cat;
}
*/
//�P�_�Y�H�b�������O�����[�ݩεo��(upload)���v�Q
function chk_cate_power($kind=""){
	global $xoopsDB,$xoopsUser,$xoopsModule;
	if(!empty($xoopsUser)){
	  $module_id = $xoopsModule->getVar('mid');
	  $isAdmin=$xoopsUser->isAdmin($module_id);
		if($isAdmin){
	    $ok_cat[]="0";
		}
		$user_array=$xoopsUser->getGroups();
	}else{
    $user_array=array(3);
	}

	$col=($kind=="upload")?"enable_upload_group":"enable_group";


	$sql = "select csn,{$col} from ".$xoopsDB->prefix("tad_gallery_cate")."";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	while(list($csn,$power)=$xoopsDB->fetchRow($result)){
	  if($isAdmin or empty($power)){
      $ok_cat[]=$csn;
		}else{
			$power_array=explode(",",$power);
			foreach($power_array as $gid){
				if(in_array($gid,$user_array)){
					$ok_cat[]=$csn;
					break;
				}
			}
		}
	}

	return $ok_cat;
}


//���o�����U�Կ��
function get_tad_gallery_cate_option($of_csn=0,$level=0,$v="",$chk_view=1,$chk_up=0,$this_csn="",$no_self="0"){
	global $xoopsDB,$xoopsUser,$xoopsModule;

	if ($xoopsUser) {
    $module_id = $xoopsModule->getVar('mid');
    $isAdmin=$xoopsUser->isAdmin($module_id);
  }else{
    $isAdmin=false;
	}
	
	$sql = "select count(*),csn from ".$xoopsDB->prefix("tad_gallery")." group by csn";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while(list($count,$csn)=$xoopsDB->fetchRow($result)){
	  $cate_count[$csn]=$count;
	}
	
	//$left=$level*10;
	$level+=1;
	
	$syb=str_repeat("-", $level)." ";
	
	$option=($of_csn)?"":"<option value='0'>"._MA_TADGAL_CATE_SELECT."</option>";
	$sql = "select csn,title from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$of_csn}' order by sort";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());

	if($chk_view)$ok_cat=chk_cate_power();
	if($chk_up)$ok_up_cat=chk_cate_power("upload");
	
	while(list($csn,$title)=$xoopsDB->fetchRow($result)){
	  if($chk_view){
			if(!in_array($csn,$ok_cat)){
			  continue;
			}
		}
	  if($chk_up){
			if(!in_array($csn,$ok_up_cat)){
			  continue;
			}
		}
		if($no_self=='1' and $this_csn==$csn)continue;
		$selected=($v==$csn)?"selected":"";
		$count=(empty($cate_count[$csn]))?0:$cate_count[$csn];
		$option.="<option value='{$csn}' $selected>{$syb}{$title}({$count})</option>";
		$option.=get_tad_gallery_cate_option($csn,$level,$v,$chk_view,$chk_up,$this_csn,$no_self);
	}
	return $option;
}



//��h���}�C�ܦ��r��
function implodeArray2D ($sep="", $array="",$pre=""){
		$array1=array("IFD0","SubIFD","IFD1","InteroperabilityIFD","IFD1Offset");
    $str = "";
    foreach ($array as $k=>$v){
			if(is_array($v)){
			  if(!in_array($k,$array1))continue;
        $str.=implodeArray2D ($sep, $v ,"[$k]");
			}else{
			  $k=addslashes($k);
			  $v=addslashes($v);
			  if($k=="JFIF")continue;
        $str.= "{$pre}[$k]={$v}{$sep}";
			}
    }
    return $str;
}


//�H�y�������o�Y��tad_gallery���
function get_tad_gallery($sn=""){
	global $xoopsDB;
	if(empty($sn))return;
	$sql = "select * from ".$xoopsDB->prefix("tad_gallery")." where sn='$sn'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$data=$xoopsDB->fetchArray($result);
	return $data;
}


//�۰ʨ��o�Y�����U�̤j���Ƨ�
function auto_get_csn_sort($csn=""){
	global $xoopsDB;
	$sql = "select max(`sort`) from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$csn}' group by of_csn";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	list($max_sort)=$xoopsDB->fetchRow($result);
	
	return ++$max_sort;
}


//�s�W��ƨ�tad_gallery_cate��
function add_tad_gallery_cate($csn="",$new_csn=""){
	global $xoopsDB,$xoopsUser;
	if(empty($new_csn))return;
	$upload_powers=chk_cate_power("upload");
	//�����z��
	if(!in_array($csn,$upload_powers)){
     redirect_header($_SERVER['PHP_SELF'],3, _TADGAL_NO_UPLOAD_POWER);
	}
	
	if(empty($_POST['enable_group'])){
    $enable_group="";
	}else{
		$enable_group=implode(",",$_POST['enable_group']);
	}
	
	if(empty($_POST['enable_upload_group'])){
    $enable_upload_group="1";
	}else{
		$enable_upload_group=implode(",",$_POST['enable_upload_group']);
	}
	
	$sort=(empty($_POST['sort']))?auto_get_csn_sort():$_POST['sort'];
	$uid=$xoopsUser->getVar('uid');
	
	$sql = "insert into ".$xoopsDB->prefix("tad_gallery_cate")." (of_csn,title,enable_group,enable_upload_group,mode,sort,uid) values('{$csn}','{$new_csn}','{$enable_group}','{$enable_upload_group}','{$_POST['mode']}','$sort','{$uid}')";
	$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	//���o�̫�s�W��ƪ��y���s��
	$csn=$xoopsDB->getInsertId();
	return $csn;
}


//���otad_gallery_cate�Ҧ���ư}�C
function get_tad_gallery_cate_all(){
	global $xoopsDB;
	$sql = "select csn,title from ".$xoopsDB->prefix("tad_gallery_cate");
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while(list($csn,$title)=$xoopsDB->fetchRow($result)){
    $data[$csn]=$title;
	}
	return $data;
}

//�H�y�������o�Y��tad_gallery_cate���
function get_tad_gallery_cate($csn=""){
	global $xoopsDB;
	if(empty($csn))return;
	$sql = "select * from ".$xoopsDB->prefix("tad_gallery_cate")." where csn='$csn'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$data=$xoopsDB->fetchArray($result);
	return $data;
}

//�إߥؿ�
function mk_dir($dir=""){
    //�Y�L�ؿ��W�٨q�Xĵ�i�T��
    if(empty($dir))redirect_header("index.php", 3,_MA_MKDIR_NO_DIRNAME);
    //�Y�ؿ����s�b���ܫإߥؿ�
    if (!is_dir($dir)) {
        umask(000);
        //�Y�إߥ��Ѩq�Xĵ�i�T��
        if(!mkdir($dir, 0777)){
            redirect_header("index.php", 3,sprintf(_MA_MKDIR_ERROR,$dir));
        }
    }
}


//��X��UTF8
function to_utf8($buffer=""){
	if(is_utf8($buffer)){
		return $buffer;
	}else{
  	$buffer=(!function_exists("mb_convert_encoding"))?iconv("Big5","UTF-8",$buffer):mb_convert_encoding($buffer,"UTF-8","Big5");
  	return $buffer;
	}
}

if(!function_exists("is_utf8")){
	//�P�_�r��O�_��utf8
	function  is_utf8($str)  {
	    $i=0;
	    $len  =  strlen($str);

	    for($i=0;$i<$len;$i++)  {
	        $sbit  =  ord(substr($str,$i,1));
	        if($sbit  <  128)  {
	            //���r�`���^��r�šA���P�z�|
	        }elseif($sbit  >  191  &&  $sbit  <  224)  {
	            //�Ĥ@�r�`������192~223��utf8������r(��ܸӤ��嬰��2�Ӧr�`�Ҳզ�utf8����r)�A��U�@�Ӥ���r
	            $i++;
	        }elseif($sbit  >  223  &&  $sbit  <  240)  {
	            //�Ĥ@�r�`������223~239��utf8������r(��ܸӤ��嬰��3�Ӧr�`�Ҳզ���utf8����r)�A��U�@�Ӥ���r
	            $i+=2;
	        }elseif($sbit  >  239  &&  $sbit  <  248)  {
	            //�Ĥ@�r�`������240~247��utf8������r(��ܸӤ��嬰��4�Ӧr�`�Ҳզ���utf8����r)�A��U�@�Ӥ���r
	            $i+=3;
	        }else{
	            //�Ĥ@�r�`���D��utf8������r
	            return  0;
	        }
	    }
	    //�ˬd����Ӧr�곣�S����A�N��o�Ӧr��Outf8����r
	    return  1;
	}
}

/********************* �Ϥ���� *********************/
//�Ϥ���m�ΦW��
function photo_name($sn="",$kind="",$local="1"){
  global $xoopsDB;
  
	$sql = "select filename,dir from ".$xoopsDB->prefix("tad_gallery")." where sn='{$sn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	list($filename,$dir)=$xoopsDB->fetchRow($result);

	$place=($local)?_TADGAL_UP_FILE_DIR:_TADGAL_UP_FILE_URL;
	
	if($kind=="m"){
		$k="m_";
		$place.="medium/";
	}elseif($kind=="s"){
		$k="s_";
		$place.="small/";
	}else{
		$k="";
	}
	$photo_name="{$place}{$dir}/{$sn}_{$k}{$filename}";
	return $photo_name;
}

//�[�J�B���L(209x27)
function add_pic_mark($filename="",$newname="",$type="image/jpeg",$mark=""){


	// Load
	if($type=="image/jpeg" or $type=="image/jpg" or $type=="image/pjpg" or $type=="image/pjpeg"){
		$source = imagecreatefromjpeg($filename);
		$type="image/jpeg";
	}elseif($type=="image/png"){
		$source = imagecreatefrompng($filename);
		$type="image/png";
	}elseif($type=="image/gif"){
		$source = imagecreatefromgif($filename);
		$type="image/gif";
	}
	// Content type
 	header('Content-type: '.$type);

	if(!empty($mark)){
		// Get new sizes
		list($width, $height) = getimagesize($filename);

		//$x=round($width/3,0);
		//$y=round($height/2,0);

		$x=round($width-230,0);
		$y=round($height-30,0);

		//�]�w��r�C��
		$color = imagecolorallocatealpha($source,255,255,255,95);

		//�ഫ��r
		//$content=iconv("big5","utf-8",$mark);
    $content=$mark;

		//ø�s�D���D��r
		$font=XOOPS_ROOT_PATH."/modules/pollution/wt011.ttf";
		imagettftext($source,20,0,$x,$y, $color, $font, $content);
	}

	// Output
	if($type=="image/jpeg" or $type=="image/jpg" or $type=="image/pjpg" or $type=="image/pjpeg"){
		imagejpeg($source,$newname,95);
	}elseif($type=="image/png"){
		imagepng($source,$newname);
	}elseif($type=="image/gif"){
		imagegif($source,$newname);
	}
	return true;
}


//���Y��
function thumbnail($filename="",$thumb_name="",$type="image/jpeg",$width="160"){

	set_time_limit(0);
	ini_set('memory_limit', '100M');
	// Get new sizes
	list($old_width, $old_height) = getimagesize($filename);

	//�ˬd�O�_�O180�ת��ۤ�
	$pic180=(($old_width/$old_height) > 2 and ($old_width/$width) > 2 )?true:false;

	if($pic180){
    $height=$width * 0.75;
    $percent = round($height/$old_height,2);
    
    $newwidth = round($old_width * $percent,0);
    $newheight = round($old_height * $percent,0);
	}else{
		$percent=($old_width>$old_height)?round($width/$old_width,2):round($width/$old_height,2);

		$newwidth = ($old_width>$old_height)?$width:round($old_width * $percent,0);
		$newheight = ($old_width>$old_height)?round($old_height * $percent,0):$width;
	}
	
	
	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	if($type=="image/jpeg" or $type=="image/jpg" or $type=="image/pjpg" or $type=="image/pjpeg"){
		$source = imagecreatefromjpeg($filename);
		$type="image/jpeg";
	}elseif($type=="image/png"){
		$source = imagecreatefrompng($filename);
		$type="image/png";
	}elseif($type=="image/gif"){
		$source = imagecreatefromgif($filename);
		$type="image/gif";
	}else{
		die($type);
	}

	// Resize
	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $old_width, $old_height);


	// Output
	if($type=="image/jpeg"){
		imagejpeg($thumb,$thumb_name,90);
	}elseif($type=="image/png"){
		imagepng($thumb,$thumb_name);
	}elseif($type=="image/gif"){
		imagegif($thumb,$thumb_name);
	}
	imagedestroy($source);
	imagedestroy($thumb);
}


//�ꨤ��r��
function pic_3d($width=150,$height=150,$main=""){
	$width+=22;
	$height+=22;
	$main="
	<div class='pic_corners' style='width:{$width}px;height:{$height}px;display:inline;float:left'>
	<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
	<div class='boxcontent'>
 	$main
	</div>
	<b class='b4b'></b><b class='b3b'></b><b class='b2b'></b><b class='b1b'></b>
	</div>";
	return $main;
}

/********************* �w�]��� *********************/
//�ꨤ��r��
function div_3d($title="",$main="",$kind="raised",$style=""){
	$main="<table style='width:auto;{$style}'><tr><td>
	<div class='{$kind}'>
	<h1>$title</h1>
	<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
	<div class='boxcontent'>
 	$main
	</div>
	<b class='b4b'></b><b class='b3b'></b><b class='b2b'></b><b class='b1b'></b>
	</div>
	</td></tr></table>";
	return $main;
}



//�޲z���������
function menu_interface($show=1){
global $xoopsModule,$xoopsModuleConfig;
	if(empty($show))return;
	$dirname=$xoopsModule->getVar('dirname');
	include_once("".XOOPS_ROOT_PATH."/modules/{$dirname}/language/tchinese/modinfo.php");
	include("menu.php");
	$page=explode("/",$_SERVER['PHP_SELF']);
	$n=sizeof($page)-1;
	if(is_array($adminmenu)){
		foreach($adminmenu as $m){
			$td.="<a href='".XOOPS_URL."/modules/{$dirname}/{$m['link']}'>{$m['title']}</a>";
		}
	}else{
		$td="<td></td>";
	}
	$main="
	<style type='text/css'>
	#admtool{
		margin-bottom:10px;
	}
	#admtool a:link, #admtool a:visited {
		font-size: 12px;
		background-image: url(".XOOPS_URL."/modules/{$dirname}/images/bbg.jpg);
		margin-right: 0px;
		padding: 3px 10px 2px 10px;
		color: rgb(80,80,80);
		background-color: #FCE6EA;
		text-decoration: none;
		border-top: 1px solid #FFFFFF;
		border-left: 1px solid #FFFFFF;
		border-bottom: 1px solid #717171;
		border-right: 1px solid #717171;
	}
	#admtool a:hover {
		background-image: url(".XOOPS_URL."/modules/{$dirname}/images/bbg2.jpg);
		color: rgb(255,0,128);
		border-top: 1px solid #717171;
		border-left: 1px solid #717171;
		border-bottom: 1px solid #FFFFFF;
		border-right: 1px solid #FFFFFF;
	}
	</style>
	<div id='admtool'>{$td}<a href='".XOOPS_URL."/modules/{$dirname}/'>"._BACK_MODULES_PAGE."</a>
	</div>";
	return $main;
}

//�������s���u��
function toolbar($interface_menu=array()){
	global $xoopsModule,$xoopsModuleConfig,$xoopsUser;
	if(empty($interface_menu))return;
	$dirname=$xoopsModule->getVar('dirname');
	$moduleperm_handler = & xoops_gethandler( 'groupperm' );
	//�P�_�O�_���޲z�v��
	if ( $xoopsUser) {
		if ($moduleperm_handler->checkRight( 'module_admin', $xoopsModule->getVar( 'mid' ), $xoopsUser->getGroups() ) ) {
			$admin_tools="<a href='".XOOPS_URL."/modules/{$dirname}/admin/index.php'>"._TO_ADMIN_PAGE."</a>";
		}
	}
	if(is_array($interface_menu)){
		foreach($interface_menu as $title => $url){
			$td.="<a href='".XOOPS_URL."/modules/{$dirname}/{$url}'>{$title}</a>";
		}
	}else{
		return;
	}
	$main="
	<style type='text/css'>
	#toolbar{
		margin-bottom:10px;
	}
	#toolbar a:link, #toolbar a:visited {
		font-size: 11px;
		background-image: url(".XOOPS_URL."/modules/{$dirname}/images/bbg.jpg);
		margin-right: 0px;
		padding: 3px 10px 2px 10px;
		color: rgb(80,80,80);
		background-color: #FCE6EA;
		text-decoration: none;
		border-top: 1px solid #FFFFFF;
		border-left: 1px solid #FFFFFF;
		border-bottom: 1px solid #717171;
		border-right: 1px solid #717171;
	}
	#toolbar a:hover {
		background-image: url(".XOOPS_URL."/modules/{$dirname}/images/bbg2.jpg);
		color: rgb(255,0,128);
		border-top: 1px solid #717171;
		border-left: 1px solid #717171;
		border-bottom: 1px solid #FFFFFF;
		border-right: 1px solid #FFFFFF;
	}
	</style>
	<div id='toolbar'>{$td}{$admin_tools}</div>";
	return $main;
}

//���^�_��l��ƨ��
function chk($DBV="",$NEED_V="",$defaul="",$return="checked"){
	if($DBV==$NEED_V){
		return $return;
	}elseif(empty($DBV) && $defaul=='1'){
		return $return;
	}
	return "";
}

//�ƿ�^�_��l��ƨ��
function chk2($defaul_array="",$NEED_V="",$defaul=1){
	if(in_array($NEED_V,$the_array)){
		return "checked";
	}elseif($defaul){
		return "checked";
	}

	return "";
}


//�ӳ��v���P�_
function power_chk($perm_name="",$psn=""){
	global $xoopsUser,$xoopsModule;

	//���o�ثe�ϥΪ̪��s�սs��
	if($xoopsUser) {
		$groups = $xoopsUser->getGroups();
	}else{
		$groups = XOOPS_GROUP_ANONYMOUS;
	}

	//���o�Ҳսs��
	$module_id = $xoopsModule->getVar('mid');
	//���o�s���v���\��
	$gperm_handler =& xoops_gethandler('groupperm');

	//�v�����ؽs��
	$perm_itemid = intval($psn);
	//�̾ڸӸs�լO�_����v�����ئ��ϥ��v���P�_ �A�����P���B�z
	if($gperm_handler->checkRight($perm_name, $perm_itemid, $groups, $module_id)) {
		return true;
	}
	return false;
}

//���P�_
function is_checked($v1="",$v2="",$default=""){
	if(isset($v1) and $v1==$v2){
		return "checked";
	}elseif($default=="default"){
		return "checked";
	}
}



//��������
class PageBar{
	// �ثe�Ҧb���X
	var $current;
	// �Ҧ�����Ƽƶq (rows)
	var $total;
	// �C����ܴX�����
	var $limit;
	// �ثe�b�ĴX�h�����ƿﶵ�H
	var $pCurrent;
	// �`�@�����X���H
	var $pTotal;
	// �C�@�h�̦h���X�ӭ��ƿﶵ�i�ѿ�ܡA�p�G3 = {[1][2][3]}
	var $pLimit;
	var $prev;
	var $next;
	var $prev_layer = ' ';
	var $next_layer = ' ';
	var $first;
	var $last;
	var $bottons = array();
	// �n�ϥΪ� URL ���ưѼƦW�H
	var $url_page = "g2p";
	// �n�ϥΪ� URL Ū���ɶ��ѼƦW�H
	var $url_loadtime = "loadtime";
	// �|�ϥΨ쪺 URL �ܼƦW�A�� process_query() �L�o�Ϊ��C
	var $used_query = array();
	// �ثe�����C��
	var $act_color = "#990000";
	var $query_str; // �s�� URL �ѼƦC

	function PageBar($total, $limit, $page_limit){
		$mydirname = basename( dirname( __FILE__ ) ) ;
		$this->prev = "<img src='".XOOPS_URL."/modules/{$mydirname}/images/1leftarrow.gif' alt='"._BP_BACK_PAGE."' align='absmiddle' hspace=3>"._BP_BACK_PAGE;
		$this->next = "<img src='".XOOPS_URL."/modules/{$mydirname}/images/1rightarrow.gif' alt='"._BP_NEXT_PAGE."' align='absmiddle' hspace=3>"._BP_NEXT_PAGE;
		$this->first = "<img src='".XOOPS_URL."/modules/{$mydirname}/images/2leftarrow.gif' alt='"._BP_FIRST_PAGE."' align='absmiddle' hspace=3>"._BP_FIRST_PAGE;
		$this->last = "<img src='".XOOPS_URL."/modules/{$mydirname}/images/2rightarrow.gif' alt='"._BP_LAST_PAGE."' align='absmiddle' hspace=3>"._BP_LAST_PAGE;

		$this->limit = $limit;
		$this->total = $total;
		$this->pLimit = $page_limit;
	}

	function init(){
		$this->used_query = array($this->url_page, $this->url_loadtime);
		$this->query_str = $this->processQuery($this->used_query);
		$this->glue = ($this->query_str == "")?'?':
		'&';
		$this->current = (isset($_GET["$this->url_page"]))? $_GET["$this->url_page"]:
		1;
		$this->pTotal = ceil($this->total / $this->limit);
		$this->pCurrent = ceil($this->current / $this->pLimit);
	}

	//��l�]�w
	function set($active_color = "none", $buttons = "none"){
		if ($active_color != "none"){
			$this->act_color = $active_color;
		}

		if ($buttons != "none"){
			$this->buttons = $buttons;
			$this->prev = $this->buttons['prev'];
			$this->next = $this->buttons['next'];
			$this->prev_layer = $this->buttons['prev_layer'];
			$this->next_layer = $this->buttons['next_layer'];
			$this->first = $this->buttons['first'];
			$this->last = $this->buttons['last'];
		}
	}

	// �B�z URL ���ѼơA�L�o�|�ϥΨ쪺�ܼƦW��
	function processQuery($used_query){
		// �N URL �r��������G���}�C
		$vars = explode("&", $_SERVER['QUERY_STRING']);
		for($i = 0; $i < count($vars); $i++){
			$var[$i] = explode("=", $vars[$i]);
		}

		// �L�o�n�ϥΪ� URL �ܼƦW��
		for($i = 0; $i < count($var); $i++){
			for($j = 0; $j < count($used_query); $j++){
				if (isset($var[$i][0]) && $var[$i][0] == $used_query[$j]) $var[$i] = array();
			}
		}

		// �X���ܼƦW�P�ܼƭ�
		for($i = 0; $i < count($var); $i++){
			$vars[$i] = implode("=", $var[$i]);
		}

		// �X�֬��@���㪺 URL �r��
		$processed_query = "";
		for($i = 0; $i < count($vars); $i++){
			$glue = ($processed_query == "")?'?':
			'&';
			// �}�Y�Ĥ@�ӬO '?' ��l���~�O '&'
			if ($vars[$i] != "") $processed_query .= $glue.$vars[$i];
		}
		return $processed_query;
	}

	// �s�@ sql �� query �r�� (LIMIT)
	function sqlQuery(){
		$row_start = ($this->current * $this->limit) - $this->limit;
		$sql_query = " LIMIT {$row_start}, {$this->limit}";
		return $sql_query;
	}


	// �s�@ bar
	function makeBar($url_page = "none"){
		if ($url_page != "none"){
			$this->url_page = $url_page;
		}
		$this->init();

		// ���o�ثe�ɶ�
		$loadtime = '&loadtime='.time();

		// ���o�ثe����(�h)���Ĥ@�ӭ��Ʊҩl�ȡA�p 6 7 8 9 10 = 6
		$i = ($this->pCurrent * $this->pLimit) - ($this->pLimit - 1);

		$bar_center = "";
		while ($i <= $this->pTotal && $i <= ($this->pCurrent * $this->pLimit)){
			if ($i == $this->current){
				$bar_center = "{$bar_center}<font color='{$this->act_color}'>[{$i}]</font>";
			}else{
				$bar_center .= " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}={$i}{$loadtime}'' title='{$i}'>{$i}</a> ";
			}
			$i++;
		}
		$bar_center = $bar_center . "";

		// ���e���@��
		if ($this->current <= 1){
			$bar_left = " {$this->prev} ";
			$bar_first = " {$this->first} ";
		}	else{
			$i = $this->current-1;
			$bar_left = " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}={$i}{$loadtime}' title='"._BP_BACK_PAGE."'>{$this->prev}</a> ";
			$bar_first = " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}=1{$loadtime}' title='"._BP_FIRST_PAGE."'>{$this->first}</a> ";
		}

		// ������@��
		if ($this->current >= $this->pTotal){
			$bar_right = " {$this->next} ";
			$bar_last = " {$this->last} ";
		}	else{
			$i = $this->current + 1;
			$bar_right = " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}={$i}{$loadtime}' title='"._BP_NEXT_PAGE."'>{$this->next}</a> ";
			$bar_last = " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}={$this->pTotal}{$loadtime}' title='"._BP_LAST_PAGE."'>{$this->last}</a> ";
		}

		// ���e���@��ӭ���(�h)
		if (($this->current - $this->pLimit) < 1){
			$bar_l = " {$this->prev_layer} ";
		}	else{
			$i = $this->current - $this->pLimit;
			$bar_l = " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}={$i}{$loadtime}' title='".sprintf($this->pLimit,_BP_GO_BACK_PAGE)."'>{$this->prev_layer}</a> ";
		}

		//������@��ӭ���(�h)
		if (($this->current + $this->pLimit) > $this->pTotal){
			$bar_r = " {$this->next_layer} ";
		}	else{
			$i = $this->current + $this->pLimit;
			$bar_r = " <a href='{$_SERVER['PHP_SELF']}{$this->query_str}{$this->glue}{$this->url_page}={$i}{$loadtime}' title='".sprintf($this->pLimit,_BP_GO_NEXT_PAGE)."'>{$this->next_layer}</a> ";
		}

		$page_bar['center'] = $bar_center;
		$page_bar['left'] = $bar_first . $bar_l . $bar_left;
		$page_bar['right'] = $bar_right . $bar_r . $bar_last;
		$page_bar['current'] = $this->current;
		$page_bar['total'] = $this->pTotal;
		$page_bar['sql'] = $this->sqlQuery();
		return $page_bar;
	}

}

?>
