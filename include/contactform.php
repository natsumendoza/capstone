
<?php

include 'connectdb.php';
if (isset($_POST['fname'])&& isset($_POST['lname'])&& isset($_POST['email'])&& isset($_POST['message']))
{
	$lname = addslashes(strip_tags($_POST['fname']));
	$fname = addslashes(strip_tags($_POST['fname']));
	$email = addslashes(strip_tags($_POST['email']));
	$message = addslashes(strip_tags($_POST['message']));
	
    $dateToday = mktime(0,0,0,date("m"),date("d"),date("Y"));				
	$today = date("d\tM\tY", $dateToday);
                
	if ($fname&&$lname&&$email&&$message)
	{
		//send email
			
            $register = mysql_query("INSERT INTO inbox VALUES ('','$fname', '$email','$message', now())");
            
                            echo '  <div class="alert alert-success"> Message sent thank you  </div>';
                            
					
      }
	  else {
		  echo '<div class="alert">Please fill out all the fields </div> ';
		  }

}		
?>


