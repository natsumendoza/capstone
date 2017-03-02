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
            <h1>Inventory <small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

       <div class="row">
       <div class="table-responsive">
        <table class="table table-striped">
          <thead>
                  
    <th>Product name</th>
    <th>Sold</th>
    <th>Stock Now</th>
    <th>Stock Before</th>
     <th>Status</th>
     <th>Date</th>
	 		    </thead>
          <tbody>
  				   <?php 
//Run a select query to get my latest 3 items

include ('../include/connectdb.php');  
$sql = mysql_query("SELECT * FROM inventory ORDER BY pname ASC");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
			 $id = $row['id'];
             $pname = $row["pname"];
			 
			
			 $lessted_value= $row["lessted_value"];
			  $current_stock = $row["current_stock"];
			   $previous_stock = $row["previous stock"];
			    $date = $row["date"];
			 
	 if($current_stock < 10 && $current_stock >=40){
				 $status = '<span style="color: #F00">Critical</span>';
				 }
				 else if($current_stock == 0){
					  $status = '<span style="color: #333">0 Stock</span>';
					 }
					 else{
						 $status = '<span style="color: #090">Sufficient</span>';
						 }
   
	echo '
  <tr>
	    <td>'.$pname.'</td>
    <td>'.$lessted_value.'</td>

    <td>'.$current_stock.'</td>
     <td >'.$previous_stock.'</td>
	  <td>'.$status.'</td>
	 <td>'.$date.'</td>
  </tr>
  ';
    }
} 
else 
{
	$product_list = "You have no products listed in your store yet";
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
