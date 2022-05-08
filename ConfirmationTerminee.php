<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<?php
$finished = 1;
if (isset($_SESSION['login'])) {
    if (isset($_POST['title'])) {
        //modifier le statut de l'histoire dans la base de données
        $requete = "UPDATE stories SET finished=?";
        $stmt = $bdd->prepare($requete);
        $stmt->execute(array($finished));
        $ligne = $stmt->fetch();
    }
}
?>

<main>
    <div id="backgroundConnexion">
        <br />
        <br />
        <br />
        <h1 id="centre">
            Félicitations !
        </h1>
        <h2 id="centre">
            Vous histoire est désormais marquée comme "Terminée"
        </h2>
        <div id="btn-lecture">
            <a class="btn btn-outline-dark" href="ListeHistoires.php" role="button"> Retour </a>
        </div>
    </div>
</main>