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
include '../include/connectdb.php';

//For end date
$month = date('m');
$day = date('d');
$year = date('Y');
$today = date('M j, Y');

$mword = date('M Y');
//today
$todaySales = "";
$ttoday="";
$now = mysql_query("SELECT * FROM transactions WHERE month=$month and year=$year and day=$day");
$tCount2 = mysql_num_rows($now); // Counting the database TRANSACTIONS


$todayQuery= mysql_query("SELECT sum(mc_gross), sum(mc_fee), day, month, year FROM transactions   WHERE month=$month and year=$year and day=$day");
$tCount = mysql_num_rows($todayQuery);
if (mysql_num_rows($todayQuery)==0){
		$ttoday="0";
        $todaySales = "0.00";
}
else {
        while($row = mysql_fetch_array($todayQuery)){
          $sales = $row['sum(mc_gross)'];
          $fee = $row['sum(mc_fee)'];
          $tsales = $sales - $fee;
          $todaySales = $tsales;
        }
}
?>
<?php
//yesterday
$yesterdaySales = "";
$td = date('m/d/Y');
$yesterday = strtotime ( 'yesterday' , strtotime ( $td ) ) ;

$ymonth = date('m', $yesterday);
$yday = date('d', $yesterday);
$yyear = date ('Y', $yesterday);

