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
        <table class="table table-hover bg-light mx-5" style="width: 60%;">
        <tr>
                <th>N°</th>
                <td><?=  $Speciality->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="speciality">speciality</label></th>
                <td><input  type = "text" id="speciality" name="speciality"  required value="<?=  htmlspecialchars($Speciality->getSpeciality()); ?>"></td>
            </tr>
        </table>
        <button type="submit" name="submit"class="btn btn-primary">Enregistrer</button>
    </form>

    <ul class="mt-5">
        <li><a href=<?= '?entity=specialities&id='.$Speciality->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=specialities&id='.$Speciality->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=specialities' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showSpeciality->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>