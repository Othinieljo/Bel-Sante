<?php
require_once('src/lib/database.php');

class Consultation{
    public $IDCONSULTATION;
    public $NUMERODOSSIER;
    public $DIAGNOSTIC;
    public $PRESCRIPTION;
    public $ACTEMEDICAL;
    public $DATECONSULTATION;
    public $HEURECONSULTATION;
    public $DATECONTROLE;
    public $OBSERVATION;
    public $CONSTANTES;
    

   



    public DataBaseConnection $connection;

    public function NewConsultation($NUMERODOSSIER,$DIAGNOSTIC,
    $PRESCRIPTION,$ACTEMEDICAL,$DATECONSULTATION,$HEURECONSULTATION,$DATECONTROLE,$OBSERVATION,$CONSTANTES){
        $stmt = $this->connection->getConnection()->prepare("INSERT INTO CONSULTATION
        (NUMERODOSSIER,DIAGNOSTIC,PRESCRIPTION,
        ACTEMEDICAL,DATECONSULTATION,HEURECONSULTATION,DATECONTROLE,OBSERVATION,CONSTANTES)
        VALUES (?,?,?,?,?,?,?,?,?)  ");
        $success = $stmt->execute([
        $NUMERODOSSIER,$DIAGNOSTIC,$PRESCRIPTION,
        $ACTEMEDICAL,$DATECONSULTATION,$HEURECONSULTATION,
        $DATECONTROLE,$OBSERVATION,$CONSTANTES]);

        if($success){
            return true;
        }else {
            return false;
        }
    }
    public function NewConsultationC($NUMERODOSSIER,$DATECONSULTATION,$HEURECONSULTATION){
        $stmt = $this->connection->getConnection()->prepare("INSERT INTO CONSULTATION
        (NUMERODOSSIER,DATECONSULTATION,HEURECONSULTATION)
        VALUES (?,?,?)  ");
        $success = $stmt->execute([
        $NUMERODOSSIER,$DATECONSULTATION,$HEURECONSULTATION]);

        if($success){
            return true;
        }else {
            return false;
        }
    }
    public function UpdateConsultation($NUMERODOSSIER, $DIAGNOSTIC,$PRESCRIPTION, $ACTEMEDICAL, $DATECONTROLE, $OBSERVATION,$CONSTANTES)
{
    $stmt = $this->connection->getConnection()->prepare("
        UPDATE CONSULTATION 
        SET  
            DIAGNOSTIC = ?, 
            PRESCRIPTION = ?, 
            ACTEMEDICAL = ?, 
            DATECONTROLE = ?, 
            OBSERVATION = ? ,
            CONSTANTES = ?
        WHERE NUMERODOSSIER = ?
    ");

    $success = $stmt->execute([$DIAGNOSTIC,$PRESCRIPTION,$ACTEMEDICAL,$DATECONTROLE,$OBSERVATION,$CONSTANTES,$NUMERODOSSIER]);

    if ($success) {
        return true; // Mise à jour réussie
    } else {
        return false; // Erreur lors de la mise à jour
    }
}

    public function AddDossier($NUMERODOSSIER){
        $stmt = $this->connection->getConnection()->prepare("INSERT INTO CONSULTATION
        (NUMERODOSSIER)
        VALUES (?)");
        $success = $stmt->execute([
        $NUMERODOSSIER]);

        if($success){
            return true;
        }else {
            return false;
        }

    
    }
    public function GetConsultationByN($NUMERODOSSIER){
        $stmt = $this->connection->getConnection()->prepare("
            SELECT *
            FROM CONSULTATION
            WHERE NUMERODOSSIER = ?
            AND DATECONSULTATION = (
                SELECT MAX(DATECONSULTATION)
                FROM CONSULTATION
                WHERE NUMERODOSSIER = ?
            )
        ");
    
        $stmt->execute([$NUMERODOSSIER, $NUMERODOSSIER]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function checkNecessiterByIDCONSULTATION($IDCONSULTATION) {
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as count
            FROM NECESSITER
            WHERE IDCONSULTATION = ?
        ");
        
        $stmt->execute([$IDCONSULTATION]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['count'] > 0;
    }
    
    public function GetConsultationByNumero($NUMERODOSSIER){
        $stmt = $this->connection->getConnection()->prepare("
            SELECT *
            FROM CONSULTATION 
            WHERE NUMERODOSSIER = ?
            ORDER BY IDCONSULTATION DESC;
            
        ");
    
        $stmt->execute([$NUMERODOSSIER]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function GetConsultationByIDCONSULTATION($IDCONSULTATION) {
        $stmt = $this->connection->getConnection()->prepare("
            SELECT C.*, D.*, P.*, S.*
            FROM CONSULTATION C
            JOIN DOSSIER D ON C.NUMERODOSSIER = D.NUMERODOSSIER
            JOIN PARTICIPER P ON C.IDCONSULTATION = P.IDCONSULTATION
            JOIN SPECIALISTE S ON P.IDSPECIALISTE = S.IDSPECIALISTE
            WHERE C.IDCONSULTATION = ?
            
        ");
        
        $stmt->execute([$IDCONSULTATION]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    
    public function CountConsultations(){
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) as total FROM CONSULTATION");
         
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['total'];
    }
    public function CountConsultationsPerMonth($year){
        $stmt = $this->connection->getConnection()->prepare("
            SELECT MONTH(DATECONSULTATION) as mois, COUNT(*) as total
            FROM CONSULTATION
            WHERE YEAR(DATECONSULTATION) = ?
            GROUP BY MONTH(DATECONSULTATION)
        ");
         
        $stmt->execute([$year]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }
    public function GetConsultationsByActualDate(){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT *
            FROM CONSULTATION ORDER BY IDCONSULTATION DESC
            WHERE DATECONTROLE >= ?
        ");
    
        $stmt->execute([$currentDate]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results;
    }
    public function CountConsultationsByActualDate(){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as total
            FROM CONSULTATION
            WHERE DATECONTROLE >= ?
        ");
    
        $stmt->execute([$currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    public function CountNewConsultationsToday(){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(DISTINCT NUMERODOSSIER) as total
            FROM CONSULTATION
            WHERE DATECONSULTATION = ? 
        ");
    
        $stmt->execute([$currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    public function CountNewConsultationsByActualDate(){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as total
            FROM CONSULTATION
            WHERE DATECONSULTATION = ?
        ");
    
        $stmt->execute([$currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    
    
    
    

}