<?php
$config = require('../Bel-Sante/config.php');
$host = $config['DB_HOST'];
$name = $config['DB_NAME'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
class DataBaseConnection {
    public ?PDO $database = null ;


    public function getConnection(): PDO{
        global $host, $name, $user, $pass ;

        if ($this->database === null) {
            $this->database = new PDO('mysql:host='.$host.';dbname='.$name.';charset=utf8',$user,$pass);

        }
        return $this->database;



    }



}