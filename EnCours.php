<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php") ?>

<?php
    //modifier le statut de l'histoire dans la base de données
    $id=$_GET["id"];
    $requete = "UPDATE stories SET finished='0' WHERE id_story=?";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array($id));
    $ligne = $stmt->fetch();
    redirect("story_modify.php?id=$id");
?>