<SCRIPT>

function htmlphp(){
	var input = document.htphp.input.value;
	output = "out.println(\"";
	for (var c = 0; c < input.length; c++){
		if ((input.charAt(c) == "\n" || input.charAt(c) == "\r")){
			output += "\");";
			if (c != input.length - 1) output +="\n out.println( \"";
			c++;
			}
                else {
			if (input.charAt(c) == "\");") 
				output += "\\\"";
				if (input.charAt(c) == "\"") {
				output += "\\\"";
				}
			else {
				if (input.charAt(c) == "\\"){
					output += "\\\\";
					}

				else {
					output += input.charAt(c);
					if (c == input.length -1) output += "\");";	
					}
				}
			}
		
		}

info="\<% \n"

info2="\n out.println( \"\);\n" +

"\%\>";

	document.htphp.output.value =info+output+info2;
}

</SCRIPT>