<?php
//login check function
ob_start();
session_start();

function loggedin()
{
	if (isset($_SESSION['manager'])||isset($_COOKIE['manager']))
	{
		$loggedin = TRUE;
		return $loggedin;	
		
	}
}
?>