<?php
//Import de UserModel.php
use models\users\UserModel;

require_once "../models/users/UserModel.php";

function EngisterUtilisateur():bool{
    //Instance de la classe UserModel()
    $user_model = new \models\users\UserModel();
    //Le bouton du formulaire
    if(isset($_POST["btn-register"])){
        //Les champs sont obligatoire
        if (empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["password_repeat"])) {
            echo "<div class='alert alert-danger p-3'>Merci de remplir tous les champs !</div>";
            return false;
        } else {
            $form_is_valid = true;
        }
        //PASSWORD REPEAT
        if ($_POST["password_repeat"] != $_POST["password"]) {
            echo "<div class='text-center'>
                        <div class='alert alert-danger p-3 w-50 text-center mt-3'>Les mot de passe sont différents !</div>";
            return false;
        } else {
            $form_is_valid = true;
        }
        //Si le formulaire est valide -> on appel la methode de l'instance de UserModel()
        //La methode UserRegsiter prend 3 paramètres obligatoire
        if($form_is_valid && $user_model->UserRegister($_POST["email"], $_POST["password"], $role = "user")){
            echo "<div class='alert alert-success p-3 w-50'>
                        <div>
                        Merci pout votre inscription !
                        </div>
                        <a href='connexion' class='btn btn-success mt-3'>Se connecter</a>
                        </div>";
            return true;
        } else {
            echo "<div class='alert alert-danger p-3 w-50'>
                        <div>
                        Erreur lors de votre inscription !
                        </div>
                        <a href='inscription' class='btn btn-danger mt-3'>Recommencer</a>
                        </div>";
            return false;
        }
    }
    return false;
}

//Valider le compte utilisateur
function ValiderCompteUtilisateur(int $id, $status){
    //Instance de la classe UserModel()
    $user_model = new \models\users\UserModel();
    //Appel de la methode du modele avec id et statut
    $success = $user_model->ChangeAccountStatus($id, $status);
    if($success){
        ?>
            <div class="text-center">
                <div class="alert alert-success w-25 shadow mt-3 p-3">
                    Merci pour votre inscription : votre compte a bien été validé !
                </div>
                <a href="connexion" class="btn btn-warning mt-3">Connexion</a>
            </div>
        <?php
    }else{
        ?>
        <div class="text-center">
            <div class="alert alert-danger w-25 shadow mt-3 p-3">
                Erreur lors de la validation de votre !
            </div>
            <a href="produits" class="btn btn-warning mt-3">Retour</a>
        </div>
        <?php
    }
}

//Connexion Utilisateur
function ConnexionUtilisateur(){
    //Instance de la classe UsersModel stocker dans un variable
    $user_model = new UserModel();
    //Au clic sur le bouton du formulaire
    if(isset($_POST["btn-login"])){
        //Si les champs ne sont  pas vide
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            //Appel de la methode du modèle dans une condition
            if($user_model->UserLogin($_POST["email"], $_POST["password"])){
                //Si on est administrateur => on redirige vers la page admin
                if(isset($_SESSION["is_admin"])){
                    header("Location: administration");
                    exit;
                }
                //Sinon vers la page de profile
                if(isset($_SESSION["is_user"])){
                    header("Location: profile");
                    exit;
                }
            }else{
                //Sinon -> on affiche une erreur
                ?>
                <div class='alert alert-danger p-3'>Erreur lors de votre tentative de connexion ! Merci de vérifié votre email et mot de passe !
                        <hr>
                            <a href='connexion' class='btn btn-warning mt-3'>Recommencer</a>
                        <hr>
                </div>
                <?php
            }
        }
    }
}
//Mot de passe oublié
function MotDePasseOublieController() {
    $user_model = new UserModel();

    if (isset($_POST["btn-reset"])) {
        $user_model->ResetPassword();
    }
}
//Modifier le mot de passe
function ResetPasswordFormController() {
    $user_model = new UserModel();

    if (isset($_POST["btn-new-pass"])) {
        $user_model->UpdatePassword($_GET["email"]);
    }
}

//Supprimer un compte utilisateur
function SupprimerUtilisateur(){
    //Debug de ID utilisateur stocké dans la sessin
    //var_dump($_SESSION["user_id"]);
    //Instance du modèle
    $users_model = new UserModel();
    //Le bouton du formulaire
    if(isset($_POST["btn-delete"])){
        //Appel de la methode du modèle
        $users_model->DeleteUserAccount();
        //Redirection pour confimer la supression
        header("Location: supprimer-utilisateur");
        return true;
    }
    return false;
}

//Afficher tous les utilisateurs
function AfficherUtilisateur(){
    $users_model = new UserModel();
    $users = $users_model->GetAllUsers();
    return $users;
}

//Changer le role des utilisateurs
function ChangerRoleUtilisateur()
{
    if (!isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] !== true) {
        header("Location: afficher-produits");
        exit;
    }

    if (!isset($_POST["user_id"], $_POST["role"])) {
        header("Location: administration-utilisateur");
        exit;
    }

    $user_id = (int)$_POST["user_id"];
    $role = $_POST["role"]; // "0" ou "1"

    $user_model = new UserModel();
    $user_model->AssignRole($user_id, $role);

    header("Location: administration-utilisateur?success=1");
    exit;
}





