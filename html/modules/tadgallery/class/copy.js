function Copy2Clipboard(text2copy){


	if( window.clipboardData && clipboardData.setData ) //only works in IE
	{
		window.clipboardData.setData("Text",text2copy);
	}
	else //for other browsers
	{

	var flashcopier = 'flashcopier';
	
	if(!document.getElementById(flashcopier))	{
		var divholder = document.createElement('div');
		divholder.id = flashcopier;
		document.body.appendChild(divholder);
	}
	
	document.getElementById(flashcopier).innerHTML = '';
	var divinfo = '<embed src="class/copy.swf" FlashVars="clipboard='+encodeURIComponent(text2copy)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';

	document.getElementById(flashcopier).innerHTML = divinfo;
	}
}
