<?php
session_start ();
if (empty ( $_SESSION ['user_name'] )) {
	header ( "Location: login.php?redirect=" . $_SERVER ['PHP_SELF'] );
}

// Session expiration check
$now = time ();

if ($now > $_SESSION ['expire_time']) {
	session_destroy ();
	die ( "Your session has expired! <a href='login.php'>Login here</a>" );
}
?>