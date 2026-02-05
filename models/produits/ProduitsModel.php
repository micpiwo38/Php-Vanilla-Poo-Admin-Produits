<?php
namespace models\produits;
//Appel de la classe parente models/Database.php dont ProduitsModel va hérité
//Elle aura accès apres instance au methode public
use models\Database;
use PDO;

require_once "../models/Database.php";

class ProduitsModel extends Database
{
    //Les variables ont totutes un accès privé (encapsulation), elle ne seront accessible qu'a l'interieur de cette classe
    private int $product_id;
    private string $product_name;
    private string $product_description;
    private float $product_price;
    //Accès a la base de données
    private PDO $db;
    //On utilise un constructeur pour ce connecter a la base de données
    //C'est a dire qu'a l'instance de la classe ProduitModel => on appel automatiquement la methode de connexion a la base de donnée issue de la classe parente
    private int $product_category;
    private string $product_reference;
    private string $product_images;

    public function __construct()
    {
        //Instance de la classe parente
        $connexion = new Database();
        //Appel de la methode de connexion
        $this->db = $connexion->getPDOConnection();
        //Debug
        //var_dump($this->db);
    }

    //Afficher les produits => cette methode sera appelée par le controlleur ProduitsController.php et retourner a la vue
    public function DisplayAllProducts(){
        //La requète SQL
        $sql = "SELECT * FROM produits";
        //La requète préparée => lutte contre les injections SQL
        $statement = $this->db->prepare($sql);
        //Executer la requète
        $statement->execute();
        //Stocker le resulat dans une variable
        $products = $statement->fetchAll();
        //La variable est retournée par la methode et sera recupérée dans ProduitsController
        return $products;
    }
    //Afficher les details d'un produit à l'aide de son ID recuperer dans URL
    public function DisplayProductDetails(){
        //La requète SQL avec un paramtre id dans URL
        $sql = "SELECT * FROM produits WHERE id_produit = ?";
        //La requète préparée => lutte contre les injections SQL
        $statement = $this->db->prepare($sql);
        //Recuperer le paramètre ID passer dans l'url depuis la page afficher_produit.php
        $this->product_id = $_GET["id"];
        //Lier le paramètre id de l'url a id_produit de la requète SQL
        $statement->bindParam(1, $this->product_id);
        //Executer la requète
        $statement->execute();
        //Stocker le resultat de la requète dans une variable
        $product_details = $statement->fetch();
        //var_dump($product_details);
        //Ma methode retourne la variable qui sera utilisée dans ProduitsController
        return $product_details;
    }
    //Ajouter un produit => on passe en paramètre de la fonction tous les champs du formulaire
    //Ces derniers seront envoyé au controlleur pares instance
    public function AddProduct(
        string $product_name,
        string $product_description,
        float $product_price
    ){
        //Les paramètres valent les variables privée locale
        $this->product_name = $product_name;
        $this->product_description = $product_description;
        $this->product_price = $product_price;
        //La requète SQL
        $sql = "INSERT INTO `produits`(nom_produit, description_produit, prix_produit) VALUES (?,?,?)";
        //La requète préparée => lutte contre les injections SQL
        $statement = $this->db->prepare($sql);
        //Lier les paramètres du formulaire a la requète SQL
        $new_product = $statement->execute([
            $product_name,
            $product_description,
            $product_price,
        ]);
        //Retourné une variable passée au controlleur
        return $new_product;
    }

    //Supprimer un produit a l'aide de son ID
    public function DeleteProductById(){
        //La requète SQL
        $sql = "DELETE FROM produits WHERE id_produit = ?";
        //Connexion a la BDD et la requète préparée => lutte contre les injections SQL
        $statement = $this->db->prepare($sql);
        //Recuperer le paramètre ID passer dans l'url depuis la page afficher_produit.php
        $this->product_id = $_GET["id"];
        //Lier le paramètre id de l'url a id_produit de la requète SQL
        $statement->bindParam(1, $this->product_id);
        //Executer la requète
        $statement->execute();
    }

    //Editer un produit => on passe en paramètre de la fonction tous les champs du formulaire
    //Ces derniers seront envoyé au controlleur pares instance
    public function EditProduct(
        string $product_name,
        string $product_description,
        float $product_price,
        int $product_id
    ){
        //Les paramètres valent les variables privée locale
        $this->product_name = $product_name;
        $this->product_description = $product_description;
        $this->product_price = $product_price;
        $this->product_id = $product_id;
        //La requète SQL
        $sql = "UPDATE produits SET nom_produit = ?, description_produit = ?, prix_produit = ? WHERE id_produit = ?";
        //La requète préparée => lutte contre les injections SQL
        $statement = $this->db->prepare($sql);
        $statement->bindParam(1, $product_name);
        $statement->bindParam(2, $product_description);
        $statement->bindParam(3, $product_price);
        $statement->bindParam(4, $product_id);
        //Lier les paramètres du formulaire a la requète SQL
        $update_product = $statement->execute([
            $product_name,
            $product_description,
            $product_price,
            $product_id,
        ]);
        //Retourne une variable passée au controlleur
        return $update_product;
    }
}