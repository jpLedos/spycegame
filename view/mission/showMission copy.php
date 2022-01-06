<?php 
$title = 'Detail Mission';

ob_start();  

$mission = $showMission->fetchObject('mission');
if($mission) {
    $titleh2 = "<h2>Description de la mission code : ".$mission->getCode()."</h2>";

    $countryManager = new CountryManager(); // get country from countryId
    $showCountry = $countryManager->getCountry($mission->getCountryId()); 
    $country = $showCountry->fetchObject('Country'); 
 
    $typeManager = new TypeManager(); //get Type from typeId
    $showType = $typeManager->getType($mission->getTypeId());
    $type = $showType->fetchObject('Type');
   
    $specialityManager = new SpecialityManager();  // get speciality from specialityId
    $showSpeciality = $specialityManager->getSpeciality($mission->getSpecialityId());
    $speciality = $showSpeciality->fetchObject('Speciality');

    $statutManager = new StatutManager();  // get speciality from specialityId
    $showStatut = $statutManager->getStatut($mission->getStatutId());
    $statut = $showStatut->fetchObject('Statut');

} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 80%;">
        <tr>
            <th>N°</th>
            <td><?=  $mission->getId(); ?></td>
        </tr>

            <th>Titre</th>
            <td><?= $mission->getTitle();  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td id="country"><?= $country->getFullName();  ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?= $mission->getDescriptions();  ?> </td>
        </tr>
        <tr>
            <th>Type</th>
            <td><?= $type->getType();  ?> </td>
        </tr>
        <tr>
            <th>Statut</th>
            <td><?= $statut->getStatut(); ?></td>
        </tr>
        <tr>
            <th>Specialité</th>
            <td id='speciality'><?= $speciality->getSpeciality();?> </td>
        </tr>
        <tr>
            <th width="20%">Date debut</th>
            <td width="80%"><?= date('d-m-Y',strToTime($mission->getStartDate()));  ?> </td>
            </tr>
            <tr>
            <th width="20%" >Date fin</th>
            <td width="20%" ><?= date('d-m-Y',strToTime($mission->getEndDate()));  ?> </td>
        </tr>
        <tr id='agents'>
            <th>Agents</th>
            <td>
                <ul>
                <?php 
                while ($missionAgent = $missionAgents->fetch()) {
                    $agentManager = new AgentManager();
                    $showAgent = $agentManager->getAgent($missionAgent['agentId']); 
                    $agent= $showAgent->fetchObject('Agent');

                    $showAgentSpecialities = $agentManager->getSpecialitiesFromAgent($agent->getId());

                    $showCountry = $countryManager->getCountry($agent->getCountryId()); 
                    $country = $showCountry->fetchObject('Country');
                ?>
                    
                    <li><?= $agent->getFullName(); ?>
                        <div class="details">    
                            <p>Pays : <span class="agentCountry"><?= $country->getFullName() ?></span></p>
                            <p class="agentSpecialities">Specialités :       
                            <?php
                            while ($agentSpeciality = $showAgentSpecialities->fetch(PDO::FETCH_ASSOC)) 
                                    {
                                    echo($agentSpeciality['speciality'].", ");
                                    }
                            ?>
                            </p>
                        </div>
                    </li>
                <?php
                } 
                ?>
                </ul>
                <div class="rules">Il faut un agent minimum ! <br>
                    Un agent ne peut pas être d'un pays identique à une cible ! <br>
                    Un agent doit posseder la specialité requise par la mission !
                </div>
            </td>
        </tr>
        <tr id='targets'>
            <th>Cibles</th>
            <td>
                <ul>
                <?php 
                    while ($missionTarget = $missionTargets->fetch()) {
                        $targetManager = new TargetManager();
                        $showTarget = $targetManager->getTarget($missionTarget['targetId']); 
                        $target= $showTarget->fetchObject('Target');

                        $showCountry = $countryManager->getCountry($target->getCountryId()); 
                        $country = $showCountry->fetchObject('Country'); 
                ?>
                        <li><?= $target->getFullName(); ?>
                        <div>Pays : <span class="targetCountry"><?= $country->getFullName() ?></span></div>
                        </li>
                <?php 
                }   
                ?>
                </ul>
                <div class="rules">il faut definir au moins une cible pour cette mission !</div>
            </td>
        </tr>
        <tr id="contacts">
            <th>Contacts</th>
            <td>
                <ul>
                <?php 
                    while ($missionContact = $missionContacts->fetch()) {
                        $contactManager = new ContactManager();
                        $showContact = $contactManager->getContact($missionContact['contactId']); 
                        $contact= $showContact->fetchObject('Contact');

                        $showCountry = $countryManager->getCountry($contact->getCountryId()); 
                        $country = $showCountry->fetchObject('Country'); 
                ?>
                        <li><?= $contact->getFullName() ?>
                        <div>Pays : <span class="contactCountry"><?= $country->getFullName() ?><span></div>  
                        </li>
                        
                <?php
                $showContact->closeCursor();
                    } 
                ?>
                </ul>
                <div class="rules">il faut un contact minimum ! Et un contact doit être d'un pays identique à la mission</div>
            </td>
        </tr>
        <tr id='hideaways'>
            <th>Planques</th>
            <td>
                <ul>
                <?php 
                    while ($missionHideaway = $missionHideaways->fetch()) {
                        $hideawayManager = new HideawayManager();
                        $showHideaway = $hideawayManager->getHideaway($missionHideaway['hideawayId']); 
                        $hideaway= $showHideaway->fetchObject('Hideaway');

                        $hidewayTypeManager = new HydeawayTypeManager(); // Création d'un objet'
                        $showHideawayType = $hidewayTypeManager->getHideawayType($hideaway->getHideawayTypeId());
                        $hideawayType = $showHideawayType->fetchObject('HideawayType');

                        $showCountry = $countryManager->getCountry($hideaway->getCountryId()); 
                        $country = $showCountry->fetchObject('Country'); 
                ?>
                        <li><?= $hideaway->getFullName() ?> 
                            <div class="details">
                                <p>Type : <?= $hideawayType->getName() ?></p>
                                <p>Pays : <?= $country->getFullName() ?></p>
                        </li>
                        
                <?php 
                    $showHideaway->closeCursor();
                    } 
                ?>
               
                </ul>
                <div class="rules">Au moins une planque n'est pas dans le pays de la mission !</div>
            </td>
        </tr>

    </table>


    <ul class="mt-5">
    <?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {
             if ($mission->getStatutId()<3) {
            ?>
        <li><a href=<?= '?entity=missions&id='.$mission->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=missions&id='.$mission->getId().'&action=delete' ?>>delete</a></li>
    <?php
        }
    }
    ?>    
        <li><a href=<?= '?entity=missions' ?>>retour à la liste</a></li>
    </ul>   

</div>

<?php 
$showMission->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/checkMission.js'></script>";
require('view/layout.php'); ?>
