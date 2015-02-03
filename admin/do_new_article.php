<?PHP
require_once 'session.php';
require_once '../db.inc';
require_once "resize_image.php";

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
	// header ( "Location: new_article_success.php?id=" . $article_id );
} else {
	header ( "Location: new_article_fail.php" );
}

// Saves an image to the "media" directory and creates a row in
// article_images table with metadata.
function save_image($con, $article_id, $image_index, $image_file, $image_url) {
	$image_dir = "../media/";
	
	// do nothing and return true if there is no image to save
	if (empty ( $image_file ['name'] ) && empty ( $image_url )) {
		echo "no image to save. image index $image_index <br>";
		return true;
	}
	
	if (! empty ( $image_file ['name'] )) {
		echo "image is not empty<br>";
		$image_extn = pathinfo ( $image_file ['name'], PATHINFO_EXTENSION );
		
		// generate names for the image files
		$orig_file_name = $image_dir . $article_id . "-" . $image_index . "-orig." . $image_extn;
		$resized_file_name = $image_dir . $article_id . "-" . $image_index . "." . $image_extn;
		echo $image_file ['tmp_name'] . "<br>";
		
		// Writes the photo to the server
		if (move_uploaded_file ( $image_file ['tmp_name'], '../media/' . $orig_file_name )) {
			// figure out the width and height of the resized image
			list ( $orig_width, $orig_height, $image_type, $image_attr ) = getimagesize ( $orig_file_name );
			
			$ratio_orig = $orig_width / $orig_height;
			$width = 500;
			$height = 500;
			
			if ($width / $height > $ratio_orig) {
				$width = $height * $ratio_orig;
			} else {
				$height = $width / $ratio_orig;
			}
			
			// resize the image
			// resize_image ( $orig_file_name, $resized_file_name );
			$resizeObj = new resize ( $orig_file_name );
			$resizeObj->resizeImage ( $width, $height, "auto" );
			$resizeObj->saveImage ( $resized_file_name, 100 );
			
			// save image metadata to the database
			$stmt = mysqli_prepare ( $con, "INSERT INTO article_images (article_id, orig_image_name, resized_image_name) VALUES (?, ?, ?)" ) or die ( "Unable to prepare SQL statement to save image metadata" );
			mysqli_stmt_bind_param ( $stmt, "iss", $article_id, $orig_file_name, $resized_file_name ) or die ( "Unable to bind parameters to save image metadata" );
			mysqli_stmt_execute ( $stmt ) or die ( "Unable to execute SQL statement to save image metadata" );
			$rows_inserted = mysqli_stmt_affected_rows ( $stmt );
			
			return true;
		} else {
			return false;
		}
	} elseif (! empty ( $image_url )) {
		// download the image from the URL
		// save the original image as a temporary file
		// resize the image
		// save the image
		
		return true; // or false
	}
	
	return true;
} // end function save_image
  
// function to resize images
function resize_image($orig_file_name, $resized_file_name) {
	
	// *** 1) Initialise / load image
	$resizeObj = new resize ( $orig_file_name );
	
	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj->resizeImage ( 200, 200, 'crop' );
	
	// *** 3) Save image
	$resizeObj->saveImage ( $resized_file_name, 100 );
} // end resize_image

?>