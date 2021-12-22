<?php

require_once('model/manager.php');
require_once('Class/type.php');

class StatutManager extends Manager
{
    function getStatuts()
    {
        $db = $this->dbConnect();
        $sql="SELECT statuts.id, statuts.statut
        FROM statuts";
        $req = $db->prepare($sql);
        $req->execute();
        return $req;
    }

    function getStatut(int $id)
    {
        $db = $this->dbConnect();
        if(!isset($id)){
            $id=$_GET['id'];
        }
        $sql="SELECT statuts.id, statuts.statut
        FROM statuts
        WHERE statuts.id = ?";
        //echo ("$sql".$id);
        $req = $db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_STR);
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
        $db = $this->dbConnect();
        $sql=  "INSERT INTO types ( type)
        Value ('".$newtype->getType()."');'";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    function deletetype($id)
    {
        $db = $this->dbConnect();
        $sql="DELETE FROM types WHERE id = ".$id.";";

        $req = $db->prepare($sql);
        $req->execute();

        return $req;

    }
}