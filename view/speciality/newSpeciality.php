
<?php 
$title = 'creation Agent'; 
$titleh2 = "<h2>Creation d'une nouvelle specialité.</h2>";
ob_start();  

?>


<div class="container-fluid m-5 bg-light">
    <form method="post" action="index.php?entity=specialities">
        <input id="SpecialityId" name="SpecialityId" type="hidden" value="0">
        <input id="returnTo" name="returnTo" type="hidden" value=<?=$_SERVER['HTTP_REFERER'] ?>>
        <table class="table bg-light mx-5" style="width: 60%;">
            <tr>
                <th><label for="speciality">Specialité</label></th>
                <td><input  type = "text" id="speciality" name="speciality"  placeholder ="entrez la specialité" required></td>
            </tr>
        </table>
        <button type="submit" name="specialityAdd"class="btn btn-primary">Enregistrer</button>
    </form>

  
    <ul class="mt-5">
        <li><a href=<?= '?entity=agents' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>