<?php $title = 'Detail Specialité'; ?>
      
<?php 
ob_start();  
$Speciality = $showSpeciality->fetchObject('Speciality');
if($Speciality) {
    $titleh2 = "<h2>Description Specialité !</h2>";
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 60%;">
        <tr>
            <th>N°</th>
            <td><?=  $Speciality->getId(); ?></td>
        </tr>
        <tr>
            <th>Spécialité</th>
            <td><?=  htmlspecialchars($Speciality->getSpeciality()); ?></td>
        </tr>
        <tr>
       

    </table>


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
