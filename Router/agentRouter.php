<?php
if (isset($_GET['action'])) {
    switch($GET['action']) {
        case 'show' : 
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                        showAgent($_GET['id']);
            } else {
                echo 'Erreur : aucun identifiant de billet envoyé';
            }           
        break;
        }   
} else {
    listAgent();
}
