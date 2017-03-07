<form action="processauthor.php" method="post">

	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
	
	Name: <input type="text" name="name" value="<?php echo $_GET['name']; ?>">

	<input type="submit" name="submit" value="Edit">

</form>