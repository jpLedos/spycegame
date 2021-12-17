<?php $title = 'Detail cible'; ?>
      
<?php 
ob_start();  
$Contact = $showContact->fetchObject('Contact');

$countryManager = new CountryManager(); // Création d'un objet'
$showCountry = $countryManager->getCountry($Contact->getCountryId());// Appel d'une fonction de cet objet
$country = $showCountry->fetchObject('Country'); 

$titleh2 = "<h2>Description de la cible code : ".$Contact->getCode()."</h2>";
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 80%;">
        <tr>
            <th>N°</th>
            <td><?=  $Contact->getId(); ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?=  htmlspecialchars($Contact->getLastName()); ?></td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td><?= htmlspecialchars($Contact->getFirstname());  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= htmlspecialchars($country->getFullName());  ?></td>
        </tr>
        <tr>
            <th>né(e) en</th>
            <td><?= $Contact->getDateOfBirth();  ?> </td>
        </tr>
        <tr>
            <th>En vie</th>
            <td><?= !$Contact->getIsDead()? 'Vivant': 'Décédé';  ?> </td>
        </tr>
    </table>


    <ul class="mt-5">
        <li><a href=<?= '?entity=contacts&id='.$Contact->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=contacts&id='.$Contact->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=contacts' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showContact->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>
