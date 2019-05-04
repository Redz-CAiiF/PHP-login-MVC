<?php
require_once "Database.php";

class Regione{
    /*
    +--------+--------------+------+-----+---------+-------+
    | Field  | Type         | Null | Key | Default | Extra |
    +--------+--------------+------+-----+---------+-------+
    | codice | int(11)      | NO   | PRI | NULL    |       |
    | nome   | varchar(100) | NO   |     | NULL    |       |
    +--------+--------------+------+-----+---------+-------+
    */

    public $codice;
    public $nome;
    
    function __construct($codice, $nome){
        $this->codice = $codice;
        $this->nome = $nome;
    }
}



function getRegioni($parametersValues = null){
    $queryColums = ["codice",
                    "nome"];
    
    $queryTable = "Region";
    $queryEnd = "order by nome asc";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, $queryEnd);
    $regioni = array();
    foreach($result as $row){
        array_push($regioni, new Regione($row['codice'],$row['nome']));
    }
    return $regioni;
}

?>