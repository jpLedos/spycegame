<?php
// formmulaire de gestion des hideaways de la mission _____________________________________
function editHideaways($Id) 
{
    $MissionManager = new MissionManager(); // Création d'un objet
    $showMission = $MissionManager->getMission($Id); // Appel d'une fonction de cet objet
    $hideawayManager = new HideawayManager(); // Création d'un objet
    $listHideaways = $hideawayManager->getHideaways(); // Appel d'une fonction de cet objet
    require('view/mission/listMissionHideaways.php');
}

function getIsMissionHideaway($missionId, $hideawayId)
{
    $MissionManager = new MissionManager(); 
    return $MissionManager->isMissionHideaway($missionId, $hideawayId);
}


//Traitement de la mise à jour des hideaways
if (isset($_POST['hideawaysUpdated']) ) 
{
    $MissionManager = new MissionManager(); 
    $MissionManager->purgeMissionHideaways($_POST['missionId']); // on efface tous avant de reecrire
    //$MissionManager->updateSpeciality($newMission);
    foreach($_POST as $post => $value) {
        if(substr($post,0,9)==="toBeAdded") {
            $MissionManager->addHideawayToMission($_POST['missionId'],$value); 
        }
    } ;

    header("Location: ?entity=missions&id=".$_POST['missionId']."&action=edit");
}
