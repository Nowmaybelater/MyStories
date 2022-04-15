<?php session_start(); ?>
<?php include("includes/head.php");?>
<body class="accueil">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand" href="Accueil.php">
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
              <li><a class="dropdown-item" href="#">Histoire 1</a></li>
              <li><a class="dropdown-item" href="#">Histoire 2</a></li>
              <li><a class="dropdown-item" href="#">Histoire 3</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <?php 
              if(isset($_SESSION['login']))
              {
                ?>
                <a class="nav-link active" aria-current="page" href="logout.php"><i class="bi bi-person-fill"></i> Se déconnecter</a>
                <?php
              }
              else
              {
                  ?>
                  <a class="nav-link active" aria-current="page" href="login.php"><i class="bi bi-person-fill"></i> Se connecter</a>
                  <?php
              }
              ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>