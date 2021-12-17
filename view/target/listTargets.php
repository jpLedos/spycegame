<?php $title = 'Les cibles'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des cibles</h2>";
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
    while  ($target = $listTargets->fetchObject('Target'))
    {
        $country = $countryManager->getCountry($target->getId())->fetchObject('Country'); 
    ?>
        <tr class="  <?= !$target->getIsDead() ? 'bg-success' : 'bg-danger'  ?>">
        <th scope="row"><?=  $target->getId(); ?></th>   
                <td><?=  htmlspecialchars($target->getLastname()); ?></td>
                <td> <?= htmlspecialchars($target->getFirstname());  ?></td>
                <td><em> <?= htmlspecialchars($target->getCode()); ?></em></td>
                <td><?= $country->getFullname(); ?></td>
                <td><?= !$target->getIsDead() ? 'Vivant': 'Décédé';  ?> </td>
                <td class ="bg-light text-center"><a href=<?= '?entity=targets&id='.$target->getId().'&action=show' ?>>show</a></td>
        </tr>
    <?php
    }

    $listTargets->closeCursor();
    ?>
    </tbody>
</table>

<ul class="mt-5">
    <li><a href=<?= '?entity=targets&action=new' ?>>Creer une nouvelle cible</a></li>
</ul> 

<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
