<?php
require_once('src/models/dossier.php');
require_once('src/models/user.php');
require_once('src/models/necessiter.php');
require_once('src/models/specialiste.php');
require_once('src/models/consultation.php');
require_once('src/models/participer.php');
require_once('src/models/notification.php');
require_once('session.php');
function specialistePage(){


    
    
    $specialiste = new Specialiste();
    $user = new User();
    $notification = new Notification();

    try{
        $user->connection = new DataBaseConnection();
        $userAdmin = $user->GetUserByID($_SESSION['id_user']);
        $specialiste->connection = new DataBaseConnection();
        $notification->connection = new DataBaseConnection();
        $specialistes = $specialiste->AllSpecialiste();
        $notif = $notification->CountNotificationsNotS($_SESSION['id_user']);
       
       
    

    }catch(Exception $e){
        // echo "Une nouvelle erreur est survenu".$e->getMessage();

    }
    require('./src/templates/admin/specialistes.php');
}