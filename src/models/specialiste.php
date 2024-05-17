<?php
require_once('src/lib/database.php');
class Specialiste{
    public $IDSPECIALISTE;
    public $id_user;
    public $NOMSPECIALISTE;
    public $PRENOMSPECIALISTE;
    public $SEXEPECIALISTE;
    public $SPECIALITEDUSPECIALISTE;
    public $GRADESPECIALISTE;

    public DataBaseConnection $connection;

    public function NewSpecialiste(
    $id_user,$NOMSPECIALISTE,$PRENOMSPECIALISTE,$SEXEPECIALISTE,$SPECIALITEDUSPECIALISTE,$GRADESPECIALISTE){
        $stmt = $this->connection->getConnection()->prepare("
        INSERT INTO SPECIALISTE (id_user,NOMSPECIALISTE,PRENOMSPECIALISTE,SEXESPECIALISTE,SPECIALITEDUSPECIALISTE,GRADESPECIALISTE)
        VALUES (?,?,?,?,?,?)");
        $success = $stmt->execute([$id_user,$NOMSPECIALISTE,$PRENOMSPECIALISTE,$SEXEPECIALISTE,
        $SPECIALITEDUSPECIALISTE,$GRADESPECIALISTE]);

        if ($success){
            return true;
        }else{
            return false;
        }


        
   

    }
    public function AllSpecialiste(){
        $stmt = $this->connection->getConnection()->prepare("SELECT * FROM SPECIALISTE");
         
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }
}