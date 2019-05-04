<?php

class RegisterController {
    private $viewRegister = "view/registerView.php";
    private $successPath = "success.php";
    private $modelProvincie = "model/DAOprovince.php";
    private $modelUser = "model/DAOuser.php";

    public function loadPage($popup){
        //carico e ottengo le provincie per il form provincie
        $this->requireDaoProvincie();
        $provincie = getProvince();

        include ($this->viewRegister);
    }

    private function requireDaoUser(){
        require_once $this->modelUser;
    }

    private function requireDaoProvincie(){
        require_once $this->modelProvincie;
    }

    //array("nome" => $user->provincia); provincia parameters
    public function check(){
        if(isset($_POST['submit'])){ //controllo per sicurezza
            //register logic here
            session_start();
            $this->requireDaoUser();
            $this->requireDaoProvincie();
            /* dati utente: user-name, user-surname, user-email, user-username, user-password, user-region, user-address, user-birthdate, user-picture, chosenDB*/
            $user = new User($_POST['user-username'],$_POST['user-email'],hash('sha256',$_POST['user-password']),$_POST['user-name'],$_POST['user-surname'],getProvince(array("nome" => $_POST['user-region']))[0]->codice,$_POST['user-address'],$_POST['user-picture'],$_POST['user-birthdate'],"","","");
            
            if(count(getUsers(array('email'=>$user->getEmail()))) > 0){//ho un riscontro qundi esiste gia un utente con quella mail
                $popup = 'Mail already used';
                //include the view
                $this->loadPage($popup);
            } else {
                if(count(getUsers(array('username'=>$user->getUsername()))) > 0){//ho un riscontro qundi esiste gia un utente con quel username
                    $popup = 'Username already used';
                    //include the view
                    $this->loadPage($popup);
                } else {
                    //procedo ad inserire l'utente nel database
                    $result = insertUser($user);
                    
                    if($result === false){
                        $popup = ':( Something bad happend';
                        $this->loadPage($popup);//include la view register
                    }else {
                        //echo("utente inserito");
                        $_SESSION['username'] = $user->getUsername();
                        $_SESSION['password'] = $user->getPassword();

                        header("Location: ".$this->successPath); die();//apre la nuova pagina
                    }
                }
            }
        } else {
            $this->loadPage("error incorrect program logic"); //non è passato per la logica corretta
            //the passed message is only for debug
        }
    }

}

?>
