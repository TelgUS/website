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

$con = db_connect ();
$stmt = mysqli_prepare ( $con, "INSERT INTO articles (title, text, start_date, end_date) VALUES (?, ?, ?, ?)" );
mysqli_stmt_bind_param ( $stmt, "ssss", $_POST ['article_title'], $_POST ['article_text'], $start_date, $end_date );
mysqli_stmt_execute ( $stmt );
$rows_inserted = mysqli_stmt_affected_rows ( $stmt );

if ($rows_inserted <= 0) {
	$insert_error = mysqli_error ( $con );
} else {
	$article_id = mysqli_insert_id ( $con );
}

db_disconnect ( $con );

?>

<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: New Article</title>
</head>

<body>
	<div class="container">
		<div class="content">
		<?php require_once 'admin_menu.php';?>

		<?php if ($rows_inserted <= 0) {?>
			<div class="alert alert-danger" role="alert">
				<p>
					<strong>Error!</strong> Failed to create article.  <?php echo $insert_error; ?></p>
			</div>
		<?php } else {?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<strong>Warning!</strong> Do not refresh this page.  If you do, it will create the article again.
			</div>
			<div class="alert alert-success" role="alert">
				<p>
					<strong>Saved!</strong>  <?php echo $rows_inserted; ?> article(s) created successfully.</p>
			</div>

			<p>
				To view the article you created, <a
					href="/article.php?id=<?php echo $article_id; ?>">click here</a>.
			</p>
			<p>To create another article, <a href="/admin/new_article.php">click here</a>.</p>
		<?php } ?>
		</div>
		<!-- content -->
		<?php require_once "../footer.php"; ?>

	</div>
	<!-- container -->


	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_<selection>").addClass("active");
	</script>

</body>
</html>