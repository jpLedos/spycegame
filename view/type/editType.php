<?php $title = 'Modification Type Mission'; ?>
      
<?php 
ob_start();  
$Type = $showType->fetchObject('Type');
if($Type) {
    $titleh2 = "<h2>Modification du type de Mission</h2>";
}else{
    echo('Aucun resultat pour cette requête !');
    die;
}
?>

<div class="container-fluid m-5">
    <form method="post" action="index.php?entity=types">
        <input id="typeId" name="typeId" type="hidden" value="<?=  $Type->getId(); ?>">
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th>N°</th>
                <td><?=  $Type->getId(); ?></td>
            </tr>
            <tr>
                <th><label for="type">Type</label></th>
                <td><input  type = "text" id="type" name="type"  value="<?=  htmlspecialchars($Type->getType()); ?>"></td>
            </tr>
         
        </table>
        <button type="submit" name="submit"class="btn btn-primary">Enregistrer</button>
    </form>


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