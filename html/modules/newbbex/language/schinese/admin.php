<?php
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MDEX_A_FORUMCONF","��̳����");
define("_MDEX_A_ADDAFORUM","����������");
define("_MDEX_A_LINK2ADDFORUM","������ӽ�����ǰ�������ݿ�������������ҳ��.");
define("_MDEX_A_EDITAFORUM","�༭������");
define("_MDEX_A_LINK2EDITFORUM","��������������༭�Ѵ��ڵ�������.");
define("_MDEX_A_SETPRIVFORUM","����˽����̳Ȩ��");
define("_MDEX_A_LINK2SETPRIV","�������������Ϊ˽����̳����Ȩ��.");
define("_MDEX_A_SYNCFORUM","ͬ����̳/��������");
define("_MDEX_A_LINK2SYNC","������ӽ�����ͬ����̳��ר��ָ�꣬�Ծ����κβ�����ܲ���");
define("_MDEX_A_ADDACAT","��������");
define("_MDEX_A_LINK2ADDCAT","���������������һ������������̳�ķ���.");
define("_MDEX_A_EDITCATTTL","�༭��������");
define("_MDEX_A_LINK2EDITCAT","�������������༭��������.");
define("_MDEX_A_RMVACAT","ɾ������");
define("_MDEX_A_LINK2RMVCAT","�����������������ݿ���ɾ������");
define("_MDEX_A_REORDERCAT","��������");
define("_MDEX_A_LINK2ORDERCAT","������������㽫������������");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MDEX_A_FORUMUPDATED","��̳����");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","����ѡ���İ������ᱻɾ������Ϊ���ǿ�����������̳�İ���.");
define("_MDEX_A_FORUMREMOVED","ɾ����̳.");
define("_MDEX_A_FRFDAWAIP","��̳�������е����ӻᱻһ��ɾ��.");
define("_MDEX_A_NOSUCHFORUM","û�������̳");
define("_MDEX_A_EDITTHISFORUM","�༭�����̳");
define("_MDEX_A_DTFTWARAPITF","ɾ�������̳ (Ҳ��ɾ����̳�������)");
define("_MDEX_A_FORUMNAME","��̳����:");
define("_MDEX_A_FORUMDESCRIPTION","��̳˵��:");
define("_MDEX_A_MODERATOR","����:");
define("_MDEX_A_REMOVE","ɾ��");
define("_MDEX_A_NOMODERATORASSIGNED","û��ָ������");
define("_MDEX_A_NONE","��");
define("_MDEX_A_CATEGORY","����:");
define("_MDEX_A_ANONYMOUSPOST","��������");
define("_MDEX_A_REGISTERUSERONLY","ע���û�");
define("_MDEX_A_MODERATORANDADMINONLY","�����͹���Ա");
define("_MDEX_A_TYPE","����:");
define("_MDEX_A_PUBLIC","����");
define("_MDEX_A_PRIVATE","˽��");
define("_MDEX_A_SELECTFORUMEDIT","ѡ����̳�༭");
define("_MDEX_A_NOFORUMINDATABASE","���ݿ���û����̳");
define("_MDEX_A_DATABASEERROR","���ݿ����");
define("_MDEX_A_EDIT","�༭");
define("_MDEX_A_CATEGORYUPDATED","�������.");
define("_MDEX_A_EDITCATEGORY","�༭����:");
define("_MDEX_A_CATEGORYTITLE","��������:");
define("_MDEX_A_SELECTACATEGORYEDIT","ѡ�����༭");
define("_MDEX_A_CATEGORYCREATED","�����Ѵ���.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","ע: ����������ɾ�������µ���̳������������̳�༭��������صĲ���.");
define("_MDEX_A_REMOVECATEGORY","ɾ������");
define("_MDEX_A_CREATENEWCATEGORY","��������");
define("_MDEX_A_YDNFOATPOTFDYAA","��û�а�Ҫ����д�� <br>�����ָ��һ�����������㷵����д.");
define("_MDEX_A_FORUMCREATED","��̳����.");
define("_MDEX_A_VTFYJC","�鿴����������̳.");
define("_MDEX_A_EYMAACBYAF","����, �������Ƚ������࣬������̳");
define("_MDEX_A_CREATENEWFORUM","������̳");
define("_MDEX_A_ACCESSLEVEL","Ȩ��:");
define("_MDEX_A_CATEGORYMOVEUP","��������");
define("_MDEX_A_TCIATHU","���Ѿ��������.");
define("_MDEX_A_CATEGORYMOVEDOWN","��������");
define("_MDEX_A_TCIATLD","���Ѿ��������.");
define("_MDEX_A_SETCATEGORYORDER","���÷���˳��");
define("_MDEX_A_TODHITOTCWDOTIP","������ʾ���򣬸���������Ҫѡ�����ƻ�����.");
define("_MDEX_A_ECWMTCPUODITO","���һ�ο��Ըı�һ��λ��.");
define("_MDEX_A_CATEGORY1","����");
define("_MDEX_A_MOVEUP","����");
define("_MDEX_A_MOVEDOWN","����");


