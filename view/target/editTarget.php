<?php $title = 'Modification cible'; ?>
      
<?php 
ob_start();  
$returnToUrl = $_SERVER['HTTP_REFERER'];
$target = $showTarget->fetchObject('Target');
if($target) {
    $countryManager = new CountryManager(); // Création d'un objet'
    $listCountries = $countryManager->getCountries();// Appel d'une fonction de cet objet
    $titleh2 = "<h2>Modification de la cible code : ".$target->getCode()."</h2>";
}else {
    echo('Aucun resultat pour cette requête !');
    die;
}

?>

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=targets">
        <input id="targetID" name="targetID" type="hidden" value="<?=  $target->getId(); ?>">
        <input id="returnToUrl" name="returnToUrl" type="hidden" value=<?=$returnToUrl ?>>
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th>N°</th>
                <td><?=  $target->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="lastname">Nom</label></th>
                <td><input  type = "text" id="lastname" name="lastname"  value="<?=  htmlspecialchars($target->getLastName()); ?>"></td>
            </tr>
            <tr>
                <th><label for="firstname">Prenom</th>
                <td><input type="text" id ="firstname" name="firstname" value="<?= htmlspecialchars($target->getFirstname());  ?>"></td>
            </tr>
            <tr>
                <th><label for="code">Code</th>
                <td><input type="text" id ="code" name="code" value="<?= htmlspecialchars($target->getcode());  ?>"></td>
            </tr>
            <tr>
                <th><label for="countryId" >Pays</th>
                <td><select id="countryId" name="countryId">
                <?php
                while  ($country = $listCountries->fetchObject('Country'))
                {?>
                    <option value="<?= $country->getId() ?>"
                    <?= $country->getId()===$target->getCountryId() ? "selected":"" ?>
                    ><?= $country->getFullName() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>
            <tr>
                <th><label for="dateOfBirth" >né(e) en</label></th>
                <td><input type = "date" id="dateOfBirth" name="dateOfBirth" 
                    value="<?= htmlspecialchars($target->getdateOfBirth()); ?>"> 
                </td>
            </tr>
            <tr>
                <th><label for="isDead">En vie</label></th>
                <td><input type="checkbox"
                            value="0"
                            id="isDead" 
                            name="isDead" <?= $target->getIsDead() ? 'checked':''  ?>checked> (coché = vivant)</td>
            </tr>
        </table>
        <button type="submit" name="targetUpdate"class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
        <li><a href=<?= '?entity=targets&id='.$target->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=targets&id='.$target->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=targets' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showTarget->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>