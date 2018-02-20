<?php
/**
 * ****************************************************************************
 *  - TDMNotify By TDM   - TEAM DEV MODULE FOR XOOPS
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
Adminmenu(2, _AM_NOTIFY_MANAGE_BLOCK);
echo "<style>
.CPbigTitle{
	font-size: 20px;
	color: #1E90FF;
	background: no-repeat left top;
	font-weight: bold;
	height: 40px;
	vertical-align: middle;
	padding: 10px 0 0 50px;
	border-bottom: 3px solid #1E90FF;
}
</style>";
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (2, _AM_NOTIFY_MANAGE_BLOCK);
}

$notif_handler =& xoops_getModuleHandler('tdmnotify_notif', 'TDMNotify');
$form_handler =& xoops_getModuleHandler('tdmnotify_form', 'TDMNotify');
$block_handler =& xoops_getModuleHandler('tdmnotify_block', 'TDMNotify');

$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
 

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/block.png); background-repeat: no-repeat; background-position: left; padding-left: 50px;"><strong>'._AM_NOTIFY_MANAGE_BLOCK.'</strong>';
echo '</div><br /><div class="head" align="center">';
echo '<a href="block.php?op=list">'._AM_NOTIFY_BLOCK_BLOCK.'</a>';
echo ' | ';
echo '<a href="block.php?op=form">'._AM_NOTIFY_BLOCK_FORM.'</a>';
echo '</div><br>';

 switch($op) {
  
    //sauv  
 case "save":
 
		if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('block.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if (isset($_REQUEST['id'])) {
        $obj =& $block_handler->get($_REQUEST['id']);
		} else {
        $obj =& $block_handler->create();
		}   
		
		$obj->setVar('pid', implode("|", $_REQUEST['pid']));	
		$obj->setVar('title', $_REQUEST['title']);
		$obj->setVar('text', $_REQUEST['text']);
		$obj->setVar('img', $_REQUEST['img']);
		$obj->setVar('style', $_REQUEST['style']);
		$obj->setVar('alt', $_REQUEST['alt']);
		$obj->setVar('indate', time());
		
		if ($block_handler->insert($obj)) {
	//permission
	$id = $obj->getVar('id');
	$gperm_handler = &xoops_gethandler('groupperm');
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('gperm_itemid', $id, '='));
	$criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'),'='));
	$criteria->add(new Criteria('gperm_name', 'notify_view', '='));
	$gperm_handler->deleteAll($criteria);

	if(isset($_POST['groups_view'])) {
		foreach($_POST['groups_view'] as $onegroup_id) {
			$gperm_handler->addRight('notify_view', $id, $onegroup_id, $xoopsModule->getVar('mid'));
		}
	}
	
		
		
		
        redirect_header('block.php', 2, _AM_NOTIFY_BASEOK);
		}
		//include_once('../include/forms.php');
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
		$form->display();
    break;
	
	 case "save_form":
 
		if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('block.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if (isset($_REQUEST['id'])) {
        $obj =& $form_handler->get($_REQUEST['id']);
		} else {
        $obj =& $form_handler->create();
		}   
		
		$obj->setVar('champ', $_REQUEST['champ']);			
		$obj->setVar('size', $_REQUEST['size']);
		$obj->setVar('limit', $_REQUEST['limit']);
		$obj->setVar('title', $_REQUEST['title']);
		$obj->setVar('option', $_REQUEST['option']);
		$obj->setVar('label', $_REQUEST['label']);
		
		if ($form_handler->insert($obj)) {
        redirect_header('block.php', 2, _AM_NOTIFY_BASEOK);
		}
		//include_once('../include/forms.php');
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
		$form->display();
    break;
	
	 case "edit": 
    $obj = $block_handler->get($_REQUEST['id']);
    $form = $obj->getForm();
    $form->display();
    break;
	
	case "edit_form": 
    $obj = $form_handler->get($_REQUEST['id']);
    $form = $obj->getForm();
    $form->display();
    break;
	
	
 case "delete":
	$obj =& $block_handler->get($_REQUEST['id']);
	
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('block.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		//supprime le genre	
     if ($block_handler->delete($obj)) {
        redirect_header('block.php', 2, _AM_NOTIFY_BASEOK);
       } else {
           echo $obj->getHtmlErrors();
        }
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_NOTIFY_FORMSUREDEL, $obj->getVar('title')));
    }
    break;
	
	 case "delete_form":
	$obj =& $form_handler->get($_REQUEST['id']);
	
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('block.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		//supprime le genre	
     if ($form_handler->delete($obj)) {
        redirect_header('block.php', 2, _AM_NOTIFY_BASEOK);
       } else {
           echo $obj->getHtmlErrors();
        }
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_NOTIFY_FORMSUREDEL, $obj->getVar('title')));
    }
    break;
	

case "form": 

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

	
	$criteria->setLimit($limit);
	$criteria->setOrder('ASC');
	$alb_arr = $form_handler->getObjects( $criteria );
	$numrows = $form_handler->getCount();
	
	
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
			echo '<th align="center" width="20%">'._AM_NOTIFY_TITLE.'</th>';
			echo '<th align="center" width="10%">'._AM_NOTIFY_TYPE.'</th>';
			echo '<th align="center" width="10%">'._AM_NOTIFY_SIZE.'</th>';
			echo '<th align="center" width="10%">'._AM_NOTIFY_LIMIT.'</th>';
			echo '<th align="center" width="20%">'._AM_NOTIFY_OPTION.'</th>';
			echo '<th align="center" width="20%">'._AM_NOTIFY_LABEL.'</th>';
			echo '<th align="center" width="20%">'._AM_NOTIFY_ACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
		    foreach (array_keys($alb_arr) as $i) {
			
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $alb_arr[$i]->getVar('id');
			$title = $myts->displayTarea($alb_arr[$i]->getVar('title'));
			
			$display = $alb_arr[$i]->getVar('visible') == 1 ? "<img src='./../images/on.gif' border='0'>" : "<img src='./../images/off.gif' border='0'>";

			
 				echo '<tr class="'.$class.'">';
				echo '<td align="center" >'.$title.'</td>';
				echo '<td align="center" >'.$alb_arr[$i]->getVar('champ').'</td>';
				echo '<td align="center" >'.$alb_arr[$i]->getVar('size').'</td>';
				echo '<td align="center" >'.$alb_arr[$i]->getVar('limit').'</td>';
				echo '<td align="center" >'.$alb_arr[$i]->getVar('option').'</td>';
				echo '<td align="center" >'.$alb_arr[$i]->getVar('label').'</td>';
				echo '<td align="center" >';
				echo '<a href="block.php?op=edit_form&id='.$id.'"><img src="./../images/edit_mini.gif" border="0" alt="'._AM_NOTIFY_EDITER.'" title="'._AM_NOTIFY_EDITER.'"></a>';
				echo '<a href="block.php?op=delete_form&id='.$id.'"><img src="./../images/delete_mini.gif" border="0" alt="'._AM_NOTIFY_DELETE.'" title="'._AM_NOTIFY_DELETE.'"></a>';
				echo '</td>';
				echo '</tr>';
			 }
			 echo '</table><br /><br />';
			 echo '<div align=right>'.$pagenav.'</div><br />';
		}
		// Affichage du formulaire de cr?ation de cat?gories
    	$obj =& $form_handler->create();
    	$form = $obj->getForm();
    	$form->display();
	
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

	
	$criteria->setLimit($limit);
	$criteria->setOrder('ASC');
	$alb_arr = $block_handler->getObjects( $criteria );
	$numrows = $block_handler->getCount();
	
	
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
			echo '<th align="center" width="10%">ID</th>';
			echo '<th align="center" width="30%">'._AM_NOTIFY_IMG.'</th>';
			echo '<th align="center" width="40%">'._AM_NOTIFY_TITLE.'</th>';
			echo '<th align="center" width="20%">'._AM_NOTIFY_ACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
		    foreach (array_keys($alb_arr) as $i) {		
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $alb_arr[$i]->getVar('id');
			$title = $myts->displayTarea($alb_arr[$i]->getVar('title'));
			//on test l'existance de l'image
			$img = $alb_arr[$i]->getVar("img") ? $alb_arr[$i]->getVar("img") : 'blank.png';
			$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/".$img;
			if (file_exists($imgpath)) {
			$album_img = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/".$alb_arr[$i]->getVar("img");
			} else {
			$album_img = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/blank.png";
			}
			
 				echo '<tr class="'.$class.'">';
				echo '<td align="center">'.$id.'</td>';
				echo '<td align="center"><img src="'.$album_img.'" alt="" title=""></td>';
				echo '<td align="center">'.$title.'</td>';
				echo '<td align="center">';
				echo '<a href="block.php?op=edit&id='.$id.'"><img src="./../images/edit_mini.gif" border="0" alt="'._AM_NOTIFY_EDITER.'" title="'._AM_NOTIFY_EDITER.'"></a>';
				echo '<a href="block.php?op=delete&id='.$id.'"><img src="./../images/delete_mini.gif" border="0" alt="'._AM_NOTIFY_DELETE.'" title="'._AM_NOTIFY_DELETE.'"></a>';
				echo '</td>';
				echo '</tr>';
			 }
			 echo '</table><br /><br />';
			 echo '<div align=right>'.$pagenav.'</div><br />';
		}
		// Affichage du formulaire de cr?ation de cat?gories
    	$obj =& $block_handler->create();
    	$form = $obj->getForm();
    	$form->display();
    break;
	
  }
xoops_cp_footer();
?>