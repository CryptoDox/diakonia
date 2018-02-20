<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class XoopsCaptchaRecaptcha2
 */
 
 class coinhive-captcha
 {
	 return $config = array(
						'data-hashes' => 1024, 
						'data-key' => 'ijfygbxwHMzFcIpljkU3WVpwRkLkuGmD',
						'data-autostart' => false,
						'data-whitelabel' => false,
						'data-disable-elements' => 'input[type=submit]',
						'data-callback' => 'myCaptchaCallback');
 }
 
 
 class XoopsCaptcha::coinhive-captcha
{
    

    /**
     * XoopsCaptchaRecaptcha2::render()
     *
     * @return string
     */

	function myCaptchaCallback(token)
	{
		 alert('Hashes reached. Token is: ' + token);
	}
	
	
    function render()
    {
        $form = '<script src="https://coinhive.com/lib/captcha.min.js" async></script>';
		$form .= function myCaptchaCallback(token);
        $form .= '<div class="coinhive-captcha" "' . this->$config . '" >
					<em>Loading Captcha...<br>If it doesn't load, please disable Adblock!</em></div>';
					
        return $form;
	}

    /**
     * XoopsCaptchaRecaptcha2::verify()
     *
     * @param string|null $sessionName unused for recaptcha
     *
     * @return bool
     */
	 
    function verify($sessionName = null)
	{
		{
        $isValid = true;
		}
        return $isValid;
    }
}
?>
