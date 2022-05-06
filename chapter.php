<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id=backgroundConnexion>
    <?php
        //fonction qui met à jour les point et la mort du joueur au fur et à mesure des choix
        function Points($id_user, $bdd, $chapter, $choice)
        {
            $requete11 = "SELECT * FROM points WHERE id_story = :story_id AND chapter= :chapter AND numChoice= :choice";
            $req11 = $bdd->prepare($requete11);
            $req11->execute(array(
                'story_id'=> $_GET['story_id'],
                'chapter'=> $chapter,
                'choice'=>$choice
            ));
            if($req11->rowCount() ==1){
                $ligne2=$req11->fetch();
                $pts=$ligne2['points'];
                $death=$ligne2['death'];

                $requete8 = "SELECT * FROM player_points WHERE id_user = :usr_id AND id_story = :story_id";
                $req8 = $bdd->prepare($requete8);
                $req8->execute(array(
                    'usr_id' => $id_user,
                    'story_id'=> $_GET['story_id']
                ));
                if($req8->rowCount() == 1){
                    $ligne=$req8->fetch();
                    $points=$ligne['points'] + $pts;
                    echo $points;
                    $req9="UPDATE player_points SET points=$points WHERE id_user = :usr_id AND id_story = :story_id";
                    $requete9 = $bdd->prepare($req9);
                    $requete9->execute(array(
                        'usr_id' => $id_user,
                        'story_id'=> $_GET['story_id']
                    ));
                    $req12="UPDATE player_points SET death=$death WHERE id_user = :usr_id AND id_story = :story_id";
                    $requete12 = $bdd->prepare($req12);
                    $requete12->execute(array(
                        'usr_id' => $id_user,
                        'story_id'=> $_GET['story_id']
                    ));
                }
                else{
                    $req10= $bdd->prepare('INSERT INTO player_points (id_user, id_story, points,death) VALUES (:usr_id, :id_story, :points, :death)');
                    $req10->execute(array(
                        'usr_id' => $id_user,
                        'id_story' => $_GET['story_id'],
                        'points' => $pts,
                        'death'=>$death
                    ));
                    
                }
                if($death==1){
                    return 1;
                }
                else{
                    return 0;
                }
            }
            return 0;
        }

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
        $requete7 = "SELECT * FROM chapters WHERE id_story = :id AND numChapter = :chap";
        $req7 = $bdd->prepare($requete7);
        $req7->execute(array(
            'id' => $_GET['story_id'],
            'chap'=> $_GET['chapter_num']
        ));
        $chapter = $req7->fetch();
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
                $failed1=Points($id_user, $bdd, $_GET['chapter_num'], 1);
                if($failed1==1){
                    echo "death";
                }
                else{
                ?>                
                    <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $choix1['id_story']?>&chapter_num=<?= $choix1['Chapter']?>&choice_num=1" role="button"><?= $chapter['choice1']?></a>
                    &nbsp;
                <?php }
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
                $failed2=Points($id_user, $bdd, $_GET['chapter_num'], 2);
                if($failed2==1){
                    echo "death";
                }
                else{
                ?>
                <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $choix2['id_story']?>&chapter_num=<?= $choix2['Chapter']?>&choice_num=2" role="button"><?= $chapter['choice2']?></a>
                &nbsp;
                <?php }
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
                $failed3=Points($id_user, $bdd, $_GET['chapter_num'], 3);
                if($failed3==1){
                    echo "death";
                }
                else{
                ?>
                <a class="btn btn-outline-dark" href="chapter.php?story_id=<?= $choix3['id_story']?>&chapter_num=<?= $choix3['Chapter']?>&choice_num=3" role="button"><?= $chapter['choice3']?></a>
                &nbsp;
                <?php }
            }
            ?>
        </div>
        <br/>
        <div>
            <!--bouton d'enregistrement de l'avancée de la partie-->
            <a class="btn btn-outline-dark" href="advancement.php?story_id=<?= $_GET['story_id']?>&chapter_num=<?= $_GET['chapter_num']?>" role="button">Enregistrer mon avancée</a>
        </div>

    </div>
</main>
</body>

</html>