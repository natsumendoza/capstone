<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
		$userid="";
			if (loggedin())
			{
				$query = mysql_query("SELECT * FROM users WHERE usn='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$usn = $row ['usn'];
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
        <div class=" align-center">
            <div class="container">
                <div class="no-overflow" style="padding-top: 40px">
				
				
          <h1 class="page-header">Product Gallery </h1>

<div class="example">


        <?php include 'template/productgal.php';?>     


    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->
    </div><!-- /.container -->


      <hr>

     <?php include 'template/footer.php';?>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>