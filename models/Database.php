<?php
declare(strict_types = 1); //Typage des elements PHP
namespace models; //Le namespace => https://www.php.net/manual/fr/language.namespaces.rationale.php
/*
    Collisions de noms entre le code que vous créez, les classes, fonctions ou constantes internes de PHP, ou celle de bibliothèques tierces.
    La capacité de faire des alias ou de raccourcir des Noms_Extremement_Long pour aider à la résolution du premier problème, et améliorer la lisibilité du code.
 */
use PDO; //Alias de la classe PDO PHP
class Database
{
    //Pour l'encapsulation les propriétés (variable ou constante dans une classe) sont privée
    //Ces données sont sensibles, elles doivent n'etre accessible qu'a l'interieur de cette classe parente

    private string $db_host = "localhost";
    private string $db_name = "base_test_2";
    private string $db_user = "root";
    private string $db_password = "";

    private PDO|bool $connexion = false;

    //Les methodes (fonction dans une classe), ont une portée public et sont donc accessible de partout
    public function getPDOConnection(){
        try{
            //Instance de la classe PDO stockée dans une varaiable
            //La pseudo-variable $this est disponible lorsqu'une méthode est appelée depuis un contexte objet.
            //$this est la valeur de l'objet appelant.
            $this->connexion = new PDO("mysql:host=" .$this->db_host. ";dbname=" .$this->db_name. ";charset=utf8", $this->db_user, $this->db_password);
            //On utilise l'opérateur :: pour acceder au constante de la classe PDO et - ou au methode static
            //Ces constantes servent au debug de vos requête HTTP
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo '<div class="container mt-3 w-50  alert alert-success p-3">Vous êtes connecter a la base de données via PDO MySQL !</div>';
            //En cas de succès, la methode retourne le booleen TRUE
            return $this->connexion;

        }catch (\PDOException $e){
            //Afficher en message d'erreur en cas d'echec de connexion
            echo "Erreur de connexion a la base de données via PDO ! " . $e->getMessage();
            die(); //Alias de exit() = Terminer le script en cours avec un code d'état ou un message

        }
    }
}