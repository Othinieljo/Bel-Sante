<?php
require_once('src/models/user.php');
require_once('src/models/specialiste.php');
require_once('src/models/service.php');
require_once('session.php');
function NewServiceAndUser(array $input){
    $username = $input['username'];
    $password1 = $input['password1'];
    $password2 = $input['password2'];
    $type = "service";
    $numero = $input['numero'];
    $NOMSERVICE = $input['NOMSERVICE'];
    $RESPONSABLE = $input['RESPONSABLE'];
    
    if($password1 === $password2){
        $user = new User();
        try{
            $user->connection = new DataBaseConnection();
            $result = $user->addUser($username,$password1,null,$numero,$type,null);
            if($result){
                $lastInsertId = $user->connection->getConnection()->lastInsertId();
                $service = new Service();
                try{
                    
                    $service->connection = new DataBaseConnection();
                    $serv = $service->NewService($lastInsertId,$NOMSERVICE,$RESPONSABLE);
                    if ($serv){
                        header("Location: /Bel-Sante/admin");
                    }

                }catch(Exception $i){
                    echo "Une nouvelle erreur est survenu".$i->getMessage();
                }
                
            }

        }catch(Exception $e){
            echo 'Une nouvelle erreur est survenu est'.$e->getMessage();
        }

    }else{

    }

    

}