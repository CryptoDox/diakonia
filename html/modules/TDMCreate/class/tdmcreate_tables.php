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

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

if (!class_exists('XoopsPersistableObjectHandler')) {
  include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/class/object.php';
}

class tdmcreate_tables extends XoopsObject
{ 

	//Constructor
	function __construct()
	{
		$this->XoopsObject();
		$this->initVar("tables_id",XOBJ_DTYPE_INT,null,false,5);
		$this->initVar("tables_modules",XOBJ_DTYPE_INT,null,false, 5);
		$this->initVar("tables_module_table",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("tables_name",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("tables_img",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("tables_nb_champs",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("tables_champs",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("tables_parametres",XOBJ_DTYPE_TXTBOX,null,false);
		$this->initVar("tables_blocs",XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar("tables_display_admin",XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar("tables_search",XOBJ_DTYPE_INT,null,false, 1);
		$this->initVar("tables_coms",XOBJ_DTYPE_INT,null,false, 1);
	}
	
	//Constructor
	function tdmcreate_tables()
    {
        $this->__construct();
    }
	
	//Formulaire de saisi de champs
    function getFormChamps($action = false, $tables_id, $tables_modules, $tables_name, $tables_blocs, $tables_display_admin, $tables_search, $tables_coms, $tables_nb_champs, $select)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = XOOPS_URL.'/modules/TDMCreate/admin/tables.php';
        }
		$class = 'even';
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_CHAMPS_ADD) : sprintf(_AM_TDMCREATE_TABLES_CHAMPS_EDIT);

        echo "<FORM Method='POST' Action='".$action."?op=tables_save&tables_modules=".$tables_modules."&tables_id=".$tables_id."&tables_name=".$tables_name."&tables_blocs=".$tables_blocs."&tables_display_admin=".$tables_display_admin."&tables_search=".$tables_search."&tables_coms=".$tables_coms."&tables_nb_champs=".$tables_nb_champs."&select=".$select."'>
				<table border='0'  width='100%' cellspacing='1' class='outer'>
					<tr>
						<td colspan='8' class='head' align='center'>".$title."</td>
					</tr>
					<tr class='head'>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_NAME."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_TYPE."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_VALEUR."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_ATTRIBUTS."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_NULL."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_DEFAULT."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_CLEF."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE."</td>
					</tr>";
					for($i=0; $i<$tables_nb_champs ; $i++)
					{
						$table_id = ( $i == 0 ) ? strtolower($tables_name).'_id' : strtolower($tables_name).'_';
						$table_primary = ( $i == 0 ) ? "checked" : "";
						$table_valeur = ( $i == 0 ) ? "8" : "";
						
						$class = ($class == 'even') ? 'odd' : 'even';
						echo "<tr class=".$class.">
								<td align='center'><INPUT type='text' size='10' value='".$table_id."' name='champs_name[".$i."]'></td>
								<td align='center'><SELECT name='champs_type[".$i."]'>
										<OPTION VALUE='int'>INT</OPTION>
										<OPTION VALUE='tinyint'>TINYINT</OPTION>
										<OPTION VALUE='smallint'>SMALLINT</OPTION>
										<OPTION VALUE='decimal'>DECIMAL</OPTION>
										<OPTION VALUE='varchar'>VARCHAR</OPTION>
										<OPTION VALUE='text'>TEXT</OPTION>
										<OPTION VALUE='longtext'>LONGTEXT</OPTION>
										<OPTION VALUE='date'>DATE</OPTION>
										<OPTION VALUE='timestamp'>TIMESTAMP</OPTION>
										<OPTION VALUE='time'>TIME</OPTION>
										<OPTION VALUE='year'>YEAR</OPTION>
									</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='champs_valeur[".$i."]' value='".$table_valeur."'></td>
								<td align='center'><SELECT name='champs_attributs[".$i."]'>
										<OPTION VALUE=''></OPTION>
										<OPTION VALUE='unsigned'>UNSIGNED</OPTION>
										<OPTION VALUE='ON UPDATE CURRENT_TIMESTAMP'>on update CURRENT_TIMESTAMP</OPTION>
									</SELECT></td>
								<td align='center'><SELECT name='champs_null[".$i."]'>
										<OPTION VALUE='not null'>NOT NULL</OPTION>
										<OPTION VALUE='null'>NULL</OPTION>
									</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='champs_default[".$i."]'></td>
								<td align='center'><SELECT name='champs_clef[".$i."]'>
										<OPTION VALUE=''></OPTION>
										<OPTION VALUE='primary'>PRIMARY</OPTION>
										<OPTION VALUE='unique'>UNIQUE</OPTION>
										<OPTION VALUE='index'>INDEX</OPTION>
										<OPTION VALUE='fulltext'>FULLTEXT</OPTION>
									</SELECT></td>
								<td align='center'>";
								if ( $i != 0 ) {
									echo "<table border='0' style='border-color:#666666'; width='100%' cellspacing='1' class='outer'>
											<tr>
												<td align='left' class='head' width='95%'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_ELEMENTS."</td>
												<td align='right' class='even' width='5%'>
													<SELECT name='champs_param_elements[".$i."]'>
														<OPTION VALUE='XoopsFormText'>Text</OPTION>
														<OPTION VALUE='XoopsFormTextArea'>TextArea</OPTION>
														<OPTION VALUE='XoopsFormDhtmlTextArea'>DhtmlTextArea</OPTION>
														<OPTION VALUE='XoopsFormCheckBox'>CheckBox</OPTION>
														<OPTION VALUE='XoopsFormRadioYN'>RadioYN</OPTION>
														<OPTION VALUE='XoopsFormSelectUser'>SelectUser</OPTION>
														<OPTION VALUE='XoopsFormColorPicker'>ColorPicker</OPTION>
														<OPTION VALUE='XoopsFormUploadImage'>UploadImage</OPTION>
														<OPTION VALUE='XoopsFormUploadFile'>UploadFile</OPTION>
														<OPTION VALUE='XoopsFormTextDateSelect'>TextDateSelect</OPTION>";
														$tablesHandler =& xoops_getModuleHandler('TDMCreate_tables', 'TDMCreate');
														$criteria = new CriteriaCompo();
														$criteria->add(new Criteria('tables_modules', $tables_modules));
														$criteria->setSort('tables_name');
														$criteria->setOrder('ASC');
														$tables_arr1 = $tablesHandler->getall($criteria);
														
														foreach (array_keys($tables_arr1) as $j) 
														{                                  
															$tables_name1 = $tables_arr1[$j]->getVar('tables_name');
															if ( $tables_name1 != 'topic' ) {
																echo "<OPTION VALUE='XoopsFormTables-".$tables_name1."'>Table : ".$tables_name1."</OPTION>";
															} else {
																echo "<OPTION VALUE='XoopsFormTopic'>Table : topic</OPTION>";
															}	
														}
														
													echo "
													</SELECT>
												</td>
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_DISPLAY_ADMIN."</td>
												<td align='right' class='even'><INPUT type='checkbox' size='4' name='champs_param_display_admin[".$i."]' checked></td>
											</tr>
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_DISPLAY_USER."</td>
												<td align='right' class='even'><INPUT type='checkbox' size='4' name='champs_param_display_user[".$i."]' checked></td>
											</tr>
											";
											//Afficher la case blocs
											if ( $tables_blocs == 1 ) 
											{
												//Pour l'affichage dans les blocs
												$checked_blocs = ( $i == 1 || $i == 2 ) ? "checked" : "";
												echo "<tr>
														<td align='left' class='head'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_BLOC."</td>
														<td align='right' class='even'><INPUT type='checkbox' size='4' name='champs_param_display_blocs[".$i."]' ".$checked_blocs."></td>
													  </tr>";
											}
											$checked_main_field = ( $i == 1 ) ? "checked" : "";
											echo "
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_MAIN_FIELD."</td>
												<td align='right' class='even'><INPUT type='radio'  value='".$i."' name='champs_param_main_field' ".$checked_main_field."></td>
											</tr>";
											
											//Afficher la case blocs
											if ( $tables_blocs == 1 ) 
											{
												echo "
												<tr>
													<td align='left' class='head'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_SEARCH."</td>
													<td align='right' class='even'><INPUT type='checkbox' size='4' name='champs_param_search_field[".$i."]' checked></td>
												</tr>";
											}
											echo "
											<tr>
												<td align='left' class='head'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE_REQUIRED."</td>
												<td align='right' class='even'><INPUT type='checkbox' size='4' name='champs_param_required_field[".$i."]' checked></td>
											</tr>											
										</table>";
								}
						echo "</td></tr>";
					}
			  echo "<tr>
						<td colspan='8' class='head' align='right'><input type='submit' value='Valider'></td>
					</tr>";
		  echo "</table>
			  </FORM>";
	}
	
	//Formulaire d'edition de champs
    function getFormEditChamps($action = false, $tables_id)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
            $action = XOOPS_URL.'/modules/TDMCreate/admin/tables.php';
        }
		$class = 'even';
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_CHAMPS_ADD) : sprintf(_AM_TDMCREATE_TABLES_CHAMPS_EDIT);
		//Donnees
		//$tables_id = $this->getVar('tables_id');
		$tables_modules = $this->getVar('tables_modules');
		$tables_modules_table = $this->getVar('tables_modules_table');
		$tables_name = $this->getVar('tables_name');
		$tables_img = $this->getVar('tables_img');
		$tables_nb_champs = $this->getVar('tables_nb_champs');
		$tables_champs = $this->getVar('tables_champs');
		$tables_parametres = $this->getVar('tables_parametres');
		$tables_blocs = $this->getVar('tables_blocs');
		$tables_display_admin = $this->getVar('tables_display_admin');
		$tables_search = $this->getVar('tables_search');
		$tables_coms = $this->getVar('tables_coms');
		$select = 0;
		
		$champs_total = explode("|", $tables_champs);
		$count_champs = count($champs_total); 
		$count_champs -= 3;
		
		$parametres_total = explode("|", $tables_parametres);
		$count_parametres = count($parametres_total);
		$count_parametres -= 3;
		//echo $count_parametres;
		//Champs
		for($i=0; $i<$tables_nb_champs; $i++)
		{
			if ( $i >= $count_champs ) {
				$champs_name[$i] = '';
				$champs_type[$i] = '';
				$champs_valeur[$i] = '';
				$champs_attributs[$i] = '';
				$champs_null[$i] = '';
				$champs_default[$i] = '';
				$champs_clef[$i] = '';
			} else {
				$champs = explode(":", $champs_total[$i]);
			
				$champs_name[$i] = $champs[0];
				$champs_type[$i] = $champs[1];
				$champs_valeur[$i] = $champs[2];
				$champs_attributs[$i] = $champs[3];
				$champs_null[$i] = $champs[4];
				$champs_default[$i] = $champs[5];
				$champs_clef[$i] = $champs[6];
			}
		}
		//Parametres
		for($i=0; $i<$tables_nb_champs; $i++)
		{
			if ( $i == 0 || $i > $count_parametres) {	
				$param_elements[$i] = '0';
				$param_display_admin[$i] = '0';
				$param_display_user[$i] = '0';
				$param_display_blocs[$i] = '0';
			} else {
				$parametres = explode(":", $parametres_total[$i-1]);
				$param_elements[$i] = $parametres[0];
				$param_display_admin[$i] = $parametres[1];
				$param_display_user[$i] = $parametres[2];
				$param_display_blocs[$i] = $parametres[3];
				$param_display_main_field[$i] = $parametres[4];
				$champs_param_search_field[$i] = $parametres[5];
				$champs_param_required_field[$i] = $parametres[6];
			}
		}

        echo "<FORM Method='POST' Action='".$action."?op=tables_save&tables_modules=".$tables_modules."&tables_id=".$tables_id."&tables_name=".$tables_name."&tables_blocs=".$tables_blocs."&tables_display_admin=".$tables_display_admin."&tables_search=".$tables_search."&tables_coms=".$tables_coms."&tables_nb_champs=".$tables_nb_champs."&select=".$select."'>
				<table border='0'  width='100%' cellspacing='1' class='outer'>
					<tr>
						<td colspan='8' class='head' align='center'>".$title."</td>
					</tr>
					<tr class='head'>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_NAME."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_TYPE."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_VALEUR."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_ATTRIBUTS."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_NULL."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_DEFAULT."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_CLEF."</td>
								<td align='center'>"._AM_TDMCREATE_TABLES_CHAMPS_MORE."</td>
					</tr>";
					for($i=0; $i<$tables_nb_champs ; $i++)
					{						
						$class = ($class == 'even') ? 'odd' : 'even';
						echo "<tr class=".$class.">
								<td align='center'><INPUT type='text' size='9' value='".$champs_name[$i]."' name='champs_name[".$i."]'></td>
								<td align='center'><SELECT name='champs_type[".$i."]'>";
									if ( $champs_type[$i] == 'int' ) {
										echo "<OPTION VALUE='int' selected>INT</OPTION>";
									} else {
										echo "<OPTION VALUE='int'>INT</OPTION>";
									}
									if ( $champs_type[$i] == 'tinyint' ) {
										echo "<OPTION VALUE='tinyint' selected>TINYINT</OPTION>";
									} else {
										echo "<OPTION VALUE='tinyint'>TINYINT</OPTION>";
									}
									if ( $champs_type[$i] == 'smallint' ) {
										echo "<OPTION VALUE='smallint' selected>SMALLINT</OPTION>";
									} else {
										echo "<OPTION VALUE='smallint'>SMALLINT</OPTION>";
									}
									if ( $champs_type[$i] == 'decimal' ) {
										echo "<OPTION VALUE='decimal' selected>DECIMAL</OPTION>";
									} else {
										echo "<OPTION VALUE='decimal'>DECIMAL</OPTION>";
									}
									if ( $champs_type[$i] == 'varchar' ) {
										echo "<OPTION VALUE='varchar' selected>VARCHAR</OPTION>";
									} else {
										echo "<OPTION VALUE='varchar'>VARCHAR</OPTION>";
									}
									if ( $champs_type[$i] == 'text' ) {
										echo "<OPTION VALUE='text' selected>TEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='text'>TEXT</OPTION>";
									}
									if ( $champs_type[$i] == 'longtext' ) {
										echo "<OPTION VALUE='longtext' selected>LONGTEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='longtext'>LONGTEXT</OPTION>";
									}
									if ( $champs_type[$i] == 'date' ) {
										echo "<OPTION VALUE='date' selected>DATE</OPTION>";
									} else {
										echo "<OPTION VALUE='date'>DATE</OPTION>";
									}
									if ( $champs_type[$i] == 'timestamp' ) {
										echo "<OPTION VALUE='timestamp' selected>TIMESTAMP</OPTION>";
									} else {
										echo "<OPTION VALUE='timestamp'>TIMESTAMP</OPTION>";
									}
									if ( $champs_type[$i] == 'time' ) {
										echo "<OPTION VALUE='time' selected>TIME</OPTION>";
									} else {
										echo "<OPTION VALUE='time'>TIME</OPTION>";
									}
									if ( $champs_type[$i] == 'year' ) {
										echo "<OPTION VALUE='year' selected>YEAR</OPTION>";
									} else {
										echo "<OPTION VALUE='year'>YEAR</OPTION>";
									}
									echo "
									</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='champs_valeur[".$i."]' value='".$champs_valeur[$i]."'></td>
								<td align='center'><SELECT name='champs_attributs[".$i."]'>";
									if ( $champs_attributs[$i] == '' ) {
										echo "<OPTION VALUE='' selected></OPTION>";
									} else {
										echo "<OPTION VALUE=''></OPTION>";
									}
									if ( $champs_attributs[$i] == 'unsigned' ) {
										echo "<OPTION VALUE='unsigned' selected>UNSIGNED</OPTION>";
									} else {
										echo "<OPTION VALUE='unsigned'>UNSIGNED</OPTION>";
									}
									if ( $champs_attributs[$i] == 'unsigned zerofill' ) {
										echo "<OPTION VALUE='ON UPDATE CURRENT_TIMESTAMP' selected>on update CURRENT_TIMESTAMP</OPTION>";
									} else {
										echo "<OPTION VALUE='ON UPDATE CURRENT_TIMESTAMP'>ON UPDATE CURRENT_TIMESTAMP</OPTION>";
									}
								
								echo "</SELECT></td>
								<td align='center'><SELECT name='champs_null[".$i."]'>";
									if ( $champs_null[$i] == 'not null' ) {
										echo "<OPTION VALUE='NOT NULL' selected>not null</OPTION>";
									} else {
										echo "<OPTION VALUE='not null'>NOT NULL</OPTION>";
									}
									if ( $champs_null[$i] == 'NULL' ) {
										echo "<OPTION VALUE='null' selected>NULL</OPTION>";
									} else {
										echo "<OPTION VALUE='null'>NULL</OPTION>";
									}
								echo "</SELECT></td>
								<td align='center'><INPUT type='text' size='2' name='champs_default[".$i."]' value='".$champs_default[$i]."'></td>
								<td align='center'><SELECT name='champs_clef[".$i."]'>";
									if ( $champs_clef[$i] == '' ) {
										echo "<OPTION VALUE='' selected></OPTION>";
									} else {
										echo "<OPTION VALUE=''></OPTION>";
									}
									if ( $champs_clef[$i] == 'primary' ) {
										echo "<OPTION VALUE='primary' selected>PRIMARY</OPTION>";
									} else {
										echo "<OPTION VALUE='primary'>PRIMARY</OPTION>";
									}
									if ( $champs_clef[$i] == 'unique' ) {
										echo "<OPTION VALUE='unique' selected>UNIQUE</OPTION>";
									} else {
										echo "<OPTION VALUE='unique'>UNIQUE</OPTION>";
									}
									if ( $champs_clef[$i] == 'index' ) {
										echo "<OPTION VALUE='index' selected>INDEX</OPTION>";
									} else {
										echo "<OPTION VALUE='index'>INDEX</OPTION>";
									}
									if ( $champs_clef[$i] == 'fulltext' ) {
										echo "<OPTION VALUE='fulltext' selected>FULLTEXT</OPTION>";
									} else {
										echo "<OPTION VALUE='fulltext'>FULLTEXT</OPTION>";
									}
									echo "										
									</SELECT></td>
								<td align='center' width='30%'>";
								if ( $i != 0 ) {
									echo "<table border='0' style='border-color:#666666'; width='100%' cellspacing='1' class='outer'>
											<tr>
												<td align='left' class='head' width='95%'>Form : Elements</td>
												<td align='right' class='even' width='5%'>
													<SELECT name='champs_param_elements[".$i."]'>";
												if ( $param_elements[$i] == 'XoopsFormText' ) {
													echo "<OPTION VALUE='XoopsFormText' selected>Text</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormText'>Text</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormTextArea' ) {
													echo "<OPTION VALUE='XoopsFormTextArea' selected>TextArea</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormTextArea'>TextArea</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormDhtmlTextArea' ) {
													echo "<OPTION VALUE='XoopsFormDhtmlTextArea' selected>DhtmlTextArea</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormDhtmlTextArea'>DhtmlTextArea</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormCheckBox' ) {
													echo "<OPTION VALUE='XoopsFormCheckBox' selected>CheckBox</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormCheckBox'>CheckBox</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormRadioYN' ) {
													echo "<OPTION VALUE='XoopsFormRadioYN' selected>RadioYN</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormRadioYN'>RadioYN</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormSelectUser' ) {
													echo "<OPTION VALUE='XoopsFormSelectUser' selected>SelectUser</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormSelectUser'>SelectUser</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormColorPicker' ) {
													echo "<OPTION VALUE='XoopsFormColorPicker' selected>ColorPicker</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormColorPicker'>ColorPicker</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormUploadImage' ) {
													echo "<OPTION VALUE='XoopsFormUploadImage' selected>UploadImage</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormUploadImage'>UploadImage</OPTION>";
												}
												if ( $param_elements[$i] == 'XoopsFormUploadFile' ) {
													echo "<OPTION VALUE='XoopsFormUploadFile' selected>UploadFile</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormUploadFile'>UploadFile</OPTION>";
												}
										
												if ( $param_elements[$i] == 'XoopsFormTextDateSelect' ) {
													echo "<OPTION VALUE='XoopsFormTextDateSelect' selected>TextDateSelect</OPTION>";
												} else {
													echo "<OPTION VALUE='XoopsFormTextDateSelect'>TextDateSelect</OPTION>";
												}
												$tablesHandler =& xoops_getModuleHandler('TDMCreate_tables', 'TDMCreate');
												$criteria = new CriteriaCompo();
												$criteria->add(new Criteria('tables_modules', $tables_modules));
												$criteria->setSort('tables_name');
												$criteria->setOrder('ASC');
												$tables_arr2 = $tablesHandler->getall($criteria);
												
												foreach (array_keys($tables_arr2) as $j) 
												{                                  
													$tables_name2 = $tables_arr2[$j]->getVar('tables_name');
													if ( $tables_name2 != 'topic' ) {
														if ( $tables_name2 != $tables_name )
														{
															if ( $param_elements[$i] == 'XoopsFormTables-'.$tables_name2.'' ) {
																echo "<OPTION VALUE='XoopsFormTables-".$tables_name2."' selected>Table : ".$tables_name2."</OPTION>";
															} else {
																echo "<OPTION VALUE='XoopsFormTables-".$tables_name2."'>Table : ".$tables_name2."</OPTION>";
															}
														}
													} else {
														if ( $param_elements[$i] == 'XoopsFormTopic' ) {
															echo "<OPTION VALUE='XoopsFormTopic' selected>Table : topic</OPTION>";
														} else {
															echo "<OPTION VALUE='XoopsFormTopic'>Table : topic</OPTION>";
														}
													}	
												}												
												echo "</SELECT>
												</td>
											<tr>
												<td align='left' class='head'>Page : Afficher admin</td>
												<td align='right' class='even'>";
												if ( $param_display_admin[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='champs_param_display_admin[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='champs_param_display_admin[".$i."]'>";	
												}	
												echo "</td>
											</tr>
											<tr>
												<td align='left' class='head'>Page : Afficher user</td>
												<td align='right' class='even'>";
												if ( $param_display_user[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='champs_param_display_user[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='champs_param_display_user[".$i."]'>";	
												}
												echo "</td>
											</tr>
											";
											//Afficher la case blocs
											if ( $tables_blocs == 1 ) 
											{
												echo "<tr>
														<td align='left' class='head'>Bloc : Afficher</td>
														<td align='right' class='even'>";
												if ( $param_display_blocs[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='champs_param_display_blocs[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='champs_param_display_blocs[".$i."]'>";	
												}
												echo "</td>
													  </tr>";
											}
											echo "
											<tr>
												<td align='left' class='head'>Table : Champs principal</td>
												<td align='right' class='even'>";
												if ( $param_display_main_field[$i] == 1 ) {
													echo "<INPUT type='radio' value='".$i."' name='champs_param_main_field' checked>";
												} else {
													echo "<INPUT type='radio' value='".$i."' name='champs_param_main_field'>";	
												}
												echo "</td>
											</tr>";
											//Afficher la case recherche
											if ( $tables_search == 1 ) 
											{
											echo "
												<tr>
													<td align='left' class='head'>Recherche : Indexer </td>
													<td align='right' class='even'>";
													if ( $champs_param_search_field[$i] == 1 ) {
														echo "<INPUT type='checkbox' size='4' name='champs_param_search_field[".$i."]' checked>";
													} else {
														echo "<INPUT type='checkbox' size='4' name='champs_param_search_field[".$i."]'>";
													}
													echo "</td>
												</tr>";
											}
											echo "
											<tr>
												<td align='left' class='head'>Form : Champs Oblig.</td>
												<td align='right' class='even'>";
												if ( $champs_param_required_field[$i] == 1 ) {
													echo "<INPUT type='checkbox' size='4' name='champs_param_required_field[".$i."]' checked>";
												} else {
													echo "<INPUT type='checkbox' size='4' name='champs_param_required_field[".$i."]'>";
												}
												echo "</td>
											</tr>
											
											</table>";
								}
						echo "</td></tr>";
					}
			  echo "<tr>
						<td colspan='8' class='head' align='right'><input type='submit' value='Valider'></td>
					</tr>";
		  echo "</table>
			  </FORM>";
	}
	
	//Formulaire de creation de tables
    function getFormTable($action = false)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
        if ($action === false) {
			$action = $_SERVER['REQUEST_URI'];
			$action1 = $this->isNew() ? 'tables_champs' : 'tables_save1' ; 
        }
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_ADD) : sprintf(_AM_TDMCREATE_TABLES_EDIT);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form_tables', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		
		$form->addElement(new XoopsFormLabel(_AM_TDMCREATE_FORM_INFO_TABLE,_AM_TDMCREATE_FORM_INFO_TABLE_FIELD));
		$modulesHandler =& xoops_getModuleHandler('TDMCreate_modules', 'TDMCreate');
    	$modules_select = new XoopsFormSelect(_AM_TDMCREATE_TABLES_MODULES, 'tables_modules', $this->getVar('tables_modules'));
    	$modules_select->addOptionArray($modulesHandler->getList());
    	$form->addElement($modules_select, true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_TABLES_NAME, 'tables_name', 40, 255, $this->getVar('tables_name')), true);
		$form->addElement(new XoopsFormText(_AM_TDMCREATE_TABLES_NB_CHAMPS, 'tables_nb_champs', 20, 255, $this->getVar('tables_nb_champs')), true);
		
		$select_blocs = $this->isNew() ? 1 : $this->getVar('tables_blocs');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_BLOCS, 'tables_blocs', $select_blocs, _YES, _NO));
		
