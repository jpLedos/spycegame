<?php $title = 'Les Planques'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Planques</h2>";
$countryManager = new CountryManager(); // Création d'un objet'
$hidewayTypeManager = new HydeawayTypeManager(); // Création d'un objet'
?> 

<div class="container-fluid m-5">
    <table class="table table-hover" style="width: 80%;">
        <thead>
            <tr class="bg-light">
                <th>N°</span>   
                <th class="" >Code</th>
                <th class="" >Addresse</th>
                <th class="">Pays</th>
                <th>Type</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php
        while  ($Hideaway = $listHideaways->fetchObject('Hideaway'))
        {
            //echo($Hideaway->getHideawayTypeId());
            //echo($Hideaway->getCountryId());
            $showCountry = $countryManager->getCountry($Hideaway->getCountryId());// Appel d'une fonction de cet objet
            $country = $showCountry->fetchObject('Country');
            $showHideawayType = $hidewayTypeManager->getHideawayType($Hideaway->getHideawayTypeId());// Appel d'une fonction de cet objet
            $hideawayType = $showHideawayType->fetchObject('HideawayType');
;       
             /* <td><?= $country->getFullname(); ?></td>
                 */
        ?>
            <tr>
                <th scope="row"><?=  $Hideaway->getId(); ?></th>   
                <td><?=  $Hideaway->getCode(); ?></td>
                <td> <?= $Hideaway->getAddress();  ?></td>
                <td><?= $country ? $country->getFullName() : 'inconnu'; ?></td>
                <td><?= $hideawayType ? $hideawayType->getName() : 'inconnu'; ?></td>
                
                <td class ="bg-light text-center d-flex justify-content-evenly ">
                    <a href=<?= '?entity=hideaways&id='.$Hideaway->getId().'&action=show' ?>>
                        <img class="picto" title= "show" src="./asset/image/view.png" alt="show icon"></a>
                    <a href=<?= '?entity=hideaways&id='.$Hideaway->getId().'&action=edit' ?>>
                        <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
                </td>
            </tr>
        <?php
        }

        $listHideaways->closeCursor();
        ?>
        </tbody>
    </table>
</div>
<ul class="mt-5">
    <li><a href=<?= '?entity=hideaways&action=new' ?>>Creer une nouvelle planque</a></li>
</ul> 

<?php $content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); 
?>
