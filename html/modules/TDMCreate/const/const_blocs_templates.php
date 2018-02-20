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

function const_blocs_templates($modules, $modules_name, $tables_name, $tables_module_table, $tables_champs, $tables_parametres)
{
	$language = '_MB_'.strtoupper($modules_name).'_';
//1er blocks		
	$blocs_language_file = ''.$tables_module_table.'_block_day.html';
	$blocs_language_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates/blocks/".$blocs_language_file;
	$en_tete = const_entete($modules, 0);


	$text = '	
<table class="outer">
	<{foreachq item='.$tables_name.' from=$block}>
		<tr class = "<{cycle values = "even,odd"}>">
			<td>';
			
				//Champs
				$champs = explode("|", $tables_champs);
				$nb_champs = count($champs);

				//Parametres
				$parametres = explode("|", $tables_parametres);
				$nb_parametres = count($parametres);

				$j=0;
				$structure_parametres[3] = 0;
				for ($i=0; $i<$nb_champs; $i++)
				{
					$structure_champs = explode(":", $champs[$i]);
					if ( $i != 0 ) {
						$structure_parametres = explode(":", $parametres[$j]);	
						$j++;
					}
					if( $structure_parametres[3] == 1 || $i == 0) {
						$text .= '<{$'.$tables_name.'.'.$structure_champs[0].'}>;
					';
					}
				}
			$text .= '</td>
		</tr>
	<{/foreach}>
</table>
	
';
		
	//Integration du contenu dans le bloc
	$handle = fopen($blocs_language_path_file ,"w");

	if (is_writable($blocs_language_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE.'<br>'.$blocs_language_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_BLOCS_TEMPLATE.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE.'<br>'.$blocs_language_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
	
//2eme blocks
$blocs_language_file = ''.$tables_module_table.'_block_recent.html';
	$blocs_language_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates/blocks/".$blocs_language_file;
	$en_tete = const_entete($modules, 0);


	$text = '	
<table class="outer">
	<{foreachq item='.$tables_name.' from=$block}>
		<tr class = "<{cycle values = "even,odd"}>">
			<td>';
			
				//Champs
				$champs = explode("|", $tables_champs);
				$nb_champs = count($champs);

				//Parametres
				$parametres = explode("|", $tables_parametres);
				$nb_parametres = count($parametres);

				$j=0;
				$structure_parametres[3] = 0;
				for ($i=0; $i<$nb_champs; $i++)
				{
					$structure_champs = explode(":", $champs[$i]);
					if ( $i != 0 ) {
						$structure_parametres = explode(":", $parametres[$j]);	
						$j++;
					}
					if( $structure_parametres[3] == 1 || $i == 0) {
						$text .= '<{$'.$tables_name.'.'.$structure_champs[0].'}>;
					';
					}
				}
			$text .= '</td>
		</tr>
	<{/foreach}>
</table>

';
		
	//Integration du contenu dans le bloc
	$handle = fopen($blocs_language_path_file ,"w");

	if (is_writable($blocs_language_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE.'<br>'.$blocs_language_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_BLOCS_TEMPLATE.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE.'<br>'.$blocs_language_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
//3eme blocks
$blocs_language_file = ''.$tables_module_table.'_block_random.html';
	$blocs_language_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/templates/blocks/".$blocs_language_file;
	$en_tete = const_entete($modules, 0);


	$text = '	
<table class="outer">
	<{foreachq item='.$tables_name.' from=$block}>
		<tr class = "<{cycle values = "even,odd"}>">
			<td>';
			
				//Champs
				$champs = explode("|", $tables_champs);
				$nb_champs = count($champs);

				//Parametres
				$parametres = explode("|", $tables_parametres);
				$nb_parametres = count($parametres);

				$j=0;
				$structure_parametres[3] = 0;
				for ($i=0; $i<$nb_champs; $i++)
				{
					$structure_champs = explode(":", $champs[$i]);
					if ( $i != 0 ) {
						$structure_parametres = explode(":", $parametres[$j]);	
						$j++;
					}
					if( $structure_parametres[3] == 1 || $i == 0) {
						$text .= '<{$'.$tables_name.'.'.$structure_champs[0].'}>;
					';
					}
				}
	$text .= '</td>
		</tr>
	<{/foreach}>
</table>
	
';
		
	//Integration du contenu dans le bloc
	$handle = fopen($blocs_language_path_file ,"w");

	if (is_writable($blocs_language_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE.'<br>'.$blocs_language_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_BLOCS_TEMPLATE.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_BLOCS_TEMPLATE.'<br>'.$blocs_language_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>