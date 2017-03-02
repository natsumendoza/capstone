<?php
include '../include/connectdb.php';
	include 'include/check_login.php';
if (!isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
	
	
	
}?>

<?php
		
		$username="";
			if (loggedin())
			{
				$query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$username = $row ['username'];
						
					
					}
				
				}
			else
			{	
			//header("Location:login.php");
		//	exit();
			}
			?>
<?php
//out of stock
$outofstock = "";
$osQuery= mysql_query("SELECT * FROM products WHERE stock=0 ORDER BY id DESC LIMIT 5");
     if (mysql_num_rows($osQuery)==0){
        $outofstock = "<h4 class='alert_error'>No data found</h4>";
    }
    else {
        while($row = mysql_fetch_array($osQuery)){
          $prod_name = $row['product_name'];
          $prod_id = $row ['id'];
          
          /* 
           <div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
            */
           $outofstock .= '<div class="list"><a href="edit_prod.php?id='.$prod_id.'">'.$prod_name.'</a></div><br/>';
          
        }
    }

?>
<?php
//critical
$critical = "";
$cQuery= mysql_query("SELECT * FROM products WHERE stock<=40 and stock>0 ORDER BY id DESC LIMIT 5");
     if (mysql_num_rows($cQuery)==0){
        $critical = "<div class='message'><p>No data found</div>";
    }
    else {
        while($row = mysql_fetch_array($cQuery)){
          $prod_name = $row['product_name'];
          $stock = $row['stock'];
          $prod_id = $row ['id'];
          
          /* 
           <div class="message"><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor.</p>
					<p><strong>John Doe</strong></p></div>
            */
           $critical .= '<a href="edit_prod.php?id='.$prod_id.'">'.$prod_name.' | <strong>Stock: '.$stock.'</strong></a><br/>';
          
        }
    }

?>
<?php
    $sql = mysql_query("SELECT * FROM products ORDER BY id");
	$prodCount = mysql_num_rows($sql); // Counting the database product
	
	$sql = mysql_query("SELECT * FROM products WHERE stock < 40 AND stock > 0");
	$stockCount = mysql_num_rows($sql); // Counting the database product critical
	
	$sql = mysql_query("SELECT * FROM products WHERE stock >=41 AND stock >=41");
	$instockCount = mysql_num_rows($sql); // Counting the database product in-stock
	
	$sql = mysql_query("SELECT * FROM products WHERE stock = 0");
	$outofstock = mysql_num_rows($sql); // Counting the database product out of stock
	
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">-->
   <!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="css/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php'?>
		<?php include 'template/top.php'?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Products <small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

        <div class="row">
    <h2>Product Status</h2>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Stock Critical</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $stockCount ?></span></div>
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Out of Stock</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $outofstock?></span></div>
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Sufficient</h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                <div class="pull-left"><span class="badge"><?php echo $stockCount?></span></div>
                  <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

			   <div class="row">
            <h2>Product List</h2>
            <div class="table-responsive">
            <?php
// to delete
$confirm = "";
	if (isset($_GET['activate']))
	{
		$stat="";
		$id = $_GET['activate'];
			$sql = mysql_query("SELECT * FROM products WHERE id=$id");
			while($row = mysql_fetch_array($sql))
			{           								
			$ext = $row["ext"]; 
			$pname = $row["product_name"]; 
			$stat = $row["status"]; 
			}
				if($stat=='unactive'){
		
                echo  '<div class="alert alert-warning">Do you realy want <strong>'.$pname.'</strong> to be active?<a href="?yesid='.$id.'" class="confirmB">
                    Yes</a> &nbsp <a href="update.php" class="confirmB">No</a></div>';
				}
				if($stat=='active'){
		
                echo  '<div class="alert alert-warning">Do you realy want <strong>'.$pname.'</strong> to be inactive?<a href="?yesid='.$id.'" class="confirmB">
                    Yes</a> &nbsp <a href="update.php" class="confirmB">No</a></div>';
				}
				
				
	}
?>
            <?php
     $stat_activation="";
    if (isset($_GET['yesid']))
	{
		$id = ($_GET['yesid']);
		$sql = mysql_query("SELECT * FROM products WHERE id=$id");
		while($row = mysql_fetch_array($sql))
		{           								
			$ext = $row["ext"]; 
			$pname = $row["product_name"]; 
			$stat = $row["status"]; 
		}
			//delete image
			//unlink('../inc/uploads/'.$id.'.'.$ext);
			//unlink('../inc/uploads/thumbs/'.$id.'.'.$ext);
			$unactive='unactive';
			$active='active';
			if($stat=='active'){				
			mysql_query("UPDATE products SET status='$unactive' WHERE id='$id'");
			 $stat_activation=  '<h4 class="alert_success">Status Inactive <a href="prodlist.php" class="confirmB"> OK</a></h4>';	
			}
			else if($stat=='unactive'){
					mysql_query("UPDATE products SET status='$active' WHERE id='$id'");
			 $stat_activation=  '<h4 class="alert_success">Status Active <a href="prodlist.php" class="confirmB"> OK</a></h4>';	
				
				}
		}
?>
            
              <table class="table table-striped">
<thead>
<tr>
<th width="12%">Image</th>
<th width="21%">Product name</th>
<th width="9%">Stock</th>
<th width="12%">Display</th>
<th width="14%">Status</th>
<th width="14%">Action</th>
</tr>
</thead>


