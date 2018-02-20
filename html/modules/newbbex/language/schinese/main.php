<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
//%%%%%%		Module Name phpBB  		%%%%%
//functions.php
define("_MDEX_ERROR","错误");
define("_MDEX_NOPOSTS","没有帖子");
define("_MDEX_GO","开始");

//index.php
define("_MDEX_FORUM","论坛");
//欢迎词可以自己修改
define("_MDEX_WELCOME","欢迎来到%s论坛.");
define("_MDEX_TOPICS","主题");
define("_MDEX_POSTS","帖子");
define("_MDEX_LASTPOST","最后发表时间");
define("_MDEX_MODERATOR","版主");
define("_MDEX_NEWPOSTS","新贴");
define("_MDEX_NONEWPOSTS","旧贴");
define("_MDEX_PRIVATEFORUM","私有论坛");
define("_MDEX_BY","by"); // Posted by
//下面一行的内容可以根据自己的需要修改
define("_MDEX_TOSTART","   ");
define("_MDEX_TOTALTOPICSC","所有主题: ");
define("_MDEX_TOTALPOSTSC","所有帖子: ");
define("_MDEX_TIMENOW","现在时间： %s");
define("_MDEX_LASTVISIT","您上次访问时间: %s");
define("_MDEX_ADVSEARCH","高级搜索");
define("_MDEX_POSTEDON","发表于: ");
define("_MDEX_SUBJECT","主题");

//page_header.php
define("_MDEX_MODERATEDBY","版主");
define("_MDEX_SEARCH","搜索");
define("_MDEX_SEARCHRESULTS","搜索结果");
define("_MDEX_FORUMINDEX","%s论坛");
define("_MDEX_POSTNEW","发布新信息");
define("_MDEX_REGTOPOST","注册发表");

//search.php
define("_MDEX_KEYWORDS","关键字:");
define("_MDEX_SEARCHANY","搜索指定条目 (默认)");
define("_MDEX_SEARCHALL","搜索所有条目");
define("_MDEX_SEARCHALLFORUMS","搜索所有论坛");
define("_MDEX_FORUMC","论坛");
define("_MDEX_SORTBY","排序方式");
define("_MDEX_DATE","日期");
define("_MDEX_TOPIC","主题");
define("_MDEX_USERNAME","用户名");
define("_MDEX_SEARCHIN","搜索");
define("_MDEX_BODY","内容");
define("_MDEX_NOMATCH","没有记录相匹配查询，请扩大搜索。");
define("_MDEX_POSTTIME","发布时间");

//viewforum.php
define("_MDEX_REPLIES","回复");
define("_MDEX_POSTER","作者");
define("_MDEX_VIEWS","点击");
define("_MDEX_MORETHAN","新贴 [人气]");
define("_MDEX_MORETHAN2","旧贴 [人气]");
define("_MDEX_TOPICSTICKY","主题置顶");
define("_MDEX_TOPICLOCKED","主题锁定");
define("_MDEX_LEGEND","Legend");
define("_MDEX_NEXTPAGE","下一页");
define("_MDEX_SORTEDBY","排序方式");
define("_MDEX_TOPICTITLE","主题标题");
define("_MDEX_NUMBERREPLIES","回复数");
define("_MDEX_TOPICPOSTER","主题作者");
define("_MDEX_LASTPOSTTIME","最后发表时间");
define("_MDEX_ASCENDING","升序排列");
define("_MDEX_DESCENDING","降序排列");
define("_MDEX_FROMLASTDAYS","前%s天");
define("_MDEX_THELASTYEAR","去年");
define("_MDEX_BEGINNING","从论坛开始");

//viewtopic.php
define("_MDEX_AUTHOR","作者");
define("_MDEX_LOCKTOPIC","锁定这个主题");
define("_MDEX_UNLOCKTOPIC","解锁这个主题");
define("_MDEX_STICKYTOPIC","主题置顶");
define("_MDEX_UNSTICKYTOPIC","解除置顶");
define("_MDEX_MOVETOPIC","移动主题");
define("_MDEX_DELETETOPIC","删除主题");
define("_MDEX_TOP","顶");
define("_MDEX_PARENT","Parent");
define("_MDEX_PREVTOPIC","前一主题");
define("_MDEX_NEXTTOPIC","后一主题");

//forumform.inc
define("_MDEX_ABOUTPOST","关于发表");
define("_MDEX_ANONCANPOST","<b>匿名用户</b>可以发表新贴及回复");
define("_MDEX_PRIVATE","这是<b>私有论坛</b>.<br />有权限的用户才能发贴及回复");
define("_MD_REGCANPOST","所有<b>注册用户</b>可以发贴及回复");
define("_MDEX_MODSCANPOST","只有<B>板主和管理员</b>才能发贴和回复");
define("_MDEX_PREVPAGE","前一页");
define("_MDEX_QUOTE","引用");

