<?php
// formmulaire de gestion des agents de la mission _____________________________________
function editAgents($Id) 
{
    $MissionManager = new MissionManager(); // Création d'un objet
    $showMission = $MissionManager->getMission($Id); // Appel d'une fonction de cet objet
    $agentManager = new AgentManager(); // Création d'un objet
    $listAgents = $agentManager->getAgents(); // Appel d'une fonction de cet objet
    require('view/Mission/listMissionAgents.php');
}

function getIsMissionAgent($missionId, $agentId)
{
    $MissionManager = new MissionManager(); 
    return $MissionManager->isMissionAgent($missionId, $agentId);
}


//Traitement de la mise à jour des agents
if (isset($_POST['agentsUpdated']) ) 
{
    $MissionManager = new MissionManager(); 
    $MissionManager->purgeMissionAgents($_POST['missionId']); // on efface tous avant de reecrire
    //$MissionManager->updateSpeciality($newMission);
    foreach($_POST as $post => $value) {
        if(substr($post,0,9)==="toBeAdded") {
            $MissionManager->addAgentToMission($_POST['missionId'],$value); 
        }
    } ;

    header("Location: ?entity=missions&id=".$_POST['missionId']."&action=edit");
}
