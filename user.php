<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
		$userid="";
		 
if (loggedin())
			{
				$usn="";
				$fname="";
				$query = mysql_query("SELECT * FROM users WHERE usn='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$usn = $row ['usn'];
						$email = $row ['email'];
						$fname = $row ['fname'];
						$lname = $row ['lname'];
						$address = $row ['address'];
						$bday = $row ['birthday'];
						$contact = $row ['contact'];
					
					}
				
				}
			else
			{	
			header("Location:login.php");
		exit();
			}
?>
<!DOCTYPE html>
<html lang="en">
   <?php include 'template/utop.php'?>
   <?php include 'include/cart.php'?>
  <body>
<script language="JavaScript" type="text/javascript">
function ajax_resetpass(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "include/reset.php";
    var oldPw = document.getElementById("oldPw").value;
    var newPw = document.getElementById("newPw").value;
	var verifyPw = document.getElementById("verifyPw").value
     var vars = "oldPw="+oldPw+"&newPw="+newPw+"&verifyPw="+verifyPw;
	
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("status").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("status").innerHTML = "<img src='img/ajax-loader.gif' />";
}


//updating the profile
function ajax_cancel(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "include/cancelorder.php";
    var txnnumber = document.getElementById("txnnumber").value;
     var vars = "txnnumber="+txnnumber;
	
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("cancel").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("cancel").innerHTML = "<img src='img/ajax-loader.gif' />";
}


function ajax_contact(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "include/reply.php";
    var memail = document.getElementById("memail").value;
	var message = document.getElementById("message").value;
    var subject = document.getElementById("subject").value;
	var fname = document.getElementById("fname").value;
      var vars = "memail="+memail+"&message="+message+"&subject="+subject+"&fname="+fname;
	
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("messaging").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("messaging").innerHTML = "<img src='../img/ajax-loader.gif' /> Processing...";
}
</script>
     <?php include 'template/uheader.php'?>

    <div class="container">

      <div class="row">

        <div class="col-lg-12">
          <h1 class="page-header">Welcome! <small> <?php echo $fname?> </small></h1>
        </div>

      </div>

      <div class="row">
        <div class="col-md-8">
        
        <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="in active"><a href="#home" data-toggle="tab">Shopping Cart</a></li>
  <li><a href="#profile" data-toggle="tab">Change Password</a></li>
   <li><a href="#cancel" data-toggle="tab">Order</a></li>
   <li><a href="#board" data-toggle="tab">Message</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
  
  <div class="table-responsive">
  		  <table class=" table table-bordered">
          <thead>
           		<tr>
                	<th align="center" valign="middle">IMAGE</th>
                    <th align="center" valign="middle">ITEM NAME</th>
                    <th align="center" valign="middle">PRICE</th>
                    <th align="center" valign="middle">QTY</th>
                    <th align="center" valign="middle">UPDATE QUANTITY</th>
                    <th align="center" valign="middle">TOTAL</th>
                    <th align="center" valign="middle">ACTION</th>
                </tr>
                
           </thead>
           <tbody>
          		<?php echo  $erroradjust?>
           		<?php echo $cartOutput?>
                <?php echo $success?>
               <?php echo  $stock_error ?>
           </tbody>
           </table>
           <div class="span8"><div class="span5"><a class="btn btn-success pull-left" href="catalog.php"><span class="icon-arrow-left"></span> Continue shopping</a></div> <div class="span2"><?php  echo $pp_checkout_btn?></div></div>
           <div class="span3"><h4 align="center"><?php echo $cart_Total ?></h4> </div>
       		 </div>
  
  </div>
  <div class="tab-pane" id="profile">
  <div id="status"></div><!--for login status output--> 
  			<form role="form" method="POST" action="javascript:ajax_resetpass()">
	               <div class="form-group col-lg-5">
	               <label for="exampleInputPassword">Current Password</label>
      <input type="password" name="oldPw" id="oldPw"  class="form-control"  placeholder="Current Password">
	              </div>
	             
                  <div class="form-group col-lg-5">
	               <label for="exampleInputEmail">Confirm password</label>
      <input type="password" name="verifyPw" id="verifyPw" class="form-control" placeholder="Confirm password">
	              </div>
                 
                   <div class="form-group col-lg-5">
                    <hr>
	               <label for="exampleInputEmail">New Password</label>
      <input  type="password" name="newPw" id="newPw"  class="form-control" placeholder="Enter New password">
	              </div>
	              <div class="clearfix"></div>
	              
	              <div class="form-group col-lg-12">
	                <input type="hidden" name="save" value="contact">
	                <button type="submit" class="btn btn-primary" name="register">Submit</button>
	              </div>
            
            </form>
  </div>
  
  <div class="tab-pane" id="messages">  
  This tab is under constract
  </div>
  
  <div class="tab-pane" id="cancel">
       <div id="cancel"></div><!--for login status output-->
   		<form action="javascript:ajax_cancel()" method="post">
     	<fieldset>
		<div class="form-group col-lg-6">
  		<label for="exampleInputPassword">Cancel Order</label>
      	<input type="text" name="txnnumber" id="txnnumber" class="form-control" required placeholder="Input TXN number">
   		</div>
   		</fieldset>
		<div class="form-group col-lg-7">
		<input type="submit" name="txn" class="btn btn-primary btn-lg pull-left" value="Cancell Order for this txn"> 
		</form>
       </div>
