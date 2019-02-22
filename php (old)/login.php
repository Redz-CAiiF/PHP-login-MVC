<?php
$configPath = "./config.ini";
$successPath = "../success.php";
$errorPath = "loginView.php";

$popup = "";

if(isset($_POST['submit'])){ //se non è null, quindi ha premuto submit dalla pagina precedente
	session_start();
	require_once 'DAOuser.php';

	$user_username =  $_POST['user-username'];
	$user_password =  hash('sha256',$_POST['user-password']);

	if(count(getUserByUsernamePassword($user_username, $user_password, $configPath)) == 1){//ho un riscontro

		$_SESSION['username'] = $user_username;
		$_SESSION['password'] = $user_password;
		
		var_dump($_REQUEST);
		
		header("Location: ".$successPath); die();
	} else {
		//prepare the popup in case of error login invalid
		$popup = 'Invalid username and password';
		//include the view
		include_once ($errorPath);
	}
} else {
	//includo la view di login
	include_once ($errorPath);
}
?>
