<?php

require_once('Manager.php');
require_once('Class/Contact.php');

class ContactManager extends Manager
{
    function getContacts()
    {
        $db=Manager::dbConnect();
        $sql="SELECT Contacts.id, Contacts.lastname,Contacts.firstname, Contacts.code, Contacts.isDead,
        Contacts.countryId
        FROM Contacts";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getContact(int $id)
    {
        if(!isset($id)){
            $id=$_GET['id'];
        }
        $db=Manager::dbConnect();
        $sql="SELECT Contacts.id, Contacts.lastname,Contacts.firstname, Contacts.code, Contacts.isDead,
        Contacts.countryId, Contacts.dateOfBirth
        FROM Contacts
        WHERE Contacts.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'Contact');
        $req->execute();
                
        return $req;
    }


    function writeContact($updatedContact)
     {
        $db=Manager::dbConnect();
        $sql = "UPDATE Contacts SET 
        Contacts.lastname ='".$updatedContact->getLastName()."',
        Contacts.firstname= '".$updatedContact->getFirstname()."', 
        Contacts.code= '".$updatedContact->getCode()."',
        Contacts.isDead='". $updatedContact->getIsDead()."',
        Contacts.countryId=". intval($updatedContact->getCountryId()).",
        Contacts.dateOfBirth= '".$updatedContact->getDateOfBirth()."'
        WHERE Contacts.id = ?";

        //var_dump($sql);
        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['ContactID']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postContact($newContact)
    {
        $db=Manager::dbConnect();
        $sql=  "INSERT INTO Contacts ( lastname, firstname,code, countryId, isDead, dateOfBirth)
        Value ('".
        $newContact->getLastName()."','".
        $newContact->getFirstName()."','".
        $newContact->getCode()."','".
        intval($newContact->getCountryId())."','".
        $newContact->getIsDead()."','".
        $newContact->getDateOfBirth()."');";
        //echo($sql);

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteContact($id)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM Contacts WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

         //retourne en texte les missions du contact
         function getMissionsFromContact($contactId)
         {
             $db=Manager::dbConnect();
             $sql="SELECT missionId, title  FROM missions_contacts
             INNER JOIN missions
             ON missions_contacts.missionId = missions.id
             WHERE contactId = ".$contactId;
     
            //echo($sql);die;
             $req = $db->prepare($sql);
             $req->execute();
     
             return $req;
         }
}