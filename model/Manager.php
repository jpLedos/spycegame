<?php

class Manager {

    protected function dbConnect()
    { 
        $host = "ble5mmo2o5v9oouq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $username = "q47ssnjajcvnxdlk";
        $password = "be2q7wrfmmc0hugd";
        $database = "un0clax84gfiuupj";
        
        try
        {
            $db = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8', $username, $password);
            
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}