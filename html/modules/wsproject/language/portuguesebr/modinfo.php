<?php
// $Id: modinfo.php 79 2005-12-25 18:57:28Z gron $
// Module Info

// The name of this module
define("_MI_WSPROJECT_NAME","Projetos");
// A brief description of this module
define("_MI_WSPROJECT_DESC","Uma ferramenta para administrar e planejar seus projetos.");

// Names of admin menu items
define('_MI_WSPROJECT_ADMENU1','Configura��es');


//Die Men�punkte
define("_MI_WSPROJECT_COMPLETEDPROJECTS",	"Projetos Finalizados");

define("_MI_WSPROJECT_ACTIVEPROJECTS","Projetos Ativos");
define("_MI_WSPROJECT_MYTASKS",		"Minhas Tarefas");
define("_MI_WSPROJECT_NEWPROJECT",	"Novo Projeto");

//Blocks
define("_MI_WSPROJECT_PROJECTSTATUS",	"Estado do Projeto");
define("_MI_WSPROJECT_PROJECTOVERVIEW",	"Resumo do Projeto");


//Notifications
define ('_MI_WSPROJECT_GLOBAL_NOTIFY', 'Global');
define ('_MI_WSPROJECT_GLOBAL_NOTIFYDSC', 'Op��es de Notifica��o Global.');

define ('_MI_WSPROJECT_PROJECT_NOTIFY', 'Projetos');
define ('_MI_WSPROJECT_PROJECT_NOTIFYDSC', 'Op��es de Notifica��o por Projeto.');

define ('_MI_WSPROJECT_TASK_NOTIFY', 'Tarefas');
define ('_MI_WSPROJECT_TASK_NOTIFYDSC', 'Op��o de Notifica��es por Tarefa.');

define ('_MI_WSPROJECT_NEWPROJECT_NOTIFY', 'Novo Projeto');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYCAP', 'Notifica��o em um novo Projeto');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYDSC', 'Notificar-me Novos Projetos.');
define ('_MI_WSPROJECT_NEWPROJECT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificar : Novo Projeto');

define ('_MI_WSPROJECT_NEWTASK_NOTIFY', 'Nova Tarefa');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYCAP', 'Notifica��o de uma nova tarefa.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYDSC', 'Notificar novas tarefas designadas para mim.');
define ('_MI_WSPROJECT_NEWTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificar : Nova Tarefa');

define ('_MI_WSPROJECT_EDITTASK_NOTIFY', 'Editar Tarefa');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYCAP', 'Notifica��o de modifica��es de tarefas.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYDSC', 'Noticar-me se a tarefa foi modificada.');
define ('_MI_WSPROJECT_EDITTASK_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Editar Tarefa');

?>
