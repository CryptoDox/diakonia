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
include '../../../include/cp_header.php'; 
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once("../include/functions.php");

xoops_cp_header();
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(4, _AM_CRYPTODUKE_MANAGER_ABOUT);
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
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (4, _AM_CRYPTODUKE_MANAGER_ABOUT);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/deco/about.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;  height: 48px;"><strong>'._AM_CRYPTODUKE_MANAGER_ABOUT.'</strong>';
echo '</div><br />';

$versioninfo =& $module_handler->get( $xoopsModule->getVar( 'mid' ) );
echo "
	<style type=\"text/css\">
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
";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . $xoopsModule->getVar("name"). "</legend>";
echo "<div style='padding: 8px;'>";
echo "<img src='" . XOOPS_URL . "/modules/" . $xoopsModule->getVar("dirname") . "/" . $versioninfo->getInfo( 'image' ) . "' alt='' hspace='10' vspace='0' /></a>\n";
echo "<div style='padding: 5px;'><strong>" . $versioninfo->getInfo( 'name' ) . " version " . $versioninfo->getInfo( 'version' ) . "</strong></div>\n";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_RELEASEDATE. ":</label><text>" . $versioninfo->getInfo( 'release' ) . "</text><br />";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_AUTHOR. ":</label><text>" . $versioninfo->getInfo( 'author' ) . "</text><br />";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_CREDITS. ":</label><text>" . $versioninfo->getInfo( 'credits' ) . "</text><br />";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_LICENSE. ":</label><text><a href=\"".$versioninfo->getInfo( 'license_file' )."\" target=\"_blank\" >" . $versioninfo->getInfo( 'license' ) . "</a></text>\n";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" ._AM_CRYPTODUKE_ABOUT_MODULE_INFO. "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_MODULE_STATUS. ":</label><text>" . $versioninfo->getInfo( 'module_status' ) . "</text><br />";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_WEBSITE. ":</label><text>" . "<a href='" . $versioninfo->getInfo( 'module_website_url' ) . "' target='_blank'>" . $versioninfo->getInfo( 'module_website_name' ) . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" ._AM_CRYPTODUKE_ABOUT_AUTHOR_INFO. "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_AUTHOR_NAME. ":</label><text>" . $versioninfo->getInfo( 'author' ) . "</text><br />";
echo "<label>" ._AM_CRYPTODUKE_ABOUT_WEBSITE. ":</label><text>" . "<a href='" . $versioninfo->getInfo( 'author_website_url' ) . "' target='_blank'>" . $versioninfo->getInfo( 'author_website_name' ) . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";


$file = XOOPS_ROOT_PATH. "/modules/".$xoopsModule->getVar("dirname")."/changelog.txt";
if ( is_readable( $file ) ){
	echo "<fieldset><legend style='font-weight: bold; color: #900;'>" ._AM_CRYPTODUKE_ABOUT_CHANGELOG. "</legend>";
	echo "<div style='padding: 8px;'>";
	echo "<div>". implode("<br />", file( $file )) . "</div>";
	echo "</div>";
	echo "</fieldset>";
	echo "<br clear=\"all\" />";
}

xoops_cp_footer();
?>