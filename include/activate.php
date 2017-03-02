
<?php

include 'connectdb.php';

$code= $_GET['code'];
if (!$code)
	echo "No code supplied";
else
{
	$check = mysql_query("SELECT * FROM users WHERE code='$code' AND activate='1'");
	if (mysql_num_rows($check)==1)
		header ("Location:../index.php");
	else
	{
		$active = mysql_query("UPDATE users SET activate='1' WHERE code='$code'");

		header ("Location:../index.php");
	}
}
?>