<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once "/head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Window Title</title>
</head>

<body>

	<?php require_once '/menu.php';?>

	<div class="container">
	
		<div class="content">
			<h1>Page Heading</h1>

			<p>Page content goes here.</p>
		</div> <!-- content -->

	</div> <!-- container -->

	<?php require_once "/footer.php"; ?>

	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_<selection>").addClass("active");
	</script>
</body>
</html>