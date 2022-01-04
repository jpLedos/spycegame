<?php $title = 'Les Missions'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Missions</h2>";
$countryManager = new CountryManager(); 
$typeManager = new TypeManager(); 
$specialityManager = new SpecialityManager(); 
$statutManager = new StatutManager(); 

$where="";
if(isset($_POST['filter'])) {
    $where = ($_POST['where']);
}
?>

<form action="?entity=missions&action=none" class="container" method="post" >
    <div class="input-group px-5 mx-5 mb-3 ">
        <input type="text" 
                class="form-control form-control-lg" 
                name="where" 
                placeholder="Recherche dans Titre et Code..."
                value= <?=$where; ?> >
        <button type="submit" name="filter" class="input-group-text btn-success">
        <i class="bi bi-search me-2"></i> Search</button>
    </div>
</form>

<table class="table table-hover ">
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
        <tr class="line-mission">
            <th scope="row"><?=  $mission->getId(); ?></th>
            <td class="isConform" style=display:none><?=$mission->getIsConform(); ?></td>  
            <td><?=  $mission->getTitle(); ?></td>
            <td><em> <?= $mission->getCode(); ?></em></td>
            <td class="statut"><?= $statut->getStatut(); ?></td>
            <td><?= $type->getType(); ?></td>
            <td><?= $speciality->getSpeciality(); ?></td>
            <td><?= $country->getFullname(); ?></td>
            <td class ="bg-light">
                <a href=<?= '?entity=missions&id='.$mission->getId().'&action=show' ?>>
                    <img class="picto" src="./asset/image/view.png" alt="show icon"></a>
                <?php 
                if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {
                    if ($mission->getStatutId()<3) {
                ?>
                    <a href=<?= '?entity=missions&id='.$mission->getId().'&action=edit' ?>>
                        <img class="picto" src="./asset/image/edition.png" alt="edit icon"></a>
                    <a  href=<?= '?entity=missions&id='.$mission->getId().'&action=delete' ?>
                        onclick="return confirm('Etes vous sur de vouloir effectuer la suppression ?')">
                        <img class="picto" src="./asset/image/bin.png" alt="bin icon"></a>
                <?php 
                    }    
                } 
                ?>
            </td>

        </tr>
    <?php
    }

    $listMissions->closeCursor();

    ?>
    </tbody>
</table>
<?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {
?>
<ul class="mt-5">
    <li><a href=<?= '?entity=missions&action=new' ?>>Creer une nouvelle Mission</a></li>
</ul>
<?php 
} 
?> 

<?php 
$content = ob_get_clean(); 
$script="<script src='./scripts/listMissions.js'></script>";
 require('view/layout.php'); ?>
