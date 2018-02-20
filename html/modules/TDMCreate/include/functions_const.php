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
 
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

function const_champs($modules_name, $tables_module_table, $tables_name, $tables_champs, $language, $champs_param_display_form = 0, $champs_param_elements = 0, $champs_param_required_field = 0, $option = 0)
{
	//print_r($champs_param_display_form);
	$text = '';
	//Compte le nombre de champs
	$champs = explode("|", $tables_champs);
	$nb_champs = count($champs);
	//Recupere les donnees
	
	if ( $option == 0 )
	{
	//Creation du constructor
		for ($i=0; $i<$nb_champs; $i++)
		{
			$structure = explode(":", $champs[$i]);
			if ( $structure[1] == 'int' || $structure[1] == 'tinyint' || $structure[1] == 'smallint' || $structure[1] == 'decimal' ) {
				$text .= '$this->initVar("'.$structure[0].'",XOBJ_DTYPE_INT,null,false,'.$structure[2].');
			';
			} elseif ( $structure[1] == 'varchar' ) {
				$text .= '$this->initVar("'.$structure[0].'",XOBJ_DTYPE_TXTBOX,null,false);
			';
			} elseif ( $structure[1] == 'text' || $structure[1] == 'longtext' ) {
				$text .= ' $this->initVar("'.$structure[0].'",XOBJ_DTYPE_TXTAREA, null, false);
			';
			} 
		}
	} else if ( $option == 1 ) {
	//Creation formulaire
		for ($i=0; $i<$nb_champs; $i++)
		{
			if ( $i != 0 ) {
				$structure = explode(":", $champs[$i]);
				$language_form = ''.$language.strtoupper($structure[0]).'';
				$form = form_elements($i, $modules_name, $tables_module_table, $tables_name, $champs_param_elements, $champs_param_required_field, $language_form, $structure[0]);
				$text .= ''.$form.'';
			}
		}
	} else if ( $option == 2 ) {
	//Creation du fichier mysql.sql
		$text .= '#
# Table structure for table `'.strtolower($tables_module_table).'`
#
		
CREATE TABLE  `'.strtolower($tables_module_table).'` (
';
		$j = 0;
		for ($i=0; $i<$nb_champs; $i++)
		{
			$structure = explode(":", $champs[$i]);
			
			//Probleme avec le type text (pas de valeur)
			if ( $structure[1] != 'text' ) {
				$type = ''.$structure[1].' ('.$structure[2].')';
			} else {
				$type = ''.$structure[1].'';
			}
			
			//Debut
			if ( $structure[0] != ' ' )
			{
				if ( empty($structure[5]) ) {
					$default = "default '".$structure[5]."'";
				} else {
					$default = "";
				}
				
				if ( $i == 0 ) {
					$virgule[$j] = 'PRIMARY KEY (`'.$structure[0].'`)';
					$j++;
					$text .= '`'.$structure[0].'` '.$type.' '.$structure[3].' '.$structure[4].'  auto_increment,
';
				} else {
					if ( $structure[6] == 'unique' || $structure[6] ==  'index' || $structure[6] ==  'fulltext')
					{
						if ( $structure[6] == 'unique' ) {
							$text .= '`'.$structure[0].'` '.$type.' '.$structure[3].' '.$structure[4].' '.$default.',
';
							$virgule[$j] = 'KEY `'.$structure[0].'` (`'.$structure[0].'`)';
						} else if ( $structure[6] == 'index' ) {
							$text .= '`'.$structure[0].'` '.$type.' '.$structure[3].' '.$structure[4].' '.$default.',
';
							$virgule[$j] = 'INDEX (`'.$structure[0].'`)';
						} else if ( $structure[6] == 'fulltext' ) {
							$text .= '`'.$structure[0].'` '.$type.' '.$structure[3].' '.$structure[4].' '.$default.',
';
							$virgule[$j] = 'FULLTEXT KEY `'.$structure[0].'` (`'.$structure[0].'`)';	
						}
						$j++;
					} else {
						$text .= '`'.$structure[0].'` '.$type.' '.$structure[3].' '.$structure[4].' '.$default.',
';
					}
				}
			}
		}
		
		//Probleme virgule
		$key = '';
		for ($i=0; $i<$j; $i++)
		{
			if ( $i != $j - 1 ) {
				$key .= ''.$virgule[$i].',
';
			} else {
				$key .= ''.$virgule[$i].'
';
			}
		}
		$text .= $key;
		$text .= ') ENGINE=MyISAM;

';
	}
	return $text;
}

//
function const_show_champs_parametres($modules_name, $tables_name, $champs_id, $nb_champs, $champs, $champs_param_display_admin, $champs_param_type, $language, $prefix = '',  $option = 0)
{	
	$text = '';
	
	if ( $option == 0 ) {
	//print_r($champs_param_display_admin);
	//Nom des colonnes du tableau
		for($i=0; $i<$nb_champs; $i++)
		{
			if ( $i != 0 ) {
				if ( $champs_param_display_admin[$i] == 1 ) {
					$text .= '<th align=\"center\">".'.$language.'_'.strtoupper($champs[$i]).'."</th>
						';
				}
			}
		}
	} elseif ( $option == 1 ) {
	//Données du tableau
		for($i=0; $i<$nb_champs; $i++)
		{
			if ( $champs_param_display_admin[$i] == 1 ) {
				if ( $i == $nb_champs - 1 ) 
				{
					$text .= '
					$online = $'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'");
				
					if( $online == 1 ) {';
						$text .= '
						echo "<td align=\"center\"><a href=\"./'.$tables_name.'.php?op=update_online_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."&'.$tables_name.'_online=0\"><img src=\"./../images/deco/on.gif\" border=\"0\" alt=\"".'.$language.'_ON."\" title=\"".'.$language.'_ON."\"></a></td>";	
					} else {';
						$text .= '
						echo "<td align=\"center\"><a href=\"./'.$tables_name.'.php?op=update_online_'.$tables_name.'&'.$champs_id.'=".$'.$tables_name.'_arr[$i]->getVar("'.$champs_id.'")."&'.$tables_name.'_online=1\"><img src=\"./../images/deco/off.gif\" border=\"0\" alt=\"".'.$language.'_OFF."\" title=\"".'.$language.'_OFF."\"></a></td>";
					}';
				} else if ( $champs[$i] == 'topic_title' ) 
				{
					if ( $prefix == 1 ) {
						$text .= 'echo "<td align=\"left\">".$prefix."&nbsp;".$topic_arr[$i]->getVar("'.$champs[$i].'")."</td>";	
						';
					} else {
						$text .= 'echo "<td align=\"left\"><img src=\"".XOOPS_URL."/modules/'.$modules_name.'/images/deco/arrow.gif\">&nbsp;".$topic_arr[$i]->getVar("'.$champs[$i].'")."</td>";	
						';
					}
					
				} else if ( $champs_param_type[$i] == 'XoopsFormUploadImage' ) 
				{
					$text .= 'echo "<td align=\"center\"><img src=\"".XOOPS_URL."/uploads/'.$modules_name.'/'.$tables_name.'/'.$champs[$i].'/".$'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'")."\" height=\"30px\" title=\"'.$champs[$i].'\" alt=\"'.$champs[$i].'\"></td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormUploadFile' ) 
				{
					$text .= 'echo "<td align=\"center\">".$'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'")."</td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormColorPicker' ) 
				{
					$text .= 'echo "<td align=\"center\"><span style=\"background-color:".$'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'")."\">&nbsp;&nbsp;&nbsp;</span> -> ".$'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'")."</td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormTextDateSelect' ) 
				{
					$text .= 'echo "<td align=\"center\">".formatTimeStamp($'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'"),"S")."</td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormTopic' ) 
				{
					$text .= '$'.$tables_name.'1 = $topicHandler->get($'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'"));
					$'.$tables_name.'_topic1 = $'.$tables_name.'1->getVar("topic_title");
					echo "<td align=\"center\">".$'.$tables_name.'_topic1."</td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormSelectUser' ) 
				{
					$text .= 'echo "<td align=\"center\">".XoopsUser::getUnameFromId($'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'"),"S")."</td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormText' || $champs_param_type[$i] == 'XoopsFormDhtmlTextArea' || $champs_param_type[$i] == 'XoopsFormTextArea' ) {
					$text .= 'echo "<td align=\"center\">".$'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'")."</td>";	
					';
				} else if ( $champs_param_type[$i] == 'XoopsFormCheckBox' || $champs_param_type[$i] == 'XoopsFormRadioYN' ) {
					$text .= '
					$verif_'.$champs[$i].' = ( $'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'") == 1 ) ? "oui" : "non";
					echo "<td align=\"center\">".$verif_'.$champs[$i].'."</td>";	
					';
				} else {
					$data = explode("-", $champs_param_type[$i]);
					//Table du select
					$tablesHandler =& xoops_getModuleHandler('TDMCreate_tables', 'TDMCreate');
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria('tables_name', $data[1]));
					$tables_select_arr = $tablesHandler->getall($criteria);

					foreach (array_keys($tables_select_arr) as $k) 
					{
						$tables_select_champs = $tables_select_arr[$k]->getVar('tables_champs');
						$tables_select_parametres = $tables_select_arr[$k]->getVar('tables_parametres');
						
						//Champs
						$champs_total_select = explode("|", $tables_select_champs);
						$nb_champs_select = count($champs_total_select);
						
						//Parametres
						$parametres_total_select = explode("|", $tables_select_parametres);
						
						//Recuperation des noms des tables
						for($l=0; $l<$nb_champs_select; $l++)
						{
							//Nom des champs
							$champs_select1 = explode(":", $champs_total_select[$l]);
							$champs_select[$l] = $champs_select1[0];
							//Afficher dans l'admin
							if( $l != 0 ) {
								$parametres_select = explode(":", $parametres_total_select[$l-1]);
								if ( $parametres_select[4] == 1 ) {
									$champs_param_main_field = $champs_select1[0];
									//echo $champs_param_main_field;
								}
							}	
						}

						$text .= '
						$'.$data[1].' =& $'.$data[1].'Handler->get($'.$tables_name.'_arr[$i]->getVar("'.$champs[$i].'"));
						$title_'.$data[1].' = $'.$data[1].'->getVar("'.$champs_param_main_field.'");	
						echo "<td align=\"center\">".$title_'.$data[1].'."</td>";
						';
					}
					
				}
			}
		}
	} elseif ( $option == 2 ) {
		for($i=0; $i<$nb_champs; $i++)
		{
			if ( $i != 0 ) 
			{
				if ( $champs_param_type[$i] == 'XoopsFormTextDateSelect' )
				{
					$text .= '//Form '.$champs[$i].'
		$obj->setVar("'.$champs[$i].'", strtotime($_REQUEST["'.$champs[$i].'"]));
		';	
				} else if ( $champs_param_type[$i] == 'XoopsFormCheckBox' || $champs_param_type[$i] == 'XoopsFormRadioYN' ) {
					$text .= '//Form '.$champs[$i].'
		$verif_'.$champs[$i].' = ($_REQUEST["'.$champs[$i].'"] == 1) ? "1" : "0";
		$obj->setVar("'.$champs[$i].'", $verif_'.$champs[$i].');
		';
				} else if ( $champs_param_type[$i] == 'XoopsFormUploadImage' ) {
				$text .= '//Form '.$champs[$i].'	
		include_once XOOPS_ROOT_PATH."/class/uploader.php";
		$uploaddir_'.$champs[$i].' = XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'/'.$champs[$i].'/";
		$uploader_'.$champs[$i].' = new XoopsMediaUploader($uploaddir_'.$champs[$i].', $xoopsModuleConfig["'.$champs[$i].'_mimetypes"], $xoopsModuleConfig["'.$champs[$i].'_size"], null, null);

		if ($uploader_'.$champs[$i].'->fetchMedia("'.$champs[$i].'")) {
			$uploader_'.$champs[$i].'->setPrefix("'.$champs[$i].'_") ;
			$uploader_'.$champs[$i].'->fetchMedia("'.$champs[$i].'");
			if (!$uploader_'.$champs[$i].'->upload()) {
				$errors = $uploader_'.$champs[$i].'->getErrors();
				redirect_header("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar("'.$champs[$i].'", $uploader_'.$champs[$i].'->getSavedFileName());
			}
		} else {
			$obj->setVar("'.$champs[$i].'", $_REQUEST["'.$champs[$i].'"]);
		}
		';
				} else if ( $champs_param_type[$i] == 'XoopsFormUploadFile' ) {
				$text .= '//Form '.$champs[$i].'	
		include_once XOOPS_ROOT_PATH."/class/uploader.php";
		$uploaddir_'.$champs[$i].' = XOOPS_ROOT_PATH."/uploads/'.$modules_name.'/'.$tables_name.'/'.$champs[$i].'/";
		$uploader_'.$champs[$i].' = new XoopsMediaUploader($uploaddir_'.$champs[$i].', $xoopsModuleConfig["'.$champs[$i].'_mimetypes"], $xoopsModuleConfig["'.$champs[$i].'_size"], null, null);

		if ($uploader_'.$champs[$i].'->fetchMedia("'.$champs[$i].'")) {
			$uploader_'.$champs[$i].'->setPrefix("'.$champs[$i].'_") ;
			$uploader_'.$champs[$i].'->fetchMedia("'.$champs[$i].'");
			if (!$uploader_'.$champs[$i].'->upload()) {
				$errors = $uploader_'.$champs[$i].'->getErrors();
				redirect_header("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar("'.$champs[$i].'", $uploader_'.$champs[$i].'->getSavedFileName());
			}
		}
		';
				} else {
					$text .= '//Form '.$champs[$i].'
		$obj->setVar("'.$champs[$i].'", $_REQUEST["'.$champs[$i].'"]);
		';	
				}
			}
		}
		
	}
	return $text;
}

function form_elements($i, $modules_name, $tables_module_table, $tables_name, $champs_param_elements, $champs_param_required_field, $language_form, $structure0) 
{
	$language1 = '_AM_'.strtoupper($modules_name).'_';
	$required_field = ( $champs_param_required_field[$i] == 1) ? 'true' : 'false';
	$text = '';
	switch ($champs_param_elements[$i]) 
	{	
		case "0":
		break;
		
		case "XoopsFormText":
			$text .= '$form->addElement(new XoopsFormText('.$language_form.', "'.$structure0.'", 50, 255, $this->getVar("'.$structure0.'")), '.$required_field.');
			';
		break;
		
		case "XoopsFormTextArea":
			$text .= '$form->addElement(new XoopsFormTextArea('.$language_form.', "'.$structure0.'", $this->getVar("'.$structure0.'"), 4, 47), '.$required_field.');
			';
		break;
		
		case "XoopsFormDhtmlTextArea":
			$text .= '$editor_configs=array();
			$editor_configs["name"] ="'.$structure0.'";
			$editor_configs["value"] = $this->getVar("'.$structure0.'", "e");
			$editor_configs["rows"] = 20;
			$editor_configs["cols"] = 80;
			$editor_configs["width"] = "100%";
			$editor_configs["height"] = "400px";
			$editor_configs["editor"] = $xoopsModuleConfig["'.$modules_name.'_editor"];				
			$form->addElement( new XoopsFormEditor('.$language_form.', "'.$structure0.'", $editor_configs), true );
			';
		break;
		
		case "XoopsFormCheckBox":
		$text .= ' $'.$structure0.' = $this->isNew() ? 1 : $this->getVar("'.$structure0.'");
			$check_'.$structure0.' = new XoopsFormCheckBox('.$language_form.', "'.$structure0.'", $'.$structure0.');
			$check_'.$structure0.'->addOption(1, " ");
			$form->addElement($check_'.$structure0.');
			';
		break;
		
		case "XoopsFormHidden":
			$text .= '$form->addElement(new XoopsFormHidden("'.$structure0.'", $this->getVar("'.$structure0.'")));
			';
		break;
		
		case "XoopsFormUploadImage":
			$text .= '
			$'.$structure0.' = $this->getVar("'.$structure0.'") ? $this->getVar("'.$structure0.'") : \'blank.gif\';
		
			$uploadirectory_'.$structure0.' = \'/uploads/'.$modules_name.'/'.$tables_name.'/'.$structure0.'\';
			$imgtray_'.$structure0.' = new XoopsFormElementTray('.$language_form.',\'<br />\');
			$imgpath_'.$structure0.' = sprintf('.$language1.'FORMIMAGE_PATH, $uploadirectory_'.$structure0.');
			$imageselect_'.$structure0.' = new XoopsFormSelect($imgpath_'.$structure0.', \''.$structure0.'\', $'.$structure0.');
			$image_array_'.$structure0.' = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory_'.$structure0.' );
			foreach( $image_array_'.$structure0.' as $image_'.$structure0.' ) {
				$imageselect_'.$structure0.'->addOption("$image_'.$structure0.'", $image_'.$structure0.');
			}
			$imageselect_'.$structure0.'->setExtra( "onchange=\'showImgSelected(\"image_'.$structure0.'\", \"'.$structure0.'\", \"".$uploadirectory_'.$structure0.'."\", \"\", \"".XOOPS_URL."\")\'" );
			$imgtray_'.$structure0.'->addElement($imageselect_'.$structure0.', false);
			$imgtray_'.$structure0.'->addElement( new XoopsFormLabel( \'\', "<br /><img src=\'".XOOPS_URL."/".$uploadirectory_'.$structure0.'."/".$'.$structure0.'."\' name=\'image_'.$structure0.'\' id=\'image_'.$structure0.'\' alt=\'\' />" ) );
		
			$fileseltray_'.$structure0.' = new XoopsFormElementTray(\'\',\'<br />\');
			$fileseltray_'.$structure0.'->addElement(new XoopsFormFile('.$language1.'FORMUPLOAD , "'.$structure0.'", $xoopsModuleConfig["'.$structure0.'_size"]),false);
			$fileseltray_'.$structure0.'->addElement(new XoopsFormLabel(\'\'), false);
			$imgtray_'.$structure0.'->addElement($fileseltray_'.$structure0.');
			$form->addElement($imgtray_'.$structure0.');

			';
		break;
		
		case "XoopsFormUploadFile":
			$text .= '$form->addElement(new XoopsFormFile('.$language_form.', "'.$structure0.'", $xoopsModuleConfig["'.$structure0.'_size"]), '.$required_field.');	
			';
		break;
		
		case "XoopsFormColorPicker":
			$text .= '$form->addElement(new XoopsFormColorPicker('.$language_form.', "'.$structure0.'", $this->getVar("'.$structure0.'")), '.$required_field.');
			';
		break;
		
		case "XoopsFormSelectUser":
			$text .= '$form->addElement(new XoopsFormSelectUser('.$language_form.', "'.$structure0.'", false, $this->getVar("'.$structure0.'"), 1, false), '.$required_field.');
			';
		break;
		case "XoopsFormTopic":
			$text .= '
			include_once(XOOPS_ROOT_PATH."/class/tree.php");
			
			$topicHandler =& xoops_getModuleHandler("'.$modules_name.'_topic", "'.$modules_name.'");
			$arr = $topicHandler->getall();
			$mytree = new XoopsObjectTree($arr, "topic_id", "topic_pid");
			$form->addElement(new XoopsFormLabel('.$language_form.', $mytree->makeSelBox("'.$structure0.'", "topic_title","-", $this->getVar("'.$structure0.'"),'.$required_field.')));
			';
		break;
		
		case "XoopsFormRadioYN":
			$text .= ' $'.$structure0.' = $this->isNew() ? 1 : $this->getVar("'.$structure0.'");
			$form->addElement(new XoopsFormRadioYN('.$language_form.', "'.$structure0.'", $'.$structure0.', _YES, _NO), '.$required_field.');
			';
		break;
		
		case "XoopsFormTextDateSelect":
			$text .= '$form->addElement(new XoopsFormTextDateSelect('.$language_form.', "'.$structure0.'", "", $this->getVar("'.$structure0.'")));
			';
		break;
		
		default:
			$data = explode("-", $champs_param_elements[$i]);

			$text .= '
			$'.$data[1].'Handler =& xoops_getModuleHandler("'.$modules_name.'_'.$data[1].'", "'.$modules_name.'");
			$'.$data[1].'_select = new XoopsFormSelect('.$language_form.', "'.$structure0.'", $this->getVar("'.$structure0.'"));
			$'.$data[1].'_select->addOptionArray($'.$data[1].'Handler->getList());
			$form->addElement($'.$data[1].'_select, '.$required_field.');
			';
	}
	return $text;
}

function UcFirstAndToLower($str)
{
	 return ucfirst(strtolower(trim($str)));
}
?>
