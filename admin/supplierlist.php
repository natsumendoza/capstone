<?php 

	include '../include/connectdb.php';


<table>
  <thead>
    <th>Name</th>
    <th>Product</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT * FROM supplier");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $id = $row['id']; 
      $name = $row['name'];
      $product = $row['product'];

      echo "
        <tr>
          <td>$name</td>
          <td>$product</td>
          <td><a href='/supplier/suppliereditform.php?id=". $id . "&type=edit&name=".$name."&product=".$product."'>Edit</a></td>
          <td><a href='/supplier/processsupplier.php?id=" . $id . "&type=delete'>Delete</a></td>
        </tr>

      ";


     }
  }

   ?>


</table>

 ?>