<?php $title = 'Modification cible'; ?>
      
<?php 
ob_start();  
$Contact = $showContact->fetchObject('Contact');
$countryManager = new CountryManager(); // Création d'un objet'
$listCountries = $countryManager->getCountries();// Appel d'une fonction de cet objet

$titleh2 = "<h2>Modification de la cible code : ".$Contact->getCode()."</h2>";
?>

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=contacts">
        <input id="ContactID" name="ContactID" type="hidden" value="<?=  $Contact->getId(); ?>">
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th>N°</th>
                <td><?=  $Contact->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="lastname">Nom</label></th>
                <td><input  type = "text" id="lastname" name="lastname"  value="<?=  htmlspecialchars($Contact->getLastName()); ?>"></td>
            </tr>
            <tr>
                <th><label for="firstname">Prenom</th>
                <td><input type="text" id ="firstname" name="firstname" value="<?= htmlspecialchars($Contact->getFirstname());  ?>"></td>
            </tr>
            <tr>
                <th><label for="code">Code</th>
                <td><input type="text" id ="code" name="code" value="<?= htmlspecialchars($Contact->getcode());  ?>"></td>
            </tr>
            <tr>
                <th><label for="countryId" >Pays</th>
                <td><select id="countryId" name="countryId">
                <?php
                while  ($country = $listCountries->fetchObject('Country'))
                {?>
                    <option value="<?= $country->getId() ?>"
                    <?= $country->getId()===$Contact->getCountryId() ? "selected":"" ?>
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
                    value="<?= htmlspecialchars($Contact->getdateOfBirth()); ?>"> 
                </td>
            </tr>
            <tr>
                <th><label for="isDead">En vie</label></th>
                <td><input type="checkbox"
                            value="0"
                            id="isDead" 
                            name="isDead" <?= $Contact->getIsDead() ? 'checked':''  ?>checked> (coché = vivant)</td>
            </tr>
        </table>
        <button type="submit" name="submit"class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
        <li><a href=<?= '?entity=Contacts&id='.$Contact->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=Contacts&id='.$Contact->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=Contacts' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showContact->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>