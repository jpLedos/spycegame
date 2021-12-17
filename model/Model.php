<?php

function getMissions()
{
    $db = dbConnect();
    $sql='SELECT missions.id, missions.title, missions.code ,  
    countries.name as country, countries.code as shortCountry,
    statuts.statut as statut 
    FROM missions 
    inner JOIN countries on missions.country_id = countries.id
    inner JOIN statuts on statuts.id= missions.statut_id;';
    $req = $db->query($sql);
    
    return $req;
}

function getAgents()
{
    $db = dbConnect();
    $sql="SELECT agents.id, agents.lastname,agents.firstname, agents.code, agents.is_dead,
    countries.name as country, countries.code as shortCountry
    FROM agents
    INNER JOIN countries on agents.countryID = countries.id";
    $req = $db->query($sql);
    
    return $req;
}

function getTargets()
{
    $db = dbConnect();
    $sql="SELECT targets.id, targets.lastname,targets.firstname, targets.code, targets.is_dead,
    countries.name as country, countries.code as shortCountry
    FROM targets
    INNER JOIN countries on targets.countryID = countries.id";
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