<!---------------------------------------------------------------------------------------------------->
<table class="table table-striped">
<thead>
<tr>
<th width="15%">TXN : number</th>
    <th width="15%">Item</th>
    <th width="14%">Status</th>
    <th width="14%">detail</th>
    <th width="22%">Date Purchased</th>
    <th width="13%">Payment</th>
</tr>
</thead>


<tbody>
  <?php
  if (isset($_GET['status']))
	{	
	$stat=$_GET['status'];
	$dstat=$_GET['status2'];

				//Run a select query to get my latest 5 items

$sql = mysql_query("SELECT * FROM transactions WHERE payment_status='$stat', ORDER BY id DESC");
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
    <td><a  data-toggle="modal" href="#transaction'.$id.'">View</a></td>
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
    <td><a  data-toggle="modal" href="#transaction'.$id.'">View</a></td>
    <td>'.$stat.'</td>
    <td>'.$dstat.'</td>
	 <td>'.$datepayment .'</td>
    <td> &#8369; '.$gross.'</td>
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
</table>
  </div>

   <div class="tab-pane" id="board">
<a href="#create" data-toggle="tab" ><span class="glyphicon-retweet">Compose></a> | <a href="#board" data-toggle="tab" ><span class="glyphicon-retweet">My message</a> 
		<table class="table table-striped">
		<thead>
			<tr>
			<th align="center">&nbsp;</th>
			<th align="center">User</th>
			<th align="center">Message</th>
			<th align="center">Date</th>
			<th align="center">Action</th>
			</tr>
		</thead>
	<tbody>

<?php 
$sql = mysql_query("SELECT * FROM outbox WHERE email='$email' order BY id DESC");
$productCount2 = mysql_num_rows($sql); // count the output amount
if ($productCount2 > 0) 
{
	while($row = mysql_fetch_array($sql))
	
	{ 
            	$id = $row["id"];
		   		//$firstname = $row["firstname"];
			 	$name = 'Admin';
			  	$email  = $row["email"];
			    $message  = $row["message"];
				$subject  = $row["subject"];
			    $date=$row['date'];
				//$active=$row['active'];

				
	
					 
					 echo '<tr>
					 <td class="p"><span class="icon-folder-open"></span></td>
					<td  class="p">'.$name.'</td>
					<td  class="p">'.$subject.'</td>
					<td  class="p">'.$date.'</td>
					<td  class="p"><a data-toggle="modal" href="#view'.$id.'"><span class="icon-eye-open"></span>View</a> </td>
					
					<td  class="p">
					<!-- view Modal -->
<div class="modal fade" id="view'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
			 <h3>'.$name.'</h3><h4>'.$subject.'</h4> <p>'.$message.' <br/>'.$date.'</p>
        </div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --><!-- /.Reply modal -->
					 </td>
</tr>';	 		
					 }

			 
		
			
			 
	
}
?>
 </tbody>
 </table>
  </div>
  

  <div class="tab-pane" id="create">
  <a href="#board" data-toggle="tab"><i class="glyphicon-arrow-left"> </i>BACK</a>
  		 <div id="messaging"></div><!--for login status output-->
   <form action="javascript:ajax_contact()" method="post">
     <fieldset>

<div class="form-group col-lg-12">
 	 <input type="hidden" name="memail" id="memail" class="form-control " value="<?php echo $email?>">
     <input type="hidden" name="fname" id="fname" class="form-control " value="<?php echo $fname?>">
      <label for="exampleInputPassword">Subect</label>
      <input type="text" name="subject" id="subject" class="form-control " required placeholder="Place your subject">
    </div>
    
    <div class="form-group col-lg-12">
  
      <label for="exampleInputPassword">Message</label>
    <textarea name="message" cols="30" id="message"  class="form-control"  rows="6"></textarea>
    </div>
   
  </fieldset>
     
   <div class="form-group col-lg-7">
<input type="submit" class="btn btn-primary btn-lg pull-left" value="Send"> 
</form>
  </div>
  </div>
 
  
</div>
          
        </div>

        <div class="col-md-4 border">
          <h1><?php echo $fname.' ' .$lname?></h1>
          <h4>Email : <?php echo $email?></h4>
          <h4>Address : <?php echo $address?></h4>
          <h4>Contact : <?php echo $contact?></h4>
          <h4>Birthday : <?php echo $bday?></h4>
           
       <br /><br />
          
        </div>
			  
	

       

      </div>

    </div><!-- /.container -->

    <div class="container">
<?php include 'template/ufooter.php'?>
    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>