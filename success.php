<!doctype html>
<?php
	session_start();
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	//var_dump( $_SESSION );
	session_destroy();
	//echo($username.", ".$password);
	echo("Welcome ".$username);
?>
<html>
<head>
<meta charset="utf-8">
<title>welcome</title>
</head>
<body style="width: 100%;height: 100%;display: flex;flex-wrap: wrap;justify-content: center; font-size: 2vw;">
</body>
</html>