<SCRIPT>

function htmlphp(){
	var input = document.htphp.input.value;
	output = "Response.Write \"";
	for (var c = 0; c < input.length; c++){
		if ((input.charAt(c) == "\n" || input.charAt(c) == "\r")){
			output += "\" & vbCrLf";
			if (c != input.length - 1) output +="\n  Response.Write \"";
			c++;
			}
		else {
			if (input.charAt(c) == "\");") {
				output += "\\\"";
				}
			else {
				if (input.charAt(c) == "\\"){
					output += "\\\\";
					}

				else {
					output += input.charAt(c);
					if (c == input.length -1) output += "\" & vbCrLf";	
					}
				}
			}
		
		}

info="\<% \n" 

info2="\n Response.Write \"\"\n" +

"\%\>";

	document.htphp.output.value =info+output+info2;
}

</SCRIPT>