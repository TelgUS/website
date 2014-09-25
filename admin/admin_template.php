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
			<h1>Page Title</h1>

			<p>Page content goes here</p>
		</div>
		<!-- content -->

	</div> <!-- container -->

	<?php require_once "admin_footer.php"; ?>
	
	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_<selection>").addClass("active");
	</script>
</body>
</html>