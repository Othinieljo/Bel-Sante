<?php
require_once('src/lib/database.php');

class Participer{
    public $IDPARTICIPATION;
    public $IDCONSULTATION;
    public $IDSPECIALISTE;
    public $TACHE;

    public DataBaseConnection $connection;

    public function NewParticipation($IDCONSULTATION, $IDSPECIALISTE, $TACHE){
        $stmt = $this->connection->getConnection()->prepare("
        INSERT INTO PARTICIPER (IDCONSULTATION, IDSPECIALISTE, TACHE)
        VALUES (?, ?, ?)");
        
        $success = $stmt->execute([$IDCONSULTATION, $IDSPECIALISTE, $TACHE]);

        if($success){
            return true;
        } else {
            return false;
        }
    }
    public function GetParticipationsBySpecialiste($IDSPECIALISTE){
        $stmt = $this->connection->getConnection()->prepare("
        SELECT * FROM PARTICIPER WHERE IDSPECIALISTE = ?");
        
        $stmt->execute([$IDSPECIALISTE]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function GetParticipationsByUserId($id_user){
        $stmt = $this->connection->getConnection()->prepare("
        SELECT P.*,
        S.NOMSPECIALISTE, 
        S.PRENOMSPECIALISTE, 
        S.SPECIALITEDUSPECIALISTE, 
        S.GRADESPECIALISTE
        FROM PARTICIPER P
        JOIN SPECIALISTE S 
        ON P.IDSPECIALISTE = S.IDSPECIALISTE
        WHERE S.id_user = ?");
        
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function GetDossierByUserId($id_user){
        $stmt = $this->connection->getConnection()->prepare("
        SELECT D.*
        FROM PARTICIPER P
        JOIN SPECIALISTE S ON P.IDSPECIALISTE = S.IDSPECIALISTE
        JOIN CONSULTATION C ON P.IDCONSULTATION = C.IDCONSULTATION
        JOIN DOSSIER D ON C.NUMERODOSSIER = D.NUMERODOSSIER
        WHERE S.id_user = ?");
        
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function CountConsultationsTodayByUserId($id_user){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as total
            FROM PARTICIPER P
            JOIN CONSULTATION C ON P.IDCONSULTATION = C.IDCONSULTATION
            WHERE C.DATECONSULTATION = ? AND P.IDSPECIALISTE = (
                SELECT S.IDSPECIALISTE
                FROM SPECIALISTE S
                WHERE S.id_user = ?
            )
        ");
    
        $stmt->execute([$currentDate, $id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    public function CountConsultationsTodayByUserIdAndControlDate($id_user){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as total
            FROM PARTICIPER P
            JOIN CONSULTATION C ON P.IDCONSULTATION = C.IDCONSULTATION
            WHERE C.DATECONTROLE = ? AND P.IDSPECIALISTE = (
                SELECT S.IDSPECIALISTE
                FROM SPECIALISTE S
                WHERE S.id_user = ?
            )
        ");
    
        $stmt->execute([$currentDate, $id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    public function CountNewConsultationsTodayByUserId($id_user){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(DISTINCT C.NUMERODOSSIER) as total
            FROM PARTICIPER P
            JOIN CONSULTATION C ON P.IDCONSULTATION = C.IDCONSULTATION
            JOIN SPECIALISTE S ON P.IDSPECIALISTE = S.IDSPECIALISTE
            WHERE C.DATECONSULTATION = ? AND S.id_user = ?
        ");
    
        $stmt->execute([$currentDate, $id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    public function CountNewConsultationsToday(){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(DISTINCT C.NUMERODOSSIER) as total
            FROM PARTICIPER P
            JOIN CONSULTATION C ON P.IDCONSULTATION = C.IDCONSULTATION
            JOIN SPECIALISTE S ON P.IDSPECIALISTE = S.IDSPECIALISTE
            WHERE C.DATECONSULTATION = ? 
        ");
    
        $stmt->execute([$currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    public function CountConsultationsTodayAndControlDate(){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as total
            FROM PARTICIPER P
            JOIN CONSULTATION C ON P.IDCONSULTATION = C.IDCONSULTATION
            WHERE C.DATECONTROLE = ? 
        ");
    
        $stmt->execute([$currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];
    }
    
    
    
}
