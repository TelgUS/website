<?PHP
require_once 'session.php';
require_once '../db.inc';

// check article title
if (empty ( $_POST ["article_title"] )) {
	die ( "Article Title is required" );
}

// check article text
if (empty ( $_POST ["article_text"] )) {
	die ( "Article Text is required" );
}

// check start date
if (empty ( $_POST ["start_date"] )) {
	$start_date = date ( "Y-m-d" );
} else {
	$start_date = $_POST ["start_date"];
}

// check end date
if (empty ( $_POST ["end_date"] )) {
	$end_date = "9999-12-31";
} else {
	$end_date = $_POST ["end_date"];
}

if (empty ( $_POST ['comments_allowed_flag'] )) {
	$comments_allowed_flag = "N";
} else {
	$comments_allowed_flag = "Y";
}

$con = db_connect ();
$stmt = mysqli_prepare ( $con, "INSERT INTO articles (title, text, start_date, end_date, comments_allowed_flag) VALUES (?, ?, ?, ?, ?)" );
mysqli_stmt_bind_param ( $stmt, "ssss", $_POST ['article_title'], $_POST ['article_text'], $start_date, $end_date, $comments_allowed_flag );
mysqli_stmt_execute ( $stmt );
$rows_inserted = mysqli_stmt_affected_rows ( $stmt );

if ($rows_inserted <= 0) {
	$insert_error = mysqli_error ( $con );
} else {
	$article_id = mysqli_insert_id ( $con );
}

db_disconnect ( $con );

if ($rows_inserted <= 0) {
	Location:
	"article_fail.php";
} else {
	Location:
	"article_success.php?id=" . $article_id;
}

?>