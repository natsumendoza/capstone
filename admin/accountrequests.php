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

  $sql = mysql_query("SELECT * FROM requests WHERE status='pending'");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $id = $row['id']; 
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
          <td><a href='processrequest.php?id=". $id . "&type=accept&name=". $fullname ."&product=".$product."&reqtype=".$reqtype."'>Accept</a></td>
          <td><a href='processrequest.php?id=" . $id . "&type=decline&name=".$fullname."&product=".$product."&reqtype=".$reqtype."'>Decline</a></td>
        </tr>

      ";


     }
  }

   ?>


</table>