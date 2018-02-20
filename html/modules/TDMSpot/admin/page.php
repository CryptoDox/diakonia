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
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$page_handler =& xoops_getModuleHandler('tdmspot_page', 'TDMSpot');
$block_handler =& xoops_getModuleHandler('tdmspot_newblocks', 'TDMSpot');

$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'desc';
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'weight';
 

include_once TDMSPOT_ROOT_PATH.'/class/breadcrumb.php';


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
		$var_cat = implode(',', $_REQUEST['cat']);
        $obj->setVar('cat', $var_cat);
		$obj->setVar('limit', $_REQUEST['limit']);
		
		if ($page_handler->insert($obj)) {
		
				//perm
	$id = $obj->getVar('id');
	$gperm_handler = &xoops_gethandler('groupperm');
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('gperm_itemid', $id, '='));
	$criteria->add(new Criteria('gperm_modid', $xoopsModule->getVar('mid'),'='));
	$criteria->add(new Criteria('gperm_name', 'spot_pageview', '='));
	$gperm_handler->deleteAll($criteria);

	if(isset($_POST['groups_view'])) {
		foreach($_POST['groups_view'] as $onegroup_id) {
			$gperm_handler->addRight('spot_pageview', $id, $onegroup_id, $xoopsModule->getVar('mid'));
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
	
	 case "edit": 
	 xoops_cp_header();
 
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(3, _AM_SPOT_MANAGE_PAGE);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (3, _AM_SPOT_MANAGE_PAGE);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/page.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_PAGE.'</strong></h3>';
echo '</div><br />';
    $obj = $page_handler->get($_REQUEST['id']);
    $form = $obj->getForm();
    $form->display();
    break;

    break;
	
 case "delete":
	$obj =& $page_handler->get($_REQUEST['id']);
	
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('page.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		//supprime le genre	
     if ($page_handler->delete($obj)) {
        redirect_header('page.php', 2, _AM_SPOT_BASEOK);
       } else {
           echo $obj->getHtmlErrors();
        }
    } else {
	 xoops_cp_header();
        xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_SPOT_BASESURE));
    }
    break;
	
		case _DELETE :
	
     if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('page.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		
        $_POST['id'] = unserialize($_REQUEST['id']);
        $size = count($_POST['id']);
        $obj = $_POST['id'];
        for ($i = 0; $i < $size; $i++) {
		$obj2 =& $page_handler->get($obj[$i]);	
        //supprime
		if ($page_handler->delete($obj2)) {
        $erreur = true;
		} else {
        echo $obj->getHtmlErrors();
        }
		
        }
		
		if (isset($erreur)) {
        redirect_header('page.php', 2, _AM_SPOT_BASEOK);
       } else {
           echo $obj2->getHtmlErrors();
        }
		
		} else { 
		xoops_cp_header();
		$title = print_r( $_REQUEST['id'], TRUE );
        xoops_confirm(array('ok' => 1, 'deletes' => 1, 'op' => $_REQUEST['op'], 'id'=> serialize(array_map("intval", $_REQUEST['id']))), $_SERVER['REQUEST_URI'], sprintf(_AM_SPOT_BASESUREDEL, $title));
    }
break;
	
 case "list": 
  default:
 xoops_cp_header();
 
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(3, _AM_SPOT_MANAGE_PAGE);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (3, _AM_SPOT_MANAGE_PAGE);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/page.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_PAGE.'</strong></h3>';
echo '</div><br />';

	$xoBreadCrumb = new SystemBreadcrumb();
	$xoBreadCrumb->addTips( _AM_SPOT_PAGEDESC );
	$xoBreadCrumb->render();
 	//$numgenre = $page_handler->getCount();
	//if ( $numgenre == 0)  {
	//redirect_header('page.php', 2, _AM_SPOT_PAGEERROR);
	//}
	
	//Parameters	
	$criteria = new CriteriaCompo();
	$limit = 20;
	if (isset($_REQUEST['start'])) {
	$criteria->setStart($_REQUEST['start']);
	$start = $_REQUEST['start'];
	} else {
	$criteria->setStart(0);
	$start = 0;
	}

	
	$criteria->setLimit($limit);
	$criteria->setSort($sort);
	$criteria->setOrder($order);
	$alb_arr = $page_handler->getObjects( $criteria );
	$numrows = $page_handler->getCount();
	
	
	//nav
	if ( $numrows > $limit ) {
	$pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'op=list');
	$pagenav = $pagenav->renderNav(2);
	} else {
	$pagenav = '';
	}
		//Affichage du tableau des catégories
		if ($numrows>0) {
			echo '<form name="form" id="form" action="item.php" method="post"><table width="100%" cellspacing="1" class="outer">';
			echo '<tr>';
			echo '<th align="center" width="5%"><input name="allbox" id="allbox" onclick="xoopsCheckAll(\'form\', \'allbox\');" type="checkbox" value="Check All" /></th>';
			echo '<th align="center" width="10%">'. tdm_switchselect(_AM_SPOT_VISIBLE, 'visible', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="10%">'. tdm_switchselect(_AM_SPOT_WEIGHT, 'weight', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="10%">'. tdm_switchselect('ID', 'id', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="45%">'. tdm_switchselect(_AM_SPOT_TITLE, 'title', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="20%">'._AM_SPOT_ACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
		    foreach (array_keys($alb_arr) as $i) {
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $alb_arr[$i]->getVar('id');
			
			$title = $myts->displayTarea($alb_arr[$i]->getVar('title'));
			
			$display = $alb_arr[$i]->getVar('visible') == 1 ? "<img src='./../images/on.gif' border='0'>" : "<img src='./../images/off.gif' border='0'>";

			
 				echo '<tr class="'.$class.'">';
				echo '<td align="center"><input type="checkbox" name="id[]" id="id[]" value="'.$id.'" /></td>';
				echo '<td align="center">'.$display.'</td>';
				echo '<td align="center">'.$alb_arr[$i]->getVar('weight').'</td>';
				echo '<td align="center">'.$id.'</td>';
				echo '<td align="center">'.$title.'</td>';
				echo '<td align="center">';
				echo '<a href="page.php?op=edit&id='.$id.'"><img src="./../images/edit_mini.gif" border="0" alt="'._AM_SPOT_EDITER.'" title="'._AM_SPOT_EDITER.'"></a>';
				echo '<a href="page.php?op=delete&id='.$id.'"><img src="./../images/delete_mini.gif" border="0" alt="'._AM_SPOT_DELETE.'" title="'._AM_SPOT_DELETE.'"></a>';
				echo '</td>';
				echo '</tr>';
			 }
			 echo '</table><input type="submit" name="op" value="'._DELETE.'" /></form><br /><br />';
			 echo '<div align=right>'.$pagenav.'</div><br />';
		}
		// Affichage du formulaire de cr?ation de cat?gories
    	$obj =& $page_handler->create();
    	$form = $obj->getForm();
    	$form->display();
    break;
	
  }
xoops_cp_footer();
?>