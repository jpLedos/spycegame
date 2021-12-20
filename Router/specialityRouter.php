<?php

require_once('Controller/SpecialityController.php');

if (isset($_GET['action'])) {
    
    switch($_GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                    showSpeciality($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;
        
        case 'edit' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {  
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {            
                    editSpeciality($_GET['id']);
            } else { 
                echo 'Erreur : Vous n\'avez pas les droits';
            }
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;

        case 'new' :         
            newSpeciality();          
        break;
        
        case 'delete' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) {  
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                
                    deleteSpeciality($_GET['id']);
                } else { 
                }       echo 'Erreur : Vous n\'avez pas les droits';  
            } else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;
        
        default : 
        try {
            listSpecialities(); 
        } 
        catch (Exception $e) {
            echo($e->getMessage());
            echo('erreur au chargment');
        }
    }

} else {
    listSpecialities(); 
}