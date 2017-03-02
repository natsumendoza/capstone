<?php
//database connection

//error_reporting(E_ALL ^ E_DEPRECATED);
$error = "Problem connecting";
mysql_connect('localhost','root','') or die($error);
mysql_select_db('capstone') or die($error);

?>