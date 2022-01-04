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
    $MissionManager = new MissionManager(); 
    $listMissions = $MissionManager->getMissions(""); 
    require('view/Mission/listMissions.php');
}

//  detail d'un mission ___________________________________________________
function showMission(int $Id)
{
    $MissionManager = new MissionManager(); 
    $showMission = $MissionManager->getMission($Id); 
    $missionAgents = $MissionManager->getAgentsFromMission($Id);
    $missionTargets = $MissionManager->getTargetsFromMission($Id);
    $missionContacts = $MissionManager->getContactsFromMission($Id);
    $missionHideaways = $MissionManager->getHideawaysFromMission($Id);
    require('view/Mission/showMission.php'); 
}


// DELETE un mission ______________________________________________________
function deleteMission(int $Id)
{
    $MissionManager = new MissionManager();
    $showMission = $MissionManager->getMission($Id);
    $mission = $showMission->fetchObject('Mission');
    if ($mission->getStatutId()<3){
    $deleteMission = $MissionManager->deleteMission($Id); 
    header("Location: ?entity=missions");
    } else {
        echo('une mission terminée ne peut être supprimée !!!');
    }
}

// prepare l'update d'un mission ___________________________________________________
function editMission(int $Id)
{
    $MissionManager = new MissionManager(); 
    $showMission = $MissionManager->getMission($Id); 
    $mission = $showMission->fetchObject('Mission');
    if($mission) {
        if ($mission->getStatutId()<3){
        $missionAgents = $MissionManager->getAgentsFromMission($Id);
        $missionTargets = $MissionManager->getTargetsFromMission($Id);
        $missionContacts = $MissionManager->getContactsFromMission($Id);
        $missionHideaways = $MissionManager->getHideawaysFromMission($Id);
        require('view/Mission/editMission.php');
        }else {
            echo('une mission terminée ne peut plus être éditée !!!');
        }
    }else {
        echo('Aucun resultat pour cette requête !');
    }
}


// update  mission traitement du formulaire _________________________________________
if (isset($_POST['MissionId']) && $_POST['MissionId']<> 0 && isset($_POST['missionUpdate'])) 
{
    if ($_POST['isConform']==1) {
        $statut = $_POST['statutId'];
    }else {
        $statut = 1;
    }
    $updatedMission = new Mission(
        htmlspecialchars($_POST['title'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['descriptions'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true), 
        htmlspecialchars($_POST['countryId']),
        htmlspecialchars($_POST['typeId']),
        htmlspecialchars($statut),
        htmlspecialchars($_POST['specialityId']),
        htmlspecialchars($_POST['startDate']),
        htmlspecialchars($_POST['endDate']),
        $_POST['isConform']
    );
    
    $MissionManager = new MissionManager(); 
    $MissionManager->writeMission($updatedMission);
    header("Location: ?entity=missions");
}


// _______________ formulaire Ajout d'un mission ___________________________________________________
function newMission()
{
    require('view/Mission/newMission.php');
}

// traitement du formulaire Ajout d'une mission  _________________________________________
if (isset($_POST['missionId']) && $_POST['missionId']== 0 && isset($_POST['MissionAdd'])) 
{
    $newMission = new Mission(
        htmlspecialchars($_POST['title'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['descriptions'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true), 
        htmlspecialchars($_POST['countryId']),
        htmlspecialchars($_POST['typeId']),
        htmlspecialchars(1),                  //en preparation par defaut
        htmlspecialchars($_POST['specialityId']),
        htmlspecialchars($_POST['startDate']),
        htmlspecialchars($_POST['endDate'])
    );

    $MissionManager = new MissionManager(); 
    $MissionManager->postMission($newMission);
}

if (isset($_POST['filter']))
{
    $filter = htmlspecialchars($_POST['where']);
    $MissionManager = new MissionManager(); 
    $listMissions = $MissionManager->getMissions("$filter"); 
    require('view/Mission/listMissions.php');
}


