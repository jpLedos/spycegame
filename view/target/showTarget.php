<?php $title = 'Detail cible'; ?>
      
<?php 
ob_start();  
$target = $showTarget->fetchObject('Target');
if($target) {
    $countryManager = new CountryManager(); // Création d'un objet'
    $showCountry = $countryManager->getCountry($target->getCountryId());// Appel d'une fonction de cet objet
    $country = $showCountry->fetchObject('Country');
    $titleh2 = "<h2>Description de la cible code : ".$target->getCode()."</h2>";
} else {
    echo('Aucun resultat pour cette requête');
    die;
}

?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 80%;">
        <tr>
            <th>N°</th>
            <td><?=  $target->getId(); ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?=  $target->getLastName(); ?></td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td><?= $target->getFirstname();  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= $country->getFullName();  ?></td>
        </tr>
        <tr>
            <th>né(e) en</th>
            <td><?= date('d-m-Y',strToTime($target->getDateOfBirth()));  ?> </td>
        </tr>
        <tr>
            <th>En vie</th>
            <td><?= !$target->getIsDead()? 'Vivant': 'Décédé';  ?> </td>
        </tr>
        <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php 
                while ($mission = $targetMissions->fetch(PDO::FETCH_ASSOC)) {  
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
        <li><a href=<?= '?entity=targets&id='.$target->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=targets' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showTarget->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
