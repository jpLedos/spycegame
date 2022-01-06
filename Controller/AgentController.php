<?php

require_once('model/AgentManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)
require_once('model/SpecialityManager.php');

// liste des agent ______________________________________________________
function listAgents() 
{
    //echo(' dans Agent controller)');
    $AgentManager = new AgentManager(); // Création d'un objet
    $listAgents = $AgentManager->getAgents(); // Appel d'une fonction de cet objet
    require('view/agent/listAgents.php');
}

//  detail d'un agent ___________________________________________________
function showAgent(int $Id)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $showAgent = $AgentManager->getAgent($Id); // Appel d'une fonction de cet objet
    $agentSpecialities = $AgentManager->getSpecialitiesFromAgent($Id);
    $agentMissions = $AgentManager->getMissionsFromAgent($Id);
    require('view/agent/showAgent.php');

    
}


// DELETE un agent ______________________________________________________
function deleteAgent(int $id)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $agentMissions = $AgentManager->getMissionsFromAgent($id);
    if($agentMissions->rowCount()==0) {
        $deleteAgent = $AgentManager->deleteAgent($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=agents");
    } else {
        echo("Un agent ayant des missions ne peut être supprimé !");
    }
}

// prepare l'update d'un agent ___________________________________________________
function editAgent(int $Id)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $showAgent = $AgentManager->getAgent($Id); // Appel d'une fonction de cet objet
    $agentSpecialities = $AgentManager->getSpecialitiesFromAgent($Id);
    $agentMissions = $AgentManager->getMissionsFromAgent($Id);
    require('view/agent/editAgent.php');
}


// update  agent traitement du formulaire _________________________________________
if (isset($_POST['AgentID']) && $_POST['AgentID']<> 0 && isset($_POST['agentUpdate'])) 
{
    $updatedAgent = new Agent(
        htmlspecialchars($_POST['firstname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true), 
        htmlspecialchars($_POST['countryId']),   
        isset($_POST['isDead'])? 0 : 1,
        htmlspecialchars($_POST['isConform'])
    );
    
    $AgentManager = new AgentManager(); // Création d'un objet
    $AgentManager->writeAgent($updatedAgent);
    //header("Location: ".$_POST['returnToUrl']);
    if($_POST['missionId']){
       header("Location: ?entity=missions&id=".$_POST['missionId']."&action=editAgents") ;
    }
}


// affiche formulaire Ajout d'un agent ___________________________________________________
function newAgent()
{
    require('view/agent/newAgent.php');
}

// traitement du formulaire Ajout d'agent  _________________________________________
if (isset($_POST['AgentID']) && $_POST['AgentID']== 0 && isset($_POST['agentAdd'])) 
{
    $newAgent = new Agent(
        htmlspecialchars($_POST['firstname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars(intval($_POST['countryId'])),
        0 ); // pour Vivant par defaut

    $AgentManager = new AgentManager(); // Création d'un objet
    $AgentManager->postAgent($newAgent);

    header("Location: ".$_POST['returnToUrl']);
}

// formmulaire de gestion des specialité de l'agent ________________________________________________
function specialities($Id) 
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $showAgent = $AgentManager->getAgent($Id); // Appel d'une fonction de cet objet
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $listSpecialities = $SpecialityManager->getSpecialities(); // Appel d'une fonction de cet objet
    require('view/agent/listSpecialities.php');
}

function getIsAgentSpeciality($agentId, $specialityId)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    return $AgentManager->isAgentSpeciality($agentId, $specialityId);
}


//Traitement de la mise à jour des specialités
if (isset($_POST['specialityUpdated']) ) 
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $AgentManager->purgeAgentSpecialities($_POST['AgentId']); // on efface tous
    //$AgentManager->updateSpeciality($newAgent);
    foreach($_POST as $post => $value) {
        if(substr($post,0,9)==="toBeAdded") {
            $AgentManager->addSpecialityToAgent($_POST['AgentId'],$value); 
        }
    } ;
    $redirection=" ?entity=agents&id=".$_POST['AgentId']."&action=edit&missionId=".$_POST['missionId'];
    //echo $redirection;die;
    //header("Location : ".$redirection,true);
    header("Location: ".$_POST['returnTo']);
}



