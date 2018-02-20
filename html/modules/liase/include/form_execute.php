<?php
// $Id: form_execute.php,v 1.6 2005/02/15 07:30:18 tuff Exp $
###############################################################################
##                Liaise -- Contact forms generator for XOOPS                ##
##                 Copyright (c) 2003-2005 NS Tai (aka tuff)                 ##
##                       <http://www.brandycoke.com/>                        ##
###############################################################################
##                   XOOPS - PHP Content Management System                   ##
##                       Copyright (c) 2000 XOOPS.org                        ##
##                          <http://www.xoops.org/>                          ##
###############################################################################
##  This program is free software; you can redistribute it and/or modify     ##
##  it under the terms of the GNU General Public License as published by     ##
##  the Free Software Foundation; either version 2 of the License, or        ##
##  (at your option) any later version.                                      ##
##                                                                           ##
##  You may not change or alter any portion of this comment or credits       ##
##  of supporting developers from this source code or any supporting         ##
##  source code which is considered copyrighted (c) material of the          ##
##  original comment or credit authors.                                      ##
##                                                                           ##
##  This program is distributed in the hope that it will be useful,          ##
##  but WITHOUT ANY WARRANTY; without even the implied warranty of           ##
##  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            ##
##  GNU General Public License for more details.                             ##
##                                                                           ##
##  You should have received a copy of the GNU General Public License        ##
##  along with this program; if not, write to the Free Software              ##
##  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA ##
###############################################################################
##  Author of this file: NS Tai (aka tuff)                                   ##
##  URL: http://www.brandycoke.com/                                          ##
##  Project: Liaise                                                          ##
###############################################################################
if( preg_match('/form_execute.php/', $_SERVER['PHP_SELF']) ){
	die('Access denied');
}

$liaise_ele_mgr =& xoops_getmodulehandler('elements');
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('form_id', $form->getVar('form_id')), 'AND');
$criteria->add(new Criteria('ele_display', 1), 'AND');
$criteria->setSort('ele_order');
$criteria->setOrder('ASC');
$elements =& $liaise_ele_mgr->getObjects($criteria, true);

$msg = array();
$err = $attachments = array();
unset($_POST['submit']);
unset($_POST['form_id']);
foreach( $_POST as $k => $v ){
	if( preg_match('/ele_/', $k) ){
		$n = explode("_", $k);
		$ele[$n[1]] = $v;
//			$id[$n[1]] = $n[1];
	}elseif( $k == 'xoops_upload_file' ){
		foreach( $_POST[$k] as $f ){
			$n = explode("_", $f);
			$ele[$n[1]] = $v;
		}
	}
}

