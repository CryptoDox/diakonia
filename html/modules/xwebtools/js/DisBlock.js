<SCRIPT>

function blockfix(){
	var input = document.blocker.input.value;
	output = "$block['content']  =  \"";
	for (var c = 0; c < input.length; c++){
		if ((input.charAt(c) == "\n" || input.charAt(c) == "\r")){
			output += "\";";
			if (c != input.length - 1) output +="\n$block['content']  .= \"";
			c++;
			}
		else {
			if (input.charAt(c) == "\"") {
				output += "\\\"";
				}
			else {
				if (input.charAt(c) == "\\"){
					output += "\\\\";
					}
				else {
					output += input.charAt(c);
					if (c == input.length -1) output += "\";";	
					}
				}
			}
		
		}

info="<\?php\n" + 

"function yourmodulename_show() {\n" 

info2=";\n" +
"return $block;\n" +
"}\n" +
"?>";

	document.blocker.output.value =info+output+info2;
}

</SCRIPT>