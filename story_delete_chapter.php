<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page contient le php permettant de supprimer un chapitre, et renvoie sur une page qui en confirme la réalisation-->
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
            $requete4 = $bdd->prepare('DELETE FROM links WHERE id_story=? AND Previous_Chapter=?');
            $requete4->execute(array($chapter['id_story'], $chapter['numChapter']));
            $requete5 = $bdd->prepare('DELETE FROM points WHERE id_story=? AND chapter=?');
            $requete5->execute(array($chapter['id_story'], $chapter['numChapter']));
            $requete6 = $bdd->prepare('DELETE FROM choices WHERE id_story=? AND numChapter=?');
            $requete6->execute(array($chapter['id_story'], $chapter['numChapter']));
            
            if($chapter['numChapter']!=1){
                $nvNum=$chapter['numChapter']-1;
                $requete7 = $bdd->prepare("UPDATE advancement SET numChapter=$nvNum WHERE id_story=:id AND numChapter=:numchapter");
                $requete7->execute(array("id"=>$chapter['id_story'], 'numchapter'=>$chapter['numChapter']));
            }
            else
            {
                $requete8 = $bdd->prepare('DELETE FROM advancement WHERE id_story=? AND numChapter=?');
                $requete8->execute(array($chapter['id_story'], $chapter['numChapter']));
                $requete9 = $bdd->prepare('DELETE FROM player_points WHERE id_story=?');
                $requete9->execute(array($chapter['id_story']));
            }
            
        //on supprime toutes les données faisant référence au chapitre
        $requete2 = $bdd->prepare('DELETE FROM chapters WHERE id_chapter=?');
        $requete2->execute(array($chapterId));
        
        //diminuer le nombre de chapitres de l'histoire
        $requete11 = $bdd->prepare('SELECT * FROM stories WHERE id_story =?');
        $requete11->execute(array($chapter['id_story']));
        $story=$requete11->fetch();
        $nbChapter=$story['nbChapters']-1;
        $requete10 = $bdd->prepare("UPDATE stories SET nbChapters=$nbChapter WHERE id_story=:id");
        $requete10->execute(array("id"=>$chapter['id_story']));
        ?>
        <br />
        <br />
        <br />
        <br />
        <div id="centre" class="alert alert-success" role="alert">
            <h3>Le chapitre a été modifié avec succès !</h3>
        </div>
        <br />
        <br />
        <br />
        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="ListeHistoires.php" role="button"> Retour à la liste de vos histoires </a>
        </div>
    </div>
    </main>
</body>

</html>