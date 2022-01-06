<?php

require_once('Manager.php');
require_once('Class/Target.php');

class TargetManager extends Manager
{
    function getTargets()
    {
        $db=Manager::dbConnect();
        $sql="SELECT targets.id, targets.lastname,targets.firstname, targets.code, targets.isDead,
        targets.countryId
        FROM targets";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getTarget(int $id)
    {
        if(!isset($id)){
            $id=$_GET['id'];
        }
        $db=Manager::dbConnect();
        $sql="SELECT targets.id, targets.lastname,targets.firstname, targets.code, targets.isDead,
        targets.countryId, targets.dateOfBirth
        FROM targets
        WHERE targets.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Target');
        $req->execute();
                
        return $req;
    }


    function writeTarget($updatedTarget)
     {
        $db=Manager::dbConnect();
        $sql = "UPDATE targets SET 
        targets.lastname ='".$updatedTarget->getLastName()."',
        targets.firstname= '".$updatedTarget->getFirstname()."', 
        targets.code= '".$updatedTarget->getCode()."',
        targets.isDead='". $updatedTarget->getIsDead()."',
        targets.countryId=". intval($updatedTarget->getCountryId()).",
        targets.dateOfBirth= '".$updatedTarget->getDateOfBirth()."'
        WHERE targets.id = ?";

        //var_dump($sql);
        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['targetID']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postTarget($newTarget)
    {
        $db=Manager::dbConnect();
        $sql=  "INSERT INTO targets ( lastname, firstname,code, countryId, isDead, dateOfBirth)
        Value ('".
        $newTarget->getLastName()."','".
        $newTarget->getFirstName()."','".
        $newTarget->getCode()."','".
        intval($newTarget->getCountryId())."','".
        $newTarget->getIsDead()."','".
        $newTarget->getDateOfBirth()."');";
        //echo($sql);

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteTarget($id)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM targets WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    
     //retourne en texte les missions de l'agent
     function getMissionsFromTarget($targetId)
     {
         $db=Manager::dbConnect();
         $sql="SELECT missionId, title  FROM missions_targets
         INNER JOIN missions
         ON missions_targets.missionId = missions.id
         WHERE targetId = ".$targetId;
 
        //echo($sql);die;
         $req = $db->prepare($sql);
         $req->execute();
 
         return $req;
     }

}