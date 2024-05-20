<?php
require_once('src/lib/database.php');
class Service{
    public $id_user;
    public $NOMSERVICE;
    public $RESPONSABLE;


    public DataBaseConnection $connection;


    public function NewService($id_user,$NOMSERVICE,$RESPONSABLE){

        $stmt = $this->connection->getConnection()->prepare("
        INSERT INTO SERVICE (id_user,NOMSERVICE,RESPONSABLE)
        VALUES (?,?,?)");
        $success = $stmt->execute([$id_user,$NOMSERVICE,$RESPONSABLE]);

        if ($success){
            return true;
        }else{
            return false;
        }

    }
    public function GetServiceByUserId($id_user){
        $stmt = $this->connection->getConnection()->prepare("
        SELECT * FROM SERVICE WHERE id_user = ?
        ");
        $stmt->execute([$id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function GetNecessiterbyUserId($id_user) {
        $stmt = $this->connection->getConnection()->prepare("
            SELECT N.*,
                   E.IDSERVICE, 
                   E.IDEXAMCOMPL,
                   E.LIBELLEEXAMCOMPL,
                   S.NOM_SERVIVE,
                   S.RESPONSABLE,
                   N.DATEEXAMEN,
                   N.CAUSEEXAMEN,
                   N.RESULTATS
            FROM NECESSITER N
            JOIN EXAMENCOMPLEMENTAIRE E 
                ON N.IDEXAMCOMPL= E.EXAMCOMPL
            JOIN SERVICE S
                ON E.IDSERVICE = S.IDSERVICE
            WHERE S.id_user = ?  
        ");
        
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function CountNecessiterByUserId($id_user){
        $currentDate = date('Y-m-d'); // Récupère la date actuelle au format YYYY-MM-DD
        
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as total
            FROM NECESSITER N
            JOIN EXAMENCOMPLEMENTAIRE E
            ON N.IDEXAMENCOMPL = E.IDEXAMENCOMPL
            JOIN SERVICE S
                ON E.IDSERVICE = S.IDSERVICE
            WHERE N.DATEEXAMEN = ? AND S.id_user = ? 
            
        ");
    
        $stmt->execute([$currentDate, $id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'];

    }
    public function GetDossierByUserId($id_user){
        $stmt = $this->connection->getConnection()->prepare("
            SELECT N.*,
                   E.IDSERVICE, 
                   E.IDEXAMENCOMPL,
                   E.LIBELLEEXAMCOMPL,
                   S.NOMSERVICE,
                   S.RESPONSABLE,
                   N.DATEEXAMEN,
                   N.CAUSEEXAMEN,
                   N.RESULTATS,
                   D.NOM,
                   D.PRENOM,
                   D.CONTACT,
                   D.STATUT,
                   D.LIEUNAISSANCE,
                   C.DATECONSULTATION,
                   C.HEURECONSULTATION
            FROM NECESSITER N
            JOIN EXAMENCOMPLEMENTAIRE E 
                ON N.IDEXAMENCOMPL= E.IDEXAMENCOMPL
            JOIN SERVICE S
                ON E.IDSERVICE = S.IDSERVICE
            JOIN CONSULTATION C
                ON N.IDCONSULTATION = C.IDCONSULTATION
            JOIN DOSSIER D 
                ON C.NUMERODOSSIER = D.NUMERODOSSIER        
            WHERE S.id_user = ?  
        ");
        
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

}