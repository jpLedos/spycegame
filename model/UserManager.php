<?php

require_once('Manager.php');
require_once('Class/User.php');

class UserManager extends Manager
{

    function getUser(string $login)
    {
        $db=Manager::dbConnect();
        $sql="SELECT users.id, users.login,users.password
        FROM Users
        WHERE Users.login = ?";
        //echo ("$sql");
        $req = $db->prepare($sql);
        $req->bindValue(1, $login, PDO::PARAM_STR);
        //$req->setFetchMode(PDO::FETCH_CLASS, 'User');
        $req->execute();
                
        return $req;
    }

}