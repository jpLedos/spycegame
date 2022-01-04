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
                <td><?=  $Type->getType(); ?></td>

                <td class ="bg-light text-center d-flex justify-content-evenly ">
                    <a href=<?= '?entity=types&id='.$Type->getId().'&action=show' ?>>
                        <img class="picto" title= "show" src="./asset/image/view.png" alt="show icon"></a>
                    <a href=<?= '?entity=types&id='.$Type->getId().'&action=edit' ?>>
                        <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
                </td>

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

<?php $content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
