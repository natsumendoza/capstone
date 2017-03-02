  <?php 
			include ('include/connectdb.php');  
				   $sql = mysql_query("SELECT * FROM inventory ORDER BY lessted_value DESC LIMIT 1");
$productCount2 = mysql_num_rows($sql); // count the output amount
if ($productCount2 > 0) 
{
	while($row = mysql_fetch_array($sql))
	
	{ 
            $vid = $row["id"];
			$pid2= $row["pid"];
		   $prod_title1 = $row["pname"];
			//$ext2  = $row["ext"];
			$sql = mysql_query("SELECT * FROM products WHERE id='$pid2'");
				$productCount2 = mysql_num_rows($sql); // count the output amount
						while($row = mysql_fetch_array($sql))
						{ 
           					$pid = $row["id"];
							$prod_title = $row["product_name"];
			 				$price = $row["price"];
			  				$prod_desc2  = $row["details"];
			  				$category = $row["category"];
							$timestamp = $row["timestamp"];
			   				$ext = $row["ext"];
						}
			
				
			
				
				echo '<div class="tile-large fg-white" data-role="tile" style="width: 23%">
                <div class="tile-content slide-down">
                    <div class="slide">
          <a href="details.php?pid='.$pid.'"><img src="img/product_image/'.$pid.'.'.$ext.'"  data-role="fitImage" data-format="fill" ></a>
		    </div>
	<div class="slide-over bg-emerald text-small padding10">
          <h2><a href="details.php?pid='.$pid.'" class="fg-white"><b>'.$prod_title.'</b></a></h2>
          <h3 class="fg-grayLighter">&#8369;'.$price.'.00</h3>
	<br>
		  <a href="details.php?pid='.$pid.'"><p align="justify" style="line-height:15px;" class="fg-white"><b>DESCRIPTION:</b><br>'.$prod_desc.'</p></a>
                           </div>	
					<div class="tile-label bg-darkTeal full-size"><a href="details.php?pid='.$pid.'" class="fg-white"><b>'.$prod_title.'</b></a></div>
                </div>				
				</div>';}
							}
			?>