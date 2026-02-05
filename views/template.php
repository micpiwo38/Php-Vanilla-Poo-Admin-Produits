
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css"/>
    <!--Le chemin relatif locale de vos fichier css -->
    <link rel="stylesheet" href="./assets/css/styles.css"/>
    <title><?= $title ?></title>
    <!--Le titre (onglet de la page) dynamique dans la memoire tampon-->
</head>
<body>
<header>
    <nav>
        <?php require_once "navbar.php"?>
    </nav>
</header>
<div class="container-fluid">
    <!--Le contenu dynamique dans la memoire tampon-->
    <?= $content ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>