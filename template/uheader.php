<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
          <a class="navbar-brand" href="index.php"><img src="img/logo.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-left">
          <li class="dropdown">
              <a href="catalog.php" class="dropdown-toggle" data-toggle="dropdown">Book Library</span></a>
              <ul class="dropdown-menu">
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
           <li> <form class="form-search margin" action="catalog.php" method="POST">
    <div class="input-append">
        <input type="text" name="searchP" class="span2 search-query">
        <button type="submit" name="submit" class="btn">Search</button>
    </div><li>
    
</form>
          </ul>
		  <?php 
			
			if (loggedin())
			{
				echo '<a class="btn btn-danger navbar-right" href="include/logout.php">Logout</a>
				
             ';
			}
			?>
        </div><!-- /.navbar-collapse -->
		  
      </div><!-- /.container -->
    </nav>