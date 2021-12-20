<?php

require_once('model/SpecialityManager.php');

function listSpecialities() 
{
    //echo(' dans Speciality controller)');
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $listSpecialities = $SpecialityManager->getSpecialities(); // Appel d'une fonction de cet objet
    require('view/Speciality/listSpecialities.php');
}

function showSpeciality(int $id)
{
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $showSpeciality = $SpecialityManager->getSpeciality($id); // Appel d'une fonction de cet objet
    require('view/Speciality/showSpeciality.php');
}

function editSpeciality(int $id)
{
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $showSpeciality = $SpecialityManager->getSpeciality($id); // Appel d'une fonction de cet objet
    require('view/Speciality/editSpeciality.php');
}

function newSpeciality()
{
    require('view/Speciality/newSpeciality.php');
}

function deleteSpeciality(int $id)
{
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $deleteSpeciality = $SpecialityManager->deleteSpeciality($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=specialities");
}


// traitement update

if (isset($_POST['SpecialityId']) && $_POST['SpecialityId']<> 0 ) 
{
    $updatedSpeciality = new Speciality(
        htmlspecialchars($_POST['speciality']),
    );
    
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $SpecialityManager->writeSpeciality($updatedSpeciality);
    header("Location: ?entity=specialities&id=".$_POST['SpecialityId']."&action=show");
}


// traitement Ajout
if (isset($_POST['SpecialityId']) && $_POST['SpecialityId']== 0 ) 
{
    $newSpeciality = new Speciality(htmlspecialchars($_POST['speciality']));
    $SpecialityManager = new SpecialityManager(); // Création d'un objet
    $SpecialityManager->postSpeciality($newSpeciality);
    header("Location: ".$_POST['returnTo']);
}





