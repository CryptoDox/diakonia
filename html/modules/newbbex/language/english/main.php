<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
//%%%%%%		Module Name phpBB  		%%%%%
//functions.php
define("_MDEX_ERROR","Error");
define("_MDEX_NOPOSTS","No Posts");
define("_MDEX_GO","Go");

//index.php
define("_MDEX_FORUM","Forum");
define("_MDEX_WELCOME","Welcome to %s Forum.");
define("_MDEX_TOPICS","Topics");
define("_MDEX_POSTS","Posts");
define("_MDEX_LASTPOST","Last Post");
define("_MDEX_MODERATOR","Moderator");
define("_MDEX_NEWPOSTS","New posts");
define("_MDEX_NONEWPOSTS","No new posts");
define("_MDEX_PRIVATEFORUM","Private forum");
define("_MDEX_BY","by"); // Posted by
define("_MDEX_TOSTART","To start viewing messages, select the forum that you want to visit from the selection below.");
define("_MDEX_TOTALTOPICSC","Total Topics: ");
define("_MDEX_TOTALPOSTSC","Total Posts: ");
define("_MDEX_TIMENOW","The time now is %s");
define("_MDEX_LASTVISIT","You last visited: %s");
define("_MDEX_ADVSEARCH","Advanced Search");
define("_MDEX_POSTEDON","Posted on: ");
define("_MDEX_SUBJECT","Subject");

//page_header.php
define("_MDEX_MODERATEDBY","Moderated by");
define("_MDEX_SEARCH","Search");
define("_MDEX_SEARCHRESULTS","Search Results");
define("_MDEX_FORUMINDEX","%s Forum Index");
define("_MDEX_POSTNEW","Post New Message");
define("_MDEX_REGTOPOST","Register To Post");

//search.php
define("_MDEX_KEYWORDS","Keywords:");
define("_MDEX_SEARCHANY","Search for ANY of the terms (Default)");
define("_MDEX_SEARCHALL","Search for ALL of the terms");
define("_MDEX_SEARCHALLFORUMS","Search All Forums");
define("_MDEX_FORUMC","Forum");
define("_MDEX_SORTBY","Sort by");
define("_MDEX_DATE","Date");
define("_MDEX_TOPIC","Topic");
define("_MDEX_USERNAME","Username");
define("_MDEX_SEARCHIN","Search in");
define("_MDEX_BODY","Body");
define("_MDEX_NOMATCH","No records match that query. Please broaden your search.");
define("_MDEX_POSTTIME","Post Time");

//viewforum.php
define("_MDEX_REPLIES","Replies");
define("_MDEX_POSTER","Poster");
define("_MDEX_VIEWS","Views");
define("_MDEX_MORETHAN","New posts [ Popular ]");
define("_MDEX_MORETHAN2","No New posts [ Popular ]");
define("_MDEX_TOPICSTICKY","Topic is Sticky");
define("_MDEX_TOPICLOCKED","Topic is Locked");
define("_MDEX_LEGEND","Legend");
define("_MDEX_NEXTPAGE","Next Page");
define("_MDEX_SORTEDBY","Sorted by");
define("_MDEX_TOPICTITLE","topic title");
define("_MDEX_NUMBERREPLIES","number of replies");
define("_MDEX_TOPICPOSTER","topic poster");
define("_MDEX_LASTPOSTTIME","last post time");
define("_MDEX_ASCENDING","Ascending order");
define("_MDEX_DESCENDING","Descending order");
define("_MDEX_FROMLASTDAYS","From last %s days");
define("_MDEX_THELASTYEAR","From the last year");
define("_MDEX_BEGINNING","From the beginning");

//viewtopic.php
define("_MDEX_AUTHOR","Author");
define("_MDEX_LOCKTOPIC","Lock this topic");
define("_MDEX_UNLOCKTOPIC","Unlock this topic");
define("_MDEX_STICKYTOPIC","Make this topic Sticky");
define("_MDEX_UNSTICKYTOPIC","Make this topic UnSticky");
define("_MDEX_MOVETOPIC","Move this topic");
define("_MDEX_DELETETOPIC","Delete this topic");
define("_MDEX_TOP","Top");
define("_MDEX_PARENT","Parent");
define("_MDEX_PREVTOPIC","Previous Topic");
define("_MDEX_NEXTTOPIC","Next Topic");

//forumform.inc
define("_MDEX_ABOUTPOST","About Posting");
define("_MDEX_ANONCANPOST","<b>Anonymous</b> users can post new topics and replies to this forum");
define("_MDEX_PRIVATE","This is a <b>Private</b> forum.<br />Only users with special access can post new topics and replies to this forum");define("_MD_REGCANPOST","All <b>Registered</b> users can post new topics and replies to this forum");
define("_MDEX_MODSCANPOST","Only <B>Moderators and Administrators</b> can post new topics and replies to this forum");
define("_MDEX_PREVPAGE","Previous Page");
define("_MDEX_QUOTE","Quote");

