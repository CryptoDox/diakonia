<SCRIPT LANGUAGE="JavaScript">
// T-Tech De-Dupe
<!-- Begin
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
//  End -->
</script>