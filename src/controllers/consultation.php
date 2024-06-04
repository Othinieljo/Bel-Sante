<?php
require_once('src/models/consultation.php');
require_once('src/models/participer.php');
require_once('src/models/necessiter.php');
require_once('src/models/dossier.php');
require_once('src/models/service.php');
require_once('src/models/notification.php');
require_once('src/models/exam_comp.php');
require_once('session.php');

function NewConsultation(array $input){
    ///// A jouter 
    $dossier = new Dossier();



    ///////
    
    $idconsultation = $input['idconsultation'];
    $diagnostic = $input['diagnostic'] ?? '';
    $prescription = $input['prescription'] ?? ''; // Correction de la faute de frappe "precription" -> "prescription"
    $acte_medical = $input['acte_medical'] ?? '';
    $constantes = $input['constantes'] ?? '';
    $examen_complementaire = $input['examen_complementaire'];
    $date_controle = $input['date_controle'] ;
    $observation = $input['observation'] ?? '';
    $numerodossier = $input['numerodossier']; 
    
    $consultation = new Consultation();
    $notification = new Notification();
    $services = new Service();
    $exam_comp = new EXAMENCOMPLEMENTAIRE();
    try {
        $dossier->connection = new DataBaseConnection();
        $consultation->connection = new DataBaseConnection();
        $notification->connection = new DataBaseConnection();
        $services->connection = new DataBaseConnection();
        $exam_comp->connection = new DataBaseConnection();
        
        
        // $res = $consultation->UpdateConsultation($numerodossier,$diagnostic,$prescription,$acte_medical,$date_controle,$observation,$constantes);
        if ($date_controle){
            $res = $consultation->UpdateConsultation($numerodossier,$diagnostic,$prescription,$acte_medical,$date_controle,$observation,$constantes);

        }else{
             $res = $consultation->UpdateConsultation($numerodossier,$diagnostic,$prescription,$acte_medical,NULL,$observation,$constantes);;
        }
        
        if ($res){
            
            $doss = $dossier->UpdateStatus($numerodossier,0);
            if ($doss){
                if(!empty($examen_complementaire)){
                    $necessiter = new Necessiter();
                    try{
                        $necessiter->connection = new DataBaseConnection();
                        $date_today = date('Y-m-d');
                        // $service = $exam_comp->GetExamByIDEXAME($examen_complementaire);
                        // $serv = $services->GetServiceByServ($service['IDSERVICE']);
                        // $notif = $notification->SendNotification($serv['id_user'],"Nouveau patient ajoute");
                       
                            $necessiter->NewNecessiter($idconsultation,$examen_complementaire,$date_today,null,null);
                           
                           
    
                       
                        
    
                        
    
                    }catch(Exception $e){
                        // echo "Une nouvelle erreur est survenu".$e->getMessage();
                    }
    

            }
           
            
            }else{
                
            }
            
            header("Location: /Bel-Sante/admin");
            
        }else{
           
        }

    } catch (Exception $e) {
        // echo "Une nouvelle erreur est survenue " . $e->getMessage(); // Correction de "survenu" -> "survenue" et ajout d'un espace après "survenue"
    }
}

function AddDossier($id){
    
}
function consultationpage($numerodossier){
    $consultation = new Consultation();
    $exam_comp = new EXAMENCOMPLEMENTAIRE();
    $dossier = new Dossier();
    $participer = new Participer();
    $user = new User();
    $userS = new Specialiste();

    try{
        $user->connection = new DataBaseConnection();
        $userSpe= $user->GetUserByID($_SESSION['id_user']);
        $userS->connection = new DataBaseConnection();
        $specialiste = $userS->GetSpecialisteByUserId($_SESSION['id_user']);

        $urlComplet = $userSpe['photourl'];
        $url = str_replace("/opt/lampp/htdocs/Bel-Sante/", "", $urlComplet);
        $participer->connection = new DataBaseConnection();
        $dossier->connection = new DataBaseConnection();
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
        $results = $dossier->GetDossiersByValue('NUMERODOSSIER',$numerodossier);
        
        $consultations = $consultation->GetConsultationByNumero($numerodossier);
        $necessiter = new Necessiter();
        $necessiter->connection = new DataBaseConnection();
        
       
        foreach($consultations as $consult){
            $consult['examen'] = $necessiter->GetNecessiterByConsultation($consult['IDCONSULTATION']);


        }

    }catch(Exception $e){

    }
    require('./src/templates/specialisteDashboard/consultation.php');


}