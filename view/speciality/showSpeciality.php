<?php $title = 'Detail Specialité'; ?>
      
<?php 
ob_start();  
$Speciality = $showSpeciality->fetchObject('Speciality');
if($Speciality) {
    $titleh2 = "<h2>Description Specialité !</h2>";
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 60%;">
        <tr>
            <th>N°</th>
            <td><?=  $Speciality->getId(); ?></td>
        </tr>
        <tr>
            <th>Spécialité</th>
            <td><?=  $Speciality->getSpeciality(); ?></td>
        </tr>
        <tr>
        <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php while ($mission = $specialityMissions->fetch(PDO::FETCH_ASSOC)) {?>
                    <li><?= $mission['title']; ?> </li>
                <?php } ?> 
                </ul>
            </td>
        </tr> 
        <tr>
            <th>Agents</th>
            <td>
                <ul>
                <?php while ($agent = $specialityAgents->fetch(PDO::FETCH_ASSOC)) {?>
                    <li><?= $agent['firstname'].' '.$agent['lastname'] ; ?> </li>
                <?php } ?> 
                </ul>
            </td>
        </tr> 

    </table>


    <ul class="mt-5">
        <li><a href=<?= '?entity=specialities&id='.$Speciality->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=specialities' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showSpeciality->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
