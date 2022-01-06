<?php

class Manager {
    
    private static PDO $instance;

    function __construct() {}
    private function __clone() {}

    public static function dbConnect(): PDO
    { 

        $host = "ble5mmo2o5v9oouq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $username = "q47ssnjajcvnxdlk";
        $password = "be2q7wrfmmc0hugd";
        $database = "un0clax84gfiuupj";
        

        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8', $username, $password);
        }

        return self::$instance;

    }

}

//$pdo = Manager::dbConnect();