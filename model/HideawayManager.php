<?php

require_once('model/manager.php');
require_once('Class/Hideaway.php');

class HideawayManager extends Manager
{
    function getHideaways()
    {
        $db = $this->dbConnect();
        $sql="SELECT Hideaways.id, Hideaways.code,Hideaways.address, 
        Hideaways.hideawayTypeId , Hideaways.countryId
        FROM Hideaways";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getHideaway(int $id)
    {
        if(!isset($id)){
            $id=$_GET['id'];
        }
        $db = $this->dbConnect();
        $sql="SELECT Hideaways.id, Hideaways.code,Hideaways.address, 
        Hideaways.hideawayTypeId , Hideaways.countryId
        FROM Hideaways
        WHERE Hideaways.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Hideaway');
        $req->execute();
                
        return $req;
    }


    function writeHideaway($updatedHideaway)
     {
        $db = $this->dbConnect();
        $sql = "UPDATE Hideaways SET 
        Hideaways.code ='".$updatedHideaway->getCode()."',
        Hideaways.Address= '".$updatedHideaway->getAddress()."', 
        Hideaways.countryId= '".$updatedHideaway->getCountryId()."',
        Hideaways.hideawayTypeId=". $updatedHideaway->getHideawayTypeId()."
        WHERE Hideaways.id = ?";

        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['HideawayId']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postHideaway($newHideaway)
    {
        $db = $this->dbConnect();
        $sql=  "INSERT INTO Hideaways ( code, address, countryId, hideawayTypeId )
        Value ('".
        $newHideaway->getCode()."','".
        $newHideaway->getAddress()."',".
        $newHideaway->getCountryId().",".
        intval($newHideaway->getHideawayTypeId()).");";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteHideaway($id)
    {
        $db = $this->dbConnect();
        $sql="DELETE FROM Hideaways WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }
}