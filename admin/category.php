<?php
include '../include/connectdb.php';
	include 'other/checklogin.php';
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
  <?php include 'other/style.php'?>
    <title>Administrator</title>
  </head>

  <body>

    <div class="margin50"id="wrapper">
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'other/sidebar.php'?>
		<?php include 'other/top.php'?>
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Add Category & Brand<small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

     
<?php
//for categories
include ('../include/connectdb.php');  

if (isset($_POST['category1'])){
    $addCat = addslashes(strip_tags($_POST['addCat']));
    
    $ifexist = mysql_query ("SELECT * FROM category WHERE cat_name='$addCat'");
    if (mysql_num_rows($ifexist)==0){
        $addC = mysql_query ("INSERT INTO category VALUES ('', '$addCat')");
        echo '<div class="alert alert-success">Successfully added</div>';
    }
    else{
         echo '<div class="alert alert-error">Category Already Exist</div>';
    }
}
?>

<h2>Category</h2>
<div class="row col-lg-12 pull-right">
    <div class="form-group col-lg-12">
<form id="contact-form" class="wufoo topLabel page"  method="post"
action="">
  <label for="Field6">Category name</label>
  <input type="text" name="addCat" class="form-control" placeholder="Add category name" size="30" />
  </div>

    <div class="form-group col-lg-12">
	<input id="register" name="category1" value="Add Category" class="btn btn-primary" type="submit"  />
  </div>
  <hr />
</div>
<h2>Brand</h2>
</form>
<?php
//for categories

if (isset($_POST['brand'])){
    $pcategory = addslashes(strip_tags($_POST['pcategory']));
	 $bname = addslashes(strip_tags($_POST['bname']));
    
    $ifexist = mysql_query ("SELECT * FROM brand WHERE brand='$bname'");
    if (mysql_num_rows($ifexist)==0){
        $addC = mysql_query ("INSERT INTO brand VALUES ('', '$bname' ,'$pcategory')");
        echo '<div class="alert alert-success">Successfully added</div>';
    }
    else{
         echo '<div class="alert alert-error">Category Already Exist</div>';
    }
}
?>
<div class="row col-lg-12 pull-right">

    <div class="form-group col-lg-12">
    <form id="contact-form" class="wufoo topLabel page"  method="post"
action="">
      <label for="exampleInputPassword">Category</label>
    	 <select class="form-control" name="pcategory" id="slct1" onchange="populate(this.id,'slct2')">
         	<?php
                                        $cat_query = mysql_query("SELECT * FROM category");

                                        while($row = mysql_fetch_array($cat_query))
                                        {
                                            $cat_name = $row['cat_name'];
                                            $cat_id = $row['cat_id'];

                                            echo '<option value='.$cat_id.'>'.$cat_name.'</option>';
                                        }
               ?>
          </select>                     
    </div>
    <div class="form-group col-lg-12">

  <label for="Field6">Brand name</label>
  <input type="text" name="bname" class="form-control" placeholder="Add Brand name" size="30" />
  </div>

    <div class="form-group col-lg-12">
	<input id="register" name="brand" value="Add Category" class="btn btn-primary" type="submit"  />
  </div>
</div>
</form>
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
