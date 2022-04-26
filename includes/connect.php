<?php
$host = "localhost";
$dbname = "mystories";
$username = "ClaraValentine";
$password = "ensc*2024";

try {
    $bdd = new PDO("mysql:host=". $host .";dbname=". $dbname .";charset=utf8",
        $username,
        $password);
} catch(Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die("Erreur : ". $e->getMessage());
}
