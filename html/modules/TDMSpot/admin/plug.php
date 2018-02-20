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
Adminmenu(3, _AM_SPOT_MANAGE_PLUG);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (3, _AM_SPOT_MANAGE_PLUG);
}


$page_handler =& xoops_getModuleHandler('tdmspot_page', 'TDMSpot');
$block_handler =& xoops_getModuleHandler('tdmspot_newblocks', 'TDMSpot');

$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
$tdmspot_style = isset($_REQUEST['tdmspot_style']) ? $_REQUEST['tdmspot_style'] : 'cupertino';

echo "<link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/css/".$tdmspot_style."/jquery-ui-1.7.2.custom.css'/>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-ui-1.7.2.custom.min.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery.wslide.js'></script>
";

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/plug.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;"><strong>'._AM_SPOT_MANAGE_PLUG.'</strong>';
echo '</div><br />';

 switch($op) {
  
    //sauv  
 case "save":
 
 //<{xoSpot page=3-4 default=4 display=1 style=none}>
		$plug = "<{xoSpot ";
	
 		if (isset($_REQUEST['default']) && $_REQUEST['default'] > 0) {
		$plug .= " default=".$_REQUEST['default'];
		}
		
		if ($_REQUEST['page'] && !in_array(0, $_REQUEST['page'])) {
		$plug .= " page=";
		$paging = "";
		foreach (($_REQUEST['page']) as $page) {
		$paging .= $page."-";
		}
		$plug .= substr($paging, 0, -1);
		}
		
		if (isset($_REQUEST['display']) && $_REQUEST['display'] > 0) {
		$plug .= " display=".$_REQUEST['display'];
		
		echo "<table class='outer'><tr><th align='center'>"._AM_SPOT_PLUG_DESC."</th></tr><tr>";
		
		switch ($_REQUEST['display']) {
		
		case 1:
		
		echo "<script type='text/javascript'>
		var $tdmspot = jQuery.noConflict();
		$tdmspot(document).ready( function() {
		$tdmspot('#tabs').tabs();
		});
		</script>";
		
	echo "<td align='center' class='odd'><div id='tabs'><ul><li style='list-style-type: none;'><a href='javascript:;' title='Test1'>Test1</a></li><li style='list-style-type: none;'><a href='javascript:;' title='Test2'>Test2</a></li><li style='list-style-type: none;'><a href='javascript:;' title='Test3'>Test3</a></li></ul></div></td>";

	
	break;
	
		case 2:
		
		echo "<td align='center' class='odd'><select class='class='ui-state-default' id='test' name='various' >
	<option value='Test1'>Test1</option>
	<option value='Test2'>Test2</option>
	<option value='Test3'>Test3</option>
	</select></td>";
	
	break;
	
		case 3:
		
	echo "<td align='center' class='odd'><div style='padding: 5px;' class='ui-state-default'>Test1 | Test2 | Test3</div></td>";
	
	break;
	
	case 4:
	
		echo '<script type="text/javascript">
	$(function() {
		$("#accordion").accordion();
	});
	</script>';
		
	echo "<td align='center' class='odd'><div id='accordion'><h3><a href='#'>Test1</a></h3></a><div>Test1</div><h3><a href='#'>Test2</a></h3><div>Test2</div><h3><a href='#'>Test3</a></h3><div>Test3</div></div></td>";
	
	break;
	
	case 5:
	
	echo '<script type="text/javascript">
	$(function() {
	$("#wslide").wslide({
	width: 250,
	height: 150,
	pos: 4,
	horiz: true
});
	});
	</script>';
	
	echo "<td align='center' class='odd'><div id='wslide'><ul><li style='list-style-type: none;'><a href='javascript:;' title='Test1'>Test1</a></li><li style='list-style-type: none;'><a href='javascript:;' title='Test2'>Test2</a></li><li style='list-style-type: none;'><a href='javascript:;' title='Test3'>Test3</a></li></ul></div></td>";

	$plug .= " width=250 height=150";
	
	break;
		}
		
	echo "</tr></table><br /><br />";
		}
		
		if (isset($tdmspot_style)) {
		$plug .= " style=".$tdmspot_style;
		}
		
		$plug .= "}>";
		
		

		echo "<table class='outer'><tr><th align='center'>"._AM_SPOT_PLUG_DESC."</th></tr><tr><td align='center' class='odd'><b>".$plug."</b></td></tr></table><br />";



		
		$obj =& $page_handler->create();
		$form =& $obj->getPlug();
		$form->display();
    break;
	

	
 case "list": 
  default:	
		// Affichage du formulaire de cr?ation de cat?gories
    	$obj =& $page_handler->create();
    	$form = $obj->getPlug();
    	$form->display();
    break;
	
  }
  
xoops_cp_footer();
?>