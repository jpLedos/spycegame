<?php

require_once('model/manager.php');
require_once('Class/Speciality.php');

class SpecialityManager extends Manager
{
    function getSpecialities()
    {
        $db = $this->dbConnect();
        $sql="SELECT Specialities.id, Specialities.speciality
        FROM Specialities";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getSpeciality(int $id)
    {
        $db = $this->dbConnect();
        $sql="SELECT Specialities.id, Specialities.speciality
        FROM Specialities
        WHERE Specialities.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $_GET['id'], PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Speciality');
        $req->execute();
                
        return $req;
    }


    function writeSpeciality($updatedSpeciality)
     {
        $db = $this->dbConnect();
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
        $db = dbConnect();
        $sql=  "INSERT INTO Specialities ( speciality)
        Value ('".
        $newSpeciality->getSpeciality()."');'";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteSpeciality($id)
    {
        $db = dbConnect();
        $sql="DELETE FROM specialities WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }
}