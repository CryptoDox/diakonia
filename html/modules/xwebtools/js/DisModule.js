<SCRIPT>

function makemymod(){
	var input = document.modumake.input.value;
	output = "echo\"";
	for (var c = 0; c < input.length; c++){
		if ((input.charAt(c) == "\n" || input.charAt(c) == "\r")){
			output += "\"";
			if (c != input.length - 1) output +="\n  . \"";
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
					if (c == input.length -1) output += "\"";	
					}
				}
			}
		
		}

info="<\?php\n" + 


"include(\"../../mainfile.php\");\n" +
"include(XOOPS_ROOT_PATH.\"/header.php\");\n" +
"OpenTable();\n"

info2=";\n" +
"CloseTable();\n" +
"include(XOOPS_ROOT_PATH.\"/footer.php\");\n" +
"?>";

	document.modumake.output.value =info+output+info2;
}

</SCRIPT>