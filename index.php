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

        case 'contacts':
            require('Router/ContactRouter.php');
            break;
            
        case 'specialities':
            require('Router/specialityRouter.php');
            break;
        
        case 'users':
            require('Router/userRouter.php');
            break;
        
        case 'types':
            require('Router/typeRouter.php');
            break;
        
        case 'hideaways':
        require('Router/hideawayRouter.php');
        break;
    
        case 'missions':
            require('Router/missionRouter.php');
            break;
                
        default: 
        echo('defaut entity');
        listMission();
         
    }
}
else {
    listMission();
}