<?php
$redirect = "index.php";

if (! empty ( $_GET ['redirect'] )) {
	$redirect = $_GET ['redirect'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "../head.php"; ?>
	<title>Login</title>

<!-- Custom styles for this template -->
<link href="login.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<form class="form-signin" role="form" NAME="auth" METHOD="POST"
			ACTION="do_login.php">
			<h2 class="form-signin-heading">Please sign in</h2>
			<input name="user_name" type="email" class="form-control"
				maxlength="45" placeholder="Email address" required autofocus> <input
				name="pswd" type="password" class="form-control"
				placeholder="Password" maxlength="16" required> <label
				class="checkbox"> <!-- <input type="checkbox" value="remember-me">Remember me -->
			</label> <input type="hidden" name="redirect"
				value="<?php echo $redirect; ?>">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign
				in</button>
		</form>

	</div>

	<?php require_once "admin_footer.php"; ?>
</body>
</html>
