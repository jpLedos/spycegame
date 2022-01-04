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
        $showCountry = $countryManager->getCountry($target->getCountryId());// Appel d'une fonction de cet objet
        $country = $showCountry->fetchObject('Country');
    ?>
        <tr class="  <?= $target->getIsDead() ? 'bg-dark text-white':''  ?>">
        <th scope="row"><?=  $target->getId(); ?></th>   
                <td><?=  $target->getLastname(); ?></td>
                <td> <?= $target->getFirstname();  ?></td>
                <td><em> <?= $target->getCode(); ?></em></td>
                <td><?= $country->getFullname(); ?></td>
                <td><?= !$target->getIsDead() ? 'Vivant': 'Décédé';  ?> </td>

                <td class ="bg-light text-center d-flex justify-content-evenly ">
                    <a href=<?= '?entity=targets&id='.$target->getId().'&action=show' ?>>
                        <img class="picto" title= "show" src="./asset/image/view.png" alt="show icon"></a>
                    <a href=<?= '?entity=targets&id='.$target->getId().'&action=edit' ?>>
                        <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
                </td>
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

<?php $content = ob_get_clean(); 
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
