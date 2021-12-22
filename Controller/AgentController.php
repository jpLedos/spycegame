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
    require('view/Agent/listAgents.php');
}

//  detail d'un agent ___________________________________________________
function showAgent(int $Id)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $showAgent = $AgentManager->getAgent($Id); // Appel d'une fonction de cet objet
    $agentSpecialities = $AgentManager->getSpecialitiesFromAgent($Id);
    require('view/Agent/showAgent.php');

    
}


// DELETE un agent ______________________________________________________
function deleteAgent(int $id)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $deleteAgent = $AgentManager->deleteAgent($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=Agents");
}

// prepare l'update d'un agent ___________________________________________________
function editAgent(int $Id)
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $showAgent = $AgentManager->getAgent($Id); // Appel d'une fonction de cet objet
    $agentSpecialities = $AgentManager->getSpecialitiesFromAgent($Id);
    require('view/Agent/editAgent.php');
}


// update  agent traitement du formulaire _________________________________________
if (isset($_POST['AgentID']) && $_POST['AgentID']<> 0 && isset($_POST['agentUpdate'])) 
{
    $updatedAgent = new Agent(
        htmlspecialchars($_POST['firstname']),
        htmlspecialchars($_POST['lastname']),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code']), 
        htmlspecialchars($_POST['countryId']),   
        isset($_POST['isDead'])? 0 : 1
    );
    
    $AgentManager = new AgentManager(); // Création d'un objet
    $AgentManager->writeAgent($updatedAgent);
    header("Location: ?entity=agents&id=".$_POST['AgentID']."&action=show");
}


// affiche formulaire Ajout d'un agent ___________________________________________________
function newAgent()
{
    require('view/Agent/newAgent.php');
}

// traitement du formulaire Ajout d'agent  _________________________________________
if (isset($_POST['AgentID']) && $_POST['AgentID']== 0 && isset($_POST['AgentAdd'])) 
{
    $newAgent = new Agent(
        htmlspecialchars($_POST['firstname']),
        htmlspecialchars($_POST['lastname']),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars($_POST['code']),
        htmlspecialchars(intval($_POST['countryId'])),
        0 ); // pour Vivant par defaut

    $AgentManager = new AgentManager(); // Création d'un objet
    $AgentManager->postAgent($newAgent);
}

// formmulaire de gestion des specialité de l'agent ________________________________________________
function specialities($Id) 
{
    $AgentManager = new AgentManager(); // Création d'un objet
    $showAgent = $AgentManager->getAgent($Id); // Appel d'une fonction de cet objet
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $listSpecialities = $SpecialityManager->getSpecialities(); // Appel d'une fonction de cet objet
    require('view/Agent/listSpecialities.php');
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

    header("Location: ?entity=agents&id=".$_POST['AgentId']."&action=edit");
}



