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
        <div class="align-center">
            <div class="container">
                <div class="no-overflow" >	
				<br/>
            <h1 class="bg-grayLighter fg-orange">Terms and Condition</h1>
            <hr class="bg-emerald">
 <p align="justify" style="line-height:24px;">
//TERMS AND CONDITIONS
 </P>
                </div>
            </div>
        </div>
        </div>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php include 'template/footer.php'?>
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>


  </body>
</html>
