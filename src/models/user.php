<?php
require_once('src/lib/database.php');
class User{
    public $id_user;
    public $username;
    public $password;
    public $email;
    public $numero;
    public $type;
    public $photourl;



    public DatabaseConnection $connection;

    public function validateCredentials($username,$password){
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Retourne l'utilisateur s'il existe et que le mot de passe est correct
        } else {
            return false; // Retourne false si les identifiants sont invalides
        }


    }
    public function addUser($username, $password,$email,$numero,$type,$photourl){
        // Vérifier si l'utilisateur existe déjà
        $stmt_check = $this->connection->getConnection()->prepare("SELECT * FROM user WHERE username = ?");
        $stmt_check->execute([$username]);
        $existing_user = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if($existing_user){
            return false; // L'utilisateur existe déjà, retourner false
        }

        // Hasher le mot de passe avant de l'insérer dans la base de données
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $stmt_insert = $this->connection->getConnection()->prepare("INSERT INTO user (username, password,email,numero,type,photourl) VALUES (?, ?,?,?,?,?)");
        $stmt_insert->execute([$username, $hashed_password,$email,$numero,$type,$photourl]);

        // Vérifier si l'insertion a réussi
        if($stmt_insert->rowCount() > 0){
            return true; // Insertion réussie, retourner true
        } else {
            return false; // Erreur lors de l'insertion, retourner false
        }
    }
    function CountNonAdminUsers(){
    
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) as total FROM user WHERE type != 'admin'");
         
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['total'];
    }
    public function GetUserByID($id_user){
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM user WHERE id_user = ?");
        $stmt->execute([$id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}



?>