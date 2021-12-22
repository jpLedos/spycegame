<?php

require_once('Controller/MissionController.php');

if (isset($_GET['action'])) {
    
    switch($_GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                    showMission($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;
        
        case 'edit' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {   
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                             
                    editMission($_GET['id']);
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }                    
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;

        case 'new' :         
            newMission();          
        break;
        
        case 'delete' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    deleteMission($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;

        case 'editAgents' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    editAgents($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;

        case 'editTargets' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    editTargets($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;

        case 'editContacts' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    editContacts($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;

        case 'editHideaways' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    editHideaways($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;
 
        default : 
        try {
            listMissions(); 
        } 
        catch (Exception $e) {
            echo($e->getMessage());
            echo('erreur au chargment des cibles');
        }
    }

} else {
    listMissions(); 
}