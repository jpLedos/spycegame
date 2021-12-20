<?php $title = 'Modification Agent'; ?>
      
<?php 
ob_start();  
$Agent = $showAgent->fetchObject('Agent');
if($Agent) {
    $countryManager = new CountryManager(); // Création d'un objet'
    $listCountries = $countryManager->getCountries();// Appel d'une fonction de cet objet
    $titleh2 = "<h2>Modification de l'agent code : ".$Agent->getCode()."</h2>";
}else{
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=agents">
        <input id="AgentID" name="AgentID" type="hidden" value="<?=  $Agent->getId(); ?>">
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th>N°</th>
                <td><?=  $Agent->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="lastname">Nom</label></th>
                <td><input  type = "text" id="lastname" name="lastname"  value="<?=  htmlspecialchars($Agent->getLastName()); ?>"></td>
            </tr>
            <tr>
                <th><label for="firstname">Prenom</th>
                <td><input type="text" id ="firstname" name="firstname" value="<?= htmlspecialchars($Agent->getFirstname());  ?>"></td>
            </tr>
            <tr>
                <th><label for="code">Code</th>
                <td><input type="text" id ="code" name="code" value="<?= htmlspecialchars($Agent->getcode());  ?>"></td>
            </tr>
            <tr>
                <th><label for="countryId" >Pays</th>
                <td><select id="countryId" name="countryId">
                <?php
                while  ($country = $listCountries->fetchObject('Country'))
                {?>
                    <option value="<?= $country->getId() ?>"
                    <?= $country->getId()===$Agent->getCountryId() ? "selected":"" ?>
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
                    value="<?= htmlspecialchars($Agent->getdateOfBirth()); ?>"> 
                </td>
            </tr>
            <tr>
                <th><label for="isDead">En vie</label></th>
                <td>
                    <input type="checkbox"
                            value="0"
                            id="isDead" 
                            name="isDead" <?= $Agent->getIsDead() ? 'checked':''  ?>checked />
                            (coché = vivant)
                </td>
            </tr>
            <tr>
            <th>Specialités</th>
            <td>
                <ul>
                <?php 
                    while ($speciality = $agentSpecialities->fetch(PDO::FETCH_ASSOC)) {
                    echo("<li>".$speciality['speciality']."</li>");
                    } 
                ?>
                </ul>
            </td>
            <td width=20%><a href="?entity=agents&id=<?=$Agent->getId()?>&action=specialities">Gestion des specialités</a></td>
        </tr>
        </table>
        <button type="submit" name="agentUpdate" class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
        <li><a href=<?= '?entity=agents&id='.$Agent->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=agents&id='.$Agent->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=agents' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showAgent->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>