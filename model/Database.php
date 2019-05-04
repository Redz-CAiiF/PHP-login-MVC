<?php

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

    public static function getTuples($columns = null, $table, $join = null, $data = null, $end = null){
        $queryStart = "SELECT ";
        $queryFrom = " FROM ";
        $queryJoin = "";
        $queryWhere = "";
        $queryEnd = "";
    
        //Select colums clause creation
        if ($columns != null) {
            $colNumber = count($columns);//mumero delle colonne
            foreach ($columns as $column) {
                $queryStart = $queryStart." ".$column;
                $colNumber--;
                if($colNumber > 0){
                    $queryStart = $queryStart.", ";
                }
            }
        } else {
            $queryStart = $queryStart." * "; //tutte le colonne di default
        }
    
        //From clause creation
        $queryFrom = $queryFrom." ".$table;
    
        //Join clause creation
        $queryJoin = $queryJoin." ".$join;
    
        //Where clause creation
        if ($data != null) {
            $queryWhere = " WHERE ";
            $whereBlocks = count($data);
            //if($whereBlocks)
            foreach ($data as $key => $param) {
                $queryWhere = $queryWhere." ".$key."=:".$key;
                $whereBlocks--;
                if($whereBlocks > 0){
                    $queryWhere = $queryWhere." AND";
                }
            }
        }

        //End clause creation
        $queryEnd = $queryEnd." ".$end;

        //unione dei componenti della query
        $query = $queryStart." ".$queryFrom." ".$queryJoin." ".$queryWhere." ".$queryEnd;
    
        //echo("<br>".$query."<br>");
    
        $return = self::execute($query, $data);
        //print_r($return);
        return $return;
    }
	
}
?>