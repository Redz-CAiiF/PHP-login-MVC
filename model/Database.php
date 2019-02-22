<?php
class Param
{
    public $name;
    public $value;
    
    function __construct($name, $value){
        $this->name = $name;
        $this->value = $value;
    }
}

class Database {
    private static $connection;
    
    public static function getConnection($pathIni){
        if(!isset(self::$connection)){
            //leggo i parametri dal file di configurazione
            $config = parse_ini_file($pathIni);
            try{
                $conn = new PDO("mysql:host=".$config["hostname"].";dbname=".$config["dbname"], $config["user"], $config["pass"]);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection = $conn;
            }catch(PDOException $e){
                echo $e->getMessage();
                die();//interrompe il caricamento della pagina
            }
        }
        return self::$connection;
    }
    
    public static function executeQuery($query, $parameter, $pathIni) {
        try {
            $db = self::getConnection($pathIni);
            
            $stmt = $db->prepare($query);
            
            //binding parameter
            foreach ($parameter as $param) {
                $stmt->bindParam($param->name, $param->value, PDO::PARAM_STR);
            }
            
            //executing and returning
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    public static function insertData($query, $parameter, $pathIni) {
        try {
            $db = self::getConnection($pathIni);
            
            $stmt = $db->prepare($query);
            
            //binding parameter
            foreach ($parameter as $param) {
                $stmt->bindParam($param->name, $param->value, PDO::PARAM_STR);
            }
            
            //executing and returning
            $stmt->execute();
            return true;
            
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    public static function updateData($query, $parameter, $pathIni) {
        try {
            $db = self::getConnection($pathIni);
            
            $stmt = $db->prepare($query);
            
            //binding parameter
            foreach ($parameter as $param) {
                $stmt->bindParam($param->name, $param->value, PDO::PARAM_STR);
            }
            
            //executing and returning
            $stmt->execute();
            return true;
            
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    public static function deleteData($query, $parameter, $pathIni) {
        try {
            $db = self::getConnection($pathIni);
            
            $stmt = $db->prepare($query);
            
            //binding parameter
            foreach ($parameter as $param) {
                $stmt->bindParam($param->name, $param->value, PDO::PARAM_STR);
            }
            
            //executing and returning
            $stmt->execute();
            return true;
            
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>