<tbody>
<?php
		if(isset($_get['critical'])){
			$critical = $_get['critical'];
			$sql = mysql_query("SELECT * FROM products WHERE stock < 11 ORDER BY id DESC");
$productCount2 = mysql_num_rows($sql); // count the output amount
if ($productCount2 > 0) 
{
	while($row = mysql_fetch_array($sql))
	
	{ 
            	$id = $row["id"];
		   		$prod_title = $row["product_name"];
			 	$price = $row["price"];
			  	$prod_desc  = $row["details"];
			    $ext  = $row["ext"];
			    $stock=$row['stock'];
			    $category = $row["category"];
				$sub_category = $row["sub_category"];
				$display = $row["status"];
			 
			 
			  
			   if($stock <=10 && $stock > 0){
				 $s_status = '<span style="color: #F00">Critical &nbsp;<a href="list.php?productid='.$id.'" title="Update Stock"><span class="icon-pencil"></a></span>';
				 }
			 else if($stock == 0){
	$s_status = '<span style="color: #333">0 Stock &nbsp;<a title="Update Stock" href="list.php?productid='.$id.'"><span class="icon-pencil"></a></span>';
					 }
				else{
						 $s_status= '<span style="color: #090">Sufficient</span>';
					}
			 
			 
			 echo'<tr>
<td>'.'<img src="../img/product_image/'.$id.'.'.$ext.'" height="50"  width="50"/>'.'</td>
<td>'.$prod_title.'</td>
<td>'.$sub_category.'</td>
<td>'.$stock.'</td>
<td>'.$display.'</td>
<td>'.$s_status.' </td>
<td><a href="edit.php?id='.$id.'">Update</a> | <td><a href="edit.php?id='.$id.'">Display</a> </td>
</tr>';
	}
}
			
			}
			
		if(isset($_get['out_of_stock'])){
			$critical = $_get['out_of_stock'];
			$critical = $_get['critical'];
			$sql = mysql_query("SELECT * FROM products WHERE stock > 10 ORDER BY id DESC");
$productCount2 = mysql_num_rows($sql); // count the output amount
if ($productCount2 > 0) 
{
	while($row = mysql_fetch_array($sql))
	
	{ 
            	$id = $row["id"];
		   		$prod_title = $row["product_name"];
			 	$price = $row["price"];
			  	$prod_desc  = $row["details"];
			    $ext  = $row["ext"];
			    $stock=$row['stock'];
			    $category = $row["category"];
				 $sub_category = $row["sub_category"];
				 $display = $row["status"];
			 
			 
			  
			   if($stock <=10 && $stock > 0){
				 $s_status = '<span style="color: #F00">Critical &nbsp;<a href="list.php?productid='.$id.'" title="Update Stock"><span class="icon-pencil"></a></span>';
				 }
			 else if($stock == 0){
	$s_status = '<span style="color: #333">0 Stock &nbsp;<a title="Update Stock" href="list.php?productid='.$id.'"><span class="icon-pencil"></a></span>';
					 }
				else{
						 $s_status= '<span style="color: #090">Sufficient</span>';
					}
			 
			 
			 echo'<tr>
<td>'.'<img src="../img/product_image/'.$id.'.'.$ext.'" height="50"  width="50"/>'.'</td>
<td>'.$prod_title.'</td>
<td>'.$stock.'</td>
<td>'.$display.'</td>
<td>'.$s_status.' </td>
<td><a href="edit.php?id='.$id.'">Update</a> | <td><a href="edit.php?id='.$id.'">Display</a> </td>
</tr>';
	}
}
			}
			
		else{
			
			$stock='';
	$sql = mysql_query("SELECT * FROM products ORDER BY id DESC");
$productCount2 = mysql_num_rows($sql); // count the output amount
if ($productCount2 > 0) 
{
	while($row = mysql_fetch_array($sql))
	
	{ 
            	$id = $row["id"];
		   		$prod_title = $row["product_name"];
			 	$price = $row["price"];
			  	$prod_desc  = $row["details"];
			    $ext  = $row["ext"];
			    $stock=$row['stock'];
			    $category = $row["category"];
				 $sub_category = $row["sub_category"];
				 $display = $row["status"];
				 if($display=='active')
				 {
					$display_title='Do not Display on gallery';	 
				 }
				 else{
					 $display_title='Display on Gallery';	
					 }
			 
			 
			  
			   if($stock <=10 && $stock > 0){
				 $s_status = '<span style="color: #F00">Critical &nbsp;<a href="list.php?productid='.$id.'" title="Update Stock"><span class="icon-pencil"></a></span>';
				 }
			 else if($stock == 0){
	$s_status = '<span style="color: #333">0 Stock &nbsp;<a title="Update Stock" href="list.php?productid='.$id.'"><span class="icon-pencil"></a></span>';
					 }
				else{
						 $s_status= '<span style="color: #090">Sufficient</span>';
					}
			 
			 
			 echo'<tr>
<td>'.'<img src="../img/product_image/'.$id.'.'.$ext.'" height="50"  width="50"/>'.'</td>
<td>'.$prod_title.'</td>
<td>'.$stock.'</td>
<td>'.$display.' <a title="'.$display_title.'" href="list.php?activate='.$id.'" alt="Display on gallery"><span class="icon-pencil"></a></td>
<td>'.$s_status.' </td>
<td><a href="edit.php?id='.$id.'">Update</a> | <a href="?activate='.$id.'">Display</a> </td>
</tr>';
	}
}
			}	
			
?>

</tbody>

</table>
    			</div>
         
        </div><!-- /.row -->
		
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>
