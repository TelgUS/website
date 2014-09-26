<?php
require_once 'db.inc';
$article_id = "";

if (! empty ( $_GET ['id'] )) {
	$article_id = $_GET ['id'];
} else {
	die ( "<p>No Article ID.  <a href='/'>Go Home</a></p>" );
}

$con = db_connect ();
$result = get_sql_result ( $con, "SELECT * FROM articles WHERE article_id = " . $article_id );
$article_row = mysqli_fetch_array ( $result );

if (empty ( $article_row ['article_id'] )) {
	die ( "<p>The Article ID is invalid. <a href='/'>Go Home</a></p>" );
}

$images_result = get_sql_result ( $con, "SELECT * FROM article_images WHERE article_id = " . $article_id );
$comments_result = get_sql_result ( $con, "SELECT * FROM articles WHERE article_id = " . $article_id );

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once "/head.php"; ?>
	<title><?php echo MY_COMPANY . ": " . $article_row['title']; ?></title>
</head>

<body>

	<?php require_once 'menu.php';?>

	<div class="container">

		<div class="content">
			<h1><?php echo  $article_row['title']; ?></h1>

			<div id="article_text"><?php echo $article_row['text']?></div>
		</div>
		<!-- content -->

	</div>
	<!-- container -->

	<?php require_once "/footer.php"; ?>

	<!-- The below script highlights the menu selection -->
	<script>
	//  No menu needs to be active for this page
	// $("#menu_<selection>").addClass("active");
	</script>

</body>
</html>