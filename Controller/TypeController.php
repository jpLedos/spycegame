<?php

require_once('model/TypeManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listTypes() 
{
    //echo(' dans Type controller)');
    $TypeManager = new TypeManager(); // Création d'un objet
    $listTypes = $TypeManager->getTypes(); // Appel d'une fonction de cet objet
    require('view/Type/listTypes.php');
}

function showType(int $id)
{
    $TypeManager = new TypeManager(); // Création d'un objet
    $showType = $TypeManager->getType($id); // Appel d'une fonction de cet objet
    require('view/Type/showType.php');
}

function editType(int $id)
{
    $TypeManager = new TypeManager(); // Création d'un objet
    $showType = $TypeManager->getType($id); // Appel d'une fonction de cet objet
    require('view/Type/editType.php');
}

function newType()
{
    require('view/Type/newType.php');
}

function deleteType(int $id)
{
    $TypeManager = new TypeManager(); // Création d'un objet
    $deleteType = $TypeManager->deleteType($id); // Appel d'une fonction de cet objet
    header("Location: ?entity=types");
}


// mofication type

if (isset($_POST['typeId']) && $_POST['typeId']<> 0 ) 
{

    $updatedType = new Type(htmlspecialchars($_POST['type']));
    $TypeManager = new TypeManager(); // Création d'un objet
    $TypeManager->writeType($updatedType);
    header("Location: ?entity=types&id=".$_POST['typeId']."&action=show");
}

// new type
if (isset($_POST['TypeID']) && $_POST['TypeID']== 0 ) 
{
    $newType = new Type(htmlspecialchars($_POST['type']));
    $TypeManager = new TypeManager(); // Création d'un objet
    $TypeManager->postType($newType);
}





