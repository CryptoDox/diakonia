<?php
/**
 * ****************************************************************************
 *  - TDMTchat By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.tdmxoops.net)
 *
 * 	Cette licence, contient des limitations
 *
 * 1. Vous devez poss�der une permission d'ex�cuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' �tudier ni l'adapter � vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la libert� de l'am�liorer ni de rendre publiques les modifications
 *
 * @license     TDMFR PRO license
 * @author		TDMFR ; TEAM DEV MODULE ; Venom 
 *
 * ****************************************************************************
 */
 
if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}

define("TDMTCHAT_DIRNAME", basename(dirname(dirname(__FILE__))));
define("TDMTCHAT_URL", XOOPS_URL . '/modules/' . TDMTCHAT_DIRNAME);
define("TDMTCHAT_IMAGES_URL", TDMTCHAT_URL . '/images');
define("TDMTCHAT_UPLOAD_URL", TDMTCHAT_URL . '/upload');
define("TDMTCHAT_ROOT_PATH", XOOPS_ROOT_PATH . '/modules/' . TDMTCHAT_DIRNAME);
define("TDMTCHAT_UPLOAD_PATH", XOOPS_ROOT_PATH . '/modules/' . TDMTCHAT_DIRNAME.'/upload');

include_once TDMTCHAT_ROOT_PATH. "/include/functions.php";
include_once XOOPS_ROOT_PATH. "/class/pagenav.php";
include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH."/class/tree.php";
$gperm_handler =& xoops_gethandler('groupperm');
?>
