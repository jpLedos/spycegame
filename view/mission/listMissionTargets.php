<?php $title = 'Targets de la mission'; ?>
        
<?php 
ob_start();    
$mission = $showMission->fetchObject('mission');
if($mission) {
    $titleh2 = "<h2>Targets de la mission ".$mission->getCode()." ".$mission->getTitle()."</h2>";

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
                    <th class="" >Targets</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            while  ($target = $listTargets->fetchObject('Target'))
            {
            ?>
            <tr class=''>
                <th scope="row"><?=  $target->getId(); ?></th>           
                <td>
                    <label for=<?=  $target->getId(); ?>>
                        <?= htmlspecialchars($target->getFullname()); ?>
                    </label>
                </td>
                <td>
                    <input 
                        type="checkbox"
                        value=<?=  $target->getId(); ?>
                        id=<?=  $target->getId(); ?>
                        name="toBeAdded.<?= $target->getId(); ?>."
                        name="toBeAdded.<?= $target->getId(); ?>."
                        <?= !getIsMissionTarget($_GET['id'],$target->getId()) ? 'checked':''  ?>checked />
                </td>
            </tr>
            <?php
            }

            $listTargets->closeCursor();
            ?>
        </table>  
        <ul class="mt-5">
            <li><a href=<?= '?entity=targets&action=new' ?>>Creer une nouvel Target</a></li>
        </ul>   
        <button type="submit" name="targetsUpdated" class="btn btn-primary">Enregistrer</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
