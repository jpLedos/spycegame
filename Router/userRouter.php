<?php

require_once('Controller/userController.php');

if(isset($_GET['action']) && $_GET['action']==='logout') {
    require('view/logout.php');
}else{
  require_once('view/login.php');  
}

