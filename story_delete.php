<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">

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
            $requete7 = $bdd->prepare('DELETE FROM stories WHERE id_story=?');
            $requete7->execute(array($storyId));
        ?>
        <div class="alert alert-success" role="alert">
            Supression de l'histoire réussie !
        </div>
    </div>
</main>