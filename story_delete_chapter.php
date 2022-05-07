<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">

        <?php
        $chapterId = $_GET['id'];
        //on supprime toutes les données faisant référence au chapitre
        $requete1 = $bdd->prepare('SELECT * FROM chapters WHERE id_chapter =?');
        $requete1->execute(array($chapterId));
        $requete2 = $bdd->prepare('DELETE FROM chapters WHERE id_chapter=?');
        $requete2->execute(array($chapterId));
        //ajouter la suppression dans les autres tables : links, points, ???
        //ne pas oublier de vérifier que le nombre de chapitres dans stories diminue aussi
        ?>
        <div class="alert alert-success" role="alert">
            Supression du chapitre réussie !
        </div>
    </div>
</main>