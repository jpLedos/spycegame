<?php $title = 'Les missions'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Missions</h2>";

while  ($mission = $listMissions->fetch())
{
?>
    <div class="container-fluid  bg-info bg-secondary.bg-gradient">
        <h3>
            <?=  $mission['id']; ?>   
            <?=  htmlspecialchars($mission['title']); ?>
            <em> <?= $mission['code']; ?></em>
            <?= htmlspecialchars($mission['country']);  ?>
            <?= htmlspecialchars($mission['shortCountry']);  ?>
            <?= '--> ' . htmlspecialchars($mission['statut']);  ?>
            
        </h3>
    </div>
<?php
}
$listMissions->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
