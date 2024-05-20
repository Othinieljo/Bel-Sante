<?php

require_once('session.php');
require_once('src/controllers/user.php');
require_once('src/models/specialiste.php');
require_once('src/models/dossier.php');
require_once('src/models/participer.php');
require_once('src/models/service.php');
require_once('src/models/user.php');

function adminpage(){
    $dossier_status = '';
    if (isset($_SESSION['id_user'])){
        if (isset($_SESSION['dossier_status'])) {
            $dossier_status = $_SESSION['dossier_status'];
            unset($_SESSION['dossier_status']); // Supprimer le message d'erreur de la session
        }

        switch($_SESSION['type']){

            case 'admin':
                $dossier = new Dossier();
                $user = new User();
                $consultation = new Consultation();

                try{
                    $user->connection = new DataBaseConnection();
                    $dossier->connection = new DataBaseConnection();
                    $consultation->connection = new DataBaseConnection();
                    $nbres_dossier = $dossier->CountDossiers();
                    $nbres_user = $user->CountNonAdminUsers();
                    $nbres_consultation = $consultation->CountConsultations();
                    $nbres_rdv = $consultation->CountConsultationsByActualDate();
                    $dossiers = $dossier->GetAllDossiers();
                    $userAdmin = $user->GetUserByID($_SESSION['id_user']);


                    $year = date('Y'); // Obtenez l'année actuelle
                    $results = $consultation->CountConsultationsPerMonth($year);

                    // Génération du contenu JavaScript avec les données récupérées
                    $dataLabels = [];
                    $dataValues = [];

                    foreach ($results as $result) {
                        $dataLabels[] = date('M', mktime(0, 0, 0, $result['mois'], 1)); // Format court du mois (ex: Jan, Fév, etc.)
                        $dataValues[] = (int)$result['total']; // Convertir en entier
                    }

                    $jsDataLabels = json_encode($dataLabels);
                    $jsDataValues = json_encode($dataValues);

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
                    echo "Une nouvelle erreur est survenu".$e->getMessage();
                }
                require('./src/templates/admin/admin.php');
                break;
            case 'receptioniste':

               
                $specialiste = new Specialiste();
                $dossier = new Dossier();
                $participer = new Participer();
                $consultation = new Consultation();
                $user = new User();

                
                try{
                    $user->connection = new DataBaseConnection();
                    $userAcceuil = $user->GetUserByID($_SESSION['id_user']);
                    $dossier->connection = new DataBaseConnection();
                    $dossiers = $dossier->GetAllDossiers();
                    $consultation->connection = new DataBaseConnection();
                    $nbres_rdv = $consultation->CountConsultationsByActualDate();
                    $participer->connection = new DataBaseConnection();
                    $new_d = $consultation->CountNewConsultationsToday();
                    $nbres_c = $consultation->CountNewConsultationsByActualDate();

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
                        }
                    }
                    unset($dossier);
                    
                }catch(Exception $e){
                    echo "Une nouvelle erreur".$e->getMessage();
                }
                
                require('./src/templates/dashboardAcceuil/admin.php');
                break;    
            case 'specialiste':
                $participer = new Participer();
                $dossier = new Dossier();
                $consultation = new Consultation();
                $user = new User();
                try{
                    $user->connection = new DataBaseConnection();
                    $userSpe= $user->GetUserByID($_SESSION['id_user']);
                    $participer->connection = new DataBaseConnection();
                    $participers = $participer->GetParticipationsByUserId($_SESSION['id_user']);
                    $nbres_p = $participer->CountConsultationsTodayByUserId($_SESSION['id_user']);
                    $nbres_rdv = $participer->CountConsultationsTodayByUserIdAndControlDate($_SESSION['id_user']);
                    $new_d = $participer->CountNewConsultationsToday();
                    $consultation->connection = new DataBaseConnection();
                    
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
                    echo "Une nouvelle erreur esr survenu".$e->getMessage();
                }               
                require('./src/templates/specialisteDashboard/admin.php');
                break;
            case 'service':
                $service = new Service();
                $user = new User();
                try{
                    $user->connection = new DataBaseConnection();
                    $userServ= $user->GetUserByID($_SESSION['id_user']);
                    $service->connection = new DataBaseConnection();
                    $nbres_consultation = $service->CountNecessiterByUserId($_SESSION['id_user']);
                    $dossiers = $service->GetDossierByUserId($_SESSION['id_user']);
                    $serv = $service->GetServiceByUserId($_SESSION['id_user']);
                   
                }catch(Exception $e){
                    echo "Une nouvelle erreur est survenu".$e->getMessage();
                }
                require('./src/templates/servicesExamenDashboard/admin.php');
                break;
            default:
                echo 'Page not found';
                break;

        }

    }else{
        header("Location: /Bel-Sante/login");
    }

   
   

    
}