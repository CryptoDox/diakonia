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
include_once XOOPS_ROOT_PATH.'/modules/TDMCreate/include/functions_const.php';

function const_xoopsversion($modules, $modules_name, $tables_arr)
{
	$language = '_MI_'.strtoupper($modules_name).'';
	$xoopsversion_file = "xoops_version.php";
	$xoopsversion_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/".$xoopsversion_file;
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'
	
	$modversion["name"] = "'.$modules->getVar("modules_name").'";
	$modversion["version"] = '.$modules->getVar("modules_version").';
	$modversion["description"] = "'.$modules->getVar("modules_description").'";
	$modversion["author"] = "'.$modules->getVar("modules_author").'";
	$modversion["author_website_url"] = "'.$modules->getVar("modules_author_website_url").'";
	$modversion["author_website_name"] = "'.$modules->getVar("modules_author_website_name").'";
	$modversion["credits"] = "'.$modules->getVar("modules_credits").'";
	$modversion["license"] = "'.$modules->getVar("modules_license").'";
	$modversion["release_info"] = "'.$modules->getVar("modules_release_info").'";
	$modversion["release_file"] = "'.$modules->getVar("modules_release_file").'";
	$modversion["manual"] = "'.$modules->getVar("modules_manual").'";
	$modversion["manual_file"] = "'.$modules->getVar("modules_manual_file").'";
	$modversion["image"] = "images/'.$modules->getVar("modules_image").'";
	$modversion["dirname"] = "'.$modules->getVar("modules_name").'";

	//about
	$modversion["demo_site_url"] = "'.$modules->getVar("modules_demo_site_url").'";
	$modversion["demo_site_name"] = "'.$modules->getVar("modules_demo_site_name").'";
	$modversion["module_website_url"] = "'.$modules->getVar("modules_module_website_url").'";
	$modversion["module_website_name"] = "'.$modules->getVar("modules_module_website_name").'";
	$modversion["release"] = "'.$modules->getVar("modules_release").'";
	$modversion["module_status"] = "'.$modules->getVar("modules_status").'";
	';
		
	if ( $modules->getVar("modules_display_admin") == 1 ) {
		$text .= '
	// Admin things
	$modversion["hasAdmin"] = 1;
	';
	}
	$text .= '
	$modversion["adminindex"] = "admin/index.php";
	$modversion["adminmenu"] = "admin/menu.php";
	
	
	// Mysql file
	$modversion["sqlfile"]["mysql"] = "sql/mysql.sql";

	// Tables
	';
	$j = 0;
	foreach (array_keys($tables_arr) as $i) 
	{
		$text .= '$modversion["tables"]['.$j.'] = "'.$tables_arr[$i]->getVar('tables_module_table').'";
	';
		$j++;
	}

	$text .= '
	
	// Scripts to run upon installation or update
	$modversion["onInstall"] = "include/install.php";
	//$modversion["onUpdate"] = "include/update.php";';

	if ( $modules->getVar("modules_display_menu") == 1 ) {
		$text .= '// Menu
	$modversion["hasMain"] = 1;
	';
	}
	
	if ( $modules->getVar("modules_active_search") == 1 ) {
		$text .= '
	//Recherche
	$modversion["hasSearch"] = 1;
	$modversion["search"]["file"] = "include/search.inc.php";
	$modversion["search"]["func"] = "'.$modules_name.'_search";
	';
	}
	
	$text .= '
	$i = 1;
	include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
	$modversion["config"][$i]["name"]        = "'.$modules_name.'_editor";
	$modversion["config"][$i]["title"]       = "'.$language.'_EDITOR";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"]    = "select";
	$modversion["config"][$i]["valuetype"]   = "text";
	$modversion["config"][$i]["default"]     = "dhtmltextarea";
	$modversion["config"][$i]["options"]     = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . "/class/xoopseditor");
	$modversion["config"][$i]["category"]    = "global";
	$i++;
	';
	foreach (array_keys($tables_arr) as $i) 
	{	
		$tables_name = $tables_arr[$i]->getVar("tables_name");
		$tables_champs = $tables_arr[$i]->getVar("tables_champs");
		$tables_parametres = $tables_arr[$i]->getVar("tables_parametres");
		
		//Champs
		$champs = explode("|", $tables_champs);
		$nb_champs = count($champs);

		//Parametres
		$parametres = explode("|", $tables_parametres);
		$nb_parametres = count($parametres);
		$j=0;
		for ($i=0; $i<$nb_champs; $i++)
		{
			$structure_champs = explode(":", $champs[$i]);
			$language1 = $language.'_'.strtoupper($structure_champs[0]).'';
			if ( $i != 0 ) 
			{
				$structure_parametres = explode(":", $parametres[$j]);	
				$j++;
				if ( $structure_parametres[0] == 'XoopsFormUploadImage' ){
					$text .= '
	//Uploads : size '.$structure_champs[0].'
	$modversion["config"][$i]["name"] = "'.$structure_champs[0].'_size";
	$modversion["config"][$i]["title"] = "'.$language1.'_SIZE";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = "10485760";
	$i++;
	
	//Uploads : mimetypes '.$structure_champs[0].'
	$modversion["config"][$i]["name"] = "'.$structure_champs[0].'_mimetypes";
	$modversion["config"][$i]["title"] = "'.$language1.'_MIMETYPES";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "select_multi";
	$modversion["config"][$i]["valuetype"] = "array";
	$modversion["config"][$i]["default"] = array("image/gif", "image/jpeg", "image/png");
	$modversion["config"][$i]["options"] = array(			
										"bmp" => "image/bmp",
										"gif" => "image/gif",
										"jpeg" => "image/pjpeg",
										"jpeg" => "image/jpeg",
										"jpg" => "image/jpeg",
										"jpe" => "image/jpeg",
										"png" => "image/png");
	$i++;
					';
				} else if ( $structure_parametres[0] == 'XoopsFormUploadFile' ) {
					$text .= '
	//Uploads : size '.$structure_champs[0].'
	$modversion["config"][$i]["name"] = "'.$structure_champs[0].'_size";
	$modversion["config"][$i]["title"] = "'.$language1.'_SIZE";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "textbox";
	$modversion["config"][$i]["valuetype"] = "int";
	$modversion["config"][$i]["default"] = "10485760";
	$i++;
	
	//Uploads : mimetypes '.$structure_champs[0].'
	$modversion["config"][$i]["name"] = "'.$structure_champs[0].'_mimetypes";
	$modversion["config"][$i]["title"] = "'.$language1.'_MIMETYPES";
	$modversion["config"][$i]["description"] = "";
	$modversion["config"][$i]["formtype"] = "select_multi";
	$modversion["config"][$i]["valuetype"] = "array";
	$modversion["config"][$i]["default"] = array("image/gif", "image/jpeg", "image/png");
	$modversion["config"][$i]["options"] = array(
										"bmp" => "image/bmp",
										"gif" => "image/gif",
										"ico" => "image/icon",
										"ief" => "image/ief",
										"jpeg" => "image/pjpeg",
										"jpeg" => "image/jpeg",
										"jpg" => "image/jpeg",
										"jpe" => "image/jpeg",
										"png" => "image/png",
										"tiff" => "image/tiff",
										"tif" => "image/tif",
										"wbmp" => "image/vnd.wap.wbmp",
										
										"ace" => "application/x-ace-compressed",
										"ai" => "application/postscript",
										"aif" => "audio/x-aiff",
										"aifc" => "audio/x-aiff",
										"aiff" => "audio/x-aiff",
										"asc" => "text/plain",
										"asf" => "video/x-ms-asf",
										"asx" => "audio/x-ms-wax",
										"au" => "audio/basic",
										"avi" => "video/x-msvideo",
										"bcpio" => "application/x-bcpio",
										"bin" => "application/octet-stream",
										"cdf" => "application/x-netcdf",
										"class" => "application/octet-stream",
										"cpio" => "application/x-cpio",
										"cpt" => "application/mac-compactpro",
										"csh" => "application/x-csh",
										"css" => "text/css",
										"dll" => "application/octet-stream",
										"dir" => "application/x-director",
										"djvu" => "image/vnd.djvu",
										"djv" => "image/vnd.djvu",
										"dms" => "application/octet-stream",
										"doc" => "application/msword",
										"dcr" => "application/x-director",
										"dvi" => "application/x-dvi",
										"dxr" => "application/x-director",
										"eps" => "application/postscript",
										"etx" => "text/x-setext",
										"exe" => "application/octet-stream",
										"ez" => "application/andrew-inset",
										"gtar" => "application/x-gtar",
										"hdf" => "application/x-hdf",
										"hqx" => "application/mac-binhex40",
										"htm" => "text/html",
										"html" => "text/html",
										"ice" => "x-conference-xcooltalk",
										"iges" => "model/iges",
										"igs" => "model/iges",
										"js" => "application/x-javascript",
										"kar" => "audio/midi",
										"latex" => "application/x-latex",
										"lha" => "application/octet-stream",
										"Log" => "text/plain",
										"log" => "text/plain",
										"lzh" => "application/octet-stream",
										"man" => "application/x-troff-man",
										"me" => "application/x-troff-me",
										"mesh" => "model/mesh",
										"msh" => "model/mesh",
										"mid" => "audio/midi",
										"midi" => "audio/midi",
										"mov" => "video/quicktime",
										"movie" => "video/x-sgi-movie",
										"mxu" => "video/vnd.mpegurl",
										"mpe" => "video/mpeg",
										"mpeg" => "video/mpeg",
										"mpg" => "video/mpeg",
										"mpga" => "audio/mpeg",
										"mp2" => "audio/mpeg",
										"mp3" => "audio/mpeg",
										"ms" => "application/x-troff-ms",
										"m3u" => "audio/x-mpegurl",
										"nc" => "application/x-netcdf",
										"oda" => "application/oda",
										"pbm" => "image/x-portable-bitmap",
										"pdb" => "chemical/x-pdb",
										"pgm" => "image/x-portable-graymap",
										"pnm" => "image/x-portable-anymap",
										"ppm" => "image/x-portable-pixmap",
										"pdf" => "application/pdf",
										"pgn" => "application/x-chess-pgn",
										"php" => "text/php",
										"php3" => "text/php3",
										"ps" => "application/postscript",
										"qt" => "video/quicktime",
										"roff" => "application/x-troff",
										"sgm" => "text/sgml",
										"sgml" => "text/sgml",
										"sh" => "application/x-sh",
										"shar" => "application/x-shar",
										"skd" => "application/x-koan",
										"skm" => "application/x-koan",
										"skp" => "application/x-koan",
										"skt" => "application/x-koan",
										"silo" => "model/mesh",
										"sit" => "application/x-stuffit",
										"smi" => "application/smil",
										"smil" => "application/smil",
										"snd" => "audio/basic",
										"so" => "application/octet-stream",
										"spl" => "application/x-futuresplash",
										"src" => "application/x-wais-source",
										"sv4cpio" => "application/x-sv4cpio",
										"sv4crc" => "application/x-sv4crc",
										"swf" => "application/x-shockwave-flash",
										"ra" => "audio/x-realaudio",
										"ram" => "audio/x-pn-realaudio",
										"rar" => "application/x-rar-compressed",
										"ras" => "image/x-cmu-raster",
										"rgb" => "image/x-rgb",
										"rm" => "audio/x-pn-realaudio",
										"rpm" => "audio/x-pn-realaudio-plugin",
										"rtf" => "text/rtf",
										"rtx" => "text/richtext",
										"t" => "application/x-troff",
										"tar" => "application/x-tar",
										"tar.gz" => "application/x-gzip",
										"tcl" => "application/x-tcl",
										"tex" => "application/x-tex",
										"texinfo" => "application/x-texinfo",
										"texi" => "application/x-texinfo",
										"tr" => "application/x-troff",
										"tsv" => "text/tab-seperated-values",
										"txt" => "text/plain",
										"ustar" => "application/x-ustar",
										"vcd" => "application/x-cdlink",
										"vrml" => "model/vrml",
										"wav" => "audio/x-wav",
										"wax" => "audio/x-windows-media",
										"wbxml" => "application/vnd.wap.wbxml",
										"wma" => "audio/x-ms-wma",
										"wm" => "video/x-ms-wm", 
										"wmd" => "application/x-ms-wmd",
										"wml" => "text/vnd.wap.wml",
										"wmlc" => "application/vnd.wap.wmlc",
										"wmls" => "text/vnd.wap.wmlscript",
										"wmlsc" => "application/vnd.wap.wmlscriptc",
										"wmx" => "video/x-ms-wmx",
										"wmv" => "video/x-ms-wmv",
										"wmz" => "application/x-ms-wmz",
										"wrl" => "model/vrml",
										"wvx" => "video/x-ms-wvx",
										"xbm" => "image/x-xbitmap",
										"xpm" => "image/x-xpixmap",
										"xht" => "application/xhtml+xml",
										"xhtml" => "application/xhtml+xml",
										"XM" => "audio/fasttracker",
										"xml" => "text/xml",
										"xsl" => "text/xml",
										//"xls" => "application/excel",
										"xls" => "application/vnd.ms-excel",
										"xwd" => "image/x-windowdump",
										"xyz" => "chemical/x-xyz",
										"zip" => "application/zip",
										"Zip" => "application/zip", 
										"unknown" => "application/octet-stream");
	$i++;
	';
				}
			}
		}
	}	
	
	$text .='
	//Blocs
	$i = 1;';
	foreach (array_keys($tables_arr) as $i) 
	{
		$tables_module_table = $tables_arr[$i]->getVar("tables_module_table");
		$tables_name = $tables_arr[$i]->getVar("tables_name");
		$tables_blocs = $tables_arr[$i]->getVar("tables_blocs");
		$language = '_MI_'.strtoupper($tables_module_table).'';
		if ( $tables_blocs == 1 ) 
		{	
			$text .= '
	$modversion["blocks"][$i]["file"] = "blocks_'.$tables_name.'.php";
	$modversion["blocks"][$i]["name"] = '.$language.'_BLOCK_RECENT;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_'.$tables_module_table.'";
	$modversion["blocks"][$i]["edit_func"] = "b_'.$tables_module_table.'_edit";
	$modversion["blocks"][$i]["options"] = "recent|5|25|0";
	$modversion["blocks"][$i]["template"] = "'.$tables_module_table.'_block_recent.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_'.$tables_name.'.php";
	$modversion["blocks"][$i]["name"] = '.$language.'_BLOCK_DAY;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_'.$tables_module_table.'";
	$modversion["blocks"][$i]["edit_func"] = "b_'.$tables_module_table.'_edit";
	$modversion["blocks"][$i]["options"] = "day|5|25|0";
	$modversion["blocks"][$i]["template"] = "'.$tables_module_table.'_block_day.html";
	$i++;
	$modversion["blocks"][$i]["file"] = "blocks_'.$tables_name.'.php";
	$modversion["blocks"][$i]["name"] = '.$language.'_BLOCK_RANDOM;
	$modversion["blocks"][$i]["description"] = "";
	$modversion["blocks"][$i]["show_func"] = "b_'.$tables_module_table.'";
	$modversion["blocks"][$i]["edit_func"] = "b_'.$tables_module_table.'_edit";
	$modversion["blocks"][$i]["options"] = "random|5|25|0";
	$modversion["blocks"][$i]["template"] = "'.$tables_module_table.'_block_random.html";
	$i++;';
		}
	}

$text .= '		
?>';
		
	//Integration du contenu dans le fichier xoopsconfig.php
	$handle = fopen($xoopsversion_path_file ,"w");

	if (is_writable($xoopsversion_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_XOOPS_VERSION.'<br>'.$xoopsversion_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_XOOPS_VERSION.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_XOOPS_VERSION.'<br>'.$xoopsversion_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>