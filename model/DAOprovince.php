<?php
require_once "Database.php";

class Province{
    /*
    +-------------------+--------------+------+-----+---------+-------+
    | Field             | Type         | Null | Key | Default | Extra |
    +-------------------+--------------+------+-----+---------+-------+
    | codiceRegione     | int(11)      | NO   |     | NULL    |       |
    | nomeRegione       | varchar(100) | NO   |     | NULL    |       |
    | codiceProvincia   | int(11)      | NO   | PRI | NULL    |       |
    | inizialiProvincia | varchar(100) | NO   |     | NULL    |       |
    | nomeProvincia     | varchar(100) | NO   |     | NULL    |       |
    +-------------------+--------------+------+-----+---------+-------+
    */

    public $codiceRegione;
    public $nomeRegione;
    public $codiceProvincia;
    public $inizialiProvincia;
    public $nomeProvincia;
    
    function __construct($codiceRegione, $nomeRegione, $codiceProvincia, $inizialiProvincia, $nomeProvincia){
        $this->codiceRegione = $codiceRegione;
        $this->nomeRegione = $nomeRegione;
        $this->codiceProvincia = $codiceProvincia;
        $this->inizialiProvincia = $inizialiProvincia;
        $this->nomeProvincia = $nomeProvincia;
    }
}

function getProvinceList(){
    $result =  Database::execute("SELECT codiceRegione,nomeRegione,codiceProvincia,inizialiProvincia,nomeProvincia FROM region order by nomeprovincia asc");
    $return = array();
    foreach($result as $row){
        array_push($return, new Province($row['codiceRegione'],$row['nomeRegione'],$row['codiceProvincia'],$row['inizialiProvincia'],$row['nomeProvincia']));
    }
    //print_r($return);
    return $return;
}

?>