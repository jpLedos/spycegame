<?php

require_once('model/manager.php');
require_once('Class/Target.php');

class TargetManager extends Manager
{
    function getTargets()
    {
        $db = $this->dbConnect();
        $sql="SELECT targets.id, targets.lastname,targets.firstname, targets.code, targets.isDead,
        targets.countryId
        FROM targets";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getTarget(int $id)
    {
        $db = $this->dbConnect();
        $sql="SELECT targets.id, targets.lastname,targets.firstname, targets.code, targets.isDead,
        targets.countryId, targets.dateOfBirth
        FROM targets
        WHERE targets.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $_GET['id'], PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Target');
        $req->execute();
                
        return $req;
    }


    function writeTarget($updatedTarget)
     {
        $db = $this->dbConnect();
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
        $db = dbConnect();
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
        $db = dbConnect();
        $sql="DELETE FROM targets WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }
}