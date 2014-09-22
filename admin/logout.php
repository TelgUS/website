<?PHP
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

  <head>
	<?php require_once "../head.php"; ?>
	<title>Logged out</title>
  </head>

  <body>
    <div id="container">
	  <h1>Logged Out</h1>

	  <p>You have been logged out. Click to <a href="login.php">login</a>.</p>
	</div>

	<?php require_once "../footer.php"; ?>
  </body>
</html>