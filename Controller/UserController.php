<?php

require_once('model/UserManager.php');

$error = "";


// traitement Ajout
if (isset($_POST['login']) && isset($_POST['password'])) {
    $userManager = new userManager(); // Création d'un objet
    $showUser = $userManager->getUser($_POST['login']); // Appel d'une fonction de cet objet
    $user = $showUser->fetchObject('User');
    
      if($user && password_verify($_POST['password'], $user->password))
      {
        $_SESSION["ADMIN"] = "yes";
        //$error= 'identification OK';
        //echo $error;die;
        header("location:/?entity=missions");
        
      } else {
        $error = 'Erreur d\'identification !';
      }
  }




