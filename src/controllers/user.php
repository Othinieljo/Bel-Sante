<?php
session_start();
require_once('src/models/user.php');

function connectionpage(){
    
    require('./src/templates/connection/connection.php');
}
function loginpage(array $input){
    $username = $input['username'];
    $password = $input['password'];

    $user = new User($username,$password);

    
    try{
        $user->connection = new DataBaseConnection();
        $result = $user->validateCredentials($username,$password);
        if ($result) {
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['type'] = $result['type'];
        }
        echo "Connexion reussi";

    }catch(Exception $e){
        echo "Une nouvelle erreur est survenu ".$e->getMessage();


    }

    if ($_SESSION['type'] === 'admin'){

        
        header("Location: index.php?action=admin");
    }

}