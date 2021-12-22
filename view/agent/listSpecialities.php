<?php $title = 'Les Specialities'; ?>
        
<?php 
ob_start();    
$agent = $showAgent->fetchObject('agent');
if($agent) {
    $titleh2 = "<h2>Specialités de l'agent ".$agent->getCode()." ".$agent->getFullName()."</h2>";

    $countryManager = new CountryManager(); // Création d'un objet'
    $showCountry = $countryManager->getCountry($agent->getCountryId());// Appel d'une fonction de cet objet
    $country = $showCountry->fetchObject('Country'); 
    $returnTo = $_SERVER['HTTP_REFERER'];
    
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}

?> 

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=agents">   
    <input id="AgentId" name="AgentId" type="hidden" value="<?=  $_GET['id']; ?>">
    <input id="returnTo" name="returnTo" type="hidden" value="<?=  $returnTo ?>">
        <table class="table table-hover bg-light" style="width: 60%;">
            <thead>
                <tr class="bg-light">
                    <th>N°</span>   
                    <th class="" >Specialité</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            while  ($Speciality = $listSpecialities->fetchObject('Speciality'))
            {
            ?>
            <tr class=''>
                <th scope="row"><?=  $Speciality->getId(); ?></th>   
                <td><?=  htmlspecialchars($Speciality->getSpeciality()); ?></td>
                <td>
                    <input type="checkbox"
                            value=<?=  $Speciality->getId(); ?>
                            id=<?=  $Speciality->getId(); ?>
                            name="toBeAdded.<?=  $Speciality->getId(); ?>."
                            <?= !getIsAgentSpeciality($_GET['id'],$Speciality->getId()) ? 'checked':''  ?>checked />
                </td>
            </tr>
            <?php
            }

            $listSpecialities->closeCursor();
            ?>
        </table>  
        <ul class="mt-5">
            <li><a href=<?= '?entity=specialities&action=new' ?>>Creer une nouvelle Specialité</a></li>
        </ul>   
        <button type="submit" name="specialityUpdated" class="btn btn-primary">Enregistrer</button>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
