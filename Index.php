<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
  <div id="backgroundConnexion">
    <p class="titre"> Bienvenue sur MyStories ! </p>
    <br />
    <h5>Vous trouverez sur ce site de nombreuses histoires interactives : des histoires dont vous êtes le héros ou l'héroïne ! Sélectionnez une histoire parmi celles écrites par nos membres, et plongez dans un récit sur-mesure, dont l'issue dépend de vos décisions.</h5>
    <br />
    <hr />
    <div>
      <?php
      $requete = "SELECT * FROM stories WHERE hide='0'";
      $resultat = $bdd->query($requete);
      while ($histoire = $resultat->fetch()) {
        $valeur = $histoire["id_story"];
      ?>
        <div>
          <h2><em><?= $histoire['title'] ?></em> par <?= $histoire['author'] ?></h2>
          <p><?= $histoire['summary'] ?></p>
        </div>
        <div id="btn-lecture">
          <?php
          if (isset($_SESSION['login'])) {
            $link = "StorySummary.php?id=$valeur.php";
          } else {
            $link = "NonConnecte.php";
          } ?>
          <a id="size-btn" class="btn btn-outline-dark" href="<?= $link ?>" role="button">Découvrir l'histoire</a>
        </div>
        <hr />
      <?php
      }
      ?>
    </div>

    <br />
    <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
  </div>
</main>
<footer id="footer">
    &copy 2022 par Clara Courtois et Valentine Lorsery
  <br />
</footer>
</body>

</html>