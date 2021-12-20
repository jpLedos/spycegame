 <?php
require 'model/model.php';

function listMission() 
{
    $listMissions = getMissions();
    require 'view/listMissions.php';
}
