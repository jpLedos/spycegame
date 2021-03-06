<?php $title = 'Detail Agent'; ?>
      
<?php 
ob_start();  


$agent = $showAgent->fetchObject('agent');
if($agent) {
    $titleh2 = "<h2>Description de l'agent code : ".$agent->getCode()."</h2>";

    $countryManager = new CountryManager(); // Création d'un objet'
    $showCountry = $countryManager->getCountry($agent->getCountryId());// Appel d'une fonction de cet objet
    $country = $showCountry->fetchObject('Country'); 
    
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 80%;">
        <tr>
            <th>N°</th>
            <td><?=  $agent->getId(); ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?=  $agent->getLastName(); ?></td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td><?= $agent->getFirstname();  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= $country->getFullName();  ?></td>
        </tr>
        <tr>
            <th>né(e) en</th>
            <td><?= date('d-m-Y',strToTime($agent->getDateOfBirth()));  ?> </td>
        </tr>
        <tr>
            <th>En vie</th>
            <td><?= !$agent->getIsDead()? 'Vivant': 'Décédé';  ?> </td>
        </tr>
        <tr id="specialities">
            <th>Specialités</th>
            <td>
                <ul>
                <?php
                    while ($agentSpeciality = $agentSpecialities->fetch(PDO::FETCH_ASSOC)) {
                    echo("<li>".$agentSpeciality['speciality']."</li>");
                    } 
                ?>
                </ul>
                <div class="rules">
                    Un agent doit posseder au moins une specialité!
                </div>
            </td>
        </tr>
        <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php 
                while ($mission = $agentMissions->fetch(PDO::FETCH_ASSOC)) {  
                ?>
                    <li><?= $mission['title']; ?> </li>
                <?php  
                } 
                ?> 
                </ul>
            </td>
        </tr>
    </table>

    <ul class="mt-5">
        <li><a href=<?= '?entity=agents&id='.$agent->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=agents' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showAgent->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/checkAgent.js'></script>";
require('view/layout.php'); ?>
