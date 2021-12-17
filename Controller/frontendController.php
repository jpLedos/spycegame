 <?php
require 'model/model.php';

function listMission() 
{
    $listMissions = getMissions();
    require 'view/listMissions.php';
}

function listAgent() 
{
    $listAgents = getAgents();
    require 'view/listAgents.php';
}

// function listTarget() 
// {
//     $listTargets = getTargets();
//     require 'view/target/listTargets.php';
// }