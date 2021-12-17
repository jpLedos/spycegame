
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
        <div  class="text-right">
                <a href="#">Se déconnecter</a>
                <a href="#">Se connecter</a>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid mx-3">
            <a class="btn" href="?entity=missions">Missions</a>
            <a class="btn" href="?entity=agents">Agents</a>
            <a class="btn" href="?entity=targets">Targets</a>
            <a class="btn" href="?entity=contacts">Contacts</a>
            <a class="btn" href="?entity=planques">PLanques</a>
            <a class="btn" href="?entity=specialites">Specialites</a>
            <a class="btn" href="?entity=statuts">Statuts</a>
        </div>
    </nav>

    <?= $titleh2 ?> 
    
<main class="container-fluid">
    <?= $content ?>
</main>

</body>
</html>