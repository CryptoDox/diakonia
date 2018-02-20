<?php
if (isset($_POST['input']))
{
print "<pre>";
print_r($_POST['input']);
print "</pre><hr>";
}


?>
<form method='post' action='test.php'>
<?php
for ($i=0; $i<1000; $i++)
print "<input type='text' name='input[$i]' value='$i' size='4'>\n";
?>
<input type='submit'>
</form>