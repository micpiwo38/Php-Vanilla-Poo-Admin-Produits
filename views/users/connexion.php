<div class="container w-25 rounded shadow mt-5 p-5">
    <!--Le formulaire avec la methode POST-->
    <form method="POST">
        <h2 class="text-warning">CONNEXION</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" name="btn-login" class="btn btn-success">CONNEXION</button>
        <hr>
        <div>Vous êtes nouveau ?
            <!--Redirection vers la route 'inscription' et donc la vue views/users/register.php-->
            <a href="inscription">S'inscrire</a>
        </div>
        <hr>
        <!--Redirection vers la route mot de passe oublié-->
        <a href="mot-de-passe-oublie">Mot de passe oublié ?</a>
    </form>
</div>