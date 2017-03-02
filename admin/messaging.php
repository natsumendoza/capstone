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
    
   <script language="JavaScript" type="text/javascript">
function ajax_contact(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "include/reply.php";
    var memail = document.getElementById("memail").value;
	var message = document.getElementById("message").value;
    var subject = document.getElementById("subject").value;
      var vars = "memail="+memail+"&message="+message+"&subject="+subject;
	
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("messaging").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("messaging").innerHTML = " Processing...";
}
</script>
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
            <h1>Messaging <small></small></h1>
           <hr>
          </div>
        </div><!-- /.row -->

       <div class="row">
       		<div class="col-lg-12">
          <div class="table-responsive">
<?php
// to delete
$confirm = "";
	if (isset($_GET['delete']))
	{
		$id=$_GET['delete'];
		
		//$id = $_GET['activate'];
			$sql = mysql_query("SELECT * FROM inbox WHERE id=$id");
			while($row = mysql_fetch_array($sql))
			{           								
			$id = $row["id"];
		   		//$firstname = $row["firstname"];
			 	//$lastname = $row["lastname"];
			  	$email  = $row["email"];
				//$subject  = $row["subject"];
			    $message  = $row["message"];
			    $date=$row['date'];
				//$active=$row['active'];
			}
				
		
                echo  '<div class="alert alert-warning">Delete this messge? <a href="?yesid='.$id.'" class="confirmB">
                    Yes</a> &nbsp <a href="messaging.php" class="confirmB">No</a></div>';
				
				
				
	}
?>

<?php
     $stat_activation="";
    if (isset($_GET['yesid']))
	{
		$yid = ($_GET['yesid']);
		mysql_query("DELETE FROM inbox WHERE id='$yid'");
		echo  "<div class='alert alert-success'>Deleted succesfully</div>";
		}
?>


<?php 
if(isset($_GET['getmessage'])){
	$mid=$_GET['getmessage'];
		$queryprod=mysql_query("SELECT * FROM  inbox WHERE id='$mid' LIMIT 1");
		echo '<a href="messaging.php">Back</a>';
		while($row=mysql_fetch_array($queryprod))
		{
				$id = $row["id"];
		   		//$firstname = $row["firstname"];
			 	//$lastname = $row["lastname"];
			  	$email  = $row["email"];
				$subject  = $row["subject"];
			    $message  = $row["message"];
			    $date=$row['date'];
				//$active=$row['active'];
				
		}
		
	echo '<div class="page-header p"><strong>'.$email.'</strong> | Date : '. $date.'</div>
	<h4>'.$subject.'</h4>
<p class="p">'.$message.'</p>
<a data-toggle="modal" class="btn btn-primary" href="#reply">Reply</a>

<!-- Reply Modal -->
<div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Reply to '.$email .' </h4>
      </div>
      <div class="modal-body">
	  <div id="messaging"></div>
		            <form action="javascript:ajax_contact();" method="post">
             <fieldset>
    <div class="form-group col-lg-12">
      <label for="exampleInputEmail">Email address</label>
      <input type="email" class="form-control" name="memail" readonly="readonly" id="memail" value="'.$email.'" placeholder="Enter email">
    </div>
	<div class="form-group col-lg-12">
      <label for="exampleInputEmail">Subject</label>
      <input type="text" class="form-control" name="subject" id="subject" value="Re: '.$subject.'" placeholder="Subject">
    </div>
    <div class="form-group col-lg-12">
      <label for="exampleInputPassword">Your message</label>
     <textarea class="form-control" name="message" rows="6" id="message" placeholder="message"></textarea>
    </div>
  </fieldset>
  <div class="modal-footer">
         <input type="submit" name="myBtn" class="btn btn-primary btn-lg pull-left"  value="Send Message">
        </div>
        </form>
        </div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --><!-- /.Reply modal -->


';
	}
	
else{
	echo '<table class="table table-striped">
<thead>
<tr>
<th align="center">&nbsp;</th>
<th align="center">User</th>
<th align="center">Subject</th>
<th align="center">Date</th>
<th align="center">Action</th>
</tr>
</thead>


<tbody>
';
		$sql = mysql_query("SELECT * FROM inbox ORDER BY id DESC");
$productCount2 = mysql_num_rows($sql); // count the output amount
if ($productCount2 > 0) 
{
	while($row = mysql_fetch_array($sql))
	
	{ 
            	$id = $row["id"];
		   		//$firstname = $row["firstname"];
			 	//$lastname = $row["lastname"];
			  	$email  = $row["email"];
			    $message  = $row["message"];
			    $date=$row['date'];
				$subject=$row['subject'];
				//$active=$row['active'];

			
					 
					 
					 $display='<tr>
					 <td class="p"><span class="icon-folder-open"></span></td>
<td  class="p">'.$email.'</td>
<td  class="p">'.$subject.'</td>
<td  class="p">'.$date.'</td>
<td  class="p"><a href="messaging.php?getmessage='.$id.'"><span class="icon-eye-open"></span>View</a> | <a href="messaging.php?delete='.$id.'"><span class="icon-trash"></span>Delete</strong></a>   </td>
</tr>';	
					 

			 
			 echo $display;
			 
	}
}
echo '</tbody>
</table>';
			
	}
?></div>
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
