<?php $title = 'Agents de la mission'; ?>
        
<?php 
ob_start();    
$mission = $showMission->fetchObject('mission');
if($mission) {
    $titleh2 = "<h2>Agents de la mission ".$mission->getCode()." ".$mission->getTitle()."</h2>";

    $countryManager = new CountryManager(); 
    $showCountry = $countryManager->getCountry($mission->getCountryId());
    $showSpeciality = $SpecialityManager->getSpeciality($mission->getSpecialityId());
    $speciality = $showSpeciality->fetchObject('Speciality');
    $country = $showCountry->fetchObject('Country'); 
    $returnTo = $_SERVER['HTTP_REFERER'];
    
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?> 
<p>Selection agents pour une mission destination :  <?= $country->getFullName()?><br>
    Specialité requise : <?= $speciality->getSpeciality()?></p>
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
                $showAgentCountry = $countryManager->getCountry($agent->getCountryId()); 
                $agentCountry = $showAgentCountry->fetchObject('Country');
                $showAgentSpecialities = $agentManager->getSpecialitiesFromAgent($agent->getId());

            ?>
            <tr class=''>
                <th scope="row"><?=  $agent->getId(); ?></th>   
                <td><?= $agent->getFullName(); ?>
                    <div class="details">    
                        <p>Pays : <span class="agentCountry"><?= $agentCountry->getFullName() ?></span></p>
                        <p class="agentSpecialities">Specialités :       
                        <?php
                        while ($agentSpeciality = $showAgentSpecialities->fetch(PDO::FETCH_ASSOC)) 
                                {
                                echo($agentSpeciality['speciality'].", ");
                                }
                        ?>
                        </p>
                    </div>
                    </td>
                    <td>
                    <input 
                        type="checkbox"
                        value=<?=  $agent->getId(); ?>
                        id=<?=  $agent->getId(); ?>
                        name="toBeAdded.<?= $agent->getId(); ?>."
                        name="toBeAdded.<?= $agent->getId(); ?>."
                        <?= !getIsMissionAgent($_GET['id'],$agent->getId()) ? 'checked':''  ?>checked />
                </td>
                <td><a href=<?= '?entity=agents&id='.$agent->getId().'&action=edit&missionId='.$_GET['id'] ?>>
                    <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
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


<?php $content = ob_get_clean(); 
$script="<script src='./scripts/no-script.js'></script>";
 require('view/layout.php'); ?>
