<?php 

/**
 * ****************************************************************************
 *  - CryptoDuke By CryptoDuke   - DEV MODULE FOR XOOPS
 *  - Licence Copyright (c) 2016 (https://elduke3d.shost.ca)
 *
 * Cette licence, contient des limitations!!!
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license     CryptoDuke Copyright (c) license
 * @author		CryptoDuke TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
 
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

/**
 * admin menu
 */
 function CryptoDuke_adminmenu ($currentoption = 0, $breadcrumb = '') {      // TDMCreate_adminmenu
		
	/* Nice buttons styles */
	echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/cryptoduke/images/menu/bg.png') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/cryptoduke/images/menu/left_both.png') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/cryptoduke/images/menu/right_both.png') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
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
    echo "<li id='" . $tblColors[0] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/index.php\"><span>"._MI_CRYPTODUKE_MANAGER_INDEX."</span></a></li>";
	echo "<li id='" . $tblColors[1] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/modules.php\"><span>"._MI_CRYPTODUKE_MANAGER_MODULES."</span></a></li>";
	// echo "<li id='" . $tblColors[2] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/tables.php\"><span>"._MI_CRYPTODUKE_MANAGER_TABLES."</span></a></li>";
	// echo "<li id='" . $tblColors[3] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/const.php\"><span>"._MI_CRYPTODUKE_MANAGER_CONST."</span></a></li>";
	echo "<li id='" . $tblColors[4] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoopsModule->getVar('dirname')."/admin/about.php\"><span>"._MI_CRYPTODUKE_MANAGER_ABOUT."</span></a></li>";
	echo "</ul></div>&nbsp;";
}


function clearDir($dossier) {
	$ouverture=@opendir($dossier);
	if (!$ouverture) return;
	while($fichier=readdir($ouverture)) {
		if ($fichier == '.' || $fichier == '..') continue;
			if (is_dir($dossier."/".$fichier)) {
				$r=clearDir($dossier."/".$fichier);
				if (!$r) return false;
			}
			else {
				$r=@unlink($dossier."/".$fichier);
				if (!$r) return false;
			}
	}
closedir($ouverture);
$r=@rmdir($dossier);
if (!$r) return false;
	return true;
}


?>
