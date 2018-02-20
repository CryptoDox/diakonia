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
 
require('../../../mainfile.php');
require(XOOPS_ROOT_PATH.'/header.php');

 
if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

error_reporting(0);
$GLOBALS['xoopsLogger']->activated = false;

$module_handler =& xoops_gethandler('module');
$xoopsModule =& $module_handler->getByDirname('TDMTchat');

include_once XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->getVar("dirname").'/include/common.php';
include_once(XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/language/".$xoopsConfig['language']."/main.php");


$tchat_handler =& xoops_getModuleHandler('tdmtchat_tchat', 'TDMTchat');


//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$xd_uid = $xoopsUser->getVar('uid');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$xd_uid = 0;
}

if (!is_object($xoopsUser)) {
    redirect_header(XOOPS_URL, 3, _NOPERM);
    exit();
}

//global $dbh;
//$dbh = mysql_connect(DBPATH,DBUSER,DBPASS);
//mysql_selectdb(DBNAME,$dbh);

if ($_REQUEST['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_REQUEST['action'] == "sendchat") { sendChat(); } 
if ($_REQUEST['action'] == "closechat") { closeChat(); } 
if ($_REQUEST['action'] == "startchatsession") { startChatSession(); } 

 $action = $_REQUEST['action'];
 
if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

switch($action) {
 
 case('chatHeartbeat'):
 
 global $xoopsUser;
	
	
	//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$uid = $xoopsUser->getVar('uid');
	$uname = $xoopsUser->getVar('uname');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$uid = 0;
}
	
	$criteria = new CriteriaCompo();
    $criteria->add(new Criteria('tchat_to', $uname));
	$criteria->add(new Criteria('tchat_recd', '0'));
	$criteria->setSort('tchat_id');
	$criteria->setOrder('ASC');
	$arr = $tchat_handler->getall($criteria);

	$items = '';

	$chatBoxes = array();

	 foreach (array_keys($arr) as $i) {
	 $chat['from'] = $arr[$i]->getVar('tchat_from');
	 $chat['message'] = $arr[$i]->getVar('tchat_message');
	 $chat['sent'] = $arr[$i]->getVar('tchat_sent');
		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
		
	//mais a jour le message afficher
	 $obj =& $tchat_handler->get($arr[$i]->getVar('tchat_id'));
	$obj->setVar('tchat_recd', 1);
	$tchat_handler->insert($obj);
	}
	

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-$time;
			//$time = date('g:iA M dS', strtotime($time));
			$time = formatTimeStamp($time,"m");

			$message = _MD_TDMTCHAT_A.": $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
break;

case('chatHistorybeat'):
 
 global $xoopsUser;
		
	//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$uid = $xoopsUser->getVar('uid');
	$uname = $xoopsUser->getVar('uname');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$uname = XOOPS_GROUP_ANONYMOUS;
	$uid = 0;
}

	//unique si la boite n'est pas ouverte
	if (!isset($_SESSION['openChatBoxes'][$_POST['to']])) {

	$sous_arr = tdmtchat_unique($_POST['to']);
	$criteria = new CriteriaCompo();
	$criteria->setSort('tchat_id');
	$criteria->setOrder('ASC');
	$assoc_arr = $tchat_handler->getAll($criteria);
	$mytree = new XoopsObjectTree($assoc_arr, "tchat_id" , "tchat_pid" );
	$sous_arr += $mytree->getAllChild(tdmtchat_theone($sous_arr));


	$items = '';

	$chatBoxes = array();

	 foreach ($sous_arr as $tree) {
	 $chat['from'] = $tree->getVar('tchat_from');
	 $chat['to'] = $tree->getVar('tchat_to');
	 $chat['box'] = $tree->getVar('tchat_pid');
	 $chat['message'] = $tree->getVar('tchat_message');
	 $chat['sent'] = formatTimeStamp($tree->getVar('tchat_sent'), "m");

	 $chat['message'] = sanitize($chat['message']);
	 
	if ($chat['from'] == $uname) {
	$chatbox = $chat['to'];
	
	$items .= <<<EOD
					   {
			"s": "0",
			"b": "{$chat['to']}",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
	
	
	} else {
		
	$chatbox = $chat['from'];
	
		$items .= <<<EOD
					   {
			"s": "0",
			"b": "{$chat['from']}",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	}}
	

			$time = $chat['sent'] ;
			$last = _MD_TDMTCHAT_LAST;

		$items .= <<<EOD
{
"s": "0",
"b": "$chatbox",
"f": "$last",
"m": "{$time}"
},
EOD;

	


	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
		}

			exit(0);
break;

case('startChatSession'):
 

global $xoopsUser;
//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$uid = $xoopsUser->getVar('uid');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$uid = 0;
}
	
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
	
header('Content-type: application/json');
?>
{

		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
break;


 case('sendChat'):

global $xoopsUser;
//permission
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
	$uid = $xoopsUser->getVar('uid');
	$uname = $xoopsUser->getVar('uname');
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
	$uid = 0;
}
	
	$from = $uname;
	$to = $_POST['to'];
	$message = $_POST['message'];
	
	$tchat_handler =& xoops_getModuleHandler('tdmtchat_tchat', 'TDMTchat');

	$_SESSION['openChatBoxes'][$_POST['to']] = time();
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);
	$obj =& $tchat_handler->create();
	//trouve d'autre message
	$sous_arr = tdmtchat_unique($to);
	if (count($sous_arr) > 0) {
	$obj->setVar('tchat_pid', tdmtchat_theone($sous_arr));
	}
	//
	$obj->setVar('tchat_from', $from);
	$obj->setVar('tchat_to', $to);
	$obj->setVar('tchat_message', $message);
	$obj->setVar('tchat_sent', time());
	$tchat_handler->insert($obj);

	echo "1";
	exit(0);

break;

 case('closeChat'):
	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
break;
}

function chatBoxSession($chatbox) {

	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}