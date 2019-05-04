<?php
require_once "Database.php";

class User{

    /*
    +-------------+--------------+------+-----+-----------+-------------------+
    | Field       | Type         | Null | Key | Default   | Extra             |
    +-------------+--------------+------+-----+-----------+-------------------+
    | email       | varchar(100) | NO   | UNI | NULL      |                   |
    | username    | varchar(100) | NO   | PRI | NULL      |                   |
    | password    | varchar(255) | NO   |     | NULL      |                   |
    | name        | varchar(100) | NO   |     | NULL      |                   |
    | surname     | varchar(100) | NO   |     | NULL      |                   |
    | provincia   | int(11)      | NO   | MUL | NULL      |                   |
    | address     | varchar(100) | NO   |     | NULL      |                   |
    | picture     | varchar(300) | NO   |     | NULL      |                   |
    | birthdate   | date         | NO   |     | curdate() |                   |
    | ageinyears  | tinyint(4)   | YES  |     | NULL      | VIRTUAL GENERATED |
    | description | varchar(500) | YES  |     | NULL      |                   |
    | banner      | varchar(50)  | YES  |     | NULL      |                   |
    +-------------+--------------+------+-----+-----------+-------------------+
    */

    private $email;
    private $username;
    private $password;
    public $name;
    public $surname;
    public $provincia;
    public $address;
    public $picture;
    //null accepted
    public $birthdate;
    public $description;
    public $banner;

    function __construct($username, $email, $password, $name, $surname, $provincia, $address, $picture, $birthdate, $ageinyears, $description, $banner){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
    
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($hash){
        $this->password = $hash;
    }
}

function insertUser($user){
    //ho ottenuto il codice della provincia, proseguo.
    $query = "INSERT INTO User(email,username,password,name,surname,provincia,address,picture,birthdate,description,banner) VALUES (:email,:username,:password,:name,:surname,:provincia,:address,:picture,:birthdate,:description,:banner)";

    unset($parameters);
    $parameters = array(
        "username" => $user->getUsername(),
        "email" => $user->getEmail(),
        "password" => $user->getPassword(),
        "name" => $user->name,
        "surname" => $user->surname,
        "provincia" => $user->provincia,
        "address" => $user->address,
        "picture" => $user->picture,
        "birthdate" => $user->birthdate,
        "description" => $user->description,
        "banner" => $user->banner
    );

    if(Database::execute($query, $parameters)){
        //ho inserito l'utente
        return true;
    }
    //non ho inserito l'utente
    return false;
}


function getUsers($parametersValues){
    $queryColums = ["username",
                    "email",
                    "password",
                    "name",
                    "surname",
                    "provincia",
                    "address",
                    "picture",
                    "birthdate",
                    "ageinyears",
                    "description",
                    "banner"];
    
    $queryTable = "user";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, null);
    $users = array();
    foreach($result as $row){
        array_push($users, new User($row['username'], $row['email'], $row['password'], $row['name'], $row['surname'], $row['provincia'], $row['address'], $row['picture'], $row['birthdate'], $row['ageinyears'], $row['description'], $row['banner']));
    }
    return $users;
}


/*$values = array(
    'username'=>'admin',
    'password'=>'5E884898DA28047151D0E56F8DC6292773603D0D6AABBDD62A11EF721D1542D8'
    );

echo("chiamo la fx<br>");
print_r(getUsers($values));

echo("<br>inserisco l'utente<br>");
echo(insertUser(new User('username', 'email', 'password', 'name', 'surname', '27', 'address', 'picture', '2000-01-01', 'ageinyears', 'description', 'banner')));*/
?>
