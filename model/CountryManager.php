<?php

require_once('model/manager.php');
require_once('Class/Country.php');

class CountryManager extends Manager
{

    function getCountries()
    {
        $db = $this->dbConnect();
        $sql="SELECT DISTINCT  Countries.id, Countries.name,Countries.code
        FROM Countries 
        ORDER BY countries.name ASC ;";
        $req = $db->prepare($sql);
        $req->execute();

        return $req;

    }

    function getCountry(int $id)
    {
        $db = $this->dbConnect();
        $sql="SELECT countries.id, countries.name,countries.code
        FROM Countries
        WHERE countries.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Target');
        $req->execute();
                
        return $req;
    
    }
}