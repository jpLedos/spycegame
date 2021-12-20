<?php
 
 unset($_SESSION['ADMIN']);
 if (session_destroy()) {
    echo 'Session détruite !';
} else {
    echo 'Erreur : impossible de détruire la session !';
}

header("location:/?entity=users");

?>