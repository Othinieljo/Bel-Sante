<?php
require_once('src/models/dossier.php');
require_once('src/models/consultation.php');
require_once('src/models/participer.php');
require_once('session.php');

function NewDossier(array $input){
    $nom = $input['nom'] ?? null;
    $prenom = $input['prenom'] ?? null;
    $datenaissance = $input['datenaissance'] ?? null; // Ajout de la variable datenaissance

    // Ajout des autres variables manquantes
    $lieunaissance = $input['lieunaissance'] ?? null;
    $sexe = $input['sexe'] ?? null;
    $profession = $input['profession'] ?? null;
    $contact = $input['contact'] ?? null;
    $email = $input['email'] ?? null;
    $groupesanguin = $input['groupesanguin'] ?? null;
    $antecedents = $input['antecedants'] ?? null;
    $habitation = $input['habitation'] ?? null;
    $specialiste = $input['specialiste'] ?? null;

    $dossier = new Dossier($nom, $prenom, $datenaissance, $lieunaissance, $sexe, $profession, $contact, $email, $groupesanguin, $antecedents, $habitation);

    try{
        $dossier->connection = new DataBaseConnection();
        $result = $dossier->NewDossier($nom, $prenom, $datenaissance, $lieunaissance, $sexe, $profession, $contact, $email, $groupesanguin, $antecedents, $habitation);
        
        $lastInsertId = $dossier->connection->getConnection()->lastInsertId();
        $date_today = date('Y-m-d');
        $consultation = new Consultation($lastInsertId,null,null,null,$date_today,null,null);
        $consultation->connection = new DataBaseConnection();
        $consult = $consultation->NewConsultation($lastInsertId,null,null,null,$date_today,null,null,null);
        $partciper = new Participer();
        $lastInsertIdP = $consultation->connection->getConnection()->lastInsertId();
        $partciper->connection = new DataBaseConnection();

        $particip = $partciper->NewParticipation($lastInsertIdP,$specialiste,null);
        

        

        if ($result && $consult && $particip){

            $_SESSION['dossier_status']='Dossier enregistrer';
            header("Location: /Bel-Sante/admin");
            
        }else{
            $_SESSION['dossier_status']="Erreur lors de l'enregistrement";
        }
    } catch (Exception $e){
        // Gestion des erreurs de connexion à la base de données
        echo "Une nouvelle erreur est survenu ".$e->getMessage();
    }
}
