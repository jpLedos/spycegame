<?php

require_once('Controller/TargetController.php');

if (isset($_GET['action'])) {
    
    switch($_GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                try {     
                    showTarget($_GET['id']);
                } catch (Exception $e) {
                    echo('une erreur d\'acces à la base de donnée est survenue');
                }   
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;
        
        case 'edit' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {            
                    editTarget($_GET['id']);
                 } else {
                    echo 'Erreur : Vous n\'avez pas les droits';
                 }
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;

        case 'new' :         
            newTarget();          
        break;
        
        case 'delete' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                
                    deleteTarget($_GET['id']);
                } else {
                    echo 'Erreur : Vous n\'avez pas les droits';
                }
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;
        
        default : 
        try {
            listTargets(); 
        } 
        catch (Exception $e) {
            echo($e->getMessage());
            echo('erreur au chargment des cibles');
        }
    }

} else {
    listTargets(); 
}