$yesday= date ('M j, Y', $yesterday);

	
$yesterdayQuery= mysql_query("SELECT sum(mc_gross), sum(mc_fee), day, month, year FROM transactions   WHERE month=$ymonth and year=$yyear
            and day=$yday");

if (mysql_num_rows($yesterdayQuery)==0){
        $yesterdaySales = " 0.00";
}
else {
        while($row = mysql_fetch_array($yesterdayQuery)){
          $sales = $row['sum(mc_gross)'];
          $fee = $row['sum(mc_fee)'];
          
          $ysales = $sales - $fee;
          $yesterdaySales = $ysales;
        }
}
?>
<?php
//week
$weekSales = "";

$date2 = date('m/d/Y');
$date1 = strtotime ( '7 days ago' , strtotime ( $date2 ) ) ;

//For start date
$smonth = date('m', $date1);
$sday = date('d', $date1);
$syear = date ('Y', $date1);

$end = strtotime($date2);
//For end date
$emonth = date('m', $end);
$eday = date('d', $end);
$eyear = date('Y', $end);
$wtotal = "";

$thisweek = mysql_query("SELECT * FROM transactions WHERE (month>=$smonth and month<=$emonth) and (year>=$syear and year<=$eyear)
            and (day>=$sday or day=$eday)");
$weekely = mysql_num_rows($thisweek ); // Counting the database TRANSACTIONS

$startWeek = date ('M j', $date1);
$weekQuery= mysql_query("SELECT sum(mc_gross), sum(mc_fee), day, month, year FROM transactions   WHERE (month>=$smonth and month<=$emonth) and (year>=$syear and year<=$eyear)
            and (day>=$sday or day=$eday)");
if (mysql_num_rows($weekQuery)==0){
        $wtotal = "0.00";
}
else {
        while($row = mysql_fetch_array($weekQuery)){
          $wsales = $row['sum(mc_gross)'];
          $wfee = $row['sum(mc_fee)'];
          
          $wsales2 = $wsales - $wfee;
          $weekSales  = $wsales2 + $wtotal;
        }
}
?>
<?php
$mtotal = "";
$thismonth = mysql_query("SELECT * FROM transactions WHERE month='$month' and year='$year'");
$tmonth = mysql_num_rows($thismonth ); // Counting the database TRANSACTIONS


$monthQuery= mysql_query("SELECT sum(mc_gross), sum(mc_fee), day, month, year FROM transactions   WHERE month='$month' and year='$year'");
if (mysql_num_rows($monthQuery)==0){
        $mtotal = "0.00";
}
else {
        while($row = mysql_fetch_array($monthQuery)){
          $sales = $row['sum(mc_gross)'];
          $fee = $row['sum(mc_fee)'];
          
          $msales = $sales - $fee;
          $mtotal = $msales + $mtotal;
        }
}
?>


<?php
//out of stock
$outofstock = "";
$osQuery= mysql_query("SELECT * FROM products WHERE stock=0 ORDER BY id");
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
	$tsql = mysql_query("SELECT * FROM transactions ORDER BY id");
	$transactions = mysql_num_rows($tsql); // Counting the database product
	
//Product status
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
            <h1>Dashboard <small> Overview</small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">&#8369;<?php echo $todaySales?></p>
                    <p class="announcement-text">Today  Sales</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Transactions <?php echo $tCount2?>
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-check fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">&#8369;<?php echo $weekSales?></p>
                    <p class="announcement-text">Week  Sales</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Transactions <?php echo $weekely?>
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-tasks fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">&#8369;<?php echo $msales?></p>
                    <p class="announcement-text">Month  Sales</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                     Transactions <?php echo $tmonth  ?>                   </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">&#8369;<?php echo $msales?></p>
                    <p class="announcement-text">Total Sales!</p>
                  </div>
                </div>
              </div>
              <a href="#">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                     Transactions <?php echo $transactions ?>
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div><!-- /.row -->

       


        <div class="row">
    <h2>Product Status</h2>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Stock Critical</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $stockCount ?></span></div>
                  <a href="list.php">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Out of Stock</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $outofstock?></span></div>
                  <a href="list.php">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Sufficient</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $stockCount?></span></div>
                  <a href="list.php">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

			   <div class="row">
            <h2>Orders</h2>
            <div class="table-responsive">
            
            
             <table class="table table-striped">
<thead>
<tr>
<th width="15%">TXN : number</th>
    <th width="21%">Customer</th>
    <th width="14%">Status</th>
    <th width="22%">Date Purchased</th>
    <th width="13%">Payment</th>
    <th width="15%">Action</th>
</tr>
</thead>


<tbody>
  <?php
include ('../include/connectdb.php');  
?>
  				 <?php 
	
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
			  $month= $row["month"];
			   $day= $row["day"];
			    $year= $row["year"];
				$cartTotal2="";
			 $datepayment = strftime("%b %d, %Y", strtotime($row["payment_date"]));
			 if($payment_status=='Completed'){
				 $stat=$payment_status;
				 }
			 else{
				 $stat=' '.$payment_status.' <a title="Update Status" href="transactions.php?transactid='.$id.'"><span class="icon-pencil"></span></a>';
				 }
			 
		
 echo'<tr>
    <td height="29">'.$txn_id.'</td>
    <td>'.$firstname.' '. $lastname.'</td>
    <td>'.$stat.'</td>
	 <td>'.$datepayment .'</td>
    <td> &#8369; '.$gross.'</td>
	<td><a  data-toggle="modal" href="#transaction'.$id.'">View</a></td>
	<td><!-- Modal -->
<div class="modal fade" id="transaction'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Transaction Details of : '.$firstname.' '.$lastname.' </h4>
      </div>
      <div class="modal-body">
    
				 Billing Address :<span style="font-size: 14px">'.$street.' '.$city.' '.$state.' '.$country.'</span><br/>
     			 Status : <span style="font-size: 14px">'.$payment_status.'</span><br/>
				 Payer Status : <span style="font-size: 14px">'.$payer_status.'</span><br/>
				 Date of Transaction : <span style="font-size: 14px">'.$datepayment.'</span><br/>
     			 Orders:
      <hr /> <div class="row thead">
               <div class="col-lg-2">Item name</div>
                <div class="col-lg-2">Price</div>
                 <div class="col-lg-2">Quantity</div>
                 <div class="col-lg-2">TPrice</div>
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
               <div class="col-lg-2" style="font-size: 14px">'.$prod_name2.'</div>
                <div class="col-lg-2" style="font-size: 14px"> &#8369;'.$price2.'</div>
                 <div class="col-lg-2" style="font-size: 14px">'.$quan.'</div>
                 <div class="col-lg-2" style="font-size: 14px">&#8369;'.$pricetotal1.'</div>
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
  </tr>';
    }
	
} 
else {
	
	echo  '<tr>
    <td height="29" colspan="6"><h4 class=" alert alert_warning">No transactions are being made yet!</h4>  </tr>';
	}
?>

</tbody>
<?php //include 'template/transaction.php';?>
</table>
    			</div>
         
        </div><!-- /.row -->
		
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
