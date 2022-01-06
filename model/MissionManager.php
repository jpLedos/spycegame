<?php

require_once('Manager.php');
require_once('Class/Mission.php');
require_once('Class/Statut.php');

class MissionManager
{
    function getMissions(string $filter)
    {


         $db=Manager::dbConnect();
        if ($filter !='') {
            $filter = " WHERE title like '%$filter%'
                        OR code like '%$filter%';";
        }
 
        $sql="SELECT id ,title, descriptions, code, countryId, typeId,  
        statutId, specialityId, startDate, endDate ,isConform
        FROM missions";
        $sql = $sql.$filter;
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function getMission(int $id)
    {
        $db=Manager::dbConnect();
        
        $sql="SELECT id ,title, descriptions, code, countryId, typeId,  
        statutId, specialityId ,startDate, endDate ,isConform
        FROM missions
        WHERE Missions.id = ?";
    
        $req = $db->prepare($sql);
        $req->bindValue(1, $_GET['id'], PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }


    function writeMission($updatedMission)
     {
        $db=Manager::dbConnect();
        $sql = "UPDATE Missions SET 
        Missions.title ='".$updatedMission->getTitle()."',
        Missions.descriptions= '".$updatedMission->getDescriptions()."', 
        Missions.code= '".$updatedMission->getCode()."',
        Missions.countryId=".intval($updatedMission->getCountryId()).",
        Missions.typeId=".intval($updatedMission->getTypeId()).",
        Missions.statutId=".intval($updatedMission->getStatutId()).",
        Missions.specialityId=". intval($updatedMission->getSpecialityId()).",
        Missions.startDate='".$updatedMission->getStartDate()."',
        Missions.endDate='".$updatedMission->getEndDate()."',
        Missions.isConform=".$updatedMission->getIsConform()."
        WHERE Missions.id = ?";
        //echo($sql);die;
        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['MissionId']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }

    function postMission($newMission)
    {
        $db=Manager::dbConnect();
        $sql=  "INSERT INTO Missions ( title, code,countryId,statutId, typeId, specialityId, 
        descriptions, startDate, endDate)
        Value ('".
        $newMission->getTitle()."','".
        $newMission->getCode()."','".
        $newMission->getCountryId()."','".
        $newMission->getStatutId()."','".
        intval($newMission->getTypeId())."','".
        $newMission->getSpecialityId()."','".
        $newMission->getDescriptions()."','".
        $newMission->getStartDate()."','".
        $newMission->getEndDate()."');";
        //echo $sql;die;
        $req = $db->prepare($sql);
        $req->execute();

        return $db->lastInsertId();
    }

    function deleteMission($id)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM Missions WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// Agents management ____________________________________________________________
    //return in  text mission's agents
    function getAgentsFromMission($missionId)
    {
        $db=Manager::dbConnect();
        $sql="SELECT agentId FROM missions_agents
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionAgent($missionId, $agentId)
    {
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
        $sql="DELETE FROM missions_agents
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addAgentToMission($missionId, $agentId)
    {
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
        $sql="SELECT targetId FROM missions_targets
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionTarget($missionId, $targetId)
    {
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
        $sql="DELETE FROM missions_targets
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addTargetToMission($missionId, $targetId)
    {
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
        $sql="SELECT contactId FROM missions_contacts
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionContact($missionId, $contactId)
    {
        $db=Manager::dbConnect();
        $sql="SELECT contactId FROM missions_contacts
        WHERE  missionId = ".$missionId." AND
            contactId= ".$contactId.";";

        //var_dump($sql);
        
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeMissionContacts($missionId)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM missions_contacts
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addContactToMission($missionId, $contactId)
    {
        $db=Manager::dbConnect();
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
        $db=Manager::dbConnect();
        $sql="SELECT hideawayId FROM missions_hideaways
        WHERE missionId = ".$missionId;

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function isMissionHideaway($missionId, $hideawayId)
    {
        $db=Manager::dbConnect();
        $sql="SELECT hideawayId FROM missions_hideaways
        WHERE  missionId = ".$missionId." AND
            hideawayId= ".$hideawayId.";";
        
        $req = $db->prepare($sql);
        $req->execute();

        return $req->fetch();
    }

    function purgeMissionHideaways($missionId)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM missions_hideaways
        WHERE missionId = ".$missionId;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function addHideawayToMission($missionId, $hideawayId)
    {
        $db=Manager::dbConnect();
        $sql = "INSERT INTO missions_hideaways (missionId, hideawayId) 
        VALUES (".$missionId.",".$hideawayId.");";
        //echo($sql);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

// ________________end of hideaways management________________
}