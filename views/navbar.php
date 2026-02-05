<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="afficher-produits">MIC-OFFICE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (!empty($_SESSION["is_login"])): ?>
                <!-- Lien profil -->
                <li class="nav-item">
                    <a class="nav-link" href="profile">Profil</a>
                </li>
                <!-- Lien visible uniquement pour les utilisateurs -->
                <?php if (!empty($_SESSION["is_user"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="liste-produits-utilisateur">Gérer vos produits</a>
                    </li>
                <?php endif; ?>
                <!-- Lien visible uniquement pour les admins -->
                <?php if (!empty($_SESSION["is_admin"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="administration">Administration</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <!-- Lien visible pour tout le monde -->
            <li class="nav-item">
                <a class="nav-link" href="liste-produits">Tous les produits</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>

            <?php if (empty($_SESSION["is_login"])): ?>
                <a href="inscription" class="mx-1 btn btn-success">Inscription</a>
                <a href="connexion" class="mx-1 btn btn-warning">Connexion</a>
            <?php else: ?>
                <a href="deconnexion" class="mx-1 btn btn-danger">Déconnexion</a>
            <?php endif; ?>
        </form>
    </div>
</nav>
