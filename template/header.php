<header class="app-bar fixed-top brown bg-darker bg-focus-taupe" data-role="appbar" data-flexstyle="sidebar2">
      <div>	  
	 
	  
	  
	  
	 	  
                    <a href="index.php" class="app-bar-element branding">MUTYA<sup> -Publishing-</sup></a>

                    <ul class="app-bar-menu">
					   <li>
                            <a href="" class="dropdown-toggle">Book Library</a>
                            <ul class="d-menu" data-role="dropdown">
                                <li><a href="catalog.php">List</a></li>
                                 <?php
                                        $cat_query = mysql_query("SELECT * FROM category");

                                        while($row = mysql_fetch_array($cat_query))
                                        {
                                            $cat_name = $row['cat_name'];
                                            $cat_id = $row['cat_id'];

                                            echo '<li><a href="catalog.php?category='.$cat_id.'">'.$cat_name.'</a></li>';
                                        }
               ?>
                            </ul>
                        </li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <!-- <li><a href="transactions.php">Transactions</a></li> -->
                        <li><a href="help.php">Help</a></li>
						
						
       <li class="place-right no-hovered bg-darker">
        <form class="form-search margin" action="catalog.php" method="POST">
            <div class="input-control text" style="width: 250px; margin-right: 10px">
                <input type="text" name="searchP" class="search-query placeholder="Search...">
                <button class="button" name="submit" type="submit"><span class="mif-search"></span></button>
            </div>
        </form>
    </li>
                    </ul>

	 
	 
	<div class="app-bar-element place-right no-hover">

<?php 		
	if (loggedin())
			{
				echo '
              <a class="dropdown-toggle fg-white">Welcome <b>'.$fname.'!</b></a>
              <div class="app-bar-drop-container fg-dark bg-grayLighter place-right"
                data-role="dropdown" data-no-close="true">
            <div class="padding20">
                <a href="user.php">Shopping Cart</a>
                <a href="include/logout.php" class="button alert">Logout</a></li>
              </div>
              </div>
            ';
			}
			else
			{
				echo '<a class="dropdown-toggle fg-white"> Welcome <b>Guest! </b><span class="mif-user"></span></a>
        <div class="app-bar-drop-container fg-dark bg-grayLighter place-right"
                data-role="dropdown" data-no-close="true">
            <div class="padding20">
                   <center> 
                  <a  href="login.php" > <button class="button loading-pulse success block-shadow-success text-shadow" type="submit" name="register"  id="notify_btn">Login</button></a>
						<a class="button primary" href="register.php"> Register</a>
                    </div>
					</center>

            </div>
        </div>';
			}
			?>		
	          </div>
                </div>       
</header>
	
       
               
