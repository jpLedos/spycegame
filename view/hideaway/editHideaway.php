<?php $title = 'Modification Planque'; ?>
      
<?php 
ob_start();  
$returnToUrl = $_SERVER['HTTP_REFERER'];
$Hideaway = $showHideaway->fetchObject('Hideaway');
if($Hideaway) {
    $countryManager = new CountryManager(); // Création d'un objet'
    $listCountries = $countryManager->getCountries();// Appel d'une fonction de cet objet
    $hideawayTypeManager = new HydeawayTypeManager(); // Création d'un objet'
    $listhideawayTypes = $hideawayTypeManager->getHideawayTypes();// Appel d'une fonction de cet objet
    $titleh2 = "<h2>Modification de la planque</h2>";
}else{
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=hideaways">
        <input id="HideawayId" name="HideawayId" type="hidden" value="<?=  $Hideaway->getId(); ?>">
        <input id="returnToUrl" name="returnToUrl" type="hidden" value=<?=$returnToUrl ?>>
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th>N°</th>
                <td><?=  $Hideaway->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="code">Code</label></th>
                <td><input  type = "text" id="code" name="code"  value="<?= $Hideaway->getCode(); ?>"></td>
            </tr>
            <tr>
                <th><label for="address">address</th>
                <td><input type="text" id ="address" name="address" value="<?= $Hideaway->getAddress();   ?>"></td>
            </tr>
            <tr>
                <th><label for="countryId" >Pays</th>
                <td><select id="countryId" name="countryId">
                <?php
                while  ($country = $listCountries->fetchObject('Country'))
                {?>
                    <option value="<?= $country->getId() ?>"
                    <?= $country->getId()===$Hideaway->getCountryId() ? "selected":"" ?>
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
                    <?= $hideawayType->getId()===$Hideaway->gethideawayTypeId() ? "selected":"" ?>
                    ><?= $hideawayType->getName() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>
            <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php 
                while ($mission = $hideawayMissions->fetch(PDO::FETCH_ASSOC)) {  
                ?>
                    <li><?= $mission['title']; ?> </li>
                <?php  
                } 
                ?> 
                </ul>
            </td>
        </tr>    
        </table>
        <button type="submit" name="hideawayUpdate"class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
        <?php if($hideawayMissions->rowCount()==0) { ?>
            <li>
                <a href=<?= '?entity=hideaways&id='.$Hideaway->getId().'&action=delete' ?>
                    onclick="return confirm('Etes vous sur de vouloir effectuer la suppression ?')">
                    <img class="picto" title= "delete" src="./asset/image/bin.png" alt="bin icon"></a>
            </li>
        <?php } ?>
        <li><a href=<?= '?entity=hideaways' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showHideaway->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>