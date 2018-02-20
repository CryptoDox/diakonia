<?php
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MDEX_A_FORUMCONF","论坛设置");
define("_MDEX_A_ADDAFORUM","新增讨论区");
define("_MDEX_A_LINK2ADDFORUM","这个连接将带您前往向数据库新增讨论区的页面.");
define("_MDEX_A_EDITAFORUM","编辑讨论区");
define("_MDEX_A_LINK2EDITFORUM","这个连接允许您编辑已存在的讨论区.");
define("_MDEX_A_SETPRIVFORUM","设置私有论坛权限");
define("_MDEX_A_LINK2SETPRIV","这个连接允许您为私有论坛设置权限.");
define("_MDEX_A_SYNCFORUM","同步论坛/主题索引");
define("_MDEX_A_LINK2SYNC","这个连接将让您同步论坛和专题指标，以纠正任何差异可能产生");
define("_MDEX_A_ADDACAT","新增分类");
define("_MDEX_A_LINK2ADDCAT","这个连接让您创建一个用来放置论坛的分类.");
define("_MDEX_A_EDITCATTTL","编辑分类主题");
define("_MDEX_A_LINK2EDITCAT","这个连接允许你编辑分类主题.");
define("_MDEX_A_RMVACAT","删除分类");
define("_MDEX_A_LINK2RMVCAT","这个连接允许你从数据库中删除分类");
define("_MDEX_A_REORDERCAT","分类排序");
define("_MDEX_A_LINK2ORDERCAT","这个连接允许你将分类重新排序");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MDEX_A_FORUMUPDATED","论坛更新");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","不过选定的版主不会被删除，因为他们可能是其他论坛的版主.");
define("_MDEX_A_FORUMREMOVED","删除论坛.");
define("_MDEX_A_FRFDAWAIP","论坛及其所有的贴子会被一起删除.");
define("_MDEX_A_NOSUCHFORUM","没有这个论坛");
define("_MDEX_A_EDITTHISFORUM","编辑这个论坛");
define("_MDEX_A_DTFTWARAPITF","删除这个论坛 (也将删除论坛里的帖子)");
define("_MDEX_A_FORUMNAME","论坛名称:");
define("_MDEX_A_FORUMDESCRIPTION","论坛说明:");
define("_MDEX_A_MODERATOR","版主:");
define("_MDEX_A_REMOVE","删除");
define("_MDEX_A_NOMODERATORASSIGNED","没有指定版主");
define("_MDEX_A_NONE","无");
define("_MDEX_A_CATEGORY","分类:");
define("_MDEX_A_ANONYMOUSPOST","匿名发贴");
define("_MDEX_A_REGISTERUSERONLY","注册用户");
define("_MDEX_A_MODERATORANDADMINONLY","版主和管理员");
define("_MDEX_A_TYPE","类型:");
define("_MDEX_A_PUBLIC","公开");
define("_MDEX_A_PRIVATE","私有");
define("_MDEX_A_SELECTFORUMEDIT","选择论坛编辑");
define("_MDEX_A_NOFORUMINDATABASE","数据库中没有论坛");
define("_MDEX_A_DATABASEERROR","数据库错误");
define("_MDEX_A_EDIT","编辑");
define("_MDEX_A_CATEGORYUPDATED","分类更新.");
define("_MDEX_A_EDITCATEGORY","编辑分类:");
define("_MDEX_A_CATEGORYTITLE","分类主题:");
define("_MDEX_A_SELECTACATEGORYEDIT","选择分类编辑");
define("_MDEX_A_CATEGORYCREATED","分类已创建.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","注: 这样做不会删除分类下的论坛，您必须在论坛编辑部分做相关的操作.");
define("_MDEX_A_REMOVECATEGORY","删除分类");
define("_MDEX_A_CREATENEWCATEGORY","新增分类");
define("_MDEX_A_YDNFOATPOTFDYAA","您没有按要求填写。 <br>你必须指派一名版主？请你返回填写.");
define("_MDEX_A_FORUMCREATED","论坛创建.");
define("_MDEX_A_VTFYJC","查看您创建的论坛.");
define("_MDEX_A_EYMAACBYAF","错误, 您必须先建立分类，后建立论坛");
define("_MDEX_A_CREATENEWFORUM","新增论坛");
define("_MDEX_A_ACCESSLEVEL","权限:");
define("_MDEX_A_CATEGORYMOVEUP","分类上移");
define("_MDEX_A_TCIATHU","这已经是最顶端了.");
define("_MDEX_A_CATEGORYMOVEDOWN","分类下移");
define("_MDEX_A_TCIATLD","这已经是最后了.");
define("_MDEX_A_SETCATEGORYORDER","设置分类顺序");
define("_MDEX_A_TODHITOTCWDOTIP","分类显示排序，根据您的需要选择上移或下移.");
define("_MDEX_A_ECWMTCPUODITO","点击一次可以改变一个位置.");
define("_MDEX_A_CATEGORY1","分类");
define("_MDEX_A_MOVEUP","上移");
define("_MDEX_A_MOVEDOWN","下移");


define("_MDEX_A_FORUMUPDATE","论坛设置更新");
define("_MDEX_A_RETURNTOADMINPANEL","返回控制面板.");
define("_MDEX_A_RETURNTOFORUMINDEX","返回论坛主页");
define("_MDEX_A_ALLOWHTML","使用 HTML:");
define("_MDEX_A_YES","是");
define("_MDEX_A_NO","否");
define("_MDEX_A_ALLOWSIGNATURES","允许代码:");
define("_MDEX_A_HOTTOPICTHRESHOLD","热门话题:");
define("_MDEX_A_POSTPERPAGE","每页贴子数:");
define("_MDEX_A_TITNOPPTTWBDPPOT","(主题显示的帖子数)");
define("_MDEX_A_TOPICPERFORUM","每个论坛显示的主题数:");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(每个论坛显示的主题数)");
define("_MDEX_A_SAVECHANGES","保存更改");
define("_MDEX_A_CLEAR","删除");
define("_MDEX_A_CLICKBELOWSYNC","点击以下按钮，将同步您的论坛和专题页面的数据，从数据库中。");
define("_MDEX_A_SYNCHING","同步论坛指数和主题（这可能需要一段时间)");
define("_MDEX_A_DONESYNC","完成!");
define("_MDEX_A_CATEGORYDELETED","分类删除.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MDEX_A_SAFTE","选择论坛编辑");
define("_MDEX_A_NFID","数据库中没有论坛");
define("_MDEX_A_EFPF","编辑论坛权限: <b>%s</b>");
define("_MDEX_A_UWA","用户有权:");
define("_MDEX_A_UWOA","用户无权:");
define("_MDEX_A_ADDUSERS","添加用户 -->");
define("_MDEX_A_CLEARALLUSERS","清除所有用户");
define("_MDEX_A_REVOKEPOSTING","撤消");
define("_MDEX_A_GRANTPOSTING","给予");

// Ajouts Herv?
define("_MDEX_A_SHOWNAME","用真名显示");
define("_MDEX_A_SHOWICONSPANEL","显示图标");
define("_MDEX_A_SHOWSMILIESPANEL","显示表情");
define("_MDEX_A_EDITPERMS","权限");
define("_MDEX_A_CURRENT","当前");
define("_MDEX_A_ADD","添加");
define("_MDEX_A_SHOWMSGPAGINATION","查看讯息分页区块");
define("_MDEX_A_CANPOST","可以发贴");
define("_MDEX_A_CANTPOST","不能发贴");
//1.5 add
define("_MDEX_A_ALLOW_UPLOAD", "允许上传文件");
?>
