<?php 
	
	include '../include/connectdb.php';

	$name = $_POST['name'];

	if (isset($_POST['submit'])) {
		

		$query = mysql_query("INSERT INTO author (name) VALUES ('$name')");
		if ($query) {
			echo "Successfully added!";
		} else {
			echo "Error.";
		}

	}


 ?>