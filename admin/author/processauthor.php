<?php 

	include '../include/connectdb.php';

	$type = $_GET['type'];
	

	if ($type == 'delete') {

		$id = $_GET['id'];

		$query = mysql_query("DELETE FROM author WHERE id=" . $id);
		if ($query) {
			echo "successfully deleted!";
		} else {
			echo "error!";
		}
		
	} else {

		if (isset($_POST['submit'])) {
		
			$id = $_POST['id'];
			$name = $_POST['name'];

			$query = mysql_query("UPDATE author SET name=" . $name . " WHERE id=" . $id);
			if ($query) {
				echo "successfully updated!";
			} else {
				echo "error!";
			}

		}


	}


	



 ?>