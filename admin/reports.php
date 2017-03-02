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
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
   <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
  </script>

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
            <h1>Reports <small></small></h1>
            <div class="col-lg-10 pull-right" style="margin-top:-40px;">
            <form action="" method="post"><label for="from">From</label>
			<input type="text" id="from" name="date2" />
			<label for="to">To</label>
			<input type="text" id="to" name="date1" /> 
			<input type="submit" name="submit" class="btn btn-primary" value="filter"/> </form>






</div>


           <hr>
          </div>
        </div><!-- /.row -->

       <div class="row">
       <h3>SALES REPORT SUMMARY</h3>
	   <!------------------------------------------------------------------------------------>
<?php
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
	   <!------------------------------------------------------------------------------------>
       <?php
$output = '';
$dialog = "";
$date2 = date('m/d/Y');
$date1 = strtotime ( '-7 day' , strtotime ( $date2 ) ) ;

//For start date
$smonth = date('m', $date1);
$sday = date('d', $date1);
$syear = date ('Y', $date1);


$end = strtotime($date2);
//For end date
$emonth = date('m', $end);
$eday = date('d', $end);
$eyear = date('Y', $end);
$totalGross =""; 

if (isset($_POST['submit'])){
    $endD = addslashes(strip_tags($_POST['date1']));
    $startD = addslashes(strip_tags($_POST['date2']));
    
    $endD = strtotime($endD);
    $startD = strtotime($startD);
    $emonth = date('m', $endD);
    $eday = date('d', $endD);
    $eyear = date('Y', $endD);
    
    $smonth = date('m', $startD);
    $sday = date('d', $startD);
    $syear = date('Y', $startD);
    
     $perday= mysql_query("SELECT sum(mc_gross), sum(mc_fee), day, month, year, product_id_array, COUNT(day) FROM transactions   WHERE (month>=$smonth and month<=$emonth) and (year>=$syear and year<=$eyear)
            and (day>=$sday and day<=$eday)GROUP BY day ORDER BY id DESC");
    
    if (mysql_num_rows($perday)==0){
        $output = '<tr><td colspan="5"  class="alert alert-error">No data found</td></tr>';
    }
    else {
        while($row = mysql_fetch_array($perday)){
          $sales = $row['sum(mc_gross)'];
          $day = $row['day'];
          $month = $row['month'];
          $year = $row['year'];
          $numOrder = $row['COUNT(day)'];
          $fee = $row['sum(mc_fee)'];
          
          $payment_gross = $sales - $fee;
                
    
                  
         $output .= "<tr>";
         $output .= '<td>'.$month.'-'.$day.'-'.$year.'</td>';
         $output .= '<td>'.$numOrder.'</td>';
         $output .=   '<td>&#8369;'.$sales.'</td>';
         $output .= '<td>&#8369;'.$fee.'</td>';
         $output .= '<td>&#8369; '.$payment_gross.'</td></tr>';
         
         $totalGross = $payment_gross + $totalGross;
        
        }
        
        
        
    }
    
}
else
{
    //Initial output pag vinisit ang report page
    //Generates report grouped by day
    $perday= mysql_query("SELECT sum(mc_gross), sum(mc_fee), day, month, year, product_id_array, COUNT(day) FROM transactions   WHERE (month>='$smonth' and month<='$emonth') and (year>='$syear' and year<='$eyear') 
            and (day>=$sday or day<=$eday)GROUP BY day ORDER BY id DESC");

    if (mysql_num_rows($perday)==0){
        $dialog = '<div class="alert alert-error">No data found</div>';
    }
    else {
        while($row = mysql_fetch_array($perday)){
          $sales = $row['sum(mc_gross)'];
          $day = $row['day'];
          $month = $row['month'];
          $year = $row['year'];
          $numOrder = $row['COUNT(day)'];
          $fee = $row['sum(mc_fee)'];
          
          $payment_gross = $sales - $fee;
                
          $output .= "<tr>";
          $output .= '<td>'.$month.'-'.$day.'-'.$year.'</td>';
         $output .= '<td>'.$numOrder.'</td>';
         $output .=   '<td>&#8369; '.$sales.'</td>';
         $output .= '<td>&#8369;'.$fee.'</td>';
         $output .= '<td>&#8369; '.$payment_gross.'</td></tr>';
       
         $totalGross = $payment_gross + $totalGross;
          
        }
       
      
        
        
    }
}
?>
<div class="table-responsive">
<table class="table table-striped">
          <thead>
  <tr>
    <th>Date</th>
   <th>Number of Orders</th>
   <th>Payment Gross</th>
   <th>Paypal Fee</th>
   <th>Total Payment</th>
    
  </tr>
  </thead>
 <?php echo $output; ?>

</table>
 </div>  
  
       <h3>SALES REPORT OVERVIEW</h3>
       
        <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                  
     <th>Date</th>
  <th>Customer name</th>
    <th>Email</th>
    <th>Amount PAID</th>
	 		    </thead>
          <tbody>
     <?php

// For Friendly printing
$today = date("M d, Y");


$month = date('m');
$day = date('d');
$year = date('Y');
$today = date('M j, Y');
$output = "";
$todayQuery= mysql_query("SELECT * FROM transactions ORDER BY id");
			
			if (mysql_num_rows($todayQuery)==0){
         $output .= "<tr ><td colspan='5'><div class='alert alert-warning'>No order for this date ($month/$day/$year)</div></td></tr>";
}
else {
        while($row = mysql_fetch_array($todayQuery)){
          $id = $row['id'];
          $first_name = $row['first_name'];
		  $last_name = $row['last_name'];
		  $payer_email = $row['payer_email'];
		  $mc_gross = $row['mc_gross'];
		  $mc_fee = $row['mc_fee'];
		  $day = $row['day'];
          $month = $row['month'];
          $year = $row['year'];
		   if($mc_fee==''){
			    $fee=3;
			}
			else
			{
				 $fee=$mc_fee;
			}
		  
		   $output .= "<tr>";
          $output .= '<td>'.$month.'/'.$day.'/'.$year.'</td>';
          $output .= '<td>'.$first_name.' '.$last_name.'</td>';
         $output .=   '<td> '.$payer_email.'</td>';
         $output .= '<td> &#8369;'.$mc_gross.'</td>';
          
 
        }
}

 ?>
 <?php echo $output ?>
      </tbody>
      </table>
      <hr />
      <?php 
 include ('../include/connectdb.php'); 
 //echo $error_dialog;
	if (isset($_GET['deactivate']))
	{
		$uid = $_GET['deactivate'];
		$dialog= "";
		$email="";
		$sql = mysql_query("SELECT * FROM users WHERE id=$uid");
		while($row = mysql_fetch_array($sql))
									{           								
										$code = $row["code"]; 
										$email = $row["email"];
									}
		?>
		
			<?php echo $dialog; ?> 
			<div class="alert alert-warninf">Are you sure you want to deactivate account: <?php echo $email ?> ? <a href="reports.php?deactivateid=<?php echo $uid; ?>">Yes</a> &nbsp <a href="reports.php">No</a></div><!-- allert -->
				
	<?php
	}
?>
<?php
  
								if (isset($_GET['deactivateid']))
								{
								 $deactivateid = ($_GET['deactivateid']);
								
								
								mysql_query("UPDATE users SET activate=0 WHERE id='$deactivateid'");
									$dialog = "<div class='alert alert-success'>User acount deactivated</div>";
									?>
								<?php echo $dialog; ?><!--div close-->
									<?php
								}
								
								
?>



 <?php
	if (isset($_GET['userid']))
	{
		$id = $_GET['userid'];
		$dialog= "";
		$sql = mysql_query("SELECT * FROM users WHERE id=$id");
								
									while($row = mysql_fetch_array($sql))
									{           								
										$code = $row["code"]; 
										$email = $row["email"];
									}
		?>
		
			<?php echo $dialog; ?> 
			<div class="alert alert-warning">Are you sure you want to activate  : <?php echo $email ?> <a href="reports.php?yesid=<?php echo $id; ?>">Yes</a> &nbsp <a href="reports.php">No</a></div><!-- allert -->
				
	<?php
	}
?>
<?php
include ('../include/connectdb.php');  
								if (isset($_GET['yesid']))
								{
								 $id = ($_GET['yesid']);
								$sql = mysql_query("SELECT * FROM users WHERE id=$id");
								
									while($row = mysql_fetch_array($sql))
									{           								
										$code = $row["code"]; 
										$email = $row["email"];
									}
									//delete image
									//unlink('../inc/uploads/'.$id.'.'.$ext);
									//unlink('../inc/uploads/thumbs/'.$id.'.'.$ext);
									
								//send activation email
									error_reporting(E_STRICT);
									date_default_timezone_set('America/Toronto');
									require_once('../include/class.phpmailer.php');
									include("../include/class.smtp.php");
									$queryprod=mysql_query("SELECT * FROM payment_option WHERE active='1' LIMIT 1");
						while($row=mysql_fetch_array($queryprod))
							{
								$id=$row['id'];
							
								$base_url=$row['base_url'];
								
								
							}
									$mail             = new PHPMailer();
									$body = 'Hello $username, <br/> <br/> Administrator was send you this mail for your account to be activated<br/> <a href="'.$base_url.'include/activate.php?code='.$code.'">href="'.$base_url.'include/activate.php?code='.$code.'"</a><br/><br/>Thank You
                                                                                <br/><br/>-Clothing Line Apparel
';

									$mail->IsSMTP(); // telling the class to use SMTP
									$mail->Host       = "smtp.gmail.com"; // SMTP server
									$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           
									// 1 = errors and messages
                                           
									// 2 = messages only


									$mail->SMTPAuth   = true;                  // enable SMTP authentication

									$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

									$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

									$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username   = "essentialitas@gmail.com";  // GMAIL username

$mail->Password   = "slvmimtrvpnspeqm";            // GMAIL password


$mail->SetFrom('essentialitas@gmail.com', 'Theresita | Music and Sports Supply');


$mail->AddReplyTo("essentialitas@gmail.com","Theresita | Music and Sports Supply");


$mail->Subject    = "Reply to Inquiry";


$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


$mail->MsgHTML($body);


$address = $email;

$mail->AddAddress($address, "Clothing Line Apparel");

					
									if(!$mail->Send()) 
									{ 
										echo "Mailer Error: " . $mail->ErrorInfo;
									} 
									else 
									{
									//register into database
					
					echo '<div class="alert alert-success">account activation was successfully sended to email ('.$email.') </div>';
											
									} //email
			
 										 
		
									?>
								<?php echo $dialog; ?><!--div close-->
									<?php
								}
								
								
?>
 <h3>USERS REPORT OVERVIEW</h3>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
    <th >Customer</th>
    <th>email</th>
    <th >birthday</th>
    <th>contact</th>
     <th>Status</th>
    <th>Action</th>
</tr>
</thead>


<tbody>
  <?php
include ('../include/connectdb.php');  
?>
  				<?php
			
			 $psql = mysql_query("SELECT * FROM users ORDER BY id DESC");
$productCount = mysql_num_rows($psql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($psql)){ 
			 $id = $row['id'];
             $fname =  $row["fname"];
			 $lname= $row["lname"];
			  $birthday = $row["birthday"];
			 $address = $row["address"];
			 $contact = $row["contact"];
			 $email= $row["email"];
			 $ext= $row["ext"];
			 $date= $row["date"];
			$activate=  $row["activate"];
			 
			  if ($activate == 1){
				 $status = 'Confirmed';
				 }
				 else{
					$status = 'Unconfirm'; 
					 }
			 if ($activate == 1){
				 $view = $view = '<a href = "reports.php?deactivate='.$id.'">Deactivate</a>'; ;
				 }
				 else{
					$view = '<a href = "reports.php?userid='.$id.'">Activate</a>'; 
					 }
			
			 
			 
			 echo'<tr>
    <td>'.$fname.' '. $lname.'</td>
    <td > '.$email.'</td>
	 <td > '.$birthday.'</td>
    <td>'.$contact.'</td>
	 <td >'.$status.'</td>
	<td >'.$view.'</td>
  </tr>';
	}
}
		
else {
	
	echo  '<tr>
    <td height="29" colspan="6"><h4 class="alert_warning">No ORDER YET!</h4>  </tr>';
	}
?>
</tbody>

</table>
        </div><!-- /.row -->
     
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
   
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
 

  </body>
</html>
