<?php
include '../include/connectdb.php';
	include 'include/check_login.php';
if (!isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
	
	
	
}?>

<?php
		
		$username="";
			if (loggedin())
			{
				$query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$username = $row ['username'];
						
					
					}
				
				}
			else
			{	
			//header("Location:login.php");
		//	exit();
			}
			?>
<?php
//out of stock
$outofstock = "";
$osQuery= mysql_query("SELECT * FROM products WHERE stock=0 ORDER BY id DESC LIMIT 5");
     if (mysql_num_rows($osQuery)==0){
        $outofstock = "<h4 class='alert_error'>No data found</h4>";
    }
    else {
        while($row = mysql_fetch_array($osQuery)){
          $prod_name = $row['product_name'];
          $prod_id = $row ['id'];
          
          /* 
           <div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
            */
           $outofstock .= '<div class="list"><a href="edit_prod.php?id='.$prod_id.'">'.$prod_name.'</a></div><br/>';
          
        }
    }

?>
<?php
//critical
$critical = "";
$cQuery= mysql_query("SELECT * FROM products WHERE stock<=10 and stock>0 ORDER BY id DESC LIMIT 5");
     if (mysql_num_rows($cQuery)==0){
        $critical = "<div class='message'><p>No data found</div>";
    }
    else {
        while($row = mysql_fetch_array($cQuery)){
          $prod_name = $row['product_name'];
          $stock = $row['stock'];
          $prod_id = $row ['id'];
          
          /* 
           <div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
            */
           $critical .= '<a href="edit_prod.php?id='.$prod_id.'">'.$prod_name.' | <strong>Stock: '.$stock.'</strong></a><br/>';
          
        }
    }

?>
<?php
    $sql = mysql_query("SELECT * FROM products ORDER BY id");
	$prodCount = mysql_num_rows($sql); // Counting the database product
	
	$sql = mysql_query("SELECT * FROM products WHERE stock < 11 AND stock > 0");
	$stockCount = mysql_num_rows($sql); // Counting the database product critical
	
	$sql = mysql_query("SELECT * FROM products WHERE stock >=10 AND stock >=10");
	$instockCount = mysql_num_rows($sql); // Counting the database product in-stock
	
	$sql = mysql_query("SELECT * FROM products WHERE stock = 0");
	$outofstock = mysql_num_rows($sql); // Counting the database product out of stock
	
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">-->
   <!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php'?>
		<?php include 'template/top.php'?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Transactions<small></small></h1>
           <hr>
          </div>
        </div><!-- /.row --><!-- /.row -->

			   <div class="row">
            <h2>Orders List</h2>
            <div class="table-responsive">
            <?php
$msg = "";
if (isset($_POST['statupdate'])){
    $txn_id2 = $_POST['txnid'];
    $status = addslashes(strip_tags($_POST['status1']));
    $status2 = addslashes(strip_tags($_POST['status2']));
    $txnquery= mysql_query("SELECT * FROM transactions WHERE txn_id='$txn_id2'");
    if (mysql_num_rows($txnquery)==0){
        echo   "No data found";
        $msg = "";
        $payment_status = "";
    }
    else {
         while($row = mysql_fetch_array($txnquery)){
            $payment_status = $row['payment_status'];
        }
       
                $update = mysql_query("UPDATE transactions SET payment_status='$status', status_detail='$status2'  WHERE txn_id='$txn_id2'");
                echo "<div class='alert alert-success'>Successfully Updated</div>";
				
				
            }
            
        
        
    
}
else{
    $notes = "";
    $msg = "";
    $payment_status = "";
}

?>  
            <?php

	if (isset($_GET['statupdate']))
	{
		$txn_no="";
		$transactid = $_GET['txnid'];		
		$queryprod=mysql_query("SELECT * FROM transactions WHERE id='$transactid' LIMIT 1");
		if($queryprod>0){
		while($row=mysql_fetch_array($queryprod))
			{
			$txn_no=$row['id'];
			$payment_status= $row["payment_status"]; 
			$txn_id = $row["txn_id"];
			
			}
		
		}
	}
		
		?>

            
             <table class="table table-striped">
