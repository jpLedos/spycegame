
<?php 
$title = 'creation Type mission'; 
$titleh2 = "<h2>Creation d'un nouveau type de mission.</h2>";
ob_start();  
?>

<div class="container-fluid m-5 bg-light" style="width: 80%;">
    <form method="post" action="index.php?entity=types">
        <input id="TypeID" name="TypeID" type="hidden" value="0">
        <table class="table bg-light mx-5" style="width: 80%;">
            <tr>
                <th><label for="type">Type de Mission</label></th>
                <td><input  type = "text" id="type" name="type"  placeholder ="entrez le type" required></td>
            </tr>
        </table>
        <button type="submit" name="typeAdd"class="btn btn-primary">Enregistrer</button>
    </form>

  
    <ul class="mt-5">
        <li><a href=<?= '?entity=types' ?>>retour à la liste</a></li>
    </ul>   

</div>


<?php 

$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>