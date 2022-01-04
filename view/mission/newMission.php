
<?php 

ob_start();  


$title = 'creation Mission'; 
$titleh2 = "<h2>Creation d'une nouvelle mission</h2>";

$countryManager = new CountryManager(); // get country from countryId
$listCountries = $countryManager->getCountries();

$typeManager = new TypeManager(); //get Type from typeId
$listTypes = $typeManager->getTypes();

$specialityManager = new SpecialityManager();  // get speciality from specialityId
$listSpecialities = $specialityManager->getSpecialities();

$statutManager = new statutManager(); 
$listStatuts = $statutManager->getStatuts();


?>


<div class="container-fluid m-5 bg-light">
    <form method="post" action="index.php?entity=missions">
        <input id="missionId" name="missionId" type="hidden" value="0">
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th><label for="title">Titre</label></th>
                <td><input  type = "text" id="title" name="title"  placeholder ="entrez le titre" required></td>
            </tr>
            <tr>
                <th><label for="code">Code</label></th>
                <td><input  type = "text" id="code" name="code"  placeholder ="entrez le code" required></td>
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
                <th><label for="typeId" >Type</th>
                <td><select id="typeId" name="typeId">
                <?php
                while  ($type = $listTypes->fetchObject('Type'))
                {?>
                    <option value="<?= $type->getId() ?>"
                    ><?= $type->getType() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>
            <tr>
                <th><label for="specialityId" >Specialité</th>
                <td><select id="specialityId" name="specialityId">
                <?php
                while  ($speciality = $listSpecialities->fetchObject('Speciality'))
                {?>
                    <option value="<?= $speciality->getId() ?>"
                    ><?= $speciality->getSpeciality() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>
            <tr>
                <th><label for="descriptions">Description</th>
                <td><textarea   id ="descriptions" name="descriptions"  
                                cols="80" placeholder ="entrez la description" required
                ></textarea></td>
            </tr>
            <tr>
                <th><label for="startDate" >Date Début</label></th>
                <td><input type = "date" id="startDate" name="startDate" 
                placeholder ="entrez la date de début" required > 
                </td>
            </tr>            <tr>
                <th><label for="endDate" >Date Fin</label></th>
                <td><input type = "date" id="endDate" name="endDate" 
                placeholder ="entrez la date fin" required> 
                </td>
            </tr>

        </table>
        <button type="submit" name="MissionAdd" class="btn btn-primary">Enregistrer</button>
    </form>

  
    <ul class="mt-5">
        <li><a href=<?= '?entity=missions' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); 
?>