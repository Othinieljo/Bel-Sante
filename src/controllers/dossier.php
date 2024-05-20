<?php
require_once('src/models/dossier.php');
require_once('src/models/user.php');
require_once('src/models/necessiter.php');
require_once('src/models/exam_comp.php');
require_once('src/models/specialiste.php');
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

    $dossier = new Dossier($nom, $prenom, $datenaissance, $lieunaissance, $sexe, $profession, $contact, $email, $groupesanguin, $antecedents, $habitation,null);

    try{
        $dossier->connection = new DataBaseConnection();
        $result = $dossier->NewDossier($nom, $prenom, $datenaissance, $lieunaissance, $sexe, $profession, $contact, $email, $groupesanguin, $antecedents, $habitation);
        
        $lastInsertId = $dossier->connection->getConnection()->lastInsertId();
        $date_today = date('Y-m-d');
        $heure_today = date('H');
        $consultation = new Consultation($lastInsertId,null,null,null,$date_today,null,null);
        $consultation->connection = new DataBaseConnection();
        $consult = $consultation->NewConsultation($lastInsertId,null,null,null,$date_today,$heure_today,null,null);
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
function AddConsultation(array $input){
    $specialiste = $input['specialiste'] ?? null;
    $numerodossier= $input['numerodossier'] ;
    $consultation = new Consultation();
    $partciper = new Participer();
    $dossier = new Dossier();
    try{
        $date_today = date('Y-m-d');
        date_default_timezone_set('Africa/Abidjan');

        $heure_today = date('H:i:s');
        $consultation->connection = new DataBaseConnection();
        $consult = $consultation->NewConsultationC($numerodossier,$date_today,$heure_today);
        
            $partciper->connection = new DataBaseConnection();
            $lastInsertIdP = $consultation->connection->getConnection()->lastInsertId();
            $particip = $partciper->NewParticipation($lastInsertIdP,$specialiste,null);
            $dossier->connection = new DataBaseConnection();
            $dossier->UpdateStatus($numerodossier,1);

        
        
        
            header("Location: /Bel-Sante/patient");
    }catch(Exception $e){
        echo "Une nouvelle erreur est survenu".$e->getMessage();
    }
    
}
function dossierpage($numerodossier){
    $numerodossier = $numerodossier;
    $dossier = new Dossier();
    $consultation = new Consultation();
    $specialiste = new Specialiste();
    $user = new User();

    try{
        $dossier->connection = new DataBaseConnection();
        $user->connection = new DataBaseConnection();
        $userAdmin = $user->GetUserByID($_SESSION['id_user']);
        $results = $dossier->GetDossiersByValue('NUMERODOSSIER',$numerodossier);
        $consultation->connection = new DataBaseConnection();
        $consultations = $consultation->GetConsultationByNumero($numerodossier);
        $necessiter = new Necessiter();
        $necessiter->connection = new DataBaseConnection();
        $specialiste->connection = new DataBaseConnection();
        $specialistes = $specialiste->AllSpecialiste();
        foreach($consultations as $consult){
            $consult['examen'] = $necessiter->GetNecessiterByConsultation($consult['IDCONSULTATION']);


        }
       
    

    }catch(Exception $e){
        echo "Une nouvelle erreur est survenu".$e->getMessage();

    }

    require('src/templates/admin/dossier.php');
}

function PutNecessiter(array $input){
    $idconsultation = $input['consultation'];
    $resultats = $input['resultats'] ;

    $necessiter = new Necessiter();
    try{
        $necessiter->connection = new DataBaseConnection();
        $result = $necessiter->UpdateNecessiterBy($idconsultation,$resultats);

    }
    catch(Exception $e){
        echo "Une nouvelle erreur est survenu".$e->getMessage();
    }
    header("Location: /Bel-Sante/patient");

}
function NewExam(array $input){
    $idservice = $input['idservice'];
    $examen = $input['exam'] ;

    $exam = new EXAMENCOMPLEMENTAIRE();
    try{
        $exam->connection = new DataBaseConnection();
        $exam->NewExamen($idservice,$examen);
    }catch(Exception $e){
        echo "Une nouvelle erreur est survenu".$e->getMessage();
    }
    header("Location: /Bel-Sante/admin");

}