<?php
$configPath = "./model/config.ini";
$errorPath = "view/registerView.php";
$successPath = "success.php";
$modelProvincie = "model/DAOprovince.php";
$modelUser = "model/DAOuser.php";
//i should import everything that i need in te right controller router
//	EDIT:: i think that i just have to write all the needed links so i can just require with the given liks in the code it-self


$popup = "";

require_once $modelProvincie;
$provincie = getProvinceList($configPath);

if(isset($_POST['submit'])){ //se non è null, quindi ha premuto submit dalla pagina precedente
	session_start();
	require_once $modelUser;
	/* dati utente */
	/*
	user-name
	user-surname
	user-email
	user-username
	user-password
	user-region
	user-address
	user-birthdate
	user-picture
	chosenDB
	*/
	$user_name =  $_POST['user-name'];
	$user_surname =  $_POST['user-surname'];
	$user_email =  $_POST['user-email'];
	$user_username =  $_POST['user-username'];
	$user_password =  hash('sha256',$_POST['user-password']);
	$user_region =  $_POST['user-region'];
	$user_address =  $_POST['user-address'];
	$user_birthdate =  $_POST['user-birthdate'];
	$user_picture =  $_POST['user-picture'];
	
	if(count(getUserByEmail($user_email, $configPath)) >= 1){//ho un riscontro qundi esiste gia un utente con quella mail
		$popup = 'Mail already used';
		//include the view
		include_once ($errorPath);
	} else {
		if(count(getUserByUsername($user_name, $configPath)) >= 1){//ho un riscontro qundi esiste gia un utente con quel username
			$popup = 'Username already used';
			//include the view
			include_once ($errorPath);
		} else {
			//procedo ad inserire l'utente nel database
			insertUser(new User($user_username,$user_email,$user_password,$user_name,$user_surname,$user_region,$user_address,$user_picture,$user_birthdate,"","",""), $configPath);
			
			$_SESSION['username'] = $user_username;
			$_SESSION['password'] = $user_password;
			
			//echo("utente inserito");
			header("Location: ".$successPath); die();//apre la nuova pagina //mmmmmm not sure about this one here
		}
	}
} else {
	//includo la view di register
	include_once ($errorPath);
}
?>