/**
 * ****************************************************************************
 *  - TDMTchat By TDM   - TEAM DEV MODULE FOR XOOPS
 *  - Licence PRO Copyright (c)  (http://www.tdmxoops.net)
 *
 * 	Cette licence, contient des limitations
 *
 * 1. Vous devez posséder une permission d'exécuter le logiciel, pour n'importe quel usage.
 * 2. Vous ne devez pas l' étudier ni l'adapter à vos besoins,
 * 3. Vous ne devez le redistribuer ni en faire des copies,
 * 4. Vous n'avez pas la liberté de l'améliorer ni de rendre publiques les modifications
 *
 * @license     TDMFR PRO license
 * @author		TDMFR ; TEAM DEV MODULE ; Venom 
 *
 * ****************************************************************************
 */



function display_dialog(id, bgiframe, modal, hide, show, height, width) {
   	var $tdmtchat = jQuery.noConflict(); 
	
	$tdmtchat(document).ready(function(){
        if (!$tdmtchat("#dialog"+id).dialog( 'isOpen' )) {
            $tdmtchat("#dialog"+id).dialog({
    			bgiframe: bgiframe,
    			modal: modal,
    			hide: hide,
    			show: show,
    			height: height,
    			width: width,
                autoOpen: false	
    		});
    		$tdmtchat("#dialog"+id).dialog("open");
		}
    });
}

function masque(id) {

   	var $tdmtchat = jQuery.noConflict();
	
	$tdmtchat(document).ready(function(){

	 if ($tdmtchat("#masque_" +id+ ":visible").length != 0) {
		$tdmtchat("#masque_" +id).fadeOut("fast", function() {
            $tdmtchat("#masque_" +id).fadeIn("fast").hide();
        });
   
    } else {	    
	$tdmtchat("#masque_" +id).fadeOut("fast", function() {
         $tdmtchat("#masque_" +id).fadeIn("fast").show();
     });
}

	
});

}
/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/
var $tdmtchat = jQuery.noConflict(); 
	
var windowFocus = true;
var username;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 1000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();

