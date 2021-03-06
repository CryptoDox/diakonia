
D.J.(phppp) http://xoops.org.cn
===========================================================================================================

xlanguage, eXtensible Xoops Multilingual Content and Encoding Management 


Applicable
---------
Any version of XOOPS and any version of any MODULE with any THEME.
NEW in 3.02 for XOOPS 2.4.0: no hacks of api.php needed anymore 


Easy to use
-----------
1 All you need do is to insert ONLY ONE LINE into common.php and install "xlanguage"
2 Do NOT need to modify/hack any other XOOPS core files or any module


Powerful enough to meet your requirements
-----------------------------------------
1 Could handle as many languages of content as you want
2 Could handle different charset of a selected language
3 Could handle multilingual content anywhere on your site, in a module, a php file, an html page or a theme's hardcoded content
4 Compatible with content cache
5 Automatic detection of user browser's language preference


使用指南
----------
1 按正常模式和步驟安裝 "xlanguage"

2 在XOOPS/include/common.php中插入一行 (只有 XOOPS 2.4.0 之前版本需設定)
		include_once XOOPS_ROOT_PATH.'/modules/xlanguage/api.php';
	位置在下列內容之前 
	    // #################### Include site-wide lang file ##################
	    if ( file_exists(XOOPS_ROOT_PATH."/language/".$xoopsConfig['language']."/global.php") ) {
	        include_once XOOPS_ROOT_PATH."/language/".$xoopsConfig['language']."/global.php";
	    } else {
	        include_once XOOPS_ROOT_PATH."/language/english/global.php";
	    }
 
 3 修改 language/schinese/global.php (如果是正體中文，請對應修改language/tchinese/global.php)
	//%%%%%		LANGUAGE SPECIFIC SETTINGS   %%%%%
	//define('_CHARSET', 'GB2312');
	//define('_LANGCODE', 'zh-CN');
	define('_CHARSET', empty($xlanguage["charset"])?'GB2312':$xlanguage["charset"]);
	define('_LANGCODE', empty($xlanguage["code"])?'zh-CN':$xlanguage["code"]);
	$xlanguage['charset_base'] = "gb2312";
    
4 選定基本語系 (從可選清單中選擇)並增加延伸語系 (如果基本語系為正體中文，請將下列內容中的簡體/正體、schinese/tchinese、gb2312/big5、zh-CN/zh-TW對調)
	比如，如果要在以下幾種語系(或編碼)之間切換: 英語, 簡體中文(gb2312), 正體中文(big5) 和 UTF-8 中文
	則需要選定基本語系(需要確定你的XOOPS已經有english和schinese兩個語系包):
	1: 	名稱: english; 		描述(可選): 英語; 			編碼: iso-8859-1; 	語系代碼: en (或其他任何字母比如 "xen", 並不是真正的語系代碼, 只用來標記英文部分的內容)
	2: 	名稱: schinese; 	描述(可選): 簡體中文; 		編碼: gb2312; 		語系代碼: zh (或其他任何字母比如 "sc", 並不是真正的語系代碼, 只用來標記中文部分的內容)
	然後增加基於簡體中文的延伸語系(將會營運後內容會自動從簡體中文轉換):
	1: 	名稱: tchinese; 	描述(可選): 正體中文; 		編碼: big5; 		語系代碼: zh-TW (正體中文的真正的語系代碼)
	2: 	名稱: utf8; 		描述(可選): UTF8中文; 		編碼: utf-8 ; 		語系代碼: zh-CN (簡體中文的真正的語系代碼)

5 在區塊管理內將"語系選擇"區塊設定為可見

6 在你的模組內容中或是模板/佈景中增加多語系內容，使用步驟4中定義的語系代碼將相應內容包起來 [如果你不使用多語系內容切換，而是只用於正體簡體自動轉換，則跳過這一步]: 
	[langcode1]Content of the language1[/langcode1] [langcode2]Content of the language2[/langcode2] [langcode3]Content of the language3[/langcode3] ...
	如果某些內容為兩種以上語系共有, 你可以使用分隔符"|"來定義共享的內容:	
	[langcode1|langcode2]Content shared by language1&2[/langcode1|langcode2] [langcode3]Content of the language3[/langcode3] ...
	
	實際例子 (假定步驟4中設定的語系代碼分別是: 英語-en; 法語-fr; 簡體中文-sc):
	[en]My XOOPS[/en][fr]Moi XOOPS[/fr][sc]我的XOOPS[/sc]
	或:
	[english|french]This is my content in English and French[/english|french][schinese]中文內容[/schinese]

7 xlanguage將自動將內容在各延伸語系之間轉換 [實際上在這一步你不需要任何操作]

8 除去語系選擇模組之外，如果你想在佈景或是模板中增加語系切換的指令:
	1) 修改 /modules/xlanguage/api.php "$xlanguage_theme_enable = true;"
	2) 設定參數 "$options = array("images", " ", 5); // 顯示模式, 分隔符, 每一行數目";
	3) 將 "<{$smarty.const.XLANGUAGE_SWITCH_CODE}>" 插入到你的佈景或是模板中需要顯示的地方。

	
xlangauge description
-------------------------
An eXtensible Multi-language content and character encoding Management plugin
Multilanguage management handles displaying contents of different languages, like English, French and Chinese
Character encoding management handles contents of different encoding sets for one language, like GB2312 (Chinese Simplified) and BIG5 (Chinese Traditional) for Chinese. 


What xlanguage CAN do
---------------------
1 displaying content of specified language based on user's dynamic choice
2 converting content from one character encoding set to another


What xlanguage canNOT do
------------------------
1 xlanguage does NOT have the ability of translating content from one language to another one. You have to input contents of various languages by yourself
2 xlanguage does NOT work without adding one line to XOOPS/include/common.php (see guide below)
3 xlanguage does NOT have the ability of converting content from one character encoding to another if none of "iconv", "mb_string" or "xconv" is available. 


Features
--------
1 auto-detection of visitor's language on his first visitor
2 memorizing users' langauge preferences
3 switching contents of different languges/encoding sets on-fly
4 supporting M-S-M mode for character encoding handler

Note:
M-S-M: Multiple encoding input, Single encoding storage, Multiple encoding output.
M-S-M allows one site to fit various users with different language character encoding usages. For example, a site having xlanguage implemented porperly allows users to input content either with GB2312, with BIG5 or UTF-8 encoding and to store the content into DB with specified encoding, for say GB2312, and to display the content either with GB2312, with BIG5 or with UTF-8 encoding.


Changelog
---------
xlanguage 3.02 changelog:
1 adjusted for Xoops 2.4.0 using Preloads, no hacks of Core files required anymore in 2.4.0 and above (trabis)

xlanguage 3.0 changelog:
1 compatable for all Xoops active versions
2 added smarty template for block
3 added inline scripts for displaying language switch manner anywhere prefered

xlanguage 2.04 changelog:
capable for different language cache, reported by suico @ xoops.org

xlanguage 2.03 changelog:
"input" parse improvement, reported by irmtfan @ xoops.org

xlanguage 2.02 bugfix for XSS vulnerability
Thanks domifara @ dev.xoops.org

xlanguage 2.01 bugfix for nonexisting language



Credits
-------
1 Adi Chiributa - webmaster@artistic.ro, language handler
2 wjue - http://www.wjue.org, ziling BIG5-GB2312 conversion
3 GIJOE - http://www.peak.ne.jp, easiest multilanguage hack

Author
------
D.J. (phppp)
http://xoops.org.cn
http://xoopsforge.com