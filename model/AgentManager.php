<?php

require_once('model/manager.php');
require_once('Class/Agent.php');

class AgentManager extends Manager
{
    function getAgents()
    {
        $db = $this->dbConnect();
        $sql="SELECT Agents.id, Agents.lastname,Agents.firstname, Agents.code, Agents.isDead,
        Agents.countryId
        FROM Agents";
        $req = $db->prepare($sql);
        $req->execute();
        
        return $req;
    }

    function getAgent(int $id)
    {
        if(!isset($id)){
            $id= $_GET['id'];
        }
        $db = $this->dbConnect();
        $sql="SELECT Agents.id, Agents.lastname,Agents.firstname, Agents.code, Agents.isDead,
        Agents.countryId, Agents.dateOfBirth
        FROM Agents
        WHERE Agents.id = ?";
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }


    function writeAgent($updatedAgent)
     {
        $db = $this->dbConnect();
        $sql = "UPDATE Agents SET 
        Agents.lastname ='".$updatedAgent->getLastName()."',
        Agents.firstname= '".$updatedAgent->getFirstname()."', 
        Agents.code= '".$updatedAgent->getCode()."',
        Agents.isDead='". $updatedAgent->getIsDead()."',
        Agents.countryId=". intval($updatedAgent->getCountryId()).",
        Agents.dateOfBirth= '".$updatedAgent->getDateOfBirth()."'
        WHERE Agents.id = ?";

        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['AgentID']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postAgent($newAgent)
    {
        $db = $this->dbConnect();
        $sql=  "INSERT INTO Agents ( lastname, firstname,code, countryId, isDead, dateOfBirth)
        Value ('".
        $newAgent->getLastName()."','".
        $newAgent->getFirstName()."','".
        $newAgent->getCode()."','".
        intval($newAgent->getCountryId())."','".
        $newAgent->getIsDead()."','".
        $newAgent->getDateOfBirth()."');";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteAgent($id)
    {
        $db = $this->dbConnect();
        $sql="DELETE FROM Agents WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    //retourne en texte les specialités de l'agent
    function getSpecialitiesFromAgent($agentId)
    {
        $db = $this->dbConnect();
        $sql="SELECT specialityId, speciality  FROM agents_specialities
        INNER JOIN specialities
        ON agents_specialities.specialityId = specialities.id
        WHERE agentId = ".$agentId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isAgentSpeciality($agentId, $specialityId)
    {
        $db=$this->dbConnect();
        $sql="SELECT specialityId FROM agents_specialities
        WHERE specialityId = ".$specialityId." AND
                agentId= ".$agentId;

        var_dump($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeAgentSpecialities($agentId)
    {
        $db=$this->dbConnect();
        $sql="DELETE FROM agents_specialities
        WHERE agentId = ".$agentId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addSpecialityToAgent($agentId, $specialityId)
    {
        $db=$this->dbConnect();
        $sql = "INSERT INTO agents_specialities (agentId, specialityId) 
        VALUES (".$agentId.",".$specialityId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }
}