<?php
// $Id: modinfo.php,v 1.12 2003/04/02 04:44:23 mvandam Exp $
// Module Info

// The name of this module
define("_MI_NEWBBEX_NAME","F�rum");

// A brief description of this module
define("_MI_NEWBBEX_DESC","M�dulo de F�rum para XOOPS");

// Names of blocks for this module (Not all module has blocks)
define("_MI_NEWBBEX_BNAME1","T�picos Recentes");
define("_MI_NEWBBEX_BNAME2","T�picos mais Vistos");
define("_MI_NEWBBEX_BNAME3","T�picos mais Ativos");
define("_MI_NEWBBEX_BNAME4","T�picos Privados Recentes");
define("_MI_NEWBBEX_BNAME5","T�picos sem Resposta");
define("_MI_NEWBBEX_BNAME6","T�pico Privado sem Resposta");
define("_MI_NEWBBEX_BNAME7","T�picos Privado e P�blico sem Resposta");
define("_MI_NEWBBEX_BNAME8","Estat�sticas dos F�runs");
define("_MI_NEWBBEX_BNAME9","T�picos Privado e Publico mais recentes");
define("_MI_NEWBBEX_BNAME10","Estat�sticas Mensais");
define("_MI_NEWBBEX_BNAME11","Mensagens p�blicas e privadas desde a sua �ltima visita");

// Names of admin menu items
define("_MI_NEWBBEX_ADMENU1","Adicionar F�rum");
define("_MI_NEWBBEX_ADMENU2","Editar F�rum");
define("_MI_NEWBBEX_ADMENU3","Editar Privado F�rum");
define("_MI_NEWBBEX_ADMENU4","Reordenar F�rums/T�picos");
define("_MI_NEWBBEX_ADMENU5","Adicionar Categoria");
define("_MI_NEWBBEX_ADMENU6","Editar Categoria");
define("_MI_NEWBBEX_ADMENU7","Apagar Categoria");
define("_MI_NEWBBEX_ADMENU8","Reordenar Categoria");

// RMV-NOTIFY
// Notification event descriptions and mail templates

define ('_MI_NEWBBEX_THREAD_NOTIFY', 'T�pico');
define ('_MI_NEWBBEX_THREAD_NOTIFYDSC', 'Op��es da notifica��o que se aplicam ao t�pico atual.');

define ('_MI_NEWBBEX_FORUM_NOTIFY', 'F�rum');
define ('_MI_NEWBBEX_FORUM_NOTIFYDSC', 'Op��es da notifica��o que se aplicam ao forum atual.');

define ('_MI_NEWBBEX_GLOBAL_NOTIFY', 'Global');
define ('_MI_NEWBBEX_GLOBAL_NOTIFYDSC', 'Op��es globais de notifica��o do forum.');

define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', 'Avise-me sobre novas mensagens neste t�pico.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', 'Receba avisos de novas mensagens no t�pico atual.');
define ('_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Nova mensagem no t�pico');

define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', 'Novo T�pico');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', 'Avise-me sobre novos t�picos deste f�rum.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', 'Receba aviso quando um novo t�pico for iniciado no f�rum atual.');
define ('_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Novo t�pico no f�rum');

define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', 'Novo f�rum');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', 'Avise-me sobre novos f�runs.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', 'Receba aviso quando for criado um novo f�rum.');
define ('_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Novo f�rum');

define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', 'Receba aviso quando uma nova mensagem for enviada.');
define ('_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o :  Nova mensagem');

define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', 'Nova mensagem');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', 'Receba aviso quando uma nova mensagem for enviada.');
define ('_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Nova mensagem no f�rum');

define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', 'Nova Mensagem (texto completo)');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Avise-me de qualquer nova mensagem (inclui texto completo no aviso).');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Receba aviso com o texto completo quando uma nova mensagem for enviada.');
define ('_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notifica��o : Nova mensagem (texto completo)');

define ('_MI_NEWBBEX_SMNAME1', 'Busca Avan�ada');
define ('_MI_NEWBBEX_SHOWMSG', 'Mostre t�tulos privados e f�runs ');
define ('_MI_NEWBBEX_SHOWMSGDESC', 'Quando configurado para n�o, os usu�rios n�o poder�o ver f�runs e mensagens que eles n�o tem acesso');

// Added in version 1.5
define("_MI_NEWBBEX_ATTACH_FILES", "Mime Types (to attach files or pictures)");
define("_MI_NEWBBEX_ATTACH_HLP", "Type one mime type per line");

define('_MI_NEWBBEX_UPLSIZE', "MAX Filesize Upload (KB) 1048576 = 1 Meg");
define('_MI_NEWBBEX_UPLSIZE_DSC', "in bytes");
?>