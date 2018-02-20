<?php

/********************************************************/
/* XOOPS Web Tools ver 1.1                              */
/* 30/4/2008                                            */
/* By: Mowaffak (www.arabxoops.com)                     */
/* based on PHP-Nuke Tools Ver 3.0 by Disipal           */
/* Author website: www.disipal.net                      */
/********************************************************/

$modversion['name']         = "XOOPS Web Tools";

$modversion['description']  = "Xoops Web Tools ver 1.1";
$modversion['version']      = "1.1";
$modversion['author']       = "Disipal (www.disipal.net) Modified by Mowaffak (www.arabxoops.com)";
$modversion['credits']      = "Disipal Designs (disipal.net)";
$modversion['license']      = "GPL";
$modversion['official']     = "No";
$modversion['image']        = "images/logo.gif";
$modversion['dirname']      = "xwebtools";

// Menu
$modversion['hasMain'] = 1;

// Admin things
$modversion['hasAdmin'] = 0;

// Blocks
$modversion['blocks'][1]['file'] = "xwt_block.php";
$modversion['blocks'][1]['name'] = _MI_XWT_BNAME1;
$modversion['blocks'][1]['description'] = _MI_XWT_BLOCK_DESC;
$modversion['blocks'][1]['show_func'] = "xwt_show";

?>
