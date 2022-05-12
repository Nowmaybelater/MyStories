<?php session_start();?>
<?php session_unset();
header("Location: index.php");?>
<!--Cette page assure la déconnexion de l'utilisateur et sa redirection vers la apge d'accueil du site une foix la déconnexion effectuée-->