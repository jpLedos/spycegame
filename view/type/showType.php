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
            <td><?=  htmlspecialchars($Type->getType()); ?></td>
        </tr>
    
    </table>


    <ul class="mt-5">
        <li><a href=<?= '?entity=types&id='.$Type->getId().'&action=edit' ?>>edit</a></li>
        <li><a href=<?= '?entity=types&id='.$Type->getId().'&action=delete' ?>>delete</a></li>
        <li><a href=<?= '?entity=types' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showType->closeCursor();
$content = ob_get_clean();
require('view/layout.php'); ?>
