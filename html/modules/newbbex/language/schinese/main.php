<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
//%%%%%%		Module Name phpBB  		%%%%%
//functions.php
define("_MDEX_ERROR","����");
define("_MDEX_NOPOSTS","û������");
define("_MDEX_GO","��ʼ");

//index.php
define("_MDEX_FORUM","��̳");
//��ӭ�ʿ����Լ��޸�
define("_MDEX_WELCOME","��ӭ����%s��̳.");
define("_MDEX_TOPICS","����");
define("_MDEX_POSTS","����");
define("_MDEX_LASTPOST","��󷢱�ʱ��");
define("_MDEX_MODERATOR","����");
define("_MDEX_NEWPOSTS","����");
define("_MDEX_NONEWPOSTS","����");
define("_MDEX_PRIVATEFORUM","˽����̳");
define("_MDEX_BY","by"); // Posted by
//����һ�е����ݿ��Ը����Լ�����Ҫ�޸�
define("_MDEX_TOSTART","   ");
define("_MDEX_TOTALTOPICSC","��������: ");
define("_MDEX_TOTALPOSTSC","��������: ");
define("_MDEX_TIMENOW","����ʱ�䣺 %s");
define("_MDEX_LASTVISIT","���ϴη���ʱ��: %s");
define("_MDEX_ADVSEARCH","�߼�����");
define("_MDEX_POSTEDON","������: ");
define("_MDEX_SUBJECT","����");

//page_header.php
define("_MDEX_MODERATEDBY","����");
define("_MDEX_SEARCH","����");
define("_MDEX_SEARCHRESULTS","�������");
define("_MDEX_FORUMINDEX","%s��̳");
define("_MDEX_POSTNEW","��������Ϣ");
define("_MDEX_REGTOPOST","ע�ᷢ��");

//search.php
define("_MDEX_KEYWORDS","�ؼ���:");
define("_MDEX_SEARCHANY","����ָ����Ŀ (Ĭ��)");
define("_MDEX_SEARCHALL","����������Ŀ");
define("_MDEX_SEARCHALLFORUMS","����������̳");
define("_MDEX_FORUMC","��̳");
define("_MDEX_SORTBY","����ʽ");
define("_MDEX_DATE","����");
define("_MDEX_TOPIC","����");
define("_MDEX_USERNAME","�û���");
define("_MDEX_SEARCHIN","����");
define("_MDEX_BODY","����");
define("_MDEX_NOMATCH","û�м�¼��ƥ���ѯ��������������");
define("_MDEX_POSTTIME","����ʱ��");

//viewforum.php
define("_MDEX_REPLIES","�ظ�");
define("_MDEX_POSTER","����");
define("_MDEX_VIEWS","���");
define("_MDEX_MORETHAN","���� [����]");
define("_MDEX_MORETHAN2","���� [����]");
define("_MDEX_TOPICSTICKY","�����ö�");
define("_MDEX_TOPICLOCKED","��������");
define("_MDEX_LEGEND","Legend");
define("_MDEX_NEXTPAGE","��һҳ");
define("_MDEX_SORTEDBY","����ʽ");
define("_MDEX_TOPICTITLE","�������");
define("_MDEX_NUMBERREPLIES","�ظ���");
define("_MDEX_TOPICPOSTER","��������");
define("_MDEX_LASTPOSTTIME","��󷢱�ʱ��");
define("_MDEX_ASCENDING","��������");
define("_MDEX_DESCENDING","��������");
define("_MDEX_FROMLASTDAYS","ǰ%s��");
define("_MDEX_THELASTYEAR","ȥ��");
define("_MDEX_BEGINNING","����̳��ʼ");

//viewtopic.php
define("_MDEX_AUTHOR","����");
define("_MDEX_LOCKTOPIC","�����������");
define("_MDEX_UNLOCKTOPIC","�����������");
define("_MDEX_STICKYTOPIC","�����ö�");
define("_MDEX_UNSTICKYTOPIC","����ö�");
define("_MDEX_MOVETOPIC","�ƶ�����");
define("_MDEX_DELETETOPIC","ɾ������");
define("_MDEX_TOP","��");
define("_MDEX_PARENT","Parent");
define("_MDEX_PREVTOPIC","ǰһ����");
define("_MDEX_NEXTTOPIC","��һ����");

//forumform.inc
define("_MDEX_ABOUTPOST","���ڷ���");
define("_MDEX_ANONCANPOST","<b>�����û�</b>���Է����������ظ�");
define("_MDEX_PRIVATE","����<b>˽����̳</b>.<br />��Ȩ�޵��û����ܷ������ظ�");
define("_MD_REGCANPOST","����<b>ע���û�</b>���Է������ظ�");
define("_MDEX_MODSCANPOST","ֻ��<B>�����͹���Ա</b>���ܷ����ͻظ�");
define("_MDEX_PREVPAGE","ǰһҳ");
define("_MDEX_QUOTE","����");

