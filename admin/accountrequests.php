<?php
include '../include/connectdb.php';





?>


<table>
  <thead>
    <th>Request Type</th>
    <th>Email</th>
    <th>Full Name</th>
    <th>Contact Number</th>
    <th>Reason</th>
    <th>Product</th>
    <th>Status</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT * FROM requests");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {
       
      $reqtype = $row['request_type'];
      $email = $row['email'];
      $fullname = $row['full_name'];
      $contact = $row['contact_num'];
      $reason = $row['reason'];
      $product = ($row['product'] == NULL) ? 0 : $row['product'];
      $status = $row['status'];

      echo "
        <tr>
        <td>$reqtype</td>
        <td>$email</td>
        <td>$fullname</td>
        <td>$contact</td>
        <td>$reason</td>
        <td>$product</td>
        <td>$status</td>
        </tr>

      ";


     }
  }

   ?>


</table>