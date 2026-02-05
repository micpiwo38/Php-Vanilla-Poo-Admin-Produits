<?php


namespace models\users;

use models\Database;
use PDO;
use PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once "../models/Database.php";
require_once "UserInterface.php";
require_once "../vendor/phpmailer/phpmailer/src/Exception.php";
require_once "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "../vendor/phpmailer/phpmailer/src/SMTP.php";

class UserModel extends Database implements UserInterface
{
    //Encpasulation privée :
    private $user_id;
    private $user_email;
    private $user_password;
    private $user_role;
    private $user_is_active = 0;

    private PDO $db;

    //Constructeur => cette methode est lancée automatiquement a l'instance de $usermode = new UserModel()
    public function __construct()
    {
        //Instance de la classe Database() pour acceder au methode stockée dans une variable
        $connexion = new Database();
        $this->db = $connexion->getPDOConnection();
    }

    public function UserRegister(string $email, string $password, string $role = "user"): bool
    {
        //Champs du formulaire not null et not empty
        if(isset($_POST["email"]) && !empty($_POST["email"])){
            $this->user_email = trim(htmlspecialchars($_POST["email"]));
        }else{
            echo "<div class='alert alert-danger p-3'>Le champ email est obligatoire !</div>";
        }

        //PASSWORD
        if(isset($_POST["password"]) && !empty($_POST["password"])){
            $this->user_password = trim(htmlspecialchars($_POST["password"]));
        }else{
            echo "<div class='alert alert-danger p-3'>Le champ mot de passe est obligatoire !</div>";
        }

        // Vérifier que l'utilisateur n'existe pas déja :
        $user_exist_request = "SELECT * FROM users WHERE email_user = ?";
        //Requète préparée pour lutter contre les injection SQL
        $check_user_exist = $this->db->prepare($user_exist_request);
        //Executer la requète
        $check_user_exist->execute([
            $this->user_email
        ]);
        $user = $check_user_exist->fetch();
        if($user){
            echo "<div class='alert alert-danger p-3'>Cet email n'est pas disponible
                    <a href='inscription'>Recommencer</a>
                </div>";
        }else{
            $sql = "INSERT INTO users (email_user, password_user, role_user, user_account_status) VALUES (?,?,?,?)";
            $this->user_role = 0;
            //Requète préparée pour lutter contre les injections SQL
            $statement = $this->db->prepare($sql);
            //Lier les paramètres du formulaire a la requète SQL
            $statement->bindParam(1, $this->user_email);
            //Hash du mot de passe
            $hash_password = password_hash($this->user_password, PASSWORD_DEFAULT);
            $statement->bindParam(2, $hash_password);
            $statement->bindParam(3, $this->user_role);
            $statement->bindParam(4, $this->user_is_active);
            //Executer les paramètres binder dans un tableau
            $statement->execute([
                $this->user_email,
                $hash_password,
                $this->user_role,
                $this->user_is_active
            ]);
            $is_register = true;
            if($is_register){
                $mail = new PHPMailer();
                //Recuperer le dernier utilisateur inscrit
                $last_user_id = $this->db->lastInsertId();
                //Debug
                //var_dump($last_user_id);
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Autorisé le debug
                    $mail->isSMTP();                                            //Envoyé via SMTP
                    $mail->Host       = 'localhost';                            //Hôte SMTP serveur port 1025                     //Enable SMTP authentication
                    $mail->Username   = 'user@example.com';                     //SMTP username
                    $mail->Password   = 'secret';                               //SMTP password
                    $mail->Port       = 1025;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    $mail->SMTPAuth = false;
                    $mail->SMTPSecure = false;
                    //Recipients
                    $mail->setFrom('from@example.com', 'Mailer');
                    $mail->addAddress('joe@example.net', 'Joe User');     //Adresse

                    //Content
                    $mail->isHTML(true);                                  //Set email au format HTML
                    $mail->Subject = 'Inscription PHP Ecommerce'; //Titre de l'email
                    $validationLink = "http://localhost/poo_mvc_base/valider-compte?id=" . $last_user_id . "&status=1"; //Recuperer le dernier ID et changer le status
                    $mail->Body = " 
                                <h3>Bienvenue !</h3> 
                                <p>Merci pour votre inscription.</p> 
                                <p>Cliquez ici pour activer votre compte :</p> <p>
                                <a href='$validationLink'>Activer mon compte</a></p> ";
                    $mail->AltBody = 'Corp de la page en plain text pour non-HTML email clients';

                    $mail->send();
                    echo 'Votre message a bien été envoyé';
                } catch (Exception $e) {
                    echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
                }
            }
        }
        return true;
    }

    public function UserLogin(string $email, string $password): bool
    {
        //Stocker les valeurs des champs du formulaire
        $this->user_email = trim(htmlspecialchars($_POST["email"]));
        $this->user_password = trim(htmlspecialchars($_POST["password"]));

        //Requete SQL pour lister les utilisateurs par email
        $sql = "SELECT * FROM users WHERE email_user = ?";
        //Requète préparée pour lutter contre les injections SQL
        $statement = $this->db->prepare($sql);
        //Executer la requète
        $statement->execute([$this->user_email,]);
        //Lister les utilisateurs inscrits => au moin 1 user dans la table
        if($statement->rowCount() === 1) {
            //Stocker les résultats dans une variable $row
            $row = $statement->fetch();
            //var_dump($row);
            //Verification du mot de passe haché
            if (password_verify($this->user_password, $row["password_user"])) {
                $_SESSION["is_login"] = true; //Variable de session bool
                $_SESSION["user_id"] = $row["id_user"]; //Stocker en session id de l'utilisateur
                $_SESSION["email"] = $row["email_user"]; //Stocker en session l'email de l'utilisateur
                $_SESSION["role"] = $row["role"]; //Stocker en session le role de l'utilisateur

                //Définition du role :
                //Si 0 => user
                if ($row["role_user"] == 0) {
                    $_SESSION["is_user"] = true;
                    //Si 1 = admin
                } elseif ($row["role_user"] == 1) {
                    $_SESSION["is_admin"] = true;
                }
                return true;
            }
        }
        return false;
    }


    public function ChangeAccountStatus(int $user_id, bool $account_status): bool
    {
        $sql = "UPDATE users SET user_account_status = ? WHERE id_user = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$account_status, $user_id]);
    }

    public function AssignRole(int $user_id, string $role)
    {
        $sql = "UPDATE users SET role_user = ? WHERE id_user = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$role, $user_id]);
    }

    public function ResetPassword()
    {
        if (empty($_POST["email"])) {
            echo "<div class='alert alert-danger p-3'>Veuillez entrer votre email.</div>";
            return false;
        }

        $email = trim(htmlspecialchars($_POST["email"]));

        // Vérifier si l'utilisateur existe
        $sql = "SELECT * FROM users WHERE email_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            echo "<div class='alert alert-danger p-3'>Aucun compte trouvé avec cet email.</div>";
            return false;
        }

        // Lien simple sans token
        $resetLink = "http://localhost/poo_mvc_base/reset-password?email=" . urlencode($email);

        // Envoi via MailHog
        $mail = new PHPMailer();

        try {
            $mail->isSMTP();
            $mail->Host = 'localhost';
            $mail->Port = 1025;
            $mail->SMTPAuth = false;

            $mail->setFrom('no-reply@mic-office.com', 'MIC-OFFICE');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Réinitialisation du mot de passe";
            $mail->Body = "
            <h3>Réinitialisation du mot de passe</h3>
            <p>Cliquez sur le lien ci-dessous pour choisir un nouveau mot de passe :</p>
            <p><a href='$resetLink'>Changer mon mot de passe</a></p>
        ";

            $mail->send();
            echo "<div class='alert alert-success p-3'>Un lien de réinitialisation a été envoyé à votre email.</div>";

        } catch (Exception $e) {
            echo "<div class='alert alert-danger p-3'>Erreur lors de l'envoi du mail : {$mail->ErrorInfo}</div>";
        }

        return true;
    }


    public function UpdatePassword(string $email)
    {
        if (empty($_POST["password"])) {
            echo "<div class='alert alert-danger p-3'>Veuillez entrer un mot de passe.</div>";
            return false;
        }

        $newPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password_user = ? WHERE email_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$newPassword, $email]);

        echo "<div class='alert alert-success p-3'>Votre mot de passe a été mis à jour.</div>";
        return true;
    }

    //Supprimer un compte utilisateur
    public function DeleteUserAccount(): bool
    {
        //Verifié que ID utilisateur est bien stocké en session
        if (!isset($_SESSION["user_id"])) {
            return false;
        }
        //La requète
        $sql = "DELETE FROM users WHERE id_user = ?";
        //Lutter contre l'injection SQL
        $statement = $this->db->prepare($sql);
        //Executer la requète
        return $statement->execute([$_SESSION["user_id"]]);
    }

    public function GetAllUsers(): array
    {
        $sql = "SELECT * FROM users ORDER BY id_user ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}