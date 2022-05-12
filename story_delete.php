<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php
    $storyId=$_GET['id'];
    //on supprime toutes les lignes faisant référence à cette histoire
    $requete1 = $bdd->prepare('SELECT * FROM chapters WHERE id_story=?');
    $requete1->execute(array($storyId));
    $requete2 = $bdd->prepare('DELETE FROM chapters WHERE id_story=?');
    $requete2->execute(array($storyId));
    $requete3 = $bdd->prepare('DELETE FROM links WHERE id_story=?');
    $requete3->execute(array($storyId));
    $requete4 = $bdd->prepare('DELETE FROM points WHERE id_story=?');
    $requete4->execute(array($storyId));
    $requete5 = $bdd->prepare('DELETE FROM advancement WHERE id_story=?');
    $requete5->execute(array($storyId));
    $requete6 = $bdd->prepare('DELETE FROM stats WHERE id_story=?');
    $requete6->execute(array($storyId));
    $requete7 = $bdd->prepare('DELETE FROM choices WHERE id_story=?');
    $requete7->execute(array($storyId));
    $requete8 = $bdd->prepare('DELETE FROM player_points WHERE id_story=?');
    $requete8->execute(array($storyId));
    $requete9 = $bdd->prepare('DELETE FROM stories WHERE id_story=?');
    $requete9->execute(array($storyId));
//redirige vers la page qui confirme la suppression de l'histoire
    header("Location: story_deleted.php");?>
</main>
</body>

</html>