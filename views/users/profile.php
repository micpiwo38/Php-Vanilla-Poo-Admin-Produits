<?php
if ($_SESSION["is_login"] && $_SESSION['is_user']) {
?>
    <div class="container shadow rounded w-50 mt-5 p-3 ">
        <h1 class="text-success">Bienvenue : <?= $_SESSION["email"] ?></h1>
        <?php
        //var_dump($_SESSION["role"]);
        if ($_SESSION["role"] === "0") {
        ?>
            <h3>Rôle : Utilisateur</h3>
        <?php
        }
        ?>
        <a href="deconnexion" class="btn btn-warning mt-3">DECONNEXION</a>
        <h2 class="text-info mt-3">Gestion de votre compte :</h2>
        <form method="POST" action="supprimer-utilisateur" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.')">
            <button name="btn-delete" class="btn btn-danger mt-3">Supprimer votre compte</button>
        </form>

        <h3 class="text-warning mt-3">Gestion de vos données :</h3>
        <a href="liste-produits-utilisateur" class="btn btn-success mt-3">Gerer vos produits</a>
        <a href="ajouter-produit" class="btn btn-info mt-3">Ajouter un produit</a>
    </div>
<?php
} elseif ($_SESSION["is_login"] && $_SESSION['is_admin']) {
?>
    <div class="container shadow rounded w-50 mt-5 p-3 ">
        <h1 class="text-success">Bienvenue : <?= $_SESSION["email"] ?></h1>
        <a href="deconnexion" class="btn btn-warning mt-3">DECONNEXION</a>
        <h2 class="text-info mt-3">Gestion de votre compte :</h2>
        <form method="POST" onsubmit="confirm(" Confirmer la supression du compte ?")">
            <button name="btn-delete" class="btn btn-danger mt-3">Supprimer votre compte</button>
        </form>

        <h3 class="text-warning mt-3">Gestion de vos données :</h3>
        <a href="liste-produits-utilisateur" class="btn btn-success mt-3">Gerer vos produits</a>
        <a href="ajouter-produit" class="btn btn-info mt-3">Ajouter un produit</a>
    </div>
<?php
}
