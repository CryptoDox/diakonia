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
include_once TDMSPOT_ROOT_PATH.'/class/breadcrumb.php';

$item_handler =& xoops_getModuleHandler('tdmspot_item', 'TDMSpot');
$cat_handler =& xoops_getModuleHandler('tdmspot_cat', 'TDMSpot');

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'list';

 switch($op) {
  
    //sauv  
 case "news":
  global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsModule;
  
  $error = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix('tdmspot_item')." 
  (id, cat, title, text, display, file, indate, hits, votes, counts, comments, poster) 
	SELECT 
	storyid, topicid, title, CONCAT(hometext, '{X_BREAK}' , bodytext) , ".$_REQUEST['display']." , '',
	published, counter, votes, rating, comments, uid 
	FROM ".$xoopsDB->prefix("stories"));
	
	$error .= $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix('tdmspot_cat')." 
  ( id, pid, title, date, text, img, weight, display) 
	SELECT 
	topic_id, topic_pid, topic_title, ".time()." , topic_description, topic_imgurl,
	0, ".$_REQUEST['display']." 
	FROM ".$xoopsDB->prefix("topics"));
  
if ($error) {
 redirect_header('import.php', 2, _AM_SPOT_BASEOK);
} else {  
redirect_header('import.php', 2, _AM_SPOT_BASEERROR);
}

 	break;
	
	 case "smartsection":
  global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsModule;
  
  $error = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix('tdmspot_item')." 
  (id, cat, title, text, display, file, indate, hits, votes, counts, comments, poster) 
	SELECT 
	  itemid, categoryid, title, CONCAT(summary, '{X_BREAK}' , body) , ".$_REQUEST['display']." , '',
	datesub, counter, '', '', comments, uid 
	FROM ".$xoopsDB->prefix("smartsection_items"));
	
	$error .= $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix('tdmspot_cat')." 
  ( id, pid, title, date, text, img, weight, display) 
	SELECT 
	categoryid, parentid, name, ".time()." , description, image,
	weight, ".$_REQUEST['display']." 
	FROM ".$xoopsDB->prefix("smartsection_categories"));
  
if ($error) {
 redirect_header('import.php', 2, _AM_SPOT_BASEOK);
} else {  
redirect_header('import.php', 2, _AM_SPOT_BASEERROR);
}

 	break;
	
 case "list": 
  default:
   xoops_cp_header();
if ( !is_readable(XOOPS_ROOT_PATH . "/Frameworks/art/functions.admin.php"))	{
TDMSound_adminmenu(20, _AM_SPOT_MANAGE_IMPORT);
} else {
include_once XOOPS_ROOT_PATH.'/Frameworks/art/functions.admin.php';
loadModuleAdminMenu (20, _AM_SPOT_MANAGE_IMPORT);
}

//menu
echo '<div class="CPbigTitle" style="background-image: url(../images/decos/import.png); background-repeat: no-repeat; background-position: left; padding-left: 60px; padding-top:20px; padding-bottom:15px;"><h3><strong>'._AM_SPOT_MANAGE_IMPORT.'</strong></h3>';
echo '</div><br />';

 	$xoBreadCrumb = new SystemBreadcrumb();
	$xoBreadCrumb->addTips( _AM_SPOT_IMPORTDESC );
	$xoBreadCrumb->render(); 
	
$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("stories")."'";
$result1=$xoopsDB->queryF($sq1); 
$news=$xoopsDB->fetchArray($result1);

$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("topics")."'";
$result1=$xoopsDB->queryF($sq1); 
$news_cat=$xoopsDB->fetchArray($result1);
 
 echo '<fieldset><legend class="CPmediumTitle">'._AM_SPOT_IMPORT_NEWS.'</legend>

		<br/>';
		if ($news > 0) {
		echo '<b><span style="color: green; padding-left: 20px;"><img src="./../images/on.gif" > ' .$news['Name']. ' : '.tdmspot_PrettySize($news['Data_length'] + $news['Index_length']) . ' | ' .$news_cat['Name']. ' : '.tdmspot_PrettySize($news_cat['Data_length'] + $news_cat['Index_length']) .'</span></b> | <b><a href="import.php?op=news&display=1">'._AM_SPOT_IMPORT_INDISPLAY.'</a></b> - <b><a href="import.php?op=news&display=0">'._AM_SPOT_IMPORT_OUTDISPLAY.'</a></b>';
		} else {
		echo '<b><span style="color: red; padding-left: 20px;"><img src="./../images/off.gif"> '. _AM_SPOT_IMPORT_NONE .'</a></span></b>';
		}
		echo '<br /><br />
	</fieldset><br />'; 
	
$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("smartsection_items")."'";
$result1=$xoopsDB->queryF($sq1); 
$smart=$xoopsDB->fetchArray($result1);

$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("smartsection_categories")."'";
$result1=$xoopsDB->queryF($sq1); 
$smart_cat=$xoopsDB->fetchArray($result1);
 
 echo '<fieldset><legend class="CPmediumTitle">'._AM_SPOT_IMPORT_SMARTSECTION.'</legend>
		<br/>';
		if ($smart > 0) {
		echo '<b><span style="color: green; padding-left: 20px;"><img src="./../images/on.gif" > ' .  tdmspot_PrettySize($smart['Data_length'] + $smart['Index_length']) . ' | ' .$smart_cat['Name']. ' : '.tdmspot_PrettySize($smart_cat['Data_length'] + $smart_cat['Index_length']) .'</span></b> | <b><a href="import.php?op=smartsection&display=1">'._AM_SPOT_IMPORT_INDISPLAY.'</a></b> - <b><a href="import.php?op=smartsection&display=0">'._AM_SPOT_IMPORT_OUTDISPLAY.'</a></b>';
		} else {
		echo '<b><span style="color: red; padding-left: 20px;"><img src="./../images/off.gif"> '. _AM_SPOT_IMPORT_NONE .'</a></span></b>';
		}
		echo '<br /><br />
	</fieldset><br />'; 
	
//$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("wfs_article")."'";
//$result1=$xoopsDB->queryF($sq1); 
//$wf=$xoopsDB->fetchArray($result1);
 
// echo '<fieldset><legend class="CPmediumTitle">'._AM_SPOT_IMPORT_WFSECTION.'</legend>
//		<br/>';
//		if ($wf > 0) {
//		echo '<b><span style="color: green; padding-left: 20px;"><img src="./../images/on.gif" > ' .  tdmspot_PrettySize($wf['Data_length'] + $wf['Index_length']) . '</span></b> | <b><a href="index.php?op=wfsection">'._AM_SPOT_IMPORT.'</a></b>';
//		} else {
//		echo '<b><span style="color: red; padding-left: 20px;"><img src="./../images/off.gif"> '. _AM_SPOT_IMPORT_NONE .'</a></span></b>';
//		}
//		echo '<br /><br />
//	</fieldset><br />'; 
	
//$sq1 = "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME."` LIKE '".$xoopsDB->prefix("xfs_article")."'";
//$result1=$xoopsDB->queryF($sq1); 
//$xf=$xoopsDB->fetchArray($result1);
 
// echo '<fieldset><legend class="CPmediumTitle">'._AM_SPOT_IMPORT_XFSECTION.'</legend>
//		<br/>';
//		if ($xf > 0) {
//		echo '<b><span style="color: green; padding-left: 20px;"><img src="./../images/on.gif" > ' .  tdmspot_PrettySize($xf['Data_length'] + $xf['Index_length']) . '</span></b> | <b><a href="index.php?op=xfsection">'._AM_SPOT_IMPORT.'</a></b>';
//		} else {
//		echo '<b><span style="color: red; padding-left: 20px;"><img src="./../images/off.gif"> '. _AM_SPOT_IMPORT_NONE .'</a></span></b>';
//		}
//		echo '<br /><br />
//	</fieldset><br />'; 
	
  break;
  }
 xoops_cp_footer(); 
?>
