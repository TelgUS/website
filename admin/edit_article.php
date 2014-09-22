<?php
require_once '../db.inc';

if (! empty ( $_GET ['id'] )) {
	$con = db_connect ();
	
	$sql = "SELECT * FROM articles WHERE article_id = " . $_GET ['id'];
	$result = get_sql_result ( $con, $sql );

	while ( $row = mysqli_fetch_array ( $result ) ) {
		$article_title = $row ["title"];
// 		$article_text = $row ['text'];
// 		$start_date = $row ['start_date'];
// 		$end_date = $row ['end_date'];
// 		$comments_allowed_flag = $row ['comments_allowed_flag'];
// 		$video_source = $row ['video_source'];
// 		$video_url = $row ['video_url'];
		$edit_article = true;
	}
	echo "<p>title: $article_title</p>";
	
	db_disconnect ( $con );
}
?>