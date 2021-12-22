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
            <td><?= htmlspecialchars($mission->getTitle());  ?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?= htmlspecialchars($country->getFullName());  ?></td>
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
            <td><?= $speciality->getSpeciality();  ?> </td>
        </tr>
        <tr>
            <th width="20%">Date debut</th>
            <td width="80%"><?= $mission->getStartDate();  ?> </td>
            </tr>
            <tr>
            <th width="20%" >Date fin</th>
            <td width="20%" ><?= $mission->getEndDate();  ?> </td>
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

                        $showCountry = $countryManager->getCountry($agent->getCountryId()); 
                        $country = $showCountry->fetchObject('Country');
                        
                        echo("<li>".$agent->getFullName()."--> : ".$country->getFullName(). "</li>");

                    } 
                ?>
                </ul>
            </td>
        </tr>
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

                        echo("<li>".$target->getFullName()."--> : ".$country->getFullName(). "</li>");
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

                        $showCountry = $countryManager->getCountry($contact->getCountryId()); 
                        $country = $showCountry->fetchObject('Country'); 

                        echo("<li>".$contact->getFullName()." --> : ".$country->getFullName(). "</li>");
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


    <ul class="mt-5">
        <li><a href=<?= '?entity=missions&id='.$mission->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=missions&id='.$mission->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=missions' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showMission->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>
