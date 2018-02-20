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

include_once '../../mainfile.php';
$xoopsOption['template_main'] = 'tdmtchat_message.html';

require(XOOPS_ROOT_PATH.'/header.php');
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$myts =& MyTextSanitizer::getInstance();

$tchat_handler =& xoops_getModuleHandler('tdmtchat_tchat', 'TDMTchat');

$status = (!empty($_REQUEST['status'])) ? intval($_REQUEST['status']) : 0;
$_REQUEST['form_groups'] = (!empty($_REQUEST['form_groups'])) ? intval($_REQUEST['form_groups']) : 0;	
	
	if (is_object($xoopsUser)) {
    $uid = $xoopsUser->getVar('uid');
    $uname = $xoopsUser->getVar('uname');
	$name = $xoopsUser->getVar('name');
	$location = $xoopsUser->getVar('user_from');
	$extra = $xoopsUser->getVar('bio', 'N');
	$sig = $xoopsUser->getVar('user_sig', 'N');
	$groups = $xoopsUser->getGroups();
	//avatar
	$image =  XOOPS_ROOT_PATH.'/uploads/'.$xoopsUser->getVar('user_avatar');
	if (file_exists($image) && $xoopsUser->getVar('user_avatar') != 'blank.gif') {
	$picture = "<img class='img' src='".XOOPS_URL."/uploads/".$xoopsUser->getVar('user_avatar')."' width='100px' title=".$xoopsUser->getVar('uname')." alt=".$xoopsUser->getVar('uname').">";
	} else {
	$picture = "<img class='img' src='".TDMTCHAT_IMAGES_URL."/no_avatar_man.gif'  width='100px' title='Anonyme' alt='Anonyme'>";
	}
	$xoopsTpl->assign('user_uid', $uid);
	$xoopsTpl->assign('user_uname', $uname);
	$xoopsTpl->assign('user_name', $name);
	$xoopsTpl->assign('user_location', $location);
	$xoopsTpl->assign('user_extra', $extra);
	$xoopsTpl->assign('user_sig', $sig);
	$xoopsTpl->assign('user_picture', $picture);
    } else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	redirect_header("index.php", 2, _MD_TDMTCHAT_REGISTER);
    }
	
	//permission d'afficher
