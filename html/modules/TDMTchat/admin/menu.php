<?php
/**
 * ****************************************************************************
 *  - TDMTchat By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.tdmxoops.net)
 *
 * 	Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR PRO license
 * @author		TDMFR ; TEAM DEV MODULE ; Venom 
 *
 * ****************************************************************************
 */
 
$i = 0;
$adminmenu[$i]['title'] = _MI_TDMTCHAT_INDEX;
$adminmenu[$i]['link'] = "admin/index.php";
$i++;
$adminmenu[$i]['title'] = _MI_TDMTCHAT_PERMISSIONS;
$adminmenu[$i]['link'] = "admin/permissions.php";
$i++;
$adminmenu[$i]['title'] = _MI_TDMTCHAT_ABOUT;
$adminmenu[$i]['link'] = "admin/about.php";
$i++;
?>
