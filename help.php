<?php
		include 'include/check_login.php';
	  	include 'include/connectdb.php';
		$userid="";
		 
if (loggedin())
			{
				$query = mysql_query("SELECT * FROM users WHERE usn='$_SESSION[username]' ");
					while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$usn = $row ['usn'];
							$fname = $row ['fname'];
					
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
   <?php include 'template/top.php'?>
  <body>

     <?php include 'template/header.php'?>
<div class="page-content">
            <div class="container">
                <div class="no-overflow" style="padding-top: 20px">
				
				
          <h1 class="page-header">Help </small></h1>
<hr class="bg-info">
<br/>

		  
	 <div class="accordion" data-role="accordion">
                            <div class="frame">
                                <div class="heading">How To make an account?<span class="mif-user icon"></span></div>
                                <div class="content">
                                    In order to be a member of this site you need to register for a account, registration of account will require some basic information and verify with your valid email address. to register cllck the Register Tab on the header. 
                                </div>
                            </div>
                            <div class="frame">
                                <div class="heading">How to make transactions?<span class="mif-profile icon"></span></div>
                                <div class="content">
                                    After you register and logged into the system you can do make transactions, just simple choose a products from our gallery and add it to tha cart. from your account you can update quantity and proceed transactions throught paypal. 
                                </div>
                            </div>
                            <div class="frame">
                                <div class="heading">What payment method Should I used?<span class="mif-cc-paypal icon"></span></div>
                                <div class="content">
                                    All users must requred to have paypal in order to make transactions 
                                </div>
                            </div>
							<div class="frame">
                                <div class="heading">I forgot my password. Can is still recover it? <span class="mif-database icon"></span></div>
                                <div class="content">
                                    From login form there is a link for forgotten password. you will need to provide email that existed in our data to keep process retrieving your account.
                                </div>
                            </div>
							<div class="frame">
                                <div class="heading">How can I get my order?<span class="mif-truck icon"></span></div>
                                <div class="content">
                                    Getting your order is be easily delivered after the payment has been made through paypal. you can contact administrator through contact us to followup your order. 
                                </div>
                            </div>
							<div class="frame">
                                <div class="heading">How can i assured that this site is safe to buy products?<span class="mif-lock icon"></span></div>
                                <div class="content">                                  
								We are resposible of monitoring your purchases
								Security is implemented through security module
								Website administrator is always available.
								Convenient personal messaging (PM) on a particular transaction

                                </div>
                            </div>
                        </div>
		  

</div>        
</div>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<hr>


   

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
     <?php include 'template/footer.php'?>
</html>