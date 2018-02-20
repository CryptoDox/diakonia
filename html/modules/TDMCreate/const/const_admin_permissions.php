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

function const_admin_permissions($modules, $modules_name, $tables_arr, $menu)
{	
	$language_manager = '_AM_'.strtoupper($modules_name).'_MANAGER_';
	$language = '_AM_'.strtoupper($modules_name).'_PERMISSIONS_';
	$myts =& MyTextSanitizer::getInstance();
	$admin_permissions_file = "permissions.php";
	$admin_permissions_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/".$admin_permissions_file;
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'
include("header.php");

if( !empty($_POST["submit"]) ) 
{
	redirect_header( XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/permissions.php" , 1 , _MP_GPERMUPDATED );
}

xoops_cp_header();

global $xoopsDB;

if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
'.$modules_name.'_adminmenu('.$menu.','.$language_manager.'PERMISSIONS);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu ('.$menu.','.$language_manager.'PERMISSIONS);
}

//menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/permissions.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>".'.$language_manager.'PERMISSIONS."</strong>
	</div><br />";

	$permtoset= isset($_POST["permtoset"]) ? intval($_POST["permtoset"]) : 1;
	$selected=array("","","");
	$selected[$permtoset-1]=" selected";
	
echo "
<form method=\"post\" name=\"fselperm\" action=\"permissions.php\">
	<table border=0>
		<tr>
			<td>
				<select name=\"permtoset\" onChange=\"javascript: document.fselperm.submit()\">
					<option value=\"1\"".$selected[0].">".'.$language.'ACCESS."</option>
					<option value=\"2\"".$selected[1].">".'.$language.'SUBMIT."</option>
				</select>
			</td>
		</tr>
	</table>
</form>";

$module_id = $xoopsModule->getVar("mid");

	switch($permtoset)
	{
		case 1:
			$title_of_form = '.$language.'ACCESS;
			$perm_name = "'.$modules_name.'_access";
			$perm_desc = "";
			break;
		case 2:
			$title_of_form = '.$language.'SUBMIT;
			$perm_name = "'.$modules_name.'_submit";
			$perm_desc = "";
			break;
	}
	
	$permform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc, "admin/permissions.php");
	$xt = new XoopsTopic( $xoopsDB -> prefix("'.$modules_name.'_topic") );
	$alltopics =& $xt->getTopicsList();
	
	foreach ($alltopics as $topic_id => $topic) 
	{
		$permform->addItem($topic_id, $topic["title"], $topic["pid"]);
	}
	echo $permform->render();
	echo "<br /><br /><br /><br />\n";
	unset ($permform);

echo "<br /><br />
<div align=\"center\"><a href=\"http://www.tdmxoops.net\" target=\"_blank\"><img src=\"http://www.tdmxoops.net/images/logo_modules.gif\" alt=\"TDM\" title=\"TDM\"></a></div>
";
?>';
		
	//Integration du contenu dans admin_header
	$handle = fopen($admin_permissions_path_file ,"w");

	if (is_writable($admin_permissions_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_PERMISSIONS.'<br>'.$admin_permissions_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_ADMIN_PERMISSIONS.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_PERMISSIONS.'<br>'.$admin_permissions_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>