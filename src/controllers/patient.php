<?php

require_once('session.php');
require_once('src/controllers/user.php');
require_once('src/models/consultation.php');
require_once('src/models/dossier.php');
require_once('src/models/notification.php');
require_once('src/models/specialiste.php');

function patientpage(){
    $dossier_status = '';
    if (isset($_SESSION['id_user'])){
        if (isset($_SESSION['dossier_status'])) {
            $dossier_status = $_SESSION['dossier_status'];
            unset($_SESSION['dossier_status']); // Supprimer le message d'erreur de la session
        }
        switch($_SESSION['type']){
            case 'admin':
                $user = new User();
                $dossier = new Dossier();
                $consultation = new Consultation();
                $notification = new Notification();
                try{
                    $user->connection = new DataBaseConnection();
                    $userAdmin = $user->GetUserByID($_SESSION['id_user']);
                    $dossier->connection = new DataBaseConnection();
                    $consultation->connection = new DataBaseConnection();
                    $notification->connection = new DataBaseConnection();
                    $notif = $notification->CountNotificationsNotS($_SESSION['id_user']);
                   $dossiers = $dossier->GetAllDossiers();
                    foreach ($dossiers as &$dossier) {
                        
                        $consultationData = $consultation->GetConsultationByN($dossier['NUMERODOSSIER']);
                        
                        // Ajouter les colonnes de la consultation dans le tableau du dossier
                        if ($consultationData) {
                            $dossier['DIAGNOSTIC'] = $consultationData['DIAGNOSTIC'];
                            $dossier['PRESCRIPTION'] = $consultationData['PRESCRIPTION'];
                            $dossier['ACTEMEDICAL'] = $consultationData['ACTEMEDICAL'];
                            $dossier['DATECONSULTATION'] = $consultationData['DATECONSULTATION'];
                            $dossier['HEURECONSULTATION'] = $consultationData['HEURECONSULTATION'];
                            $dossier['DATECONTROLE'] = $consultationData['DATECONTROLE'];
                            $dossier['OBSERVATION'] = $consultationData['OBSERVATION'];
                            $dossier['CONSTANTES'] = $consultationData['CONSTANTES'];

                            
                        }
                    }
                    unset($dossier);

                }catch(Exception $e){
                    // echo "Une nouvelle erreur est survenu".$e->getMessage();
                }
                require('./src/templates/admin/patients.php');
                break;
           
            case 'receptioniste':
                $dossier = new Dossier();
                $specialiste = new Specialiste();
                $consultation = new Consultation();
                $user = new User();
                try{
                    $user->connection = new DataBaseConnection();
                    $userAcceuil = $user->GetUserByID($_SESSION['id_user']);
                    $dossier->connection = new DataBaseConnection();
                    $consultation->connection = new DataBaseConnection();
                    $dossiers = $dossier->GetAllDossiers();
                    $specialiste->connection = new DataBaseConnection();
                    $specialistes = $specialiste->AllSpecialiste();
                    foreach ($dossiers as &$dossier) {
                        
                        $consultationData = $consultation->GetConsultationByN($dossier['NUMERODOSSIER']);
                        
                        // Ajouter les colonnes de la consultation dans le tableau du dossier
                        if ($consultationData) {
                            $dossier['DIAGNOSTIC'] = $consultationData['DIAGNOSTIC'];
                            $dossier['PRESCRIPTION'] = $consultationData['PRESCRIPTION'];
                            $dossier['ACTEMEDICAL'] = $consultationData['ACTEMEDICAL'];
                            $dossier['DATECONSULTATION'] = $consultationData['DATECONSULTATION'];
                            $dossier['HEURECONSULTATION'] = $consultationData['HEURECONSULTATION'];
                            $dossier['DATECONTROLE'] = $consultationData['DATECONTROLE'];
                            $dossier['OBSERVATION'] = $consultationData['OBSERVATION'];
                            $dossier['CONSTANTES'] = $consultationData['CONSTANTES'];
                            $dossier['IDCONSULTATION'] = $consultationData['IDCONSULTATION'];

                            $IDCONSULTATION = $dossier['IDCONSULTATION'];
                            $necessiterExists = $consultation->checkNecessiterByIDCONSULTATION($IDCONSULTATION);
                            $dossier['NECESSITER_EXISTS'] = $necessiterExists;
                        }
                    }
                    unset($dossier);

                }catch(Exception $e){
                    // echo "Une nouvelle erreur est survenu".$e->getMessage();

                }
                require('./src/templates/dashboardAcceuil/patients.php');
                break;    
            case 'specialiste':
                $participer = new Participer();
                $dossier = new Dossier();
                $consultation = new Consultation();
                $user = new User();
                $userS = new Specialiste();
                try{
                    $user->connection = new DataBaseConnection();
                    $userSpe= $user->GetUserByID($_SESSION['id_user']);
                    $participer->connection = new DataBaseConnection();
                    $participers = $participer->GetParticipationsByUserId($_SESSION['id_user']);
                    $consultation->connection = new DataBaseConnection();
                    $urlComplet = $userSpe['photourl'];
                    $url = str_replace("/opt/lampp/htdocs/Bel-Sante/", "", $urlComplet);
                    $userS->connection = new DataBaseConnection();
                    $specialiste = $userS->GetSpecialisteByUserId($_SESSION['id_user']);
                    
                    $dossiers = $participer->GetDossierByUserId($_SESSION['id_user']);
                    foreach ($dossiers as &$dossier) {
                        
                        $consultationData = $consultation->GetConsultationByN($dossier['NUMERODOSSIER']);
                        
                        // Ajouter les colonnes de la consultation dans le tableau du dossier
                        if ($consultationData) {
                            $dossier['DIAGNOSTIC'] = $consultationData['DIAGNOSTIC'];
                            $dossier['PRESCRIPTION'] = $consultationData['PRESCRIPTION'];
                            $dossier['ACTEMEDICAL'] = $consultationData['ACTEMEDICAL'];
                            $dossier['DATECONSULTATION'] = $consultationData['DATECONSULTATION'];
                            $dossier['HEURECONSULTATION'] = $consultationData['HEURECONSULTATION'];
                            $dossier['DATECONTROLE'] = $consultationData['DATECONTROLE'];
                            $dossier['OBSERVATION'] = $consultationData['OBSERVATION'];
                            $dossier['CONSTANTES'] = $consultationData['CONSTANTES'];
                        }
                    }
                    unset($dossier);


                }catch(Exception $e){
                    // echo "Une nouvelle erreur esr survenu".$e->getMessage();
                }  
                require('./src/templates/specialisteDashboard/patients.php');
                break;
            case 'service':
                $service = new Service();
                $user = new User();
                try{
                    $user->connection = new DataBaseConnection();
                    $userServ = $user->GetUserByID($_SESSION['id_user']);
                    $service->connection = new DataBaseConnection();
                    $nbres_consultations = $service->CountNecessiterByUserId($_SESSION['id_user']);
                    $dossiers = $service->GetDossierByUserId($_SESSION['id_user']);
                    $serv = $service->GetServiceByUserId($_SESSION['id_user']);


                    

                }catch(Exception $e){
                    // echo "Une nouvelle erreur est survenu".$e->getMessage();
                }
                require('./src/templates/servicesExamenDashboard/patients.php');
                break;
            default:
                echo 'Page not found';
                break;

        }

    }else{
        header("Location: /Bel-Sante/login");
    }

   
   

    
}