<?php 

	include '../include/connectdb.php';

?>

<table>
  <thead>
    <th>Name</th>
  </thead>

  <?php

  $sql = mysql_query("SELECT * FROM author");
  $requestCount = mysql_num_rows($sql);

  if ($requestCount > 0) {
     while ($row = mysql_fetch_array($sql)) {

      $id = $row['id']; 
      $name = $row['name'];

      echo "
        <tr>
          <td>$name</td>
          <td><a href='../author/authoreditform.php?id=". $id . "&type=edit&name=".$name."'>Edit</a></td>
          <td><a href='../author/processauthor.php?id=" . $id . "&type=delete'>Delete</a></td>
        </tr>

      ";


     }
  }

   ?>


</table>

<a href="addauthorform.php">Add Author</a>