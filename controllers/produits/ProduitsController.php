<?php
//Appel de la classe ProduitsModel.php
require_once "../models/produits/ProduitsModel.php";
//Afficher tous les produits
function AfficherTousLesProduits(){
    //Instance de la classe ProduitsModels stockée dans une variable
    $produits_model = new \models\produits\ProduitsModel();
    //La variable a accès au methode public du ProduitsModel
    $tous_les_produit = $produits_model->DisplayAllProducts();
    //var_dump($tous_les_produit);
    //La fonction retorune une variable qui stocke un tableau resultat de la requete SQL du model
    return $tous_les_produit;
}

//Afficher les details d'un produit
function AfficherLesDetailsDuProduit(){
    //Instance de la classe ProduitsModels stockée dans une variable
    $produits_model = new \models\produits\ProduitsModel();
    //La variable a accès au methode public du ProduitsModel
    $un_produit = $produits_model->DisplayProductDetails();
    //var_dump($un_produit);
    //La fonction retourne une variable qui stocke le resultat de la requete SQL du model
    return $un_produit;
}

//Ajouter un produit
function AjouterUnProduit(){
    //Instance de la classe ProduitsModels stockée dans une variable
    $produits_model = new \models\produits\ProduitsModel();
    //Si le bouton de la vue n'est pas null et est cliquer => on effectue le traitement
    if(isset($_POST["btn-add-product"])){
        //Champ du formulaire (on supprimer les espaces et on lutte contre la faille xss)
        $product_name = trim(htmlspecialchars($_POST["product_name"]));
        $product_description = trim(htmlspecialchars($_POST["product_description"]));
        $product_price = trim(htmlspecialchars($_POST["product_price"]));

        //Appel de la methode du modele avec ses paramètres
        $nouveau_produit = $produits_model->AddProduct(
            $product_name,
            $product_description,
            $product_price,
        );
        if($nouveau_produit){
            header("Location: afficher-produits");
            return $nouveau_produit;
        }
    }
}

//Suprimer un produit par ID
function SupprimerProduitParId(){
    //Instance de la classe ProduitsModels stockée dans une variable
    $produits_model = new \models\produits\ProduitsModel();
    $supprimer_produit = $produits_model->DeleteProductById();
    return $supprimer_produit;
}

//Editer un produit
function EditerUnProduit(){
    //Instance de la classe ProduitsModels stockée dans une variable
    $produits_model = new \models\produits\ProduitsModel();
    //Si le bouton de la vue n'est pas null et est cliquer => on effectue le traitement
    if(isset($_POST["btn-edit-product"])){
        //Champ du formulaire (on supprimer les espaces et on lutte contre la faille xss)
        $product_name = trim(htmlspecialchars($_POST["product_name"]));
        $product_description = trim(htmlspecialchars($_POST["product_description"]));
        $product_price = trim(htmlspecialchars($_POST["product_price"]));
        $product_id = $_GET["id"];
        //Appel de la methode du modele avec ses paramètres
        $maj_produit = $produits_model->EditProduct(
            $product_name,
            $product_description,
            $product_price,
            $product_id
        );
        if($maj_produit){
            header("Location: afficher-produits");
            return $maj_produit;
        }
    }
}