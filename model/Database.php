<?php
/*class Param
{
    public $name;
    public $value;
    
    function __construct($name, $value){
        $this->name = $name;
        $this->value = $value;
    }
}*/

class Database {
    private static $connection;
    
    public static function getConnection(){
        if(!isset(self::$connection)){
            //leggo i parametri dal file di configurazione
            $config = parse_ini_file("./model/config.ini");
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
    
    /*public static function executeQuery($query, $parameter) {
        try {
            $db = self::getConnection();
            
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
    }*/
	
	public static function execute($query, $parameter = null) {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($query);
            //binding parameter
			if ($parameter != null) {
				foreach ($parameter as $key => $param) {
					$stmt->bindValue(':' . $key, $param);
                }
            }
            
            //executing and returning
            $stmt->execute();
            try {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                $result = true; //è un insert o un delete o un update
            }
            
            return $result;
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
	
}
?>