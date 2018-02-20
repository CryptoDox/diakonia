<?php
/**
 * ****************************************************************************
 *  - TDMCreate By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence GPL Copyright (c)  (http://www.tdmxoops.net)
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
 * @license     TDM GPL license
 * @author		TDM TEAM DEV MODULE 
 *
 * ****************************************************************************
 */
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/const/const_entete.php';

function const_admin_header($modules, $modules_name, $tables_arr)
{	
	$language = '_AM_'.strtoupper($modules_name).'_';
	$language1 = '_MI_'.strtoupper($modules_name).'_MANAGER_';
	$myts =& MyTextSanitizer::getInstance();
	$admin_header_file = "header.php";
	$admin_header_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/".$admin_header_file;
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'
include "../../../include/cp_header.php";

include_once(XOOPS_ROOT_PATH."/class/xoopsmodule.php");
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH."/class/tree.php";
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
include_once XOOPS_ROOT_PATH."/class/pagenav.php";
include_once XOOPS_ROOT_PATH."/class/xoopstopic.php";
include_once XOOPS_ROOT_PATH."/class/xoopsform/grouppermform.php";
include_once("../include/functions.php");

$myts =& MyTextSanitizer::getInstance();
';

foreach (array_keys($tables_arr) as $i) 
{
	$text .= 'include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/class/'.$tables_arr[$i]->getVar("tables_name").'.php";
';
}

//include_once("functions.php");

$text .= '
if ( $xoopsUser ) {
	$xoopsModule = XoopsModule::getByDirname("'.$modules_name.'");
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) { 
		redirect_header(XOOPS_URL."/",3,_NOPERM);
		exit();
	}
} else {
	redirect_header(XOOPS_URL."/",3,_NOPERM);
	exit();
}

// Include language file
xoops_loadLanguage("admin", "system");
xoops_loadLanguage("admin", $xoopsModule->getVar("dirname", "e"));
xoops_loadLanguage("modinfo", $xoopsModule->getVar("dirname", "e"));

function '.$modules_name.'_adminmenu ($currentoption = 0, $breadcrumb = "") 
{   
	global $xoopsModule, $xoopsConfig; 

	echo "
    	<style type=\"text/css\">
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url(".XOOPS_URL."/modules/'.$modules_name.'/images/menu/bg.png) repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url(".XOOPS_URL."/modules/'.$modules_name.'/images/deco/left_both.png) no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url(".XOOPS_URL."/modules/'.$modules_name.'/images/deco/right_both.png) no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		#buttonbar a span {float:none;}
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
		
	$tblColors = Array();
	$tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = "";
	$tblColors[$currentoption] = "current";
	if (file_exists("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php")) {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/language/".$xoopsConfig["language"]."/modinfo.php");
	} else {
		include_once("".XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/english/modinfo.php");
	}
	
	echo "<div id=\"buttontop\">
			<table style=\"width: 100%; padding: 0;\" cellspacing=\"0\">
				<tr>
					<td style=\"font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">
					  <a class=\"nobutton\" href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$myts->displayTarea($xoopsModule->getVar("mid"))."\">'.$language.'GENERALSET</a> 
					| <a href=\"".XOOPS_URL."/modules/'.$modules_name.'/index.php\">'.$language.'GOINDEX</a> 
					| <a href=\"".XOOPS_URL."/modules/'.$modules_name.'/admin/upgrade.php\">'.$language.'UPGRADE</a> 
					</td>
					<td style=\"font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\"><b>".$myts->displayTarea($xoopsModule->name())."</b></td>
				</tr>
			</table>
		  </div>
	
		  <div id=\"buttonbar\">
			<ul>';
			$menu = 0;
			$text .= '<li id=\"$tblColors['.$menu.']\"><a href=\"".XOOPS_URL."/modules/'.$modules_name.'/admin/index.php\"><span>'.$language1.'INDEX</span></a></li>
				';
			$menu++;
			foreach (array_keys($tables_arr) as $i)
			{
				$tables_id = $tables_arr[$i]->getVar("tables_id");
				if ( $tables_arr[$i]->getVar("tables_display_admin") == 1 ) {
						$text .= '<li id=\"$tblColors['.$menu.']\"><a href=\"".XOOPS_URL."/modules/'.$modules_name.'/admin/'.$tables_arr[$i]->getVar("tables_name").'.php\"><span>'.$language1.strtoupper($tables_arr[$i]->getVar("tables_name")).'</span></a></li>
				';
				}
				$menu++;
			}
				$text .= '
				<li id=\"$tblColors['.$menu.']\"><a href=\"".XOOPS_URL."/modules/'.$modules_name.'/admin/permissions.php\"><span>'.$language1.'PERMISSIONS</span></a></li>
				';
				$menu++;
				$text .= '<li id=\"$tblColors['.$menu.']\"><a href=\"".XOOPS_URL."/modules/'.$modules_name.'/admin/about.php\"><span>'.$language1.'ABOUT</span></a></li>
			</ul></div>";
}

';
//Classes
foreach (array_keys($tables_arr) as $i) 
{
	$text .= '$'.$tables_arr[$i]->getVar("tables_name").'Handler =& xoops_getModuleHandler("'.$tables_arr[$i]->getVar("tables_module_table").'", "'.$modules_name.'");
';
}
$text .= '
?>';
		
	//Integration du contenu dans admin_header
	$handle = fopen($admin_header_path_file ,"w");

	if (is_writable($admin_header_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_HEADER.'<br>'.$admin_header_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_ADMIN_HEADER.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_HEADER.'<br>'.$admin_header_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>