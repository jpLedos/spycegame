<?php

require_once('model/MissionManager.php');

require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)
require_once('model/SpecialityManager.php');// besoin pour le name de la spe
require_once('model/TypeManager.php'); // pour le type en clair
require_once('model/StatutManager.php'); // pour le statut en clair

require_once('model/AgentManager.php'); // pour les agents
require_once('model/TargetManager.php'); // pour les cibles
require_once('model/ContactManager.php'); // pour les contacts
require_once('model/HideawayManager.php'); // pour les planques
require_once('model/HydeawayTypeManager.php'); // pour les type de planques

require_once('Controller/MissionAgentsController.php');
require_once('Controller/MissionTargetsController.php');
require_once('Controller/MissionContactsController.php');
require_once('Controller/MissionHideawaysController.php');


// liste des mission ______________________________________________________
function listMissions() 
{
    //echo(' dans Mission controller)');
    $MissionManager = new MissionManager(); // Création d'un objet
    $listMissions = $MissionManager->getMissions(); // Appel d'une fonction de cet objet
    require('view/Mission/listMissions.php');
}

//  detail d'un mission ___________________________________________________
function showMission(int $Id)
{
    $MissionManager = new MissionManager(); // Création d'un objet
    $showMission = $MissionManager->getMission($Id); 
    $missionAgents = $MissionManager->getAgentsFromMission($Id);
    $missionTargets = $MissionManager->getTargetsFromMission($Id);
    $missionContacts = $MissionManager->getContactsFromMission($Id);
    $missionHideaways = $MissionManager->getHideawaysFromMission($Id);
    require('view/Mission/showMission.php'); 
}


// DELETE un mission ______________________________________________________
function deleteMission(int $id)
{
    $MissionManager = new MissionManager(); // Création d'un objet
    $deleteMission = $MissionManager->deleteMission($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=missions");
}

// prepare l'update d'un mission ___________________________________________________
function editMission(int $Id)
{
    $MissionManager = new MissionManager(); // Création d'un objet
    $showMission = $MissionManager->getMission($Id); // Appel d'une fonction de cet objet
    $missionAgents = $MissionManager->getAgentsFromMission($Id);
    $missionTargets = $MissionManager->getTargetsFromMission($Id);
    $missionContacts = $MissionManager->getContactsFromMission($Id);
    $missionHideaways = $MissionManager->getHideawaysFromMission($Id);
    require('view/Mission/editMission.php');
}


// update  mission traitement du formulaire _________________________________________
if (isset($_POST['MissionId']) && $_POST['MissionId']<> 0 && isset($_POST['missionUpdate'])) 
{
    $updatedMission = new Mission(
        htmlspecialchars($_POST['title']),
        htmlspecialchars($_POST['descriptions']),
        htmlspecialchars($_POST['code']), 
        htmlspecialchars($_POST['countryId']),
        htmlspecialchars($_POST['typeId']),
        htmlspecialchars($_POST['statutId']),
        htmlspecialchars($_POST['specialityId']),
        htmlspecialchars($_POST['startDate']),
        htmlspecialchars($_POST['endDate'])
    );
    
    $MissionManager = new MissionManager(); // Création d'un objet
    $MissionManager->writeMission($updatedMission);
    header("Location: ?entity=missions&id=".$_POST['MissionId']."&action=show");
}


// affiche formulaire Ajout d'un mission ___________________________________________________
function newMission()
{
    require('view/Mission/newMission.php');
}

// traitement du formulaire Ajout d'une mission  _________________________________________
if (isset($_POST['MissionID']) && $_POST['MissionID']== 0 && isset($_POST['MissionAdd'])) 
{
    $newMission = new Mission(
        htmlspecialchars($_POST['firstname']),
        htmlspecialchars($_POST['lastname']),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code']),
        htmlspecialchars(intval($_POST['countryId'])),
        0 ); // pour Vivant par defaut

    $MissionManager = new MissionManager(); // Création d'un objet
    $MissionManager->postMission($newMission);
}


