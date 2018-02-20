<?php
/**
 * ****************************************************************************
 *  - TDMSpot By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.tdmxoops.net)
 *
 * Cette licence, contient des limitations!!!
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier,
 * 3. Vous ne devez pas le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer et de rendre publiques les modifications
 *
 * @license     TDMFR PRO license
 * @author		TDMFR ; TEAM DEV MODULE 
 *
 * ****************************************************************************
 */

include '../../../include/cp_header.php'; 
include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include_once(XOOPS_ROOT_PATH."/class/tree.php");
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';

$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');

//verifie la presence des categorie
$numcat = $cat_handler->getCount();
	if ( $numcat == 0)  {
		redirect_header('cat.php', 2, _AM_SPOT_CATERROR);
	}

$myts =& MyTextSanitizer::getInstance();
$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';
$display = isset($_REQUEST['display']) ? $_REQUEST['display'] : 1;
$indate = isset($_REQUEST['indate']) ? $_REQUEST['indate'] : 0;
$cat = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : 0;
$itemid = isset($_REQUEST['itemid']) ? $_REQUEST['itemid'] : 0;
$order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'desc';
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'indate';


//compte les item
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('display', 1));
$numitem = $item_handler->getCount($criteria);
//compte les item en attente
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('display', 0));
$item_waiting = $item_handler->getCount($criteria);
//compte les item en attente
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('indate', time(), '>'));
$item_time = $item_handler->getCount($criteria);


 switch($op) {
  
    //sauv  
 case "save":
 
		if (!$GLOBALS['xoopsSecurity']->check()) {
        redirect_header('index.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if (isset($_REQUEST['id'])) {
        $obj =& $item_handler->get($_REQUEST['id']);
		} else {
        $obj =& $item_handler->create();
		}   
	
//upload	
		include_once XOOPS_ROOT_PATH.'/class/uploader.php';
     //cree le chemin
	
		$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/";
		$mimetype = explode('|',$xoopsModuleConfig['tdmspot_mimetype']);
		$uploader = new XoopsMediaUploader($uploaddir, $mimetype, $xoopsModuleConfig['tdmspot_mimemax'], null, null);

		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
		$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
		if (!$uploader->upload()) {
		$errors = $uploader->getErrors();
		redirect_header("javascript:history.go(-1)",3, $errors);
		} else {
		$obj->setVar('file', $uploader->getSavedFileName());
		}
		} else {
		$obj->setVar('file', $_REQUEST['file']);
		}
		$obj->setVar('title', $_REQUEST['title']);
		$obj->setVar('cat', $_REQUEST['cat']);
		$obj->setVar('text', $_REQUEST['text']);
		$obj->setVar('display', $_REQUEST['display']);
		$obj->setVar('indate', strtotime($_REQUEST['indate']['date']) + intval($_REQUEST['indate']['time']));
		$obj->setVar('poster', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
		
		if ($item_handler->insert($obj)) {
        redirect_header('item.php', 2, _AM_SPOT_BASEOK);
		}
		//include_once('../include/forms.php');
		echo $obj->getHtmlErrors();
		$form =& $obj->getForm();
		$form->display();
    break;

	
	 case "edit": 
	   xoops_cp_header();
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMSound_adminmenu(2, _AM_SPOT_MANAGE_ITEM);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (2, _AM_SPOT_MANAGE_ITEM);
}


//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/item.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_ITEM.'</strong></h3>';
echo '</div><br /><div class="head" align="center">';
echo ($display != 0) ? '<a href="item.php?op=list&display=0">'.sprintf(_AM_SPOT_THEREARE_ITEM_WAITING,$item_waiting).'</a> | ' : '<a href="item.php?op=list">'.sprintf(_AM_SPOT_THEREARE_ITEM,$numitem).'</a> | ';
echo ($indate != 0) ? '<a href="item.php?op=list">'.sprintf(_AM_SPOT_THEREARE_ITEM,$numitem).'</a>' : '<a href="item.php?op=list&indate='.time().'">'.sprintf(_AM_SPOT_THEREARE_ITEM_TIME,$item_time).'</a>';
echo '</div><br>';
    $obj = $item_handler->get($_REQUEST['id']);
    $form = $obj->getForm();
    $form->display();
    break;

    break;
	
 case "delete":
	$obj =& $item_handler->get($_REQUEST['id']);
	
    if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('item.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
	$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/";
	
		//supprime l'album	
     if ($item_handler->delete($obj)) {
	 @unlink($uploaddir.$obj->getVar('file'));
        redirect_header('item.php', 2, _AM_SPOT_BASEOK);
       } else {
           echo $obj->getHtmlErrors();
        }
    } else {
		xoops_cp_header();
        xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_SPOT_BASESURE, $obj->getVar('title')));
    }
    break;
	
	case _DELETE :
	
     if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('item.php', 2, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
		
        $_POST['id'] = unserialize($_REQUEST['id']);
        $size = count($_POST['id']);
        $obj = $_POST['id'];
        for ($i = 0; $i < $size; $i++) {
		$obj2 =& $item_handler->get($obj[$i]);	
        //supprime
		if ($item_handler->delete($obj2)) {
        $erreur = true;
		} else {
        echo $obj->getHtmlErrors();
        }
		
        }
		
		if (isset($erreur)) {
        redirect_header('item.php', 2, _AM_SPOT_BASEOK);
       } else {
           echo $obj2->getHtmlErrors();
        }
		
		} else { 
		xoops_cp_header();
		$title = print_r( $_REQUEST['id'], TRUE );
        xoops_confirm(array('ok' => 1, 'deletes' => 1, 'op' => $_REQUEST['op'], 'id'=> serialize(array_map("intval", $_REQUEST['id']))), $_SERVER['REQUEST_URI'], sprintf(_AM_SPOT_BASESUREDEL, $title));
    }
