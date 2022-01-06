<?php

require_once('Manager.php');
require_once('Class/Hideaway.php');

class HideawayManager extends Manager
{
    function getHideaways()
    {
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
        $sql="DELETE FROM Hideaways WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

         //retourne en texte les missions de l'agent
         function getMissionsFromHideaway($hideawayId)
         {
             $db=Manager::dbConnect();
             $sql="SELECT missionId, title  FROM missions_hideaways
             INNER JOIN missions
             ON missions_hideaways.missionId = missions.id
             WHERE hideawayId = ".$hideawayId;
     
            //echo($sql);die;
             $req = $db->prepare($sql);
             $req->execute();
     
             return $req;
         }

}