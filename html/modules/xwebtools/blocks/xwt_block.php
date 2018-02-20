<?php

/********************************************************/
/* XOOPS Web Tools ver 1.1                              */
/* 30/4/2008                                            */
/* By: Mowaffak (www.arabxoops.com)                     */
/* based on PHP-Nuke Tools Ver 3.0 by Disipal           */
/* Author website: www.disipal.net                      */
/********************************************************/

function xwt_show() {

$block['content'] =  "<style type='text/css'>
                      td#xwtmenu a {display: block; margin: 0; padding: 4px;}
                      td#xwtmenu a.link {border-bottom: 1px solid #666666;}
                      </style>
                      <table cellspacing='0'><tr><td id='xwtmenu'>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLPHP'>HTML to PHP</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLASP'>HTML to ASP</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLJSP'>HTML to JSP</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLPERL'>HTML to Perl</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLJS'>HTML to Javascript</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLSWS'>HTML to SWS</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=Module'>XOOPS Module Creator</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=Block'>XOOPS Block Creator</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=Source'>Online HTML Editor</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=MTags'>Meta Tag Creator</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=Scroll'>Scrollbar Creator</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=Pop'>Popup Creator</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=Color'>Hex Colors</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=ColorMatch'>Color Match</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=PREVIEWER'>Previewer</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=SourceCoder'>Source Encoder</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=HTMLENCODER'>HTML Encoder</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=URLENCODER'>URL Encoder</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=EMAIL'>Email Encoder</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=ROT'>Rot-13 Encoder</a>
                      <a class='link' href='".XOOPS_URL."/modules/xwebtools/index.php?func=DeDupe'>Duplicate Remover</a>
                      </td></tr></table>";

return $block;

}

?>
