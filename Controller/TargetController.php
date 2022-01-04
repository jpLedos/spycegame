<?php

require_once('model/TargetManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listTargets() 
{
    //echo(' dans target controller)');
    $TargetManager = new TargetManager(); 
    $listTargets = $TargetManager->getTargets(); 
    require('view/target/listTargets.php');
}

function showTarget(int $id)
{
    $targetManager = new TargetManager(); 
    try {
        $showTarget = $targetManager->getTarget($id);
        $targetMissions = $targetManager->getMissionsFromTarget($id); 
    } catch (Exception $e) {
        echo($e->getMessage());
    }
    
    require('view/target/showTarget.php');
}

function editTarget(int $id)
{
    $targetManager = new TargetManager(); 
    $showTarget = $targetManager->getTarget($id);
    $targetMissions = $targetManager->getMissionsFromTarget($id); 
    require('view/target/editTarget.php');
}

function newTarget()
{
    require('view/target/newTarget.php');
}

function deleteTarget(int $id)
{
    $targetManager = new TargetManager(); // Création d'un objet
    $targetMissions = $targetManager->getMissionsFromTarget($id); 
    if($targetMissions->rowCount()==0) {
    $deleteTarget = $targetManager->deleteTarget($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=targets");
    }else{
        echo("Une cible ayant des missions ne peut être supprimée !");
    }
}


// traitement d'un post

if (isset($_POST['targetID']) && $_POST['targetID']<> 0  && isset($_POST['targetUpdate'])) 
{
    $updatedTarget = new Target(
        htmlspecialchars($_POST['firstname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true), 
        htmlspecialchars($_POST['countryId']),   
        isset($_POST['isDead'])? 0 : 1
    );
    
    $targetManager = new TargetManager(); // Création d'un objet
    $targetManager->writeTarget($updatedTarget);
    header("Location: ".$_POST['returnToUrl']);
}

if (isset($_POST['targetID']) && $_POST['targetID']== 0 && isset($_POST['targetAdd'])) 
{
    $newTarget = new Target(
        htmlspecialchars($_POST['firstname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars(intval($_POST['countryId'])),
         0 ); // pour Vivant par defaut

    $targetManager = new TargetManager(); // Création d'un objet
    $targetManager->postTarget($newTarget);
    header("Location: ".$_POST['returnToUrl']);
}





