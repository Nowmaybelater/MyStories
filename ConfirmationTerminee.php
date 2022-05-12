<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet de donner le statut Terminée à une histoire lorsqu'elle était marquée comme En Cours. Cette page génère un affichage de 
confirmation-->
<?php
    //modifier le statut de l'histoire dans la base de données
    $id=$_GET["id"];
    $requete = "UPDATE stories SET finished='1' WHERE id_story=?";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array($id));
    $ligne = $stmt->fetch();
?>
<!--Affichage du message de confirmation de modification du statu-->
<main>
    <div id="backgroundConnexion">
    <br />
        <br />
        <br />
        <br />
        <div id="centre" class="alert alert-success" role="alert">
            <h3>Félicitations ! Votre histoire est à présent marquée comme terminée</h3>
        </div>
        <br />
        <br />
        <br />
        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="story_modify.php?id=<?=$id?>" role="button"> Retour à la page précédente </a>
        </div>
    </div>
    </main>
</body>

</html>