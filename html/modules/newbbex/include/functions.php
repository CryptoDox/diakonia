<?php
function newbbex_createmeta_keywords($content)
{
	$tmp=array();
	// Search for the "Minimum keyword length"
	if(isset($_SESSION['newbbex_keywords_limit'])) {
		$limit = $_SESSION['newbbex_keywords_limit'];
	} else {
		$config_handler =& xoops_gethandler('config');
		$xoopsConfigSearch =& $config_handler->getConfigsByCat(XOOPS_CONF_SEARCH);
		$limit=$xoopsConfigSearch['keyword_min'];
		$_SESSION['newbbex_keywords_limit']=$limit;
	}
	$myts =& MyTextSanitizer::getInstance();
	$content = str_replace ('<br />', ' ', $content);
	$content= $myts->undoHtmlSpecialChars($content);
	$content= strip_tags($content);
	$content=strtolower($content);
	$search_pattern=array("&nbsp;","\t","\r\n","\r","\n",",",".","'",";",":",")","(",'"','?','!','{','}','[',']','<','>','/','+','-','_','\\','*');
	$replace_pattern=array(' ',' ',' ',' ',' ',' ',' ',' ','','','','','','','','','','','','','','','','','','','');
	$content = str_replace($search_pattern, $replace_pattern, $content);
	$keywords=explode(' ',$content);
	$keywords=array_unique($keywords);
	foreach($keywords as $keyword) {
		if(strlen($keyword)>=$limit && !is_numeric($keyword)) {
			$tmp[]=$keyword;
		}
	}
	$tmp=array_slice($tmp,0,30);	// If you want to change the limit of keywords, change this number from 30 to what you want
	if(count($tmp)>0) {
		return implode(',',$tmp);
	} else {
		if(!isset($config_handler) || !is_object($config_handler)) {
			$config_handler =& xoops_gethandler('config');
		}
		$xoopsConfigMetaFooter =& $config_handler->getConfigsByCat(XOOPS_CONF_METAFOOTER);
		return $xoopsConfigMetaFooter['meta_keywords'];
	}
}
?>