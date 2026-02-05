<div class="container shadow w-50 rounded mt-5 p-3">
    <h1 class="text-warning">Ajouter un produit</h1>
    <h2 class="text-success">Merci de remplir le formulaire</h2>
    <form action="" method="POST">
        <div class="mt-3">
            <input type="text" name="product_name" placeholder="Nom du produit" class="form-control">
        </div>
        <div class="mt-3">
            <textarea rows="5" name="product_description" class="form-control"></textarea>
        </div>
        <div class="mt-3">
            <input type="number" step="0.01" name="product_price" placeholder="Prix du produit" class="form-control">
        </div>
        <br>
        <button type="submit" class="btn btn-success" name="btn-add-product">Ajouter le produit</button>
        <a href="afficher-produits" class="btn btn-danger">Retour</a>
    </form>
</div>

