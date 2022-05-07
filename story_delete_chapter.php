<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">

        <?php
        $chapterId = $_GET['id'];

        $requete1 = $bdd->prepare('SELECT * FROM chapters WHERE id_chapter =?');
        $requete1->execute(array($chapterId));
        $chapter=$requete1->fetch();
        //on suprime toutes les reférences au chapitre à suprimer dans les tables qui ne sont pas chapters
            $requete3 = $bdd->prepare('DELETE FROM links WHERE id_story=? AND Chapter=?');
            $requete3->execute(array($chapter['id_story'], $chapter['numChapter']));
            $requete4 = $bdd->prepare('DELETE FROM points WHERE id_story=? AND Chapter=?');
            $requete4->execute(array($chapter['id_story'], $chapter['numChapter']));
            $requete6 = $bdd->prepare('DELETE FROM choices WHERE id_story=? AND Chapter=?');
            $requete6->execute(array($chapter['id_story'], $chapter['numChapter']));
            
            if($chapter['numChapter']!=1){
                $nvNum=$chapter['numChapter']-1;
                $requete5 = $bdd->prepare('UPDATE advancement SET numChapter=$nvNum WHERE id_story=? AND Chapter=??');
                $requete5->execute(array($chapter['id_story'], $chapter['numChapter']));
            }
            else
            {
                $requete6 = $bdd->prepare('DELETE FROM advancement WHERE id_story=? AND Chapter=?');
                $requete6->execute(array($chapter['id_story'], $chapter['numChapter']));
                $requete6 = $bdd->prepare('DELETE FROM player_points WHERE id_story=?');
                $requete6->execute(array($chapter['id_story']));
            }
            
        //on supprime toutes les données faisant référence au chapitre
        $requete2 = $bdd->prepare('DELETE FROM chapters WHERE id_chapter=?');
        $requete2->execute(array($chapterId));
        //ne pas oublier de vérifier que le nombre de chapitres dans stories diminue aussi
        ?>
        <div class="alert alert-success" role="alert">
            Supression du chapitre réussie !
        </div>
    </div>
</main>