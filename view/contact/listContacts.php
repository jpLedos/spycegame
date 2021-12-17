<?php $title = 'Les Contacts'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Contacts</h2>";
$countryManager = new CountryManager(); // Création d'un objet'
?> 

<table class="table table-hover">
    <thead>
        <tr class="bg-light">
            <th>N°</span>   
            <th class="" >Nom</th>
            <th class="" >Prenom</th>
            <th class=""><em>Code</em></th>
            <th class="">Pays</th>
            <th>En vie ?</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    <?php
    while  ($Contact = $listContacts->fetchObject('Contact'))
    {
        $country = $countryManager->getCountry($Contact->getId())->fetchObject('Country'); 
    ?>
        <tr class="  <?= !$Contact->getIsDead() ? 'bg-success' : 'bg-danger'  ?>">
        <th scope="row"><?=  $Contact->getId(); ?></th>   
                <td><?=  htmlspecialchars($Contact->getLastname()); ?></td>
                <td> <?= htmlspecialchars($Contact->getFirstname());  ?></td>
                <td><em> <?= htmlspecialchars($Contact->getCode()); ?></em></td>
                <td><?= $country->getFullname(); ?></td>
                <td><?= !$Contact->getIsDead() ? 'Vivant': 'Décédé';  ?> </td>
                <td class ="bg-light text-center"><a href=<?= '?entity=contacts&id='.$Contact->getId().'&action=show' ?>>show</a></td>
        </tr>
    <?php
    }

    $listContacts->closeCursor();
    ?>
    </tbody>
</table>

<ul class="mt-5">
    <li><a href=<?= '?entity=contacts&action=new' ?>>Creer un nouveau contact</a></li>
</ul> 

<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
