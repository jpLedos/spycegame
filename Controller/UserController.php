<?php

require_once('model/userManager.php');

$error = "";


// traitement Ajout
if (isset($_POST['login']) && $_POST['password']) {
    $userManager = new userManager(); // Création d'un objet
    $showUser = $userManager->getUser($_POST['login']); // Appel d'une fonction de cet objet
    $user = $showUser->fetchObject('User');
      if($user && password_verify($_POST['password'], $user->password))
      {
        $_SESSION["ADMIN"] = "yes";
        header("location:/?entity=users");
        $error= 'identification OK';
      } else {
        $error = 'Erreur d\'identification';
      }
  }




