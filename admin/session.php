<?php
session_start ();
if (! empty ( $_SESSION ['login'] )) {
	header ( "Location: login.php?redirect=" . $_SERVER ['PHP_SELF'] );
}
?>