<?php 
$title = 'Modification Mission'; 

ob_start();  

$mission = $showMission->fetchObject('mission');
if($mission) {
    $titleh2 = "<h2>Description de la mission code : ".$mission->getCode()."</h2>";

    $statutManager = new missionManager(); 
    $listStatuts = $statutManager->getStatuts();

    $countryManager = new CountryManager(); // get country from countryId
    $listCountries = $countryManager->getCountries();
 
    $typeManager = new TypeManager(); //get Type from typeId
    $listTypes = $typeManager->getTypes();
    
    $specialityManager = new SpecialityManager();  // get speciality from specialityId
    $listSpecialities = $specialityManager->getSpecialities();

} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-3">
    <form method="post" action="index.php?entity=missions">
        <input id="MissionId" name="MissionId" type="hidden" value="<?=  $mission->getId(); ?>">
        <table class="table bg-light m-2" style="width: 100%;">
            <tr>
                <th>N°</th>
                <td><?=  $mission->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="title">Titre</label></th>
                <td><input  type = "text" id="title" name="title"  value="<?=  htmlspecialchars($mission->getTitle()); ?>"></td>
            </tr>
            <tr>
                <th><label for="code">Titre</label></th>
                <td><input  type = "text" id="code" name="code"  value="<?=  htmlspecialchars($mission->getCode()); ?>"></td>
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
                    <?= $country->getId()===$mission->getCountryId() ? "selected":"" ?>
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
                    <?= $type->getId()===$mission->getTypeId() ? "selected":"" ?>
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
                    <?= $speciality->getId()===$mission->getSpecialityId() ? "selected":"" ?>
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
                ><?= htmlspecialchars($mission->getDescriptions());  ?></textarea></td>
            </tr>
            <tr>
                <th><label for="startDate" >né(e) en</label></th>
                <td><input type = "date" id="startDate" name="startDate" 
                    value="<?= htmlspecialchars($mission->getStartDate()); ?>"> 
                </td>
            </tr>            <tr>
                <th><label for="endDate" >né(e) en</label></th>
                <td><input type = "date" id="endDate" name="endDate" 
                    value="<?= htmlspecialchars($mission->getEndDate()); ?>"> 
                </td>
            </tr>
            <tr>
            <th>Agents</th>
                <td>
                    <ul>
                    <?php 
                        while ($missionAgent = $missionAgents->fetch()) {
                            $agentManager = new AgentManager();
                            $showAgent = $agentManager->getAgent($missionAgent['agentId']); 
                            $agent= $showAgent->fetchObject('Agent');
                            echo("<li>".$agent->getFullName()."</li>");
                        } 
                    ?>
                    </ul>
                    <td><a href="?entity=missions&id=<?=$mission->getId()?>&action=editAgents">Gestion des agents</a></td>
                </td>
            </tr>
            <tr>
            <th>Cibles</th>
            <td>
                <ul>
                <?php 
                    while ($missionTarget = $missionTargets->fetch()) {
                        $targetManager = new TargetManager();
                        $showTarget = $targetManager->getTarget($missionTarget['targetId']); 
                        $target= $showTarget->fetchObject('Target');
                        echo("<li>".$target->getFullName()."</li>");
                        $showTarget->closeCursor();
                    } 
                ?>
                </ul>
            </td>
        </tr>
        <tr>
            <th>Contacts</th>
            <td>
                <ul>
                <?php 
                    while ($missionContact = $missionContacts->fetch()) {
                        $contactManager = new ContactManager();
                        $showContact = $contactManager->getContact($missionContact['contactId']); 
                        $contact= $showContact->fetchObject('Contact');
                        echo("<li>".$contact->getFullName()."</li>");
                        $showContact->closeCursor();
                    } 
                ?>
                </ul>
            </td>
        </tr>
        <tr>
            <th>Planques</th>
            <td>
                <ul>
                <?php 
                    while ($missionHideaway = $missionHideaways->fetch()) {
                        $hideawayManager = new HideawayManager();
                        $showHideaway = $hideawayManager->getHideaway($missionHideaway['hideawayId']); 
                        $hideaway= $showHideaway->fetchObject('Hideaway');

                        $hidewayTypeManager = new HydeawayTypeManager(); // Création d'un objet'
                        $showHideawayType = $hidewayTypeManager->getHideawayType($missionHideaway['hideawayId']);
                        $hideawayType = $showHideawayType->fetchObject('HideawayType');

                        $showCountry = $countryManager->getCountry($hideaway->getCountryId()); 
                        $country = $showCountry->fetchObject('Country'); 

                        echo("<li>".$hideaway->getFullName()." --> Type : ".$hideawayType->getName()."
                        Pays : ".$country->getFullName()."</li>");
                        $showHideaway->closeCursor();
                    } 
                ?>
               
                </ul>
            </td>
        </tr>
        </table>
        <button type="submit" name="missionUpdate" class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
        <li><a href=<?= '?entity=missions&id='.$mission->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=missions' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 

$showMission->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>