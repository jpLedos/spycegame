<?php

require_once('model/CountryManager.php');

function listTargets() 
{
    
    $countryManager = new CountryManager(); // Création d'un objet'
    $listCountries = $countryManager->getCountries(); // Appel d'une fonction de cet objet
    //require('view/target/listTargets.php');
}

function showCountry(int $id)
{
    $countryManager = new CountryManager(); // Création d'un objet'
    $showCountry = $countryManager->getCountry($id);// Appel d'une fonction de cet objet
    //require('view/target/showTarget.php');
}
