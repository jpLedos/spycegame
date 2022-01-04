<?php

require_once('model/ContactManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listContacts() 
{
    //echo(' dans Contact controller)');
    $ContactManager = new ContactManager(); 
    $listContacts = $ContactManager->getContacts(); 
    require('view/Contact/listContacts.php');
}

function showContact(int $id)
{
    $ContactManager = new ContactManager(); 
    $showContact = $ContactManager->getContact($id);
    $contactMissions = $ContactManager->getMissionsFromContact($id);  
    require('view/Contact/showContact.php');
}

function editContact(int $id)
{
    $ContactManager = new ContactManager(); 
    $showContact = $ContactManager->getContact($id); 
    $contactMissions = $ContactManager->getMissionsFromContact($id); 
    require('view/Contact/editContact.php');
}

function newContact()
{
    require('view/Contact/newContact.php');
}

function deleteContact(int $id)
{
    $ContactManager = new ContactManager(); // Création d'un objet
    $contactMissions = $ContactManager->getMissionsFromContact($id); 
    if($contactMissions->rowCount()==0) {
    $deleteContact = $ContactManager->deleteContact($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=contacts");
    }else{
        echo("Un contact ayant des missions ne peut être supprimé !");
    }
}


// traitement d'un post

if (isset($_POST['ContactID']) && $_POST['ContactID']<> 0  && isset($_POST['contactUpdate']) ) 
{
    $updatedContact = new Contact(
        htmlspecialchars($_POST['firstname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars( $_POST['code'],ENT_QUOTES,'UTF-8',true), 
        htmlspecialchars($_POST['countryId']),   
        isset($_POST['isDead'])? 0 : 1
    );
    
    $ContactManager = new ContactManager(); // Création d'un objet
    $ContactManager->writeContact($updatedContact);
    header("Location: ".$_POST['returnToUrl']);
}

if (isset($_POST['ContactID']) && $_POST['ContactID']== 0  && isset($_POST['contactAdd'])) 
{
    $newContact = new Contact(
        htmlspecialchars( $_POST['firstname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['lastname'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars($_POST['dateOfBirth']),
        htmlspecialchars( $_POST['code'],ENT_QUOTES,'UTF-8',true),
        htmlspecialchars(intval($_POST['countryId'])),
         0 ); // pour Vivant par defaut
    
    $ContactManager = new ContactManager(); // Création d'un objet
    $ContactManager->postContact($newContact);
    header("Location: ".$_POST['returnToUrl']);
}





