<?php $title = 'Les Agents'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Agents</h2>";
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
    while  ($Agent = $listAgents->fetchObject('Agent'))
    {
        $showCountry = $countryManager->getCountry($Agent->getCountryId());// Appel d'une fonction de cet objet
        $country = $showCountry->fetchObject('Country');
    ?>
        <tr class="  <?= !$Agent->getIsDead() ? 'bg-success' : 'bg-danger'  ?>">
            <th scope="row"><?=  $Agent->getId(); ?></th>   
            <td><?=  htmlspecialchars($Agent->getLastname()); ?></td>
            <td> <?= htmlspecialchars($Agent->getFirstname());  ?></td>
            <td><em> <?= htmlspecialchars($Agent->getCode()); ?></em></td>
            <td><?= $country->getFullname(); ?></td>
            <td><?= !$Agent->getIsDead() ? 'Vivant': 'Décédé';  ?> </td>
            <td class ="bg-light text-center"><a href=<?= '?entity=agents&id='.$Agent->getId().'&action=show' ?>>show</a></td>
        </tr>
    <?php
    }

    $listAgents->closeCursor();
    ?>
    </tbody>
</table>

<ul class="mt-5">
    <li><a href=<?= '?entity=agents&action=new' ?>>Creer un nouveau Agent</a></li>
</ul> 

<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
