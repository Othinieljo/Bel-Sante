<?php

require_once('src/models/dossier.php');
require_once('src/models/user.php');
require_once('src/models/necessiter.php');
require_once('src/models/exam_comp.php');
require_once('src/models/specialiste.php');
require_once('src/models/consultation.php');
require_once('src/models/participer.php');
require_once('src/models/notification.php');
require_once('session.php');


function printexampage($id_consult){
    $necessiters = new Necessiter();
    try{
        $necessiters->connection = new DataBaseConnection();
        $result = $necessiters->GetNecessiterByConsultation($id_consult);
        // print_r($result);

    }catch(Exception $e){
        // echo "Une nouvelle erreur esr survenu".$e->getMessage();

    }
    
    require('src/templates/dashboardAcceuil/impressionEx.php');


}
function printconsultpage($id_consult){

    $consultations = new Consultation();
    try{
        $consultations->connection = new DataBaseConnection();
        $consultation = $consultations->GetConsultationByIDCONSULTATION($id_consult);
        // print_r($consultation);

    }catch(Exception $e){
        // echo "Une nouvelle est survenu".$e->getMessage();
    }
    require('src/templates/dashboardAcceuil/impressionCons.php');
    

}
