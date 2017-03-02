<?php 
// Start session first thing in script
// Script Error Reporting
if(!isset($_SESSION)){
    session_start();
}
// Connect to the MySQL database  
//include "connectdb.php";

//include "inc/check_login.php";
?>
<?php 
//      Section 1 (if user attempts to add something to the cart from the product page)
$cart_alert ="";
$output="";
 $stock_error="";
	if (isset($_POST['addcart'])) {
    	
		$pid = $_POST['pid'];
		$qty = $_POST['qty'];
	
		$sql = mysql_query("SELECT * FROM products WHERE id='$pid' LIMIT 1");
		while($row = mysql_fetch_array($sql))
	{
		$pid = $row["id"];
			$prod_title = $row["product_name"];
			 $price = $row["price"];
			  $prod_desc  = $row["details"];
			  $stock  = $row["stock"];
			  $category = $row["category"];
			$timestamp = $row["timestamp"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			  $ext = $row["ext"];
	}
	
	if ( $stock == 0){	
		$stock_error .='<div class="alert alert-error">Sorry!Product is not available</div>';
		}		
	else
	{
		if ( $stock < $qty){	
		$stock_error .='<div class="alert alert-error">Sorry!We only have '.$stock.' in our stocks for <strong>'.$prod_title.'</strong></div>';
		}
		else{
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < $qty) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => $qty));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + $qty)));
					  // inserting to database
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => $qty));
		   }
	}
		}
	//header("location:member.php"); 
   //exit();
}
	}

?>
<?php 
//Section 2 (if user chooses to empty their shopping cart)
$success="";
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
	$success='<div class="alert alert-success"> Transaction Complete Succesfully</div>';
}
?>
<?php 

//paypal unset cart
$successfull="";
if (isset($_GET['paypal']) && $_GET['paypal'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
?>

<?php 
//       Section 3 (if user chooses to adjust item quantity)
 $erroradjust="";
if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    // execute some code
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
	if ($quantity >= 100) { $quantity = 99; }
	if ($quantity < 1) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	
	  $query = mysql_query("SELECT * FROM products WHERE id='$item_to_adjust'");
        while($row = mysql_fetch_array($query))
        { 
           $stock = $row['stock'] ;
		   $product_name = $row["product_name"];
        }//close while
        if ($quantity>$stock)
        {
            $erroradjust .= '<div class="alert alert-error"><strong>'.$product_name.'</strong> only have '.$stock.' Stocks so it Must be less than or equal to ' .$stock.'</div></center>';
            
        }
		else{
	$i = 0;
	foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $item_to_adjust) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
	
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
					  
				  } // close if condition
		      } // close while loop
	} // close foreach loop
}
}
?>

<?php 

//       Section 4 (if user wants to remove all the item from cart)

if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>
<?php 

//       Section 5  render the cart for the user to view on the page)
$modal="";
$added='';
$cart_Total="";
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
$con="";
$each_quantity ="";
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = '<h4 class="alert_warning">Shopping Cart is empty</h4>';
	
} else {
	$base_url="";
	$queryprod=mysql_query("SELECT * FROM payment_option WHERE active='1' LIMIT 1");
						while($row=mysql_fetch_array($queryprod))
							{
								$id=$row['id'];
								$option=$row['option'];
								$merchant=$row['merchant'];
								$base_url=$row['base_url'];
								$active=$row['active'];
								
							}
	
	$added='products added to cart';
	// Start PayPal Checkout Button  
	$added='already added to the cart';       
	$pp_checkout_btn .= '<form action="'.$option.'" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="'.$merchant.'">';
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
		//$size=$each_item['size'];
		$item_id = $each_item['item_id'];
		$sql = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1");
		while ($row = mysql_fetch_array($sql)) {
			$id = $row["id"];
			$product_name = $row["product_name"];
			$prod_desc = $row["details"];
			$price = $row["price"];
			$ext = $row["ext"];
			$date = date ("Y-m-d");
			
					
		}
		
		$pricetotal = $price * $each_item['quantity'];	
		$cartTotal = $pricetotal + $cartTotal;
     
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx		

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx   
		setlocale(LC_MONETARY, "en_US");
        //$pricetotal = money_format("%10.2n", $pricetotal);
		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $product_name . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
		// Create the product array variable
		$cquantity = $each_item['quantity'];
$product_id_array .= "$item_id-".$each_item['quantity'].","; 
		// Dynamic table row assembly
$cartOutput .= "<tr>";
$cartOutput .= ' <td align="center" valign="middle"><img src="img/product_image/'.$id.'.'.$ext.'" width="50" height="50" /></td>';
$cartOutput .= '<td align="center" valign="middle">'.$product_name.'</td>';
$cartOutput .= '<td align="center" valign="middle">&#8369;'.$price.'.00</td>';
$cartOutput .= '<td width="103" align="center" valign="middle">' . $each_item['quantity'] . '</td>';
		
$cartOutput .= '<td><form action="user.php" method="post">
		 <div class="form-group col-lg-6">
		<input name="quantity" type="text" class="form-control" value="" size="3" maxlength="5" /></div>
		<input name="adjustBtn' . $item_id . '" type="submit" class="btn btn-success" value="Change" />
		<input name="item_to_adjust"  type="hidden" value="' . $item_id . '" />
		</form>
		</td>';
$cartOutput .= '<td align="center" valign="middle">&#8369;' . $pricetotal . '.00</td>';
$cartOutput .= ' <td align="center" valign="middle"><form action="user.php" method="post"><input name="deleteBtn' . $item_id . '" type="submit" id="post2" class=" btn  btn-primary" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
$cartOutput .= '</tr>';
$i++; 
		
		
    } 
	setlocale(LC_MONETARY, "en_US");
    //$cartTotal = money_format("%10.2n", $cartTotal);
	if ($cartTotal >=30 ) {
		$discount = $cartTotal * 0.02;
		 $cartTotal = $cartTotal - $discount;
    $cart_Total = '<div id="cart_total"><h5 class="alert-success">Discounted by 2% for Exceeding &#8369;30</h5><br>Cart Total : &#8369;'.$cartTotal. '</div>';
   }
   else{
   $cart_Total = '<div id="cart_total">Cart Total : &#8369;'.$cartTotal. '</div>';}
   
    // Finish the Paypal Checkout Btn
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
	<input type="hidden" name="notify_url" value="'.$base_url.'include/my_ipn.php">
	<input type="hidden" name="return" value="'.$base_url.'user.php?cmd=emptycart">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to The Store">
	<input type="hidden" name="cancel_return" value="'.$base_url.'user.php">
	<input type="hidden" name="lc" value="PHP">
	<input type="hidden" name="currency_code" value="PHP">
<input type="submit" class="btn btn-primary pull-right" name="submit" value="Proceed Checkout">
	</form>
	';


}
session_write_close();
?>