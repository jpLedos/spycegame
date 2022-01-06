<?php

require_once('model/HideawayManager.php');
require_once('model/HydeawayTypeManager.php');//besoin pour obtenir le getType(id)
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listHideaways() 
{
    //echo(' dans Hideaway controller)');
    $HideawayManager = new HideawayManager(); 
    $listHideaways = $HideawayManager->getHideaways(); 
    require('view/hideaway/listHideaways.php');
}

function showHideaway(int $id)
{
    $HideawayManager = new HideawayManager(); 
    $showHideaway = $HideawayManager->getHideaway($id);
    $hideawayMissions = $HideawayManager->getMissionsFromHideaway($id); 
    require('view/hideaway/showHideaway.php');
}

function editHideaway(int $id)
{
    $HideawayManager = new HideawayManager(); 
    $showHideaway = $HideawayManager->getHideaway($id); 
    $hideawayMissions = $HideawayManager->getMissionsFromHideaway($id);
    require('view/hideaway/editHideaway.php');
}

function newHideaway()
{
    require('view/hideaway/newHideaway.php');
}

function deleteHideaway(int $id)
{
    $HideawayManager = new HideawayManager(); 
    $hideawayMissions = $HideawayManager->getMissionsFromHideaway($id);
    if($hideawayMissions->rowCount()==0) {
    $deleteHideaway = $HideawayManager->deleteHideaway($id); 
    header("Location: ?entity=hideaways");
    }else {
        echo("Une planque ayant des missions ne peut être supprimée !");
    }
}


// traitement d'un post

if (isset($_POST['HideawayId']) && $_POST['HideawayId']<> 0 && isset($_POST['hideawayUpdate'])) 
{

    $updatedHideaway = new Hideaway(
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['address'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['countryId']),   
        htmlspecialchars($_POST['hideawayTypeId'])  
    );

    $HideawayManager = new HideawayManager(); // Création d'un objet
    $HideawayManager->writeHideaway($updatedHideaway);
    header("Location: ".$_POST['returnToUrl']);
}

//creation d une planque en bdd
if (isset($_POST['HideawayId']) && $_POST['HideawayId']== 0 && isset($_POST['hideawayAdd'])) 
{
    $newHideaway = new Hideaway(
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['address'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['countryId']),
        htmlspecialchars($_POST['hideawayTypeId'])
     );

    $HideawayManager = new HideawayManager(); 
    $HideawayManager->postHideaway($newHideaway);
    header("Location: ".$_POST['returnToUrl']);
}