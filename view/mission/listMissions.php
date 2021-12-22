<?php $title = 'Les Missions'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Missions</h2>";
$countryManager = new CountryManager(); 
$typeManager = new TypeManager(); 
$specialityManager = new SpecialityManager(); 
$statutManager = new StatutManager(); 
?> 

<table class="table table-hover">
    <thead>
        <tr class="bg-light">
            <th>N°</span>   
            <th class="" >Titre</th>
            <th class=""><em>Code</em></th>
            <th class="" >Statut</th>
            <th class="" >Type</th>
            <th class="" >Specialité</th>
            <th class="">Pays</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    <?php
    while  ($mission = $listMissions->fetchObject('Mission'))
    {
        $showCountry = $countryManager->getCountry($mission->getCountryId());
        $country = $showCountry->fetchObject('Country');

        $showSpeciality = $specialityManager->getSpeciality($mission->getSpecialityId());
        $speciality = $showSpeciality->fetchObject('Speciality');

        $showType = $typeManager->getType($mission->getTypeId());
        $type = $showType->fetchObject('Type');

        $showStatut = $statutManager->getStatut($mission->getStatutId());
        $statut = $showStatut->fetchObject('Statut');
    ?>
        <tr class=" ">
            <th scope="row"><?=  $mission->getId(); ?></th>   
            <td><?=  htmlspecialchars($mission->getTitle()); ?></td>
            <td><em> <?= htmlspecialchars($mission->getCode()); ?></em></td>
            <td><?= $statut->getStatut(); ?></td>
            <td><?= $type->getType(); ?></td>
            <td><?= $speciality->getSpeciality(); ?></td>
            <td><?= $country->getFullname(); ?></td>
            <td class ="bg-light text-center"><a href=<?= '?entity=missions&id='.$mission->getId().'&action=show' ?>>show</a></td>
        </tr>
    <?php
    }

    $listMissions->closeCursor();
    $showCountry->closeCursor();
    $showType->closeCursor();
    $showSpeciality->closeCursor();

    ?>
    </tbody>
</table>

<ul class="mt-5">
    <li><a href=<?= '?entity=missions&action=new' ?>>Creer une nouvelle Mission</a></li>
</ul> 

<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