		$select_display_admin = $this->isNew() ? 1 : $this->getVar('tables_display_admin');
		$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_DISPLAY_ADMIN, 'tables_display_admin', $select_display_admin, _YES, _NO));
		
		$result = $xoopsDB->queryF("SELECT COUNT(*) FROM " . $xoopsDB->prefix("tdmcreate_tables")." WHERE tables_search = '1'");
		list( $active_search ) = $xoopsDB->fetchRow($result);
		
		if ( $active_search == 0 ) {
			$select_search = $this->isNew() ? 1 : $this->getVar('tables_search');
			$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_SEARCH, 'tables_search', $select_search, _YES, _NO));
		}
		
		$result = $xoopsDB->queryF("SELECT COUNT(*) FROM " . $xoopsDB->prefix("tdmcreate_tables")." WHERE tables_coms = '1'");
		list( $active_coms ) = $xoopsDB->fetchRow($result);
		
		//if ( $active_coms == 0 || !$this->isNew() ) {
		if ( $active_coms == 0 ) {
			$select_coms = $this->isNew() ? 1 : $this->getVar('tables_coms');
			$form->addElement(new XoopsFormRadioYN(_AM_TDMCREATE_TABLES_COMS, 'tables_coms', $select_coms, _YES, _NO));
		}

		$tables_img = $this->getVar('tables_img') ? $this->getVar('tables_img') : 'blank.gif';
		
		$uploadirectory = "/modules/".$xoopsModule->dirname()."/images/uploads/tables";
		$imgtray = new XoopsFormElementTray(_AM_TDMCREATE_TABLES_IMAGE,'<br />');
		$imgpath = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, "./modules/".$xoopsModule->dirname()."/images/uploads/tables");
		$imageselect= new XoopsFormSelect($imgpath, 'tables_img', $tables_img);
		$tables_img_array = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory );
		foreach( $tables_img_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"tables_img\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray->addElement($imageselect,false);
		$imgtray -> addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $tables_img . "' name='image3' id='image3' alt='' />" ) );
	
		$fileseltray= new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(_AM_TDMCREATE_FORMUPLOAD , 'attachedfile', 104857600),false);
		$fileseltray->addElement(new XoopsFormLabel(''), false);
		$imgtray->addElement($fileseltray);
		$form->addElement($imgtray);
		
		$form->addElement(new XoopsFormHidden('op', ''.$action1.''));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
		$form->display();
        return $form;
	}
	
	
	//Formulaire de creation de tables topic
    function getFormTopic($action = false)
    {
		global $xoopsDB, $xoopsModule, $xoopsModuleConfig;
		
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = $this->isNew() ? sprintf(_AM_TDMCREATE_TABLES_TOPIC_ADD) : sprintf(_AM_TDMCREATE_TABLES_TOPIC_EDIT);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");

        $form = new XoopsThemeForm($title, 'form_modules', $action.'?op=tables_save&select=1', 'post', true);
		$form->setExtra('enctype="multipart/form-data"');

		$modulesHandler =& xoops_getModuleHandler('TDMCreate_modules', 'TDMCreate');
    	$modules_select = new XoopsFormSelect(_AM_TDMCREATE_TABLES_MODULES, 'tables_modules', $this->getVar('tables_modules'));
    	$modules_select->addOptionArray($modulesHandler->getList());
    	$form->addElement($modules_select, true);
		
		$tables_img1 = $this->getVar('tables_img') ? $this->getVar('tables_img') : 'blank.gif';
		
		$uploadirectory1 = "/modules/".$xoopsModule->dirname()."/images/uploads/tables";
		$imgtray1 = new XoopsFormElementTray(_AM_TDMCREATE_TABLES_IMAGE,'<br />');
		$imgpath1 = sprintf(_AM_TDMCREATE_FORMIMAGE_PATH, "./modules/".$xoopsModule->dirname()."/images/uploads/tables");
		$imageselect1= new XoopsFormSelect($imgpath1, 'tables_img1', $tables_img1);
		$tables_img_array1 = XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH.$uploadirectory1 );
		foreach( $tables_img_array1 as $image1 ) {
			$imageselect1->addOption("$image1", $image1);
		}
		$imageselect1->setExtra( "onchange='showImgSelected(\"image4\", \"tables_img1\", \"" . $uploadirectory1 . "\", \"\", \"" . XOOPS_URL . "\")'" );
		$imgtray1->addElement($imageselect1,false);
		$imgtray1->addElement( new XoopsFormLabel( '', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory1 . "/" . $tables_img1 . "' name='image4' id='image4' alt='' />" ) );
	
		$fileseltray1= new XoopsFormElementTray('','<br />');
		$fileseltray1->addElement(new XoopsFormFile(_AM_TDMCREATE_FORMUPLOAD , 'attachedfile1', 104857600),false);
		$fileseltray1->addElement(new XoopsFormLabel(''), false);
		$imgtray1->addElement($fileseltray1);
		$form->addElement($imgtray1);
		
		$form->addElement(new XoopsFormHidden('op', 'tables_save'));
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
		$form->display();
        return $form;
	}
}

class TDMCreatetdmcreate_tablesHandler extends XoopsPersistableObjectHandler 
{

    function __construct(&$db) 
    {
        parent::__construct($db, "tdmcreate_tables", 'tdmcreate_tables', 'tables_id', 'tables_names');
    }

}

?>