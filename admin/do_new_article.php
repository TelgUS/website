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

// comments allowed flag
if (empty ( $_POST ['comments_allowed_flag'] )) {
	$comments_allowed_flag = "N";
} else {
	$comments_allowed_flag = "Y";
}

// video URL
$video_url = $_POST ['video_url'];

$con = db_connect ();

// Save the Article
$stmt = mysqli_prepare ( $con, "INSERT INTO articles (title, text, start_date, end_date, comments_allowed_flag, video_url, search_keywords) VALUES (?, ?, ?, ?, ?, ?, ?)" ) or die ( "Unable to prepare SQL statement" );
mysqli_stmt_bind_param ( $stmt, "sssssss", $_POST ['article_title'], $_POST ['article_text'], $start_date, $end_date, $comments_allowed_flag, $video_url, $_POST ['search_keywords'] ) or die ( "Unable to bind parameters" );
mysqli_stmt_execute ( $stmt ) or die ( "Unable to execute SQL statement: " . mysqli_error ( $con ) );
$rows_inserted = mysqli_stmt_affected_rows ( $stmt );

if ($rows_inserted <= 0) {
	$insert_error = mysqli_error ( $con );
} else {
	$article_id = mysqli_insert_id ( $con );
}

// Process images
save_image ( $con, $article_id, 1, $_FILES ['image1_file'], $_POST ['image1_url'] ) or die ( "Unable to save image 1" );
save_image ( $con, $article_id, 2, $_FILES ['image2_file'], $_POST ['image2_url'] ) or die ( "Unable to save image 2" );
save_image ( $con, $article_id, 3, $_FILES ['image3_file'], $_POST ['image3_url'] ) or die ( "Unable to save image 3" );

db_disconnect ( $con );

if ($rows_inserted > 0) {
	header ( "Location: new_article_success.php?id=" . $article_id );
} else {
	header ( "Location: new_article_fail.php" );
}

// Saves an image to the "media" directory and creates a row in
// article_images table with metadata.
function save_image($con, $article_id, $image_index, $image_file, $image_url) {
	if (! empty ( $image_url )) {
		// download the image to $image_file
	}
	
	if (! empty ( $image_file ['name'] )) {
		// directory where images will be saved
		$target = "../media/";
		$image_extn = pathinfo ( $image_file ['name'], PATHINFO_EXTENSION );
		$target = $target . "/" . $article_id . "-" . $image_index . "." . $image_extn;
		
		// Writes the photo to the server
		if (move_uploaded_file ( $image_file ['tmp_name'], $target )) {
			// save image metadata to the database
			$stmt = mysqli_prepare ( $con, "INSERT INTO article_images (article_id, image_file_name) VALUES (?, ?)" ) or die ( "Unable to prepare SQL statement to save image metadata" );
			mysqli_stmt_bind_param ( $stmt, "is", $article_id, $target ) or die ( "Unable to bind parameters to save image metadata" );
			mysqli_stmt_execute ( $stmt ) or die ( "Unable to execute SQL statement to save image metadata" );
			$rows_inserted = mysqli_stmt_affected_rows ( $stmt );
			
			return true;
		} else {
			return false;
		}
	}
	
	return true;
} // end function save_image
?>