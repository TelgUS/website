<?PHP

require_once "../db.inc";

$uname = "";
$pword = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$uname = $_POST['user_name'];
	$pword = $_POST['pswd'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$con = db_connect() or die("<p style='color: red'>Database connection failed</p>");

	$sql = "SELECT * FROM login WHERE user_name = '" . $uname . "' AND pswd = md5('" . $pword . "')";
	echo $sql;
	$result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result);
	echo $sql;

	//====================================================
	//	CHECK TO SEE IF THE $result VARIABLE IS TRUE
	//====================================================

	if ($result) {
		if ($num_rows > 0) {
			session_start();
			$_SESSION['login'] = "1";
			$_SESSION['logon_user'] = $uname;
			header ("Location: index.php");
		} else {
			session_start();
			$_SESSION['login'] = "";
			header ("Location: login_failed.php");
		}	
	} else {
		$errorMessage = "Error logging on (" . mysqli_error($con) . ")";
	}

	db_disconnect($con);

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
      <form class="form-signin" role="form" NAME ="auth" METHOD ="POST" ACTION ="login.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="user_name" type="email" class="form-control" value="<?PHP print $uname;?>" maxlength="45" placeholder="Email address" required autofocus>
        <input name="pswd" type="password" class="form-control" placeholder="Password" value="<?PHP print $pword;?>" maxlength="16" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

	  <P class="bg-danger"><?PHP print $errorMessage;?></P>
	</div>

	<?php require_once "../footer.php"; ?>
  </body>
</html>