foreach( $elements as $i ){
	$ele_id = $i->getVar('ele_id');
	$ele_type = $i->getVar('ele_type');
	$ele_value = $i->getVar('ele_value');
	$ele_req = $i->getVar('ele_req');
	$ele_caption = $i->getVar('ele_caption');
	if( isset($ele[$ele_id]) ){
		if( $i->getVar('ele_caption') != '' ){
			$msg[$ele_id] = "\n".$myts->stripSlashesGPC($i->getVar('ele_caption'))."\n";
		}
		switch($ele_type){
			case 'upload':
			case 'uploadimg':
				if( isset($_FILES['ele_'.$ele_id]) ){
					require_once LIAISE_ROOT_PATH.'class/uploader.php';
					$ext = empty($ele_value[1]) ? 0 : explode('|', $ele_value[1]);
					$mime = empty($ele_value[2]) ? 0 : explode('|', $ele_value[2]);

					if( $ele_type == 'uploadimg' ){
						$uploader[$ele_id] =& new LiaiseMediaUploader(LIAISE_UPLOAD_PATH, $ele_value[0], $ext, $mime, $ele_value[4], $ele_value[5]);
					}else{
						$uploader[$ele_id] =& new LiaiseMediaUploader(LIAISE_UPLOAD_PATH, $ele_value[0], $ext, $mime);
					}
					if( $ele_value[0] == 0 ){
						$uploader[$ele_id]->noAdminSizeCheck(true);
					}
					if( $uploader[$ele_id]->fetchMedia('ele_'.$ele_id) ){
						$attachments[] = array(
								'id' => $ele_id,
								'path' => $_FILES['ele_'.$ele_id]['tmp_name'],
								'name' => $_FILES['ele_'.$ele_id]['name'],
								'saveto' => $ele_value[3]
												);
					}else{
						$err[] = $uploader[$ele_id]->getErrors();
					}
				}
			break;
			case 'text':
				$ele[$ele_id] = trim($ele[$ele_id]);
				if( preg_match('/\{EMAIL\}/', $ele_value[2]) ){
					if( !checkEmail($ele[$ele_id]) ){
						$err[] = _LIAISE_ERR_INVALIDMAIL;
					}else{
						$reply_mail = $ele[$ele_id];
					}
				}
				if( preg_match('/\{UNAME\}/', $ele_value[2]) ){
					$reply_name = $ele[$ele_id];
				}
				$msg[$ele_id] .= $myts->stripSlashesGPC($ele[$ele_id]);
			break;
			case 'textarea':
				$msg[$ele_id] .= $myts->stripSlashesGPC($ele[$ele_id]);
			break;
			case 'radio':
				$opt_count = 1;
				while( $v = each($ele_value) ){
					if( $opt_count == $ele[$ele_id] ){
						$other = checkOther($v['key'], $ele_id, $ele_caption);
						if( $other != false ){
							$msg[$ele_id] .= $other;
						}else{
							$msg[$ele_id] .= $myts->stripSlashesGPC($v['key']);
						}
					}
					$opt_count++;
				}
			break;
			case 'yn':
				$v = ($ele[$ele_id]==2) ? _NO : _YES;
				$msg[$ele_id] .= $myts->stripSlashesGPC($v);
			break;
			case 'checkbox':
				$opt_count = 1;
				while( $v = each($ele_value) ){
					if( is_array($ele[$ele_id]) ){
						if( in_array($opt_count, $ele[$ele_id]) ){
							$other = checkOther($v['key'], $ele_id, $ele_caption);
							if( $other != false ){
								$msg[$ele_id] .= $other;
							}else{
								$msg[$ele_id] .= $myts->stripSlashesGPC($v['key']);
							}
						}
						$opt_count++;
					}else{
						if( !empty($ele[$ele_id]) ){
							$msg[$ele_id] .= $myts->stripSlashesGPC($v['key']);
						}
					}
				}
			break;
			case 'select':
				$opt_count = 1;
				if( is_array($ele[$ele_id]) ){
					while( $v = each($ele_value[2]) ){
						if( in_array($opt_count, $ele[$ele_id]) ){
							$msg[$ele_id] .= $myts->stripSlashesGPC($v['key']);
						}
						$opt_count++;
					}
				}else{
					while( $j = each($ele_value[2]) ){
						if( $opt_count == $ele[$ele_id] ){
							$msg[$ele_id] .= $myts->stripSlashesGPC($j['key']);
						}
						$opt_count++;
					}
				}
			break;
			default:
			break;
		}
	}elseif( $ele_req == 1 ){
		$err[] = sprintf(_LIAISE_ERR_REQ, $ele_caption);
	}
}
// 	echo nl2br($msg);

if( is_dir(LIAISE_ROOT_PATH."language/".$xoopsConfig['language']."/mail_template") ){
	$template_dir = LIAISE_ROOT_PATH."language/".$xoopsConfig['language']."/mail_template";
}else{
	$template_dir = LIAISE_ROOT_PATH."language/english/mail_template";
}
$xoopsMailer =& getMailer();
$xoopsMailer->setTemplateDir($template_dir);
$xoopsMailer->setTemplate('liaise.tpl');
$xoopsMailer->setSubject(sprintf(_LIAISE_MSG_SUBJECT, $myts->stripSlashesGPC($form->getVar('form_title'))));
if( in_array('user', $xoopsModuleConfig['moreinfo']) ){
	if( is_object($xoopsUser) ){
		$xoopsMailer->assign("UNAME", sprintf(_LIAISE_MSG_UNAME, $xoopsUser->getVar("uname")));
		$xoopsMailer->assign("ULINK", sprintf(_LIAISE_MSG_UINFO, XOOPS_URL.'/userinfo.php?uid='.$xoopsUser->getVar("uid")));
	}else{
		$xoopsMailer->assign("UNAME", sprintf(_LIAISE_MSG_UNAME, $xoopsConfig['anonymous']));
		$xoopsMailer->assign("ULINK", '');
	}
}else{
	$xoopsMailer->assign("UNAME", '');
	$xoopsMailer->assign("ULINK", '');
}
if( in_array('ip', $xoopsModuleConfig['moreinfo']) ){
	$proxy = $_SERVER['REMOTE_ADDR'];
	$ip = '';
	if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}elseif( isset($_SERVER['HTTP_PROXY_CONNECTION']) ){
		$ip = $_SERVER['HTTP_PROXY_CONNECTION'];
	}elseif( isset($_SERVER['HTTP_VIA']) ){
		$ip = $_SERVER['HTTP_VIA'];
	}
	$ip = empty($ip) ? $_SERVER['REMOTE_ADDR'] : $ip;
	if( $proxy != $ip ){
		$ip = $ip.sprintf(_LIAISE_PROXY, $proxy);
	}
	$xoopsMailer->assign("IP", sprintf(_LIAISE_MSG_IP, $ip));
}else{
	$xoopsMailer->assign("IP", '');
}
if( in_array('agent', $xoopsModuleConfig['moreinfo']) ){
	$xoopsMailer->assign("AGENT", sprintf(_LIAISE_MSG_AGENT, $_SERVER['HTTP_USER_AGENT']));
}else{
	$xoopsMailer->assign("AGENT", '');
}
if( in_array('form', $xoopsModuleConfig['moreinfo']) ){
	$xoopsMailer->assign("FORMURL", sprintf(_LIAISE_MSG_FORMURL, LIAISE_URL.'index.php?form_id='.$form_id));
}else{
	$xoopsMailer->assign("FORMURL", '');
}

