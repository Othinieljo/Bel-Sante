<?php
require_once('src/lib/database.php');
class User{
    public $username;
    public $password;
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
}

?>