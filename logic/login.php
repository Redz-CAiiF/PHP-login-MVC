<?php
$errorPath = "view/loginView.php";
$successPath = "success.php";
$modelProvincie = "model/DAOprovince.php";
$modelUser = "model/DAOuser.php";
//i should import everything that i need in te right controller router
//	EDIT:: i think that i just have to write all the needed links so i can just require with the given liks in the code it-self


$popup = "";

if(isset($_POST['submit'])){ //se non è null, quindi ha premuto submit dalla pagina precedente
	session_start();
	require_once $modelUser;

	$user_username =  $_POST['user-username'];
	$user_password =  hash('sha256',$_POST['user-password']);

	if(count(getUserByUsernamePassword($user_username, $user_password)) == 1){//ho un riscontro

		$_SESSION['username'] = $user_username;
		$_SESSION['password'] = $user_password;
		
		var_dump($_REQUEST);
		
		header("Location: ".$successPath); die();//mmmmmm not sure about this one here
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
