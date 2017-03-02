<?php
//login check function
//session_start();
ob_start();
function user_session()
{
	if (isset($_SESSION['user'])||isset($_COOKIE['user']))
	{
		$user_session = TRUE;
		return $user_session;

	}

}
?>