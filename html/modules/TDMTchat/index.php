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
$xoopsOption['template_main'] = 'tdmtchat_index.html';

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
    $uid = 0;
    $uname = false;
	$groups = XOOPS_GROUP_ANONYMOUS;
	$picture = "<img class='img' src='".TDMTCHAT_IMAGES_URL."/no_avatar_man.gif'  height='100px' title='Anonyme' alt='Anonyme'>";
	$xoopsTpl->assign('user_uid', false);
	$xoopsTpl->assign('user_uname', _MD_TDMTCHAT_ANONYMOUS);
	$xoopsTpl->assign('user_name', false);
	$xoopsTpl->assign('user_location', false);
	$xoopsTpl->assign('user_extra', false);
	$xoopsTpl->assign('user_sig', false);
	$xoopsTpl->assign('user_picture', $picture);
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
	
	//test
	//$arr = tdmtchat_unique("testinou");
	//$criteria = new CriteriaCompo();
	//$criteria->setSort('tchat_id');
	//$criteria->setOrder('ASC');
	//$assoc_arr = $tchat_handler->getAll($criteria);
	//$mytree = new XoopsObjectTree($assoc_arr, "tchat_id" , "tchat_pid" );
	//$arr += $mytree->getAllChild(tdmtchat_theone($arr));
    //foreach (array_keys($arr) as $i) {
	//echo  $arr[$i]->getVar('tchat_id');
	//}


	//recherche			
	$criteria = new CriteriaCompo();
	
		if ( !empty($_REQUEST['form_uname']) ) {
			$criteria->add(new Criteria('uname', '%'.$myts->addSlashes(trim($_REQUEST['form_uname'])).'%', 'LIKE'));
			$requete_pagenav .= '&amp;form_uname='.$_REQUEST["form_uname"];
		}
		
		if ( !empty($_REQUEST['form_name']) ) {
			$criteria->add(new Criteria('name', '%'.$myts->addSlashes(trim($_REQUEST['form_name'])).'%', 'LIKE'));
			$requete_pagenav .= '&amp;form_name='.$_REQUEST["form_name"];
		}
			
		if ( !empty($_REQUEST['form_after']) ) {
			$time = strtotime(intval($_REQUEST['form_after']));
			$criteria->add(new Criteria('last_login', $time, '<'));
			$requete_pagenav .= '&amp;form_after='.$_REQUEST["form_after"];
		}
		
	//groupes
		//if ( !empty($_REQUEST['form_groups']) && is_numeric($_REQUEST['form_groups'])) {
		//	$form_groups = intval($_REQUEST['form_groups']);
		//	$criteria->add(new Criteria('level', $form_groups));
		//	$requete_pagenav .= '&amp;form_groups='.$_REQUEST["form_groups"];
		//}
		
		//ranks
		if ( !empty($_REQUEST['form_ranks']) && is_numeric($_REQUEST['form_ranks'])) {
			$form_ranks = intval($_REQUEST['form_ranks']);
			$criteria->add(new Criteria('rank', $form_ranks));
			$requete_pagenav .= '&amp;form_ranks='.$_REQUEST["form_ranks"];
		}
	
		//pays
		if ( !empty($_REQUEST['form_pays'])) {
			$criteria->add(new Criteria('user_from', '%'.$myts->addSlashes(trim($_REQUEST['form_pays'])).'%', 'LIKE'));
			$requete_pagenav .= '&amp;form_pays='.$_REQUEST["form_pays"];
		}
		
		//satus nouveaux membre
		if ( !empty($_REQUEST['status']) && $_REQUEST['status'] == 3) {
			$time = time() - (7 * 24 * 60 * 60);
			$criteria->add(new Criteria('user_regdate', $time, '>'));
		}
		
	$start = (!empty($_REQUEST['start'])) ? intval($_REQUEST['start']) : 0;	
	$criteria->setStart($start);
	
	
    $criteria->setOrder('DESC');
    $criteria->setLimit($xoopsModuleConfig['tdmtchat_pageuser']);
	
	//status
	if ($status == 1) {
	$criteria->setSort('o.last_login');
	$criteria->add(new Criteria('o.uid', $uid, '!='));
	$criteria->add(new Criteria('l.online_uid', "''", '!='));
	//$criteria->add(new Criteria('l.online_module', $xoopsModule->getVar('mid')));
	$user_handler->table_link = $xoopsDB->prefix('online'); 
	$user_handler->field_link = "online_uid"; 
	$user_handler->field_object = "uid"; 
	$arr =& $user_handler->getByLink($criteria); 
	$total_member = $user_handler->getCountByLink($criteria, false, 'online_uid');
	} elseif (!empty($_REQUEST['form_groups']) && is_numeric($_REQUEST['form_groups'])) {
	$groups = array( 0 => $_REQUEST['form_groups']);
	$criteria->setSort('last_login');
	$criteria->add(new Criteria('u.uid', $uid, '!='));
	$arr =& $member_handler->getUsersByGroupLink($groups, $criteria, true);
	$total_member = $member_handler->getUserCountByGroupLink($groups, $criteria);		
	$requete_pagenav .= '&amp;form_groups='.$_REQUEST["form_groups"];
	} else {
	$criteria->setSort('last_login');
	$criteria->add(new Criteria('uid', $uid, '!='));
	$arr =& $user_handler->getAll($criteria);
	$total_member = $user_handler->getCount($criteria);
	}
	
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
		
		if ($uid != $arr[$i]->getVar('uid')) {
		
		$member['uid'] = $arr[$i]->getVar('uid');
		$member['name'] = $arr[$i]->getVar('name');
	    $member['uname'] = $arr[$i]->getVar('uname');
		$member['location'] = $arr[$i]->getVar('user_from');
		$member['extra'] = $arr[$i]->getVar('bio', 'N');
		$member['sig'] = $arr[$i]->getVar('user_sig', 'N');
		$member['url'] =  $arr[$i]->getVar('url', 'E');
		if ($arr[$i]->getVar('user_viewemail') == 1) {
		$member['email'] = $arr[$i]->getVar('email', 'E');
		} else {
        $member['email'] = false;
        }
		$last = formatTimeStamp($arr[$i]->getVar('last_login'),"m");
		
		$poster = new XoopsUser($arr[$i]->getVar('uid'));
		/* Online poster */
		if ($poster->isOnline()) {
        $member['status'] = "<img src='".TDMTCHAT_IMAGES_URL."/online.png'  title='"._MD_TDMTCHAT_ONLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."' alt='"._MD_TDMTCHAT_ONLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."'>";
		$border = "#aee0fa";
		} else {
        $member['status'] = "<img src='".TDMTCHAT_IMAGES_URL."/offline.png' title='"._MD_TDMTCHAT_OFFLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."' alt='"._MD_TDMTCHAT_OFFLINE.'&#13;'._MD_TDMTCHAT_LAST_LOGIN.': '.$last."'>";
		$border = "#e0e0e0";
		}
	  
	  	$image =  XOOPS_ROOT_PATH.'/uploads/'.$arr[$i]->getVar('user_avatar');
		if (file_exists($image) && $arr[$i]->getVar('user_avatar') != 'blank.gif') {
		 $member['picture'] = "<img class='img'src='".XOOPS_URL."/uploads/".$arr[$i]->getVar('user_avatar')."' height='100px' title=".$arr[$i]->getVar('uname')." style='border: 2px solid ".$border.";' alt=".$arr[$i]->getVar('uname').">";
		} else {
		$member['picture'] = "<img class='img' src='".TDMTCHAT_IMAGES_URL."/no_avatar_man.gif'  height='100px' style='border: 2px solid ".$border."' title='Anonyme' alt='Anonyme'>";
		}
		
		$xoopsTpl->append('member', $member);
		}} 
		
		//page nav
		if ($total_member > $xoopsModuleConfig['tdmtchat_pageuser']) {
			$nav = new XoopsPageNav($total_member, $xoopsModuleConfig['tdmtchat_pageuser'], $start, 'start', 'status='.$status.$requete_pagenav);
			$xoopsTpl->assign( 'nav_page', $nav->renderNav() );
		}
		
		if ($gperm_handler->checkRight('tchat_view', 16, $groups, $xoopsModule->getVar('mid'))) {

		//form recherche
		$form = new XoopsThemeForm(_MD_TDMTCHAT_SEARCH, "form", "index.php", 'post', true);
  		$form->addElement(new XoopsFormText(_MD_TDMTCHAT_UNAME, "form_uname", 30, 60, @$_REQUEST['form_uname']));
		$form->addElement(new XoopsFormText(_MD_TDMTCHAT_NAME, "form_name", 30, 60, @$_REQUEST['form_name']));
		$form->addElement(new XoopsFormTextDateSelect(_MD_TDMTCHAT_AFTER, 'form_after', 15, @strtotime($_REQUEST['form_after'])));
		
		$groupe_select = new XoopsFormSelectGroup(_MD_TDMTCHAT_GROUP, "form_groups", false, @$_REQUEST['form_groups']);
		$groupe_select->addOption(0, "--------------");
		$form->addElement($groupe_select);
		
  		//$form->addElement( new XoopsFormSelectCountry(_MD_TDMTCHAT_PAYS, "form_pays", false, ''));
		$form->addElement(new XoopsFormText(_MD_TDMTCHAT_PAYS, "form_pays", 30, 100, @$_REQUEST['form_pays']));
		//
		include_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
		$rank_select = new XoopsFormSelect(_MD_TDMTCHAT_RANKS, "form_ranks", @$_REQUEST['form_ranks']);
		$ranklist = XoopsLists::getUserRankList();
		$rank_select->addOption(0, "--------------");
		$rank_select->addOptionArray($ranklist);
		$form->addElement($rank_select);
		$form->addElement(new XoopsFormRadioYN(_MD_TDMTCHAT_ONLINE, 'status', $status, _YES, _NO));
			
		
		$form->addElement(new XoopsFormButton("", "submit", _SUBMIT, "submit"));
			
		echo $form->display();
		
		}
	//pseudo masquer
	$form2 = new XoopsThemeForm(_MD_TDMTCHAT_SEARCH, "form2", "index.php", 'post', true);
	$form2->addElement(new XoopsFormHidden('username', $uname));
	echo $form2->display();
			
//netoye l'historique
tdmtchat_history();	
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