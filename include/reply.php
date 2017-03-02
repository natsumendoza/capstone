<?php 
$dialog="";
$attachment = '';
 include 'connectdb.php';
if (isset($_POST['memail'])&&($_POST['message'])&&($_POST['subject'])&&($_POST['fname']))
{	
	$memail = addslashes(strip_tags($_POST['memail']));
	$fname = addslashes(strip_tags($_POST['fname']));
	$message = addslashes(strip_tags($_POST['message']));
	$subject = addslashes(strip_tags($_POST['subject']));
	if ($message&&$subject)
	{
		mysql_query("INSERT INTO inbox VALUES ('','$fname','$subject','$memail', '$message', now())");
		
		 echo "<div class='alert alert-success'>Message Sent</div>";
	}
								
		
	
	else
	{
		echo '<div class="alert alert-error">Please fill in all fields</div>';
	}
}
	?>