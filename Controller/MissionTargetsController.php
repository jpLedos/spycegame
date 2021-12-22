<?php
// formmulaire de gestion des targets de la mission _____________________________________
function editTargets($Id) 
{
    $MissionManager = new MissionManager(); // Création d'un objet
    $showMission = $MissionManager->getMission($Id); // Appel d'une fonction de cet objet
    $targetManager = new TargetManager(); // Création d'un objet
    $listTargets = $targetManager->getTargets(); // Appel d'une fonction de cet objet
    require('view/Mission/listMissionTargets.php');
}

function getIsMissionTarget($missionId, $targetId)
{
    $MissionManager = new MissionManager(); 
    return $MissionManager->isMissionTarget($missionId, $targetId);
}


//Traitement de la mise à jour des targets
if (isset($_POST['targetsUpdated']) ) 
{
    $MissionManager = new MissionManager(); 
    $MissionManager->purgeMissionTargets($_POST['missionId']); // on efface tous avant de reecrire
    //$MissionManager->updateSpeciality($newMission);
    foreach($_POST as $post => $value) {
        if(substr($post,0,9)==="toBeAdded") {
            $MissionManager->addTargetToMission($_POST['missionId'],$value); 
        }
    } ;

    header("Location: ?entity=missions&id=".$_POST['missionId']."&action=edit");
}
