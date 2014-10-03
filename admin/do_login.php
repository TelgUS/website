<?php
require_once "../db.inc";
$uname = "";
$pword = "";
$redirect = "/admin";
$errorMessage = "";
$session_timeout_minutes = 60;

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	$uname = $_POST ['user_name'];
	$pword = $_POST ['pswd'];
	
	$uname = htmlspecialchars ( $uname );
	$pword = htmlspecialchars ( $pword );
	
	$con = db_connect ();
	
	$sql = "SELECT * FROM login WHERE user_name = '" . $uname . "' AND pswd = md5('" . $pword . "')";
	$result = mysqli_query ( $con, $sql );
	$num_rows = mysqli_num_rows ( $result );
	
	if ($result) {
		if ($num_rows == 1) {
			session_start ();
			
			// set session variables
			$_SESSION ['user_name'] = $uname;
			$_SESSION ['start_time'] = time ();
			// Set the session expiration: 30 minutes from the starting time.
			$_SESSION ['expire_time'] = $_SESSION ['start_time'] + ($session_timeout_minutes * 60);
			
			if (! empty ( $_POST ['redirect'] )) {
				$redirect = $_POST ['redirect'];
			}
			
			header ( "Location: " . $redirect );
		} else {
			header ( "Location: login_fail.php" );
		}
	} else {
		$errorMessage = "Error running query (" . mysqli_error ( $con ) . ")";
	}
	
	db_disconnect ( $con );
}
?>