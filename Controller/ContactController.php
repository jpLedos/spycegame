<?php

require_once('model/ContactManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listContacts() 
{
    //echo(' dans Contact controller)');
    $ContactManager = new ContactManager(); // Création d'un objet
    $listContacts = $ContactManager->getContacts(); // Appel d'une fonction de cet objet
    require('view/Contact/listContacts.php');
}

function showContact(int $id)
{
    $ContactManager = new ContactManager(); // Création d'un objet
    $showContact = $ContactManager->getContact($id); // Appel d'une fonction de cet objet
    require('view/Contact/showContact.php');
}

function editContact(int $id)
{
    $ContactManager = new ContactManager(); // Création d'un objet
    $showContact = $ContactManager->getContact($id); // Appel d'une fonction de cet objet
    require('view/Contact/editContact.php');
}

function newContact()
{
    require('view/Contact/newContact.php');
}

function deleteContact(int $id)
{
    $ContactManager = new ContactManager(); // Création d'un objet
    $deleteContact = $ContactManager->deleteContact($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=contacts");
}


// traitement d'un post

if (isset($_POST['ContactID']) && $_POST['ContactID']<> 0 ) 
{
    $updatedContact = new Contact(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['dateOfBirth'],
        $_POST['code'], 
        $_POST['countryId'],   
        isset($_POST['isDead'])? 0 : 1
    );
    
    $ContactManager = new ContactManager(); // Création d'un objet
    $ContactManager->writeContact($updatedContact);
    header("Location: ?entity=contacts&id=".$_POST['ContactID']."&action=show");
}

if (isset($_POST['ContactID']) && $_POST['ContactID']== 0 ) 
{
    $newContact = new Contact(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['dateOfBirth'],
        $_POST['code'],
        intval($_POST['countryId']),
         0 ); // pour Vivant par defaut

    
    $ContactManager = new ContactManager(); // Création d'un objet
    $ContactManager->postContact($newContact);
    echo('ajouté');
}





