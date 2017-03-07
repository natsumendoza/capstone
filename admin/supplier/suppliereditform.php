<form action="processsupplier.php" method="post">

	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
	
	Name: <input type="text" name="name" value="<?php echo $_GET['name']; ?>">

	Product: <input type="text" name="product" value="<?php echo $_GET['product']; ?>">

	<input type="submit" name="submit" value="Edit">

</form>