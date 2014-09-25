<?PHP
require_once 'session.php'; // Check whether the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: New Article: Success</title>
</head>

<body>
	<?php require_once 'admin_menu.php';?>
	<div class="container">

		<div class="content">
			<h1>New Article</h1>

			<div class="alert alert-success" role="alert">
				<p>
					<strong>Done!</strong> Your article is created successfully.
				</p>
			</div>

			<p>
				To view the article you created, <a
					href="/article.php?id=<?php echo $_GET['id']; ?>">click here</a>.
			</p>
			<p>
				To create another article, <a href="/admin/new_article.php">click
					here</a>.
			</p>

		</div>
		<!-- content -->

	</div>
	<!-- container -->

	<?php require_once "admin_footer.php"; ?>

	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_new").addClass("active");
	$("#menu_new_article").addClass("active");
	</script>

</body>
</html>