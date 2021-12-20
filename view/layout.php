
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
    
</head>
<body>
<H1>LES MISSIONS DU SPYGAME</H1>
    <nav class="navbar navbar-light bg-light">
        <div  class="text-right mx-3">
            <?= (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") ? 
            "<a href='?entity=users&action=logout'>Se déconnecter</a>
            <br><strong class='text-success'>Acces au bask-office</strong>" :
            "<a href='?entity=users'>Se connecter</a>"  ?>

        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid mx-3">
            <a class="btn" href="?entity=missions">Missions</a>
        <?php if (isset($_SESSION["ADMIN"]) && $_SESSION["ADMIN"] == "yes") {
        ?>
            <a class="btn" href="?entity=agents">Agents</a>
            <a class="btn" href="?entity=targets">Targets</a>
            <a class="btn" href="?entity=contacts">Contacts</a>
            <a class="btn" href="?entity=hideaways">Planques</a>
            <a class="btn" href="?entity=specialities">Specialites</a>
            <a class="btn" href="?entity=types">Type Missions</a>
        <?php 
        } 
        ?>
        </div>
    </nav>

    <?= $titleh2 ?> 
    
<main class="container-fluid">
    <?= $content ?>
</main>

</body>
</html>