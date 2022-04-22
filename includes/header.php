<?php session_start(); ?>
<?php include("includes/head.php"); ?>
<?php include("includes/connect.php") ?>

<body class="accueil">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand" href="Index.php">
        <h2><i class="bi bi-vector-pen"></i> MyStories</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-book"></i> Histoires
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php $requete = "SELECT id_story, title FROM stories";
              $resultat = $bdd->query($requete);
              while ($ligne = $resultat->fetch()) {
                $valeur = $ligne['id_story'];
              ?>
                <li><a class="dropdown-item" href="StorySummary.php?id=<?=$valeur?>"><?= $ligne['title'] ?></a></li>
              <?php } ?>
            </ul>
          </li>  
          <?php
            if (isset($_SESSION['login'])) {
              $login=$_SESSION['login'];
              $access="admin";
              $requete = $bdd->prepare('SELECT * FROM user WHERE login_usr=? AND acces=?');
              $requete->execute(array($login,$access));
              if($requete->rowCount() == 1)
              {
                ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCreate" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                  <i class="bi bi-plus-circle"></i> Édition
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownCreate">
                    <li><a class="dropdown-item" href="story_add.php">Créer</a></li>
                    <li><a class="dropdown-item" href="story_modify.php">Modifier</a></li>
                  </ul>
                </li>
              <?php 
              }
            } ?>        
              <li class="nav-item">
            <?php
            if (isset($_SESSION['login'])) {
            ?>
              <a class="nav-link active" aria-current="page" href="logout.php"><i class="bi bi-person-x-fill"></i> Se déconnecter</a>
            <?php
            } else {
            ?>
              <a class="nav-link active" aria-current="page" href="login.php"><i class="bi bi-person-check-fill"></i> Se connecter</a>
            <?php
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>