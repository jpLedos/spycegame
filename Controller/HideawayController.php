<?php

require_once('model/HideawayManager.php');
require_once('model/HydeawayTypeManager.php');//besoin pour obtenir le getType(id)
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listHideaways() 
{
    //echo(' dans Hideaway controller)');
    $HideawayManager = new HideawayManager(); // Création d'un objet
    $listHideaways = $HideawayManager->getHideaways(); // Appel d'une fonction de cet objet
    require('view/hideaway/listHideaways.php');
}

function showHideaway(int $id)
{
    $HideawayManager = new HideawayManager(); // Création d'un objet
    $showHideaway = $HideawayManager->getHideaway($id); // Appel d'une fonction de cet objet
    require('view/Hideaway/showHideaway.php');
}

function editHideaway(int $id)
{
    $HideawayManager = new HideawayManager(); // Création d'un objet
    $showHideaway = $HideawayManager->getHideaway($id); // Appel d'une fonction de cet objet
    require('view/Hideaway/editHideaway.php');
}

function newHideaway()
{
    require('view/Hideaway/newHideaway.php');
}

function deleteHideaway(int $id)
{
    $HideawayManager = new HideawayManager(); // Création d'un objet
    $deleteHideaway = $HideawayManager->deleteHideaway($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=hideaways");
}


// traitement d'un post

if (isset($_POST['HideawayId']) && $_POST['HideawayId']<> 0 ) 
{

    $updatedHideaway = new Hideaway(
        htmlspecialchars($_POST['code']),
        htmlspecialchars($_POST['address']),
        htmlspecialchars($_POST['countryId']),   
        htmlspecialchars($_POST['hideawayTypeId'])  
    );

    $HideawayManager = new HideawayManager(); // Création d'un objet
    $HideawayManager->writeHideaway($updatedHideaway);
    header("Location: ?entity=hideaways&id=".$_POST['HideawayId']."&action=show");
}

//creation d une planque en bdd
if (isset($_POST['HideawayId']) && $_POST['HideawayId']== 0 ) 
{
    $newHideaway = new Hideaway(
        htmlspecialchars(htmlspecialchars($_POST['code'])),
        htmlspecialchars(htmlspecialchars($_POST['address'])),
        htmlspecialchars(htmlspecialchars($_POST['countryId'])),
        htmlspecialchars(htmlspecialchars($_POST['hideawayTypeId']))
     );

    $HideawayManager = new HideawayManager(); // Création d'un objet
    $HideawayManager->postHideaway($newHideaway);
}