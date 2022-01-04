<?php

require_once('model/TypeManager.php');
require_once('model/CountryManager.php'); //besoin pour obtenir le getfullname(id)

function listTypes() 
{
    //echo(' dans Type controller)');
    $TypeManager = new TypeManager();
    $listTypes = $TypeManager->getTypes();
    require('view/Type/listTypes.php');
}

function showType(int $id)
{
    $TypeManager = new TypeManager(); 
    $showType = $TypeManager->getType($id);
    $typeMissions = $TypeManager->getMissionsFromType($id);
    require('view/Type/showType.php');
}

function editType(int $id)
{
    $TypeManager = new TypeManager();
    $showType = $TypeManager->getType($id);
    $typeMissions = $TypeManager->getMissionsFromType($id);  
    require('view/Type/editType.php');
}

function newType()
{
    require('view/Type/newType.php');
}

function deleteType(int $id)
{
    $TypeManager = new TypeManager();
    $typeMissions = $TypeManager->getMissionsFromType($id);
    if($typeMissions->rowCount()==0) {
        try {
            $deleteType = $TypeManager->deleteType($id); 
            header("Location: ?entity=types");
        }
        catch (Exception $e) {
            return ('erreur de procedure suppression type !!');
        }
    }   else {
        echo("Suppression impossible ! une mission de ce type existe !!!");
    }
    
}


// mofication type

if (isset($_POST['typeId']) && $_POST['typeId']<> 0 && isset($_POST['typeUpdate'])) 
{

    $updatedType = new Type(htmlspecialchars($_POST['type'],ENT_QUOTES,'UTF-8',true));
    $TypeManager = new TypeManager(); // Création d'un objet
    $TypeManager->writeType($updatedType);
    header("Location: ?entity=types&id=".$_POST['typeId']."&action=show");
}

// new type
if (isset($_POST['TypeID']) && $_POST['TypeID']== 0 && isset($_POST['typeAdd'])) 
{
    $newType = new Type(htmlspecialchars($_POST['type'],ENT_QUOTES,'UTF-8',true));
    $TypeManager = new TypeManager(); // Création d'un objet
    $TypeManager->postType($newType);
}





