<?php

require_once('model/manager.php');
require_once('Class/type.php');

class typeManager extends Manager
{
    function gettypes()
    {
        $db = $this->dbConnect();
        $sql="SELECT types.id, types.type
        FROM types";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function gettype(int $id)
    {
        $db = $this->dbConnect();
        $sql="SELECT types.id, types.type
        FROM types
        WHERE types.id = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $_GET['id'], PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'type');
        $req->execute();
                
        return $req;
    }


    function writeType($updatedtype)
     {
        $db = $this->dbConnect();
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
        $db = dbConnect();
        $sql=  "INSERT INTO types ( type)
        Value ('".$newtype->getType()."');'";
        echo($sql);

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deletetype($id)
    {
        $db = dbConnect();
        $sql="DELETE FROM types WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;

    }
}