<?php 

	include '../include/connectdb.php';

	$id = $_GET['id'];
	$type = $_GET['type'];
	$reqtype = $_GET['reqtype'];
	$name = $_GET['name'];

	if ($type == "accept") {
		
		if ($reqtype == "supplier") {
			
			$product = $_GET['product'];

			mysql_query("UPDATE requests SET status='accepted' WHERE id=" . $id) or die("Error!");
			mysql_query("INSERT INTO supplier (name, product) VALUES ('$name', '$product')") or die("Error!");

		} else {


			mysql_query("UPDATE requests SET status='accepted' WHERE id=" . $id) or die("Error!");
			mysql_query("INSERT INTO author (name) VALUES ('$name')") or die("Error!");

		}

	} else {

		mysql_query("UPDATE requests SET status='declined' WHERE id=" . $id) or die("Error!");

	}

 ?>