// ERROR messages
define("_MDEX_ERRORFORUM","ERROR: Forum not selected!");
define("_MDEX_ERRORPOST","ERROR: Post not selected!");
define("_MDEX_NORIGHTTOPOST","You don't have the right to post in this forum.");
define("_MDEX_NORIGHTTOACCESS","You don't have the right to access this forum.");
define("_MDEX_ERRORTOPIC","ERROR: Topic not selected!");
define("_MDEX_ERRORCONNECT","ERROR: Could not connect to the forums database.");
define("_MDEX_ERROREXIST","ERROR: The forum you selected does not exist. Please go back and try again.");
define("_MDEX_ERROROCCURED","An Error Occured");
define("_MDEX_COULDNOTQUERY","Could not query the forums database.");
define("_MDEX_FORUMNOEXIST","Error - The forum/topic you selected does not exist. Please go back and try again.");
define("_MDEX_USERNOEXIST","That user does not exist.  Please go back and search again.");
define("_MDEX_COULDNOTREMOVE","Error - Could not remove posts from the database!");
define("_MDEX_COULDNOTREMOVETXT","Error - Could not remove post texts!");

//reply.php
define("_MDEX_ON","on"); //Posted on
define("_MDEX_USERWROTE","%s wrote:"); // %s is username

//post.php
define("_MDEX_EDITNOTALLOWED","You're not allowed to edit this post!");
define("_MDEX_EDITEDBY","Edited by");
define("_MDEX_ANONNOTALLOWED","Anonymous user not allowed to post.<br>Please register.");
define("_MDEX_THANKSSUBMIT","Thanks for your submission!");
define("_MDEX_REPLYPOSTED","A reply to your topic has been posted.");
define("_MDEX_HELLO","Hello %s,");
define("_MDEX_URRECEIVING","You are receiving this email because a message you posted on %s forums has been replied to."); // %s is your site name
define("_MDEX_CLICKBELOW","Click on the link below to view the thread:");

//forumform.inc
define("_MDEX_YOURNAME","Your Name:");
define("_MDEX_LOGOUT","Logout");
define("_MDEX_REGISTER","Register");
define("_MDEX_SUBJECTC","Subject:");
define("_MDEX_MESSAGEICON","Message Icon:");
define("_MDEX_MESSAGEC","Message:");
define("_MDEX_ALLOWEDHTML","Allowed HTML:");
define("_MDEX_OPTIONS","Options:");
define("_MDEX_POSTANONLY","Post Anonymously");
define("_MDEX_DISABLESMILEY","Disable Smiley");
define("_MDEX_DISABLEHTML","Disable html");
define("_MDEX_NEWPOSTNOTIFY", "Notify me of new posts in this thread");
define("_MDEX_ATTACHSIG","Attach Signature");
define("_MDEX_POST","Post");
define("_MDEX_SUBMIT","Submit");
define("_MDEX_CANCELPOST","Cancel Post");

// forumuserpost.php
define("_MDEX_ADD","Add");
define("_MDEX_REPLY","Reply");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","You are not the moderator of this forum therefore you cannot perform this function.");
define("_MDEX_TTHBRFTD","The topic has been removed from the database.");
define("_MDEX_RETURNTOTHEFORUM","Return to the forum");
define("_MDEX_RTTFI","Return to the forum index");
define("_MDEX_EPGBATA","Error - Please go back and try again.");
define("_MDEX_TTHBM","The topic has been moved.");
define("_MDEX_VTUT","View the updated topic");
define("_MDEX_TTHBL","The topic has been locked.");
define("_MDEX_TTHBS","The topic has been Stickyed.");
define("_MDEX_TTHBUS","The topic has been unStickyed.");
define("_MDEX_VIEWTHETOPIC","View the topic");
define("_MDEX_TTHBU","The topic has been unlocked.");
define("_MDEX_OYPTDBATBOTFTTY","Once you press the delete button at the bottom of this form the topic you have selected, and all its related posts, will be <b>permanently</b> removed.");
define("_MDEX_OYPTMBATBOTFTTY","Once you press the move button at the bottom of this form the topic you have selected, and its related posts, will be moved to the forum you have selected.");
define("_MDEX_OYPTLBATBOTFTTY","Once you press the lock button at the bottom of this form the topic you have selected will be locked. You may unlock it at a later time if you like.");
define("_MDEX_OYPTUBATBOTFTTY","Once you press the unlock button at the bottom of this form the topic you have selected will be unlocked. You may lock it again at a later time if you like.");
define("_MDEX_OYPTSBATBOTFTTY","Once you press the Sticky button at the bottom of this form the topic you have selected will be Stickyed. You may unSticky it again at a later time if you like.");
define("_MDEX_OYPTTBATBOTFTTY","Once you press the unSticky button at the bottom of this form the topic you have selected will be unStickyed. You may Sticky it again at a later time if you like.");
define("_MDEX_MOVETOPICTO","Move Topic To:");
define("_MDEX_NOFORUMINDB","No Forums in DB");
define("_MDEX_DATABASEERROR","Database Error");
define("_MDEX_DELTOPIC","Delete Topic");

// delete.php
define("_MDEX_DELNOTALLOWED","Sorry, but you're not allowed to delete this post.");
define("_MDEX_AREUSUREDEL","Are you sure you want to delete this post and all its child posts?");
define("_MDEX_POSTSDELETED","Selected post and all its child posts deleted.");

// definitions moved from global.
define("_MDEX_THREAD","Thread");
define("_MDEX_FROM","From");
define("_MDEX_JOINED","Joined");
define("_MDEX_ONLINE","Online");
define("_MDEX_BOTTOM","Bottom");

// ajout Hervé
define("_MDEX_POSTWITHOUTANSWER","See the post without answer");

// Added version 1.5
define("_MDEX_ATTACH_FILE","Attach File");
define("_MDEX_ATTACHED_FILES","Attached File(s)");
define("_MDEX_UPLOAD_DBERROR_SAVE","Error while attaching file to the story");
define('_MDEX_UPLOAD_ERROR',"Error while uploading the file");
?>