<thead>
<tr>
<th width="15%">TXN : number</th>
    <th width="20%">Customer</th>
    <th width="14%">Status</th>
    <th width="14%">detail</th>
    <th width="22%">Date Purchased</th>
    <th width="13%">Payment</th>
    <th width="15%">Action</th>
</tr>
</thead>


<tbody>
  <?php
  if (isset($_GET['status']))
	{	
	$stat=$_GET['status'];

				//Run a select query to get my latest 5 items

$sql = mysql_query("SELECT * FROM transactions WHERE payment_status='$stat' ORDER BY id DESC");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
			 $id = $row['id'];
			 $date = $row['payment_date'];
			  $gross = $row["mc_gross"];
			  $txn_id = $row["txn_id"];
			  $txn_type = $row["txn_type"];
			 $firstname = $row["first_name"];
			 $lastname = $row["last_name"];
			 $email= $row["payer_email"];
			 $payer_status = $row["payer_status"];
			 $street = $row["address_street"];
			 $city = $row["address_city"];
			 $state = $row["address_state"];
			  $country = $row["address_country"];
			  $currency = $row["mc_currency"]; 
			  $payment_status= $row["payment_status"]; 
			  $status_detail= $row["status_detail"]; 
			  $month= $row["month"];
			   $day= $row["day"];
			    $year= $row["year"];
				$cartTotal2="";
			 $datepayment = strftime("%b %d, %Y", strtotime($row["payment_date"]));
			 if($payment_status=='Completed'){
				 $stat=$payment_status;
				 $dstat=$status_detail;
				 }
			 else{
				 $stat=' '.$payment_status.' <a title="Update Status" href="transactions.php?transactid='.$id.'"><span class="icon-pencil"></span></a>';
				 $dstat=' '.$status_detail.' <a title="Update Status" href="transactions.php?transactid='.$id.'"><span class="icon-pencil"></span></a>';
				 }
			 
		
 echo'<tr>
    <td height="29">'.$txn_id.'</td>
    <td>'.$firstname.' '. $lastname.'</td>
    <td>'.$stat.'</td>
    <td>'.$dstat.'</td>
	 <td>'.$datepayment .'</td>
    <td> &#8369; '.$gross.'</td>
	<td><a  data-toggle="modal" href="#transaction'.$id.'">View</a>| <a  data-toggle="modal" href="#status'.$id.'">Update Status</a></td>
	<td><!-- Modal -->
<div class="modal fade" id="transaction'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Status : '.$firstname.' '.$lastname.' </h4>
      </div>
      <div class="modal-body">
    
				 Billing Address :<span style="font-size: 14px">'.$street.' '.$city.' '.$state.' '.$country.'</span><br/>
     			 Status : <span style="font-size: 14px">'.$payment_status.'</span><br/>
				 Payer Status : <span style="font-size: 14px">'.$payer_status.'</span><br/>
				 Date of Transaction : <span style="font-size: 14px">'.$datepayment.'</span><br/>
     			 Orders:
      <hr /> <div class="row thead">
               <div class="col-lg-3">Item name</div>
                <div class="col-lg-3">Price</div>
                 <div class="col-lg-3">Quantity</div>
                 <div class="col-lg-3">TPrice</div>
             </div>';
	  
	$product_array = $row["product_id_array"];
  				$product_id_string = rtrim($product_array, ",");
                $pieces = explode(",", $product_id_string);
                $result = count($pieces);
                $fullAmount = 0;
			    for ($i=0; $i<$result; $i++){
                       
                                    list($cat, $quan) = explode("-", $pieces[$i]);
                                      
                                    $prod = mysql_query("SELECT * FROM products WHERE id='$cat'");
                                    while($row = mysql_fetch_array($prod)){
										$productid1 = $row['id'];
                                         $prod_name2 = $row['product_name'];
										 $price2 = $row['price'];
										 $ext = $row['ext'];
										 
										$pricetotal1 = $price2 * $quan;
										$cartTotal2 = $pricetotal1 + $cartTotal2;
										
										echo '<div class="row">
               <div class="col-lg-3" style="font-size: 14px">'.$prod_name2.'</div>
                <div class="col-lg-3" style="font-size: 14px"> &#8369;'.$price2.'</div>
                 <div class="col-lg-3" style="font-size: 14px">'.$quan.'</div>
                 <div class="col-lg-3" style="font-size: 14px">&#8369;'.$pricetotal1.'</div>
             </div>';
										
									}
				}
	  
	  
	  echo'
				
               <hr />
              <div class="row">
			 
               <div class="span2 pull-right">Total Order: &#8369;'.$cartTotal2.'</div>
             </div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --></td>



<td><!-- Modal -->
<div class="modal fade" id="status'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Status :  '.$stat.'</h4>
      </div>
      <div class="modal-body">
       <form action="" method="POST" >
          <h4 class="modal-title">Status Update</h4>
        </div>
        <div id="stock_status"></div><!--for login status output--> 
        <div class="modal-body">  
        <h5>Name : '.$firstname.' '.$lastname.'</h5>
		<h5>Transaction ID : '.$txn_id.'></h5>
   <div class="form-group">
      <label for="exampleInputPassword">Status</label>
     <select name="status1"><option value="'.$payment_status.'">'.$payment_status.'</option>
                         <option value="Pending">Pending</option>
                         <option value="Completed">Completed</option>
                         <option value="Shipped">Shipping</option>
                         <option value="Cancelled">Cancelled</option>
                         <option value="Returned">Returned</option></select>
	
	<select name="status2"><option value="'.$status_detail.'">'.$status_detail.'</option>
                         <option value="Pending">Pending</option>
                         <option value="Completed">Completed</option>
                         <option value="Shipped">Shipping</option>
                         <option value="Cancelled">Cancelled</option>
                         <option value="Defect">Defect</option></select>
						 
    </div>
    <div class="form-group">
    <input name="txnid" type="hidden" value="'.$txn_id.'" />
	<input type="submit" name="statupdate" class="btn btn-primary" value="Update"/>
    </div>
        </form>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --></td>
  </tr>';
    }
	
} 
	else{
		echo '<div class="alert alert-error">No Complete Transactions</div>';
		}
			
			}
	
	
	else{
		//Run a select query to get my latest 5 items

$sql = mysql_query("SELECT * FROM transactions ORDER BY id DESC");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
			 $id = $row['id'];
			 $date = $row['payment_date'];
			  $gross = $row["mc_gross"];
			  $txn_id = $row["txn_id"];
			  $txn_type = $row["txn_type"];
			 $firstname = $row["first_name"];
			 $lastname = $row["last_name"];
			 $email= $row["payer_email"];
			 $payer_status = $row["payer_status"];
			 $street = $row["address_street"];
			 $city = $row["address_city"];
			 $state = $row["address_state"];
			  $country = $row["address_country"];
			  $currency = $row["mc_currency"]; 
			  $payment_status= $row["payment_status"]; 
			  $status_detail= $row["status_detail"];
			  $month= $row["month"];
			   $day= $row["day"];
			    $year= $row["year"];
				$cartTotal2="";
				
			

				
				
				
				
				
				
			 $datepayment = strftime("%b %d, %Y", strtotime($row["payment_date"]));
			 if($payment_status=='Completed'){
				 $stat=$payment_status;
				 $dstat=$status_detail;
				 }
			 else{
				 $stat=' '.$payment_status.' <a title="Update Status" href="transactions.php?transactid='.$id.'"><span class="icon-pencil"></span></a>';
				 
				 $dstat=' '.$status_detail.' <a title="Update Status" href="transactions.php?transactid='.$id.'"><span class="icon-pencil"></span></a>';
				 }
			 
		
 echo'<tr>
    <td height="29">'.$txn_id.'</td>
    <td>'.$firstname.' '. $lastname.'</td>
    <td>'.$stat.'</td>
    <td>'.$dstat.'</td>
	 <td>'.$datepayment .'</td>
    <td> &#8369; '.$gross.'</td>
	<td><a  data-toggle="modal" href="#transaction'.$id.'">View</a>| <a  data-toggle="modal" href="#status'.$id.'">Update Status</a></td>
	<td><!-- Modal -->
<div class="modal fade" id="transaction'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Status : '.$firstname.' '.$lastname.' </h4>
      </div>
      <div class="modal-body">
    
				 Billing Address :<span style="font-size: 14px">'.$street.' '.$city.' '.$state.' '.$country.'</span><br/>
     			 Status : <span style="font-size: 14px">'.$payment_status.'</span><br/>
				 Payer Status : <span style="font-size: 14px">'.$payer_status.'</span><br/>
				 Date of Transaction : <span style="font-size: 14px">'.$datepayment.'</span><br/>
     			 Orders:
      <hr /> <div class="row thead">
               <div class="col-lg-3">Item name</div>
                <div class="col-lg-3">Price</div>
                 <div class="col-lg-3">Quantity</div>
                 <div class="col-lg-3">TPrice</div>
             </div>';
	  
	$product_array = $row["product_id_array"];
  				$product_id_string = rtrim($product_array, ",");
                $pieces = explode(",", $product_id_string);
                $result = count($pieces);
                $fullAmount = 0;
			    for ($i=0; $i<$result; $i++){
                       
                                    list($cat, $quan) = explode("-", $pieces[$i]);
                                      
                                    $prod = mysql_query("SELECT * FROM products WHERE id='$cat'");
                                    while($row = mysql_fetch_array($prod)){
										$productid1 = $row['id'];
                                         $prod_name2 = $row['product_name'];
										 $price2 = $row['price'];
										 $ext = $row['ext'];
										 
										$pricetotal1 = $price2 * $quan;
										$cartTotal2 = $pricetotal1 + $cartTotal2;
										
										echo '<div class="row">
               <div class="col-lg-3" style="font-size: 14px">'.$prod_name2.'</div>
                <div class="col-lg-3" style="font-size: 14px"> &#8369;'.$price2.'</div>
                 <div class="col-lg-3" style="font-size: 14px">'.$quan.'</div>
                 <div class="col-lg-3" style="font-size: 14px">&#8369;'.$pricetotal1.'</div>
             </div>';
										
									}
				}
	  
	  
	  echo'
				
               <hr />
              <div class="row">
			 
               <div class="span2 pull-right">Total Order: &#8369;'.$cartTotal2.'</div>
             </div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --></td>



<td><!-- Modal -->
<div class="modal fade" id="status'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Status :  '.$stat.'</h4>
      </div>
      <div class="modal-body">
       <form action="" method="POST" >
          <h4 class="modal-title">Status Update</h4>
        </div>
        <div id="stock_status"></div><!--for login status output--> 
        <div class="modal-body">  
        <h5>Name : '.$firstname.' '.$lastname.'</h5>
		<h5>Transaction ID : '.$txn_id.'></h5>
   <div class="form-group">
      <label for="exampleInputPassword">Status</label>
     <select name="status1"><option value="'.$payment_status.'">'.$payment_status.'</option>
                         <option value="Pending">Pending</option>
                         <option value="Completed">Completed</option>
                         <option value="Shipped">Shipping</option>
                         <option value="Cancelled">Cancelled</option>
						 <option value="Returned">Returned</option></select>
						 
		<select name="status2"><option value="'.$status_detail.'">'.$status_detail.'</option>
                         <option value="Pending">Pending</option>
                         <option value="Completed">Completed</option>
                         <option value="Shipped">Shipping</option>
                         <option value="Cancelled">Cancelled</option>
						 <option value="Defect">Defect</option></select>
    </div>
    <div class="form-group">
    <input name="txnid" type="hidden" value="'.$txn_id.'" />
	<input type="submit" name="statupdate" class="btn btn-primary" value="Update"/>
    </div>
        </form>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --></td>
  </tr>';
    }
	
} 
		}
		
			
?>

</tbody>
<?php //include 'template/transaction.php';?>
</table>
    			</div>
         
        </div>
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>
