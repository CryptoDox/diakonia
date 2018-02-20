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
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';

function const_admin_pages($modules, $modules_name, $tables_id, $tables_module_table, $tables_name, $tables_img, $tables_champs, $tables_parametres, $menu)
{
	$language = '_AM_'.strtoupper($modules_name).'';
	$language_manager = '_AM_'.strtoupper($modules_name).'_MANAGER_'.strtoupper($tables_name).'';
	
	$modules_name_minuscule = strtolower($modules_name);
	$admin_page_file = $tables_name.".php";
	$admin_page_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/admin/".$admin_page_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'
include_once("./header.php");
	
xoops_cp_header();

if (isset($_REQUEST["op"])) {
	$op = $_REQUEST["op"];
} else {
	@$op = "show_list_'.$tables_name.'";
}

//Menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php") ) {
'.$modules_name.'_adminmenu('.$menu.', '.$language_manager.');
} else {
include_once XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php";
loadModuleAdminMenu ('.$menu.', '.$language_manager.');
}

//Sous menu
echo "<div class=\"CPbigTitle\" style=\"background-image: url(../images/deco/'.$tables_img.'); background-repeat: no-repeat; background-position: left; padding-left: 50px;\">
		<strong>".'.$language_manager.'."</strong>
	</div><br /><br>";';
	
//Champs
$champs_total = explode("|", $tables_champs);
$nb_champs = count($champs_total);

//Parametres
$parametres_total = explode("|", $tables_parametres);

//Recuperation des noms des tables
for($i=0; $i<$nb_champs; $i++)
{
	//Nom des champs
	$champs1 = explode(":", $champs_total[$i]);
	$champs[$i] = $champs1[0];
	//Afficher dans l'admin
		if( $i == 0 ) {
			$champs_param_display_admin[$i] = '0';
		} else {
			$parametres = explode(":", $parametres_total[$i-1]);
			$champs_param_type[$i] = $parametres[0];
			$champs_param_display_admin[$i] = $parametres[1];
		}	
}

$champs_id = $champs[0];
$champs_name = $champs[1];

