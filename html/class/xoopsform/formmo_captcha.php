<?php
/**
 * XOOPS form element of CAPTCHA
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
 * @since           2.3.0
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: formcaptcha.php 4897 2010-06-19 02:55:48Z phppp $
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

xoops_load('XoopsFormElement');

/**
 * Usage of XoopsFormCaptcha
 *
 * For form creation:
 * Add form element where proper: <code>$xoopsform->addElement(new XoopsFormCaptcha($caption, $name, $skipmember, $configs));</code>
 *
 * For verification:
 * <code>
 *               xoops_load("captcha");
 *               $xoopsCaptcha =& XoopsCaptcha::getInstance();
 *               if (! $xoopsCaptcha->verify() ) {
 *                   echo $xoopsCaptcha->getMessage();
 *                   ...
 *               }
 * </code>
 */

/**
 * Xoops Form Captcha
 *
 * @author 			Taiwen Jiang <phppp@users.sourceforge.net>
 * @package 		kernel
 * @subpackage 		form
 */
class XoopsFormMocaptcha extends XoopsFormElement
{
    var $captchaHandler;

    /**
     *
     * @param string $caption Caption of the form element, default value is defined in captcha/language/
     * @param string $name Name for the input box
     * @param boolean $skipmember Skip CAPTCHA check for members
     */
    function XoopsFormMocaptcha($caption = '', $name = 'xoopscaptcha', $skipmember = true, $configs = array())
    {
        xoops_load('XoopsCaptcha');
        $this->captchaHandler = &XoopsCaptcha::getInstance();
        $configs['name'] = $name;
        $configs['skipmember'] = $skipmember;
        $this->captchaHandler->setConfigs($configs);
        if (! $this->captchaHandler->isActive()) {
            $this->setHidden();
        } else {
            $caption = ! empty($caption) ? $caption : $this->captchaHandler->getCaption();
            $this->setCaption($caption);
            $this->setName($name);
        }
    }

    function setConfig($name, $val)
    {
        return $this->captchaHandler->setConfig($name, $val);
    }

    function render()
    {
        // if (!$this->isHidden()) {
        return $this->captchaHandler->render();
        // }
    }
}

?>