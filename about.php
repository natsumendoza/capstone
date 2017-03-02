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
   <?php include 'template/top.php' ?>
   <title>About Us
   </title>
  <body>

     <?php include 'template/header.php'?>

    <div class="container">

          <h1 class="page-header">About<small> us </small></h1>
      

      <div class="row">


         
        <div class="">
		
          <center> <img src="img/bali.png" style="height:300px"></center>
        </div>

        <div class="col-md-12">
        <h3 align="center">MUTYA PUBLISHING</h3>
       <p align="justify" style="line-height:24px;">Mutya Publishing is a publishing company that aims to satisfy the educational needs of all Filipino college students. It was founded in 1980 with only a handful of employees. Now it has grown to be one of the leading textbook publishers in the Philippines. It was founded by Ma. Socorro M. Lutao and now it has 3 offices, the main office in Valenzuela City and the other office in Davao City and Cagayan de Oro to serve the Mindanao region.</p>

        <p align="justify" style="line-height:24px;">Mutya Publishing House Inc., is an institution dedicated to meet the academic needs of students in the higher education. Its humble beginning in 1999 proves the legacy of hard work and integrity that see the company through more than a decade after its founding.</p>

        <p align="justify" style="line-height:24px;">Mutya Publishing’s vision is to be the leading publisher of college books with titles in every course in every year level and also to be a frontline academic partner of every educational institution in providing quality education to students in the higher education. Currently, the company releases books in English, Filipino, Science, Finance and Mathematics, Literature, Social Sciences and the Humanities. As a textbook publisher, Mutya Publishing is at the forefront of educating the public specially the youth through the books it publishes. The company makes sure the books are up-to-date with notable authors on its line-up. </p>

        <p align="justify" style="line-height:24px;">Led by people with passion for excellence, authors with highly competent expertise and manpower with strong dedication in place, Mutya Publishing, Inc. has produced around 400 titles across all curricular offerings that address the specific needs of the students.</p>
       </div>



  
 

    </div><!-- /.container -->
    </div><!-- /.container -->

	    <hr>
     <?php include 'template/footer.php'?>
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>
</html>