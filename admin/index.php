<?PHP
require_once 'session.php';
?>

<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Admin Home</title>
</head>

<body>
	<?php require_once 'admin_menu.php';?>

	<div class="container">

		<div class="content">
			<h2>Admin Dashboard</h2>

			<p>Figure out the content that is presented in this dashboard.</p>
		</div>
		<!-- content -->

	</div>
	<!-- container -->

	<?php require_once "admin_footer.php"; ?>

	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_home").addClass("active");
	</script>

</body>
</html>