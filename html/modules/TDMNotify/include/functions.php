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
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}


function tdmsound_header()
{
global $xoopsConfig, $xoopsModule, $xoTheme, $xoopsTpl;
$myts =& MyTextSanitizer::getInstance();

if(isset($xoTheme) && is_object($xoTheme)) {
$xoTheme->addScript(XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-1.3.2.min.js");
$xoTheme->addScript(XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/AudioPlayer.js");
$xoTheme->addScript(XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-ui-1.7.1.custom.min.js");

$xoTheme->addStylesheet(XOOPS_URL."/modules/".$xoopsModule->dirname()."/css/tdmsound.css");
}else {
$mp_module_header = "<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/js/AudioPlayer.js'></script>
</script>";
$xoopsTpl->assign('xoops_module_header', $mp_module_header);
}

}


 function tdmsound_PrettySize($size)
{
    $mb = 1024 * 1024;
    if ($size > $mb)
    {
        $mysize = sprintf ("%01.2f", $size / $mb) . " Mo";
    }elseif ($size >= 1024)
    {
        $mysize = sprintf ("%01.2f", $size / 1024) . " Ko";
    }
    else
    {
        $mysize = sprintf('oc', $size);
    }
    return $mysize;
}


/**
 * admin menu
 */
 function Adminmenu ($currentoption = 0, $breadcrumb = '') {      
		
	/* Nice buttons styles */
	echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/TDMSpot/images/deco/bg.png') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/TDMSpot/images/decos/left_both.png') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/TDMSpot/images/decos/right_both.png') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#buttonbar a span {float:none;}
		/* End IE5-Mac hack */
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
	
	global $xoopsModule, $xoopsConfig;
	$myts = &MyTextSanitizer::getInstance();
	
	$tblColors = Array();
	$tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = '';
	$tblColors[$currentoption] = 'current';
	if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
		include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/' . $xoopsConfig['language'] . '/modinfo.php';
	} else {
		include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/english/modinfo.php';
	}
	
	echo "<div id='buttontop'>";
	echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
	//echo "<td style=\"width: 45%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\"><a class=\"nobutton\" href=\"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoopsModule->getVar('mid') . "\">" . _AM_SF_OPTS . "</a> | <a href=\"import.php\">" . _AM_SF_IMPORT . "</a> | <a href=\"../index.php\">" . _AM_SF_GOMOD . "</a> | <a href=\"../help/index.html\" target=\"_blank\">" . _AM_SF_HELP . "</a> | <a href=\"about.php\">" . _AM_SF_ABOUT . "</a></td>";
	echo "<td style='font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;'>
	<a href='" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/index.php'>".$xoopsModule->getVar('dirname')."</a>
	</td>";
	echo "<td style='font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;'><b>" . $myts->displayTarea($xoopsModule->name()) . "  </b> ".$breadcrumb." </td>";
	echo "</tr></table>";
	echo "</div>";
	
	echo "<div id='buttonbar'>";
	echo "<ul>";
    echo "<li id='" . $tblColors[0] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/index.php\"><span>"._MI_NOTIFY_INDEX."</span></a></li>";
	echo "<li id='" . $tblColors[1] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/notif.php\"><span>"._MI_NOTIFY_NOTIF."</span></a></li>";
	echo "<li id='" . $tblColors[2] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/form.php\"><span>"._MI_NOTIFY_FORM."</span></a></li>";
	echo "<li id='" . $tblColors[3] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/plug.php\"><span>"._MI_NOTIFY_PLUG."</span></a></li>";
	echo "<li id='" . $tblColors[4] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/permissions.php\"><span>" ._MI_NOTIFY_PERMISSIONS. "</span></a></li>";
	echo "<li id='" . $tblColors[5] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/about.php\"><span>"._MI_NOTIFY_ABOUT."</span></a></li>";
	echo "<li id='" . $tblColors[6] . "'><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule ->getVar('mid')."'><span>" ._MI_NOTIFY_PREF. "</span></a></li>";
	echo "</ul></div>&nbsp;";
}


?>