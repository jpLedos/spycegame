
<?php 
$title = 'Creation Planque'; 
$titleh2 = "<h2>Creation d'une nouvelle planque.</h2>";
ob_start();  

$countryManager = new CountryManager(); // Création d'un objet'
$listCountries = $countryManager->getCountries();// Appel d'une fonction de cet objet
$hideawayTypeManager = new HydeawayTypeManager(); // Création d'un objet'
$listhideawayTypes = $hideawayTypeManager->getHideawayTypes();// Appel d'une fonction de cet objet
$returnToUrl = $_SERVER['HTTP_REFERER'];
?>


<div class="container-fluid m-5 bg-light">
    <form method="post" action="index.php?entity=hideaways">
        <input id="HideawayId" name="HideawayId" type="hidden" value="0">
        <input id="returnToUrl" name="returnToUrl" type="hidden" value=<?=$returnToUrl ?>>

        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th><label for="code">Code</th>
                <td><input type="text" id ="code" name="code" placeholder ="entrez le code" required></td>
            </tr>
            <tr>
                <th><label for="address">Adresse</label></th>
                <td><input  type = "text" id="address" name="address"  placeholder ="entrez l'adresse" required></td>
            </tr>

            <tr>
                <th><label for="countryId" >Pays</th>
                <td><select id="countryId" name="countryId">
                <?php
                while  ($country = $listCountries->fetchObject('Country'))
                {?>
                    <option value="<?= $country->getId() ?>"
                    ><?= $country->getFullName() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>

            <tr>
                <th><label for="hideawayTypeId" >Type</th>
                <td><select id="hideawayTypeId" name="hideawayTypeId">
                <?php
                while  ($hideawayType = $listhideawayTypes->fetchObject('HideawayType'))
                {?>
                    <option value="<?= $hideawayType->getId() ?>"
                    ><?= $hideawayType->getName() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>


        </table>
        <button type="submit" name="hideawayAdd"class="btn btn-primary">Enregistrer</button>
    </form>

  
    <ul class="mt-5">
        <li><a href=<?= '?entity=hideaways' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>