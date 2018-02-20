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

function const_admin_about($modules, $modules_name, $menu)
{
	global $xoopsModule, $xoopsConfig;
	
	$language = '_AM_'.strtoupper($modules_name).'_ABOUT_';
	$language_manager = '_AM_'.strtoupper($modules_name).'_MANAGER_ABOUT';
	$admin_about_file = "about.php";
	$admin_about_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/".$admin_about_file;
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'
include_once("./header.php");

xoops_cp_header();

if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
'.$modules_name.'_adminmenu('.$menu.', '.$language_manager.');

echo "<style>
.CPbigTitle{
	font-size: 20px;
	color: #1E90FF;
	background: no-repeat left top;
	font-weight: bold;
	height: 40px;
	vertical-align: middle;
	padding: 10px 0 0 50px;
	border-bottom: 3px solid #1E90FF;
}
</style>";
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu ('.$menu.', '.$language_manager.');
}

//menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/about.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>".'.$language_manager.'."</strong>
</div><br />";

$versioninfo =& $module_handler->get( $xoopsModule->getVar("mid") );

echo "<style type=\"text/css\">
		label,text {
			display: block;
			float: left;
			margin-bottom: 2px;
		}
		label {
			text-align: right;
			width: 150px;
			padding-right: 20px;
		}
		br {
			clear: left;
		}
	</style>

	<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">".$xoopsModule->getVar("name")."</legend>
			<div style=\"padding: 8px;\">
				<img src=\"".XOOPS_URL."/modules/".$xoopsModule->getVar("dirname")."/".$versioninfo->getInfo("image")."\" alt=\"\" hspace=\"10\" vspace=\"0\" /></a>\n
				<div style=\"padding: 5px;\"><strong>".$versioninfo->getInfo("name")." version ".$versioninfo->getInfo("version")."</strong></div>\n
				<label>".'.$language.'RELEASEDATE.":</label><text>".$versioninfo->getInfo("release")."</text><br />
				<label>".'.$language.'AUTHOR.":</label><text>".$versioninfo->getInfo("author")."</text><br />
				<label>".'.$language.'CREDITS.":</label><text>".$versioninfo->getInfo("credits")."</text><br />
				<label>".'.$language.'LICENSE.":</label><text><a href=\"".$versioninfo->getInfo("license_file")."\" target=\"_blank\" >".$versioninfo->getInfo("license")."</a></text>\n
			</div>
	</fieldset>
<br clear=\"all\"/>

	<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">".'.$language.'MODULE_INFO."</legend>
			<div style=\"padding: 8px;\">
				<label>".'.$language.'MODULE_STATUS.":</label><text>".$versioninfo->getInfo("module_status")."</text><br />
				<label>".'.$language.'WEBSITE.":</label><text><a href=\"".$versioninfo->getInfo("module_website_url")."\" target=\"_blank\">".$versioninfo->getInfo("module_website_name")."</a></text><br />
			</div>
	</fieldset>
<br clear=\"all\" />

	<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">".'.$language.'AUTHOR_INFO."</legend>
			<div style=\"padding: 8px;\">
				<label>".'.$language.'AUTHOR_NAME.":</label><text>".$versioninfo->getInfo("author")."</text><br />
				<label>".'.$language.'WEBSITE.":</label><text><a href=\"".$versioninfo->getInfo("author_website_url")."\" target=\"_blank\">".$versioninfo->getInfo("author_website_name")."</a></text><br />
			</div>
	</fieldset>
<br clear=\"all\" />";

$file = XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar("dirname")."/changelog.txt";

if ( is_readable( $file ) ){
echo "<fieldset>
		<legend style=\"font-weight: bold; color: #900;\">".'.$language.'CHANGELOG."</legend>
			<div style=\"padding: 8px;\">
				<div>".implode("<br />", file( $file ))."</div>
			</div>
	</fieldset>
	<br clear=\"all\" />";

}
echo "<br /><br />
<div align=\"center\"><a href=\"http://www.tdmxoops.net\" target=\"_blank\"><img src=\"http://www.tdmxoops.net/images/logo_modules.gif\" alt=\"TDM\" title=\"TDM\"></a></div>
";
xoops_cp_footer();
?>';
		
	//Integration du contenu dans admin_header
	$handle = fopen($admin_about_path_file ,"w");

	if (is_writable($admin_about_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_ABOUT.'<br>'.$about_menu_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_ADMIN_ABOUT.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_ABOUT.'<br>'.$about_menu_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>