<?php
require('controller/frontendController.php');

if (isset($_GET['entity'])) {
    switch ($_GET['entity']) {
        case 'targets' :
            //echo('index route target');
           require('Router/targetRouter.php');
        break;

        case 'agents':
            require('Router/AgentRouter.php');
            break;
        
        default: 
        listMission();
         
    }
}
else {
    listMission();
}