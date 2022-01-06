<?php

require_once('Manager.php');
require_once('Class/Type.php');

class typeManager extends Manager
{
    function getTypes()
    {
        $db=Manager::dbConnect();
        $sql="SELECT types.id, types.type
        FROM types";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getType(int $id)
    {
        $db=Manager::dbConnect();
        if(!isset($id)){
            $id=$_GET['id'];
        }
        $sql="SELECT types.id, types.type
        FROM types
        WHERE types.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'type');
        $req->execute();
                
        return $req;
    }


    function writeType($updatedtype)
     {
        $db=Manager::dbConnect();
        $sql = "UPDATE types SET 
        types.type ='".$updatedtype->getType()."'
        WHERE types.id = ?";

        $req = $db->prepare($sql);
        $req->bindValue(1, ($_POST['typeId']), PDO::PARAM_STR);
        $req->execute();
                
        return $req;
    }


    function postType($newtype)
    {
        $db=Manager::dbConnect();
        $sql=  "INSERT INTO types ( type)
        Value ('".$newtype->getType()."');'";
        echo($sql);

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deletetype($id)
    {
        $db=Manager::dbConnect();
        $sql="DELETE FROM types WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        
        $req->execute();

        return $req;

    }

    //retourne en texte les missions de  ce type
    function getMissionsFromType($typeId)
    {
        $db=Manager::dbConnect();
        $sql="SELECT typeId, title  FROM missions
        WHERE typeId = ".$typeId;

       //echo($sql);die;
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }
}