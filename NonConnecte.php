<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<div class="accueil">
  <main>
    <div id="backgroundConnexion">
      <p class="titre"> Vous n'êtes pas connecté ! </p>
      <br />
      <p id="centre">Pour pouvoir accéder aux différentes histoires, il est nécessaire que vous soyez connecté.</p>
      </p>
      <br />
      <div id="btn-lecture">
        <a id="size-btn" class="btn btn-outline-dark" href="login.php" role="button">Se connecter</a>
        &nbsp;
        <!--cette instruction permet d'ajouter un espace entre les deux boutons-->
        <a id="size-btn" class="btn btn-outline-secondary" href="inscription.php" role="button">S'inscrire</a>
      </div>
      <br />
    </div>
  </main>
</div>
</body>

</html>