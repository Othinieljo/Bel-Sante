<?php

require_once('src/models/user.php');
require_once('src/models/specialiste.php');
require_once('session.php');

function connectionpage(){
    $message = '';
    if (isset($_SESSION['login_error'])) {
        $message = $_SESSION['login_error'];
        unset($_SESSION['login_error']); // Supprimer le message d'erreur de la session
    }
    require('./src/templates/connection/connection.php');

    
}
function deconnexionpage(){
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Détruire toutes les données de la session
    $_SESSION = array();

   

    // Finalement, détruire la session elle-même
    session_destroy();

    // Rediriger l'utilisateur vers la page de connexion
    header("Location: /Bel-Sante/login");
    exit(); // Assurez-vous de quitter le script après la redirection
}

function loginpage(array $input){
    
    $username = $input['username'];
    $password = $input['password'];

    $user = new User($username,$password);
    
    // $user->connection = new DataBaseConnection();
    // $result = $user->addUser($username,$password);
    // if($result){
    //     echo "Creer";
    // }
    
    try{
        $user->connection = new DataBaseConnection();
        $result = $user->validateCredentials($username,$password);
        if ($result) {
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['type'] =  $result['type'];
            
        }else {
            
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header("Location: /Bel-Sante/login");
            
            
            
        }
    }catch(Exception $e){
        echo "Une nouvelle erreur est survenu ".$e->getMessage();


    }
    if (isset($_SESSION['type'])){

        header("Location: /Bel-Sante/admin");
    }
   

}
 function NewSpecialisteAndUser(array $input){
    $username = $input['username'];
    $password = $input['password'];
    $email = $input['email'];
    $type = "specialiste";
    $numero = $input['numero'];
    $photourl = $input['photourl'];
    $NOMSPECIALITE = $input['NOMSPECIALISTE'];
    $PRENOMSPECIALISTE = $input['PRENOMSPECIALISTE'];
    $SPECIALITEDUSPECIALISTE = $input['SPECIALITEDUSPECIALISTE'];
    $GRADESPECIALISTE = $input['GRADESPECIALISTE'];
    $SEXESPECIALISTE = $input['SEXESPECIALISTE'];


    $user = new User();
    try{
        $user->connection = new DataBaseConnection();
        $result = $user->addUser($username,$password,$email,$numero,$type,$photourl);
        if($result){
            $lastInsertId = $user->connection->getConnection()->lastInsertId();
            $specialiste = new Specialiste();
            $specialiste->connection = new DataBaseConnection();
            $spec = $specialiste->NewSpecialiste($lastInsertId,
            $NOMSPECIALITE,$PRENOMSPECIALISTE,$SEXESPECIALISTE,$SPECIALITEDUSPECIALISTE,$GRADESPECIALISTE);
            if ($spec){
                echo "Bien enregistree";
            }
        }


    }catch(Exception $e){
        echo 'Une nouvelle erreur est survenu est'.$e->getMessage();
    }
    






}




