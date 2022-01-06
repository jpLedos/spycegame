<?php

require_once('model/SpecialityManager.php');

function listSpecialities() 
{
    //echo(' dans Speciality controller)');
    $SpecialityManager = new SpecialityManager(); 
    $listSpecialities = $SpecialityManager->getSpecialities(); 
    require('view/speciality/listSpecialities.php');
}

function showSpeciality(int $id)
{
    $SpecialityManager = new SpecialityManager(); 
    $showSpeciality = $SpecialityManager->getSpeciality($id); 
    $specialityMissions = $SpecialityManager->getMissionsFromSpeciality($id);
    $specialityAgents = $SpecialityManager->getAgentsFromspeciality($id);
    require('view/speciality/showSpeciality.php');
}

function editSpeciality(int $id)
{
    $SpecialityManager = new SpecialityManager(); 
    $showSpeciality = $SpecialityManager->getSpeciality($id); 
    $specialityMissions = $SpecialityManager->getMissionsFromSpeciality($id);
    $specialityAgents = $SpecialityManager->getAgentsFromspeciality($id);
    require('view/speciality/editSpeciality.php');
}

function newSpeciality()
{
    require('view/speciality/newSpeciality.php');
}

function deleteSpeciality(int $id)
{
    $SpecialityManager = new SpecialityManager(); 
    $specialityMissions = $SpecialityManager->getMissionsFromSpeciality($id);
    $specialityAgents = $SpecialityManager->getAgentsFromspeciality($id);
    if($specialityMissions->rowCount()==0 && $specialityAgents->rowCount()==0) {
    $deleteSpeciality = $SpecialityManager->deleteSpeciality($id); 
    header("Location: ?entity=specialities");
    } else {
        echo("Une specialité appartenant à des missions ou des agents ne peut être supprimée !");
    }
}


// traitement update

if (isset($_POST['SpecialityId']) && $_POST['SpecialityId']<> 0 && isset($_POST['specialityUpdate'])) 
{
    $updatedSpeciality = new Speciality(
        htmlspecialchars($_POST['speciality'],ENT_QUOTES,'UTF-8',true),
    );
    
    $SpecialityManager = new SpecialityManager(); 
    $SpecialityManager->writeSpeciality($updatedSpeciality);
    header("Location: ?entity=specialities&id=".$_POST['SpecialityId']."&action=show");
}


// traitement Ajout
if (isset($_POST['SpecialityId']) && $_POST['SpecialityId']== 0 && isset($_POST['specialityAdd'])) 
{
    $newSpeciality = new Speciality(htmlspecialchars($_POST['speciality'],ENT_QUOTES,'UTF-8',true));
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $SpecialityManager->postSpeciality($newSpeciality);
    header("Location: ".$_POST['returnTo']);
}





