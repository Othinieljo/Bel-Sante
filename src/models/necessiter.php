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
    public function GetNecessiterByConsultation($IDCONSULTATION) {
        $stmt = $this->connection->getConnection()->prepare("
            SELECT N.*, C.*, D.*, E.*
            FROM NECESSITER N
            JOIN CONSULTATION C ON N.IDCONSULTATION = C.IDCONSULTATION
            JOIN DOSSIER D ON C.NUMERODOSSIER = D.NUMERODOSSIER
            JOIN EXAMENCOMPLEMENTAIRE E ON N.IDEXAMENCOMPL = E.IDEXAMENCOMPL
            WHERE N.IDCONSULTATION = ?
        ");
        
        $stmt->execute([$IDCONSULTATION]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }
    
    
    public function UpdateNecessiterBy($IDCONSULTATION,$RESULTATS){

        $stmt = $this->connection->getConnection()->prepare("
        UPDATE NECESSITER 
        SET RESULTATS = ?
        
        
        WHERE IDCONSULTATION = ?"
    
    );
        $result = $stmt->execute([$RESULTATS,$IDCONSULTATION]);

        if ($result){
            return true;
        }else{
            return false;
        }

        

    }
}