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

function getUserByEmail($email){
    $query = "SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email";
    $parameters["email"] = $email;
    
    $result =  Database::execute($query, $parameters);
    $return = array();
    foreach($result as $row){
        array_push($return, new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));
    }
    //print_r($return);
    return $return;
}

function getUserByUsername($username){
    $query = "SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE username=:username";
    $parameters["username"] = $username;

    $result = Database::execute($query, $paremeter);
    $return = array();
    foreach($result as $row){
        array_push($return, new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));
    }
    return $return;
}

function getUserByUsernamePassword($username, $password){
    $query = "SELECT  username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE username=:username AND hash=:password";
    $parameters["username"] = $username;
    $parameters["password"] = $password;

    $result = Database::execute($query, $parameters);
    $return = array();
    foreach($result as $row){
        array_push($return, new User($row['username'], $row['email'], $row['hash'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));

    }
    return $return;
}

function insertUser($user){
    $query = "INSERT INTO credential (email,username,hash) VALUES (:email,:username,:hash)";
    unset($parameters);
    $parameters["email"] = $user->getEmail();
    $parameters["username"] = $user->getUsername();
    $parameters["hash"] = $user->getHash();

    if(Database::execute($query, $parameters)){

        $query = "SELECT codiceProvincia FROM region WHERE nomeProvincia=:provincia";
        unset($parameters);
        $parameters["provincia"] = $user->provincia;

        $user_reg = Database::execute($query, $parameters);
        if(count($user_reg)>0){
            $user_reg_code = $user_reg[0]["codiceProvincia"];

            /*$parameters = array(
                ["username"] => $user->getUsername(),
                ["name"] => $user->name,
                ["surname"] => $user->surname,
                ["provincia"] => $user_reg_code,
                ["address"] => $user->address,
                ["picture"] => $user->picture,
                ["birthdate"] => $user->birthdate,
                ["description"] => $user->description,
                ["banner"] => $user->banner
            );*/

            $query = "INSERT INTO profiledata (username,name,surname,provincia,address,picture,birthdate,description,banner) VALUES (:username,:name,:surname,:provincia,:address,:picture,:birthdate,:description,:banner)";
            unset($parameters);
            $parameters["username"] = $user->getUsername();
            $parameters["name"] = $user->name;
            $parameters["surname"] = $user->surname;
            $parameters["provincia"] = $user_reg_code;
            $parameters["address"] = $user->address;
            $parameters["picture"] = $user->picture;
            $parameters["birthdate"] = $user->birthdate;
            $parameters["description"] = $user->description;
            $parameters["banner"] = $user->banner;

            $result = Database::execute($query, $parameters);
            return $result;
        }
    }
    return false;
}

?>