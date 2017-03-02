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
        <div>
            <div class="container">
                <div class="no-overflow" style="padding-top: 40px">

          <h1 class="page-header">Products <small>Showcase </small></h1>
<?php

include ('include/connectdb.php');
$output='';
if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysql_query("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $pid = $row["id"];
			$prod_title = $row["product_name"];
			 $price = $row["price"];
			  $prod_desc  = $row["details"];
			  $category = $row["category"];
			$timestamp = $row["timestamp"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			  $ext = $row["ext"];
			  
			  if (loggedin())
					{
					$botton='<a data-toggle="modal" href="#addtocart" class="btn btn btn-success btn-large">Add to cart</a> ';
					}
					
						else{
							$botton='<a data-toggle="modal" href="#login" class="btn btn btn-success btn-large">Add to cart</a>';
							}
						
					
			 
			 echo '<div class="example" data-text="details">
            <div class="grid no-margin-top">
			 <div class="tile-big bg-dark fg-white element-selected" data-role="tile" style="width: 35%">
                <div class="tile-content">
                
                    <img class="img-responsive" src="img/product_image/'.$pid.'.'.$ext.'"data-role="fitImage" data-format="fill">
		 </div>
		 </div>

          <h1 class="bg-darker fg-amber block-shadow">'.$prod_title.'</h1>
          <h2 class="block-shadow">&#8369; '.$price.'</h2>
		  <hr class="bg-green" />
		  <br/>
		 <h4><b>DESCRIPTION:</b></h4>
       <p align="justify" style="line-height:15px;">'.$prod_desc.'</p><br/><br/>
        </div>
		
		
		
			<div class="grid no-margin-top">
			<form method="post" action="user.php">
	   	<div class="input-control text" data-role="input">
	   <input type="text" class="form-control" name="qty" value="1" placeholder="1">
	   <button class="button helper-button clear"><span class="mif-cross"></span></button>
	   </div>   
        <input name="pid" type="hidden" value="'.$pid.'" />
	    <button type="submit" class="button success" name="addcart">Add to Cart <span class="mif-opencart"></span></button>		
		 </form>
		 </div>
		</div>	
		</div>
		</div>';
			  
	
        }
    } else {
	    echo "<div id='error'>Invalid Id</div>";
		
    }
}
?>
       

      </div>
      </div>
      </div>
      </div>
      
      <hr>
<?php include 'template/footer.php'?>
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>