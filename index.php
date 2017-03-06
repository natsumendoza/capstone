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
  
  <body>
  <?php include 'template/top.php'?>
    <?php include 'template/header.php'?>

<div class="carousel square-bullets" data-height="480" data-role="carousel" data-direction="left">
<div class="slide"><img src="img/car1.png" data-role="fitImage" data-format="fill"></div>
<div class="slide"><img src="img/car2.png" data-role="fitImage" data-format="fill"></div>
<div class="slide"><img src="img/car3.png" data-role="fitImage" data-format="fill"></div>
</div>	
	
						
<div class="page-content">
        <div class="align-center">
            <div class="container">
                <div class="no-overflow" >	
            <h1>Featured Books</h1>
            <hr>
 
<?php 
		 $sql = mysql_query("SELECT * FROM products WHERE status='active' ORDER BY id DESC LIMIT 4");
						$productCount2 = mysql_num_rows($sql); // count the output amount
						if ($productCount2 > 0) 
							{
							while($row = mysql_fetch_array($sql))
										{ 
											$id = $row["id"];
		   									$title = $row["product_name"];
			    							$price = $row["price"];
			   								$prod_desc  = $row["details"];
			    							$ext  = $row["ext"];
			    							$category = $row["category"];
			    							$timestamp = $row["timestamp"];
											
											echo '<div class="tile-large fg-white" data-role="tile" style="width: 23%">
                <div class="tile-content slide-down">
                    <div class="slide">
          <a href="details.php?pid='.$id.'"><img src="img/product_image/'.$id.'.'.$ext.'"  data-role="fitImage" data-format="fill" ></a>
		    </div>
	<div class="slide-over bg-emerald text-small padding10">
          <h2><a href="details.php?pid='.$id.'" class="fg-white"><b>'.$title.'</b></a></h2>
          <h3 class="fg-grayLighter">&#8369;'.$price.'</h3>
	<br>
	<br>
                           </div>	
				
                </div>				
				</div>
				';
										}
							}
						else{
								echo '<div class="alert alert-error">No Products for '.$categorylink.'</div>';
							}
				
		
			?>
			
          
          
       
				         <!-- <div class="grid no-margin-bottom" style="margin-top: 100px" id="g1">
                        <div class="row cells3">
                            <div class="cell no-overflow" style="height: 85px">
                                <div class="bg-yellow fg-white block-shadow" style="height: 85px; padding-top: 20px; margin-top: 85px;">
                                    <h2 class="text-light">yellow ranger</h2>
                                </div>
                            </div>
                            <div class="cell no-overflow" style="height: 85px">
                                <div class="bg-green fg-white block-shadow" style="height: 85px; padding-top: 20px; margin-top: 85px;">
                                    <h2 class="text-light">green ranger</h2>
                                </div>
                            </div>
                            <div class="cell no-overflow" style="height: 85px">
                                <div class="bg-red fg-white block-shadow" style="height: 85px; padding-top: 20px; margin-top: 85px;">
                                    <h2 class="text-light">red ranger</h2>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <script>
                        $(function(){
                            setTimeout(function(){
                                $("#g1 .cell > div:eq(0)").animate({
                                    'margin-top': 0
                                }, 500, 'easeOutBounce');
                                $("#g1 .cell > div:eq(1)").animate({
                                    'margin-top': 0
                                }, 1000, 'easeOutBounce');
                                $("#g1 .cell > div:eq(2)").animate({
                                    'margin-top': 0
                                }, 1500, 'easeOutBounce');
                            }, 500);
                        });
                    </script>
                </div>
            </div>
        </div>
        </div>
<?php include 'template/footer.php'?>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>


  </body>
</html>
