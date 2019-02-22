<?php
require_once "Database.php";

class User{
    private $email;
    private $username;
    private $hash;
    public $name;
    public $surname;
    public $provincia;
    public $address;
    public $picture;
    //null accepted
    public $birthdate;
    public $description;
    public $banner;
    
    function __construct($username, $email, $hash, $name, $surname, $provincia, $address, $picture, $birthdate, $ageinyears, $description, $banner){
        $this->username = $username;
        $this->email = $email;
        $this->hash = $hash;
        $this->name = $name;
        $this->surname = $surname;
        $this->provincia = $provincia;
        $this->address = $address;
        $this->picture = $picture;
        $this->birthdate = $birthdate;
        $this->ageinyears = $ageinyears;
        $this->description = $description;
        $this->banner = $banner;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    
    public function getHash(){
        return $this->hash;
    }
    public function setHash($hash){
        $this->hash = $hash;
    }
}

function getUserByEmail($email, $pathIni){
    //username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner
    //SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email
    $result =  Database::executeQuery("SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email", array(new Param(":email",$email)), $pathIni);
    $return = array();
    foreach($result as $row){
        //($email, $username, $hash, $name, $surname, $provincia, $address, $picture, $birthdate, $description, $banner)
        //new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']);
        array_push($return, new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));
    }
    //print_r($return);
    return $return;
}

function getUserByUsername($username, $pathIni){
    //username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner
    //SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email
    $result =  Database::executeQuery("SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE username=:username", array(new Param(":username",$username)), $pathIni);
    $return = array();
    foreach($result as $row){
        //($email, $username, $hash, $name, $surname, $provincia, $address, $picture, $birthdate, $description, $banner)
        //new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']);
        array_push($return, new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));
    }
    return $return;
}

function getUserByUsernamePassword($username, $password, $pathIni){
    //username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner
    //SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email
    $result =  Database::executeQuery("SELECT  username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE username=:username AND hash=:password", array(new Param(":username",$username), new Param(":password",$password)), $pathIni);
    $return = array();
    foreach($result as $row){
        //($email, $username, $hash, $name, $surname, $provincia, $address, $picture, $birthdate, $description, $banner)
        //new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']);
        array_push($return, new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));

    }
    return $return;
}

function insertUser($user, $pathIni){
    //username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner
    //SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email
    Database::executeQuery("INSERT INTO credential (email,username,hash) VALUES (:email,:username,:hash)", array(new Param(":email",$user->getEmail()), new Param(":username",$user->getUsername()), new Param(":hash",$user->getHash())), $pathIni);

    $user_reg = Database::executeQuery("SELECT codiceProvincia FROM region WHERE nomeProvincia=:provincia", array(new Param(":provincia",$user->provincia)), $pathIni);
    $user_reg_code = $user_reg[0]["codiceProvincia"];

    Database::executeQuery("INSERT INTO profiledata (username,name,surname,provincia,address,picture,birthdate,description,banner) VALUES (:username,:name,:surname,:provincia,:address,:picture,:birthdate,:description,:banner)", array(new Param(":username",$user->getUsername()),new Param(":name",$user->name),new Param(":surname",$user->surname),new Param(":provincia",$user_reg_code),new Param(":address",$user->address),new Param(":picture",$user->picture),new Param(":birthdate",$user->birthdate),new Param(":description",$user->description),new Param(":banner",$user->banner) ), $pathIni);
    return true;
}

?>