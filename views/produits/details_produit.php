<?php
//Appel du controlleur
require_once "../controllers/produits/ProduitsController.php";
//Stocker la fonction d ucontrolleur dans une variable
$produit = AfficherLesDetailsDuProduit();
//var_dump($produit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <title>Détails du produits produits</title>
</head>
<body>
<div class="container">
    <h1 class="text-info text-center">Détails du produit</h1>
</div>
<div class="container">
    <ul class="list-group">
        <li class="list-group">
            <div class="text-center">
                <img src="./assets/img/produits/not_found.jpg" class="img-fluid" width="25%" alt="<?= $produit["nom_produit"] ?>" title="<?= $produit["nom_produit"] ?>">
            </div>
        </li>
        <li class="list-group-item">ID du produit : <?= $produit["id_produit"] ?></li>
        <li class="list-group-item">Nom du produit : <?= $produit["nom_produit"] ?></li>
        <li class="list-group-item">Description du produit : <?= $produit["description_produit"] ?></li>
        <li class="list-group-item">Prix du produit : <?= $produit["prix_produit"] ?></li>
        <li class="list-group-item">
            <a class="btn btn-info" href="editer_produit?id=<?= $produit["id_produit"] ?>">Editer le produit</a>
        </li>
        <li class="list-group-item">
            <a class="btn btn-danger" href="supprimer_produit?id=<?= $produit["id_produit"] ?>">Supprimer le produit</a>
        </li>
        <li class="list-group-item">
            <a class="btn btn-success" href="afficher-produits">Retour</a>
        </li>
    </ul>
</div>
</body>
</html>