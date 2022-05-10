<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
  <div id="backgroundConnexion">
    <p class="titre"> Bibliothèque </p>
    <br />
    <p>Vous trouverez ici la liste des histories que vous avez déjà commencé</p>
    <br />
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
            $histEnCours=$advancmt['id_story'];
            $requete3 = "SELECT * FROM stories WHERE id_story=$histEnCours";
            $requete3 = $bdd->query($requete3);
            while ($histoire = $requete3->fetch()) {
              $num = $advancmt["numChapter"];
              $date = $advancmt['jour'];
            ?>
              <div>
                <h2><em><?= $histoire['title'] ?></em> par <?= $histoire['author'] ?></h2>
                <p>Dernière lecture : chapitre <?= $num?>,  le <?= $date?></p>
                <p><?= $histoire['summary'] ?></p>
              </div>
              <div id="btn-lecture">
                <?php
                //$link = "chapter.php?story_id=$histEnCours&chapter_num=$num&choice_num=0&prev_chap=0";
                  $link = "StorySummary.php?id=$histEnCours.php";
                ?>
                <a class="btn btn-outline-dark" href="<?= $link ?>" role="button">Reprendre la lecture</a>
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