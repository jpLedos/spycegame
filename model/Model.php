<?php

function getMissions()
{
    $db = dbConnect();
    $sql='SELECT missions.id, missions.title, missions.code ,  
    countries.name as country, countries.code as shortCountry,
    statuts.statut as statut 
    FROM missions 
    inner JOIN countries on missions.countryId = countries.id
    inner JOIN statuts on statuts.id= missions.statutId;';
    $req = $db->query($sql);
    
    return $req;
}



function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=spygames;charset=utf8', 'root', '');
        
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
