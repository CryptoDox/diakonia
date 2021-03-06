<?php
/**
 * CAPTCHA_M configurations
 *
 * Based on my own code for monero mining
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         class
 * @subpackage      CAPTCHA_M
 * @since           10.10.07
 * @author          Christophe Leduc <christophe.leduc@xxx.fr>
 * @version         $Id: captcha_m.php 1.0
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

return $config = array(
    'num_chars' => 4,  // Maximum characters
    'rule_text' => _CAPTCHA_RULE_IMAGE,
    'rootpath' => XOOPS_ROOT_PATH . '/class/captcha_m/image',  // __Absolute__ Path to the root of fonts and backgrounds
    'imageurl' => 'class/captcha_m/image/scripts/image.php',  // Path to the script for creating image, __relative__ to XOOPS_ROOT_PATH
    'casesensitive' => false,  // Characters in image mode is case-sensitive
    'fontsize_min' => 12,  // Minimum font-size
    'fontsize_max' => 12,  // Maximum font-size
    'background_type' => 0,  // Background type in image mode: 0 - bar; 1 - circle; 2 - line; 3 - rectangle; 4 - ellipse; 5 - polygon; 100 - generated from files
    'background_num' => 50,  // Number of background images to generate
    'polygon_point' => 3,
    'skip_characters' => array(
        'o',
        '0',
        'i',
        'l',
        '1')); // characters that should not be used

?>