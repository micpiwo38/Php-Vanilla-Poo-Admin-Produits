<?php
//Appel du controlleur
require_once "../controllers/produits/ProduitsController.php";
//On stock la fonction du controlleur dans une variable
$tous_les_produit = AfficherTousLesProduits();
//var_dump($tous_les_produit); //Debug
?>
<div class="container">
    <div class="text-center">
        <a href="ajouter-produit" class="btn btn-success mb-3">Ajouter un produit</a>
    </div>
    <div class="row">
        <?php
        //Boucle de parcours du tableau de produits
        foreach ($tous_les_produit as $row) {
            //Afficher le champ de la table
            ?>

            <div class="col-md-3 col-sm-12 mx-4 text-center mb-3">
                <div class="card" style="width: 20rem;">
                    <img src="./assets/img/produits/not_found.jpg" class="card-img-top" alt="<?= $row["nom_produit"] ?>"
                         title="<?= $row["nom_produit"] ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center text-warning"><?= $row["nom_produit"] ?></h5>
                        <p class="card-text"><?= $row["description_produit"] ?></p>
                        <p>Prix : <?= $row["prix_produit"] ?> €</p>
                        <a href="details_produit?id=<?= $row["id_produit"]?>" class="btn btn-primary">Plus d'infos</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
