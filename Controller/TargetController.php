<?php

require_once('model/TargetManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listTargets() 
{
    //echo(' dans target controller)');
    $TargetManager = new TargetManager(); // Création d'un objet
    $listTargets = $TargetManager->getTargets(); // Appel d'une fonction de cet objet
    require('view/target/listTargets.php');
}

function showTarget(int $id)
{
    $targetManager = new TargetManager(); // Création d'un objet
    $showTarget = $targetManager->getTarget($id); // Appel d'une fonction de cet objet
    require('view/target/showTarget.php');
}

function editTarget(int $id)
{
    $targetManager = new TargetManager(); // Création d'un objet
    $showTarget = $targetManager->getTarget($id); // Appel d'une fonction de cet objet
    require('view/target/editTarget.php');
}

function newTarget()
{
    require('view/target/newTarget.php');
}

function deleteTarget(int $id)
{
    $targetManager = new TargetManager(); // Création d'un objet
    $deleteTarget = $targetManager->deleteTarget($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=targets");
}


// traitement d'un post

if (isset($_POST['targetID']) && $_POST['targetID']<> 0 ) 
{
    $updatedTarget = new Target(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['dateOfBirth'],
        $_POST['code'], 
        $_POST['countryId'],   
        isset($_POST['isDead'])? 0 : 1
    );
    
      var_dump($updatedTarget);
    
    $targetManager = new TargetManager(); // Création d'un objet
    $targetManager->writeTarget($updatedTarget);
    header("Location: ?entity=targets&id=".$_POST['targetID']."&action=show");
}

if (isset($_POST['targetID']) && $_POST['targetID']== 0 ) 
{
    $newTarget = new Target(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['dateOfBirth'],
        $_POST['code'],
        intval($_POST['countryId']),
         0 ); // pour Vivant par defaut

    
    $targetManager = new TargetManager(); // Création d'un objet
    $targetManager->postTarget($newTarget);
    echo('ajouté');
}





