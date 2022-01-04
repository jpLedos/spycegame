<?php $title = 'Contacts de la mission'; ?>
        
<?php 
ob_start();    
$mission = $showMission->fetchObject('mission');
if($mission) {
    $titleh2 = "<h2>Contacts de la mission ".$mission->getCode()." ".$mission->getTitle()."</h2>";

    $countryManager = new CountryManager(); // Création d'un objet'
    $showCountry = $countryManager->getCountry($mission->getCountryId());// Appel d'une fonction de cet objet
    $country = $showCountry->fetchObject('Country'); 
    $returnTo = $_SERVER['HTTP_REFERER'];
    
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?> 

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=missions">   
    <input id="missionId" name="missionId" type="hidden" value="<?=  $_GET['id']; ?>">
    <input id="returnTo" name="returnTo" type="hidden" value="<?=  $returnTo ?>">
        <table class="table table-hover bg-light" style="width: 60%;">
            <thead>
                <tr class="bg-light">
                    <th>N°</span>   
                    <th class="" >Contacts</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            while  ($contact = $listContacts->fetchObject('Contact'))
            {
                $showContactCountry = $countryManager->getCountry($contact->getCountryId()); 
                $contactCountry = $showContactCountry->fetchObject('Country');
            ?>
            <tr class=''>
                <th scope="row"><?=  $contact->getId(); ?></th>           
                <td>
                    <label for=<?=  $contact->getId(); ?>>
                        <?= $contact->getFullname(); ?>
                        <div class="details">    
                        <p>Pays :<?= $contactCountry->getFullName() ?></p>
                        <div>
                    </label>
                </td>
                <td>
                    <input 
                        type="checkbox"
                        value=<?=  $contact->getId(); ?>
                        id=<?=  $contact->getId(); ?>
                        name="toBeAdded.<?= $contact->getId(); ?>."
                        name="toBeAdded.<?= $contact->getId(); ?>."
                        <?= !getIsMissionContact($_GET['id'],$contact->getId()) ? 'checked':''  ?>checked />
                </td>
                <td><a href=<?= '?entity=contacts&id='.$contact->getId().'&action=edit' ?>>
                    <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
                </td>
            </tr>
            <?php
            }

            $listContacts->closeCursor();
            ?>
        </table>  
        <ul class="mt-5">
            <li><a href=<?= '?entity=contacts&action=new' ?>>Creer une nouvel Contact</a></li>
        </ul>   
        <button type="submit" name="contactsUpdated" class="btn btn-primary">Enregistrer</button>
    </form>
</div>


<?php $content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
