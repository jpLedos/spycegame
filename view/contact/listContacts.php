<?php $title = 'Les contacts'; ?>
        
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
        $showCountry = $countryManager->getCountry($Contact->getCountryId());// Appel d'une fonction de cet objet
        $country = $showCountry->fetchObject('Country');
    ?>
        <tr class="  <?= $Contact->getIsDead() ? 'bg-dark text-white':'' ?>">
        <th scope="row"><?=  $Contact->getId(); ?></th>   
                <td><?=  $Contact->getLastname(); ?></td>
                <td> <?= $Contact->getFirstname();  ?></td>
                <td><em> <?= $Contact->getCode(); ?></em></td>
                <td><?= $country->getFullname(); ?></td>
                <td><?= !$Contact->getIsDead() ? 'Vivant': 'Décédé';  ?> </td>

                <td class ="bg-light text-center d-flex justify-content-evenly ">
                    <a href=<?= '?entity=contacts&id='.$Contact->getId().'&action=show' ?>>
                        <img class="picto" title= "show" src="./asset/image/view.png" alt="show icon"></a>
                    <a href=<?= '?entity=contacts&id='.$Contact->getId().'&action=edit' ?>>
                        <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
                </td>

        </tr>
    <?php
    }

    $listContacts->closeCursor();
    ?>
    </tbody>
</table>

<ul class="mt-5">
    <li><a href=<?= '?entity=contacts&action=new' ?>>Creer nouveau contact</a></li>
</ul> 

<?php $content = ob_get_clean(); 
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
