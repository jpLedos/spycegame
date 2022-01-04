<?php $title = 'Detail Mission'; ?>
      
<?php 
ob_start();  
$Type = $showType->fetchObject('Type');
if($Type) {
    $titleh2 = "<h2>Description  Type de Mission</h2>";
} else {
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <table class="table bg-light mx-5" style="width: 60%;">
        <tr>
            <th>N°</th>
            <td><?=  $Type->getId(); ?></td>
        </tr>
        <tr>
            <th>Type Mission</th>
            <td><?=  $Type->getType(); ?></td>
        </tr>
        <tr>
            <th>Missions</th>
            <td>
                <ul>
                <?php 
                while ($mission = $typeMissions->fetch(PDO::FETCH_ASSOC)) {  
                ?>
                    <li><?= $mission['title']; ?> </li>
                <?php  
                } 
                ?> 
                </ul>
            </td>
        </tr> 
    </table>


    <ul class="mt-5">
        <li><a href=<?= '?entity=types&id='.$Type->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=types' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showType->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
