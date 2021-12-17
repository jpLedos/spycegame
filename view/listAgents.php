<?php $title = 'Les agents'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Agents</h2>";

while  ($agent = $listAgents->fetch())
{
?>

    <div class="container-fluid  bg-info bg-secondary.bg-gradient">
        <h3>
            <?=  $agent['id']; ?>   
            <?=  htmlspecialchars($agent['lastname']); ?>
            <?= htmlspecialchars($agent['firstname']);  ?>
            <em> <?= $agent['code']; ?></em>
            <?= htmlspecialchars($agent['country']);  ?>
            <?= !$agent['is_dead'] ? 'Vivant': 'Décédé';  ?> 
        </h3>
    </div>
<?php
}
$listAgents->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
