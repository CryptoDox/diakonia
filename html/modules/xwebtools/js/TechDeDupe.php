<?php
include("../mainfile.php");
include(XOOPS_ROOT_PATH."/header.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<HEAD>
<SCRIPT LANGUAGE="Javascript">
<!--
function dedupe_list()
{
	var count = 0;
	var mainlist = document.form1.mainlist.value;
	mainlist = mainlist.replace(/\r/gi, "\n");
	mainlist = mainlist.replace(/\n+/gi, "\n");
	
	var listvalues = new Array();
	var newlist = new Array();
	
	listvalues = mainlist.split("\n");
	
	var hash = new Object();
	
	for (var i=0; i<listvalues.length; i++)
	{
		if (hash[listvalues[i].toLowerCase()] != 1)
		{
			newlist = newlist.concat(listvalues[i]);
			hash[listvalues[i].toLowerCase()] = 1
		}
		else { count++; }
	}
	document.form1.mainlist.value = newlist.join("\r\n");
	alert('Removed ' + count + ' duplicate values from list. . .');
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<FORM ACTION="" NAME="form1" ID="form1">
<TABLE BORDER=1 CELLPADDING=5>
<TR class="head">
<TD>Paste list to be de-duped here<BR>(one value per line)<P><TEXTAREA NAME="mainlist" COLS=30 ROWS=20></TEXTAREA></TD>
</TR>
<TR class="even"><TD align="center"><input type="button" onClick="dedupe_list();" value="De-Dupe List!"></TD></TR>
</TABLE>
</FORM>

</body>
</html>
<?
include(XOOPS_ROOT_PATH."/footer.php");
?>
