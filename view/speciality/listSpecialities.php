<?php $title = 'Les Specialities'; ?>
        
<?php 
ob_start();       
$titleh2 = "<h2>Liste des Specialités</h2>";
?> 

<div class="container-fluid m-5">
    <table class="table table-hover bg-light" style="width: 60%;">
        <thead>
            <tr class="bg-light">
                <th>N°</span>   
                <th class="" >Specialité</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        <?php
        while  ($Speciality = $listSpecialities->fetchObject('Speciality'))
        {
        ?>
            <tr class=''>
            <th scope="row"><?=  $Speciality->getId(); ?></th>   
            <td><?=  $Speciality->getSpeciality(); ?></td>

            <td class ="bg-light text-center d-flex justify-content-evenly ">
                    <a href=<?= '?entity=specialities&id='.$Speciality->getId().'&action=show' ?>>
                        <img class="picto" title= "show" src="./asset/image/view.png" alt="show icon"></a>
                    <a href=<?= '?entity=specialities&id='.$Speciality->getId().'&action=edit' ?>>
                        <img class="picto" title= "edit" src="./asset/image/edition.png" alt="edit icon"></a>
                </td>
            </tr>
        <?php
        }

        $listSpecialities->closeCursor();
        ?>
        </tbody>
    </table>
</div>
<ul class="mt-5">
    <li><a href=<?= '?entity=specialities&action=new' ?>>Creer une nouvelle Specialité</a></li>
</ul> 

<?php $content = ob_get_clean(); 
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
