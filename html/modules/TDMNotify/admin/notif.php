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
 
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(1, _AM_NOTIFY_MANAGE_NOTIF);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (1, _AM_NOTIFY_MANAGE_NOTIF);
}


$notif_handler =& xoops_getModuleHandler('tdmnotify_notif', 'TDMNotify');
$form_handler =& xoops_getModuleHandler('tdmnotify_form', 'TDMNotify');
$block_handler =& xoops_getModuleHandler('tdmnotify_block', 'TDMNotify');

$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
 

//compte les notif
$numart = $notif_handler->getCount();
//compte les notif en attente
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('inread', 0));
$art_waiting = $notif_handler->getCount($criteria);

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/notif.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;"><strong>'._AM_NOTIFY_MANAGE_NOTIF.'</strong>';
echo '</div><br /><div class="head" align="center">';
echo !isset($_REQUEST['inread']) ||  $_REQUEST['inread'] == 1 ? '<a href="notif.php?op=list&inread=0">'.sprintf(_AM_NOTIFY_THEREARE_NOTIF_WAITING,$art_waiting).'</a>' : '<a href="notif.php?op=list&inread=1">'.sprintf(_AM_NOTIFY_THEREARE_NOTIF,$numart).'</a>';
echo '</div><br>';

 switch($op) {
  
    //sauv  
 case "save":
 
		if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('pages.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if (isset($_REQUEST['id'])) {
        $obj =& $page_handler->get($_REQUEST['id']);
		} else {
        $obj =& $page_handler->create();
		}		
	
		$obj->setVar('title', $_REQUEST['title']);
		$obj->setVar('weight', $_REQUEST['weight']);
		$obj->setVar('visible', $_REQUEST['visible']);
		
		if ($page_handler->insert($obj)) {
		
				//perm
	$id = $obj->getVar('id');
	$gperm_handler = &xoops_gethandler('groupperm');
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('gperm_itemid', $id, '='));
	$criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'),'='));
	$criteria->add(new Criteria('gperm_name', 'spot_view', '='));
	$gperm_handler->deleteAll($criteria);

	if(isset($_POST['groups_view'])) {
		foreach($_POST['groups_view'] as $onegroup_id) {
			$gperm_handler->addRight('spot_view', $id, $onegroup_id, $xoopsModule->getVar('mid'));
		}
	}
	//
		
        redirect_header('page.php', 2, _AM_SPOT_BASEOK);
		}
		//include_once('../include/forms.php');
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
		$form->display();
    break;
	
	
 case "delete":
	$obj =& $notif_handler->get($_REQUEST['id']);
	
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('notif.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		//supprime le genre	
     if ($notif_handler->delete($obj)) {
        redirect_header('notif.php', 2, _AM_NOTIFY_BASEOK);
       } else {
           echo $obj->getHtmlErrors();
        }
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_NOTIFY_BASESURE));
    }
    break;
	
	case "update":
	
	$obj = $notif_handler->get($_REQUEST['id']);
	
	if ($obj->getVar('poster') > 0 ) {
  
  if ($xoopsModuleConfig['send_notify'] > 1) {
		echo $users =& $obj->getMail($obj->getVar('poster'), 2);
	}
        }
	

	$obj->setVar('inread', 1);
	if ($notif_handler->insert($obj)) {
	redirect_header('notif.php', 2, _AM_NOTIFY_BASEOK);
     }
	 
	break;
	
 case "list": 
  default:
	
	//Parameters	
	$criteria = new CriteriaCompo();
	$limit = 10;
	if (isset($_REQUEST['start'])) {
	$criteria->setStart($_REQUEST['start']);
	$start = $_REQUEST['start'];
	} else {
	$criteria->setStart(0);
	$start = 0;
	}

	if (isset($_REQUEST['inread'])) {
	$criteria->add(new Criteria('inread', $_REQUEST['inread']));
	}
	
	$criteria->setLimit($limit);
	$criteria->setSort('indate');
	$criteria->setOrder('ASC');
	$alb_arr = $notif_handler->getObjects( $criteria );
	$numrows = $notif_handler->getCount();
	
	
	//nav
	if ( $numrows > $limit ) {
	$pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'op=list');
	$pagenav = $pagenav->renderNav(2);
	} else {
	$pagenav = '';
	}
		//Affichage du tableau des catégories
		if ($numrows>0) {
			echo '<table width="100%" cellspacing="1" class="outer">';
			echo '<tr>';
			echo '<th align="center" width="10%">'._AM_NOTIFY_NOTIF_READ.'</th>';
			echo '<th align="center" width="10%">'._AM_NOTIFY_BLOCK_BLOCK.'</th>';
			echo '<th align="center" width="10%">'._AM_NOTIFY_NOTIF_POSTER.'</th>';
			echo '<th align="center" width="50%">'._AM_NOTIFY_NOTIF_FORM.'</th>';
			echo '<th align="center" width="20%">'._AM_NOTIFY_ACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
		    foreach (array_keys($alb_arr) as $i) {
			//trouve titre block
			$ret =& $block_handler->get($alb_arr[$i]->getVar('block'));
			if (is_object($ret)) {
			$block_title = $myts->displayTarea($ret->getVar('title'));
			//
			} else {
			$block_title = 'none';
			}
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $alb_arr[$i]->getVar('id');
			$title = $myts->displayTarea($alb_arr[$i]->getVar('title'));
			$indate = formatTimeStamp($alb_arr[$i]->getVar("indate"),"m");
			$poster = XoopsUser::getUnameFromId($alb_arr[$i]->getVar('poster'));
			
			$display = $alb_arr[$i]->getVar('inread') == 1 ? "<img src='./../images/on.gif' border='0'>" : "<a href='notif.php?op=update&id=".$id."'><img alt='"._AM_NOTIFY_UPDATE."' title='"._AM_NOTIFY_UPDATE."' src='./../images/off.gif' border='0'></a>";
			
 				echo '<tr class="'.$class.'">';
				echo '<td align="center" >'.$display.'</td>';
				echo '<td align="center" >'.$block_title .'</td>';
				echo '<td align="center" >'.$poster.'</td>';
				echo '<td align="center" >'._AM_NOTIFY_NOTIF_URL.': <a href="'.$alb_arr[$i]->getVar('url').'">'.$alb_arr[$i]->getVar('url').'</a><br />'._AM_NOTIFY_NOTIF_FORM.': '.$alb_arr[$i]->getVar('form').'</td>';
				echo '<td align="center" >';
				//echo '<a href="page.php?op=edit&id='.$id.'"><img src="./../images/edit_mini.gif" border="0" alt="'._AM_SPOT_EDITER.'" title="'._AM_SPOT_EDITER.'"></a>';
				echo '<a href="notif.php?op=delete&id='.$id.'"><img src="./../images/delete_mini.gif" border="0" alt="'._AM_NOTIFY_DELETE.'" title="'._AM_NOTIFY_DELETE.'"></a>';
				echo '</td>';
				echo '</tr>';
			 }
			 echo '</table><br /><br />';
			 echo '<div align=right>'.$pagenav.'</div><br />';
		}
    break;
	
  }
xoops_cp_footer();
?>