$text .= '
switch ($op) 
{	
	case "save_'.$tables_name.'":
		if ( !$GLOBALS["xoopsSecurity"]->check() ) {
           redirect_header("'.$tables_name.'.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
        }
        if (isset($_REQUEST["'.$champs_id.'"])) {
           $obj =& $'.$tables_name.'Handler->get($_REQUEST["'.$champs_id.'"]);
        } else {
           $obj =& $'.$tables_name.'Handler->create();
        }
		
		';
	 	
		$champs_save = const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, '', 2);		
		
		$text .= ''.$champs_save.'
		
        if ($'.$tables_name.'Handler->insert($obj)) {
           redirect_header("'.$tables_name.'.php?op=show_list_'.$tables_name.'", 2, '.$language.'_FORMOK);
        }
        //include_once("../include/forms.php");
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
	break;
	
	case "edit_'.$tables_name.'":
		$obj = $'.$tables_name.'Handler->get($_REQUEST["'.$champs_id.'"]);
		$form = $obj->getForm();
	break;
	
	case "delete_'.$tables_name.'":
		$obj =& $'.$tables_name.'Handler->get($_REQUEST["'.$champs_id.'"]);
		if (isset($_REQUEST["ok"]) && $_REQUEST["ok"] == 1) {
			if ( !$GLOBALS["xoopsSecurity"]->check() ) {
				redirect_header("'.$tables_name.'.php", 3, implode(",", $GLOBALS["xoopsSecurity"]->getErrors()));
			}
			if ($'.$tables_name.'Handler->delete($obj)) {
				redirect_header("'.$tables_name.'.php", 3, '.$language.'_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array("ok" => 1, "'.$champs_id.'" => $_REQUEST["'.$champs_id.'"], "op" => "delete_'.$tables_name.'"), $_SERVER["REQUEST_URI"], sprintf('.$language.'_FORMSUREDEL, $obj->getVar("'.$tables_name.'")));
		}
	break;
	
	case "update_online_'.$tables_name.'":
		
	if (isset($_REQUEST["'.$champs_id.'"])) {
		$obj =& $'.$tables_name.'Handler->get($_REQUEST["'.$champs_id.'"]);
	} 
	$obj->setVar("'.$tables_name.'_online", $_REQUEST["'.$tables_name.'_online"]);

	if ($'.$tables_name.'Handler->insert($obj)) {
		redirect_header("'.$tables_name.'.php", 3, '.$language.'_FORMOK);
	}
	echo $obj->getHtmlErrors();
	
	break;
	
	case "default":
	default:

		$criteria = new CriteriaCompo();
		$criteria->setSort("'.$champs_id.'");
		$criteria->setOrder("ASC");
		$numrows = $'.$tables_name.'Handler->getCount();
		$'.$tables_name.'_arr = $'.$tables_name.'Handler->getall($criteria);
		';
		if ( $tables_name != 'topic' ) 
		{
			$text .='
			//Affichage du tableau
			if ($numrows>0) 
			{			
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
					<tr>
						';
						$champs_colonne_name = const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, '', 0);
						$text .= ''.$champs_colonne_name.'
						<th align=\"center\" width=\"10%\">".'.$language.'_FORMACTION."</th>
					</tr>";
						
				$class = "odd";
				
				foreach (array_keys($'.$tables_name.'_arr) as $i) 
				{	
					if ( $'.$tables_name.'_arr[$i]->getVar("topic_pid") == 0)
					{
						echo "<tr class=\"".$class."\">";
						$class = ($class == "even") ? "odd" : "even";
						';
						$champs_data = const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, '', 1);
						
						$text .= ''.$champs_data.'
									echo "<td align=\"center\" width=\"10%\">
										<a href=\"'.$tables_name.'.php?op=edit_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."\"><img src=\"../images/deco/edit.gif\" alt=\"".'.$language.'_EDIT."\" title=\"".'.$language.'_EDIT."\"></a>
										<a href=\"'.$tables_name.'.php?op=delete_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."\"><img src=\"../images/deco/delete.gif\" alt=\"".'.$language.'_DELETE."\" title=\"".'.$language.'_DELETE."\"></a>
									  </td>";
						echo "</tr>";
					}	
				}
				echo "</table><br><br>";
			}
		';
		} else {
			$text .= '
			//Fonction qui permet afficher les catégories enfants
			function '.$modules_name.'_display_children($topic_id = 0, $topic_arr, $prefix = "", $order = "", &$class) 
			{   
				$topicHandler =& xoops_getModuleHandler("'.$tables_module_table.'", "'.$modules_name.'");
				$prefix = $prefix."<img src=\"".XOOPS_URL."/modules/'.$modules_name.'/images/deco/arrow.gif\">";
				foreach (array_keys($topic_arr) as $i) 
				{
					$topic_id = $topic_arr[$i]->getVar("topic_id");
					$topic_img = $topic_arr[$i]->getVar("topic_img");
					$topic_title = $topic_arr[$i]->getVar("topic_title");
					$topic_weight = $topic_arr[$i]->getVar("topic_weight");
					echo "<tr class=\"".$class."\">";
					';
					$champs_data = const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, 1, 1);
				
					$text .= ''.$champs_data.'
								echo "<td align=\"center\" width=\"10%\">
									<a href=\"'.$tables_name.'.php?op=edit_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."\"><img src=\"../images/deco/edit.gif\" alt=\"".'.$language.'_EDIT."\" title=\"".'.$language.'_EDIT."\"></a>
									<a href=\"'.$tables_name.'.php?op=delete_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."\"><img src=\"../images/deco/delete.gif\" alt=\"".'.$language.'_DELETE."\" title=\"".'.$language.'_DELETE."\"></a>
								</td>                 
						</tr>";
					$class = ($class == "even") ? "odd" : "even";
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria("topic_pid", $topic_arr[$i]->getVar("topic_id")));
					$criteria->setSort("topic_title");
					$criteria->setOrder("ASC");
					$topic_pid = $'.$tables_name.'Handler->getall($criteria);
					$num_pid = $'.$tables_name.'Handler->getCount();
					if ( $num_pid != 0 )
					{
						'.$modules_name.'_display_children($topic_id, $topic_pid, $prefix, $order, $class);
					}
				}
			}

			//Affichage du tableau
			if ($numrows>0) 
			{
				echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">
						<tr>
						';
							$champs_colonne_name = const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, '', 0);
							$text .= ''.$champs_colonne_name.'
							<th align=\"center\" width=\"10%\">".'.$language.'_FORMACTION."</th>		
						</tr>";
				$class = "odd";
				$prefix = "<img src=\"".XOOPS_URL."/modules/'.$modules_name.'/images/deco/arrow.gif\">";
				foreach (array_keys($'.$tables_name.'_arr) as $i) 
				{               
					if ( $'.$tables_name.'_arr[$i]->getVar("topic_pid") == 0 )
					{                    
						$topic_id = $'.$tables_name.'_arr[$i]->getVar("topic_id");
						$topic_img = $'.$tables_name.'_arr[$i]->getVar("topic_img");
						$topic_title = $'.$tables_name.'_arr[$i]->getVar("topic_title");
						$topic_weight = $'.$tables_name.'_arr[$i]->getVar("topic_weight");
						echo "<tr class=\"".$class."\">";
						';
						$champs_data = const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, 1, 1);
					
						$text .= ''.$champs_data.'
								echo "<td align=\"center\" width=\"10%\">
									<a href=\"'.$tables_name.'.php?op=edit_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."\"><img src=\"../images/deco/edit.gif\" alt=\"".'.$language.'_EDIT."\" title=\"".'.$language.'_EDIT."\"></a>
									<a href=\"'.$tables_name.'.php?op=delete_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."\"><img src=\"../images/deco/delete.gif\" alt=\"".'.$language.'_DELETE."\" title=\"".'.$language.'_DELETE."\"></a>
								</td>                 
						</tr>";
						$class = ($class == "even") ? "odd" : "even";
						$criteria = new CriteriaCompo();
						$criteria->add(new Criteria("topic_pid", $topic_id));
						$criteria->setSort("topic_title");
						$criteria->setOrder("ASC");
						$topic_pid = $'.$tables_name.'Handler->getall($criteria);
						$num_pid = $'.$tables_name.'Handler->getCount();
						
						if ( $num_pid != 0)
						{
							'.$modules_name.'_display_children($topic_id, $topic_pid, $prefix, "topic_title", $class);
						}
					}
				}
				echo "</table><br><br>";
			}
		';
		}
		$text .= '
		// Affichage du formulaire
    	$obj =& $'.$tables_name.'Handler->create();
    	$form = $obj->getForm();	
}
echo "<br /><br />
<div align=\"center\"><a href=\"http://www.tdmxoops.net\" target=\"_blank\"><img src=\"http://www.tdmxoops.net/images/logo_modules.gif\" alt=\"TDM\" title=\"TDM\"></a></div>
";
xoops_cp_footer();
	
?>';
		
	//Integration du contenu dans le bloc
	$handle = fopen($admin_page_path_file ,"w");

	if (is_writable($admin_page_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'.sprintf(_AM_TDMCREATE_CONST_NOTOK_ADMIN_PAGES, $tables_name).'<br>'.$admin_page_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'.sprintf(_AM_TDMCREATE_CONST_OK_ADMIN_PAGES, $tables_name).'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'.sprintf(_AM_TDMCREATE_CONST_NOTOK_ADMIN_PAGES, $tables_name).'<br>'.$admin_page_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>