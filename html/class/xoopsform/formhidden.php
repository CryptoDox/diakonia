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
 * @version         $Id: formhidden.php 4897 2010-06-19 02:55:48Z phppp $
 */
 
defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * A hidden field
 */
class XoopsFormHidden extends XoopsFormElement
{
    /**
     * Value
     *
     * @var string
     * @access private
     */
    var $_value;
    
    /**
     * Constructor
     *
     * @param string $name "name" attribute
     * @param string $value "value" attribute
     */
    function XoopsFormHidden($name, $value)
    {
        $this->setName($name);
        $this->setHidden();
        $this->setValue($value);
        $this->setCaption('');
    }
    
    /**
     * Get the "value" attribute
     *
     * @param bool $encode To sanitizer the text?
     * @return string
     */
    function getValue($encode = false)
    {
        return $encode ? htmlspecialchars($this->_value, ENT_QUOTES) : $this->_value;
    }
    
    /**
     * Sets the "value" attribute
     *
     * @patam $value	string
     */
    function setValue($value)
    {
        $this->_value = $value;
    }
    
    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
        return '<input type="hidden" name="' . $this->getName() . '" id="' . $this->getName() . '" value="' . $this->getValue() . '" />';
    }
}

?>