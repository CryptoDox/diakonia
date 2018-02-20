<?php
include "../../../include/cp_header.php";

if($_POST['op']=="update_tad_gallery"){
 	$sql = "update ".$xoopsDB->prefix("tad_gallery")." set `title`='{$_POST['title']}',`description`='{$_POST['description']}' where sn='{$_POST['sn']}'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],10, mysql_error());
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title></title>
<?php

$sql = "select title,description from ".$xoopsDB->prefix("tad_gallery")." where sn='{$_GET['sn']}'";
$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
list($title,$description)=$xoopsDB->fetchRow($result);

$title=to_utf8($title);
$description=to_utf8($description);

echo "
<form action='' method='post'>
<table class='form_tbl'>
<tr>
<td class='col'><input type='text' name='title' value='{$title}' style='width:100%;'></td></tr>
<tr>
<td class='col'><textarea style='width: 100%; height: 60px;' name='description'>{$description}</textarea></td></tr>
<tr><td class='bar' colspan='2'>
<input type='hidden' name='sn' value='{$_GET['sn']}'>
<input type='hidden' name='csn' value='{$_GET['csn']}'>
<input type='hidden' name='op' value='update_tad_gallery'>
<input type='submit' value='"._MA_SAVE."'></td></tr>
</table>
</form>";


//輸出為UTF8
function to_utf8($buffer=""){
	if(is_utf8($buffer)){
		return $buffer;
	}else{
  	$buffer=(!function_exists("mb_convert_encoding"))?iconv("Big5","UTF-8",$buffer):mb_convert_encoding($buffer,"UTF-8","Big5");
  	return $buffer;
	}
}


//判斷字串是否為utf8
function  is_utf8($str)  {
    $i=0;
    $len  =  strlen($str);

    for($i=0;$i<$len;$i++)  {
        $sbit  =  ord(substr($str,$i,1));
        if($sbit  <  128)  {
            //本字節為英文字符，不與理會
        }elseif($sbit  >  191  &&  $sbit  <  224)  {
            //第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)，找下一個中文字
            $i++;
        }elseif($sbit  >  223  &&  $sbit  <  240)  {
            //第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)，找下一個中文字
            $i+=2;
        }elseif($sbit  >  239  &&  $sbit  <  248)  {
            //第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)，找下一個中文字
            $i+=3;
        }else{
            //第一字節為非的utf8的中文字
            return  0;
        }
    }
    //檢查完整個字串都沒問體，代表這個字串是utf8中文字
    return  1;
}

?>
</body>
</html>
