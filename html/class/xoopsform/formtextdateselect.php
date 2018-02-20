<?php
/**
 * XOOPS form element
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         kernel
 * @subpackage      form
 * @since           2.0.0
 * @author          Kazumi Ono (AKA onokazu) http://www.myweb.ne.jp/, http://jp.xoops.org/
 * @version         $Id: formtextdateselect.php 4897 2010-06-19 02:55:48Z phppp $
 */

if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

/**
 * A text field with calendar popup
 */

class XoopsFormTextDateSelect extends XoopsFormText
{

	function XoopsFormTextDateSelect($caption, $name, $size = 15, $value= 0)
	{
		$value = !is_numeric($value) ? time() : intval($value);
		$this->XoopsFormText($caption, $name, $size, 25, $value);
	}

	function render()
	{
    	$ele_name = $this->getName();
		$ele_value = $this->getValue(false);
		$jstime = formatTimestamp( $ele_value, 'F j Y, H:i:s' );
		include_once XOOPS_ROOT_PATH.'/include/calendarjs.php';
		return "<input type='text' name='".$ele_name."' id='".$ele_name."' size='".$this->getSize()."' maxlength='".$this->getMaxlength()."' value='".date("Y-m-d", $ele_value)."'".$this->getExtra()." /><input type='reset' value=' ... ' onclick='return showCalendar(\"".$ele_name."\");'>";
	}
}
?>