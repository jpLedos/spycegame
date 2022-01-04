<?php
// formmulaire de gestion des contacts de la mission _____________________________________
function editContacts($Id) 
{
    $MissionManager = new MissionManager(); 
    $showMission = $MissionManager->getMission($Id); 
    $contactManager = new ContactManager(); 
    $listContacts = $contactManager->getContacts(); 
    require('view/Mission/listMissionContacts.php');
}

function getIsMissionContact($missionId, $contactId)
{
    $MissionManager = new MissionManager(); 
    return $MissionManager->isMissionContact($missionId, $contactId);
}


//Traitement de la mise à jour des contacts
if (isset($_POST['contactsUpdated']) ) 
{
    $MissionManager = new MissionManager(); 
    $MissionManager->purgeMissionContacts($_POST['missionId']); // on efface tous avant de reecrire
    //$MissionManager->updateSpeciality($newMission);
    foreach($_POST as $post => $value) {
        if(substr($post,0,9)==="toBeAdded") {
            $MissionManager->addContactToMission($_POST['missionId'],$value); 
        }
    } ;

    header("Location: ?entity=missions&id=".$_POST['missionId']."&action=edit");
}
