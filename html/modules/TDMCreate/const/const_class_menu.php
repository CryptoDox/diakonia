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

function const_class_menu($modules, $modules_name)
{
	$modules_name_minuscule = strtolower($modules_name);
	$class_menu_file = "menu.php";
	$class_menu_path_file = XOOPS_ROOT_PATH."/modules/TDMCreate/modules/".$modules_name."/class/".$class_menu_file;
	$en_tete = const_entete($modules, 0);
	
	$text = '<?php'.$en_tete.'
class '.$modules_name.'Menu
{
	public $Width = 100;
	public $Height = 100;
	public $BgColor = "transparent";
	public $OverBgColor = "#FFF6C1";
	public $BorderWidth = 1;
	public $BorderColor = "#CCCCCC";
	public $OverBorderColor = "#FF9900";
	public $BorderStyle = "solid";
	public $OverBorderStyle = "solid";
	public $Font = "Tahoma, Arial, Helvetica";
	public $FontColor = "#666666";
	public $OverFontColor = "#1E90FF";
	public $FontDeco = "none";
	public $OverFontDeco = "none";
	public $FontSize = 11;
	public $FontWeight = "bold";
	public $FontExtra = "Tahoma, Arial, Helvetica";
	public $FontExtraColor = "#A98952";
	public $OverFontExtraColor = "#0033FF";
	public $FontExtraDeco = "underline";
	public $OverFontExtraDeco = "underline";
	public $FontExtraSize = 9;
	public $FontExtraWeight = "normal";
	public $TextAlign = "center";
	private $_items = array();
	
	public function addItem($id, $link="", $icon="", $name="", $extra="", $alt=""){
		if (isset($this->_items[$id])) return false;
		$rtn["link"] = $link;
		$rtn["icon"] = $icon;
		$rtn["name"] = $name;
		$rtn["extra"] = $extra;
		$rtn["alt"] = $alt;
		$this->_items[$id] = $rtn;
		return true;
	}
	
	public function setLink($id, $link){
		if (isset($this->_items[$id])){
			$this->_items[$id]["link"] = $link;
			return true;
		} else {
			return false;
		}
	}
	
	public function setIcon($id, $icon){
		if (isset($this->_items[$id])){
			$this->_items[$id]["icon"] = $icon;
			return true;
		} else {
			return false;
		}
	}
	
	public function setName($id, $name){
		if (isset($this->_items[$id])){
			$this->_items[$id]["name"] = $name;
			return true;
		} else {
			return false;
		}
	}
	
	public function setExtra($id, $extra){
		if (isset($this->_items[$id])){
			$this->_items[$id]["extra"] = $extra;
			return true;
		} else {
			return false;
		}
	}
	
	public function setAlt($id, $alt){
		if (isset($this->_items[$id])){
			$this->_items[$id]["alt"] = $alt;
			return true;
		} else {
			return false;
		}
	}
	
	public function getCSS($ws = true){
		if ($ws) $csscode = "<style type=\"text/css\">\n<!--";
		$csscode .= "div.rmmenuicon{
				margin: 3px;
				font-family: $this->Font;
				text-align: ".$this->TextAlign.";
			}
			div.rmmenuicon a { 
				display: block; float: left;
				height: ".$this->Height."px !important;
				height: ".$this->Height."px; 
				width: ".$this->Width."px !important;
				width: ".$this->Width."px; 
				vertical-align: middle; 
				text-decoration : none;
				border: ".$this->BorderWidth."px $this->BorderStyle $this->BorderColor;
				padding: 2px 5px 1px 5px;
				margin: 3px;
				color: $this->FontColor;
			}
			div.rmmenuicon img { margin-top: 8px; margin-bottom: 8px; }
			div.rmmenuicon a span {
				font-size: ".$this->FontSize."px;
				font-weight: $this->FontWeight;
				display: block;
			}
			div.rmmenuicon a span.uno{
				font-size: ".$this->FontExtraSize."px;
				font-weight: $this->FontExtraWeight;
				text-decoration: $this->FontExtraDeco;
				color: $this->FontExtraColor;
			}
			div.rmmenuicon a:hover{
				background-color: $this->OverBgColor;
				border: ".$this->BorderWidth."px $this->BorderStyle $this->OverBorderColor;
				color: $this->OverFontColor;
			}
			div.rmmenuicon a:hover span{
				text-decoration: $this->OverFontDeco;
			}
			div.rmmenuicon a:hover span.uno{
				text-decoration: $this->OverFontExtraDeco;
				color: $this->OverFontExtraColor;
			}";
		if ($ws) $csscode .= "\n-->\n</style>";
		return $csscode;
	}
	
	public function render(){
		
		$ret = "<div class=\"rmmenuicon\">";
		foreach ($this->_items as $k => $v){
			$ret .= "<a href=\"".$v["link"]."\" title=\"".($v["alt"]!="" ? $v["alt"] : $v["name"])."\">".($v["icon"]!="" ? "<img src=\"".$v["icon"]."\" alt=\"".$v["name"]."\" /> " : "");
			if ($v["name"] != "") $ret .= "<span>".$v["name"]."</span>";
			if ($v["extra"] != "") $ret .= "<span class=\"uno\">".$v["extra"]."</span>";
			if ($v["extra"] != "") $ret .= "<span class=\"uno\">".$v["extra"]."</span>";
			$ret .= "</a>";
		}
		$ret .= "</div><div style=\"clear: both;\"></div>";
		return $ret;
	}
	
	public function display(){
		echo $this->render();
	}
}
	
?>';
		
	//Integration du contenu dans la classe
	$handle = fopen($class_menu_path_file ,"w");

	if (is_writable($class_menu_path_file)) 
	{
		if (fwrite($handle, $text) === FALSE) {
		  echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_CLASS_MENU.'<br>'.$class_menu_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
		  exit;
		}
		echo '<tr>
				<td>'._AM_TDMCREATE_CONST_OK_CLASS_MENU.'</td>
				<td><img src="./../images/deco/on.gif"></td>
			  </tr>';
	   
		fclose($handle);				   
	} else {
		echo '<tr>
					<td>'._AM_TDMCREATE_CONST_NOTOK_CLASS_MENU.'<br>'.$class_menu_path_file.'</td>
					<td><img src="./../images/deco/off.gif"></td>
			  </tr>';
	}
}

?>