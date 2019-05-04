<?php
require_once "Database.php";

class Province{
    /*
    +----------+--------------+------+-----+---------+-------+
    | Field    | Type         | Null | Key | Default | Extra |
    +----------+--------------+------+-----+---------+-------+
    | Regione  | int(11)      | NO   | MUL | NULL    |       |
    | codice   | int(11)      | NO   | PRI | NULL    |       |
    | iniziali | varchar(100) | NO   |     | NULL    |       |
    | nome     | varchar(100) | NO   |     | NULL    |       |
    +----------+--------------+------+-----+---------+-------+
    */

    public $Regione;
    public $codice;
    public $iniziali;
    public $nome;
    
    function __construct($Regione, $codice, $iniziali, $nome){
        $this->Regione = $Regione;
        $this->codice = $codice;
        $this->iniziali = $iniziali;
        $this->nome = $nome;
    }
}

function getProvince($parametersValues = null){
    $queryColums = ["Regione",
                    "codice",
                    "iniziali",
                    "nome"];
    
    $queryTable = "Province";
    $queryEnd = "order by nome asc";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, $queryEnd);
    $provincie = array();
    foreach($result as $row){
        array_push($provincie, new Province($row['Regione'],$row['codice'],$row['iniziali'],$row['nome']));
    }
    return $provincie;
}

?>