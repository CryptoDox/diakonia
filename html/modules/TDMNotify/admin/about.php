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
Adminmenu(5, _AM_NOTIFY_MANAGE_ABOUT);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (5, _AM_NOTIFY_MANAGE_ABOUT);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/about.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;"><strong>'._AM_NOTIFY_MANAGE_ABOUT.'</strong>';
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
echo "<label>" ._AM_ABOUT_RELEASEDATE. ":</label><text>" . $versioninfo->getInfo( 'release' ) . "</text><br />";
echo "<label>" ._AM_ABOUT_AUTHOR. ":</label><text>" . $versioninfo->getInfo( 'author' ) . "</text><br />";
echo "<label>" ._AM_ABOUT_CREDITS. ":</label><text>" . $versioninfo->getInfo( 'credits' ) . "</text><br />";
echo "<label>" ._AM_ABOUT_LICENSE. ":</label><text><a href=\"".$versioninfo->getInfo( 'license_file' )."\" target=\"_blank\" >" . $versioninfo->getInfo( 'license' ) . "</a></text>\n";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" ._AM_ABOUT_MODULE_INFO. "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" ._AM_ABOUT_MODULE_STATUS. ":</label><text>" . $versioninfo->getInfo( 'module_status' ) . "</text><br />";
echo "<label>" ._AM_ABOUT_WEBSITE. ":</label><text>" . "<a href='" . $versioninfo->getInfo( 'module_website_url' ) . "' target='_blank'>" . $versioninfo->getInfo( 'module_website_name' ) . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";

echo "<fieldset><legend style='font-weight: bold; color: #900;'>" ._AM_ABOUT_AUTHOR_INFO. "</legend>";
echo "<div style='padding: 8px;'>";
echo "<label>" ._AM_ABOUT_AUTHOR_NAME. ":</label><text>" . $versioninfo->getInfo( 'author' ) . "</text><br />";
echo "<label>" ._AM_ABOUT_WEBSITE. ":</label><text>" . "<a href='" . $versioninfo->getInfo( 'author_website_url' ) . "' target='_blank'>" . $versioninfo->getInfo( 'author_website_name' ) . "</a>" . "</text><br />";
echo "</div>";
echo "</fieldset>";
echo "<br clear=\"all\" />";


$file = XOOPS_ROOT_PATH. "/modules/TDMNotify/changelog.txt";
if ( is_readable( $file ) ){
	echo "<fieldset><legend style='font-weight: bold; color: #900;'>" ._AM_ABOUT_CHANGELOG. "</legend>";
	echo "<div style='padding: 8px;'>";
	echo "<div>". implode("<br />", file( $file )) . "</div>";
	echo "</div>";
	echo "</fieldset>";
	echo "<br clear=\"all\" />";
}

xoops_cp_footer();
?>