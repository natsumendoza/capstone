<?php

include'connectdb.php';
//post variable for calleling the transactions	
$reason="";
if (isset($_POST['txnnumber']))
		{
		$txnnumber= $_POST['txnnumber'];
		//$reason= $_POST['reason'];
		
		if(!empty($txnnumber))
		{
		
			
							//$transaction= mysql_query ("SELECT * FROM transactions WHERE txn_id='$txn' LIMIT 1") or die('Error on query');
							$check2 = mysql_query ("SELECT * FROM transactions WHERE txn_id='$txnnumber'");
							if (mysql_num_rows($check2)>=1)
									{
										$check2 = mysql_query ("SELECT * FROM cacel_order WHERE txn_id='$txnnumber'");
											if (mysql_num_rows($check2)>=1)
												{
													echo '<div class="alert alert-warning">The product you are trying to return is already in our record </div>';
												}
											else{
										echo '<div class="alert alert-success">Do you realy want to cancel order?  <a class="btn btn-primary" href="include/cancelorder.php?txn='.$txnnumber.'">Yes</a> | <a class="btn btn-success" href="user.php">No</a></div>';}
												}
						 	else{
								echo '<div class="alert alert-error">Sorry! We dont have order for that transaction id</div>';
								}
			
		}
		
	else{
			echo '<div class="alert alert-error">Please input your transaction number </div>';
			}
			
		
		}
		
		
if(isset($_GET['txn'])){
		$txn = addslashes(strip_tags($_GET['txn']));
		
			if($txn)
			{
				
				
				$sql = mysql_query("SELECT * FROM transactions WHERE txn_id ='$txn'") or die("Query didnt work");
				$productCount = mysql_num_rows($sql); // count the output amount
				
				
						 if ($productCount > 0) {
	   					 while($row = mysql_fetch_array($sql)){ 
             				 $id = $row["id"];
						 	 $payer_email = $row["payer_email"];
			 				 $transaction_id1 = $row["txn_id"];
						 }
						 	
						$check2 = mysql_query ("SELECT * FROM cacel_order WHERE transaction_id='$transactid'");
							if (mysql_num_rows($check2)>=1)
							{
						$dialog = '<h4 class="alert_warning">The product you are trying to return is already in our record </h4>';
							}
						 else{
							 
							 
						mysql_query(" Delete from cacel_order where txn_id = '$txn'");
						header("Location:../user.php");
						mysql_query("INSERT INTO cacel_order VALUES ('','$txn','$payer_email', now())");
							}
				
					
		
    } 	
	else {
	  $dialog = '<h4 class="alert_warning">Transaction ID you are trying to cancelled is not in our record </h4>';
		}		 
			}
			else
			{
			echo '<h4 class="alert_error">Please fill in all fields</h4>';
			}
	
			
			}
		
	?>