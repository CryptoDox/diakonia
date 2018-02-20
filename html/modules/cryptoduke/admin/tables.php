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
include '../../../include/cp_header.php'; 
include_once("../include/functions.php");
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/class/tdmcreate_tables.php';

xoops_cp_header();
//appele du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMCreate_adminmenu(2, _AM_TDMCREATE_MANAGER_TABLES);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (2,_AM_TDMCREATE_MANAGER_TABLES);
}

if (isset($_REQUEST['op'])) {
	$op = $_REQUEST['op'];
} else {
	@$op = 'default';
}

//load class
$tablesHandler =& xoops_getModuleHandler('TDMCreate_tables', 'TDMCreate');
$modulesHandler =& xoops_getModuleHandler('TDMCreate_modules', 'TDMCreate');

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/deco/tables.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;  height: 48px;"><strong>'._AM_TDMCREATE_MANAGER_TABLES.'</strong>';
echo '</div><br />';

switch ($op) {
	case "tables_save":
	
		/*if (!$GLOBALS['xoopsSecurity']->check()) {
           redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }*/
        if (isset($_REQUEST['tables_id'])) {
           $obj =& $tablesHandler->get($_REQUEST['tables_id']);
        } else {
           $obj =& $tablesHandler->create();
        }

		//Nom du module
		$modules =& $modulesHandler->get($_REQUEST['tables_modules']);
		$modules_name = $modules->getVar('modules_name');
		
		$obj->setVar('tables_modules', $_REQUEST['tables_modules']);
		
		if ( $_REQUEST['select'] ==  1 )
		{
			$obj->setVar('tables_module_table', strtolower($modules_name.'_topic'));
			$obj->setVar('tables_name', 'topic');
			$obj->setVar('tables_blocs', 0);
			$obj->setVar('tables_display_admin', 1);
			$obj->setVar('tables_search', 0);
			$obj->setVar('tables_coms', 0);
			$obj->setVar('tables_nb_champs', 7);
			
			$tables_champs = 'topic_id:int:11:unsigned:NOT NULL: :|topic_pid:int:5:unsigned:NOT NULL:0:|topic_title:varchar:255: :NOT NULL: :|topic_desc:text: : :NOT NULL: :|topic_img:varchar:255: :NOT NULL: :|topic_weight:int:5: :NOT NULL:0:|topic_color:varchar:10: :NULL: :|topic_submitter:int:10: :NOT NULL:0:|topic_date_created:int:10: :NOT NULL:0:|topic_online:tinyint:1: :NOT NULL:0:';
			$tables_parametres = 'XoopsFormTopic:0:0:0:0:0:0|XoopsFormText:1:1:0:1:0:1|XoopsFormTextArea:0:1:0:0:0:1|XoopsFormUploadImage:1:1:0:0:0:0|XoopsFormText:1:1:0:0:0:1|XoopsFormColorPicker:1:1:0:0:0:0|XoopsFormSelectUser:0:0:0:0:0:1|XoopsFormTextDateSelect:0:0:0:0:0:1|XoopsFormCheckBox:1:1:0:0:0:1';
		
			//Image
			include_once XOOPS_ROOT_PATH.'/class/uploader.php';
			$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/tables/";
			$uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile1"]['name']) ;
				$name_img = 'topic.'.$extension;
				$uploader->setTargetFileName($name_img); 
				$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
				if (!$uploader->upload()) {
					$errors = $uploader->getErrors();
					redirect_header("javascript:history.go(-1)",3, $errors);
				} else {
					$obj->setVar('tables_img', $uploader->getSavedFileName());
				}
			} else {
				$obj->setVar('tables_img', $_REQUEST['tables_img1']);
			}		
		} else {
				
			$obj->setVar('tables_module_table', strtolower($modules_name.'_'.$_REQUEST['tables_name']));
			$obj->setVar('tables_name', strtolower($_REQUEST['tables_name']));
			$obj->setVar('tables_blocs', $_REQUEST['tables_blocs']);
			$obj->setVar('tables_display_admin', $_REQUEST['tables_display_admin']);
			$obj->setVar('tables_search', $_REQUEST['tables_search']);
			$obj->setVar('tables_coms', $_REQUEST['tables_coms']);
			$obj->setVar('tables_nb_champs', $_REQUEST['tables_nb_champs']);
			
			$tables_champs = '';
			$tables_parametres = '';
			for($i=0; $i<$_REQUEST['tables_nb_champs']; $i++)
			{
				//Rajouts des parametres: text:on:off: ...
				if ( $i != 0 ) {
					$tables_parametres .= ( !empty($_REQUEST['champs_param_elements'][$i]) ) ? "".$_REQUEST['champs_param_elements'][$i].":" : " :";
					$tables_parametres .= ( !empty($_REQUEST['champs_param_display_admin'][$i]) ) ? "1:" : "0:";
					$tables_parametres .= ( !empty($_REQUEST['champs_param_display_user'][$i]) ) ? "1:" : "0:";
					$tables_parametres .= ( !empty($_REQUEST['champs_param_display_blocs'][$i]) ) ? "1:" : "0:";
					$tables_parametres .= ( $i == $_REQUEST['champs_param_main_field']) ? "1:" : "0:";
					$tables_parametres .= ( !empty($_REQUEST['champs_param_search_field'][$i]) ) ? "1:" : "0:";
					$tables_parametres .= ( !empty($_REQUEST['champs_param_required_field'][$i]) ) ? "1" : "0";
				}

				//Rajouts des champs: test:int:4: ...
				$tables_champs .= (!empty($_REQUEST['champs_name'][$i])) ? "".$_REQUEST['champs_name'][$i].":" : " :";
				$tables_champs .= (!empty($_REQUEST['champs_type'][$i])) ? "".$_REQUEST['champs_type'][$i].":" : " :";
				$tables_champs .= (!empty($_REQUEST['champs_valeur'][$i])) ? "".$_REQUEST['champs_valeur'][$i].":" : " :";
				$tables_champs .= (!empty($_REQUEST['champs_attributs'][$i])) ? "".$_REQUEST['champs_attributs'][$i].":" : " :";
				$tables_champs .= (!empty($_REQUEST['champs_null'][$i])) ? "".strtoupper($_REQUEST['champs_null'][$i]).":" : " :";
				$tables_champs .= (!empty($_REQUEST['champs_default'][$i])) ? "".$_REQUEST['champs_default'][$i].":" : " :";
				$tables_champs .= (!empty($_REQUEST['champs_clef'][$i])) ? "".$_REQUEST['champs_clef'][$i]."" : " ";
				
				//Coupure entre les champs et coupre entre les parametres
				if ( $i != $_REQUEST['tables_nb_champs'] - 1) {
					$tables_champs .= '|';
					if ( $i != 0 )
						$tables_parametres .= '|';
				} else {
					$tables_champs .= '|'.strtolower($_REQUEST['tables_name']).'_submitter:int:10: :NOT NULL:0:|'.strtolower($_REQUEST['tables_name']).'_date_created:int:10: :NOT NULL:0:|'.strtolower($_REQUEST['tables_name']).'_online:tinyint:1: :NOT NULL:0:';
					$tables_parametres .= '|XoopsFormSelectUser:1:1:1:0:0:1|XoopsFormTextDateSelect:1:1:1:0:0:1|XoopsFormCheckBox:1:1:1:0:0:1';
				}
			}
		}
		
		$obj->setVar('tables_champs', $tables_champs);
		$obj->setVar('tables_parametres', $tables_parametres);
    
		if ($tablesHandler->insert($obj)) 
		{
		   redirect_header('tables.php?op=default', 2, _AM_TDMCREATE_FORMOK);
		}
		
	break;
	
	case "tables_save1":
	
			if (!$GLOBALS['xoopsSecurity']->check()) {
			   redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}

			if (isset($_REQUEST['tables_id'])) {
			   $obj =& $tablesHandler->get($_REQUEST['tables_id']);
			} else {
			   $obj =& $tablesHandler->create();
			}
			//Nom du module
			$modules =& $modulesHandler->get($_REQUEST['tables_modules']);
			$modules_name = $modules->getVar('modules_name');
		
			$tables_blocs = (isset($_REQUEST['tables_blocs'])) ? $_REQUEST['tables_blocs'] : '0';
			$tables_display_admin = (isset($_REQUEST['tables_display_admin'])) ? $_REQUEST['tables_display_admin'] : '0';
			$tables_search = (isset($_REQUEST['tables_search'])) ? $_REQUEST['tables_search'] : '0';
			$tables_coms = (isset($_REQUEST['tables_coms'])) ? $_REQUEST['tables_coms'] : '0';
			$select = (isset($_REQUEST['select'])) ? $_REQUEST['select'] : '0';
			
			//Image
			include_once XOOPS_ROOT_PATH.'/class/uploader.php';
			$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/tables/";
			$uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile"]['name']) ;
				$name_img = $_REQUEST['tables_name'].'.'.$extension;
				$uploader->setTargetFileName($name_img); 
				$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
				if (!$uploader->upload()) {
					$errors = $uploader->getErrors();
					redirect_header("javascript:history.go(-1)",3, $errors);
				} else {
					$obj->setVar('tables_img', $uploader->getSavedFileName());
				}
			} else {
				$obj->setVar('tables_img', $_REQUEST['tables_img']);
			}
			
			$obj->setVar('tables_modules', strtolower($_REQUEST['tables_modules']));
			$obj->setVar('tables_module_table', strtolower($modules_name.'_'.$_REQUEST['tables_name']));
			$obj->setVar('tables_name', strtolower($_REQUEST['tables_name']));
			$obj->setVar('tables_blocs', $_REQUEST['tables_blocs']);
			$obj->setVar('tables_display_admin', $_REQUEST['tables_display_admin']);
			//mettre des isset pour search
			if ( isset($_REQUEST['tables_search']) )
				$obj->setVar('tables_search', $_REQUEST['tables_search']);
			if ( isset($_REQUEST['tables_coms']) )
				$obj->setVar('tables_coms', $_REQUEST['tables_coms']);
			$obj->setVar('tables_nb_champs', $_REQUEST['tables_nb_champs']);
				
			if ($tablesHandler->insert($obj)) {
				redirect_header('tables.php?op=default', 2, _AM_TDMCREATE_FORMOK);
			}	
	break;
	
	case "edit_tables":
		$obj =& $tablesHandler->get($_REQUEST['tables_id']);
		$form = $obj->getFormTable();
	break;
	
	case "edit_champs":
		$obj =& $tablesHandler->get($_REQUEST['tables_id']);
		$form = $obj->getFormEditChamps(false, $_REQUEST['tables_id']);
	break;
		
	case "delete_tables":
		$obj =& $tablesHandler->get($_REQUEST['tables_id']);
		if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($tablesHandler->delete($obj)) {
				redirect_header('tables.php', 3, _AM_TDMCREATE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array('ok' => 1, 'tables_id' => $_REQUEST['tables_id'], 'op' => 'delete_tables'), $_SERVER['REQUEST_URI'], sprintf(_AM_TDMCREATE_FORMSUREDEL, $obj->getVar('tables_name')));
		}
	break;
	
	case "modules_save":
		if (!$GLOBALS['xoopsSecurity']->check()) {
           redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($_REQUEST['modules_id'])) {
           $obj =& $modulesHandler->get($_REQUEST['modules_id']);
        } else {
           $obj =& $modulesHandler->create();
        }
		
		//Image
		include_once XOOPS_ROOT_PATH.'/class/uploader.php';
	    $uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/modules/";
        $uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile"]['name']) ;
			$name_img = $_REQUEST['modules_name'].'Logo.'.$extension;
			$uploader->setTargetFileName($name_img); 
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header("javascript:history.go(-1)",3, $errors);
			} else {
				$obj->setVar('modules_image', $uploader->getSavedFileName());
			}
		} else {
			$obj->setVar('modules_image', $_REQUEST['modules_image']);
        }
		
		$obj->setVar('modules_name', $_REQUEST['modules_name']);
        $obj->setVar('modules_version', $_REQUEST['modules_version']);
        $obj->setVar('modules_description', $_REQUEST['modules_description']);
        $obj->setVar('modules_author', $_REQUEST['modules_author']);
		$obj->setVar('modules_author_website_url', $_REQUEST['modules_author_website_url']);
        $obj->setVar('modules_author_website_name', $_REQUEST['modules_author_website_name']);
        $obj->setVar('modules_credits', $_REQUEST['modules_credits']);
        $obj->setVar('modules_license', $_REQUEST['modules_license']);
		$obj->setVar('modules_release_info', $_REQUEST['modules_release_info']);
        $obj->setVar('modules_release_file', $_REQUEST['modules_release_file']);
        $obj->setVar('modules_manual', $_REQUEST['modules_manual']);
        $obj->setVar('modules_manual_file', $_REQUEST['modules_manual_file']);
        $obj->setVar('modules_demo_site_url', $_REQUEST['modules_demo_site_url']);
        $obj->setVar('modules_demo_site_name', $_REQUEST['modules_demo_site_name']);
        $obj->setVar('modules_module_website_url', $_REQUEST['modules_module_website_url']);
		$obj->setVar('modules_module_website_name', $_REQUEST['modules_module_website_name']);
        $obj->setVar('modules_release', $_REQUEST['modules_release']);
        $obj->setVar('modules_module_status', $_REQUEST['modules_module_status']);
		
		$obj->setVar('modules_display_menu', $_REQUEST['modules_display_menu']);
		$obj->setVar('modules_display_admin', $_REQUEST['modules_display_admin']);
		$obj->setVar('modules_active_search', $_REQUEST['modules_active_search']);
		 
        if ($modulesHandler->insert($obj)) {
           redirect_header('tables.php?op=default', 2, _AM_TDMCREATE_FORMOK);
        }	
	break;
	
	case "edit_modules":
		$obj =& $modulesHandler->get($_REQUEST['modules_id']);
		$form = $obj->getForm();
	break;
	
	case "delete_modules":
		$obj =& $modulesHandler->get($_REQUEST['modules_id']);
		if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
			if (!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if ($modulesHandler->delete($obj)) {
				$xoopsDB->queryF("DELETE FROM ".$xoopsDB->prefix("tdmcreate_tables")." WHERE tables_modules = ".$_REQUEST['modules_id']);
				redirect_header('tables.php', 3, _AM_TDMCREATE_FORMDELOK);
			} else {
				echo $obj->getHtmlErrors();
			}
		} else {
			xoops_confirm(array('ok' => 1, 'modules_id' => $_REQUEST['modules_id'], 'op' => 'delete_modules'), $_SERVER['REQUEST_URI'], sprintf(_AM_TDMCREATE_FORMSUREDEL, $obj->getVar('modules_name')));
		}
	break;
	
	case "tables_champs":
	
		//Champs existe deja ?
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('tables_name', $_REQUEST['tables_name']));
		$nb_tables1 = $tablesHandler->getCount($criteria);
	
		if ( $nb_tables1 < 1 )
		{
			if (!$GLOBALS['xoopsSecurity']->check()) {
			   redirect_header('tables.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if (isset($_REQUEST['tables_id'])) {
			   $obj =& $tablesHandler->get($_REQUEST['tables_id']);
			} else {
			   $obj =& $tablesHandler->create();
			}
			$tables_blocs = (isset($_REQUEST['tables_blocs'])) ? $_REQUEST['tables_blocs'] : '0';
			$tables_display_admin = (isset($_REQUEST['tables_display_admin'])) ? $_REQUEST['tables_display_admin'] : '0';
			$tables_search = (isset($_REQUEST['tables_search'])) ? $_REQUEST['tables_search'] : '0';
			$tables_coms = (isset($_REQUEST['tables_coms'])) ? $_REQUEST['tables_coms'] : '0';
			$select = (isset($_REQUEST['select'])) ? $_REQUEST['select'] : '0';
			
			//Image
			include_once XOOPS_ROOT_PATH.'/class/uploader.php';
			$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/images/uploads/tables/";
			$uploader = new XoopsMediaUploader($uploaddir, "gif|jpeg|pjpeg|png", 104857600, null, null);

			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				$extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES["attachedfile"]['name']) ;
				$name_img = $_REQUEST['tables_name'].'.'.$extension;
				$uploader->setTargetFileName($name_img); 
				$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
				if (!$uploader->upload()) {
					$errors = $uploader->getErrors();
					redirect_header("javascript:history.go(-1)",3, $errors);
				} else {
					$obj->setVar('tables_img', $uploader->getSavedFileName());
				}
			} else {
				$obj->setVar('tables_img', $_REQUEST['tables_img']);
			}
				
			if ($tablesHandler->insert($obj)) {
				$tables_id = $xoopsDB->getInsertId();
				$obj = $tablesHandler->get($tables_id);
				$form = $obj->getFormChamps(false, $tables_id, intval($_REQUEST['tables_modules']), strtolower($_REQUEST['tables_name']), $tables_blocs, $tables_display_admin, $tables_search, $tables_coms, intval($_REQUEST['tables_nb_champs']), $select);
			}	
		} else {
			redirect_header('tables.php?op=default', 2, _AM_TDMCREATE_TABLES_EXIST);
		}
	break;
	
	case "default":
	default:
	
		//Retirer les tables inutiles
		$sql = "SELECT tables_id FROM ".$xoopsDB->prefix("tdmcreate_tables")." WHERE tables_modules = 0";
		$result = $xoopsDB->queryF($sql);
		while ( $myrow = $xoopsDB->fetchArray($result) ) 
		{
			$sql_del = "DELETE FROM ".$xoopsDB->prefix("tdmcreate_tables")." WHERE tables_id = ".$myrow['tables_id']."";
			$xoopsDB->queryF($sql_del);
		}
		
	    $criteria = new CriteriaCompo();
        $criteria->setSort('modules_name');
        $criteria->setOrder('ASC');
		$modules_arr = $modulesHandler->getall($criteria);
		$numrows_modules = $modulesHandler->getCount();
		
        if ( $numrows_modules > 0 ) 
		{
			echo '<table width="100%" cellspacing="1" class="outer">';
			echo '<tr>';
			echo '<th align="center" width="40%">'._AM_TDMCREATE_NAME.'</th>';
			echo '<th align="center" width="10%">'._AM_TDMCREATE_IMAGE.'</th>';
			echo '<th align="center" width="10%">'._AM_TDMCREATE_DISPLAY_ADMIN.'</th>';
			echo '<th align="center" width="10%">'._AM_TDMCREATE_BLOCS.'</th>';
			echo '<th align="center" width="10%">'._AM_TDMCREATE_NB_CHAMPS.'</th>';
			echo '<th align="center" width="20%">'._AM_TDMCREATE_FORMACTION.'</th>';			
			echo '</tr>';
			$class = 'odd';
            foreach (array_keys($modules_arr) as $i) 
			{                                  
                    $modules_id = $modules_arr[$i]->getVar('modules_id');
                    $modules_name = $modules_arr[$i]->getVar('modules_name');
					$modules_image = $modules_arr[$i]->getVar('modules_image');
                    echo '<tr class="odd">';
                    echo '<td align="left"><b>'.$modules_name.'</b></td>';
					echo '<td align="center"><img src="../images/uploads/modules/'.$modules_image.'" height="30px"></td>';
                    echo '<td align="left">&nbsp;</td>';
					echo '<td align="left">&nbsp;</td>';
					echo '<td align="left">&nbsp;</td>';
					echo '<td align="center">';
                    echo '<a href="tables.php?op=edit_modules&modules_id='.$modules_id.'"><img src="../images/deco/edit.gif" alt="'._AM_TDMCREATE_FORMEDIT.'" title="'._AM_TDMCREATE_FORMEDIT.'"></a>&nbsp;<a href="tables.php?op=delete_modules&modules_id='.$modules_id.'"><img src="../images/deco/delete.gif" alt="'._AM_TDMCREATE_FORMDEL.'" title="'._AM_TDMCREATE_FORMDEL.'"></a>';
                    echo '</td>';                    
                    echo '</tr>';
					
                    $criteria = new CriteriaCompo();
                    $criteria->add(new Criteria('tables_modules', $modules_id));
                    $criteria->setSort('tables_name');
                    $criteria->setOrder('ASC');
                    $tables_arr = $tablesHandler->getall($criteria);
					$numrows_tables = $tablesHandler->getCount();
                    if ( $numrows_tables != 0 )
					{
						foreach (array_keys($tables_arr) as $i) 
						{
							$tables_id = $tables_arr[$i]->getVar('tables_id');
							$tables_modules = $tables_arr[$i]->getVar('tables_modules');
							$tables_name = $tables_arr[$i]->getVar('tables_name');
							$tables_img = $tables_arr[$i]->getVar('tables_img');
							$tables_blocs = $tables_arr[$i]->getVar('tables_blocs');
							$tables_champs = $tables_arr[$i]->getVar('tables_champs');
							$tables_display_admin = $tables_arr[$i]->getVar('tables_display_admin');
							$champs = explode("|", $tables_champs);
							$nb_champs = $tables_arr[$i]->getVar('tables_nb_champs');
							$display_admin = ($tables_display_admin == 1) ? _YES : _NO;
							$blocs = ($tables_blocs == 1) ? _YES : _NO;
							echo '<tr class="even">';
							echo '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>- '.$tables_name.'</b></a></td>';
							echo '<td align="center"><img src="../images/uploads/tables/'.$tables_img.'" height="30px"></td>';
							echo '<td align="center">'.$display_admin.'</td>';
							echo '<td align="center">'.$blocs.'</td>';
							echo '<td align="center">'.$nb_champs.'</td>';
							echo '<td align="center">';
							echo '<a href="tables.php?op=edit_tables&tables_id='.$tables_id.'"><img src="../images/deco/edit.gif" alt="'._AM_TDMCREATE_FORMEDIT.'" title="'._AM_TDMCREATE_FORMEDIT.'"></a>&nbsp;<a href="tables.php?op=edit_champs&tables_id='.$tables_id.'"><img src="../images/deco/fields.png" alt="'._AM_TDMCREATE_FORMCHAMPS.'" title="'._AM_TDMCREATE_FORMCHAMPS.'"></a>&nbsp;<a href="tables.php?op=delete_tables&tables_id='.$tables_id.'"><img src="../images/deco/delete.gif" alt="'._AM_TDMCREATE_FORMDEL.'" title="'._AM_TDMCREATE_FORMDEL.'"></a>';
							echo '</td>';        
							echo '</tr>';
						}
                    }
            }
			echo '</table><br><br>';
		}
		
		$obj =& $tablesHandler->create();
		$form = $obj->getFormTable();
		echo '<br><br>';
		$result = $xoopsDB->queryF("SELECT COUNT(*) FROM " . $xoopsDB->prefix("tdmcreate_tables")." WHERE tables_name = 'topic'");
		list( $topic ) = $xoopsDB->fetchRow($result);

		if ( $topic == 0 ) {
			$form = $obj->getFormTopic();
		}
		
		//ici
	break;
}
xoops_cp_footer();
?>