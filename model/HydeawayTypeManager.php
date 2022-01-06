<?php

require_once('Manager.php');
require_once('Class/HideawayType.php');

class HydeawayTypeManager extends Manager
{

    function getHideawayTypes()
    {
        $db=Manager::dbConnect();
        $sql="SELECT hideawayTypes.id, hideawayTypes.name
        FROM HideawayTypes 
        ORDER BY hideawayTypes.name ASC ;";
        $req = $db->prepare($sql);
        $req->execute();
        //echo($sql);
        return $req;

    }

    function getHideawayType(int $id)
    {
        $db=Manager::dbConnect();
        $sql="SELECT hideawayTypes.id, hideawayTypes.name
        FROM HideawayTypes
        WHERE hideawayTypes.id = ?";
        //echo ("$sql").$id;
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    
    }
}