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

function const_include_functions($modules, $modules_name)
{
	
	$include_functions_file = "functions.php";
	$include_functions_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/include/".$include_functions_file;
	$en_tete = const_entete($modules, 0);

	$text = '<?php'.$en_tete.'	

/***************Blocks***************/
function block_addCatSelect($cats) {
	if(is_array($cats)) 
	{
		$cat_sql = "(".current($cats);
		array_shift($cats);
		foreach($cats as $cat) 
		{
			$cat_sql .= ",".$cat;
		}
		$cat_sql .= ")";
	}
	return $cat_sql;
}



	
?>';
		
	//Integration du contenu dans le bloc
	$handle = fopen($include_functions_path_file ,"w");

	if (is_writable($include_functions_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
			echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_INCLUDE_FUNCTIONS.'<br>'.$include_functions_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
				  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_INCLUDE_FUNCTIONS.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_NOTOK_INCLUDE_FUNCTIONS.'<br>'.$include_functions_path_file.'</td>
				<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>