<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */

include '../../../include/cp_header.php'; 
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once("../include/functions.php");

 xoops_cp_header();
 

if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(3, _AM_NOTIFY_MANAGE_PLUG);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (3, _AM_NOTIFY_MANAGE_PLUG);
}

$notif_handler =& xoops_getModuleHandler('tdmnotify_notif', 'TDMNotify');
$form_handler =& xoops_getModuleHandler('tdmnotify_form', 'TDMNotify');
$block_handler =& xoops_getModuleHandler('tdmnotify_block', 'TDMNotify');

$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
 	//load class
$style = isset($_REQUEST['style']) ? $_REQUEST['style'] : 'cupertino';

echo "<link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/css/".$style."/jquery-ui-1.7.2.custom.css'/>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-ui-1.7.2.custom.min.js'></script>
";

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/plug.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;"><strong>'._AM_NOTIFY_MANAGE_PLUG.'</strong>';
echo '</div><br />';

 switch($op) {
  
    //sauv  
 case "save":
 
 //<{xoSpot page=3-4 default=4 display=1 style=none}>
		$plug = "<{xoNotify ";
	
 		if (isset($_REQUEST['default']) && $_REQUEST['default'] > 0) {
		$plug .= " default=".$_REQUEST['default'];
		}
		
		if (!empty($_REQUEST['page'])) {
		$plug .= " page=".$_REQUEST['page'];
		}
		
		if (isset($_REQUEST['style'])) {
		$plugstyle = substr($_REQUEST['style'], 15);	
		$plug .= " style=".$plugstyle;
		}
		
		if (!empty($_REQUEST['var'])) {	
		$plug .= " var=".$_REQUEST['var'];
		}
		
		$plug .= "}>";
		
		echo "<table class='outer'><tr><th align='center'>"._AM_NOTIFY_PLUG_DESC."</th></tr><tr><td align='center' class='odd'><b>".$plug."</b></td></tr></table><br />";

    break;
	

	
 case "list": 
  default:	
	// Affichage du formulaire de cr?ation de plug

    $form = new XoopsThemeForm(_AM_NOTIFY_ADD, 'form', $_SERVER['REQUEST_URI'], 'post', true);
	$form->setExtra('enctype="multipart/form-data"');
	
	//load block
    $page_select = new XoopsFormSelect(_AM_NOTIFY_STYLE, 'default', '');
    $page_select->addOptionArray($block_handler->getList());
	//$page_select->addOption(0, _AM_SPOT_PLUGNONE);
    $form->addElement($page_select);
//	

//id unique
$form->addElement(new XoopsFormText(_AM_NOTIFY_PAGE, 'page', 10, 10, 0), false);

	//
// style display	
	$tagchannel = array('plug.php?style=cupertino' => 'cupertino', 'plug.php?style=lightness' => 'lightness', 'plug.php?style=darkness' => 'darkness', 'plug.php?style=smoothness' => 'smoothness', 'plug.php?style=start' => 'start', 'plug.php?style=redmond' => 'redmond', 'plug.php?style=sunny' => 'sunny', 'plug.php?style=pepper' => 'pepper', 'plug.php?style=eggplant' => 'eggplant' ,
	'plug.php?style=dark-hive' => 'dark-hive', 'plug.php?style=excite' => 'excite', 'plug.php?style=vader' => 'vader', 'plug.php?style=trontastic' => 'trontastic' );
	$tagchannel_select = new XoopsFormSelect(_AM_NOTIFY_STYLEFORM, 'style', 'plug.php?style='.$style);
	//$tagchannel_select->setDescription(_AM_SPOT_PLUGSTYLE_DESC);
	$tagchannel_select->addOptionArray($tagchannel);
	$tagchannel_select->setExtra("OnChange='window.document.location=this.options[this.selectedIndex].value;'");
	$form->addElement($tagchannel_select);
	
	//var
$form->addElement(new XoopsFormText(_AM_NOTIFY_PLUGVAR, 'var', 50, 100, 0), false);

		
	$form->addElement(new XoopsFormHidden('op', 'save'));
	
	$button_tray = new XoopsFormElementTray('' ,'');
	$demo_btn = new XoopsFormButton('', 'demo', 'demo', 'demo');	
	$button_tray->addElement($demo_btn);
	$submit_btn = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
	$button_tray->addElement($submit_btn);
	$form->addElement($button_tray);

    $form->display();
		

		
	echo '
	<style type="text/css">
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; }
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#users-contain {  width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-button { outline: 0; margin:0; padding: .4em 1em .5em; text-decoration:none;  !important; cursor:pointer; position: relative; text-align: center; }
		.ui-dialog .ui-state-highlight, .ui-dialog .ui-state-error { padding: .3em;  }
		
		
	</style>
	<script type="text/javascript">
	$(function() {
		$("#dialog").dialog({
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
					$(this).dialog("close");
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	$("#demo").click(function() {
			$("#dialog").dialog("open");
		})
	</script>
	<div id="dialog" title="Demo">
	<p id="validateTips">form demo.</p>

	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" /><br />
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" /><br />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>';
		
    break;
	
	
  }
  
xoops_cp_footer();
?>