$group = $member_handler->getGroup($form->getVar('form_send_to_group'));
if( $form->getVar('form_send_method') == 'p' && is_object($xoopsUser) && false != $group ){
	$xoopsMailer->usePM();
	$xoopsMailer->setToGroups($group);
}else{
	$xoopsMailer->useMail();
	$xoopsMailer->setFromName($xoopsConfig['sitename']);
	$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
	$xoopsMailer->multimailer->AddReplyTo($reply_mail, '"'.$reply_name.'"');
	$charset = !empty($xoopsModuleConfig['mail_charset']) ? $xoopsModuleConfig['mail_charset'] : _CHARSET;
	$xoopsMailer->charSet = $charset;
	if( false != $group ){
		$xoopsMailer->setToGroups($group);
	}else{
		$xoopsMailer->setToEmails($xoopsConfig['adminmail']);
	}
}

$uploaded = array();
if( count($attachments) > 0 ){
	foreach( $attachments as $a ){
		if( false == $xoopsMailer->isMail || $a['saveto'] ){
			$uploader[$a['id']]->prefix = $form->getVar('form_id').'_';
			if( false == $uploader[$a['id']]->upload() ){
				$err[] = $uploader[$a['id']]->getErrors();
			}else{
				$saved = $uploader[$a['id']]->savedFileName;
				$uploaded[] = LIAISE_UPLOAD_PATH.$saved;
				$len = strlen(LIAISE_UPLOAD_PATH) - strlen(XOOPS_ROOT_PATH);
				if( $len >= 0 ){
					$path1 = substr(LIAISE_UPLOAD_PATH, 0, (0 - $len));
					$path2 = substr(LIAISE_UPLOAD_PATH, strlen($path1));
				}
				if( $path1 == XOOPS_ROOT_PATH ){
					$path3 = XOOPS_URL.$path2.$saved;
				}else{
					$path3 = LIAISE_UPLOAD_PATH.$saved;
				}
				$msg[$a['id']] .= sprintf(_LIAISE_UPLOADED_FILE, $path3);
			}
		}else{
			if( false == $xoopsMailer->multimailer->AddAttachment($a['path'], $a['name']) ){
				$err[] = $xoopsMailer->multimailer->ErrorInfo;
			}else{
				$msg[$a['id']] .= sprintf(_LIAISE_ATTACHED_FILE, $_FILES['ele_'.$a['id']]['name']);
			}
		}
	}
}
$message = '';
foreach( $msg as $m ){
	$message .= $m."\n";
}
$xoopsMailer->assign("MSG", $message);


if( count($err) < 1 ){
	if( !$xoopsMailer->send(true) ){
		$err[] = $xoopsMailer->getErrors();
	}
}

if( count($err) > 0 ){
	if( count($uploaded) > 0 ){
		foreach( $uploaded as $u ){
			@unlink($u);
		}
	}
	$xoopsOption['template_main'] = 'liaise_error.html';
	include_once XOOPS_ROOT_PATH.'/header.php';
	$xoopsTpl->assign('error_heading', _LIAISE_ERR_HEADING);
	$xoopsTpl->assign('errors', $err);
	$xoopsTpl->assign('go_back', _BACK);
	$xoopsTpl->assign('liaise_url', LIAISE_URL.'/index.php?form_id='.$form_id);
	$xoopsTpl->assign('xoops_pagetitle', _LIAISE_ERR_HEADING);
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

$whereto = $form->getVar('form_whereto');
$whereto = !empty($whereto) ? str_replace('{SITE_URL}', XOOPS_URL, $whereto) : XOOPS_URL.'/index.php';
redirect_header($whereto, 0, _LIAISE_MSG_SENT);

function checkOther($key, $id, $caption){
	global $err, $myts;
	if( !preg_match('/\{OTHER\|+[0-9]+\}/', $key) ){
		return false;
	}else{
		if( !empty($_POST['other']['ele_'.$id]) ){
			return _LIAISE_OPT_OTHER.$myts->stripSlashesGPC($_POST['other']['ele_'.$id]);
		}else{
			$err[] = sprintf(_LIAISE_ERR_REQ, $caption);
		}
	}
	return false;
}
?>