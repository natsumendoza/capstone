<?php 
include 'include/connectdb.php';
if(!empty($_POST)){
		for($i = 1; $i <= $_POST['num_cart_items']; $i++){
			$receiver_email = $_POST['business'];
	    	$address_country = $_POST['residence_country'];
	    	$address_zip = $_POST['address_zip'];
	    	$verify_sign = $_POST['verify_sign'];
			$payer_email = $_POST['payer_email'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$payment_date = $_POST['payment_date'];
			$date=strtotime($_POST['payment_date']);
			$payment_date2=strftime("%Y-%m-%d %H:%M:%S",$date);
			$mc_gross = $_POST['mc_gross'];
			$mc_fee = $_POST['mc_gross_'.$i];
			$txn_id = $_POST['txn_id'];
			$payment_type = $_POST['payment_type'];
			$payment_status = $_POST['payment_status'];
			$txn_type = $_POST['txn_type'];
			$payer_status = $_POST['payer_status'];
			$address_street = $_POST['address_street'];
			$address_city = $_POST['address_city'];
			$address_state = $_POST['address_state'];
			
			$notify_version = $_POST['notify_version'];
			$payer_id = $_POST['payer_id'];
			$mc_currency = $_POST['mc_currency'];

			// Homework - Examples of assigning local variables from the POST variables
			$txn_id = $_POST['txn_id'];
			$payer_email = $_POST['payer_email'];
			$custom = $_POST['custom'];
			$cday = date('d', strtotime ($payment_date));
			$cmonth = date('m', strtotime ($payment_date));
			$cyear= date('Y', strtotime ($payment_date));

			// Place the transaction into the database
			$sql = "INSERT INTO transactions (product_id_array, payer_email, first_name, last_name,month,day,year, payment_date, mc_gross, txn_id, receiver_email, payment_type, payment_status, txn_type, payer_status, address_street, address_city, address_state, address_zip, address_country, notify_version, verify_sign, payer_id, mc_currency,mc_fee) VALUES('$custom','$payer_email','$first_name','$last_name','$cmonth','$cday','$cyear','$payment_date2','$mc_gross','$txn_id','$receiver_email','$payment_type','$payment_status','$txn_type','$payer_status','$address_street','$address_city','$address_state','$address_zip','$address_country','$notify_version','$verify_sign','$payer_id','$mc_currency', '$mc_fee')";
			// echo $sql;
			mysql_query($sql) or die ("unable to execute the query");
		}
		header("Location: user.php?cmd=emptycart");
	}

?>