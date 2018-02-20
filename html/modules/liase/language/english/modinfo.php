<?php
// $Id: modinfo.php,v 1.5 2005/02/14 12:52:52 tuff Exp $

// The name of this module
define("_MI_LIAISE_NAME","Liaise");

// A brief description of this module
define("_MI_LIAISE_DESC","Contact forms generator");

// admin/menu.php
define("_MI_LIAISE_ADMENU1","Contact form listing");
define("_MI_LIAISE_ADMENU2","Create a new form");

//	preferences
define("_MI_LIAISE_TEXT_WIDTH","Default width of text boxes");
define("_MI_LIAISE_TEXT_MAX","Default maximum length of text boxes");
define("_MI_LIAISE_TAREA_ROWS","Default rows of text areas");
define("_MI_LIAISE_TAREA_COLS","Default columns of text areas");

######### version 1.1  additions #########
//	preferences
define("_MI_LIAISE_MAIL_CHARSET","Text encoding for sending emails");

//	template descriptions
define("_MI_LIAISE_TMPL_MAIN_DESC","Main page of Liaise");
define("_MI_LIAISE_TMPL_ERROR_DESC","Page to show when error occurs");

######### version 1.2 additions #########
//	template descriptions
define("_MI_LIAISE_TMPL_FORM_DESC","Template for forms");

//	preferences
define("_MI_LIAISE_MOREINFO","Send additional information along with the submitted data");
define("_MI_LIAISE_MOREINFO_USER","User name and url to user info page");
define("_MI_LIAISE_MOREINFO_IP","Submitter's IP address");
define("_MI_LIAISE_MOREINFO_AGENT","Submitter's user agent (browser info)");
define("_MI_LIAISE_MOREINFO_FORM","URL of the submitted form");
define("_MI_LIAISE_MAIL_CHARSET_DESC","Leave blank for "._CHARSET);
define("_MI_LIAISE_PREFIX","Text prefix for required fields");
define("_MI_LIAISE_SUFFIX","Text suffix for required fields");
define("_MI_LIAISE_INTRO","Introduction text in main page");
define("_MI_LIAISE_GLOBAL","Text to be displayed in every form page");

// admin/menu.php
define("_MI_LIAISE_ADMENU3","Create form elements");

######### version 1.21 additions #########
// preferences default values
define("_MI_LIAISE_INTRO_DEFAULT","Feel free to contact us via the following means:");
define("_MI_LIAISE_GLOBAL_DEFAULT","[b]* Required[/b]");

######### version 1.23 additions #########
define("_MI_LIAISE_UPLOADDIR","Physical path for storing uploaded files WITHOUT trailing slash");
define("_MI_LIAISE_UPLOADDIR_DESC","All upload files will be stored here when a form is sent via private message");

?>