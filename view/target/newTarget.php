
<?php 
$title = 'creation Cible'; 
$titleh2 = "<h2>Creation d'une nouvelle cible.</h2>";
ob_start();  

$countryManager = new CountryManager(); // Création d'un objet'
$listCountries = $countryManager->getCountries();// Appel d'une fonction de cet objet
$returnToUrl = $_SERVER['HTTP_REFERER'];
?>


<div class="container-fluid m-5 bg-light">
    <form method="post" action="index.php?entity=targets">
        <input id="targetID" name="targetID" type="hidden" value="0">
        <input id="returnToUrl" name="returnToUrl" type="hidden" value=<?=$returnToUrl ?>>
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th><label for="lastname">Nom</label></th>
                <td><input  type = "text" id="lastname" name="lastname"  placeholder ="entrez le nom" required></td>
            </tr>
            <tr>
                <th><label for="firstname">Prenom</th>
                <td><input type="text" id ="firstname" name="firstname" placeholder ="entrez le prénom"" required></td>
            </tr>
            <tr>
                <th><label for="code">Code</th>
                <td><input type="text" id ="code" name="code" placeholder ="entrez le code" required></td>
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
                <th><label for="dateOfBirth" >né(e) en</label></th>
                <td><input type = "date" id="dateOfBirth" name="dateOfBirth" required> 
                </td>
            </tr>

        </table>
        <button type="submit" name="targetAdd"class="btn btn-primary">Enregistrer</button>
    </form>

  
    <ul class="mt-5">
        <li><a href=<?= '?entity=targets' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>