<?PHP
require_once 'session.php'; // check whether the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Window Title</title>
</head>

<body>
	<?php require_once 'admin_menu.php';?>
	<div class="container">

		<div class="content">
			<h1>Remove Article</h1>
			<p>Enter the Article ID to remove from the system. This will also
				delete all corresponding data - including images, comments, etc.
				This action is not reversible. If you are looking to hide an article
				from the site, edit the article and set an End Date.</p>

			<form class="form-inline" role="form" method="post"
				action="delete_article.php">
				<div class="form-group">
					<label class="sr-only" for="article_id">Article ID</label> <input
						type="text" class="form-control" id="article_id" name="article_id"
						placeholder="Article ID" required>
				</div>
				<button type="submit" class="btn btn-primary">Remove</button>
			</form>
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