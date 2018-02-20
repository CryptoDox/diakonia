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

function const_admin_index($modules, $modules_name, $tables_arr, $menu)
{	
	$language = '_AM_'.strtoupper($modules_name).'_MANAGER_';
	$language1 = '_AM_'.strtoupper($modules_name).'_THEREARE_';
	$myts =& MyTextSanitizer::getInstance();
	$admin_index_file = "index.php";
	$admin_index_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/".$admin_index_file;
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'
include_once("./header.php");

xoops_cp_header();

global $xoopsModule;

//Apelle du menu admin
if ( !is_readable(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php"))	{
'.$modules_name.'_adminmenu('.$menu.', '.$language.'INDEX);
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu ('.$menu.', '.$language.'INDEX);
}
';

foreach (array_keys($tables_arr) as $i) 
{
	$text .= '
	//compte "total"
	$count_'.$tables_arr[$i]->getVar("tables_name").' = $'.$tables_arr[$i]->getVar("tables_name").'Handler->getCount();
	//compte "attente"
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("'.$tables_arr[$i]->getVar("tables_name").'_online", 1));
	$'.$tables_arr[$i]->getVar("tables_name").'_online = $'.$tables_arr[$i]->getVar("tables_name").'Handler->getCount($criteria);
	';
}
$text .= '
include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/class/menu.php";

	$menu = new '.$modules_name.'Menu();
	';
	foreach (array_keys($tables_arr) as $i) 
	{
		$text .= '$menu->addItem("'.$tables_arr[$i]->getVar("tables_name").'", "'.$tables_arr[$i]->getVar("tables_name").'.php", "../images/deco/'.$tables_arr[$i]->getVar("tables_img").'", '.$language.strtoupper($tables_arr[$i]->getVar("tables_name")).');';
	}
	//$menu->addItem("Preference" "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid")."&amp;&confcat_id=1", "../images/decos/pref.png", '.$language.'NAVPREFERENCES);	
	
	$text .= '
	$menu->addItem("update", "../../system/admin.php?fct=modulesadmin&op=update&module='.$modules_name.'", "../images/deco/update.png",  '.$language.'UPDATE);	
	$menu->addItem("permissions", "permissions.php", "../images/deco/permissions.png", '.$language.'PERMISSIONS);
	$menu->addItem("preference", "../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule->getVar("mid").
												"&amp;&confcat_id=1", "../images/deco/pref.png", '.$language.'PREFERENCES);
	$menu->addItem("about", "about.php", "../images/deco/about.png", '.$language.'ABOUT);
	
	echo $menu->getCSS();
	

echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;\"><strong>".'.$language.'INDEX."</strong></div><br />
		<table width=\"100%\" border=\"0\" cellspacing=\"10\" cellpadding=\"4\">
			<tr>
				<td valign=\"top\">".$menu->render()."</td>
				<td valign=\"top\" width=\"60%\">";
				';

				foreach (array_keys($tables_arr) as $i) 
				{
					$text .= '
					echo "<fieldset>
						<legend class=\"CPmediumTitle\">".'.$language.''.strtoupper($tables_arr[$i]->getVar("tables_name")).'."</legend>
						<br />";
						printf('.$language1.strtoupper($tables_arr[$i]->getVar("tables_name")).', $count_'.$tables_arr[$i]->getVar("tables_name").');
						echo "<br /><br />";
						printf('.$language1.strtoupper($tables_arr[$i]->getVar("tables_name")).'_ONLINE, $'.$tables_arr[$i]->getVar("tables_name").'_online);
						echo "<br />
					</fieldset><br /><br />";
					';
				}
				$text .= '
				echo "</td>
			</tr>
		</table>
<br /><br />
<div align=\"center\"><a href=\"http://www.tdmxoops.net\" target=\"_blank\"><img src=\"http://www.tdmxoops.net/images/logo_modules.gif\" alt=\"TDM\" title=\"TDM\"></a></div>
";
xoops_cp_footer();

?>';
		
	//Integration du contenu dans admin_header
	$handle = fopen($admin_index_path_file ,"w");

	if (is_writable($admin_index_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_INDEX.'<br>'.$admin_index_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_ADMIN_INDEX.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_ADMIN_INDEX.'<br>'.$admin_index_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>