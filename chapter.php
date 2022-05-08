<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php") ?>

<main>
    <div id=backgroundConnexion>

    <!--enregistrement de l'avancée de la partie-->
    <?php 
        $id_story=$_GET['story_id'];
        $num_chapter=$_GET['chapter_num'];
        $login=$_SESSION['login'];
        Advancement($id_story, $num_chapter, $login, $bdd);
    ?>


    <?php
        //récupération de l'id_user
        $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
        $req = $bdd->prepare($requete);
        $req->execute(array(
            'usr_login' => $_SESSION['login'],
        ));
        $ligne = $req->fetch();  
        $id_user = $ligne['id_usr'];
        

        //récupération des données de l'histoire
        $requete = "SELECT * FROM stories WHERE id_story = :id";
        $req = $bdd->prepare($requete);
        $req->execute(array('id' => $_GET['story_id']));

        $histoire = $req->fetch();
        $points_story=$histoire['nbrPoints'];

        ?> 

        <!--affichage du titre et numéro de chapitre-->
        <h1 id="centre"><?php echo $histoire['title']; ?></h2>
        <h6 id="donneesHistoire">Chapitre <?= $_GET['chapter_num']?></h6>

        <?php
        //récupération du chapitre
        $requete7 = "SELECT * FROM chapters WHERE id_story = :id AND numChapter = :chap";
        $req7 = $bdd->prepare($requete7);
        $req7->execute(array(
            'id' => $_GET['story_id'],
            'chap'=> $_GET['chapter_num']
        ));
        $chapter = $req7->fetch();
        ?>

        <?php
            if($_GET['choice_num']!=0)
            {
                //récupération du numéro du chapitre précédent
                $requete5 = "SELECT * FROM links WHERE id_story = :id AND Chapter = :chapter AND Previous_Choice = :previous_choice ";
                $req5 = $bdd->prepare($requete5);
                $req5->execute(array(
                    'id' => $_GET['story_id'],
                    'chapter'=> $_GET['chapter_num'],
                    'previous_choice'=>$_GET['choice_num']
                ));
                $previous_chap = $req5->fetch(); 

                //vérifie que le joueur n'est pas mort et ajoute les points perdu nécessaire
                $failed=Points($id_user, $bdd, $previous_chap['Previous_Chapter'], $_GET['choice_num'], $points_story);
                if($failed==1){
                    $id=$_GET['story_id'];
                    $link="end.php?id=$id&failed=1";
                    header("Location: $link");
                }
                
                //enregistre le choix du joueur dans la bdd pour le résumé de la partie à la fin
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
            //affichage du contenu du choix 1 dans un bouton cliquable
            if(!empty($chapter['choice1'])){
                $requete2 = "SELECT * FROM links WHERE id_story = :id AND Previous_Chapter = :previous_chap AND Previous_Choice = :previous_choice ";
                $req2 = $bdd->prepare($requete2);
                $req2->execute(array(
                    'id' => $_GET['story_id'],
                    'previous_chap'=> $_GET['chapter_num'],
                    'previous_choice'=> 1
                ));
                $choix1 = $req2->fetch();  
                if($_GET['chapter_num']!=$histoire['nbChapters']){
                    $id=$_GET['story_id'];
                    $chapterNum=$choix1['Chapter'];
                    ?>
                        <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $id?>&chapter_num=<?= $chapterNum?>&choice_num=1" role="button"><?= $chapter['choice1']?></a>
                        &nbsp;
                    <?php
                }
                else{
                    $id=$_GET['story_id'];
                    ?>
                        <a class="btn btn-outline-dark" href="end.php?id=<?= $id?>&failed=0" role="button"><?= $chapter['choice1']?></a>
                        &nbsp;
                    <?php
                }
            }
            //affichage du contenu du choix 2 dans un bouton cliquable
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
            //affichage du contenu du choix 3 dans un bouton cliquable
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
    </div>
</main>
</body>

</html>