define("_MDEX_A_FORUMUPDATE","��̳���ø���");
define("_MDEX_A_RETURNTOADMINPANEL","���ؿ������.");
define("_MDEX_A_RETURNTOFORUMINDEX","������̳��ҳ");
define("_MDEX_A_ALLOWHTML","ʹ�� HTML:");
define("_MDEX_A_YES","��");
define("_MDEX_A_NO","��");
define("_MDEX_A_ALLOWSIGNATURES","�������:");
define("_MDEX_A_HOTTOPICTHRESHOLD","���Ż���:");
define("_MDEX_A_POSTPERPAGE","ÿҳ������:");
define("_MDEX_A_TITNOPPTTWBDPPOT","(������ʾ��������)");
define("_MDEX_A_TOPICPERFORUM","ÿ����̳��ʾ��������:");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(ÿ����̳��ʾ��������)");
define("_MDEX_A_SAVECHANGES","�������");
define("_MDEX_A_CLEAR","ɾ��");
define("_MDEX_A_CLICKBELOWSYNC","������°�ť����ͬ��������̳��ר��ҳ������ݣ������ݿ��С�");
define("_MDEX_A_SYNCHING","ͬ����ָ̳�������⣨�������Ҫһ��ʱ��)");
define("_MDEX_A_DONESYNC","���!");
define("_MDEX_A_CATEGORYDELETED","����ɾ��.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MDEX_A_SAFTE","ѡ����̳�༭");
define("_MDEX_A_NFID","���ݿ���û����̳");
define("_MDEX_A_EFPF","�༭��̳Ȩ��: <b>%s</b>");
define("_MDEX_A_UWA","�û���Ȩ:");
define("_MDEX_A_UWOA","�û���Ȩ:");
define("_MDEX_A_ADDUSERS","����û� -->");
define("_MDEX_A_CLEARALLUSERS","��������û�");
define("_MDEX_A_REVOKEPOSTING","����");
define("_MDEX_A_GRANTPOSTING","����");

// Ajouts Herv?
define("_MDEX_A_SHOWNAME","��������ʾ");
define("_MDEX_A_SHOWICONSPANEL","��ʾͼ��");
define("_MDEX_A_SHOWSMILIESPANEL","��ʾ����");
define("_MDEX_A_EDITPERMS","Ȩ��");
define("_MDEX_A_CURRENT","��ǰ");
define("_MDEX_A_ADD","���");
define("_MDEX_A_SHOWMSGPAGINATION","�鿴ѶϢ��ҳ����");
define("_MDEX_A_CANPOST","���Է���");
define("_MDEX_A_CANTPOST","���ܷ���");
//1.5 add
define("_MDEX_A_ALLOW_UPLOAD", "�����ϴ��ļ�");
?>
