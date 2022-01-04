<?php $title = 'Login'; ?>
      
<?php 
ob_start();  
    $titleh2 = "<h2>Acces à l'administration</h2>";
?>

<div class="container-fluid m-5 bg-light">
<div  class="text-danger"><?php  echo  $error  ?></div>
    <form method="post" action="index.php?entity=users">
        <table class="table bg-light mx-5" style="width: 60%;">
            <tr>
                <th><label for="login">Login</label></th>
                <td><input  type = "text" id="login" name="login"  placeholder ="entrez votre login" required></td>
            </tr>
            <tr>
                <th><label for="password">Password</label></th>
                <td><input  type = "password" id="password" name="password"  placeholder ="entrez votre password" required></td>
            </tr>
        </table>
        <button type="submit" name="submit"class="btn btn-primary">Soumettre</button>
    </form>

    <ul class="mt-5">
        <li><a href=<?= './' ?>>Liste des missions</a></li>
    </ul>   
</div>

<?php 
$content = ob_get_clean();
$script="<script src='./scripts/no-script.js'></script>";
require('view/layout.php'); ?>
