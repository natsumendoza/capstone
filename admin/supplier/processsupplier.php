<?php 

	include '../include/connectdb.php';

	$type = $_GET['type'];
	

	if ($type == 'delete') {

		$id = $_GET['id'];

		$query = mysql_query("UPDATE supplier SET contract='invalid' WHERE id=" . $id);
		if ($query) {
			echo "successfully terminated!";
		} else {
			echo "error!";
		}
		
	} else {

		if (isset($_POST['submit'])) {

			$id = $_POST['id'];
		
			$name = $_POST['name'];
			$product = $_POST['product'];

			$query = mysql_query("UPDATE supplier SET name=" . $name . ", product=".$product." WHERE id=" . $id);
			if ($query) {
				echo "successfully updated!";
			} else {
				echo "error!";
			}

		}


	}


	



 ?>