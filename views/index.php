<?php
session_start(); //Démarre une nouvelle session ou reprend une session existante
/*Cette fonction active la mise en mémoire tampon de la sortie. Lorsque la mise en mémoire tampon est active,
aucune sortie n'est envoyée depuis le script ; au lieu de cela, la sortie est stockée dans une mémoire tampon interne.*/
ob_start();
//Appel des controlleurs
require_once "../controllers/produits/ProduitsController.php";
require_once "../controllers/users/UserController.php";
//Le param_tre dans URL lié a la variable Apache : RewriteRule ^(.*)$ views/index.php?url=$1 [QSA,L]
$url = "";
//isset — Détermine si une variable est déclarée et est différente de null
//Si $url existe, la super globale $_GET["url"] est récupérée et stockée dans $url
if(isset($_GET["url"])){
    $url = $_GET["url"];
    //var_dump($url); debug de la route courante
}else{
    //Sinon par defaut la route d'accueil est la suivante
    $url = "afficher-produits";
}

//***************************************GESTION DES UTILISATEURS**********************//
if($url === "connexion"){
    $title = "MIC ECOMMERCE - Connexion -";
    ConnexionUtilisateur();
    require_once "users/connexion.php";
}elseif ($url === "profile" && !empty($_SESSION["is_user"])){
    $title = "MIC ECOMMERCE - Profile -";
    require_once "users/profile.php";
}elseif ($url === "administration" && !empty($_SESSION["is_admin"])){
    $title = "MIC ECOMMERCE - Administration -";
    require_once "administration/accueil_admin.php";
}elseif ($url === "deconnexion"){
    require_once "users/deconnexion.php";
}elseif ($url === "inscription"){
    $title = "MIC ECOMMERCE - Inscription -";//Afficher le formulaire
    require_once "users/inscription.php";
    //La fonction de UserController
    EngisterUtilisateur();
}elseif ($url === "valider-compte" && isset($_GET["id"], $_GET["status"])){
    var_dump($url);
    $title = "MIC ECOMMERCE - Valider votre compte -";
    ValiderCompteUtilisateur((int) $_GET["id"], (bool) $_GET["status"]);
}
elseif ($url === "mot-de-passe-oublie") {
    $title = "MIC ECOMMERCE - Mot de passe oublié -";
    require_once "users/mot_de_passe_oublie.php";
    MotDePasseOublieController();
}
elseif ($url === "reset-password" && isset($_GET["email"])) {
    $title = "MIC ECOMMERCE - Nouveau mot de passe -";
    require_once "users/reset_password.php";
    ResetPasswordFormController();
}
elseif ($url === "supprimer-utilisateur" && !empty($_SESSION["is_user"])){
    $title = "MIC ECOMMERCE - Supprimer votre compte -";
    SupprimerUtilisateur();
    require_once "users/supprimer_utilisateur.php";
}
elseif ($url === "administration-utilisateur" && !empty($_SESSION["is_admin"])){
    $title = "MIC ECOMMERCE - Role des utilisateurs -";
    require_once "administration/administration_utilisateur.php";
}
//*********************************LES PRODUITS***********************************//
//Si le paramètre apache et la variable $url valent "afficher-produits"
elseif($url === "afficher-produits"){
    $title = "MIC ECOMMERCE - Nos produits -";
    //Par defaut : http://localhost/poo_mvc_base/views/produits/afficher_produit.php
    //Avec la réecriture : http://localhost/poo_mvc_base/views/index.php?url=afficher-produits
    //URL finale : http://localhost/poo_mvc_base/afficher-produits
    //On appel le fichier php views/produits/afficher_produit.php
    require_once "produits/afficher_produit.php";
}elseif ($url === "details_produit"){
    $title = "MIC ECOMMERCE - Détails du produit -";
    require_once "produits/details_produit.php";
}elseif ($url === "ajouter-produit"){
    $title = "MIC ECOMMERCE - Ajouter un produit -";
    //On appel la vue pour charger les champs du formulaire
    require_once "produits/ajouter_produit.php";
    //Ensuite la fonction du controlleur pour le traitement
    AjouterUnProduit();
}elseif ($url === "supprimer_produit"){
    SupprimerProduitParId();
    header("Location: afficher-produits");
}elseif ($url === "editer_produit"){
    $title = "MIC ECOMMERCE - Editer un produit -";
    //On appel la vue pour charger les champs du formulaire
    require_once "produits/editer_produit.php";
    //Ensuite la fonction du controlleur pour le traitement
    EditerUnProduit();

}

//On effectue une redirection si url ne correspond a aucune route via des regexs
elseif($url !=  '#:@&-[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: connexion");
}



//Le contenu dynamique ajouté au template.php
//Cette fonction appelle le gestionnaire de sortie,
$content = ob_get_clean(); //Ignore sa valeur de retour, retourne le contenu du tampon de sortie actif et désactive ce dernier.
require_once "template.php";




//On effectue une redirection si url ne correspond a aucune route via des regexs

//$content = ob_get_clean();

?>