<?php
require_once('src/models/consultation.php');
require_once('src/models/participer.php');
require_once('src/models/necessiter.php');
require_once('src/models/dossier.php');
require_once('src/models/exam_comp.php');
require_once('session.php');

function NewConsultation(array $input){
    $idconsultation = $input['idconsultation'];
    $diagnostic = $input['diagnostic'] ?? '';
    $prescription = $input['prescription'] ?? ''; // Correction de la faute de frappe "precription" -> "prescription"
    $acte_medical = $input['acte_medical'] ?? '';
    $constantes = $input['constantes'] ?? '';
    $examen_complementaire = $input['examen_complementaire'];
    $date_controle = $input['date_controle'] ?? '';
    $observation = $input['observation'] ?? '';
    $numerodossier = $input['numerodossier']; 
    $consultation = new Consultation();
    try {
       
        $consultation->connection = new DataBaseConnection();
        $res = $consultation->UpdateConsultation($numerodossier,$diagnostic,$prescription,$acte_medical,$date_controle,$observation,$constantes);
        if ($res){
            if(!empty($examen_complementaire)){
                $necessiter = new Necessiter();
                try{
                    $necessiter->connection = new DataBaseConnection();
                    $date_today = date('Y-m-d');
                    $necessiter->NewNecessiter($idconsultation,$examen_complementaire,$date_today,null,null);

                }catch(Exception $e){
                    echo "Une nouvelle erreur est survenu".$e->getMessage();
                }

            }
            header("Location: /Bel-Sante/consult?n=".$numerodossier);
            
        }

    } catch (Exception $e) {
        echo "Une nouvelle erreur est survenue " . $e->getMessage(); // Correction de "survenu" -> "survenue" et ajout d'un espace après "survenue"
    }
}

function AddDossier($id){
    
}
function consultationpage($numerodossier){
    $consultation = new Consultation();
    $exam_comp = new EXAMENCOMPLEMENTAIRE();
    $dossier = new Dossier();
    $participer = new Participer();

    try{
        $participer->connection = new DataBaseConnection();
        $dossiers = $participer->GetDossierByUserId($_SESSION['id_user']);
        $consultation->connection = new DataBaseConnection();
        $consult = $consultation->GetConsultationByN($numerodossier);
        $exam_comp->connection = new DataBaseConnection();
        $exam_comps = $exam_comp->GetAllExamen();
        if ($consult) {
            $idconsultation = $consult['IDCONSULTATION'];
            $diagnostic = $consult['DIAGNOSTIC'] ?? '';
            $prescription = $consult['PRESCRIPTION'] ?? '';
            $acte_medical = $consult['ACTEMEDICAL'] ?? '';
            $constantes = $consult['CONSTANTES'] ?? '';
            $examen_complementaire = $consult['EXAMENCOMPLEMENTAIRE'] ?? '';
            $date_controle = $consult['DATECONTROLE'] ?? '';
            $observation = $consult['OBSERVATION'] ?? '';
        } else {
            // Si aucune consultation n'est trouvée, initialisez les variables à des valeurs par défaut
            $diagnostic = '';
            $prescription = '';
            $acte_medical = '';
            $constantes = '';
            $examen_complementaire = '';
            $date_controle = '';
            $observation = '';
        }

    }catch(Exception $e){

    }
    require('./src/templates/specialisteDashboard/consultation.php');


}