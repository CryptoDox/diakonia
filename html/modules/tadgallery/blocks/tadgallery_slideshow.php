<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2008-03-23
// $Id: tadgallery_show.php,v 1.7 2008/05/14 01:23:14 tad Exp $
// ------------------------------------------------------------------------- //


//�϶��D�禡 (Flash�ۤ��i��)
function tadgallery_slideshow($options){
	global $xoopsDB;
	
	if(!file_exists(XOOPS_ROOT_PATH."/uploads/tadgallery/gallery_{$options[1]}.xml") or $options[4]=="true"){

		$sql = "select a.sn,a.title,a.description,a.post_date,a.filename,a.dir,b.title from ".$xoopsDB->prefix("tad_gallery")." as a left join  ".$xoopsDB->prefix("tad_gallery_cate")." as b on a.csn=b.csn where b.passwd='' and b.enable_group='' and a.csn='{$options[1]}' order by a.post_date";

		$result = $xoopsDB->query($sql);


		while(list($sn,$title,$description,$post_date,$filename,$dir,$album_title)=$xoopsDB->fetchRow($result)){
		  $pic_url=str_replace(XOOPS_URL."/uploads/tadgallery/medium/","",get_pic_url($dir,$sn,$filename,"m"));
		  $pic_s_url=str_replace(XOOPS_URL."/uploads/tadgallery/small/","",get_pic_url($dir,$sn,$filename,"s"));
		  $title=(empty($title))?$album_title:$title;
		  $description=(empty($description))?"$dir/$filename":$description;

			$images.="
			<image title=\"{$title}\" date=\"{$post_date}\" thumbnail=\"{$pic_s_url}\" image=\"{$pic_url}\" link=\"".XOOPS_URL."/modules/tadgallery/view.php?sn={$sn}\">{$description}</image>";
			$at="<album title=\"{$album_title}\" description=\"{$album_title}\">";
		}
		
    $album="$at
		$images
		</album>";

		//�s�@ dl.php ���e
		//urlencode(to_utf8($options[0])) Big5�i�H
		//$options[0] Big5�i�H
		
		if(!empty($options[0])){
			$mp3=is_utf8(_MB_TADGAL_BLOCK_MP3)?$options[0]:urlencode(to_utf8($options[0]));
		}else{
			$mp3="";
		}
		
		$contents = file_get_contents(XOOPS_ROOT_PATH."/modules/tadgallery/gallery.xml");
		$contents=str_replace("[web_title]","DFGallery",$contents);
		$contents=str_replace("[xoops_url]",XOOPS_URL,$contents);
		$contents=str_replace("[mp3]",$mp3,$contents);
		$contents=str_replace("[album]",to_utf8($album),$contents);
		//�g�J���e
		$handle = fopen(XOOPS_ROOT_PATH."/uploads/tadgallery/gallery_{$options[1]}.xml", 'w');
		fwrite($handle, $contents);
		fclose($handle);
	}

	$block['sn']=$options[1];
	$block['width']=$options[2];
	$block['height']=$options[3];
	return $block;
}



//�϶��s��禡
function tadgallery_slideshow_edit($options){
	$cate_select=get_tad_gallery_block_cate_option(0,0,$options[1]);
  $is_utf8=is_utf8(_MB_TADGAL_BLOCK_MP3);
  $list="<select name='options[0]'>
	<option value=''>"._MB_TADGAL_BLOCK_NO_MP3."</option>
	";
  if ($dh = opendir(XOOPS_ROOT_PATH."/uploads/tadgallery/mp3/")) {
    $i=0;
    while (($file = readdir($dh)) !== false) {
      if(substr($file,0,1)==".")continue;
      $selected=($options[0]==$file)?"selected":"";
      $file=($is_utf8)?to_utf8($file):$file;
      $list.="<option value='{$file}' $selected>$file</option>\n";
			$i++;
    }
    closedir($dh);
  }
  $list.="</select>";


	$form="
	"._MB_TADGAL_BLOCK_MP3."
	{$list}"._MB_TADGAL_BLOCK_MP3_txt."<br>
	"._MB_TADGAL_BLOCK_SHOWCATE."
	<select name='options[1]'>
		$cate_select
	</select>"._MB_TADGAL_BLOCK_CATE_TXT."<br>
	"._MB_TADGAL_BLOCK_WIDTH."
	<INPUT type='text' name='options[2]' value='{$options[2]}' size=3> x
	"._MB_TADGAL_BLOCK_HEIGHT."
	<INPUT type='text' name='options[3]' value='{$options[3]}' size=3> px<br>
	
	<INPUT type='checkbox' name='options[4]' value='true' $checked>"._MB_TADGAL_BLOCK_MK_XML."
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

if(!function_exists("to_utf8")){
	function to_utf8($buffer=""){
		if(is_utf8($buffer)){
			return $buffer;
		}else{
	  	$buffer=(!function_exists("mb_convert_encoding"))?iconv("Big5","UTF-8",$buffer):mb_convert_encoding($buffer,"UTF-8","Big5");
	  	return $buffer;
		}
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

		$option="";
		$sql = "select csn,title from ".$xoopsDB->prefix("tad_gallery_cate")." where of_csn='{$of_csn}' and passwd='' and enable_group='' order by sort";
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

//PHP 4.2.x Compatibility function
if (!function_exists('file_get_contents')) {
    function file_get_contents($filename, $incpath = false, $resource_context = null)
    {
        if (false === $fh = fopen($filename, 'rb', $incpath)) {
            trigger_error('file_get_contents() failed to open stream: No such file or directory', E_USER_WARNING);
            return false;
        }

        clearstatcache();
        if ($fsize = @filesize($filename)) {
            $data = fread($fh, $fsize);
        } else {
            $data = '';
            while (!feof($fh)) {
                $data .= fread($fh, 8192);
            }
        }

        fclose($fh);
        return $data;
    }
}
?>