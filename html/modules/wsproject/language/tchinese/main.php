<?php
// $Id: main.php 75 2005-09-06 21:52:55Z gron $
//      t.chinese by xoobs
//include shared constants
include_once(XOOPS_ROOT_PATH."/modules/wsproject/language/tchinese/shared.php");


define("_WS_USERDETAILS","");

define("_WS_NOTE",			"通知");

define("_WS_COMPLETEPROJECT","專案完成");

define("_WS_SUBTASKS", "內含分項任務");

define("_WS_REACTIVATE",	"重新啟動");
define("_WS_COMPLETED2",	"完成日期");
define("_WS_RESTORE",		"放棄更新");
define("_WS_UPDATETASK",	"更新任務");
define("_WS_UPDATEPROJECT",	"更新專案");
define("_WS_DELPROJECT1",	"您確認要刪除 ＜");
define("_WS_DELPROJECT2",	"＞ 這個專案嗎");
define("_WS_DELWARNING",	"選擇是，這個專案裡的所有任務與其相關之訊息將會同時被刪除喔！");

define("_WS_TOPLEVEL", "（頂層主要任務）");
define("_WS_SUBTASKOF", "此分項任務屬於");
define("_WS_PUBLIC", "公開");
define("_WS_QUOTEDHOURS", "預定時數");
define("_WS_NOTIFYUSER", "通知用戶");
define("_WS_ASSIGNEDTO", "任務分配給");
define("_WS_TASKNAME", "任務名稱");
define("_WS_SHOWPROJECT", "專案與任務相關內容");
define("_WS_ADDPROJECT", "新增專案");
define("_WS_COMMENTS", "專案內容描述");
define("_WS_STARTDATE", "專案起始日期");
define("_WS_PROJECTNAME",	"專案名稱");

define("_WS_PROJECTOVERVIEW", "專案概觀");

define("_WS_WARNING", "警告");
define("_WS_CHILDWARNING", "這個任務內含分項任務. 刪除動作會連同所含分項任務一併刪除!");
define("_WS_DELTASK",	"您確認要刪除這個任務嗎？");

define("_WS_PLEASEADDGROUP","請選擇一個使用者群組以便進行專案編修");

//admin
define("_WS_PROJECTADMIN",	"專案管理群組設定");
define("_WS_CONFIG",		"選擇專案管理群組");
define("_WS_USEDGROUPS",	"選擇的群組");
define("_WS_APPLY",			"確認選擇");

define("_WS_PROJECTUSER",	"標準使用者");
define("_WS_PROJECTUSERNOTE","任務可以指派給所選擇之群組，這個群組的使用者將被授權可以變更這項任務的進行狀態。");
define("_WS_PROJECTADMIN2",	"專案管理員");
define("_WS_PROJECTADMINNOTE","授權所選擇之群組，可以管理更新此專案內之所有任務與步驟。");
define("_WS_ADMINGROUPS",	"專案管理群組：<br />經選擇之群組將被授權<br /> 可以編修管理所有的專案與任務。");
?>