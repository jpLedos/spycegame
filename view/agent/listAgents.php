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
        <tr class="line-agent">
        <td class="isConform" style=display:none><?= $Agent->getIsConform() ?></td> 
        <td class="isDead" style=display:none><?= $Agent->getIsDead() ?></td> 
            <th scope="row"><?=  $Agent->getId(); ?></th>   
            <td><?=  $Agent->getLastname(); ?></td>
            <td> <?= $Agent->getFirstname();  ?></td>
            <td><em> <?= $Agent->getCode(); ?></em></td>
            <td><?= $country->getFullname(); ?></td>
            <td><?= !$Agent->getIsDead() ? 'Vivant': 'Décédé';  ?> </td>
            <td class ="bg-light text-center d-flex justify-content-evenly ">
                <a href=<?= '?entity=agents&id='.$Agent->getId().'&action=show' ?>>
                    <img class="picto" title= "show" src="./asset/image/view.png" alt="show icon"></a>
                <a href=<?= '?entity=agents&id='.$Agent->getId().'&action=edit' ?>>
                    <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>

            </td>
           
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

<?php $content = ob_get_clean(); 
$script="<script src='./scripts/listAgents.js'></script>";
require('view/layout.php');
?>