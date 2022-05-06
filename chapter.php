<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id=backgroundConnexion>
    <?php

        //récupération de l'id_user
        $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
        $req = $bdd->prepare($requete);
        $req->execute(array(
            'usr_login' => $_SESSION['login'],
        ));
        $ligne = $req->fetch();  
        $id_user = $ligne['id_usr'];

        //récupération de l'id_story
        $requete = "SELECT * FROM stories WHERE id_story = :id";
        $req = $bdd->prepare($requete);
        $req->execute(array('id' => $_GET['story_id']));

        $histoire = $req->fetch();
    ?> 
        <!--affichage du titre et numéro de chapitre-->
        <h1 id="centre"><?php echo $histoire['title']; ?></h2>
        <h6 id="donneesHistoire">Chapitre <?= $_GET['chapter_num']?></h6>

        <?php
        //récupération du chapitre
        $requete = "SELECT * FROM chapters WHERE id_story = :id AND numChapter = :chap";
        $req = $bdd->prepare($requete);
        $req->execute(array(
            'id' => $_GET['story_id'],
            'chap'=> $_GET['chapter_num']
        ));
        $chapter = $req->fetch();
        ?>

        <?php
            //enregistre le choix du joueur dans la bdd pour le résumé de la partie à la fin
            if($_GET['choice_num']!=0)
            {
                $requete5 = "SELECT * FROM links WHERE id_story = :id AND Chapter = :chapter AND Previous_Choice = :previous_choice ";
                $req5 = $bdd->prepare($requete5);
                $req5->execute(array(
                    'id' => $_GET['story_id'],
                    'chapter'=> $_GET['chapter_num'],
                    'previous_choice'=>$_GET['choice_num']
                ));
                $previous_chap = $req5->fetch(); 

                $req6 = $bdd->prepare('INSERT INTO choices (id_usr, id_story, numChapter,choice) VALUES (:usr_id, :id_story, :numChap, :choice)');
                $req6->execute(array(
                    'usr_id' => $id_user,
                    'id_story' => $_GET['story_id'],
                    'numChap' => $previous_chap['Previous_Chapter'],
                    'choice'=>$_GET['choice_num']
                ));
            }
        ?>

        <div>
            <p>
                <!--affichage du contenu du chapitre-->
                <?= $chapter['chapterContent']?>
            </p>
        </div>
        <div>
            <?php 
            if(!empty($chapter['choice1'])){
                $requete2 = "SELECT * FROM links WHERE id_story = :id AND Previous_Chapter = :previous_chap AND Previous_Choice = :previous_choice ";
                $req2 = $bdd->prepare($requete2);
                $req2->execute(array(
                    'id' => $_GET['story_id'],
                    'previous_chap'=> $_GET['chapter_num'],
                    'previous_choice'=> 1
                ));
                $choix1 = $req2->fetch();                
                ?>
                <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $choix1['id_story']?>&chapter_num=<?= $choix1['Chapter']?>&choice_num=1" role="button"><?= $chapter['choice1']?></a>
                &nbsp;
                <?php
            }
            if(!empty($chapter['choice2'])){
                $requete3 = "SELECT * FROM links WHERE id_story = :id AND Previous_Chapter = :previous_chap AND Previous_Choice = :previous_choice ";
                $req3 = $bdd->prepare($requete3);
                $req3->execute(array(
                    'id' => $_GET['story_id'],
                    'previous_chap'=> $_GET['chapter_num'],
                    'previous_choice'=> 2
                ));
                $choix2 = $req3->fetch(); 
                ?>
                <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $choix2['id_story']?>&chapter_num=<?= $choix2['Chapter']?>&choice_num=2" role="button"><?= $chapter['choice2']?></a>
                &nbsp;
                <?php
            }
            if(!empty($chapter['choice3'])){
                $requete4 = "SELECT * FROM links WHERE id_story = :id AND Previous_Chapter = :previous_chap AND Previous_Choice = :previous_choice ";
                $req4 = $bdd->prepare($requete4);
                $req4->execute(array(
                    'id' => $_GET['story_id'],
                    'previous_chap'=> $_GET['chapter_num'],
                    'previous_choice'=> 3
                ));
                $choix3 = $req4->fetch();
                ?>
                <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $choix3['id_story']?>&chapter_num=<?= $choix3['Chapter']?>&choice_num=3" role="button"><?= $chapter['choice3']?></a>
                &nbsp;
                <?php
            }
            ?>
        </div>
        <br/>
        <div>
            <a class="btn btn-outline-dark" href="advancement.php?story_id=<?= $_GET['story_id']?>&chapter_num=<?= $_GET['chapter_num']?>" role="button">Enregistrer mon avancée</a>
        </div>

    </div>
</main>
</body>

</html>