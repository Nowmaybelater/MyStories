<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet à l'utilisateur d'accéder aux histoires qu'il est en train de lire, et dont la progression est sauvegardée. Il peut ainsi
reprendre la lecture à tout moment, en voyant les points de vie qu'il lui reste-->
<main>
  <div id="backgroundConnexion">
    <p class="titre"> Bibliothèque </p>
    <p id="centre">Vous trouverez ici la liste des histoires que vous avez déjà commencées</p>
    <br/>
    <hr />
    <div>
      <?php
      //récupération de id_user
        $requete1 = "SELECT * FROM user WHERE login_usr = :usr_login";
        $requete1 = $bdd->prepare($requete1);
        $requete1->execute(array(
            'usr_login' => $_SESSION['login']
        ));
        $ligne = $requete1->fetch();  
        $id_user = $ligne['id_usr'];

        //récupération  des données de la table advancement de l'utilisateur id_user
        $requete2 = "SELECT * FROM advancement WHERE id_usr=:id";
        $requete2 = $bdd->prepare($requete2);
        $requete2->execute(array('id'=>$id_user));
        while ($advancmt = $requete2->fetch()){
          //pour chaque donnée de la table avancement associé à l'utilisateur connecté on récupère l'histoire correspodante
            $histEnCours=$advancmt['id_story'];
            $requete3 = "SELECT * FROM stories WHERE id_story=$histEnCours";
            $requete3 = $bdd->query($requete3);
            while ($histoire = $requete3->fetch()) {
              //pour chaque histoire on affiche l'avancement du joueur  ainsi que son nombre de points et la date
              $num = $advancmt["numChapter"];
              $date = $advancmt['jour'];
              $ptsStories=$histoire['nbrPoints'];

              $requete4 = "SELECT * FROM player_points WHERE id_story=:id_story AND id_user=:id_usr";
              $requete4 = $bdd->prepare($requete4);
              $requete4->execute(array(
                'id_story'=>$histEnCours,
                 'id_usr'=>$id_user
                ));
              if($requete4->rowCount()==1){
                $player=$requete4->fetch();
                $ptsJoueur=$player['points'];
              }
              else{
                $ptsJoueur=0;
              }
              $points=$ptsStories-$ptsJoueur;
            ?>
              <div>
                <h2><em><?= $histoire['title'] ?></em> par <?= $histoire['author'] ?></h2>
                <p>
                  <ul>
                    <li> Chapitre en cours : <?= $num?> </li>
                    <li> Dernière visite le <?= $date?></li>
                    <li> Vous avez actuellement <?= $points?> points sur les <?= $ptsStories?> accordés en début d'histoire.</li>
                  </ul> 
                </p> 
                <p><?= $histoire['summary'] ?></p>
              </div>
              <div id="btn-lecture">
                <?php
                $link = "chapter.php?story_id=$histEnCours&chapter_num=$num&choice_num=0&prev_chap=0";
                ?>
                <a id="size-btn" class="btn btn-outline-dark" href="<?= $link ?>" role="button">Reprendre la lecture !</a>
              </div>
              <hr />
            <?php
            }
            ?>
          </div>
      
          <br />
          <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
        </div>
        <?php
        }
?>
      
</main>
</body>

</html>