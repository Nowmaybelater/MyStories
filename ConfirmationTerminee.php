<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<?php
    //modifier le statut de l'histoire dans la base de données
    $id=$_GET["id"];
    $requete = "UPDATE stories SET finished='1' WHERE id_story=?";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array($id));
    $ligne = $stmt->fetch();
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
</body>

</html>