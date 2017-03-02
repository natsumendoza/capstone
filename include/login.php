<?php
include 'connectdb.php';
if (isset($_POST['register']))
{
	//get data
	$username = addslashes(strip_tags($_POST['username']));
	$password = addslashes(strip_tags($_POST['password']));
	
	if ($username&&$password)
	{
				$login = mysql_query("SELECT * FROM users WHERE usn='$username'");//filtering the database and compare if the username macth the variable inputed in the username field.
				
				if (mysql_num_rows($login)!=0)
				{
					//code to login
					while ($row = mysql_fetch_assoc($login))
					{
						$dbpassword = $row ['password'];
						$password = md5($password);
						
						if ($password != $dbpassword){
							echo '<div class="fg-red">Incorrect username or password</div>';
							    
							}
							
						else
						{
							$activate = $row['activate'];
							$usn = $row['usn'];
							
							if ($activate==0)
							{
								echo '<div class="fg-amber">You have not activated your account. Please check your email</div>';
							}
							else{
							
							$fname = $row ['fname'];
							 session_start();
							$_SESSION['username']=$username;
							
							//echo'<div class="alert alert-success"> Welcome '.$fname .' | <a href="'.$_SERVER['HTTP_REFERER'].'">Shop now!</a>';
							header("Location:index.php");
		//	exit();
							}
							
						}
					}
				}
				else
				{
				echo '<div class="fg-red">That user doesnt exist!</div>';
						
				}			
	}
	else
	
	echo '<div class="fg-amber">Please enter a username and password</div>';
			
			

			}
			
			

?>

<form role="form" method="POST" action="">
	            <div class="row">
				<br/>
	              <fieldset class="example" data-text="login form">
				  <br/>
				  <div class="row cells2">
				  <div class="cell">
	              <div class="form-group">
				  <div class="input-control text full-size" data-role="input">
	                <label for="input2">Username</label>
					<span class="mif-user prepend-icon"></span>
	                <input type="text" name="username" class="form-control" id="input2">
					<button class="button helper-button clear"><span class="mif-cross"></span></button>
	              </div>
	              </div>
				  <br/>
	              <div class="form-group">
				  <div class="input-control password full-size" data-role="input">
	                <label for="input3">Password</label>
					<span class="mif-lock prepend-icon"></span>
	                <input type="password" name="password" class="form-control" id="input3">
					<button class="button helper-button reveal"><span class="mif-looks"></span></button>         
	              </div>
                  <a href="forgot.php">Forgotten password?</a>
	              <div class="clearfix"></div>
	              <br/>
	              <div class="form-group">
	                <input type="hidden" name="save" value="contact">
	                <button type="submit" class="button success" name="register">Submit</button>
                    Not yet a member? Register<a href="register.php"> here</a>
	              </div>
	              </div>
				  </fieldset>
              </div>
            </form>