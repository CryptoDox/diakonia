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

include '../../../include/cp_header.php'; 
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';


xoops_cp_header();
//apelle du menu admin
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(0, _AM_TDMTCHAT_MANAGE_INDEX);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (0, _AM_TDMTCHAT_MANAGE_INDEX);
}

//load class
$tchat_handler =& xoops_getModuleHandler('tdmtchat_tchat', 'TDMTchat');
$member_handler =& xoops_gethandler('member');
//compte 
$numtchat = $tchat_handler->getCount();
//compte les users
$member = $member_handler->getUsers();
$numuser = Count($member);
 
//info priv_msgs
$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("tdmtchat_tchat")."'";
$result1=$xoopsDB->queryF($sq1); 
$row=$xoopsDB->fetchArray($result1);

if ( !empty($_REQUEST['op']) && $_REQUEST['op'] == 'optimise') {
 $sq1 = "OPTIMIZE TABLE ".$xoopsDB->prefix("tdmtchat_tchat");
 $result1 = $xoopsDB->queryF($sq1);
 if($result1){
 redirect_header( 'index.php', 1, _AM_TDMTCHAT_BASEOK);
        }else{
         redirect_header( 'index.php', 1, _AM_TDMTCHAT_BASENOTOK);
        } 
}			
			
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname().'/class/menu.php';

				//showIndex();
				$menu = new TDMTchatMenu();
				$menu->addItem('about', 'about.php', '../images/decos/about.png', _AM_TDMTCHAT_MANAGE_ABOUT);
				$menu->addItem('update', '../../system/admin.php?fct=modulesadmin&op=update&module='.$xoopsModule ->getVar('name')
												, '../images/decos/update.png', _AM_TDMTCHAT_MANAGE_UPDATE);	
				$menu->addItem('permissions', 'permissions.php', '../images/decos/permissions.png', _AM_TDMTCHAT_MANAGE_PERM);
				$menu->addItem('Preference', '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod='.$xoopsModule ->getVar('mid').
												'&amp;&confcat_id=1', '../images/decos/pref.png',  _AM_TDMTCHAT_MANAGE_PREF);	
				
	echo $menu->getCSS();
	
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/index.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;">
		<h3><strong>'._AM_TDMTCHAT_MANAGE_INDEX.'</strong></h3>
	</div><br /><table width="100%" border="0" cellspacing="10" cellpadding="4">
  <tr>
  <td valign="top">
  '.$menu->render().'</td>
  <td valign="top" width="60%">
 <fieldset><legend class="CPmediumTitle">'._AM_TDMTCHAT_MANAGE_STATS.'</legend>
		<br/>';
		printf(_AM_TDMTCHAT_THEREARE_TCHAT,$numtchat);
		echo '<br/><br />';
		printf(_AM_TDMTCHAT_THEREARE_USER,$numuser);
		
		echo '<br/><br />
	</fieldset><br /><br />
	
	 <fieldset><legend class="CPmediumTitle">'.$row['Name'].'</legend>
		<br/>';
		printf(_AM_TDMTCHAT_THEREARE_LENGHT, tdmtchat_PrettySize($row['Data_length']));
		echo '<br/><br />';
		printf(_AM_TDMTCHAT_THEREARE_FREE , tdmtchat_PrettySize($row['Data_free']));
		echo "&nbsp;(<a href='index.php?op=optimise'>"._AM_TDMTCHAT_OPTIMISE."</a>)";
		echo '<br/><br />';
		printf(_AM_TDMTCHAT_THEREARE_TOTAL , tdmtchat_PrettySize($row['Data_length'] + $row['Index_length']));
		
	echo '<br /><br /></fieldset><br /> <br />
	
	</td></tr></table>';
xoops_cp_footer();
?>