break;
	
	case "update":
	$obj = $item_handler->get($_REQUEST['id']);
	$obj->setVar('display', 1);
	if ($item_handler->insert($obj)) {
         redirect_header('item.php', 2, _AM_SPOT_BASEOK);
      }
	break;
	
 case "list": 
  default:
   xoops_cp_header();
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMSound_adminmenu(2, _AM_SPOT_MANAGE_ITEM);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (2, _AM_SPOT_MANAGE_ITEM);
}


//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/item.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_ITEM.'</strong></h3>';
echo '</div><br /><div class="head" align="center">';
echo ($display != 0) ? '<a href="item.php?op=list&display=0">'.sprintf(_AM_SPOT_THEREARE_ITEM_WAITING,$item_waiting).'</a> | ' : '<a href="item.php?op=list">'.sprintf(_AM_SPOT_THEREARE_ITEM,$numitem).'</a> | ';
echo ($indate != 0) ? '<a href="item.php?op=list">'.sprintf(_AM_SPOT_THEREARE_ITEM,$numitem).'</a>' : '<a href="item.php?op=list&indate='.time().'">'.sprintf(_AM_SPOT_THEREARE_ITEM_TIME,$item_time).'</a>';
echo '</div><br>';

  //creation du formulaire de tris
	$form = new XoopsThemeForm(_AM_SPOT_SEARCH, "tris", "item.php");
 
	$form->addElement(new XoopsFormHidden("op", "list"));
	$form->addElement(new XoopsFormHidden("display", $display));
	$form->addElement(new XoopsFormHidden("indate", $indate));

    $cat_select = new XoopsFormSelect(_AM_SPOT_CATEGORY, 'cat', $cat);
    $cat_select->addOption(0, _AM_SPOT_ALL);
    $cat_select->addOptionArray($cat_handler->getList());
    $form->addElement($cat_select);
 
	$form->addElement(new XoopsFormText(_AM_SPOT_ID, 'itemid', 8, 8, $itemid));
 
	$button_tray = new XoopsFormElementTray(_AM_SPOT_ACTION ,'');
	$button_tray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
	$form->addElement($button_tray);

	$form->display();
 
	echo"<br />";
	
	$uploaddir = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/";
	
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

	if (isset($display)) {
	$criteria->add(new Criteria('display', $display));
	}
	
	if (isset($_REQUEST['cat']) && $_REQUEST['cat'] != 0) {
	$criteria->add(new Criteria('cat', $_REQUEST['cat']));
	}
	
	if (isset($_REQUEST['itemid']) && $_REQUEST['itemid'] != 0) {
	$criteria->add(new Criteria('id', $_REQUEST['itemid']));
	}
	
	if (isset($_REQUEST['indate']) && $_REQUEST['indate'] != 0) {
	$criteria->add(new Criteria('indate', $_REQUEST['indate'], '>'));
	}
	
	$criteria->setLimit($limit);
	$criteria->setSort($sort);
	$criteria->setOrder($order);
	
	$alb_arr = $item_handler->getObjects( $criteria );
	$numrows = $item_handler->getCount($criteria);
	
	
	//nav
	
	if ( $numrows > $limit ) {
	$pagenav = new XoopsPageNav($numrows, $limit, $start, 'start', 'op=list&itemid='.$itemid.'&cat='.$cat.'&display='.$display.'&indate='.$indate);
	$pagenav = $pagenav->renderNav(2);
	} else {
	$pagenav = '';
	}
		//Affichage du tableau des catégories
		if ($numrows>0) {
			echo '<form name="form" id="form" action="item.php" method="post"><table width="100%" cellspacing="1" class="outer">';
			echo '<tr>';
			echo '<th align="center" width="5%"><input name="allbox" id="allbox" onclick="xoopsCheckAll(\'form\', \'allbox\');" type="checkbox" value="Check All" /></th>';
			echo '<th align="center" width="10%">'. tdm_switchselect(_AM_SPOT_VISIBLE, 'display', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="20%">'. tdm_switchselect(_AM_SPOT_INDATE, 'indate', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="20%">'. tdm_switchselect(_AM_SPOT_CATEGORY, 'cat', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="35%">'. tdm_switchselect(_AM_SPOT_TITLE, 'title', TDMSPOT_IMAGES_URL).'</th>';
			echo '<th align="center" width="10%">'._AM_SPOT_ACTION.'</th>';
			echo '</tr>';
			$class = 'odd';
		    foreach (array_keys($alb_arr) as $i) {
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $alb_arr[$i]->getVar('id');
			$title = $myts->displayTarea($alb_arr[$i]->getVar('title'));
			$indate = formatTimeStamp($alb_arr[$i]->getVar("indate"),"m");
				
			//trouve la categorie
			if ($cat =& $cat_handler->get($alb_arr[$i]->getVar('cat'))) {
			$cat_title = $cat->getVar('title');
			} else {
			$cat_title = 'NONE';
			}
			//
			if ($alb_arr[$i]->getVar('display') == 1 && $alb_arr[$i]->getVar('indate') < time() )
			{ $display = "<img src='./../images/on.gif' border='0'>";
			} else { $display =  "<a href='item.php?op=update&id=".$id."'><img alt='"._AM_SPOT_UPDATE."' title='"._AM_SPOT_UPDATE."' src='./../images/off.gif' border='0'></a>";
			}
			//on test l'existance de l'image
			$imgpath = XOOPS_ROOT_PATH . "/modules/".$xoopsModule->dirname()."/upload/".$alb_arr[$i]->getVar("file");
			if (file_exists($imgpath)) {
			$file = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/upload/".$alb_arr[$i]->getVar("file");
			} else {
			$file = XOOPS_URL. "/modules/".$xoopsModule->dirname()."/images/blank.png";
			}
			
 				echo '<tr class="'.$class.'">';
				echo '<td align="center"><input type="checkbox" name="id[]" id="id[]" value="'.$id.'" /></td>';
				echo '<td align="center">'.$display.'</td>';
				echo '<td align="center">'.$indate.'</td>';
				echo '<td align="center">'.$cat_title.'</td>';
				echo '<td align="center">'.$title.'</td>';
				echo '<td align="center">';
				echo '<a href="item.php?op=edit&id='.$id.'"><img src="./../images/edit_mini.gif" border="0" alt="'._AM_SPOT_EDITER.'" title="'._AM_SPOT_EDITER.'"></a>';
				echo '<a href="item.php?op=delete&id='.$id.'"><img src="./../images/delete_mini.gif" border="0" alt="'._AM_SPOT_DELETE.'" title="'._AM_SPOT_DELETE.'"></a>';
				echo '</td>';
				echo '</tr>';
			 }
			 echo '</table><input type="submit" name="op" value="'._DELETE.'" /></form><br /><br />';
			 echo '<div align=right>'.$pagenav.'</div><br />';
		}
		// Affichage du formulaire de cr?ation de cat?gories
    	$obj =& $item_handler->create();
    	$form = $obj->getForm();
    	$form->display();
    break;
	
  }
xoops_cp_footer();
?>