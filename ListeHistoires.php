<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id="backgroundConnexion">
        <p class="titre"> Mes Histoires </p>
        <br />
        <div>
            <?php
            $requete = "SELECT * FROM stories";
            $resultat = $bdd->query($requete);
            while ($histoire = $resultat->fetch()) {
                $valeur = $histoire["id_story"];
            ?>
                <div>
                    <h2><em><?= $histoire['title'] ?></em> par <?= $histoire['author'] ?></h2>
                    <p><?= $histoire['summary'] ?></p>
                </div>
                <div id="btn-lecture">
                    <a class="btn btn-outline-dark" href="story_modify.php" role="button">Modifier</a>
                    &nbsp;
                    <a class="btn btn-outline-dark" href="story_delete.php" role="button">Supprimer</a>
                    &nbsp;
                    <a class="btn btn-outline-dark" href="story_hide.php" role="button">Cacher</a>
                    &nbsp;
                    <a class="btn btn-outline-dark" href="#" role="button">Statistiques</a>
                </div>
                <hr />
            <?php
            }
            ?>
        </div>

        <br />
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>
</body>