<?php $title = 'Agents de la mission'; ?>
        
<?php 
ob_start();    
$mission = $showMission->fetchObject('mission');
if($mission) {
    $titleh2 = "<h2>Agents de la mission ".$mission->getCode()." ".$mission->getTitle()."</h2>";

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
                    <th class="" >Agents</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            while  ($agent = $listAgents->fetchObject('Agent'))
            {
            ?>
            <tr class=''>
                <th scope="row"><?=  $agent->getId(); ?></th>   
                <td><?=  htmlspecialchars($agent->getFullname()); ?></td>
                </td><td>
                <td>
                    <input 
                        type="checkbox"
                        value=<?=  $agent->getId(); ?>
                        id=<?=  $agent->getId(); ?>
                        name="toBeAdded.<?= $agent->getId(); ?>."
                        <?= !getIsMissionAgent($_GET['id'],$agent->getId()) ? 'checked':''  ?>checked />
                </td>
            </tr>
            <?php
            }

            $listAgents->closeCursor();
            ?>
        </table>  
        <ul class="mt-5">
            <li><a href=<?= '?entity=agents&action=new' ?>>Creer une nouvel Agent</a></li>
        </ul>   
        <button type="submit" name="agentsUpdated" class="btn btn-primary">Enregistrer</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
