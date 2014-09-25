<?php
function db_connect() {
	// Create connection
	$con = mysqli_connect ( "localhost", "telugux", "telugux", "telugux" );
	
	// Check connection
	if (mysqli_connect_errno ()) {
		echo "<p style='color: red;'>Failed to connect to MySQL: " . mysqli_connect_error () . "</p>";
	}
	
	return $con;
} // end db_connect

function db_disconnect($con) {
	mysqli_close ( $con );
} // end db_disconnect

function get_sql_result($con, $sql) {
	$result = mysqli_query ( $con, $sql );
	$sql_error = mysqli_error($con);
	
	if (!empty($sql_error)) {
		echo "<div class='alert alert-danger' role='alert'><strong>SQL ERROR</strong><br><br>\n";
		echo "<code>$sql</code><br><br>\n";
		echo "$sql_error</div>";
		exit();
	}

	return $result;
}

?>