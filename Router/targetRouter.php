<?php

require_once('Controller/TargetController.php');

if (isset($_GET['action'])) {
    
    switch($_GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                    showTarget($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;
        
        case 'edit' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                    editTarget($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de cible envoyé';
            }           
        break;

        case 'new' :         
            newTarget();          
        break;
        
        case 'delete' :         
            if (isset($_GET['id']) && $_GET['id'] > 0) {               
                deleteTarget($_GET['id']);
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