$tdmtchat(document).ready(function(){
	originalTitle = document.title;
	startChatSession();

	$tdmtchat([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
});

function restructureChatBoxes() {
	align = 0;
	for (x in chatBoxes) {
		chatboxtitle = chatBoxes[x];

		if ($tdmtchat("#chatbox_"+chatboxtitle).css('display') != 'none') {
			if (align == 0) {
				$tdmtchat("#chatbox_"+chatboxtitle).css('right', '20px');
			} else {
				width = (align)*(225+7)+20;
				$tdmtchat("#chatbox_"+chatboxtitle).css('right', width+'px');
			}
			align++;
		}
	}
}

function chatWith(chatuser) {
	createChatBox(chatuser);
	$tdmtchat("#chatbox_"+chatuser+" .chatboxtextarea").focus();
}

function createChatBox(chatboxtitle, minimizeChatBox) {


	if ($tdmtchat("#chatbox_"+chatboxtitle).length > 0) {
		if ($tdmtchat("#chatbox_"+chatboxtitle).css('display') == 'none') {
			$tdmtchat("#chatbox_"+chatboxtitle).css('display','block');
			restructureChatBoxes();
		}
		$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		return;
	}


	$tdmtchat(" <div />" ).attr("id","chatbox_"+chatboxtitle)
	.addClass("chatbox")
	.html('<div class="chatboxhead"><div class="chatboxtitle">'+chatboxtitle+'</div><div class="chatboxoptions"><a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')">-</a> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><div class="chatboxinput"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\');"></textarea></div>')
	.appendTo($tdmtchat( "body" ));
	 
	$tdmtchat("#chatbox_"+chatboxtitle).css('bottom', '0px');
	
	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if ($tdmtchat("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		$tdmtchat("#chatbox_"+chatboxtitle).css('right', '20px');
	} else {
		width = (chatBoxeslength)*(225+7)+20;
		$tdmtchat("#chatbox_"+chatboxtitle).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();

		if ($tdmtchat.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $tdmtchat.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
			$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		}
	}

	chatboxFocus[chatboxtitle] = false;

	$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
		$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
		$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
		$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

	$tdmtchat("#chatbox_"+chatboxtitle).click(function() {
		if ($tdmtchat('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
			$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		}
	});

	$tdmtchat("#chatbox_"+chatboxtitle).show();
	chatHistorybeat(chatboxtitle);
}

function chatHistorybeat(chatboxtitle){

	var itemsfound = 0;

	$tdmtchat.ajax({	
			type: 'POST',
			url: "./include/chat.php",
			data: {  
				'action': 'chatHistorybeat',
				'to' : chatboxtitle
				},
	dataType: "json",
	//error: function(data){
	//alert("error");
	//},
		 success:  function(data){
		$tdmtchat.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug
			

				chatboxtitle = item.b;	
				
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					newMessages[chatboxtitle] = true;
					$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxhistory"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}

				//$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
	}});
}

function chatHeartbeat(){

	var itemsfound = 0;
	
	if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					document.title = x+' says...';
					titleChanged = 1;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				$tdmtchat('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	
	$tdmtchat.ajax({	
			type: 'POST',
			url: "./include/chat.php",
			data: {  
				'action': 'chatHeartbeat'
				},
	dataType: "json",
	//error: function(data){
	//alert("error");
	//},
		 success:  function(data){
		 //	alert(data);	
		$tdmtchat.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;

				if ($tdmtchat("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle);
				}
				if ($tdmtchat("#chatbox_"+chatboxtitle).css('display') == 'none') {
					$tdmtchat("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}

				$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
}

function closeChatBox(chatboxtitle) {
	$tdmtchat('#chatbox_'+chatboxtitle).css('display','none');
	restructureChatBoxes();
		$tdmtchat.ajax({	
		type: 'POST',
			url: "./include/chat.php",
			data: {  
				'action': 'closeChat',
				'chatbox': chatboxtitle
				},
	success:  function(data){
		}
	});

}

function toggleChatBoxGrowth(chatboxtitle) {

	if ($tdmtchat('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
		
		var minimizedChatBoxes = new Array();
		
		if ($tdmtchat.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $tdmtchat.cookie('chatbox_minimized').split(/\|/);
		}

		var newCookie = '';

		for (i=0;i<minimizedChatBoxes.length;i++) {
			if (minimizedChatBoxes[i] != chatboxtitle) {
				newCookie += chatboxtitle+'|';
			}
		}

		newCookie = newCookie.slice(0, -1)


		$tdmtchat.cookie('chatbox_minimized', newCookie);
		$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
		$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
		$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
	} else {
		
		var newCookie = chatboxtitle;

		if ($tdmtchat.cookie('chatbox_minimized')) {
			newCookie += '|'+$tdmtchat.cookie('chatbox_minimized');
		}


		$tdmtchat.cookie('chatbox_minimized',newCookie);
		$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		$tdmtchat('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
	}
	
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle) {
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		message = $tdmtchat(chatboxtextarea).val();
		message = message.replace(/^\s+|\s+$tdmtchat/g,"");
		username = $tdmtchat('#username').attr('value');
		$tdmtchat(chatboxtextarea).val('');
		$tdmtchat(chatboxtextarea).focus();
		$tdmtchat(chatboxtextarea).css('height','44px');
		if (message != '') {
			$tdmtchat.ajax({	
			type: 'POST',
			url: "./include/chat.php",
			data: {  
				'action': 'sendChat',
				'to': chatboxtitle,
				'message' : message
				},
		 success:  function(data){
		 //alert(data);
				message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
				$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+username+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>');
				$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			}});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;

		return false;
	}

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 94;

	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			$tdmtchat(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		$tdmtchat(chatboxtextarea).css('overflow','auto');
	}
	 
}

function startChatSession(){  

	var username = $tdmtchat('#username').attr('value');

	if (username != '') {
	
	$tdmtchat.ajax({	
	type: 'POST',
	url: "./include/chat.php",
	 data: {  
		'action': 'startChatSession'
			},
	dataType: "json",
	cache: false,
	//error: function(data){
	//alert("error");
	//},
	success: function(data){

	$tdmtchat.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;

				if ($tdmtchat("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle,1);
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}
			}
		});
		
		for (i=0;i<chatBoxes.length;i++) {
			chatboxtitle = chatBoxes[i];
			$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			setTimeout('$tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($tdmtchat("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
		}
	
	setTimeout('chatHeartbeat();',chatHeartbeatTime);
		
	}});
	
	} else { return false; }
}


/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};