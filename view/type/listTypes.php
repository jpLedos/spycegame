<?php $title = 'Types Missions'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des types de mission</h2>";
?> 

<div class="container-fluid m-5">
    <table class="table table-hover bg-light" style="width:60%;">
        <thead>
            <tr class="bg-light">
                <th>N°</span>   
                <th class="" >Type Mission</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php
        while  ($Type = $listTypes->fetchObject('Type'))
        {
        ?>
            <tr class=""bg-success">
                <th scope="row"><?=  $Type->getId(); ?></th>   
                <td><?=  htmlspecialchars($Type->getType()); ?></td>
                <td class ="bg-light text-center"><a href=<?= '?entity=types&id='.$Type->getId().'&action=show' ?>>show</a></td>
            </tr>
        <?php
        }

        $listTypes->closeCursor();
        ?>
        </tbody>
    </table>
</div>
<ul class="mt-5">
    <li><a href=<?= '?entity=types&action=new' ?>>Creer un nouveau Type</a></li>
</ul> 

<?php $content = ob_get_clean(); ?>

<?php require('view/layout.php'); ?>
