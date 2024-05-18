<?php
// Afficher les erreurs de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure le fichier user.php qui contient la fonction connectionpage()
require_once('src/controllers/user.php');
require_once('src/controllers/admin.php');

try {
    // Appeler la fonction pour effectuer la redirection
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'login') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loginpage($_POST);
            }
        } elseif ($_GET['action'] === 'admin') {
            adminpage(); // Appeler la fonction pour gérer la page admin
        }
    }else {
        connectionpage();
    }
    
    

} catch (Exception $e) {
    // Capturer l'erreur et afficher un message personnalisé
    echo 'Une erreur est survenue : ' . $e->getMessage();
}
?>
