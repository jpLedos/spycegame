<?php $title = 'Modification spécialité'; ?>
      
<?php 
ob_start();  
$Speciality = $showSpeciality->fetchObject('Speciality');
if($Speciality) {
    $titleh2 = "<h2>Modification de la spécialité !</h2>";
}else{
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
<form method="post" action="index.php?entity=specialities">
        <input id="SpecialityID" name="SpecialityId" type="hidden" value="<?= $Speciality->getId(); ?>">
        <input id="missionId" name="missionId" type="hidden" value="<?= $_GET['missionId']; ?>">
        <table class="table table-hover bg-light mx-5" style="width: 60%;">
        <tr>
                <th>N°</th>
                <td><?=  $Speciality->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="speciality">speciality</label></th>
                <td><input  type = "text" 
                            id="speciality" 
                            name="speciality"  
                            required 
                            value="<?=  $Speciality->getSpeciality(); ?>">
                </td>
            </tr>
            <tr>
                <th>Missions</th>
                <td>
                    <ul>
                    <?php while ($mission = $specialityMissions->fetch(PDO::FETCH_ASSOC)) {?>
                        <li><?= $mission['title']; ?> </li>
                    <?php } ?> 
                    </ul>
                </td>
            </tr> 
            <tr>
                <th>Agents</th>
                <td>
                    <ul>
                    <?php while ($agent = $specialityAgents->fetch(PDO::FETCH_ASSOC)) {?>
                        <li><?= $agent['firstname'].' '.$agent['lastname'] ; ?> </li>
                    <?php } ?> 
                    </ul>
                </td>
            </tr> 
        </table>
        <button type="submit" name="specialityUpdate"class="btn btn-primary">Enregistrer</button>
    </form>

    <ul class="mt-5">
    <?php if($specialityMissions->rowCount()==0 && $specialityAgents->rowCount()==0 ) { ?>
        <li>                   
            <a  href=<?= '?entity=specialities&id='.$Speciality->getId().'&action=delete' ?>
                onclick="return confirm('Etes vous sur de vouloir effectuer la suppression ?')">
                <img class="picto" title= "delete" src="./asset/image/bin.png" alt="bin icon"></a>
        </li>
        <?php } ?>
        <li><a href=<?= '?entity=specialities' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showSpeciality->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>