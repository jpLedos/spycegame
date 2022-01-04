<?php $title = 'Detail Planques'; ?>
      
<?php 
ob_start();  
$Hideaway = $showHideaway->fetchObject('Hideaway');
if($Hideaway) {
    //recuperation de countryFullname en function de countryID
    $countryManager = new CountryManager(); // Création d'un objet'
    $showCountry = $countryManager->getCountry($Hideaway->getCountryId());// Appel d'une fonction de cet objet
    $country = $showCountry->fetchObject('Country'); 
    
    $hidewayTypeManager = new HydeawayTypeManager(); // Création d'un objet'
    $showHideawayType = $hidewayTypeManager->getHideawayType($Hideaway->getHideawayTypeId());// Appel d'une fonction de cet objet
    $hideawayType = $showHideawayType->fetchObject('HideawayType');
    
    $titleh2 = "<h2>Description de la Planque code : ".$Hideaway->getCode()."</h2>";
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 80%;">
        <tr>
            <th>N°</th>
            <td><?=  $Hideaway->getId(); ?></td>
        </tr>
        <tr>
            <th>Code</th>
            <td><?=  $Hideaway->getCode(); ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?= $Hideaway->getAddress();  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= $country->getFullName();  ?></td>
        </tr>
        <tr>
            <th>Type de planque</th>
            <td><?= $hideawayType->getName();  ?> </td>
        </tr>
        <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php while ($mission = $hideawayMissions->fetch(PDO::FETCH_ASSOC)) {?>
                    <li><?= $mission['title']; ?> </li>
                <?php } ?> 
                </ul>
            </td>
        </tr>     
    </table>

    <ul class="mt-5">
        <li><a href=<?= '?entity=hideaways&id='.$Hideaway->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=hideaways' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showHideaway->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
