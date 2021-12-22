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
        $db = $this->dbConnect();
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
        $db = $this->dbConnect();
        $sql="DELETE FROM Missions WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// Agents management ____________________________________________________________
    //return in  text mission's agents
    function getAgentsFromMission($missionId)
    {
        $db = $this->dbConnect();
        $sql="SELECT agentId FROM missions_agents
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionAgent($missionId, $agentId)
    {
        $db=$this->dbConnect();
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
        $db=$this->dbConnect();
        $sql="DELETE FROM missions_agents
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addAgentToMission($missionId, $agentId)
    {
        $db=$this->dbConnect();
        $sql = "INSERT INTO missions_agents (missionId, agentId) 
        VALUES (".$missionId.",".$agentId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// ________________end of Agents management___________________________________




//_____________________ Targets management __________________________________________
    //return in  text mission's targets
    function getTargetsFromMission($missionId)
    {
        $db = $this->dbConnect();
        $sql="SELECT targetId FROM missions_targets
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionTarget($missionId, $targetId)
    {
        $db=$this->dbConnect();
        $sql="SELECT targetId FROM missions_targets
        WHERE  missionId = ".$missionId." AND
            targetId= ".$targetId.";";

        var_dump($sql);
        
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeMissionTargets($missionId)
    {
        $db=$this->dbConnect();
        $sql="DELETE FROM missions_targets
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addTargetToMission($missionId, $targetId)
    {
        $db=$this->dbConnect();
        $sql = "INSERT INTO missions_targets (missionId, targetId) 
        VALUES (".$missionId.",".$targetId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// ________________end of Targets management___________________________________


//_____________________ Contacts management __________________________________________
    //return in  text mission's contacts
    function getContactsFromMission($missionId)
    {
        $db = $this->dbConnect();
        $sql="SELECT contactId FROM missions_contacts
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionContact($missionId, $contactId)
    {
        $db=$this->dbConnect();
        $sql="SELECT contactId FROM missions_contacts
        WHERE  missionId = ".$missionId." AND
            contactId= ".$contactId.";";

        var_dump($sql);
        
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeMissionContacts($missionId)
    {
        $db=$this->dbConnect();
        $sql="DELETE FROM missions_contacts
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addContactToMission($missionId, $contactId)
    {
        $db=$this->dbConnect();
        $sql = "INSERT INTO missions_contacts (missionId, contactId) 
        VALUES (".$missionId.",".$contactId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// ________________end of Contacts management___________________________________





//_____________________ hideaways management __________________________________________
    //return in  text mission's hideaways
    function getHideawaysFromMission($missionId)
    {
        $db = $this->dbConnect();
        $sql="SELECT hideawayId FROM missions_hideaways
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionHideaway($missionId, $hideawayId)
    {
        $db=$this->dbConnect();
        $sql="SELECT hideawayId FROM missions_hideaways
        WHERE  missionId = ".$missionId." AND
            hideawayId= ".$hideawayId.";";

        var_dump($sql);
        
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeMissionHideaways($missionId)
    {
        $db=$this->dbConnect();
        $sql="DELETE FROM missions_hideaways
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addHideawayToMission($missionId, $hideawayId)
    {
        $db=$this->dbConnect();
        $sql = "INSERT INTO missions_hideaways (missionId, hideawayId) 
        VALUES (".$missionId.",".$hideawayId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// ________________end of hideaways management___________________________________

}