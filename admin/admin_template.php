<?PHP
session_start ();
if (! (isset ( $_SESSION ['login'] ) && $_SESSION ['login'] != '')) {
	header ( "Location: login.php" );
}
?>

<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Window Title</title>
</head>

<body>
	<div class="container">
		<?php require_once 'admin_menu.php';?>

		<div class="content">
			<h1>Page Title</h1>

			<p>Page content goes here</p>
		</div>
		<!-- content -->
		<?php require_once "../footer.php"; ?>

	</div> <!-- container -->


	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_<selection>").addClass("active");
	</script>
</body>
</html>