// ERROR messages
define("_MDEX_ERRORFORUM","错误: 没有选择论坛!");
define("_MDEX_ERRORPOST","错误: 没有选择帖子!");
define("_MDEX_NORIGHTTOPOST","您没有权限在这里发贴.");
define("_MDEX_NORIGHTTOACCESS","您没有这个论坛的权限.");
define("_MDEX_ERRORTOPIC","错误: 主题没有选择!");
define("_MDEX_ERRORCONNECT","错误: 不能连接论坛数据库.");
define("_MDEX_ERROREXIST","错误: 您选择的论坛不存在. 请重新选择.");
define("_MDEX_ERROROCCURED","出错了");
define("_MDEX_COULDNOTQUERY","不能检索论坛数据.");
define("_MDEX_FORUMNOEXIST","错误 - 您选择论坛/主题不存在，请重试.");
define("_MDEX_USERNOEXIST","用户不存在.  请重新搜索.");
define("_MDEX_COULDNOTREMOVE","错误 - 不能删除帖子!");
define("_MDEX_COULDNOTREMOVETXT","错误 - 不能删除!");

//reply.php
define("_MDEX_ON","发表于"); //Posted on
define("_MDEX_USERWROTE","%s发表:"); // %s is username

//post.php
define("_MDEX_EDITNOTALLOWED","您不能编辑这个帖子!");
define("_MDEX_EDITEDBY","编辑");
define("_MDEX_ANONNOTALLOWED","匿名用户不能发表.<br>请注册后发表.");
define("_MDEX_THANKSSUBMIT","感谢您的发贴!");
define("_MDEX_REPLYPOSTED","您的主题有回复.");
define("_MDEX_HELLO","您好%s,");
define("_MDEX_URRECEIVING","您收到这封信是因为您在%s论坛发的帖子有回复."); // %s is your site name
define("_MDEX_CLICKBELOW","点击下面的链接，以查看详细内容:");

//forumform.inc
define("_MDEX_YOURNAME","名字:");
define("_MDEX_LOGOUT","登出");
define("_MDEX_REGISTER","注册");
define("_MDEX_SUBJECTC","主题:");
define("_MDEX_MESSAGEICON","表情:");
define("_MDEX_MESSAGEC","内容:");
define("_MDEX_ALLOWEDHTML","允许HTML:");
define("_MDEX_OPTIONS","选项:");
define("_MDEX_POSTANONLY","匿名发表");
define("_MDEX_DISABLESMILEY","禁止表情");
define("_MDEX_DISABLEHTML","禁止html");
define("_MDEX_NEWPOSTNOTIFY", "有新贴通知我");
define("_MDEX_ATTACHSIG","签名");
define("_MDEX_POST","发布");
define("_MDEX_SUBMIT","提交");
define("_MDEX_CANCELPOST","取消");

// forumuserpost.php
define("_MDEX_ADD","添加");
define("_MDEX_REPLY","回复");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","你不是这个论坛的版主，所以你不能履行这一职能.");
define("_MDEX_TTHBRFTD","这个主题已经从数据库中删除.");
define("_MDEX_RETURNTOTHEFORUM","返回论坛");
define("_MDEX_RTTFI","返回论坛首页");
define("_MDEX_EPGBATA","错误 - 请重试.");
define("_MDEX_TTHBM","主题已经移动.");
define("_MDEX_VTUT","查看主题更新");
define("_MDEX_TTHBL","主题被锁定.");
define("_MDEX_TTHBS","主题被置顶.");
define("_MDEX_TTHBUS","主题解除置顶.");
define("_MDEX_VIEWTHETOPIC","查看主题");
define("_MDEX_TTHBU","主题已经被锁定.");
define("_MDEX_OYPTDBATBOTFTTY","一旦你按下删除键，你选择的内容将永久删除.");
define("_MDEX_OYPTMBATBOTFTTY","一旦你按下移动键，你选择的内容将移动.");
define("_MDEX_OYPTLBATBOTFTTY","一旦你按下锁定键，你选择的内容将锁定.");
define("_MDEX_OYPTUBATBOTFTTY","一旦你按下解锁键，你选择的内容将解锁.");
define("_MDEX_OYPTSBATBOTFTTY","一旦你按下置顶键，你选择的内容将置顶.");
define("_MDEX_OYPTTBATBOTFTTY","一旦你按下解除置顶键，你选择的内容将解除置顶.");
define("_MDEX_MOVETOPICTO","主题转移至:");
define("_MDEX_NOFORUMINDB","数据库中没有论坛");
define("_MDEX_DATABASEERROR","数据库错误");
define("_MDEX_DELTOPIC","删除主题");

// delete.php
define("_MDEX_DELNOTALLOWED","您不能删除帖子.");
define("_MDEX_AREUSUREDEL","您确定要删除这个主题或回复吗?");
define("_MDEX_POSTSDELETED","选择的主题或回复已经删除.");

// definitions moved from global.
define("_MDEX_THREAD","内容");
define("_MDEX_FROM","来自");
define("_MDEX_JOINED","加入");
define("_MDEX_ONLINE","在线");
define("_MDEX_BOTTOM","底部");

// ajout Herv?
define("_MDEX_POSTWITHOUTANSWER","查看没有回复的帖子");

// Added version 1.5
define("_MDEX_ATTACH_FILE","附件");
define("_MDEX_ATTACHED_FILES","附件");
define("_MDEX_UPLOAD_DBERROR_SAVE","附件上传出现错误");
define('_MDEX_UPLOAD_ERROR',"上传文件发生错误");
?>
