<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
  <div id="backgroundConnexion">
    <p class="titre"> Bienvenue sur MyStories ! </p>
    <br />
    <p>Vous trouverez sur ce site de nombreuses histoires interactives : des histoires dont vous êtes le héro ou l'héroïne ! Sélectionnez une histoire parmi celles écrites par nos membres, et plongez dans un récit sur-mesure, dont l'issue dépend de vos décisions.</p>
    </p>
    <div id="btn-lecture">
      <?php
      if (isset($_SESSION['login'])) {
        $link = "ListeHistoires.php";
      } else {
        $link = "NonConnecte.php";
      }
      ?>
      <a class="btn btn-outline-dark" href="<?= $link ?>" role="button">Commencer la lecture !</a>
    </div>
    <br />
  </div>
</main>

</body>

</html>