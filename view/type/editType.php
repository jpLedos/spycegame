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
                <td><input  type = "text" id="type" name="type"  value="<?= $Type->getType(); ?>"></td>
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
        <button type="submit" name="typeUpdate"class="btn btn-primary">Enregistrer</button>
    </form>


    <ul class="mt-5">
    <?php if($typeMissions->rowCount()==0) { ?>
        <li>    
            <a  href=<?= '?entity=types&id='.$Type->getId().'&action=delete' ?>
                onclick="return confirm('Etes vous sur de vouloir effectuer la suppression ?')">
                <img class="picto" title= "delete" src="./asset/image/bin.png" alt="bin icon"></a>
        </li>
    <?php } ?>
        <li><a href=<?= '?entity=types' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$showType->closeCursor();
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>