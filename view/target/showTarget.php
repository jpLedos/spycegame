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
            <td><?=  htmlspecialchars($target->getLastName()); ?></td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td><?= htmlspecialchars($target->getFirstname());  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= htmlspecialchars($country->getFullName());  ?></td>
        </tr>
        <tr>
            <th>né(e) en</th>
            <td><?= $target->getDateOfBirth();  ?> </td>
        </tr>
        <tr>
            <th>En vie</th>
            <td><?= !$target->getIsDead()? 'Vivant': 'Décédé';  ?> </td>
        </tr>
    </table>


    <ul class="mt-5">
        <li><a href=<?= '?entity=targets&id='.$target->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=targets&id='.$target->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=targets' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showTarget->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>
