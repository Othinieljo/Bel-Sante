<?php
require_once('src/lib/database.php');
class Dossier {
    public $NUMERODOSSIER;
    public $NOM;
    public $PRENOM;
    public $DATENAISSANCE;
    public $LIEUNAISSANCE;
    public $SEXE;
    public $PROFESSION;
    public $CONTACT;
    public $EMAIL;
    public $GROUPESANGUIN;
    public $ANTECEDENTS;
    public $HABITATION;
    public $STATUT;
    

    public DataBaseConnection $connection;


    public function NewDossier($NOM, $PRENOM, $DATENAISSANCE, $LIEUNAISSANCE,
    $SEXE, $PROFESSION, $CONTACT, $EMAIL,
    $GROUPESANGUIN, $ANTECEDENTS, $HABITATION)
{
    $stmt = $this->connection->getConnection()->prepare(
        "INSERT INTO DOSSIER (NOM, PRENOM, DATENAISSANCE, LIEUNAISSANCE, 
        SEXE, PROFESSION, CONTACT, EMAIL, GROUPESANGUIN, ANTECEDANTS, HABITATION,STATUT) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    
    // Exécution de la requête avec les valeurs des champs
    $success = $stmt->execute([$NOM, $PRENOM, $DATENAISSANCE,
        $LIEUNAISSANCE, $SEXE, $PROFESSION, $CONTACT, $EMAIL, $GROUPESANGUIN, $ANTECEDENTS, $HABITATION,1]);
    
    // Vérification du succès de l'insertion
    if ($success) {
        return true; // Insertion réussie, retourner true
        $lastInsertId = $this->connection->getConnection()->lastInsertId();
        
    } else {
        return false; // Erreur lors de l'insertion, retourner false
    }
}
public function GetAllDossiers(){
    $stmt = $this->connection->getConnection()->prepare("SELECT * FROM DOSSIER");
     
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}
public function GetDossiersByNom($nom){
    $stmt = $this->connection->getConnection()->prepare("SELECT * FROM DOSSIER WHERE NOM = ?");
    
    $stmt->execute([$nom]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}
public function CountDossiers(){
    $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) as total FROM DOSSIER");
     
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result['total'];
}
public function GetDossiersByValue($fieldName, $fieldValue){
    $stmt = $this->connection->getConnection()->prepare("SELECT * FROM DOSSIER WHERE $fieldName = ?");
    
    $stmt->execute([$fieldValue]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}



}