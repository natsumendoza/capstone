<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
		$userid="";
		 
if (loggedin())
			{
				$query = mysql_query("SELECT * FROM users WHERE email='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$email = $row ['email'];
						$fname = $row ['fname'];
						$lname = $row ['lname'];
						$address = $row ['address'];
						$bday = $row ['birthday'];
						$contact = $row ['contact'];
					
					}
				
				}
			else
			{	
			header("Location:login.php");
		exit();
			}
?>
<!DOCTYPE html>
<html lang="en">
   <?php include 'template/top.php'?>
   <?php include 'include/cart.php'?>
  <body>
<script language="JavaScript" type="text/javascript">
function ajax_resetpass(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "include/reset.php";
    var oldPw = document.getElementById("oldPw").value;
    var newPw = document.getElementById("newPw").value;
	var verifyPw = document.getElementById("verifyPw").value
     var vars = "oldPw="+oldPw+"&newPw="+newPw+"&verifyPw="+verifyPw;
	
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("status").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("status").innerHTML = "<img src='img/ajax-loader.gif' />";
}
</script>
     <?php include 'template/header.php'?>

    <div class="container">

      <div class="row">

        <div class="col-lg-12">
          <h1 class="page-header">Welcome! <small> <?php echo $fname?> </small></h1>
        </div>

      </div>

      <div class="row">
        <div class="col-md-7">
        
        <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="in active"><a href="#home" data-toggle="tab">Shopping Cart</a></li>
  <li><a href="#profile" data-toggle="tab">Change Password</a></li>
  <li><a href="#messages" data-toggle="tab">Update Profile</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
  <?php echo $success?>
  <div class="table-responsive">
  		  <table class=" table table-bordered">
          <thead>
           		<tr>
                	<th align="center" valign="middle">IMAGE</th>
                    <th align="center" valign="middle">ITEM NAME</th>
                    <th align="center" valign="middle">PRICE</th>
                    <th align="center" valign="middle">QTY</th>
                    <th align="center" valign="middle">TOTAL</th>
                    <th align="center" valign="middle">ACTION</th>
                </tr>
                
           </thead>
           <tbody>
          <?php echo  $erroradjust?>
           		<?php echo $cartOutput?>
           </tbody>
           </table>
           <div class="span8"><div class="span5"><a class="btn btn-success pull-left" href="gallery.php"><span class="icon-arrow-left"></span> Continue shopping</a></div> <div class="span2"><?php  echo $pp_checkout_btn?></div></div>
           <div class="span3"><h4 align="center"><?php echo $cart_Total ?></h4></div>
       		 </div>
  
  </div>
  <div class="tab-pane" id="profile">
  <div id="status"></div><!--for login status output--> 
  			<form role="form" method="POST" action="javascript:ajax_resetpass()">
	               <div class="form-group col-lg-5">
	               <label for="exampleInputPassword">Current Password</label>
      <input type="password" name="oldPw" id="oldPw"  class="form-control"  placeholder="Current Password">
	              </div>
	             
                  <div class="form-group col-lg-5">
	               <label for="exampleInputEmail">Confirm password</label>
      <input type="password" name="verifyPw" id="verifyPw" class="form-control" placeholder="Confirm password">
	              </div>
                 
                   <div class="form-group col-lg-5">
                    <hr>
	               <label for="exampleInputEmail">New Password</label>
      <input  type="password" name="newPw" id="newPw"  class="form-control" placeholder="Enter New password">
	              </div>
	              <div class="clearfix"></div>
	              
	              <div class="form-group col-lg-12">
	                <input type="hidden" name="save" value="contact">
	                <button type="submit" class="btn btn-primary" name="register">Submit</button>
	              </div>
            
            </form>
  </div>
  <div class="tab-pane" id="messages">
  
  This tab is under constract
  </div>
</div>
          
        </div>

        <div class="col-md-5 border">
          <h1><?php echo $fname.' ' .$lname?></h1>
          <h4>Email : <?php echo $email?></h4>
          <h4>Address : <?php echo $address?></h4>
          <h4>Contact : <?php echo $contact?></h4>
          <h4>Birthday : <?php echo $bday?></h4>
           
       <br /><br />
          
        </div>
			  
	

       

      </div>

      <hr>
 

    </div><!-- /.container -->

    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; Company 2013</p>
          </div>
        </div>
      </footer>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>