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
include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php';


$page_handler =& xoops_getModuleHandler('tdmspot_page', 'TDMSpot');
$block_handler =& xoops_getModuleHandler('tdmspot_newblocks', 'TDMSpot');

//verifie la presence des pages
 	$numgenre = $page_handler->getCount();
	if ( $numgenre == 0)  {
		redirect_header('page.php', 2, _AM_SPOT_PAGEERROR);
	}
	
$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'desc';
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'weight';

	
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
		
		if (isset($_REQUEST['options'])) {
            $options_count = count($_REQUEST['options']);
            if ($options_count > 0) {
                //Convert array values to comma-separated
                for ( $i = 0; $i < $options_count; $i++ ) {
                    if (is_array($_REQUEST['options'][$i])) {
                        $options[$i] = implode(',', $_REQUEST['options'][$i]);
                    }
                }
                $options = implode('|', $_REQUEST['options']);
                $obj->setVar('options', $options);
            }
        }
		
		$obj->setVar('bid', $_REQUEST['bid']);
		$obj->setVar('pid', $_REQUEST['pid']);	
		$obj->setVar('title', $_REQUEST['title']);
		$obj->setVar('side', $_REQUEST['side']);
		$obj->setVar('weight', $_REQUEST['weight']);
		$obj->setVar('visible', $_REQUEST['visible']);
		
		if ($block_handler->insert($obj)) {
        redirect_header('block.php', 2, _AM_SPOT_BASEOK);
		}
		//include_once('../include/forms.php');
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
		$form->display();
    break;
	
	 case "edit": 
	 xoops_cp_header();
 
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
Adminmenu(4, _AM_SPOT_MANAGE_BLOCK);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (4, _AM_SPOT_MANAGE_BLOCK);
}
//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/block.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_BLOCK.'</strong></h3>';
echo '</div><br />';
    $obj = $block_handler->get($_REQUEST['id']);
    $form = $obj->getForm();
    $form->display();
    break;

    break;
	
 case "delete":
	$obj =& $block_handler->get($_REQUEST['id']);
	
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('block.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		//supprime le genre	
     if ($block_handler->delete($obj)) {
        redirect_header('block.php', 2, _AM_SPOT_BASEOK);
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
            redirect_header('block.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		
        $_POST['id'] = unserialize($_REQUEST['id']);
        $size = count($_POST['id']);
        $obj = $_POST['id'];
        for ($i = 0; $i < $size; $i++) {
		$obj2 =& $block_handler->get($obj[$i]);	
        //supprime
		if ($block_handler->delete($obj2)) {
        $erreur = true;
		} else {
        echo $obj->getHtmlErrors();
        }
		
        }
		
		if (isset($erreur)) {
        redirect_header('block.php', 2, _AM_SPOT_BASEOK);
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
Adminmenu(4, _AM_SPOT_MANAGE_BLOCK);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (4, _AM_SPOT_MANAGE_BLOCK);
}
//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/block.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_BLOCK.'</strong></h3>';
echo '</div><br />';
	
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
	$criteria->setSort($sort);
	$criteria->setOrder($order);
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
			echo '<form name="form" id="form" action="item.php" method="post"><table width="100%" cellspacing="1" class="outer">';
			echo '<tr>';
			echo '<th align="center" width="5%"><input name="allbox" id="allbox" onclick="xoopsCheckAll(\'form\', \'allbox\');" type="checkbox" value="Check All" /></th>';
			echo '<th align="center" width="10%">'. tdm_switchselect(_AM_SPOT_VISIBLE, 'visible', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="10%">'. tdm_switchselect(_AM_SPOT_WEIGHT, 'weight', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="25%">'. tdm_switchselect(_AM_SPOT_PAGE, 'pid', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="30%">'. tdm_switchselect(_AM_SPOT_TITLE, 'title', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="20%">'._AM_SPOT_ACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
		    foreach (array_keys($alb_arr) as $i) {
			//nom de page 
			if ($page = $page_handler->get($alb_arr[$i]->getVar('pid')))
			{
			$page_title = $page->getVar('title'); 
			}else { 
			$page_title = false;
			}
			  
			//trouve le block
			$block_arr = new XoopsBlock($alb_arr[$i]->getVar('bid'));
			$title_block = $block_arr->getVar('name');
			
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $alb_arr[$i]->getVar('id');
			$title = $myts->displayTarea($alb_arr[$i]->getVar('title'));
			
			$display = $alb_arr[$i]->getVar('visible') == 1 ? "<img src='./../images/on.gif' border='0'>" : "<img src='./../images/off.gif' border='0'>";

			
 				echo '<tr class="'.$class.'">';
				echo '<td align="center"><input type="checkbox" name="id[]" id="id[]" value="'.$id.'" /></td>';
				echo '<td align="center" width="10%">'.$display.'</td>';
				echo '<td align="center" width="10%">'.$alb_arr[$i]->getVar('weight').'</td>';
				echo '<td align="center" width="30%">'.$alb_arr[$i]->getVar('pid').' - '.$page_title.'</td>';
				echo '<td align="center" width="30%">'.$title_block.' - '.$title.'</td>';
				echo '<td align="center" width="20%">';
				echo '<a href="block.php?op=edit&id='.$id.'"><img src="./../images/edit_mini.gif" border="0" alt="'._AM_SPOT_EDITER.'" title="'._AM_SPOT_EDITER.'"></a>';
				echo '<a href="block.php?op=delete&id='.$id.'"><img src="./../images/delete_mini.gif" border="0" alt="'._AM_SPOT_DELETE.'" title="'._AM_SPOT_DELETE.'"></a>';
				echo '</td>';
				echo '</tr>';
			 }
			 echo '</table><input type="submit" name="op" value="'._DELETE.'" /></form><br /><br />';
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