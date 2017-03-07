<?php 
	
	include '../include/connectdb.php';

	$name = $_POST['name'];
	$product = $_POST['product'];

	if (isset($_POST['submit'])) {
		

		$query = mysql_query("INSERT INTO supplier (name, product) VALUES ('$name', '$product')");
		if ($query) {
			echo "Successfully added!";
		} else {
			echo "Error.";
		}

	}


 ?>