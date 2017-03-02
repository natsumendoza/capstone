<?php 
error_reporting(E_STRICT);
date_default_timezone_set('America/Toronto');
?>

<?php
require_once 'connectdb.php';
									
if ($_SERVER['REQUEST_METHOD'] != "POST") die ("No Post Variables");
// Initialize the $req variable and add CMD key value pair
$req = 'cmd=_notify-validate';
// Read the post from PayPal
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}
// Now Post all of that back to PayPal's server using curl, and validate everything with PayPal
// We will use CURL instead of PHP for this for a more universally operable script (fsockopen has issues on some environments)
$merchant="";
$base_url="";
$option="";
$queryprod=mysql_query("SELECT * FROM payment_option WHERE active='1' LIMIT 1");
						while($row=mysql_fetch_array($queryprod))
							{
								$id=$row['id'];
								$option=$row['option'];
								$merchant=$row['merchant'];
								$base_url=$row['base_url'];
								$active=$row['active'];
								
							}
$url = $option;

$curl_result=$curl_err='';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req)));
curl_setopt($ch, CURLOPT_HEADER , 0);   
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$curl_result = @curl_exec($ch);
$curl_err = curl_error($ch);
curl_close($ch);

//$req = str_replace("&", "\n", $req);  // Make it a nice list in case we want to email it to ourselves for reporting

// Check number 4 ------------------------------------------------------------------------------------------------------------
$product_id_string = $_POST['custom'];
$product_id_string = rtrim($product_id_string, ","); // remove last comma
// Explode the string, make it an array, then query all the prices out, add them up, and make sure they match the payment_gross amount
$id_str_array = explode(",", $product_id_string); // Uses Comma(,) as delimiter(break point)
$fullAmount = 0;
foreach ($id_str_array as $key => $value) {
    
	$id_quantity_pair = explode("-", $value); // Uses Hyphen(-) as delimiter to separate product ID from its quantity
	$product_id = $id_quantity_pair[0]; // Get the product ID
	$product_quantity = $id_quantity_pair[1]; // Get the quantity
	$sql = mysql_query("SELECT price FROM products WHERE id='$product_id' LIMIT 1");
    while($row = mysql_fetch_array($sql)){
		$product_price = $row["price"];
	}
	$product_price = $product_price * $product_quantity;
	$fullAmount = $fullAmount + $product_price;
	//xxxxxxxxxxxxxxxxxxxxxxxxx
//	if ($product_price >= 30){
//		$disc = $product_prize * 0.02;
//		$fullAmount = $fullAmount + $product_price - $disc;
//	}
//	else{
//		$fullAmount = $fullAmount + $product_price;
//	}
//xxxxxxxxxxxxxxxxxxxxxxxxx
}
$fullAmount = number_format($fullAmount, 2);
$grossAmount = $_POST['mc_gross']; 
if ($fullAmount != $grossAmount) {
        $message = "Possible Price Jack: " . $_POST['payment_gross'] . " != $fullAmount \n\n\n$req";
        mail("$merchant", "Price Jack or Bad Programming", $message, "From: $merchant" );
        exit(); // exit script
} 
// END ALL SECURITY CHECKS NOW IN THE DATABASE IT GOES ------------------------------------
////////////////////////////////////////////////////
//Stock Level Update ----------------------------------------------------------------------
$productname="";
$stock_level="";
$stock_update="";
$product_id_string = $_POST['custom'];
$product_id_string = rtrim($product_id_string, ","); // remove last comma
// Explode the string, make it an array, then query all the prices out, add them up, and make sure they match the payment_gross amount
$id_str_array = explode(",", $product_id_string); // Uses Comma(,) as delimiter(break point)

