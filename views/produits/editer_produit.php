<?php
//Appel du controlleur
require_once "../controllers/produits/ProduitsController.php";
//Stocker la fonction d ucontrolleur dans une variable
$produit = AfficherLesDetailsDuProduit();
//var_dump($produit);
?>

<div class="container">
    <h1 class="text-danger">Editer un produit</h1>
</div>


<div class="container">
    <form method="POST">
        <div class="mt-3">
            <input type="text" name="product_name" placeholder="<?= $produit["nom_produit"] ?>" class="form-control">
        </div>
        <div class="mt-3">
            <textarea rows="5" name="product_description" class="form-control">
                <?= $produit["description_produit"] ?>
            </textarea>
        </div>
        <div class="mt-3">
            <input type="number" step="0.01" name="product_price" placeholder="<?= $produit["prix_produit"] ?>"
                   class="form-control"
        </div>
        <br>
        <button type="submit" class="btn btn-secondary" name="btn-edit-product">Editer le produit</button>
        <br><br>
        <a href="afficher-produits" class="btn btn-success">Retour</a>
    </form>
</div>

