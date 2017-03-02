<?php 
if(isset($_POST['update'])){
	$pid=$_POST['pid'];
	$stock=$_POST['stock'];
	  $errors = array();
	if(!preg_replace('#[^0-9]#i', '',$stock))
					{
					
					$errors[] = '<div class="alert alert-error">Please input numbers only</div>';
				
					}
	if(empty($stock)){
		
		$errors[] = '<div class="alert alert-error">Stock Field Cannot be empty</div>';
		}
					if (!empty($errors)) 
									{
										foreach ($errors as $error) 
										{
											echo $error, '<br/>';
										}
									}
		
	

	else{
		$sql = mysql_query("SELECT * FROM products WHERE id='$pid' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $pid = $row["id"];
			$ustock = $row["stock"];
			$pnme=$row['product_name'];
			$update_stock = $ustock + $stock;
			$notice="";
			if($stock>1){$notice='stocks';}else{$notice='stock';}
			
			mysql_query("UPDATE products SET stock='$update_stock' WHERE id='$pid'");
		echo '<div class="alert alert-success"> '.$stock.' Products Added to '.$pnme.' | In-Stock '.$update_stock.' <a href="list.php">View </a></div>';
		}
	}
	else{
		echo 'Invalid id';
		
		}	
	}
		}

?>
<form action="edit.php?id=<?php echo $targetID?>" method="post" >
          <h4 class="modal-title">Add Stock</h4>   
        <fieldset>
       <br />
  	 <div class="form-group">
      <div class="form-group col-lg-12">
      <input type="text" autofocus required name="stock" id="stock" class="col-lg-4 " placeholder="0">
      <input type="hidden" required name="pid" id="pid" class="input-xlarge" value="<?php echo $targetID ?>">
      </div>
    </fieldset>       
<input type="submit" name="update" class="btn btn-primary btn-lg pull-left" value="Update Stock">
</form>