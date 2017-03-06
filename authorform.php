<?php 

	include "/include/connectdb.php";

	if(isset($_POST['submitrequest'])) {


		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
		$contact = $_POST['contact'];
		$reason = $_POST['reason'];

		$query = "INSERT INTO requests (request_type, email, full_name, contact_num, reason, product, status) VALUES ('author', '$email', '$fullname', '$contact', '$reason', NULL, 'pending')";

		if (mysql_query($query)) {
			echo "successfully requested";
		} else {
			echo "Error!";
		}

	}

?>
	
<form action="" method="post"> 
	Email: <input type="text" name="email"> <br>
	Full Name: <input type="text" name="fullname"><br>
	Contact Number: <input type="textarea" name="contact"><br>
	Reason: <textarea name="reason"></textarea><br>

	<input type="submit" name="submitrequest">
</form>
