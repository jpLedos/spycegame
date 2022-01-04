<?php 
$title = 'Modification Mission'; 

ob_start();  

    $titleh2 = "<h2>Description de la mission code : ".$mission->getCode()."</h2>";

    $countryManager = new CountryManager(); // get country from countryId
    $listCountries = $countryManager->getCountries();
 
    $typeManager = new TypeManager(); //get Type from typeId
    $listTypes = $typeManager->getTypes();
    
    $specialityManager = new SpecialityManager();  // get speciality from specialityId
    $listSpecialities = $specialityManager->getSpecialities();

    $statutManager = new statutManager(); 
    $listStatuts = $statutManager->getStatuts();
?>

<div class="container-fluid m-3">
    <form method="post" action="index.php?entity=missions">
        <input id="MissionId" name="MissionId" type="hidden" value="<?=  $mission->getId(); ?>">
        <input id="isConform" name="isConform" type="hidden" value="<?=  $mission->getIsConform(); ?>">
        <table class="table bg-light m-2" style="width: 100%;">
            <tr>
                <th>N°</th>
                <td><?=  $mission->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="title">Titre</label></th>
                <td><input  type = "text" 
                            id="title" name="title"  
                            value="<?=  $mission->getTitle(); ?>"></td>
            </tr>
            <tr>
                <th><label for="code">Code</label></th>
                <td><input  type = "text" 
                            id="code" name="code"  
                            value="<?=  $mission->getCode(); ?>"></td>
            </tr>
            <tr>
                <th><label for="statutId">Statut</th>
                <td><select id="statutId" name="statutId">
                <?php
                while  ($statut = $listStatuts->fetchObject('Statut'))
                {?>
                    <option value="<?= $statut->getId() ?>"
                    <?= $statut->getId()===$mission->getStatutId() ? "selected":"" ?>
                    ><?= $statut->getStatut() ?>
                    </option>
                <?php
                }
                ?> 
                </td>
            </tr>
            <tr>
                <th><label for="countryId" >Pays</th>
                <td><select id="countryId" name="countryId">
                <?php
                while  ($country = $listCountries->fetchObject('Country'))
                {?>
                    <option value="<?= $country->getId() ?>"
                    <?= $country->getId()===$mission->getCountryId() ? "selected" : "" ?>
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
                    <?= $type->getId()===$mission->getTypeId() ? "selected" : "" ?>
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
                    <?= ($speciality->getId() == $mission->getSpecialityId()) ? "selected" : "" ?>
                    ><?= $speciality->getSpeciality() ?>
                    </option>
                <?php
                }
                ?>    
                </td>
            </tr>
            <tr>
                <th><label for="descriptions">Description</th>
                <td><textarea id ="descriptions" name="descriptions"  cols="80"
                ><?= $mission->getDescriptions();  ?></textarea></td>
            </tr>
            <tr>
                <th><label for="startDate" >Date Début</label></th>
                <td><input type = "date" id="startDate" name="startDate" 
                    value="<?= $mission->getStartDate(); ?>"> 
                </td>
            </tr>            <tr>
                <th><label for="endDate" >Date Fin</label></th>
                <td><input type = "date" id="endDate" name="endDate" 
                    value="<?= $mission->getEndDate(); ?>"> 
                </td>
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
                    <td><a href="?entity=missions&id=<?=$mission->getId()?>&action=editAgents">Gestion des agents</a></td>
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
                <td><a href="?entity=missions&id=<?=$mission->getId()?>&action=editTargets">Gestion des Cibles</a></td>
            </td>
        </tr>
        <tr id='contacts'>
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
                <td><a href="?entity=missions&id=<?=$mission->getId()?>&action=editContacts">Gestion des Contacts</a></td>
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
                <td><a href="?entity=missions&id=<?=$mission->getId()?>&action=editHideaways">Gestion des Planques</a></td>
            </td>
        </tr>
        </table>

        <button type="submit" name="missionUpdate" class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
        <li><a  href=<?= '?entity=missions&id='.$mission->getId().'&action=delete' ?>
                onclick="return confirm('Etes vous sur de vouloir effectuer la suppression ?')">delete</a>
        </li>
        <li><a href=<?= '?entity=missions' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 

$showMission->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/checkMission.js'></script>";
require('view/layout.php'); ?>