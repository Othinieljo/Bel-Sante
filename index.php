<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once('src/controllers/user.php');
require_once('src/controllers/service.php');
require_once('src/controllers/impression.php');
require_once('src/controllers/admin.php');
require_once('src/controllers/dossier.php');
require_once('src/controllers/patient.php');
require_once('src/controllers/consultation.php');
require_once('src/controllers/specialistes.php');
require_once('src/controllers/notification.php');

$message = '';

try {

    // Récupérer l'URL demandée
$request_uri = $_SERVER['REQUEST_URI'];

// Extrait le chemin de l'URL sans les paramètres GET
$path = parse_url($request_uri, PHP_URL_PATH);

switch ($path) {
    case '/Bel-Sante/login':
        connectionpage();
        break;
    case '/Bel-Sante/dossiers':
        if (isset($_GET['n'])){
            $num_dossier = $_GET['n'];
            dossierpage($num_dossier);
        }
        else{
            header("Location : /bel-Sante/admin");
        }
        break;    
    case '/Bel-Sante/logout':
        deconnexionpage();
        break;    
    case '/Bel-Sante/patient':
        patientpage();
        break;    
    case '/Bel-Sante/connect':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            loginpage($_POST);
        }
        break;    
    case '/Bel-Sante/admin':
        adminpage(); 
        break;
    case '/Bel-Sante/consult':
        if (isset($_GET['n'])) {
            // Récupération du NUMERODOSSIER depuis le paramètre GET
            $num_dossier = $_GET['n'];
            consultationpage($num_dossier);
        } else {
            header("Location: /Bel-Sante/patient");
        }
        break;
    case '/Bel-Sante/consultation':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            NewConsultation($_POST);
        }
        break; 
    case '/Bel-Sante/exam':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            PutNecessiter($_POST);
        }
        break; 
    case '/Bel-Sante/exam/post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            NewExam($_POST);
        }
        break;                
    case '/Bel-Sante/dossier':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            NewDossier($_POST);
        }
        break; 
    case '/Bel-Sante/newsp':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            NewSpecialisteAndUser($_POST);
        }
        break; 
    case '/Bel-Sante/newsv':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            NewServiceAndUser($_POST);
        }
        break;
    case '/Bel-Sante/newsc':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            AddConsultation($_POST);
        }
        break;
    case '/Bel-Sante/printexam':
        if (isset($_GET['n'])){
            $id_consult = $_GET['n'];
            printexampage($id_consult);
        }
        else{
            header("Location : /bel-Sante/admin");
        }
        
        break;
    case '/Bel-Sante/printconsult':
        if (isset($_GET['n'])){
            $id_consult = $_GET['n'];
            printconsultpage($id_consult);
        }
        else{
            header("Location : /bel-Sante/admin");
        }
       
        break;           
    case '/Bel-Sante/specialistes':
        specialistePage();
        break;
    case '/Bel-Sante/notifications':
        notificationPage();
        break;    
    default:
        header("Location: /Bel-Sante/admin");
        break;
}

} catch (Exception $e) {
    // Capturer l'erreur et afficher un message personnalisé
    echo 'Une erreur est survenue : ' . $e->getMessage();
}
?>