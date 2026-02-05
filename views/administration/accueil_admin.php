<?php
if($_SESSION["is_admin"]){
    ?>
    <div class="container shadow rounded p-3 mt-3">
        <h1 class="text-success">ADMINISTRATEUR :
            <?= $_SESSION["email"] ?>
        </h1>
        <?php
        //var_dump($_SESSION["role"]);
        if($_SESSION["role"] === "1"){
            ?>
            <h3>Rôle : Administrateur</h3>
            <?php
        }
        ?>
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="administration-utilisateur">UTILISATEURS</a>
                    </li>
                    <li class="list-group-item">
                        <a href="admin-produits">PRODUITS</a>
                    </li>
                    <li class="list-group-item">
                        <a href="catégories">CATÉGORIES</a>
                    </li>
                    <li class="list-group-item">
                        <a href="admin-images">IMAGES</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-12">
                <div>ADMINISTRATION</div>
            </div>
        </div>
    </div>

    <?php
}else{
    header("Location: connexion");
}