<?PHP
require_once 'session.php';
require_once '../db.inc';

// check Article ID
if (empty ( $_POST ["article_id"] )) {
	die ( "Article ID is required" );
}

$con = db_connect ();

// Delete User Comments for the Article
$stmt = mysqli_prepare ( $con, "DELETE FROM article_comments WHERE article_id = ?" ) or die ( "Unable to prepare SQL statement for User Comments" );
mysqli_stmt_bind_param ( $stmt, "i", $_POST ['article_id'] ) or die ( "Unable to bind parameters for User Comments" );
mysqli_stmt_execute ( $stmt ) or die ( "Unable to execute SQL statement for User Comments" );
$rows_affected = mysqli_stmt_affected_rows ( $stmt );

// Delete Images from the file system
$result = get_sql_result ( $con, "SELECT image_file_name FROM article_images WHERE article_id = " . $_POST ['article_id'] ) or die ( "Unable to query images for Article" );
while ( $row = mysqli_fetch_array ( $result ) ) {
	unlink ( "../media/" . $row ['image_file_name'] );
}

// Delete Images for the Article
$stmt = mysqli_prepare ( $con, "DELETE FROM article_images WHERE article_id = ?" ) or die ( "Unable to prepare SQL statement for Article Images" );
mysqli_stmt_bind_param ( $stmt, "i", $_POST ['article_id'] ) or die ( "Unable to bind parameters for Article Images" );
mysqli_stmt_execute ( $stmt ) or die ( "Unable to execute SQL statement for Article Images" );
$rows_affected = $rows_affected + mysqli_stmt_affected_rows ( $stmt );

// Delete the Article
$stmt = mysqli_prepare ( $con, "DELETE FROM articles WHERE article_id = ?" ) or die ( "Unable to prepare SQL statement for the Article" );
mysqli_stmt_bind_param ( $stmt, "i", $_POST ['article_id'] ) or die ( "Unable to bind parameters for the Article" );
mysqli_stmt_execute ( $stmt ) or die ( "Unable to execute SQL statement for the Article" );
$rows_affected = $rows_affected + mysqli_stmt_affected_rows ( $stmt );

db_disconnect ( $con );

if ($rows_affected > 0) {
	header ( "Location: remove_article_success.php?id=" . $article_id );
} else {
	header ( "Location: remove_article_fail.php" );
}
?>