<?php

require_once('model/manager.php');
require_once('Class/Mission.php');
require_once('Class/Statut.php');

class MissionManager extends Manager
{
    function getMissions()
    {
        $db = $this->dbConnect();
        $sql="SELECT id ,title, descriptions, code, countryId, typeId,  
        statutId, specialityId, startDate, endDate 
        FROM missions";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function getMission(int $id)
    {
        $db = $this->dbConnect();
        $sql="SELECT id ,title, descriptions, code, countryId, typeId,  
        statutId, specialityId ,startDate, endDate 
        FROM missions
        WHERE Missions.id = ?";
    
        $req = $db->prepare($sql);
        $req->bindValue(1, $_GET['id'], PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }


    function writeMission($updatedMission)
     {
        $db = $this->dbConnect();
        $sql = "UPDATE Missions SET 
        Missions.title ='".$updatedMission->getTitle()."',
        Missions.descriptions= '".$updatedMission->getDescriptions()."', 
        Missions.code= '".$updatedMission->getCode()."',
        Missions.countryId=".intval($updatedMission->getCountryId()).",
        Missions.typeId=".intval($updatedMission->getTypeId()).",
        Missions.statutId=".intval($updatedMission->getStatutId()).",
        Missions.specialityId=". intval($updatedMission->getSpecialityId())."
        WHERE Missions.id = ?";

        // ,
        // Missions.startDate=".$updatedMission->getStartDate().",
        // Missions.endDate=".$updatedMission->getEndDate()."

        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['MissionId']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postMission($newMission)
    {
        $db = dbConnect();
        $sql=  "INSERT INTO Missions ( lastname, firstname,code, countryId, isDead, dateOfBirth)
        Value ('".
        $newMission->getLastName()."','".
        $newMission->getFirstName()."','".
        $newMission->getCode()."','".
        intval($newMission->getCountryId())."','".
        $newMission->getIsDead()."','".
        $newMission->getDateOfBirth()."');";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deleteMission($id)
    {
        $db = dbConnect();
        $sql="DELETE FROM Missions WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// Agents management ____________________________________________________________
    //return in  text mission's agents
    function getAgentsFromMission($missionId)
    {
        $db = dbConnect();
        $sql="SELECT agentId FROM missions_agents
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionAgent($missionId, $agentId)
    {
        $db=dbConnect();
        $sql="SELECT agentId FROM missions_agents
        WHERE  missionId = ".$missionId." AND
               agentId= ".$agentId.";";

        var_dump($sql);
        
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeMissionAgents($missionId)
    {
        $db=dbConnect();
        $sql="DELETE FROM missions_agents
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addAgentToMission($missionId, $agentId)
    {
        $db=dbConnect();
        $sql = "INSERT INTO missions_agents (missionId, agentId) 
        VALUES (".$missionId.",".$agentId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// ________________end of Agents management___________________________________


// Cibles management
    //return in  text mission's cibles
    function getTargetsFromMission($missionId)
    {
        $db = dbConnect();
        $sql="SELECT targetId FROM missions_targets
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }


// ________________end of Cibles management___________________________________


// _______________Contacts management________________________________________
    //return in  text mission's cibles
    function getContactsFromMission($missionId)
    {
        $db = dbConnect();
        $sql="SELECT contactId FROM missions_contacts
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }


// ________________end of contact management___________________________________


// ________________Hideaways management________________________________________
    //return in  text mission's cibles
    function getHideawaysFromMission($missionId)
    {
        $db = dbConnect();
        $sql="SELECT hideawayId FROM missions_Hideaways
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }


// ________________end of contact management___________________________________





    function getMissionStatut($statutId)
    {
        $db=dbConnect();
        $sql = "SELECT id,statut from statuts WHERE id = ".$statutId.";";
        $req = $db->prepare($sql);
        $req->execute();
        $statut = $req->fetch(PDO::FETCH_ASSOC);
        
        return $statut;

    }

    function getStatuts()
    {
        $db=dbConnect();
        $sql = "SELECT id,statut from statuts";
        $req = $db->prepare($sql);
        $req->execute();

        return $req;  
    }
}