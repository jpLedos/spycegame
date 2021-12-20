<?php

require_once('Controller/TypeController.php');

if (isset($_GET['action'])) {
    
    switch($_GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                    showType($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;
        
        case 'edit' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {   
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                             
                    editType($_GET['id']);
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }                    
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;

        case 'new' :         
            newType();          
        break;
        
        case 'delete' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {                 
                    deleteType($_GET['id']);  
                } else { 
                    echo 'Erreur : Vous n\'avez pas les droits';  
                }      
        }   else {
            echo 'Erreur : aucun identifiant de cible envoyé';
        }               
        break;
        
        default : 
        try {
            listTypes(); 
        } 
        catch (Exception $e) {
            echo($e->getMessage());
            echo('erreur au chargment des cibles');
        }
    }

} else {
    listTypes(); 
}