<?php
session_start();
if (isset($_GET['entity'])) {
    switch ($_GET['entity']) {
        case 'targets' :
            //echo('index route target');
           require('Router/targetRouter.php');
        break;

        case 'agents':
            require('Router/agentRouter.php');
            break;

        case 'contacts':
            require('Router/contactRouter.php');
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
        header("Location: ?entity=missions");
        break;
         
    }
}
else {
    header("Location: ?entity=missions");
}