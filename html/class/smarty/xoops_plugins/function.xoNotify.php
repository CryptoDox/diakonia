<?php



function smarty_function_xoNotify( $params, &$smarty ) {
	global $xoops,$xoopsUser,$xoopsConfig, $HTTP_COOKIE_VARS, $xoopsModule;

	extract( $params );

$notif_handler =& xoops_getModuleHandler('tdmnotify_notif', 'TDMNotify');
$form_handler =& xoops_getModuleHandler('tdmnotify_form', 'TDMNotify');
$block_handler =& xoops_getModuleHandler('tdmnotify_block', 'TDMNotify');

$modhandler = &xoops_gethandler('module');
$xoopsModule = &$modhandler->getByDirname("TDMNotify");
$gperm_handler =& xoops_gethandler('groupperm');
$myts =& MyTextSanitizer::getInstance();

//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}

 //inlude les langues //
 if( file_exists(XOOPS_ROOT_PATH. "/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language']."/main.php") ) {
	include(XOOPS_ROOT_PATH. "/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language']."/main.php");
} else {
	include(XOOPS_ROOT_PATH ."/modules/".$xoopsModule->dirname()."/language/english/main.php");
}
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");


$style = isset($params['style']) ? $params['style'] : 'cupertino';

//include style
echo "<link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/css/".$style."/jquery-ui-1.7.2.custom.css'/>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-ui-1.7.2.custom.min.js'></script>
";
  
$mes = "";


global $xoopsDB;
$member_handler =& xoops_gethandler('member');

//trouve le block
$default = isset($params['default']) ? $params['default'] : '0';
$page = isset($params['page']) ? $params['page'] : '0';
$block = $block_handler->get($default);

if (is_object($block)) {

if ($gperm_handler->checkRight('notify_view', $block->getVar('id'), $groups, $xoopsModule->getVar('mid')))
{
//creation de jquery
echo '
	<style type="text/css">
		.tdmnotif label, .tdmnotif input { display:block; }
		.tdmnotif input.text { margin-bottom:12px; width:95%; padding: .4em; }
		.tdmnotif fieldset { padding:0; border:0; margin-top:25px; }
		.tdmnotif h1 { font-size: 1.2em; margin: .6em 0; }
		.tdmnotif .ui-button { outline: 0; margin:0; padding: .4em 1em .5em; text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; }
		.tdmnotif .ui-dialog .ui-state-highlight, .ui-dialog .ui-state-error { padding: .3em;  }
		
		
	</style>
	
	<script type="text/javascript">
	$(function() {
	
	var MonTableau = new Array();
	
		  $("#form_block'.$block->getVar('id').'_'.$page.' input:text, #form_block'.$block->getVar('id').'_'.$page.' input:radio, #form_block'.$block->getVar('id').'_'.$page.' input:checkbox, #form_block'.$block->getVar('id').'_'.$page.' textarea, #form_block'.$block->getVar('id').'_'.$page.' select").each(function(i){
				MonTableau[i] = new Array($(this).attr("name"), $(this).attr("value"));
						});
	
		$("#notify_'.$block->getVar('id').'_'.$page.'").dialog({
			bgiframe: true,
			autoOpen: false,
			height: 300,
			modal: true,
			overlay: {
				backgroundColor: "#000",
				opacity: 0.5
			},
			buttons: {
				"OK": function() {					
			$.ajax({
			type: "POST",
			url: "'.XOOPS_URL.'/modules/TDMNotify/include/jquery.php",
			 data: "op=save&block="+$("#block").attr("value")+"&url="+location.href+"&form="+MonTableau,
	
		success: function(msg){
		alert(msg);
	}
     });
	 $(this).dialog("close");
					
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
	});
		
	function WhoBlock(page)
	{
	$("#notify_'.$block->getVar('id').'_"+page).dialog("open");
	}
	</script>
	
	<div class="tdmnotif"  style="display: none;" id="notify_'.$block->getVar('id').'_'.$page.'" title="'.$block->getVar('title').'">
	<p id="validateTips">'.$block->getVar('text').'</p>';
	
$obj = $block_handler->get($block->getVar('id'));
$form = $obj->getElement($page, $params['var']);
echo "<fieldset>";
$form->display();
echo "</fieldset>";

echo '</div>';


switch($block->getVar('style')) {
 
   case "text": 
    $mes .= "<a href='javascript:;' onclick='WhoBlock(".$page.")' alt='".$block->getVar('alt')."'>".$block->getVar('title')."</a>";	
    break;

	case "img": 
			//on test l'existance de l'image
			$img = $block->getVar("img") ? $block->getVar("img") : 'blank.png';
			$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/".$img;
			if (file_exists($imgpath)) {
			$album_img = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/".$block->getVar("img");
			} else {
			$album_img = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/blank.png";
			}
			
$mes .= "<a href='javascript:;' onclick='WhoBlock(".$page.")' alt='".$block->getVar('alt')."'><img src='".$album_img."' title='".$block->getVar('title')."' alt='".$block->getVar('alt')."'></a>";
	
 break;
 
 	case "button": 
$mes .= "<a href='javascript:;' onclick='WhoBlock(".$page.")'><input type='button' class='formbutton' alt='".$block->getVar('alt')."' value='".$block->getVar('title')."'></a>";
 
 break;
 
 }	
	echo $mes;
	
	}
	
	}
	
	}
	
?>