if (!$gperm_handler->checkRight('tchat_view', 2, $groups, $xoopsModule->getVar('mid'))) {
	redirect_header(XOOPS_URL, 2, _MD_TDMTCHAT_NOPERM);
	 exit();
    }
	
	$xoopsTpl->assign('module_name', $xoopsModule->getVar("name"));
	
	$user_handler =& xoops_gethandler('user');
	$member_handler =& xoops_gethandler('member');
	$requete_pagenav = '';
	
	//supprimer
	//if ( !empty($_REQUEST['tchat_id'])) {
	//$size = count($_REQUEST['tchat_id']);
	//for ( $i = 0; $i < $size; $i++ ) {
	//$obj =& $tchat_handler->get($_REQUEST['tchat_id'][$i]);
	
	//if (!$tchat_handler->delete($obj)) {
    //       $erreur .= $obj->getHtmlErrors();
     //   }
		
	//}
	
	//if ($erreur) {
	//echo $obj->getHtmlErrors();
	//} else { 
	//redirect_header("message.php", 2, _MD_TDMTCHAT_BASEOK);
	//}
	
		//}
	///
	
	

	//recherche			
	$start = (!empty($_REQUEST['start'])) ? intval($_REQUEST['start']) : 0;	
	$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'DESC';	

	
	//status
	$criteria2 = new CriteriaCompo();
	$tocriteria = new CriteriaCompo();	
	$criteria2->add(new Criteria('tchat_pid', '0')); 
    $tocriteria->add(new Criteria('tchat_to',  $uname));
	//$tocriteria->add(new Criteria('tchat_from', $to), 'OR');
	$tocriteria->add(new Criteria('tchat_from',  $uname), 'OR');
	//$tocriteria->add(new Criteria('tchat_to', $to), 'OR');
	$criteria2->add($tocriteria);
	$criteria2->setStart($start);
	$criteria2->setLimit($xoopsModuleConfig['tdmtchat_pageuser']);
	$criteria2->setSort('tchat_id');
	$criteria2->setOrder($order);
	
	$arr =& $tchat_handler->getAll($criteria2);
	$total_member = $tchat_handler->getCount($criteria2);
	
	$xoopsTpl->assign('total_member', $total_member);
	$xoopsTpl->assign('all_member', $user_handler->getCount(new Criteria('uid', $uid, '!=')));

	//active le online
	$online_handler =& xoops_gethandler('online');
	mt_srand((double)microtime()*1000000);
    // set gc probabillity to 10% for now..
    if (mt_rand(1, 100) < 11) {
        $online_handler->gc(300);
    }
    $online_handler->write($uid, $uname, time(), $xoopsModule->getVar('mid'), $_SERVER['REMOTE_ADDR']);
	$total_module = $online_handler->getCount(new Criteria('online_module', $xoopsModule->getVar('mid')));
	$total_online = $online_handler->getCount();
	$xoopsTpl->assign('total_online', $total_online);
	$xoopsTpl->assign('total_module', sprintf(_MD_TDMTCHAT_ONLINE_MODULE, $total_module));
	//
	
		$member = array();

	foreach (array_keys($arr) as $i) {		
		
		if ($arr[$i]->getVar('tchat_from') == $uname) {
		$member['uname'] = $arr[$i]->getVar('tchat_to');
		}else {
	    $member['uname'] = $arr[$i]->getVar('tchat_from');
		}
		$member['id'] = $arr[$i]->getVar('tchat_id');
		$member['recd'] = $arr[$i]->getVar('tchat_recd') == 1 ? "<img alt='"._MD_TDMTCHAT_READ."' title='"._MD_TDMTCHAT_READ."' src='".TDMTCHAT_IMAGES_URL."/read.png' border='0'>" : "<img alt='"._MD_TDMTCHAT_UNREAD."' title='"._MD_TDMTCHAT_UNREAD."' src='".TDMTCHAT_IMAGES_URL."/unread.png' border='0'>";
		$member['from'] = $arr[$i]->getVar('tchat_from');
		$member['message'] = $arr[$i]->getVar('tchat_message');
		$member['sent'] = formatTimeStamp($arr[$i]->getVar('tchat_sent'), "m");
		//trouve le membre
		$criteria = new CriteriaCompo();	
		$criteria->add(new Criteria('uname', $member['uname'])); 
		$user = $user_handler->getAll($criteria);
		//
		foreach (array_keys($user) as $u) {
		
		$member['uid'] = $user[$u]->getVar('uid');
		$member['location'] = $user[$u]->getVar('user_from');
		$member['extra'] = $user[$u]->getVar('bio', 'N');
		$member['sig'] = $user[$u]->getVar('user_sig', 'N');
		$member['url'] =  $user[$u]->getVar('url', 'E');
		if ($user[$u]->getVar('user_viewemail') == 1) {
		$member['email'] = $user[$u]->getVar('email', 'E');
		} else {
        $member['email'] = false;
        }
		$last = formatTimeStamp($user[$u]->getVar('last_login'),"m");
		
		$poster = new XoopsUser($user[$u]->getVar('uid'));
		/* Online poster */
		if ($poster->isOnline()) {
        $member['status'] = "<img src='".TDMTCHAT_IMAGES_URL."/online.png'  title='"._MD_TDMTCHAT_ONLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."' alt='"._MD_TDMTCHAT_ONLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."'>";
		$border = "#aee0fa";
		} else {
        $member['status'] = "<img src='".TDMTCHAT_IMAGES_URL."/offline.png' title='"._MD_TDMTCHAT_OFFLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."' alt='"._MD_TDMTCHAT_OFFLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."'>";
		$border = "#e0e0e0";
		}
	  
	  	$image =  XOOPS_ROOT_PATH.'/uploads/'.$user[$u]->getVar('user_avatar');
		if (file_exists($image) && $user[$u]->getVar('user_avatar') != 'blank.gif') {
		$member['picture'] = "<img class='img'src='".XOOPS_URL."/uploads/".$user[$u]->getVar('user_avatar')."' height='100px' title=".$user[$u]->getVar('uname')." style='border: 2px solid ".$border.";' alt=".$user[$u]->getVar('uname').">";
		} else {
		$member['picture'] = "<img class='img' src='".TDMTCHAT_IMAGES_URL."/no_avatar_man.gif'  height='100px' style='border: 2px solid ".$border."' title='Anonyme' alt='Anonyme'>";
		}
		//count message
	$criteria = new CriteriaCompo();
	$criteria->setSort('tchat_id');
	$criteria->setOrder('ASC');
	$assoc_arr = $tchat_handler->getAll($criteria);
	$mytree = new XoopsObjectTree($assoc_arr, "tchat_id" , "tchat_pid" );
	$sous_arr = $mytree->getAllChild($arr[$i]->getVar('tchat_id'));
	//$member_chat = array();
	foreach ($sous_arr as $tree) {
	 $chat['id'] = $tree->getVar('tchat_id');
	 $chat['recd'] = $tree->getVar('tchat_recd') == 1 ? "<img alt='"._MD_TDMTCHAT_READ."' title='"._MD_TDMTCHAT_READ."' src='".TDMTCHAT_IMAGES_URL."/read.png' border='0'>" : "<img alt='"._MD_TDMTCHAT_UNREAD."' title='"._MD_TDMTCHAT_UNREAD."' src='".TDMTCHAT_IMAGES_URL."/unread.png' border='0'>";
	 $chat['from'] = $tree->getVar('tchat_from');
	 $chat['to'] = $tree->getVar('tchat_to');
	 $chat['box'] = $tree->getVar('tchat_pid');
	 $chat['message'] = $tree->getVar('tchat_message');
	 $chat['sent'] = formatTimeStamp($tree->getVar('tchat_sent'), "m");

	$member['chat'][] = $chat;
	 }
	 //
		$xoopsTpl->append('member', $member);
		unset($member['chat']);
		}
		}
		
		//page nav
		if ($total_member > $xoopsModuleConfig['tdmtchat_pageuser']) {
			$nav = new XoopsPageNav($total_member, $xoopsModuleConfig['tdmtchat_pageuser'], $start, 'start');
			$xoopsTpl->assign( 'nav_page', $nav->renderNav() );
		}
		
	
//perm
if ($gperm_handler->checkRight('tchat_view', 4, $groups, $xoopsModule->getVar('mid'))) {
$xoopsTpl->assign('perm_tchat', true);
}
if ($gperm_handler->checkRight('tchat_view', 8, $groups, $xoopsModule->getVar('mid'))) {
$xoopsTpl->assign('perm_carte', true);
}
tdmtchat_header();
include_once XOOPS_ROOT_PATH.'/footer.php';
?>