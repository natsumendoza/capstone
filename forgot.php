<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
		$userid="";
			if (loggedin())
			{
				$query = mysql_query("SELECT * FROM users WHERE email='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$email = $row ['email'];
						$fname = $row ['fname'];
					
					}
				
				}
			else
			{	
			//header("Location:login.php");
		//	exit();
			}
?>
<!DOCTYPE html>
<html lang="en">
   <?php include 'template/top.php'?>
  <body>
     <?php include 'template/header.php'?>
<div class="page-content">
            <div class="container">
                <div class="no-overflow" style="padding-top: 20px">
				
          <h1><a href="index.php" class="nav-button block-shadow transform"><span></span></a>&nbsp;Forgot Password Page</h1>
           <h4 class="bg-grayLighter block-shadow no-padding-bottom"><a href="index.php"><i>_home </a>/<span class="fg-gray"> forgot</span></i></h4>
            
     <hr class="bg-amber no-padding-top">

<div class="grid">
         <?php include 'include/forgot.php';?>

    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->

      <hr>

 <?php include 'template/footer.php'?>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>