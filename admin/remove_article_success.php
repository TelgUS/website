<?PHP
require_once 'session.php'; // Check whether the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Remove Article: Success</title>
</head>

<body>
	<?php require_once 'admin_menu.php';?>
	<div class="container">

		<div class="content">
			<h1>Remove Article</h1>

			<div class="alert alert-success" role="alert">
				<p>
					<strong>Done!</strong> Removed the article and information related
					to the article.
				</p>
			</div>

			<p>
				<a href="/admin/remove_article.php"><button class="btn btn-danger">Remove
						another Article</button></a>
			</p>

		</div>
		<!-- content -->

	</div>
	<!-- container -->

	<?php require_once "admin_footer.php"; ?>

	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_del").addClass("active");
	$("#menu_del_article").addClass("active");
	</script>

</body>
</html>