<?php
//La session est en cours
session_start();

$_SESSION = array();
//2 manières de détruire une session
session_unset();
session_destroy();
//Redirection vers la page de connexion
header('Location: connexion');
?>

<div>Vous etes deconnecter !!!!</div>
