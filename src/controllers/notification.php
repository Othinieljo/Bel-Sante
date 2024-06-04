<?php
require_once('session.php');


function notificationPage(){
    switch($_SESSION['type']){

        case 'admin':
            
            require('./src/templates/admin/notification.php');
            break;
        case 'receptioniste':

           
            
            
            require('./src/templates/dashboardAcceuil/admin.php');
            break;    
        case 'specialiste':
            
            require('./src/templates/specialisteDashboard/notification.php');
            break;
        case 'service':
            
            require('./src/templates/servicesExamenDashboard/notification.php');
            break;
        default:
            echo 'Page not found';
            break;

    }

}