<?php

require_once('Controller/AgentController.php');

if (isset($_GET['action'])) {
    
    switch($_GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                    showAgent($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;
        
        case 'edit' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {   
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                             
                    editAgent($_GET['id']);
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }                    
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;

        case 'new' :         
            newAgent();          
        break;
        
        case 'delete' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    deleteAgent($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;

        case 'specialities' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    specialities($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;

        
        default : 
        try {
            listAgents(); 
        } 
        catch (Exception $e) {
            echo($e->getMessage());
            echo('erreur au chargment des cibles');
        }
    }

} else {
    listAgents(); 
}