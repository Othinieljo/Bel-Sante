<?php
require_once('src/lib/database.php');
class Notification {
    public $IDNOTIFICATION;
    public $id_user;
    public $message;
    public $STATUT;


    public DataBaseConnection $connection;




    public function SendNotification($id_user,$message){
        $stmt = $this->connection->getConnection()->prepare("
        INSERT INTO NOTIFICATION (id_user,message,STATUT)
        VALUES (?, ?, ?)");
        
        $success = $stmt->execute([$id_user,$message, 0]);

        if($success){
            return true;
        } else {
            return false;
        }

    }

    public function UpdateNotification($IDNOTIFICATION){
        $stmt = $this->connection->getConnection()->prepare(
            "UPDATE NOTIFICATION 
            SET STATUT = ?"
        );
        $success = $stmt->execute([1]);

        if($success){
            return true;
        }else{
            return false;
        }
    }

    public function GetAllNotifications($id_user){
        $stmt = $this->connection->getConnection()->prepare("
        SELECT * FROM NOTIFICATION WHERE id_user = ?");
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function CountNotificationsNotS($id_user) {
        // Préparer la requête SQL pour compter les notifications non lues
        $stmt = $this->connection->getConnection()->prepare("
            SELECT COUNT(*) as unread_count 
            FROM NOTIFICATION 
            WHERE id_user = ? AND STATUT = 0
        ");
    
        // Exécuter la requête en passant l'ID de l'utilisateur
        $stmt->execute([$id_user]);
    
        // Récupérer le résultat de la requête
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retourner le nombre de notifications non lues
        return $result['unread_count'];
    }
    








}