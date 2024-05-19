<?php
require_once('src/lib/database.php');
class EXAMENCOMPLEMENTAIRE{
    public $IDEXAMCOMPL;
    public $IDSERVICE;
    public $LIBELLEEXAMCOMPL;


    public  DataBaseConnection $connection;

    public function GetAllExamen(){
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM EXAMENCOMPLEMENTAIRE");
         
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function NewExamen($IDSERVICE,$LIBELLEEXAM){
        $stmt = $this->connection->getConnection()->prepare(
            "INSERT INTO EXAMENCOMPLEMENTAIRE (IDSERVICE, LIBELLEEXAM) 
            VALUES (?, ?)"
        );
        
        // Exécution de la requête avec les valeurs des champs
        $success = $stmt->execute([$IDSERVICE, $LIBELLEEXAM]);
        
        // Vérification du succès de l'insertion
        if ($success) {
            return true; // Insertion réussie, retourner true
            
            
        } else {
            return false; // Erreur lors de l'insertion, retourner false
        }

    }
    // public function UpdateExam($ID)
}