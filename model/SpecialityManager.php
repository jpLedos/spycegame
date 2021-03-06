<?php

require_once('Manager.php');
require_once('Class/Speciality.php');

class SpecialityManager extends Manager
{
    function getSpecialities()
    {
        $db=Manager::dbConnect();
        $sql="SELECT Specialities.id, Specialities.speciality
        FROM Specialities";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getSpeciality(int $id)
    {
        if(!isset($id)){
            $id = $_GET['id'];
        }
        $db=Manager::dbConnect();
        $sql="SELECT Specialities.id, Specialities.speciality
        FROM Specialities
        WHERE Specialities.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Speciality');
        $req->execute();
                
        return $req;
    }


    function writeSpeciality($updatedSpeciality)
     {
        $db=Manager::dbConnect();
        $sql = "UPDATE Specialities SET 
        specialities.speciality ='".$updatedSpeciality->getSpeciality()."'
        WHERE specialities.id = ?";

        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['SpecialityId']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postSpeciality($newSpeciality)
    {
        $db=Manager::dbConnect();
        $sql=  "INSERT INTO Specialities ( speciality)
        Value ('".
        $newSpeciality->getSpeciality()."');'";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteSpeciality($id)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM specialities WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

        //retourne en texte les missions de la specialit√©
        function getMissionsFromSpeciality($specialityId)
        {
            $db=Manager::dbConnect();
            $sql="SELECT specialityId, title  FROM missions
            WHERE specialityId = ".$specialityId;
    
           //echo($sql);die;
            $req = $db->prepare($sql);
            $req->execute();
    
            return $req;
        }

             //retourne en texte les missions de l'agent
     function getAgentsFromspeciality($specialityId)
     {
         $db=Manager::dbConnect();
         $sql="SELECT agentId, lastname, firstname FROM agents_specialities
         INNER JOIN agents
         ON agents_specialities.agentId = agents.id
         WHERE specialityId = ".$specialityId;
 
        //echo($sql);die;
         $req = $db->prepare($sql);
         $req->execute();
 
         return $req;
     }
}