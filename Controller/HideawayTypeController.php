<?php

require_once('model/HideawayTypeManager.php');

function listTargets() 
{
    
    $hideawayTypeManager = new HideawayTypeManager(); // Création d'un objet'
    $listCountries = $hideawayTypeManager->getCountries(); // Appel d'une fonction de cet objet
    //require('view/target/listTargets.php');
}

function showHideawayType(int $id)
{
    $hideawayTypeManager = new HideawayTypeManager(); // Création d'un objet'
    $showHideawayType = $hideawayTypeManager->getHideawayType($id);// Appel d'une fonction de cet objet
    //require('view/target/showTarget.php');
}
