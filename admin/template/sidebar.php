
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="../img/logo.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>PRODUCTS<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="list.php">Listing</a></li>
                <li><a href="add.php">Add Products</a></li>
                <li><a href="update.php">Update Products</a></li>
              </ul>
            </li>
           <li class="dropdown">
              <a href="orders.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>ORDERS<b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li><a href="orders.php">Order List</a></li>
                	 <li><a href="orders.php?status=Pending">Pending</a></li>
                 	<li><a href="orders.php?status=Completed">Completed</a></li>                      
              		<li><a href="orders.php?status=Shipped">Shipping</a></li>
                    <li><a href="orders.php?status=Cancelled">Cancelled</a></li>
                    <li><a href="orders.php?status=Returned">Returned</a></li>
              </ul>
            </li>
             <li><a href="cancel.php"><i class="fa fa-edit"></i>REQUEST CANCEL ORDER</a></li>
            <li><a href="reports.php"><i class="fa fa-edit"></i> REPORTS</a></li>
            <li><a href="inventory.php"><i class="fa fa-font"></i>INVENTORY</a></li>
            <li><a href="messaging.php"><i class="fa fa-font"></i>MESSAGE</a></li>
            <li><a href="backup.php"><i class="fa fa-font"></i>BACKUP DB</a></li>
            <li><a href="accountrequests.php"><i class="fa fa-font"></i>ACCOUNT REQUESTS</a></li>
            <li><a href="../admin/supplier/supplierlist.php"><i class="fa fa-font"></i>SUPPLIER LIST</a></li>
            <li><a href="../admin/author/authorlist.php"><i class="fa fa-font"></i>AUTHOR LIST</a></li>
            
          </ul>