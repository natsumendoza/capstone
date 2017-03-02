<?php 
$dialog="";
$attachment = '';
 include '../../include/connectdb.php';
if (isset($_POST['memail'])&&($_POST['message'])&&($_POST['subject']))
{	
	$memail = addslashes(strip_tags($_POST['memail']));
	$message = addslashes(strip_tags($_POST['message']));
	$subject = addslashes(strip_tags($_POST['subject']));
	if ($memail&&$message)
	{
		mysql_query("INSERT INTO outbox VALUES ('','$memail', '$subject', '$message', now())");
		
		
		echo "<div class='alert alert-success'>Message Sent</div>";
	}
								
		

	else
	{
		echo '<div id="error">Please fill in all fields</div>';
	}
}
	?>