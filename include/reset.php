<?php 
include 'connectdb.php';
	if (
	
		isset($_POST['oldPw'])&&
		isset($_POST['newPw'])&&
		isset($_POST['verifyPw'])
	
	)
	{	
	//parsing the value
		
		
		
		if((empty($_POST['oldPw'])) || (empty($_POST['newPw'])) || (empty($_POST['verifyPw'])))
			{
				echo '<div class="alert alert-error">Feilds Cannot be Empty!</div>';
			}
		else
			{
			$oldPw = $_POST['oldPw'];
			$newPw = $_POST['newPw'];
			$verifyPw = $_POST['verifyPw'];
			//md5 value
			$oldpassword=md5($oldPw);
			$newpassword=md5($newPw);
			$verifypassword=md5($verifyPw);
			
			$errors = array();
	
			$query = mysql_query("SELECT * FROM users WHERE password='$oldpassword'");
				if (mysql_num_rows($query)==0)
	{
	$errors[] = '<div class="alert alert-error">Current password is wrong.</div>';
	}
	if ($newPw!=$verifyPw) ///check if pw match
			{
			$errors[] = '<div class="alert alert-error">New pass does not match!</div>';
			}
	
		if (!empty($errors)) 
			{
				foreach ($errors as $error2) 
					{
						echo $error2;
					}
			}
		else
			{
				mysql_query("UPDATE users SET password='$newpassword' WHERE password='$oldpassword'");
							 echo '<div class="alert alert-success">Successfully updated</div>';
			}
			
		}
	}
?>