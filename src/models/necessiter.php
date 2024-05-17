<?php
require_once('src/lib/database.php');
class Necessiter{
    public $IDNECESSITER;
    public $IDCONSULTATION;
    public $IDEXAMENCOMPL;
    public $DATEEXAMEN;
    public $CAUSEEXAMEN;
    public $RESULTATS;


    public DataBaseConnection $connection;


    public function NewNecessiter($IDCONSULTATION,$IDEXAMENCOMPL,$DATEEXAM,$CAUSEEXAM,$RESULTATS){
        $stmt = $this->connection->getConnection()->prepare("INSERT INTO NECESSITER
        (IDCONSULTATION,IDEXAMENCOMPL,DATEEXAMEN,CAUSEEXAMEN,RESULTATS)   VALUES (?,?,?,?,?)");
        
        $result = $stmt->execute([$IDCONSULTATION,$IDEXAMENCOMPL,$DATEEXAM,$CAUSEEXAM,$RESULTATS]);

        if($result){
            return true;
        }else{
            return false;
        }
    }
}