foreach ($id_str_array as $key => $value) {
    
$id_quantity_pair = explode("-", $value); // Uses Hyphen(-) as delimiter to separate product ID from its quantity
$product_id = $id_quantity_pair[0]; // Get the product ID
$product_quantity = $id_quantity_pair[1]; // Get the quantity
$sql = mysql_query("SELECT * FROM products WHERE id='$product_id' LIMIT 1");
    while($row = mysql_fetch_array($sql)){
$stock_level = $row["stock"];
$productname = $row["product_name"];
}

//update the product
$stock_update = ($stock_level - $product_quantity);
$sql = mysql_query("UPDATE products SET stock='$stock_update' WHERE id='$product_id'");

///////////////////////////////////////////////////////////////////////////////////////////
//inserting the data into inventory
$inv = mysql_query("SELECT * FROM inventory WHERE pname='$productname' LIMIT 1");
   if (mysql_num_rows($inv)==0){
       $insert_inv =  mysql_query("INSERT INTO inventory VALUES ('','$product_id','$productname','$product_quantity','$stock_update','$stock_level',now())")or die ("unable to execute the query");
                        }
						else{
							while($row = mysql_fetch_array($inv)){
									$qty = $row["lessted_value"];
									
								}
							$lessted_value = ($qty + $product_quantity);
							  mysql_query("UPDATE inventory SET lessted_value='$lessted_value', current_stock='$stock_update'  WHERE pname='$productname'")or die ("unable to execute the query");
							
							}
							}

//local variables from the POST variables
$gateway = 'PayPal';
$custom = $_POST['custom'];
$payer_email = $_POST['payer_email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payment_date = $_POST['payment_date'];
$date=strtotime($_POST['payment_date']);
$payment_date2=strftime("%Y-%m-%d %H:%M:%S",$date);
$mc_gross = $_POST['mc_gross'];
$payment_currency = $_POST['payment_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$txn_type = $_POST['txn_type'];
$payer_status = $_POST['payer_status'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$address_country = $_POST['address_country'];
$address_status = $_POST['address_status'];
$notify_version = $_POST['notify_version'];
$verify_sign = $_POST['verify_sign'];
$payer_id = $_POST['payer_id'];
$mc_currency = $_POST['mc_currency'];
$mc_fee = $_POST['mc_fee'];

// Homework - Examples of assigning local variables from the POST variables
$txn_id = $_POST['txn_id'];
$payer_email = $_POST['payer_email'];
$custom = $_POST['custom'];
$cday = date('d', strtotime ($payment_date));
$cmonth = date('m', strtotime ($payment_date));
$cyear= date('Y', strtotime ($payment_date));

// Place the transaction into the database
$sql = mysql_query("INSERT INTO transactions (product_id_array, payer_email, first_name, last_name,month,day,year, payment_date, mc_gross, payment_currency, txn_id, receiver_email, payment_type, payment_status, txn_type, payer_status, address_street, address_city, address_state, address_zip, address_country, address_status, notify_version, verify_sign, payer_id, mc_currency, mc_fee) VALUES('$custom','$payer_email','$first_name','$last_name','$cmonth','$cday','$cyear','$payment_date2','$mc_gross','$payment_currency','$txn_id','$receiver_email','$payment_type','$payment_status','$txn_type','$payer_status','$address_street','$address_city','$address_state','$address_zip','$address_country','$address_status','$notify_version','$verify_sign','$payer_id','$mc_currency','$mc_fee')") or die ("unable to execute the query");

mysql_close();
			
			
								  	error_reporting(E_STRICT);
									date_default_timezone_set('America/Toronto');
									require_once('class.phpmailer.php');
									include("class.smtp.php");
								   
								   	$mail             = new PHPMailer();
									$body = '
								<p>Hello <strong>'.$first_name.' '.$last_name.'</strong>,<br />
								</p>
								<p>Thank you for your payment to Mutya</p>
								<p>Please take note of This transaction ID :<span style="color: #00F; font-style: italic;">'.$txn_id.' </span>as our valid transaction number. </p>
								<p>This will be needed in order to monitor the status of your order.Thank you.</p>
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


$mail->SetFrom('essentialitas@gmail.com', 'M');


$mail->AddReplyTo("essentialitas@gmail.com","M");


$mail->Subject    = "Transaction To M Completed";


$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


$mail->MsgHTML($body);


$address = $payer_email;

$mail->AddAddress($address, "M");

									if(!$mail->Send()) 
									{ 
										echo "Mailer Error: " . $mail->ErrorInfo;
									} 
									else 
									{
									//register into database
										header("location:../user.php?cmd=emptycart"); 
									//} //email
									}
				


//mail("$merchant", "NORMAL IPN RESULT YAY MONEY!", $req, "From: $merchant");
//header("location:../success.php?txn=$txn_id"); 
exit();
?>
