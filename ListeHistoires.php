<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre"> Histoires disponibles </p>
        <div>
            <?php
            $requete = "SELECT * FROM stories";
            $resultat = $bdd->query($requete);
            while ($histoire = $resultat->fetch()) {
                $valeur = $histoire["id_story"];
            ?>
                <div>
                    <h2><a href="StorySummary.php?id=<?= $valeur ?>" class="listeHistoires"><em><?= $histoire['title'] ?></em> par <?= $histoire['author'] ?></a></h2>
                </div>
            <?php
            }
            ?>
        </div>
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>