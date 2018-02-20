<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.)
 *
 * Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR GNU public license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */

include '../../../include/cp_header.php'; 
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once("../include/functions.php");

xoops_cp_header();
//apelle du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(0, _AM_NOTIFY_MANAGE_INDEX);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (0, _AM_NOTIFY_MANAGE_INDEX);
}

//load class
$notif_handler =& xoops_getModuleHandler('tdmnotify_notif', 'TDMNotify');
$form_handler =& xoops_getModuleHandler('tdmnotify_form', 'TDMNotify');
$block_handler =& xoops_getModuleHandler('tdmnotify_block', 'TDMNotify');
//compte les notifications creer en admin
$numblock = $block_handler->getCount();
//compte les formulaire
$numform = $form_handler->getCount();
//compte les notification envoyer
$numnotif = $notif_handler->getCount();
//compte les notification en attente
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('inread', 0));
$notif_waiting = $notif_handler->getCount($criteria);

//verifie le plug
if ( isset($_REQUEST['op']) && $_REQUEST['op'] == 'create') {
//Copie du plug

$indexFile = XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/xoops_plugins/function.xoNotify.php";
copy($indexFile, XOOPS_ROOT_PATH."/class/smarty/xoops_plugins/function.xoNotify.php");

}


if (!is_readable(XOOPS_ROOT_PATH ."/class/smarty/xoops_plugins/function.xoNotify.php")) {
$veriffile = '<span style="color: red;"><a href="index.php?op=create"><img src="./../images/off.gif"> '._AM_NOTIFY_MANAGE_PLUGERROR.'</span></a>';
} else {
$veriffile = '<span style="color: green;"><img src="./../images/on.gif" >'._AM_NOTIFY_MANAGE_PLUGOK.'</span>';
}
			
			
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname().'/class/menu.php';

				//showIndex();
				$menu = new TDMSoundMenu();
				$menu->addItem('notif', 'notif.php', '../images/decos/notif.png', _AM_NOTIFY_MANAGE_NOTIF);
				$menu->addItem('form', 'block.php', '../images/decos/block.png', _AM_NOTIFY_MANAGE_BLOCK);
				$menu->addItem('plug', 'plug.php', '../images/decos/plug.png', _AM_NOTIFY_MANAGE_PLUG);
				$menu->addItem('about', 'about.php', '../images/decos/about.png', _AM_NOTIFY_MANAGE_ABOUT);
				$menu->addItem('update', '../../system/admin.php?fct=modulesadmin&op=update&module='.$xoopsModule ->getVar('name')
												, '../images/decos/update.png', _AM_NOTIFY_MANAGE_UPDATE);	
				$menu->addItem('permissions', 'permissions.php', '../images/decos/permissions.png', _AM_NOTIFY_MANAGE_PERM);
			
				
	echo $menu->getCSS();
	
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/index.png); background-repeat: no-repeat; background-position: left; padding-left: 50px; height:48px;">
		<strong>'._AM_NOTIFY_MANAGE_INDEX.'</strong>
	</div><br /><table width="100%" border="0" cellspacing="10" cellpadding="4">
  <tr>
  <td valign="top">
  '.$menu->render().'</td>
  <td valign="top" width="60%">
 <fieldset><legend class="CPmediumTitle">'._AM_NOTIFY_MANAGE_NOTIF.'</legend>
		<br/>';
		printf(_AM_NOTIFY_THEREARE_NOTIF,$numnotif);
		echo '<br/><br/>';
		printf(_AM_NOTIFY_THEREARE_NOTIF_WAITING,$notif_waiting);
		echo '<br/>
	</fieldset><br /><br />
	
	 <fieldset><legend class="CPmediumTitle">'._AM_NOTIFY_MANAGE_BLOCK.'</legend>
		<br/>';
		printf(_AM_NOTIFY_THEREARE_BLOCK,$numblock);
		echo '<br/>
	</fieldset><br /> <br />
	
	<fieldset><legend class="CPmediumTitle">'._AM_NOTIFY_MANAGE_PLUG.'</legend>
		<br/>';
		echo $veriffile;
		echo '<br/>
	</fieldset><br /> <br />';
	
	
	echo '</td></tr></table>';
xoops_cp_footer();
?>