// ERROR messages
define("_MDEX_ERRORFORUM","����: û��ѡ����̳!");
define("_MDEX_ERRORPOST","����: û��ѡ������!");
define("_MDEX_NORIGHTTOPOST","��û��Ȩ�������﷢��.");
define("_MDEX_NORIGHTTOACCESS","��û�������̳��Ȩ��.");
define("_MDEX_ERRORTOPIC","����: ����û��ѡ��!");
define("_MDEX_ERRORCONNECT","����: ����������̳���ݿ�.");
define("_MDEX_ERROREXIST","����: ��ѡ�����̳������. ������ѡ��.");
define("_MDEX_ERROROCCURED","������");
define("_MDEX_COULDNOTQUERY","���ܼ�����̳����.");
define("_MDEX_FORUMNOEXIST","���� - ��ѡ����̳/���ⲻ���ڣ�������.");
define("_MDEX_USERNOEXIST","�û�������.  ����������.");
define("_MDEX_COULDNOTREMOVE","���� - ����ɾ������!");
define("_MDEX_COULDNOTREMOVETXT","���� - ����ɾ��!");

//reply.php
define("_MDEX_ON","������"); //Posted on
define("_MDEX_USERWROTE","%s����:"); // %s is username

//post.php
define("_MDEX_EDITNOTALLOWED","�����ܱ༭�������!");
define("_MDEX_EDITEDBY","�༭");
define("_MDEX_ANONNOTALLOWED","�����û����ܷ���.<br>��ע��󷢱�.");
define("_MDEX_THANKSSUBMIT","��л���ķ���!");
define("_MDEX_REPLYPOSTED","���������лظ�.");
define("_MDEX_HELLO","����%s,");
define("_MDEX_URRECEIVING","���յ����������Ϊ����%s��̳���������лظ�."); // %s is your site name
define("_MDEX_CLICKBELOW","�����������ӣ��Բ鿴��ϸ����:");

//forumform.inc
define("_MDEX_YOURNAME","����:");
define("_MDEX_LOGOUT","�ǳ�");
define("_MDEX_REGISTER","ע��");
define("_MDEX_SUBJECTC","����:");
define("_MDEX_MESSAGEICON","����:");
define("_MDEX_MESSAGEC","����:");
define("_MDEX_ALLOWEDHTML","����HTML:");
define("_MDEX_OPTIONS","ѡ��:");
define("_MDEX_POSTANONLY","��������");
define("_MDEX_DISABLESMILEY","��ֹ����");
define("_MDEX_DISABLEHTML","��ֹhtml");
define("_MDEX_NEWPOSTNOTIFY", "������֪ͨ��");
define("_MDEX_ATTACHSIG","ǩ��");
define("_MDEX_POST","����");
define("_MDEX_SUBMIT","�ύ");
define("_MDEX_CANCELPOST","ȡ��");

// forumuserpost.php
define("_MDEX_ADD","���");
define("_MDEX_REPLY","�ظ�");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","�㲻�������̳�İ����������㲻��������һְ��.");
define("_MDEX_TTHBRFTD","��������Ѿ������ݿ���ɾ��.");
define("_MDEX_RETURNTOTHEFORUM","������̳");
define("_MDEX_RTTFI","������̳��ҳ");
define("_MDEX_EPGBATA","���� - ������.");
define("_MDEX_TTHBM","�����Ѿ��ƶ�.");
define("_MDEX_VTUT","�鿴�������");
define("_MDEX_TTHBL","���ⱻ����.");
define("_MDEX_TTHBS","���ⱻ�ö�.");
define("_MDEX_TTHBUS","�������ö�.");
define("_MDEX_VIEWTHETOPIC","�鿴����");
define("_MDEX_TTHBU","�����Ѿ�������.");
define("_MDEX_OYPTDBATBOTFTTY","һ���㰴��ɾ��������ѡ������ݽ�����ɾ��.");
define("_MDEX_OYPTMBATBOTFTTY","һ���㰴���ƶ�������ѡ������ݽ��ƶ�.");
define("_MDEX_OYPTLBATBOTFTTY","һ���㰴������������ѡ������ݽ�����.");
define("_MDEX_OYPTUBATBOTFTTY","һ���㰴�½���������ѡ������ݽ�����.");
define("_MDEX_OYPTSBATBOTFTTY","һ���㰴���ö�������ѡ������ݽ��ö�.");
define("_MDEX_OYPTTBATBOTFTTY","һ���㰴�½���ö�������ѡ������ݽ�����ö�.");
define("_MDEX_MOVETOPICTO","����ת����:");
define("_MDEX_NOFORUMINDB","���ݿ���û����̳");
define("_MDEX_DATABASEERROR","���ݿ����");
define("_MDEX_DELTOPIC","ɾ������");

// delete.php
define("_MDEX_DELNOTALLOWED","������ɾ������.");
define("_MDEX_AREUSUREDEL","��ȷ��Ҫɾ����������ظ���?");
define("_MDEX_POSTSDELETED","ѡ��������ظ��Ѿ�ɾ��.");

// definitions moved from global.
define("_MDEX_THREAD","����");
define("_MDEX_FROM","����");
define("_MDEX_JOINED","����");
define("_MDEX_ONLINE","����");
define("_MDEX_BOTTOM","�ײ�");

// ajout Herv?
define("_MDEX_POSTWITHOUTANSWER","�鿴û�лظ�������");

// Added version 1.5
define("_MDEX_ATTACH_FILE","����");
define("_MDEX_ATTACHED_FILES","����");
define("_MDEX_UPLOAD_DBERROR_SAVE","�����ϴ����ִ���");
define('_MDEX_UPLOAD_ERROR',"�ϴ��ļ���������");
?>
