<?php
require_once "Database.php";

/*
$myCar = new Param();
$myCar->name = ':user';
$myCar->value = 'ciao';
$cars = array($myCar);
*/

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

function getRegionList($pathIni){
    $result =  Database::executeQuery("SELECT nomeprovincia FROM region order by nomeprovincia asc", array(), $pathIni);
    $return = array();
    foreach($result as $row){
        array_push($return, $row['nomeprovincia']);
        //echo '<li>'.$row['nomeprovincia'].'</li>';
    }
    //print_r($return);
    return $return;
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
        //echo '<li>'.$row['nomeprovincia'].'</li>';
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
        //echo '<li>'.$row['nomeprovincia'].'</li>';
    }
    //print_r($return);
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
        //echo '<li>'.$row['nomeprovincia'].'</li>';
    }
    //print_r($return);
    return $return;
}

function insertUser($user, $pathIni){
    //username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner
    //SELECT username, email, hash, name, surname, provincia, address, picture, birthdate, ageinyears, description, banner FROM Credential NATURAL JOIN profiledata WHERE email=:email
    Database::executeQuery("INSERT INTO credential (email,username,hash) VALUES (:email,:username,:hash)", array(new Param(":email",$user->getEmail()), new Param(":username",$user->getUsername()), new Param(":hash",$user->getHash())), $pathIni);

    $user_reg = Database::executeQuery("SELECT codiceProvincia FROM region WHERE nomeProvincia=:provincia", array(new Param(":provincia",$user->provincia)), $pathIni);
    $user_reg_code = $user_reg[0]["codiceProvincia"];
    /*foreach($user_reg as $row){
        echo $row["codiceProvincia"];
    }*/
    Database::executeQuery("INSERT INTO profiledata (username,name,surname,provincia,address,picture,birthdate,description,banner) VALUES (:username,:name,:surname,:provincia,:address,:picture,:birthdate,:description,:banner)", array(new Param(":username",$user->getUsername()),new Param(":name",$user->name),new Param(":surname",$user->surname),new Param(":provincia",$user_reg_code),new Param(":address",$user->address),new Param(":picture",$user->picture),new Param(":birthdate",$user->birthdate),new Param(":description",$user->description),new Param(":banner",$user->banner) ), $pathIni);
    return true;
}


/*function getUserTest($username){
    $result =  Database::executeQuery("SELECT email,username FROM credential WHERE username=:username", array(new Param(":username",$username)));
    foreach($result as $row){
        echo '<p>MAIL:'.$row['email'].' USERNAME:'.$row['username'].'</p>';
    }
}
function addUserTest($username){
    $result =  Database::insertData("INSERT INTO credential (email,username,hash) VALUES ('dos',:username,'5E884898DA28047151D0E56F8DC6292773603D0D6AABBDD62A11EF721D1542D8')", array(new Param(":username",$username)));
    echo $result;
}
function updateUserTest($username){
    $result =  Database::updateData("update credential set email='bob@bob.bob' where username = :username", array(new Param(":username",$username)));
    echo $result;
}
function deleteUserTest($username){
    $result =  Database::deleteData("DELETE FROM credential WHERE username = :username", array(new Param(":username",$username)));
    echo $result;
}*/


/*getUserTest("admin");
addUserTest("bob");
updateUserTest("bob");
deleteUserTest("bob");*/

//$ret = getUserByUsername("admin","./config.ini");
//echo count($ret);

/*foreach($ret as $row){
    echo '<li>'.$row->getUsername().'</li>';
}*/

?>