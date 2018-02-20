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

function const_class($modules, $modules_name, $tables_module_table, $tables_name, $tables_champs, $tables_parametres)
{
	$language = '_AM_'.strtoupper($modules_name).'_';
	$modules_name_minuscule = strtolower($modules_name);
	$class_name = $tables_name;
	$class_file = $class_name.".php";
	$class_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/class/".$class_file;
	$constructor = const_champs($modules_name, $tables_module_table, $tables_name, $tables_champs, $language, 0, 0, 0, 0);
	$en_tete = const_entete($modules, 0);
	
	//Champs
	$champs_total = explode("|", $tables_champs);
	$nb_champs = count($champs_total);
	//print_r($champs_total);
	//Parametres
	$parametres_total = explode("|", $tables_parametres);

	//Recuperation des parametres affichage dans le formulaire
	for($i=0; $i<$nb_champs; $i++)
	{
		$champs = explode(":", $champs_total[$i]);
		//Afficher dans les elements du formulaire et choisir le type
			if( $i == 0 ) {
				$champs_param_elements[$i] = '0';
				$champs_param_display_form[$i] = '0';
			} else {
				$parametres1 = explode(":", $parametres_total[$i-1]);
				//print_r($parametres1);
				$champs_param_display_form[$i] = $parametres1[3];
				$champs_param_elements[$i] = $parametres1[0];
				$champs_param_required_field[$i] = $parametres1[6];
				if ( $parametres1[4] == 1 ) {
					$champs_param_main_field = $champs[0];
				}
			}
	}
	
	$form = const_champs($modules_name, $tables_module_table, $tables_name, $tables_champs, $language, $champs_param_display_form, $champs_param_elements,$champs_param_required_field, 1);

	$text = '<?php'.$en_tete.'
	
	if (!defined("XOOPS_ROOT_PATH")) {
		die("XOOPS root path not defined");
	}

	if (!class_exists("XoopsPersistableObjectHandler")) {
		include_once XOOPS_ROOT_PATH."/modules/'.$modules_name.'/class/object.php";
	}

	class '.$tables_module_table.' extends XoopsObject
	{ 
		//Constructor
		function __construct()
		{
			$this->XoopsObject();';
			$text .= '
			'.$constructor.'
			// Pour autoriser le html
			$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
		';
	$text .= '	
		}

		function '.$tables_module_table.'()
		{
			$this->__construct();
		}
	
		function getForm($action = false)
		{
			global $xoopsDB, $xoopsModuleConfig;
		
			if ($action === false) {
				$action = $_SERVER["REQUEST_URI"];
			}
		
			$title = $this->isNew() ? sprintf('.$language.strtoupper($tables_name).'_ADD) : sprintf('.$language.strtoupper($tables_name).'_EDIT);

			include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

			$form = new XoopsThemeForm($title, "form", $action, "post", true);
			$form->setExtra(\'enctype="multipart/form-data"\');
			
			';
			
			$text .= ''.$form.'';
			
			$text .= '
			$form->addElement(new XoopsFormHidden("op", "save_'.$tables_name.'"));
			$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			$form->display();
			return $form;
		}
	}';

	$text .= '
	class '.$modules_name.$tables_module_table.'Handler extends XoopsPersistableObjectHandler 
	{

		function __construct(&$db) 
		{
			parent::__construct($db, "'.$tables_module_table.'", "'.$tables_module_table.'", "'.$tables_name.'_id", "'.$champs_param_main_field.'");
		}

	}
	
?>';
		
	//Integration du contenu dans la classe
	$handle = fopen($class_path_file ,"w");

	if (is_writable($class_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'.sprintf(_AM_TDMCREATE_CONST_NOTOK_CLASS,$tables_name).'<br>'.$class_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'.sprintf(_AM_TDMCREATE_CONST_OK_CLASS,$tables_name).'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'.sprintf(_AM_TDMCREATE_CONST_NOTOK_CLASS,$tables_name).'<br>'.$class_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>