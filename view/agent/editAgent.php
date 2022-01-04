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

//naviguation vers mission si on vient de là
$returnToUrl = $_SERVER['HTTP_REFERER'];
if(isset($_GET['missionId'])) {
    $urlMission = "&missionId=".$_GET['missionId'];
} else {
    $urlMission='';
}
?>

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=agents">
        <input id="AgentID" name="AgentID" type="hidden" value="<?=  $Agent->getId(); ?>">
        <?php if(isset($_GET['missionId'])) { ?>
        <input id="missionId" name="missionId" type="hidden" value="<?= $_GET["missionId"]; ?>">
        <?php } ?>
        <input id="returnToUrl" name="returnToUrl" type="hidden" value=<?=$returnToUrl ?>>
        <input id="isConform" name="isConform" type="hidden" value="<?=  $Agent->getIsConform(); ?>">

        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th>N°</th>
                <td><?=  $Agent->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="lastname">Nom</label></th>
                <td><input  type = "text" 
                            id="lastname" 
                            name="lastname"  
                            value="<?=  $Agent->getLastName(); ?>"></td>
            </tr>
            <tr>
                <th><label for="firstname">Prenom</th>
                <td><input type="text" 
                            id ="firstname" 
                            name="firstname" 
                            value="<?= $Agent->getFirstname();  ?>"></td>
            </tr>
            <tr>
                <th><label for="code">Code</th>
                <td><input type="text" 
                            id ="code" 
                            name="code" 
                            value="<?= $Agent->getcode();  ?>"></td>
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
            <tr id="specialities">
            <th>Specialités</th>
            <td>
                <ul>
                <?php 
                    while ($speciality = $agentSpecialities->fetch(PDO::FETCH_ASSOC)) {
                    echo("<li>".$speciality['speciality']."</li>");
                    } 
                ?>
                </ul>
                <div class="rules">
                    Un agent doit posseder au moins une specialité!
                </div>
            </td>
            <td width=20%>
                <a href="?entity=agents&id=<?=$Agent->getId()?>&action=specialities<?= $urlMission?>" >
                Gestion des specialités</a></td>
        </tr>
        <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php 
                    while ($mission = $agentMissions->fetch(PDO::FETCH_ASSOC)) {
                    echo("<li>".$mission['title']."</li>");
                    } 
                ?>
                </ul>
            </td>
        </tr>
        </table>
        <button type="submit" name="agentUpdate" class="btn btn-primary">Enregistrer</button>
    </form>

    <ul class="mt-5">
        <?php if($agentMissions->rowCount()==0) { ?>
            <li>
                <a href=<?= '?entity=agents&id='.$Agent->getId().'&action=delete' ?>
                    onclick="return confirm('Etes vous sur de vouloir effectuer la suppression ?')">
                    <img class="picto" title= "delete" src="./asset/image/bin.png" alt="bin icon"></a>
            </li>
        <?php } ?>
        <li><a href=<?= '?entity=agents' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showAgent->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/checkAgent.js'></script>";
require('view/layout.php'); ?>